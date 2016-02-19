<?php
/**
* Plugin Name: Wooster Login Page
* Plugin URI: http://technology.spaces.wooster.edu
* Description: This plugin will modify the WordPress login page to be Wooster branded.
* Version: 1.0.0
* Author: Jon Breitenbucher
* Author URI: http://jon.breitenbucher.net
* License: GPL2
*/

/*
Wooster Login Page (Wordpress Plugin)
Copyright (C) 2015 Jon Breitenbucher
Contact me at jbreitenbucher@wooster.edu

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

function wlp_login() {
echo '<link rel="stylesheet" type="text/css" href="' . plugins_url( 'css/style.css', __FILE__ ) . ' />"';
}
add_action('login_head', 'wlp_login');

function wlp_login_logo_url() {
switch_to_blog(1);
$site_url = network_site_url( '/' );
restore_current_blog();
return $site_url;
}
add_filter( 'login_headerurl', 'wlp_login_logo_url' );
function wlp_login_logo_url_title() {
switch_to_blog(1);
$site_title = get_bloginfo( 'name' );
restore_current_blog();
return $site_title;
}
add_filter( 'login_headertitle', 'wlp_login_logo_url_title' );

function wlp_login_error_override()
{
return 'Incorrect login details.';
}
add_filter('login_errors', 'wlp_login_error_override');

function wlp_login_head() {
remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'wlp_login_head');

function wlp_admin_login_redirect( $redirect_to, $request, $user )
{
global $user;
if( isset( $user->roles ) && is_array( $user->roles ) ) {
if( in_array( "administrator", $user->roles ) ) {
return $redirect_to;
} else {
return network_site_url( '/' );
}
}
else
{
return $redirect_to;
}
}
add_filter("login_redirect", "wlp_admin_login_redirect", 10, 3);

function wlp_login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'wlp_login_checked_remember_me' );
function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}