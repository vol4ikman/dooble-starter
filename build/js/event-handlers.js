/**
 * Global variables
 */
jQuery(document).ready(function(){
    // main menu wrapper selector = wrap_main_menu
    jQuery('.wrap_main_menu nav ul li.menu-item-has-children a').on('focusin', methods.accessibility_show_sub_menu.bind(this) );
    // jump to next parent menu item
    jQuery('body').on('focusout','ul li.menu-item-has-children.hover ul li:last-child a', methods.accessibility_exit_sub_menu.bind(this) );

    jQuery('.header').click( methods.do_something.bind(this) );
});
