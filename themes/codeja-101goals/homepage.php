<?php
/**
 *
 * Template Name: Homepage
 *
 * Build By:
 * www.CODEJA.net - Turning imagination into creation
 *
 * Team Member:
 * Full Name: Kirill Lavrishev
 * Contact Information: #0526142466 / k@codeja.net
 *
 * File Details:
 * Date of creation: 11-Oct-16 / 22:13
 * Last updated: 11-Oct-16 / 22:13 By Kirill Lavrishev
 *
 */

get_header();
?>
<?php if( have_rows('what_to_show_on_homepage', 674841)): $loop_repeater = 0 ?>
	<?php while( have_rows('what_to_show_on_homepage', 674841)): the_row(); ?>

		<?php if ( get_sub_field('category_block_banner') ) : ?>
			<?php the_banner_placement( 'HOMEPAGE_BETWEEM_POSTS', $loop_repeater ) ?>
			<?php the_banner_placement( 'HOMEPAGE_BETWEEM_POSTS_MOBILE', $loop_repeater ) ?>
			<?php $loop_repeater++; ?>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-12">
				<div class="category-block">
					<div class="row">
						<header class="category-block-top text-center">
							<a href="<?php echo get_category_link(get_sub_field('category_block_category_name')) ?>"><h2><?php the_sub_field('category_block_title'); ?></h2></a>
							<p><?php the_sub_field('category_block_sub_title'); ?></p>
						</header>
					</div>
					<div class="row category-posts">
						<?php
						$args = array(
							'posts_per_page' => get_sub_field('category_block_number_of_posts'),
							'orderby' => 'post_date',
							'order' => 'DESC',
							'post_type' => 'post',
							'cat' => get_sub_field('category_block_category_name'),
							'post_status' => 'publish',
							'suppress_filters'  => true,
							'update_post_term_cache' => false, // don't retrieve post terms
							'update_post_meta_cache' => false, // don't retrieve post meta,
							'no_found_rows' => true, // counts posts, remove if pagination required,
							);

						$recent_posts = new WP_Query( $args );
						$i = 0;
						?>
						<?php if ( $recent_posts->have_posts() ) : ?>
							<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $i++; ?>
								<?php $no_padding = $i % 2 == 0 ? 'col-no-padding' : '';?>

								<?php if ( $i == 4 && wp_is_mobile() ) {
									the_banner_placement( 'HOMEPAGE_BETWEEM_POSTS_MOBILE', $loop_repeater );
									$loop_repeater++; // UPDATE LOOP REPEATER TO CHOOSE NEXT BANNER
								} ?>

								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo $no_padding ?> category-post">
									<div class="post-wrapper">
										<a href="<?php the_permalink() ?>">
											<div class="post-image">
                                                <?php get_post_thumbnail_id() ?>
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
							<?php endwhile; wp_reset_postdata();
						endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile;  ?>
 <?php endif;
get_footer();