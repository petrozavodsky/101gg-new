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
 * Date of creation: 28-Dec-16 / 14:07
 * Last updated: 28-Dec-16 / 14:07 By Kirill Lavrishev
 *
 */

function get_suggest_posts_for_terms( $tags, $current_post_id ) {
	// GET ALL SEEN POSTS FROM COOKIE
	/*$seen_posts = json_decode( stripslashes($_COOKIE['seen_posts']), true );

	$seen_posts[] = $current_post_id;*/
if (!is_user_logged_in()) {
	return null;
}
	$suggest_args = array(
		'post_type'         => 'post',
		'order'             => 'DESC',
		'order_by'          => 'meta_value_num',
		'meta_key'          => 'post_views',
		'tag__in'           => $tags,
		'post_status'       => 'publish',
		'suppress_filters'  => true,
		'posts_per_page'     => 4,
		'update_post_term_cache' => false, // don't retrieve post terms
		'update_post_meta_cache' => false, // don't retrieve post meta,
		'no_found_rows' => true, // counts posts, remove if pagination required,
	);
	wp_reset_query();

	$suggested_query = new WP_Query( $suggest_args );

	$suggested_posts = '';
	$i = 0;
	if ( $suggested_query->have_posts() ) {
/*		$content = '<div class="only-desktop row">';
		$content .= '<div class="col-md-12">';
		$content .= '<div class="suggested-posts">';*/
		while ( $suggested_query->have_posts() ) {
			$i++;
			the_post();


			$suggested_posts .= '<div class="suggested-post__wrapper col-md-4">';
			$suggested_posts .= '<img src="suggested-post__thumbnail">';
			$suggested_posts .= '<div class="suggested-post__title">' . get_the_title() . '</div>';
			$suggested_posts .= '</div>';

			if ( $i > 3 )
				break;
		}

		/*$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';*/
	}
	wp_reset_postdata();

	return $suggested_posts;
}

function the_suggest_posts_for_terms( $current_post_id ) {
	$current_post_id = $_POST['post_id'];
	$tags = wp_get_post_tags( 675602, array( 'fields' => 'ids' ) );


	echo get_suggest_posts_for_terms( $tags, $current_post_id );
}

add_action( 'wp_ajax_the_suggest_posts_for_terms', 'the_suggest_posts_for_terms' );
add_action( 'wp_ajax_nopriv_the_suggest_posts_for_terms', 'the_suggest_posts_for_terms' );