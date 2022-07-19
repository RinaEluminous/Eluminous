<?php
include_once("class.phpmailer.php");
/*$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '68c56404aa1e30';
$phpmailer->Password = 'af79b7d9701d0d';*/

$phpmailer = new PHPMailer();
$phpmailer->IsSMTP();
$phpmailer->Mailer = "smtp";
$phpmailer->CharSet = "UTF-8"; 
$phpmailer->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);
$phpmailer->SMTPDebug  = 2; 
$phpmailer->SMTPAuth   = true;
$phpmailer->SMTPSecure = "ssl";
$phpmailer->Port       =  '465';
$phpmailer->Host       = "smtp.gmail.com";
$phpmailer->Username   = "biz@eluminoustechnologies.com";
$phpmailer->Password   = 'eLuTech#2021*hbu#98';
$phpmailer->IsHTML(true);
$phpmailer->Body = "Test Mail BY Akash";
$phpmailer->Subject = " Test Akash ";
$phpmailer->setFrom("mail@eluminoustechnologies.net", "eLuminous");
$phpmailer->AddAddress('theakashwagh@gmail.com', 'Akash');

if(!$phpmailer->Send())
{
	echo "Error sending: " . $phpmailer->ErrorInfo;
}
else
{
	echo "E-mail sent";
}
?>