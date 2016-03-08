<?php
/**
 * Contains the custom meta box "Games" for buddypress groups.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads\Group Extensions
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Games_Group_Extension extends Clanpress_Group_Extension {
	/**
   * @{inheritdoc}
   */
  protected function settings() {
    return array(
      'name' => __( 'Games', 'clanpress' ),
      'show_tab' => 'noone',
    );
  }

  /**
   * @{inheritdoc}
   */
  public function settings_screen( $group_id = NULL ) {
    parent::settings_screen( $group_id );
  }

  /**
   * @{inheritdoc}
   */
  public function settings_screen_save( $group_id = NULL ) {
    parent::settings_screen_save( $group_id );
  }

  /**
   * @{inheritdoc}
   */
  protected function form_elements() {
    return array(
      'games' => array(
        'type' => 'checkboxes',
        'label' => __( 'Games', 'clanpress' ),
        'options' => $this->get_games(),
        'default' => array(),
      ),
    );
  }

  /**
   * Returns an associative array of game terms.
   *
   * @return array
   *   Array of games.
   */
  protected function get_games() {
    $games = array();

    $terms = get_terms( 'clanpress_game', array(
      'orderby' => 'name',
      'hide_empty' => false,
    ) );

    foreach ( $terms as $term ) {
      $games[ $term->term_id ] = $term->name;
    }

    return $games;
  }
}
