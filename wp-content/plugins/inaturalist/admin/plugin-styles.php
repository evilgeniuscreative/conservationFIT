<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/29/17
 * Time: 4:10 PM
 */

add_action('wp_enqueue_scripts', 'register_plugin_styles');
function register_plugin_styles()
{

    wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . get_option('google_maps_api_key'), false, true);
    wp_register_script('google-jsapi', 'https://www.google.com/jsapi', false, true);

    wp_register_style('inat', plugins_url('inaturalist/css/inat.css'));

    wp_enqueue_script('google-maps');
    wp_enqueue_script('google-jsapi');

    wp_enqueue_style('inat');
}