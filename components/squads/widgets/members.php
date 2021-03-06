<?php
/**
 * Contains the class of the custom 'Members' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads\Widgets
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Members_Widget extends Clanpress_Widget {
  /**
   * @{inheritdoc}
   */
  protected function template_elements( $instance = array() ) {
    $args = array(
      'max' => (int) $instance['num_items'],
      'group_id' => (int) $instance['squads'],
      'exclude_admins_mods' => false,
    );

    clanpress_query_squad_members( $args );

    return array();
  }

  /**
   * @{inheritdoc}
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
        'label' => __( 'Squad', 'clanpress' ),
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
    $options += Clanpress_Squads_Component::get_squad_options();
    return $options;
  }

  /**
   * @{inheritdoc}
   */
  protected function name() {
    return __( 'Members', 'clanpress' );
  }

  /**
   * @{inheritdoc}
   */
  protected function description() {
    return __( 'Displays a list of members.', 'clanpress' );
  }
}
