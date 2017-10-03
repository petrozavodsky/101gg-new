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
 * Date of creation: 24-Dec-16 / 15:51
 * Last updated: 24-Dec-16 / 15:51 By Kirill Lavrishev
 *
 */


// EXCLUDE LIVE STREAMING CATEGORIES AND POSTS THAT ARE NEEDS TO BE EXCLUDED FROM RSS BY CHOICE
function exclude_category($query) {
	if ( is_feed( ) ) {
		if ( $query->is_feed ) {
			$query->set( 'cat', '-15325, -15321, -15319, -14766, -15314, -15316, -15320, -15318, -15317' );

            $query->set( 'post_type', 'post' );

			/*$query->set( 'meta_query',
				array(
					'relation' => 'OR',
					array(
						'key'     => 'codeja_exclude_from_rss',
						'value'   => 1,
						'compare' => '!='
					),
					array(
						'key'     => 'codeja_exclude_from_rss',
						'value'   => '',
						'compare' => 'NOT EXISTS'
					)
				)
			);*/

		}
	}
	return $query;
}
add_filter('pre_get_posts', 'exclude_category');