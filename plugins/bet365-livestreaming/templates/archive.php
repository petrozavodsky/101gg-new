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
 * Date of creation: 18-Jan-17 / 13:10
 * Last updated: 18-Jan-17 / 13:10 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
            <!-- Header end -->

                <?php $main_header_title = CJBL::get_option( 'main_header_title' ) ? CJBL::get_option( 'main_header_title' ) : get_the_archive_title() ?>
            <header class="first-title-on-page">
                <h1><?php echo $main_header_title ?></h1>
            </header>


                <div class="cjbl cjbl-above-table">
                    <ul class="cjbl-categories-list">
                        <div class="cjbl-scroll-left"></div>
                        <?php $categories = cjbl_get_categories();                        ?>
                        <?php $i = 0; foreach( $categories as $value ) : ?>
                            <li class="cjbl-category-list-item <?php echo $i == 0 ? 'active' : '' ?>" id="term-id-<?php echo $value->term_id ?>"><span><?php echo $value->name ?></span></li>
                        <?php $i++; endforeach; ?>
                        <div class="cjbl-scroll-right"></div>
                    </ul>
                </div>

                <?php $i = 0; foreach( $categories as $category ) : ?>
                <div class="cjbl-table-tab <?php echo $i == 0 ? 'active' : '' ?>" id="cjbl-tab-term-id-<?php echo $category->term_id ?>">
                    <div class="cjbl-live-stream-table">
                        <div class="cjbl-table-head cjbl-group">
                            <div class="cjbl-table-title">
                                <h2><?php echo $category->name ?> Live Streaming Games</h2>
                            </div>

                            <div class="cjbl-table-link">
                                <a href="<?php echo get_term_link($category) ?>" class="cjbl-show-all-btn">Show All</a>
                            </div>
                        </div>
                        <table class="cjbl-table">
                            <tbody>
                                <?php foreach ( cjbl_get_from_category( $category->term_id, array('posts_per_page' => 6, 'what_to_show' => 'today') ) as $stream_id ) :

                                    $stream = new CJBL_Stream( $stream_id ) ?>
                                    <tr class="cjbl-table-tr">
                                        <td class="cjbl-table-td cjbl-td-arrow"><div class="cjbl-arrow"></div></td>
                                        <td class="cjbl-table-td cjbl-td-date"><?php echo $stream->get_date() ?></td>
                                        <td class="cjbl-table-td cjbl-td-title"><?php echo $stream->get_title_html() ?></td>
                                        <td class="cjbl-table-td cjbl-td-league"><span class="cjbl-table-td-league"><?php echo $stream->league['name'] ?></span></td>
                                        <td class="cjbl-table-td cjbl-td-link"><?php echo $stream->get_watch_now_html( 'cjbl-table-td-link '); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $i++; endforeach; ?>

                <section class="cjbl-below-archive">
                    <?php do_action('cjbl_archive_below_content'); ?>
                </section>

                <section>
                    <?php echo wpautop(CJBL::get_option( 'under-header-content' )) ?>
                </section>

    <div class="cjbl-image-wrapper">
        <a href="http://www.101greatgoals.com/FootballLiveStreaming101" rel="nofollow" target="_blank"><img src="http://1tvs492zptzq380hni2k8x8p.wpengine.netdna-cdn.com/wp-content/uploads/2017/07/Screen-Shot-2017-07-30-at-20.13.08.jpg"></a>
    </div>
    <!-- End Footer -->
<?php

get_footer();