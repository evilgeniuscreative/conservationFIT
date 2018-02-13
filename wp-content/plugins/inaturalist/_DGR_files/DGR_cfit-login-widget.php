<?php

class CFIT_Login_Widget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'cfit_login_widget',
            'description' => 'Login for ConservationFIT',
        );
        parent::__construct('cfit_login_widget', 'CFIT Login Widget', $widget_ops);
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        $current_user = wp_get_current_user();
        if (!$current_user->user_login) {
            $template = "/templates/cfit-login-form.php";
            $templatePath = dirname(__FILE__) . $template;

            $output = View::render($templatePath);

            echo $output;
        } else {
            echo "logged in";
        }


    }

    /*
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        // outputs the options form on admin
    }

    /*
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }
}

function register_cfit_login_widget()
{
    register_widget('CFIT_Login_Widget');
}

add_action('widgets_init', 'register_cfit_login_widget');
?>
