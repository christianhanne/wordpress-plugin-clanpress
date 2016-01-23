<?php
/**
 * @file
 * Contains the parent class of the plugin's custom taxonomies.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Taxonomy
 */
class Clanpress_Taxonomy {
  /**
   * Registers a new taxonomy with the name of the class.
   *
   * @param bool $register
   *   Flag can be used to skip registration process.
   */
  function __construct($register = true) {
    if ( $register === true ) {
      $post_types = $this->post_types();
      if ( count( $post_types ) ) {
        $args = (array) $this->settings();
        $args['labels'] = (array) $this->labels();
        register_taxonomy( $this->id(), $post_types, $args );

        add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
        add_action( 'parent_file', array( $this, 'register_parent_file' ) );
      }
    }
  }

  /**
   * Registers taxonomy as submenu page of plugin menu item.
   */
  public static function register_admin_page() {
    $class_name = get_called_class();
    $class = new $class_name( false );
    $labels = $class->labels();

    add_submenu_page(
      'clanpress',
      $labels['name'],
      $labels['name'],
      'edit_others_posts', // TODO: Use correct capability_type.
      'edit-tags.php?taxonomy=' . $class->id()
    );
  }

  /**
   * Filter the parent file of an admin menu sub-menu item.
   *
   * @param string $parent_file
   *   The parent file.
   *
   * @return string
   *   The updated parent file.
   */
  public static function register_parent_file( $parent_file ) {
    global $current_screen;
	  if ( $current_screen->taxonomy == self::id() ) {
      $parent_file = 'clanpress';
    }

    return $parent_file;
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
  final private static function id() {
    $id = strtolower( get_called_class() );
    $id = str_replace( '_taxonomy', '', $id );
    return $id;
  }
}
