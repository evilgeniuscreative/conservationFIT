<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/28/17
 * Time: 4:31 PM
 */

function inat_map(){
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
        // $verb, $id, $page,
        $data = inat_get_call($verb, null, $page_number, $per_page, $order_by, $custom);

        $startCenter = 'var south_atlantic = {lat: -26.027536, lng: -13.977898};';
        $startMap = 'var map = new google.maps.Map(document.getElementById(\'map\'), {
          zoom: 2,
          center: south_atlantic
        });';
        $marker1 = 'var marker = new google.maps.Marker({
          position: south_atlantic,
          map: map
        });';


        $output =
            '<div id="map"></div>
        <script>
        function initMap()';// ignore this IDE warning
        $output .= '{';
        $output .= $startCenter;
        $output .= $startMap;

// create markers
        foreach ($data as $id => $obs) {
            if ($obs->latitude != '') {

                $thisBalloonContent = "'<div class=\"bubble\" id=\"balloon_".$obs->id."\">" .
                    "<h1><a href=\"#observation_".$obs->id."\">" . $obs->species_guess . " (" . $obs->taxon->name . ")</a></h1>" .
                    "<p class=\"description\">" . ucfirst($obs->description) . "</p>" .
                    "<div class=\"obs-thumbnail\"><img src=\"" . $obs->photos[0]->square_url . "\"/></div>" .
                    "<div class=\"obs-details\">" .
                    "<p><em>Date:</em> " . date("F j, Y", strtotime($obs->observed_on)) . "</p>" .
                    "<p><em>Location:</em> " . $obs->place_guess . "</p>" .
                    "<p><em>Tags:</em> " . implode(", ", $obs->tag_list) . "</p>" .
                    "<p><em>Observer:</em> " . $obs->user_login . "</p>" .
                    "</div>" .

                    "</div>';";

                $output .= "\r\n var contentString_" . $id . ' = ' . $thisBalloonContent;

                $output .= "\r\n var infowindow_" . $id . ' = new google.maps.InfoWindow({
                content:contentString_' . $id . '});';

                $output .= "\r\n var marker_" . $id . ' = new google.maps.Marker({
                position:{lat:' . $obs->latitude . ',lng:' . $obs->longitude . '},
                map:map
            });';

                $output .= 'marker_' . $id . '.addListener(\'click\', function() {
                infowindow_' . $id . '.open(map, marker_' . $id . ');
            });';
            }
        }

        $output .= '}';


        $output .=
            'initMap();
        </script>';

        return $output;


}
add_shortcode('inaturalist_map', 'inat_map');