<?php
/**
 * Contains the parent class for buddy group extensions.
 *
 * @author Christian Hanne <support@aureola.codes>
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
	 */
	public function settings_screen( $group_id = NULL ) {
		$instance = groups_get_groupmeta( $group_id, $this->id() );

    // TODO: This should be merged into a helper function.
    foreach ( $this->form_elements() as $id => $element ) {
      $element['field_id'] = $this->id() . '[' . $id . ']';
      $element['field_name'] = $this->id() . '[' . $id . ']';

      if ( isset( $instance[ $id ] ) ) {
        $element['default'] = $instance[ $id ];
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
	 */
	public function settings_screen_save( $group_id = NULL ) {
		$instance = groups_get_groupmeta( $group_id, $this->id() );
    if ( empty( $instance ) ) {
      $instance = array();
    }

    // TODO: This should be merged into a helper function.
   	if ( isset( $_POST[ $this->id() ] ) ) {
			$new_instance = $_POST[ $this->id() ];

      foreach ( $this->form_elements() as $id => $element ) {
        if ( isset( $new_instance[ $id ] ) &&  Clanpress_Form::is_valid( $element, $new_instance[ $id ] ) ) {
          $field_id = $this->id() . '[' . $id . ']';
          if ( Clanpress_Form::is_multi_value( $element ) ) {
            array_walk( $new_instance[ $id ], 'sanitize_text_field' );
            $instance[ $id ] = $new_instance[ $id ];
          } else {
            $instance[ $id ] = sanitize_text_field( $new_instance[ $id ] );
          }
        }
      }
		}

		groups_update_groupmeta( $group_id, $this->id(), $instance );
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
	 * Returns the id of the given buddypress group extension.
	 *
	 * The id will be used for registering the extension and storing the groups
	 * meta data. The id will be retrieved from the class name and has to be
	 * unique.
	 *
	 * @return string
	 *   Id of the group extension.
	 */
	private final function id() {
		$class_name = get_called_class();
		return str_replace( 'group_extension', '', strtolower( $class_name ) );
	}
}
