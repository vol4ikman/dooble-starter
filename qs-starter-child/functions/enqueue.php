<?php
define( 'QS_PARENT', get_stylesheet_directory_uri() );
define( 'QS_CHILD', get_stylesheet_directory_uri() );

// Load styles
function qs_theme_styles(){
    if(ENV == 'dev'){
        // parents styles
        wp_register_style('assets', QS_PARENT . '/build/css/assets.min.css', array(), THEME_VER, 'all'); wp_enqueue_style('assets');
        wp_register_style('main-style', QS_PARENT . '/build/css/main-style.css', array(), THEME_VER, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', QS_PARENT . '/build/css/responsive.css', array(), THEME_VER, 'all'); wp_enqueue_style('responsive');
        // child styles
        wp_register_style('main-style-child', QS_CHILD . '/build/css/main-style-child.css', array(), THEME_VER, 'all'); wp_enqueue_style('main-style-child');
        wp_register_style('responsive-child', QS_CHILD . '/build/css/responsive-child.css', array(), THEME_VER, 'all'); wp_enqueue_style('responsive-child');
    } else {
        wp_register_style('production', QS_PARENT . '/build/css/production.min.css', array(), THEME_VER, 'all'); wp_enqueue_style('production');
        wp_register_style('production-child', QS_CHILD . '/build/css/production-child.min.css', array(), THEME_VER, 'all'); wp_enqueue_style('production-child');
    }
}

// Load scripts
function qs_theme_scripts() {

    if(ENV == 'dev'){
        wp_register_script( 'assets', QS_PARENT . '/build/js/assets.min.js', array( 'jquery' ), THEME_VER, true );
        wp_register_script( 'scripts', QS_PARENT . '/build/js/scripts.js', array( 'jquery' ), THEME_VER, true );
        wp_register_script( 'scripts-child', QS_CHILD . '/build/js/scripts-child.js', array( 'jquery' ), THEME_VER, true );

        wp_enqueue_script( 'assets' );
        wp_enqueue_script( 'scripts' );

        $site_settings = array(
        	'home_url'  => get_home_url(),
        	'theme_url' => THEME
        );
        wp_localize_script( 'scripts-child', 'site_settings_child', $site_settings );
        wp_enqueue_script( 'scripts-child' );

    } else {
        wp_register_script( 'production', QS_PARENT . '/build/js/production.min.js', array( 'jquery' ), THEME_VER, true );
        wp_enqueue_script( 'production' );
        wp_register_script( 'production-child', QS_CHILD . '/build/js/production-child.min.js', array( 'jquery' ), THEME_VER, true );
        wp_enqueue_script( 'production-child' );
    }

    wp_register_script( 'ajax_custom_script', QS_CHILD . '/build/js/ajax.js', array( 'scripts' ) , THEME_VER, true );
    wp_localize_script( 'ajax_custom_script', 'ajaxurl', admin_url( 'admin-ajax.php' ));
    wp_enqueue_script( 'ajax_custom_script' );
}
