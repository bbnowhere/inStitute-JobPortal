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
   * Helper to render image/file fields.
   */
  private function renderFileField($node, $field_name, $is_image = FALSE) {
    if ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) {
      return 'Uploaded';
    }
    return '-';
  }

  /**
   * Helper to render string fields.
   */
  private function renderField($node, $field_name) {
    return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->value : '';
  }

  /**
   * Helper to render string fields with uppercase.
   */
  private function renderUpperField($node, $field_name) {
    $value = ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->value : '';
    return strtoupper($value);
  }

  /**
   * Helper to render long text fields.
   */
  private function renderLongField($node, $field_name) {
    return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->value : '';
  }

  /**
   * Helper to render list fields.
   */
  private function renderListField($node, $field_name) {
    return ($node->hasField($field_name) && !$node->get($field_name)->isEmpty()) ? $node->get($field_name)->getString() : '';
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

    // Check if the application deadline has passed.
    $deadline_passed = FALSE;
    if ($job) {
      $job_node = \Drupal\node\Entity\Node::load($job);
      if ($job_node && $job_node->hasField('field_last_date') && !$job_node->get('field_last_date')->isEmpty()) {
        $last_date = $job_node->get('field_last_date')->value;
        $current_time = new \DateTime();
        $last_date_time = new \DateTime($last_date);
        if ($current_time > $last_date_time) {
          $deadline_passed = TRUE;
        }
      }
    }

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
    elseif ($deadline_passed) {
      $form['status'] = [
        '#markup' => $this->t('<strong>The application submission deadline has passed. You can no longer submit this application.</strong>'),
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

    $photo_base64 = '';
    $signature_base64 = '';
    if ($personal_node) {
      if ($personal_node->hasField('field_photo') && !$personal_node->get('field_photo')->isEmpty()) {
        $fid = $personal_node->get('field_photo')->target_id;
        $file = \Drupal\file\Entity\File::load($fid);
        if ($file) {
          $data = file_get_contents($file->getFileUri());
          $photo_base64 = 'data:image/' . pathinfo($file->getFilename(), PATHINFO_EXTENSION) . ';base64,' . base64_encode($data);
        }
      }
      if ($personal_node->hasField('field_signature') && !$personal_node->get('field_signature')->isEmpty()) {
        $fid = $personal_node->get('field_signature')->target_id;
        $file = \Drupal\file\Entity\File::load($fid);
        if ($file) {
          $data = file_get_contents($file->getFileUri());
          $signature_base64 = 'data:image/' . pathinfo($file->getFilename(), PATHINFO_EXTENSION) . ';base64,' . base64_encode($data);
        }
      }
    }


        /* <div class="row mb-3">
            <div class="col-md-3 text-center">' . ($photo_base64 ? '<img src="' . $photo_base64 . '" style="max-width:120px;max-height:120px;border-radius:8px;border:1px solid #ccc;" />' : '-') . '</div>
            <div class="col-md-3 text-center">' . ($signature_base64 ? '<img src="' . $signature_base64 . '" style="max-width:120px;max-height:120px;border-radius:8px;border:1px solid #ccc;" />' : '-') . '</div>
          </div> */

    if ($personal_node) {
      $form['preview']['personal_information'] = [
        '#type' => 'details',
        '#title' => $this->t('Personal Information'),
        '#open' => TRUE,
        '#markup' => '
     
          <table class="table table-bordered table-striped">
            <tbody>
              <tr><th>Full Name</th><td>' . $this->renderUpperField($personal_node, 'field_full_name') . '</td></tr>
              <tr><th>Father/Mother/Spouse Name</th><td>' . $this->renderUpperField($personal_node, 'field_father_mother_spouse_name') . '</td></tr>
              <tr><th>Email</th><td>' . $this->renderField($personal_node, 'field_email') . '</td></tr>
              <tr><th>Date of Birth</th><td>' . $this->renderField($personal_node, 'field_date_of_birth') . '</td></tr>
              <tr><th>Age</th><td>' . $this->renderField($personal_node, 'field_age') . '</td></tr>
              <tr><th>Gender</th><td>' . strtoupper($this->renderListField($personal_node, 'field_gender')) . '</td></tr>
              <tr><th>Category</th><td>' . $this->renderUpperField($personal_node, 'field_category') . '</td></tr>
              <tr><th>PWD Category</th><td>' . $this->renderUpperField($personal_node, 'field_pwd_category') . '</td></tr>
              <tr><th>Category Certificate</th><td>' . $this->renderFileField($personal_node, 'field_category_certificate') . '</td></tr>
              <tr><th>Mobile Number</th><td>' . $this->renderField($personal_node, 'field_mobile_number') . '</td></tr>
              <tr><th>Marital Status</th><td>' . $this->renderUpperField($personal_node, 'field_marital_status') . '</td></tr>
              <tr><th>Nationality</th><td>' . $this->renderUpperField($personal_node, 'field_nationality') . '</td></tr>
              <tr><th>Alternate Phone</th><td>' . $this->renderField($personal_node, 'field_alternate_phone') . '</td></tr>
              <tr><th>Permanent Address</th><td>' . $this->renderField($personal_node, 'field_permanent_address') . '</td></tr>
              <tr><th>Correspondence Address</th><td>' . $this->renderField($personal_node, 'field_correspondence_address') . '</td></tr>
              <tr><th>Departmental Candidate</th><td>' . ucwords(strtolower($this->renderListField($personal_node, 'field_departmental_candidate'))) . '</td></tr>
              <tr><th>Brief particulars about departmental candidates i.e. who are all entitled to get the benefits of departmental candidate.</th><td>' . ($this->renderLongField($personal_node, 'field_brief_particulars_about_de') ?: '-') . '</td></tr>
              <tr><th>Experience Level</th><td>' . $this->renderUpperField($personal_node, 'field_experience_level') . '</td></tr>
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
                <th>CGPA/GPA</th>
                <th>Marks (%)</th>
                <th>Month/Year</th>
                <th>Certificate</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_10th_qualification_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_10th_specialization') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_10th_university') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_10th_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_10th_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_10th_marks_percentage') . '</td>
                <td>' . $this->renderField($education_node, 'field_10th_year_of_passing') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_10th_certificate') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_12th_qualification_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_12th_specialization') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_12th_university') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_12th_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_12th_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_12th_marks_percentage') . '</td>
                <td>' . $this->renderField($education_node, 'field_12th_year_of_passing') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_12th_certificate') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_grad_qual_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_grad_spec') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_grad_univ') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_grad_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_grad_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_grad_marks') . '</td>
                <td>' . $this->renderField($education_node, 'field_grad_year') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_grad_cert') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_pg_qual_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_pg_spec') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_pg_univ') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_pg_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_pg_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_pg_marks') . '</td>
                <td>' . $this->renderField($education_node, 'field_pg_year') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_pg_cert') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_phd_qual_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_phd_spec') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_phd_univ') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_phd_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_phd_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_phd_marks') . '</td>
                <td>' . $this->renderField($education_node, 'field_phd_year') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_phd_cert') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderUpperField($education_node, 'field_other_qualification_name') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_other_spec') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_other_uni') . '</td>
                <td>' . $this->renderUpperField($education_node, 'field_other_country') . '</td>
                <td>' . $this->renderField($education_node, 'field_other_cgpa_gpa') . '</td>
                <td>' . $this->renderField($education_node, 'field_other_marks') . '</td>
                <td>' . $this->renderField($education_node, 'field_other_year_of_passing') . '</td>
                <td>' . $this->renderFileField($education_node, 'field_other_certificate_upload') . '</td>
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
          ($para->get('field_designation')->value ?? ''),
          strtoupper($para->get('field_employer')->value ?? ''),
          strtoupper($para->get('field_job_address')->value ?? ''),
          $para->get('field_from_date')->value ?? '',
          $para->get('field_to_date')->value ?? '',
          strtoupper($employment_type),
          strtoupper($other_employment_type),
          strtoupper($type_of_work),
          strtoupper($other_type_of_work),
          $para->get('field_pay_band')->value ?? '',
          strtoupper($para->get('field_nature_of_job')->value ?? ''),
          $para->get('field_experience_calculated')->value ?? '',
        ];
      }
      $header = [
        'S.No', 'Designation', 'Employer', 'Address', 'From', 'To',
        'Employment Type', 'Other Employment Type',
        'Type of Work', 'Other Type of Work',
        ' Pay Level', 'Nature of Job', 'Experience'
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
                <td>' . $this->renderField($referee_node, 'field_referee1_name') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee1_designation') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee1_email') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee1_phone') . '</td>
                <td>' . $this->renderLongField($referee_node, 'field_referee1_address') . '</td>
              </tr>
              <tr>
                <td>' . $this->renderField($referee_node, 'field_referee2_name') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee2_designation') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee2_email') . '</td>
                <td>' . $this->renderField($referee_node, 'field_referee2_phone') . '</td>
                <td>' . $this->renderLongField($referee_node, 'field_referee2_address') . '</td>
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
              <tr><th>Malpractice</th><td>' . ucwords(strtolower($this->renderListField($addinfo_node, 'field_admin_malpractice'))) . '</td></tr>
              <tr><th>Malpractice Details</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_admin_malpractice_details'))) . '</td></tr>
              <tr><th>Debarred Unfair Means</th><td>' . ucwords(strtolower($this->renderListField($addinfo_node, 'field_debarred_unfair_means'))) . '</td></tr>
              <tr><th>Debarred Details</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_debarred_details'))) . '</td></tr>
              <tr><th>Discharged Employment</th><td>' . ucwords(strtolower($this->renderListField($addinfo_node, 'field_discharged_employment'))) . '</td></tr>
              <tr><th>Discharged Employment Details</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_discharged_employment_d'))) . '</td></tr>
              <tr><th>Disciplinary Proceedings</th><td>' . ucwords(strtolower($this->renderListField($addinfo_node, 'field_disciplinary_proceedings'))) . '</td></tr>
              <tr><th>Disciplinary Proceedings Details</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_disciplinary_proceedings_d'))) . '</td></tr>
              <tr><th>Financial Irregularity</th><td>' . ucwords(strtolower($this->renderListField($addinfo_node, 'field_financial_irregularity'))) . '</td></tr>
              <tr><th>Financial Irregularity Details</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_financial_irregularity_d'))) . '</td></tr>
              <tr><th>Joining Time (days)</th><td>' . $this->renderField($addinfo_node, 'field_joining_time_days') . '</td></tr>
              <tr><th>Significant Contributions</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_significant_contributions'))) . '</td></tr>
              <tr><th>Suitability</th><td>' . ucfirst(strtolower($this->renderLongField($addinfo_node, 'field_suitability'))) . '</td></tr>
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
      // Also load education node for certificates
      $education_nids = \Drupal::entityQuery('node')
        ->accessCheck(FALSE)
        ->condition('type', 'education')
        ->condition('uid', $uid)
        ->condition('field_application.target_id', $job)
        ->range(0, 1)
        ->execute();
      $education_node = !empty($education_nids) ? \Drupal\node\Entity\Node::load(reset($education_nids)) : NULL;

      $markup = '<table class="table table-bordered table-striped"><tbody>';

      // Education certificates first
      if ($education_node) {
        if ($education_node->hasField('field_10th_certificate') && !$education_node->get('field_10th_certificate')->isEmpty()) {
          $markup .= '<tr><th>10th Document</th><td>' . $this->renderFileField($education_node, 'field_10th_certificate') . '</td></tr>';
        }
        if ($education_node->hasField('field_12th_certificate') && !$education_node->get('field_12th_certificate')->isEmpty()) {
          $markup .= '<tr><th>12th Document</th><td>' . $this->renderFileField($education_node, 'field_12th_certificate') . '</td></tr>';
        }
        if ($education_node->hasField('field_grad_cert') && !$education_node->get('field_grad_cert')->isEmpty()) {
          $markup .= '<tr><th>Graduation Document</th><td>' . $this->renderFileField($education_node, 'field_grad_cert') . '</td></tr>';
        }
        if ($education_node->hasField('field_pg_cert') && !$education_node->get('field_pg_cert')->isEmpty()) {
          $markup .= '<tr><th>Post Graduation Document</th><td>' . $this->renderFileField($education_node, 'field_pg_cert') . '</td></tr>';
        }
        if ($education_node->hasField('field_phd_cert') && !$education_node->get('field_phd_cert')->isEmpty()) {
          $markup .= '<tr><th>PhD Document</th><td>' . $this->renderFileField($education_node, 'field_phd_cert') . '</td></tr>';
        }
        if ($education_node->hasField('field_other_certificate_upload') && !$education_node->get('field_other_certificate_upload')->isEmpty()) {
          $markup .= '<tr><th>Other Document</th><td>' . $this->renderFileField($education_node, 'field_other_certificate_upload') . '</td></tr>';
        }
      }

      // Then other files
      $markup .= '<tr><th>Resume</th><td>' . $this->renderFileField($file_node, 'field_resume') . '</td></tr>';
      $markup .= '<tr><th>PAN/Passport/DL/Voter</th><td>' . $this->renderFileField($file_node, 'field_pan_passport_dl_voter') . '</td></tr>';
      $markup .= '<tr><th>Experience Certificates</th><td>' . $this->renderFileField($file_node, 'field_experience_certificates') . '</td></tr>';
      $markup .= '<tr><th>Transaction Details</th><td>' . $this->renderLongField($file_node, 'field_transaction_details') . '</td></tr>';
      if (strpos($this->renderListField($file_node, 'field_noc_option'), 'produce') !== false) {
        $markup .= '<tr><th>NOC Declaration</th><td>I declared that I shall produce NOC at the time of Document Verification/Skill Test/Interview.</td></tr>';
      }
      $markup .= '<tr><th>NOC</th><td>' . $this->renderFileField($file_node, 'field_noc_file') . '</td></tr>';
      $markup .= '<tr><th>Reservation Certificate</th><td>' . $this->renderFileField($file_node, 'field_reservation_certificate') . '</td></tr>';
      $markup .= '</tbody></table>';

      $form['preview']['file_upload'] = [
        '#type' => 'details',
        '#title' => $this->t('File Uploads'),
        '#open' => TRUE,
        '#markup' => $markup,
      ];
    }

    return $form;
  }

