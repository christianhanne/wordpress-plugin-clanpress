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
   * Registers a new post type with the name of the class.
   */
  function __construct() {
    $args = (array) $this->settings();
    $args['labels'] = (array) $this->labels();
    register_post_type( $this->id(), $args );

    add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
    add_action( 'save_post', array( $this, 'save_meta_boxes' ) );

    add_filter( 'single_template', array( $this, 'single_template' ) );
    add_filter( 'archive_template', array( $this, 'archive_template' ) );
  }

  /**
   * Registers all defined meta boxes for this post type.
   *
   * @see Clanpress_Post_Type::add_meta_box()
   */
  public function add_meta_boxes() {
    $meta_boxes = $this->meta_boxes();
    foreach ( $meta_boxes as $id => $meta_box ) {
      $this->add_meta_box( $id, $meta_box );
    }
  }

  /**
   * Handles storage logic for all defined meta boxes.
   *
   * @see Clanpress_Post_Type::save_meta_box()
   */
  public function save_meta_boxes( $post_id ) {
    // TODO: Check user permissions.

    $meta_boxes = $this->meta_boxes();
    foreach ( $meta_boxes as $id => $meta_box ) {
      $meta_box_id = $this->get_meta_box_id( $id );
      $instance = isset( $_POST[ $meta_box_id ] ) ? $_POST[ $meta_box_id ] : array();
      if ( count( $instance ) ) {
        $this->save_meta_box( $post_id, $id, $meta_box, $instance );
      }
    }
  }

  /**
   * Handles rendering logic for all defined meta boxes.
   *
   * @see Clanpress_Post_Type::render_meta_box()
   */
  public function render_meta_boxes( $post, $metabox ) {
    $id = $this->extract_meta_box_id( $metabox['id'] );
    $this->render_meta_box( $id, $this->meta_boxes( $post )[ $id ], $post );
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
    return self::get_template( $template, 'single');
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
    return self::get_template( $template, 'archive');
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
   * Registers the given metabox for the custom post type.
   *
   * @param string $id
   *   Metabox id.
   * @param array $meta_box
   *   Metabox settings array.
   */
  final private function add_meta_box($id, $meta_box) {
    if ( !isset( $meta_box['title'] ) || !isset( $meta_box['form_elements'] ) ) {
      return;
    }

    add_meta_box(
  		$this->get_meta_box_id( $id ),
  		$meta_box['title'],
  		array( $this, 'render_meta_boxes' ),
  		array( $this->id() ),
      isset( $meta_box['context'] ) ? $meta_box['context'] : NULL,
      isset( $meta_box['priority'] ) ? $meta_box['priority'] : NULL
  	);
  }

  /**
   * Handles storage logic for the given metabox.
   *
   * @param int $post_id
   *   The ID of the post being saved.
   * @param string $id
   *   Metabox id.
   * @param array $meta_box
   *   Metabox settings array.
   * @param array $instance
   *   POST values specific to this metabox.
   */
  final private function save_meta_box( $post_id, $id, $meta_box, $instance ) {
    foreach ( $meta_box['form_elements'] as $key => $element ) {
      if ( Clanpress_Form::is_valid( $element, $instance[ $key ] ) ) {
        $field_id = $this->get_meta_box_id( $id ) . '[' . $key . ']';

        if ( Clanpress_Form::is_multi_value( $element ) ) {
          array_walk( $instance[ $key ], 'sanitize_text_field' );
          $value = json_encode( $instance[ $key ] );
        } else {
          $value = sanitize_text_field( $instance[ $key ] );
        }

        update_post_meta( $post_id, $field_id, $value );
      }
    }
  }

  /**
   * Handles rendering logic for the given metabox.
   *
   * @param string $id
   *   Metabox id.
   * @param array $meta_box
   *   Metabox settings array.
   * @param WP_Post $post
   *   The post object.
   */
  final private function render_meta_box( $id, $meta_box, $post ) {
    $field_id = $this->get_meta_box_id( $id ) . '[nonce]';
    wp_nonce_field($this->get_meta_box_id( $id ), $field_id );

    $output = '';
    foreach ( $meta_box['form_elements'] as $key => $element ) {
      $field_id = $this->get_meta_box_id( $id ) . '[' . $key . ']';

      $element['field_id'] = $field_id;
      $element['field_name'] = $field_id;

      $value_raw = get_post_meta( $post->ID, $field_id, true );
      if ( Clanpress_Form::is_multi_value( $element ) ) {
        $element['value'] = json_decode( $value_raw, true );
      } else {
        $element['value'] = $value_raw;
      }

      $output .= Clanpress_Form::element( $element );
    }

    echo $output;
  }

  /**
   * Returns a metabox id for this post type.
   *
   * @param string $id
   *   Metabox id.
   *
   * @return string
   *   Metabox id for this post type.
   */
  final private function get_meta_box_id($id) {
    return $this->id() . '_' . $id;
  }

  /**
   * Extracts the original metabox id from the customized one.
   *
   * @param string $meta_box_id
   *   Metabox id for this post type.
   *
   * @return string
   *   Metabox id.
   */
  final private function extract_meta_box_id($meta_box_id) {
    return  str_replace( $this->id() . '_', '', $meta_box_id );
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
