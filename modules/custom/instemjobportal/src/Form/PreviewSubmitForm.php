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
      // Remove the title from the preview fieldset.
      // '#title' => $this->t('Preview of your submission'), // <-- Remove or comment this line
    ];

    if (empty($items)) {
      $form['preview']['none'] = [
        '#markup' => $this->t('No submitted sections were found for this job.'),
      ];
    }
    // else {
    //   $rows = [];
    //   foreach ($items as $it) {
    //     $rows[] = $it['title'];
    //   }
    //   $form['preview']['list'] = [
    //     '#theme' => 'item_list',
    //     '#items' => $rows,
    //   ];
    // }

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

    // Helper to render image/file fields.
    function render_file_field($node, $field_name, $is_image = FALSE) {
      if ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) {
        $fid = $node->get($field_name)->target_id;
        $file = \Drupal\file\Entity\File::load($fid);
        if ($file) {
          // Use the file_url_generator service for Drupal 10/11
          $url = \Drupal::service('file_url_generator')->generateAbsoluteString($file->getFileUri());
          if ($is_image) {
            return '<img src="' . $url . '" style="max-width:120px;max-height:120px;border-radius:8px;border:1px solid #ccc;" />';
          }
          else {
            return '<a href="' . $url . '" target="_blank">Download</a>';
          }
        }
      }
      return '';
    }

    // Helper to render string fields.
    function render_field($node, $field_name) {
      return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->value : '';
    }

    // Helper to render long text fields.
    function render_long_field($node, $field_name) {
      return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->value : '';
    }

    // Helper to render list fields.
    function render_list_field($node, $field_name) {
      return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->getString() : '';
    }

    // Personal Information
    $personal_node = NULL;
    $personal_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'personal_information')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($personal_nids)) {
      $personal_node = \Drupal\node\Entity\Node::load(reset($personal_nids));
    }

    if ($personal_node) {
      $form['preview']['personal_information'] = [
        '#type' => 'details',
        '#title' => $this->t('Personal Information'),
        '#open' => TRUE,
        '#markup' => '
          <div class="row mb-3">
            <div class="col-md-3 text-center">' . render_file_field($personal_node, 'field_photo', TRUE) . '</div>
            <div class="col-md-3 text-center">' . render_file_field($personal_node, 'field_signature', TRUE) . '</div>
          </div>
          <table class="table table-bordered table-striped">
            <tbody>
              <tr><th>Full Name</th><td>' . render_field($personal_node, 'field_full_name') . '</td></tr>
              <tr><th>Father/Mother/Spouse Name</th><td>' . render_field($personal_node, 'field_father_mother_spouse_name') . '</td></tr>
              <tr><th>Email</th><td>' . render_field($personal_node, 'field_email') . '</td></tr>
              <tr><th>Date of Birth</th><td>' . render_field($personal_node, 'field_date_of_birth') . '</td></tr>
              <tr><th>Age</th><td>' . render_field($personal_node, 'field_age') . '</td></tr>
              <tr><th>Gender</th><td>' . render_list_field($personal_node, 'field_gender') . '</td></tr>
              <tr><th>Category</th><td>' . render_list_field($personal_node, 'field_category') . '</td></tr>
              <tr><th>PWD Category</th><td>' . render_list_field($personal_node, 'field_pwd_category') . '</td></tr>
              <tr><th>Category Certificate</th><td>' . render_file_field($personal_node, 'field_category_certificate') . '</td></tr>
              <tr><th>Mobile Number</th><td>' . render_field($personal_node, 'field_mobile_number') . '</td></tr>
              <tr><th>Marital Status</th><td>' . render_list_field($personal_node, 'field_marital_status') . '</td></tr>
              <tr><th>Nationality</th><td>' . render_field($personal_node, 'field_nationality') . '</td></tr>
              <tr><th>Alternate Phone</th><td>' . render_field($personal_node, 'field_alternate_phone') . '</td></tr>
              <tr><th>Permanent Address</th><td>' . render_field($personal_node, 'field_permanent_address') . '</td></tr>
              <tr><th>Correspondence Address</th><td>' . render_field($personal_node, 'field_correspondence_address') . '</td></tr>
              <tr><th>Departmental Candidate</th><td>' . render_list_field($personal_node, 'field_departmental_candidate') . '</td></tr>
              <tr><th>Experience Level</th><td>' . render_field($personal_node, 'field_experience_level') . '</td></tr>
            </tbody>
          </table>
        ',
      ];
    }

    // Education
    $education_node = NULL;
    $education_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'education')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($education_nids)) {
      $education_node = \Drupal\node\Entity\Node::load(reset($education_nids));
    }

    if ($education_node) {
      $form['preview']['education'] = [
        '#type' => 'details',
        '#title' => $this->t('Education'),
        '#open' => TRUE,
        '#markup' => '
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Qualification</th>
                <th>Specialization</th>
                <th>University</th>
                <th>Country</th>
                <th>GPA</th>
                <th>Marks (%)</th>
                <th>Year of Passing</th>
                <th>Certificate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>' . render_field($education_node, 'field_10th_qualification_name') . '</td>
                <td>' . render_field($education_node, 'field_10th_specialization') . '</td>
                <td>' . render_field($education_node, 'field_10th_university') . '</td>
                <td>' . render_field($education_node, 'field_10th_country') . '</td>
                <td>' . render_field($education_node, 'field_10th_gpa') . '</td>
                <td>' . render_field($education_node, 'field_10th_marks_percentage') . '</td>
                <td>' . render_field($education_node, 'field_10th_year_of_passing') . '</td>
                <td>' . render_file_field($education_node, 'field_10th_certificate') . '</td>
              </tr>
              <tr>
                <td>' . render_field($education_node, 'field_12th_qualification_name') . '</td>
                <td>' . render_field($education_node, 'field_12th_specialization') . '</td>
                <td>' . render_field($education_node, 'field_12th_university') . '</td>
                <td>' . render_field($education_node, 'field_12th_country') . '</td>
                <td>' . render_field($education_node, 'field_12th_gpa') . '</td>
                <td>' . render_field($education_node, 'field_12th_marks_percentage') . '</td>
                <td>' . render_field($education_node, 'field_12th_year_of_passing') . '</td>
                <td>' . render_file_field($education_node, 'field_12th_certificate') . '</td>
              </tr>
              <tr>
                <td>' . render_field($education_node, 'field_grad_qual_name') . '</td>
                <td>' . render_field($education_node, 'field_grad_spec') . '</td>
                <td>' . render_field($education_node, 'field_grad_univ') . '</td>
                <td>' . render_field($education_node, 'field_grad_country') . '</td>
                <td>' . render_field($education_node, 'field_grad_gpa') . '</td>
                <td>' . render_field($education_node, 'field_grad_marks') . '</td>
                <td>' . render_field($education_node, 'field_grad_year') . '</td>
                <td>' . render_file_field($education_node, 'field_grad_cert') . '</td>
              </tr>
              <tr>
                <td>' . render_field($education_node, 'field_pg_qual_name') . '</td>
                <td>' . render_field($education_node, 'field_pg_spec') . '</td>
                <td>' . render_field($education_node, 'field_pg_univ') . '</td>
                <td>' . render_field($education_node, 'field_pg_country') . '</td>
                <td>' . render_field($education_node, 'field_pg_gpa') . '</td>
                <td>' . render_field($education_node, 'field_pg_marks') . '</td>
                <td>' . render_field($education_node, 'field_pg_year') . '</td>
                <td>' . render_file_field($education_node, 'field_pg_cert') . '</td>
              </tr>
              <tr>
                <td>' . render_field($education_node, 'field_phd_qual_name') . '</td>
                <td>' . render_field($education_node, 'field_phd_spec') . '</td>
                <td>' . render_field($education_node, 'field_phd_univ') . '</td>
                <td>' . render_field($education_node, 'field_phd_country') . '</td>
                <td>' . render_field($education_node, 'field_phd_gpa') . '</td>
                <td>' . render_field($education_node, 'field_phd_marks') . '</td>
                <td>' . render_field($education_node, 'field_phd_year') . '</td>
                <td>' . render_file_field($education_node, 'field_phd_cert') . '</td>
              </tr>
            </tbody>
          </table>
        ',
      ];
    }

    // Employment Details (Paragraphs)
    $employment_node = NULL;
    $employment_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'employment_details')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($employment_nids)) {
      $employment_node = \Drupal\node\Entity\Node::load(reset($employment_nids));
    }

    if ($employment_node && $employment_node->hasField('field_employment_details')) {
      $paragraphs = $employment_node->get('field_employment_details')->referencedEntities();
      $rows = [];
      $slno = 1;
      foreach ($paragraphs as $para) {
        $employment_type = $para->get('field_employment_type')->getString();
        $other_employment_type = ($employment_type === 'other') ? ($para->get('field_other_employment_type')->value ?? '') : '';
        $type_of_work = $para->get('field_type_of_work')->getString();
        $other_type_of_work = ($type_of_work === 'other') ? ($para->get('field_other_type_of_work')->value ?? '') : '';
        $rows[] = [
          $slno++,
          $para->get('field_designation')->value ?? '',
          $para->get('field_employer')->value ?? '',
          $para->get('field_from_date')->value ?? '',
          $para->get('field_to_date')->value ?? '',
          $employment_type,
          $other_employment_type,
          $type_of_work,
          $other_type_of_work,
          $para->get('field_pay_band')->value ?? '',
          $para->get('field_nature_of_job')->value ?? '',
          $para->get('field_experience_calculated')->value ?? '',
        ];
      }
      $header = [
        'S.No', 'Designation', 'Employer', 'From', 'To',
        'Employment Type', 'Other Employment Type',
        'Type of Work', 'Other Type of Work',
        'Pay Band', 'Nature of Job', 'Experience'
      ];
      $form['preview']['employment_details'] = [
        '#type' => 'details',
        '#title' => $this->t('Employment Details'),
        '#open' => TRUE,
        'table' => [
          '#theme' => 'table',
          '#header' => $header,
          '#rows' => $rows,
          '#attributes' => ['class' => ['table', 'table-bordered', 'table-striped']],
        ],
      ];
    }

    // Referee
    $referee_node = NULL;
    $referee_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'referee')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($referee_nids)) {
      $referee_node = \Drupal\node\Entity\Node::load(reset($referee_nids));
    }

    if ($referee_node) {
      $form['preview']['referee'] = [
        '#type' => 'details',
        '#title' => $this->t('Referee'),
        '#open' => TRUE,
        '#markup' => '
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th><th>Designation</th><th>Email</th><th>Phone</th><th>Address</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>' . render_field($referee_node, 'field_referee1_name') . '</td>
                <td>' . render_field($referee_node, 'field_referee1_designation') . '</td>
                <td>' . render_field($referee_node, 'field_referee1_email') . '</td>
                <td>' . render_field($referee_node, 'field_referee1_phone') . '</td>
                <td>' . render_long_field($referee_node, 'field_referee1_address') . '</td>
              </tr>
              <tr>
                <td>' . render_field($referee_node, 'field_referee2_name') . '</td>
                <td>' . render_field($referee_node, 'field_referee2_designation') . '</td>
                <td>' . render_field($referee_node, 'field_referee2_email') . '</td>
                <td>' . render_field($referee_node, 'field_referee2_phone') . '</td>
                <td>' . render_long_field($referee_node, 'field_referee2_address') . '</td>
              </tr>
            </tbody>
          </table>
        ',
      ];
    }

    // Additional Information
    $addinfo_node = NULL;
    $addinfo_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'additional_information')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($addinfo_nids)) {
      $addinfo_node = \Drupal\node\Entity\Node::load(reset($addinfo_nids));
    }

    if ($addinfo_node) {
      $form['preview']['additional_information'] = [
        '#type' => 'details',
        '#title' => $this->t('Additional Information'),
        '#open' => TRUE,
        '#markup' => '
          <table class="table table-bordered table-striped">
            <tbody>
              <tr><th>Malpractice</th><td>' . render_list_field($addinfo_node, 'field_admin_malpractice') . '</td></tr>
              <tr><th>Malpractice Details</th><td>' . render_long_field($addinfo_node, 'field_admin_malpractice_details') . '</td></tr>
              <tr><th>Debarred Unfair Means</th><td>' . render_list_field($addinfo_node, 'field_debarred_unfair_means') . '</td></tr>
              <tr><th>Debarred Details</th><td>' . render_long_field($addinfo_node, 'field_debarred_details') . '</td></tr>
              <tr><th>Discharged Employment</th><td>' . render_list_field($addinfo_node, 'field_discharged_employment') . '</td></tr>
              <tr><th>Discharged Employment Details</th><td>' . render_long_field($addinfo_node, 'field_discharged_employment_d') . '</td></tr>
              <tr><th>Disciplinary Proceedings</th><td>' . render_list_field($addinfo_node, 'field_disciplinary_proceedings') . '</td></tr>
              <tr><th>Disciplinary Proceedings Details</th><td>' . render_long_field($addinfo_node, 'field_disciplinary_proceedings_d') . '</td></tr>
              <tr><th>Financial Irregularity</th><td>' . render_list_field($addinfo_node, 'field_financial_irregularity') . '</td></tr>
              <tr><th>Financial Irregularity Details</th><td>' . render_long_field($addinfo_node, 'field_financial_irregularity_d') . '</td></tr>
              <tr><th>Joining Time (days)</th><td>' . render_field($addinfo_node, 'field_joining_time_days') . '</td></tr>
              <tr><th>Significant Contributions</th><td>' . render_long_field($addinfo_node, 'field_significant_contributions') . '</td></tr>
              <tr><th>Suitability</th><td>' . render_long_field($addinfo_node, 'field_suitability') . '</td></tr>
            </tbody>
          </table>
        ',
      ];
    }

    // File Upload
    $file_node = NULL;
    $file_nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE)
      ->condition('type', 'file_upload')
      ->condition('uid', $uid)
      ->condition('field_application.target_id', $job)
      ->range(0, 1)
      ->execute();
    if (!empty($file_nids)) {
      $file_node = \Drupal\node\Entity\Node::load(reset($file_nids));
    }

    if ($file_node) {
      $form['preview']['file_upload'] = [
        '#type' => 'details',
        '#title' => $this->t('File Uploads'),
        '#open' => TRUE,
        '#markup' => '
          <table class="table table-bordered table-striped">
            <tbody>
              <tr><th>Resume</th><td>' . render_file_field($file_node, 'field_resume') . '</td></tr>
              <tr><th>PAN/Passport/DL/Voter</th><td>' . render_file_field($file_node, 'field_pan_passport_dl_voter') . '</td></tr>
              <tr><th>Experience Certificates</th><td>' . render_file_field($file_node, 'field_experience_certificates') . '</td></tr>
              <tr><th>Transaction Details</th><td>' . render_long_field($file_node, 'field_transaction_details') . '</td></tr>
              <tr><th>NOC Option</th><td>' . render_list_field($file_node, 'field_noc_option') . '</td></tr>
              <tr><th>NOC File</th><td>' . render_file_field($file_node, 'field_noc_file') . '</td></tr>
              <tr><th>Reservation Certificate</th><td>' . render_file_field($file_node, 'field_reservation_certificate') . '</td></tr>
            </tbody>
          </table>
        ',
      ];
    }

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

        // Add personal information node to field_applicants of the job node.
        if ($job && $personal_nid) {
          $job_node = \Drupal\node\Entity\Node::load($job);
          if ($job_node && $job_node->hasField('field_applicants')) {
            $applicants = $job_node->get('field_applicants')->getValue();
            // Prevent duplicates.
            $existing_ids = array_column($applicants, 'target_id');
            if (!in_array($personal_nid, $existing_ids)) {
              $applicants[] = ['target_id' => $personal_nid];
              $job_node->set('field_applicants', $applicants);
              $job_node->save();
            }
          }
        }

        // Invalidate per-job-per-user cache tag so sidebar updates.
        if ($job && $current_user && $current_user->isAuthenticated()) {
          \Drupal::service('cache_tags.invalidator')->invalidateTags(['instemjobportal_app:job:' . $job . ':user:' . $current_user->id()]);
        }
      }
    }

    // After submit, redirect to dashboard for the job.
    $form_state->setRedirect('<front>');
    \Drupal::messenger()->addStatus($this->t('Your application has been submitted successfully.'));
  }

}
