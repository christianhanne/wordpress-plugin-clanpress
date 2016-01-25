<?php
/**
 * @file
 * Bootstrap file for unit tests.
 *
 * @author Christian Hanne <support@aureola.codes>
 * @package Clanpress
 */

$directory = getenv( 'WP_TESTS_DIR' );
if ( ! $directory ) {
	$directory = '/tmp/wordpress-tests-lib';
}

require_once $directory . '/includes/functions.php';

function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/clanpress.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $directory . '/includes/bootstrap.php';
