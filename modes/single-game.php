<?php
/**
 * Contains the Clanpress "Single-Game" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Single_Game_Mode
 */
class Clanpress_Single_Game_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  public static function name() {
    return __( 'Single-Game Clan', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  public static function description() {
    return __( 'TODO', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  public static function thumbnail() {
    return Clanpress_Helper::get_assets_path() . 'modes/single-game.jpg';
  }

  /**
   * @inheritdoc
   */
  protected function components() {
    return array(
      'admin',
      'awards',
      'matches',
      'misc',
      'sponsors',
      'squads',
      'teamspeak',
    );
  }
}
