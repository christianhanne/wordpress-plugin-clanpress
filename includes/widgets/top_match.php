<?php
/**
 * @file
 * Contains the class of the custom 'Top Match' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Top_Match_Widget
 */
class Clanpress_Top_Match_Widget extends Clanpress_Widget {
  /**
   * @inheritdoc
   */
  protected function template_elements( $instance = array() ) {
    query_posts( array(
      'posts_per_page' => 1,
      'offset' => 0,
      'post_type' => 'clanpress_match',
      'meta_query' => array(
    		array(
    			'key' => 'clanpress_match_top_match[match_type]',
    			'value' => '1',
    		),
    	)
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
   * @inheritdoc
   */
  protected function name() {
    return __( 'Top Match', 'clanpress' );
  }

  /**
   * @inheritdoc
   */
  protected function description() {
    return __( 'Displays the currently selected top match.', 'clanpress' );
  }
}
