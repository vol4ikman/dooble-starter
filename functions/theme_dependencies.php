<?php

/*****************************************
**  Includes
****************************************/
get_template_part( 'functions/define' );
get_template_part( 'functions/enqueue' );
get_template_part( 'functions/hooks' );
get_template_part( 'functions/functions' );
get_template_part( 'functions/ajax' );
get_template_part( 'functions/helpers' );
get_template_part( 'functions/tgm' );

if ( class_exists( 'WooCommerce' ) ) {
    get_template_part( 'functions/woocommerce' );
}

if ( defined( 'QS_API_ENDPOINT' ) && QS_API_ENDPOINT ){ // <==== currently on beta stage
    get_template_part( 'functions/qs_api_endpoint' );
}

get_template_part( 'admin/options' );
get_template_part( 'admin/types' );
