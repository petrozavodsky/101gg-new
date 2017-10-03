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
 * Last updated: 25-Oct-16 / 22:24 By Kirill Lavrishev
 *
 */

get_header(); 

?>

    <!-- Match Previews -->
<?php if ( wp_is_mobile() ) : ?>
    <iframe src="https://imstore.bet365affiliates.com/365_700816-507-72-6-149-1-55698.aspx" width="300" height="250" frameborder="0" scrolling="no">
    </iframe>
<?php endif; ?>
<h1>Football betting offer of the day!</h1>
    <?php
cj_get_betting_box();
   $args = array(
        'post_type' => 'post',
        'cat'  => '20704',
    );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>

    <div class="row">
            <div class="col-md-12">
                <div class="category-block">
                    <div class="row">
                        <header class="category-block-top text-center">
                            <a><h2>Match Previews</h2></a>
                            <p></p>
                        </header>
                    </div>
                    <div class="row category-posts">
                            <?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>
                                <?php $no_padding = $i % 2 == 0 ? 'col-no-padding' : '';?>

                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo $no_padding ?> category-post">
                                    <div class="post-wrapper">
                                        <a href="<?php the_permalink() ?>">
                                            <div class="post-image">
                                                <?php get_post_thumbnail_id() ?>
                                                <picture>
                                                    <source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                                                    <source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                                    <img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                                </picture>
                                            </div>
                                            <div class="post-excerpt">
                                                <p>
                                                    <?php the_real_or_external_title() ?>
                                                </p>
                                                <span class="btn btn-readmore btn-absolute">
													<span class="readmore-text">Read More</span>
													<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
												</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php     endif; ?>
    <!-- Football Betting News -->
    <?php
    $args = array(
        'post_type' => 'post',
        'cat'  => '20705',
    );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>

    <div class="row">
        <div class="col-md-12">
            <div class="category-block">
                <div class="row">
                    <header class="category-block-top text-center">
                        <a><h2>Football Betting News</h2></a>
                        <p></p>
                    </header>
                </div>
                <div class="row category-posts">
                        <?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>
                            <?php $no_padding = $i % 2 == 0 ? 'col-no-padding' : '';?>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo $no_padding ?> category-post">
                                <div class="post-wrapper">
                                    <a href="<?php the_permalink() ?>">
                                        <div class="post-image">
                                            <?php get_post_thumbnail_id() ?>
                                            <picture>
                                                <source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                                                <source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                                <img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                            </picture>
                                        </div>
                                        <div class="post-excerpt">
                                            <p>
                                                <?php the_real_or_external_title() ?>
                                            </p>
                                            <span class="btn btn-readmore btn-absolute">
													<span class="readmore-text">Read More</span>
													<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
												</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- Normal Betting Posts -->
<?php if ( have_posts() && false ) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="category-block">
                <div class="row">
                    <header class="category-block-top text-center">
                        <a><h2>Betting</h2></a>
                        <p></p>
                    </header>
                </div>
                <div class="row category-posts">
                        <?php while ( have_posts() ) : the_post(); $i++; ?>
                            <?php $no_padding = $i % 2 == 0 ? 'col-no-padding' : '';?>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo $no_padding ?> category-post">
                                <div class="post-wrapper">
                                    <a href="<?php the_permalink() ?>">
                                        <div class="post-image">
                                            <?php get_post_thumbnail_id() ?>
                                            <picture>
                                                <source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                                                <source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                                <img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                            </picture>
                                        </div>
                                        <div class="post-excerpt">
                                            <p>
                                                <?php the_real_or_external_title() ?>
                                            </p>
                                            <span class="btn btn-readmore btn-absolute">
													<span class="readmore-text">Read More</span>
													<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
												</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
    </div>
<?php   endif; ?>

    <!-- Football Betting Brand Reviews -->
    <?php
    $post_to_show = array(
        673152,
        673147,
        673144,
        673132,
        673122,
        673120,
        673109,
        673103,
        673072,
        715085
    );

    $args = array(
        'post_type' => 'post',
        'post__in'  => $post_to_show,
    );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="category-block">
                <div class="row">
                    <header class="category-block-top text-center">
                        <a><h2>Football Betting Brand Reviews</h2></a>
                        <p></p>
                    </header>
                </div>
                <div class="row category-posts">

                        <?php while ( $query->have_posts() ) : $query->the_post(); $i++; ?>
                            <?php $no_padding = $i % 2 == 0 ? 'col-no-padding' : '';?>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 <?php echo $no_padding ?> category-post">
                                <div class="post-wrapper">
                                    <a href="<?php the_permalink() ?>">
                                        <div class="post-image">
                                            <?php get_post_thumbnail_id() ?>
                                            <picture>
                                                <source srcset="<?php the_post_thumbnail_url( 'codeja-homepage-thumb' ) ?>" media="(min-width: 360px) and (max-width: 768px)">
                                                <source srcset="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                                <img src="<?php the_post_thumbnail_url( 'thumbnail' ) ?>">
                                            </picture>
                                        </div>
                                        <div class="post-excerpt">
                                            <p>
                                                <?php the_real_or_external_title() ?>
                                            </p>
                                            <span class="btn btn-readmore btn-absolute">
													<span class="readmore-text">Read More</span>
													<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
												</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
             <?php       endif; ?>



<?php
get_footer();