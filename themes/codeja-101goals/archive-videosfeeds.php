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
 * Last updated: 03-Oct-17 / 22:24 By Kirill Lavrishev
 *
 */

get_header(); ?>
	<script>

	</script>
	<header class="first-title-on-page">
		<h1>Football video feed – the best the Internet has to offer – updated 24/7</h1>
	</header>
	<div class="videos-posts">
		<?php
		if ( have_posts() ) :
			$loop_counter = 0;
			$inside_loop_counter = 0;

			while ( have_posts() ) :
				the_post();
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
				$loop_counter ++;
			endwhile;
			?>

		<?php endif; ?>
	</div>
	
	<div class="page-seo-text">
		<h3>Football videos feed: 101 Great Goals</h3>
		<p>The 101 Great Goals football video page is the ultimate place to keep up with all the latest and best football videos on social media.</p>
		<p>The main feature of the 101 Great Goals football video page is a constantly updated football video feed.</p>
		<p>Watch the latest and very best football videos from Facebook, Instagram, Twitter and YouTube.</p>
		<h3>The original 101 Great Goals</h3>
		<p>This is a return to the original aims of 101 Great Goals – cataloguing the best football video content online.</p>
		<p>It’s a bold statement, but we believe the 101 Great Goals football video page is like YouTube for football videos.</p>
		<p>Here at 101 Great Goals we believe when you open up this page at any given time or hour you will find something from the football video social media world you haven’t seen before.</p>
		<p>Nowadays, we are simply deluged with brilliant football video content from social media. 101 Great Goals is here to provide a feed that is a one-stop-shop for football videos.</p>
		<h3>What to expect on this football videos page</h3>
		<p>This football clips page feed is updated by the 101 Great Goals content team on an hourly basis.</p>
		<p>We live in a world where so many of the major rights holders push their video content available to all within seconds of goals going in.</p>
		<p>For example, BT Sport produce Champions League video content and the MLS also push every goal on social media.</p>
		<h3>Send in your football videos!</h3>
		<p>Pretty much every major club on the world wide web also uploads many minutes of football video content every day.</p>
		<p>We aim to include the very best on this page so that football fans have a "one-stop-shop" to ensure they never miss any great football videos.</p>
		<p>You can also send us your football video content - or clips online that we shouldn't miss out on - via our <a href="/contactus/">Contact Us page here</a>.</p>
	</div>

<?php
get_footer();
