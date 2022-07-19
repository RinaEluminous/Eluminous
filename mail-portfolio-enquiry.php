<?php
error_reporting(E_ALL);
include_once('includes/constant.php');
date_default_timezone_set("Asia/Calcutta");	
$base_url="https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
include("phpmailer/configuration.php");
include_once("connection.php");
$mail = new PHPMailer();
// include mailchimp 
	include("class.MailChimp.php");
	$APIKEY = '4d3cda91f5a35f5121af8ceb4a27b04b-us20';
	$LISTID = '22ed4c4ad1';
	use \DrewM\MailChimp\MailChimp;
	$MailChimp = new MailChimp($APIKEY);
if(isset($_REQUEST))
{
	
	$email 	=  trim($_REQUEST['email']);
	$_SESSION['name'] = $email;

			// mailchimp
			$mailchimpUrl  = "lists/".$LISTID."/members";
			$mailchimpData = array('email_address' => $email, 'status' => 'subscribed');
			$result = $MailChimp->post($mailchimpUrl, $mailchimpData);

			$response = array();
			if ($MailChimp->success()) 
			{
				print_r($response);
			} else {
				//echo $MailChimp->getLastError();
				$response['type'] = 'error';
				$response['msg'] = 'You haev already subscribed. Use another email.';//$MailChimp->getLastError();
			}
			//echo json_encode($response);

			$message = '';
				$subject = 'New Enquiry: '.$email.' has subscribed to portfolio.';	// Your Email Subject.

				$message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
				$message .= '<span style="display:block;color:#000;">Received New Enquiry from eLuminous Technologies for Portfolio Subscription. Please have a look on user detail.Below is the user detail </span>';
				$message .= '<table border="0" cellspacing="0" cellpadding="0" style="border-color: #ffffff;font-size: 12px;width:100%;">
				<tbody>
				';
				
				$message .= '<tr>
				<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Email </td>
				<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$email.'</td>
				</tr>';
				
				$message .= ' 
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
					// print_r($admin);
					send_email_admin($admin, "eLuminous", $subject, $mailSubject);

				}
				
		      	//send_email_admin("eluminous_se38@eluminoustechnologies.com", "eLuminous", $subject, $mailSubject);

				include("phpmailer/user_mail_header.php");
				$subject = 'You have requested for Case Studies - eLuminous Technologies';	
				$skype_account = "eluminoustechnologies?chat";

				$mailSubject .='<tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">Hello '.$email.',<br> <br>Thank you! We have received your request for Web Development/Mobile App/Front end Development Case Studies.<br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving a more agile process with our proven IT Solutions.<br><br>Download the Case Studies - eLuminous Technologies attached with the email.<br><br>';
				$mailSubject .='<a target="self" href="'. SITE_URL .'download-file.php">Case Studies file</a><br><br>';
				$mailSubject .='Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr>';
				include("phpmailer/user_mail_footer.php");
				send_email_user_attachment($email, $email, $subject , $mailSubject,"images/pdf-file/Case Studies- eLuminous Technologies.pdf");
				
				//$response['type'] = 'success';
	
	}


?>