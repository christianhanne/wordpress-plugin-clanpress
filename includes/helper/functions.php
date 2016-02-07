<?php
/**
 * @file
 * This file contains publicly accessible shortcuts to helper functions.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

 /**
  * Includes a post type's content template.
  *
  * Will always use the global $post object to determine the post type.
  *
  * @param string $type
  *   Display type, either 'single' or 'archive'.
  */
function clanpress_content_template( $type ) {
  Clanpress_Post_Type::content_template( $type, get_post_type() );
}

/**
 * Displays the squad type of the given squad post.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_type($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $squad_type_id = get_post_meta( $post->ID, 'clanpress_squad_squad_type[squad_type]', true );
  $squad_types = Clanpress_Squad_Post_type::get_squad_types();

  echo $squad_types[ $squad_type_id ];
}

/**
 * Displays a list of games for the given squad.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_games($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $games = array();
  foreach ( get_the_terms( $post, 'clanpress_game' ) as $term ) {
    array_push( $games, esc_html( $term->name ) );
  }

  echo implode(', ', $games);
}

/**
 * Displays a list of short names for the games of a given squad.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_games_short($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $games = array();
  foreach ( get_the_terms( $post, 'clanpress_game' ) as $term ) {
    array_push( $games, esc_html( $term->slug ) );
  }

  echo implode(', ', $games);
}

/**
 * Displays the members count of a given squad.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_members_count($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $group_id = get_post_meta( $post->ID, 'clanpress_group_id', true );
  echo (int) groups_get_total_member_count( $group_id );
}

/**
 * Displays a link to an awards archive filtered for the given squad.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_awards_link($post = null) {
  $post = isset( $post ) ? $post : get_post();

  vprintf('<a href="%s">%s</a>', array(
    site_url('/awards?squad_id=' . $post->ID),
    __( 'Squad awards', 'clanpress' ),
  ));
}

/**
 * Displays a link to a matches archive filtered for the given squad.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_squad_matches_link($post = null) {
  $post = isset( $post ) ? $post : get_post();

  vprintf('<a href="%s">%s</a>', array(
    site_url('/matches?squad_id=' . $post->ID),
    __( 'Squad matches', 'clanpress' ),
  ));
}

/**
 * Displays the avatar of a given squad member.
 *
 * @param object $member
 *   Buddypress group member object.
 */
function clanpress_the_squad_member_avatar($member = null) {
  $member = isset( $member ) ? $member : clanpress_get_squad_member();
  echo bp_core_fetch_avatar(array(
    'item_id' => $member->ID,
    'type' => 'full',
  ));
}

/**
 * Displays the profile link of a given squad member.
 *
 * @param object $member
 *   Buddypress group member object.
 */
function clanpress_the_squad_member_link($member = null) {
  $member = isset( $member ) ? $member : clanpress_get_squad_member();
  echo bp_core_get_userlink( $member->ID );
}

/**
 * Displays the role of a given squad member.
 *
 * @param object $member
 *   Buddypress group member object.
 */
function clanpress_the_squad_member_role($member = null) {
  $member = isset( $member ) ? $member : clanpress_get_squad_member();
  if ( $member->is_admin || $member->is_mod ) {
    $role = __( 'Leader', 'clanpress' );
  } else {
    $role = __( 'Member', 'clanpress' );
  }

  echo $role;
}

/**
 * Returns the currently active squad member.
 *
 * @return object
 *   Currently active squad member.
 */
function clanpress_get_squad_member() {
  global $_clanpress_squad_member;
  return isset( $_clanpress_squad_member ) ? $_clanpress_squad_member : NULL;
}

/**
 * Sets the next member in the globals members array as active.
 */
function clanpress_the_squad_member() {
  global $_clanpress_squad_member, $_clanpress_squad_members;
  $_clanpress_squad_member = array_shift( $_clanpress_squad_members );
}

/**
 * Returns if there is are further squad members loaded.
 *
 * @return bool
 *   True, if there are squad members to be displayed.
 */
function clanpress_have_squad_members() {
  global $_clanpress_squad_members;
  return count($_clanpress_squad_members) > 0;
}

/**
 * Displays the link to the sponsor website.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_sponsor_link($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $website = get_post_meta( $post->ID, 'clanpress_sponsor_sponsor[website]', true);
  vprintf('<a href="%s">%s</a>', array(
    esc_url( $website ),
    __( 'To the sponsor', 'clanpress' ),
  ));
}

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
