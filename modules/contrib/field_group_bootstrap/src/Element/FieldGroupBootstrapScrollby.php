<?php

namespace Drupal\field_group_bootstrap\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Attribute\FormElement;
use Drupal\Core\Render\Element\RenderElementBase;

/**
 * Provides a render element for horizontal bootstrap scrollby.
 *
 * Formats all child details and all non-child details whose #group is
 * assigned this element's name as navigation scrollby.
 */
#[FormElement('field_group_bootstrap_scrollby')]
class FieldGroupBootstrapScrollby extends RenderElementBase {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#default_tab' => '',
      '#process' => [
        [$this, 'processFieldGroupBootstrapScrollby'],
      ],
      '#theme_wrappers' => ['field_group_bootstrap_scrollby'],
    ];
  }

  /**
   * Creates a group formatted as Scrollby.
   *
   * @param array $element
   *   An associative array containing the properties and children of the
   *   detail's element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param bool $on_form
   *   Are the tabs rendered on a form or not.
   *
   * @return array
   *   The processed element.
   */
  public function processFieldGroupBootstrapScrollby(array &$element, FormStateInterface $form_state, $on_form = TRUE) {

    // Inject a new details as child, so that form_process_details() processes
    // this details element like any other details.
    $element['group'] = [
      '#type' => 'details',
      '#theme_wrappers' => [],
      '#parents' => $element['#parents'],
    ];

    // Add an invisible label for accessibility.
    if (empty($element['#title'])) {
      $element['#title_label'] = $this->t('Bootstrap Scrollby');
      $element['#title_display'] = 'invisible';
    }
    return $element;
  }

}
