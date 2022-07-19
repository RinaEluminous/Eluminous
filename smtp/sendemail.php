<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require("phpmailer/src/PHPMailer.php");
	require("phpmailer/src/SMTP.php");
	require("phpmailer/src/Exception.php");

	
	$mail = new PHPMailer\PHPMailer\PHPMailer();

	//$mail = new PHPMailer;

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->SMTPSecure = 'ssl'; 
	$mail->Username = "vishavjeet@tinkit.se";
	$mail->Password = "ilovepapa@1";

	$mail->From = '';
	$mail->FromName = 'Mailer';
	$mail->addAddress('eluminous_se30@eluminoustechnologies.com', 'Joe User');     // Add a recipient
	
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	echo 'Message has been sent';
	}

		
?>