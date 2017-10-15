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

require_once get_template_directory() . '/templates/amp/class-cj-amp-helpers.php';
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
			<div class="amp-codja-video-single">
				<?php CJ_Amp_Helpers::convert( get_field( 'video_iframe' ) ); ?>
			</div>
			<?php include_once( get_template_directory() . '/templates/amp/common/social-share.php' ); ?>
			<amp-facebook-comments width=486 height=657 layout="responsive" data-numposts="5" data-href="<?php the_permalink(); ?>"></amp-facebook-comments>
			<?php
		endwhile; // WHILE HAVE POSTS

		add_to_seen_posts( $post->ID ); // ADD POST TOO COOKIE OF SEEN POSTS
		update_views_count( $post->ID );    // ADD VIEWS FOR POST*/

	endif;
	wp_reset_postdata(); // IF HAVE POSTS
	?>

	<h3 class="amp-codja-sub-title">Related Videos</h3>

	<?php
	$q = new WP_Query( [
		'posts_per_page' => 10,
		'post_type'      => 'videosfeeds',
		'post__not_in'   => array( get_the_ID() ),
	] );

	if ( $q->have_posts() ) :
		while ( $q->have_posts() ) :
			$q->the_post();
			?>
			<div class="amp-codja-related-video">
				<?php CJ_Amp_Helpers::convert( get_field( 'video_iframe' ) ); ?>
				<a class="amp-codja-related-video-title" href="<?php the_permalink(); ?>?is_amp">
					<?php the_real_or_external_title(); ?>
				</a>
			</div>
		<?php
		endwhile;
		wp_reset_postdata();
		?>
	<?php endif; ?>

</main>
<?php
get_footer( 'amp' );
