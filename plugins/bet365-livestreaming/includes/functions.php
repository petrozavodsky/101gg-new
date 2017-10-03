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
 * Date of creation: 14-Jan-17 / 21:40
 * Last updated: 14-Jan-17 / 21:40 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// GET ALL STREAM CATEGORIES
function cjbl_get_categories( $parent_id = false, $hide_leagues = true ) {
    $categories = array();

    $args = array(
        'taxonomy'  => CJBL::$taxonomy,
        'parent'    => $parent_id,
        'order'     => 'ASC',
    );

    if ( ! $parent_id ) {
        $args['meta_key'] = 'cjbl_order';
        $args['orderby'] = 'meta_value_num';
    }

    foreach ( get_categories( $args ) as $key => $value ) {
        if ( cjbl_is_empty_category( $value->term_id ) ) {
            continue;
        }

        if ( $parent_id && $hide_leagues ) {
            if ( cjbl_is_hidden_league( $value->term_id ) ) {
                continue;
            }
        }

        $categories[] = $value;
    }

    return $categories;
}

function cjbl_is_empty_category( $term_id, $what_to_show = 'today' ) {
    $args = array();

    if ( $what_to_show ) {
        $args['what_to_show'] = $what_to_show;
    }



/*    var_dump(count(cjbl_get_from_category( $term_id, $args ) ));*/
    if ( cjbl_get_from_category( $term_id, $args ) ) {
        return false;
    } else {
        return true;
    }
}

// GET ALL STREAMS IN CATEGORY
function cjbl_get_from_category( $cat_id, $params = array() ) {

    $args = array(
        'fields' => 'ids',
        'post_type' => CJBL::$post_type,
        'orderby' => 'end_time',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => CJBL::$taxonomy,
                'field' => 'term_id',
                'terms' => $cat_id,
            ),
        ),
    );

    $args['posts_per_page'] = $params['posts_per_page'] ? $params['posts_per_page'] : -1;

    if (  $params['what_to_show'] == 'today' ) {
        $tz_object = new DateTimeZone('Europe/London');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $true_timestamp = strtotime( $datetime->format('Y\-m\-d\ H:i:s') );

        $args['meta_query'] = array(
            array(
                'key' => 'end_time',
                'value' => $true_timestamp,
                'compare' => '>',
                'type'  => 'NUMERIC',
            )
        );
    }

    return get_posts( $args );
}

// GET ALL STREAMS
function cjbl_get_streams( $args = array() ) {

    $posts_args = array(
        'fields' => 'ids',
        'post_type' => CJBL::$post_type,
        'meta_key' => 'end_time',
        'orderby' => 'meta_value_num',
        'order' => $args['sort_order'] ? $args['sort_order'] : 'DESC',
    );

    if ( ! is_array( $args['category__not_in'] ) ) { // @@
        $args['category__not_in'] = explode( ',', $args['category__not_in'] );
    }

    $posts_args['tax_query'] = array(
        array(
            'taxonomy' => CJBL::$taxonomy,
            'field'    => 'term_id',
            'terms'    => $args['category__not_in'],
            'operator' => 'NOT IN',
        ),
    );

    $posts_args['posts_per_page'] = $args['posts_per_page'];

    // ONLY LIVE NOW GAMES
    if ( $args['what_to_show'] == 'live' ) {
        $tz_object = new DateTimeZone('Europe/London');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $true_timestamp = strtotime( $datetime->format('Y\-m\-d\ H:i:s') );

        $posts_args['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'start_time',
                'value' => $true_timestamp,
                'compare' => '<=',
                'type' => 'NUMERIC'
            ),
            array(
                'key' => 'end_time',
                'value' => $true_timestamp + 60 * 60,
                'compare' => '>=',
                'type' => 'NUMERIC'
            )
        );
        // ONLY CLOSEST TO TODAY'S DATE
    } elseif ( $args['what_to_show'] == 'today' ) {
        unset( $posts_args['meta_query'] );

        $tz_object = new DateTimeZone('Europe/London');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $true_timestamp = strtotime( $datetime->format('Y\-m\-d\ H:i:s') );

        $posts_args['meta_query'] = array(
            array(
                'key' => 'end_time',
                'value' => $true_timestamp + 60 * 60,
                'compare' => '>',
                'type' => 'NUMERIC'
            )
        );
    }

    return get_posts( $posts_args );
}

