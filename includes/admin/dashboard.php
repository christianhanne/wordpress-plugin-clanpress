<?php
/**
 * @file
 * Contains the class of the custom 'Dashboard' admin page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Dashboard_Page
 */
class Clanpress_Dashboard_Page extends Clanpress_Page {
  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Dashboard', 'clanpress' ),
      'menu_title' => __( 'Dashboard', 'clanpress' ),
      'capability' => 'manage_options', // TODO: Add correct capability.
      'menu_slug' => 'clanpress/dashboard',
      'function' => array( $this, 'render' ),
    );
  }

  /**
   * TODO
   */
  public function render() {

  }
}
