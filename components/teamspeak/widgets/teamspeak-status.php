<?php
/**
 * Contains the class of the custom 'Teamspeak' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Teamspeak_Widget
 */
class Clanpress_Teamspeak_Status_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    $library_uri = Clanpress_Helper::get_library_uri('jquery-ts3status');

    $plugin_uri = $library_uri . '/src/jquery.ts3status.min.js';
    wp_enqueue_script( 'clanpress_jquery_ts3status_plugin', $plugin_uri );

    $component = Clanpress_Helper::get_component_by_path( __FILE__ );
    $script_uri = Clanpress_Helper::get_scripts_uri( $component ) . 'teamspeak-status.min.js';
    wp_enqueue_script( 'clanpress_jquery_ts3status', $script_uri );

    return array(
      'address' => esc_attr( $instance['address'] ),
      'port' => esc_attr( $instance['port'] ),
    );
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
   * @inheritdoc
   */
  protected function name() {
    return __( 'TS3 Status', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays the server status for a teamspeak server.', 'clanpress' );
  }
}
