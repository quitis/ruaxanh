<?php
function add_admin_menu()
{
    add_menu_page (
            'Danh sách người dùng đã tham gia event', 
            'Event - Clients', 
            'read', 
            'event-client', 
            'show_event_client', 
            '', 
            '2'
    );
}
 
function show_event_client()
{
	global $mfpd;
	$mfpd = new Demo();
	
	$arFilter = array();
	
	if( isset($_REQUEST['usr_name']) ){
		$arFilter['usr_name'] = trim($_REQUEST['usr_name']);
	}
	
	if( isset($_REQUEST['usr_email']) ){
		$arFilter['usr_email'] = trim($_REQUEST['usr_email']);
	}
	
	if( isset($_REQUEST['usr_phone']) ){
		$arFilter['usr_phone'] = trim($_REQUEST['usr_phone']);
	}
	
	if( isset($_REQUEST['usr_datefrom']) ){
		$arFilter['date']['from'] = trim($_REQUEST['usr_datefrom']);
	}
	
	if( isset($_REQUEST['usr_dateto']) ){
		$arFilter['date']['to'] = trim($_REQUEST['usr_dateto']);
	}
	$clients = $mfpd->event_list($arFilter);
	$paging = $mfpd->paging($arFilter);
	$mfpd->view( 'event-client', array(
		'clients' => $clients,
		'paging' => $paging,
		'filter' => $arFilter
	) );
}
 
add_action('admin_menu', 'add_admin_menu');
?>
