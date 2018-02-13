<?php
/**
 * Created by:
 * Programmer: Ian Kleinfeld for http://www.jmp.com
 * Date: 3/29/17
 * Time: 4:09 PM
 */


function add_inat_menu()
{
    // ADD iNaturalist to SETTINGS dashboard menu
    $inat_options = add_options_page('iNaturalist configuration page', 'iNaturalist', 'manage_options', 'inaturalist', 'inat_options');
}

// add the menu
add_action('admin_menu', 'add_inat_menu');


// Configuration Page Optionswor
function inat_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    if (isset($_POST['inat_base_url'])) {
        update_option('inat_base_url', esc_url_raw($_POST['inat_base_url']));
    }
    if (isset($_POST['inat_reduce_project'])) {
        update_option('inat_reduce_project', intval($_POST['inat_reduce_project']));
    }
    if (isset($_POST['inat_reduce_user'])) {
        update_option('inat_reduce_user', intval($_POST['inat_reduce_user']));
    }
    if (isset($_POST['google_maps_api_key'])) {
        update_option('google_maps_api_key', wp_kses($_POST['google_maps_api_key'], array()));
    }
    if (isset($_POST['inat_login_callback'])) {
        update_option('inat_login_callback', esc_url_raw($_POST['inat_login_callback']));
    }
    if (isset($_POST['inat_login_id'])) {
        update_option('inat_login_id', wp_kses($_POST['inat_login_id'], array()));
    }
    if (isset($_POST['inat_login_secret'])) {
        update_option('inat_login_secret', wp_kses($_POST['inat_login_secret'], array()));
    }
    if (isset($_POST['inat_login_app'])) {
        update_option('inat_login_app', intval($_POST['inat_login_app']));
    }

    echo '<div class="wrap">';
    echo '<h2>' . __('iNaturalist configuration page', 'inat') . '</h2>';
    echo '<form action="" method="post">';
    echo '<table class="form-table"><tbody>';
    echo '<tr><th scope="row"><label for="this">' . __('Base URL of iNaturalist', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . (get_option('inat_base_url') != '' ? get_option('inat_base_url') : 'http://www.inaturalist.org') . '" name="inat_base_url">';
    echo '<p class="description">' . __('The URL used to access iNaturalist data. Default: http://www.inaturalist.org', 'inat') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Limit to a project ', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_reduce_project') . '" name="inat_reduce_project">';
    echo '<p class="description">' . __('The project numeric id to filter the plugin behavior', 'inat') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Limit to a user ', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_reduce_user') . '" name="inat_reduce_user">';
    echo '<p class="description">' . __('The user login name to limit the plugin behavior', 'inat') . '</p></td></tr>';

    echo '<tr><th scope="row"><label for="this">' . __('Google Maps API Key', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('google_maps_api_key') . '" name="google_maps_api_key">';
    echo '<p class="description">' . __('Google Maps API key. Get one ', 'inat') . '<a href="https://developers.google.com/maps/documentation/javascript/adding-a-google-map#key" target="_blank">here.</a></p></td></tr>';

    echo '<tr><th colspan=2><h3>' . __('Configurations for login using an iNaturalist application', 'inat') . '</h3><p>See <a href="http://www.inaturalist.org/oauth/applications/" target="_blank">http://www.inaturalist.org/oauth/applications/</a></p></th></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Callback url', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_login_callback') . '" name="inat_login_callback">';
    echo '<p class="description">' . __('iNat application callback url', 'inat') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Application Id', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_login_id') . '" name="inat_login_id">';
    echo '<p class="description">' . __('iNat application identifier', 'inat') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Secret', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_login_secret') . '" name="inat_login_secret">';
    echo '<p class="description">' . __('iNat application secret key', 'inat') . '</p></td></tr>';
    echo '<tr><th scope="row"><label for="this">' . __('Numeric id of your application', 'inat') . ' </label></th>';
    echo '<td><input type="text" class="regular-text" value="' . get_option('inat_login_app') . '" name="inat_login_app">';
    echo '<p class="description">' . __('Click application name. Find id in url i.e., http://www.inaturalist.org/oauth/applications/[:appid]', 'inat') . '</p></td></tr>';
    //echo '<input type="text" value="'.get_option( 'inat_' ).'" name="">';
    echo '</tbody></table>';
    echo '<input type="submit" name="dp_submit" value="Save Settings" />';
    echo '</form>';
    echo '</div>';
}