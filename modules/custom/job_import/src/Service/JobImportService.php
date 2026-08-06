<?php

namespace Drupal\job_import\Service;

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\file\FileRepositoryInterface;
use Drupal\node\Entity\Node;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

/**
 * Imports job JSON payloads into the Job content type.
 */
final class JobImportService {

  /**
   * The import source directory.
   */
  private const SOURCE_DIRECTORY = '/var/data/jobs';

  /**
   * Files to ignore explicitly.
   */
  private const SKIPPED_FILENAMES = [
    'jobs.json',
    'archive.json',
  ];

  /**
   * The field used for business identity in incoming payloads.
   */
  private const EXTERNAL_JOB_ID_FIELD = 'field_external_job_id';

  /**
   * The job code field stored on the node.
   */
  private const JOB_CODE_FIELD = 'field_job_code';

  /**
   * The Job content type identifier.
   */
  private const JOB_TYPE = 'job';

  public function __construct(
    private readonly EntityTypeManagerInterface $entityTypeManager,
    private readonly Connection $database,
    private readonly LoggerChannelFactoryInterface $loggerFactory,
    private readonly FileSystemInterface $fileSystem,
    private readonly FileRepositoryInterface $fileRepository,
    private readonly ClientInterface $httpClient,
  ) {}

  /**
   * Executes the full import from the JSON source directory.
   *
   * @return array{created:int, updated:int, skipped:int, errors:int}
   *   Import summary counters.
   */
  public function importAll(): array {
    $stats = [
      'created' => 0,
      'updated' => 0,
      'skipped' => 0,
      'errors' => 0,
      'failed_files' => [],
    ];

    $this->loggerFactory->get('job_import')->notice('Import Started');

    if (!is_dir(self::SOURCE_DIRECTORY)) {
      $message = sprintf('Import source directory not found: %s', self::SOURCE_DIRECTORY);
      $this->loggerFactory->get('job_import')->error('Import source directory not found: @path', [
        '@path' => self::SOURCE_DIRECTORY,
      ]);
      throw new RuntimeException($message);
    }

    $files = glob(self::SOURCE_DIRECTORY . DIRECTORY_SEPARATOR . '*.json');
    if ($files === false) {
      $files = [];
    }

    sort($files, SORT_NATURAL | SORT_FLAG_CASE);

    foreach ($files as $file_path) {
      $filename = basename($file_path);
      if (in_array($filename, self::SKIPPED_FILENAMES, true)) {
        $stats['skipped']++;
        continue;
      }

      $this->loggerFactory->get('job_import')->notice('Reading @file', [
        '@file' => $filename,
      ]);

      try {
        $result = $this->processJsonFile($file_path);
        if ($result === 'created') {
          $stats['created']++;
          $this->loggerFactory->get('job_import')->notice('Job Imported Successfully');
        }
        elseif ($result === 'updated') {
          $stats['updated']++;
          $this->loggerFactory->get('job_import')->notice('Job Imported Successfully');
        }
        else {
          $stats['skipped']++;
        }
      }
      catch (RuntimeException $exception) {
        $stats['errors']++;
        $stats['failed_files'][] = [
          'filename' => $filename,
          'reason' => $exception->getMessage(),
        ];
        $this->logException($exception, 'Import failed for @file', ['@file' => $filename]);
        continue;
      }
      catch (\Throwable $throwable) {
        $stats['errors']++;
        $stats['failed_files'][] = [
          'filename' => $filename,
          'reason' => $throwable->getMessage(),
        ];
        $this->logException($throwable, 'Import failed for @file', ['@file' => $filename]);
        continue;
      }
    }

    $this->loggerFactory->get('job_import')->notice('Import completed', $stats);
    return $stats;
  }

