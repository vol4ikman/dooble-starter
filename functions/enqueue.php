<?php
// Load styles
function qs_theme_styles(){
    if(ENV == 'dev'){
        wp_register_style('assets', CSS_INC . 'assets.min.css', array(), NULL, 'all'); wp_enqueue_style('assets');
        wp_register_style('main-style', CSS_INC . 'main-style.css', array(), NULL, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', CSS_INC . 'responsive.css', array(), NULL, 'all'); wp_enqueue_style('responsive');
    } else {
        wp_register_style('production', CSS_INC . 'production.min.css', array(), NULL, 'all'); wp_enqueue_style('production');
    }
}
add_action('wp_enqueue_scripts', 'qs_theme_styles');

// Load scripts
function qs_theme_scripts() {
    if(ENV == 'dev'){
        wp_register_script( 'assets', JS_INC . 'assets.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'assets' );
        wp_register_script( 'scripts', JS_INC . 'scripts.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'scripts' );
    } else {
        wp_register_script( 'production', JS_INC . 'production.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'production' );
    }
}
add_action( 'wp_enqueue_scripts', 'qs_theme_scripts' );
