<?php

/**
 *
 * DEFINE THE MODULE THAT ARE USED ON THE TEMPLATE
 *
 */
function register_modules(){
    $active_modules = array(
        "login" => array(
            "module_folder" => "login"
        )
    );

    return $active_modules;
}
