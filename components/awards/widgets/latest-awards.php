<?php
/**
 * Contains the class of the custom 'Latest Awards' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Latest_Awards_Widget
 */
class Clanpress_Latest_Awards_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    query_posts( array(
      'posts_per_page' => (int) $instance['num_items'],
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'clanpress_award',
    ) );

    return array();
  }

  /**
   * @inheritdoc
   */
  protected function form_elements() {
    return array(
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title' ),
        'default' => $this->name(),
      ),
      'num_items' => array(
        'type' => 'number',
        'label' => __( 'Number of awards to show', 'clanpress' ),
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
   * @inheritdoc
   */
  protected function name() {
    return __( 'Latest Awards', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays a list of the latest awards.', 'clanpress' );
  }
}
