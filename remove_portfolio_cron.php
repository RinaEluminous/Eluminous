<?php
define( 'ABSPATH', dirname(__FILE__) . '/' );
$eluminFilename = ABSPATH."portfolio";
require 'cron/PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
 
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'a2ztester06@gmail.com';
$mail->Password = '1234test1234';

$mail->SMTPSecure = "ssl";
$mail->Port = 465; 

$mail->From = 'eluminous_sse17@eluminoustechnologies.com';
$mail->FromName = 'Eluminous Technologies';
/*$mail->addAddress('nitin_mahajan@eluminoustechnologies.com', 'Nitin Mahajan');*/
$mail->addAddress('eluminous_sse17@eluminoustechnologies.com', 'Ashwini Bhosales');
 
$mail->addReplyTo('test@test.com', 'testing');
 
$mail->WordWrap = 50;
$mail->isHTML(true);

if (file_exists($eluminFilename)) {
	
/*	foreach(glob("{$eluminFilename}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    } */


    foreach(scandir($eluminFilename) as $file) {
	echo $file.'<br>';
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$eluminFilename/$file")) rmdir_recursive("$eluminFilename/$file");
        else unlink("$eluminFilename/$file");
    }

	if(rmdir($eluminFilename)){
		$mail->Subject = 'Eluminous - Oops! found a portfolio folder.';
		$mail->Body    = 'Portfolio folder is found in file structure and has been removed on '.date('jS M, Y h:i A');
	} else{
		$mail->Subject = 'Eluminous - Oops! found a portfolio folder.';
		$mail->Body    = 'Unable to delete folder on '.date('jS M, Y h:i A');
	}
	
} 
else{
	$mail->Subject = 'Eluminous - All is well, no portfolio folder.';
	$mail->Body    = 'Reviwewd on '.date('jS M, Y h:i A').' and it seems that there in no portfolio folder exist.';
}

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent';
?>