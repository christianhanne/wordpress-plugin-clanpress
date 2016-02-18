<?php
/**
 * Contains the Clanpress "Star Citizen" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Star_Citizen_Mode
 */
class Clanpress_Star_Citizen_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  public static function name() {
    return __( 'Star Citizen', 'clanpress' );
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
    return Clanpress_Helper::get_assets_path() . 'modes/star-citizen.png';
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
