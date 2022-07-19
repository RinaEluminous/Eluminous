<?php
define("sender_email", "eluminous_se30@eluminoustechnologies.com");
include "class.phpmailer.php"; // include the 

	
	$mail = new PHPMailer(); // create a new object
	
	//print_r($mail);exit;
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "host.eluminoustechnologies.com";
	$mail->Port = 587; // or 587
	$mail->IsHTML(true);
	$mail->Username = "eluminous_se30@eluminoustechnologies.com";
	$mail->Password = "eluminous";
	//$mail->SetFrom($from);
	$mail->SetFrom('sales@eluminoustechnologies.com');

	//$address = "eluminous.se49@gmail.com"; // my email which I hope to receive the data inputed on the field
	$mail->AddAddress($to, $title);
	$mail->Subject = $subject;
	$mail->Body = $body;
	/*if($attachment && is_file($attachment)){
			$mail->AddAttachment($attachment);
	}*/
	
	return $mail->Send();
	

?>