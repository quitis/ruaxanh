<?php
/**
 * Template Name: Custom Page Template
 */
$return = array(
   'message'  => 'Sucessful',
	'code' => 1,
	'data' => array()
);

define("PHOTO_WIDTH", 596);
define("PHOTO_HEIGHT", 601);
define("QUALITY", 100);

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
	if(isset($_POST['action']) && $_POST['action'] === 'sent_email') {

        if (!isset($_POST['client_id']) || !isset($_POST['client_id'])) {
            $return['message'] = 'Missing fields: client_id';
            $return['code'] = -2;
        }
        if ($return['code'] == 1) {
            $client = new Client_Api();
            $arUser = $client->get_event_client($_POST['client_id']);

            /*Check if Sent Code or Not*/
            $clientEventCodeId = $arUser->EVENT_CODE_ID;
            if(intval($clientEventCodeId) == 0) {
                $arCode = $client->get_event_code_active();
                $user_email = $arUser->EMAIL;
                $user_name = $arUser->NAME;
                $code = $arCode->CODE;
                /*Sen mail*/
                $template = "<html>\n";
                $template .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px;\">\n";
                $template .= "<p>Hi <b>[[CLIENT_NAME]]</b></p>";
                $template .= "<p>Chúc mừng bạn đã nhận được quà tặng từ Old Navy Việt Nam.</p>";
                $template .= "<p>Mã code của bạn là: <b>[[EVENT_CODE]]<b></p>";
                $template .= "<p>Vui lòng xem chi tiết áp dụng mã code theo hình bên dưới</p>";
                $template .= "</body>\n";
                $template .= "</html>\n";
                $tokens = array(
                    'CLIENT_NAME' => $user_name,
                    'EVENT_CODE' => $code,
                );

                $pattern = '[[%s]]';

                $map = array();
                foreach ($tokens as $var => $value) {
                    $map[sprintf($pattern, $var)] = $value;
                }

                $message = strtr($template, $map);
                if (strlen($user_email) > 0 && strlen($code) > 0) {
                    //Auto sent Code to client Email
                    $emailSent = send_email_auto($user_email, "QUÀ TẶNG TỪ OLD NAVY VIỆT NAM", $message);
                    if ($emailSent) {
                        /*InActive Code*/
                    $client->update_event_code($arCode->ID,array('IS_SENT' => 'Y'));
                    $client->update_client_event_code($arUser->ID,$arCode->ID);
                    }
                } else {
                    $return['message'] = 'Email or Code is not exist.';
                    $return['code'] = -2;
                }
            } else {
                /*Code sent before*/
                $return['message'] = 'Code had been sent before.';
                $return['code'] = -3;
            }
        }
    } else {
	    /*Default Add User*/
        if (!isset($_POST['client_name']) || !isset($_POST['client_email'])) {
            $return['message'] = 'Missing fields';
            $return['code'] = -2;
        }

        if ($return['code'] == 1) {
            if (empty($_POST['client_name']) || empty($_POST['client_email'])) {
                $return['message'] = 'Empty fields';
                $return['code'] = -3;
            }
        }

        if ($return['code'] == 1) {
            $client = new Client_Api();
            $name = trim($_POST['client_name']);
            $email = trim($_POST['client_email']);
            $phone = isset($_POST['client_phone']) ? trim($_POST['client_phone']) : '';

            if (!function_exists('wp_handle_upload')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }

            $uploadedfile = $_FILES['client_photo'];

            $allowed = array('gif', 'png', 'jpg');
            $filename = $_FILES['client_photo']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $return['message'] = 'Photo type must be in gif,png,jpg';
                $return['code'] = -4;
            }

            if ($return['code'] == 1) {
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                $photo = $movefile['url'];
                $file_path = $movefile['file'];

                $client->resize_image($file_path, PHOTO_WIDTH, PHOTO_HEIGHT, false, $file_path);
                $client->merge_image($file_path, $file_path, $name);

                $objClient = $client->check_client_exist($email);

                if (empty($objClient)) {
                    $ID = $client->add_event_client($name, $email, $photo, $phone);
                } else {
                    $ID = $objClient->ID;
                    $arFields = array(
                        'NAME' => $name,
                        'EMAIL' => $email,
                        'PHOTO' => $photo,
                        'PHONE' => $phone,
                    );
                    $client->update_client($ID, $arFields);
                }
            }

            $return['data'] = array(
                "ID" => $ID,
                "PHOTO" => $photo
            );

        }
    }
	
}
date_default_timezone_set("Asia/Ho_Chi_Minh");
function send_email_auto($to, $subject, $message, $additional_headers, $additional_parameters)
{
    $headers  = "From: oldnavy2018campaig<noreply@oldnavy2018campaig.vn>\r\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    include_once(get_template_directory().'/phpmailer/PHPMailerAutoload.php');
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = "tls";
    $mail->Port = '587';
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    $mail->Username = 'oldnavy.herecomesthefun18@gmail.com';
    $mail->Password = 'oldnavy2018campaign';
    $mail->Subject = $subject;
    $mail->From = 'admin@oldnavy2018campaig.vn';
    $mail->FromName = 'admin@oldnavy2018campaig.vn';
    $mail->AddAttachment(get_template_directory().'/images/Anniversary Artwork_voucher-2.jpg');

    $mail->AddAddress($to);
    $mail->Body = $message;
    // $mail->Header = $additional_headers.PHP_EOL;
    $mail->Header = $headers.PHP_EOL;
    $result = $mail->send();
    return $result;
}
wp_send_json($return);