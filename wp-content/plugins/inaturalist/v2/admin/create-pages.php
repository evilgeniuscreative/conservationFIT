<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 4/13/17
 * Time: 2:06 PM
 */

//
$has_inat_page = get_page_by_path('inat');
$has_inat_obs_page = get_page_by_path('inat/observation-single');
$has_inat_obs_list_page = get_page_by_path('inat/observations');
$has_inat_obs_list_page = get_page_by_path('inat/observation-download');


function create_page_if_null($target)
{
    //   d('checking page ' . $target);
    if (get_page_by_title($target) == NULL) {
        //    d('NULL ' . $target);
        create_pages_fly($target);
    }
    // else {
    //     d($target . ' exists');
    //}
}

function check_pages_live()
{
    create_page_if_null('inat');
    create_page_if_null('add-observation');
    create_page_if_null('observations');
    create_page_if_null('observation-single');
    create_page_if_null('observation-download');

}

add_action('init', 'check_pages_live');

function create_pages_fly($pageName)
{
    // d('creating page ' . $pageName);
    if ($pageName == 'inat') {
        $createPage = array(
            'post_title' => $pageName,
            'post_content' => $pageName . 'starter content',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
            'post_name' => $pageName
        );
    } else {
        $createPage = array(
            'post_title' => $pageName,
            'post_content' => $pageName . ' starter content',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'page',
            'post_name' => $pageName,
            'post_parent' => get_page_by_title('inat')->ID
        );
    }


    // Insert the post into the database
    wp_insert_post($createPage);
}