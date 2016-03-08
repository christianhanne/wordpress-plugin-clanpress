<?php
/**
 * Contains the custom extension "Matches" for buddypress groups.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads\Group Extensions
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Matches_Group_Extension extends Clanpress_Group_Extension {
  /**
   * @var int
   * Numbers of posts to display per page.
   */
  const POSTS_PER_PAGE = 5;

	/**
   * @{inheritdoc}
   */
  protected function settings() {
    return array(
      'name' => __( 'Matches', 'clanpress' ),
      'show_tab' => 'anyone',
    );
  }

  /**
   * Displays an archive of matches posts attached to this group.
   *
   * @param int|null $group_id
   *   The group id.
   */
  public function display( $group_id = null ) {
    query_posts( array(
      'posts_per_page' => self::POSTS_PER_PAGE,
      'offset' => 0,
      'post_type' => 'clanpress_match',
      'meta_query' => array(
    		array(
    			'key' => 'clanpress_match_squads[squads][' . $group_id . ']',
    			'value' => '1',
    		),
    	)
    ) );

    if ( have_posts() ) {
      while ( have_posts() ) {
        the_post();
        clanpress_content_template( 'archive' );
      }
    }

    wp_reset_query();
  }
}
