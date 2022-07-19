<?php

/*
 * Send Mail using SMTP of Domain direct-response-info.com
 * Return : (array) array('result' => Success/Error, 'status'=>'') 
 */
function fnSendMailSMTP()
{
	
	include("class.phpmailer.php");
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port =  '465';// or 587
	$mail->IsHTML(true);
	$mail->Username = 'eluminous_sse17@eluminoustechnologies.com';
	$mail->Password = 'romeo2012';
	$mail->SetFrom('Ashwini');
	$mail->Subject = 'SMTP Test';
	$mail->Body = "Hello, How are you?";
	$mail->AddAddress('eluminous_sse30@eluminoustechnologies.com');

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
$result = fnSendMailSMTP();
print_r($result);
if($result['result']== "Success")
{
	echo 'send';
}


	
	
?>