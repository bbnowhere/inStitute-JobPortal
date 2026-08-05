<?php

namespace Drupal\instemjobportal\Service;

use Drupal\Core\Mail\MailManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Url;
use Drupal\user\UserInterface;

/**
 * Service for handling custom email functionality.
 */
class EmailService {
  use StringTranslationTrait;

  /**
   * The mail manager.
   *
   * @var \Drupal\Core\Mail\MailManagerInterface
   */
  protected $mailManager;

  /**
   * Constructs a new EmailService object.
   *
   * @param \Drupal\Core\Mail\MailManagerInterface $mail_manager
   *   The mail manager.
   */
  public function __construct(MailManagerInterface $mail_manager) {
    $this->mailManager = $mail_manager;
  }

  /**
   * Builds registration mail subject/body using the Twig template.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user object.
   * @param string $one_time_login_url
   *   The one-time login URL.
   *
   * @return array
   *   Mail data with subject and message HTML.
   */
  public function buildRegistrationEmail(UserInterface $user, string $one_time_login_url): array {
    $site_config = \Drupal::config('system.site');
    $site_name = $site_config->get('name');
    $login_url = Url::fromRoute('user.login')->setAbsolute()->toString();

    // Prepare user data for template
    $user_data = [
      'name' => $user->getAccountName(),
      'email' => $user->getEmail(),
      'id' => $user->id(),
    ];

    $params = [
      'user' => $user_data,
      'site_name' => $site_name,
      'one_time_login_url' => $one_time_login_url,
      'login_url' => $login_url,
    ];

    $template = [
      '#theme' => 'registration_email',
      '#user' => $user_data,
      '#site_name' => $site_name,
      '#one_time_login_url' => $one_time_login_url,
      '#login_url' => $login_url,
    ];

    $langcode = $user->getPreferredLangcode();
    $to = $user->getEmail();
    $subject = $this->t('Account details for @username at @site', [
      '@username' => $user->getAccountName(),
      '@site' => $site_name,
    ]);

    return [
      'subject' => (string) $subject,
      'message' => (string) \Drupal::service('renderer')->render($template),
      'to' => $to,
      'langcode' => $langcode,
      'params' => $params,
    ];
  }

  /**
   * Sends a registration email to a new user.
   *
   * @param \Drupal\user\UserInterface $user
   *   The user object.
   * @param string $one_time_login_url
   *   The one-time login URL.
   */
  public function sendRegistrationEmail(UserInterface $user, string $one_time_login_url): void {
    $mail_data = $this->buildRegistrationEmail($user, $one_time_login_url);
    $params = $mail_data['params'];
    $params['subject'] = $mail_data['subject'];
    $params['message'] = $mail_data['message'];

    $this->mailManager->mail(
      'instemjobportal',
      'register',
      $mail_data['to'],
      $mail_data['langcode'],
      $params,
      NULL,
      TRUE
    );
  }
}
