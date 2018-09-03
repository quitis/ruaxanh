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
	
	function resize_image($file, $w, $h, $crop=FALSE,$newfile='') {
		
		$infor 	 = getimagesize($file);
		$mime  = $infor['mime'];
		
		switch ($mime) {
			case 'image/jpeg':
					$image_create_func = 'imagecreatefromjpeg';
					$image_save_func = 'imagejpeg';
					break;
			case 'image/png':
					$image_create_func = 'imagecreatefrompng';
					$image_save_func = 'imagepng';
					break;
			case 'image/gif':
					$image_create_func = 'imagecreatefromgif';
					$image_save_func = 'imagegif';
					break;
			default: 
					throw new Exception('Unknown image type.');
		}
		
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = $image_create_func($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		$image_save_func($dst, $newfile,QUALITY);
		imagedestroy($dst);
	}
	
	function merge_image($file,$newfile)
	{
		
		$infor 	 = getimagesize($file);
		$mime  = $infor['mime'];
		
		switch ($mime) {
			case 'image/jpeg':
					$image_create_func = 'imagecreatefromjpeg';
					$image_save_func = 'imagejpeg';
					break;
			case 'image/png':
					$image_create_func = 'imagecreatefrompng';
					$image_save_func = 'imagepng';
					break;
			case 'image/gif':
					$image_create_func = 'imagecreatefromgif';
					$image_save_func = 'imagegif';
					break;
			default: 
					throw new Exception('Unknown image type.');
		}
		
		$image1 = $image_create_func($file); //300 x 300
		$border = get_template_directory()."/images/frame.png";
		$image2 = imagecreatefrompng($border);
		
		$merged_image = imagecreatetruecolor(PHOTO_WIDTH, PHOTO_HEIGHT);
		
		imagealphablending($merged_image, false);
		imagesavealpha($merged_image, true);

		imagecopy($merged_image, $image1, 0, 0, 0, 0, PHOTO_WIDTH, PHOTO_HEIGHT);
		// after first time of "imagecopy" change "imagealphablending"
		imagealphablending($merged_image, true);

		imagecopy($merged_image, $image2, 0, 0, 0, 0, PHOTO_WIDTH, PHOTO_HEIGHT);
		$image_save_func($merged_image , $newfile , QUALITY);
		imagedestroy($image1);
		imagedestroy($image2);
		imagedestroy($merged_image);
	}
	
}
