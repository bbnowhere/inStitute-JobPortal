<?php

namespace Drupal\instemjobportal\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a User Registration Sidebar block.
 *
 * @Block(
 *   id = "user_registration_sidebar_block",
 *   admin_label = @Translation("User Registration Sidebar")
 * )
 */
class UserRegistrationSidebarBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_user = \Drupal::currentUser();
    $is_front = \Drupal::service('path.matcher')->isFrontPage();

    // Only show if user is not logged in and is on the front page.
    if ($current_user->isAuthenticated() || !$is_front) {
      return [];
    }

    $base = '/jobportal';

    return [
      '#markup' => '
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white"></div>
          <div class="card-body">
            <p class="mb-3">' . $this->t('Please login or register to apply for jobs.') . '</p>
            <div class="d-grid gap-2">
              <a href="' . $base . '/user/login?destination=' . urlencode($base . '/') . '" class="btn btn-outline-primary btn-lg">' . $this->t('Login') . '</a>
              <a href="' . $base . '/user/register?destination=' . urlencode($base . '/') . '" class="btn btn-primary btn-lg">' . $this->t('Register') . '</a>
            </div>
          </div>
        </div>
      ',
      '#allowed_tags' => ['div', 'h5', 'p', 'a', 'span'],
    ];
  }

}