/**
 * {@inheritdoc}
 */
public function validateForm(array &$form, FormStateInterface $form_state) {
  $job = $form_state->getValue('job');
  $current_user = \Drupal::currentUser();
  $uid = $current_user->id();

    // Check if the last date for application has passed.
    if ($job) {
      $job_node = \Drupal\node\Entity\Node::load($job);
      if ($job_node && $job_node->hasField('field_last_date') && !$job_node->get('field_last_date')->isEmpty()) {
        $last_date = $job_node->get('field_last_date')->value;
        $current_time = new \DateTime();
        $last_date_time = new \DateTime($last_date);
        if ($current_time > $last_date_time) {
          $form_state->setErrorByName('', $this->t('The application submission deadline has passed. You can no longer submit this application.'));
          return;
        }
      }
    }

    // Run full revalidation before submission.
    $is_valid = instemjobportal_revalidate_application($uid, $job, $form_state);

    // If revalidation fails, mark form as invalid.
    if (!$is_valid) {
      // Drupal automatically stops submission if errors are set during validation.
      \Drupal::messenger()->addError($this->t('Please correct the highlighted issues before final submission.'));
    }
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
    $uid = $current_user->id();


    // Set the advertisement reference if the field exists.
    if ($pnode->hasField('field_advertisement_number')) {
      $pnode->set('field_advertisement_number', ['target_id' => $job]);
    }

    //  Only mark as Completed if validation passes.
    if ($pnode->hasField('field_job_status')) {
      $pnode->set('field_job_status', 'Completed');
    }

    $pnode->save();
    instemjobportal_send_confirmation_email($pnode);
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
   \Drupal::messenger()->addStatus($this->t('Your application has been submitted successfully.'));
   $form_state->setRedirect('<front>');
  // $form_state->setRedirect('/jobportal/my-jobs');
  }

}
