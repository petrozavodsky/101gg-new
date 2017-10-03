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
 * Date of creation: 01-Jan-17 / 16:39
 * Last updated: 01-Jan-17 / 16:39 By Kirill Lavrishev
 *
 */

function redirect_from_404_to_correct_permalink() {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // REDIRECT IF /layout-mode IN URL
    if ( strpos($actual_link, '/layout-mode') !== false ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . str_replace('/layout-mode', '', $actual_link) );
        exit;
    }

    // REDIRECT IF /item IN URL
    if ( strpos($actual_link, '/item') !== false ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . str_replace('/item', '', $actual_link) );
        exit;
    }

    // REDIRECT IF /packer IN URL
    if ( strpos($actual_link, '/packer') !== false ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . str_replace('/packer', '', $actual_link) );
        exit;
    }


    // REDIRECT IF /rect IN URL
    if ( strpos($actual_link, '/rect') !== false ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . str_replace('/rect', '', $actual_link) );
        exit;
    }

    // EXPLODE AND TRIM "SLUG" BY /
    $full_slug = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    // INIT ARGS ARRAY
    $args = array(
        'post_type'   => array( 'post', CJBL::$post_type ),
        'post_status' => 'publish',
        'posts_per_page' => 1
    );

    // IF LAST "SLUG" CONTAINS NUMBER(POST_ID) TRY TO GET POSTS
    if ( is_numeric( end($full_slug) ) ) {
        $args['p'] = end($full_slug);

        // GET POSTS BY ID
        $my_posts = get_posts($args);

        // CHECK IF POST FOUND
        if ( count($my_posts) > 0 ) {
            ob_clean();
            header('HTTP/1.1 301 Moved Permanently');
            header("Location:" . get_permalink($my_posts[0]));
            exit;
        }

        unset($args['p']);
    }

    // IF NOT NUMBER OR "MY_POSTS" IS EMPTY, TRY BY NAME
    $args['name'] = end($full_slug);
    $args['exact'] = true;


    // GET POSTS BY NAME
    $my_posts = get_posts($args);

    // CHECK IF POST FOUND
    if ( count($my_posts) > 0 ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . get_permalink($my_posts[0]) );
        exit;
    }

    $end_full_slug = str_replace('-2/', '', end($full_slug) . '/');
    $end_full_slug = str_replace('-3/', '', $end_full_slug);
    $args['name'] = $end_full_slug;

    // GET POSTS BY DUPLICATED NAME
    $my_posts = get_posts($args);

    // CHECK IF POST DUPLICATED FOUND
    if ( count($my_posts) > 0 ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . get_permalink($my_posts[0]) );
        exit;
    }

    // LASTLY, TRY FOR CATEGORY
    $category_id = get_category_by_slug(end($full_slug))->term_id;

    // CHECK IF CATEGORY FOUND
    if ( !empty($category_id) ) {
        ob_clean();
        header( 'HTTP/1.1 301 Moved Permanently' );
        header( "Location:" . get_category_link($category_id) );
        exit;
    }

    return null;
}


