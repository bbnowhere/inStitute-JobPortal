<?php

namespace Drupal\instemjobportal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Form for previewing and submitting an application.
 */
class PreviewSubmitForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'instemjobportal_preview_submit_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $job = \Drupal::routeMatch()->getParameter('job') ?? \Drupal::request()->query->get('job');
    if (is_object($job) && method_exists($job, 'id')) {
      $job = $job->id();
    }

    $current_user = \Drupal::currentUser();
    $uid = $current_user->id();

    // Sections to include in the preview. Keep in sync with the sidebar.
    $sections = [
      'personal_information',
      'education',
      'employment_details',
      'referee',
      'additional_information',
      'file_upload',
    ];

    $items = [];
    foreach ($sections as $bundle) {
      $nids = \Drupal::entityQuery('node')
        ->accessCheck(FALSE)
        ->condition('type', $bundle)
        ->condition('uid', $uid)
        ->condition('field_application.target_id', $job)
        ->range(0, 1)
        ->execute();
      if (!empty($nids)) {
        $nid = reset($nids);
        $node = \Drupal\node\Entity\Node::load($nid);
        if ($node) {
          $items[] = [
            'bundle' => $bundle,
            'nid' => $nid,
            'title' => $node->label(),
          ];
        }
      }
    }

    // Determine if already submitted by checking personal_information field_job_status.
    $already_submitted = FALSE;
    foreach ($items as $it) {
      if ($it['bundle'] === 'personal_information') {
        $pnode = \Drupal\node\Entity\Node::load($it['nid']);
        if ($pnode && $pnode->hasField('field_job_status') && !$pnode->get('field_job_status')->isEmpty()) {
          $status = (string) $pnode->get('field_job_status')->value;
          if (strtolower($status) === 'completed') {
            $already_submitted = TRUE;
          }
        }
      }
    }

    $form['#cache']['contexts'] = ['user', 'url.query_args:job'];

    $form['preview'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Preview of your submission'),
    ];

    if (empty($items)) {
      $form['preview']['none'] = [
        '#markup' => $this->t('No submitted sections were found for this job.'),
      ];
    }
    else {
      $rows = [];
      foreach ($items as $it) {
        $rows[] = $it['title'];
      }
      $form['preview']['list'] = [
        '#theme' => 'item_list',
        '#items' => $rows,
      ];
    }

    // Show submit button unless already submitted or nothing to submit.
    if ($already_submitted) {
      $form['status'] = [
        '#markup' => $this->t('<strong>Your application has already been submitted.</strong>'),
      ];
    }
    else {
      $form['actions'] = [
        '#type' => 'actions',
      ];
      $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit Application'),
        '#button_type' => 'primary',
        '#attributes' => ['class' => ['preview-submit-button']],
      ];
    }

    // Pass node ids to submit handler for reference.
    $form['nids'] = [
      '#type' => 'value',
      '#value' => array_column($items, 'nid'),
    ];
    $form['job'] = [
      '#type' => 'value',
      '#value' => $job,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nids = $form_state->getValue('nids') ?: [];
    $job = $form_state->getValue('job');
    $current_user = \Drupal::currentUser();

    // Use the personal_information node if it exists as the canonical applicant
    // node to update fields on. Fall back to the first available node.
    $personal_nid = NULL;
    foreach ($nids as $nid) {
      $node = \Drupal\node\Entity\Node::load($nid);
      if ($node && $node->getType() === 'personal_information') {
        $personal_nid = $nid;
        break;
      }
    }
    if (!$personal_nid && !empty($nids)) {
      $personal_nid = reset($nids);
    }

    if ($personal_nid) {
      $pnode = \Drupal\node\Entity\Node::load($personal_nid);
      if ($pnode) {
        // Set the advertisement reference if the field exists.
        if ($pnode->hasField('field_advertisement_number')) {
          $pnode->set('field_advertisement_number', ['target_id' => $job]);
        }
        // Mark job status completed when possible.
        if ($pnode->hasField('field_job_status')) {
          $pnode->set('field_job_status', 'Completed');
        }
        $pnode->save();

        // Invalidate per-job-per-user cache tag so sidebar updates.
        if ($job && $current_user && $current_user->isAuthenticated()) {
          \Drupal::service('cache_tags.invalidator')->invalidateTags(['instemjobportal_app:job:' . $job . ':user:' . $current_user->id()]);
        }
      }
    }

    // After submit, redirect to dashboard for the job.
    $url = Url::fromRoute('instemjobportal.dashboard', ['job' => $job]);
    $form_state->setRedirectUrl($url);
    \Drupal::messenger()->addStatus($this->t('Your application has been submitted.'));
  }

}
