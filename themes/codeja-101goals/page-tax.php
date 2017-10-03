<?php
/**
 *
 * Template Name: Taxonomy Page Template
 *
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
        <header class="first-title-on-page">
            <h1><?php the_title(); ?></h1>
        </header>
        <ul class="term-list list-inline">
        <?php

            // GET CURRENT SLUG
            $allowed_slugs = array('players', 'teams', 'managers');
            $slug = trim($_SERVER['REQUEST_URI'], '/');
            $selected_taxonomy = in_array($slug, $allowed_slugs) ? $slug : 'players';

            $terms = get_terms( array('taxonomy' => $selected_taxonomy) );
            foreach ( $terms as $term ) : ?>
                    <li class="col-md-3 term-item"><a href="<?php echo get_term_link($term->term_id) ?>"><?php echo $term->name?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
get_footer();