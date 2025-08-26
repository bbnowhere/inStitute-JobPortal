<?php

namespace Drupal\instemjobportal\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;

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
    $job_id = !empty($config['job']) ? $config['job'] : \Drupal::routeMatch()->getParameter('job');
    $sections = !empty($config['sections']) ? $config['sections'] : [
      'personal_information' => $this->t('Personal Information'),
      'education' => $this->t('Education'),
      'employment_details' => $this->t('Employment Details'),
      'referee' => $this->t('Referee'),
      'additional_information' => $this->t('Additional Information'),
      'file_upload' => $this->t('File Upload'),
    ];
    $completion = !empty($config['completion']) ? $config['completion'] : [];

    $current_route = \Drupal::routeMatch()->getRouteName();
    $current_node_type = \Drupal::routeMatch()->getParameter('node_type');
    $current_job_query = \Drupal::request()->query->get('job');

    $items = [];
    foreach ($sections as $machine => $label) {
      // Gate route in this module that validates role/permission then redirects to node.add.
      $url = Url::fromRoute('instemjobportal.add_node', [
        'job' => $job_id,
        'node_type' => $machine,
      ]);

      // Create a renderable link so Twig can render it directly.
      $link = Link::fromTextAndUrl($label, $url)->toRenderable();

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
        'title' => $label,
        'link' => $link,
        'url' => $url,
        'active' => $active,
        'status' => $status,
      ];
    }

    return [
      '#theme' => 'application_sidebar_menu',
      '#items' => $items,
    ];
  }

}
