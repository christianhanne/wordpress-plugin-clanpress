<?php
/**
 * @file
 * Contains the main class of the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress
 */
class Clanpress {
  /**
   * @const string
   * Holds the Clanpress' widgets directory path.
   */
  const WIDGETS_PATH = CLANPRESS_PLUGIN_PATH . 'widgets/';

  /**
   * @const string
   * Holds the Clanpress' post types directory path.
   */
  const POST_TYPES_PATH = CLANPRESS_PLUGIN_PATH . 'post-types/';

  /**
   * Initializes the plugin's behavior.
   *
   * @see Clanpress::register_widgets()
   * @see Clanpress::register_post_types()
   */
  public function __construct() {
    require_once( CLANPRESS_PLUGIN_PATH . 'classes/form.php' );
    require_once( CLANPRESS_PLUGIN_PATH . 'classes/widget.php' );
    require_once( CLANPRESS_PLUGIN_PATH . 'classes/post-type.php' );

    add_action( 'widgets_init', array( $this, 'register_widgets' ) );
    add_action( 'init', array( $this, 'register_post_types' ) );
  }

  /**
   * Registers all custom widgets of the plugin.
   *
   * @see Clanpress::register_widget()
   */
  public static function register_widgets() {
    self::register_widget( 'latest_awards' );
    self::register_widget( 'latest_matches' );
    self::register_widget( 'members' );
    self::register_widget( 'social_media' );
    self::register_widget( 'sponsors' );
    self::register_widget( 'squads' );
    self::register_widget( 'teamspeak' );
    self::register_widget( 'top_match' );
    self::register_widget( 'upcoming_matches' );
  }

  /**
   * Registers all custom post types of the plugin.
   *
   * @see Clanpress::register_post_type()
   */
  private static function register_post_types() {
    self::register_post_type( 'award' );
    self::register_post_type( 'match' );
    self::register_post_type( 'sponsor' );
    self::register_post_type( 'squad' );
  }

  /**
   * Registers a new post type with the given name.
   *
   * This function includes a file with the post type's name. This file has
   * to contain a function named "Clanpress_[Post_Type]_Post_Type.
   * [Post_Type] should be replaced by the actual name of the post type in
   * upper camelcase. This class has to extend the Clanpress_Post_Type class.
   *
   * Please note that this function does no sanitization nor checks on
   * the widget name, so it should stay private and be used with caution.
   *
   * @param string $post_type
   *   Machine-readable name of post type
   *
   * @see Clanpress_Post_Type
   */
  private static function register_post_type( $post_type ) {
    require_once( self::POST_TYPES_PATH . $post_type . '.php' );
    $post_type_class = 'Clanpress_' . ucwords( $post_type ) . '_Post_Type';
    new $post_type_class();
  }

  /**
   * Registers a new widget with the given name.
   *
   * This function includes a file with the widget's name. This file has
   * to contain a function named "Clanpress_[Widget_Name]_Widget.
   * [Widget_Name] should be replaced by the actual name of the widget in
   * upper camelcase. This class has to extend the Clanpress_Widget class.
   *
   * Please note that this function does no sanitization nor checks on
   * the widget name, so it should stay private and be used with caution.
   *
   * @param string $widget
   *   Machine-readable name of widget
   *
   * @see Clanpress_Widget
   */
  private static function register_widget( $widget ) {
    require_once( self::WIDGETS_PATH . $widget . '.php' );
    register_widget( 'Clanpress_' . ucwords( $widget ) . '_Widget' );
  }
}
