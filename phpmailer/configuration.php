<?php
include("class.phpmailer.php");
define("SMTPDebug","0");
define("SMTPAuth",true);
define("SMTPSecure","ssl");
define("Host","smtp.gmail.com");
define("Port","465");
define("Username","biz@eluminoustechnologies.com");
define("Password","3D>m8WW&");
define("SetFrom","biz@eluminoustechnologies.com");
		
define('admin_mail', ['sk@eluminoustechnologies.com','gauri@eluminoustechnologies.com','biz@eluminoustechnologies.com']);	
	

	function send_email_admin($to, $user, $subject, $body )
{

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = SMTPDebug;
	$mail->SMTPAuth = SMTPAuth;
	$mail->SMTPSecure = SMTPSecure;
	$mail->Host = Host;
	$mail->Port =  Port;
	$mail->IsHTML(true);
	$mail->Username = Username;
	$mail->Password = Password;														
	$mail->AddAddress($to, $user);
	$mail->SetFrom('biz@eluminoustechnologies.com','eLuminous');
	
	
	$mail->Subject = $subject;
	$content = $body;
	$mail->MsgHTML($content); 
	if(!$mail->Send())
	{
		return false;
	} 
	else
	{
		return true;		
	}
}


	function send_email_user($to, $user, $subject, $body )
{

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = SMTPDebug;
	$mail->SMTPAuth = SMTPAuth;
	$mail->SMTPSecure = SMTPSecure;
	$mail->Host = Host;
	$mail->Port =  Port;
	$mail->IsHTML(true);
	$mail->Username = Username;
	$mail->Password = Password;														
	$mail->AddAddress($to, $user);
	$mail->SetFrom('biz@eluminoustechnologies.com','eLuminous');
	$mail->Subject = $subject;
	$content = $body;
	$mail->MsgHTML($content); 
	if(!$mail->Send())
	{
		return false;
	} 
	else
	{
		return true;		
	}
}

function send_email_user_attachment($to, $user, $subject, $body,$attachment )
{

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = SMTPDebug;
	$mail->SMTPAuth = SMTPAuth;
	$mail->SMTPSecure = SMTPSecure;
	$mail->Host = Host;
	$mail->Port =  Port;
	$mail->IsHTML(true);
	$mail->Username = Username;
	$mail->Password = Password;														
	$mail->AddAddress($to, $user);
	$mail->SetFrom('biz@eluminoustechnologies.com','eLuminous');
	$mail->addAttachment($attachment);
	
	$mail->Subject = $subject;
	$content = $body;
	$mail->MsgHTML($content); 
	if(!$mail->Send())
	{
		return false;
	} 
	else
	{
		return true;		
	}
}