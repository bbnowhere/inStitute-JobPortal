<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Template\Attribute;
use Drupal\field_group\FieldGroupFormatterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'horizontal_tabs' formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_tabs",
 *   label = @Translation("Bootstrap Tabs classic"),
 *   description = @Translation("This fieldgroup renders child groups in its
 *   own tabs wrapper."), supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapTabs extends FieldGroupFormatterBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a tabs object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param object $group
   *   The group object.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handler service.
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   */
  public function __construct($plugin_id, $plugin_definition, $group, array $settings, $label, protected ModuleHandlerInterface $moduleHandler, protected RendererInterface $renderer) {
    parent::__construct($plugin_id, $plugin_definition, $group, $settings, $label);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new self(
      $plugin_id,
      $plugin_definition,
      $configuration['group'],
      $configuration['settings'],
      $configuration['label'],
      $container->get('module_handler'),
      $container->get('renderer'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {

    $build_nav = [];
    if (!empty($fields = $this->group->children)) {
      $nav_mode = $this->getSetting('mode');

      $icons = explode(',', $this->getSetting('icon'));

      foreach ($fields as $index => $field_name) {
        $field = $processed_object[$field_name] ?? [];
        $custom_class = $unprocessed_id = $title = '';
        if (isset($element[$field_name]['#access']) && $element[$field_name]['#access'] == FALSE) {
          continue;
        }
        switch ($this->context) {
          case 'view':
            if (!empty($element[$field_name]['#lazy_builder'])) {
              continue 2;
            }
            if (!empty($processed_object["#fieldgroups"][$field_name])) {
              $unprocessed_id = $processed_object["#fieldgroups"][$field_name]->group_name;
              $title = $processed_object["#fieldgroups"][$field_name]->label;
              if (!empty($processed_object["#fieldgroups"][$field_name]->format_settings["id"])) {
                $unprocessed_id = $processed_object["#fieldgroups"][$field_name]->format_settings["id"];
              }
              if (!empty($processed_object["#fieldgroups"][$field_name]->format_settings["classes"])) {
                $custom_class = $processed_object["#fieldgroups"][$field_name]->format_settings["classes"];
              }
            }
            elseif (!empty($field['#field_name'])) {
              $unprocessed_id = $field['#field_name'];
              $title = !empty($field['#title']) ? $field['#title'] : '';
            }
            else {
              // Field empty or not accessible.
              continue 2;
            }
            break;

          case 'form':
            if (!empty($processed_object["#fieldgroups"][$field_name])) {
              $unprocessed_id = 'edit-' . $processed_object["#fieldgroups"][$field_name]->group_name;
              $title = $processed_object["#fieldgroups"][$field_name]->label;
            }
            elseif (!empty($field)) {
              $unprocessed_id = 'edit-' . implode('-', $field['#parents']);
              $tempTitle = $field['widget'][0]['#title'] ?? '';
              $title = $field['widget']['#title'] ?? $tempTitle;
              if (empty($title) && !empty($field['widget']['title'])) {
                $title = $field['widget']['title'];
              }
              if (empty($title)) {
                $temp_widget = $field['widget'];
                field_group_bootstrap_hide_form_title($temp_widget, $title);
              }
            }
            break;
        }
        $unprocessed_id = Html::getId($unprocessed_id);
        if (is_array($title)) {
          $title = $this->renderer->render($title);
        }
        $button = [
          '#title' => $title,
          '#id' => Html::getId("nav-" . $field_name),
          '#attributes' => [
            'class' => ['nav-link', 'fg-bootstrap-tab'],
            'data-bs-toggle' => $nav_mode,
            'role' => "tab",
            'data-bs-target' => '#' . $unprocessed_id,
            'data-group' => $this->group->group_name,
            'aria-controls' => $field_name,
            'type' => 'button',
            'aria-selected' => "false",
          ],
        ];
        if (!$index) {
          $button['#attributes']['class'][] = 'active';
        }
        if (!empty($icons)) {
          $icon = $icons[$index] ?? '';
          $icon = trim($icon);
          if (!empty($icon)) {
            $button['#title'] = Markup::create('<i class="' . $icon . '"></i> ' . $title);
            $button['#attributes']['class'][] = 'icon-link icon-link-hover';
          }
        }
        $build_nav[$field_name] = [
          'attributes' => new Attribute($button['#attributes']),
          'label' => $button['#title'],
        ];
        $attr = [
          'id' => $unprocessed_id,
          'class' => ['tab-pane', 'tabs'],
          'role' => "tabpanel",
          'aria-labelledby' => Html::getId("nav-" . $field_name),
        ];
        if (!$index) {
          $attr['class'][] = 'active show';
        }
        if (!empty($custom_class)) {
          $attr['class'][] = $custom_class;
        }
        if (!empty($processed_object["#fieldgroups"][$field_name])) {
          $groupSettings = $processed_object["#fieldgroups"][$field_name]->format_settings;
          if (!empty($groupSettings['classes'])) {
            $explode_class = explode(' ', $groupSettings["classes"]);
            $attr["class"] = array_merge($attr["class"], $explode_class);
            $attr["class"] = array_unique($attr['class']);
          }
          $attributes = 'role="tabpanel" aria-labelledby="' . $attr['aria-labelledby'] . '"';
          $processed_object["#fieldgroups"][$field_name]->format_settings["id"] = $attr['id'];
          $processed_object["#fieldgroups"][$field_name]->format_settings["attributes"] = $attributes;
          $processed_object["#fieldgroups"][$field_name]->format_settings["classes"] = implode(' ', $attr['class']);
        }
        if (empty($field['#id'])) {
          $processed_object[$field_name]['#id'] = $attr['id'];
        }
        if (!empty($element[$field_name]["#attributes"]) && is_array($element[$field_name]["#attributes"])) {
          $field_name_class = [];
          if (!empty($element[$field_name]["#attributes"]['class'])) {
            $field_name_class = $element[$field_name]["#attributes"]['class'];
          }
          if (is_object($element[$field_name]["#attributes"])) {
            $field_name_class = $element[$field_name]["#attributes"]->getClass();
          }
          $attr['class'] = array_merge($attr['class'], $field_name_class);
        }
        $element[$field_name]["#id"] = $attr['id'];
        $element[$field_name]["#attributes"] = new Attribute($attr);
        $element[$field_name]['#label_display'] = 'hidden';
      }
    }

    $element += [
      '#type' => 'field_group_bootstrap_tabs',
      '#navigation' => $build_nav,
      '#tree' => TRUE,
      '#parents' => [$this->group->group_name],
      '#default_tab' => '',
      '#direction' => $this->getSetting('direction'),
      '#mode' => $this->getSetting('mode'),
    ];
    if (!empty($this->getSetting('icon'))) {
      $element['#icons'] = explode(',', $this->getSetting('icon'));
    }
    $element['#attached']['library'][] = 'field_group_bootstrap/field_group_boostrap';
    if ($this->getSetting('id')) {
      $element['#id'] = Html::getUniqueId($this->getSetting('id'));
    }
    $idElement = !empty($element['#id']) ? $element['#id'] : $this->group->group_name ?? '';
    $idElement = !empty($idElement) ? 'id="' . $idElement . '" ' : '';
    $element['#prefix'] = '<div ' . $idElement . 'class="' . implode(' ', $this->getClasses()) . '">';
    $element['#suffix'] = '</div>';

    // By default, tabs don't have titles, but you can override it in the theme.
    if ($this->getLabel() && $this->getSetting('show_label')) {
      $element['#title'] = $this->getLabel();
    }
    if (method_exists($this->moduleHandler, 'invokeAllWith')) {
      $group = $this->group;
      $this->moduleHandler->invokeAllWith('field_group_tab_pre_render', function (callable $hook) use (&$element, &$group, &$processed_object) {
        $hook($element, $group, $processed_object);
      });
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

    $form['direction'] = [
      '#title' => $this->t('Direction'),
      '#type' => 'select',
      '#options' => [
        'vertical' => $this->t('Vertical'),
        'horizontal' => $this->t('Horizontal'),
      ],
      '#default_value' => $this->getSetting('direction'),
    ];
    $form['show_label'] = [
      '#title' => $this->t('Show label'),
      '#type' => 'checkbox',
      '#default_value' => $this->getSetting('show_label'),
    ];
    $form['mode'] = [
      '#title' => $this->t('Mode'),
      '#type' => 'select',
      '#options' => [
        'tab' => $this->t('Tabs'),
        'pill' => $this->t('Pills'),
      ],
      '#default_value' => $this->getSetting('mode'),
    ];

    $form['icon'] = [
      '#title' => $this->t('Icon class'),
      '#description' => $this->t('<a href="@icon" target="_blank" class="use-ajax" data-dialog-options="{&quot;width&quot;:600}"  data-dialog-type="modal"  >Bootstrap icon</a> separated by , example: bi bi-alarm, bi bi-airplane', ['@icon' => 'https://icons.getbootstrap.com']),
      '#type' => 'textarea',
      '#rows' => 2,
      '#default_value' => $this->getSetting('icon'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = parent::settingsSummary();
    $summary[] = $this->t(
      'Direction: @direction',
      ['@direction' => $this->getSetting('direction')]
    );
    $summary[] = $this->t(
      'Mode: @mode',
      ['@mode' => $this->getSetting('mode')]
    );
    if (!empty($this->getSetting('icon'))) {
      $icons = explode(',', $this->getSetting('icon'));
      if (!empty($icons)) {
        $markup = [];
        foreach ($icons as $icon) {
          $markup[] = Markup::create('<i class="' . $icon . '"></i>');
        }
        $summary[] = 'Icon: ' . implode(' ', $markup);
      }
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultContextSettings($context) {
    return ['direction' => 'horizontal'] +
      ['show_label' => FALSE] +
      ['mode' => 'tab'] +
      ['icon' => ''] +
      parent::defaultContextSettings($context);
  }

  /**
   * {@inheritdoc}
   */
  public function getClasses() {

    $classes = parent::getClasses();
    $classes[] = 'field-group-' . $this->group->format_type . '-wrapper';
    if ($this->getSetting('direction') == 'vertical') {
      $classes[] = 'd-flex align-items-start';
    }
    return $classes;
  }

  /**
   * Arranges elements into groups.
   *
   * This method is useful for non-input elements that can be used in and
   * outside the context of a form.
   *
   * {@inheritDoc}
   */
  public static function processGroup(&$element, FormStateInterface $form_state, &$complete_form) {

    $groups = &$form_state->getGroups();
    $element['#groups'] = &$groups;

    if (isset($element['#group'])) {
      // Add this element to the defined group (by reference).
      $group = $element['#group'];
      $groups[$group][] = &$element;
    }

    return $element;
  }

}
