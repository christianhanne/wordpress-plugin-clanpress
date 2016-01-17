<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 *
 * @link https://www.planetteamspeak.com/rest-api/
 */

/**
 * TODO
 */
class Clanpress_Teamspeak_Widget extends Clanpress_Widget {
  /**
   * TODO
   */
  const TEAMSPEAK_API = 'https://api.planetteamspeak.com/serverstatus/';

  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    $elements = array();
    $elements['error'] = NULL;

    $result = $this->server_status( $instance['address'], $instance['port'] );
    if ( empty( $result ) ) {
      $elements['error'] = __( 'Unable to connect to server.', 'clanpress' );
    }
    else if ( isset( $result->message ) ) {
      $elements['error'] = esc_html( $result->message );
    }
    else {
      $elements['name'] = esc_html( $result->name );
      $elements['address'] = esc_html( $result->address );
      $elements['country'] = esc_html( $result->country );
      $elements['users'] = esc_html( $result->users );
      $elements['slots'] = esc_html( $result->slots );
      $elements['online'] = !!$result->online;
    }

    return $elements;
  }

  /**
   * @inheritdoc
   */
  protected function form_elements() {
    return array(
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title', 'clanpress' ),
        'default' => $this->name(),
      ),
      'address' => array(
        'type' => 'text',
        'label' => __( 'IP', 'clanpress' ),
        'default' => '127.0.0.1',
        'pattern' => '^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$',
      ),
      'port' => array(
        'type' => 'text',
        'label' => __( 'Port', 'clanpress' ),
        'default' => '80',
        'pattern' => '^[0-9]+$',
      ),
    );
  }

  /**
   * TODO
   */
  protected function name() {
    return __( 'TS Viewer', 'clanpress' );
  }

  /**
   * TODO
   */
  protected function description() {
    return __( 'Displays a visually appealing view of your TeamSpeak server.', 'clanpress' );
  }

  /**
   * TODO
   */
  private function server_status($address = '', $port = '') {
    if ( !class_exists( 'WP_Http' ) ) {
      include_once( ABSPATH . WPINC. '/class-http.php' );
    }

    $request = new WP_Http;
    $result = $request->request(self::TEAMSPEAK_API . $address . ':' . $port );
    if ( !isset( $result['body'] ) ) {
      return NULL;
    }
    else if ( $body = @json_decode( $result['body'] ) ) {
      return isset( $body->result ) ? $body->result : NULL;
    }
    else {
      return NULL;
    }
  }
}
