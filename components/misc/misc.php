<?php
/**
 * Contains the misc component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Misc_Component
 */
class Clanpress_Misc_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function taxonomies() {
    return array(
      'game',
    );
  }
}
