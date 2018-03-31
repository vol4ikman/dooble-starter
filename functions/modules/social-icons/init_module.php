SOCIAL ICONS
https://i.imgur.com/cpDB4wm.png

/* DEFINITION */
The function will accepts args and will create the icons using fontawesome/images/foundation fonts

/* USAGE */

/* IF IMAGES THEN USE ACF OPTIONS REPEATER */
$view_args = array(
    'type' => 'fontawesome',
    'networks' => array(
        'facebook' => get_field('facebook_url'),
        'linkedin' => get_field('linkeding_url'),
    )
);
qs_get_module( 'social' , $view_args );
