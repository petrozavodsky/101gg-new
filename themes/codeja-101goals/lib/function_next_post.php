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
 * Date of creation: 15-Dec-16 / 12:58
 * Last updated: 15-Dec-16 / 12:58 By Kirill Lavrishev
 *
 */

function codeja_get_next_post( $postid = null ) {
	$postid = get_real_post_id( $postid );

	// GET ALL SEEN POSTS FROM COOKIE
	$seen_posts = json_decode( stripslashes($_COOKIE['seen_posts']), true );

	// ADD CURRENT POST TO SEEN POSTS
	$seen_posts[$postid] = $postid;

	$posts = new WP_Query (
		array(
			'cat'                   => 2,
			'posts_per_page'        => 1,
			'post__not_in'          => $seen_posts,
			'orderby'               => 'post_date',
			'post_status'           => 'publish',
			'date_query' => array(
				'relation'   => 'OR',
				array(
					'column'  => 'post_date',
					'after'   => '-7 days'
				),
				array(
					'column'  => 'post_modified',
					'after'   => '-7 days'
				)
			)
		)
	);

	return $posts->get_posts()[0];
}

/*function ajax_codeja_get_next_post() {
	echo get_permalink( codeja_get_next_post( ) );
	exit();
}

add_action( 'wp_ajax_codeja_get_next_post', 'ajax_codeja_get_next_post' );
add_action( 'wp_ajax_nopriv_codeja_get_next_post', 'ajax_codeja_get_next_post' );*/