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
 * @class Clanpress
 */
class Clanpress {
  /**
   * @var string
   * The default clanpress mode.
   */
  const DEFAULT_MODE = 'setup';

  /**
   * @var Clanpress
   * Holds an instance of the Clanpress plugin.
   */
  protected static $instance;

  /**
   * Initializes the plugin's behavior.
   */
  public function __construct() {
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/component.php');
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/helper.php');
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/mode.php');

    $this->mode( get_option( 'clanpress_mode', self::DEFAULT_MODE ) );
  }

  /**
   * Creates a new instance of the given plugin.
   */
  public static function init() {
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

    update_option( 'clanpress_mode', self::DEFAULT_MODE );
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

    delete_option( 'clanpress_mode' );
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

  /**
   * Returns an array of allowed modes.
   *
   * @return array
   *   Allowed modes.
   */
  public static function modes() {
    return array(
      'multi-game',
    );
  }

  /**
   * Returns the class name for a given mode id.
   *
   * @param string $mode
   *   Id of the plugin mode.
   *
   * @return string
   *   Class name of the mode.
   */
  public static function get_mode_class($mode) {
    return 'Clanpress_' . ucwords( str_replace( '-', '_', $mode ) ) . '_Mode';
  }

  /**
   * Registers and initializes the given clanpress mode.
   *
   * @param string $mode
   *   Id of the clanpress mode.
   */
  private function mode($mode) {
    $mode = !in_array( $mode, $this->modes() ) ? self::DEFAULT_MODE : $mode;

    require_once( Clanpress_Helper::get_modes_path() . $mode . '.php' );
    $mode_class = self::get_mode_class( $mode );
    new $mode_class();
  }

}
