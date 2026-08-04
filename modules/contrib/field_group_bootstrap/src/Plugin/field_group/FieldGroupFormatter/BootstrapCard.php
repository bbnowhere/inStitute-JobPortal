<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Element;
use Drupal\Core\Render\Markup;
use Drupal\field_group\FieldGroupFormatterBase;

/**
 * Plugin implementation of the Bootstrap card formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_card",
 *   label = @Translation("Bootstrap card"),
 *   description = @Translation("This fieldgroup renders child groups in its own Card wrapper."),
 *   supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapCard extends FieldGroupFormatterBase {

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $id = Html::getUniqueId($this->getSetting('id'));
    if (empty($id)) {
      $id = 'card-' . $this->group->group_name;
    }
    $element += [
      '#id' => $id,
      '#type' => 'field_group_bootstrap_card',
      '#title' => $this->getLabel(),
      '#attributes' => [
        'class' => $this->getClasses(),
      ],
      '#header' => $this->getSetting('header') ?? FALSE,
    ];
    foreach (Element::children($element) as $fieldName) {
      if (!empty($element[$fieldName]["#field_type"]) && $element[$fieldName]["#field_type"] == 'image') {
        $element['#img'] = $element[$fieldName][0] ?? '';
        $element['#img']["#item_attributes"]['class'][] = 'card-img-top';
        unset($element[$fieldName]);
        break;
      }
    }
    if (!empty($this->getSetting('title'))) {
      $title = [
        '#type' => 'inline_template',
        '#template' => $this->getSetting('title') ?? '',
        '#context' => [
          'context' => $element,
        ],
      ];
      $element['#card_title'] = $title;
    }
    if (!empty($this->getSetting('footer'))) {
      $footer = [
        '#type' => 'inline_template',
        '#template' => $this->getSetting('footer') ?? '',
        '#context' => [
          'context' => $element,
        ],
      ];
      $element['#footer'] = $footer;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function preRender(&$element, $rendering_object) {
    parent::preRender($element, $rendering_object);
    $this->process($element, $rendering_object);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm() {
    $form = parent::settingsForm();
    $form['header'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show header'),
      '#default_value' => $this->getSetting('header'),
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->getSetting('title'),
    ];
    $form['footer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Show footer'),
      '#default_value' => $this->getSetting('footer'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    if (!empty($this->getSetting('title'))) {
      $summary[] = 'Card title: ' . Markup::create($this->getSetting('title'));
    }
    if (!empty($this->getSetting('footer'))) {
      $summary[] = 'Footer: ' . Markup::create($this->getSetting('footer'));
    }
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    return [
      'btn_color' => 'btn-primary',
      'footer' => '',
      'header' => FALSE,
    ] + parent::defaultContextSettings($context);
  }

  /**
   * {@inheritdoc}
   */
  public function getClasses() {
    $classes = parent::getClasses();
    $classes[] = 'field-group-' . $this->group->format_type . '-wrapper';
    $classes[] = 'card';
    return $classes;
  }

}
