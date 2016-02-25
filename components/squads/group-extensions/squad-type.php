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
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'name' => __( 'Squad Type', 'clanpress' ),
    );
  }
}
