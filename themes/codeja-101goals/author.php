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

        <?php
        $user_id = get_queried_object_id();
        $user = get_userdata( $user_id );
        $facebook = get_user_meta( $user_id, 'facebook', true );
        $twitter = get_user_meta( $user_id, 'twitter', true );
        ?>
        <h1><?php echo $user->first_name ?> <?php echo $user->last_name?></h1>

        <div class="row margin-bottom-15px">
            <div class="col-md-2">
                <div class="author-image">
                    <?php echo get_avatar( $user_id, 128 ); ?>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="author-bio">
                            <p><?php echo get_user_meta($user_id, 'description', true) ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="author-social-icons">
                            <?php if ( $facebook ) : ?>
                            <li class="author-social-icon">
                                <a class="facebook share" href="https://www.facebook.com/<?php echo $facebook ?>" target="_blank">
                                    <img src="<?php echo IMAGES_FOLDER . '/facebook.png' ?>" alt="facebook share">
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if ( $twitter ) : ?>
                            <li class="author-social-icon">
                                <a class="twitter share" href="https://twitter.com/<?php echo $twitter ?>" target="_blank">
                                    <img src="<?php echo IMAGES_FOLDER . '/twitter.png' ?>" alt="twitter share">
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</header>
    <h2><?php echo $user->first_name ?> <?php echo $user->last_name?> Articles</h2>
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
<?php
get_footer();