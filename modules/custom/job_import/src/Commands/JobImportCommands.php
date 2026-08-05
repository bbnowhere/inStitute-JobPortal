<?php

namespace Drupal\job_import\Commands;

use Drupal\job_import\Service\JobImportService;
use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;

/**
 * Drush command for importing recruitment jobs from JSON files.
 */
final class JobImportCommands extends DrushCommands {

  public function __construct(
    private readonly JobImportService $jobImportService,
  ) {
    parent::__construct();
  }

  /**
   * Import jobs from JSON files stored in /var/data/jobs.
   */
  #[CLI\Command(name: 'job:import', description: 'Import jobs from /var/data/jobs JSON files.')]
  public function import(): int {
    $this->io()->writeln('Job Import Started');

    $stats = $this->jobImportService->importAll();

    if (!empty($stats['failed_files'])) {
      $this->io()->writeln('ERROR');
      $this->io()->writeln('');
      foreach ($stats['failed_files'] as $failed_file) {
        $filename = $failed_file['filename'] ?? 'Unknown';
        $reason = $failed_file['reason'] ?? 'Unknown error';
        $this->io()->writeln($filename);
        $this->io()->writeln('Reason');
        $this->io()->writeln($reason);
      }
      $this->io()->writeln('');
    }

    $this->io()->writeln('==================================');
    $this->io()->writeln('Import Summary');
    $this->io()->writeln('');
    $this->io()->writeln('Created : ' . $stats['created']);
    $this->io()->writeln('Updated : ' . $stats['updated']);
    $this->io()->writeln('Skipped : ' . $stats['skipped']);
    $this->io()->writeln('Errors  : ' . $stats['errors']);
    $this->io()->writeln('----------------------------------');

    if (!empty($stats['failed_files'])) {
      $this->io()->writeln('');
      $this->io()->writeln('Failed Files');
      foreach ($stats['failed_files'] as $failed_file) {
        $filename = $failed_file['filename'] ?? 'Unknown';
        $reason = $failed_file['reason'] ?? 'Unknown error';
        $this->io()->writeln($filename);
        $this->io()->writeln('Reason');
        $this->io()->writeln($reason);
      }
    }

    return $stats['errors'] > 0 ? self::EXIT_FAILURE : self::EXIT_SUCCESS;
  }

}
