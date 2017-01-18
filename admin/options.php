<?php
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    // acf_add_options_sub_page(array(
    //     'page_title' 	=> 'Header Settings',
    //     'menu_title'	=> 'Header',
    //     'parent_slug'	=> 'theme-general-settings',
    // ));

}
?>
