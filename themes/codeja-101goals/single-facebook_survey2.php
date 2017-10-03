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
$left_image = get_field( 'cj_left_image', $post_id )['sizes']['large'];

$right_icon = get_post_meta( $post_id, 'cj_right_icon', true );
$right_image = get_field( 'cj_right_image', $post_id )['sizes']['large'];

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
            .tc { display: inline-block; position: absolute; left: 100%; top: 10%; min-width: 170px; line-height: 60px; background: <?php echo $title_border_color ?>; }
            .right .tc { left: auto; right: 100%; }
/*            .emoji {display: inline-block; width: 80px; height: auto; position: absolute; left: -10px; top: -10px; transform: translateY(-50%); }
            .right .emoji { left: auto; right: -10px; }*/
            .emoji { display: inline-block; width: 25px; }
            .counter {color: black; font-family: Lato; font-size: 39px; font-weight: 900; padding: 0 30px; }
            .float-left { display: inline-block; width: 30.5%; text-align: center;     margin: 50px auto; padding: 10px;}
            .thumb { width: 200px;    margin: 0 auto; height: 200px; position: relative; }
            .counter_and_emoji {
                border-radius: 5px;
                background-color: #eee;
                padding: 5px;
                margin-top: 10px;
                font-size: 22px;
                font-weight: bold;
            }
            .wrapper { display: block;
                margin: 0 auto;
                text-align: center;}
        </style>
    </head>
    <body>
    <header>
    </header>
<div class="wrapper">

    <?php
    $num_rows = count( get_field('cj_icons_loop') );
    if ( $num_rows <= 3 ) {
        echo '<style>.wrapper{     width: 100%; position: absolute; top: 50%; -webkit-transform: translate(0,-50%);-moz-transform: translate(0,-50%);-ms-transform: translate(0,-50%);-o-transform: translate(0,-50%);transform: translate(0,-50%);}</style>';
    } else if ( $num_rows == 4 ) {
        echo '<style>.float-left { width: 48% } </style>';
    }

    while ( have_rows('cj_icons_loop') ) : the_row();
    $emoji_name = get_sub_field('cj_emoji_loop');
    $emoji_icon = $icons[$emoji_name]['icon'];
    $emoji_class = $icons[$emoji_name]['class'];
    $image = get_sub_field('cj_image_loop')['sizes']['large'];


    ?>
        <div class="float-left">
            <div class="thumb">
                <div>
                    <img style="width: 200px; height: 200px;"  src="<?php echo $image ?>" alt="">
                    <div class="counter_and_emoji <?php echo $emoji_class ?>">
                        <img class="emoji" src="<?php echo IMAGES_FOLDER ?>/<?php echo $emoji_icon ?>">
                        <span class="counter"></span>
                    </div>
                </div>
            </div>
        </div>

        <?php
endwhile;
?>

</div>


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