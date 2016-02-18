<?php
/**
 * Contains the Clanpress "Multi-Game" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Multi_Game_Mode
 */
class Clanpress_Multi_Game_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  public static function name() {
    return __( 'Multi-Gaming Clan', 'clanpress' );
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
    return Clanpress_Helper::get_assets_path() . 'modes/multi-game.png';
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
