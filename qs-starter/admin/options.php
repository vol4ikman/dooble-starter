<?php
// If Polylang is installed
if( function_exists ( 'pll_the_languages' ) ){
    get_template_part( 'functions/polylang-acf' );
}

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
