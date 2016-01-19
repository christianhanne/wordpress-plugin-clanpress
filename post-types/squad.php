<?php
/**
 * @file
 * Contains the class of the custom 'Squad' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Squad_Post_Type
 */
class Clanpress_Squad_Post_Type extends Clanpress_Post_Type {
  /**
   * @const string
   * Defines squad as playing.
   */
  const SQUAD_TYPE_PLAYING = 'playing';

  /**
   * @const string
   * Defines squad as not playing.
   */
  const SQUAD_TYPE_NOT_PLAYING = 'not_playing';

  /**
   * @inheritdoc
   */
  protected function labels() {
    return array(
      'name'               => __( 'Squads', 'clanpress' ),
      'singular_name'      => __( 'Squad', 'clanpress' ),
      'menu_name'          => __( 'Squads', 'clanpress' ),
      'name_admin_bar'     => __( 'Squad', 'clanpress' ),
      'add_new'            => __( 'Add new', 'clanpress' ),
      'add_new_item'       => __( 'Add new Squad', 'clanpress' ),
      'new_item'           => __( 'New Squad', 'clanpress' ),
      'edit_item'          => __( 'Edit Squad', 'clanpress' ),
      'view_item'          => __( 'View Squad', 'clanpress' ),
      'all_items'          => __( 'All Squads', 'clanpress' ),
      'search_items'       => __( 'Search Squads', 'clanpress' ),
      'parent_item_colon'  => __( 'Parent Squad', 'clanpress' ),
      'not_found'          => __( 'No Squads found', 'clanpress' ),
      'not_found_in_trash' => __( 'No Squads found in trash', 'clanpress' ),
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
      'supports'            => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'         => true,
      'rewrite'             => array( 'slug' => 'squads' ),
      'query_var'           => true
    );
  }

  /**
   * @inheritdoc
   */
  protected function meta_boxes() {
    $boxes['squad_type'] = array(
      'title' => __( 'Squad type', 'clanpress' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'placement' => array(
          'type' => 'select',
          'options' => array(
            self::SQUAD_TYPE_PLAYING     => __( 'Playing', 'clanpress' ),
            self::SQUAD_TYPE_NOT_PLAYING => __( 'Not playing', 'clanpress' ),
          ),
          'default' => self::SQUAD_TYPE_PLAYING,
        ),
      ),
    );

    $boxes['games'] = array(
      'title' => __( 'Games', 'clanpress' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'squads' => array(
          'type' => 'checkboxes',
          'options' => array( 'TODO' => 'TODO' ),
          'default' => array( 'TODO' ),
        ),
      ),
    );

    $boxes['members'] = array(
      'title' => __( 'Members', 'clanpress' ),
      'context' => 'normal',
      'priority' => 'default',
      'form_elements' => array(
        'squads' => array(
          'type' => 'checkboxes',
          'options' => array( 'TODO' => 'TODO' ),
          'default' => array( 'TODO' ),
        ),
      ),
    );

    return $boxes;
  }
}
