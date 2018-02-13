<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 3/28/17
 * Time: 4:31 PM
 */

function inat_map()
{

    $page_number = null;
    $per_page = null;
    $order_by = null;
    $custom = null;
    /* Google maps */
    $red_usr = get_option('inat_reduce_user');
    $red_prj = get_option('inat_reduce_project');
    $verb = 'observations';
    $id = '';

    if ($red_usr != '' && $red_usr != '0') {
        $usr_data = inat_get_call('users', $red_usr);
        $usr_name = $usr_data->login;
        $verb .= '/' . $usr_name;
    } elseif ($red_prj != '') {
        $verb .= '/project/' . $red_prj;
    }

    $observations = inat_get_call($verb, null, $page_number, $per_page, $order_by, $custom);
    $partners = array();

//    $partners = get_post_type_object( 'partner' );
    //print_r($observations);

    foreach($observations as $id=>$obs){
        $obs_template = "/templates/template-map-observation-bubble.php";
        $obs_templatePath = dirname(__FILE__) . $obs_template;

        $obs_output = View::render($obs_templatePath, $obs);
        $observations[$id]->bubble = "'".strip_returns_newlines($obs_output)."'";
    }

    $args = array(
        'post_type' => 'partner'
    );

    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) {

            $wp_query->the_post();
            $partners[] = get_fields();
            $partners[$wp_query->current_post]['title'] = get_the_title();
            $partners[$wp_query->current_post]['permalink'] = get_the_permalink();
            $partners[$wp_query->current_post]['thumbnail'] = get_the_post_thumbnail(null,array(60,60),array('class'=>'partner-thumbnail'));
        }
    }
    foreach($partners as $id=>$par){
        $par_template = "/templates/template-map-partner-bubble.php";
        $par_templatePath = dirname(__FILE__) . $par_template;

        $par_output = View::render($par_templatePath, $par);


        $partners[$id]['bubble'] = "'".strip_returns_newlines($par_output)."'";
    }

    //print_r($partners);
//    wp_reset_postdata();


    // Create markers.


// create markers
//    foreach ($data as $id => $obs) {
//        if ($obs->latitude != '') {
//
//            $thisBalloonContent = "'<div class=\"bubble\" id=\"balloon_" . $obs->id . "\">" .
//                "<h1><a href=\"".home_url()."/inat/observation-single/" . $obs->id . "\">" . $obs->species_guess . " (" . $obs->taxon->name . ")</a></h1>" .
//                "<p class=\"description\">" . ucfirst($obs->description) . "</p>" .
//                "<div class=\"obs-thumbnail\"><img src=\"" . $obs->photos[0]->square_url . "\"/></div>" .
//                "<div class=\"obs-details\">" .
//                "<p><em>Date:</em> " . date("F j, Y", strtotime($obs->observed_on)) . "</p>" .
//                "<p><em>Location:</em> " . $obs->place_guess . "</p>" .
//                "<p><em>Tags:</em> " . implode(", ", $obs->tag_list) . "</p>" .
//                "<p><em>Observer:</em> " . $obs->user_login . "</p>" .
//                "</div>" .
//
//                "</div>';";
//
//            $output .= "\r\n var contentString_" . $id . ' = ' . $thisBalloonContent;
//
//            $output .= "\r\n var infowindow_" . $id . ' = new google.maps.InfoWindow({
//                content:contentString_' . $id . '});';
//
//            $output .= "\r\n var marker_" . $id . ' = new google.maps.Marker({
//                position:{lat:' . $obs->latitude . ',lng:' . $obs->longitude . '},
//                map:map
//            });';
//
//            $output .= 'marker_' . $id . '.addListener(\'click\', function() {
//                infowindow_' . $id . '.open(map, marker_' . $id . ');
//            });';
//        }
//    }
//
//
//    $output .= '</script>';
//
//    return $output;

    $data = array('partners' => $partners, 'observations' => $observations);
    $template = "/templates/template-map-render.php";
    $templatePath = dirname(__FILE__) . $template;

    $output = View::render($templatePath, $data);

    return $output;


}

add_shortcode('inaturalist_map', 'inat_map');