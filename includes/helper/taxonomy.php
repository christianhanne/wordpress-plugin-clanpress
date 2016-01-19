<?php
/**
 * @file
 * Contains the parent class of the plugin's custom taxonomies.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Taxonomy
 */
class Clanpress_Taxonomy {
  /**
   * Registers a new taxonomy with the name of the class.
   */
  function __construct() {
    $post_types = $this->post_types();
    if ( count( $post_types ) ) {
      $args = (array) $this->settings();
      $args['labels'] = (array) $this->labels();
      register_taxonomy( $this->id(), $post_types, $args );
    }
  }

  /**
   * Returns an array of settings for the custom taxonomy.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, no custom settings will be
   * added. Check the linked documentation for details. Please notice: Labels
   * should be defined in a separate function.
   *
   * @return array
   *   An array of settings for this taxonomy
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function settings() {
    return array();
  }

  /**
   * Returns an array of labels for the custom taxonomy.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, no custom labels will be added.
   *
   * @return array
   *   An array of labels for this taxonomy
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function labels() {
    return array();
  }

  /**
   * Returns an array of post types this taxonomy should be used in.
   *
   * Should be overwritten by the taxonomies extending this class. If no array
   * is returned or the returned array is empty, taxonomy won't be added.
   *
   * @return array
   *   Array of post types
   *
   * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
   */
  protected function post_types() {
    return array();
  }

  /**
   * Returns the machine-readable id of the taxonomy.
   *
   * The id is currently equivalent to the class name in lower case.
   * The "taxonomy" suffix will be removed, because of WordPress name
   * length restriction. Taxonomies extending this class should not overwrite
   * this function.
   *
   * @return string
   *   Machine-readable id of the taxonomy
   */
  final private function id() {
    $id = strtolower( get_class( $this ) );
    $id = str_replace( '_taxonomy', '', $id );
    return $id;
  }
}
