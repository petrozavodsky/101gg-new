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
 if ( post_is_in_descendant_category(16469) ){
	include (TEMPLATEPATH . '/category-365-bets.php');
	exit;
}
get_header(); ?>
	<header class="first-title-on-page">
		<h1><?php echo single_cat_title() ?></h1>
	</header>
	<div class="row category-posts">
		<?php
		if (have_posts()) : $loop_counter = 0; $inside_loop_counter = 0;
			while (have_posts()) :
				the_post(); ?>
				<div class="col-md-4 category-post">
					<div class="post-wrapper">
						<a href="<?php the_permalink() ?>">
							<div class="post-image">
								<picture>
									<source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
									<source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
									<img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
								</picture>
							</div>
							<div class="post-excerpt">
								<p>
									<?php the_real_or_external_title() ?>
								</p>
						<span class="btn btn-readmore btn-absolute">
							<span class="readmore-text">Read More</span>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
							</div>
						</a>
					</div>
				</div>
				<?php
				// ON LOOP 6(5) AND THAN 9
				if ( $loop_counter == 5  || ( $loop_counter % 9  == 0 && $loop_counter != 0 && $loop_counter != 9 ) ) {
					the_banner_placement( 'CATEGORIES_BETWEEN_POSTS', $inside_loop_counter );
					the_banner_placement( 'CATEGORIES_BETWEEN_POSTS_MOBILE', $inside_loop_counter );
					$inside_loop_counter++;
					$loop_counter = 9; // RESET LOOP COUNTER TO WORK WITH MODULO
				}
				?>
				<?php $loop_counter++; endwhile; ?>
			<div class="col-md-12 pagination">
				<?php if ( get_next_posts_link() ) : ?>
				<div class="btn btn-success pull-left"><?php next_posts_link( 'Older  posts' ); ?></div>
				<?php endif; if ( get_previous_posts_link() ) : ?>
				<div class="btn btn-success pull-right"><?php previous_posts_link( 'Newer posts' ); ?></div>
				<?php endif; ?>
			</div>
			<?php
		endif;?>
	</div>
<?php if ( is_category( array(20705, 20704 ) ) )  {
    cj_get_betting_box();
}

?>
<?php
get_footer();