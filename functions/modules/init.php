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
        //'login' => array(),
        'sliderFactory' => array(),
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

/**
 * if module exist return module
 * if $save is true ( by default ) save the instance in query_var;
 * @method qs_get_module_instance
 * @param  [type]                 $module_name [ string of the module name ]
 * @param  boolean                $save        [ save in query_var or not - default : true ]
 * @return [type]                              [the module instance ]
 */
function qs_get_module_instance( $module_name , $save = true ){
    if( $save && ! empty( $module = get_query_var( $module_name ) ) ){
        return $module;
    } else{
        if( $module = qs_get_active_module( $module_name ) ){
            if( $save ){
                set_query_var( $module_name , $module );
            }
            return $module;
        }
    }
}
