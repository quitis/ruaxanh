<?php
// Hàm bổ sung chữ freetuts.net vào chuỗi
function add_string_to_title($title)
{
    return 'freetuts.net - ' . $title;
}

function my_custom_menu_order( $menu_ord) {
	$curr_id = get_current_user_id();
	$user = new WP_User( $curr_id );
	
	foreach ( $user->roles as $role ){
		 switch($role){
			case 'subscriber':
				//if (!$menu_ord) return true;
				return array(
				'index.php', // Dashboard
				'plugins.php', // Plugins 
				);
				break;
		default:
			break;
		 }		
	}
}
 
// Đưa hàm add_string_to_title vào hook filter the_title
add_filter('the_title', 'add_string_to_title', 10, 1);
add_filter('custom_menu_order', 'my_custom_menu_order');
add_filter('menu_order', 'my_custom_menu_order');
?>
