<?php
//add_action('wp', 'myStartSession', 1);
//add_action('wp_logout', 'myEndSession');
//add_action('wp_login', 'myEndSession');
//function myStartSession() {
//    if(!session_id()) {
//        session_start();
//    }
//}
//function myEndSession() {
//    if(session_id()){
//        session_destroy ();
//    }
//
//}


add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

}


//wp_enqueue_script("jquery-cookie", plugins_url('inaturalist/js/js.cookie.js'), array(), '0');

//function set_user_cookie( $cookie_name, $cookie_value)
//{
//    //consoleLog("set_user_cookie");
//    // var_dump(headers_sent());
//    setcookie($cookie_name, $cookie_value, time() + 3600 * 24, COOKIEPATH, COOKIE_DOMAIN);
//
//    //print_r([$redirect,$cookie_name,$cookie_value,$cookie_expires,$cookie_path,$cookie_domain]);
//}

