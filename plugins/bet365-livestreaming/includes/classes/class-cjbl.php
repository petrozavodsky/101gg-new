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
 * Date of creation: 18-Jan-17 / 16:52
 * Last updated: 18-Jan-17 / 16:52 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CJBL {
	public static $post_type = 'cjbl_live_streaming';
	public static $taxonomy = 'cjbl_sport_types';
	public static $sidebar = 'cjbl_under_content_widget_area';
	public static $sport_type_prefix = 'live-streaming-';

	public static function get_option( $name, $default = false ) {
		$option = get_option( 'cjbl' );

		if ( false === $option ) {
			return $default;
		}

		if ( isset( $option[ $name ] ) ) {
			return $option[ $name ];
		} else {
			return $default;
		}
	}

	public static function update_option( $name, $value ) {
		$option = get_option( 'cjbl' );
		$option = ( false === $option ) ? array() : (array) $option;
		$option = array_merge( $option, array( $name => $value ) );
		update_option( 'cjbl', $option );
	}

	public static function delete_option( $name ) {
		$option = get_option( 'cjbl' );
		$option = ( false === $option ) ? array() : (array) $option;
		unset( $option[ $name ] );
		update_option( 'cjbl', $option );
	}

    public static function get_import_option( $name, $default = false ) {
        $option = get_option( 'cjbl_import' );

        if ( false === $option ) {
            return $default;
        }

        if ( isset( $option[ $name ] ) ) {
            return $option[ $name ];
        } else {
            return $default;
        }
    }

    public static function update_import_option( $name, $value ) {
        $option = get_option( 'cjbl_import' );
        $option = ( false === $option ) ? array() : (array) $option;
        $option = array_merge( $option, array( $name => $value ) );
        update_option( 'cjbl', $option );
    }

    public static function delete_iomport_option( $name ) {
        $option = get_option( 'cjbl_import' );
        $option = ( false === $option ) ? array() : (array) $option;
        unset( $option[ $name ] );
        update_option( 'cjbl', $option );
    }

	public static function add_log( $action, $description, $file = null, $line = null ) {
		$logs = self::get_logs();

		$backtrace = debug_backtrace();

		$logs[] = array(
			'action'      => $action,
			'description' => $description,
			'time'        => time(),
			'file'        => $backtrace[0]['file'],
		);

		self::update_option( 'logs', $logs );
	}

	public static function get_logs() {
		$logs = self::get_option( 'logs' );
		$logs = ( false === $logs ) ? array() : (array) $logs;

		usort( $logs, 'cjbl_sorting_array' );

		return $logs;
	}
}