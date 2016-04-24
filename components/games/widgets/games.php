<?php
/**
 * Contains the class of the custom 'Games' widget.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Games\Widgets
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Games_Widget extends Clanpress_Widget {
  /**
   * @{inheritdoc}
   */
  protected function template_elements( $instance = array() ) {
    $elements['display_name'] = $instance['display_name'] == 1;
    $elements['display_slug'] = $instance['display_slug'] == 1;
    $elements['display_icon'] = $instance['display_icon'] == 1;
    $elements['display_image'] = $instance['display_image'] == 1;

    $elements['terms'] = get_terms( 'clanpress_game', array(
      'hide_empty' => false,
    ) );

    if ( !is_array( $elements['terms'] ) ) {
      $elements['terms'] = array();
    }

    return $elements;
  }

  /**
   * @{inheritdoc}
   */
  protected function form_elements() {
    return array(
      'title' => array(
        'type' => 'text',
        'label' => __( 'Title' ),
        'default' => $this->name(),
      ),
      'display_name' => array(
        'type' => 'checkbox',
        'label' => __( 'Display game name', 'clanpress' ),
        'default' => true,
      ),
      'display_slug' => array(
        'type' => 'checkbox',
        'label' => __( 'Display game slug', 'clanpress' ),
      ),
      'display_icon' => array(
        'type' => 'checkbox',
        'label' => __( 'Display game icon', 'clanpress' ),
      ),
      'display_image' => array(
        'type' => 'checkbox',
        'label' => __( 'Display game image', 'clanpress' ),
      ),
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function name() {
    return __( 'Games', 'clanpress' );
  }

  /**
   * @{inheritdoc}
   */
  protected function description() {
    return __( 'Displays a list of games.', 'clanpress' );
  }
}
