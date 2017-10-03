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

$stream = new CJBL_Stream( $post );
?>

	<main class="amp-codja-container">
		<article class="amp-codjabl-tv">
			<div class="cjbl-tv-inside">
				<header class="cjbl-event-header">
					<h1><?php echo $stream->get_opponents_html( true ); ?></h1>

					<p class="cjbl-under-category-text"><?php echo $stream->get_opponents_html(); ?> live streaming: How to watch the <?php echo $stream->league['name'] ?> match</p>
					<?php if ( $stream->is_live ) : ?>
						<div class="cjbl-active-game"><?php echo CJBL::get_option( 'active_now_text' ) ? CJBL::get_option( 'active_now_text' ) : 'Live' ?></div>
					<?php endif; ?>
				</header>

				<?php echo $stream->get_watch_now_html( 'cjbl-watch-button btn', 'Watch And Bet on Bet365', 1 ); ?>
			</div>

			<footer class="cjbl-stream-meta">
				<ul>
					<li>
						<div class="cjbl-stream-wrapper">
							<div class="cjbl-meta-header">Event:</div>
							<p class="cjbl-meta-content"><?php echo $stream->get_opponents_html() ?> </p>
						</div>
					</li>
					<li>
						<div class="cjbl-stream-wrapper">
							<div class="cjbl-meta-header">Start Date/Time:</div>
							<p class="cjbl-meta-content"><?php echo $stream->get_date( 'd-m-Y H:i' ) ?></p>
						</div>
					</li>
					<li>
						<div class="cjbl-stream-wrapper">
							<div class="cjbl-meta-header">Competition/League:</div>
							<p class="cjbl-meta-content"><?php echo $stream->league['name'] ?></p>
						</div>
					</li>
					<li>
						<div class="cjbl-stream-wrapper">
							<div class="cjbl-meta-header">Sport:</div>
							<p class="cjbl-meta-content"><?php echo $stream->sport_type['name'] ?></p>
						</div>
					</li>
				</ul>
			</footer>
		</article>

		<section class="cjbl_single_below_content-hook">
			<?php if ( ! empty ( get_the_content() ) ) : ?>
				<?php echo cjbl_replace_content_with_real_data( '', $stream->ID ) ?>
			<?php else : ?>
				<?php echo cjbl_get_under_content( $stream->ID ) ?>
			<?php endif; ?>
		</section>

		<?php echo $stream->get_watch_now_html( 'cjbl-watch-button btn', 'Watch And Bet on Bet365', 1 ); ?>

		<?php if ( has_action( 'cjbl_single_under_content' ) ) : ?>
			<section class="cjbl_single_under_content-hook">
				<?php do_action( 'cjbl_single_under_content' ); ?>
			</section>
		<?php endif; ?>

		<div class="cjbl-how-to">
			<?php do_action('cjbl_single_below_content'); ?>
		</div>

		<?php get_sidebar(); ?>
	</main>

<?php
get_footer('amp');