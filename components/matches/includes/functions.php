<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays a link to the matches' external website.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_link( $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $match_link = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'match', 'link' );
  if ( !empty( $match_link ) ) {
    vprintf('<a href="%s">%s</a>', array(
      esc_url( $match_link ),
      __( 'To the match', 'clanpress' ),
    ));
  }
}

/**
 * Displays the name of the matches' opponent(s).
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_opponent( $post = null ) {
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
function clanpress_the_match_opponent_thumbnail( $size = 'post-thumbnail', $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $attachments = array();
  $terms = get_the_terms( $post, 'clanpress_opponent' );
  if ( is_array( $terms ) && count( $terms ) ) {
    foreach ( $terms as $term ) {
      $attachment = clanpress_the_opponent_image( $term->term_id, $size );
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
function clanpress_the_match_squad( $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Squads_Component::get_squad_options();

  $squads = array();
  $squad_ids = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'squads', 'squads' );
  if ( is_array( $squad_ids ) ) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      if ( $checked ) {
        array_push( $squads, $squad_options[ $squad_id ] );
      }
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
function clanpress_the_match_squad_thumbnail( $size = 'post-thumbnail', $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $squad_options = Clanpress_Squads_Component::get_squad_options();

  $images = array();
  $squad_ids = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'squads', 'squads' );
  if ( is_array( $squad_ids ) ) {
    foreach ( $squad_ids as $squad_id => $checked ) {
      if ( $checked ) {
        $image = bp_core_fetch_avatar( array( 'item_id' => $squad_id, 'object' => 'group', 'type' => $size ) );
        array_push( $images, $image );
      }
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
function clanpress_the_match_game( $post = null ) {
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
function clanpress_the_match_result( $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $squad = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'result', 'squad');
  $opponent = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'result', 'opponent');
  $map = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'result', 'map');

  vprintf( __( 'Map: %s, <strong>%d:%d</strong>', 'clanpress' ), array(
    esc_html( $map ),
    esc_html( $squad ),
    esc_html( $opponent ),
  ) );
}

/**
 * Displays the match type.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_match_type( $post = null ) {
  $post = isset( $post ) ? $post : get_post();

  $match_types = Clanpress_Match_Post_Type::get_match_types();
  $match_type = Clanpress_Match_Post_Type::get_post_value( $post->ID, 'match_type', 'match_type');

  if ( isset( $match_types[ $match_type ] ) ) {
    echo $match_types[ $match_type ];
  }
}

/**
 * Displays the link to the opponent's website.
 *
 * @param int $term_id
 *   The term id.
 */
function clanpress_the_opponent_link( $term_id ) {
  $link = clanpress_get_opponent_link( $term_id );
  if ( !empty( $link ) ) {
    printf( '<a href="%s">%s</a>', $link, __( 'Website', 'clanpress' ) );
  }
}

/**
 * Displays the opponent image for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 */
function clanpress_the_opponent_image( $term_id, $size = 'thumbnail') {
  echo clanpress_get_opponent_image( $term_id, $size );
}

/**
 * Returns the link to the opponent's website.
 *
 * @param int $term_id
 *   The term id.
 *
 * @return string
 *   The opponent's website link.
 */
function clanpress_get_opponent_link( $term_id ) {
  $meta = Clanpress_Opponent_Taxonomy::get_term_meta( $term_id );
  if ( !empty( $meta[ 'clanpress_opponent_link' ] ) ) {
    return esc_url( $meta[ 'clanpress_opponent_link' ] );
  }

  return '';
}

/**
 * Returns the image for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 *
 * @return string
 *    The opponent's image as an image tag.
 */
function clanpress_get_opponent_image( $term_id, $size = 'thumbnail' ) {
  $meta = Clanpress_Opponent_Taxonomy::get_term_meta( $term_id );
  if ( !empty( $meta[ 'clanpress_opponent_image' ] ) ) {
    $attachment_id = (int) $meta[ 'clanpress_opponent_image' ];
    return wp_get_attachment_image( $attachment_id, $size );
  }

  return '';
}
