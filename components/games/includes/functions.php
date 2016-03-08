<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Games
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays the image for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 *
 * @subpackage Theme
 */
function clanpress_the_game_image( $term_id, $size = 'thumbnail' ) {
  echo clanpress_get_game_image( $term_id, $size );
}

/**
 * Displays the icon for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 *
 * @subpackage Theme
 */
function clanpress_the_game_icon( $term_id, $size = null ) {
  echo clanpress_get_game_icon( $term_id, $size );
}

/**
 * Returns the image for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 *
 * @return string
 *    The game image as an image tag.
 *
 * @subpackage Theme
 */
function clanpress_get_game_image( $term_id, $size = 'thumbnail' ) {
  $meta = Clanpress_Game_Taxonomy::get_term_meta( $term_id );
  if ( !empty( $meta[ 'clanpress_game_image' ] ) ) {
    $attachment_id = (int) $meta[ 'clanpress_game_image' ];
    return wp_get_attachment_image( $attachment_id, $size );
  }

  return '';
}

/**
 * Returns the icon for the given term id.
 *
 * @param int $term_id
 *   The term id.
 * @param string|array $size
 *   Display size, either wordpress format or dimensions array.
 *
 * @return string
 *    The game icon as an image tag.
 *
 * @subpackage Theme
 */
function clanpress_get_game_icon( $term_id, $size = 'thumbnail' ) {
  $meta = Clanpress_Game_Taxonomy::get_term_meta( $term_id );
  if ( !empty( $meta[ 'clanpress_game_icon' ] ) ) {
    $attachment_id = (int) $meta[ 'clanpress_game_icon' ];
    return wp_get_attachment_image( $attachment_id, $size );
  }

  return '';
}
