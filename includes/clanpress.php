<?php
/**
 * @file
 * Contains the main class of the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress
 */
class Clanpress {
  /**
   * Initializes the plugin's behavior.
   */
  public function __construct() {
    require_once( self::get_helper_path() . 'functions.php' );
    require_once( self::get_helper_path() . 'form.php' );
    require_once( self::get_helper_path() . 'helper.php' );
    require_once( self::get_helper_path() . 'meta-box.php' );
    require_once( self::get_helper_path() . 'page.php' );
    require_once( self::get_helper_path() . 'post-type.php' );
    require_once( self::get_helper_path() . 'taxonomy.php' );
    require_once( self::get_helper_path() . 'widget.php' );

    add_action( 'init', array( $this, 'register_post_types' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'admin_init', array( $this, 'register_admin_styles' ) );
    add_action( 'admin_menu', array( $this, 'register_admin_pages' ) );
    add_action( 'widgets_init', array( $this, 'register_widgets' ) );
  }

  /**
   * Registers all main admin menu pages.
   *
   * @see Clanpress::register_admin_page()
   */
  public static function register_admin_pages() {
    self::register_admin_page( 'clanpress' );
    self::register_admin_page( 'dashboard' );
    self::register_admin_page( 'settings' );
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
    self::register_widget( 'teamspeak_status' );
    self::register_widget( 'teamspeak_viewer' );
    self::register_widget( 'top_match' );
    self::register_widget( 'upcoming_matches' );
  }

  /**
   * Registers all custom post types of the plugin.
   *
   * @see Clanpress::register_post_type()
   */
  public static function register_post_types() {
    self::register_post_type( 'award' );
    self::register_post_type( 'match' );
    self::register_post_type( 'sponsor' );
    self::register_post_type( 'squad' );

    // For some reason this is necessary to get the plugin's slugs to work.
    flush_rewrite_rules();
  }

  /**
   * Registers all custom taxonomies of the plugin.
   *
   * @see Clanpress::register_taxonomy()
   */
  public static function register_taxonomies() {
    self::register_taxonomy( 'game' );
    self::register_taxonomy( 'opponent' );
  }

  /**
   * Registers stylesheets for admin pages.
   */
  public static function register_admin_styles() {
    wp_enqueue_style( 'clanpress', self::get_styles_uri() . '/backend.min.css' );
  }

  /**
   * Registers a new page with the given name.
   *
   * This function includes a file with the page's name. This file has
   * to contain a function named "Clanpress_[Page]_Page.
   * [Page] should be replaced by the actual name of the post type in
   * upper camelcase. This class has to extend the Clanpress_Page class.
   *
   * Please note that this function does no sanitization nor checks on
   * the widget name, so it should stay private and be used with caution.
   *
   * @param string $page
   *   Machine-readable name of page.
   *
   * @see Clanpress_Page
   */
  private static function register_admin_page( $page ) {
    require_once( self::get_admin_page_path() . $page . '.php' );
    $page_class = 'Clanpress_' . ucwords( $page ) . '_Page';
    new $page_class();
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
    require_once( self::get_post_types_path() . $post_type . '.php' );
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
    require_once( self::get_widgets_path() . $widget . '.php' );
    register_widget( 'Clanpress_' . ucwords( $widget ) . '_Widget' );
  }

  /**
   * Registers a new taxonomy with the given name.
   *
   * This function includes a file with the taxonomy's name. This file has
   * to contain a function named "Clanpress_[Taxonomy]_Taxonomy.
   * [Taxonomy] should be replaced by the actual name of the taxonomy in
   * upper camelcase. This class has to extend the Clanpress_Taxonomy class.
   *
   * Please note that this function does no sanitization nor checks on
   * the widget name, so it should stay private and be used with caution.
   *
   * @param string $taxonomy
   *   Machine-readable name of taxonomy
   *
   * @see Clanpress_Taxonomy
   */
  private static function register_taxonomy( $taxonomy ) {
    require_once( self::get_taxonomies_path() . $taxonomy . '.php' );
    $taxonomy_class = 'Clanpress_' . ucwords( $taxonomy ) . '_Taxonomy';
    new $taxonomy_class();
  }

  /**
   * Returns the path of the plugin's helper directory.
   *
   * @return string
   *   Helper directory path.
   */
  private static function get_helper_path() {
    return CLANPRESS_PLUGIN_PATH . 'includes/helper/';
  }

  /**
   * Returns the path of the plugin's post types directory.
   *
   * @return string
   *   Post types directory path.
   */
  private static function get_post_types_path() {
    return CLANPRESS_PLUGIN_PATH . 'includes/post-types/';
  }

  /**
   * Returns the path of the plugin's taxonomies directory.
   *
   * @return string
   *   Taxonomies directory path.
   */
  private static function get_taxonomies_path() {
    return CLANPRESS_PLUGIN_PATH . 'includes/taxonomies/';
  }

  /**
   * Returns the path of the plugin's widgets directory.
   *
   * @return string
   *   Widgets directory path.
   */
  private static function get_widgets_path() {
    return CLANPRESS_PLUGIN_PATH . 'includes/widgets/';
  }

  /**
   * Returns the path of the plugin's admin pages directory.
   *
   * @return string
   *   Admin pages directory path.
   */
  private static function get_admin_page_path() {
    return CLANPRESS_PLUGIN_PATH . 'includes/admin/';
  }


  /**
   * Returns the path of the plugin's styles uri.
   *
   * @return string
   *   Styles directory uri.
   */
  private static function get_styles_uri() {
    return CLANPRESS_PLUGIN_URL . 'dist/css';
  }
}
