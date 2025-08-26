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

    // Build the sidebar block plugin instance programmatically and render it.
    $block_manager = \Drupal::service('plugin.manager.block');
    $plugin_block = $block_manager->createInstance('application_sidebar_block', [
      'job' => $job_node->id(),
      'sections' => $sections,
      'completion' => $completion,
    ]);
    $sidebar_build = $plugin_block->build();

    return [
      '#theme' => 'job_application_dashboard',
      '#job' => $job_node,
      '#sections' => $sections,
      '#completion' => $completion,
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

}