<?php
require_once('mail_functions.php');
include("class.phpmailer.php");
$strPopFname	=$_REQUEST['name'];
$strPopEmail	=$_REQUEST['email'];
$strPopPhone	=$_REQUEST['phone'];	
$message = '';
$adminMail	=	"eluminous_bde3@eluminoustechnologies.com";
$adminMail2	=	"eluminous_bde7@eluminoustechnologies.com";


$adminEmailFrom	=	$customerEmail = $strPopEmail ;
$adminMailsubject	=	"Enquiry for amazing offers";
$customerMailsubject	=	'Thank you for showing the interest in this amazing Chirstmas offer';

$AdminMailbody	=	"<p>Dear Admin,</p><p>".$strPopFname." has shown interest in amazing offer.</p><p>Here are the details: <br/><strong>Name</strong>: ".$strPopFname."<br/><strong>Phone Number:</strong>".$strPopPhone." <br/><strong>Email</strong>:".$strPopEmail."</p><p>Team eLuminous</p>";
$customerMailbody	=	"<p>Dear ".$strPopFname."</p><p>Thank you for showing the interest in this amazing offer. You are offically authorised to get a discount of $400 for your next project. To get a clear idea about your project, what would be a suitable channel to get in touch with you, and when? <p>
<p>Looking forward to hear from you!</p><p>Team eLuminous</p>";			


//-----------------Add user to mailchimp list start----------------------
  require_once 'MCAPI.class.php';

  $apikey = 'cd3fd2e7e4d879f3a4cddf90de30dd7d-us14';
  $listId = '93623ce4d9';//'f5f8296e9d'; 
  $apiUrl = 'http://api.mailchimp.com/1.3/';
   
  // create a new api object
  $api = new MCAPI($apikey);
   
  // set $merge_vars to null if you have only one input
  $merge_vars = null;
  $merge_vars = array('FNAME'=>$strPopFname, 'PHONE' => $strPopPhone);
   
  if($email !== '') {
   
    $return_value = $api->listSubscribe( $listId, $strPopEmail, $merge_vars, 'html', false, false, false, false );
  
    // check for error code
    if ($api->errorCode){
    	$message = "Error: $api->errorCode, $api->errorMessage";
    } else{
		$message = "Thank you for showing the interest in this amazing offer";
			
			// Admin Mail
			$isSend	=	sendmail($adminMail, $adminEmailFrom,	$adminMailsubject, $AdminMailbody, $strPopFname);
			$isSend	=	sendmail($adminMail2, $adminEmailFrom,	$adminMailsubject, $AdminMailbody, $strPopFname);
			// Customer Email
			$isSend	=	sendmail($customerEmail, $adminMail,	$customerMailsubject, $customerMailbody, 'Admin');
	}
  }else{
	  $message = "Email is is not valid";
  }
//-----------------Add user to mailchimp list end----------------------

echo json_encode(array('sts'=>'SUCC', 'msg'=> $message));


?>