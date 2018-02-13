<?php
require_once('v2/includes/errors.inc');

/**
 * Plugin Name: iNaturalist v2.0
 * Plugin URI: http://www.jmp.com
 * Description: Connects WordPress to iNaturalist platform
 * Version: 2.0
 * Author: Ian.Kleinfeld@JMP.com based on work by Julià Mestieri (@julimestieri)
 * Author URI: http://www.jmp.com
 * License: aGPLv3
 */

require(ABSPATH . '/wp-load.php');
require_once(ABSPATH . "wp-includes/pluggable.php");

//defined( 'ABSPATH' ) or die( 'access forbidden' );

//Includes https://www.inaturalist.org/pages/api+reference
require_once('v2/includes/utils.php');
require_once('v2/classes/View.php');
require_once('v2/cookies.php');
require_once('v2/widget-inat-user-login.php');
require_once('v2/admin/create-pages.php');

require_once('v2/observation-add-after-submit.php');
require_once('v2/api-get.php');
require_once ('v2/api-post.php');

require_once('v2/google-map.php');
require_once('v2/observation-single.php');
require_once('v2/observation-list.php');
require_once('v2/observation-add.php');
//require_once('v2/observation-download.php');

require_once('v2/admin/configuration-page.php');
require_once('v2/admin/plugin-styles.php');


wp_register_script( 'inat_plugin_js', plugins_url('/js/inat-plugin.js', __FILE__), array('jquery'),false);

wp_enqueue_script( 'inat_plugin_js' );

add_action('init','inat_cookies');
add_action('wp_footer','inat_clean_url');



function inat_clean_url(){
    // once the cookie is set, remove the query string
    $url = $_SERVER['REQUEST_URI'];
    $val = substr( $url, 0, strrpos( $url, "?"));
    echo "<script>history.replaceState({foo:'bar'},'','$val');</script>";
}

//add_action( 'profile_personal_options', 'inat_user' );
//add_action( 'show_user_profile', 'inat_user' );


//function inat_user( $user ) {

//$inat_user_value = get_user_meta( $user->ID, 'inat_user', true );

//}

//add_action('personal_options_update', 'update_inat_user');

//function update_inat_user($user_id) {
//if ( current_user_can('edit_user',$user_id) )
//update_user_meta($user_id, 'inat_user', $_POST['inat_user']);
//}



