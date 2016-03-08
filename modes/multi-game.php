<?php
/**
 * Contains the Clanpress "Multi-Game" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Modes
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Multi_Game_Mode extends Clanpress_Mode {
  /**
   * @{inheritdoc}
   */
  public static function name() {
    return __( 'Multi-Gaming Clan', 'clanpress' );
  }

  /**
   * @{inheritdoc}
   */
  public static function description() {
    return __( 'TODO', 'clanpress' );
  }

  /**
   * @{inheritdoc}
   */
  public static function thumbnail() {
    return Clanpress_Helper::get_assets_path() . 'modes/placeholder.png';
  }

  /**
   * @{inheritdoc}
   */
  protected function components() {
    return array(
      'admin',
      'awards',
      'games',
      'matches',
      'sponsors',
      'squads',
      'teamspeak',
    );
  }
}
