<?php
/**
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Squads\Pages
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Squads_Page extends Clanpress_Page {
  /**
   * @{inheritdoc}
   */
  function __construct() {
    parent::__construct();

    add_action( 'admin_init', array( $this, 'remove_menu_page' ) );
    if ( function_exists( 'bp_groups_admin_load' ) ) {
      add_action( 'load-' . $this->hook, 'bp_groups_admin_load' );
    }
  }

  /**
   * Render the buddypress groups table using buddypress functions.
   *
   * This is probably not safe due to changes in the buddypress plugin. So in
   * case this ever changes, we add a check for this required functions.
   */
  public function render() {
    if ( function_exists( 'bp_groups_admin_load' ) && function_exists( 'bp_groups_admin' ) ) {
      bp_groups_admin();
    } else {
      echo '<p>' . __( 'Unable to display admin groups table.', 'clanpress' ) . '</p>';
    }
  }

  /**
   * Remove the default buddypress squads item from the admin menu.
   */
  public function remove_menu_page() {
    remove_menu_page( 'bp-groups' );
  }

  /**
   * @{inheritdoc}
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Squads', 'clanpress' ),
      'menu_title' => __( 'Squads', 'clanpress' ),
      'capability' => 'bp_moderate',
      'menu_slug' => 'admin.php?page=clanpress/squads',
      'function' => array( $this, 'render' ),
    );
  }
}
