<?php
/**
 * Contains publicly accessible functions for this component.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Teamspeak\Theme
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * Displays a connect link for a given TS3 server address.
 *
 * @param string|null $address
 *   Server address.
 * @param string|null $port
 *   Server port.
 */
function clanpress_the_ts3_connect_link($address = null, $port = null) {
  if ( !empty($address) && !empty($port) ) {
    vprintf('<a href="ts3server://%s/?port=%s">%s</a>', array(
      esc_attr($address),
      esc_attr($port),
      __( 'Connect', 'clanpress' ),
    ) );
  }
}

/**
 * Displays the url of the TS3 connect link.
 *
 * @param string|null $address
 *   Server address.
 * @param string|null $port
 *   Server port.
 */
function clanpress_the_ts3_connect_url($address = null, $port = null) {
  if ( !empty($address) && !empty($port) ) {
    vprintf('ts3server://%s/?port=%s', array(
      esc_attr($address),
      esc_attr($port),
    ) );
  }
}
