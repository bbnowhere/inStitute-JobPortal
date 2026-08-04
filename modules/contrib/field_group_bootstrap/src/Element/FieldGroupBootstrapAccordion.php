<?php

namespace Drupal\field_group_bootstrap\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Attribute\FormElement;
use Drupal\Core\Render\Element\RenderElementBase;

/**
 * Provides a render element for bootstrap accordion.
 *
 * Formats all child details and all non-child details whose #group is
 * assigned this element's name as accordion.
 */
#[FormElement('field_group_bootstrap_accordion')]
class FieldGroupBootstrapAccordion extends RenderElementBase {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    return [
      '#process' => [
        [$this, 'processFieldGroupBootstrapAccordion'],
      ],
      '#theme_wrappers' => ['field_group_bootstrap_accordion'],
    ];
  }

  /**
   * Creates a group formatted as accordion.
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
  public function processFieldGroupBootstrapAccordion(array &$element, FormStateInterface $form_state, $on_form = TRUE) {

    // Inject a new details as child, so that form_process_details() processes
    // this details element like any other details.
    $element['group'] = [
      '#type' => 'details',
      '#theme_wrappers' => [],
      '#parents' => $element['#parents'],
    ];

    // Add an invisible label for accessibility.
    if (empty($element['#title'])) {
      $element['#title_label'] = $this->t('Bootstrap Accordion');
      $element['#title_display'] = 'invisible';
    }
    return $element;
  }

}
