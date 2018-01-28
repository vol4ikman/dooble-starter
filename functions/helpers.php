<?php
/*********************
** Helper functions
**********************/

//ACF Google API
function get_google_api_key(){
    if( function_exists( 'get_field' ) ){
        $google_api_key = get_field('google_api_key','option');

        return $google_api_key;
    }

}
function google_api_acf_init() {
	acf_update_setting('google_api_key', get_google_api_key());
}

/** GLOBAL header scripts **/

function qs_add_header_scripts(){
    if( function_exists( 'get_field' ) ){
        $header_scripts = get_field('qs_header_scripts','option');
        $page_header_scripts = get_field('page_header_scripts');

        if( $header_scripts ) {
            echo $header_scripts;
        }
        if( $page_header_scripts ){
            echo $page_header_scripts;
        }
    }
}
/** Global Footer scripts **/

function qs_add_footer_scripts(){
    if( function_exists( 'get_field' ) ){
        $footer_scripts = get_field('qs_footer_scripts','option');
        $page_footer_scripts = get_field('page_footer_scripts');

        if( $footer_scripts ) {
            echo $footer_scripts;
        }
        if( $page_footer_scripts ){
            echo $page_footer_scripts;
        }
    }
}
function qstheme_textdomain(){
    load_theme_textdomain('qstheme', THEME . '/languages');
}

if ( ! function_exists( 'add_body_class' ) ){
    function add_body_class( $classes ) {        
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $is_winIE, $is_edge;
        if( $is_lynx ) $classes[] = 'lynx';
        elseif( $is_gecko ) $classes[] = 'firefox-gecko';
        elseif( $is_opera ) $classes[] = 'opera';
        elseif( $is_NS4 ) $classes[] = 'ns4';
        elseif( $is_safari ) $classes[] = 'safari';
        elseif( $is_chrome ) $classes[] = 'chrome';
	elseif( $is_edge ) $classes[] = 'ms-edge';
        elseif( $is_winIE ) $classes[] = 'ms-winIE';	    
        elseif( $is_IE ) {
            $classes[] = 'ie';
            if( preg_match( '/MSIE ( [0-11]+ )( [a-zA-Z0-9.]+ )/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) )
            $classes[] = 'ie' . $browser_version[1];
        } else $classes[] = 'unknown';
        if( $is_iphone ) $classes[] = 'iphone';

        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
        }
        if (defined('LANG')){
            $classes[] = 'lang-'.LANG;
        }
        if (defined('ENV')){
            $classes[] = 'env-'.ENV;
        }
	if ( class_exists( 'WooCommerce' ) ) {
	    $classes[] = 'woo-is-on';
	}
        return $classes;
    }

}
function qs_admin_theme_styles(){
    wp_register_style( 'admin-style', THEME . '/admin/css/style.css', array(), NULL, 'all' );
    wp_enqueue_style( 'admin-style' );
}
function register_theme_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'qstheme'), // Main Navigation
    ));
}

//Header menu
function header_menu() {
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu',
			'menu_class'      => 'header_menu_class',
			'container'       => ''
		)
	);
}
