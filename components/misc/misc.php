<?php
/**
 * Contains the misc component class.
 *
 * @author Christian Hanne <support@aureola.codes>
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

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'social_media',
    );
  }
}
