<?php
/**
 * Contains the Clanpress modes parent class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/**
 * @class Clanpress_Mode
 */
class Clanpress_Mode {
  /**
   * Add all registered components.
   */
  function __construct() {
    $components = $this->components();
    if ( !in_array( 'shared', $components ) ) {
      array_unshift( $components, 'shared' );
    }

    foreach ( $components as $component ) {
      $this->add_component( $component );
    }
  }

  /**
   * Adds the component with the given name.
   *
   * @param string $id
   *   Id of the component.
   */
  private function add_component( $id ) {
    $component_path = Clanpress_Helper::get_component_path( $id );
    require_once $component_path . $id . '.php';

    $component = $this->get_component_class( $id );
    new $component();
  }

  /**
   * Returns the class name for a given component id.
   *
   * @param string $id
   *   Id of the component.
   *
   * @return string
   *   Name of the component's class.
   */
  private function get_component_class( $id ) {
    return 'Clanpress_' . ucwords($id) . '_Component';
  }
}
