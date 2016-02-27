<?php
/**
 * Contains the sponsors component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Sponsors_Component
 */
class Clanpress_Sponsors_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  protected function includes() {
    return array(
      'functions',
    );
  }

  /**
   * @inheritdoc
   */
  protected function post_types() {
    return array(
      'sponsor',
    );
  }

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'sponsors',
    );
  }
}
