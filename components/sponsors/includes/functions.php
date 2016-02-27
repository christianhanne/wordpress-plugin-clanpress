<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
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

  $website = get_post_meta( $post->ID, 'clanpress_sponsor_sponsor[website]', true);
  vprintf('<a href="%s">%s</a>', array(
    esc_url( $website ),
    __( 'To the sponsor', 'clanpress' ),
  ));
}
