<?php
/**
 * @file
 * Contains the class of the custom 'Members' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Members_Widget
 */
class Clanpress_Members_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    $elements = array();

    $args = array(
      'number' => (int) $instance['num_items'],
      'offset' => 0,
      'orderby' => 'name',
      'order' => 'ASC',
    );

    $squad_id = (int) $instance['squads'];
    if ( $squad_id !== 0) {
      $key = 'clanpress_squad_members[members]';
      $args['include'] = get_post_meta( $squad_id, $key );
    }

    $elements['members'] = array();
    $user_query = new WP_User_Query( $args );
    foreach ( $user_query->results as $user ) {
      array_push($elements['members'], array(
        'id' => $user->ID,
        'name' => esc_html( $user->display_name ),
      ));
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
      'squads' => array(
        'type' => 'select',
        'options' => $this->squads_options(),
        'default' => 0,
      ),
      'num_items' => array(
        'type' => 'number',
        'label' => __( 'Number of members to show', 'clanpress' ),
        'default' => 5,
        'pattern' => '^[0-9]+$',
        'attributes' => array(
          'step' => 1,
          'min' => 1,
          'size' => 3,
        ),
      ),
    );
  }

  /**
   * Returns an array of options for the squads select.
   *
   * @return array
   *   Array of squads options
   */
  private function squads_options() {
    $options = array( __( 'All squads', 'clanpress' ) );
    $options += Clanpress_Helper::get_squad_options();
    return $options;
  }

  /**
   * @inheritdoc
   */
  protected function name() {
    return __( 'Members', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays a list of members.', 'clanpress' );
  }
}
