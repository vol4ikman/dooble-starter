<?php
/**
 * Load theme styles and scripts
 *
 * @package WordPress
 */

/**
 * Load styles
 */
function qs_theme_styles() {
	if ( 'dev' === ENV ) {
		wp_register_style( 'assets', CSS_INC . 'assets.min.css', array(), THEME_VER, 'all' );
		wp_enqueue_style( 'assets' );
		wp_register_style( 'main-style', CSS_INC . 'main-style.css', array(), THEME_VER, 'all' );
		wp_enqueue_style( 'main-style' );
		wp_register_style( 'responsive', CSS_INC . 'responsive.css', array(), THEME_VER, 'all' );
		wp_enqueue_style( 'responsive' );
		// Accessibility style.
		wp_register_style( 'a11y', CSS_INC . 'a11y.css', array(), THEME_VER, 'all' );
		wp_enqueue_style( 'a11y' );
	} else {
		wp_register_style( 'production', CSS_INC . 'production.min.css', array(), THEME_VER, 'all' );
		wp_enqueue_style( 'production' );
	}
}
/**
 * Load scripts
 */
function qs_theme_scripts() {
	// Move jquery to footer.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array(), THEME_VER, true );
	wp_enqueue_script( 'jquery' );

	if ( 'dev' === ENV ) {
		wp_register_script( 'assets', JS_INC . 'assets.min.js', array( 'jquery' ), THEME_VER, true );
		wp_register_script( 'scripts', JS_INC . 'scripts.js', array( 'jquery' ), THEME_VER, true );
		wp_register_script( 'a11y', JS_INC . 'a11y.js', array( 'jquery' ), THEME_VER, true );

		wp_enqueue_script( 'assets' );

		$site_settings = array(
			'home_url'  => get_home_url(),
			'theme_url' => THEME,
		);
		wp_localize_script( 'scripts', 'site_settings', $site_settings );

		wp_enqueue_script( 'scripts' );
		p_enqueue_script( 'a11y' );

	} else {
		wp_register_script( 'production', JS_INC . 'production.min.js', array( 'jquery' ), THEME_VER, true );
		wp_enqueue_script( 'production' );
	}

	wp_register_script( 'ajax_custom_script', THEME . '/build/js/ajax.js', array( 'scripts' ), THEME_VER, true );
	wp_localize_script( 'ajax_custom_script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	wp_enqueue_script( 'ajax_custom_script' );
}
/**
 * Load custom admin styles
 */
function qs_load_custom_admin_style() {
	wp_register_style( 'qs-admin-style', get_template_directory_uri() . '/admin/css/admin-style.css', false, '1.0.0' );
	wp_register_script( 'qs-admin-script', get_template_directory_uri() . '/admin/js/admin-script.js', array( 'jquery' ), THEME_VER, true );

	wp_enqueue_style( 'qs-admin-style' );
	wp_enqueue_script( 'qs-admin-script' );
}
