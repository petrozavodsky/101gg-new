<?php
// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_DISPLAY', true );
// @ini_set( 'display_errors', 'On' );
// @error_reporting('E_ALL');

/**
 * Created by PhpStorm.
 * User: KirillROCKS
 * Date: 28-Sep-16
 * Time: 11:58
 */

/** enqueue styles */
// INIT
// INIT
define('BANNER_NUMBER', 1);
define('TEMPLATE_URI', get_template_directory_uri() );
define('IMAGES_FOLDER', get_template_directory_uri() . '/images' );
define('JS_FOLDER', get_template_directory_uri() . '/js' );

function get_all_dfp_banners() {
	$dfp_banners = array();

	if ( have_rows( 'codeja_dfp_banners', 'option' ) ) {
		while ( have_rows( 'codeja_dfp_banners', 'option' ) ) {
			the_row();
			$id = get_sub_field( 'codeja_banner_unique_id' );
			$dfp_banners[$id] = array(
				'id'        => $id,
				'code'      => get_sub_field( 'codeja_inside_banner' ),
				'is_dfp'    => get_sub_field( 'is_dfp_code' ),
				'screen'    => get_sub_field( 'codeja_desktop_or_mobile' ),
				'remove_style'    => get_sub_field( 'codeja_remove_all_styles' ),
				'is_float'  => get_sub_field( 'codeja_is_float' ),
			) ;
		}
	}

	$GLOBALS['DFP_BANNERS'] = $dfp_banners;

	return null;
}


get_all_dfp_banners();


add_action('wp_enqueue_scripts', 'codeja_enqueue_styles');
function codeja_enqueue_styles() {
	/*	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3' );*/
	/*	wp_enqueue_style( 'keyframes', get_template_directory_uri() . '/css/keyframes.css', array(), '1' );*/

	// style.css
	/*	wp_enqueue_style( 'default style', get_template_directory_uri() . '/style.min.css', array(), '3' );*/
}

/** enqueue scripts */
add_action('wp_enqueue_scripts', 'codeja_enqueue_scripts');
function codeja_enqueue_scripts() {
	wp_deregister_script( 'jquery' );

	wp_enqueue_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	/*	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3', true );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'), '3.0.1', true );
		wp_enqueue_script( 'packery-isotope', get_template_directory_uri() . '/js/packery.min.js', array('jquery'), '3.0.1', true );*/
	/*	wp_enqueue_script( 'codeja-js', get_template_directory_uri() . '/main.min.js', array('jquery', 'bootstrap'), '1', true );*/

	/*wp_localize_script( 'codeja-js', 'ajax',
		array( 'url' => admin_url( 'admin-ajax.php' ) ) );*/
}


