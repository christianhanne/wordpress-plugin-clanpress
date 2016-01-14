<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * TODO
 */
class Clanpress_Squads_Widget extends Clanpress_Widget {
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
      'num_items' => array(
        'type' => 'number',
        'label' => __( 'Number of squads to show', 'clanpress' ),
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
   * TODO
   */
  protected function name() {
    return __( 'Squads', 'clanpress' );
  }

  /**
   * TODO
   */
  protected function description() {
    return __( 'Displays a list of squads.', 'clanpress' );
  }
}
