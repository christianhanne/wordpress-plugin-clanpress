<?php
/**
 * Contains the admin component class.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress\Admin
 */

defined( 'ABSPATH' ) or die( 'Access restricted.' );

/**
 * @class Clanpress_Admin_Component
 */
class Clanpress_Admin_Component extends Clanpress_Component {
  /**
   * @{inheritdoc}
   */
  protected function includes() {
    return array(
      'functions',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function admin_pages() {
    return array(
      'clanpress',
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function settings() {
    return array(
      'clan_name' => array(
        'type' => 'text',
        'label' => __( 'Name of the Clan', 'clanpress' ),
        'pattern' => '.+',
      ),
      'clan_subtitle' => array(
        'type' => 'text',
        'label' => __( 'Subtitle', 'clanpress' ),
        'pattern' => '.+',
      ),
      'logo' => array(
        'type' => 'upload',
        'label' => __( 'Logo', 'clanpress' ),
      ),
      'icon' => array(
        'type' => 'upload',
        'label' => __( 'Icon', 'clanpress' ),
      ),
      'header' => array(
        'type' => 'upload',
        'label' => __( 'Header', 'clanpress' ),
      ),
      'footer' => array(
        'type' => 'textarea',
        'label' => __( 'Footer', 'clanpress' ),
        'attributes' => array(
          'rows' => 5,
        ),
      ),
    );
  }

  /**
   * @{inheritdoc}
   */
  protected function name() {
    return __( 'Clanpress', 'clanpress' );
  }
}
