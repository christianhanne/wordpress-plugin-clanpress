<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * Displays the award's placement.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_award_placement($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $placement = get_post_meta( $post->ID, 'clanpress_award_placement[placement]', true );
  echo !empty( $placement ) ? $placement : '&ndash;';
}

/**
 * Display the award's squads.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_award_squad($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Helper::get_squad_options();

  $squads = array();
  $squad_ids = get_post_meta( $post->ID, 'clanpress_award_squad[squad]', true );

  if (is_array($squad_ids)) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      array_push( $squads, $squad_options[ $squad_id ] );
    }
  }

  echo implode(', ', $squads);
}
