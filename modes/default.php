<?php
/**
 * Contains the Clanpress "Default" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Default_Mode
 */
class Clanpress_Default_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  protected function components() {
    return array(
      'awards',
      'matches',
      'sponsors',
      'squads',
      'teamspeak',
      'misc',
    );
  }
}
