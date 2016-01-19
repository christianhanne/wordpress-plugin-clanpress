<?php
/**
 * @file
 * Contains the class of the custom 'Game' taxonomy.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Game_Taxonomy
 */
class Clanpress_Game_Taxonomy extends Clanpress_Taxonomy {
  /**
   * @inheritdoc
   */
  protected function labels() {
    return  array(
      'name'                       => __( 'Games', 'clanpress' ),
      'singular_name'              => __( 'Game', 'clanpress' ),
      'search_items'               => __( 'Games', 'clanpress' ),
      'popular_items'              => __( 'Popular Games', 'clanpress' ),
      'all_items'                  => __( 'All Games', 'clanpress' ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit Game', 'clanpress' ),
      'update_item'                => __( 'Update Game', 'clanpress' ),
      'add_new_item'               => __( 'Add New Game', 'clanpress' ),
      'new_item_name'              => __( 'New Game Name', 'clanpress' ),
      'separate_items_with_commas' => __( 'Separate Games with commas', 'clanpress' ),
      'add_or_remove_items'        => __( 'Add or remove Games', 'clanpress' ),
      'choose_from_most_used'      => __( 'Choose from most used Games', 'clanpress' ),
      'not_found'                  => __( 'No Games found', 'clanpress' ),
      'menu_name'                  => __( 'Games', 'clanpress' ),
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
      'clanpress_award',
    );
  }
}