  /**
   * Processes a single JSON file.
   */
  private function processJsonFile(string $file_path): string {
    $filename = basename($file_path);
    $this->loggerFactory->get('job_import')->debug('Loading JSON @file', [
      '@file' => $filename,
    ]);

    $contents = file_get_contents($file_path);
    if ($contents === false) {
      throw new RuntimeException(sprintf('Unable to read file: %s', $filename));
    }

    try {
      $payload = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    }
    catch (\JsonException $exception) {
      throw new RuntimeException(sprintf('Invalid JSON in %s: %s', $filename, $exception->getMessage()));
    }

    if (!is_array($payload)) {
      throw new RuntimeException(sprintf('JSON root is not an object in %s', $filename));
    }

    $job_code = $this->extractJobCode($payload);
    $external_job_id = $this->extractExternalJobId($payload);
    if ($external_job_id === '') {
      throw new RuntimeException(sprintf('Missing or empty field_external_job_id in %s', $filename));
    }

    $this->loggerFactory->get('job_import')->debug('Finding existing node for @external_job_id', [
      '@external_job_id' => $external_job_id,
    ]);
    $node = $this->findNodeByExternalJobId($external_job_id);
    $node_data = $this->buildNodeData($payload, $job_code, $external_job_id);

    if ($node === null) {
      $this->loggerFactory->get('job_import')->debug('Creating node for @external_job_id', [
        '@external_job_id' => $external_job_id,
      ]);
      $node = Node::create([
        'type' => self::JOB_TYPE,
        'title' => $node_data['title'],
      ]);
      $node->set(self::JOB_CODE_FIELD, $job_code);
      $this->applyNodeData($node, $node_data);
      $this->loggerFactory->get('job_import')->debug('Saving node for @job_code', [
        '@job_code' => $job_code,
      ]);
      $node->save();
      $this->loggerFactory->get('job_import')->notice('Creating Job', [
        'job_code' => $job_code,
        'nid' => $node->id(),
      ]);
      return 'created';
    }

    $this->loggerFactory->get('job_import')->debug('Updating node for @external_job_id', [
      '@external_job_id' => $external_job_id,
    ]);
    $this->applyNodeData($node, $node_data);
    $this->loggerFactory->get('job_import')->debug('Saving node for @job_code', [
      '@job_code' => $job_code,
    ]);
    $node->save();
    $this->loggerFactory->get('job_import')->notice('Updating Job', [
      'job_code' => $job_code,
      'nid' => $node->id(),
    ]);
    return 'updated';
  }

  /**
   * Retrieves the Job node with the matching external job identifier.
   */
  private function findNodeByExternalJobId(string $external_job_id): ?\Drupal\node\NodeInterface {
    $result = $this->entityTypeManager
      ->getStorage('node')
      ->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', self::JOB_TYPE)
      ->condition(self::EXTERNAL_JOB_ID_FIELD, $external_job_id)
      ->range(0, 1)
      ->execute();

    if (empty($result)) {
      return NULL;
    }

    $nid = reset($result);
    return $this->entityTypeManager->getStorage('node')->load($nid);
  }

