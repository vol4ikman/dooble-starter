<?php
/**
 * Theme dependencies
 *
 * @package WordPress
 */

get_template_part( 'functions/define' );
get_template_part( 'functions/enqueue' );
get_template_part( 'functions/hooks' );
get_template_part( 'functions/ajax' );
get_template_part( 'functions/helpers' );
get_template_part( 'functions/tgm' );

// CF7 Cities list tag.
// get_template_part( 'functions/cf7-cities' );.

get_template_part( 'functions/classes/class.admin-notices' );
get_template_part( 'functions/classes/class.base-module' );
get_template_part( 'functions/classes/class.base-module-helper' );

// Modules.
get_template_part( 'functions/modules/init' );

// Plugins.
// get_template_part('admin/plugins/user-switching/user-switching');.

if ( class_exists( 'WooCommerce' ) ) {
	get_template_part( 'functions/woocommerce' );
}

if ( defined( 'QS_API_ENDPOINT' ) && QS_API_ENDPOINT ) { // <==== currently on beta stage
	get_template_part( 'functions/qs_api_endpoint' );
}

get_template_part( 'admin/options' );
get_template_part( 'admin/types' );
get_template_part( 'admin/classes/class-logger' );
