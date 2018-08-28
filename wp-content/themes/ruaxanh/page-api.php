<?php
/**
 * Template Name: Custom Page Template
 */
$return = array(
   'message'  => 'Sucessful',
	'code' => 1,
	'data' => array()
);

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    // call the save function.
	if( isset($_GET['id']) && intval($_GET['id'])>0 ){
		$client = new Client_Api();
		$return['data'] = $client->get_event_client($_GET['id']);
	}else{
		$return['message'] = 'Missing client id';
		$return['code'] = -1;
	}
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	if( !isset($_POST['client_name']) || !isset($_POST['client_email'])){
		$return['message'] = 'Missing fields';	
		$return['code'] = -2;
	}
	
	if(  $return['code']==1 ){
		if( empty($_POST['client_name']) || empty($_POST['client_email']) ){
			$return['message'] = 'Empty fields';
			$return['code'] = -3;
		}
	}
	
	if(  $return['code']==1 ){
		$client = new Client_Api();
		$name = trim($_POST['client_name']);
		$email = trim($_POST['client_email']);
		
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		
		$uploadedfile = $_FILES['client_photo'];

		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		$photo = $movefile['url'];
		$return['data'] = $client->add_event_client($name,$email,$photo);
	}
	
}

wp_send_json($return);