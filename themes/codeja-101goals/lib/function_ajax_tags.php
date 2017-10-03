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
 * Date of creation: 11-Dec-16 / 14:55
 * Last updated: 11-Dec-16 / 14:55 By Kirill Lavrishev
 *
 */

$cj_teams_terms = '';
$cj_player_terms = '';

function ajax_get_tags_and_odds( )  {
    global $post, $cj_teams_terms, $cj_player_terms;


	$post_id = $post->ID;
	$content = '';
	$teams_terms = array();

	$content .= '<div class="inside-post-tags">
			<a class="before-tags-icon">
				<i class="fa fa-hashtag"></i>
			</a>';
	
	foreach (wp_get_post_tags( $post_id ) as $key => $value )  {
		$content .= '<a class="btn btn-success" href="' . get_term_link( $value->term_id ) . '">' . $value->name .'</a>';
	}

	foreach (wp_get_post_terms( $post_id, 'teams' ) as $key => $value ) {
		$teams_terms[] = $value->name;
        $cj_teams_terms = array( 'name' => $value->name, 'id' => $value->term_id );
		$content .= '<a class="btn btn-success" href="' . get_term_link( $value->term_id ) . '">' . $value->name .'</a>';
	}

	foreach (wp_get_post_terms( $post_id, 'players' ) as $key => $value ) {
        $cj_player_terms = array( 'name' => $value->name, 'id' => $value->term_id );
		$content .= '<a class="btn btn-success" href="' . get_term_link( $value->term_id ) . '">' . $value->name . '</a>';
	}

	foreach (wp_get_post_terms( $post_id, 'managers' ) as $key => $value ) {
		$content .= '<a class="btn btn-success" href="' . get_term_link( $value->term_id ) . '">' . $value->name . '</a>';
	}

	$content .= '</div>';

	//disable ods
	//$odds_to_give = get_post_meta('codeja_odds_to_show', $post_id) ? get_post_meta('codeja_odds_to_show', $post_id) : 1;
	//$odds = get_the_odds_for_terms( $teams_terms, $odds_to_give );

	//echo $odds . $content; k
	echo $content;
}

/*add_action( 'wp_ajax_get_tags_and_odds', 'ajax_get_tags_and_odds' );
add_action( 'wp_ajax_nopriv_get_tags_and_odds', 'ajax_get_tags_and_odds' );*/