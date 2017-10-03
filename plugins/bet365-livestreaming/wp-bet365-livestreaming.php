<?php
/*
Plugin Name: Bet365 Livestreaming
Plugin URI: kirill.rocks
Description: Bet365 Livestreaming export
Author: Kirill Lavrishev
Author URI: me
Text Domain: bet365-livestreaming
Domain Path: /languages/
Version: 4.6
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'CJBL_VERSION', '1.0' );

define( 'CJBL_REQUIRED_WP_VERSION', '4' );

define( 'CJBL_PLUGIN', __FILE__ );

define( 'CJBL_PLUGIN_BASENAME', plugin_basename( CJBL_PLUGIN ) );

define( 'CJBL_PLUGIN_NAME', trim( dirname( CJBL_PLUGIN_BASENAME ), '/' ) );

define( 'CJBL_PLUGIN_DIR', untrailingslashit( dirname( CJBL_PLUGIN ) ) );

define( 'CJBL_PLUGIN_URL', plugin_dir_url( CJBL_PLUGIN ) );

define( 'CJBL_PLUGIN_REAL_NAME', 'bet365 Live-Streams' );

require_once CJBL_PLUGIN_DIR . '/settings.php';