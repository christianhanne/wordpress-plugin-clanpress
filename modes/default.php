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
  protected function post_types() {
    return array(
      'awards'   => array('award'),
      'matches'  => array('match'),
      'sponsors' => array('sponsor'),
      'squads'   => array('squad'),
    );
  }

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(

    );
  }

  /**
   * @inheritdoc
   */
  protected function taxonomies() {

  }

  /**
   * @inheritdoc
   */
  protected function settings() {

  }
}
