<script src="js/jquery.min.js"></script>
<?php
include("class.phpmailer.php");
require_once('mail_functions.php');
$strThankYoumsg_1	=	$strThankYoumsg_2	=	'';
$strThankYoumsg		=	'Thank you for submitting enquiry.<br>One of our experts will contact you soon.';
$adminMail			=   'eluminous_bde3@eluminoustechnologies.com';
$adminMail_1		=   'eluminous_sse23@eluminoustechnologies.com'; //sales@eluminoustechnologies.com';
$adminMail_2		=	'priyank_purohit@eluminoustechnologies.com'; //'hrushikeshw@gmail.com' ;
$adminMail_3		=	'eluminous_bde7@eluminoustechnologies.com';

$admin_test_mail	=	'eluminous_sse30@eluminoustechnologies.com';

$AdminfromName		=	'Admin';
$adminMailsubject	=	'Received new enquiry';
$CustmorMailsubject	=	'Thanks for reaching out : eLuminous Technologies Pvt. Ltd.';
$AdminMailbody		=	$customerMailBody	=	'';
//--------------------------Call back Form Functionality Starts-------------------------------------------------------
if(isset($_REQUEST['get_btn']) && ($_REQUEST['get_btn']!="")){
	$strGetYourName = trim($_REQUEST['strGetYourName']);
	$strGetYourEmail	=	 trim($_REQUEST['strGetYourEmail']);
	$strGetYourSubject	=	 trim($_REQUEST['strGetYourSubject']);
	$getintoucharea	=	 trim($_REQUEST['getintoucharea']);
	$strAdminMailSubject	=	"Get In Touch Enquiry || ".$strGetYourSubject;
	$strAdminMailBody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/business-intelligence-services/images/eluminous-admin-logo-BI.png"  alt="logo" border="0" style="display:block; margin-left:15px;width:300px;height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><table rules="all" style="border:1px solid #cccccc;" cellpadding="5" width="100%">
         <tr style="background: #f4f4f4;">
          <td><strong>Name: </strong></td>
          <td>' . strip_tags($strGetYourName) . '</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Email id</strong>:</td>
          <td>'. strip_tags($strGetYourEmail) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Subject:</strong></td>
          <td>'. strip_tags($strGetYourSubject) .'</td>
        </tr>
		<tr style="background: #f4f4f4;">
          <td><strong>Message:</strong></td>
          <td>'. strip_tags($getintoucharea) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';

	// Admin Mail
	$isSend	=	sendmail($adminMail, $strGetYourEmail,	$strAdminMailSubject, $strAdminMailBody, $strGetYourName);
	$isSend	=	sendmail($adminMail_2, $strGetYourEmail,	$strAdminMailSubject, $strAdminMailBody, $strGetYourName);
	$isSend	=	sendmail($adminMail_3, $strGetYourEmail,	$strAdminMailSubject, $strAdminMailBody, $strGetYourName);
	// User Mail
	$strUserMailSubject	=	'Thank you !! eluminous Technologies';
	$strUserMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/outsourcing/img/eluminous-client-logo.png" alt="logo" border="0" style="display:block; margin-left:15px;width:300px; height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strGetYourName).',</strong><br>
      <p style="padding-top:10px; margin:0;">Thanks for taking the time to check out our site, and showing your interest!</p>
      <p style="padding-top:10px; margin:0;">One of our experts will contact you soon to talk about your potential fit with the service offering. Can you confirm the preferred time for calling you? Also, it will be great if you can let us know a bit about your requirements to make the conversation easier. </p>
      <p style="padding-top:10px; margin:0;">Look forward to your mail !  </p>
      
     </td>
  </tr>
  
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>';
	$isSend	=	sendmail($strGetYourEmail, $adminMail_2,	$strUserMailSubject, $strUserMailBody, 'eLuminous Technologies');
	?>
	<script type="text/javascript"> 
            $(document).ready(function(){
                 swal("Thank you!", "Thank you for contact with us. One of our experts will contact you soon for further discussion.", "success");
			});
           
        </script>
