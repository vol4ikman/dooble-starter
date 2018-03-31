<?php

/**
 * QSmoduleBase
 *
 * The base class for qs modules.
 *
 * @class       QSmoduleBase
 * @version     1.0.0
 * @package     QSmoduleBase
 * @author      QS
 */
abstract class QSmoduleBase
{
    /**
     * Is the module active
     * @var [type]
     */
    private $is_active;

    /**
     * Basename of the module directory
     * @var [type]
     */
    private $dirname;
    /**
     * Module CSS Path
     * @var [type]
     */
    private $css_url;
    /**
     * Module Javscript path
     * @var [type]
     */
    private $js_url;

    /**
     * The complete module path
     * @var [type]
     */
    private $module_path;

    /**
     * Module base path
     * @var [type]
     */
    private $module_base_path;
    /**
     * Holds the args that will be transferred to the template view
     * @var [type]
     */
    private $view_args;
    /**
     * The main constructor function
     * @var [type]
     */
    abstract function __construct( $dirname );

    /**
     * The main init function
     * @var [type]
     */
    abstract function init();

    /**
     * Definses the files that must be loaded in order to use the modyule
     * @var [type]
     */
    abstract function get_module_dependencies();

    /**
     * Loads scripts meant for admin panel usage
     * @var [type]
     */
    abstract function load_admin_scripts();

    /**
     * Loads scripts meant for frontend usage
     * @var [type]
     */
    abstract function load_public_scripts();

    /**
     * The main view , this function will retrive the main module view
     * @var [type]
     */
    public function view( $view_args = array() ){

        $this->_set( 'view_args' , $view_args );

        $this->qs_get_module_template( 'tpl-base' );

    }

    /**
     * Check if all dependencies are installed - this function will be called on each module
     * @var [type]
     */
    function dependncy_load_and_check(){

        $this->define();

        $this->load_dependencies();

        $dep_check = $this->check_dependencies();

        if( ! is_wp_error( $dep_check ) ){
            $this->_set( 'is_active' , true );
        }else{
            $this->_set( 'is_active' , false );
            // TODO: add error admin notice
        }

        $this->set_global_hooks();

    }
    function define(){

        $this->_set( 'module_base_url' , QS_MODULES_URL . '/' . $this->dirname  );

        $this->_set( 'css_url' , QS_MODULES_URL . "/" . $this->dirname . '/assets/css/');

        $this->_set( 'js_url' , QS_MODULES_URL . "/" . $this->dirname . '/assets/js/');

        $this->_set( 'module_path' , QS_MODULES . "/" . $this->dirname . '/' );

        $this->_set( 'module_base_path' , "functions/modules/" . $this->dirname . '/' );


    }
    /**
     * Check that the module dependencies are all loaded
     * @return [type] [description]
     */
    public function check_dependencies(){

        if( isset( $this->dependencies ) && $this->dependencies ){

            foreach( $this->dependencies as $dependency ){

                if( $dependency['type'] == 'function' && ! function_exists( $dependency['name'] ) ){
                    return new WP_Error( 'function not exists' , $dependency['name'] );
                }

                if( $dependency['type'] == 'class' && ! class_exists( $dependency['name'] ) ){
                    return new WP_Error( 'class not exists' , $dependency['name'] );
                }

            }
        }

        return true;

    }

    /**
     * Load all the dependencies
     * @return [type] [description]
     */
    public function load_dependencies(){

        if( isset( $this->dependencies ) && $this->dependencies ){

            foreach( $this->dependencies as $dependency ){
                if( isset( $dependency['file'] ) ){
                    require_once( QS_MODULES . '/' . $this->dirname . '/' . $dependency['file'] );
                }
            }
        }

    }
    /**
     * Set hooks that are loaded for each module (these are must use scripts and styles)
     */
    public function set_global_hooks(){

        add_action( 'admin_enqueue_scripts', array( $this , 'load_admin_scripts' ) );

        add_action( 'enqueue_scripts', array( $this , 'load_public_scripts' ) );

    }
    /**
     * Get a property
     * @param  [string] $name [the name of the requested propery]
     * @return [any]       [the property value]
     */
    public function _get( $name ){
        return $this->$name;
    }

    /**
     * Set a property
     * @param [string] $name  [the name of the requested propery]
     * @param [any] $value [the new value to set]
     */
    public function _set( $name , $value ){
        $this->$name = $value;
    }

    /**
     * Get template part function that will get the required templates files
     * @param  [string] $slug [the file slug]
     * @param  string $name [the name of the tempate]
     * @version     1.0
     */

    function qs_get_module_template( $slug , $name = '' ) {
        $template = '';

        if ( $name  ) {
            $template = locate_template( array( "{$slug}-{$name}.php", "{$slug}-{$name}.php" ) );
        }

        if ( ! $template && $name && file_exists( TEMPLATEPATH . "/view/module-themes/{$slug}-{$name}.php" ) ) {
            $template = "/view/module-themes/{$slug}-{$name}.php";
        }

        if ( ! $template && ! $name && file_exists( TEMPLATEPATH  . "/view/module-themes/" . $this->dirname . "/{$slug}.php" ) ) {
            $template = TEMPLATEPATH . "/view/module-themes/" . $this->dirname . "/{$slug}.php";
        }

        if ( ! $template && $name && file_exists( $this->module_base_path . "templates/{$slug}-{$name}.php" ) ) {
            $template = $this->module_base_path . "/templates/{$slug}-{$name}.php";
        }


        if ( ! $template ) {
            $template = locate_template( array( "{$slug}.php", "{$slug}.php" ) );
        }

        if ( ! $template ) {
            $template = locate_template( array( $this->module_base_path . "templates/{$slug}.php" ) );
        }

        $template = apply_filters( 'qs_get_module_template', $template, $slug, $name );

        if ( $template ) {
            include( $template );
        }
    }
}
