<?php

/**
 * Created by CODEJA.
 * User: kirillrocks
 * Date: 30-Jan-17
 * Time: 13:55
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class CJBL_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'cjbl_widget', // Base ID
            esc_html__( 'Bet365 Widget', 'text_domain' ), // Name
            array( 'description' => esc_html__( 'A bet365 live streaming mobile friendly table widget', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $title = $instance['title'] ? $instance['title'] : 'Live Streaming Widget';
        $posts_per_page = $instance['posts_per_page'] ? $instance['posts_per_page'] : '';
        $what_to_show = ! empty( $instance['what_to_show'] ) ? $instance['what_to_show'] : '';
        $what_sports_to_hide = $instance['what_sports_to_hide'] ? $instance['what_sports_to_hide'] : '';
        $sort_order = $instance['sort_order'] ? $instance['sort_order'] : '';
        ?>


         <div class="cjbl-widget cjbl-live-stream-table">
             <div class="cjbl-widget-top cjbl-group">
                 <div class="cjbl-widget-title">
                     <span><?php echo $title ?></span>
                 </div>

                <a href="<?php echo get_post_type_archive_link( CJBL::$post_type ) ?>" class="cjbl-see-all-streams-btn">
                    <span>See All Live Streams</span><span class="cjbl-blue-arrow"><span class="cjbl-blue-arrow-effect">&rsaquo;</span></span>
                </a>
             </div>

            <table class="cjbl-table">
                <tbody>
                <?php $args = array(
                        'posts_per_page'    => $posts_per_page,
                        'category__not_in'  => $what_sports_to_hide,
                        'what_to_show'      => $what_to_show,
                        'sort_order'        => $sort_order,
                );?>

                <?php if ( count ( cjbl_get_streams( $args ) ) == 0 ) : ?>
                    There is no new live streaming games.
                <?php endif; ?>
                <?php foreach (  cjbl_get_streams( $args ) as $stream_id ) : $stream = new CJBL_Stream( $stream_id ) ?>
                    <tr class="cjbl-table-tr">
                        <td class="cjbl-table-td cjbl-td-arrow"><div class="cjbl-arrow"></div></td>
                        <td class="cjbl-table-td cjbl-td-desktop-time"><?php echo $stream->get_date(); ?></td>
                        <td class="cjbl-table-td cjbl-td-title">
                            <span class="cjbl-table-game-name"><?php echo $stream->get_title_html() ?></span>
                            <span class="cjbl-table-league-name"><?php echo trim ( $stream->league['name'] ) ?></span>
                        </td>
                        <td class="cjbl-table-td cjbl-td-sport-title"><?php echo $stream->sport_type['name'] ?><span class="cjbl-mobile-time"> | <?php echo $stream->get_date( 'd.m , H:i' ); ?></span></td>
                        <td class="cjbl-table-td cjbl-td-watch-now"><?php echo $stream->get_watch_now_html( 'cjbl-table-td-link' ); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <?php
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        $posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 6;
        $what_to_show = ! empty( $instance['what_to_show'] ) ? $instance['what_to_show'] : $instance['what_to_show'];
        $what_sports_to_hide = ! empty( $instance['what_sports_to_hide'] ) ? $instance['what_sports_to_hide'] : '';
        $sort_order = ! empty( $instance['sort_order'] ) ? $instance['sort_order'] : '';
        ?>
        <p>


            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_attr_e( 'How much to show?', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'what_sports_to_hide' ) ); ?>"><?php esc_attr_e( 'What sports to exclude?', 'text_domain' ); ?></label>
            <select class="widefat" multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'what_sports_to_hide' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'what_sports_to_hide' ) ); ?>[]">

                <?php $selected_array = explode( ',', $what_sports_to_hide ); ?>
                <?php foreach ( cjbl_get_categories() as $value ) : ?>
                    <?php $is_selected = in_array( $value->term_id, $selected_array ) ? 'selected="true"' : false; ?>
                    <option value="<?php echo $value->term_id ?>" <?php echo $is_selected ?>><?php echo $value->name ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'what_to_show' ) ); ?>"><?php esc_attr_e( 'What to show?', 'text_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'what_to_show' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'what_to_show' ) ); ?>">
                <option value="today" <?php selected($what_to_show, 'today', true) ?>>Stream closest to today`s date</option>
                <option value="live" <?php selected($what_to_show, 'live', true) ?>>Stream live now</option> 
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'sort_order' ) ); ?>"><?php esc_attr_e( 'Sort Order', 'text_domain' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sort_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sort_order' ) ); ?>">
                <option value="ASC" <?php selected( $sort_order, 'ASC', true) ?>>ASC</option>
                <option value="DESC" <?php selected( $sort_order, 'DESC', true) ?>>DESC</option>
            </select>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? strip_tags( $new_instance['posts_per_page'] ) : '';
        $instance['what_to_show'] = ( ! empty( $new_instance['what_to_show'] ) ) ?  $new_instance['what_to_show'] : '';
        $instance['what_sports_to_hide'] = ( ! empty( $new_instance['what_sports_to_hide'] ) ) ? strip_tags( implode(',', $new_instance['what_sports_to_hide'] )) : '';
        $instance['sort_order'] = ( ! empty( $new_instance['sort_order'] ) ) ? strip_tags( $new_instance['sort_order'] ) : '';

        return $instance;
    }

 // class Foo_Widget
}