<?php
    unset($_POST['strGetYourName']);
    unset($_POST['strGetYourEmail']);
	unset($_REQUEST['strGetYourSubject']);
	unset($_REQUEST['getintoucharea']);
}
if(isset($_REQUEST['btn_request_callback']) && ($_REQUEST['btn_request_callback']!=''))
{
    $strName			=	trim($_REQUEST['your_name_1']) ? trim($_REQUEST['your_name_1']) : '' ;
	$strEmailAddress	=	trim($_REQUEST['your_email_address_1']) ? trim($_REQUEST['your_email_address_1']) : '' ;
	$strPhone			=	trim($_REQUEST['phone_1']) ? trim($_REQUEST['phone_1']) : '' ;
	$strCountry			=	trim($_REQUEST['country_1']) ? trim($_REQUEST['country_1']) : '' ;
	
	//Add user to mailchimp list start Ref :https://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php------
	require_once 'MCAPI.class.php';
	$apikey = '5e7454474599937e06be1c04740c87b8-us13';
	$listId = 'e52b8ac798';
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	
	// set $merge_vars to null if you have only one input
	$merge_vars = null;
	$merges = array('EMAIL'=>$strEmailAddress,'FNAME'=>$strName);
	 
	$update_existing=true;
	$data = array(
			'email_address'=>$strEmailAddress,
			'apikey'=>$apikey,
			'merge_vars' => $merges,
			'id' => $listId,
			'update_existing' => $update_existing,
			'double_optin' => false,
		);
	$payload = json_encode($data);
	 
	//replace us2 with your actual datacenter
	$submit_url = "http://us13.api.mailchimp.com/1.3/?method=listSubscribe";
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $submit_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
	 
	$result = curl_exec($ch);
	curl_close ($ch);
	$data = json_decode($result);
	if (isset($data->error)){
		echo $data->code .' : '.$data->error."\n";
	} else {
		//echo "success, look for the confirmation message\n";
	}
	//-------------------------------------------------------------------------------------------------
  
    $mail_from			=	$strEmailAddress;
	
    $AdminMailbody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/business-intelligence-services/images/eluminous-admin-logo-BI.png"  alt="logo" border="0" style="display:block; margin-left:15px;width:300px;height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><table rules="all" style="border:1px solid #cccccc;" cellpadding="5" width="100%">
         <tr style="background: #f4f4f4;">
          <td><strong>Name: </strong></td>
          <td>' . strip_tags($strName) . '</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Email id</strong>:</td>
          <td>'. strip_tags($strEmailAddress) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Phone:</strong></td>
          <td>'. strip_tags($strPhone) .'</td>
        </tr>
		<tr style="background: #f4f4f4;">
          <td><strong>Country:</strong></td>
          <td>'. strip_tags($strCountry) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	// Admin Mail
	$isSend	=	sendmail($adminMail, $mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	//$isSend	=	sendmail($adminMail_1,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	
	if($isSend){
		$strThankYoumsg_1	=	$strThankYoumsg;
	}
	// Custome Mail
	$customerMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/outsourcing/img/eluminous-client-logo.png" alt="logo" border="0" style="display:block; margin-left:15px;width:300px; height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strName).',</strong><br>
      <p style="padding-top:10px; margin:0;">Thanks for taking the time to check out our site, and showing your interest!</p>
      <p style="padding-top:10px; margin:0;">One of our experts will contact you soon to talk about your potential fit with the service offering. Can you confirm the preferred time for calling you? Also, it will be great if you can let us know a bit about your requirements to make the conversation easier. </p>
      <p style="padding-top:10px; margin:0;">Look forward to your mail !  </p>
      
     </td>
  </tr>
  
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	sendmail($strEmailAddress, $adminMail,$CustmorMailsubject, $customerMailBody, $AdminfromName);
        ?>
<script type="text/javascript"> 
            $(document).ready(function(){
                 swal("Thank you!", "Thank you for sharing your details. Our Sales Team will soon connect with you for further discussion.", "success");
				 //window.location.href = 'http://eluminoustechnologies.com/thankyou/';
                 /*setTimeout(function(){
                    //window.location.href = 'http://eluminousdev.com/mobile-app-development/';
                    window.location.href = 'http://eluminoustechnologies.com/thankyou/';
                 }, 1000);*/
            });
           
        </script>
<?php
        unset($_POST['your_name_1']);
        unset($_POST['your_email_address_1']);
		unset($_REQUEST['phone_1']);
		unset($_REQUEST['country_1']);
     
}
?>
<?php
//--------------------------Call back Form Functionality Starts-------------------------------------------------------
if(isset($_REQUEST['btn_connect_expert']) && ($_REQUEST['btn_connect_expert']!=''))
{
    $strName			=	trim($_REQUEST['your_name']) ? trim($_REQUEST['your_name']) : '' ;
	$strEmailAddress	=	trim($_REQUEST['your_email']) ? trim($_REQUEST['your_email']) : '' ;
	
	$strPhoneNumber		=	trim($_REQUEST['your_phone']) ? trim($_REQUEST['your_phone']) : '' ;	
	
	
	//Add user to mailchimp list start Ref :https://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php------
	require_once 'MCAPI.class.php';
	$apikey = '5e7454474599937e06be1c04740c87b8-us13';
	$listId = 'e52b8ac798';
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	
	// set $merge_vars to null if you have only one input
	$merge_vars = null;
	$merges = array('EMAIL'=>$strEmailAddress,'FNAME'=>$strName, 'PHONE'=>$strPhoneNumber);
	 
	$update_existing=true;
	$data = array(
			'email_address'=>$strEmailAddress,
			'apikey'=>$apikey,
			'merge_vars' => $merges,
			'id' => $listId,
			'update_existing' => $update_existing,
			'double_optin' => false,
		);
	$payload = json_encode($data);
	 
	//replace us2 with your actual datacenter
	$submit_url = "http://us13.api.mailchimp.com/1.3/?method=listSubscribe";
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $submit_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));
	 
	$result = curl_exec($ch);
	curl_close ($ch);
	$data = json_decode($result);
	if (isset($data->error)){
		echo $data->code .' : '.$data->error."\n";
	} else {
		//echo "success, look for the confirmation message\n";
	}
	//-------------------------------------------------------------------------------------------------
  
    $mail_from			=	$strEmailAddress;
	
    $AdminMailbody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/business-intelligence-services/images/eluminous-admin-logo-BI.png"  alt="logo" border="0" style="display:block; margin-left:15px;width:300px;height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><table rules="all" style="border:1px solid #cccccc;" cellpadding="5" width="100%">
         <tr style="background: #f4f4f4;">
          <td><strong>Name: </strong></td>
          <td>' . strip_tags($strName) . '</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Email id</strong>:</td>
          <td>'. strip_tags($strEmailAddress) .'</td>
        </tr> 
		
		<tr style="background: #f4f4f4;">
          <td><strong>Mobile Number</strong>:</td>
          <td>'. strip_tags($strPhoneNumber) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	// Admin Mail
	$isSend	=	sendmail($adminMail, $mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	//$isSend	=	sendmail($adminMail_1,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	
	if($isSend){
		$strThankYoumsg_1	=	$strThankYoumsg;
	}
	// Custome Mail
	$customerMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="http://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/outsourcing/img/eluminous-client-logo.png" alt="logo" border="0" style="display:block; margin-left:15px;width:300px; height:96px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strName).',</strong><br>
      <p style="padding-top:10px; margin:0;">Thanks for taking the time to check out our site, and showing your interest!</p>
      <p style="padding-top:10px; margin:0;">One of our experts will contact you soon to talk about your potential fit with the service offering. Can you confirm the preferred time for calling you? Also, it will be great if you can let us know a bit about your requirements to make the conversation easier. </p>
      <p style="padding-top:10px; margin:0;">Look forward to your mail !  </p>
      
     </td>
  </tr>
  
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	sendmail($strEmailAddress, $adminMail,$CustmorMailsubject, $customerMailBody, $AdminfromName);
        ?>
<script type="text/javascript"> 
            $(document).ready(function(){
                 swal("Thank you!", "Thank you for sharing your details. Our Sales Team will soon connect with you for further discussion.", "success");
				 //window.location.href = 'http://eluminoustechnologies.com/thankyou/';
                 /*setTimeout(function(){
                    //window.location.href = 'http://eluminousdev.com/mobile-app-development/';
                    window.location.href = 'http://eluminoustechnologies.com/thankyou/';
                 }, 1000);*/
            });
           
        </script>
<?php
        unset($_POST['your_name']);
        unset($_POST['your_email']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" itemprop="description" content="Our Business Intelligence Services provides the right decision support to the right people for the best business outcomes." />
<meta name="keywords" itemprop="keywords" content="business intelligence services, bi tools, pentaho developers, qlikview developers,  tableau developers, msbi developers" />
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-45111893-1', 'auto');
  ga('send', 'pageview');
</script>
<title>Business Intelligence Services/</title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/sticky-popup.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="dist/sweetalert.css">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">
</head>
<body>
<div id="top-bar" class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-8 col-xs-6">
        <div class="contact-info"> <span><i class="fa fa-phone" aria-hidden="true"></i> +91 0253 238 2566</span> <span><i class="fa fa-envelope" aria-hidden="true"></i> sales@eluminoustechnologies.com</span> </div>
      </div>
      <div class="col-md-4 pull-right social text-right">
        <ul>
          <li><a href="https://www.facebook.com/eluminoustech" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="https://twitter.com/eluminoustech" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="https://plus.google.com/b/102274258265995536485/+eLuminousTechnologiesPvtLtdNashik/posts/p/pub?gmbpt=true&pageId=102274258265995536485&hl=en" target="_blank"><i class="fa fa-google" aria-hidden="true"></i></a></li>
          <li><a href="http://www.linkedin.com/company/eluminous-technologies" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="header">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-9"><a href="#top-bar"><img src="images/logo.png"></a></div>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="logo">
          <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav">
            <li><a href="#top-bar">Home</a></li>
            <li><a href="#section-3">industries</a></li>
            <li><a href="#section-4">tools</a></li>
            <li><a href="#section-5">Case studies</a></li>
            <li><a href="#section-6">Mobile BI</a></li>
            <li><a href="#section-7">Team</a></li>
            <li><a href="#section-8">Contact</a></li>
          </ul>
          </li>
          </ul>
        </div>
        <!-- /navbar --> 
        
      </div>
    </div>
  </div>
</div>
<section id="main-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1>Business <span>Intelligence</span> Services</h1>
        <p>Providing the right decision support to the decision-makers for the best business outcomes.</p>
        <div class="header-form">
          <h2>Connect with the expert</h2>
          <form method="post" action="" name="connect_expert">
            <input name="your_name" required type="text" placeholder="FULL NAME">
            <input required name="your_email" type="email" placeholder="EMAIL">
            <input name="your_phone" required type="text" placeholder="MOBILE NUMBER">
            <input name="btn_connect_expert" type="submit" value="Let's Go!">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="section-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Benefits of Associating with us</h2>
        <aside>
          <h3>Save your Time </h3>
          <ul>
            <li>Experienced Developers</li>
            <li>Agile Development</li>
            <li>Smart Project Management</li>
          </ul>
        </aside>
        <aside>
          <h3>Add a Value to Business</h3>
          <ul>
            <li>Deeper Understanding &amp; Consulting</li>
            <li>Optimum Solution</li>
            <li>Well Tested Bug Free Output</li>
          </ul>
        </aside>
        <h4>& help you to achieve Desired Outcome</h4>
        <img src="images/business-up-arrow.jpg" alt=""> </div>
    </div>
  </div>
</section>
<section id="section-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>How we Work?</h2>
        <div class=" hidden-xs"><img src="images/chart.png" alt=""></div>
        <div class=" visible-xs">
          <ul>
            <li>Deeper Understanding and Problem Definition</li>
            <li>Project Analysis and Consulting</li>
            <li>Execution with Agile Methodology</li>
            <li>BI Execution Steps</li>
            <li>Data Sources</li>
            <li>Data Integration</li>
            <li>Data Warehousing</li>
            <li>Reporting &amp; analytics</li>
            <li>Deployment</li>
            <li>Deployment, Training and After Sales Support</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="section-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2>Industries</h2>
        <p>We have the expertise and experience in serving these industry sectors:</p>
      </div>
    </div>
    <div class="row indus-sec-1">
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-1.png"> <img class="white" src="images/indus-icon-white1.png">
          <h2>Healthcare</h2>
          <ul>
            <li>Readmissions Management</li>
            <li>Hospital Management</li>
            <li>Medical Device &amp; Instruments Supply Management</li>
            <li>Predictive Diagnostics </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-2.png"> <img class="white" src="images/indus-icon-white2.png">
          <h2>Retail</h2>
          <ul>
            <li>Order Management</li>
            <li>Sales and Marketing Intelligence</li>
            <li>Business Performance Management</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-3.png"> <img class="white" src="images/indus-icon-white3.png">
          <h2>Trading</h2>
          <ul>
            <li>Order Management</li>
            <li>Procurement/Spend Analytics</li>
            <li>Vendor Management</li>
            <li>Report Reconciliation</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-3.png"> <img class="white" src="images/indus-icon-white3.png">
          <h2>Finance</h2>
          <ul>
            <li>Financial Analytics</li>
            <li>Insurance</li>
            <li>Campaign to Cash Analysis</li>
            <li>Corporate performance management </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-5.png"> <img class="white" src="images/indus-icon-white5.png">
          <h2>Logistics</h2>
          <ul>
            <li>Supply Chain Management</li>
            <li>Transportation Management</li>
            <li>Warehouse Management</li>
            <li>Product Return Management</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="indus-sec"> <img src="images/indus-icon-6.png"> <img class="white" src="images/indus-icon-white6.png">
          <h2>Manufacturing</h2>
          <ul>
            <li>Production Planning</li>
            <li>Inventory Management</li>
            <li>Demand-Production-Sales </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="section-4">
  <div class="container">
    <h2 class="text-center">Tools</h2>
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="tool-sec tool-sec-1">
          <div class="img-sec"> <em><img src="images/tableau.png" alt=""></em> </div>
          <aside> <span>Speak to our BI Analyst</span> <a href="#section-8"><img src="images/big-right-arrow.png" alt=""></a> </aside>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="tool-sec tool-sec-2">
          <div class="img-sec"> <em><img src="images/qlik.png" alt=""></em> </div>
          <aside> <span>Connect with the expert</span> <a href="#section-8"><img src="images/big-right-arrow.png" alt=""></a> </aside>
        </div>
      </div>
    </div>
    <div class="row tool-last-sec">
      <div class="col-md-6 col-sm-6">
        <div class="tool-sec tool-sec-3">
          <div class="img-sec"> <em><img src="images/business.png" alt=""></em> </div>
          <aside> <span>Let's discuss BI</span> <a href="#section-8"><img src="images/big-right-arrow.png" alt=""></a> </aside>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="tool-sec tool-sec-4">
          <div class="img-sec"> <em><img src="images/pentaho.png" alt=""></em> </div>
          <aside> <span>Explore Pentaho with expert</span> <a href="#section-8"><img src="images/big-right-arrow.png" alt=""></a> </aside>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="section-5">
  <div class="container">
    <h2 class="text-center">Case studies</h2>
    <div class="row">
      <div class="col-md-12">
        <div class="case-sec"> <img src="images/img-1.png" alt="">
          <h3>Job portal reporting tool for a big placement company near NYC.</h3>
          <p>A placement company having office in more than 7-8 locations wanted to develop its market by utilizing its limited resources correctly. There were many factors including jobs available vs skills available by registered members, jobs available according to the location vs skills in that area, trend analysis of demand and Trend analysis of areas.</p>
          <a href="#">Read More</a> </div>
        <div class="case-sec"> <img src="images/img-2.png" alt="">
          <h3>Developing MAR Management Analysis Reports for MP Innovations</h3>
          <p>MP Innovations works in various verticals of Online Leads processing & eCommerce strategy n execution for its clientele. In every vertical they have many clients and process for each vertical is different.</p>
          <a href="#">Read More</a> </div>
        <div class="case-sec"> <img src="images/img-3.png" alt="">
          <h3>Development of comprehensive BI reporting solution with Pentaho</h3>
          <p>A leading Valves Manufacturing company in USA, having presence in 12 different locations out of which 8 are manufacturing plants and 4 are the regional controlling offices looking after the overall operations including Production, Finance and Sales</p>
          <a href="#">Read More</a> </div>
        <div class="case-sec no-border"> <img src="images/img-4.png" alt="">
          <h3>Consulting and Development- BI project for Tyre (tire) manufacturing company</h3>
          <p>Our client is a big player in tyre (tire) industry who purchases tyres (tire) from reputed manufacturers and wholesalers. They sell those tyres (tires) in 30 different countries with 3300 point-of-sales.</p>
          <a href="#">Read More</a> </div>
      </div>
    </div>
  </div>
</section>
<section id="section-6">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6"><img src="images/mobile-img.png" alt=""></div>
      <div class="col-md-6 col-sm-6">
        <h2>mobile bi</h2>
        <h3>Going Mobile is the need of an hour. </h3>
        <p>Need to make critical decisions while on flight or at odd business hours? Mobile business intelligence applications offers right set of information to the decision makers through its comprehensive dashboard on the mobile device. This can increase the productivity of business users, whether they're in corporate meetings or on the road.</p>
        <p>We offer Mobile BI solution which enables data and text mining with interactive analytics tools. Want to find out how you can implement Mobile BI in your organization? </p>
        <a href="#">Speak to the Expert</a> </div>
    </div>
  </div>
</section>
<section id="section-7">
  <div class="container">
    <div class="row">
      <h2>Our team</h2>
    </div>
    <div class="row team-sec">
      <div class="team-mem text-center"> <img src="images/Nitin.png" alt="">
        <h3>Nitin Mahajan</h3>
        <span>Project Manager</span> </div>
      <div class="team-mem text-center"> <img src="images/Sachin.png" alt="">
        <h3>Sachin Shelke</h3>
        <span>Sr. BI Consultant</span> </div>
      <div class="team-mem text-center"> <img src="images/Priyank.png" alt="">
        <h3>Priyank Purohit</h3>
        <span>Business Development Manager</span> </div>
      <div class="team-mem text-center"> <img src="images/anand.png" alt="">
        <h3>Anand Thorat</h3>
        <span>BI Consultant</span> </div>
      <div class="team-mem text-center last"> <img src="images/deepti.png" alt="">
        <h3>Deepti Ahire</h3>
        <span>BI Developer</span> </div>
      <div class="team-mem text-center last"> <img src="images/satish.png" alt="">
        <h3>Satish Harkal</h3>
        <span>BI Developer</span> </div>
    </div>
  </div>
</section>
<section id="section-8">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h2>Request a callback</h2>
        <p>Just fill-in the form below and we will get in touch with you as soon as possible.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
        <form method="post" action="" name="request_quote">
          <div class="col-sm-6 form-group">
            <input class="form-control" placeholder="Full Name" required name="your_name_1" type="text">
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" placeholder="Email" required name="your_email_address_1" type="text">
          </div>
          </div>
          <div class="row">
            <div class="col-sm-6 form-group"> 
              
              <!--<input type="text" class="form-control" placeholder="Country" required name="country_1">-->
              
              <select required="" name="country_1" class="form-control">
                <option value="">Select Country</option>
                <option value="">Select Country</option>
                <option value="Afganistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bonaire">Bonaire</option>
                <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Canary Islands">Canary Islands</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Channel Islands">Channel Islands</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos Island">Cocos Island</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote DIvoire">Cote D'Ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Curaco">Curacao</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="East Timor">East Timor</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands">Falkland Islands</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Ter">French Southern Ter</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Great Britain">Great Britain</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea North">Korea North</option>
                <option value="Korea Sout">Korea South</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macau">Macau</option>
                <option value="Macedonia">Macedonia</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Malawi">Malawi</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Midway Islands">Midway Islands</option>
                <option value="Moldova">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Nambia">Nambia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherland Antilles">Netherland Antilles</option>
                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                <option value="Nevis">Nevis</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau Island">Palau Island</option>
                <option value="Palestine">Palestine</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Phillipines">Philippines</option>
                <option value="Pitcairn Island">Pitcairn Island</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Republic of Montenegro">Republic of Montenegro</option>
                <option value="Republic of Serbia">Republic of Serbia</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="St Barthelemy">St Barthelemy</option>
                <option value="St Eustatius">St Eustatius</option>
                <option value="St Helena">St Helena</option>
                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                <option value="St Lucia">St Lucia</option>
                <option value="St Maarten">St Maarten</option>
                <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                <option value="Saipan">Saipan</option>
                <option value="Samoa">Samoa</option>
                <option value="Samoa American">Samoa American</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syria">Syria</option>
                <option value="Tahiti">Tahiti</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Erimates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States of America">United States of America</option>
                <option value="Uraguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Vatican City State">Vatican City State</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                <option value="Wake Island">Wake Island</option>
                <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                <option value="Yemen">Yemen</option>
                <option value="Zaire">Zaire</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
            <div class="col-sm-6 form-group">
              <input class="form-control" placeholder="Phone Number" required name="phone_1" type="text">
            </div>
          </div>
          <input class="btn btn-blue" value="Send" name="btn_request_callback" type="submit">
        </form>
      </div>
    </div>
  </div>
</section>
<footer>
  <div class="container">
    <p>Copyright &copy; 2016 eLuminous technologies Pvt. Ltd.</p>
  </div>
</footer>
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<!--<script src="js/jquery.min.js"></script>  --> 
<script src="dist/sweetalert-dev.js"></script> 
<!-- Sticky --> 
<script type="text/javascript">
		$(document).ready(function() {
			// grab the initial top offset of the navigation 
		   	var stickyNavTop = $('.header').offset().top;
		   	
		   	// our function that decides weather the navigation bar should have "fixed" css position or not.
		   	var stickyNav = function(){
			    var scrollTop = $(window).scrollTop(); // our current vertical position from the top
			         
			    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
			    // otherwise change it back to relative
			    if (scrollTop > stickyNavTop) { 
			        $('.header').addClass('sticky');
			    } else {
			        $('.header').removeClass('sticky'); 
			    }
			};
			stickyNav();
			// and run it again every time you scroll
			$(window).scroll(function() {
				stickyNav();
			});
			$('a[href^="#"]').on('click', function(event) {
   var target = $( $(this).attr('href') );
  
   if( target.length ) {
    event.preventDefault();
    $('html, body').animate({
     scrollTop: target.offset().top-75
    }, 600);
   }
  
  });
			
		});
		
	
	</script>
<div class="sticky-popup right-bottom open_sticky_popup popup-content-bounce-in-up" style="bottom: -402px; visibility: visible;"><div class="popup-wrap"><div class="popup-header"><span class="popup-title">GET IN TOUCH<div class="popup-image"></div></span></div><div class="popup-content"><div class="popup-content-pad"><div role="form" class="wpcf7" id="wpcf7-f1325-o2" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form action="" method="post" class="wpcf7-form">

<p><label> Your Name (required)<br>
    <span class="wpcf7-form-control-wrap your-name"><input type="text" name="strGetYourName" id="strGetYourName" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></span> </label></p>
<p><label> Your Email (required)<br>
    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="strGetYourEmail" id="strGetYourEmail" required value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"></span> </label></p>
<p><label> Subject<br>
    <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="strGetYourSubject" id="strGetYourSubject" required value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false"></span> </label></p>
<p><label> Your Message<br>
    <span class="wpcf7-form-control-wrap your-message"><textarea name="getintoucharea"  id="getintoucharea"cols="40" rows="10" required class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span>  </label></p>
<p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit btn btn-default" name="get_btn" id="get_btn" ><span class="ajax-loader"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>


<div class="swp-content-locator"></div></div></div></div></div>    
<!--<div class="sticky-popup right-bottom open_sticky_popup popup-content-bounce-in-up" style="bottom: -402px; visibility: visible;">
  <div class="popup-wrap">
    <div class="popup-header"><span class="popup-title">GET IN TOUCH
      <div class="popup-image"></div>
      </span></div>
    <div class="popup-content">
      <div class="popup-content-pad">
        <div role="form" class="wpcf7" id="wpcf7-f1325-o2" lang="en-US" dir="ltr">
          <div class="screen-reader-response"></div>
          <form action="" method="post" >
            <p>
              <label> Your Name (required)<br>
                <span class=" your-name">
                <input type="text" name="strGetYourName" value="" id="strGetYourName" required >
                </span> </label>
            </p>
            <p>
              <label> Your Email (required)<br>
                <span class=" your-email">
                <input type="email" name="strGetYourEmail"  id="strGetYourEmail" required>
                </span> </label>
            </p>
            <p>
              <label> Subject<br>
                <span class=" your-subject">
                <input type="text" name="strGetYourSubject" value="" id="strGetYourSubject"  required>
                </span> </label>
            </p>
            <p>
              <label> Your Message<br>
                <span class=" your-message">
                <textarea name="getintoucharea" cols="40" rows="5"  id="getintoucharea" required></textarea>
                </span> </label>
            </p>
            <p>
              <input type="submit" id="get_btn" name="get_btn" value="Send" class="btn btn-default">
            </p>
          </form>
        </div>
        <div class="swp-content-locator"></div>
      </div>
    </div>
  </div>
</div>-->
<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery("#get_btn").click(function(){
			var count = 0;
			var strGetYourName	=	jQuery("#strGetYourName").val().trim();
			var strGetYourEmail	=	jQuery("#strGetYourEmail").val().trim();
			var strGetYourSubject	=	jQuery("#strGetYourSubject").val().trim();
			var getintoucharea	=	jQuery("#getintoucharea").val().trim();
			if(strGetYourName == ''){
				count = 1;
				jQuery("#strGetYourName").css('border-color', 'red');
			}else{
				jQuery("#strGetYourName").css('border-color', '#e8e8e8');
			}
			if(strGetYourEmail == ''){
				count = 1;
				jQuery("#strGetYourEmail").css('border-color', 'red');
			}else{
				jQuery("#strGetYourEmail").css('border-color', '#e8e8e8');
			}
			if(strGetYourSubject == ''){
				count = 1;
				jQuery("#strGetYourSubject").css('border-color', 'red');
			}else{
				jQuery("#strGetYourSubject").css('border-color', '#e8e8e8');
			}
			if(getintoucharea == ''){
				count = 1;
				jQuery("#getintoucharea").css('border-color', 'red');
			}else{
				jQuery("#getintoucharea").css('border-color', '#e8e8e8');
			}
			if(count == 0){
				return true;
			}else{
				return false;
			}
		});
			
		jQuery( ".sticky-popup" ).addClass('right-bottom');
		var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
		jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );
		jQuery( ".sticky-popup" ).css( "visibility", "visible" );
		jQuery('.sticky-popup').addClass("open_sticky_popup");
		jQuery('.sticky-popup').addClass("popup-content-bounce-in-up");
		
		jQuery( ".popup-header" ).click(function() {
			if(jQuery('.sticky-popup').hasClass("open"))
			{
				jQuery('.sticky-popup').removeClass("open");
				jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );
			}
			else
			{
				jQuery('.sticky-popup').addClass("open");
				jQuery( ".sticky-popup" ).css( "bottom", 0 );		
			}
		  
		});		    
	});
</script> 
<script>
  $(function() {
    $('#navbar a[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
	$('a[href^="#"]').on('click', function(event) {
   var target = $( $(this).attr('href') );
  
   if( target.length ) {
    event.preventDefault();
    $('html, body').animate({
     scrollTop: target.offset().top-60
    }, 400);
   }
});
$('.nav a').click(function () {
    $('.navbar-collapse').collapse('hide');
});
  });
</script>
</body>
</html>