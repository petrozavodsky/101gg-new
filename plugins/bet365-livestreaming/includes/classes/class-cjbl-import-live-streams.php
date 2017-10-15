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
 * Date of creation: 14-Jan-17 / 10:48
 * Last updated: 14-Jan-17 / 10:48 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CJBL_Import_Live_Streams {

	private $hashed_row, $wpdb, $total_inserted_posts = array();

	function __construct() {
		global $wpdb;

		$this->wpdb    = $wpdb;

		// RESET DB FOR FASTER INSERTION
		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );
		$this->wpdb->query( 'SET autocommit = 0;' );
	}

	/**
	 * Creating unique hashed string from an array.
	 *
	 * @param $array
	 *
	 * @return null|string
	 */
	private function hash_row( $array ) {
		if ( is_array( $array ) ) {
			return md5( implode( ',', $array ) );
		} else {
			return null;
		}
	}

	/**
	 * @param $sport_type
	 *
	 * @return int|null
	 */
	private function use_or_create_sport_type( $sport_type ) {
        if ( empty( $sport_type ) ) {
            $sport_type = 'Other Sports';
        }

	    $args = array(
	        'taxonomy' => CJBL::$taxonomy,
            'hide_empty' => false,
            'number' => 1,
            'meta_query' => array(
                array(
                    'key' => 'cj_real_sport_name',
                    'value' => $sport_type,
                    'compare' => '='
                )
            )
        );

	    $terms = get_terms ( $args );

		// SPORT TYPE EXIST - USE IT
		if ( ! empty ( $terms ) ) {
			return $terms[0]->term_id;
		}

        $create_term_args = array(
            'slug' => CJBL::$sport_type_prefix . str_replace(' ', '-', strtolower( $sport_type ) )
        );

		$return = wp_insert_term( $sport_type, CJBL::$taxonomy, $create_term_args );

		// CHECK FOR ERRORS
        if ( is_wp_error( $return ) ) {
            CJBL::add_log( 'creating SPORT TYPE error',  'sport name: ' . $sport_type . ' error: ' . $return->get_error_message() );
			die( $return->get_error_message() );
		} else {
            add_term_meta( $return['term_id'], 'cjbl_order', 0 ); // ADD BASIC ORDER
            add_term_meta( $return['term_id'], 'cj_real_sport_name', $sport_type ); // SAVE REAL SPORT NAME FOR LATER USE
            return $return['term_id'];
		}
	}

	/**
     * @param $league_name
     * @param $sport_type_id
	 *
	 * @return int|null
	 */
	private function use_or_create_league( $league_name, $sport_type_id ) {
        if ( empty( $league_name ) || $league_name == '' || $league_name == ' ' ) {
            $league_name = 'Other Leagues';
        }

	    $term = term_exists( $league_name, CJBL::$taxonomy, $sport_type_id );

		// LEAGUE EXIST - USE IT
		if ( $term !== 0 && $term !== null ) {
			return $term['term_id'];
		}

        // ASSIGN PARENT
        $args = array(
            'parent' => $sport_type_id
        );

		$return = wp_insert_term( $league_name, CJBL::$taxonomy, $args );

		// CHECK FOR ERRORS
		if ( is_wp_error( $return ) ) {
            CJBL::add_log( 'creating LEAGUE TYPE error', 'league name: ' . $league_name . ' error: ' . $return->get_error_message() );
            die( $return->get_error_message() );
		} else {
			return $return['term_id'];
		}
	}

	/**
	 * Check if hashed row exist
	 * If $row given, use it.
	 * If $this->hashed_row already created - use it
	 * Die on no $row and no $hashed_row
	 *
	 * @param array|null $row
	 *
	 * @return bool
	 */
	private function is_row_exists( array $row = null ) {
		if ( ! $row ) {
			die( 'ERROR: hashed_row or row not given' );
		}

		$this->hashed_row = $this->hash_row( $row ); // Returns $this->hashed_row and declares it.

		// CHECK IF ALREADY EXIST IN DB
		$results = $this->wpdb->get_results( "
			SELECT post_id 
			FROM {$this->wpdb->postmeta}
			WHERE meta_key = 'hash_code' 
			AND  meta_value = '{$this->hashed_row}'
			LIMIT 1
			", ARRAY_A );

		if ( count( $results ) > 0 ) {
			return true;
		}

		return false;
	}

	public function get_data_from_xml() {
		$xml = simplexml_load_file( BASE_XML_URL );

		$i = 0;
		// ITERATE THROUGH EVERY XML ROW(LINE)
		foreach ( $xml as $row ) {
			$i++;
			$attrs = [];

			// CREATE ARRAY OF ATTRIBUTES
			foreach ( $row->attributes() as $key => $value ) {
				$attrs[ $key ] = (string) $value;
			}

			$attrs_to_hash = $attrs;
			unset($attrs_to_hash['EventEnd']);

			if ( $this->is_row_exists( $attrs_to_hash ) ) {
				continue;
			}

			// GET CATEGORY ID
            $sport_type_id = (int) $this->use_or_create_sport_type( $attrs['Classification'] );
            $league_id = (int) $this->use_or_create_league( $attrs['EventGroup'], $sport_type_id );

			// EXPLODE TEAMS TO HAVE 2 SEPARATE VARIABLES
			$teams_playing = explode( ' vs ', str_replace( ' v ', ' vs ', $attrs['EventName'] ) );

			$attrs['team_1'] = $teams_playing[0];
			$attrs['team_2'] = $teams_playing[1];

			// CREATE NEW POST TITLE
            $post_title = $attrs['team_1'];

            if ( $attrs['team_2'] ) {
                $post_title .= ' v ' . $attrs['team_2'];
            }

            $new_post_title = CJBL::get_import_option( 'post_title', '{opponent} : online live streaming video hd {competition} {date}' );
            $new_post_title = str_replace( '{opponent}', $post_title, $new_post_title );
            $new_post_title = str_replace( '{competition}', $attrs['EventGroup'], $new_post_title );

            // REPLACE PLACEHOLDER VARIABLES WITH REAL DATA // {date}
            $new_post_title = str_replace( '{date}', date( "Y-m-d", strtotime( $attrs['EventStart'] ) ), $new_post_title );

			// NEW POST ARGS
			$new_post = array(
				'post_type'    => CJBL::$post_type,
				'post_title'   => $new_post_title,
				'post_author'  => CJBL::get_import_option( 'post_author', 1 ),
				'post_content' => '',
				'post_status'  => 'publish',
				'meta_input'   => array(
					'hash_code'  => $this->hashed_row,
					'attributes' => json_encode( $attrs ),
                    'start_time' => strtotime( $attrs['EventStart'] ),
                    'end_time' => strtotime( $attrs['EventEnd'] ),
                    '_yoast_wpseo_title' => $new_post_title,
                    '_yoast_wpseo_metadesc' => 'Are ready to Watch ' . $attrs['team_1'] . ' vs ' . $attrs['team_2'] . ' - ' . $attrs['EventGroup'] .
                        ' -  Live Streaming [HD] - Date & Time: ' . date("Y-m-d", strtotime($attrs['EventStart'])) .
                        ', ' . date("H:i", strtotime($attrs['EventStart'])) . '.',
				),
			);

			// CATCH ERROR ON POST CREATION
			if ( is_wp_error( $new_post_id = wp_insert_post( $new_post, true ) ) ) {
                CJBL::add_log( 'ERROR!', 'Can\'t Add Post to DB. POST DATA(JSON)' . json_encode( $new_post ) );
				die( "ERROR: Can't insert new post to DB" );
			}

			// ADD TERMS TAXONOMY TO CREATED LIVE STREAM
            wp_set_object_terms( $new_post_id, array( $sport_type_id, $league_id ), CJBL::$taxonomy );
            //wp_set_object_terms( $new_post_id, $league_id, CJBL::$taxonomy );

            $this->total_inserted_posts[ $sport_type_id ] += 1;
		}

		// RESET DB FOR FASTER INSERTION
		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );
		$this->wpdb->query( 'SET autocommit = 1;' );

		return $this->send_mail();
	}

	/**
	 * Send email
	 */
	private function send_mail() {
		$message = "<b>New entries by Categories:</b> <br/><br/>";

		$total = 0;

		foreach ( $this->total_inserted_posts as $key => $value ) {
			$total += $value;
			$message .= "<b>$key</b>: $value <br/>";
		}

		$message .= "<br /><b>Total: $total</b>";

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );
		$emails  = CJBL::get_option( 'report_emails', get_bloginfo( 'admin_email' ) );

		$return = wp_mail( get_bloginfo( 'admin_email' ), 'All the livestream pages that has been updated ' . date( 'd/M/Y' ), $message, $headers );

		if ( ! $return ) {
			return $total;
		}

		return $total;
	}
}