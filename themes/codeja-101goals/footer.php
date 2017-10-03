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
 * Date of creation: 28-Sep-16 / 13:16
 * Last updated: 28-Sep-16 / 13:16 By Kirill Lavrishev
 *
 */

?>
<?php if ( !is_404() ) : ?>
	</div> <!-- #main -->
    <?php if ( ! is_post_type_archive('videosfeeds') && ! is_singular('videosfeeds')  ) {
        get_sidebar();
	} ?>
	</div> <!-- #row -->

	<?php the_banner_placement( 'UNDER_CONTENT_BANNER' ); ?>
<?php endif; ?>
</div> <!-- .container -->

<footer>
	<div class="footer-wrapper">
		<div class="container">
<!--			<div class="row">
				<div class="col-md-4">
					<div class="newsletter-text">
						<h1>Sign up for updates from   <span class="yellow">101 Great Goals</span></h1>
					</div>
				</div>
				<div class="col-md-offset-1 col-md-7">
					<div class="newsletter-form">
						<form method="get" action="#" id="main-website-newsletter">
							<input type="text" value="Type your email here..." name="newsletter-email" id="newsletter-input">
							<label for="newsletter-input">Get the very latest news and special offers from 101 Great Goals</label>
							<input type="submit" style="visibility: hidden">
						</form>
					</div>
				</div>
			</div>
-->		</div>
	</div>

	<div class="container only-mobile">
		<div class="row">
			<div class="footer-widgets-area clearfix col-md-5">
                <div class="row">
                    <div class="col-md-2 col-md-offset-1">
                        <div class="footer-logo">
                            <img src="<?php echo get_template_directory_uri()?>/images/footer_logo.png">
                        </div>
                        <div class="footer-social">
                            <span class="follow-us">Follow Us on</span>
                            <ul class="list-inline">
                                <li><a href="https://twitter.com/101greatgoals"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.facebook.com/101GreatGoalsCom/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/101greatgoals/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

                    </div>				<div class="col-md-2"><h2 class="widgettitle">101 Great Goals</h2>
                            <ul>
                                <li><a href="<?php the_permalink(2) ?>">About 101GG</a></li>
                                <li><a href="<?php the_permalink(633781) ?>">Advertising</a></li>
                                <li><a href="<?php the_permalink(43975) ?>">Contact us</a></li>
                                <li><a href="<?php the_permalink(70429) ?>">Privacy policy</a></li>
                                <li><a href="<?php the_permalink(82997) ?>">Terms of service</a></li>
                            </ul>

                    </div>				<div class="col-md-2"><h2 class="widgettitle">Community</h2>
                            <ul>
                                <li><a href="https://twitter.com/101greatgoals">Twitter</a></li>
                                <li><a href="https://www.facebook.com/101GreatGoalsCom/">Facebook</a></li>
                                <li><a href="https://www.youtube.com/user/101greatgoalsYT">YouTube</a></li>
                                <li><a href="https://www.instagram.com/101greatgoals/">Instagram</a></li>
                            </ul>

                    </div>				<div class="col-md-2"><h2 class="widgettitle">Sections</h2>
                            <ul>
                                <li><a href="<?php echo get_category_link(2) ?>">News</a></li>
                                <li><a href="<?php echo get_category_link(3) ?>">Goals</a></li>
                                <li><a href="<?php echo get_category_link(5339) ?>">Videos</a></li>
                                <li><a href="<?php echo get_category_link(16469) ?>">Live Streaming</a></li>
                                <li><a href="<?php echo get_category_link(1028) ?>">Betting</a></li>
                            </ul>

                    </div>
                </div>

				<div class="col-md-5">
					<h2 class="widgettitle"></h2>
					<div class="languages-picker">
						<ul><li><img src="http://www.flagsarenotlanguages.com/flags/thumbs/gb.png"> United Kingdom</li></ul>
					</div>
					<span class="copyrights">All Rights Reserved ©</span>
					<strong><a style="display: block; font-size: 12px; color: #bcbcbc;" href="https://kirill.rocks" target="_blank">Developed by Kirill Lavrishev</a></strong>

				</div>
			</div>
		</div>
	</div>
    <div class="container only-desktop">
        <div class="row">
            <div class="footer-widgets-area clearfix">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-4"><h2 class="widgettitle">101 Great Goals</h2>
                                <ul>
                                    <li><a href="<?php the_permalink(2) ?>">About 101GG</a></li>
                                    <li><a href="<?php the_permalink(633781) ?>">Advertising</a></li>
                                    <li><a href="<?php the_permalink(43975) ?>">Contact us</a></li>
                                    <li><a href="<?php the_permalink(70429) ?>">Privacy policy</a></li>
                                    <li><a href="<?php the_permalink(82997) ?>">Terms of service</a></li>
                                </ul>

                            </div>
                            <div class="col-md-4"><h2 class="widgettitle">Community</h2>
                                <ul>
                                    <li><a href="https://twitter.com/101greatgoals">Twitter</a></li>
                                    <li><a href="https://www.facebook.com/101GreatGoalsCom/">Facebook</a></li>
                                    <li><a href="https://www.youtube.com/user/101greatgoalsYT">YouTube</a></li>
                                    <li><a href="https://www.instagram.com/101greatgoals/">Instagram</a></li>
                                </ul>

                            </div>
                            <div class="col-md-4"><h2 class="widgettitle">Sections</h2>
                                <ul>
                                    <li><a href="<?php echo get_category_link(2) ?>">News</a></li>
                                    <li><a href="<?php echo get_category_link(3) ?>">Goals</a></li>
                                    <li><a href="<?php echo get_category_link(5339) ?>">Videos</a></li>
                                    <li><a href="<?php echo get_category_link(16469) ?>">Live Streaming</a></li>
                                    <li><a href="<?php echo get_category_link(1028) ?>">Betting</a></li>
                                </ul>

                            </div>
