<?php
require_once('includes/errors.inc');
/**
 * Plugin Name: iNaturalist v1
 * Plugin URI: http://www.inaturalist.org
 * Description: This plugin connects your wordpress to inaturalist platform
 * Version: 1.2
 * Author: Julià Mestieri for Projecte Ictineo SCCL (http://projecteictineo.com)
 * Author URI: http://projecteictineo.com
 * License: aGPLv3
 */

//defined( 'ABSPATH' ) or die( 'access forbidden' );
require_once('utils.php');
require_once('classes/View.php');
require_once('inat-cookies.php');
require_once('admin/plugin-styles.php');
require_once('admin/configuration-page.php');
require_once ('inat-org-content-filter.php');
require_once('inat-user-login.php');
require_once('inat-widgets.php');
require_once('inat-widget-links.php');

require_once ('inat-api-get-call.php');

require_once('inat-call-api.php');
require_once('inat-user-api.php');
require_once('inat-map.php');
require_once('inat-observations-list.php');



//afegir camp a l'usuari

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





