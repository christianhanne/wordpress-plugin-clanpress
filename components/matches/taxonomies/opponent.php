<?php
/**
 * Contains the class of the custom 'Opponent' taxonomy.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Matches\Taxonomies
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Opponent_Taxonomy extends Clanpress_Taxonomy {
  /**
   * @var int
   * Defines the icon size in pixels.
   */
  const ICON_SIZE = 50;

  /**
   * @{inheritdoc}
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
   * @{inheritdoc}
   */
  protected function settings() {
    return array(
      'hierarchical'          => false,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
      'rewrite'               => array( 'slug' => 'opponent' ),
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function post_types() {
    return array(
      'clanpress_match',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function form_elements() {
    return array(
      'link' => array(
        'type' => 'text',
        'label' => __( 'Website', 'clanpress' ),
        'pattern' => '^http[s]?:\/\/.+$',
        'description' => __( 'Add a link to your opponent\'s website.', 'clanpress' ),
      ),
      'image' => array(
        'type' => 'upload',
        'default' => '',
        'description' => __( 'Select or upload an image for this opponent.', 'clanpress' ),
      ),
    );
  }

  /**
   * @{inheritdoc}
   */
  public function admin_table_thead( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
      if ( $key == 'posts' || $key == 'description' ) {
        continue;
      }

      $new_columns[ $key ] = $value;
    }

    $new_columns['link'] = __( 'Website', 'clanpress' );
    $new_columns['image'] = __( 'Image', 'clanpress' );
    return $new_columns;
  }

  /**
   * @{inheritdoc}
   */
  public function admin_table_column( $output, $column, $term_id ) {
    switch ( $column ) {
      case 'link':
        return clanpress_get_opponent_url( $term_id );

      case 'image':
        return clanpress_get_opponent_image( $term_id, array(
          self::ICON_SIZE,
          self::ICON_SIZE,
        ) );

      default:
        return parent::admin_table_column( $output, $column, $term_id );
    }
  }

}
