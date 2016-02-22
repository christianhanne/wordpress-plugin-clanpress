<?php
/**
 * Contains basic helper functions for various purposes.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Helper
 */
class Clanpress_Helper {
  /**
   * Registers a new page with the given name.
   *
   * This function includes a file with the page's name. This file has
   * to contain a function named "Clanpress_[Page]_Page.
   * [Page] should be replaced by the actual name of the post type in
   * upper camelcase. This class has to extend the Clanpress_Page class.
   *
   * Please note that this function does no sanitization nor checks on
   * the widget name, so it should be used with caution.
   *
   * @param string $component
   *   Id of the component.
   * @param string $page
   *   Machine-readable name of page.
   *
   * @see Clanpress_Page
   */
  public static function register_page( $component, $page ) {
    require_once( self::get_pages_path( $component ) . self::normalize( $page ) . '.php' );
    $page_class = 'Clanpress_' . ucwords( $page ) . '_Page';
    new $page_class();
  }

  /**
  * Registers a new style with the given name
  *
  * @param string $component
  *   Id of the component.
  * @param string $style
  *   Filename of the style.
   */
  public static function register_style( $component, $style ) {
    $styles_uri = self::get_styles_uri( $component ) . $style . '.min.css';
    wp_enqueue_style( $component . '_' . $style, $styles_uri );
  }

  /**
  * Registers an include file.
  *
  * @param string $component
  *   Id of the component.
  * @param string $include
  *   Filename of the include.
   */
  public static function register_include( $component, $include ) {
    require_once( self::get_includes_path( $component ) . self::normalize( $include ) . '.php' );
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
   * the widget name, so it should be used with caution.
   *
   * @param string $component
   *   Id of the component.
   * @param string $post_type
   *   Machine-readable name of post type
   *
   * @see Clanpress_Post_Type
   */
  public static function register_post_type( $component, $post_type ) {
    require_once( self::get_post_types_path( $component ) . self::normalize( $post_type ) . '.php' );
    $post_type_class = 'Clanpress_' . ucwords( $post_type ) . '_Post_Type';
    new $post_type_class();
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
   * the widget name, so it should be used with caution.
   *
   * @param string $component
   *   Id of the component.
   * @param string $taxonomy
   *   Machine-readable name of taxonomy
   *
   * @see Clanpress_Taxonomy
   */
  public static function register_taxonomy( $component, $taxonomy ) {
    require_once( self::get_taxonomies_path( $component ) . self::normalize( $taxonomy ) . '.php' );
    $taxonomy_class = 'Clanpress_' . ucwords( $taxonomy ) . '_Taxonomy';
    new $taxonomy_class();
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
   * the widget name, so it be used with caution.
   *
   * @param string $component
   *   Id of the component.
   * @param string $widget
   *   Machine-readable name of widget
   *
   * @see Clanpress_Widget
   */
  public static function register_widget( $component, $widget ) {
    require_once( self::get_widgets_path( $component ) . self::normalize( $widget ) . '.php' );
    register_widget( 'Clanpress_' . ucwords( $widget ) . '_Widget' );
  }

  /**
   * Returns the path of the given component.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   *
   * @return string
   *   Path of the component.
   */
  public static function get_component_path( $component ) {
    return CLANPRESS_PLUGIN_PATH . 'components/' . $component . '/';
  }

  /**
   * Returns the path of the plugin's post types directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Post types directory path.
   */
  public static function get_post_types_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'post-types/';
  }

  /**
   * Returns the path of the plugin's taxonomies directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Taxonomies directory path.
   */
  public static function get_taxonomies_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'taxonomies/';
  }

  /**
   * Returns the path of the plugin's widgets directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Widgets directory path.
   */
  public static function get_widgets_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'widgets/';
  }

  /**
   * Returns the path of the plugin's admin pages directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Pages directory path.
   */
  public static function get_pages_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'pages/';
  }

  /**
   * Returns the path of the plugin's includes directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Includes directory path.
   */
  public static function get_includes_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'includes/';
  }

  /**
   * Returns the path of the plugin's templates directory.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   * @return string
   *   Templates directory path.
   */
  public static function get_templates_path( $component ) {
    $component_path = self::get_component_path( $component );
    return $component_path . 'templates/';
  }

  /**
   * Returns the path to the modes directory.
   *
   * @return string
   *   Path to the modes directory.
   */
  public static function get_modes_path() {
    return CLANPRESS_PLUGIN_PATH . 'modes/';
  }

  /**
   * Returns an uri for a specific library.
   *
   * @param string $library
   *   Folder name of the library to include.
   *
   * @return string
   *   Uri of the library.
   */
  public static function get_library_uri( $library ) {
    return CLANPRESS_PLUGIN_URL . 'dist/vendor/' . $library;
  }

  /**
   * Returns an uri for the styles folder.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   *
   * @return string
   *   Uri of the styles folder.
   */
  public static function get_styles_uri( $component ) {
    return CLANPRESS_PLUGIN_URL . 'dist/css/' . $component . '/';
  }

  /**
   * Returns an uri for the scripts folder.
   *
   * @param string $component
   *   Name of the component. Must equal it's id.
   *
   * @return string
   *   Uri of the scripts folder.
   */
  public static function get_scripts_uri( $component ) {
    return CLANPRESS_PLUGIN_URL . 'dist/js/' . $component . '/';
  }

  /**
   * Returns an uri for the assets folder.
   *
   * @return string
   *   Uri of the scripts folder.
   */
  public static function get_assets_path() {
    return CLANPRESS_PLUGIN_URL . 'assets/';
  }

  /**
   * Extracts the component name from a given file path.
   *
   * @param string $path
   *   Raw filepath from inside a components folder.
   *
   * @return string
   *   Id of the component.
   */
  public static function get_component_by_path( $path ) {
    preg_match('/components\/(.*)\//Ui', $path, $matches);
    return $matches[1];
  }

  /**
   * Normalizes a filename for use in am require statement.
   *
   * @param string $filename
   *   Raw filename.
   *
   * @return string
   *   Normalized filename.
   */
  public static function normalize( $filename ) {
    return preg_replace( '/[^a-z\d-]/i', '-', $filename );
  }
}
