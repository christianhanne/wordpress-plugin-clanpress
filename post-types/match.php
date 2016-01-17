<?php
/**
 * @file
 * Contains the class of the custom 'Match' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Match_Post_Type
 */
class Clanpress_Match_Post_Type extends Clanpress_Post_Type {
  /**
   * @inheritdoc
   */
  protected function labels() {
    return array(
      'name'               => __( 'Matches', 'clanpress' ),
      'singular_name'      => __( 'Match', 'clanpress' ),
      'menu_name'          => __( 'Matches', 'clanpress' ),
      'name_admin_bar'     => __( 'Match', 'clanpress' ),
      'add_new'            => __( 'Add new', 'clanpress' ),
      'add_new_item'       => __( 'Add new Match', 'clanpress' ),
      'new_item'           => __( 'New Match', 'clanpress' ),
      'edit_item'          => __( 'Edit Match', 'clanpress' ),
      'view_item'          => __( 'View Match', 'clanpress' ),
      'all_items'          => __( 'All Matches', 'clanpress' ),
      'search_items'       => __( 'Search Matches', 'clanpress' ),
      'parent_item_colon'  => __( 'Parent Match', 'clanpress' ),
      'not_found'          => __( 'No Matches found', 'clanpress' ),
      'not_found_in_trash' => __( 'No Matches found in trash', 'clanpress' ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'public'              => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'show_ui'             => true,
      'show_in_nav_menus'   => true,
      'show_in_menu'        => true,
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-admin-appearance',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
      'has_archive'         => true,
      'rewrite'             => array( 'slug' => 'matches' ),
      'query_var'           => true
    );
  }
}
