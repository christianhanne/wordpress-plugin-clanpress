<?php
/**
 * Contains the squads component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Squads_Component
 */
class Clanpress_Squads_Component extends Clanpress_Component {
  /**
   * Returns an array of squad options.
   *
   * @return array
   *   Array of squad post ids & titles.
   */
  public static function get_squad_options() {
    static $options;
    if ( !isset( $options ) ) {
      $args = array(
        'orderby' => 'title',
        'order' => 'ASC',
        'post_type' => 'clanpress_squad',
      );

      $options = array();
      foreach ( get_posts( $args ) as $post ) {
        $options[ $post->ID ] = $post->post_title;
      }
    }

    return $options;
  }

  /**
   * @inheritdoc
   */
  protected function group_extensions() {
    return array(
      'squad_type',
      'games',
    );
  }

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
  protected function widgets() {
    return array(
      'members',
      'squads',
    );
  }
}
