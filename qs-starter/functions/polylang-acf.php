<?php
class BEA_ACF_For_Polylang {
   function __construct() {
       // Set Polylang current lang
       add_filter( 'acf/settings/current_language', array( __CLASS__, 'get_current_site_lang' ) );
       // Load default Polylang's option page value
       add_filter( 'acf/load_value', array( __CLASS__, 'set_default_value' ), 10, 3 );
   }
   /**
    * Get the current Polylang's locale or the wp's one
    *
    * @author Maxime CULEA
    *
    * @return bool|string
    */
   public static function get_current_site_lang() {
       return function_exists( 'pll_current_language' ) ? pll_current_language( 'locale' ) : get_locale();
   }
   /**
    * Load default value in front, if none found for an acf option
    *
    * @author Maxime CULEA
    *
    * @param $value
    * @param $post_id
    * @param $field
    *
    * @return mixed|string|void
    */
   public static function set_default_value( $value, $post_id, $field ) {
       if ( is_admin() || false === strpos( $post_id, 'options' ) || ! function_exists( 'pll_current_language' ) ) {
           return $value;
       }
       /**
        * According to his type, check the value to be not an empty string.
        * While false or 0 could be returned, so "empty" method could not be here useful.
        *
        * @see https://github.com/atomicorange : Thx to atomicorange for the issue
        *
        * @since 1.0.1
        */
       if ( ! is_null( $value ) ) {
           if ( is_array( $value ) ) {
               // Get from array all the not empty strings
               $is_empty = array_filter( $value, function ( $value_c ) {
                   return "" !== $value_c;
               } );
               if ( ! empty( $is_empty ) ) {
                   // Not an array of empty values
                   return $value;
               }
           } else {
               if ( "" !== $value ) {
                   // Not an empty string
                   return $value;
               }
           }
       }
       /**
        * Delete filters for loading "default" Polylang saved value
        * and for avoiding infinite looping on current filter
        */
       remove_filter( 'acf/settings/current_language', array( __CLASS__, 'get_current_site_lang' ) );
       remove_filter( 'acf/load_value', array( __CLASS__, 'set_default_value' ) );

       //$value = acf_get_metadata( 'options', $field['name'] );

       /**
        * Re-add deleted filters
        */
       add_filter( 'acf/settings/current_language', array( __CLASS__, 'get_current_site_lang' ) );
       add_filter( 'acf/load_value', array( __CLASS__, 'set_default_value' ), 10, 3 );
       return $value;
   }
}
new BEA_ACF_For_Polylang();
