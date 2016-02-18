<?php
/**
 * Contains the shared component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Shared_Component
 */
class Clanpress_Shared_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function includes() {
    return array(
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
