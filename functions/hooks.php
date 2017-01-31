<?php
// ENV: dev or production
define('ENV', 'dev');

// Load styles
function qs_theme_styles(){
    wp_register_style('foundation', FOUNDATION . '/css/foundation.css', array(), NULL, 'all'); wp_enqueue_style('foundation');
    wp_register_style('assets', THEME . '/build/css/assets.min.css', array(), NULL, 'all'); wp_enqueue_style('assets');

    if(ENV == 'dev'){
        wp_register_style('main-style', THEME . '/build/css/main-style.css', array(), NULL, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', THEME . '/build/css/responsive.css', array(), NULL, 'all'); wp_enqueue_style('responsive');
	wp_register_style('main-style-rtl', THEME . '/build/css/main-style-rtl.css', array(), NULL, 'all'); wp_enqueue_style('main-style-rtl');
    } else {
        wp_register_style('main-style', THEME . '/build/css/main-style.min.css', array(), NULL, 'all'); wp_enqueue_style('main-style');
        wp_register_style('responsive', THEME . '/build/css/responsive.min.css', array(), NULL, 'all'); wp_enqueue_style('responsive');
	wp_register_style('main-style-rtl', THEME . '/build/css/main-style-rtl.min.css', array(), NULL, 'all'); wp_enqueue_style('main-style-rtl');
    }
}
add_action('wp_enqueue_scripts', 'qs_theme_styles');

// Load scripts
function qs_theme_scripts() {
	wp_register_script( 'assets', THEME . '/build/js/assets.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'assets' );
    if(ENV == 'dev'){
        wp_register_script( 'scripts', THEME . '/build/js/scripts.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'scripts' );
    } else {
        wp_register_script( 'scripts', THEME . '/build/js/scripts.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'scripts' );
    }	
}
add_action( 'wp_enqueue_scripts', 'qs_theme_scripts' );

if ( ! function_exists( 'add_body_class' ) ){
    function add_body_class( $classes ) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if( $is_lynx ) $classes[] = 'lynx';
        elseif( $is_gecko ) $classes[] = 'gecko';
        elseif( $is_opera ) $classes[] = 'opera';
        elseif( $is_NS4 ) $classes[] = 'ns4';
        elseif( $is_safari ) $classes[] = 'safari';
        elseif( $is_chrome ) $classes[] = 'chrome';
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
        return $classes;
    }
    add_filter( 'body_class','add_body_class' );
}
// Add Theme Stylesheet To ADMIN
add_action('admin_enqueue_scripts', 'qs_admin_theme_styles');
function qs_admin_theme_styles(){
    wp_register_style('admin-style', THEME . '/admin/css/style.css', array(), NULL, 'all'); wp_enqueue_style('admin-style');
}


// Register THEME Navigation
add_action('init', 'register_theme_menus');
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
		)
	);
}

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
