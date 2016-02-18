<?php
/**
 * Contains the Clanpress "Setup" mode configuration.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Setup_Mode
 */
class Clanpress_Setup_Mode extends Clanpress_Mode {
  /**
   * @inheritdoc
   */
  protected function components() {
    return array(
      'setup',
    );
  }
}
