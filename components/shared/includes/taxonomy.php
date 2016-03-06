<?php
/**
 * Contains the parent class of the plugin's custom taxonomies.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Taxonomy
 */
class Clanpress_Taxonomy {
  /**
   * Registers a new taxonomy with the name of the class.
   *
   * @param bool $register
   *   Flag can be used to skip registration process.
   */
  function __construct($register = true) {
    if ( $register === true ) {
      $post_types = $this->post_types();
      if ( count( $post_types ) ) {
        $args = (array) $this->settings();
        $args['labels'] = (array) $this->labels();
        register_taxonomy( $this->id(), $post_types, $args );

        add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
        add_action( 'parent_file', array( $this, 'register_parent_file' ) );

        if ( count( $this->form_elements() ) ) {
          add_action( $this->id() . '_add_form_fields', array( $this, 'term_add') );
          add_action( $this->id() . '_edit_form_fields', array( $this, 'term_edit') );
          add_action( 'create_' . $this->id() , array( $this, 'term_save') );
          add_action( 'edited_' . $this->id() , array( $this, 'term_save') );
          add_action( 'pre_delete_term', 'term_delete' );

          add_filter( 'manage_edit-' . $this->id() . '_columns', array( $this, 'admin_table_thead' ) );
          add_filter( 'manage_' . $this->id() . '_custom_column', array( $this, 'admin_table_column' ) );
        }
      }
    }
  }

  /**
   * Registers taxonomy as submenu page of plugin menu item.
   */
  public static function register_admin_page() {
    $class_name = get_called_class();
    $class = new $class_name( false );
    $labels = $class->labels();

    add_submenu_page(
      'clanpress',
      $labels['name'],
      $labels['name'],
      'edit_others_posts', // TODO: Use correct capability_type.
      'edit-tags.php?taxonomy=' . $class->id()
    );
  }

  /**
   * Filter the parent file of an admin menu sub-menu item.
   *
   * @param string $parent_file
   *   The parent file.
   *
   * @return string
   *   The updated parent file.
   */
  public static function register_parent_file( $parent_file ) {
    global $current_screen;
	  if ( $current_screen->taxonomy == self::id() ) {
      $parent_file = 'clanpress';
    }

    return $parent_file;
  }

  /**
   * Adds custom field to the term creation form.
   */
  public function term_add() {
    foreach ( $this->form_elements() as $key => $element ) {
      $field_id = $this->id() . '_' . $key;

      $element['field_id'] = $field_id;
      $element['field_name'] = $field_id;

      echo Clanpress_Form::element($element);
    }
  }

  /**
   * Adds custom form fields to the term edit form.
   *
   * @param object $term
   *   The wordpress term object.
   */
  public function term_edit( $term ) {
    $term_meta = $this->get_term_meta( $term->term_id );
    foreach ( $this->form_elements() as $key => $element ) {
      $field_id = $this->id() . '_' . $key;

      if ( isset( $term_meta[ $field_id ] )) {
        $element['value'] = $term_meta[ $field_id ];
      }

      $element['field_id'] = $field_id;
      $element['field_name'] = $field_id;

      $element['template'] = '<tr><th>$label</th><td>$field$description</td></tr>';

      echo Clanpress_Form::element($element);
    }
  }

  /**
   * Stores values for all custom form fields.
   *
   * @param int $term_id
   *   The term's storage id.
   */
  public function term_save( $term_id ) {
    $values = array();

    $instance = isset( $_POST ) ? $_POST : array();
    foreach ( $this->form_elements() as $key => $element ) {
      $field_id = $this->id() . '_' . $key;
      if ( Clanpress_Form::is_valid( $element, $instance[ $field_id ] ) ) {
        if ( Clanpress_Form::is_multi_value( $element ) ) {
          $value = $instance[ $field_id ];
          array_walk( $value, 'sanitize_text_field' );
        } else {
          $value = sanitize_text_field( $instance[ $field_id ] );
        }

        $values[ $field_id ] = $value;
      }
    }

    $this->save_term_meta( $term_id, $values );
  }

  /**
   * Cleans up all meta data before term gets deleted.
   *
   * @param int $term_id
   *   The term's storage id.
   * @param string $taxonomy
   *   Name of the taxonomy.
   */
  public function term_delete( $term_id, $taxonomy ) {
    if ( $this->id() === $taxonomy ) {
      $this->delete_term_meta( $term_id );
    }
  }

  /**
   * Returns the term's stored meta data.
   *
   * @param int $term_id
   *   The term's storage id.
   *
   * @return array
   *   Array of term meta data.
   */
  public static function get_term_meta( $term_id ) {
    return get_option( self::id() . '_' . $term_id, array() );
  }

  /**
   * Overwrite columns for taxonomy's admin table.
   *
   * @param array $columns
   *   Array of table columns.
   *
   * @return array
   *   Edited array of table columns.
   */
  public function admin_table_thead( $columns ) {
    return $columns;
  }

  /**
   * Overwrite output of taxonomy's admin table column.
   *
   * @param string $output
   *   Original html output of the column.
   * @param string $column
   *   Name of the column.
   * @param int $term_id
   *   The term id.
   *
   * @return string
   *   Edited column output.
   */
  public function admin_table_column( $output, $column, $term_id ) {
    return 'TODO' . $output;
  }

  /**
   * Stores the term's meta data.
   *
   * @param int $term_id
   *   The term's storage id.
   * @param array $values
   *   Array with new meta data values.
   */
  private function save_term_meta( $term_id, $values ) {
    $term_meta = $this->get_term_meta( $term_id );
    foreach ( $values as $key => $value ) {
      $term_meta[ $key ] = $value;
    }

    update_option( $this->id() . '_' . $term_id, $term_meta );
  }

  /**
   * Deletes the term's stored meta data.
   *
   * @param int $term_id
   *   The term's storage id.
   */
  private function delete_term_meta( $term_id ) {
    delete_option( $this->id() . '_' . $term_id );
  }

  /**
   * Returns an array of settings for the custom taxonomy.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, no custom settings will be
   * added. Check the linked documentation for details. Please notice: Labels
   * should be defined in a separate function.
   *
   * @return array
   *   An array of settings for this taxonomy
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function settings() {
    return array();
  }

  /**
   * Returns an array of labels for the custom taxonomy.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, no custom labels will be added.
   *
   * @return array
   *   An array of labels for this taxonomy
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function labels() {
    return array();
  }

  /**
   * Returns an array of post types this taxonomy should be used in.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, taxonomy won't be added.
   *
   * @return array
   *   Array of post types
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function post_types() {
    return array();
  }

  /**
   * Returns an array of form elements.
   *
   * Should return an array of form elements for taxonomy forms. The array
   * should consist of the form element ids as key and the element settings
   * as values. For details on element settings check the linked function.
   *
   * @return array
   *   Array of form elements for widget forms.
   *   Eg. array('title' => $element, 'num_items' => $element)
   *
   * @see Clanpress_Form::element()
   */
  protected function form_elements() {
    return array();
  }

  /**
   * Returns the machine-readable id of the taxonomy.
   *
   * The id is currently equivalent to the class name in lower case.
   * The "taxonomy" suffix will be removed, because of WordPress name
   * length restriction. Taxonomies extending this class should not overwrite
   * this function.
   *
   * @return string
   *   Machine-readable id of the taxonomy
   */
  final private static function id() {
    $id = strtolower( get_called_class() );
    $id = str_replace( '_taxonomy', '', $id );
    return $id;
  }
}
