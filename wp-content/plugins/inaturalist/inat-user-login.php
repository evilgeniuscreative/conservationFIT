<?php
require_once('includes/errors.inc');

/**
 * Adds INaturalist_Login widget.
 */
class INaturalist_Login extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'inaturalist_login',
            'description' => 'NEW iNaturalist Login Widget'
        );
        parent::__construct(
            'inaturalist_login', 'INAT LOGIN WIDGET', $widget_ops
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $instance['title'] = 'iNaturalist Login';
        $current_user = wp_get_current_user();
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];

        $data = inat_get_call('users/' . $current_user->user_login);

        if ($current_user->user_login) {
            // is logged in to WP, use WP username for iNaturalist by default
            if (isset($_POST['inat_username']) && isset($_POST['inat_password'])) {

                consoleLog('POSTED');
                $this->userLogin($_POST['inat_username'], $_POST['inat_password']);

            } else if ($data !== false) {
                consoleLog('VALID USERNAME');
                echo '<p class="login-notice">You are logged in to ConservationFIT. To upload observations, please also log in to iNaturalist with your ConservationFIT username, <em>' . $current_user->user_login . '</em></p>';
                ?>
                <form class="inat-login-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                      method="post">
                    <input type="hidden" name="action" value="inat_login_form">
                    <label for="inat_username">iNaturalist Username</label>
                    <input type="text" name="inat_username" id="inat_username"
                           value="<?php echo $current_user->user_login ?>"/>
                    <label for="inat_password">iNaturalist Password</label>
                    <input type="text" name="inat_password" id="inat_password" value="Pamplem0usse"/>
                    <input type="hidden" name="redirect" value="<?php echo the_permalink() ?>">
                    <button type="submit">Log In to iNaturalist</button>
                </form>
                <?php
            } else {
                echo '<p class="login-notice">There\'s no iNaturalist account using your ConservationFIT username, <em>' . $current_user->user_login . '</em>. Create one?</p>';
                ?>
                <form class="inat-create-user-form">
                    <label for="inat_username">iNaturalist Username <span class="required">*</span></label>
                    <input type="text" name="inat_username" id="inat_username"
                           value="<?php echo $current_user->user_login ?>"/> <label for="inat_username">iNaturalist
                        E-mail
                        <span class="required">*</span></label>
                    <input type="text" name="inat_email" id="inat_email"
                           value="<?php echo $current_user->user_email ?>"/>
                    <label for="inat_password">iNaturalist Password <span class="required">*</span></label>
                    <input type="password" name="inat_password" id="inat_password"/>
                    <label for="inat_pwd_conf">Confirm Password <span class="required">*</span></label>
                    <input type="password" name="inat_pwd_conf" id="inat_pwd_conf"/>
                    <input type="hidden" name="redirect" value="<?php echo the_permalink() ?>">
                    <button type="submit">Create Account</button>
                </form>
                <?php
            }
        } else {
            // is not logged in to wordpress
            echo 'Please <a href="' . wp_login_url(get_permalink()) . '">log in to your ConservationFIT account</a> before logging in to iNaturalist';
        }
        //print_r($data);
        //    $usertest =  get_option('inat_base_url')."/users/".$current_user->user_login;

        echo $args['after_widget'];
    }


    /**
     * Back-end widget form.
     * @see WP_Widget::form()
     * @param array $instance Previously saved values from database.
     * @return something
     */
    public function form($instance)
    {
        // outputs the options form on admin
        ?>

        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return instance
     */
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
        $instance = array();
        // $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }

} // class INaturalist_Login

// register INaturalist_Login widget
function register_inat_login_widget()
{
    register_widget('INaturalist_Login');
}

add_action('widgets_init', 'register_inat_login_widget');


function inat_user_login()
{
    //consoleLog('userLogin');
    if (isset($_POST['inat_username']) && isset($_POST['inat_password'])) {
        $client_id = get_option('inat_login_id', '');
        $client_secret = get_option('inat_login_secret', '');
        $redirect_uri = get_option('inat_login_callback', '');
        $data = 'client_id=' . $client_id . '&client_secret=' . $client_secret . '&redirect_uri=' . $redirect_uri . '&username=' . $_POST['inat_username'] . '&password=' . $_POST['inat_password'] . '&grant_type=password';
        $url = get_option('inat_base_url') . '/oauth/token';
        $opt = array(
            'method' => 'POST',
            'content' => $data,
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                "Content-Length: " . strlen($data) . "\r\n" .
                "User-Agent:MyAgent/1.0\r\n",);
        $options = array(
            'http' => $opt
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $tokenInfo = json_decode($result, true);
        $token = $tokenInfo['access_token'];
        $createdAt = $tokenInfo['created_at'];
        $headers = array("Authorization" => "Bearer $token");
        set_user_cookie('inat_access_token', $token);
       // inat_cookies($token);
//        print "<p>TOKEN:  $token</p>";
//        print "<p>CREATED AT:  $createdAt</p>";
//
//        print "<br/>COOKIE: ". $_COOKIE['inat_access_token'];
        //wp_redirect($_POST['redirect']);
    }
}

//add_action('admin_post_nopriv_inat_login_form', 'inat_user_login',10,2);
add_action('admin_post_inat_login_form', 'inat_user_login');

