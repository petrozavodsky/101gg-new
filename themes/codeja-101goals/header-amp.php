<?php
/**
 * File header-amp.php created by:
 * CODJA.net - Turning imagination into creation
 *
 * Team Member: Evgeniy Z
 *
 * File Details:
 * Date of creation: 28.09.2017 / 19:42
 * Last updated: 28.09.2017 / 19:42 by Evgeniy Z
 */

?>
<!DOCTYPE html>
<html amp <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<script async src="https://cdn.ampproject.org/v0.js"></script>
	<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
	<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
	<title><?php wp_title(); ?></title>
	<?php wp_meta(); ?>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=medium">
	<meta property="fb:app_id" content="345296042591084">
	<meta property="fb:admins" content="KirillLavrishev120"/>
	<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri() . '/images/fav.png'; ?>"/>
	<link rel="canonical" href="<?php echo wp_get_canonical_url( get_the_ID() ); ?>">

	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

	<style amp-custom>
		/* Global Styling */
		body {
			background: #f1f1f1;
			font: 15px/1.4 Sans-serif;
		}

		a {
			color: #312C7E;
			text-decoration: none
		}

		/* Header */
		#header {
			background: #232732;
			text-align: center;
		}

		#header h1 {
			text-align: center;
			font-size: 20px;
			font-weight: bold;
			line-height: 1;
			padding: 15px;
			margin: 0;
		}

		.amp-logo {
			margin: 15px 0 10px 0;
		}

		/* Footer */
		#footer {
			background: #fff;
			font-size: 13px;
			text-align: center;
			letter-spacing: 0.2px;
			padding: 20px 0;
		}

		#footer p:first-child {
			margin-bottom: 12px;
		}

		#footer p {
			margin: 0
		}

		.amp-codja-bc {
			font-size: 12px;
			font-weight: 700;
			padding: 10px 15% 0 15%;
		}

		.amp-codja-bc a {
			color: #555;
		}

		.amp-codja-container {
			-moz-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
			-webkit-box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
			background: #fefefe;
			box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
			margin: 15px 15% 15px 15%;
			padding: 15px;
		}

		.cjbl_single_below_content-hook a.cjbl-watch-button {
			align-items: center;
			background-color: #f8c014;
			border-radius: 4px;
			color: #000;
			display: flex;
			font-size: 15px;
			font-weight: 700;
			justify-content: center;
			padding: 12px;
		}

		a.cjbl-watch-button {
			align-items: center;
			background-color: #f8c014;
			border-radius: 4px;
			color: #000;
			display: flex;
			font-size: 15px;
			font-weight: 700;
			justify-content: center;
			padding: 12px;
		}

		.codeja-smart-widget {
			background: #232732;
			margin: 20px 0;
			padding: 15px 10px 1px;
		}

		.codeja-smart-widget a {
			color: #fff;
		}

		.widgettitle {
			color: #f8c014;
			font-size: 16px;
			margin: 0 0 15px;
			text-align: center;
			text-transform: uppercase;
		}

		.widgettitle a {
			color: #f8c014;
			font-size: 16px;
			margin: 0 0 15px;
			text-align: center;
			text-transform: uppercase;
		}

		.list-unstyled {
			padding-left: 0;
			list-style: none;
		}

		.cjbl_single_below_content-hook a {
			color: #5cb85c;
			font-size: 18px;
		}

		/* Slide Navigation code */
		.nav_container {
			padding: 18px 15px;
			background: #232732;
			color: #fff;
			text-align: center
		}

		.amp-sidebar-image {
			line-height: 100px;
			vertical-align: middle;
		}

		.amp-close-image {
			top: 15px;
			left: 225px;
			cursor: pointer;
		}

		.toggle-navigationv2 ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		.toggle-navigationv2 ul ul li a {
			padding-left: 35px;
			background: #fff;
			display: inline-block
		}

		.toggle-navigationv2 ul li a {
			padding: 15px 25px;
			width: 100%;
			display: inline-block;
			background: #fafafa;
			font-size: 14px;
			border-bottom: 1px solid #efefef;
		}

		.close-nav {
			font-size: 12px;
			background: rgba(0, 0, 0, 0.25);
			letter-spacing: 1px;
			display: inline-block;
			padding: 10px;
			border-radius: 100px;
			line-height: 8px;
			margin: 14px;
			left: 191px;
			color: #fff;
		}

		.close-nav:hover {
			background: rgba(0, 0, 0, 0.45);
		}

		.toggle-navigation ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			display: inline-block;
			width: 100%
		}

		.menu-all-pages-container:after {
			content: "";
			clear: both
		}

		.toggle-navigation ul li {
			font-size: 13px;
			border-bottom: 1px solid rgba(0, 0, 0, 0.11);
			padding: 11px 0px;
			width: 25%;
			float: left;
			text-align: center;
			margin-top: 6px
		}

		.toggle-navigation ul ul {
			display: none
		}

		.toggle-navigation ul li a {
			color: #eee;
			padding: 15px;
		}

		.toggle-navigation {
			display: none;
			background: #444;
		}

		.toggle-text {
			color: #fff;
			font-size: 12px;
			text-transform: uppercase;
			letter-spacing: 3px;
			display: inherit;
			text-align: center;
		}

		.toggle-text:before {
			content: "...";
			font-size: 32px;
			position:;
			font-family: georgia;
			line-height: 0px;
			margin-left: 0px;
			letter-spacing: 1px;
			top: -3px;
			position: relative;
			padding-right: 10px;
		}

		.nav_container:hover + .toggle-navigation,
		.toggle-navigation:hover,
		.toggle-navigation:active,
		.toggle-navigation:focus {
			display: inline-block;
			width: 100%;
		}

		.amp-cj-widget-link {
			align-items: center;
			display: flex;
		}

		.codeja-smart-widget.numbers .thumb-placeholder {
			align-items: center;
			background-color: #232732;
			display: flex;
			height: 76px;
			justify-content: center;
			min-width: 76px;
		}

		.codeja-smart-widget.numbers .thumb-placeholder .number {
			font-size: 42px;
		}

		.codeja-smart-widget .title-placeholder {
			display: flex;
			margin-left: 15px;
		}

		.codeja-smart-widget li {
			padding: 10px;
			border: 1px solid #414652;
			background-color: #30343f;
			position: relative;
		}

		.codeja-smart-widget .title-placeholder .title {
			line-height: 18px;
		}

		li.clearfix {
			clear: both;
		}

		.amp-codjabl-tv {
			background-color: #0b3cc7;
			color: #fff;
			margin-left: -15px;
			margin-right: -15px;
			margin-top: -15px;
		}

		.cjbl-event-header {
			text-align: center;
			padding: 25px;
		}

		.cjbl-event-header h1 {
			font-size: 35px;
			font-weight: 700;
			margin-top: 0;
		}

		p.cjbl-under-category-text {
			font-size: 16px;
			margin: 20px 0;
		}

		.cjbl-tv-inside .cjbl-watch-button {
			margin: 0 25px 25px;
		}

		.cjbl-stream-meta {
			background-color: #01218e;
			padding: 25px;
		}

		.cjbl-stream-meta ul {
			margin: 0;
			padding: 0;
		}

		.cjbl-stream-meta li {
			display: block;
			border-right: 0;
			border-bottom: 1px solid #0030ca;
			padding: 25px 0;
		}

		.cjbl-stream-meta li:last-child {
			border-bottom: 0;
		}

		.cjbl-meta-content {
			padding: 0;
			margin: 0;
		}

		amp-sidebar {
			width: 250px;
		}
		.amp-sidebar-image {
			line-height: 100px;
			vertical-align:middle;
		}
		.amp-close-image {
			top: 15px;
			left: 225px;
			cursor: pointer;
		}

		@media screen and (max-width: 767px) {
			.amp-codja-container {
				margin: 15px 10px 15px 10px;
			}
		}
	</style>
</head>

<body <?php body_class(); ?>>

<header class="container">
	<div id="headerwrap">
		<div id="header">
			<a href="<?php echo home_url( '/' ) . '?is_amp'; ?>" class="desktop-logo">
				<amp-img src="<?php echo get_template_directory_uri() . '/images/desktop_logo.png'; ?>" width="144" height="42" alt="logo" class="amp-logo"></amp-img>
			</a>
		</div>
	</div>
</header>

<div on='tap:nav-sidebar.toggle' role="button" tabindex="0" class="nav_container">
	<a href="#" class="toggle-text">Navigate</a>
</div>

<amp-sidebar id="nav-sidebar" layout="nodisplay" side="right">
	<div class="toggle-navigationv2">
		<div role="button" tabindex="0" on='tap:nav-sidebar.close' class="close-nav">X</div>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'main-menu',
			'container'      => false,
		) );
		?>
	</div>
</amp-sidebar>

<!--<section class="amp-codja-bc">-->
<!--	--><?php //yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
<!--</section>-->





