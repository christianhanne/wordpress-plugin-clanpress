<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

 /**
  * Includes a post type's content template.
  *
  * Will always use the global $post object to determine the post type.
  *
  * @param string $type
  *   Display type, either 'single' or 'archive'.
  *
  * @subpackage Theme
  */
function clanpress_content_template( $type ) {
  $post_type = get_post_type();
  $class = Clanpress_Post_Type::get_class_name( $post_type );
  $class::content_template( $type, $post_type );
}

/**
 * Returns an image tag for the given attachment id & size.
 *
 * This is a wrapper for the original wordpress function used
 * to deal with vector based images.
 *
 * @param int $attachment_id
 *   The attachment id.
 * @param string $size
 *   Valid size declaration. See linked function for details.
 *
 * @return string
 *   Image tag.
 *
 * @see wp_get_attachment_image()
 */
function clanpress_get_image( $attachment_id, $size = 'thumbnail' ) {
  $attachment_url =  wp_get_attachment_url( $attachment_id );
  if ( !is_empty( $attachment_url ) && substr( $attachment_url, -4 ) === '.svg' ) {
    return '<img src="' . $attachment_url . '" alt="SVG" />';
  }

  return wp_get_attachment_image( $attachment_id, $size );
}

/**
 * Returns an url for the given attachment id & size.
 *
 * This is a wrapper for the original wordpress function used
 * to deal with vector based images.
 *
 * @param int $attachment_id
 *   The attachment id.
 * @param string $size
 *   Valid size declaration. See linked function for details.
 *
 * @return string
 *   Image url.
 *
 * @see wp_get_attachment_image()
 */
function clanpress_get_image_src( $attachment_id, $size = 'thumbnail' ) {
  $attachment_url =  wp_get_attachment_url( $attachment_id );
  if ( !is_empty( $attachment_url ) && substr( $attachment_url, -4 ) === '.svg' ) {
    return $attachment_url;
  }

  return wp_get_attachment_image_src( $attachment_id, $size )[0];
}
