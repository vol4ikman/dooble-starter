<?php
/*****************************************
**  Define
*****************************************/
define('ENV', 'dev');
if( !defined('THEME') ){
    define("THEME", get_template_directory_uri());
}
define('CSS_INC', THEME.'/build/css/');
define('JS_INC', THEME.'/build/js/');

//if wpml
// define("LANG",ICL_LANGUAGE_CODE);
define("LANG", "he");
if(is_rtl()){
    define("FLOAT", 'right');
    define("FOUNDATION", THEME.'/assets/foundation-6.2.1-rtl');
}
else{
    define("FLOAT", 'left');
    define("FOUNDATION", THEME.'/assets/foundation-6.2.1-ltr');
}
if( !defined('TEMPLATEPATH') ) {
    define( 'TEMPLATEPATH', get_template_directory() );    
} 
define('qs_api_endpoint', false);
