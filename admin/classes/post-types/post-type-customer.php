<?php

class QS_post_type_customer extends QS_general_post_type{
    /**
     * Init the post type
     * @param [type] $post_id [description]
     */
    public function __construct( $post_id ){
        $post_type = "customer";

        parent::__construct( $post_type );
    }

    /**
     * Static function to init the post type options
     * @return [type] [description]
     */
    public static function init(){
        // create a book custom post type
        $post_type = new CPT('customer');
        // create a genre taxonomy
        $post_type->register_taxonomy('genre');
        // define the columns to appear on the admin edit screen
        $post_type->columns(array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Title'),
        ));
        // populate the price column
        $post_type->populate_column('price', function($column, $post) {
            echo "£" . get_field('price'); // ACF get_field() function
        });
        // populate the ratings column
        $post_type->populate_column('rating', function($column, $post) {
            echo get_field('rating') . '/5'; // ACF get_field() function
        });
        // make rating and price columns sortable
        $post_type->sortable(array(
            'price' => array('price', true),
            'rating' => array('rating', true)
        ));
        // use "pages" icon for post type
        $post_type->menu_icon("dashicons-book-alt");
    }
}
