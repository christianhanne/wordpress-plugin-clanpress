<?php
/**
 * Contains the Clanpress "Setup" mode configuration.
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
class Clanpress_Setup_Mode extends Clanpress_Mode {
  /**
   * @{inheritdoc}
   */
  protected function components() {
    return array(
      'setup',
    );
  }
}
