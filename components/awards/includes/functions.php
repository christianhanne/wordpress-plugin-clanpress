<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Awards
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays the award's placement.
 *
 * @param WP_Post $post
 *   The post.
 *
 * @subpackage Theme
 */
function clanpress_the_award_placement($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $placement = Clanpress_Award_Post_Type::get_post_value( $post->ID, 'placement', 'placement' );
  echo !empty( $placement ) ? $placement : '&ndash;';
}

/**
 * Display the award's squads.
 *
 * @param WP_Post $post
 *   The post.
 *
 * @subpackage Theme
 */
function clanpress_the_award_squad($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Squads_Component::get_squad_options();
  $squad_ids = Clanpress_Award_Post_Type::get_post_value( $post->ID, 'squad', 'squad' );

  $squads = array();
  if (is_array($squad_ids)) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      if ( $checked ) {
        array_push( $squads, $squad_options[ $squad_id ] );
      }
    }
  }

  echo implode(', ', $squads);
}
