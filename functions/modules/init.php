<?php
global $active_modules;

/**
 *
 * DEFINE THE MODULE THAT ARE USED ON THE TEMPLATE
 *
 */
function register_modules(){
    global $active_modules;

    $active_modules = array(
        'login' => array(

        ),
        // 'register' => array(
        //
        // )
    );

    return $active_modules;
}

if( $modules = register_modules() ){

    foreach( $modules as $registered_module_name => $registered_module ){

        get_template_part( "functions/modules/{$registered_module_name}/init_module" );

        $class_name = "QS{$registered_module_name}Module";
        $active_modules[$registered_module_name] = new $class_name( $registered_module_name );

    }

}
/**
 * Check if a module is active
 * @param  [string]  $name [Module name]
 * @return boolean       [description]
 */
function qs_get_active_module( $name ){
    global $active_modules;

    return isset( $active_modules[$name] ) ? $active_modules[$name] : new WP_Error( 'module' , 'module is not active' );
}

/**
 * This function will return the module and will display its HTML
 * @param  [type] $name [description]
 * @return [type]       [description]
 */
function qs_get_module( $name ,$args = array() ){
    if( $module = qs_get_active_module( $name ) ){

        $module->view( $args );

    }
}