function cjbl_is_hidden_league( $league_id ) {
    if ( CJBL::get_import_option( 'hide_term_' . $league_id ) ) {
        return true;
    } else {
        return false;
    }
}

// HELP FUNCTION
function cjbl_sorting_array( $a, $b ) {
    if ( $a['time'] == $b['time'] ) {
        return 0;
    }

    return ( $a['time'] > $b['time'] ) ? - 1 : 1;
}

// DEFAULT CONTENT
function cjbl_get_under_content( $stream_id, $content = false ) {
    if ( ! $stream_id ) {
        $stream_id = get_queried_object_id();
    }

    $content = $content ? $content : wpautop(CJBL::get_option( 'under-livestream-content' ));

    return cjbl_replace_content_with_real_data ( $content, $stream_id );
}

// CHANGE CONTENT WITH REAL VARIABLES
function cjbl_replace_content_with_real_data( $content = '', $stream_id = false, $get_content = true ) {
    if ( ! $stream_id ) {
        $stream_id = get_queried_object_id();
    }

    $stream = new CJBL_Stream( $stream_id );
    if  ( ! $content && $get_content ) {
        ob_start();
        the_content( $stream_id);
        $content = ob_get_contents();
        ob_clean();
    }

    // REPLACE PLACEHOLDER VARIABLES WITH REAL DATA // {team1}, {team2}
    $content = str_replace( '{opponents}', $stream->get_opponents_html(), $content );
    $content = str_replace( '{bet365_button}', $stream->get_watch_now_html( 'cjbl-watch-button btn', 'Watch And Bet on Bet365', 1 ), $content );
    $content = str_replace( '{competition}', $stream->league['name'], $content );
    $content = str_replace( '{sport}', $stream->sport_type['name'], $content );

    if ( cj_is_amp() ) {
    	if ( cjbl_get_data_for_league($stream->league['name'])['img'] ) {
		    $content = str_replace( '{league_image}', '<amp-img src="' . cjbl_get_data_for_league( $stream->league['name'] )['img'] . '" width="400" height="170" layout="responsive"></amp-img>', $content );
	    } else {
		    $content = str_replace( '{league_image}', '', $content );
	    }
    } else {
	    $content = str_replace( '{league_image}', '<img src="' . cjbl_get_data_for_league($stream->league['name'])['img'] . '">' , $content );
    }

    $content = str_replace( '{blocked_countries}', cjbl_get_blocked_countries($stream->blocked_countries),$content );

    // REPLACE DATE WITH REAL DATA
    $content = str_replace( '{date}', $stream->get_date('d-m-Y'), $content );
    $content = str_replace( '{time}', $stream->get_date('H:i'), $content );

    return $content;
}

