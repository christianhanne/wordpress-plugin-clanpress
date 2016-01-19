<?php
/**
 * @file
 * TODO
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/*
Plugin Name: ClanPress
Plugin URI: http://aureola.codes/wordpress-plugins/clanpress
Description: TODO
Author: Christian Hanne <support@aureola.codes>
Author URI: http://aureola.codes/wordpress-plugins/
Version: 0.0.1
Text Domain: clanpress
*/

defined( 'ABSPATH' ) or die( 'Access restricted.' );

define( 'CLANPRESS_VERSION', '0.0.1' );
define( 'CLANPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CLANPRESS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( CLANPRESS_PLUGIN_PATH . 'includes/clanpress.php' );
$clanpress = new Clanpress();
