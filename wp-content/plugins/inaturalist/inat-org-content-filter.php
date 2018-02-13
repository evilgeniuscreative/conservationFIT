<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/30/17
 * Time: 10:17 AM
 */


// ORIGINAL iNat PLUGIN URL-BASED, SINGLE-PAGE FILTER
// Filter page content
function my_the_content_filter($content)
{
    if ($GLOBALS['post']->post_title == 'inat') {

        update_option('inat_post_id', (string)$GLOBALS['post']->ID);
        $output = '';
        // action
        $verb = (isset($GLOBALS['_REQUEST']['verb'])) ? $GLOBALS['_REQUEST']['verb'] : 'observations';

        // iNat database element id/entry id/key (i.e. https://www.inaturalist.org/observations/123.json or https://www.inaturalist.org/projects/123.json)
        $id = (isset($GLOBALS['_REQUEST']['id'])) ? $GLOBALS['_REQUEST']['id'] : '';

        // page number
        $page = (isset($GLOBALS['_REQUEST']['page'])) ? $GLOBALS['_REQUEST']['page'] : '1';

        // items per page
        $per_page = (isset($GLOBALS['_REQUEST']['per_page'])) ? $GLOBALS['_REQUEST']['per_page'] : '50';

        // order by property
        $order_by = (isset($GLOBALS['_REQUEST']['order_by'])) ? $GLOBALS['_REQUEST']['order_by'] : 'observed_on';

        $custom = array();
        if (isset($GLOBLAS['_REQUEST']['place_guess'])) {
            $custom += array('place_guess' => $GLOBALS['_REQUEST']['place_guess']);
        }
        if (isset($GLOBLAS['_REQUEST']['taxon_id'])) {
            $custom += array('taxon_id' => $GLOBALS['_REQUEST']['taxon_id']);
        }
        //if(isset($GLOBLAS['_REQUEST'][''])) { $custom += array('' => $GLOBALS['_REQUEST']['']); }
        //$ret_cont .= 'inat in!';
        $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
        $params = array('verb' => $verb, 'id' => $id, 'page' => $page, 'per_page' => $per_page, 'order_by' => $order_by, 'custom' => $custom);
        $red_usr = get_option('inat_reduce_user');
        $red_prj = get_option('inat_reduce_project');
        switch ($verb) {
            /******
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
             ********/
            case 'observations':
                if ($id == '') {
                    if ($red_usr != '' && $red_usr != '0') {
                        $usr_data = inat_get_call('users', $red_usr);
                        $usr_name = $usr_data->login;
                        $verb .= '/' . $usr_name;
                    } elseif ($red_prj != '') {
                        $verb .= '/project/' . $red_prj;
                    }
                    $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_map_obs($data);
                    $output .= theme_list_obs($data, $params);
                } else {
                    $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_observation($data);
                }
                break;
            case 'places':
                $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                if ($id == '') {
                    $output .= theme_list_places($data, $params);
                } else {
                    $output .= theme_place($data);
                    $verb = 'observations';
                    $id = '';
                    $custom['place_guess'] = $id;
                    $data2 = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_list_obs($data2, $params);
                }
                break;
            case 'projects':
                if ($id == '') {
                    if ($red_prj != '') {
                        $id = $red_prj;
                    } elseif ($red_usr != '') {
                        $usr_data = inat_get_call('users', $red_usr);
                        $usr_name = $usr_data->login;
                        $verb .= '/user/' . $usr_name;
                    }
                    $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                    if ($red_prj != '') {
                        $output .= theme_project($data);
                        $verb2 = 'observations/project';
                        $data2 = inat_get_call($verb2, $id, $page, $per_page, $order_by, $custom);
                        $output .= theme_list_obs($data2, $params);
                    } else {
                        $output .= theme_list_projects($data, $params);
                    }
                } else {
                    $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_project($data);
                    $verb2 = 'observations/project';
                    $data2 = inat_get_call($verb2, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_list_obs($data2, $params);
                }
                break;
            case 'taxa':
                $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                if ($id == '') {
                    $output .= theme_list_taxa($data, $params);
                } else {
                    $output .= theme_taxon($data);
                    $verb2 = 'observations';
                    $custom['taxon_id'] = $id;
                    unset($id);
                    $data2 = inat_get_call($verb2, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_list_obs($data2, $params);
                }
                break;
            case 'users':
                $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                if ($id != '') {
                    $verb2 = 'observations/' . $data->login;
                    $output .= theme_user($data);
                    unset($id);
                    $data2 = inat_get_call($verb2, $id, $page, $per_page, $order_by, $custom);
                    $output .= theme_list_obs($data2, $params);
                }
                break;
            case 'add/user':
                $output .= theme_add_user();
                break;
            case 'add/observation':
                $output .= theme_add_obs();
                break;
            default:
                $data = inat_get_call($verb, $id, $page, $per_page, $order_by, $custom);
                $output .= theme_list_obs($data, $params);
        }
        return $output;
    }
    return $content;
}

add_filter('the_content', 'my_the_content_filter');