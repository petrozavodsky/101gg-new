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
 * Date of creation: 28-Sep-16 / 13:12
 * Last updated: 28-Sep-16 / 13:12 By Kirill Lavrishev
 *
 */

if ( have_rows('cj_icons_loop') ){
    include (TEMPLATEPATH . '/single-facebook_survey2.php');
    exit;
}
get_header('no-header'); ?>
<?php
$post_id = get_queried_object_id();

$title = get_the_title( $post_id );
$facebook_post_id = get_post_meta( $post_id, 'cj_facebook_post_id', true );
$base_font_size = get_post_meta( $post_id, 'cj_title_size', true );

// IF NO PX IN FONT SIZE
if ( strpos( 'px', $base_font_size ) === false ) {
    $base_font_size .= 'px';
}

$title_border_color = get_post_meta( $post_id, 'cj_title_border_color', true );

$left_icon = get_post_meta( $post_id, 'cj_left_icon', true );
$left_icon2 = get_post_meta( $post_id, 'cj_left_icon_2', true );
$left_image = get_field( 'cj_left_image', $post_id )['sizes']['large'];
$left_image2 = get_field( 'cj_left_image_2', $post_id )['sizes']['large'];

$right_icon = get_post_meta( $post_id, 'cj_right_icon', true );
$right_icon2 = get_post_meta( $post_id, 'cj_right_icon_2', true );
$right_image = get_field( 'cj_right_image', $post_id )['sizes']['large'];
$right_image2 = get_field( 'cj_right_image_2', $post_id )['sizes']['large'];

$icons = array(
    'happy' => array (
        'icon' => 'haha.png',
        'class' => 'fml'
    ),
    'like' => array (
        'icon' => 'like.png',
        'class' => 'likes',
    ),
    'heart' => array (
        'icon' => 'love.png',
        'class' => 'happy',
    ),
    'cry' => array (
        'icon' => 'sad.png',
        'class' => 'sad',
    ),
    'angry' => array (
        'icon' => 'angry.png',
        'class' => 'angry',
    ),
    'wow' => array (
        'icon' => 'shock.png',
        'class' => 'shock',
    ),
);


$selected_left_icon = $icons[$left_icon];
$selected_left_icon2 = $icons[$left_icon2];
$selected_right_icon = $icons[$right_icon];
$selected_right_icon2 = $icons[$right_icon2];

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Facebook Reactions - SocialWall.me</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet">
        <style>
            body { font-family: 'Lato', sans-serif; }
            footer { height: 140px; background: rgba(0, 0, 0, 0.6); position: fixed; left: 0; bottom: 0; width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; box-sizing: border-box;}
            .question { color: <?php echo $title_border_color ?>; font-size: 35px; font-weight: 900; text-transform: uppercase; padding: 45px 30px 30px; text-align: center;}
            .competitor {transform: translateY(-19%); position: relative; border: 8px solid <?php echo $title_border_color ?>; border-radius: 5px; }
            .tc { display: inline-block; position: absolute; left: 100%; top: 10%; min-width: 250px; line-height: 60px; background: <?php echo $title_border_color ?>; }
            .right .tc { left: auto; right: 100%; }
            .emoji {display: inline-block; width: 80px; height: auto; position: absolute; left: -10px; top: 50%; transform: translateY(-50%); }
            .right .emoji { left: auto; right: -10px; }
            .counter {float: right; color: black; font-family: Lato; font-size: 39px; font-weight: 900; padding: 0 5px; }
            .right .counter { float: left; }
            .competitor.top { position: absolute; top: 60px; }
            header .left {
                left: 30px;
                right: auto;
            }

            header .right {
                right: 30px;
                left: auto;
            }
        </style>
    </head>
    <body>
    <header>
        <?php if ( get_field('cj_left_image_2') ) : ?>
            <div class="competitor left top">
                <img style="width: 170px; height: 170px;"  src="<?php echo $left_image2 ?>" alt="">
                <div class="tc wf <?php echo $selected_left_icon2['class'] ?>">
                    <img class="emoji" src="<?php echo IMAGES_FOLDER ?>/<?php echo $selected_left_icon2['icon'] ?>">
                    <span class="counter"></span>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( get_field('cj_right_image_2') ) : ?>
            <div class="competitor right top">
                <img style="width: 170px; height: 170px;"  src="<?php echo $right_image2 ?>" alt="">
                <div class="tc wf <?php echo $selected_right_icon2['class'] ?>">
                    <img class="emoji" src="<?php echo IMAGES_FOLDER ?>/<?php echo $selected_right_icon2['icon'] ?>">
                    <span class="counter"></span>
                </div>
            </div>
        <?php endif; ?>
    </header>





    <footer>
        <div class="competitor left">
            <img style="width: 170px; height: 170px;"  src="<?php echo $left_image ?>" alt="">
            <div class="tc wf <?php echo $selected_left_icon['class'] ?>">
                <img class="emoji" src="<?php echo IMAGES_FOLDER ?>/<?php echo $selected_left_icon['icon'] ?>">
                <span class="counter"></span>
            </div>
        </div>



        <div class="question"><?php echo $title ?></div>

        <div class="competitor right">
            <img style="width: 170px; height: 170px;"  src="<?php echo $right_image ?>" alt="">
            <div class="tc wf <?php echo $selected_right_icon['class'] ?>">
                <img class="emoji" src="<?php echo IMAGES_FOLDER ?>/<?php echo $selected_right_icon['icon'] ?>">
                <span class="counter"></span>
            </div>
        </div>

    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo JS_FOLDER ?>/lodash.min.js"></script>

    <script>
        "use strict";
        var access_token = '1256681621080635|jj8FK_60bKNctvKMaUXIAtJS-Gc'; // PASTE HERE YOUR FACEBOOK ACCESS TOKEN
        var postID = '<?php echo $facebook_post_id ?>'; // PASTE HERE YOUR POST ID
        var refreshTime = 5; // Refresh time in seconds
        var defaultCount = 0; // Default count to start with

        var reactions = ['LIKE', 'LOVE', 'WOW', 'HAHA', 'SAD', 'ANGRY'].map(function (e) {
            var code = 'reactions_' + e.toLowerCase();
            return 'reactions.type(' + e + ').limit(0).summary(total_count).as(' + code + ')'
        }).join(',');

        var	v1 = $('.likes .counter'),
            v2 = $('.happy .counter'),
            v3 = $('.sad .counter'),
            v4 = $('.fml .counter'),
            v5 = $('.angry .counter'),
            v6 = $('.shock .counter');

        function refreshCounts() {
            $('.counter').css('width', '200px !important');

            var url = 'https://graph.facebook.com/v2.8/?ids=' + postID + '&fields=' + reactions + '&access_token=' + access_token;
            $.getJSON(url, function(res){
                v1.text(defaultCount + res[postID].reactions_like.summary.total_count);
                v2.text(defaultCount + res[postID].reactions_love.summary.total_count);
                v3.text(defaultCount + res[postID].reactions_sad.summary.total_count);
                v4.text(defaultCount + res[postID].reactions_haha.summary.total_count);
                v5.text(defaultCount + res[postID].reactions_angry.summary.total_count);
                v6.text(defaultCount + res[postID].reactions_wow.summary.total_count);
            });
        }

        $(document).ready(function(){
            setInterval(refreshCounts, refreshTime * 1000);
            refreshCounts();

        });
    </script>
    </body>
    </html>
<?php
get_footer('no-footer');