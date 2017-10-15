<?php
/**
 * Build By:
 * www.CODEJA.net - Turning imagination into creation
 *
 * Team Member:
 * Full Name: Kirill Lavrishev
 * Contact Information: #0526142466 / k@codeja.net
 *
 * File Details:
 * Date of creation: 14-Jan-17 / 21:25
 * Last updated: 14-Jan-17 / 21:25 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// CLASSES
require_once CJBL_PLUGIN_DIR . '/includes/classes/class-cjbl.php';

// CONST
define( 'BASE_XML_URL', CJBL::get_option( 'xml_url' ) );

require_once CJBL_PLUGIN_DIR . '/includes/classes/class-cjbl-helper.php';
require_once CJBL_PLUGIN_DIR . '/includes/classes/class-cjbl-import-live-streams.php';
require_once CJBL_PLUGIN_DIR . '/includes/classes/class-cjbl-stream.php';

// WIDGETS
require_once CJBL_PLUGIN_DIR . '/includes/classes/widgets/class-cjbl-widget.php';

// DEFAULT FUNCTIONS
require_once CJBL_PLUGIN_DIR . '/includes/functions.php';

// HOOKS
require_once CJBL_PLUGIN_DIR . '/includes/hooks.php';
require_once CJBL_PLUGIN_DIR . '/includes/widgets.php';



if ( is_admin() ) {
	require_once CJBL_PLUGIN_DIR . '/admin/admin.php';
}

// ON PLUGIN ACTIVATE
register_activation_hook( CJBL_PLUGIN, 'cjbl_activation' );
function cjbl_activation() {
	if ( $option = get_option( 'cjbl' ) ) {
		return;
	}

	CJBL::update_option( 'post_title_2_teams', '{team1} v {team2}' );
	CJBL::update_option( 'post_title_1_team', '{opponent}' );
	CJBL::update_option( 'post_author', get_super_admins()[0] );
	CJBL::update_option( 'under-livestream-content', 'Demo under content' );

	CJBL_Helper::register_post_type(); // REGISTER POST TYPES
	CJBL_Helper::register_taxonomy(); // REGISTER TAXONOMIES

	wp_schedule_event( time(), 'daily', 'cjbl_cronjob_import_new_streams' );

	flush_rewrite_rules(); // RESET PERMALINKS
}

// ON PLUGIN DEACTIVATION
register_deactivation_hook( CJBL_PLUGIN, 'cjbl_deactivation' );
function cjbl_deactivation() {
	wp_clear_scheduled_hook( 'cjbl_cronjob_import_new_streams' );
	flush_rewrite_rules(); // RESET PERMALINKS
}

/** FILTERS & ACTIONS **/
add_action( 'plugins_loaded', 'cjbl' );
function cjbl() {
	add_shortcode( 'cjbl_livestreaming_table', 'cjbl_livestreaming_table' );
}

add_action( 'init', 'cjbl_init' );
function cjbl_init() {
	CJBL_Helper::register_post_type(); // REGISTER POST TYPES
	CJBL_Helper::register_taxonomy(); // REGISTER TAXONOMIES
	flush_rewrite_rules(); // RESET PERMALINKS
}

function delete_all_posts() {
	$posts = get_posts( array(
		'post_type' => CJBL::$post_type,
		'posts_per_page' => -1,
	) );
	foreach ( $posts as $post ) {
		// Delete's each post.
		wp_delete_post( $post->ID, true );
		// Set to False if you want to send them to Trash.
	}
}

// IMPORT NEW STREAMS - CRONJOB
add_action( 'cjbl_cronjob_import_new_streams', 'cjbl_import_streams' );
function cjbl_import_new_streams() {
	$cjbl_import_games = new CJBL_Import_Live_Streams();
	$result = $cjbl_import_games->get_data_from_xml();

	CJBL::add_log( 'CRONJOB updating live streams', 'New games imported: ' . ( 0 == $result ? 0 : $result ) . ' (function: cjbl_import_new_streams)' );
}

// CORRECT TEMPLATE FOR PLUGIN
add_filter( 'template_include', 'cjbl_templates', 10 );
function cjbl_templates( $template ) {
	return CJBL_Helper::template_chooser( $template );
}

add_action( 'widgets_init', 'cjbl_load_sidebars' );
function cjbl_load_sidebars() {
	CJBL_Helper::register_sidebar();
}

add_action( 'wp_enqueue_scripts', 'cjbl_enqueue_scripts' );
function cjbl_enqueue_scripts() {
	CJBL_Helper::enqueue();
}

/** AJAX CALLS **/

// IMPORT NEW GAMES - AJAX
add_action( 'wp_ajax_import_new_games', 'cjbl_ajax_import_streams' );
function cjbl_ajax_import_streams() {
	$cjbl_import_games = new CJBL_Import_Live_Streams();
	$result = $cjbl_import_games->get_data_from_xml();

	CJBL::add_log( 'AJAX updating live streams', 'New games imported: ' . ( 0 == $result ? 0 : $result ) . ' (function: cjbl_ajax_import_streams)' );

	echo $result;
	wp_die(); // this is required to terminate immediately and return a proper response
}

add_action( 'wp', 'wp_ajax_import_new_games_activation' );
function wp_ajax_import_new_games_activation() {
	if ( ! wp_next_scheduled( 'wp_ajax_import_new_games' ) ) {
		wp_schedule_event( time(), 'hourly', 'wp_ajax_import_new_games' );
	}
}
