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
 * Date of creation: 30-Nov-16 / 10:24
 * Last updated: 30-Nov-16 / 10:24 By Kirill Lavrishev
 *
 */

if ( !is_single() )
	exit;

$postid = $post->ID ? $post->ID : get_queried_object_id() ; // GET POST ID
$author_id = $post->post_author ? $post->post_author : get_post_field( 'post_author', $postid ); // GET AUTHOR ID

?>

<div class="post-meta clearfix">
	<div class="author-image">
		<?php echo get_avatar( $author_id, 32 ); ?>
	</div>
	<div class="post-data">
		<span class="author-name">
			By <a href="<?php echo get_author_posts_url( $author_id ) ?>">
				<?php echo get_the_author_meta( 'display_name', $author_id ) ?>
				</a>
		</span>
		<span class="post-date"> on <?php echo get_the_date( 'l, F j, Y', $postid ) ?></span>
	</div>
</div>
