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

 /*   $newsletter_files = fopen( get_template_directory() . "/newsletter-emails.txt", "a+" );
    while( !feof($newsletter_files) ) {
        if ( strpos( fgets($newsletter_files), $email ) !== false ) {
            echo 2; // EMAIL EXISTS
            exit;
        }
    }
    fwrite( $newsletter_files, $email . PHP_EOL );
    fclose( $newsletter_files );*/


get_header();
?>

    <style>
        .error-page {
            text-align: center;
            margin: 0 -15px;
            position: relative;
        }


        h1.error-title {
            font-size: 76px;
            font-family: 'Squada One', Arial, sans-serif;
            margin: 0;
        }

        h3.error-subtitle {
            font-size: 32px;
            text-transform: uppercase;
            font-family: 'Squada One', Arial, sans-serif;
            margin: 0;
        }

        .error-image {
            width: auto;
            height: 700px;
            position: relative;
        }

        .error-image img {
            max-height: 100%;
            position: absolute;
            right: 0;
        }



        .error-buttons {
            position: absolute;
            bottom: 30px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .error-buttons > div {
            margin: 8px 0;
        }

        .error-buttons > div > a, .error-buttons > div > span {
            font-size: 34px;
            font-family: 'Squada One', Arial, sans-serif;
            font-weight: 300;
            text-transform: uppercase;
        }

        .error-buttons > div > a:hover {
            text-decoration: none;
        }

        .error-buttons .error-take-me-out a, .error-buttons .error-lucky a {
            padding: 8px 32px;
            border-radius: 3px;
            background: #eeaa0e;
            border-bottom: #af8309 5px solid;
            box-shadow: 4px 3px 20px 2px rgba(0,0,0,0.3);
        }

        .footer-wrapper {
            margin-top: 0;
        }

        @media screen and (max-width: 1281px) {
            .error-image {
                height: auto;
            }

            .error-image img {
                max-height: 100%;
                position: relative;
            }
        }

        @media screen and (max-width: 830px) {
            .error-page {
                position: inherit;
            }

            h1.error-title {
                font-size: 30px;
                font-family: 'Squada One', Arial, sans-serif;
                margin: 0;
            }

            h3.error-subtitle {
                font-size: 20px;
            }

            .error-buttons {
                position: fixed;
                left: 0;
                -webkit-transform: inherit;
                -moz-transform: inherit;
                -ms-transform: inherit;
                -o-transform: inherit;
                transform: inherit;
                bottom: 0;
                width: 100%;
                z-index: 10;
            }

            .error-buttons > div {
                margin: 0;
            }

            .error-buttons .error-take-me-out a {
                padding: 8px 0;
                width: 100%;
                display: block;
                border-radius: 0;
            }

            .error-buttons .error-lucky, .error-buttons .error-button {
                display: none;
            }
        }
    </style>

    <div class="error-page">
        <div class="error-header">
            <h1 class="error-title">Uh Oh 404!</h1>
            <h3 class="error-subtitle">Looks like the wrong place at the wrong time</h3>
        </div>
        <div class="error-image">
            <img src="<?php echo get_template_directory_uri() . '/images/404.png'?>">
        </div>
        <div class="error-buttons">
            <div class="error-take-me-out"><a href="<?php echo home_url('/') ?>">take me to the homepage</a></div>
            <div class="error-button"><span>or</span></div>
            <div class="error-lucky"><a href="<?php echo get_permalink(get_last_video_post()) ?>">i'm feeling lucky</a></div>
        </div>
    </div>

<?php
get_footer();