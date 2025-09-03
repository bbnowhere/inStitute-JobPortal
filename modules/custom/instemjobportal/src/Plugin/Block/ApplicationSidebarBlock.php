<?php

namespace Drupal\instemjobportal\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides an application sidebar block.
 *
 * @Block(
 *   id = "application_sidebar_block",
 *   admin_label = @Translation("Application Sidebar")
 * )
 */
class ApplicationSidebarBlock extends BlockBase {

  public function build() {
    $config = $this->getConfiguration();
    // Prefer explicit configuration. If not present, prefer a route parameter
    // named 'job'. If that is not present (for example when the job is
    // supplied as a query argument like ?job=39), fall back to the request
    // query parameter. This prevents empty values being passed into the
    // instemjobportal.add_node route which requires a non-empty {job} value.
    $job_id = !empty($config['job'])
      ? $config['job']
      : (\Drupal::routeMatch()->getParameter('job') ?? \Drupal::request()->query->get('job'));
    // Normalize job_id to a scalar (nid or string) if an object was passed.
    if (is_object($job_id)) {
      if (method_exists($job_id, 'id')) {
        $job_id = $job_id->id();
      }
      elseif (method_exists($job_id, 'label')) {
        $job_id = $job_id->label();
      }
      else {
        $job_id = (string) $job_id;
      }
    }
    $sections = !empty($config['sections']) ? $config['sections'] : [
      'personal_information' => $this->t('Personal Information'),
      'education' => $this->t('Education'),
      'employment_details' => $this->t('Employment Details'),
      'referee' => $this->t('Referee'),
      'additional_information' => $this->t('Additional Information'),
      'file_upload' => $this->t('File Upload'),
    ];
    $completion = !empty($config['completion']) ? $config['completion'] : [];

    // If completion wasn't provided by the caller (for example when the
    // block is rendered outside the dashboard controller), compute it here so
    // the Preview and Submit enablement reflects actual node state.
    if (empty($completion) && !empty($job_id)) {
      $completion = [];
      $current_user = \Drupal::currentUser();
      $uid = $current_user->id();
      foreach ($sections as $bundle => $label) {
        try {
          $query = \Drupal::entityQuery('node')
            ->condition('type', $bundle)
            ->condition('uid', $uid)
            ->condition('field_application.target_id', $job_id)
            ->accessCheck(TRUE)
            ->range(0, 1);
          $result = $query->execute();
          $completion[$bundle] = !empty($result);
        }
        catch (\Throwable $e) {
          // If the query fails, assume not complete for safety.
          $completion[$bundle] = FALSE;
        }
      }
    }

    $current_route = \Drupal::routeMatch()->getRouteName();
    $current_node_type = \Drupal::routeMatch()->getParameter('node_type');
    // Normalize current_node_type to scalar if object.
    if (is_object($current_node_type)) {
      if (method_exists($current_node_type, 'id')) {
        $current_node_type = $current_node_type->id();
      }
      elseif (method_exists($current_node_type, 'label')) {
        $current_node_type = $current_node_type->label();
      }
      else {
        $current_node_type = (string) $current_node_type;
      }
    }
    $current_job_query = \Drupal::request()->query->get('job');
    if (is_object($current_job_query)) {
      if (method_exists($current_job_query, 'id')) {
        $current_job_query = $current_job_query->id();
      }
      elseif (method_exists($current_job_query, 'label')) {
        $current_job_query = $current_job_query->label();
      }
      else {
        $current_job_query = (string) $current_job_query;
      }
    }

    $items = [];
    foreach ($sections as $machine => $label) {
      // Determine if an application node already exists for this section/job.
      $existing_nid = NULL;
      // Use a direct entity query and disable access checks to reliably find
      // any nodes the current user created that reference this job.
      try {
  $current_user = \Drupal::currentUser();
        if ($current_user->isAuthenticated() && !empty($job_id)) {
          $uid = $current_user->id();
          $query = \Drupal::entityQuery('node')
            ->accessCheck(FALSE)
            ->condition('type', $machine)
            ->condition('uid', $uid)
            ->condition('field_application.target_id', $job_id)
            ->range(0, 1);
          $result = $query->execute();
          if (!empty($result)) {
            $existing_nid = reset($result);
          }
        }
      }
      catch (\Throwable $e) {
        // If the query fails for any reason, fall back to helper if present.
        if (function_exists('instemjobportal_find_application_node')) {
          $existing_nid = instemjobportal_find_application_node($machine, \Drupal::currentUser()->id(), $job_id);
        }
      }

      if (!empty($existing_nid)) {
        // Link to edit the existing node. Preserve the job query parameter
        // when available so the edit flow retains context (e.g. /node/25/edit?job=39).
        if (!empty($job_id)) {
          $url = Url::fromRoute('entity.node.edit_form', ['node' => $existing_nid], ['query' => ['job' => $job_id]]);
        }
        else {
          $url = Url::fromRoute('entity.node.edit_form', ['node' => $existing_nid]);
        }
      }
      else {
        // If we have a job id, link to the gated add route which preserves
        // the job context. If not, fall back to the normal node.add route so
        // we don't attempt to generate a URL with an empty {job} parameter
        // (which causes an InvalidParameterException).
        if (!empty($job_id)) {
          $url = Url::fromRoute('instemjobportal.add_node', [
            'job' => $job_id,
            'node_type' => $machine,
          ]);
        }
        else {
          $url = Url::fromRoute('node.add', ['node_type' => $machine]);
        }
      }

      // Ensure the label is a string. If it's an array, convert to a readable string.
      if (is_array($label)) {
        // Try to get a 'title' key if present, otherwise serialize.
        $label_text = isset($label['title']) ? $label['title'] : json_encode($label);
      }
      elseif (is_object($label)) {
        if (method_exists($label, 'label')) {
          $label_text = $label->label();
        }
        else {
          $label_text = (string) $label;
        }
      }
      else {
        $label_text = (string) $label;
      }

      // Create a renderable link so Twig can render it directly.
      $link = Link::fromTextAndUrl($label_text, $url)->toRenderable();

      $completed = !empty($completion[$machine]);
      $status = $completed ? '✅' : '🕒';

      // Active if:
      // - user is on the gated add route for this section and job, OR
      // - user is on the core node.add form for this node_type and job query param matches.
      $active = (
        ($current_route === 'instemjobportal.add_node' && (string) $current_node_type === (string) $machine && (string) \Drupal::routeMatch()->getParameter('job') === (string) $job_id)
        ||
        ($current_route === 'node.add' && (string) $current_node_type === (string) $machine && (string) $current_job_query === (string) $job_id)
      );

      $items[] = [
        'title' => $label_text,
        'link' => $link,
        'url' => $url,
        'active' => $active,
        'status' => $status,
      ];
    }

    // Add a Preview and Submit menu item. Position it after the sections.
    // Enabled only when all configured sections are completed for this job.
    $all_completed = TRUE;
    foreach (array_keys($sections) as $s) {
      if (empty($completion[$s])) {
        $all_completed = FALSE;
        break;
      }
    }
    $preview_enabled = $all_completed;

    // Build preview URL (preserve job when available).
    $preview_url = !empty($job_id)
      ? Url::fromRoute('instemjobportal.preview_submit', ['job' => $job_id])
      : Url::fromRoute('instemjobportal.preview_submit');

    // Renderable link or plain label when disabled.
    if ($preview_enabled) {
      $preview_link = Link::fromTextAndUrl($this->t('Preview and Submit'), $preview_url)->toRenderable();
    }
    else {
      // When disabled show as plain text (non-clickable) so users know it's locked.
      $preview_link = ['#markup' => $this->t('Preview and Submit')];
    }

    $items[] = [
      'title' => $this->t('Preview and Submit'),
      'link' => $preview_link,
      'url' => $preview_url,
      'active' => ($current_route === 'instemjobportal.preview_submit'),
      'status' => ($preview_enabled ? '✅' : '🔒'),
    ];

    // Add a cache tag specific to this job and user so the block can be
    // invalidated when the user's application for this job changes.
    $cache_tags = [];
    $current_user = \Drupal::currentUser();
    if (!empty($job_id) && $current_user && $current_user->isAuthenticated()) {
      $cache_tags[] = 'instemjobportal_app:job:' . $job_id . ':user:' . $current_user->id();
    }

    $build = [
      '#theme' => 'application_sidebar_menu',
      '#items' => $items,
      '#cache' => [
        'contexts' => [
          'user',
          'route',
          'url.query_args:job',
        ],
        'tags' => $cache_tags,
      ],
    ];

    return $build;
  }

