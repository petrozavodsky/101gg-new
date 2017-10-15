<?php
/**
 * Created by CODEJA.
 * User: kirillrocks
 * Date: 09-Oct-17
 * Time: 10:18
 */

if ( 'L4hYJBVWKOIRuwitR55mmBaZ' === $_GET['key'] ) {
	define( 'WP_USE_THEMES', false );
	require_once( '../../../wp-load.php' );
	require_once( dirname( __FILE__ ) . '/includes/classes/class-cjbl-import-live-streams.php' );

	$cjbl_import_games = new CJBL_Import_Live_Streams();
	$result = $cjbl_import_games->get_data_from_xml();

	echo $result;
}
