<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress
 */
class Clanpress {

  /**
   * TODO
   */
  const WIDGETS_PATH = CLANPRESS_PLUGIN_PATH . 'widgets/';

  /**
   * TODO
   */
  public function __construct() {
    require_once( CLANPRESS_PLUGIN_PATH . 'classes/form.php' );
    require_once( CLANPRESS_PLUGIN_PATH . 'classes/widget.php' );

    add_action( 'widgets_init', array('Clanpress', 'register_widgets') );
  }

  /**
   * TODO
   */
  public static function register_widgets() {
    self::register_widget( 'latest_awards' );
    self::register_widget( 'latest_matches' );
    self::register_widget( 'members' );
    self::register_widget( 'social_media' );
    self::register_widget( 'sponsors' );
    self::register_widget( 'squads' );
    self::register_widget( 'teamspeak' );
    self::register_widget( 'top_match' );
    self::register_widget( 'upcoming_matches' );
  }

  /**
   * [register_widget description]
   * @param string $widget [description]
   */
  private static function register_widget($widget) {
    require_once( self::WIDGETS_PATH . $widget . '.php' );
    register_widget( 'Clanpress_' . ucwords( $widget ) . '_Widget' );
  }
}
