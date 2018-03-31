<?php
/**
 * This file will hold general callback function_exists
 * Use only in case no need for a class function
 */

 //ACF Google API
 function get_google_api_key(){
     if( function_exists( 'get_field' ) ){
         $google_api_key = get_field('google_api_key','option');

         return $google_api_key;
     }
 }
