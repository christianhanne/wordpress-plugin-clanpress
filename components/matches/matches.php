<?php
/**
 * Contains the matches component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Matches
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Matches_Component extends Clanpress_Component {
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
  protected function post_types() {
    return array(
      'match',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function taxonomies() {
    return array(
      'opponent',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function widgets() {
    return array(
      'latest_matches',
      'top_match',
      'upcoming_matches',
    );
  }
}
