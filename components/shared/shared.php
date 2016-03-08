<?php
/**
 * Contains the shared component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Shared_Component extends Clanpress_Component {
  /**
   * @{inheritdoc}
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
      'group-extension',
      'settings',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function admin_styles() {
    return array(
      'backend',
    );
  }
}
