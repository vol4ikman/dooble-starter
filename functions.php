<?php
/*****************************************
**  Define
*****************************************/
if( !defined('THEME') ){
define("THEME", get_template_directory_uri());
} 
//if wpml
// define("LANG",ICL_LANGUAGE_CODE);
define("LANG", "he");
if(is_rtl()){
define("FLOAT", 'right');
define("FOUNDATION", THEME.'/assets/foundation-6.2.1-rtl');
}
else{
define("FLOAT", 'left');
define("FOUNDATION", THEME.'/assets/foundation-6.2.1-ltr');
}
if( !defined('TEMPLATEPATH') ) {
define( 'TEMPLATEPATH', get_template_directory() );    
}   	
/*****************************************
**  Languages
*****************************************/
add_action('after_setup_theme', 'qstheme_textdomain');
function qstheme_textdomain(){
    load_theme_textdomain('qstheme', THEME . '/languages');
}
/*****************************************
**  Includes
****************************************/
get_template_part("admin/options");
get_template_part("admin/types");
get_template_part("functions/hooks");
get_template_part("functions/functions");
get_template_part("functions/front-ajax");
get_template_part("functions/helpers");
get_template_part("functions/tgm");
/*****************************************
**  Global
*****************************************/
if (!isset($content_width)) {
    $content_width = 1024;
}
if (function_exists('add_theme_support')){
    // Add Menu Support
    add_theme_support('menus');
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1000, '', true);
    add_image_size('medium', 450, '', true);
    add_image_size('small', 250, '', true);
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
}
/**********************
    ACF Google API
**********************/
function get_google_api_key(){
    $google_api_key = get_field('google_api_key','option');
    return $google_api_key;
}
function google_api_acf_init() {
acf_update_setting('google_api_key', get_google_api_key());
}
add_action('acf/init', 'google_api_acf_init');
