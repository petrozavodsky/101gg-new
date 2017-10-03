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
 * Date of creation: 28-Sep-16 / 13:12
 * Last updated: 28-Sep-16 / 13:12 By Kirill Lavrishev
 *
 */

if ( post_is_in_descendant_category(16469) ){
    include (TEMPLATEPATH . '/single-livestream.php');
    exit;
}

get_header(); ?> 

<div class="inside-post">
<?php

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<?php if ( get_field('codeja_use_thumbnail') ) :
            $image = cj_get_image_data();
			the_post_thumbnail('full', array( 'title' => $image->caption ) );
		endif; ?>

        <div id="social-share">
            <?php do_action('after_post_featured_image') // social share ?>
        </div>
		<header id="first-title-on-page">
			<h1><?php the_title(); ?></h1>
		</header>
		<?php
		if ( get_field('codeja_show_author') != 'hide' ) :
			include_once ('templates/single/parts/post-meta.php'); // author and post meta data
		endif;

		the_content();

		include_once ('templates/single/parts/post-tags.php'); // post tags and odds -> loads through ajax
        do_action('after_tags'); // social share
  ?>
        <hr/>
        <style>
            .fb-comments iframe, .fb-comments, .fb-comments > span {
                width: 100% !important;
            }

        </style>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=345296042591084";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
        <?php
        break;
	endwhile; // WHILE HAVE POSTS
	add_to_seen_posts( $post->ID ); // ADD POST TOO COOKIE OF SEEN POSTS
	update_views_count( $post->ID ); 	// ADD VIEWS FOR POST

endif; // IF HAVE POSTS

cj_get_betting_box();

the_banner_placement( 'THIRD_INSIDE_POST_BANNER' );

include_once ('templates/single/parts/suggested-videos.php'); // suggested videos

if ( ! empty( $cj_teams_terms ) ) {
    include_once ('templates/single/parts/suggested-teams.php'); // suggested teams
}
if ( ! empty( $cj_player_terms ) ) {
    include_once('templates/single/parts/suggested-players.php'); // suggested players
}
?>

	</div> <!-- CLOSE DIV POST -->
	<?php the_banner_placement( 'UNDER_POST_REC_CONTENT' ) ?>
<?php
get_footer();