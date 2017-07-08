<?php
function hook_req(){
    $CI =&get_instance();
    // $CI->output->set_header("Access-Control-Allow-Origin: * ");
    
    $whitelist = array('/signin', '/login/signin_submit', '/login/signup_submit');
    $userdata = $CI->session->userdata;

    $path = $_SERVER['PATH_INFO'];
    if (in_array($path, $whitelist)){
        // echo 'in whitelist';
        return;

    }
    if (isset($userdata['login'])&&($userdata['login']===true)){
        // echo 'is logged';
        return;
    }

    // echo "not allowed";
    redirect('signin');

}