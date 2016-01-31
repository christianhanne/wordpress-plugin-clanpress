<?php
/**
 * @file
 * Contains the class of the custom 'Settings' admin page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Settings_Page
 */
class Clanpress_Settings_Page extends Clanpress_Page {
  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Settings', 'clanpress' ),
      'menu_title' => __( 'Settings', 'clanpress' ),
      'capability' => 'manage_options', // TODO: Add correct capability.
      'menu_slug' => 'clanpress/settings',
      'function' => array( $this, 'render' ),
      'icon_url' => NULL,
      'position' => 99,
    );
  }

  /**
   * TODO
   */
  public function render() {

  }
}
