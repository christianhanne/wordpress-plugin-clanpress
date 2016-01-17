<?php
/**
 * @file
 * Contains the parent class of the plugin's custom post types.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Post_Type
 */
class Clanpress_Post_Type {
  /**
   * Returns the machine-readable id of the post type.
   *
   * The id is currently equivalent to the class name in lower case. Post types
   * extending this class should not overwrite this function.
   *
   * @return string
   *   Machine-readable id of the post type
   */
  final private function id() {
    return strtolower( get_class( $this ) );
  }
}
