<?php
/**
 * Plugin Name: carseller
 * Plugin URI: 
 * Description: carsellers plugin use this shortcode to show latest cars <strong>'[latest_cars number_of_cars_to_show]'</strong>
 * Version: 1.1.0
 * Author: Arun Kushwaha
 * Author URI:
 * License: GPL2
 */

include 'carseller-install.php';
include 'carseller-type.php';
include 'luxury-carseller.php';
include 'image_attachments.php';
include 'check_availability.php';
include 'carseller_setting.php';
include 'carseller_request_list.php';
include 'ajax_site_url.php';
include 'send_request_availability.php';
include 'get_carseller_page_template.php';
include 'category-list-widget.php';
// include 'admin-carsellers.php';
include 'nav-carsellers.php';



register_activation_hook( __FILE__, 'carsellers_install' );
register_activation_hook( __FILE__, 'carsellers_install_data' );


function mydid_flush_rewrite_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( 'init', 'mydid_flush_rewrite_rules');

function carseller_activate() {

    $admin_email=get_option( 'admin_email');
   
    $messageforcustomer="
		<table>
		<tbody>
		<tr><td>
		Website named <b>".site_url()."</b> has activated the carseller free plugin.
		</td>
		</tr>
		
		
		</tbody>
	</table>
		";
 	$subject='Website named '.site_url().' has activated the carseller free plugin';
	$headers[] = 'From:  <'.$admin_email.'>';
	wp_mail( 'helplive24x7@gmail.com', $subject, $messageforcustomer, $headers );
}
register_activation_hook( __FILE__, 'carseller_activate' );
function carseller_deactivation() {

    $admin_email=get_option( 'admin_email');
   
    $messageforcustomer="
		<table>
		<tbody>
		<tr><td>
		Website named <b>".site_url()."</b> has deactivated the carseller free plugin.
		</td>
		</tr>
		
		
		</tbody>
	</table>
		";
 	$subject='Website named '.site_url().' has deactivated the carseller free plugin';
	$headers[] = 'From:  <'.$admin_email.'>';
	wp_mail( 'helplive24x7@gmail.com', $subject, $messageforcustomer, $headers );
}
register_deactivation_hook( __FILE__, 'carseller_deactivation' );