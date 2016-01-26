<?php
/**
 * @file
 * Contains the class of the custom 'Opponent' taxonomy.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Opponent_Taxonomy
 */
class Clanpress_Opponent_Taxonomy extends Clanpress_Taxonomy {
  /**
   * @inheritdoc
   */
  protected function labels() {
    return  array(
      'name'                       => __( 'Opponents', 'clanpress' ),
      'singular_name'              => __( 'Opponent', 'clanpress' ),
      'search_items'               => __( 'Opponents', 'clanpress' ),
      'popular_items'              => __( 'Popular Opponents', 'clanpress' ),
      'all_items'                  => __( 'All Opponents', 'clanpress' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit Opponent', 'clanpress' ),
      'update_item'                => __( 'Update Opponent', 'clanpress' ),
      'add_new_item'               => __( 'Add New Opponent', 'clanpress' ),
      'new_item_name'              => __( 'New Opponent Name', 'clanpress' ),
      'separate_items_with_commas' => __( 'Separate Opponents with commas', 'clanpress' ),
      'add_or_remove_items'        => __( 'Add or remove Opponents', 'clanpress' ),
      'choose_from_most_used'      => __( 'Choose from most used Opponents', 'clanpress' ),
      'not_found'                  => __( 'No Opponents found', 'clanpress' ),
      'menu_name'                  => __( 'Opponents', 'clanpress' ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'hierarchical'          => false,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'attribute' ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function post_types() {
    return array(
      'clanpress_match',
    );
  }
}
