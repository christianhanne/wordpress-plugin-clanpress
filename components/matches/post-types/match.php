<?php
/**
 * Contains the class of the custom 'Match' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Match_Post_Type
 */
class Clanpress_Match_Post_Type extends Clanpress_Post_Type {
  /**
   * @const string
   * Defines match type fun war.
   */
  const MATCH_TYPE_FUN = 'fun';

  /**
   * @const string
   * Defines match type official war.
   */
  const MATCH_TYPE_OFFICIAL = 'official';

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
      'all_items'          => __( 'Matches', 'clanpress' ),
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
      'show_in_menu'        => 'clanpress',
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-admin-appearance',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => array( 'title', 'editor', 'thumbnail' ),
      'has_archive'         => true,
      'rewrite'             => array( 'slug' => 'matches' ),
      'query_var'           => true
    );
  }

  /**
  * @inheritdoc
  */
  protected static function meta_boxes() {
    $boxes['match'] = array(
      'title' => __( 'Match', 'clanpress' ),
      'context' => 'normal',
      'priority' => 'default',
      'form_elements' => array(
        'link' => array(
          'type' => 'text',
          'label' => __( 'Link to the match', 'clanpress' ),
          'default' => '',
          'pattern' => '^http[s]?:\/\/.*$',
        ),
        'top_match' => array(
          'type' => 'checkbox',
          'label' => __( 'Mark as top match', 'clanpress' ),
          'description' => __( 'The most recent top match will be displayed in the top match widget.', 'clanpress' ),
          'default' => FALSE,
        ),
      ),
    );

    $boxes['result'] = array(
      'title' => __( 'Result', 'clanpress' ),
      'context' => 'normal',
      'priority' => 'default',
      'form_elements' => array(
        'squad' => array(
          'type' => 'text',
          'label' => __( 'Squad', 'clanpress' ),
          'default' => '',
          'pattern' => '^[0-9]+$',
        ),
        'opponent' => array(
          'type' => 'text',
          'label' => __( 'Opponent', 'clanpress' ),
          'default' => '',
          'pattern' => '^[0-9]+$',
        ),
      ),
    );

    $boxes['match_type'] = array(
      'title' => __( 'Match type', 'clanpress' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'match_type' => array(
          'type' => 'select',
          'options' => array(
            self::MATCH_TYPE_OFFICIAL => __( 'Official war', 'clanpress' ),
            self::MATCH_TYPE_FUN      => __( 'Fun war', 'clanpress' ),
          ),
          'default' => self::MATCH_TYPE_OFFICIAL,
        ),
      ),
    );

    $boxes['squads'] = array(
      'title' => __( 'Squads', 'clanpress' ),
      'context' => 'side',
      'priority' => 'default',
      'form_elements' => array(
        'squads' => array(
          'type' => 'checkboxes',
          'options' => Clanpress_Squads_Component::get_squad_options(),
          'default' => array(),
        ),
      ),
    );

    return $boxes;
  }
}
