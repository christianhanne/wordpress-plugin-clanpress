<?php
/**
 * Contains the custom meta box "Image" for buddypress groups.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Image_Group_Extension
 */
class Clanpress_Image_Group_Extension extends BP_Group_Extension {
	/**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'name' => __( 'Image', 'clanpress' ),
    );
  }
}
