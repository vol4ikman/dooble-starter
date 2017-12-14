<?php

/*****************************************
**  Languages
*****************************************/
add_action( 'after_setup_theme' , 'qstheme_textdomain' );
add_filter( 'body_class' , 'add_body_class' );

// Add Theme Stylesheet To ADMIN
add_action( 'admin_enqueue_scripts', 'qs_admin_theme_styles' );
function qs_admin_theme_styles(){
    wp_register_style( 'admin-style', THEME . '/admin/css/style.css', array(), NULL, 'all' );
    wp_enqueue_style( 'admin-style' );
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
			'container'       => ''
		)
	);
}

// Remove Actions
remove_action( 'wp_head' , 'feed_links_extra' , 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head' , 'feed_links' , 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head' , 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head' , 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head' , 'index_rel_link' ); // Index link
remove_action( 'wp_head' , 'parent_post_rel_link' , 10, 0); // Prev link
remove_action( 'wp_head' , 'start_post_rel_link' , 10, 0); // Start link
remove_action( 'wp_head' , 'adjacent_posts_rel_link' , 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head' , 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head' , 'start_post_rel_link' , 10, 0);
remove_action( 'wp_head' , 'adjacent_posts_rel_link_wp_head' , 10, 0);
remove_action( 'wp_head' , 'rel_canonical' );
remove_action( 'wp_head' , 'wp_shortlink_wp_head' , 10, 0);
// Add Filters
add_filter( 'widget_text' , 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text' , 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'the_excerpt' , 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt' , 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' ); // Remove thumbnail src set for responsive images
// Remove Filters
remove_filter( 'the_excerpt' , 'wpautop' ); // Remove <p> tags from Excerpt altogether