function cjbl_get_data_for_league( $name ) {

    $leagues = array(
        'Mexico Apertura' => array (
            'name' => 'Mexico Apertura',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_Mexico.svg1_-300x171.png',
            'not_allowed_countries' => 'South America & Mexico'
        ),
        'A League' => array (
            'name' => 'A League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/A-League_logo1.png',
            'not_allowed_countries' => 'Canada & Australia'
        ),
        'AFF Suzuki Cup' => array (
            'name' => 'AFF Suzuki Cup',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/roh1.jpg',
            'not_allowed_countries' => ''
        ),
        'Austria Bundesliga' => array (
            'name' => 'Austria Bundesliga',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/aut_bundsliga1.jpg',
            'not_allowed_countries' => 'Austria, Germany and Italy'
        ),
        'Austria Erste Liga' => array (
            'name' => 'Austria Erste Liga',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/aut_bundsliga1.jpg',
            'not_allowed_countries' => 'Austria, Germany and Italy'
        ),
        'Argentina Primera Division' => array (
            'name' => 'Argentina Primera Division',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/argentina_primera_division_live1.jpg',
            'not_allowed_countries' => 'South America & Canada - UK & Ireland are fine'
        ),
        'Asian Champions League (ACL)' => array (
            'name' => 'Asian Champions League (ACL)',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/afc_champions_league1.jpg',
            'not_allowed_countries' => 'Australia & China'
        ),
        'Bulgarian A PFG League' => array (
            'name' => 'Bulgarian A PFG League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/1587190_w21.jpg',
            'not_allowed_countries' => 'Bulgaria'
        ),
        'Belgium Pro League' => array (
            'name' => 'Bulgarian A PFG League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/pro_league_logo_l1.jpg',
            'not_allowed_countries' => '',
            'allowed_countries' => 'UK, Ireland, Canada, Australia, Bulgaria, Chile, Czech Republic, Denmark, Germany, Greece, Hungary, Italy, Poland, Portugal, Romania, Slovakia, Spain & Sweden'
        ),
        'Campeonato Brasileiro' => array (
            'name' => 'Campeonato Brasileiro',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/CAMPEONATO-BRASILEIRO1.jpg',
            'not_allowed_countries' => 'Canada, Spain, Italy and South America',
            'allowed_countries' => ''
        ),
        'Capital One Cup' => array (
            'name' => 'Capital One Cup',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2trophy800x450304-589123_1600x9001.jpg',
            'not_allowed_countries' => 'Japan, Middle East, North Africa, UK, Ireland and USA',
            'allowed_countries' => ''
        ),
        'China Super League' => array (
            'name' => 'China Super League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/csl-logo-NEW-Small-640x4201.png',
            'not_allowed_countries' => 'China',
            'allowed_countries' => ''
        ),
        'Chilean Arpetura' => array (
            'name' => 'Chilean Arpetura',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/U-campeC3B3n-620x3301.jpg',
            'not_allowed_countries' => '',
            'allowed_countries' => ''
        ),
        'Columbian league' => array (
            'name' => 'Columbian league',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/seleccion_colombia1.jpg',
            'not_allowed_countries' => 'Canada',
            'allowed_countries' => ''
        ),
        'CONCACAF Champions League' => array (
            'name' => 'CONCACAF Champions League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/concacaf-champions-league1.jpg',
            'not_allowed_countries' => 'Canada & South America',
            'allowed_countries' => ''
        ),
        'Copa del Rey' => array (
            'name' => 'CONCACAF Champions League',
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/concacaf-champions-league1.jpg',
            'not_allowed_countries' => 'Canada & South America',
            'allowed_countries' => ''
        ),
        'Copa do Brasil' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/COPA-DO-BRASIL-20141.jpg',
            'allowed' => 'is available worldwide, except for in Brazil.'
        ),
        'Copa Libertadores' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/copalibertadores1.jpg',
            'allowed' => 'is available worldwide, except for in Brazil and the USA.'
        ),
        'Coppa Italia' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Coppa-Italia1.jpg',
            'allowed' => 'is available in UK, Ireland, Canada, Australia, Germany, Sweden, Bulgaria, Greece, Poland, Portugal, Romania, Czech Republic & Hungary. It is not available in Italy, Denmark & Norway.'
        ),
        'Denmark Superligaen' => array (
            /*correct*/
            'img' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTZwVzY9NhQ46tGRTHbKIll4YOSQVvf8i3QSzVPpqjlJWEJkEJb',
            'allowed' => 'is available worldwide, except for in Denmark.'
        ),
        'Denmark Division 1' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/640px-Denmark_flag1.gif',
            'allowed' => 'is available worldwide, except for in Denmark.'
        ),
        'Dutch Cup' => array (
            'img' => 'http://home.knvb.nl/media/3001/knvb-beker.jpg?anchor=center&mode=crop&width=1440&height=938&rnd=130561451340000000',
            'allowed' => 'is available worldwide, except for in Holland.'
        ),
        'Ecuadorian League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/deportivo-quito-2011-ecuador-serie-a-champions1.jpg',
            'allowed' => 'is available worldwide, except for in Canada, Spain & South America.'
        ),
        'France Ligue 1' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/maxresdefault1.jpg',
            'allowed' => 'is available everywhere in the world, except for France.'
        ),
        'France Ligue 2' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/16544830832_3c8454ffa8_o_d1.jpg',
            'allowed' => 'is available everywhere in the world, except for France.'
        ),
        'Finland Veikkausliiga' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/1280px-Veikkausliigan_logo.svg1_.png',
            'allowed' => 'can be watched everywhere on the planet - there are no geographical restrictions.'
        ),
        'Germany Bundesliga I' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/bundesliga-radio1.jpg',
            'allowed' => 'is available in UK, Ireland, Spain, Italy, Greece & Portugal, but it is not available in Germany or Austria.'
        ),
        'Germany Bundesliga II' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/germany-2_-bundesliga1.jpg',
            'allowed' => 'is available in UK, Ireland, Spain, Italy, Greece & Portugal, but it is not available in Germany or Austria.'
        ),
        'Greek Super League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/slg_logo1.jpg',
            'allowed' => 'is available worldwide, except Canada, Australia & Greece.'
        ),
        'Holland Eredivisie' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Logo_eredivisie1.jpg',
            'allowed' => 'is available in the following countries: UK, Germany, Czech Republic, Sweden, Spain, Italy, Romania, Poland, Republic of Ireland, Bulgaria, Slovakia, Greece, Canada, Australia, China, Denmark, Portugal, Switzerland, Hungary, Cyprus and Austria.'
        ),
        'Indonesia League' => array (
            'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Flag_of_Indonesia.svg/2000px-Flag_of_Indonesia.svg.png',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Italy Serie A' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/serie-a1.jpg',
            'allowed' => 'is available in the UK, Ireland, Canada, Australia, Bulgaria, Chile, Czech Republic, Denmark, Germany, Greece, Hungary, Poland, Portugal, Romania, Slovakia, Spain & Sweden.'
        ),
        'Japan J-League' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/JLeague-logo1.png',
            'allowed' => 'is available worldwide, except for in Australia, Japan and Brazil.'
        ),
        'Korean League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/280_-k-league-primary-1.gif',
            'allowed' => 'is available worldwide, except for in Canada & Korea.'
        ),
        'Lithuania League \'A Lyga\'' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/A-Lyga_Lithuania_Football-League1.jpg',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Norway Tippeligaen' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Tippeligaen-20121.png',
            'allowed' => 'is available worldwide, except for in Scandanavia & USA.'
        ),
        'USA - MLS' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/new-mls-crest-header12.jpg',
            'allowed' => 'is available worldwide, except for in Canada, South America and the USA.'
        ),
        'Mexico Liga de Ascenso' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_Mexico.svg1_-1.png',
            'allowed' => 'is available worldwide, except for in South America & Mexico.'
        ),
        'England Championship' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Sky_Bet_Championship1.png',
            'allowed' => 'is available worldwide, except for the UK, Japan, the Middle East, North Africa, Ireland and the USA.'
        ),
        'League One' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/league102-11.png',
            'allowed' => 'is available worldwide, except for the UK, Japan, the Middle East, North Africa, Ireland and the USA.'
        ),
        'Brazil Paulista Championship' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/brazil-intro3.jpg',
            'allowed' => 'is available worldwide, except for Brazil, Canada, Chile, Spain and Italy.'
        ),
        'Poland Ekstraklasa' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Ekstraklasa_Website1.jpg',
            'allowed' => 'is available worldwide, except for in Poland.'
        ),
        'Portugal Primeira Liga' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Drapeau_Portugal1.png',
            'allowed' => 'is available everywhere in the world, except for Portugal.'
        ),
        'Portuguese Liga Sagres' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Drapeau_Portugal1.png',
            'allowed' => 'is available everywhere in the world, except for Portugal.'
        ),
        'Portugal Liga de Horna' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Drapeau_Portugal1.png',
            'allowed' => 'is available everywhere in the world, except for Portugal.'
        ),
        'Ukraine League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_Ukraine.svg1_.png',
            'allowed' => 'is available worldwide, except for in Ukraine.'
        ),
        'Russia Premier League' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Rnfl_logo1.jpg',
            'allowed' => 'is available worldwide, except for in Russia.'
        ),
        'Russian Cup' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/059a084dc1f9a97cf91646fce8f356bc1.jpg',
            'allowed' => 'is available worldwide, except for in Russia.'
        ),
        'Scotland Premiership' => array (
            /*correct*/
            'img' => 'http://i1.dailyrecord.co.uk/incoming/article2089077.ece/ALTERNATES/s298/Scottish-Premishership.jpg',
            'allowed' => 'is available worldwide, except for the UK and Ireland.'
        ),
        'Scotland Championship' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/195649-scottish-championship-logo1.jpg',
            'allowed' => 'is available worldwide, except for the UK and Ireland.'
        ),
        'Scottish FA Cup' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/scottish_cup_1.jpg',
            'allowed' => 'is not available in the UK but can be watched everywhere else on the planet.'
        ),
        'South Korea K-League Classic' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_South_Korea.svg1_.png',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Spain Primera Liga' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/spain-primera-division-previews1-1.jpg',
            'allowed' => 'is available worldwide, except for Spain or the Middle East and North Africa -  everywhere else on the planet - including the UK & Ireland is fine'
        ),
        'Spain Segunda' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Liga_Adelante1.jpg',
            'allowed' => 'is available worldwide, except for the UK, Ireland, Australia and Spain - everywhere else on the planet is fine'
        ),
        'Sweden Allsvenskan' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/allsvenskan1.png',
            'allowed' => 'is available worldwide, except for Denmark, Sweden & Norway.'
        ),
        'Turkey Super Lig' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/spor_toto_super_lig1.jpg',
            'allowed' => 'is available worldwide, except for Canada, Australia and Germany.'
        ),
        'Turkey Cup' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/spor_toto_super_lig1.jpg',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Bolivian League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_Bolivia_state.svg1_.png',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Israeli League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/israel-sport1.jpg',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Switzerland Challenge League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Swiss-Football-League1.jpg',
            'allowed' => 'is available worldwide - except for in Switzerland and Germany.'
        ),
        'Switzerland Super League' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Swiss_Flag1.gif',
            'allowed' => 'is available worldwide - except for in Switzerland and Germany.'
        ),
        'Indian I League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/150386hp21.jpg',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Slovenia Prva Liga' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Slovenia-Prva-Liga-logo1.jpg',
            'allowed' => 'is available worldwide - there are no geographical restrictions.'
        ),
        'Ukraine Vyscha Liga' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/1101.jpg',
            'allowed' => 'is available worldwide - except for Ukraine.'
        ),
        'Paraguay Division Profesional' => array (
            /*correct*/
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/2000px-Flag_of_Paraguay.svg1_.png',
            'allowed' => 'is available worldwide - except for in South America.'
        ),
        'Peru Apertura' => array (
            'img' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRb8SsabJSXb8c_6oZ330j3oiwTyNnsX-xFwMpTClyqxag6U8jAfA',
            'allowed' => 'is available worldwide - except for in South America. '
        ),
        'Uruguayan League' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/UruguayFlagImage11.png',
            'allowed' => 'is available worldwide - except for in South America.'
        ),
        'Greek Super Cup' => array (
            'img' => 'http://www.101greatgoals.com/wp-content/uploads/2016/02/Greece-Flag1.png',
            'allowed' => 'is available worldwide - except for in Greece.'
        )
    );

    return $leagues[$name];
}

