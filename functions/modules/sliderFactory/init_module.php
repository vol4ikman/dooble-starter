<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Slick Slider Factory module
 *
 * Create an option to embed slider form functionality via shortcode/template/function call.
 *
 * @class       QS_Slider_Factory
 * @version     1.0.0
 * @package     QS_Modules/Slider
 * @author      QS
 */

class QSSliderFactoryModule extends QSmoduleBase{

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
     * If all dependencies exists start the process - Get All Slider Classes
     * @return [type] [description]
     */
    public function init(){
        include( 'class.slider.php');
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
        wp_register_style( 'slick-style' , $this->_get( 'css_url' ) . '/slick.css', false, '1.8.0' );
        wp_enqueue_style( 'slick-style' );

        wp_register_style( $this->_get( 'dirname' ) , $this->_get( 'css_url' ) . '/module-style.min.css', false, '1.0.0' );
        wp_enqueue_style( $this->_get( 'dirname' )  );

        wp_register_script( 'slick-script' , $this->_get( 'js_url' ). '/slick.min.js', array( 'jquery' ) , '1.8.0'  , true );
        wp_enqueue_script(  'slick-script' );

        wp_register_script( $this->_get( 'dirname' ) , $this->_get( 'js_url' ) . '/module_script.js', array( 'jquery' ), '1.0.0' , true);
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
                'name' => 'QSSliderFactoryModuleHelper',
                'file' => 'module_helpers.php'
            ),
            'controller' => array(
                'type' => 'class',
                'name' => 'QSSliderFactoryController',
                'file' => 'controller.php'
            ),
            'acf' => array(
                'type' => 'function',
                'name' => 'get_field'
            )
        );

    }

    /**
     * Save slide to slider lists ( check all instances )
     * @method save_slider
     * @param  [type]      $slider [ Slider Instance - QSSliderModule object ]
     */
    private function save_slider( $slider ){
        $sliders = $this->_get( 'sliders' );

        if( empty( $sliders ) ){
            $sliders = array();
        }
        $sliders[] = $slider;

        $this->_set( 'sliders' , $sliders );
    }

    /**
     * Create new slider instance ( QSSliderModule object )
     * @method new_slider
     * @return [type]     [ QSSliderModule object ]
     */
    public function new_slider(){
        $slider = new QSSliderModule( $this->_get( 'dirname') );
        $this->save_slider( $slider );
        return $slider;
    }

}
