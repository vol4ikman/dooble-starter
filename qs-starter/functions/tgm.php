<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Gulp Starter
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/functions/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'gulp_starter_register_required_plugins' );

function gulp_starter_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'Advanced custom fields Pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/functions/tgm/plugins/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true,
		),
		// wp-rocket
		array(
			'name'               => 'Wp Rocket', // The plugin name.
			'slug'               => 'wp-rocket', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/functions/tgm/plugins/wp-rocket.zip', // The plugin source.
			'required'           => true,
		),
		// wordfence
		array(
			'name'		=> 'Wordfence',
			'slug'		=> 'wordfence',	// The plugin slug (typically the folder name)
			'required'	=> true
		),
		array(
			'name'		=> 'Markup (JSON-LD) structured in schema.org',
			'slug'		=> 'wp-structuring-markup',	// The plugin slug (typically the folder name)
			'required'	=> true
		),
		array(
			'name'		=> 'ACF User Role Field Setting',
			'slug'		=> 'user-role-field-setting-for-acf',	// The plugin slug (typically the folder name)
			'required'	=> false
		),
		array(
			'name'	   => 'Contact Form 7',
			'slug'	   => 'contact-form-7',
			'required' => true,
		),
		array(
			'name'	   => 'Contact Form 7 Database Addon – CFDB7',
			'slug'	   => 'contact-form-cfdb7',
			'required' => true,
		),
		array(
			'name'	   => 'Regenerate Thumbnails',
			'slug'	   => 'regenerate-thumbnails',
			'required' => false,
		),
		array(
			'name'	   => 'Yoast SEO',
			'slug'	   => 'wordpress-seo',
			'required' => false,
		),
		array(
			'name'	   => 'Post Duplicator',
			'slug'	   => 'post-duplicator',
			'required' => false,
		),
		array(
			'name'	   => 'Intuitive Custom Post Order',
			'slug'	   => 'intuitive-custom-post-order',
			'required' => false,
		),
		array(
			'name'	   => 'Post Type Archive Link',
			'slug'	   => 'post-type-archive-links',
			'required' => false,
		),
		array(
			'name'		=> 'ACF Nav Menu',
			'slug'		=> 'advanced-custom-fields-nav-menu-field',
			'required'	=> false
		)

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme' ),
			'menu_title'                      => __( 'Install Plugins', 'theme' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'theme' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'theme' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme' ),
			'dismiss'                         => __( 'Dismiss this notice', 'theme' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'theme' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'theme' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