function cjbl_get_country( $abbr ) {

    $countries = array
    (
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );

    return $countries[$abbr];
}

function cjbl_get_blocked_countries( $blocked_countries ) {
    $blocked_countries_text = '';
    $blocked_countries = explode('#', $blocked_countries);

    $loop = 0;
    foreach ( $blocked_countries as $country_abbr ) {
        $loop++;

        $blocked_countries_text .= cjbl_get_country($country_abbr);

        if ( count( $blocked_countries ) != $loop ) {
            if ( count( $blocked_countries )-1 == $loop ) {
                $blocked_countries_text .= ' & ';
            } else {
                $blocked_countries_text .= ', ';
            }
        }
    }

    return $blocked_countries_text;
}

function cjbl_update_the_content( $content ) {
    $link = CJBL::get_option( 'watch_now_link' );
    $text = CJBL::get_option( 'single_watch_now_text' );


    $link = '<a  class="cjbl-watch-button btn" href="' . $link .'" rel="nofollow"  target="_blank">' . $text . '</a>';
    return $content = str_replace( '{bet365_button}', $link, $content );

}

add_filter( 'the_content','cjbl_update_the_content' );

add_filter('wpseo_metadesc','change_yoast_description',100,1); 
function change_yoast_description($description)
{
    if ( is_post_type_archive( CJBL::$post_type ) && ! is_singular()) {
        $description = 'Watch online live streaming & live streams of Football, Tennis, Horse Racing, Basketball, Cricket, E-Sports, Badminton, Ice hockey, Handball, Bowls, Snooker';
    }


    if ( is_tax( CJBL::$taxonomy, 17685) ) {
        $description = 'Watch online football live streaming of some of the biggest live streams around, includes La Liga, Serie A, Championship, Carabao Cup, Copa Libertadores...';
    }

    return $description;
}

add_filter('wpseo_title','change_yoast_title',100,1);
function change_yoast_title($title)
{
    if ( is_post_type_archive( CJBL::$post_type ) && ! is_singular()) {
        $title = 'Live Streaming sports: football, tennis, horse racing & more';
    }

    if ( is_tax( CJBL::$taxonomy, 17685) ) {
        $title = 'Football live streaming, watch soccer live streams: La Liga, Serie A & more';
    }

    return $title;
}