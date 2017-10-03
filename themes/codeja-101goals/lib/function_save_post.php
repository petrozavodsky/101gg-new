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
 * Date of creation: 15-Dec-16 / 14:19
 * Last updated: 15-Dec-16 / 14:19 By Kirill Lavrishev
 *
 */

// SAVE POST TO COOKIE
function save_post( $postid = null, $userid = null ) {
	$userid = get_real_user_id( $userid );
	$postid = get_real_post_id( $postid );

	// IF POST NO SAVED ALREADY - ADD IT, OR DELETE IT
	if ( !is_post_saved( $postid ) ) {
		$saved = json_decode( stripslashes($_COOKIE['saved_posts']), true );
		$saved[$postid] = array(
			'date_added'    => time(),
			'post_id'       => $postid
		);
		setcookie( "saved_posts", json_encode($saved), time() + (10 * 365 * 24 * 60 * 60), '/' );

		return array('error' => 0, 'response' => 'POST_ADDED', 'msg' => 'Saved!');
	} else {
		return delete_post_from_saved( $postid, $userid );
	}
}

function delete_post_from_saved( $postid = null, $userid = null) {
	$userid = get_real_user_id( $userid );
	$postid = get_real_post_id( $postid );

	// IF POST IN SAVED - DELETE
	if ( is_post_saved( $postid ) ) {
		$saved = json_decode( stripslashes($_COOKIE['saved_posts']), true );
		unset($saved[$postid]);
		setcookie( "saved_posts", json_encode($saved), time() + (10 * 365 * 24 * 60 * 60), '/' );

		return array('error' => 0, 'response' => 'POST_DELETED_FROM_SAVED', 'msg' => 'Deleted!');
	}

	return array('error' => 1, 'response' => 'POST_NOT_IN_SAVED', 'msg' => 'post not in saved messages');
}

function is_post_saved( $postid = null ) {
	$postid = get_real_post_id( $postid );

	if ( !isset($_COOKIE['saved_posts']) ) {
		setcookie( "saved_posts", json_encode( array( 'nothing' => 'nothing') ), time() + (10 * 365 * 24 * 60 * 60), '/' );
		return false;
	}

	if ( !array_key_exists($postid, json_decode( stripslashes($_COOKIE['saved_posts'])), true) ) {
		return false;
	}

	return true;
}

function get_saves_posts( ) {
	if ( isset($_COOKIE['saved_posts'] ) ) {
		return json_encode($_COOKIE['saved_posts']);
	}
	
	return null;
}

function ajax_save_post() {
	$response = save_post($_POST['post_id'], $_POST['user_id']);
	if ( $response['error'] != 1 ) {
		echo '<pre style="text-align: left; float: left">';
		print_r( $_COOKIE );
		echo '</pre>';
	} else {
/*		console('error', $response);*/
		echo $response['msg'];
	}
}
add_action( 'wp_ajax_save_post', 'ajax_save_post' );
add_action( 'wp_ajax_nopriv_save_post', 'ajax_save_post' );

function ajax_delete_post_from_saved() {
	if ( $response = delete_post_from_saved($_POST['post_id'], $_POST['user_id'])['error'] != 1 ) {
		echo '<pre style="text-align: left; float: left">';
		print_r( $_COOKIE['saved_posts'] );
		echo '</pre>';
	} else {
		console('error', $response);
		echo $response['msg'];
	}
}

add_action( 'wp_ajax_delete_post_from_saved', 'ajax_delete_post_fromt_saved' );
add_action( 'wp_ajax_nopriv_delete_post_fromt_saved', 'ajax_delete_post_fromt_saved' );