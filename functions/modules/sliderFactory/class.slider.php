<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Slick Slider module
 *
 * Create an option to embed slider form functionality via shortcode/template/function call.
 *
 * @class       QS_Slider
 * @version     1.0.0
 * @package     QS_Modules/Slider
 * @author      QS
 */

class QSSliderModule extends QSmoduleBase{

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
     * If all dependencies exists start the process - Create Template With Args
     * @return [type] [description]
     */
    public function init(){
        $this->_set( 'view_args' , array( 'slider_args'=> array() ) ); // Init slider view args with empty array
    }

    public function get_slider_args(){

        $this->_set('slider_args_defaults' , array(
        	'slidesToShow'   => 1,     // # of slides to show
        	'slidesToScroll' => 1,     // # of slides to scroll
            'autoplay'       => true,  // Enables Autoplay
            'autoplaySpeed'  => 3000,  // Autoplay Speed in milliseconds
        	'speed'          => 300,   // Slide/Fade animation speed
            'arrows'         => true,  // Prev/Next Arrows
            'asNavFor'       => '',    // Set the slider to be the navigation of other slider (Class or ID Name)
            'centerMode'     => false, // Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts.
            'centerPadding'  => '50px',// Side padding when in center mode (px or %)
            'dots'           => false, // Show dot indicators
            'fade'           => false, // Enable fade
            'infinite'       => true,  // Infinite loop sliding
        	'swipe'          => true,  // Enable swiping
        	'swipeToSlide'   => false, // Allow users to drag or swipe directly to a slide irrespective of slidesToScroll
        	'touchMove'      => true,  // Enable slide motion with touch
        	'vertical'       => false, // Vertical slide mode
        	'rtl'            => false  // Change the slider's direction to become right-to-left
            )
        );

        return array_merge( $this->_get( 'slider_args_defaults' ) , $this->_get( 'view_args' )['slider_args'] );
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
    }
    /**
     * Define the dependencies required for this plugin
     * @return [type] [description]
     */
    function get_module_dependencies(){

        $this->dependencies = array(
            'slider-factory' => array(
                'type' => 'class',
                'name' => 'QSSliderFactoryModule',
                'file' => 'init_module.php'
            ),
            'acf' => array(
                'type' => 'function',
                'name' => 'get_field'
            )
        );

    }

    /**
     * Change Args After Class Created ( Before Print Slider )
     * @method set_args
     * @param  [type]   $args [description]
     */
    public function set_args( $args ){
        $this->_set( 'view_args' , array( 'slider_args'=> $args ) );
    }

    /**
     * Print data slick args [data-slick] as json ( for slick wrapper )
     * @method print_data_slick_args
     * @return [type]                [description]
     */
    public function print_data_slick_args(){
        $slider_args             = $this->get_slider_args();
        $html_data_args          = array();
        echo json_encode( $slider_args );
    }

    /**
     * Add slide
     * @method add_slide
     * @param  string    $slide_content [ can be string as content or path to template content ]
     * @param  string    $slide_class   [ template args - send this args to the content template ]
     */
    public function add_slide( $slide_content = '' , $template_args = ''){
        // Check if $slide_content is path to template
        if( strpos( $slide_content , '.php' ) !== false ){
            $this->_set( 'template_path' , $slide_content );
            $this->_set( 'template_args' , $template_args );
            ob_start();
                $this->qs_get_module_template( chop( $slide_content , '.php' ) );
            $slide_content = ob_get_clean();
        }

        $this->_set( 'slide_content' , $slide_content );

        ob_start();
            $this->qs_get_module_template( 'slide' );
        $slide = ob_get_clean();

        $this->_set( 'slide_content' , '' );
        $this->_set( 'template_path' , '' );
        $this->_set( 'template_args' , '' );

        $this->save_slide( $slide );
    }

    /**
     * Save slide instance
     * @method save_slide
     * @param  [type]     $slide [ slide data ]
     */
    private function save_slide( $slide ){
        $slides = $this->_get( 'slides' );

        if( empty( $slides ) ){
            $slides = array();
        }
        $slides[] = $slide;

        $this->_set( 'slides' , $slides );
    }
    /**
     * Get all slides
     * @method get_slides
     * @return [type]     [array of slides]
     */
    public function get_slides(){
        return $this->_get( 'slides' );
    }
    /**
     * Print all slides
     * @method print_slides
     * @return [type]       [print slieds html]
     */
    public function print_slides(){
        echo implode( '' , $this->get_slides() );
    }

    /**
     * Get Slider html
     * @method get_slider
     * @param  array      $args [slick slider args]
     * @return [type]           [slider html]
     */
    public function get_slider( $args = array() , $template_name = '' ){
        $this->_set( 'view_args' , array('slider_args' => $args ) );
        $this->set_slider_template_base_name( $template_name );
        ob_start();
            $this->qs_get_module_template( $this->get_slider_template_base_name() );
        return ob_get_clean();
    }
    /**
     * Print slider html
     * @method print_slider
     * @param  array        $args [slick slider args]
     * @param  string       $template_name [slick slider args]
     * @return [type]             [print slider html]
     */
    public function print_slider( $args = array() , $template_name = '' ){
        echo $this->get_slider( $args , $template_name );
    }
    /**
     * Set base slider template ( instand of defualt - "tpl-base" )
     * @method set_slider_template_base_name
     * @param  [type]              $template_name [description]
     */
    public function set_slider_template_base_name( $template_name ){
        if( ! empty( $template_name ) ){
            $this->_set( 'tpl-base' , $template_name );
        }
    }
    /**
     * Get the slider template - if not defined return default ( "tpl-base" )
     * @method get_slider_template_base_name
     * @return [type]              [description]
     */
    private function get_slider_template_base_name(){
        if( empty( $tpl_name = $this->_get( 'tpl-base' ) ) ){
            $tpl_name = 'tpl-base';
        }
        return $tpl_name;
    }
    /**
     * get slide data template
     * @method get_template_data
     * @param  string            $specific_arg [ specific arg( like title / content  - you need to define first ) ]
     * @return [type]                          [specific data]
     */
    public function get_template_data( $specific_arg = '' ){
        $template_data = $this->_get( 'template_args' );
        if( ! empty( $specific_arg ) ){
            return isset( $template_data[ $specific_arg ] ) ? $template_data[ $specific_arg ] : '';
        }
        return $template_data;
    }

}
