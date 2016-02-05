<?php
/**
 * @file
 * Contains the class of the custom 'Squad' post type.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

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
   * Adds custom save & delete method to deal with BuddyPress features.
   */
  function __construct() {
    parent::__construct();

    add_action( 'save_post', array( $this, 'save_post' ) );
    add_action( 'delete_post', array( $this, 'delete_post' ) );
  }

  /**
   * Create/update a BuddyPress group for this post.
   *
   * @param int $post_id
   *   The post id.
   */
  public function save_post( $post_id ) {
    $post = get_post( $post_id );

    // Check if a group has been stored previously.
    $group_id = get_post_meta( $post_id, 'clanpress_group_id', true );
    if ( function_exists('groups_create_group') ) {
      $group_id = groups_create_group( array(
        'group_id' => $group_id,
        'name' => $post->post_title,
        'description' => $post->post_excerpt,
        'status' => 'hidden',
      ) );

      update_post_meta( $post_id, 'clanpress_group_id', $group_id );
    }

    // Fetch the group's members.
    $user_ids = $this->get_group_member_ids( $group_id );
    $meta_data = $this->meta_boxes['members']->get_meta( $post_id );
    $members = isset( $meta_data['members'] ) ? json_decode( $meta_data['members'], true ) : array();

    // Add all new members newly selected in the post type.
    if ( function_exists('groups_join_group') ) {
      foreach ( $members as $user_id => $enabled ) {
        if ( !in_array( $user_id, $user_ids ) && $enabled == 1 )  {
          groups_join_group( $group_id, $user_id );
        }
      }
    }

    // Remove all members no longers selected in the post type.
    if ( function_exists('groups_leave_group') ) {
      foreach ( $user_ids as $user_id ) {
        if ( !isset( $members[ $user_id ] ) || $members[ $user_id ] != 1 ) {
          groups_leave_group( $group_id, $user_id );
        }
      }
    }
  }

  /**
   * Remove the BuddyPress group related to this post.
   *
   * @param int $post_id
   *   The post id.
   */
  public function delete_post( $post_id ) {
    $group_id = get_post_meta( $post_id, 'clanpress_group_id', true );
    if ( !empty( $group_id ) && function_exists('groups_delete_group') ) {
      groups_delete_group( $group_id );
    }
  }

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
      'all_items'          => __( 'Squads', 'clanpress' ),
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
      'show_in_menu'        => 'clanpress',
      'show_in_admin_bar'   => true,
      'menu_position'       => 100,
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
        'squad_type' => array(
          'type' => 'select',
          'options' => array(
            self::SQUAD_TYPE_PLAYING     => __( 'Playing', 'clanpress' ),
            self::SQUAD_TYPE_NOT_PLAYING => __( 'Not playing', 'clanpress' ),
          ),
          'default' => self::SQUAD_TYPE_PLAYING,
        ),
      ),
    );

    $boxes['members'] = array(
      'title' => __( 'Members', 'clanpress' ),
      'context' => 'normal',
      'priority' => 'default',
      'form_elements' => array(
        'members' => array(
          'type' => 'checkboxes',
          'options' => $this->get_user_options(),
          'default' => array(),
        ),
      ),
    );

    return $boxes;
  }

  /**
   * @inheritdoc
   */
  protected static function single_elements($post) {
    $elements = array();

    $games = array();
    foreach ( get_the_terms( $post, 'clanpress_game' ) as $term ) {
      array_push( $games, esc_html( $term->slug ) );
    }

    $group_id = get_post_meta( $post->ID, 'clanpress_group_id', true );
    $group_members_count = groups_get_total_member_count( $group_id );

    $squad_type_id = get_post_meta( $post->ID, 'clanpress_squad_squad_type[squad_type]', true );
    $squad_types = self::get_squad_types();

    $group = groups_get_group_members( array( 'group_id' => $group_id ) );
    $squad_members = $group['members'];

    $elements['squad_games_short'] = implode(', ', $games);
    $elements['squad_members'] = $squad_members;
    $elements['squad_members_count'] = $group_members_count;
    $elements['squad_link_awards'] = 'TODO';
    $elements['squad_link_matches'] = 'TODO';
    $elements['squad_type'] = $squad_types[ $squad_type_id ];

    return $elements;
  }

  /**
   * @inheritdoc
   */
  protected static function archive_elements($post) {
    $elements = array();

    $games = array();
    foreach ( get_the_terms( $post, 'clanpress_game' ) as $term ) {
      array_push( $games, esc_html( $term->slug ) );
    }

    $group_id = get_post_meta( $post->ID, 'clanpress_group_id', true );
    $group_members_count = groups_get_total_member_count( $group_id );

    $squad_type_id = get_post_meta( $post->ID, 'clanpress_squad_squad_type[squad_type]', true );
    $squad_types = self::get_squad_types();

    $elements['squad_games_short'] = implode(', ', $games);
    $elements['squad_members_count'] = $group_members_count;
    $elements['squad_link_awards'] = 'TODO';
    $elements['squad_link_matches'] = 'TODO';
    $elements['squad_type'] = $squad_types[ $squad_type_id ];

    return $elements;
  }

  /**
   * Returns an array of user ids associated with their user names.
   *
   * @return array
   *   Array of user names & ids.
   */
  private function get_user_options() {
    static $options;
    if ( !isset( $options ) ) {
      $options = array();
      foreach (get_users() as $user) {
        $options[ $user->ID ] = esc_html( $user->display_name );
      }
    }

    return $options;
  }

  /**
   * Returns an array of group member ids.
   *
   * @param int $group_id
   *   The buddypress group id.
   *
   * @return array
   *   Array of user ids.
   */
  private function get_group_member_ids( $group_id ) {
    $user_ids = array();
    if ( function_exists('groups_get_group_members') ) {
      $group = groups_get_group_members( array( 'group_id' => $group_id ) );
      foreach ($group['members'] as $member) {
        array_push( $user_ids, $member->ID );
      }
    }

    return $user_ids;
  }

  /**
   * TODO
   *
   * @return array
   *   TODO
   */
  private static function get_squad_types() {
    return array(
      self::SQUAD_TYPE_PLAYING     => __( 'Playing', 'clanpress' ),
      self::SQUAD_TYPE_NOT_PLAYING => __( 'Not playing', 'clanpress' ),
    );
  }
}
