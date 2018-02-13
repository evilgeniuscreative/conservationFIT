<?php
/**
 * The Header
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Cryout Creations
 * @subpackage nirvana
 * @since nirvana 0.5
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php cryout_meta_hook(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php
    cryout_header_hook();
    wp_head(); ?>
</head>
<body <?php

$current_user = wp_get_current_user();
if ($current_user->user_login == 'IanAtJMP') {
    body_class('superadmin'); ;
} else {
    body_class();
}
?> >

<?php cryout_body_hook(); ?>
<?php  if ($current_user->user_login == 'IanAtJMP') { ?>
<div class="ians-messages">
    <h1>Hello, Ian</h1>
    <dl>
        <dt>$_SESSION VARS</dt>
        <dd></dd>
        <dl>
            <dt>inat_access_token:</dt><dd><?php echo isset($_COOKIE['inat_access_token'])?$_COOKIE['inat_access_token']:'logged out of iNat' ?></dd>

        <dt>REQUEST_URI</dt><dd><?php
                preg_match(',/observation-single/(\d+)/,', $_SERVER['REQUEST_URI'], $matches);
                print_r($matches);

                ?></dd>
        </dl>
    </dl>
</div>
<?php } ?>
<div id="wrapper" class="hfeed">
    <!--    <div id="topbar">-->
    <!--        <div id="topbar-inner">-->
    <!--        </div>-->
    <!--    </div>-->
    <?php cryout_wrapper_hook(); ?>

    <div id="header-full">
        <?php
        $current_user = wp_get_current_user();
        if (!$current_user->user_login) {
            // user is not logged in, offer register or login  button

            ?>
            <div id="cfit-top-login">
                <a href="<?php echo wp_login_url(get_permalink()); ?>" title="Login">Login</a>
                <span>or</span>
                <a href="<?php echo wp_registration_url() . "&redirect_to=" . urlencode(get_permalink()); ?>"
                   title="Login">Register</a>
            </div>
            <?php
        }
        ?>
        <header id="header">
            <div id="masthead">
                <?php cryout_masthead_hook(); ?>
                <div id="branding" role="banner">
                    <?php // cryout_branding_hook(); ?>
                    <a href="<?php echo home_url() ?>" class="fitlogo"><img
                                src="<?php echo get_stylesheet_directory_uri() ?>/theme-images/logo-FIT-400.png"/></a>
                    <a href="<?php echo home_url() ?>" class="wtlogo"><img
                                src="<?php echo get_stylesheet_directory_uri() ?>/theme-images/logo-WT-333.png"/></a>
                    <?php cryout_header_widgets_hook(); ?>
                    <div style="clear:both;"></div>
                </div><!-- #branding -->

                <a id="nav-toggle"><span>&nbsp;</span></a>
                <nav id="access" role="navigation">
                    <?php cryout_access_hook(); ?>
                </nav><!-- #access -->


            </div><!-- #masthead -->
        </header><!-- #header -->
    </div><!-- #header-full -->

    <div style="clear:both;height:0;"></div>
    <?php cryout_breadcrumbs_hook(); ?>
    <div id="main">
        <?php cryout_main_hook(); ?>
        <div id="forbottom">
            <?php cryout_forbottom_hook(); ?>

            <div style="clear:both;"></div>