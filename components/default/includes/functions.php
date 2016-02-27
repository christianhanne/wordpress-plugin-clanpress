<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

 /**
  * Includes a post type's content template.
  *
  * Will always use the global $post object to determine the post type.
  *
  * @param string $type
  *   Display type, either 'single' or 'archive'.
  */
function clanpress_content_template( $type ) {
  Clanpress_Post_Type::content_template( $type, get_post_type() );
}
