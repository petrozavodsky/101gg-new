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
 * Date of creation: 25-Oct-16 / 22:00
 * Last updated: 25-Oct-16 / 22:00 By Kirill Lavrishev
 *
 */

get_header(); ?>
	<header class="first-title-on-page">
        <form method="get" action="<?php echo home_url('/') ?>" id="search-form">
            <input type="text" value="<?php echo $_GET['s']; ?>" name="s" class="search-input" placeholder="Search" />
            <input type="submit" value="Search" />
        </form>

</header>
<div class="search-results">
	<?php
if (have_posts() && !empty($_GET['s'])) :
    ?><h1> Showing results for <?php echo $_GET['s']; ?></h1><?php
	while (have_posts()) :
		the_post();


?>
	<div class="search-post">
		<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
		<div class="meta_data">
			<span>posted on: <?php the_date()?> by <?php the_author() ?></span>
		</div>
        <?php if ( post_is_in_descendant_category(16469) && ! get_the_content() ) : ?>
            <?php $attrs = json_decode( get_post_meta($post->ID, 'attributes', true), 'ARRAY' );

            $team1 = $attrs['team_1'];
            $team2 = $attrs['team_2'];
            $EventGroup = $attrs['EventGroup'];
            $EventStart =  $attrs['EventStart'];
            $blocked_countries = explode('#', $attrs['BlockedCountryCodes']);
            $event = get_data_for_league($EventGroup);

            // DIFF LINKS FOR MOBILE AND DESKTOP
            if ( wp_is_mobile() ) :
                $bet365_link = 'http://extra.bet365.com/promotions/mobile-and-tablet/mobile-sports-live-streaming/?affiliate=365_375720';
            else :
                $bet365_link = 'http://www.bet365.com/extra/en/streaming/live-sport/?affiliate=365_375720';
            endif;

            $new_page_content = "<a href='$bet365_link' target='_blank' rel='nofollow'><img src='{$event['img']}'></a>
			<h2>$team1 vs $team2 live stream</h2>
			<p><a href='$bet365_link' target='_blank' rel='nofollow'><b>$team1 v $team2: Watch a Live Stream here.</b></a></p>
			<p>Bet365 are showing $team1 v $team2 live, legal and straight onto your computer via 101 Great Goals.</p>
			<p><a href='$bet365_link' rel='nofollow' ><b>Simply click on this link and follow the simple step-by-step instructions to watch $team1 v $team2.</b></a></p>
			{$event['allowed']}
			<p>NOTE: Please be aware that you will need an active Bet365 account to watch $team1 v $team2.</p>
			<h2>$team1 vs $team2 match information</h2>
			<p>Match: $team1 v $team2</p>
			<p>Competition: " . $EventGroup . "</p>
			<p>Date: " . date('Y-m-d', strtotime($EventStart) +
                        3600) . "</p>
			<p>Kickoff time: " . date("H:i", strtotime($EventStart) +
                        3600) . "</p>
			<p><a href='$bet365_link' target='_blank' rel='nofollow'><b>$team1 v $team2: Watch a Live Stream here.</b></a></p>";

                echo substr($new_page_content, 0, 160);
             ?>
        <?php else : ?>
            <p><?php the_excerpt() ?></p>
        <?php endif; ?>

    </div>
	<?php endwhile;
endif;?>
	</div>
<?php
get_footer();