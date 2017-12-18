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
    private $is_active;

    private $dirname;

    private $css_path;

    private $js_path;
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
     * Check if all dependencies are installed
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
        }

        $this->set_global_hooks();

    }
    function define(){
        $this->css_path = QS_MODULES_URL . "/" . $this->_get( 'dirname' ) . '/assets/css/';

        $this->js_path = QS_MODULES_URL . "/" . $this->_get( 'dirname' ) . '/assets/js/';
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
                    require_once( QS_MODULES . '/' . $this->_get( 'dirname' ) . '/' . $dependency['file'] );
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

}
