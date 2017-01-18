<?php
/**
* add_frontend_ajax_javascript_file()
* Enqueue Ajax Scripts
* @return
*/
add_action( 'wp_enqueue_scripts', 'add_frontend_ajax_javascript_file' );
function add_frontend_ajax_javascript_file() {
    wp_enqueue_script( 'ajax_custom_script', THEME . '/assets/js/ajax.js', array('jquery') );
    wp_localize_script( 'ajax_custom_script', 'ajaxurl', admin_url( 'admin-ajax.php' ));
}
