<?php
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Site Settings',
        'menu_title'	=> 'Site Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    get_template_part("admin/acf-options-import");

    // acf_add_options_sub_page(array(
    //     'page_title' 	=> 'Header Settings',
    //     'menu_title'	=> 'Header',
    //     'parent_slug'	=> 'theme-general-settings',
    // ));

}
?>
