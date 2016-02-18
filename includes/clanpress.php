<?php
/**
 * @file
 * Contains the main class of the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
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
   * Initializes the plugin's behavior.
   */
  public function __construct() {
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/component.php');
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/helper.php');
    require_once( CLANPRESS_PLUGIN_PATH . 'includes/mode.php');

    $this->mode( get_option( 'clanpress_mode', self::DEFAULT_MODE ) );
  }

  /**
   * Registers and initializes the given clanpress mode.
   *
   * @param string $mode
   *   Id of the clanpress mode.
   */
  private function mode($mode) {
    $mode = !in_array( $mode, $this->modes() ) ? self::DEFAULT_MODE : $mode;

    require_once( CLANPRESS_PLUGIN_PATH . 'modes/' . $mode . '.php' );
    $mode_class = 'Clanpress_' . ucwords($mode) . '_Mode';
    new $mode_class();
  }

  /**
   * Returns an array of allowed modes.
   *
   * @return array
   *   Allowed modes.
   */
  private function modes() {
    return array();
  }
}
