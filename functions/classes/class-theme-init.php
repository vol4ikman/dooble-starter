<?php

class QS_theme_init{
    /**
	 * WipiChildLoader constructor.
	 */
	public function __construct() {
		$this->load_dependencies();

		$admin = new QS_theme_admin();

		$this->init_hooks();

        if ( class_exists( 'WooCommerce' ) ) {
            $woocommerce_init = new QS_theme_woocommerce();
        }

	}

	/**
	 * Load file dependencies
	 */
	protected function load_dependencies() {
        /**
         * General theme defintions and variables
         * @var [type]
         */
        get_template_part( 'functions/definitions' );
		get_template_part( 'functions/functions' );
		get_template_part( 'admin/classes/class-admin-init' );
        get_template_part( 'functions/classes/class-theme-ajax' );
        get_template_part( 'functions/classes/class-theme-enqueue' );
        get_template_part( 'functions/classes/class-theme-helpers' );
        get_template_part( 'functions/classes/class-theme-api' );
        get_template_part( 'functions/classes/class-theme-woocommerce' );

        get_template_part( 'functions/classes/class.admin-notices' );
        get_template_part( 'functions/classes/class.base-module' );
        get_template_part( 'functions/classes/class.base-module-helper' );

        get_template_part( 'functions/modules/init' );


        if ( defined( 'QS_API_ENDPOINT' ) && QS_API_ENDPOINT ){ // <==== currently on beta stage
            get_template_part( 'functions/classes/class-theme-rest-api' );
        }

        get_template_part( 'admin/options' );
        get_template_part( 'admin/types' );

	}
    /**
     * Register templates textdomain
     * @return [type] [description]
     */
    public function qstheme_textdomain(){

		//wp-content/languages/theme-name/it_IT.mo
		load_theme_textdomain( 'qstheme', trailingslashit( WP_LANG_DIR ) . 'themes/' . get_template() );

		//wp-content/themes/child-theme-name/languages/it_IT.mo
		load_theme_textdomain( 'qstheme', get_stylesheet_directory() . '/languages' );

		//wp-content/themes/theme-name/languages/it_IT.mo
		load_theme_textdomain( 'qstheme', get_template_directory() . '/languages' );

    }


	/**
	 * Initialize WordPress globl hooks
	 */
	protected function init_hooks() {
		global $content_width;

		if ( ! $content_width ) {
	        $content_width = 1024;
	    }
        //register theme textdomain
        add_action( 'after_setup_theme' , array( $this , 'qstheme_textdomain' ) );
        //register theme scripts and styles
        add_action( 'wp_head', 'QS_theme_enqueue::qs_add_header_scripts' );
        add_action( 'wp_footer', 'QS_theme_enqueue::qs_add_footer_scripts' , 100);
        add_action( 'wp_enqueue_scripts', 'QS_theme_enqueue::qs_theme_styles');
        add_action( 'wp_enqueue_scripts', 'QS_theme_enqueue::qs_theme_scripts' );
        add_filter( 'body_class' , 'QS_theme_helpers::add_body_class' );
        //add google api key for acf
        add_action( 'acf/init', 'QS_theme_helpers::google_api_acf_init' );

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
        // Remove default galleries css style
        add_filter( 'use_default_gallery_style', '__return_false' );
        // Remove admin bar
        //add_filter('show_admin_bar', '__return_false');
	}

    /**
     * Adds general theme support
     */
    function add_theme_support(){
        // Add Menu Support
        add_theme_support( 'menus' );
        add_image_size( 'large', 1000, '', true );
        add_image_size( 'medium', 450, '', true );
        add_image_size( 'small', 250, '', true );

        // Enable support for wp galleries with figure tag
        add_theme_support( 'html5' , array( 'gallery' ) );

		// RSS feed links support
		add_theme_support('automatic-feed-links');

		// Title tag support
		add_theme_support('title-tag');

		// Post thumbnail support
		add_theme_support('post-thumbnails');

		// WooCommerce support
		add_theme_support('woocommerce');

		// Custom Logo
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 170,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description', 'fl-logo-text' ),
		) );

		// Nav menus
		register_nav_menus(array(
            'header-menu' => __('Header Menu', 'qstheme'), // Main Navigation
        ));
    }
}
