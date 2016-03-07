<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays the stored clan name.
 */
function clanpress_the_clan_name() {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['clan_name'] ) ) {
    echo esc_html( $settings['clan_name'] );
  }
}

/**
 * Displays the stored clan subtitle.
 */
function clanpress_the_subtitle() {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['clan_subtitle'] ) ) {
    echo esc_html( $settings['clan_subtitle'] );
  }
}

/**
 * Displays a previously stored header image.
 *
 * @param string $size
 *   Size of the image.
 */
function clanpress_the_header_image( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['header'] ) ) {
    echo wp_get_attachment_image( $settings['header'], $size );
  }
}

/**
 * Displays a previously stored icon image.
 *
 * @param string $size
 *   Size of the image.
 */
function clanpress_the_icon_image( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['icon'] ) ) {
    echo wp_get_attachment_image( $settings['icon'], $size );
  }
}

/**
 * Displays a previously stored logo image.
 *
 * @param string $size
 *   Size of the image.
 */
function clanpress_the_logo_image( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['logo'] ) ) {
    echo wp_get_attachment_image( (int) $settings['logo'], $size );
  }
}

/**
 * Returns the url of the header image.
 *
 * @param string $size
 *   Size of the image.
 *
 * @return string
 *   Url to the header image in the given size.
 */
function clanpress_get_header_image_src( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['header'] ) ) {
    return wp_get_attachment_image_src( $settings['header'], $size )[0];
  }
}

/**
 * Returns the url of the icon.
 *
 * @param string $size
 *   Size of the image.
 *
 * @return string
 *   Url to the icon in the given size.
 */
function clanpress_get_icon_image_src( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['icon'] ) ) {
    return wp_get_attachment_image_src( $settings['icon'], $size )[0];
  }
}

/**
 * Returns the url of the logo.
 *
 * @param string $size
 *   Size of the image.
 *
 * @return string
 *   Url to the logo in the given size.
 */
function clanpress_get_logo_image_src( $size = 'thumbnail' ) {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['logo'] ) ) {
    return wp_get_attachment_image_src( (int) $settings['logo'], $size )[0];
  }
}

/**
 * Displays the stored footer.
 */
function clanpress_the_footer() {
  $settings = Clanpress_Settings::instance()->get_values( 'admin' );
  if ( !empty( $settings['footer'] ) ) {
    echo nl2br( esc_html( $settings['footer'] ) );
  }
}
