<?php
/**
 * Contains overrides for buddypress groups.
 *
 * Some of the code is taken from the following repository:
 * https://github.com/strangerstudios/bp-site-groups
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * TODO
 */
class Clanpress_Squads_Multi_Site  {
  /**
   * Wire up filters and actions for squads multi site support.
   */
  public function __construct() {
    if ( function_exists('get_blog_details') ) {
      add_action( 'groups_created_group', array( $this, 'group_meta_save' ) );
      add_filter( 'groups_get_groups', array( $this, 'groups_get_groups' ) );
      add_action( 'template_redirect', array( $this, 'template_redirect' ) );
      add_action( 'admin_init', array( $this, 'admin_init_redirect' ) );
    }
  }

  /**
   * Store id of the current blog with the group data.
   *
   * @param int $group_id
   *   The group id.
   */
  public function group_meta_save( $group_id ) {
  	$blog = get_blog_details( get_current_blog_id(), true );
		groups_update_groupmeta( $group_id, 'clanpress_blog_id', $blog->blog_id );
  }

  /**
   * Filter groups by blog id if set.
   *
   * @param array $groups
   *   Unfiltered array of groups.
   *
   * @return array
   *   Filtered array of groups.
   */
  public function groups_get_groups( $groups ) {
    $blog = get_blog_details( get_current_blog_id(), true );

    $settings = Clanpress_Settings::instance()->get_values( 'squads' );
    $show_old_groups = @!!$settings['show_old_groups'];

    $groups_filtered = array();
    foreach ( $groups['groups'] as $group ) {
      $clanpress_blog_id = groups_get_groupmeta( $group->id, 'clanpress_blog_id' );
      if ( $clanpress_blog_id == $blog->blog_id ) {
        array_push( $groups_filtered, $group );
      } else if ( $show_old_groups && empty( $clanpress_blog_id ) ) {
        array_push( $groups_filtered, $group );
      }
    }

  	$groups['groups'] = $groups_filtered;
  	$groups['total'] = count( $groups_filtered );

  	return $groups;
  }

  /**
   * Redirects user's if the try to access groups out of their blog scope.
   */
  function template_redirect() {
  	if ( !function_exists('bp_get_current_group_id') ) {
      return;
    }

    $group_id = bp_get_current_group_id();
    if ( empty( $group_id ) ) {
      return;
    }

		$blog = get_blog_details( get_current_blog_id(), true );
		$clanpress_blog_id = groups_get_groupmeta( $group_id, 'clanpress_blog_id' );

		if ( $blog->blog_id != $clanpress_blog_id ) {
			wp_redirect( home_url() );
			exit;
		}
  }

  /**
   * Redirects user's if the try to access groups out of their blog scope.
   */
  function admin_init_redirect() {
    if ( empty( $_REQUEST['page'] ) || $_REQUEST['page'] != 'bp-groups') {
      return;
    }

    if ( empty( $_REQUEST['action'] ) || $_REQUEST['action'] != 'edit' ) {
      return;
    }

    if ( empty( $_REQUEST['gid'] ) ) {
      return;
    }

    $group_id = (int) $_REQUEST['gid'];
		$blog = get_blog_details( get_current_blog_id(), true );
		$clanpress_blog_id = groups_get_groupmeta( $group_id, 'clanpress_blog_id' );

  	if ( $blog->blog_id != $clanpress_blog_id ) {
			wp_redirect( admin_url() );
			exit;
  	}
  }
}
