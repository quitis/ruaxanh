<?php

class Client_Api
{
	function add_event_client( $name,$email,$photo,$phone='' ){
		global $wpdb;
		$wpdb->insert( 
			'ruaxanh_event_clients', 
			array( 
				'NAME' => $name, 
				'EMAIL' => $email,
				'PHOTO' => $photo,
				'PHONE' => $phone,
			));
		return $wpdb->insert_id;
	}
	
	function get_event_client($id){
		global $wpdb;
		$sSQL = "SELECT * FROM ruaxanh_event_clients where ID = ".$id;
		$arResult = Array();
		$arResult = $wpdb->get_row($sSQL);
		return $arResult;
	}
}
