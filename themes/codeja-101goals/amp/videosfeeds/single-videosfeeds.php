<?php
/**
 * File single-amp.php created by:
 * CODJA.net - Turning imagination into creation
 *
 * Team Member: Evgeniy Z
 *
 * File Details:
 * Date of creation: 28.09.2017 / 19:42
 * Last updated: 28.09.2017 / 19:42 by Evgeniy Z
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'amp' );
?>
<main class="amp-codja-container">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<header id="first-title-on-page">
				<h1><?php the_title(); ?></h1>
			</header>
			<div class="video-single">
				<?php get_field( 'video_iframe' ); ?>
			</div>
			<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5"></div>
			<?php
		endwhile; // WHILE HAVE POSTS

		add_to_seen_posts( $post->ID ); // ADD POST TOO COOKIE OF SEEN POSTS
		update_views_count( $post->ID );    // ADD VIEWS FOR POST*/

	endif;
	wp_reset_postdata(); // IF HAVE POSTS
	?>
</main>
<?php
get_footer( 'amp' );
