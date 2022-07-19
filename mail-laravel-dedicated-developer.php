<?php	
//print_r($_REQUEST);die;
//session_start();

$base_url="https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
	//$base_url="https://".$_SERVER['SERVER_NAME'].'/';
include_once("class.phpmailer.php");
//require_once('class.smtp.php');

	$mail = new PHPMailer(); // create a new object
	if(isset($_REQUEST)) {
		$formType = trim($_REQUEST['formType']);
		$name 					=  trim($_REQUEST['name']);
		$email 				=  trim($_REQUEST['email']);
		$number 			=  trim($_REQUEST['number']);
		$skype_id 	=  trim($_REQUEST['skype_id']);
		$comment 		=  trim($_REQUEST['comment']);
		$comment 		=  (isset($comment) && ($comment != "")) ? $comment : '-' ;
		$messageContent = "";

		$_SESSION['name'] = $name ;

	//	$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port =  '465';
		$mail->IsHTML(true);
		$mail->Username = 'biz@eluminoustechnologies.com';
		$mail->Password = 'eLuTech#2021*hbu#98';
		$mail->SetFrom('biz@eluminoustechnologies.com','eLuminous');
		$message = '';
		if($formType == 'laravelDeveloper'){
			$subject = 'New Enquiry: Hire Dedicated Laravel Developer';	// Your Email Subject.
			$messageContent = "Dedicated Laravel Developer";
		} else {
			$subject = 'New Enquiry: Hire Dedicated Developer';	// Your Email Subject.
			$messageContent = "Dedicated Developer";
		}
		
		$message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
		$message .= '<span style="display:block;color:#000;">Below is the user detail </span>';
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
						<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Number </td>
						<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$number.'</td>
					</tr>';
		$message .= '<tr>
						<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Skype </td>
						<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$skype_id.'</td>
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


		$header = 'Content-type: text/html; charset=iso-8859-1';

		$mail->Subject = $subject;
		$mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#333;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="0">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">';

		$mailSubject .= ' '.$messageFormate .'<tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#333;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be In Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://plus.google.com/+eLuminousTechnologiesPvtLtdNashik"><img src="'.$base_url.'/mailer_data/connect-gplus.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.pinterest.com/eluminoustech/"><img src="'.$base_url.'/mailer_data/pinterest.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="skype:eluminoustechnologies?chat"><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2002-'.date('Y').' All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';
		$mail->Body = $mailSubject;
		$mail->setFrom($email, $name);
		$mail->AddAddress('shweta_j@eluminoustechnologies.com', 'Shweta'); 
		$mail->AddAddress('sales@eluminoustechnologies.com', 'Sales');
		$mail->AddAddress('biz@eluminoustechnologies.com', 'Biz');

		$mail->send();
		
		$emailObject = new PHPMailer();
		$emailObject->IsSMTP();
		$emailObject->SMTPDebug = 2;
		$emailObject->SMTPAuth = true;
		$emailObject->SMTPSecure = 'ssl';
		$emailObject->Host = 'smtp.gmail.com';
		$emailObject->Port =  '465';
		$emailObject->IsHTML(true);
		$emailObject->Username = 'biz@eluminoustechnologies.com';
		$emailObject->Password = 'eLuTech#2021*hbu#98';
		$emailObject->SetFrom('biz@eluminoustechnologies.com','eLuminous');

		$subject = 'Thank you! We have received your enquiry';	
		$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "FROM: eLuminous Technologies Pvt Ltd Nashik <biz@eluminoustechnologies.com>\r\n";
		$emailObject->Subject = $subject;
		$mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#333;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr><tr><td valign="top" height="265"><img src="'.$base_url.'/mailer_data/thank-baneer.jpg" alt="eluminous-pvt-ltd_black" width="600"></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="30">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">';

		$mailSubject .='Hello '.$name.',<br> <br>Thank you! We have received your request for '.$messageContent.'.<br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr><tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#333;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be in Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://plus.google.com/+eLuminousTechnologiesPvtLtdNashik"><img src="'.$base_url.'/mailer_data/connect-gplus.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.pinterest.com/eluminoustech/"><img src="'.$base_url.'/mailer_data/pinterest.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="skype:eluminoustechnologies?chat"><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2002-'.date('Y').'All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';

		$emailObject->Body = $mailSubject;
		$emailObject->setFrom('biz@eluminoustechnologies.com', 'eluminous');
		$emailObject->AddAddress($email, $name);
		
		$emailObject->send();	
	}

	?>