<?php


/** sets cookie from url if there **/
function inat_cookies()
{

    if (isset($_GET['inat_key'])) {
        setcookie('inat_access_token', $_GET['inat_key'], time() + 3600 * 24 * 30 * 12 * 10,'/');
    }
}


