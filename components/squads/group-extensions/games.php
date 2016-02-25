<?php
/**
 * Contains the custom meta box "Games" for buddypress groups.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Games_Group_Extension
 */
class Clanpress_Games_Group_Extension extends BP_Group_Extension {
	/**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'name' => __( 'Games', 'clanpress' ),
    );
  }
}
