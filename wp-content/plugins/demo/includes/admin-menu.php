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
	//include_once('templates/event-client.php');
}
 
add_action('admin_menu', 'add_admin_menu');
?>
