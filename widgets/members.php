<?php
/**
 * @file
 * Contains the class of the custom 'Members' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Members_Widget
 */
class Clanpress_Members_Widget extends Clanpress_Widget {
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
   *
   * @todo Actually fetch squads from the database.
   */
  private function squads_options() {
    return array(
      0 => __( 'All squads', 'clanpress' ),
    );
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
