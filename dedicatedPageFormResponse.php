<?php
session_start();
$base_url="https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
include("class.phpmailer.php");
	$mail = new PHPMailer(); // create a new object

	if(isset($_POST)) {
		if ($_POST['authentication'] == 'dedicatedFormSubmissionDetails') {

			#$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port =  '465';// or 587
			$mail->IsHTML(true);
			$mail->Username = 'biz@eluminoustechnologies.com';
			$mail->Password = '3D>m8WW&';
			

			$name			= $_POST['name'];
			$email			= $_POST['email'];
			$mobile			= preg_replace('/[^0-9\-]/', '', $_POST['mobile']);
			$mobile 			=  str_replace('!','',$mobile);
			$skypeId		= $_POST['skypeId'];
			$clientMessage	= $_POST['message'];

			$_SESSION['name'] = $name ;
			$subject = 'Received New Dedicated Developer Enquiry ';	// Your Email Subject.
			$message = "";
			$message .= '<span style="display:block;color:#000;">Hi Admin, </span>';
			$message .= '<span style="display:block;color:#000;">Below is the Dedicated Developer Enquiry </span>';
			$message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;"><tbody><tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Name </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$name.'</td></tr>';
			$message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Email </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$email.'</td></tr>';			
			$message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Mobile </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$mobile.'</td></tr>';			
			$message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Skype Id </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$skypeId.'</td></tr>';			
			$message .= '<tr><td style="padding: 4px 8px;border: 1px solid #efefef;">Message </td><td style="padding: 4px 8px;border: 1px solid #efefef;">'.$clientMessage.'</td></tr>';			

			$message .= '</tbody></table>';
			
			
			$top = '<p style="text-align:center;margin:0px;padding:23px 10px;background:#2196f3;color:white;font-size:28px;width:500px">'.$subject.'</p>';
			$bottom = '<p style="width:500px;text-align:center;margin-top:10px;padding:15px;background-color:#efefef;font-size: 24px;">Thank You</p>';
			$messageFormate = '<p style="text-align:left;margin:0px;padding:23px 10px;background: #fff0;color:black;font-size:14px;border:  1px solid #efefef;">'.$message.'</p>';
			$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$mail->Subject = $subject;
			$mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br> <a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">'; $mailSubject .= ' '.$messageFormate .'<tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be in Touch</span><br> <a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://plus.google.com/+eLuminousTechnologiesPvtLtdNashik"><img src="'.$base_url.'/mailer_data/connect-gplus.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.pinterest.com/eluminoustech/"><img src="'.$base_url.'/mailer_data/pinterest.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="skype:eluminoustechnologies?chat"><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2018 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';
			$mail->Body = $mailSubject;
			$mail->AddAddress('gauri@eluminoustechnologies.com', 'eLuminous Technologies Pvt Ltd Nashik'); 
			$mail->AddAddress('sales@eluminoustechnologies.com', 'eLuminous Technologies Pvt Ltd Nashik');
			// $mail->AddAddress('eluminous_se42@eluminoustechnologies.com', 'eLuminous Technologies Pvt Ltd Nashik');
			// $mail->AddAddress('akash_wagh@eluminoustechnologies.com','eLuminous Technologies Pvt Ltd Nashik'); 
			// $mail->AddAddress('eluminous.sse24@googlemail.com', 'eLuminous Technologies Pvt Ltd Nashik'); 
			$mail->setFrom('biz@eluminoustechnologies.com', 'eLuminous');
			
			
			$mail->send();

			$emailObject = new PHPMailer();
			//$emailObject->IsSMTP(); // enable SMTP
			$emailObject->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
			$emailObject->SMTPAuth = true; // authentication enabled
			$emailObject->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$emailObject->Host = 'smtp.gmail.com';
			$emailObject->Port =  '465';// or 587
			$emailObject->IsHTML(true);
			$emailObject->Username = 'biz@eluminoustechnologies.com';
			$emailObject->Password = '3D>m8WW&';
			$emailObject->SetFrom('biz@eluminoustechnologies.com','eLuminous');

			
			/*      */
			$subject = 'Dedicated Resource Enquiry is Submitted to eLuminous Technologies';	// Your Email Subject.			
			$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$emailObject->Subject = $subject;
			$mailSubject = '<body style="font-family: Arial, Helvetica, arial, Segoe UI,Tahoma, Verdana, Geneva, sans-serif; background-color:#fff;"><table style="width:580px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="90"><img src="'.$base_url.'/mailer_data/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd_black" width="200" style="display: block;"></td><td width="50%" style="text-align: right; font-weight:normal;"><span style="font-size:16px; color:#334455;font-family:Segoe UI,Tahoma arial;font-weight: bold;">+91 253 238 2566 <br><a style="color: #2196f3;text-decoration:none; " href="mailto:sales@eluminoustechnologies.com"> sales@eluminoustechnologies.com</a></span></td></tr></tbody></table></td></tr><tr><td valign="middle" height="265" bgcolor="#2196f3" style="font-family: arial,sans-serif;background-color: #2196f3;text-align: center;color: #fff;font-size: 45px;"><h1 style="font-family: arial,sans-serif;background-color: #2196f3;text-align: center;color: #fff;font-size: 45px;">Thank you <small style="text-transform: capitalize;font-size: 25px; display: block;font-weight: 300;">we have received your request</small></h1></td></tr></tbody></table></td></tr><tr><td><table style="width:100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td height="30">&nbsp;</td></tr><tr><td><span style="font-size:16px;line-height:20px;color:#334455;font-family:Segoe UI,Tahoma">';

			$mailSubject .='Hello '.$name.',<br> <br>Thank you! We have received your request. <br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr><tr style="border-top: 1px solid #dcdcdc;padding-top: 10px;display: block; text-align: center;"><td style="text-align: center;width:100%; display: block;" ><span style="font-size:16px;line-height:38px;color:#334455;font-family:Segoe UI,Tahoma; font-weight: 500; text-transform: capitalize;"> Be in Touch</span><br><a style="display: inline-block; margin-right:10px;" href="https://www.facebook.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-fb.png" alt="eluminous-pvt-ltd_black" width="39" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://plus.google.com/+eLuminousTechnologiesPvtLtdNashik"><img src="'.$base_url.'/mailer_data/connect-gplus.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g"><img src="'.$base_url.'/mailer_data/youtube-logotype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://twitter.com/eluminoustech"><img src="'.$base_url.'/mailer_data/connect-twitter.png" alt="eluminous-pvt-ltd_black" width="37" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.linkedin.com/company/eluminous-technologies"><img src="'.$base_url.'/mailer_data/connect-linkedin.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="https://www.pinterest.com/eluminoustech/"><img src="'.$base_url.'/mailer_data/pinterest.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><a style="display: inline-block; margin-right:10px;" href="skype:eluminoustechnologies?chat"><img src="'.$base_url.'/mailer_data/skype.png" alt="eluminous-pvt-ltd_black" width="38" height="39"></a><br> <br></td></tr></tbody></table></td></tr><tr><td><table style="width:100%; text-align: center; margin-top: 10px; padding:15px;background-color: #efefef;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td valign="middle" height="38"><span style="font-size:14px;color:#757575;font-family:Segoe UI,Tahoma"><a href="https://eluminoustechnologies.com/" style="color: #444444;text-decoration:none;font-size: 15px;">eLuminous technologies </a> © 2018 All Rights Reserved</span></td></tr></tbody></table></td></tr></tbody></table></body>';
			
			$emailObject->Body = $mailSubject;
			$emailObject->setFrom('gauri@eluminoustechnologies.com',' eLuminous Technologies Pvt Ltd Nashik ');
				//$emailObject->setFrom('eluminous_sse30@eluminoustechnologies.com',' eLuminous Technologies Pvt Ltd Nashik ');
			$emailObject->AddAddress($email, $name);
			$emailObject->addReplyTo('');
			$emailObject->send();

		}
	}
	
	?>