<?php
/**
 * Contains the games component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Games
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Games_Component extends Clanpress_Component {
  /**
   * @{inheritdoc}
   */
  protected function includes() {
    return array(
      'functions',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function taxonomies() {
    return array(
      'game',
    );
  }
}
