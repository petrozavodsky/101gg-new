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
 * Date of creation: 14-Jan-17 / 22:24
 * Last updated: 14-Jan-17 / 22:24 By Kirill Lavrishev
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class CJBL_Admin_Page {

    public function __construct() {
    }

    public function enqueue( $hook ) {
        if ( strpos( $hook, 'cjbl') !== false ) {
            wp_enqueue_script( 'cjbl-admin-javascript', CJBL_PLUGIN_URL . '/admin/assets/js/admin.js', array( 'jquery' ) );
            wp_enqueue_style( 'cjbl-admin-style', CJBL_PLUGIN_URL . '/admin/assets/css/admin.css' );

            wp_localize_script( 'cjbl-admin-javascript', 'ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
            );
        }
    }

    /**
     * ADDING ADMIN PAGE FUNCTIONALITY
     */
    public function addAdminPage() {
        add_menu_page( 'Bet365 Streams', 'Bet365 Streams', 'manage_options', 'cjbl-admin-page', array(
            $this,
            'renderSettings'
        ) );


        add_submenu_page( 'cjbl-admin-page', 'Bet365 Livestreaming Logs', 'Settings', 'manage_options', 'cjbl-admin-page', array(
            $this,
            'renderSettings'
        ) );

        add_submenu_page( 'cjbl-admin-page', 'Import Settings', 'Import Settings', 'manage_options', 'cjbl-import-settings', array(
            $this,
            'renderImportSettings'
        ) );

        add_submenu_page( 'cjbl-admin-page', 'Logs', 'Imported Streams', 'manage_options', 'cjbl-streams', array(
            $this,
            'renderImportedStreams'
        ) );
        add_submenu_page( 'cjbl-admin-page', 'Logs', 'Logs', 'manage_options', 'cjbl-logs', array(
            $this,
            'renderLogs'
        ) );
    }

    /**
     * CONFIGURING ALL THE SETTINGS AVAILABLE FOR USER
     */
    public function configure() {
        // General Section
        add_settings_section(
            'cjbl-general',
            'General Settings',
            array( $this, 'renderGeneralSection' ),
            'cjbl-settings'
        );
        add_settings_field(
            'cjbl-general-xml-url',
            'Bet365 API Url',
            array( $this, 'renderXmlUrl' ),
            'cjbl-settings',
            'cjbl-general'
        );


        // NEW WAY OF CREATING FIELDS
        $this->add_field( 'active_now_text', 'Active Now Button Text', 'cjbl-settings', 'cjbl-general' );
        $this->add_field( 'single_watch_now_text', 'Single Page Button Text', 'cjbl-settings', 'cjbl-general' );
        $this->add_field( 'watch_now_link', 'Watch Now Link', 'cjbl-settings', 'cjbl-general' );
        $this->add_field( 'main_header_title', 'Archive Header Title', 'cjbl-settings', 'cjbl-general' );

        add_settings_field(
            'cjbl-general-ajax-get-livestreaming',
            '',
            array( $this, 'renderAjaxGetLivestream' ),
            'cjbl-settings',
            'cjbl-general'
        );

        add_settings_field(
            'cjbl-posts-content-under-header',
            'Content Under Archive',
            array( $this, 'renderContentUnderHeader' ),
            'cjbl-settings',
            'cjbl-general'
        );

        add_settings_field(
            'cjbl-posts-content-under-category',
            'Content Under Category(spot-type)',
            array( $this, 'renderContentUnderCategory' ),
            'cjbl-settings',
            'cjbl-general'
        );


        add_settings_field(
            'cjbl-posts-content-under-livestream',
            'Content Under Live Stream',
            array( $this, 'renderContentUnderLivestream' ),
            'cjbl-settings',
            'cjbl-general'
        );

        add_settings_section(
            'cjbl-instructions-image',
            'Instruction Images',
            array( $this, 'renderGeneralSection' ),
            'cjbl-settings'
        );


        $this->add_field( 'image_instruction_title', 'Instruction Title', 'cjbl-settings', 'cjbl-instructions-image' );
        $this->add_field( 'image_file_1', 'Image File 1', 'cjbl-settings', 'cjbl-instructions-image', 'image' );
        $this->add_field( 'image_file_1_title', 'Title', 'cjbl-settings', 'cjbl-instructions-image' );
        $this->add_field( 'image_file_1_content', 'Content', 'cjbl-settings', 'cjbl-instructions-image', 'textarea' );
        $this->add_field( 'image_file_2', 'Mobile Image File 2', 'cjbl-settings', 'cjbl-instructions-image', 'image' );
        $this->add_field( 'image_file_2_title', 'Mobile Title', 'cjbl-settings', 'cjbl-instructions-image' );
        $this->add_field( 'image_file_2_content', 'Mobile Title', 'cjbl-settings', 'cjbl-instructions-image', 'textarea' );


        // IMPORT SETTINGS //
        // ADD-SECTION: POSTS SETTINGS / cjbl-posts
        add_settings_section(
            'cjbl-posts',
            'Posts',
            array( $this, 'renderPostsSettings' ),
            'cjbl-import-settings'
        );

/*        add_settings_field(
            'cjbl-posts-post-title-2-teams',
            'Post Title for 2 Teams',
            array( $this, 'renderPostTitle2Teams' ),
            'cjbl-import-settings',
            'cjbl-posts'
        );*/

        add_settings_field(
            'cjbl-posts-post-title-1-team',
            'Post Title',
            array( $this, 'renderPostTitle' ),
            'cjbl-import-settings',
            'cjbl-posts'
        );

        add_settings_field(
            'cjbl-posts-post-author',
            'Post Author',
            array( $this, 'renderPostAuthor' ),
            'cjbl-import-settings',
            'cjbl-posts'
        );

        // ADD SECTION SPORT TYPES
        add_settings_section(
            'cjbl-import-settings',
            'Sport Types Categories',
            array( $this, 'renderImportSettingsSection' ),
            'cjbl-import-settings'
        );

        $get_categories = get_terms( array( 'taxonomy' => array( CJBL::$taxonomy ), 'parent' => 0, 'hide_empty=0' ) );

        if ( count( $get_categories ) != 0 ) {
            foreach ( $get_categories as $key => $value ) {
                add_settings_field(
                    $value->taxonomy . '_' . $value->term_id,
                    get_term_meta( $value->term_id, 'cj_real_sport_name', true ),
                    function( $args ) {

                        echo '<input id="cjbl-import-settings-' . $args[term_id] . '" name="cjbl_import[term_id_' . $args[term_id] . ']" placeholder="Leave empty to use default" class="regular-text code" type="text"
                           value="' . CJBL::get_import_option('term_id_' . $args[term_id]) . '"/><input name="cjbl_import[term_id_' . $args[term_id] . '_order]" type="number" placeholder="Order" value="' . CJBL::get_import_option('term_id_' . $args[term_id] . '_order') . '"></input>';
                    },
                    'cjbl-import-settings',
                    'cjbl-import-settings',
                    $args = array(
                        'term_id' => $value->term_id,
                    )
                );

                // CREATE LEAGUE TO APPEAR OR NOT
                foreach ( get_term_children( $value->term_id, CJBL::$taxonomy ) as $child ) {
                    $child_term = get_term_by( 'id', $child, CJBL::$taxonomy );
                    $this->add_field( 'hide_term_' . $child_term->term_id, $child_term->name, 'cjbl-import-settings', 'cjbl-import-settings', 'checkbox', false, 'check to hide this league in <strong>' . $value->name . '</strong> sport type' );
                }
            }
        }


        // Register settings
        register_setting( 'cjbl-explanation-image', 'cjbl' );
        register_setting( 'cjbl-import-settings', 'cjbl_import',  array( $this, 'sanitizeImportSettings' ) );
        register_setting( 'cjbl-settings', 'cjbl' );

    }

    /**
     * Wrapper method for add_settings_field function
     *
     * @param $name
     * @param $title
     * @param $page
     * @param string $section
     * @param string $type
     * @param array $select_data
     * @param bool $description
     * @param string $class
     */
    private function add_field( $name, $title, $page, $section = 'default', $type = 'text', $select_data = array( ), $description = false,  $class = 'regular-text' ) {
        // GENERAL SECTION # FIELD
        add_settings_field(
            'cjbl-' . $section . '-' . $name,
            $title,
            array( $this, 'renderField' ),
            $page,
            $section,
            $args = array(
                'section'  => $section,
                'name'  => $name,
                'title' => $title,
                'type'  => $type,
                'class' => $class,
                'description' => $description,
                'data' => $select_data,
            )
        );
    }

    /**
     * Renders the correct field with the data from $this->add_field()
     *
     * @param $args
     */
    public function renderField( $args ) {
        // IF TEXTAREA
        if ( $args['type'] == 'textarea' ) : ?>
            <textarea id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>" name="cjbl[<?php echo $args['name'] ?>]" cols="50" class="<?php echo $args['class'] ?> code "><?php echo CJBL::get_option( $args['name'] ) ?: CJBL::get_option( $args['name'] ) ?></textarea>

        <?php
        // IF SELECT BOX
        elseif ( $args['type'] == 'select' ) : ?>

            <select id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>" name="cjbl[<?php echo $args['name'] ?>]" class="<?php echo $args['class'] ?> code ">
                <option></option>
                <?php foreach( $args['data'] as $key => $value ) : ?>
                    <option value="<?php echo $key ?>" <?php selected( $key, CJBL::get_option( $args['name'] ), true) ?>><?php echo $value ?></option>
                <?php endforeach; ?>
            </select>

        <?php
        // IF FILE
        elseif ( $args['type'] == 'image' ) : ?>

            <?php if ( $img = CJBL::get_option( $args['name'] ) ) :
                $img_src = wp_get_attachment_thumb_url( $img );
            else :
                $img_src = '';
            endif; ?>

            <div class="cjbl-image-upload-btn" data-connected-to="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>">
                <img src="<?php echo $img_src ?>" id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>-img" width="150" height="150" />
            </div>
            <input id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>-id" name="cjbl[<?php echo $args['name'] ?>]" class="<?php echo $args['class'] ?> code " type="hidden"
                   value="<?php echo $img ?>"/>
        <?php
        // IF CHECKBOX OR RADIO BUTTON
        elseif ( $args['type'] == 'checkbox' || $args['type'] == 'radio' ) : ?>

            <?php if ( $args['section'] == 'cjbl-import-settings' ) : ?>
                <?php $settings = CJBL::get_import_option( $args['name'] ); // import settings ?>
                <?php $name = "cjbl_import[{$args['name']}]"; ?>
            <?php else : ?>
                <?php $settings = CJBL::get_option( $args['name'] ); // normal settings ?>
                <?php $name = "cjbl[{$args['name']}]"; ?>
            <?php endif; ?>

            <input id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>" name="<?php echo $name ?>" class="<?php echo $args['class'] ?> code " type="<?php echo $args['type'] ?>"
            value="1" <?php checked( $settings, 1, true ) ?>/>

        <?php
        // IF TYPE - ELSE
        else : ?>
            <?php if ( $args['section'] == 'cjbl-import-settings' ) : ?>
                <?php echo $args['section'] ?>
                <?php $settings = CJBL::get_import_option( $args['name'] ); // import settings ?>
                <?php $name = "cjbl_import[{$args['name']}]"; ?>
            <?php else : ?>
                <?php $settings = CJBL::get_option( $args['name'] ); // normal settings ?>
                <?php $name = "cjbl[{$args['name']}]"; ?>
            <?php endif; ?>

            <input id="cjbl-<?php echo $args['section'] ?>-<?php echo $args['name'] ?>" name="<?php echo $name ?>" class="<?php echo $args['class'] ?> code " type="<?php echo $args['type'] ?>"
                   value="<?php echo $settings ?>"/>

        <?php endif; ?>

        <?php if ( $args['description'] ) : ?>
            <p class="description"><?php echo $args['description'] ?></p>
        <?php endif;
    }

    public function renderSettings() {
        ?>
        <div class="wrap" id="cjbl-admin-page">
            <h2>General Settings <span class="cjbl-small-header"><?php echo CJBL_PLUGIN_REAL_NAME ?></span></h2>
            <form action="options.php" method="POST">
                <?php settings_fields( 'cjbl-settings' ); ?>
                <?php do_settings_sections( 'cjbl-settings' ); ?>

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function renderGeneralSection() {
        // general settings
    }

    public function renderXmlUrl() {
        ?>
        <input id="cjbl-settings-xml-url" name="cjbl[xml_url]" class="regular-text code" type="text"
               value="<?php echo CJBL::get_option( 'xml_url' ) ?>"/>
        <p class="description" id="admin-email-description">Insert the bet 365 xml url for exporting livestream
            games.</p>
        <?php
    }

    public function renderAjaxGetLivestream() {
        ?>
        <input type="button" id="cjbl-get-new-games" class="button button-primary" value="Import Streams">
        <div class="spinner"></div>
        <div id="cjbl-get-new-games-description"></div>
        <?php
    }

    public function renderPostsSettings() {
        // post settings
    }

    public function renderImportSettingsSection() {
        $get_categories = get_terms( CJBL::$taxonomy , 'hide_empty=0');

        if ( count( $get_categories ) == 0 ) {
            echo 'Categories not exist';
        }
    }

/*    public function renderPostTitle2Teams() {
        ?><!--
        <input id="cjbl-settings-post-title-2-teams" name="cjbl_import[post_title_2_teams]" class="regular-text code" type="text"
               value="<?php /*echo
               CJBL::get_import_option( 'post_title_2_teams', '{team1} v {team2} : Online Live Streaming video [HD] {date}' ); ?>"/>
        <p class="description">
            Can be used to change the default title of the single live streams post that contain 2 teams - no backwards compatibility
        </p>
        <ul>
            <li>{team1} - First opponent</li>
            <li>{team2} - Second opponent</li>
            <li>{date} - Time and date</li>
        </ul>
        --><?php
    }*/

    public function renderPostTitle() {
        ?>
        <input id="cjbl-settings-post-title" name="cjbl_import[post_title]" class="regular-text code" type="text"
               value="<?php echo
               CJBL::get_import_option( 'post_title', '{opponent} : Online Live Streaming video [HD] {date}' ); ?>"/>
        <p class="description">
            Can be used to change the default title of the single live streams imported post that contain 1 opponent - no backwards compatibility
        </p>
        <ul>
            <li>{opponent} - Opponent(s)</li>
            <li>{competition} - League</li>
            <li>{date} - Time and date</li>
        </ul>
        <?php
    }

    public function renderPostAuthor() { ?>
        <select id="cjbl-settings-post-author" name="cjbl_import[post_author]">
            <option></option>
            <?php foreach ( get_users() as $user ) : ?>
                <option value="<?php echo $user->ID ?>" <?php selected( $user->ID, CJBL::get_import_option( 'post_author' ), true ) ?>><?php echo $user->display_name ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function renderContentUnderHeader() {
        $content = CJBL::get_option( 'under-header-content' );
        echo wp_editor( $content, 'cjbl-under-header-content', array( 'textarea_name' => 'cjbl[under-header-content]' ) );
    }

    public function renderContentUnderCategory() {
        $content = CJBL::get_option( 'under-header-content-category' );
        echo wp_editor( $content, 'under-header-content-category', array( 'textarea_name' => 'cjbl[under-header-content-category]' ) );
    }

    public function renderContentUnderLivestream() {
        $content = CJBL::get_option( 'under-livestream-content' );
        echo wp_editor( $content, 'cjbl-under-livestream-content', array( 'textarea_name' => 'cjbl[under-livestream-content]' ) );
    }

    public function renderImportSettings() {
        ?>
        <div class="wrap" id="cjbl-admin-page">
            <h2>Import Settings <span class="cjbl-small-header"><?php echo CJBL_PLUGIN_REAL_NAME ?></span></h2>

            <form action="options.php" method="POST">
                <?php settings_fields( 'cjbl-import-settings' ); ?>
                <?php do_settings_sections( 'cjbl-import-settings' ); ?>

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function renderImportedStreams() {
        $streams = get_posts( array(
                'post_type'      => CJBL::$post_type,
                'posts_per_page' => -1,
                'order_by'       => 'post_modified'
            )
        );
        ?>
        <div class="wrap" id="cjbl-logs">
            <h2>Imported Streams <span class="cjbl-small-header"><?php echo CJBL_PLUGIN_REAL_NAME ?></span></h2>
            <table class="widefat fixed">
                <thead>
                <tr>
                    <th id="cjbl-time" class="manage-column" style="width: 5%" scope="col">ID</th>
                    <th id="cjbl-action" class="manage-column" scope="col" style="30%">Title</th>
                    <th id="cjbl-description" class="manage-column" scope="col" style="width: 51%">Attributes</th>
                    <th id="cjbl-file-line" class="manage-column" scope="col" style="width: 10%">Created Time</th>
                    <th id="cjbl-file-line" class="manage-column" scope="col" style="width: 4%;">Link</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ( $streams as $post ) :
                    ?>
                    <tr class="<?php echo $i % 2 ?: 'alternate';
                    $i ++ ?>">
                        <td class="cb"><?php echo $post->ID ?></td>
                        <td><?php echo $post->post_title ?></td>
                        <td><?php echo get_post_meta($post->ID, 'attributes', true); ?></td>
                        <td><?php echo $post->post_date ?></td>
                        <td><?php echo '<a href="' . get_permalink( $post->ID ) . '" target="_blank">Go!</a>'; ?></td>
                    </tr>
                    <?php
                endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function sanitizeImportSettings( $data )
    {
        CJBL::add_log('something', json_encode( $data ));
        foreach ( $data as $key => $value ) {
            $value = trim( $value );
            if ( strpos( $key, 'term_id_' ) !== false && $value != '' ) {
                $field = explode( '_', $key );
                $term_id = $field[2];

                if ( count( $field ) == 3 ) {
                    $slug = CJBL::$sport_type_prefix . strtolower( str_replace( ' ', '-', $value ) );
                    wp_update_term( $term_id, CJBL::$taxonomy, array(
                        'slug' => $slug,
                        'name' => $value
                    ));

                    CJBL::add_log( 'data updated for term id: ' . $term_id, 'Slug to: ' . $slug . ' Fake Name to: ' . $value );
                } else if ( count ( $field ) == 4 && is_numeric( $value )) {
                    update_term_meta( $term_id, 'cjbl_order', $value );

                    CJBL::add_log( 'order changed', 'term id: ' . $term_id . ' order: ' . $value );
                }
            }
        }
        return $data;
    }

    public function renderLogs() {
        $logs = CJBL::get_logs();
        ?>
        <div class="wrap" id="cjbl-logs">
            <h2>Logs <span class="cjbl-small-header"><?php echo CJBL_PLUGIN_REAL_NAME ?></span></h2>
            <table class="widefat fixed">
                <thead>
                <tr>
                    <th id="cjbl-time" class="manage-column" scope="col">Time</th>
                    <th id="cjbl-action" class="manage-column" scope="col">Action</th>
                    <th id="cjbl-description" class="manage-column" scope="col">Description</th>
                    <th id="cjbl-file-line" class="manage-column" scope="col">File (line)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ( $logs as $value ) :
                    ?>
                    <tr class="<?php echo $i % 2 ?: 'alternate';
                    $i ++ ?>">
                        <td><?php echo date( 'd/m/Y h:i:s', $value['time'] ) ?></td>
                        <td><span><?php echo $value['action'] ?></span></td>
                        <td><?php echo $value['description'] ?></td>
                        <td><?php echo $value['file'] ?></td>
                    </tr>
                    <?php if ( $i >= 100 ) {
                    break;
                } endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}