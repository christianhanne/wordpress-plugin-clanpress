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
 * Displays the squad type of the given squad post.
 *
 * @param int|null $group_id
 *   The group id.
 */
function clanpress_the_squad_type($group_id = null) {
  $group_id = isset( $group_id ) ? $group_id : bp_group_id();

  $squad_type = Clanpress_Squad_Type_Group_Extension::get_meta_value( $group_id, 'squad_type' );
  $squad_types = Clanpress_Squad_Type_Group_Extension::get_squad_types();

  if ( isset( $squad_types[ $squad_type ] ) ) {
    echo $squad_types[ $squad_type ];
  }
}

/**
 * Displays a list of games for the given squad.
 *
 * @param int|null $group_id
 *   The group id.
 */
function clanpress_the_squad_games($group_id = null) {
  $group_id = isset( $group_id ) ? $group_id : bp_group_id();

  $games_selected = Clanpress_Games_Group_Extension::get_meta_value( $group_id, 'games' );

  $terms = get_terms( 'clanpress_game', array(
    'orderby' => 'name',
    'hide_empty' => false,
  ) );

  foreach ( $terms as $term ) {
    if ( $games_selected[ $term->term_id ] == 1 ) {
        array_push( $games, esc_html( $term->name ) );
    }
  }

  echo implode(', ', $games);
}

/**
 * Displays a list of short names for the games of a given squad.
 *
 * @param int|null $group_id
 *   The group id.
 */
function clanpress_the_squad_games_short($group_id = null) {
  $group_id = isset( $group_id ) ? $group_id : bp_group_id();

  $games_selected = Clanpress_Games_Group_Extension::get_meta_value( $group_id, 'games' );

  $terms = get_terms( 'clanpress_game', array(
    'orderby' => 'name',
    'hide_empty' => false,
  ) );

  foreach ( $terms as $term ) {
    if ( $games_selected[ $term->term_id ] == 1 ) {
        array_push( $games, esc_html( $term->slug ) );
    }
  }

  echo implode(', ', $games);
}

/**
 * Displays the members count of a given squad.
 *
 * @param int|null $group_id
 *   The group id.
 */
function clanpress_the_squad_members_count($group_id = null) {
  $group_id = isset( $group_id ) ? $group_id : bp_group_id();

  echo (int) groups_get_total_member_count( $group_id );
}

/**
 * Displays a link to an awards archive filtered for the given squad.
 *
 * @param BP_Groups_Group $group
 *   The group.
 */
function clanpress_the_squad_awards_link($group = null) {
  vprintf('<a href="%s">%s</a>', array(
    bp_get_group_permalink( $group ) . '/clanpress_awards/',
    __( 'Squad awards', 'clanpress' ),
  ));
}

/**
 * Displays a link to a matches archive filtered for the given squad.
 *
 * @param BP_Groups_Group $group
 *   The group.
 */
function clanpress_the_squad_matches_link($group = null) {
  vprintf('<a href="%s">%s</a>', array(
    bp_get_group_permalink( $group ) . '/clanpress_awards/',
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
 * Starts a new squad members query.
 *
 * @param array $args
 *   Array with query arguments. Check linked function for details.
 *
 * @see groups_get_group_members()
*/
function clanpress_query_squad_members( $args = array() ) {
  global $_clanpress_squad_members, $_clanpress_squad_member;

  $group = groups_get_group_members( $args );

  $_clanpress_squad_member = NULL;
  $_clanpress_squad_members = $group['members'];
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
