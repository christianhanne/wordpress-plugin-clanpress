<?php
/**
 * Contains the awards component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Awards_Component
 */
class Clanpress_Awards_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function post_types() {
    return array(
      'award',
    );
  }

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'latest_awards',
    );
  }
}
