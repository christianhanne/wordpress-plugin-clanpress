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
class Clanpress_Sponsors_Widget extends Clanpress_Widget {
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
        'label' => __( 'Number of sponsors to show', 'clanpress' ),
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
    return __( 'Sponsors', 'clanpress' );
  }

  /**
   * TODO
   */
  protected function description() {
    return __( 'Displays a list of sponsors.', 'clanpress' );
  }
}
