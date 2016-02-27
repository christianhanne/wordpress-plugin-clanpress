<?php
/**
 * Contains the setup component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Setup_Component
 */
class Clanpress_Setup_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function admin_pages() {
    return array(
      'setup',
    );
  }

  /**
   * @inheritdoc
   */
  protected function admin_styles() {
    return array(
      'setup',
    );
  }
}
