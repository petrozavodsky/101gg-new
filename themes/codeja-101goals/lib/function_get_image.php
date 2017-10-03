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
 * Date of creation: 09-Jan-17 / 16:58
 * Last updated: 09-Jan-17 / 16:58 By Kirill Lavrishev
 *
 */

function get_image_alt() {

    $thumbnail = get_the_post_thumbnail();
    console($thumbnail);

    $output = '';
    $output .= '<picture>
                    <source srcset="<?php the_post_thumbnail_url( \'codeja-homepage-thumb\' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                    <source srcset="<?php the_post_thumbnail_url( \'thumbnail\' ) ?>">
                    <img src="<?php the_post_thumbnail_url( \'thumbnail\' ) ?>">
                </picture>';

    return $output;
}