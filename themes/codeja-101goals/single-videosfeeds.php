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

get_header(); ?>

	<div class="inside-post">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<header id="first-title-on-page">
					<h1><?php the_title(); ?></h1>
				</header>
				<div class="video-single">
					<?php echo get_field( 'video_iframe' ); ?>
				</div>
				<div id="social-share">
					<?php do_action( 'after_post_featured_image' ); // social share ?>
				</div>
				<div id="fb-root"></div>
				<script>
					(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s);
						js.id = id;
						js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=219394138188209';
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5"></div>
				<?php
			endwhile; // WHILE HAVE POSTS

			add_to_seen_posts( $post->ID ); // ADD POST TOO COOKIE OF SEEN POSTS
			update_views_count( $post->ID );    // ADD VIEWS FOR POST*/

		endif;
		wp_reset_postdata(); // IF HAVE POSTS
		?>

	</div> <!-- CLOSE DIV POST -->
	<h3 class="suggested_posts__title">Related Videos</h3>


	<div class="videos-posts">
		<?php
		// The Query
		$args = array(
			'posts_per_page' => 10,
			'post_type'      => 'videosfeeds',
			'post__not_in'   => array( get_the_ID() ),
		);
		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				?>
				<div class="video-post">
					<div class="video-post__block">
						<div class="video-post__thumbnail">
							<?php echo get_field( 'video_iframe' ); ?>
						</div>
						<div class="video-post_bottom">
							<div class="video-post__title">
								<a href="<?php the_permalink(); ?>">
									<?php the_real_or_external_title(); ?>
								</a>
							</div>

							<ul class="video-post__counters">
								<?php $views = get_post_meta( $post->ID, 'post_views', true ) ?: 0; ?>

								<li>
									<i class="fa fa-eye" aria-hidden="true"></i> <?php echo $views; ?>
								</li>
								<li>
									<i class="fa fa-comment" aria-hidden="true"></i> 0
								</li>

							</ul>
						</div>
						<div class="video-post__social">
							<div id="social-share">
								<div class="cj-social-share" data-post-id="<?php echo $post->ID; ?>">
									<div class="primary-share">
										<a target="_blank" class="social-share facebook social-box"
										   data-network="facebook"
										   href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>"></a>
										<a target="_blank" class="social-share twitter social-box"
										   data-network="twitter"
										   href="https://twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>"></a>
										<a target="_blank" class="social-share email social-box" data-network="email"
										   href="mailto:?Subject=<?php echo urlencode( get_the_title() ); ?>&amp;body=<?php echo urlencode( get_permalink() ); ?>"></a>
										<a target="_blank" class="social-share copy social-box" data-network="copy"
										   data-clipboard-text="<?php echo urlencode( get_permalink() ); ?>"
										   data-toggle="tooltip" title="" data-placement="bottom" href=""
										   data-original-title="Copied!"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php
			endwhile;
			wp_reset_postdata();
			?>

		<?php endif; ?>
	</div>

<?php
the_banner_placement( 'UNDER_POST_REC_CONTENT' );
get_footer();