<!--                            <div class="col-md-12">
                                <div class="footer-logo">
                                    <img src="<?php /*echo get_template_directory_uri()*/?>/images/footer_logo.png">
                                </div>
                                <div class="footer-social">
                                    <span class="follow-us">Follow Us on</span>
                                    <ul class="list-inline">
                                        <li><a href="https://twitter.com/101greatgoals"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.facebook.com/101GreatGoalsCom/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="https://www.instagram.com/101greatgoals/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>

                            </div>
-->                        </div>
                    </div>
                    <div class="col-md-7 footer-text">
                        101 Great Goals is a global, football media news publisher devoted to producing content for a digital generation over web, social and mobile platforms. The 101 Great Goals website is constantly updated with football (soccer) news, video and social media updates by the hour. Every single day of the week.
                        We pride ourselves at 101 Great Goals on sourcing the greatest football video content on the world wide web as well as being up to date on all social media updates regarding major teams and players. You can also find on 101 Great Goals extensive transfer news both during the transfer windows as well as gossip and rumour throughout the year. We cover some of the biggest teams in the world, including Manchester United, Arsenal, Chelsea, Liverpool, Real Madrid, Barcelona and Tottenham.
                        101 Great Goals is also active on an hourly basis on social media, including Facebook, Instagram and Twitter.
                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <strong><a style="font-size: 12px; color: #bcbcbc;" href="https://kirill.rocks" target="_blank">Developed by Kirill Lavrishev</a></strong>
                <span class="copyrights">All Rights Reserved ©</span>
            </div>
        </div>
    </div>
</footer>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Squada+One" rel="stylesheet">
<?php wp_footer(); ?>

<!-- CJ_JS -->
<script>
    <?php include('bundlejs.php'); ?>
</script>

<?php if ( CODEJA_COUNTRY_CODE == 'US'  || IS_TEST && ! post_is_in_descendant_category( 16469 )  ) : ?>
<script type="text/javascript">
    window._ttf = window._ttf || [];
    _ttf.push({
        pid          : 58552
        ,lang        : "en"
        ,slot        : '#main .inside-post > p'
        ,format      : "inread"
        ,minSlot     : 3
        ,components  : { skip: {delay : 0}}
        ,css         : "margin: 0px auto 15px; max-width: 600px;"
    });

    (function (d) {
        var js, s = d.getElementsByTagName('script')[0];
        js = d.createElement('script');
        js.async = true; 
        js.src = '//cdn.teads.tv/media/format.js';
        s.parentNode.insertBefore(js, s);
    })(window.document);
</script>
<?php    endif; ?>

