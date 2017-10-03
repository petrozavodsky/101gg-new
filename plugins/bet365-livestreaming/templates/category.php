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

get_header();
$parent_sport_type_id = get_queried_object_id();
?>
                <!-- Header end -->
    <header class="first-title-on-page">
        <h1><?php echo get_cat_name( $parent_sport_type_id ) ?></h1>
    </header>

                <div class="cjbl cjbl-above-table">
                    <ul class="cjbl-categories-list">
                        <div class="cjbl-scroll-left"></div>
                        <?php $parent_categories = cjbl_get_categories( $parent_sport_type_id ); ?>
                        <?php $i = 0; foreach( $parent_categories as $value ) : ?>
                            <li class="cjbl-category-list-item <?php echo ! $i == 0 ?: 'active' ?>" id="term-id-<?php echo $value->term_id ?>"><span><?php echo $value->name ?></span></li>
                        <?php $i++; endforeach; ?>
                        <div class="cjbl-scroll-right"></div>
                    </ul>
                </div>

                <?php $i = 0; foreach( $parent_categories as $category ) : ?>
                <div class="cjbl-table-tab <?php echo ! $i == 0 ?: 'active' ?>" id="cjbl-tab-term-id-<?php echo $category->term_id ?>">
                    <div class="cjbl-live-stream-table league">
                        <div class="cjbl-table-head cjbl-group">
                            <div class="cjbl-table-title">
                                <h2><?php echo $category->name ?></h2>
                            </div>

                            <div class="cjbl-table-link">
                                <a href="<?php echo get_post_type_archive_link( CJBL::$post_type ) ?>" class="cjbl-go-to-main-btn">Go Back to Main &rarr;</a>
                            </div>
                        </div>
                        <table class="cjbl-table">
                            <tbody>
                                <?php foreach ( cjbl_get_from_category( $category->term_id, array('posts_per_page' => 6, 'what_to_show' => 'today') ) as $stream_id ) : $stream = new CJBL_Stream( $stream_id ) ?>
                                    <tr class="cjbl-table-tr">
<!--                                        <td class="cjbl-table-td cjbl-td-arrow"><div class="cjbl-arrow"></div></td>
-->                                        <td class="cjbl-table-td cjbl-td-date"><?php echo $stream->get_date() ?></td>
                                        <td class="cjbl-table-td cjbl-td-title"><?php echo $stream->get_title_html() ?></td>
                                        <td class="cjbl-table-td cjbl-td-league"><?php echo $stream->league['name'] ?></td>
                                        <td class="cjbl-table-td cjbl-td-link"><?php echo $stream->get_watch_now_html( 'cjbl-table-td-link '); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $i++; endforeach; ?>

                <section class="cjbl-below-archive">
                    <?php do_action('cjbl_category_below_content'); ?>
                </section>



                <?php $i = 0; foreach( cjbl_get_categories( $parent_sport_type_id, false ) as $category ) : ?>
                            <div class="cjbl-full-list-header cjbl-group">
                                <div class="cjbl-list-title">
                                    <span><?php echo $category->name ?></span>
                                </div>

                                <a class="cjbl-blue-arrow">&rsaquo;</a>
                                <a class="cjbl-see-all-games-btn">
                                    <span>See All Games</span>
                                </a>
                            </div>
                            <table class="cjbl-full-list-table cjbl-table">
                                <tbody>
                                <?php foreach ( cjbl_get_from_category( $category->term_id, array( 'what_to_show' => 'today' ) ) as $stream_id ) : $stream = new CJBL_Stream( $stream_id ) ?>
                                    <tr class="cjbl-table-tr">
                                        <td class="cjbl-table-td cjbl-td-date"><?php echo $stream->get_date() ?></td>
                                        <td class="cjbl-table-td cjbl-td-title"><?php echo $stream->get_title_html() ?></td>
                                        <td class="cjbl-table-td cjbl-td-league"><?php echo $stream->league['name'] ?></td>
                                        <td class="cjbl-table-td cjbl-td-link"><?php echo $stream->get_watch_now_html( 'cjbl-table-td-link' ) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                    <?php $i++; endforeach; ?>

    <section>
        <?php echo wpautop(CJBL::get_option( 'under-header-content-category' )) ?>
    </section>

    <div class="cjbl-image-wrapper">
        <a href="http://www.101greatgoals.com/FootballLiveStreaming101" rel="nofollow" target="_blank"><img src="http://1tvs492zptzq380hni2k8x8p.wpengine.netdna-cdn.com/wp-content/uploads/2017/07/Screen-Shot-2017-07-30-at-20.13.08.jpg"></a>
    </div>
    <!-- End Footer -->
<?php
get_footer();