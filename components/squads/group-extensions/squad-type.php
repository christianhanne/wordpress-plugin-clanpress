<?php
/**
 * Contains the custom meta box "Squad Type" for buddypress groups.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Squad_Type_Group_Extension
 */
class Clanpress_Squad_Type_Group_Extension extends Clanpress_Group_Extension {
  /**
   * @var string
   * Marks a squad as not playing.
   */
  const NOT_PLAYING = 'not-playing';

  /**
   * @var string
   * Marks a squad as playing.
   */
  const PLAYING = 'playing';

  /**
	 * @inheritdoc
	 */
	public function display( $group_id = NULL ) {
    echo 'TODO';
	}

	/**
	 * @inheritdoc
	 */
	public function settings_screen( $group_id = NULL ) {
    parent::settings_screen( $group_id );
	}

  /**
	 * @inheritdoc
	 */
	public function settings_screen_save( $group_id = NULL ) {
    parent::settings_screen_save( $group_id );
	}

  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'name' => __( 'Squad Type', 'clanpress' ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function form_elements() {
    return array(
      'squad_type' => array(
        'type' => 'select',
        'label' => __( 'Squad Type', 'clanpress' ),
        'options' => $this->get_squad_types(),
        'default' => self::NOT_PLAYING,
      ),
    );
  }

  /**
   * Returns an associative array of squad types.
   *
   * @return array
   *   Array of squad types.
   */
  protected function get_squad_types() {
    return array(
      self::NOT_PLAYING => __( 'Not playing', 'clanpress' ),
      self::PLAYING     => __( 'Playing', 'clanpress' ),
    );
  }
}
