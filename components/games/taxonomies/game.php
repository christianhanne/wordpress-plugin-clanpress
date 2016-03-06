<?php
/**
 * Contains the class of the custom 'Game' taxonomy.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Game_Taxonomy
 */
class Clanpress_Game_Taxonomy extends Clanpress_Taxonomy {
  /**
   * @var int
   * Defines the icon size in pixels.
   */
  const ICON_SIZE = 50;

  /**
   * @var int
   * Defines the image size in pixels.
   */
  const IMAGE_SIZE = 100;

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
      'rewrite'               => array( 'slug' => 'game' ),
    );
  }

  /**
   * @inheritdoc
   */
  protected function post_types() {
    return array(
      'clanpress_award',
      'clanpress_match',
      'clanpress_squad',
    );
  }

  /**
   * @inheritdoc
   */
  protected function form_elements() {
    return array(
      'image' => array(
        'type' => 'upload',
        'label' => __( 'Image', 'clanpress' ),
      ),
      'icon' => array(
        'type' => 'upload',
        'label' => __( 'Icon', 'clanpress' ),
      ),
    );
  }

  /**
   * @inheritdoc
   */
  public function admin_table_thead( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
      if ( $key == 'posts' || $key == 'description' ) {
        continue;
      }

      $new_columns[ $key ] = $value;
    }

    $new_columns['image'] = __( 'Image', 'clanpress' );
    $new_columns['icon'] = __( 'Icon', 'clanpress' );
    return $new_columns;
  }

  /**
   * @inheritdoc
   */
  public function admin_table_column( $output, $column, $term_id ) {
    switch ( $column ) {
      case 'icon':
        return clanpress_get_game_icon( $term_id, array(
          self::ICON_SIZE,
          self::ICON_SIZE,
        ) );

      case 'image':
        return clanpress_get_game_image( $term_id, array(
          self::ICON_SIZE,
          self::ICON_SIZE,
        ) );

      default:
        return parent::admin_table_column( $output, $column, $term_id );
    }
  }
}
