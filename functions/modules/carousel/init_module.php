ADD CAROUSEL
https://i.imgur.com/MQ5XtLn.png

/* DEFINITION */
The function will accepts html and will create a carousel

/* USAGE */

$view_args = array(
    'html_template' => $html_template (this will be optional there will be a default template )
    'slider_options' => array(
        /* slick slider options */
    )
);

qs_get_module( 'carousel' , $view_args );
