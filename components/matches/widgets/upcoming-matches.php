<?php
/**
 * @file
 * Contains the class of the custom 'Upcoming Matches' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Upcoming_Matches_Widget
 */
class Clanpress_Upcoming_Matches_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    query_posts( array(
      'posts_per_page' => (int) $instance['num_items'],
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'clanpress_match',
      'date_query' => array(
        'after' => date('Y-m-d'),
      ),
      'post_status' => 'future',
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
        'label' => __( 'Number of upcoming matches to show', 'clanpress' ),
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
    return __( 'Upcoming Matches', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays a list of upcoming matches.', 'clanpress' );
  }
}
