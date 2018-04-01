<?php
/**
 * Enqueue theme scripts and style both admin and front end
 */
class QS_theme_enqueue{
    /**
     * Enqueue admin styles
     * @return [type] [description]
     */
    public static function qs_admin_theme_styles(){
        wp_register_style( 'admin-style', THEME . '/admin/css/style.css', array(), NULL, 'all' );
        wp_enqueue_style( 'admin-style' );
    }
    /**
     * Adds cross site header scripts
     */
    public static function qs_add_header_scripts(){
        if( function_exists( 'get_field' ) ){
            $header_scripts      = get_field('qs_header_scripts','option');
            $page_header_scripts = get_field('page_header_scripts');

            if( $header_scripts ) {
                echo $header_scripts;
            }
            if( $page_header_scripts ){
                echo $page_header_scripts;
            }
        }
    }
    /**
     * Adds cross site footer scripts
     */
    public static function qs_add_footer_scripts(){
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
    // Load styles
    public static function qs_theme_styles(){
        if(ENV == 'dev'){

            wp_register_style('assets', CSS_INC . 'assets.min.css', array(), THEME_VER, 'all');
            wp_register_style('main-style', CSS_INC . 'main-style.css', array(), THEME_VER, 'all');
            wp_register_style('responsive', CSS_INC . 'responsive.css', array(), THEME_VER, 'all');

            wp_enqueue_style('assets');
            wp_enqueue_style('main-style');
            wp_enqueue_style('responsive');

        } else {

            wp_register_style('production', CSS_INC . 'production.min.css', array(), THEME_VER, 'all');

            wp_enqueue_style('production');
        }
    }
    // Load scripts
    public static function qs_theme_scripts() {
        // Move jquery to footer
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', includes_url('js/jquery/jquery.js'), array(), THEME_VER, true );


        if(ENV == 'dev'){
            wp_register_script( 'assets', JS_INC . 'assets.min.js', array( 'jquery' ), THEME_VER, true );
            wp_register_script( 'scripts', JS_INC . 'scripts.js', array( 'jquery' ), THEME_VER, true );

            wp_enqueue_script( 'assets' );

            $site_settings = array(
            	'home_url'  => get_home_url(),
            	'theme_url' => THEME
            );

            wp_localize_script( 'scripts', 'site_settings', $site_settings );
            wp_enqueue_script( 'scripts' );

        } else {
            wp_register_script( 'production', JS_INC . 'production.min.js', array( 'jquery' ), THEME_VER, true );

            wp_enqueue_script( 'production' );
        }

        wp_enqueue_script( 'jquery' );

        wp_register_script( 'ajax_custom_script', THEME . '/build/js/ajax.js', array( 'scripts' ) , THEME_VER, true );
        wp_localize_script( 'ajax_custom_script', 'ajaxurl', admin_url( 'admin-ajax.php' ));
        wp_enqueue_script( 'ajax_custom_script' );
    }
}