/*/** Register Sidebars */
add_action('widgets_init', 'codeja_register_sidebars');
function codeja_register_sidebars() {
	$args = array(
		'Default Sidebar' => array(
			'name'          => 'Default Sidebar',
			'id'            => 'codeja-default-sidebar',
			'description'   => 'mainly used for home page',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		'Single Sidebar' => array(
			'name'          => 'Single(post) Sidebar',
			'id'            => 'codeja-single-sidebar',
			'description'   => 'used for post pages',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
		'Top Sidebar' => array(
			'name'          => 'Top Sidebar',
			'id'            => 'codeja-top-sidebar',
			'description'   => 'for top sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
        'Top Betting Sidebar' => array(
            'name'          => 'Top Betting Sidebar',
            'id'            => 'codeja-top-betting-sidebar',
            'description'   => 'for top betting sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>'
        ),
		'Betting' => array(
			'name'          => 'Betting',
			'id'            => 'codeja-betting-sidebar',
			'description'   => 'for betting page',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		),
        'Live stream' => array(
            'name'          => 'Live stream',
            'id'            => 'codeja-livestream-sidebar',
            'description'   => 'for livestream page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>'
        ),
		'AMP Single Footer' => array(
			'name'          => 'AMP Single Footer',
			'id'            => 'codeja-amp-single-footer',
			'description'   => 'for single amp footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		)

	);

	// Loop through array of sidebars and create each one
	foreach ( $args as $key => $value ) {
		register_sidebar( $value );
	}

	// Add all sidebars to GLOBAL for later use
	$GLOBALS['codeja_dynamic_sidebar_list'] = $args;
}

/** Register meta box */
function codeja_register_meta_boxes() {
	// Add sidebar select for meta box
	//add_meta_box( 'codeja-sidebar-select', __( 'Sidebar', '101goals' ), 'codeja_select_sidebar', '', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'codeja_register_meta_boxes', 999 );

/** Callback for codeja_select_sidebar meta box */
function codeja_select_sidebar( $post ) {
	$sidebars = $GLOBALS['codeja_dynamic_sidebar_list'];
	if ( is_array ( $sidebars ) && ! empty ( $sidebars ) ) {
		$get_current_sidebar = get_post_meta( $post->ID, 'codeja_selected_sidebar', true );

		// HTML
		echo '<div id="codeja-select-sidebar" class="categorydiv" style="max-height: 300px; overflow-x: auto;">';
		echo '<select name="codeja_selected_sidebar">';
		echo '<option value="codeja-default-sidebar" ' . ( $get_current_sidebar == 'codeja-default-sidebar' ? 'selected' : '' ) . '>' . get_post_type() . ' default</option>';
		echo '<option value="none" ' . ( $get_current_sidebar == 'none' ? 'selected' : '' ) . ' >None, Full Width Page</option>';
		foreach( $sidebars as $key => $value ){
			// un selected nothing
			$selected = "";

			// Check if the selected sidebar id is the same as the value id inside of the loop, if it is - add selected
			if ( $get_current_sidebar == $value['id'] ) {
				$selected = " selected='selected'";
			}

			echo "<option value='{$value['id']}' " . $selected . ">{$value['name']}</option>";
		}
		echo '</select>';
		echo '<p class="howto">Choose the sidebar you want to use</p>';
		echo '</div>'; // end HTML
	} else {
		return false;
	}
	exit();
}

/** Save meta box */
add_action( 'save_post', 'codeja_save_select_sidebar' );
function codeja_save_select_sidebar( $post_id ) {
	if ( array_key_exists( 'codeja_selected_sidebar', $_POST ) ) {
		update_post_meta( $post_id,
			'codeja_selected_sidebar',
			$_POST['codeja_selected_sidebar']
		);
	}
}

/** Get selected sidebar */
function codeja_get_selected_sidebar( $default = "codeja-default-sidebar" ) {
	if ( is_page() || is_single() || is_home() || is_front_page() ) {
		if ( $post_id = get_queried_object_id() ) {
			$post_meta = get_post_meta( $post_id, 'codeja_selected_sidebar', true );
			if ( ! empty ( $post_meta ) ) {
				return $post_meta;
			} else {
				return $default;
			}
		} else {
			return $default;
		}
	} else {
		if ( $term_id = get_queried_object()->term_id ) {
			$term_meta = get_term_meta( $term_id, 'codeja_selected_sidebar', true );
			if ( ! empty ($term_meta ) ) {
				return $term_meta;
			} else {
				return $default;
			}
		} else {
			return $default;
		}
	}
}

/** Get correct width classes if sidebar exists or not */
function codeja_get_correct_classes( $classes = array() ) {
	if ( ! empty ( $classes ) && is_array ( $classes ) ) {
		$classes = ' ' . implode(' ', $classes);
	} else {
		$classes = '';
	}

	if ( codeja_get_selected_sidebar() == 'none' ) {
		echo 'class = "col-md-12' . $classes . '"';
	} else {
		echo 'class = "col-md-9' . $classes . '"';
	}
}

/** Create menu location  */
function register_my_menu() {
	register_nav_menu('main-menu',__( 'Default and Main site menu' ));
}
add_action( 'init', 'register_my_menu' );

/** Get image of the correct league and where are they not allowed */
function get_data_for_league( $name ) {

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

// HELP FUNCTION - GET ALL CATEGORIES AND RETURN <option value=$1>$2</option> LIST
function get_option_of_all_categories($selected_category = false, $taxonomy = 'category', $orderby = 'name') {
	// GET ALL CATEGORIES
	$categories = get_categories(
		array(
			'orderby'   => $orderby,
			'taxonomy'  => $taxonomy
		)
	);

	$output = '<option></option>';
	$selected = '';

	// LOOP THROUGH ALL THE CATEGORIES AND ASSIGN "SELECTED"
	foreach($categories as $category) {
		if ( $selected_category == $category->term_id ) {
			$selected = 'selected';
		}

		$output .= '<option value="' . $category->term_id .'" ' . $selected . '>' . $category->name . '</option>';
	}

	return $output;
}

// HELP FUNCTION - get_option_of_all_categories($selected_category = false, $taxonomy = 'category', $orderby = 'name')
function the_option_of_all_categories($selected_category = false, $taxonomy = 'category', $orderby = 'name') {
	echo get_option_of_all_categories($selected_category, $taxonomy, $orderby);
}

// HELP FUNCTION - GET ALL TAGS AND RETURN <option value=$1>$2</option> LIST
function get_option_of_all_tags( $selected_tag = false, $orderby = 'name') {
    // GET ALL TAGS
    $tags = get_tags(
        array(
            'orderby'   => $orderby,
            'hide_empty' => true,
        )
    );

    $output = '<option></option>';
    $selected = '';

    // LOOP THROUGH ALL THE CATEGORIES AND ASSIGN "SELECTED"
    foreach( $tags as $tag ) {
        if ( $selected_tag == $tag->term_id ) {
            $selected = 'selected';
        }

        $output .= '<option value="' . $tag->term_id .'" ' . $selected . '>' . $tag->name . '</option>';
    }

    return $output;
}

// HELP FUNCTION - get_option_of_all_categories($selected_category = false, $taxonomy = 'category', $orderby = 'name')
function the_option_of_all_tags( $selected_tag = false, $taxonomy = 'category', $orderby = 'name' ) {
    echo get_option_of_all_tags( $selected_tag, $orderby );
}

/*// HELP FUNCTION - GET ALL CATEGORIES AND RETURN <option value=$1>$2</option> LIST
function get_option_of_all_taxonomies($selected_category = false, $taxonomy = 'category', $orderby = 'name') {
    // GET ALL CATEGORIES
    $categories = get_categories(
        array(
            'orderby'   => $orderby,
            'taxonomy'  => $taxonomy
        )
    );

    $output = '<option></option>';
    $selected = '';

    // LOOP THROUGH ALL THE CATEGORIES AND ASSIGN "SELECTED"
    foreach($categories as $category) {
        if ( $selected_category == $category->term_id ) {
            $selected = 'selected';
        }

        $output .= '<option value="' . $category->term_id .'" ' . $selected . '>' . $category->name . '</option>';
    }

    return $output;
}

// HELP FUNCTION - get_option_of_all_categories($selected_category = false, $taxonomy = 'category', $orderby = 'name')
function the_option_of_all_taxonomies($selected_category = false, $taxonomy = 'category', $orderby = 'name') {
    echo get_option_of_all_taxonomies($selected_category, $taxonomy, $orderby);
}*/

// HELP FUNCTION - IS OPTION PRE-SELECTED AND SHOW AS SELECTED
function is_selected($value, $response) {
	if ($value == $response) {
		echo 'selected';
	} else {
		return null;
	}
}

// HELP FUNCTION - IS CHECKBOX IS CHECK AND SHOW AS CHECKED
function is_checked($value) {
	if ( !($value) )
		return null;

	echo 'checked="checked"';
}

// HELP FUNCTION - CUT BY $CHARS THE $STRING AND ADD ..., ONLY CUT OPERATION IS INVOLVED - MAINLY FOR LONG TITLES
function get_cut_and_dots( $string, $chars ) {
	if ( strlen( $string ) > $chars ) {
		return mb_substr( $string, 0, $chars ) . '...';
	} else {
		return $string;
	}
}

// HELP FUNCTION - get_cut_and_dots( $string, $chars )
function the_cut_and_dots( $string, $chars ) {
	echo get_cut_and_dots( $string, $chars );
}

// ADJUST BREADCRUMBS THAT WILL HIDE NAME OF POST
function jj_wpseo_breadcrumb_links( $links ) {
	if( sizeof( $links ) > 1 && is_singular() ){
		array_pop( $links );
	}

	return $links;
}

add_filter( 'wpseo_breadcrumb_links', 'jj_wpseo_breadcrumb_links' );

add_filter( 'wpseo_breadcrumb_single_link', 'jj_link_to_last_crumb' , 10, 2);
function jj_link_to_last_crumb( $output, $crumb) {
	$output = '<a property="v:title" rel="v:url" href="' . $crumb['url'] . '" >';
	$output .= $crumb['text'];
	$output .= '</a>';

	return $output;
}

// HELP FUNCTION - PRINT TO CONSOLE - DEBUGGING TOOL
function console( $text = null, $data = null ) {
	if ( is_array($data) ) {
		$data = json_encode($data);
	}
	echo "<script>console.log('$text','$data'); </script>";
}

// HELP FUNCTION - GET REAL USER ID IF USERID IS NULL - USED MAINLY IN FUNCTIONS CALLS
function get_real_user_id( $userid = null ) {
	if ( !$userid ) {
		$userid = get_current_user_id();
	}

	return $userid;
}

// HELP FUNCTION - GET REAL POST ID IF POSTID NULL - USED MAINLY IN FUNCTIONS CALLS
function get_real_post_id( $postid = null ) {
	if ( !$postid ) {
		$postid = get_queried_object_id();
	}

	return $postid;
}

// ADD TO ALREADY SEEN POSTS (COOKIE)
function add_to_seen_posts( $postid ) {
	$seen_posts = json_decode( stripslashes($_COOKIE['seen_posts']), true );
	if ( in_array( $postid, $seen_posts ) ) {
		return false;
	}

	$seen_posts[$postid] = $postid;

	setcookie('seen_posts', json_encode($seen_posts), time() + 86000, '/');

	return null;
}

if( function_exists('acf_add_options_page') ) {
	$args = array(
		'page_title' => 'General 101 Options',
		'menu_title' => 'General 101 Options',
		'menu_slug' => 'general-101-options',
		'position' => 2,
	);

	$parent = acf_add_options_page( $args );

	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'DFP Banners',
		'menu_title' 	=> 'DFP Banners',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}

// GET BANNER PLACEMENT LOCATION WITH $RECEIVED VARIABLES - MAINLY USED FOR DFP
function get_banner_placement( $banner_id, $next_banner_in_array = false, $float = false ) {

	switch ( $GLOBALS['DFP_BANNERS'][$banner_id]['screen'] ) {
		case 1:
			$desktop_or_mobile = 'only-desktop';
			break;

		case 2:
			$desktop_or_mobile = 'only-mobile';
			break;

		default:
			$desktop_or_mobile = '';
			break;
	}

	// ADJUST IF FLOATING BANNER SET
	switch ( $GLOBALS['DFP_BANNERS'][$banner_id]['is_float'] ) {
		case 'left':
			$float_class = 'banner-float-left';
			break;

		case 'right':
			$float_class = 'banner-float-right';
			break;

		case 'center':
			$float_class = 'banner-float-center';
			break;

		default:
			$float_class = '';
			break;
	}

	if ( $GLOBALS['DFP_BANNERS'][$banner_id]['is_dfp'] ) {
		$code = $GLOBALS['DFP_BANNERS'][ $banner_id ]['code'];

		if ( strpos ( $GLOBALS['DFP_BANNERS'][$banner_id]['code'], ',') ) {
			$banners_array = explode(',', $GLOBALS['DFP_BANNERS'][$banner_id]['code']);

			if ( $next_banner_in_array !== false ) {

				$code = $banners_array[$next_banner_in_array];

				if ( $code == '' ) {
					return null;
				}
			}
		}

		$return = '';

		if ( ! $GLOBALS['DFP_BANNERS'][$banner_id]['remove_style'] ) {
			$return .= '<div class="row ' . $desktop_or_mobile . ' banner-wrapper ' . $float_class . '" id="banner-placement-' . $GLOBALS['BANNER_NUMBER'] . '">
							<div class="col-md-12">
								<div class="banner-placement">
									<div class="inside">';

			// RESET FLOATING IF NOT REMOVE STYLE, THAT IT WILL NO BE DOUBLE EFFECT
			$float_class = '';
			$desktop_or_mobile = '';
		}

		$return .= '	<div id="' . $code . '" class="' . $desktop_or_mobile . ' ' . $float_class . '">

										<script>
											googletag.cmd.push(function() { googletag.display(\'' . $code . '\'); });
										</script>
									</div>';


		if ( ! $GLOBALS['DFP_BANNERS'][$banner_id]['remove_style'] ) {
			$return .= 	'</div>
							</div>
						</div>
					</div>';
		}

		/*	$return = '<div class="row ' . $desktop_or_mobile . ' banner-wrapper ' . $float_class . '" id="banner-placement-' . $GLOBALS['BANNER_NUMBER'] . '">
								<div class="col-md-12">
									<div class="banner-placement">
										<div class="inside">
															<div id="' . $code . '">

											<script>
												googletag.cmd.push(function() { googletag.display(\'' . $code . '\'); });
											</script>
										</div>
									</div>
								</div>
							</div>
						</div>';*/
	} else if ( $GLOBALS['DFP_BANNERS'][$banner_id]['remove_style'] ) {
		$return = $GLOBALS['DFP_BANNERS'][$banner_id]['code'];
	} else {
		$return = '<div class="row ' . $desktop_or_mobile . ' banner-wrapper" id="banner-placement-' . $GLOBALS['BANNER_NUMBER'] . '">
					<div class="col-md-12">
						<div class="banner-placement">
							<div class="inside"> 
								' . $GLOBALS['DFP_BANNERS'][$banner_id]['code'] . '
							</div>
						</div>
					</div>
				</div>';
	}
	$GLOBALS['BANNER_NUMBER'] += 1;

	return $return;
}

// ECHO get_banner_placement( $banner_id )
function the_banner_placement( $banner_id, $next_banner_in_array = false, $float = false ) {
    if ( post_is_in_descendant_category( array( 16469, 1028, 20704 ) ) || is_singular( CJBL::$post_type ) || is_post_type_archive( array( CJBL::$post_type, 'videosfeeds' ) ) || is_tax( CJBL::$taxonomy ) || is_category( 20704 ) || is_category( 20705 ) || is_single( 715085 ) ){
        return false;
    }

	if ( BANNERS_OFF ) {
		return false;
	}

	if ( strpos ( $banner_id, 'MOBILE' ) && !wp_is_mobile() ) {
		return false;
	}

	if ( $GLOBALS['DFP_BANNERS'][$banner_id]['screen'] == 1 && wp_is_mobile() ) {
		return false;
	}

	echo get_banner_placement( $banner_id, $next_banner_in_array, $float );
}

function get_country_name_from_abbr( $abbr ) {
	$countries = array (
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

function ajax_save_newsletter_details() {
	$email = $_POST['email'];

	if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$newsletter_files = fopen( get_template_directory() . "/newsletter-emails.txt", "a+" );
		while( !feof($newsletter_files) ) {
			if ( strpos( fgets($newsletter_files), $email ) !== false ) {
				echo 2; // EMAIL EXISTS
				exit;
			}
		}
		fwrite( $newsletter_files, $email . PHP_EOL );
		fclose( $newsletter_files );
		echo 1; // EMAIL ADDED

	} else {
		echo 3; // EMAIL NOT FILLED
	}

	exit;
}

add_action( 'wp_ajax_save_newsletter_details', 'ajax_save_newsletter_details' );
add_action( 'wp_ajax_nopriv_save_newsletter_details', 'ajax_save_newsletter_details' );

function the_country_name_from_abbr( $abbr ) {
	echo get_country_name_from_abbr( $abbr );
}

function get_custom_cat_template($single_template) {
	global $post;

	if ( in_category( '365-bets') || in_category( 'betting' )) {
		$single_template = dirname( __FILE__ ) . '/single-livestream.php';
	}
	return $single_template;
}

add_filter( "single_template", "get_custom_cat_template" ) ;

function get_the_real_or_external_title() {
    if ( get_field('codeja_external_title') ) {
        return get_field('codeja_external_title');
    } else {
        return get_the_title();
    }
}

// USE REAL OR EXTERNAL TITLE
function the_real_or_external_title() {
	echo get_the_real_or_external_title();

	return null;
}

function get_seen_posts() {
	return json_decode( stripslashes($_COOKIE['seen_posts']), true );
}

function cj_default_image_size () {
    return 'large';
}

add_filter( 'pre_option_image_default_size', 'cj_default_image_size' );

function get_last_video_post() {
	$last_video_query = new WP_Query (
		array(
			'cat'               => 15276,
			'posts_per_page'    => 1,
			'order_by'          => 'meta_value_num',
			'meta_key'          => 'post_views',
			'post__not_in'		=> get_seen_posts(),
			'post_status'       => 'publish',
			'date_query' => array(
				'relation'   => 'OR',
				array(
					'column'  => 'post_date',
					'after'   => '-7 days'
				),
				array(
					'column'  => 'post_modified',
					'after'   => '-7 days'
				)
			)
		)
	);

	return $last_video_query->get_posts()[0];
}

function update_views_count( $post_id ) {
	$post_id = get_real_post_id( $post_id );

	$current_views = get_post_meta( $post_id, 'post_views', true);
	$views = $current_views == false ? 0 : $current_views;
	update_post_meta( $post_id, 'post_views', $views + 1 );
	return null;
}

function post_is_in_descendant_category( $cats, $post = null ){
    if ( is_single() ) {
        $post = ! $post ? get_queried_object_id() : $post;

        if ( in_category( $cats, $post ) ) {
            return true;
        }
    }

	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');

		if ( $descendants && in_category( $descendants, $post ) || is_category($cat) )
			return true;
	}
	return false;
}

function wpd_do_stuff_on_404(){
	if( is_404() ){
		redirect_from_404_to_correct_permalink();
	}
}
add_action( 'template_redirect', 'wpd_do_stuff_on_404', 0 );

/*
// AMP PAGES
function codeja_amp_set_custom_template( $file, $type, $post ) {
    if ( 'single' === $type ) {
        $file = dirname( __FILE__ ) . '/templates/amp/single-amp.php';
    }
    return $file;
}
add_filter( 'amp_post_template_file', 'codeja_amp_set_custom_template', 10, 3 );*/

define( "CODEJA_COUNTRY_CODE" ,  getenv('HTTP_GEOIP_COUNTRY_CODE') );
define( "IS_TEST" ,  $_GET['test_mode'] == 1 ? true : false );
define( "BANNERS_OFF" ,  is_user_logged_in() && $_GET['banners'] == 1 ? true : false );

function cj_enqueue_amp_scripts() {
    echo '<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>';
    echo '<script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>';
}
add_action( 'amp_post_template_head', 'cj_enqueue_amp_scripts' );

add_filter( 'wpseo_breadcrumb_links', 'cj_wpseo_breadcrumb_links', 999, 1 );
function cj_wpseo_breadcrumb_links( $links ) {
    $category = get_the_category();


    $current_rel_uri = add_query_arg( NULL, NULL );
    $slugs = explode( '/', $current_rel_uri );

    if ( in_array( 'players', $slugs ) && is_tax( 'players' )) {
        $taxonomy = get_taxonomy( 'players' );

        $tax_name = $taxonomy->labels->name;
        $slug = $taxonomy->rewrite['slug'];

        $links[] = Array
        (
            'text' => $tax_name,
            'url' => home_url( $slug ),
            'allow_html' => 1
        );
    }

    if ( in_array( 'teams', $slugs ) && is_tax( 'teams' )) {
        $taxonomy = get_taxonomy( 'teams' );

        $tax_name = $taxonomy->labels->name;
        $slug = $taxonomy->rewrite['slug'];

        $links[] = Array
        (
            'text' => $tax_name,
            'url' => home_url( $slug ),
            'allow_html' => 1
        );
    }

    if ( in_array( 'managers', $slugs ) && is_tax( 'managers' )) {
        $taxonomy = get_taxonomy( 'managers' );

        $tax_name = $taxonomy->labels->name;
        $slug = $taxonomy->rewrite['slug'];

        $links[] = Array
        (
            'text' => $tax_name,
            'url' => home_url( $slug ),
            'allow_html' => 1
        );
    }

    return $links;
}

// GET IMAGE ALI AND TITLE
function cj_get_image_data( $post_id = false, $image_id = false ) {
    $image = new stdClass;

    if ( $image_id ) {
        $image->ID = $image_id;
    } else {
        $image->ID = $post_id ? get_post_thumbnail_id( $post_id ) : get_post_thumbnail_id();
    }

    $attachment_meta = wp_get_attachment_metadata( $image->ID );

    $image->alt = get_post_meta( $image->ID, '_wp_attachment_image_alt', true);
    $image->title = $attachment_meta['image_meta']['title'];
    $image->caption = $attachment_meta['image_meta']['caption'];

    return $image;
}

function cj_button_shortcode( $atts ) {

    // Attributes
    $atts = shortcode_atts(
        array(
            'text' => '',
            'text_color' => '',
            'color' => '',
            'link' => ''
        ),
        $atts
    );

    $output = '';

    if ( ! empty( $atts['link'] ) ) {
        $output .= '<a style="text-decoration: none;" href="' . $atts['link'] . '">';
    }

    $output .= '<div class="cj_button" style="color: ' . $atts['text_color'] . '; background-color: ' . $atts['color'] . '">';
    $output .= $atts['text'];
    $output .= '</div>';

    if ( ! empty( $atts['link'] ) ) {
        $output .= '</a>';
    }

    return $output;

}
add_shortcode( 'button', 'cj_button_shortcode' );

include_once ('posts-widget.php'); // widget for posts ordering in sidebar
include_once('lib/function_content.php'); // widget for posts ordering in sidebar
include_once('lib/function_odds.php'); // widget for posts ordering in sidebar
include_once('lib/function_save_post.php'); // add save_post functionality
include_once('lib/function_next_post.php'); // add next_post
include_once('lib/function_dfp_widget.php'); // add dfp widget
include_once('lib/function_ajax_tags.php'); // add ajax tags and odds
include_once('lib/function_suggest_posts.php'); // add suggested posts, called by ajax
include_once('lib/function_rss.php'); // rss
include_once('lib/function_fix_404.php'); // try to fix 404 errors from previous site
include_once('lib/function_prepopulate_livestream.php'); // try to fix 404 errors from previous site
include_once('lib/function_get_image.php'); // try to fix 404 errors from previous site
include_once('lib/function_post_types.php'); // add post types
include_once('lib/function_amp_content.php'); // check if amp

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

add_theme_support( 'post-thumbnails' );
add_image_size( 'codeja-homepage-thumb', 600, 400, true ); // HARD Crop Mode
add_image_size( 'codeja-small-horizontal', 110, 76, true ); // HARD Crop Mode

// init process for registering our button
add_action('init', 'wpse72394_shortcode_button_init');
function wpse72394_shortcode_button_init() {

    //Abort early if the user will never see TinyMCE
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
        return;

    //Add a callback to regiser our tinymce plugin
    add_filter("mce_external_plugins", "wpse72394_register_tinymce_plugin");

    // Add a callback to add our button to the TinyMCE toolbar
    add_filter('mce_buttons', 'wpse72394_add_tinymce_button');
}


//This callback registers our plug-in
function wpse72394_register_tinymce_plugin($plugin_array) {
    $plugin_array['wpse72394_button'] = JS_FOLDER . '/button_shortcode.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function wpse72394_add_tinymce_button($buttons) {
    //Add the button ID to the $button array
    $buttons[] = "wpse72394_button";return $buttons;
}


function cj_get_betting_box() {
    if ( get_field('cj_betting_box_show_hide', 'option') && have_rows('cj_betting_box', 'option') ) :
        echo '<!-- html banner -->';
        while ( have_rows('cj_betting_box', 'option') ) : the_row();
            echo '<!-- start banner -->';

            $from_when = strtotime(get_sub_field('cj_from_when'));
            $to_when = strtotime(get_sub_field('cj_to_when'));
            $image = get_sub_field('cj_betting_box_image');
            $url = get_sub_field('cj_betting_box_url');
            $nofollow = get_sub_field('cj_betting_box_no_follow') ?: 'rel="nofollow"';


            if ( time() > $from_when && time() < $to_when ) : ?>

                <div class="cj-betting-box">
                    <a href="<?php echo $url ?>" <?php echo $nofollow ?> target="_blank">
                        <img src="<?php echo $image ?>">
                    </a>
                </div>

                <?php
            endif;
        endwhile;
    endif;
}


function cj_get_betting_box_return() {
    if ( get_field('cj_betting_box_show_hide', 'option') && have_rows('cj_betting_box', 'option') ) {
        $output = '';
        while ( have_rows('cj_betting_box', 'option') ) {
            the_row();
            $from_when = strtotime(get_sub_field('cj_from_when'));
            $to_when = strtotime(get_sub_field('cj_to_when'));
            $image = get_sub_field('cj_betting_box_image');
            $url = get_sub_field('cj_betting_box_url');
            $nofollow = get_sub_field('cj_betting_box_no_follow') ?: 'rel="nofollow"';

            $image_size = getimagesize( $image );


            if ( time() > $from_when && time() < $to_when ) {
                $output .= '<div class="cj-betting-box">
                    <a href="' . $url . '" ' . $nofollow . ' target="_blank">
                        <img src="' . $image . '" width="' . $image_size[0] . '" height="' . $image_size[1] . '">
                    </a>
                </div>';
            }
        }
        return $output;
    }
    return false;
}


remove_all_actions('do_feed_rss2');
add_action('do_feed_rss2', 'newsnow_rss', 10, 1);

function newsnow_rss() {
    get_template_part('rss', 'newsnow');
}

add_action('init', 'instantRSS');
function instantRSS(){
    add_feed('instant-rss', 'instant_rss_function');
}

function instant_rss_function() {
    get_template_part('rss', 'instant');
}

function cj_is_amp() {
	return isset( $_GET['is_amp'] );
}

function cj_add_amp() {
	if ( 'cjbl_live_streaming' === get_post_type( get_the_ID() ) && is_single() 
	|| 'videosfeeds' === get_post_type( get_the_ID() ) && is_single() ) {
		echo '<link rel="amphtml" href="' . wp_get_canonical_url( get_the_ID() ) . '?is_amp">';
	}
}

add_action('wp_head', 'cj_add_amp');

function change_videosfeeds_yoast_title( $title ) {
	if ( is_post_type_archive( 'videosfeeds' ) ) {
		$title = 'Football videos: The best clips the internet has to offer - 24/7 updated feed';
	}

	return $title;
}

add_filter( 'wpseo_title', 'change_videosfeeds_yoast_title', 100, 1 );

function cj_get_amp_templates( $template ) {
	if ( cj_is_amp() ) {
		if ( 'videosfeeds' === get_post_type( get_the_ID() ) && is_single() ) {
			$template = get_template_directory() . '/templates/amp/' . get_post_type() . '/single-' . get_post_type() . '.php';
		}
	}

	return $template;
}

add_filter( 'template_include', 'cj_get_amp_templates', 10 );

// add_action( 'init', 'is_amp_init' );
// function is_amp_init() {
// 	global $wp_rewrite;

// 	add_rewrite_endpoint( 'is_amp', 'is_amp' );

// 	var_dump($wp_rewrite->endpoints);
// }