  /**
   * Control block visibility programmatically.
   *
   * Only show this block on the job application dashboard route and when a
   * valid job parameter exists.
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    // Build an AccessResult that expresses the checks; return a boolean if
    // the caller expects one (older APIs), otherwise return the object.
    $is_auth = $account->isAuthenticated();
    $route_name = \Drupal::routeMatch()->getRouteName();
    $request = \Drupal::request();

    // Job can be provided as route parameter or query arg.
    $job = \Drupal::routeMatch()->getParameter('job') ?? $request->query->get('job');

    // Allow on the dashboard when job exists (the main apply entry point).
    if ($is_auth && $route_name === 'instemjobportal.dashboard' && !empty($job)) {
      $result = AccessResult::allowed();
      return $return_as_object ? $result : $result->isAllowed();
    }

    // Allow on the gated add route or on core node.add when ?job is present.
    if ($is_auth && in_array($route_name, ['instemjobportal.add_node', 'node.add']) && !empty($job)) {
      $result = AccessResult::allowed();
      return $return_as_object ? $result : $result->isAllowed();
    }

    // Allow when editing an existing application node that references a job
    // via field_application. This ensures the sidebar remains visible during
    // edit/save flows for application submissions.
    if ($is_auth && $route_name === 'entity.node.edit_form') {
      $node = \Drupal::routeMatch()->getParameter('node');
      if ($node) {
        // If $node is an object (Node), check for field_application.
        if (is_object($node) && method_exists($node, 'hasField') && $node->hasField('field_application') && !$node->get('field_application')->isEmpty()) {
          $result = AccessResult::allowed();
          return $return_as_object ? $result : $result->isAllowed();
        }
        // If the route provided an ID, try to load the node and check.
        if (!is_object($node)) {
          try {
            $loaded = \Drupal\node\Entity\Node::load($node);
            if ($loaded && $loaded->hasField('field_application') && !$loaded->get('field_application')->isEmpty()) {
              $result = AccessResult::allowed();
              return $return_as_object ? $result : $result->isAllowed();
            }
          }
          catch (\Throwable $e) {
            // ignore and fall through to denied
          }
        }
      }
    }

    $result = AccessResult::forbidden();
    return $return_as_object ? $result : $result->isAllowed();
  }

}
