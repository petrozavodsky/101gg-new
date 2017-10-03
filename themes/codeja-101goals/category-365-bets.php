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
 * Date of creation: 25-Oct-16 / 22:24
 * Last updated: 25-Oct-16 / 22:24 By Kirill Lavrishev
 *
 */

get_header();


?>
<header class="first-title-on-page">
	<h1><?php echo single_cat_title() ?></h1>
</header>
	<div class="row category-posts">
		<?php
		if (have_posts()) :
			while (have_posts()) :
				the_post(); ?>
	<div class="col-md-4 category-post">
		<div class="post-wrapper">
			<div class="post-image">
				<a href="<?php the_permalink() ?>">
					<div class="post-image">
						<?php if ( !$thumbnail = get_the_post_thumbnail_url() ) {
							$thumbnail = get_template_directory_uri() . '/images/default-livestream.jpg';
						}
						?>

						<img src="<?php echo $thumbnail ?>">
					</div>
					<div class="post-excerpt">
						<p>
							<?php the_title() ?>
						</p>
						<span class="btn btn-readmore btn-absolute">
							<span class="readmore-text">Read More</span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</div>
				</a>
			</div>
		</div>
</div>
			<?php endwhile; ?>
			<div class="col-md-12 pagination">
				<div class="btn btn-success pull-left"><?php next_posts_link( 'Older posts' ); ?></div>
				<div class="btn btn-success pull-right"><?php previous_posts_link( 'Newer posts' ); ?></div>
			</div>
			<?php
		endif;?>
	</div>
<?php
get_footer();