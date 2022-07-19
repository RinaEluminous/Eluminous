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
	$dateday 	=  trim($_REQUEST['dateday']);
	$datetime	=  trim($_REQUEST['datetime']);
	/*-------------------------DATABASE ENTRY--------------------------*/
	 	
	$sql_booking='INSERT INTO tbl_booking_slot (name, email,bookingday,bookingtime) VALUES ("'.$name.'", "'.$email.'", "'.date("Y-m-d H:i:s",strtotime($dateday)).'", "'.$datetime .'");';
	
	$result_booking = mysqli_query($conn,$sql_booking);
	
	 $timeSlot = array(
	 	"Opt09" => "9 AM",
        "Opt010" => "10 AM",
        "Opt011" => "11 AM",
        "Opt12" => "12 PM",
        "Opt1" => "1 PM",
        "Opt2" => "2 PM",
        "Opt3" => "3 PM",
        "Opt4" => "4 PM",
        "Opt5" => "5 PM",
        "Opt6" => "6 PM",
        "Opt7" => "7 PM",
        "Opt8" => "8 PM",
        "Opt9" => "9 PM",
        "Opt10" => "10 PM",
        "Opt1" => "11 PM"

    );
	/*-------------------------DATABASE END--------------------------*/
	if($result_booking){

	    $message = '';
		$subject = 'Adwords Consultation Enquiry: Booking  Slot';	// Your Email Subject.

		$message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
		$message .= '<span style="display:block;color:#000;">Received New Enquiry from eLuminous Technologies for Web Development/Mobile App/Front end Development/Business Intelligence. Please have a look on user detail.Below is the user detail </span>';
		$message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;">
		<tbody>
		<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Name </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$name.'</td>
		</tr>';
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Email </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$email.'</td>
		</tr>';
		
		$message .= '<tr>
		<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Time Slot </td>
		<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$dateday.' @ '.$timeSlot[$datetime].'</td>
		</tr>';
		$message .= '	</tbody>
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
		$subject = 'Thank you! We have received your request for Web Development Service';	
		$skype_account = "eluminoustechnologies?chat";
		$mailSubject .='<tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">Hello '.$name.',<br> <br>Thank you! We have received your request for Web Development/Mobile App/Front end Development/Business Intelligence.<br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr>';
		include("phpmailer/user_mail_footer.php");
		send_email_user($email, $name, $subject, $mailSubject);
	}

}
?>