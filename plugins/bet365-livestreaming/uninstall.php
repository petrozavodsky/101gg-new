<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

function cjbl_delete_plugin() {
	delete_option( 'cjbl' );
}

cjbl_delete_plugin();
