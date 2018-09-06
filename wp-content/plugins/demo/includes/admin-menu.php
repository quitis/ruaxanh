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
	
	if( isset($_REQUEST['p']) ){
		$arFilter['current_page'] = trim($_REQUEST['p']);
	}
	
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
	$total = $mfpd->get_total($arFilter);
		
	$paging = $mfpd->paging($arFilter);
	$mfpd->view( 'event-client', array(
		'clients' => $clients,
		'paging' => $paging,
		'filter' => $arFilter,
		'total' => $total
	) );
}
 
add_action('admin_menu', 'add_admin_menu');
add_action('admin_init', 'export_csv');


function export_csv()
{
	if( isset($_REQUEST['page']) && $_REQUEST['page']=='event-client' && isset($_REQUEST['export']) && $_REQUEST['export']==1 ){
		
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
		$clients = $mfpd->get_for_csv($arFilter);
		
		$sCSV = "Name,Email,Phone,Date,Code\r\n";
		
		foreach($clients as $client){
			$sCSV .= $client->NAME.",";
			$sCSV .= $client->EMAIL.",";
			$sCSV .= $client->PHONE.",";
			$sCSV .= date('d/m/Y h:m A', strtotime($client->ADD_DATE)).",";
			$sCSV .= $client->CODE."\r\n";
		}
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"event_client.csv\";" );
		header("Content-Transfer-Encoding: binary");
		echo $sCSV;
		exit;
	}
}
?>
