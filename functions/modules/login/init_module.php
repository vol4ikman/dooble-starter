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

    public function get_login_args(){

        $this->_set('login_form_defaults' , array(
        	'echo'           => true,
        	'remember'       => true,
        	'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        	'form_id'        => 'loginform',
        	'id_username'    => 'user_login',
        	'id_password'    => 'user_pass',
        	'id_remember'    => 'rememberme',
        	'id_submit'      => 'wp-submit',
        	'label_username' => __( 'Username or Email Address' ),
        	'label_password' => __( 'Password' ),
        	'label_remember' => __( 'Remember Me' ),
        	'label_log_in'   => __( 'Log In' ),
        	'value_username' => '',
        	'value_remember' => false,
            'use_ajax'       => false
            )
        );

        return array_merge( $this->_get( 'login_form_defaults' ) , $this->_get( 'view_args' )['login_args'] );
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
            ),
            'controller' => array(
                'type' => 'class',
                'name' => 'QSloginController',
                'file' => 'controller.php'
            ),
            'acf' => array(
                'type' => 'function',
                'name' => 'get_field'
            )
        );

    }

}
