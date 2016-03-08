<?php
/**
 * Contains the controller class for post type metaboxes.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * TODO
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
        if ( Clanpress_Form::is_multi_value( $element ) ) {
          $this->store_multi_value( $post_id, $key, $instance[ $key ] );
        } else {
          $this->store_single_value( $post_id, $key, $instance[ $key ] );
        }
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
      $element['value'] = $meta_data[ $key ];

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
      if ( Clanpress_Form::is_multi_value( $element ) ) {
        $meta[ $key ] = $this->get_multi_value( $post_id, $key );
      }
      else {
        $meta[ $key ] = $this->get_single_value( $post_id, $key );
      }
    }

    return $meta;
  }

  /**
   * Stores a single value as post meta data.
   *
   * @param int $post_id
   *   The post id.
   * @param string $id
   *   Id of the form field.
   * @param mixed $value
   *   Value to be stored.
   */
  private function store_single_value($post_id, $id, $value) {
    $value = sanitize_text_field( $value );
    update_post_meta( $post_id, $this->get_field_id( $id ), $value );
  }

  /**
   * Stores multiple values as post meta data.
   *
   * @param int $post_id
   *   The post id.
   * @param string $id
   *   Id of the form field.
   * @param mixed $value
   *   Value to be stored.
   */
  private function store_multi_value($post_id, $id, $values) {
    foreach ( $values as $key => $value) {
      $value = sanitize_text_field( $value );
      update_post_meta( $post_id, $this->get_field_id( $id ) . '[' . $key . ']', $value );
    }
  }

  /**
   * Handles retrieval for single value fields.
   *
   * @param int $post_id
   *   The post id.
   * @param string $id
   *   Id of the form field.
   *
   * @return mixed
   *   The stored value.
   */
  private function get_single_value($post_id, $id) {
    return get_post_meta( $post_id, $this->get_field_id( $id ), true );
  }

  /**
   * Handles retrieval of multi-value fields.
   *
   * @param int $post_id
   *   The post id.
   * @param string $id
   *   Id of the form field.
   *
   * @return array
   *   Array of stored values.
   */
  private function get_multi_value($post_id, $id) {
    $return = array();

    $field_id = $this->get_field_id( $id );
    foreach ( get_post_meta( $post_id, '', true ) as $key => $value) {
      if ( strpos( $key, $field_id ) !== FALSE ) {
        $storage_key = str_replace( array( $field_id, '[', ']' ), '', $key);
        if ( !empty($storage_key) ) {
          $return[ $storage_key ] = is_array( $value ) ? current( $value ) : $value;
        }
      }
    }

    return $return;
  }

  /**
   * Returns the field id as defined in the post variables.
   *
   * @param string $id
   *   Id of the form field.
   *
   * @return string
   *   Field id.
   */
  private function get_field_id($id) {
    return $this->id() . '[' . $id . ']';
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
