<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 4/14/17
 * Time: 4:58 PM
 */

function inat_add_observation()
{
    $template = "/templates/template-form-observation.php";
    $templatePath = dirname(__FILE__) . $template;

    $output = '<div class="inat-add-observation">';
    $output .=  View::render($templatePath, null) ;
    $output .='</div>';
    return $output;
}

add_shortcode('inaturalist_add_observation', 'inat_add_observation');