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
 * Plugin implementation of the tab formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_tab",
 *   label = @Translation("Bootstrap tab navigation"),
 *   description = @Translation("This fieldgroup renders child groups in its
 *   own tab wrapper."), supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapTab extends FieldGroupFormatterBase implements ContainerFactoryPluginInterface {

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
    $build_nav = [];
    $active_tab = $this->getSetting('default_tab');
    $element_id = Html::getUniqueId($this->group->group_name);
    if ($this->getSetting('id')) {
      $element_id = $this->getSetting('id');
    }
    parent::preRender($element, $processed_object);
    if (!empty($fields = $this->group->children)) {
      $cookie = $this->requestStack->getCurrentRequest()->cookies->get('bootstrap_tab');
      if (!empty($cookie)) {
        $active_tabs = Json::decode($cookie);
        if (!empty($active_tabs)) {
          $active_tab = current($active_tabs);
        }
      }
      $icons = explode(',', $this->getSetting('icon'));
      $nav_mode = $this->getSetting('mode');
      foreach ($fields as $index => $field_name) {
        $field = $processed_object[$field_name] ?? [];
        $unprocessed_id = $title = '';
        $button = [
          '#title' => $title,
          '#id' => Html::getId("nav-" . $field_name),
          '#attributes' => [
            'class' => ['nav-link', 'fg-bootstrap-tab'],
            'data-bs-toggle' => $nav_mode,
            'role' => "tab",
            'data-bs-target' => '#nav-' . $unprocessed_id,
            'data-group' => $this->group->group_name,
            'aria-controls' => 'nav-' . $unprocessed_id,
            'type' => 'button',
            'aria-selected' => "false",
          ],
        ];
        if ($active_tab == $field_name) {
          $button['#attributes']['class'][] = 'active';
          $button['#attributes']['aria-selected'] = 'true';
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
          $element[$field_name]["#title"] = $title;
          $element[$field_name]["#parent_id"] = $element_id;
          $element[$field_name]["#active"] = $active_tab == $field_name ? 'show' : '';
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
        $button['#attributes']['data-bs-target'] = '#nav-' . $unprocessed_id;
        $button['#id'] = $button['#attributes']['aria-controls'] = 'nav-' . $unprocessed_id;
        if (!empty($icons)) {
          $icon = $icons[$index] ?? '';
          $icon = trim($icon);
          if (!empty($icon)) {
            $button['#title'] = Markup::create("<i class='$icon'></i> " . $button['#title']);
          }
        }
        if ($this->context == 'view') {
          $element[$field_name]["#id"] = $unprocessed_id;
          $element[$field_name]["#button_attributes"] = new Attribute($button["#attributes"]);
        }
        $build_nav[$field_name] = [
          'attributes' => new Attribute($button['#attributes']),
          'label' => $button['#title'],
          'id' => $button['#id'],
        ];
      }
    }
    $element += [
      '#id' => $element_id,
      '#type' => 'container',
      '#tree' => TRUE,
      '#parents' => [$this->group->group_name],
      '#default_tab' => $active_tab,
      '#direction' => $this->getSetting('direction'),
      'nav' => [
        '#theme' => 'field_group_bootstrap_tab_nav',
        '#tabs' => $build_nav,
        '#attributes' => [
          'class' => ["nav", "nav-" . $this->getSetting('mode') . "s"],
          'role' => "tablist",
          'aria-orientation' => $this->getSetting('direction'),
        ],
        '#weight' => 0,
      ],
      'tab_content' => [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['tab-content'],
        ],
        '#weight' => 1,
      ],
    ];
    if (!empty($build_nav)) {
      foreach (array_keys($build_nav) as $child) {
        if (isset($element[$child])) {
          $attributes = $element["nav"]["#tabs"][$child]["attributes"]->toArray();
          $element[$child]['#id'] = $attributes["aria-controls"];
          $element[$child]["#theme_wrappers"] = ['field_group_bootstrap_tab'];
          $element["tab_content"][$child] = $element[$child];
          unset($element[$child]);
        }
      }
    }
    $element['#attached']['library'][] = 'field_group_bootstrap/field_group_boostrap';
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
  }

  /**
   * {@inheritdoc}
   */
  public function preRender(&$element, $rendering_object) {
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
        $options[$field_name] = $field_name;
        $fieldConfig = FieldConfig::loadByName($entity_type, $bundle, $field_name);
        if (!empty($fieldConfig)) {
          $options[$field_name] = $fieldConfig->getLabel();
        }
      }
    }

    $form = parent::settingsForm();
    $form['default_tab'] = [
      '#title' => $this->t('Tab default'),
      '#type' => 'select',
      '#options' => $options,
      '#empty_option' => $this->t('Default'),
      '#default_value' => $this->getSetting('default_tab'),
    ];

    $form['direction'] = [
      '#title' => $this->t('Direction'),
      '#type' => 'select',
      '#options' => [
        'vertical' => $this->t('Vertical'),
        'horizontal' => $this->t('Horizontal'),
      ],
      '#default_value' => $this->getSetting('direction'),
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
    if (!empty($this->getSetting('default_tab'))) {
      $fieldConfig = FieldConfig::loadByName($entity_type, $bundle, $this->getSetting('default_tab'));
      $summary[] = $this->t('Tab default: @active_default',
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
      'default_tab' => '',
      'mode' => 'tab',
      'direction' => 'horizontal',
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
    $classes[] = 'tab';
    return $classes;
  }

}
