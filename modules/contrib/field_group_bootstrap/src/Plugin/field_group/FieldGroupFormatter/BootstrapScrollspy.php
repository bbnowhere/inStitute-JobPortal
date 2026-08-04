<?php

namespace Drupal\field_group_bootstrap\Plugin\field_group\FieldGroupFormatter;

use Drupal\Component\Serialization\Json;
use Drupal\Component\Utility\Html;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Template\Attribute;
use Drupal\field_group\FieldGroupFormatterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Plugin implementation of the Scrollspy formatter.
 *
 * @FieldGroupFormatter(
 *   id = "bootstrap_scrollspy",
 *   label = @Translation("Bootstrap Scrollspy"),
 *   description = @Translation("This fieldgroup renders child groups in its own Scrollspy wrapper."),
 *   supported_contexts = {
 *     "form",
 *     "view",
 *   }
 * )
 */
class BootstrapScrollspy extends FieldGroupFormatterBase implements ContainerFactoryPluginInterface {

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
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   The request stack service.
   */
  public function __construct($plugin_id, $plugin_definition, $group, array $settings, $label, protected RequestStack $requestStack) {
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
    );
  }

  /**
   * {@inheritdoc}
   */
  public function process(&$element, $processed_object) {
    $active_tab = '';
    if (!empty($fields = $this->group->children)) {
      $active_tab = $fields[0];
      $cookie = $this->requestStack->getCurrentRequest()->cookies->get('bootstrap_scrollby');
      if (!empty($cookie)) {
        $active_tabs = Json::decode($cookie);
        if (!empty($active_tabs[$this->group->group_name])) {
          $active_tab = $active_tabs[$this->group->group_name];
        }
      }
      $build_nav = [];
      $icons = explode(',', $this->getSetting('icon'));
      foreach ($fields as $index => $field_name) {
        $field = $processed_object[$field_name] ?? [];
        $unprocessed_id = $title = '';
        switch ($this->context) {
          case 'view':
            if (!empty($element[$field_name]['#lazy_builder'])) {
              continue 2;
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
              continue 2;
            }
            if (!empty($element[$field_name]) && empty($element[$field_name]["#attributes"]['id'])) {
              $element[$field_name]["#attributes"]['id'] = Html::getId($unprocessed_id);
            }
            break;

          case 'form':
            if (!empty($processed_object["#fieldgroups"][$field_name])) {
              $unprocessed_id = 'edit-' . $processed_object["#fieldgroups"][$field_name]->group_name;
              $title = $processed_object["#fieldgroups"][$field_name]->label;
            }
            elseif (!empty($field)) {
              $unprocessed_id = 'edit-' . implode('-', $field['#parents']);
              $title = $field['widget']['#title'] ?? $field["widget"][0]["#title"];
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
        $id = Html::getId($unprocessed_id);
        $icon = $icons[$index] ?? '';
        if (!empty($icon)) {
          $icon = trim($icon);
          $title = Markup::create('<i class="' . $icon . '"></i> ' . $title);
        }
        $build_nav[$field_name] = [
          'id' => $id,
          'label' => $title,
          'active' => $active_tab == $field_name ? 'active' : '',
          'group' => $this->group->group_name,
          'attributes' => new Attribute([
            'data-controls' => $field_name,
            'data-group' => $this->group->group_name,
            'href' => '#' . $id,
            'class' => [
              'nav-link',
              !empty($icon) ? 'icon-link icon-link-hover' : '',
              $active_tab == $field_name ? 'active' : '',
            ],
          ]),
        ];
      }
    }
    if ($this->getSetting('id')) {
      $element['#id'] = Html::getUniqueId($this->getSetting('id'));
    }
    if (empty($element['#id'])) {
      $element['#id'] = Html::getId($this->group->group_name);
    }
    $element += [
      '#type' => 'field_group_bootstrap_scrollby',
      '#prefix' => '<div class="' . implode(' ', $this->getClasses()) . '">',
      '#suffix' => '</div>',
      '#attributes' => [
        'data-bs-spy' => "scroll",
        'data-bs-smooth-scroll' => "true",
        'data-bs-target' => "#" . $element['#id'],
        'data-bs-offset' => 0,
        'tabindex' => 0,
      ],
      '#label_width' => $this->getSetting('width'),
      '#direction' => $this->getSetting('direction'),
      '#navigation' => $build_nav,
      '#parents' => [$this->group->group_name],
      '#default_tab' => $active_tab,
    ];
    if (!empty($height = $this->getSetting('height'))) {
      $element['#attributes']['data-height'] = $height;
      $element['#attributes']['style'] = "height: {$height}px;position: relative; overflow: auto;";
    }
    $element['#attached']['library'][] = 'field_group_bootstrap/field_group_boostrap';

    // By default, tabs don't have titles, but you can override it in the theme.
    if ($this->getLabel()) {
      $element['#title'] = $this->getLabel();
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
        'vertical' => $this->t('List group'),
        'horizontal' => $this->t('Navigation bar'),
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

    $form['width'] = [
      '#title' => $this->t('List width'),
      '#type' => 'select',
      '#options' => array_combine(range(1, 11), range(1, 11)),
      '#default_value' => $this->getSetting('width'),
    ];
    $form['height'] = [
      '#title' => $this->t('List height'),
      '#type' => 'number',
      '#suffix' => 'px',
      '#min' => 0,
      '#default_value' => $this->getSetting('height'),
    ];
    $form['icon'] = [
      '#title' => $this->t('Icon class'),
      '#description' => $this->t('<a href="@icon" target="_blank" class="use-ajax" data-dialog-options="{&quot;width&quot;:600}"  data-dialog-type="modal"  >Bootstrap icon</a> separated by , example: bi bi-alarm, bi bi-airplane', ['@icon' => 'https://icons.getbootstrap.com']),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('icon'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {

    $summary = parent::settingsSummary();
    $summary[] = $this->t('Direction: @direction',
      ['@direction' => $this->getSetting('direction')]
    );
    $summary[] = $this->t('Mode: @mode',
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
    return [
      'direction' => 'horizontal',
      'width' => 3,
      'height' => '',
      'show_label' => FALSE,
      'mode' => 'tab',
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
    $classes[] = 'row';
    return $classes;
  }

}
