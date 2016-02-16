<?php
/**
 * Contains the teamspeak component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Teamspeak_Component
 */
class Clanpress_Teamspeak_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'teamspeak_status',
      'teamspeak_viewer',
    );
  }
}
