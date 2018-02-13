<?
/**
 * Script procesor for add/user form
 */


function inat_add_obs()
{

    // add observation
    $data_string =
        'observation[species_guess]=' . $_POST['inat_obs_add_species_guess'] .
        '&observation[taxon_id]=' . $_POST['inat_obs_add_taxon_id'] .
        '&observation[id_please]=' . $_POST['inat_obs_add_id_please'] .
        '&observation[observed_on_string]=' . $_POST['inat_obs_add_observed_on_string'] .
        '&observation[time_zone]=' . $_POST['inat_obs_add_time_zone'] .
        '&observation[description]=' . $_POST['inat_obs_add_description'] .
        '&observation[place_guess]=' . $_POST['inat_obs_add_place_guess'] .
        '&observation[latitude]=' . $_POST['inat_obs_add_latitude'] .
        '&observation[longitude]=' . $_POST['inat_obs_add_longitude'];

    // get inserted json
    $json = api_post('observations.json', $data_string);

    // add observation with id to project, if you're filtering by project
    if(get_option('inat_reduce_project')!=''){


    }

    $data_string_project =
        'project_observation[observation_id]=' . $json[0]->id .
        '&project_observation[project_id]=' . get_option('inat_reduce_project');

    api_post('project_observations.json', $data_string_project);

//    $url = get_option('inat_base_url') . '/' . $data_category . '?' . $data_string;
//    $opt = array('http' => array('method' => 'POST', 'header' => 'Authorization: Bearer ' . $_COOKIE['inat_access_token']));
//    $context = stream_context_create($opt);
//    $result = file_get_contents($url, false, $context);
//    $json = json_decode($result);

    wp_redirect('http://localhost:8888/ConservationFIT/inat/observation-single/' . $json[0]->id);//
//header("Location: ".$_POST['site_url'].'/?'.http_build_query(array('page_id' => $_POST['inat_post_id'], 'verb' => 'observations', 'id' => $json[0]->id)));

}

add_action('admin_post_inat_form_obs_add', 'inat_add_obs');