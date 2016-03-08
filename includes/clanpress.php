<?php
/**
 * @file
 * Contains the main class of the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * TODO
 */
class Clanpress {
  /**
   * @var Clanpress
   * Holds an instance of the Clanpress plugin.
   */
  protected static $instance;

  /**
   * Initializes the plugin's behavior.
   */
  public function __construct() {
    Clanpress_Mode::init();
  }

  /**
   * Creates a new instance of the given plugin.
   */
  public static function instance() {
    if ( empty( self::$instance ) ) {
      self::$instance = new self;
    }

    return self::$instance;
  }

  /**
   * Performs all necessary steps for plugin activation.
   *
   * @see register_activation_hook()
   */
  public static function activate() {
    if ( !current_user_can( 'activate_plugins' ) ) {
      return;
    }

    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( 'activate-plugin_' . $plugin );

    Clanpress_Mode::reset();
  }

  /**
   * Performs all necessary steps for plugin deactivation.
   *
   * @see register_deactivation_hook()
   */
  public static function deactivate() {
    if ( !current_user_can( 'activate_plugins' ) ) {
      return;
    }

    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( 'deactivate-plugin_' . $plugin );

    Clanpress_Mode::reset();
  }

  /**
   * Performs all necessary steps for plugin uninstallation.
   *
   * @see register_uninstall_hook()
   */
  public static function uninstall() {
    if ( !current_user_can( 'activate_plugins' ) || __FILE__ !== WP_UNINSTALL_PLUGIN ) {
      return;
    }

    check_admin_referer( 'bulk-plugins' );

    // Remove all stored clanpress options.
    $options = wp_load_alloptions();
    foreach ( $options as $key => $value ) {
      if ( substr( $key, 0, 9 ) === 'clanpress' ) {
        delete_option( $key );
      }
    }
  }

}
