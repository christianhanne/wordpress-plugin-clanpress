<?php
/**
 * @file
 * Contains the class of the custom 'Award' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Award_Post_Type
 */
class Clanpress_Award_Post_Type extends Clanpress_Post_Type {
  /**
   * @inheritdoc
   */
  protected function labels() {
    return array(
      'name'               => __( 'Awards', 'clanpress' ),
      'singular_name'      => __( 'Award', 'clanpress' ),
      'menu_name'          => __( 'Awards', 'clanpress' ),
      'name_admin_bar'     => __( 'Award', 'clanpress' ),
      'add_new'            => __( 'Add new', 'clanpress' ),
      'add_new_item'       => __( 'Add new Award', 'clanpress' ),
      'new_item'           => __( 'New Award', 'clanpress' ),
      'edit_item'          => __( 'Edit Award', 'clanpress' ),
      'view_item'          => __( 'View Award', 'clanpress' ),
      'all_items'          => __( 'Awards', 'clanpress' ),
      'search_items'       => __( 'Search Awards', 'clanpress' ),
      'parent_item_colon'  => __( 'Parent Award', 'clanpress' ),
      'not_found'          => __( 'No Awards found', 'clanpress' ),
      'not_found_in_trash' => __( 'No Awards found in trash', 'clanpress' ),
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
      'show_in_menu'        => 'clanpress',
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-admin-appearance',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'         => true,
      'rewrite'             => array( 'slug' => 'awards' ),
      'query_var'           => true
    );
  }

  /**
   * @inheritdoc
   */
  protected function meta_boxes() {
    $boxes['placement'] = array(
      'title' => __( 'Placement', 'clanpress' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'placement' => array(
          'type' => 'select',
          'options' => Clanpress_Form::range(1, 10),
          'default' => 1,
        ),
      ),
    );

    $boxes['squad'] = array(
      'title' => __( 'Squads', 'clanpress' ),
      'screen' => array( 'post', 'page' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'squad' => array(
          'type' => 'checkboxes',
          'options' => Clanpress_Helper::get_squad_options(),
          'default' => array(),
        ),
      ),
    );

    return $boxes;
  }
}
