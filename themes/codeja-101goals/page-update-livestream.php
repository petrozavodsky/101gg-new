<?php
/**
 *
 * Template Name: Get Live Stream
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

get_header();
$str_xml = simplexml_load_file('http://oddsfeed3.bet365.com/DiaryStreaming.aspx?LanguageID=1');
// DEBUGGING PURPOSES
if ($_GET['show_all'] == 'yes') {
    $link = 'http://oddsfeed3.bet365.com/Soccer.asp?EventGroupID=100100';
    $str_xml = simplexml_load_file($link);

    echo '<pre style="text-align: left; float: left">';
    print_r($link);
    print_r($str_xml);
    echo file_get_contents('http://oddsfeed3.bet365.com/Soccer.asp?EventGroupID=100100');
    echo '</pre>';
    wp_die();
}

if ($_GET['generate_streams'] != 'yes' || $_GET['password'] != 'ronnie' || empty($_GET['email_to'])) {
    die('Not Allowed');
}

// RESET
$total_loops = 0;
$total_post_added = 0;

// RESET COUNTING
wp_defer_term_counting(true);
wp_defer_comment_counting(true);
$wpdb->query('SET autocommit = 0;');

$live_stream_categories = array(
    'main' => array(
        'id' => 16469,
        'posts_this_time' => 0
    ),
    'tennis' => array(
        'id' => 15321,
        'posts_this_time' => 0
    ),
    'horse racing' => array(
        'id' => 15319,
        'posts_this_time' => 0
    ),
    'soccer' => array(
        'id' => 14766,
        'posts_this_time' => 0
    ),
    'volleyball' => array(
        'id' => 15314,
        'posts_this_time' => 0
    ),
    'basketball' => array(
        'id' => 15316,
        'posts_this_time' => 0
    ),
    'darts' => array(
        'id' => 15314,
        'posts_this_time' => 0
    ),
    'ice hockey' => array(
        'id' => 15320,
        'posts_this_time' => 0
    ),
    'badminton' => array(
        'id' => 15314,
        'posts_this_time' => 0
    ),
    'handball' => array(
        'id' => 15318,
        'posts_this_time' => 0
    ),
    'rugby union' => array(
        'id' => 15314,
        'posts_this_time' => 0
    ),
    'bowls' => array(
        'id' => 15317,
        'posts_this_time' => 0
    )
);

foreach ($str_xml as $xml) {
    $total_loops++;

    /*	if ($total_loops > 200)
            break;*/

    // GET attributes() INTO SINGLE DIMENSION ARRAY
    $attrs = [];
    foreach ($xml->attributes() as $key => $value) {
        $attrs[$key] = (string)$value;
    }

    $game_category = strtolower($attrs['Classification']);

    /** Some hash to insert into database */
    $all_data_encoded = md5(implode(',', $attrs));

    global $wpdb;
    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
	WHERE meta_key = 'hash_code' AND  meta_value = '" . $all_data_encoded . "' LIMIT 1", ARRAY_A);
    if (count($results) > 0) {
        continue;
    }

    $teams_playing = explode(' vs ', str_replace(' v ', ' vs ', $attrs['EventName']));
    unset($attrs['EventName']);

    /*	$blocked_countries = explode('#', $attrs['BlockedCountryCodes']);*/

    $attrs['team_1'] = $teams_playing[0];
    $attrs['team_2'] = $teams_playing[1];

    $new_page_title = $attrs['team_1'] . ' v ' . $attrs['team_2'] .
        ': Online Live Streaming video [HD] ' . date("Y-m-d", strtotime($attrs['EventStart']));

    $url = sanitize_title($new_page_title);

    $new_page = array(
        'post_type' => 'post',
        'post_title' => $new_page_title,
        'post_author' => '18214',
        'post_content' => '',
        'post_status' => 'publish',
        'post_category' => array($live_stream_categories['main']['id'], $live_stream_categories[$game_category]['id']),
        'meta_input' => array(
            'hash_code' => $all_data_encoded,
            'attributes' => json_encode($attrs),
            '_wp_post_template' => 'single-livestream.php',
            '_yoast_wpseo_title' => $new_page_title,
            '_yoast_wpseo_metadesc' => 'Are ready to Watch ' . $attrs['team_1'] . ' vs ' . $attrs['team_2'] . ' - ' . $attrs['EventGroup'] .
                ' -  Live Streaming [HD] - Date & Time: ' . date("Y-m-d", strtotime($attrs['EventStart'])) .
                ', ' . date("H:i", strtotime($attrs['EventStart'])) . '.',
        )
    );

    $new_page_id = wp_insert_post($new_page, true);
    $live_stream_categories[$game_category]['posts_this_time'] += 1;
    $total_post_added++;
}

// RESET COUNTING TO WORK AGAIN
wp_defer_term_counting(false);
wp_defer_comment_counting(false);
$wpdb->query('COMMIT;');
$wpdb->query('SET autocommit = 1;');

if ($total_loops > 0) {
    $message = "<b>Total XML Entries:</b> $total_loops<br /><br/><b>Total NEW Entries:</b> $total_post_added<br /><br/> <b>By Categories:</b> <br/>";

    foreach ($live_stream_categories as $key => $value) {
        if ($key != 'main')
            $message .= "<b>$key</b>: {$value['posts_this_time']} <br/>";
    }

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $multiple_recipients = array(
        'k@codeja.net'
    );

    if ( !empty($_GET['email_to'])) {
        $multiple_recipients[] = $_GET['email_to'];
    }


    wp_mail($multiple_recipients, 'All the livestream pages that has been updated ' . date('d/M/Y'), $message, $headers);
}

get_footer();