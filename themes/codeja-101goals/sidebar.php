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
 * Date of creation: 28-Sep-16 / 14:19
 * Last updated: 28-Sep-16 / 14:19 By Kirill Lavrishev
 *
 */

// if ( post_is_in_descendant_category( 16469 ) || is_singular( CJBL::$post_type ) || is_post_type_archive( CJBL::$post_type ) || is_tax( CJBL::$taxonomy ) ) {
//     $selected_sidebar = 'codeja-livestream-sidebar';
// } elseif ( is_single() ) {
// 	$selected_sidebar = 'codeja-single-sidebar';
// } else if ( is_category( 'betting' ) ) {
//     $selected_sidebar = 'codeja-betting-sidebar';
// } else {
// 	$selected_sidebar = 'codeja-default-sidebar';
// }

$selected_sidebar = esc_html( $_GET['selected_sidebar'] );

if ( is_active_sidebar( $selected_sidebar ) ) : ?>
	<div id="secondary" class="col-md-3 col-sm-4">
		<?php dynamic_sidebar( $selected_sidebar ); ?>
	</div>
<?php endif; ?>
