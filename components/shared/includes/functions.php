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
