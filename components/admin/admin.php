<?php
/**
 * Contains the admin component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Admin_Component
 */
class Clanpress_Admin_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function admin_pages() {
    return array(
      'clanpress',
      'dashboard',
      'settings',
    );
  }
}
