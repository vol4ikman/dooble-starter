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
	wp_register_style( 'main-style', THEME . '/assets/scss/main-style.css', array(), THEME_VER, 'all' );
	wp_register_style( 'responsive', THEME . '/assets/scss/responsive.css', array(), THEME_VER, 'all' );
	// Accessibility style.
	wp_register_style( 'a11y', THEME . '/assets/scss/a11y.css', array(), THEME_VER, 'all' );

	wp_enqueue_style( 'main-style' );
	wp_enqueue_style( 'responsive' );
	wp_enqueue_style( 'a11y' );
}
/**
 * Load scripts
 */
function qs_theme_scripts() {
	// Move jquery to footer.
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array(), THEME_VER, array(
        'in_footer' => true,
    ) );
	wp_enqueue_script( 'jquery' );

	wp_register_script( 'scripts', THEME . '/assets/js/scripts.js', array( 'jquery' ), THEME_VER, array(
        'in_footer' => true,
        'strategy'  => 'defer',
    ) );
	wp_register_script( 'a11y', THEME . '/assets/js/a11y.js', array( 'jquery' ), THEME_VER, array(
        'in_footer' => true,
        'strategy'  => 'defer',
    ) );

	wp_enqueue_script( 'assets' );

	$site_settings = array(
		'home_url'  => get_home_url(),
		'theme_url' => THEME,
		'ajaxurl'   => admin_url( 'admin-ajax.php' ),
		'dev'       => 'dooble',
	);
	wp_localize_script( 'scripts', 'site_settings', $site_settings );

	wp_enqueue_script( 'scripts' );
	wp_enqueue_script( 'a11y' );

	wp_register_script( 'ajax_custom_script', THEME . '/assets/js/ajax.js', array( 'scripts' ), THEME_VER, true );
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
