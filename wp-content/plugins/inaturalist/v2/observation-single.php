<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 3/30/17
 * Time: 10:39 AM
 */

function inat_observation()
{
    preg_match(',/observation-single/(\d+)/,', $_SERVER['REQUEST_URI'], $matches);
    $data_point_id = $matches[1];
    //d($data_point_id);

    $data = inat_get_call('observations', $data_point_id);


    $template = "/templates/template-observation-single.php";
    $templatePath = dirname(__FILE__) . $template;

    $output = '<div class="inat-observation-single">';
    $output .=  View::render($templatePath, $data) ;
    $output .='</div>';
    return $output;

}

add_shortcode('inaturalist_single_observation', 'inat_observation');