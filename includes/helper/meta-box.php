<?php
/**
 * @file
 * Contains the controller class for post type metaboxes.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Meta_Box
 */
class Clanpress_Meta_Box {
  /**
   * Holds the meta boxes' unique id.
   * @var string
   */
  protected $id = NULL;

  /**
   * Holds the meta boxes' associated post type.
   * @var string
   */
  protected $post_type = NULL;

  /**
   * Holds the meta boxes' settings array.
   * @var array
   */
  protected $settings = array();

  /**
   * Registers the given metabox for the custom post type.
   *
   * @param string $id
   *   Metabox id. Might not be unique.
   * @param string $post_type
   *   Post type's unique id.
   * @param string $settings
   *   Metabox settings array.
   */
  function __construct($id, $post_type, $settings) {
    if ( !isset( $settings['title'] ) || !isset( $settings['form_elements'] ) ) {
      return;
    }

    $this->id = $id;
    $this->post_type = $post_type;
    $this->settings = $settings;

    add_action( 'add_meta_boxes', array( $this, 'register' ) );
  }

  /**
   * Registers the given metabox.
   */
  public function register() {
    add_meta_box(
      $this->id(),
      $this->settings['title'],
      array( $this, 'render' ),
      array( $this->post_type ),
      isset( $this->settings['context'] ) ? $this->settings['context'] : NULL,
      isset( $this->settings['priority'] ) ? $this->settings['priority'] : NULL
    );
  }

  /**
   * Handles storage logic for the given metabox.
   *
   * @param int $post_id
   *   The ID of the post being saved.
   * @param array $instance
   *   POST values specific to this metabox.
   */
  public function save($post_id, $instance = array()) {
    foreach ( $this->settings['form_elements'] as $key => $element ) {
      if ( isset( $instance[ $key ] ) &&  Clanpress_Form::is_valid( $element, $instance[ $key ] ) ) {
        $field_id = $this->id() . '[' . $key . ']';

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
   * @param WP_Post $post
   *   The post object.
   */
  public function render($post) {
    $field_id = $this->id() . '[nonce]';
    wp_nonce_field($this->id(), $field_id );

    $meta_data = $this->get_meta( $post->ID );

    $output = '';
    foreach ( $this->settings['form_elements'] as $key => $element ) {
      $field_id = $this->id() . '[' . $key . ']';

      $element['field_id'] = $field_id;
      $element['field_name'] = $field_id;

      $value_raw = $meta_data[ $key ];
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
   * Returns the metaboxes previously saved data.
   *
   * @param int $post_id
   *   The post id.
   *
   * @return array
   *   Array of meta data.
   */
  public function get_meta( $post_id ) {
    $meta = array();
    foreach ( $this->settings['form_elements'] as $key => $element ) {
      $field_id = $this->id() . '[' . $key . ']';
      $meta[ $key ] = get_post_meta( $post_id, $field_id, true );
    }

    return $meta;
  }

  /**
   * Returns the metaboxes' unique id.
   *
   * @return string
   *   Metabox id.
   */
  public function id() {
    return $this->post_type . '_' . $this->id;
  }
}
