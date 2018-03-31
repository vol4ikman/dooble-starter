<?php

class QS_general_post_type{
    /**
     * Genreal constructor function
     * @param [type] $post_type [description]
     */
    public function __construct( $post_type ){
        global $post;

        $this->post_type = $post_type;

        if( is_singular( $this->post_type ) ){
            $this->post = $post;
        }elseif( $post_id ){
            $this->post = get_post( $post_id );
        }
    }
}
