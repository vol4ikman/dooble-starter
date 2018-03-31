<?php
/**
 * Main admin class
 */
class QS_theme_admin{
    /**
     * The main constructor
     */
    public function __construct(){
        //load admin dependencies
        $this->load_dependencies();
        //load admin options pages
        $this->acf_add_admin_pages();
        //load admin hooks
        $this->init_admin_hooks();
        //load all files under post-types directory
        $this->autoload_post_types_files();
        //init post types
        $this->init_post_type();
    }
    /**
     * Iint the theme relevant post types
     * @return [type] [description]
     */
    public function init_post_type(){
        QS_post_type_book::init();
        QS_post_type_customer::init();
    }
    /**
     * Scan post types folder and create the post types
     * @return [type] [description]
     */
    public function autoload_post_types_files(){
        spl_autoload_register( function( $class_name ) {
        	/**
        	 * Note that actual usage may require some string operations to specify the filename
        	 */
        	$file_name = $class_name . '.php';
        	if( file_exists( $file_name ) ) {
        		require $file_name;
        	}
        } );

        $path = TEMPLATEPATH . "/admin/classes/post-types/";

        $files = scandir( $path );

        if( $files ){
            foreach ( $files as $filename ){
                if( $filename == '.' || $filename == '..' ) continue;

                include $path.$filename;
            }
        }
    }
    /**
     * Dependency files that are required for the admin
     * @return [type] [description]
     */
    public function load_dependencies(){

        get_template_part( 'admin/tgm/class-tgm-plugin-activation' );

        get_template_part( 'admin/classes/class-admin-notices' );

        get_template_part( 'admin/classes/class-general-post-type');

        get_template_part( 'admin/classes/class-post-type' );
    }
    /**
     * Register wodrpress admin hooks
     * @return [type] [description]
     */
    public function init_admin_hooks(){
        // ACF settings
        add_filter( 'acf/settings/save_json' , array( $this , 'qs_theme_acf_json_save_point' ) );
        add_filter( 'acf/settings/load_json' , array( $this , 'qs_theme_acf_json_load_point' ) );
        // Add Theme Stylesheet To ADMIN
        add_action( 'admin_enqueue_scripts', 'QS_theme_enqueue::qs_admin_theme_styles' );

        add_action( 'tgmpa_register', 'QS_theme_admin::register_required_plugins' );
    }
    /**
     * Tell acf to save all json files to specific directory
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    function qs_theme_acf_json_save_point( $path ) {
        // update path
        $path = get_stylesheet_directory() . '/admin/fields';
        // return
        return $path;

    }
    /**
     * Tell acf to load all json files from a specific directory
     * @param  [type] $paths [description]
     * @return [type]        [description]
     */
    function qs_theme_acf_json_load_point( $paths ) {
        // remove original path (optional)
        unset($paths[0]);
        // append path
        $paths[] = get_stylesheet_directory() . '/admin/fields';
        // return
        return $paths;

    }
    /**
     * Add options pages to the admin panel
     */
    public function acf_add_admin_pages(){
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' 	=> 'Site Settings',
                'menu_title'	=> 'Site Settings',
                'menu_slug' 	=> 'theme-general-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ));

            get_template_part("admin/functions/acf-options-import");

            // acf_add_options_sub_page(array(
            //     'page_title' 	=> 'Header Settings',
            //     'menu_title'	=> 'Header',
            //     'parent_slug'	=> 'theme-general-settings',
            // ));
            //
        }
    }

    /**
     * Registers required theme plugins
     * @return [type] [description]
     */
    public static function register_required_plugins() {
    	$plugins = array(

    		array(
    			'name'               => 'Advanced custom fields Pro', // The plugin name.
    			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
    			'source'             => get_template_directory() . '/functions/tgm/plugins/advanced-custom-fields-pro.zip', // The plugin source.
    			'required'           => true,
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
    	);

    	tgmpa( $plugins, $config );
    }

}
