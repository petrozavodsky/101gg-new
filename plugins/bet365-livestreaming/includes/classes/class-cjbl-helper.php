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
 * Date of creation: 14-Jan-17 / 21:46
 * Last updated: 14-Jan-17 / 21:46 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

class CJBL_Helper {
	public static function register_post_type() {
		$labels = array(
			"name"          => __( 'Live Streaming', 'twentyseventeen' ),
			"singular_name" => __( 'Live Streaming', 'twentyseventeen' ),
		);

		$args = array(
			"label"               => __( 'Games', 'twentyseventeen' ),
			"labels"              => $labels,
			"description"         => "",
			"public"              => true,
			"publicly_queryable"  => true,
			"show_ui"             => true,
			"show_in_rest"        => false,
			"rest_base"           => "",
			"show_in_menu"        => true,
            "has_archive"         => 'live-streaming-games',
			"exclude_from_search" => false,
			"capability_type"     => "post",
			"map_meta_cap"        => true,
			"hierarchical"        => false,
			"rewrite"             => array( "slug" => "live-streaming-games/%" . CJBL::$taxonomy . "%", "with_front" => true ),
			"query_var"           => true,
			"supports"            => array( "title", "editor", "thumbnail" ),
		);

		register_post_type( CJBL::$post_type, $args );
	}

	public static function register_taxonomy() {
		$labels = array(
			"name"          => __( 'Sports Types', 'twentyseventeen' ),
			"singular_name" => __( 'Sport Type', 'twentyseventeen' ),
		);

		$args = array(
			"label"              => __( 'Sport Types', 'twentyseventeen' ),
			"labels"             => $labels,
			"public"             => true,
			"hierarchical"       => true,
			"show_ui"            => true,
			"show_in_menu"       => true,
			"show_in_nav_menus"  => true,
			"query_var"          => true,
			"rewrite"            => array( 'slug' => 'live-streaming-games' ),
			"show_admin_column"  => false,
			"show_in_rest"       => false,
			"rest_base"          => "",
			"show_in_quick_edit" => false,
		);

        register_taxonomy( CJBL::$taxonomy, array( CJBL::$post_type ), $args );
	}

	public static function template_chooser( $template ) {
		$post_id = get_the_ID();

		// ALL OTHER CPT TYPES
		if ( get_post_type( $post_id ) != CJBL::$post_type ) {
			return $template;
		}

		// IF LIVESTREAMING - USE TEMPLATE
		if ( is_single() ) {
			return self::get_template_hierarchy( 'single' );
		}

        if ( is_category() || is_tax() ) {
            return self::get_template_hierarchy( 'category' );
        }

        if ( is_archive() ) {
            return self::get_template_hierarchy( 'archive' );
        }

		return $template;
	}

	/**
	 * Get the custom template if is set
	 *
	 * @since 1.0
	 */

	private static function get_template_hierarchy( $template_type ) {
		// Get the template slug
		$template_slug = rtrim( $template_type, '.php' );
		$template      = $template_slug;

		// Check if a custom template exists in the theme folder, if not, load the plugin template file
		if ( $theme_file = locate_template( array( 'cj_bet365_livestreams/' . $template . '.php' ) ) ) {
			$file = $theme_file;
		} else {
			$file = CJBL_PLUGIN_DIR . '/templates/' . $template . ( cj_is_amp() ? '-amp' : null ) . '.php';
		}

		return apply_filters( 'cjbl_template' . $template, $file );
	}

	public static function register_sidebar() {
        register_sidebar( array(
            'name' => __( CJBL_PLUGIN_REAL_NAME, 'cjbl' ),
            'id' => CJBL::$sidebar,
            'description' => __( 'Widgets in this area will be shown on bet365 ARCHIVE PAGE', 'cjbl' ),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name' => __( CJBL_PLUGIN_REAL_NAME, 'cjbl' ),
            'id' => CJBL::$sidebar . '2',
            'description' => __( 'Widgets in this area will be shown on bet365 CATEGORY PAGE', 'cjbl' ),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name' => __( CJBL_PLUGIN_REAL_NAME, 'cjbl' ),
            'id' => CJBL::$sidebar . '3',
            'description' => __( 'Widgets in this area will be shown on bet365 SINGLE PAGE', 'cjbl' ),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ) );
    }

    public static function enqueue() {
        wp_enqueue_script( 'cjbl-javascript', CJBL_PLUGIN_URL . 'assets/js/cjbl.js', array( 'jquery' ) );
        //wp_enqueue_style( 'cjbl-style', CJBL_PLUGIN_URL . 'assets/css/cjbl.css' );

        wp_localize_script( 'cjbl-javascript', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
        );
    }
}