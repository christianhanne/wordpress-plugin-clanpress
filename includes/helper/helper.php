<?php
/**
 * Contains basic helper functions for various purposes.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Helper
 */
class Clanpress_Helper {
    /**
     * Returns an array of squad options.
     *
     * @return array
     *   Array of squad post ids & titles.
     */
    public static function get_squad_options() {
      static $options;
      if ( !isset( $options ) ) {
        $args = array(
          'orderby' => 'title',
          'order' => 'ASC',
          'post_type' => 'clanpress_squad',
        );

        foreach ( get_posts( $args ) as $post ) {
          $options[ $post->ID ] = $post->post_title;
        }
      }

      return $options;
    }

    /**
     * Returns an uri for a specific library.
     *
     * @param string $library
     *   Folder name of the library to include.
     *
     * @return string
     *   Uri of the library.
     */
    public static function get_library_uri( $library ) {
      return CLANPRESS_PLUGIN_URL . 'dist/vendor/' . $library;
    }

    /**
     * Returns an uri for the scripts folder.
     *
     * @return string
     *   Uri of the scripts folder.
     */
    public static function get_scripts_uri() {
      return CLANPRESS_PLUGIN_URL . 'dist/js/';
    }
}
