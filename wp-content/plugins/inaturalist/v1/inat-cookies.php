<?php


    /** cookie manajer for inat auth **/
   function inat_cookies($token)
    {
        if ($token) {
            //$_COOKIE['inat_code'] = $_GET['code'];
            setcookie('inat_code', $token, time() + 3600 * 24 * 30 * 12 * 10);


        }
        //if(isset()){}
        if (isset($_COOKIE) &&
            array_key_exists('inat_code', $_COOKIE) &&
            (!array_key_exists('inat_access_token', $_COOKIE) || $_COOKIE['inat_access_token'] == NULL)
        ) {
            //d('isset cookie');
            /** Get the access_token **/
            $code = $_COOKIE['inat_code'];
            $client_id = get_option('inat_login_id', '');
            $client_secret = get_option('inat_login_secret', '');
            $redirect_uri = get_option('inat_login_callback', '');

            $data = 'client_id=' . $client_id . '&client_secret=' . $client_secret . '&code=' . $code . '&redirect_uri=' . $redirect_uri . '&grant_type=authorization_code';
            $url = get_option('inat_base_url') . '/oauth/token';

            //d($data);

            $opt = array(
                'method' => 'POST',
                'content' => $data,
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($data) . "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",);
//        $opt = array('method' => 'POST', 'content' => $data, 'header' => array('Content-Type' => 'application/x-www-form-urlencoded'));
            $options = array(
                'http' => $opt
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $req = json_decode($result);
            setcookie('inat_access_token', $req->access_token,time()+3600);
        }

    }
