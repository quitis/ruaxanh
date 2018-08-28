<?php

function event_list()
{
	global $wpdb;
	$sSQL = "SELECT * FROM ruaxanh_event_clients";
	$arResult = Array();
	$arResult = $wpdb->get_results($sSQL);
	return $arResult;
}

?>
