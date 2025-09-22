<?php

namespace Drupal\instemjobportal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;

class ApplicationPreviewController extends ControllerBase {

  public function preview(Node $node) {
    // Optionally, check if the node is of type 'personal_information'
    if ($node->bundle() !== 'personal_information') {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
    // Optionally, check if the current user is the owner
    if ($node->getOwnerId() != $this->currentUser()->id() && !$this->currentUser()->hasPermission('administer nodes')) {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
    // Render in 'submitted' view mode
    $build = \Drupal::entityTypeManager()
      ->getViewBuilder('node')
      ->view($node, 'submitted');
    return $build;
  }
}