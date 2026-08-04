<?php

namespace Drupal\instemfileorganizer\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;
use ZipArchive;

/**
 * Controller for exporting full application data as ZIP.
 */
class ZipExportController extends ControllerBase {

  /**
   * Generate and download ZIP of full application.
   */
  public function export($application_id) {

    $file_system = \Drupal::service('file_system');

    /**
     * 1) LOAD personal_information NODE using application_id.
     */
    $results = \Drupal::entityTypeManager()
      ->getStorage('node')
      ->loadByProperties([
        'type' => 'personal_information',
        'field_application_id' => $application_id,
      ]);

    if (!$results) {
      return new Response('Invalid Application ID', 404);
    }

    /** @var \Drupal\node\Entity\Node $pi_node */
    $pi_node = reset($results);

    /**
     * 2) Get Job & Job Code.
     */
    if ($pi_node->get('field_application')->isEmpty()) {
      return new Response('Job reference missing.', 400);
    }

    $job_nid = $pi_node->get('field_application')->target_id;
    $job_node = Node::load($job_nid);

    if (!$job_node || $job_node->get('field_job_code')->isEmpty()) {
      return new Response('Job code unavailable.', 400);
    }

    $job_code = $job_node->get('field_job_code')->value;

    /**
     * 3) Build application folder path.
     */
    $app_folder = "private://{$job_code}/{$application_id}";
    $app_folder_real = $file_system->realpath($app_folder);

    if (!is_dir($app_folder_real)) {
      return new Response("Application folder not found.", 404);
    }

    /**
     * 4) Prepare ZIP directory.
     */
    $zip_dir = 'private://temp_zips';
    $file_system->prepareDirectory(
      $zip_dir,
      \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY |
      \Drupal\Core\File\FileSystemInterface::MODIFY_PERMISSIONS
    );

    $zip_path = $zip_dir . "/{$job_code}_{$application_id}.zip";
    $zip_real = $file_system->realpath($zip_path);

    /**
     * 5) Create ZIP archive.
     */
    $zip = new ZipArchive();
    if ($zip->open($zip_real, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
      return new Response("ZIP creation failed.", 500);
    }

    $iterator = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator($app_folder_real, \FilesystemIterator::SKIP_DOTS),
      \RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $file) {
      if ($file->isFile()) {
        $file_path = $file->getRealPath();
        $relative_path = substr($file_path, strlen($app_folder_real) + 1);
        $zip->addFile($file_path, $relative_path);
      }
    }

    $zip->close();

    /**
     * 6) Auto-delete ZIP files older than 24 hours (cleanup).
     */
    $this->cleanupOldZips($zip_dir);

    /**
     * 7) Serve ZIP as a download.
     */
    $headers = [
      'Content-Type' => 'application/zip',
      'Content-Disposition' => 'attachment; filename="' . basename($zip_path) . '"',
    ];

    return new Response(file_get_contents($zip_real), 200, $headers);
  }


  /**
   * Remove ZIP files older than 24 hours from temp folder.
   */
  private function cleanupOldZips($dir) {
    $fs = \Drupal::service('file_system');
    $real_dir = $fs->realpath($dir);

    foreach (glob($real_dir . "/*.zip") as $zip_file) {
      if (filemtime($zip_file) < (time() - 86400)) { // 24 hours
        @unlink($zip_file);
      }
    }
  }

}