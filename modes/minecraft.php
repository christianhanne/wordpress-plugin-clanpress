<?php
/**
 * Contains the Clanpress "Minecraft" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Minecraft_Mode
 */
class Clanpress_Minecraft_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  public static function name() {
    return __( 'Minecraft', 'clanpress' );
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
    return Clanpress_Helper::get_assets_path() . 'modes/minecraft.jpg';
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
