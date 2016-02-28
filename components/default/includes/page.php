<?php
/**
 * Contains the controller class for custom clanpress pages.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Page
 */
class Clanpress_Page {
  /**
   * Registers the page if settings have been defined.
   */
  function __construct() {
    $settings = $this->settings();
    if ( !count($settings) ) {
      return;
    }

    $is_submenu_page = strpos( $settings['menu_slug'], 'clanpress/' ) !== FALSE;
    if ( !$is_submenu_page ) {
      add_menu_page(
        isset( $settings['page_title'] ) ? $settings['page_title'] : NULL,
        isset( $settings['menu_title'] ) ? $settings['menu_title'] : NULL,
        isset( $settings['capability'] ) ? $settings['capability'] : NULL,
        isset( $settings['menu_slug'] )  ? $settings['menu_slug']  : NULL,
        isset( $settings['function'] )   ? $settings['function']   : NULL,
        isset( $settings['icon_url'] )   ? $settings['icon_url']   : NULL,
        isset( $settings['position'] )   ? $settings['position']   : NULL
      );
    }
    else {
      add_submenu_page(
        'clanpress',
        isset( $settings['page_title'] ) ? $settings['page_title'] : NULL,
        isset( $settings['menu_title'] ) ? $settings['menu_title'] : NULL,
        isset( $settings['capability'] ) ? $settings['capability'] : NULL,
        isset( $settings['menu_slug'] )  ? $settings['menu_slug']  : NULL,
        isset( $settings['function'] )   ? $settings['function']   : NULL
      );
    }
  }

  /**
   * Returns an array of settings for the custom page.
   *
   * Should be overwritten by the page extending this class. If no array
   * is returned or the returned array is empty, the page won't be added.
   * Check the linked documentation for details.
   *
   * Please note: The page will be automatically added as a subpage, if the
   * menu slug is a path below "clanpress/".
   *
   * @return array
   *   An array of settings for this page
   *
   * @link https://developer.wordpress.org/reference/functions/add_menu_page/
   * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
   */
  protected function settings() {
    return array();
  }
}
