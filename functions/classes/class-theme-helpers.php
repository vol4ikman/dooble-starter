<?php
/**
 * This file contains all the theme general helper function_exists
 * It will consist static functions for general use
 */

Class QS_theme_helpers{
    /**
     * Adds various classes to the HTML body
     * @param [type] $classes [description]
     */
    public static function add_body_class( $classes ) {
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
    /**
     * Add google api key
     * @return [type] [description]
     */
    public static function google_api_acf_init() {
    	acf_update_setting('google_api_key', get_google_api_key());
    }

    /**
     * Creates header menu
     * @return [type] [description]
     */
    public static function header_menu() {
    	wp_nav_menu(
    		array(
    			'theme_location'  => 'header-menu',
    			'menu_class'      => 'header_menu_class',
    			'container'       => ''
    		)
    	);
    }
}
