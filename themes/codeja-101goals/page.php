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
if (have_posts()) :
	while (have_posts()) : ?>
		<header class="first-title-on-page">
			<h1><?php the_title(); ?></h1>
		</header>
		<?php
		the_post();
		the_content();
	endwhile;
endif;
?>
</div>
<?php
get_footer();