  /**
   * Maps the JSON payload to Drupal field values.
   *
   * @return array<string, mixed>
   */
  private function buildNodeData(array $payload, string $job_code, string $external_job_id = ''): array {
    $source = is_array($payload['fields'] ?? NULL) ? array_merge($payload, $payload['fields']) : $payload;
    $title = trim((string) ($source['title'] ?? $job_code));
    $field_data = [
      'title' => $title === '' ? $job_code : $title,
      self::JOB_CODE_FIELD => $job_code,
      self::EXTERNAL_JOB_ID_FIELD => $this->stringValue($external_job_id !== '' ? $external_job_id : ($source[self::EXTERNAL_JOB_ID_FIELD] ?? NULL)),
      'field_department' => $this->stringValue($source['field_department'] ?? NULL),
      'field_employment_recruitment' => $this->normalizeListValue('field_employment_recruitment', $source['field_employment_type_recruitmen'] ?? $source['field_employment_recruitment'] ?? NULL),
      'field_application_type' => $this->normalizeListValue('field_application_type', $source['field_application_type'] ?? NULL),
      'field_age_limit' => $this->intValue($source['field_age_limit_in_years'] ?? $source['field_age_limit'] ?? NULL),
      'field_category_reservation' => $this->boolValue($source['field_category_reservation'] ?? NULL),
      'field_category' => $this->normalizeListValue('field_category', $source['field_category'] ?? NULL),
      'field_other_category' => $this->stringValue($source['field_other_category'] ?? NULL),
      'field_salary_offered' => $this->stringValue($source['field_salary_offered'] ?? NULL),
      'field_cutoff_required' => $this->boolValue($source['field_cutoff_required'] ?? NULL),
      'field_min_experience' => $this->intValue($source['field_minimum_experience_require'] ?? $source['field_min_experience'] ?? NULL),
      'field_number_of_vacancies' => $this->intValue($source['field_number_of_vacancies'] ?? NULL),
      'field_last_date' => $this->dateValue($source['field_last_date_to_apply_date_o'] ?? $source['field_last_date'] ?? NULL),
      'field_job_description' => $this->textareaValue($source['field_job_description'] ?? NULL),
      'field_press_release' => $this->downloadFileField($source['field_press_release'] ?? NULL, $job_code, 'field_press_release'),
      'field_result' => $this->textareaValue($source['field_result'] ?? NULL),
      'field_announcement' => $this->textareaValue($source['field_announcement'] ?? NULL),
      'field_job_advertisement_upload' => $this->downloadFileField($source['field_job_advertisement_upload'] ?? NULL, $job_code, 'field_job_advertisement_upload'),
      'field_result_upload' => $this->downloadFileField($source['field_result_upload'] ?? NULL, $job_code, 'field_result_upload'),
      'field_shortlisted_candidates' => $this->downloadFileField($source['field_upload_shortlisted_candida'] ?? $source['field_shortlisted_candidates'] ?? NULL, $job_code, 'field_shortlisted_candidates'),
      'field_selected_candidate' => $this->downloadFileField($source['field_upload_selected_candidate'] ?? $source['field_selected_candidate'] ?? NULL, $job_code, 'field_selected_candidate'),
      'field_job_status' => $this->normalizeListValue('field_job_status', $source['field_job_status'] ?? ((($source['status'] ?? NULL) === true) ? 'In Process' : NULL)),
      'status' => $this->normalizeStatusValue($source['status'] ?? NULL),
    ];

    $field_data = array_filter($field_data, static fn ($value): bool => $value !== NULL && $value !== [] && $value !== '');
    return $field_data;
  }

  /**
   * Applies mapped data to a node, including publication state.
   *
   * @param array<string, mixed> $node_data
   */
  private function applyNodeData(\Drupal\Core\Entity\EntityInterface $node, array $node_data): void {
    foreach ($node_data as $field_name => $value) {
      if ($field_name === 'title') {
        $node->setTitle((string) $value);
        continue;
      }

      if ($field_name === 'status') {
        continue;
      }

      if (!$node->hasField($field_name)) {
        continue;
      }

      $node->set($field_name, $value);
    }

    if ($this->shouldPublish($node_data)) {
      $node->setPublished();
      $this->loggerFactory->get('job_import')->debug('Publishing node for @job_code', [
        '@job_code' => $node->get(self::JOB_CODE_FIELD)->value ?? NULL,
      ]);
      $this->loggerFactory->get('job_import')->notice('Job Published', [
        'nid' => $node->id(),
        'job_code' => $node->get(self::JOB_CODE_FIELD)->value ?? NULL,
      ]);
    }
    else {
      $node->setUnpublished();
      $this->loggerFactory->get('job_import')->debug('Unpublishing node for @job_code', [
        '@job_code' => $node->get(self::JOB_CODE_FIELD)->value ?? NULL,
      ]);
      $this->loggerFactory->get('job_import')->notice('Job Unpublished', [
        'nid' => $node->id(),
        'job_code' => $node->get(self::JOB_CODE_FIELD)->value ?? NULL,
      ]);
    }
  }

