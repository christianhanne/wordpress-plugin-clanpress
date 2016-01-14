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
class Clanpress_Top_Match_Widget extends Clanpress_Widget {
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
      'show_names' => array(
        'type' => 'checkbox',
        'label' => __( 'Display names of the teams', 'clanpress' ),
        'default' => FALSE,
      ),
    );
  }

  /**
   * TODO
   */
  protected function name() {
    return __( 'Top Match', 'clanpress' );
  }

  /**
   * TODO
   */
  protected function description() {
    return __( 'Displays the currently selected top match.', 'clanpress' );
  }
}
