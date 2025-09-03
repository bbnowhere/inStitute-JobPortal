<?php

namespace Drupal\instemjobportal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Controller for Job application dashboard.
 */
class DashboardController extends ControllerBase {

  public function dashboard($job) {
    // Require login.
    if (!$this->currentUser()->isAuthenticated()) {
      return new RedirectResponse('/user/login');
    }

    $job_node = Node::load($job);
    if (!$job_node || $job_node->bundle() !== 'job') {
      return ['#markup' => $this->t('Invalid job.')];
    }

    $sections = [
      'personal_information' => $this->t('Personal Information'),
      'education' => $this->t('Education'),
      'employment_details' => $this->t('Employment Details'),
      'referee' => $this->t('Referee'),
      'additional_information' => $this->t('Additional Information'),
      'file_upload' => $this->t('File Upload'),
    ];

    // Check completion status for each section.
    $completion = [];
    $uid = $this->currentUser()->id();
    foreach ($sections as $bundle => $label) {
      // Entity query: look for a node of this bundle by this user that references this job.
      $query = \Drupal::entityQuery('node')
        ->condition('type', $bundle)
        ->condition('uid', $uid)
        // Use the ER field's target_id column:
        ->condition('field_application.target_id', $job_node->id())
        ->accessCheck(TRUE)
        ->range(0, 1);
      $result = $query->execute();
      $completion[$bundle] = !empty($result);
    }

    // Normalize sections into a numeric array of simple arrays.
    $section_items = $this->sanitizeSections($sections, $completion ?? [], $job_node->id());

    // Build the sidebar block instance and render it.
    $block_manager = \Drupal::service('plugin.manager.block');
    $plugin_block = $block_manager->createInstance('application_sidebar_block', [
      'job' => $job_node->id(),
      'sections' => $section_items,
    ]);
    $sidebar_build = $plugin_block->build();

    // Calculate total completion percentage for the progress bar.
    $completed_sections = array_filter($completion, function($status) {
        return $status === TRUE;
    });
    $total_sections = count($sections);
    $completion_percentage = $total_sections > 0 ? (int) (count($completed_sections) / $total_sections * 100) : 0;

    return [
      '#theme' => 'job_application_dashboard',
      '#job' => $job_node,
      '#sections' => $section_items,
      '#completion' => $completion_percentage,
      '#sidebar' => $sidebar_build,
    ];
  }

  /**
   * Route controller that gates access then redirects to core node.add
   * while preserving the ?job query parameter.
   *
   * Path: /apply/{job}/add/{node_type}
   */
  public function addNode($job, $node_type) {
    if (!$this->currentUser()->isAuthenticated()) {
      return new RedirectResponse('/user/login');
    }

    $job_node = Node::load($job);
    if (!$job_node || $job_node->bundle() !== 'job') {
      throw new AccessDeniedHttpException();
    }

    // Allow if user role applicant OR has placeholder permission.
    $account = $this->currentUser();
    $has_applicant_role = in_array('applicant', $account->getRoles());
    $has_permission = $account->hasPermission('create content via job link');

    if (!$has_applicant_role && !$has_permission) {
      throw new AccessDeniedHttpException();
    }

    // Redirect to core node add route with the job in query string.
    return $this->redirect('node.add', ['node_type' => $node_type], ['query' => ['job' => $job]]);
  }

  /**
   * Convert a possibly-keyed $sections input into a numeric array of arrays
   * with bundle/title/status/link keys. Always returns an array of arrays.
   */
  private function sanitizeSections($sections, array $completion = [], $job_id = NULL) {
    $safe = [];
    if (!is_array($sections)) {
      return $safe;
    }
    foreach ($sections as $key => $item) {
      // boolean true => completed section named by key.
      if ($item === TRUE) {
        $safe[] = [
          'bundle' => (string) $key,
          'title' => ucfirst(str_replace('_', ' ', (string) $key)),
          'status' => 'complete',
          'link' => "/apply/{$job_id}/add/{$key}",
        ];
        continue;
      }
      // boolean false => skip.
      if ($item === FALSE) {
        continue;
      }
      // scalar/object -> title
      if (!is_array($item)) {
        try {
          $title = (string) $item;
        } catch (\Throwable $e) {
          $title = (string) $key;
        }
        $safe[] = [
          'bundle' => (string) $key,
          'title' => $title ?: ucfirst(str_replace('_', ' ', (string) $key)),
          'status' => !empty($completion[$key]) ? 'complete' : 'incomplete',
          'link' => "/apply/{$job_id}/add/{$key}",
        ];
        continue;
      }

      // item is array: normalize fields.
      $title = $item['title'] ?? ($item['#title'] ?? (string) $key);
      if (is_array($title)) {
        try { $title = trim(strip_tags(\Drupal::service('renderer')->renderPlain($title))); } catch (\Throwable $e) { $title = (string) $key; }
      } else {
        $title = trim(strip_tags((string) $title));
      }
      $status = strtolower(trim((string) ($item['status'] ?? $item['#status'] ?? ($completion[$key] ? 'complete' : 'incomplete'))));
      $status_map = ['completed'=>'complete','complete'=>'complete','done'=>'complete','finished'=>'complete'];
      $status = $status_map[$status] ?? ($status ?: 'incomplete');
      $link = $item['link'] ?? ($item['#url'] ?? ($item['#href'] ?? "/apply/{$job_id}/add/{$key}"));
      if (is_array($link)) {
        try { $link = \Drupal::service('renderer')->renderPlain($link); } catch (\Throwable $e) { $link = NULL; }
      } elseif (is_object($link) && method_exists($link, '__toString')) {
        $link = (string) $link;
      } else {
        $link = $link !== NULL ? (string) $link : NULL;
      }

      $safe[] = [
        'bundle' => (string) $key,
        'title' => $title ?: ucfirst(str_replace('_', ' ', (string) $key)),
        'status' => $status,
        'link' => $link,
      ];
    }

    return array_values($safe);
  }
}