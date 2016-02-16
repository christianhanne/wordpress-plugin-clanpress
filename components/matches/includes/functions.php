<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * Displays a link to the matches' external website.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_link($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $match_link = get_post_meta( $post->ID, 'clanpress_match_match[link]', true);
  vprintf('<a href="%s">%s</a>', array(
    esc_url( $match_link ),
    __( 'To the match', 'clanpress' ),
  ));
}

/**
 * Displays the name of the matches' opponent(s).
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_opponent($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $opponents = array();

  $terms = get_the_terms( $post, 'clanpress_opponent' );
  if ( is_array( $terms ) && count( $terms ) ) {
    foreach ( $terms as $term ) {
      array_push( $opponents, esc_html( $term->name ) );
    }
  }

  echo implode(', ', $opponents);
}

/**
 * Displays the thumbnail of the matches' opponent(s).
 *
 * @param array|string $size
 *   Image size to use. Accepts any valid image size, or an array of width
 *   and height values in pixels (in that order).
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_opponent_thumbnail($size = 'post-thumbnail', $post = null) {
  $post = isset( $post ) ? $post : get_post();

  $attachments = array();
  $terms = get_the_terms( $post, 'clanpress_opponent' );
  if ( is_array( $terms ) && count( $terms ) ) {
    foreach ( $terms as $term ) {
      $term_meta = Clanpress_Opponent_Taxonomy::get_term_meta( $term->term_id );
      $attachment_id = (int) $term_meta['clanpress_opponent_image'];

      $attachment = wp_get_attachment_image( $attachment_id, $size );
      array_push( $attachments, $attachment );
    }
  }

  echo implode('', $attachments);
}

/**
 * Display the matches squads.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_squad($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Helper::get_squad_options();

  $squads = array();
  $squad_ids = get_post_meta( $post->ID, 'clanpress_match_squads[squads]', true );
  if (is_array($squad_ids)) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      array_push( $squads, $squad_options[ $squad_id ] );
    }
  }

  echo implode(', ', $squads);
}

/**
 * Displays the thumbnail of the matches' opponent(s).
 *
 * @param array|string $size
 *   Image size to use. Accepts any valid image size, or an array of width
 *   and height values in pixels (in that order).
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_squad_thumbnail($size = 'post-thumbnail', $post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Helper::get_squad_options();

  $images = array();
  $squad_ids = get_post_meta( $post->ID, 'clanpress_match_squads[squads]', true );
  if (is_array($squad_ids)) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      array_push( $images, get_the_post_thumbnail( $squad_id, $size ) );
    }
  }

  echo implode('', $images);
}

/**
 * Displays the matches games.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_game() {
  $post = isset( $post ) ? $post : get_post();

  $games = array();
  $terms = get_the_terms( $post, 'clanpress_game' );
  if ( is_array( $terms ) && count( $terms ) ) {
    foreach ( $terms as $term ) {
      array_push( $games, esc_html( $term->name ) );
    }
  }

  echo implode(', ', $games);
}

/**
 * Displays the matches results.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_result($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad = get_post_meta( $post->ID, 'clanpress_match_result[squad]', true);
  $opponent = get_post_meta( $post->ID, 'clanpress_match_result[opponent]', true);

  printf('%d:%d', $squad, $opponent);
}
