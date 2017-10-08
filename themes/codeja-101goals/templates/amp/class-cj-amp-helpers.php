<?php
class CJ_Amp_Helpers {
	public static function convert( $tag ) {
		if ( strpos( $tag, 'youtu' ) ) {
			preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $tag, $match );
			echo '<amp-youtube data-videoid="' . $match[1] . '" layout="responsive" width="480" height="270"></amp-youtube>';
		} elseif ( strpos( $tag, 'twitter' ) ) {
			preg_match( '#https?://twitter\.com/(?:\#!/)?(\w+)/status(es)?/(\d+)#is',$tag, $match );
			echo '<amp-twitter width="375" height="472" layout="responsive" data-tweetid="' . end( $match ) . '"></amp-twitter>';
		} elseif ( strpos( $tag, 'instagram' ) ) {
			preg_match( '#https?://www\.instagram\.com/p/(\w+)#is',$tag, $match );
			echo '<amp-instagram data-shortcode="' . end( $match ) . '" data-captioned width="480" height="270" layout="responsive"></amp-instagram>';
		} elseif ( strpos( $tag, 'facebook' ) ) {
			preg_match( '/href=([^&]+)/', $tag, $match );
			echo '<amp-facebook width="476" height="316" layout="responsive" data-embed-as="video" data-href="' . urldecode( end( $match ) ) . '"></amp-facebook>';
		} elseif ( strpos( $tag, 'streamable' ) ) {
			preg_match( '/src="([^"]+)/', $tag, $match );
			echo '<amp-iframe width="480" height="270" sandbox="allow-scripts allow-same-origin" layout="responsive" frameborder="0" src="' . end( $match ) . '"><amp-img layout="fill" src="https://i.vimeocdn.com/video/499134794_1280x720.jpg" placeholder></amp-img></amp-iframe>';
		}
	}
}
