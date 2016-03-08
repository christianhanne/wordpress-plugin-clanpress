<?php
/**
 * Contains the class of the custom 'Top Match' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Matches\Widgets
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Top_Match_Widget extends Clanpress_Widget {
  /**
   * @{inheritdoc}
   */
  protected function template_elements( $instance = array() ) {
    query_posts( array(
      'posts_per_page' => 1,
      'offset' => 0,
      'post_type' => 'clanpress_match',
      'meta_query' => array(
    		array(
    			'key' => 'clanpress_match_match[top_match]',
    			'value' => '1',
    		),
    	)
    ) );

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
      'show_names' => array(
        'type' => 'checkbox',
        'label' => __( 'Display names of the teams', 'clanpress' ),
        'default' => FALSE,
      ),
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function name() {
    return __( 'Top Match', 'clanpress' );
  }

  /**
   * @{inheritdoc}
   */
  protected function description() {
    return __( 'Displays the currently selected top match.', 'clanpress' );
  }
}
