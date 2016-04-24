<?php
/**
 * Contains the shared component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Shared
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @{inheritdoc}
 */
class Clanpress_Shared_Component extends Clanpress_Component {

  /**
   * Setup clanpress shared component.
   */
  public function __construct() {
    parent::__construct();

    add_filter('upload_mimes', array( $this, 'upload_mimes' ) );
  }

  /**
   * Update allowed mime types.
   *
   * @param array $mimes
   *   Original array of mime types.
   *
   * @return mixed
   *   Array of mime types.
   */
  public function upload_mimes( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }

  /**
   * @{inheritdoc}
   */
  protected function includes() {
    return array(
			'functions',
      'form',
      'meta-box',
      'page',
      'post-type',
      'taxonomy',
      'widget',
      'group-extension',
      'settings',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function admin_styles() {
    return array(
      'backend',
    );
  }
}
