<?php
	
session_start();
//live site url
$base_url="https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

//localhost baseurl
//$base_url="http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';

include("phpmailer/configuration.php");
	
	if(isset($_REQUEST)){
			if ($_REQUEST['authentication'] == 'homeFormSubmissionDetails'){
				
				$companyName 		=  $_REQUEST['companyName'];
				$name 				=  $_REQUEST['name'];
				$email 				=  $_REQUEST['email'];
			    $mobile 			=  preg_replace('/[^0-9\-]/', '', $_REQUEST['mobile']);
			    $mobile 			=  str_replace('!','',$mobile);
			    $full_mobile 		=  $_REQUEST['country_code']."-". $mobile;
				$projectDetails 	=   $_REQUEST['projectDetails'];
				$projectType 		=  $_REQUEST['projectType'];
				$reasonContact 		=  $_REQUEST['reasonContact'];
				$hearAboutUs 		=  $_REQUEST['hearAboutUs'];


				$_SESSION['name'] = $name ;
				$admin_subject = 'Received New Enquiry from '.$name;	// Your Email Subject.
			
		        $message .= '<span style="display:block;color:#000;"> Hi Admin, </span>';
				$message .= '<span style="display:block;color:#000;">Received New Enquiry from eLuminous Technologies from contact page. Please have a look on user detail. Below is the user detail</span>';
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
								<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$full_mobile.'</td>
							</tr>';
			    $message .= '<tr>
								<td width="100px" style="padding: 4px 8px;border: 1px solid #efefef;">Project Details </td>
							<td style="padding: 4px 8px;border: 1px solid #efefef; text-align: left;">'.$projectDetails.'</td>
						</tr> 
					</tbody>
				</table>';
			
				$top = '<p style="text-align:center;margin:0px;padding:23px 10px;background:#2196f3;color:white;font-size:28px;width:500px">'.$subject.'</p>';
				$bottom = '<p style="width:500px;text-align:center;margin-top:10px;padding:15px;background-color:#efefef;font-size: 24px;">Thank You</p>';
				$messageFormate = '<p style="text-align:left;margin:0px;padding:23px 10px;background: #fff0;color:black;font-size:14px;border:  1px solid #efefef;">'.$message.'</p>';
				

				include("phpmailer/admin_mail_header.php");

			    $mailSubject .= ' '.$messageFormate;
				include("phpmailer/admin_mail_footer.php");
	

				if($_REQUEST['businessintelligencesolutions'] == "sachine"){
					send_email_admin('sachin_shelke@eluminoustechnologies.com', "eLuminous", $admin_subject, $mailSubject);  
				}		
				
			
				foreach(admin_mail as $admin)
					{
						send_email_admin($admin, "eLuminous", $admin_subject, $mailSubject);
					}
			
				//--------------------------------------User mail function --------------------------

				
				$subject = 'Thank you for contacting eLuminous Technologies';	// Your Email Subject.			
				$skype_account = "eluminoustechnologies?chat";
				include("phpmailer/user_mail_header.php");
				
				$mailSubject .='<tr><td><span style="font-size:16px;line-height:20px;color:#333;font-family:Segoe UI,Tahoma">Hello '.$name.',<br> <br>Thank you! We have received your request for Web Development/Mobile App/Front end Development/Business Intelligence.<br> <br>eLuminous Technologies success relies on the success of our customers. Following the latest technology trends, we help them in driving more agile process with our proven IT Solutions.<br><br>One of our representative will get in touch with you shortly to get an overview of your project ideas & offer solutions tailored for your needs.<br><br>We look forward providing top-notch quality service to you. Thank you once again for your time & consideration.<br><br>Best Regards,<br>Team eLuminous Technologies</b><br><br></span></td></tr>';

					include("phpmailer/user_mail_footer.php");
				
				
				send_email_user($email, $name, $subject, $mailSubject);
				
				
				

			}
	}
	
	?>
