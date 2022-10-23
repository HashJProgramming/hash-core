<?php

include_once 'sign-in.php';
include_once 'sign-up.php';
include_once 'sign-out.php';
include_once 'products.php';
include_once 'shopping-cart.php';

// ----------------------------------------- SETTINGS ----------------------------------------- //
// check if session is already start if not then session start
if (!isset($_SESSION)) {
    session_start();
}

function settings($data, $value) {
    $str = file_get_contents('./settings.json');
    $json = json_decode($str, true);
    return $json[$data][$value];
}

function site_name() {
    echo settings('site-settings', 'site-name');
}

function head(){

    foreach (settings('site-config','head') as $head){
        echo $head;
    }
}


function js(){
    foreach (settings('site-config','js') as $js){
        echo $js;
    }
}

function authenticator($option): bool
{
    switch($option){
        case 'auth':
            if (!isset($_SESSION['ID'])){
                $location = settings('site-settings', 'site-sign-in');
                header("Location: $location");
            }
            break;
        case 'auth-bool':
            if (isset($_SESSION['ID'])){
                return true;
            } else{
                return false;
            }
    }
    return false;
}

function currency($price): string
{
    return settings('ecommerce-config','currency').number_format($price, 2);
}
// ----------------------------------------- END SETTINGS ----------------------------------------- //
