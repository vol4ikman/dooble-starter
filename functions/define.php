<?php
/*****************************************
**  Define
*****************************************/
if( !defined('THEME') ){
    define("THEME", get_template_directory_uri());
} 
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
