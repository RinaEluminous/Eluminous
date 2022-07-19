<?php

/*
 * Send Mail using SMTP of Domain direct-response-info.com
 * Return : (array) array('result' => Success/Error, 'status'=>'') 
 */
function fnSendMailSMTP($strSubject, $strMailContent, $strSendTo,$strSendFromName,$StrSendFromEmail,$arrSendCC = array())
{
	$arrResult = array();
	$strSendFromEmail = 'eluminous_sse18@eluminoustechnologies.com';
	$strSendFromName = "kalyani@1990";
	$strToName	=	'';
	include_once 'smtpMailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer();			
	$mail->isSMTP();					
	$mail->SMTPDebug 	= 0;						//Enable SMTP debugging>> 0 = off (for production use);	1 = client messages;	2 = client and server messages
	$mail->Debugoutput 	= 'html';		
	$mail->Host 		= 'eluminousdev.com';	//5.102.168.163			//Set the hostname of the mail server
	$mail->Port 		= 25;						//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->SMTPAuth 	= false;			
	
	$mail->Username 	= "";				//Username to use for SMTP authentication - use full email address for gmail
	$mail->Password 	= "";				//Password to use for SMTP authentication
	
	$mail->setFrom($strSendFromEmail, $strSendFromName);	//Set who the message is to be sent from
	$mail->addAddress($strSendTo, $strToName);	//Set who the message is to be sent to
	$mail->Subject = $strSubject;
	$mail->msgHTML($strMailContent);

	$boolResult = $mail->send();
	
	if (!$boolResult) {
		$arrResult = array('result' => 'Error', 'status' => $mail->ErrorInfo);
	} else {
		$arrResult = array('result' => 'Success', 'status' => '');
	}
	return $arrResult;
}

$mail_subject = 'Subject';
$mail_msg = 'Test mail from service SMTP';
$str_email = 'eluminous_sse30@eluminoustechnologies.com';
$result = fnSendMailSMTP($mail_subject, $mail_msg , $str_email,$strCustomFromName='STAUER',$strCustomFromEmail='stauer@direct-response-info.com');
print_r($result);
if($result['result']== "Success")
{
	echo 'send';
}
?>