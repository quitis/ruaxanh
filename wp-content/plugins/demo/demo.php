<?php
/**
 * Plugin Name: Demo 
 * Plugin URI: http://ruaxanh.net 
 * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi. 
 * Version: 1.0 
 * Author: Quitis 
 * Author URI: http://rua.net
 * License: GPLv2 or later 
 */
 
require 'includes/admin-menu.php';
 
 if(!class_exists('Demo')) {
	class Demo {
		function __construct() {
		}
		
		function event_list()
		{
			global $wpdb;
			$sSQL = "SELECT * FROM ruaxanh_event_clients";
			$arResult = Array();
			$arResult = $wpdb->get_results($sSQL);
			return $arResult;
		}

		function view( $name, array $args = array() ){
			$args = apply_filters( 'demo_view_arguments', $args, $name );		
			foreach ( $args AS $key => $val ) {
				$$key = $val;
			}

			$file =  'templates/'. $name . '.php';
			include( $file );
		}
	}
}
function mfpd_load() {
	global $mfpd;
	$mfpd = new Demo();
	//$clients = $mfpd->event_list();
	//$mfpd->view( 'event-client', array('clients' => $clients) );
	//print_r($client);
}

// function create_post_type() {
  // register_post_type( 'event_clients',
    // array(
      // 'labels' => array(
        // 'name' => __( 'Event Clients' ),
        // 'singular_name' => __( 'Client' )
      // ),
      // 'public' => true,
      // 'has_archive' => true,
	  // 'supports' => array('title','thumbnail','custom-fields'),
	  // 'rewrite' => array('slug' => 'event-client'),
    // )
  // );
// }
// add_action( 'init', 'create_post_type' );
add_action( 'plugins_loaded', 'mfpd_load' );
 
?>
