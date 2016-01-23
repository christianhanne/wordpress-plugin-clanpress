<?php
/**
 * @file
 * Contains the class of the custom 'Latest Matches' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Latest_Matches_Widget
 */
class Clanpress_Latest_Matches_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    $elements = array();

    $args = array(
      'posts_per_page' => (int) $instance['num_items'],
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'clanpress_match',
    );

    $elements['links'] = array();
    foreach ( get_posts( $args ) as $post ) {
      array_push($elements['links'], array(
        'id' => $post->ID,
        'title' => esc_html( $post->post_title ),
        'href' =>  get_permalink( $post->ID ),
      ));
    }

    wp_reset_postdata();

    return $elements;
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
        'label' => __( 'Number of matches to show', 'clanpress' ),
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
    return __( 'Latest Matches', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays a list of the latest matches.', 'clanpress' );
  }
}
