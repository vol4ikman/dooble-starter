<?php
/*********************
** Helper functions
**********************/

//ACF Google API
function get_google_api_key(){
    $google_api_key = get_field('google_api_key','option');
    return $google_api_key;
}
function google_api_acf_init() {
	acf_update_setting('google_api_key', get_google_api_key());
}
add_action('acf/init', 'google_api_acf_init');

/** GLOBAL header scripts **/
add_action('wp_head', 'qs_add_header_scripts');
function qs_add_header_scripts(){
    $header_scripts = get_field('qs_header_scripts','option');
    $page_header_scripts = get_field('page_header_scripts');

    if( $header_scripts ) {
        echo $header_scripts;
    }
    if( $page_header_scripts ){
        echo $page_header_scripts;
    }

}
/** Global Footer scripts **/
add_action('wp_footer', 'qs_add_footer_scripts', 100);
function qs_add_footer_scripts(){
    $footer_scripts = get_field('qs_footer_scripts','option');
    $page_footer_scripts = get_field('page_footer_scripts');

    if( $footer_scripts ) {
        echo $footer_scripts;
    }
    if( $page_footer_scripts ){
        echo $page_footer_scripts;
    }
}
