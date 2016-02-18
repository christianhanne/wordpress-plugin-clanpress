<?php
/**
 * @file
 * Contains the class of the custom 'Setup' admin page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Setup_Page
 */
class Clanpress_Setup_Page extends Clanpress_Page {
  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Clanpress', 'clanpress' ),
      'menu_title' => __( 'Clanpress', 'clanpress' ),
      'capability' => 'manage_options', // TODO: Add correct capability.
      'menu_slug' => 'clanpress',
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
