<?php
/**
 * Contains the clanpress settings controller.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

/**
 * @class Clanpress_Settings
 */
class Clanpress_Settings {
  /**
   * @var array
   * Id of the settings section.
   */
  protected $id = null;

  /**
   * @var array
   * Name of the settings section.
   */
  protected $name = null;

  /**
   * @var array
   * Array of form elements for this section.
   */
  protected $elements = array();

  /**
   * Initializes a new settings section for a component.
   *
   * @param string $id
   *   Id of the settings section.
   * @param string $name
   *   Name of the settings section.
   * @param array $elements
   *   Array of form elements for this section.
   */
  public function __construct( $id = null, $name = null, $elements = array() ) {
    if ( !empty( $id ) && !empty( $name ) && count( $elements ) ) {
      $this->id = $id;
      $this->name = $name;
      $this->elements = $elements;
      $this->init();
    }
  }

  /**
   * TODO
   */
  public function init() {

  }
}
