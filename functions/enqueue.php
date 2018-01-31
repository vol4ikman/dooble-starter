<?php

// Load styles
function qs_theme_styles(){
    if(ENV == 'dev'){
        wp_register_style('assets', CSS_INC . 'assets.min.css', array(), THEME_VER, 'all'); wp_enqueue_style('assets');
        wp_register_style('main-style', CSS_INC . 'main-style.css', array(), THEME_VER, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', CSS_INC . 'responsive.css', array(), THEME_VER, 'all'); wp_enqueue_style('responsive');
    } else {
        wp_register_style('production', CSS_INC . 'production.min.css', array(), THEME_VER, 'all'); wp_enqueue_style('production');
    }
}


// Load scripts
function qs_theme_scripts() {
    // Move jquery to footer
    wp_deregister_script('jquery');
    wp_register_script( 'jquery', includes_url('js/jquery/jquery.js'), array(), THEME_VER, true ); wp_enqueue_script( 'jquery' );

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

    wp_register_script( 'ajax_custom_script', THEME . '/build/js/ajax.js', array( 'scripts' ) , THEME_VER, true );
    wp_localize_script( 'ajax_custom_script', 'ajaxurl', admin_url( 'admin-ajax.php' ));
    wp_enqueue_script( 'ajax_custom_script' );
}
