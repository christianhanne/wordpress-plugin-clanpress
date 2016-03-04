<?php
/**
 * Contains the parent class of the plugin's custom post types.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Post_Type
 */
class Clanpress_Post_Type {
  /**
   * Holds an array of all the post's metaboxes.
   * @var array
   */
  protected $meta_boxes = array();

  /**
   * Registers a new post type with the name of the class.
   */
  function __construct() {
    $args = (array) $this->settings();
    $args['labels'] = (array) $this->labels();
    register_post_type( $this->id(), $args );

    add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    add_filter( 'single_template', array( $this, 'single_template' ) );
    add_filter( 'archive_template', array( $this, 'archive_template' ) );

    $this->add_meta_boxes();
  }

  /**
   * Registers all defined meta boxes for this post type.
   */
  public function add_meta_boxes() {
    foreach ( $this->meta_boxes() as $id => $settings ) {
      $meta_box = new Clanpress_Meta_Box($id, $this->id(), $settings);
      $this->meta_boxes[ $id ] = $meta_box;
    }
  }

  /**
   * Handles storage logic for all defined meta boxes.
   */
  public function save_meta_boxes( $post_id ) {
    // TODO: Check user permissions.
    foreach ($this->meta_boxes as $meta_box) {
      $instance = isset( $_POST[ $meta_box->id() ] ) ? $_POST[ $meta_box->id() ] : array();
      $meta_box->save($post_id, $instance);
    }
  }

  /**
   * Returns the correct path for a single post template.
   *
   * @param string|null $template
   *   Original template path.
   *
   * @return string
   *   Updated template path.
   */
  public static function single_template( $template = null ) {
    return self::get_post_template( $template, 'single' );
  }

  /**
   * Returns the correct path for an archive template.
   *
   * @param string|null $template
   *   Original template path.
   *
   * @return string
   *   Updated template path.
   */
  public static function archive_template( $template = null ) {
    return self::get_post_template( $template, 'archive' );
  }

  /**
   * Includes a post type's content template.
   *
   * @param string $type
   *   Display type, either 'single' or 'archive'.
   * @param string $post_type
   *   The post type.
   */
  public static function content_template( $type, $post_type ) {
    $class = self::get_class_name( $post_type );
    if ( $type === 'archive' ) {
      $params = $class::archive_elements( get_post() );
    }
    else {
      $params = $class::single_elements( get_post() );
    }

    foreach ($params as $key => $value) {
      set_query_var( $key, $value );
    }

    $component = Clanpress_Helper::get_component_by_class( get_called_class() );
    $post_type = str_replace( '_', '-', $post_type );
    $template_name = $type . '-content-' . $post_type . '.php';

    $templates = array(
      trailingslashit( get_stylesheet_directory() ) . $template_name,
      trailingslashit( get_stylesheet_directory() ) . 'clanpress/' . $template_name,
      trailingslashit( get_template_directory() ) . $template_name,
      trailingslashit( get_template_directory() ) .'clanpress/' . $template_name,
      Clanpress_Helper::get_templates_path( $component ) . $template_name,
    );

    foreach ( $templates as $template ) {
      if ( file_exists( $template ) ) {
        load_template( $template, false );
        break;
      }
    }
  }

  /**
   * Returns an array of settings for the custom post type.
   *
   * Should be overwritten by the post types extending this class. If no array
   * is returned or the returned array is empty, no custom settings will be
   * added. Check the linked documentation for details. Please notice: Labels
   * should be defined in a separate function.
   *
   * @return array
   *   An array of settings for this post type
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  protected function settings() {
    return array();
  }

  /**
   * Returns an array of labels for the custom post type.
   *
   * Should be overwritten by the post types extending this class. If no array
   * is returned or the returned array is empty, no custom labels will be added.
   *
   * @return array
   *   An array of labels for this post type
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  protected function labels() {
    return array();
  }

  /**
   * Returns an array of meta boxes.
   *
   * Should be overwritten by the post types extending this class. If no array
   * is returned or the returned array is empty, no custom meta boxes will be added.
   *
   * @return array
   *   An array of meta boxes
   */
  protected function meta_boxes() {
    return array();
  }

  /**
   * Returns an array of template elements.
   *
   * Should return an associative array of template elements/variables. Every
   * element in the array will be available in the post's archive template
   * through a variable with the same name as the array key.
   *
   * @param WP_Post $post
   *   The post object.
   *
   * @return array
   *   Array of archive template elements
   */
  protected static function archive_elements($post) {
    return array();
  }

  /**
   * Returns an array of template elements.
   *
   * Should return an associative array of template elements/variables. Every
   * element in the array will be available in the post's single template
   * through a variable with the same name as the array key.
   *
   * @param WP_Post $post
   *   The post object.
   *
   * @return array
   *   Array of single template elements
   */
  protected static function single_elements($post) {
    return array();
  }

  /**
   * Returns the correct template for the given template type.
   *
   * @param string|null $template
   *   Original template path.
   * @param string $type
   *   Template type.
   *
   * @return string
   *   Updated template path.
   *
   * @TODO Check if this is obsolete.
   */
  final private static function get_post_template( $template = null, $type ) {
    global $post;
    if ( $post->post_type == self::id() || $template === null ) {
      $template_name = self::post_template_name( $type );
      $template_dir = Clanpress_Helper::get_templates_path( Clanpress_Helper::DEFAULT_COMPONENT );

      $suggestions = array(
        get_stylesheet_directory() . '/' . $template_name,
        get_stylesheet_directory() . '/clanpress/' . $template_name,
        $template_dir . $template_name,
      );

      foreach ( $suggestions as $suggestion ) {
        if ( file_exists( $suggestion ) ) {
          return $suggestion;
        }
      }
    }

    return $template;
  }

  /**
   * Returns the template's file name for this post type.
   *
   * @param string $type
   *   Template type.
   *
   * @return string
   *   Template's file name.
   */
  final private static function post_template_name( $type ) {
    return $type . '-clanpress.php';
  }

  /**
   * Returns previously stored meta data for the given post id.
   *
   * @param int $post_id
   *   The post id.
   * @param string $meta_box
   *   The meta box id.
   * @param string $field
   *   The field id.
   *
   * @return mixed
   *   Returns the stored post meta value or null if not found.
   */
  final public static function get_post_value($post_id, $meta_box, $field) {
    $meta_boxes = self::meta_boxes();
    if ( !isset( $meta_boxes[ $meta_box ] ) ) {
      return null;
    }

    $instance = new Clanpress_Meta_Box( $meta_box, self::id(), $meta_boxes[ $meta_box ] );
    $meta = $instance->get_meta( $post_id );

    return isset( $meta[ $field ] ) ? $meta[ $field ] : null;
  }

  /**
   * Returns the class name for a given post type id.
   *
   * @param string $post_type
   *   The post type id.
   *
   * @return string
   *   Post type's class name.
   *
   * @TODO Use helper function instead.
   */
  final public static function get_class_name( $post_type ) {
    $class = ucwords(str_replace('_', ' ', $post_type));
    $class = str_replace(' ', '_', $class);
    $class .= '_Post_Type';
    return $class;
  }

  /**
   * Returns the machine-readable id of the post type.
   *
   * The id is currently equivalent to the class name in lower case.
   * The "post_type" suffix will be removed, because of WordPress name
   * length restriction. Post types extending this class should not overwrite
   * this function.
   *
   * @return string
   *   Machine-readable id of the post type
   *
   * @TODO Use helper function instead.
   */
  final protected static function id() {
    $id = strtolower( get_called_class() );
    $id = str_replace( '_post_type', '', $id );
    return $id;
  }
}
