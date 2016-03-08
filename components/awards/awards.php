<?php
/**
 * Contains the awards component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Awards
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Awards_Component extends Clanpress_Component {
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
  protected function post_types() {
    return array(
      'award',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function widgets() {
    return array(
      'latest_awards',
    );
  }
}
