<?php
// get_template_directory_uri - parent
// get_stylesheet_directory_uri - child
add_action('wp_enqueue_scripts', 'qstheme_styles_child');
add_action( 'wp_enqueue_scripts', 'qstheme_scripts_child' );

// Load styles
if( ! function_exists('qstheme_styles_child') ){
    function qstheme_styles_child(){
        // parents styles
        wp_register_style('assets', get_template_directory_uri() . '/build/css/assets.min.css', array(), NULL, 'all'); wp_enqueue_style('assets');
        wp_register_style('main-style', get_template_directory_uri() . '/build/css/main-style.css', array(), NULL, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', get_template_directory_uri() . '/build/css/responsive.css', array(), NULL, 'all'); wp_enqueue_style('responsive');
        // child styles
        wp_register_style('main-style-child', get_stylesheet_directory_uri() . '/build/css/main-style-child.css', array(), NULL, 'all'); wp_enqueue_style('main-style-child');
        wp_register_style('responsive-child', get_stylesheet_directory_uri() . '/build/css/responsive-child.css', array(), NULL, 'all'); wp_enqueue_style('responsive-child');
    }
}



// Load scripts
if( ! function_exists('qstheme_scripts_child') ){
    function qstheme_scripts_child() {

        wp_register_script( 'assets', get_template_directory_uri() . '/build/js/assets.min.js', array( 'jquery' ), NULL, true );
        wp_register_script( 'scripts', get_template_directory_uri() . '/build/js/scripts.js', array( 'jquery' ), NULL, true );
        wp_register_script( 'scripts-child', get_stylesheet_directory_uri() . '/build/js/scripts-child.js', array( 'jquery' ), NULL, true );

        wp_enqueue_script( 'assets' );
        wp_enqueue_script( 'scripts' );

        $site_settings = array(
            'home_url'  => get_home_url(),
            'theme_url' => THEME
        );
        wp_localize_script( 'scripts-child', 'site_settings_child', $site_settings );
        wp_enqueue_script( 'scripts-child' );

        wp_register_script( 'ajax_custom_script_child', get_stylesheet_directory_uri() . '/build/js/ajax.js', array( 'scripts' ) , NULL, true );
        wp_localize_script( 'ajax_custom_script_child', 'ajaxurl', admin_url( 'admin-ajax.php' ));
        wp_enqueue_script( 'ajax_custom_script_child' );
    }
}
