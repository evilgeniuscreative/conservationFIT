<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/28/17
 * Time: 5:35 PM
 */


function inat_observations_list()
{

    $red_usr = get_option('inat_reduce_user');
    $red_prj = get_option('inat_reduce_project');
    $verb = 'observations';
    if ($red_usr != '' && $red_usr != '0') {
        $usr_data = inat_get_call('users', $red_usr);
        $usr_name = $usr_data->login;
        $verb .= '/' . $usr_name;
    } elseif ($red_prj != '') {
        $verb .= '/project/' . $red_prj;
    }
    $data = inat_get_call($verb, $id, $page_number, $per_page, $order_by, $custom);

    // START HERE
    $template = "/templates/observation.php";
    $templatePath = dirname(__FILE__) . $template;

    $output = '<div id="inat-observations-list">';
    foreach ($data as $id => $ob) {
        //$output .= theme_list_single_obs($id, $ob, $params);
        $output .= View::render($templatePath, $ob);
    }


   // $prev_url = site_url() . '/?' . http_build_query(array('page_id' => get_option('inat_post_id'), 'verb' => $params['verb'], 'page' => $params['page'] - 1));
  //  $next_url = site_url() . '/?' . http_build_query(array('page_id' => get_option('inat_post_id'), 'verb' => $params['verb'], 'page' => $params['page'] + 1));
   // $output .= '<div class="clearfix"> </div><div class="pager-wrapper">';
//    if ($params['page'] > 1) {
//        $output .= '<span id="prev-link" class="pager link"><a href="' . $prev_url . '">' . __('Prev', 'inat') . '</a></span>&nbsp;&nbsp;';
//    }
//    $output .= '<span id="next-link" class="pager link"><a href="' . $next_url . '">' . __('Next', 'inat') . '</a></span></div>';

    $output .= "</div>";

    return $output;
}

add_shortcode('inaturalist_observations', 'inat_observations_list');