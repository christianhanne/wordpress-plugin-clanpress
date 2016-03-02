<?php
/**
 * Contains the Clanpress modes parent class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Mode
 */
class Clanpress_Mode {
  /**
   * @var string
   * Stores the default mode's id.
   */
  const DEFAULT = 'setup';

  /**
   * @var array
   * Holds an array of clanpress modes.
   */
  protected static $modes = array(
    'multi-game',
  );

  /**
   * Add all registered components.
   */
  function __construct() {
    $components = $this->components();
    if ( !in_array( Clanpress_Helper::DEFAULT_COMPONENT, $components ) ) {
      array_unshift( $components, Clanpress_Helper::DEFAULT_COMPONENT );
    }

    foreach ( $components as $component ) {
      Clanpress_Helper::register_component( $component );
    }
  }

  /**
   * Initializes the currently active mode.
   */
  public static function init() {
    Clanpress_Helper::register_mode( self::get() );
  }

  /**
   * Sets the mode to the given one if possible.
   *
   * @param string|null $mode
   *   Id of the mode.
   *
   * @return bool
   *   Returns true, if mode could be updated.
   */
  public static function set( $mode = null ) {
    if ( in_array( $mode, self::list() ) ) {
      update_option( 'clanpress_mode', $mode ) );
      return true;
    }

    return false;
  }

  /**
   * Returns the currently active mode.
   *
   * @return string
   *   Currently active mode.
   */
  public static function get() {
    return get_option( 'clanpress_mode', self::DEFAULT ) );
  }

  /**
   * Returns an array of allowed modes.
   *
   * @return array
   *   Allowed modes.
   */
  public static function list() {
    return self::$modes;
  }

  /**
   * Removes the stored clanpress mode so the default mode will kick in.
   */
  public static function reset() {
    delete_option( 'clanpress_mode' );
  }
}
