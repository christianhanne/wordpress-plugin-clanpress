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
  }

  /**
   * TODO
   */
  public function add_meta_boxes() {
    $meta_boxes = $this->meta_boxes();
    foreach ( $meta_boxes as $id => $meta_box ) {
      $this->add_meta_box( $id, $meta_box );
    }
  }

  /**
   * TODO
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
   * TODO
   */
  public function render_meta_boxes( $post, $metabox ) {
    $id = $this->extract_meta_box_id( $metabox['id'] );
    $this->render_meta_box( $id, $this->meta_boxes( $post )[ $id ], $post );
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
   * TODO
   *
   * @param string $id
   *   TODO
   * @param array $meta_box
   *   TODO
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
   * TODO
   *
   * @param int $post_id
   *   The ID of the post being saved.
   * @param string $id
   *   TODO
   * @param array $meta_box
   *   TODO
   * @param array $instance
   *   TODO
   */
  final private function save_meta_box( $post_id, $id, $meta_box, $instance ) {
    foreach ( $meta_box['form_elements'] as $key => $element ) {
      if ( Clanpress_Form::is_valid( $element, $instance[ $key ] ) ) {
        $field_id = $this->get_meta_box_id( $id ) . '[' . $key . ']';
        $value = sanitize_text_field( $instance[ $key ] );

        update_post_meta( $post_id, $field_id, $value );
      }
    }
  }

  /**
   * TODO
   *
   * @param string $id
   *   TODO
   * @param array $meta_box
   *   TODO
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
      $element['value'] = get_post_meta( $post->ID, $field_id, true );

      $output .= Clanpress_Form::element( $element );
    }

    echo $output;
  }

  /**
   * TODO
   *
   * @param string $id
   *   TODO
   *
   * @return string
   *   TODO
   */
  final private function get_meta_box_id($id) {
    return $this->id() . '_' . $id;
  }

  /**
   * TODO
   *
   * @param string $id
   *   TODO
   *
   * @return string
   *   TODO
   */
  final private function extract_meta_box_id($meta_box_id) {
    return  str_replace( $this->id() . '_', '', $meta_box_id );
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
  final private function id() {
    $id = strtolower( get_class( $this ) );
    $id = str_replace( '_post_type', '', $id );
    return $id;
  }
}
