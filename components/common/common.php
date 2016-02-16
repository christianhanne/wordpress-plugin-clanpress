<?php
/**
 * Contains the common component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Common_Component
 */
class Clanpress_Common_Component extends Clanpress_Component {
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
  protected function admin_pages() {
    return array(
      'clanpress',
      'dashboard',
      'settings',
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
