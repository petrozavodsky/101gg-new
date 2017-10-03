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

get_header(); ?>
<div class="inside-post">
<?php
if (have_posts()) :
	while (have_posts()) : ?>
		<header class="first-title-on-page">
			<h1><?php the_title(); ?></h1>
		</header>
        <div id="header-social" class="only-desktop">
            <?php include ('templates/global/social.php'); // social share ?>
        </div>
<?php
		the_post();

		$attrs = json_decode( get_post_meta($post->ID, 'attributes', true), 'ARRAY' );

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

		if ( !get_the_content() ) {
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
		
			echo $new_page_content;
		  } else {
			the_content();
		}
		endwhile;
	endif; ?>
</div> <?php
get_footer();