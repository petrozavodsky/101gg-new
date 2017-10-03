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
 * Date of creation: 14-Jan-17 / 21:40
 * Last updated: 14-Jan-17 / 21:40 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ADD LIVE STREAM INSTRUCTIONS
add_action( 'cjbl_single_below_content', 'cjbl_get_instructions', 1 );
function cjbl_get_instructions() {

	$instructions = array();

	if ( CJBL::get_option( 'image_file_1' ) ) {
		$instructions[] = array(
			'image'   => CJBL::get_option( 'image_file_1' ),
			'title'   => CJBL::get_option( 'image_file_1_title' ),
			'content' => CJBL::get_option( 'image_file_1_content' ),
		);
	}

	if ( CJBL::get_option( 'image_file_2' ) && wp_is_mobile() ) {
		$instructions[] = array(
			'image'   => CJBL::get_option( 'image_file_2' ),
			'title'   => CJBL::get_option( 'image_file_2_title' ),
			'content' => CJBL::get_option( 'image_file_2_content' ),
		);
	}
	?>

	<div class="cjbl-instruction cjbl-group">
		<h2><?php echo CJBL::get_option( 'image_instruction_title' ) ?></h2>
		<ul class="list-unstyled row"<?php echo cj_is_amp() ? null : ' style="margin: 0 -15px; padding: 0;"'; ?>>

			<?php foreach ( $instructions as $value ) :
				$img_src = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'large' )[0] : '';

				$content = cjbl_replace_content_with_real_data( $value['content'], '', false );
				?>

				<li class="col-sm-12">
					<div class="cjbl-image-header">
						<span><?php echo $value['title'] ?></span>
					</div>
					<div class="cjbl-image-wrapper">
						<a href="<?php echo CJBL::get_option( 'watch_now_link' ); ?>" rel="nofollow" target="_blank">
							<?php if ( cj_is_amp() ) : ?>
								<amp-img src="<?php echo $img_src ?>" width="2.2" height="1" layout="responsive"></amp-img>
							<?php else : ?>
								<img src="<?php echo $img_src ?>">
							<?php endif; ?>
						</a>
					</div>
					<div class="cjbl-image-content">
						<span><?php echo $content ?></span>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}

add_action( 'cjbl_archive_below_content', 'cjbl_get_sidebar' );
function cjbl_get_sidebar() {
	if ( ! is_active_sidebar( CJBL::$sidebar ) ) {
		return null;
	}

	dynamic_sidebar( CJBL::$sidebar );
}

add_action( 'cjbl_category_below_content', 'cjbl_get_sidebar2' );
function cjbl_get_sidebar2() {
	if ( ! is_active_sidebar( CJBL::$sidebar . '2' ) ) {
		return null;
	}

	dynamic_sidebar( CJBL::$sidebar );
}

add_action( 'cjbl_single_under_content', 'cjbl_get_sidebar3' );
function cjbl_get_sidebar3() {
	if ( ! is_active_sidebar( CJBL::$sidebar . '3' ) ) {
		return null;
	}

	dynamic_sidebar( CJBL::$sidebar );
}

add_filter( 'post_type_link', 'cj_update_permalink_structure', 10, 2 );
function cj_update_permalink_structure( $post_link, $post ) {
	if ( false !== strpos( $post_link, '%' . CJBL::$taxonomy . '%' ) ) {
		$event_type_term = get_the_terms( $post->ID, CJBL::$taxonomy );
		foreach ( $event_type_term as $term ) {
			if ( $term->parent ) {
				$parent_term = get_term( $term->parent, CJBL::$taxonomy );
				$post_link   = str_replace( '%' . CJBL::$taxonomy . '%', $parent_term->slug, $post_link );
			}
		}
	}

	return $post_link;
}