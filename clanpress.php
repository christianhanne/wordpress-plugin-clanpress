<?php
/**
 * This is the main plugin file which is used to identify the plugin.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @copyright Copyright (c) 2016, Aureola
 * @license https://github.com/aureolacodes/clanpress/blob/master/LICENSE
 *
 * @package Clanpress
 */

/*
Plugin Name: ClanPress
Plugin URI: http://aureola.codes/wordpress-plugins/clanpress
Description: ClanPress is full featured clan management plugin.
Author: Christian Hanne <support@aureola.codes>
Author URI: http://aureola.codes/wordpress-plugins/
Version: 0.7.1
Text Domain: clanpress
*/

defined( 'ABSPATH' ) or die( 'Access restricted.' );

define( 'CLANPRESS_VERSION', '0.7.1' );
define( 'CLANPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CLANPRESS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

require_once( CLANPRESS_PLUGIN_PATH . 'includes/clanpress.php' );

register_activation_hook(   __FILE__, array( 'Clanpress', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Clanpress', 'deactivate' ) );
register_uninstall_hook(    __FILE__, array( 'Clanpress', 'uninstall' ) );

add_action( 'plugins_loaded', array( 'Clanpress', 'instance' ) );
