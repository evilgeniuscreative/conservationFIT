<?php
/**
 * Created by:
 * Ian Kleinfeld for http://www.jmp.com
 * Date: 4/20/17
 * Time: 10:48 AM
 */

function api_post($data_category,$data_string){
    $url = get_option('inat_base_url') . '/' . $data_category . '?' . $data_string;
    $opt = array('http' => array('method' => 'POST', 'header' => 'Authorization: Bearer ' . $_COOKIE['inat_access_token']));
    $context = stream_context_create($opt);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result);
    return $json;
}
