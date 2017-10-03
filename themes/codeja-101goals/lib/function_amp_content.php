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
 * Date of creation: 28-Dec-16 / 14:07
 * Last updated: 28-Dec-16 / 14:07 By Kirill Lavrishev
 *
 */

function is_amp() {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if ( strpos('/amp', $actual_link) !== false || strpos('?amp', $actual_link) !== false) {
        return true;
    } else {
        return false;
    }
}
/*
function get_amp_content( $post_id ) {
    $post_id = get_real_post_id( $post_id );

    $content = get_the_content( $post_id );


    return $new_content;
}*/