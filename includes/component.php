<?php
/**
 * Contains the main Clanpress components class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Component
 */
class Clanpress_Component {
  /**
   * @var Clanpress_Settings
   * Holds the settings class of this component.
   */
  protected $settings;

  /**
   * Initializes the component.
   */
  function __construct() {
    foreach ( $this->includes() as $include ) {
      Clanpress_Helper::register_include( $this->id(), $include );
    }

    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'admin_init', array( $this, 'register_admin_styles' ) );
    add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );
    add_action( 'widgets_init', array( $this, 'register_widgets' ) );
    add_action( 'bp_include', array( $this, 'register_group_extensions' ) );

    $this->settings = new Clanpress_Settings( $this->id(), $this->name(), $this->settings() );
  }

  /**
   * Registers all main admin menu pages.
   *
   * @see Clanpress_Helper::register_page()
   */
  public function register_admin_pages() {
    foreach ( $this->admin_pages() as $page ) {
      Clanpress_Helper::register_page( $this->id(), $page );
    }
  }

  /**
   * Registers stylesheets for admin pages.
   *
   * @see Clanpress_Helper::register_style()
   */
  public function register_admin_styles() {
    foreach ( $this->admin_styles() as $admin_style ) {
      Clanpress_Helper::register_style( $this->id(), $admin_style );
    }
  }

  /**
   * Registers group extensions for buddypress.
   *
   * @see Clanpress_Helper::register_group_extension().
   */
  public function register_group_extensions() {
    foreach ( $this->group_extensions() as $group_extension ) {
      Clanpress_Helper::register_group_extension( $this->id(), $group_extension );
    }
  }

  /**
   * Registers all custom post types of the plugin.
   *
   * @see Clanpress_Helper::register_post_type()
   */
  public function register_post_types() {
    foreach ( $this->post_types() as $post_type ) {
      Clanpress_Helper::register_post_type( $this->id(), $post_type );
    }

    // For some reason this is necessary to get the plugin's slugs to work.
    flush_rewrite_rules();
  }

  /**
   * Registers all custom taxonomies of the plugin.
   *
   * @see Clanpress_Helper::register_taxonomy()
   */
  public function register_taxonomies() {
    foreach ( $this->taxonomies() as $taxonomy ) {
      Clanpress_Helper::register_taxonomy( $this->id(), $taxonomy );
    }
  }

  /**
   * Registers all custom widgets of the plugin.
   *
   * @see Clanpress_Helper::register_widget()
   */
  public function register_widgets() {
    foreach ( $this->widgets() as $widget ) {
      Clanpress_Helper::register_widget( $this->id(), $widget );
    }
  }

  /**
   * Returns an array of admin pages this component registers.
   *
   * Names of the pages must equal the page's file names. All files must be
   * located inside the component's folder.
   *
   * @return array
   *   Array of admin pages.
   */
  protected function admin_pages() {
    return array();
  }

  /**
   * Returns an array of admin styles this component registers.
   *
   * Names of the pages must equal the styles' file names. All files must be
   * located inside the component's folder.
   *
   * @return array
   *   Array of admin styles.
   */
  protected function admin_styles() {
    return array();
  }

  /**
   * Returns an array of buddypress group extensions this component registers.
   *
   * Names of the group extensions must equal the post type's file names. All
   * files must be located inside the component's folder.
   *
   * @return array
   *   Array of group extensions.
   */
  protected function group_extensions() {
    return array();
  }


  /**
   * Returns an array of post types this component registers.
   *
   * Names of the post types must equal the post type's file names. All files
   * must be located inside the component's folder.
   *
   * @return array
   *   Array of post types.
   */
  protected function post_types() {
    return array();
  }

  /**
   * Returns an array of taxonomies this component registers.
   *
   * Names of the taxonomies must equal the taxonomy's file names. All files
   * must be located inside the component's folder.
   *
   * @return array
   *   Array of taxonomies.
   */
  protected function taxonomies() {
    return array();
  }

  /**
   * Returns an array of widgets this component registers.
   *
   * Names of the widgets must equal the widget's file names. All files must be
   * located inside the component's folder.
   *
   * @return array
   *   Array of widgets.
   */
  protected function widgets() {
    return array();
  }

  /**
   * Returns an array of includes this component registers.
   *
   * @return array
   *   Array of includes.
   */
  protected function includes() {
    return array();
  }

  /**
   * Returns an array of settings for this component.
   *
   * Settings will be added as separate sections inside the clanpress
   * settings page. All settings must be added using the clanpress form
   * api. Check the linked function for details.
   *
   * @return array
   *   Array of form elements.
   *
   * @see Clanpress_Form::element()
   */
  protected function settings() {
    return array();
  }

  /**
   * Can be overridden to add a human readable name to this component.
   *
   * @return string
   *   Name of the component.
   */
  protected function name() {
    return $this->id();
  }

  /**
   * Can be overridden to add a description to this component.
   *
   * @return string
   *   Description text.
   */
  protected function description() {
    return __( 'N/A', 'clanpress' );
  }

  /**
   * Returns the id of the current component.
   *
   * @return string
   *   Id of the component
   */
  protected function id() {
    return Clanpress_Helper::get_id( get_called_class(), 'component' );
  }
}
