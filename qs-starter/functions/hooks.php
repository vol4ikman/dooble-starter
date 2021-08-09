<?php
/**
 * Theme HOOKS
 *
 * @package WordPress
 */

add_action( 'after_setup_theme', 'qstheme_textdomain' );
add_filter( 'body_class', 'add_body_class' );

// Rest Api.
// add_action( 'rest_api_init', 'disabled_rest_api_init' );.
// add_action( 'rest_authentication_errors', 'disabled_rest_api', 0 );.

add_action( 'acf/init', 'google_api_acf_init' );
add_action( 'wp_head', 'qs_add_header_scripts' );
add_action( 'wp_footer', 'qs_add_footer_scripts', 100 );
// Add Theme Stylesheet To ADMIN.
add_action( 'admin_enqueue_scripts', 'qs_load_custom_admin_style' );
// Register THEME Navigation.
add_action( 'init', 'register_theme_menus' );

// Remove Actions.
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds.
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed.
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link.
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link.
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Prev link.
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version.
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Add Filters.
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar.
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!).
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only).
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only).
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' ); // Remove thumbnail src set for responsive images.
// Remove Filters.
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether.

add_action( 'wp_enqueue_scripts', 'qs_theme_styles' );
add_action( 'wp_enqueue_scripts', 'qs_theme_scripts' );

// HTML Email.
add_filter( 'wp_mail_content_type', 'qsemail_set_content_type' );

// add_filter( 'wpcf7_validate_tel*', 'custom_tel_confirmation_validation_filter', 20, 2 );.

add_filter(
	'jpeg_quality',
	function( $arg ) {
		return 100;
	}
);

add_filter(
	'doing_it_wrong_trigger_error',
	function () {
		return false;
	},
	10,
	0
);
