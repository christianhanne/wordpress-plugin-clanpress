<?php
/**
 * Contains the parent class for buddy group extensions.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Group_Extension
 */
class Clanpress_Group_Extension extends BP_Group_Extension {
  /**
   * Creates a new buddypress group extension with the given settings.
   *
   * @see Clanpress_Group_Extension::settings()
   */
  function __construct() {
    $settings = $this->settings();
    if ( count( $settings ) ) {
			$settings['slug'] = $this->id();
      parent::init( $settings );
    }
  }

	/**
	 * Handles the display of the form elements on the group's settings screen.
	 *
	 * Please note that (for some stupid reason) this function has to be added
	 * to the child class also. Otherwise the form elements won't show up. For
	 * convenience add parent::settings_screen() to the child class function.
	 *
	 * @param int|null $group_id
	 *   The group id.
	 *
	 * @TODO: This should be merged into a helper function.
	 */
	public function settings_screen( $group_id = NULL ) {
    foreach ( $this->form_elements() as $id => $element ) {
      $element['field_id'] = $this->id() . '[' . $id . ']';
      $element['field_name'] = $this->id() . '[' . $id . ']';

      if ( Clanpress_Form::is_multi_value( $element ) ) {
        $element['default'] = $this->get_multi_value( $group_id, $id );
      } else {
        $element['default'] = $this->get_single_value( $group_id, $id );
      }

      echo Clanpress_Form::element( $element );
    }
	}

  /**
	 * Handles the storage of the group extensions form elements.
	 *
	 * Please note that (for some stupid reason) this function has to be added
	 * to the child class also. Otherwise the form elements won't show up. For
	 * convenience add parent::settings_screen_save() to the child class function.
	 *
	 * @param int|null $group_id
	 *   The group id.
	 *
	 * @TODO: This should be merged into a helper function.
	 */
	public function settings_screen_save( $group_id = NULL ) {
   	if ( isset( $_POST[ $this->id() ] ) ) {
			$instance = $_POST[ $this->id() ];
      foreach ( $this->form_elements() as $id => $element ) {
        if ( isset( $instance[ $id ] ) &&  Clanpress_Form::is_valid( $element, $instance[ $id ] ) ) {
          if ( Clanpress_Form::is_multi_value( $element ) ) {
            $this->store_multi_value( $group_id, $id, $instance[ $id ] );
          } else {
            $this->store_single_value( $group_id, $id, $instance[ $id ] );
          }
        }
      }
		}
	}

  /**
   * Returns the metaboxes previously saved data.
   *
   * @param int $group_id
   *   The group id.
   *
   * @return array
   *   Array of meta data.
   */
  public static function get_meta( $group_id ) {
    $meta = array();
    foreach ( self::form_elements() as $key => $element ) {
      if ( Clanpress_Form::is_multi_value( $element ) ) {
        $meta[ $key ] = self::get_multi_value( $group_id, $key );
      }
      else {
        $meta[ $key ] = self::get_single_value( $group_id, $key );
      }
    }

    return $meta;
  }

  /**
   * Returns a settings array for the buddypress group extension.
   *
   * Please take a look at the linked website for more details on extension
   * settings. The function should at least return a name value.
   *
   * @return array
   *   Group extension settings array.
   *
   * @link https://codex.buddypress.org/developer/group-extension-api/
   */
  protected function settings() {
    return array();
  }

  /**
   * Returns an array of form elements.
   *
   * Should return an array of form elements for the group extension. The array
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
   * Stores a single value as post meta data.
   *
   * @param int $group_id
   *   The group id.
   * @param string $id
   *   Id of the form field.
   * @param mixed $value
   *   Value to be stored.
   */
  private static function store_single_value($group_id, $id, $value) {
    $value = sanitize_text_field( $value );
    groups_update_groupmeta( $group_id, self::get_field_id( $id ), $value );
  }

  /**
   * Stores multiple values as post meta data.
   *
   * @param int $group_id
   *   The group id.
   * @param string $id
   *   Id of the form field.
   * @param mixed $value
   *   Value to be stored.
   */
  private static function store_multi_value($group_id, $id, $values) {
    foreach ( $values as $key => $value) {
      $value = sanitize_text_field( $value );
      groups_update_groupmeta( $group_id, self::get_field_id( $id ) . '[' . $key . ']', $value );
    }
  }

  /**
   * Handles retrieval for single value fields.
   *
   * @param int $group_id
   *   The group id.
   * @param string $id
   *   Id of the form field.
   *
   * @return mixed
   *   The stored value.
   */
  private static function get_single_value($group_id, $id) {
    return groups_get_groupmeta( $group_id, self::get_field_id( $id ), true );
  }

  /**
   * Handles retrieval of multi-value fields.
   *
   * @param int $group_id
   *   The group id.
   * @param string $id
   *   Id of the form field.
   *
   * @return array
   *   Array of stored values.
   */
  private static function get_multi_value($group_id, $id) {
    $return = array();

    $field_id = self::get_field_id( $id );
    foreach ( groups_get_groupmeta( $group_id, '', true ) as $key => $value) {
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
  private static function get_field_id($id) {
    return self::id() . '[' . $id . ']';
  }

	/**
	 * Returns the id of the given buddypress group extension.
	 *
	 * The id will be used for registering the extension and storing the groups
	 * meta data. The id will be retrieved from the class name and has to be
	 * unique.
	 *
	 * @return string
	 *   Id of the group extension.
	 */
	private static final function id() {
		$class_name = get_called_class();
		return str_replace( '_group_extension', '', strtolower( $class_name ) );
	}
}
