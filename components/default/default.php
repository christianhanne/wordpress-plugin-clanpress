<?php
/**
 * Contains the default component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Shared_Component
 */
class Clanpress_Default_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function includes() {
    return array(
			'functions',
      'form',
      'meta-box',
      'page',
      'post-type',
      'taxonomy',
      'widget',
    );
  }

  /**
   * @inheritdoc
   */
  protected function admin_styles() {
    return array(
      'backend',
    );
  }
}
