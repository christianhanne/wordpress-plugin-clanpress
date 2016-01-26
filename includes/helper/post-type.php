<?php
/**
 * @file
 * Contains the parent class of the plugin's custom post types.
 *
 * @author Christian Hanne <support@aureola.codes>
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
      array_push($this->meta_boxes, $meta_box);
    }
  }

  /**
   * Handles storage logic for all defined meta boxes.
   */
  public function save_meta_boxes( $post_id ) {
    // TODO: Check user permissions.

    foreach ($this->meta_boxes as $meta_box) {
      $instance = isset( $_POST[ $meta_box->id() ] ) ? $_POST[ $meta_box->id() ] : NULL;
      $meta_box->save($post_id, $instance);
    }
  }

  /**
   * Returns the correct path for a single post template.
   *
   * @param string $template
   *   Original template path.
   *
   * @return string
   *   Updated template path.
   */
  public static function single_template( $template ) {
    return self::get_template( $template, 'single' );
  }

  /**
   * Returns the correct path for an archive template.
   *
   * @param string $template
   *   Original template path.
   *
   * @return string
   *   Updated template path.
   */
  public static function archive_template( $template ) {
    return self::get_template( $template, 'archive' );
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
   * Returns the correct template for the given template type.
   *
   * @param string $template
   *   Original template path.
   * @param string $type
   *   Template type.
   *
   * @return string
   *   Updated template path.
   */
  final private static function get_template( $template, $type ) {
    global $post;
    if ( $post->post_type == self::id() ) {
      $template_name = self::template_name( $type );
      $template_dir = CLANPRESS_PLUGIN_PATH . 'templates/post-types/';
      if ( $template !== get_stylesheet_directory() . '/' . $template_name ) {
        return $template_dir . $template_name;
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
  final private static function template_name( $type ) {
    $template_name = $type . '-' . str_replace( '_', '-', self::id() ) . '.php';
    return $template_name;
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
   */
  final private static function id() {
    $id = strtolower( get_called_class() );
    $id = str_replace( '_post_type', '', $id );
    return $id;
  }
}
