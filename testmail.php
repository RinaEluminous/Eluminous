<?php


	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	//$headers .= 'To: eLuminous <biz@eluminoustechnologies.com>' . "\r\n";
	$headers .= 'From: eLuminous Technologies Pvt Ltd Nashik <biz@eluminoustechnologies.com>' . "\r\n";
	//$headers .= 'Bcc: gauri@eluminoustechnologies.com' . "\r\n";
	//$headers .= 'Bcc: priyank_purohit@eluminoustechnologies.com' . "\r\n";
	//$headers .= 'Bcc: eluminous.sse24@gmail.com ' . "\r\n";
	$subject = 'Welcome to ET '.rand(100,1000); 
	// Mail to ETech
	 mail("eluminous.sse24@gmail.com",$subject , "This is test mail only", $headers);
	echo $subject;
?>