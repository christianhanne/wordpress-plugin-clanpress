<?php
/**
 * Contains the parent class for buddy group extensions.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Group_Extension
 */
class Clanpress_Group_Extension extends BP_Group_Extension {
  /**
   * TODO
   */
  function __construct() {
    $settings = $this->settings();
    if ( count( $settings ) ) {
			$settings['slug'] = $this->id();
      parent::init( $settings );
    }
  }

	/**
	 * TODO
	 *
	 * @param int|null $group_id
	 *   TODO
	 */
	public function display( $group_id = NULL ) {

	}

	/**
	 * TODO
	 *
	 * @param int|null $group_id
	 *   TODO
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
	 * TODO
	 *
	 * @param int|null $group_id
	 *   TODO
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
   * TODO
   *
   * @return array
   *   TODO
   *
   * @link https://codex.buddypress.org/developer/group-extension-api/
   */
  protected function settings() {
    return array();
  }

  /**
   * TODO
   *
   * @return array
   *   TODO
   */
  protected function form_elements() {
    return array();
  }

	/**
	 * TODO
	 *
	 * @return string
	 *   TODO
	 */
	private final function id() {
		$class_name = get_called_class();
		return str_replace( 'group_extension', '', strtolower( $class_name ) );
	}
}
