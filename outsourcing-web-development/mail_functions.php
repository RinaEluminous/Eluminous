<?php
function sendmail($mail_to , $mail_from, $subject, $body, $fromName){
	
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port =  '465';// or 587
	$mail->IsHTML(true);
	$mail->Username = 'sales@eluminoustechnologies.com';
	$mail->Password = 'priyank2012';
	$mail->From = $mail_from ;
	$mail->FromName = $fromName;
	$mail->Subject = $subject;
	$mail->Body = $body ;
	$mail->AddAddress($mail_to);
	
	if(!$mail->Send()){
		$SUCESS_MESSAGE = false;
	}
	else{
		$SUCESS_MESSAGE = true;
	}
	
	return $SUCESS_MESSAGE;
}