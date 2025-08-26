<?php

namespace Drupal\education\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EducationForm extends FormBase {

  public function getFormId() {
    return 'education_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['qualification_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Qualification Name'),
      '#required' => TRUE,
    ];

    $form['specialization'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Specialization/Main Subjects'),
      '#required' => TRUE,
    ];

    $form['university'] = [
      '#type' => 'textfield',
      '#title' => $this->t('University/Institute'),
      '#required' => TRUE,
    ];

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#required' => TRUE,
    ];

    $form['year_of_passing'] = [
      '#type' => 'number',
      '#title' => $this->t('Year of Passing'),
      '#required' => TRUE,
      '#min' => 1900,
      '#max' => date('Y'),
    ];

    $form['marks'] = [
      '#type' => 'number',
      '#title' => $this->t('% of Marks'),
      '#required' => TRUE,
      '#min' => 35,
      '#max' => 100,
    ];

    $form['gpa'] = [
      '#type' => 'number',
      '#title' => $this->t('GPA'),
      '#required' => TRUE,
      '#min' => 1,
      '#max' => 10,
      '#step' => 0.1,
    ];

    $form['certificate_upload'] = [
      '#type' => 'file',
      '#title' => $this->t('Certificate Upload'),
      '#description' => $this->t('Upload your qualification certificate.'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Education'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Handle form submission logic here.
  }

}