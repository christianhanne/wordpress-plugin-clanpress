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
   * Registers a new post type with the name of the class.
   */
  function __construct() {
    $args = (array) $this->settings();
    $args['labels'] = (array) $this->labels();
    register_post_type( $this->id(), $args );
  }

  /**
   * Returns an array of settings for the custom post type.
   *
   * Should be overwritten by the post types extending this class. If no array
   * is returned or the returned array is empty, no custom settings will be
   * added. Check the linked documentation for details. Please notice: Labels
   * should be defined in a separate function.
   *
   * @return array
   *   An array of settings for this post type
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  protected function settings() {
    return array();
  }

  /**
   * Returns an array of labels for the custom post type.
   *
   * Should be overwritten by the post types extending this class. If no array
   * is returned or the returns array is empty, no custom labels will be added.
   *
   * @return array
   *   An array of labels for this post type
   *
   * @link http://codex.wordpress.org/Function_Reference/register_post_type
   */
  protected function labels() {
    return array();
  }

  /**
   * Returns the machine-readable id of the post type.
   *
   * The id is currently equivalent to the class name in lower case.
   * The "post_type" suffix will be removed, because of WordPress name
   * length restriction. Post types extending this class should not overwrite
   * this function.
   *
   * @return string
   *   Machine-readable id of the post type
   */
  final private function id() {
    $id = strtolower( get_class( $this ) );
    $id = str_replace( '_post_type', '', $id );
    return $id;
  }
}
