<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/30/17
 * Time: 10:22 AM
 */

require_once('includes/errors.inc');
function inat_get_call($data_category = '', $data_point_id = '', $page_num = '', $per_page = '', $order_by = '', $custom = array())
{
    /** Get the project information **/
    /**
     *
     * $data_category: comments, identifications, observations, observation_fields, observation_field_values,
     *                 observation_photos, places, projects, users.
     *
     * See http://www.inaturalist.org/pages/api+reference
     * $data_point_id: iNat object id
     * $page_num: page number
     * $per_page: items per page
     * $order_by: property to order results by
     * $custom: custom query
     *
     * API CALL URL EXAMPLES:
     * http://www.inaturalist.org/observations.json?per_page=150&order_by=observed_on&page=1
     * http://www.inaturalist.org/observations.json?per_page=40&order_by=observed_on&page=1
     * http://www.inaturalist.org/observations.json?per_page=150&order_by=observed_on&page=1
     * http://www.inaturalist.org/places.json?page=1
     * http://www.inaturalist.org/projects.json
     * http://www.inaturalist.org/taxa.json
     *
     * http://www.inaturalist.org/observations/694370.json
     * http://www.inaturalist.org/places/61841.json
     * http://www.inaturalist.org/observations.json?per_page=40&order_by=observed_on&place_guess=61841
     * http://www.inaturalist.org/projects/101.json
     * http://www.inaturalist.org/observations/project/101.json?per_page=40&order_by=observed_on
     * http://www.inaturalist.org/taxa/47686.json
     * http://www.inaturalist.org/observations.json?per_page=40&order_by=observed_on&taxon_id=47686&page=1
     *
     * http://www.inaturalist.org/users/18730.json
     * http://www.inaturalist.org/observations/garrettt331.json?per_page=40&order_by=observed_on
     */


    if ($data_point_id != '') {
        // add slash for api call if there's an ID filter
        $data_point_id = '/' . $data_point_id;
    }

    $api_call_url = get_option('inat_base_url') . '/' . $data_category . $data_point_id . '.json';

   // consoleLog('data_category: ', $data_category);
   // consoleLog('call api_call_url: ', $api_call_url);

    $data = array();
    if ($page_num != '') {
        $data += array('page' => $page_num);
    }
    if ($per_page != '') {
        $data += array('per_page' => $per_page);
    }
    if ($order_by != '') {
        $data += array('order_by' => $order_by);
    }
    if (isset($custom)) {
        $data += $custom;
    }

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'GET',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    try {
        $result = file_get_contents($api_call_url, false, $context);
        if ($result === false) {
            return false;
        } else {
            $data = json_decode($result);
            return $data;
        }
    } catch (Exception $e) {
        echo "API Exception $e";
        return false;
    }


}
