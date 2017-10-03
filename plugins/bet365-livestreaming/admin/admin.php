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
 * Date of creation: 14-Jan-17 / 21:27
 * Last updated: 14-Jan-17 / 21:27 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once CJBL_PLUGIN_DIR . '/admin/includes/classes/class-cjbl-admin-page.php';

add_action( 'admin_init', 'cjbl_admin_init' );
function cjbl_admin_init() {
    $cjbl_admin_page = new CJBL_Admin_Page();

    do_action( 'cjbl_admin_init' ); // ADD ACTION FOR LATER USE
	$cjbl_admin_page->configure();
}

add_action( 'admin_menu', 'cjbl_admin_menu' );
function cjbl_admin_menu() {
    $cjbl_admin_page = new CJBL_Admin_Page();

    do_action( 'cjbl_admin_menu' ); // ADD ACTION FOR LATER USE
	$cjbl_admin_page->addAdminPage();
}

add_action( 'admin_enqueue_scripts', 'cjbl_admin_enqueue' );
function cjbl_admin_enqueue( $hook ) {
    $cjbl_admin_page = new CJBL_Admin_Page();

    do_action( 'cjbl_admin_enqueue' ); // ADD ACTION FOR LATER USE
	$cjbl_admin_page->enqueue( $hook );
    wp_enqueue_media();

}

