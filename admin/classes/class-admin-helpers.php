<?php

class QS_theme_admin{
    public function __construct(){

        $this->acf_add_admin_pages();

        $this->init_admin_hooks();
        
    }

    /**
     * Register wodrpress admin hooks
     * @return [type] [description]
     */
    public function init_admin_hooks(){
        add_filter('acf/settings/save_json', 'qs_theme_acf_json_save_point');
        add_filter('acf/settings/load_json', 'qs_theme_acf_json_load_point');
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
}
