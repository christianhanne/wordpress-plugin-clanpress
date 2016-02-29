<?php
/**
 * Contains the class of the custom 'Setup' admin page.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Setup_Page
 */
class Clanpress_Setup_Page extends Clanpress_Page {
  /**
   * @inheritdoc
   */
  function __construct() {
    if ( $this->requirements_met() ) {
      if ( !empty($_POST['clanpress_mode']) ) {
        $this->process_mode( $_POST['clanpress_mode'] );
      }
      else if ( count( $this->get_modes() ) === 1 ) {
        $mode = current( array_keys( $this->get_modes() ) );
        $this->process_mode( $mode );
      }
    }
    else {
      parent::__construct();
    }
  }

  /**
   * @inheritdoc
   */
  protected function settings() {
    return array(
      'page_title' => __( 'Clanpress', 'clanpress' ),
      'menu_title' => __( 'Clanpress', 'clanpress' ),
      'capability' => 'manage_options', // TODO: Add correct capability.
      'menu_slug' => 'clanpress',
      'function' => array( $this, 'render' ),
      'icon_url' => NULL,
      'position' => 99,
    );
  }

  /**
   * Renders a setup page.
   *
   * @TODO Add a template for this. Feels wrong to output this in a function.
   */
  public function render() {
    if ( !$this->requirements_met() ) {
      echo '<h1>' . __( 'Clanpress', 'clanpress' ) . '</h1>';
      echo '<div class="update-nag">';
      echo '<h2>Buddypress not found!</h2>';
      echo '<p>' . __( 'This plugin requires Buddypress to function properly.', 'clanpress' ) . '</p>';
      echo '<p>' . __( 'Please install & enable the latest version of this plugin:', 'clanpress' ) . '<br />';
      echo '<a href="https://buddypress.org/download/">Download</a></p>';
      echo '</div>';
    } else {
      echo '<h1>' . __( 'Clanpress', 'clanpress' ) . '</h1>';

      $component = Clanpress_Helper::get_component_by_path( __FILE__ );
      $script_uri = Clanpress_Helper::get_scripts_uri( $component ) . 'setup.min.js';
      wp_enqueue_script( 'clanpress_setup', $script_uri );

      echo '<form method="POST" action="' . admin_url('admin.php?page=clanpress') . '">';

      echo '<div class="clanpress_modes">';
      echo '<p>';
      echo __( 'Please select the plugin mode. ', 'clanpress' );
      echo __( 'Please note that it is not recommended to change plugin modes.', 'clanpress' );
      echo '</p>';

      foreach ( $this->get_modes() as $id => $mode ) {
        echo '<div class="clanpress_modes__mode" data-mode="' . $id . '">';
        echo '<div class="clanpress_modes__image">';
        echo '<img src="' . $mode['thumbnail'] . '" alt="' . $mode['name'] . '" />';
        echo '</div>';
        echo '<div class="clanpress_modes__description">';
        echo '<strong>' . $mode['name'] . '</strong>';
        echo '<em>' . $mode['description'] . '</em>';
        echo '</div>';
        echo '</div>';
      }

      echo '</div>';
      echo '<input id="clanpress_mode" name="clanpress_mode" type="hidden" value="" />';
      echo '<input type="submit" value="' . __( 'Store plugin mode', 'clanpress' ) . '" />';
      echo '</form>';
    }
  }

  /**
   * Stores the given mode & redirects to the default wordpress admin page.
   *
   * @param string $mode
   *   The mode's name.
   */
  private function process_mode( $mode ) {
    update_option( 'clanpress_mode', $mode, true );
    wp_redirect( admin_url('index.php') );
    exit;
  }

  /**
   * Returns an array of available
   *
   * @return array
   *   Array of game modes.
   */
  private function get_modes() {
    $modes = array();
    foreach ( Clanpress::modes() as $mode ) {
      require_once( Clanpress_Helper::get_modes_path() . $mode . '.php' );
      $mode_class = Clanpress::get_mode_class( $mode );

      $modes[ $mode ] = array(
        'name' => $mode_class::name(),
        'description' => $mode_class::description(),
        'thumbnail' => $mode_class::thumbnail(),
      );
    }

    return $modes;
  }

  /**
   * Returns if the requirements have been met.
   *
   * @return boolean
   *   True, if all requirements are met.
   *
   * @TODO Learn how to correctly check for extensions & use this method.
   */
  private function requirements_met() {
    foreach ( $this->requirements() as $requirement ) {
      if ( !function_exists( $requirement ) ) {
        return FALSE;
      }
    }

    return TRUE;
  }

  /**
   * Returns an array of required functions for the clanpress plugin.
   *
   * @return array
   *   Required functions.
   */
  private function requirements() {
    return array(
      'bp_core_fetch_avatar',
      'bp_core_get_userlink',
      'groups_get_group_members',
    );
  }
}
