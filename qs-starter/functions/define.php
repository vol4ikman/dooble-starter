<?php
/**
 * Define theme vars
 *
 * @package WordPress
 */

define( 'THEME_VER', 11.2022 );
define( 'ENV', 'dev' );

if ( ! defined( 'THEME' ) ) {
	define( 'THEME', get_template_directory_uri() );
}
if ( ! defined( 'CHILD_THEME' ) ) {
	define( 'CHILD_THEME', get_stylesheet_directory_uri() );
}
define( 'CSS_INC', THEME . '/build/css/' );
define( 'JS_INC', THEME . '/build/js/' );
define( 'CSS_ASSETS_INC', THEME . '/assets/css/' );
define( 'JS_ASSETS_INC', THEME . '/assets/js/' );


// if wpml.
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
	define( 'LANG', ICL_LANGUAGE_CODE );
} else {
	define( 'LANG', 'he' );
}

if ( is_rtl() ) {
	define( 'FLOAT', 'right' );
	define( 'FOUNDATION', THEME . '/assets/foundation-6.2.1-rtl' );
} else {
	define( 'FLOAT', 'left' );
	define( 'FOUNDATION', THEME . '/assets/foundation-6.2.1-ltr' );
}
define( 'QS_API_ENDPOINT', false );
define( 'QS_MODULES', get_template_directory() . '/functions/modules' );
define( 'QS_CLASSES', get_template_directory() . '/functions/classes' );
define( 'QS_MODULES_URL', THEME . '/functions/modules' );
define( 'QS_CLASSES_URL', THEME . '/functions/classes' );
