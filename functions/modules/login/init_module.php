<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Login module
 *
 * Create an option to embed login form functionality via shortcode/template/function call.
 *
 * @class       QS_login_module
 * @version     1.0.0
 * @package     QS_Modules/Login
 * @author      QS
 */

class QSloginModule extends QSmoduleBase{

    /**
     * The main class constructor
     * Get dependencies
     * check dependencies
     * init the class
     */
    public function __construct( $dirname ){

        $this->_set( 'dirname' , $dirname );

        $this->_set( 'module_base_url' , QS_MODULES_URL . '/' . $dirname  );

        $this->_set( 'dirname' , $dirname );

        $this->get_module_dependencies();

        $this->dependncy_load_and_check();

        if( $this->_get( 'is_active' ) ){
            $this->init();
        }

    }
    /**
     * If all dependencies exists start the process
     * @return [type] [description]
     */
    public function init(){


    }
    /**
     * Load scripts and style for admin use (optional)
     * These are called from the parent class
     * @return [type] [description]
     */
    public function load_admin_scripts(){

    }
    /**
     * Load scripts and style for public use (optional)
     * These are called from the parent class
     * @return [type] [description]
     */
    public function load_public_scripts(){
        wp_register_style( $this->_get( 'dirname' ) , $this->get( 'module_base_url' ) . '/css/module-style.min.css', false, '1.0.0' );
        wp_enqueue_style( $this->_get( 'dirname' )  );

        wp_register_script( $this->_get( 'dirname' ) , $this->get( 'module_base_url' ) . '/js/module_script.js', false, '1.0.0' );
        wp_enqueue_script( $this->_get( 'dirname' )  );
    }
    /**
     * Define the dependencies required for this plugin
     * @return [type] [description]
     */
    function get_module_dependencies(){

        $this->dependencies = array(
            'module_helpers' => array(
                'type' => 'class',
                'name' => 'QSloginModuleHelper',
                'file' => 'module_helpers.php'
            )
        );

    }

}