<?php if ( CODEJA_COUNTRY_CODE != 'US' && is_single() && ! post_is_in_descendant_category( 16469 ) && ! wp_is_mobile() ) : ?>
    <script type="text/javascript" id="aniviewJS">
        var windowWidth,
            divHeight,
            adConfig,
            myPlayer,
            aniviewBox,
            aniAnimation,
            newItem,
            videoAd,
            bigPlayImg,
            playerUrl;

        windowWidth = document.documentElement.clientWidth
            || document.body.clientWidth || screen.width;
        if(windowWidth>640){windowWidth=640};
        divHeight=Math.floor(windowWidth/1.777);

        adConfig = {
            publisherId 		: 	'584d730a28a0612d181d27d0',
            channelId			: 	'584d750f0b8ee8198d11aa56',
            width               :	windowWidth,
            height              :	divHeight,
            HD                  :	false,
            autoPlay            :	true,
            ref1			    : 	'',
            loop                :   true,
            soundButton     	: 	true,
            pauseButton     	: 	false,
            logo            	: 	false,
            closeButton     	: 	true,
            vastRetry 	        :	3,
            backgroundColor 	:	'#FEFEFE',
            position            :	'aniplayer'
        };
        aniviewBox =  document.getElementById("aniviewBox");
        aniviewBox.style.position = "absolute";
        aniviewBox.style.top = -divHeight+"px";
        aniviewBox.style.top = "-100000px";
        aniAnimation =  document.getElementById("aniAnimation");
        aniAnimation.style.height = "12px";
        newItem = document.createElement("div");
        newItem.id = 'aniAnimation_close';
        aniAnimation.appendChild(newItem);

        PlayerUrl = 'http://cdn.aniview.com/script/6/aniview.js';
        function downloadScript(src,adData) {
            var scp = document.createElement('script');
            scp.src = src;
            scp.onload = function() {
                var _$_de83 = ["frameElement", "Ad on 3rd party iFrame", "log", "window", "parent", "aniAnimation", "getElementById", "min", "max", "style", "createElement", "innerHTML", ".aniAnimationOpen{height:0;width:", "px;overflow:hidden;background:black;-moz-animation:slide 1s ease 0.5s forwards;-webkit-animation:slide 1s ease 0.5s forwards;-o-animation:slide 1s ease 0.5s forwards;-ms-animation:slide 1s ease 0.5s forwards;animation:slide 1s ease 0.5s forwards}@-moz-keyframes slide{from{height:0}to{height:", "px}}@-webkit-keyframes slide{from{height:0}to{height:", "px}}@-o-keyframes slide{from{background:black}to{background:black}}@-ms-keyframes slide{from{height:0}to{height:", "px}}@keyframes slide{from{height:0}to{height:", "px}}", ".aniAnimationClose{height:", "px;width:", "px;overflow:hidden;background:black;-moz-animation:slide2 1s ease 0.5s forwards;-webkit-animation:slide2 1s ease 0.5s forwards;-o-animation:slide2 1s ease 0.5s forwards;-ms-animation:slide2 1s ease 0.5s forwards;animation:slide2 1s ease 0.5s forwards}@-moz-keyframes slide2{from{height:", "px}to{height:0}}@-webkit-keyframes slide2{from{height:", "px}to{height:0}}@-o-keyframes slide2{from{background:black}to{background:black}}@-ms-keyframes slide2{from{height:", "px}to{height:0}}@keyframes slide2{from{height:", "px}to{height:0}}", "appendChild", "head", "getElementsByTagName", "position", "relative", "top", "0px", "resume", "getBoundingClientRect", "documentElement", "document", "pageYOffset", "clientTop", "left", "pageXOffset", "clientLeft", "offsetWidth", "offsetHeight", "innerWidth", "innerHeight", "scroll", "addEventListener", "resize", "removeEventListener"];
                var frame, isIframe, el, wnd, fraction, rect, docEl, rectTop, rectLeft, h, r, b, w, y, x, visibleX, visibleY, visible, that, evObj;
                myPlayer= new avPlayer(adData);
                var playerPlay = false;
                var playerInView = true;
                function showPlayer(){
                    s = document[_$_de83[10]](_$_de83[9]);
                    s[_$_de83[11]] = _$_de83[12] + windowWidth + _$_de83[13] + divHeight + _$_de83[14] + divHeight + _$_de83[15] + divHeight + _$_de83[16] + divHeight + _$_de83[17];
                    s[_$_de83[11]] = s[_$_de83[11]] + _$_de83[18] + divHeight + _$_de83[19] + windowWidth + _$_de83[20] + divHeight + _$_de83[21] + divHeight + _$_de83[22] + divHeight + _$_de83[23] + divHeight + _$_de83[24];
                    document[_$_de83[27]](_$_de83[26])[0][_$_de83[25]](s);
                    aniviewBox[_$_de83[9]][_$_de83[28]] = _$_de83[29];
                    aniviewBox[_$_de83[9]][_$_de83[30]] = _$_de83[31];
                }
                function hidePlayer() {
                    if(playerPlay) {
                        playerPlay=false;
                        aniAnimation.style.height = divHeight+"px";
                        aniAnimation.setAttribute("class", "aniAnimationClose");
                    }
                }
                myPlayer.onPlay    = function() {
                    playerPlay = true;
                    aniAnimation.style.top="";
                    aniAnimation.style.position="";
                    if(playerInView)
                        showPlayer();
                    else
                        setTimeout(function(){myPlayer.pause()},5);
                };
                myPlayer.onClose    = function(type) {hidePlayer();};
                myPlayer.onPlay100  = function(type) {hidePlayer();};
                myPlayer.onError    = function(type) {hidePlayer();};
                myPlayer.play();
            };
            document.getElementsByTagName('head')[0].appendChild(scp);
        };
        downloadScript(PlayerUrl,adConfig);
    </script>
<?php endif; ?>

<?php if ( ! post_is_in_descendant_category( array( 16469, 1028 ) ) || is_singular( CJBL::$post_type ) || is_post_type_archive( CJBL::$post_type ) ) : ?>

<div id='div-gpt-ad-1485090039185-11'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485090039185-11'); });
    </script>
</div>            <div id='div-gpt-ad-1485090039185-12'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485090039185-12'); });
    </script>
</div> <div id='div-gpt-ad-1485090039185-13'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485090039185-13'); });
    </script>
</div>
<div id='div-gpt-ad-1485090039185-14'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485090039185-14'); });
    </script>
</div><div id='div-gpt-ad-1485090039185-15'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485090039185-15'); });
    </script>
</div>
<div id='div-gpt-ad-1485086466413-0'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1485086466413-0'); });
    </script>
</div>
<?php endif; ?>
</body>
</html>