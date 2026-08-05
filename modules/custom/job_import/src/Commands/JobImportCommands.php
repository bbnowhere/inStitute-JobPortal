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

    $this->io()->writeln('Created: ' . $stats['created']);
    $this->io()->writeln('Updated: ' . $stats['updated']);
    $this->io()->writeln('Skipped: ' . $stats['skipped']);
    $this->io()->writeln('Errors: ' . $stats['errors']);

    return self::EXIT_SUCCESS;
  }

}
