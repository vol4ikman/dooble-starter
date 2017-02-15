<?php
/*********************
** Helper functions
**********************/

//ACF Google API
function get_google_api_key(){
    $google_api_key = get_field('google_api_key','option');
    return $google_api_key;
}
function google_api_acf_init() {
	acf_update_setting('google_api_key', get_google_api_key());
}
add_action('acf/init', 'google_api_acf_init');
