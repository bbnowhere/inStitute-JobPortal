<?php

namespace Drupal\instemfileorganizer\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use ZipArchive;

class JobZipExportController extends ControllerBase {

  public function export($job_code) {

    $file_system = \Drupal::service('file_system');

    // 1) Build job folder path
    $job_folder = "private://{$job_code}";
    $job_folder_real = $file_system->realpath($job_folder);

    if (!is_dir($job_folder_real)) {
      return new Response("Job folder not found.", 404);
    }

    // 2) Prepare temp directory for ZIPs
    $zip_dir = 'private://temp_zips';
    $file_system->prepareDirectory(
      $zip_dir,
      \Drupal\Core\File\FileSystemInterface::CREATE_DIRECTORY |
      \Drupal\Core\File\FileSystemInterface::MODIFY_PERMISSIONS
    );

    // 3) ZIP file full path
    $zip_path = $zip_dir . "/{$job_code}.zip";
    $zip_real = $file_system->realpath($zip_path);

    // 4) Create ZIP archive
    $zip = new ZipArchive();
    if ($zip->open($zip_real, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
      return new Response("ZIP creation failed.", 500);
    }

    // 5) Recursively zip entire job folder
    $iterator = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator($job_folder_real, \FilesystemIterator::SKIP_DOTS),
      \RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $file) {
      if ($file->isFile()) {
        $file_path = $file->getRealPath();
        $relative_path = substr($file_path, strlen($job_folder_real) + 1);
        $zip->addFile($file_path, $relative_path);
      }
    }

    $zip->close();

    // 6) Clean ZIPs older than 24 hours
    $this->cleanupOldZips($zip_dir);

    // 7) Download ZIP
    $headers = [
      'Content-Type' => 'application/zip',
      'Content-Disposition' => 'attachment; filename="' . basename($zip_path) . '"',
    ];

    return new Response(file_get_contents($zip_real), 200, $headers);
  }

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
