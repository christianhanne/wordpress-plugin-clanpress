<?php
/**
 * @file
 * This is the main plugin file which is used to identify the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

/*
Plugin Name: ClanPress
Plugin URI: http://aureola.codes/wordpress-plugins/clanpress
Description: ClanPress is full featured clan management plugin.
Author: Christian Hanne <support@aureola.codes>
Author URI: http://aureola.codes/wordpress-plugins/
Version: 0.1.2
Text Domain: clanpress
*/

defined( 'ABSPATH' ) or die( 'Access restricted.' );

define( 'CLANPRESS_VERSION', '0.1.2' );
define( 'CLANPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CLANPRESS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( CLANPRESS_PLUGIN_PATH . 'includes/clanpress.php' );
$clanpress = new Clanpress();
