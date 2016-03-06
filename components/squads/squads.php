<?php
/**
 * Contains the squads component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Squads_Component
 */
class Clanpress_Squads_Component extends Clanpress_Component {
  /**
   * @inheritdoc
   */
  public function __construct() {
    parent::__construct();

    new Clanpress_Squads_Multi_Site();
  }

  /**
   * Returns an array of squad options.
   *
   * @return array
   *   Array of squad post ids & titles.
   */
  public static function get_squad_options() {
    static $options;
    if ( !isset( $options ) ) {
      $args = array(
				'type' => 'alphabetical',
				'per_page' => 999
			);

      $groups = groups_get_groups( $args );
      foreach ( $groups['groups'] as $group ) {
        $options[ $group->id ] = $group->name;
      }
    }

    return $options;
  }

  /**
   * @inheritdoc
   */
  protected function admin_pages() {
    return array(
      'squads',
    );
  }

  /**
   * @inheritdoc
   */
  protected function group_extensions() {
    return array(
      'awards',
      'matches',
      'squad_type',
      'games',
    );
  }

  /**
   * @inheritdoc
   */
  protected function includes() {
    return array(
      'functions',
      'multi-site',
    );
  }

  /**
   * @inheritdoc
   */
  protected function widgets() {
    return array(
      'members',
      'squads',
    );
  }
}
