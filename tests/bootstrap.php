<?php
/**
 * @file
 * Loads all files necessary to initialize the plugin's test cases.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

define('TEST_DIR', '/tmp/wordpress-develop/tests/phpunit');
require_once TEST_DIR . '/includes/functions.php';

function load_clanpress() {
	require dirname( dirname( __FILE__ ) ) . '/clanpress.php';
}

tests_add_filter( 'muplugins_loaded', 'load_clanpress' );
require TEST_DIR . '/includes/bootstrap.php';
