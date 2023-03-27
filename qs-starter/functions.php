<?php
/**
 * Main theme functions
 *
 * @package WordPress
 */

add_filter('doing_it_wrong_trigger_error', function () {return false;}, 10, 0);

get_template_part( 'functions/theme-dependencies' );

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}
if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support.
	add_theme_support( 'menus' );
	// Add Thumbnail Theme Support.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 1000, '', true );
	add_image_size( 'medium', 450, '', true );
	add_image_size( 'small', 250, '', true );
	// Theme Support fot yoast.
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'gallery', 'script', 'style' ) );

}

// Remove default galleries css style.
add_filter( 'use_default_gallery_style', '__return_false' );

// Remove admin bar.
// add_filter('show_admin_bar', '__return_false');.

/**
 * Remove admin dashboard widgets
 *
 * @return void
 */
function remove_dashboard_meta() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); // Removes the 'incoming links' widget.
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); // Removes the 'plugins' widget.
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); // Removes the 'WordPress News' widget.
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' ); // Removes the secondary widget.
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Removes the 'Quick Draft' widget.
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); // Removes the 'Recent Drafts' widget.
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Removes the 'Activity' widget.
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // Removes the 'At a Glance' widget.
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // Removes the 'Activity' widget (since 3.8).
	remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
}
add_action( 'admin_init', 'remove_dashboard_meta' );

add_action( 'wp_dashboard_setup', 'dooble_dashboard_widgets' );
/**
 * Dooble_dashboard_widgets
 */
function dooble_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget( 'custom_help_widget', 'דובל פתרונות דיגיטליים', 'dooble_dashboard_help' );
}
/**
 * Dooble_dashboard_help description]
 *
 * @return [type] [description]
 */
function dooble_dashboard_help() {
	echo '<p style="text-align:center;"><a href="https://www.dooble.co.il/" target="_blank"><img src="' . THEME . '/images/dooble-logo.jpg" /></a></p>';
	echo '<p style="text-align:center;">שירות לקוחות ותמיכה טכנית: 072-2788660</p>';
}
