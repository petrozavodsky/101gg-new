<?php
/**
 * Created by CODEJA.
 * User: kirillrocks
 * Date: 30-Jan-17
 * Time: 16:21
 */

add_action( 'widgets_init', 'cjbl_register_widget' );
function cjbl_register_widget() {
    register_widget( 'CJBL_Widget' );
}
