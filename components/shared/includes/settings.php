<?php
/**
 * Contains the clanpress settings controller.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Settings
 */
class Clanpress_Settings {
  /**
   * @var string
   * Clanpress settings page id.
   */
  const SETTINGS_PAGE = 'clanpress_settings';

  /**
   * @var Clanpress_Settings
   * Instance of the clanpress settings controller.
   */
  protected static $instance;

  /**
   * @var array
   * Array of components with settings attached.
   */
  protected $components = array();

  /**
   * Registers settings and menu page of clanpress settings.
   */
  public function __construct() {
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    add_action( 'admin_menu', array( $this, 'add_options_page' ) );
  }

  /**
   * Creates and returns an instance of the clanpress settings controller.
   *
   * @return Clanpress_Settings
   */
  public static function instance() {
    if ( empty( self::$instance ) ) {
      self::$instance = new self;
    }

    return self::$instance;
  }

  /**
   * Adds component's settings to the settings array.
   *
   * @param string|null $id
   *   The component id.
   * @param string|null $name
   *   Name of the component.
   * @param string|null $form_elements
   *   Array of form elements.
   *
   * @see Clanpress_Form::element()
   */
  public function add_settings( $id = null, $name = null, $form_elements = array() ) {
    if ( empty( $id ) || empty( $name ) || !count( $form_elements ) ) {
      return;
    }

    $this->components[ $id ] = array(
      'id' => $id,
      'name' => $name,
      'form_elements' => $form_elements,
    );
  }

  /**
   * Returns the settings values stored for the given component.
   *
   * @param string $component
   *   The component id.
   *
   * @return array
   *   Array of stored settings.
   */
  public function get_values( $component ) {
    return get_option( $this->get_section_id( $component ), array() );
  }

  /**
   * Registers all previously added settings.
   */
  public function register_settings() {
    foreach ( $this->components as $component ) {
      $section_id = $this->get_section_id( $component['id'] );

      add_settings_section(
      	$section_id,
      	$component['name'],
      	null,
      	$section_id
      );

      register_setting(
        $section_id,
        $section_id,
        array( $this, 'validate_section' )
      );

      $values = get_option( $section_id, array() );
      foreach ( $component['form_elements'] as $key => $element ) {
        if ( isset( $values[ $key ] ) ) {
          $element['default'] = $values[ $key ];
        }

        $element['field_id'] = $section_id . '[' . $key . ']';
        $element['field_name'] = $element['field_id'];

        add_settings_field(
          $key,
          $element['label'],
          array( $this, 'display_field' ),
          $section_id,
          $section_id,
          array( 'element' => $element )
        );
      }
    }
  }

  /**
   * Adds the clanpress options page.
   */
  public function add_options_page() {
    add_options_page(
      __( 'Clanpress', 'clanpress' ),
      __( 'Clanpress', 'clanpress' ),
      'manage_options',
      self::SETTINGS_PAGE,
      array( $this, 'display_page' )
    );
  }

  /**
   * Displays a settings page for clanpress settings.
   *
   * @TODO Add a template for this page.
   */
  public function display_page() {
    if ( !current_user_can( 'manage_options' ) ) {
      wp_die( __( 'Access denied.', 'clanpress' ) );
    }

    if ( !count( $this->components ) ) {
      echo '<p>' . __( 'No settings available.', 'clanpress' ) . '</p>';
      return;
    }

    $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : null;
    if ( !isset( $this->components[ $active_tab ] )) {
      $active_tab = array_keys( $this->components )[0];
    }

    echo '<div class="wrap">';
    echo '<h2 class="nav-tab-wrapper">';
    foreach ( $this->components as $component ) {
      $class = $component['id'] === $active_tab ? ' nav-tab-active' : '';

      vprintf('<a href="?page=%s&tab=%s" class="nav-tab%s">%s</a>', array(
        self::SETTINGS_PAGE,
        $component['id'],
        $class,
        $component['name'],
      ));
    }
    echo '</h2>';

    echo '<form method="post" action="options.php">';

    $sections_id = $this->get_section_id( $active_tab );
    settings_fields( $sections_id );
    do_settings_sections( $sections_id );
    submit_button();

    vprintf('<input type="hidden" name="%s" value="%s" />', array(
      $sections_id . '[_component]',
      $active_tab
    ));

    echo '</form>';
    echo '</div>';
  }

  /**
   * Displays a single settings field.
   *
   * @param array $args
   *   Settings field arguments.
   */
  public function display_field( $args ) {
    unset( $args['element']['label'] );

    echo Clanpress_Form::element( $args['element'] );
  }

  /**
   * Validate the sections's settings fields.
   *
   * @param array $new_instance
   *   Settings values about to be stored.
   *
   * @return array
   *   Validated settings values.
   */
  public function validate_section( $new_instance ) {
    if ( !isset( $new_instance['_component'] ) ) {
      return null;
    }

    $component = $new_instance['_component'];
    if ( !isset( $this->components[ $component ]['form_elements'] ) ) {
      return null;
    }

    $elements = $this->components[ $component ]['form_elements'];
    $section_id = $this->get_section_id( $component );

    $instance = get_option( $section_id, array() );
    foreach ( $elements as $key => $element ) {
      if ( isset( $new_instance[ $key ] ) && !Clanpress_Form::is_valid( $element, $new_instance[ $key ] ) ) {
        $new_instance[ $key ] = isset( $instance[ $key ] ) ? $instance[ $key ] : null;

        $message = vsprintf( __( 'Unable to store setting: <em>%s</em>', 'clanpress' ), array(
          isset( $element['label'] ) ? esc_html( $element['label'] ) : $key,
        ) );

        add_settings_error( $section_id, $key, $message, 'error' );
      }
    }

    return $new_instance;
  }

  /**
   * Returns the sections id for a given component.
   *
   * @param string $component
   *   The component id.
   *
   * @return string
   *   The component's section id.
   */
  protected function get_section_id( $component ) {
    return self::SETTINGS_PAGE . '_' . $component;
  }
}
