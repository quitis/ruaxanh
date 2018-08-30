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
		
		private $plugin_dir = '';
		private $page_size = 2;
		
		function __construct() {
			$this->plugin_dir = plugin_dir_path( __FILE__ );
		}
		
		function event_list( $arFilter = array(), $arSort = array() )
		{
			global $wpdb;
			
			$current_page = isset($arFilter['current_page'])?intval($arFilter['current_page']):1;
			$start = abs(($current_page-1)*$this->page_size);
			
			$sWhere = $this->buildCondition($arFilter);
			
			$sSQL = "SELECT * FROM ruaxanh_event_clients ".$sWhere." LIMIT ".$start.",".$this->page_size;
			$arResult = Array();
			$arResult = $wpdb->get_results($sSQL);
			
			return $arResult;
		}
		
		function paging( $arFilter = array() )
		{
			global $wpdb;
			$paged = isset($_GET['p'])?intval($_GET['p']):1;
			
			$sWhere = $this->buildCondition($arFilter);
			
			$total_row = $wpdb->get_var( "SELECT COUNT(*) FROM ruaxanh_event_clients".$sWhere );
			$last  = ceil( $total_row / $this->page_size );
			$links = array();
			$text = '';
			
			if( $last>1 ){
				/** Add current page to the array */
				if ( $paged >= 1 )
					$links[] = $paged;

				/** Add the pages around the current page to the array */
				if ( $paged >= 3 ) {
					$links[] = $paged - 1;
					$links[] = $paged - 2;
				}

				if ( ( $paged + 2 ) <= $last ) {
					$links[] = $paged + 2;
					$links[] = $paged + 1;
				}
				
				$cur_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				
				sort( $links );
				
				if( $paged>1 ){
					$text .= '<li><a href="'.$cur_url.'&p='.($paged-1).'"><< Trước</a></li>';
				}
				
				foreach ( (array) $links as $link ) {
					$class = $paged == $link ? ' class="active"' : '';
					$text .= '<li '.$class.'><a href="'.$cur_url.'&p='.$link.'">'.$link.'</a></li>';
				}
				
				if( $paged<$last ){
					$text .= '<li><a href="'.$cur_url.'&p='.($paged+1).'">Sau >></a></li>';
				}
			}		
			 
			return $text;
		}
		
		function buildCondition($arFilter)
		{
			$sWhere = '';
			foreach( $arFilter as $key => $value ){
				switch($key){
					case 'usr_name':
						if( $value!='' ){
							$sWhere .= $sWhere!=''?" AND ":"";
							$sWhere .= "NAME like '%".$value."%'";
						}						
					break;
					case 'usr_email':
						if( $value!='' ){
							$sWhere .= $sWhere!=''?" AND ":"";
							$sWhere .= "EMAIL like '%".$value."%'";
						}
					break;
					case 'usr_phone':
						if( $value!='' ){
							$sWhere .= $sWhere!=''?" AND ":"";
							$sWhere .= "PHONE like '%".$value."%'";
						}
					break;
					default:
						break;
				}
			}
			$sWhere =  $sWhere!=''?(" WHERE ".$sWhere):$sWhere;
			return $sWhere;
		}

		function view( $name, array $args = array() )
		{
			$args = apply_filters( 'demo_view_arguments', $args, $name );		
			foreach ( $args AS $key => $val ) {
				$$key = $val;
			}

			$file =  $this->plugin_dir.'includes/templates/'. $name . '.php';
			include( $file );
		}
	}
}
 
?>
