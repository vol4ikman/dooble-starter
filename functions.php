<?php 	
/*****************************************
**  Languages
*****************************************/
add_action('after_setup_theme', 'qstheme_textdomain');
function qstheme_textdomain(){
    load_theme_textdomain('qstheme', THEME . '/languages');
}
/*****************************************
**  Includes
****************************************/
get_template_part("functions/define");
get_template_part("functions/enqueue");
get_template_part("functions/hooks");
get_template_part("functions/functions");
get_template_part("functions/ajax");
get_template_part("functions/helpers");
get_template_part("functions/tgm");

get_template_part("admin/options");
get_template_part("admin/types");
/*****************************************
**  Global
*****************************************/
if (!isset($content_width)) {
    $content_width = 1024;
}
if (function_exists('add_theme_support')){
    // Add Menu Support
    add_theme_support('menus');
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 1000, '', true);
    add_image_size('medium', 450, '', true);
    add_image_size('small', 250, '', true);
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    // Enable support for wp galleries with figure tag
    add_theme_support( 'html5', array( 'gallery' ) );
    
}

// Remove default galleries css style
add_filter( 'use_default_gallery_style', '__return_false' );
