<?php
/**
 * @file
 * Contains the class of the custom 'Sponsor' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Sponsor_Post_Type
 */
class Clanpress_Sponsor_Post_Type extends Clanpress_Post_Type {
  /**
   * @inheritdoc
   */
  protected function labels() {
    return array(
      'name'               => __( 'Sponsors', 'clanpress' ),
      'singular_name'      => __( 'Sponsor', 'clanpress' ),
      'menu_name'          => __( 'Sponsors', 'clanpress' ),
      'name_admin_bar'     => __( 'Sponsor', 'clanpress' ),
      'add_new'            => __( 'Add new', 'clanpress' ),
      'add_new_item'       => __( 'Add new Sponsor', 'clanpress' ),
      'new_item'           => __( 'New Sponsor', 'clanpress' ),
      'edit_item'          => __( 'Edit Sponsor', 'clanpress' ),
      'view_item'          => __( 'View Sponsor', 'clanpress' ),
      'all_items'          => __( 'Sponsors', 'clanpress' ),
      'search_items'       => __( 'Search Sponsors', 'clanpress' ),
      'parent_item_colon'  => __( 'Parent Sponsor', 'clanpress' ),
      'not_found'          => __( 'No Sponsors found', 'clanpress' ),
      'not_found_in_trash' => __( 'No Sponsors found in trash', 'clanpress' ),
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
      'rewrite'             => array( 'slug' => 'sponsors' ),
      'query_var'           => true
    );
  }

  /**
   * @inheritdoc
   */
  protected function meta_boxes() {
    $boxes['sponsor'] = array(
      'title' => __( 'Sponsor', 'clanpress' ),
      'context' => 'normal',
      'priority' => 'default',
      'form_elements' => array(
        'website' => array(
          'type' => 'text',
          'label' => __( 'Website', 'clanpress' ),
          'default' => '',
          'pattern' => '^http[s]?:\/\/.*$',
        ),
      ),
    );

    return $boxes;
  }
}
