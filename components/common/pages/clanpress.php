<?php
/**
 * @file
 * Contains the class of the custom 'Clanpress' admin page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Clanpress_Page
 */
class Clanpress_Clanpress_Page extends Clanpress_Page {
  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Clanpress', 'clanpress' ),
      'menu_title' => __( 'Clanpress', 'clanpress' ),
      'capability' => 'manage_options', // TODO: Add correct capability.
      'menu_slug' => 'clanpress',
    );
  }
}
