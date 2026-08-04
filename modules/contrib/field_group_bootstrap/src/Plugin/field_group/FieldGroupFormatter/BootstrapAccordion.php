<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Serialization\Json;
use Drupal\Component\Utility\Html;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Template\Attribute;
use Drupal\field\Entity\FieldConfig;
use Drupal\field_group\FieldGroupFormatterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Plugin implementation of the Accordion formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_accordion",
 *   label = @Translation("Bootstrap Accordion"),
 *   description = @Translation("This fieldgroup renders child groups in its
 *   own Accordion wrapper."), supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapAccordion extends FieldGroupFormatterBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a ScrollSpy object.
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
   * @param \Symfony\Component\HttpFoundation\RequestStack|null $requestStack
   *   The request stack service.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The module handle service.
   */
  public function __construct($plugin_id, $plugin_definition, $group, array $settings, $label, protected ?RequestStack $requestStack = NULL, protected ?ModuleHandlerInterface $moduleHandler = NULL) {
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
      $container->get('request_stack'),
      $container->get('module_handler'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $build_header = [];
    $active_accordion = $this->getSetting('active_default');

    $element_id = Html::getUniqueId($this->group->group_name);
    if ($this->getSetting('id')) {
      $element_id = $this->getSetting('id');
    }
    parent::preRender($element, $processed_object);
    if (!empty($fields = $this->group->children)) {
      $cookie = $this->requestStack->getCurrentRequest()->cookies->get('bootstrap_accordion');
      if (!empty($cookie)) {
        $active_accordion = Json::decode($cookie);
        if (!empty($active_accordion[$this->group->group_name])) {
          $active_accordion = $active_accordion[$this->group->group_name];
        }
      }
      $icons = explode(',', $this->getSetting('icon'));
      foreach ($fields as $index => $field_name) {
        $field = $processed_object[$field_name] ?? [];
        $unprocessed_id = $title = '';
        $button = [
          '#attributes' => [
            'class' => ['accordion-button'],
            'id' => Html::getId("accordion-" . $field_name),
            'data-group' => $this->group->group_name,
            'data-bs-toggle' => "collapse",
            'data-controls' => $field_name,
            'aria-expanded' => "false",
            'role' => "button",
          ],
        ];
        if ($active_accordion == $field_name) {
          $button['#attributes']['class'][] = 'active';
          $button['#attributes']['aria-expanded'] = 'true';
        }
        elseif (empty($this->getSetting('open'))) {
          $button['#attributes']['class'][] = 'collapsed';
        }
        if (!empty($this->getSetting('open'))) {
          $button['#attributes']['aria-expanded'] = 'true';
        }
        if ($this->context == 'view') {
          if (!empty($element[$field_name]['#lazy_builder'])) {
            continue;
          }
          if (!empty($processed_object["#fieldgroups"][$field_name])) {
            $unprocessed_id = $processed_object["#fieldgroups"][$field_name]->group_name;
            $title = $processed_object["#fieldgroups"][$field_name]->label;
          }
          elseif (!empty($field['#field_name'])) {
            $unprocessed_id = $field['#field_name'];
            $title = !empty($field['#title']) ? $field['#title'] : '';
          }
          else {
            // Field empty or not accessible.
            continue;
          }
          $element[$field_name]["#theme_wrappers"] = ['field_group_bootstrap_accordion'];
          $element[$field_name]["#title"] = $title;
          $element[$field_name]["#parent_id"] = $element_id;
          $element[$field_name]["#collapse"] = $active_accordion == $field_name ? 'show' : '';
        }
        elseif ($this->context == 'form') {
          if (!empty($processed_object["#fieldgroups"][$field_name])) {
            $unprocessed_id = 'edit-' . $processed_object["#fieldgroups"][$field_name]->group_name;
            $title = $processed_object["#fieldgroups"][$field_name]->label;
          }
          elseif (!empty($field)) {
            $unprocessed_id = 'edit-' . implode('-', $field['#parents'] ?? []);
            $title = $field['widget']['#title'] ?? $field["widget"][0]["#title"];
            if (empty($title) && !empty($field['widget']['title'])) {
              $title = $field['widget']['title'];
            }
          }
        }
        $button['#title'] = $title;
        $unprocessed_id = Html::getId($unprocessed_id);
        $button['#attributes']['data-bs-target'] = '#' . $unprocessed_id;
        $button['#attributes']['aria-controls'] = $unprocessed_id;
        if (!empty($icons)) {
          $icon = $icons[$index] ?? '';
          $icon = trim($icon);
          if (!empty($icon)) {
            $element[$field_name]['#icon'] = Markup::create('<i class="' . $icon . '"></i>');
            $button['#attributes']['class'][] = 'icon-link icon-link-hover';
          }
        }
        if ($this->context == 'view') {
          $element[$field_name]["#id"] = $unprocessed_id;
          $element[$field_name]["#button_attributes"] = new Attribute($button["#attributes"]);
        }
        $build_header[$field_name] = $button;
      }
    }
    $element += [
      '#id' => $element_id,
      '#type' => 'container',
      '#tree' => TRUE,
      '#parents' => [$this->group->group_name],
      '#default_tab' => $active_accordion,
      '#items' => $build_header,
      '#open' => $this->getSetting('open'),
    ];
    if (!empty($element['#attributes']) && is_object($element['#attributes'])) {
      $element['#attributes']->addClass($this->getClasses());
    }
    else {
      $element['#attributes']['class'] = array_filter(array_unique(array_merge($element['#attributes']['class'] ?? [], $this->getClasses())));
    }
    if ($this->context == 'view') {
      if (empty($element['#attributes']['id'])) {
        $element['#attributes']['id'] = $element_id;
      }
    }
    // By default, tabs don't have titles, but you can override it in the theme.
    if ($this->getLabel()) {
      $element['#title'] = $this->getLabel();
    }
    if (method_exists($this->moduleHandler, 'invokeAllWith')) {
      $group = $this->group;
      $this->moduleHandler->invokeAllWith('field_group_accordion_pre_render', function (callable $hook) use (&$element, &$group, &$processed_object) {
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
    $options = [];
    $fields = $this->group->children ?? [];
    if (!empty($fields)) {
      $entity_type = $this->group->entity_type;
      $bundle = $this->group->bundle;
      foreach ($fields as $field_name) {
        $fieldConfig = FieldConfig::loadByName($entity_type, $bundle, $field_name);
        if (!empty($fieldConfig)) {
          $options[$field_name] = $fieldConfig->getLabel();
        }
      }
    }

    $form = parent::settingsForm();
    $form['active_default'] = [
      '#title' => $this->t('Accordion default'),
      '#type' => 'select',
      '#options' => $options,
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('active_default'),
    ];

    $form['open'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Always open'),
      '#default_value' => $this->getSetting('open'),
    ];

    $form['flush'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Remove the default background color'),
      '#default_value' => $this->getSetting('flush'),
    ];

    $form['icon'] = [
      '#title' => $this->t('Icon class'),
      '#description' => $this->t('<a href="@icon" target="_blank" class="use-ajax" data-dialog-options="{&quot;width&quot;:600}"  data-dialog-type="modal"  >Bootstrap icon</a> separated by , example: bi bi-alarm, bi bi-airplane', ['@icon' => 'https://icons.getbootstrap.com']),
      '#type' => 'textarea',
      '#default_value' => $this->getSetting('icon'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $entity_type = $this->group->entity_type;
    $bundle = $this->group->bundle;
    $summary = parent::settingsSummary();
    if (!empty($this->getSetting('active_default'))) {
      $fieldConfig = FieldConfig::loadByName($entity_type, $bundle, $this->getSetting('active_default'));
      $summary[] = $this->t('Accordion default: @active_default',
        ['@active_default' => $fieldConfig->getLabel()]
      );
    }
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
    return [
      'active_default' => '',
      'flush' => FALSE,
      'open' => FALSE,
      'icon' => '',
    ] +
    parent::defaultContextSettings($context);
  }

  /**
   * {@inheritdoc}
   */
  public function getClasses() {
    $classes = parent::getClasses();
    $classes[] = 'field-group-' . $this->group->format_type . '-wrapper';
    $classes[] = 'accordion';
    if ($this->getSetting('flush')) {
      $classes[] = 'accordion-flush';
    }
    return $classes;
  }

}
