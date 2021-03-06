<?php
/**
 * Contains the teamspeak component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Teamspeak
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Teamspeak_Component extends Clanpress_Component {
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
  protected function widgets() {
    return array(
      'teamspeak_status',
      'teamspeak_viewer',
    );
  }
}