  /**
   * Determines whether the job should be published.
   *
   * @param array<string, mixed> $node_data
   */
  private function shouldPublish(array $node_data): bool {
    $status = $node_data['status'] ?? NULL;
    if (is_string($status)) {
      $normalized = strtolower(trim($status));
      if ($normalized === 'active') {
        return TRUE;
      }
      if (in_array($normalized, ['archived', 'closed'], true)) {
        return FALSE;
      }
    }

    $job_status = $node_data['field_job_status'] ?? NULL;
    if (is_string($job_status) && strcasecmp($job_status, 'In Process') === 0) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Extracts the unique job code from a payload.
   */
  private function extractJobCode(array $payload): string {
    $source = is_array($payload['fields'] ?? NULL) ? array_merge($payload, $payload['fields']) : $payload;
    $value = $source[self::JOB_CODE_FIELD] ?? $source['job_code'] ?? NULL;
    return trim((string) $value);
  }

  /**
   * Extracts the external job identifier from a payload.
   */
  private function extractExternalJobId(array $payload): string {
    $source = is_array($payload['fields'] ?? NULL) ? array_merge($payload, $payload['fields']) : $payload;
    $value = $source[self::EXTERNAL_JOB_ID_FIELD] ?? $source['external_job_id'] ?? $source[self::JOB_CODE_FIELD] ?? $source['job_code'] ?? NULL;
    return trim((string) $value);
  }

  /**
   * Converts a scalar value to a plain string.
   */
  private function stringValue(mixed $value): ?string {
    if ($value === NULL || $value === '') {
      return NULL;
    }

    if (is_array($value)) {
      if (isset($value['value'])) {
        return trim((string) $value['value']);
      }
      return NULL;
    }

    return trim((string) $value);
  }

  /**
   * Converts a value to integer.
   */
  private function intValue(mixed $value): ?int {
    if ($value === NULL || $value === '') {
      return NULL;
    }

    if (is_string($value) && trim($value) === '') {
      return NULL;
    }

    return (int) $value;
  }

  /**
   * Converts a value to bool.
   */
  private function boolValue(mixed $value): ?bool {
    if ($value === NULL || $value === '') {
      return NULL;
    }

    if (is_bool($value)) {
      return $value;
    }

    if (is_int($value)) {
      return $value === 1;
    }

    if (is_string($value)) {
      $normalized = strtolower(trim($value));
      if (in_array($normalized, ['1', 'true', 'yes', 'y', 'on'], true)) {
        return TRUE;
      }
      if (in_array($normalized, ['0', 'false', 'no', 'n', 'off'], true)) {
        return FALSE;
      }
    }

    return (bool) $value;
  }

  /**
   * Normalizes a status value from the source payload.
   */
  private function normalizeStatusValue(mixed $value): ?string {
    $string_value = $this->stringValue($value);
    if ($string_value === NULL) {
      return NULL;
    }

    $normalized = strtolower(trim($string_value));
    if (in_array($normalized, ['active', 'archived', 'closed'], true)) {
      return $normalized;
    }

    return $string_value;
  }

  /**
   * Converts a string to a Drupal date field value.
   */
  private function dateValue(mixed $value): mixed {
    $string_value = $this->stringValue($value);
    if ($string_value === NULL) {
      return NULL;
    }

    return $string_value;
  }

  /**
   * Converts text objects or strings to textarea values.
   */
  private function textareaValue(mixed $value): mixed {
    if ($value === NULL || $value === '') {
      return NULL;
    }

    if (is_array($value) && isset($value['value'])) {
      $value = $value['value'];
    }

    return [
      'value' => (string) $value,
      'format' => 'plain_text',
    ];
  }

  /**
   * Normalizes values for Drupal option/select fields.
   */
  private function normalizeListValue(string $field_name, mixed $value): ?string {
    $string_value = $this->stringValue($value);
    if ($string_value === NULL) {
      return NULL;
    }

    $normalized = strtolower(str_replace(['-', '_'], ' ', $string_value));

    $map = [
      'field_employment_recruitment' => [
        'direct recruitment' => 'Direct Recruitment',
        'deputation' => 'Deputation',
        'temporary' => 'Temporary',
      ],
      'field_application_type' => [
        'online' => 'Online',
        'walkin' => 'Walkin',
        'walk-in' => 'Walkin',
        'external' => 'External',
      ],
      'field_category' => [
        'general' => 'general',
        'obc' => 'obc',
        'sc' => 'sc',
        'st' => 'st',
        'ews' => 'ews',
        'economically weaker' => 'ews',
      ],
      'field_job_status' => [
        'in process' => 'In Process',
        'in_process' => 'In Process',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
      ],
    ];

    $options = $map[$field_name] ?? [];
    if (array_key_exists($normalized, $options)) {
      return $options[$normalized];
    }

    return $string_value;
  }

  /**
   * Downloads a remote file URI and creates or reuses a Drupal file entity.
   */
  private function downloadFileField(mixed $value, string $job_code, string $field_name): mixed {
    if ($value === NULL || $value === '' || $value === []) {
      return NULL;
    }

    $source_uri = is_array($value) ? ($value['uri'] ?? $value['url'] ?? NULL) : $value;
    if (!is_string($source_uri) || trim($source_uri) === '') {
      return NULL;
    }

    $parsed = parse_url($source_uri);
    $path = $parsed['path'] ?? $source_uri;
    $basename = basename($path);
    if ($basename === '') {
      $basename = sprintf('%s-%s.pdf', $job_code, $field_name);
    }

    $existing_file = $this->findExistingFileByFilename($basename);
    if ($existing_file !== NULL) {
      return ['target_id' => $existing_file->id()];
    }

    $this->loggerFactory->get('job_import')->debug('Downloading files for @job_code', [
      '@job_code' => $job_code,
    ]);

    try {
      $response = $this->httpClient->request('GET', $source_uri, ['timeout' => 30]);
      $status_code = $response->getStatusCode();
      if ($status_code < 200 || $status_code >= 300) {
        $this->loggerFactory->get('job_import')->error('Job @job_code - Field @field - Download failed. URL: @url HTTP @status Filename: @filename', [
          '@job_code' => $job_code,
          '@field' => $field_name,
          '@url' => $source_uri,
          '@status' => $status_code,
          '@filename' => $basename,
        ]);
        return NULL;
      }

      $contents = (string) $response->getBody();
      $this->loggerFactory->get('job_import')->notice('Downloading @field PDF', [
        '@field' => ucfirst(str_replace('_', ' ', $field_name)),
      ]);
    }
    catch (GuzzleException $exception) {
      $this->loggerFactory->get('job_import')->error('Job @job_code - Field @field - Unable to download file. URL: @url Message: @message File: @file Line: @line Trace: @trace', [
        '@job_code' => $job_code,
        '@field' => $field_name,
        '@url' => $source_uri,
        '@message' => $exception->getMessage(),
        '@file' => $exception->getFile(),
        '@line' => $exception->getLine(),
        '@trace' => $exception->getTraceAsString(),
      ]);
      return NULL;
    }

    $directory = sprintf('public://job_import/%s', $job_code);
    try {
      $prepared = $this->fileSystem->prepareDirectory($directory, FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);
      if ($prepared === FALSE) {
        throw new RuntimeException(sprintf('Destination directory could not be prepared: %s', $directory));
      }

      $destination = sprintf('%s/%s', $directory, $basename);
      $file = $this->fileRepository->writeData($contents, $destination, FileSystemInterface::EXISTS_REPLACE);
      if ($file instanceof \Drupal\file\FileInterface) {
        $file->setPermanent();
        $file->save();
        return ['target_id' => $file->id()];
      }
    }
    catch (\Throwable $exception) {
      $this->loggerFactory->get('job_import')->error('Job @job_code - Field @field - File write failed. URL: @url Filename: @filename Message: @message File: @file Line: @line Trace: @trace', [
        '@job_code' => $job_code,
        '@field' => $field_name,
        '@url' => $source_uri,
        '@filename' => $basename,
        '@message' => $exception->getMessage(),
        '@file' => $exception->getFile(),
        '@line' => $exception->getLine(),
        '@trace' => $exception->getTraceAsString(),
      ]);
      return NULL;
    }

    return NULL;
  }

  /**
   * Reuses existing file entities with the same filename when possible.
   */
  private function findExistingFileByFilename(string $filename): ?\Drupal\file\FileInterface {
    $files = $this->entityTypeManager->getStorage('file')->loadByProperties([
      'filename' => $filename,
    ]);

    if (!$files) {
      return NULL;
    }

    return reset($files);
  }

  /**
   * Logs a throwable with a stack trace and useful metadata.
   */
  private function logException(\Throwable $exception, string $message, array $context = []): void {
    $this->loggerFactory->get('job_import')->error($message, array_merge([
      '@message' => $exception->getMessage(),
      '@file' => $exception->getFile(),
      '@line' => $exception->getLine(),
      '@trace' => $exception->getTraceAsString(),
    ], $context));
  }

}
