<?php
/**
 * Contains the matches component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Matches_Component
 */
class Clanpress_Matches_Component extends Clanpress_Component {
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
      'match',
    );
  }

  /**
   * @inheritdoc
   */
  protected function taxonomies() {
    return array(
      'opponent',
    );
  }

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'latest_matches',
      'top_match',
      'upcoming_matches',
    );
  }
}
