<?php
error_reporting(E_ALL);
date_default_timezone_set("Asia/Calcutta");	
$base_url="https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
include("phpmailer/configuration.php");
include_once("connection.php");
$mail = new PHPMailer();
if(isset($_REQUEST))
{
	
	$name 				=  trim($_REQUEST['name']);
	$email 				=  trim($_REQUEST['email']);
	$companyName 				=  trim($_REQUEST['company_name']);
	$number_full 			=  trim($_REQUEST['full_number']);
	$number 			=  trim($_REQUEST['number']);
	$hire_for 			=  trim($_REQUEST['hire_for']);
	$number =  $_REQUEST['country_code']."-".str_replace('!', "", $number);
	//$skype_id 			=  trim($_REQUEST['skype_id']);
	$comment 		=  trim($_REQUEST['comment']);
	$comment 		=  (isset($comment) && ($comment != "")) ? $comment : '-' ;
	$IP_address = $_SERVER['REMOTE_ADDR']; 
	/*-------------------------DATABASE ENTRY--------------------------*/
	 
	$page_url = (isset($_REQUEST['page_url']) && ($_REQUEST['page_url'] != "")) ? $_REQUEST['page_url'] : '-' ;
	$sql_statement='INSERT INTO tbl_campaign_data (camp_id, name, email, phone_number, skype_id,message, IP_address, entry_date,`page_url`) VALUES ("3", "'.$name .'", "'.$email .'", "'.$number .'", "'.$companyName .'", "'.$comment .'", "'.$IP_address .'", "'.date('Y-m-d H:i:s').'", "'.$page_url.'");';
	$result = mysqli_query($conn,$sql_statement);
	/*-------------------------DATABASE END--------------------------*/
	$_SESSION['name'] = $name ;
	$message = '';
		$subject = 'New Enquiry: Hire '.$hire_for.' developers';	// Your Email Subject.

		$message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
		$message .= '<span style="display:block;color:#000;">Received New Enquiry from eLuminous Technologies for Hire '.$hire_for.' developers. Please have a look on user detail.Below is the user detail </span>';
		$message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;">
		<tbody>
		<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Name </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$name.'</td>
		</tr>';
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Company Name </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$companyName.'</td>
		</tr>';
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Email </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$email.'</td>
		</tr>';
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Number </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$number.'</td>
		</tr>';
		
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Message </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$comment.'</td>
		</tr> 
		</tbody>
		</table>';
		
		$top = '<p style="text-align:center;margin:0px;padding:23px 10px;background:#2196f3;color:white;font-size:28px;width:500px">'.$subject.'</p>';
		$bottom = '<p style="width:500px;text-align:center;margin-top:10px;padding:15px;background-color:#efefef;font-size: 24px;">Thank You</p>';
		$messageFormate = '<p style="text-align:left;margin:0px;padding:23px 10px;background: #fff0;color:black;font-size:14px;border:  1px solid #efefef;">'.$message.'</p>';

		include("phpmailer/admin_mail_header.php");
		$mailSubject .= ' '.$messageFormate;
		include("phpmailer/admin_mail_footer.php");

		
		foreach(admin_mail as $admin)
		{
			
			send_email_admin($admin, "eLuminous", $subject, $mailSubject);

		}
		
		include("phpmailer/user_mail_header.php");
		$subject = 'Thank you! We have received your request for Hire '.$hire_for.' developers';	
		$skype_account = "eluminoustechnologies?chat";
		$mailSubject .='<tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">Hello '.$name.',<br> <br>Thank you! We have received your request for Hire '.$hire_for.' developers.<br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr>';
		include("phpmailer/user_mail_footer.php");
		send_email_user($email, $name, $subject, $mailSubject);
	}
?>