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
			$group_id = bp_get_group_id();
			echo 'What a cool plugin!';
	}

	/**
	 * TODO
	 *
	 * @param int|null $group_id
	 *   TODO
	 */
	public function settings_screen( $group_id = NULL ) {
			$setting = groups_get_groupmeta( $group_id, 'group_extension_example_1_setting' );

			?>
			Save your plugin setting here: <input type="text" name="group_extension_example_1_setting" value="<?php echo esc_attr( $setting ) ?>" />
			<?php
	}

	/**
	 * TODO
	 *
	 * @param int|null $group_id
	 *   TODO
	 */
	public function settings_screen_save( $group_id = NULL ) {
			$setting = '';

			if ( isset( $_POST['group_extension_example_1_setting'] ) ) {
					$setting = $_POST['group_extension_example_1_setting'];
			}

			groups_update_groupmeta( $group_id, 'group_extension_example_1_setting', $setting );
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
	 * @return string
	 *   TODO
	 */
	private final function id() {
		$class_name = get_called_class();
		return str_replace( 'group_extension', '', strtolower( $class_name ) );
	}
}
