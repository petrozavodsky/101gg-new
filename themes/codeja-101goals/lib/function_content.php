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
 * Date of creation: 30-Nov-16 / 11:58
 * Last updated: 30-Nov-16 / 11:58 By Kirill Lavrishev
 *
 */

// Insert ads after second paragraph of single post content.
function codeja_insert_post_ads( $content ) {
    if ( is_single() && !in_category( '365-bets' ) && ! is_amp() ) {
        // FIRST BANNER IN POST
        if ( CODEJA_COUNTRY_CODE != 'US' || IS_TEST ) :
            $include = get_banner_placement('SINGLE_POST_AFTER_FIRST_P' );
            $tag     = '</p>';
            $row     = 1;
            $before  = false;
            $content = codeja_adjust_the_content( $include, $tag, $row, $content, $before );
        endif;

        $include = get_banner_placement('FIRST_INSIDE_POST' );
        $tag     = '</p>';
        $row     = 5;
        $before  = false;
        $content = codeja_adjust_the_content( $include, $tag, $row, $content, $before );

        // SECOND BANNER IN POST
        $include = get_banner_placement( 'SECOND_INSIDE_POST' ) . get_banner_placement( 'SECOND_INSIDE_POST_MOBILE' );
        $tag     = '</p>';
        $row     = 10;
        $before  = false;
        $content = codeja_adjust_the_content( $include, $tag, $row, $content, $before );
    }

    if ( is_amp() ) {
        $include = '';
        $tag     = '</p>';
        $row     = 5;
        $before  = false;
        $content = codeja_adjust_the_content( $include, $tag, $row, $content, $before );
    }

	return $content;
}
add_filter( 'the_content', 'codeja_insert_post_ads' );


function codeja_div_wrapper_before_iframe( $content ) {
   if ( is_single() ) {
		$include = '<div class="iframe-wrapper">';
		$tag     = '<iframe';
		$row     = 1; // HERE IT IS UNUSABLE, USING $i INSTEAD
		$before  = true;

		$count_the_time_it_repeats = substr_count( $content , $tag );

		// LOOP FOR ALL THE $TAGS(IFRAMES) IN PAGE
		for ($i = 0; $i < $count_the_time_it_repeats; $i++ ) {
			$content = codeja_adjust_the_content( $include, $tag, $i + 1, $content, $before );
		}

	}
	return $content;
}
add_filter( 'the_content', 'codeja_div_wrapper_before_iframe' );

function codeja_div_wrapper_after_iframe( $content ) {
	if ( is_single() ) {
		$include = '</div>';
		$tag     = '</iframe>';
		$row     = 1; // HERE IT IS UNUSABLE, USING $i INSTEAD
		$before  = false;

		$count_the_time_it_repeats = substr_count( $content , $tag );

		// LOOP FOR ALL THE $TAGS(IFRAMES) IN PAGE
		for ($i = 0; $i < $count_the_time_it_repeats; $i++ ) {
			$content = codeja_adjust_the_content( $include, $tag, $i + 1, $content, $before );
		}

	}
	return $content;
}
add_filter( 'the_content', 'codeja_div_wrapper_after_iframe' );
 
// Function to inject adverts into post
function codeja_adjust_the_content( $what_to_add, $tag_to_use, $row_to_use, $the_content, $before = false ) {

	if ( !preg_match('/<(.*?)>/', $tag_to_use ) ) {
		$closting_tag = false;
	} elseif ( !preg_match('/<\/(.*?)>/', $tag_to_use ) ) {
		$closting_tag = true;
	}

	$exploded_content = explode($tag_to_use, $the_content);

	$new_content = '';

	if ( $before == true ) {
		foreach ( $exploded_content as $key => $value ) {
			if ( $key == 0) {
				$new_content .= $value;
				continue;
			}

			if ( $key == $row_to_use ) {
				$new_content .= $what_to_add;
			}

			$new_content .= $tag_to_use . $value;
		}
	} else {
		foreach ( $exploded_content as $key => $value ) {
			if ( $key == 0) {
				$new_content .= $value;
				continue;
			}

			if ( $key != $row_to_use ) {
				$new_content .= $tag_to_use . $value;
			} else {
				$new_content .= $tag_to_use . $what_to_add . $value;
			}
		}
	}

	return $new_content;
}

function include_outside_file( $file ) {
	ob_start();
	require( $file );
	return ob_get_clean();
}

function amp_twitter( $content ) {
    if ( is_amp_endpoint() ) {
        $content = preg_replace("'<blockquote class=\"twitter-tweet\"(.*?)https://twitter.com/(.*?)/status/(.*?)\">(.*?)</blockquote>'si", '<amp-twitter width=486 height=657
                     layout="responsive"
                     data-tweetid="\\3" data-cards="hidden"></amp-twitter>', $content);

        $content = preg_replace("'<blockquote class=\"twitter-video\"(.*?)https://twitter.com/(.*?)/status/(.*?)\">(.*?)</blockquote>'si", '<amp-twitter width=486 height=657
                     layout="responsive"
                     data-tweetid="\\3" data-cards="hidden"></amp-twitter>', $content);

    }

    return $content;
}
add_filter('the_content', 'amp_twitter');

/*function amp_youtube( $content ) {
    if ( is_amp_endpoint() ) {
        $content = preg_replace("'<blockquote class=\"twitter-tweet\"(.*?)https://twitter.com/(.*?)/status/(.*?)\">(.*?)</blockquote>'si", '<amp-twitter width=486 height=657
                     layout="responsive"
                     data-tweetid="\\3" data-cards="hidden"></amp-twitter>', $content);
    }

    return $content;
}
add_filter('the_content', 'amp_youtube');*/

function cj_amp_instagram( $content ) {
    $replace = '<amp-instagram
    data-shortcode="fBwFP"
    width="400"
    height="400"
    layout="responsive">
</amp-instagram>';
    if ( is_amp_endpoint() ) {
        $content = preg_replace("'<blockquote class=\"instagram-media\"(.*?)https://www.instagram.com/p/(.*?)/(.*?)</blockquote>'si", '<amp-instagram
    data-shortcode="\\2"
    width="400"
    height="400"
    layout="responsive">
</amp-instagram>', $content);
    }

    return $content;
}
add_filter('the_content', 'cj_amp_instagram', 1);