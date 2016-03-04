<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays the link to the sponsor website.
 *
 * @param WP_Post $post
 *   The post.
 */
function clanpress_the_sponsor_link($post = null) {
  $post = isset( $post ) ? $post : get_post();

  $website = Clanpress_Sponsor_Post_Type( $post->ID, 'sponsor', 'website' );
  if ( $website ) {
    vprintf('<a href="%s">%s</a>', array(
      esc_url( $website ),
      __( 'To the sponsor', 'clanpress' ),
    ));
  }
}
