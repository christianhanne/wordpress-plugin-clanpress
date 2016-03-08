<?php
/**
 * Contains the class of the custom 'Sponsors' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Sponsors\Widgets
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * {inheritdoc}
 */
class Clanpress_Sponsors_Widget extends Clanpress_Widget {
  /**
   * @{inheritdoc}
   */
  protected function template_elements( $instance = array() ) {
    query_posts( array(
      'posts_per_page' => (int) $instance['num_items'],
      'offset' => 0,
      'orderby' => 'title',
      'order' => 'ASC',
      'post_type' => 'clanpress_sponsor',
    ) );

    return array();
  }

  /**
   * {inheritdoc}
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
   * {inheritdoc}
   */
  protected function name() {
    return __( 'Sponsors', 'clanpress' );
  }

  /**
   * {inheritdoc}
   */
  protected function description() {
    return __( 'Displays a list of sponsors.', 'clanpress' );
  }
}
