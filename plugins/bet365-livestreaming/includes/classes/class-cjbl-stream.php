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
 * Date of creation: 18-Jan-17 / 16:52
 * Last updated: 18-Jan-17 / 16:52 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CJBL_Stream {
    public $ID, $title, $date, $category, $league, $is_live;
    public $post_data;

    public function __construct( $post ) {
        if ( ! is_numeric( $post ) ) {
            $post = $post->ID;
        }

        if ( get_post_type( $post ) != CJBL::$post_type ) {
            return new WP_Error( 'Error', __( "Incorrect post id given", "cjbl" ) );
        }

        $this->ID = $post;

        $this->post_data = json_decode( get_post_meta( $this->ID, 'attributes', true ), true );

        $this->title = $this->get_title();
        $this->sport_type = $this->get_sport_type();
        $this->blocked_countries = $this->post_data['BlockedCountryCodes'];
        $this->league = $this->get_league();
        $this->is_live = $this->is_live();
        $this->teams = $this->get_teams();
    }

    private function get_title() {
        return get_the_title( $this->ID );
    }

    private function get_teams() {
        $tmp = array(
            'team_1' => $this->post_data['team_1'],
            'team_2' => $this->post_data['team_2']
        );

        return $tmp;
    }

    /**
     * @param bool $with_line_break
     * @return string
     */
    public function get_opponents_html( $with_line_break = false ) {
        $html = '';

        $html .= $this->teams['team_1'];

        // CHECK IF THERE IS SECOND TEAM
        if ( ! empty( $this->teams['team_2'] ) ) {
            // ADD LINE BREAK
            if ( $with_line_break ) {
                $html .= '<span class="cjbl-v-line-break"> v </span>';
            } else {
                $html .= ' v ';
            }
            $html .= $this->teams['team_2'];
        }

        return $html;
    }

    public function get_date( $format = 'd.m | H:i' ) {
        if ( ! $this->post_data['EventStart'] ) {
            return new WP_Error('No EventStart', 'Event Start in Stream not set');
        }

        $new_date = date( $format, strtotime( $this->post_data['EventStart'] ) + 60 * 60 );

        return $new_date;
    }

    public function get_date_end( $format = 'd.m | H:i' ) {
        if ( ! $this->post_data['EventEnd'] ) {
            return new WP_Error('No EventEnd', 'Event End in Stream not set');
        }

        $new_date = date( $format, strtotime($this->post_data['EventStart']));

        return $new_date;
    }

    public function get_sport_type() {
        //CJBL::add_log( 'check if parent taxonomy exist', json_encode ( $this->get_term( 'parent' ) ) );
        $term = $this->get_term( 'parent' );

        return get_object_vars( $term );
    }

    private function get_term( $get = 'parent' ) {
        $terms = get_the_terms( $this->ID, CJBL::$taxonomy );

        // SPLIT TERMS TO PARENT / CHILD
        $new_terms = array();

        foreach ( $terms as $term ) {
            if ( $term->parent == 0 ) {
                $new_terms['parent'] = $term;
            } else {
                $new_terms['child'] = $term;
            }
        }

        if ( $get == 'parent' ) {
            return $new_terms['parent'] ? $new_terms['parent'] : false;
        } else {
            return $new_terms['child'] ? $new_terms['child'] : false;
        }
    }

    private function is_live() {
        $tz_object = new DateTimeZone('Europe/London');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $true_date = $datetime->format('Y\-m\-d\ H:i:s');

        $date_object_now = new DateTime( $true_date );
        $date_object_start =  new DateTime( $this->get_date('Y\-m\-d\ H:i:s' ) );
        $date_object_end =  new DateTime( $this->get_date_end('Y\-m\-d\ H:i:s' ) );

        if (
            ( $date_object_now->getTimestamp() >= $date_object_start->getTimestamp() + 60*60 ) &&
            ( $date_object_now->getTimestamp() <= $date_object_end->getTimestamp()  + 60*60 )
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $class
     * @return string
     */
    public function get_watch_now_html( $class = '', $text = 'Watch Now', $single = false ) {
        $link = CJBL::get_option( 'watch_now_link' ) ? CJBL::get_option( 'watch_now_link') : get_permalink( $this->ID );

        if ( $single ) {
            $text = CJBL::get_option( 'single_watch_now_text' ) ? CJBL::get_option( 'single_watch_now_text') : $text;
        }


        $content = $text;

        // REPLACE PLACEHOLDER VARIABLES WITH REAL DATA // {team1}, {team2}
        $content = str_replace( '{opponents}', $this->get_opponents_html(), $content );
        $content = str_replace( '{competition}', $this->league['name'], $content );
        $content = str_replace( '{sport}', $this->sport_type['name'], $content );

        // REPLACE DATE WITH REAL DATA
        $content = str_replace( '{date}', $this->get_date('d-m-Y'), $content );
        $content = str_replace( '{time}', $this->get_date('H:i'), $content );

        if ( cj_is_amp() ) {
        	$link = '<a class="' . $class . '" href="' . $link .'" target="_blank">' . $content . '</a>';
        } else {
	        $link = '<a class="' . $class . '" href="' . $link .'" alt="' . $this->title . '" rel="nofollow"  target="_blank">' . $content . '</a>';
        }

        return $link;
    }

    /**
     * @param string $class
     * @param string $title
     * @return string
     */
    public function get_title_html( $class = '' ) {
        $link = get_permalink( $this->ID );

        $title = $this->get_opponents_html();

        return '<a class="' . $class . '" href="' . $link .'" alt="' . $this->title . '">' .  $title . '</a>';
    }

    private function get_league() {
        return (array) $this->get_term( 'child' );
    }
}