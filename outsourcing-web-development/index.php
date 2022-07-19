<?php
error_reporting(0);
require_once('mail_functions.php');
include("class.phpmailer.php");
$strThankYoumsg_1	=	$strThankYoumsg_2	=	'';
$strThankYoumsg		=	'Thank you for submitting enquiry.<br>One of our experts will contact you soon.';
//$adminMail			=	'eluminous_sse23@eluminoustechnologies.com';
$adminMail_2		=	'hrushikeshw@gmail.com' ;
$adminMail_3		=	'ricky@pushgroup.co.uk' ;
$adminMail_4		=	'qam@pushgroup.co.uk' ;
$adminMail_5		=	'reece@pushgroup.co.uk' ;
$adminMail_6		=	'eluminous_bde3@eluminoustechnologies.com' ;
$adminMail_7		=	'eluminous_bde6@eluminoustechnologies.com' ;
 
$AdminfromName		=	'Admin';
$adminMailsubject	=	'Received new enquiry';
$CustmorMailsubject	=	'Your enquiry has been submitted successfully';
$AdminMailbody		=	$customerMailBody	=	'';
if(isset($_REQUEST['btn_submit_1']) && ($_REQUEST['btn_submit_1']!='')){
	
	$strName			=	trim($_REQUEST['your_name_1']) ? trim($_REQUEST['your_name_1']) : '' ;
	$strEmailAddress	=	trim($_REQUEST['your_email_address_1']) ? trim($_REQUEST['your_email_address_1']) : '' ;
	//$strSkyPe			=	trim($_REQUEST['skype_id_1']) ? trim($_REQUEST['skype_id_1']) : '' ;
	$strCountry			=	trim($_REQUEST['country_1']) ? trim($_REQUEST['country_1']) : '' ;
	$strPhone			=	trim($_REQUEST['phone_1']) ? trim($_REQUEST['phone_1']) : '' ;
	
	
	
	//-----------------Add user to mailchimp list start----------------------
	require_once 'MCAPI.class.php';

	$apikey = '76239c417a8a860a3ab4e83b2333c737-us2';
	$listId = 'f5f8296e9d';
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	 
	// create a new api object
	$api = new MCAPI($apikey);
	 
	// set $merge_vars to null if you have only one input
	$merge_vars = null;
	$merge_vars = array('FNAME'=>$strName);
	 
	if($email !== '') {
	 
	  $return_value = $api->listSubscribe( $listId, $strEmailAddress, $merge_vars, 'html', false, false, true, true );
	 
	  // check for error code
	  if ($api->errorCode){
		//echo "<p>Error: $api->errorCode, $api->errorMessage</p>";
	  } 
	}
	//-----------------Add user to mailchimp list end----------------------
	
	
	$mail_from			=	$strEmailAddress;
	
	$AdminMailbody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="#"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/logo.png" alt="logo" border="0" style="display:block; margin-left:15px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
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
        <!--<tr style="background: #f4f4f4;">
          <td><strong>Skype:</strong></td>
          <td>'. strip_tags($strSkyPe) .'</td>
        </tr>-->
        <tr style="background: #f4f4f4;">
          <td><strong>Country:</strong></td>
          <td>'. strip_tags($strCountry) .'</td>
        </tr>
		<tr style="background: #f4f4f4;">
          <td><strong>Phone:</strong></td>
          <td>'. strip_tags($strPhone) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	
	// Admin Mail
	//$isSend	=	sendmail($adminMail,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_3,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_4,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_5,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_6,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_7,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	if($isSend){
		$strThankYoumsg_1	=	$strThankYoumsg;
	}
	// Custome Mail
	$customerMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="#"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/logo.png" alt="logo" border="0" style="display:block; margin-left:15px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strName).',</strong><br>
      <p style="padding-top:10px; margin:0;">Thanks for your interest in our organization. One of our experts will contact you soon to talk about your potential fit with the service offering.</p></td>
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
        <!--<tr style="background: #f4f4f4;">
          <td><strong>Skype:</strong></td>
          <td>'. strip_tags($strSkyPe) .'</td>
        </tr>-->
        <tr style="background: #f4f4f4;">
          <td><strong>Country:</strong></td>
          <td>'. strip_tags($strCountry) .'</td>
        </tr>
		<tr style="background: #f4f4f4;">
          <td><strong>Phone:</strong></td>
          <td>'. strip_tags($strPhone) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	sendmail($strEmailAddress, $adminMail,$CustmorMailsubject, $customerMailBody, $AdminfromName);
}

if(isset($_REQUEST['btn_submit_2']) && ($_REQUEST['btn_submit_2']!='')){
	$services			=	'';
	$strName			=	trim($_REQUEST['your_name_2']) ? trim($_REQUEST['your_name_2']) : '' ;
	$strEmailAddress	=	trim($_REQUEST['your_email_address_2']) ? trim($_REQUEST['your_email_address_2']) : '' ;
	$intPhoneNumber		=	trim($_REQUEST['your_phone_2']) ? trim($_REQUEST['your_phone_2']) : '' ;
	$strCountry			=	trim($_REQUEST['country_2']) ? trim($_REQUEST['country_2']) : '' ;
	$arrServices		=	$_REQUEST['services_2'];
	if(count($arrServices)>0 && is_array($arrServices)){
		$services	=	 implode(',',$arrServices);
	}
	
	$mail_from	=	$strEmailAddress;
	
	
	//-----------------Add user to mailchimp list start----------------------
	require_once 'MCAPI.class.php';

	$apikey = '76239c417a8a860a3ab4e83b2333c737-us2';
	$listId = 'f5f8296e9d';
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	 
	// create a new api object
	$api = new MCAPI($apikey);
	 
	// set $merge_vars to null if you have only one input
	$merge_vars = null;
	$merge_vars = array('FNAME'=>$strName);
	 
	if($email !== '') {
	 
	  $return_value = $api->listSubscribe( $listId, $strEmailAddress, $merge_vars, 'html', false, false, true, true );
	 
	  // check for error code
	  if ($api->errorCode){
		//echo "<p>Error: $api->errorCode, $api->errorMessage</p>";
	  } 
	}
	//-----------------Add user to mailchimp list end----------------------
	
	
	$AdminMailbody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="#"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/logo.png" alt="logo" border="0" style="display:block; margin-left:15px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
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
          <td><strong>Phone Number:</strong></td>
          <td>'. strip_tags($intPhoneNumber) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Services:</strong></td>
          <td>'. strip_tags($services) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Country:</strong></td>
          <td>'. strip_tags($strCountry) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	
	// Admin Mail
	//$isSend	=	sendmail($adminMail,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_3,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_4,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_5,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_6,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	$isSend	=	sendmail($adminMail_7,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);
	if($isSend){
		$strThankYoumsg_2	=	$strThankYoumsg;
	}
	// Custome Mail
	$customerMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">
  <tr>
    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="#"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/logo.png" alt="logo" border="0" style="display:block; margin-left:15px;" /></a></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>
  </tr>
  <tr>
    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strName).',</strong><br>
      <p style="padding-top:10px; margin:0;">Thanks for your interest in our organization. One of our experts will contact you soon to talk about your potential fit with the service offering.</p></td>
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
          <td><strong>Phone Number:</strong></td>
          <td>'. strip_tags($intPhoneNumber) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Services:</strong></td>
          <td>'. strip_tags($services) .'</td>
        </tr>
        <tr style="background: #f4f4f4;">
          <td><strong>Country:</strong></td>
          <td>'. strip_tags($strCountry) .'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" align="center"><img src="http://eluminoustechnologies.com/outsourcing-web-development/images/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>
  </tr>
</table>
';
	sendmail($strEmailAddress, $adminMail,$CustmorMailsubject, $customerMailBody, $AdminfromName);
}
?>
<!doctype html>
<html>
     <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="description" content="Finding a reliable outsourced web development company in India is not easy. eLuminous offers a 75% extra value to your money as compared to others." />
	 <meta name="keywords" content="outsourced web development, outsourcing web development company, outsourcing web development India, outsourcing web development company, web design outsourcing companies">
     <title>Outsourced Web Development | Outsourcing Web Development</title>
     <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media='all' />
     <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media='all' />
     <link rel="stylesheet" href="css/animation.css" type="text/css" media='all' />
     <link rel="stylesheet" href="css/style.css" type="text/css" media='all' />
     <!-- favicon -->
     <link rel="shortcut icon" type="image/x-icon" href="http://eluminoustechnologies.com/wp-content/uploads/2014/08/favicon11.ico" />
     
     <script src="js/jquery-2.0.3.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script>
  $(document).ready(function(){
    $("#main-menu").sticky({topSpacing:0});
  });
  setTimeout(function() {
    $('#success_div_1').fadeOut('slow');
}, 9000);
</script>
     <script>
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {		
		//Active - START
		$( "a" ).each(function() {
		  $( this ).removeClass( "active" );
		});
		$(this).addClass("active");
		//Active - END
		
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
	</script>
     <script>
	 $(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
	
	
	$('a[href^="#"]').on('click', function(event) {

   var target = $( $(this).attr('href') );
  
   if( target.length ) {
    event.preventDefault();
    $('html, body').animate({
     scrollTop: target.offset().top-145
    }, 600);
   }
  
  });

});
     </script>
	  <!--Google Analytics - START -->
	  <script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-45111893-1', 'auto');
		ga('send', 'pageview');
	  </script>
	  <!--Google Analytics - END -->
     </head>
     <body>
     <div class="wrapper"><!-- wraper start-->
       
       <div id="header">
       		  <div class="subhead">
              	<div class="container">
                	<div class="col-md-12 topadd">
                	<span>Salamander Quay, Park Lane, London, UB9 6NZ </span> &nbsp;<small class="line">|</small>&nbsp; <span class="phone-no"><i class="fa fa-phone"></i><a href="tel:[020 3733 1140]"> 020 3733 1140</a></a></div>
               </div>     
                </div>
           
       
       
         <div class="container">         
           <div class="row">
             <div class="col-md-4"><a href="http://eluminoustechnologies.com/" target="_blank"><img src="images/logo.png"></a></div>
           </div>
           <div class="row">
             <div class="col-md-8 col-sm-7 header-text">
               <h1>Have you ever <strong>outsourced web development</strong> to a service provider who failed to deliver the promised quality and consistency?</h1>
               <h2>It's time for you to make some serious<br>changes in the system.</h2>
               <!--<h4>HOW ?</h4>-->
              <img src="images/coder.png"></div>
             <div class="col-md-4 col-sm-5 header-form">
               <div class="form-inner">
                 <h2>Start Your Free Trial</h2>
                 <span class="subheading">Discuss your needs with our team and start a free trial as soon as today!</span>
                 <?php 
				 if(isset($strThankYoumsg_1) && ($strThankYoumsg_1!='')){
					 echo '<p id="success_div_1">'.$strThankYoumsg_1.'</p>';
				 }
				 ?>
                 <form name="upper" method="POST" action="">
                   <p>
                     <label>Your Name<span>*</span></label>
                     <input  type="text" value="" name="your_name_1" required>
                   </p>
                   <p>
                     <label>Email Address<span>*</span></label>
                     <input  type="email" value="" name="your_email_address_1" required>
                   </p>
                   <!--<p>
                     <label>Skype Id</label>
                     <input  type="text" value="" name="skype_id_1">
                   </p>-->
                   <p>
                     <label>Country<span>*</span></label>
                     <select required name="country_1">
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
                   </p>
                   <p>
                     <label>Phone<span>*</span></label>
                     <input  type="text" value="" name="phone_1" required>
                   </p>
                   <p>
                     <input type="submit" value="GET FREE TRIAL" name="btn_submit_1" id="mc-embedded-subscribe" class="button" onClick="_gaq.push(['_trackEvent', 'DedicatedCategory', 'DedicatedAction', 'dedicatedLable',5]);">
                   </p>
                 </form>
               </div>
             </div>
           </div>
           <div class="row">
             <div id="main-menu" class="col-md-12">
               <nav class="navbar navbar-default">
                 <div class="container"> 
                   <!--<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>-->
                   <div id="navbar" class="navbar-collapse">
                     <ul class="nav navbar-nav">
                       <li class="gr"><a class="animated" href="#improve-brand-value"><img src="images/menu-icon-1.png"><span>Improve Brand Value</span></a></li>
                       <li class="re"><a class="animated" href="#end-to-end"><img src="images/menu-icon-2.png"><span>End To End Solution</span></a></li>
                       <li class="sk"><a class="animated" href="#roi"><img src="images/menu-icon-3.png"><span>Higher ROI</span></a></li>
                       <li class="le"><a class="animated" href="#smart"><img src="images/menu-icon-4.png"><span>Smart Process</span></a></li>
                       <li class="ye"><a class="animated" href="#business"><img src="images/menu-icon-5.png"><span>Business Growth</span></a></li>
                     </ul>
                   </div>
                   <!--/.nav-collapse --> 
                 </div>
               </nav>
             </div>
           </div>
         </div>
       </div>
       <div id="improve-brand-value" class="improve-brand-value">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <h2>What's your biggest headache?</h2>
               <h3><img src="images/q-icon.png">Your current outsourced web development partner is not creating any Brand value for
                 your business. </h3>
             </div>
           </div>
           <div class="row improve-brand-value-con ">
             <div class="col-md-3 col-sm-3 main-icon"><img src="images/im-icon-1.png"></div>
             <div class="col-md-9 col-sm-9">
               <p>Stop worrying, your brand is going to take off with us. </p>
               <span class="right-arrow-green">Here's our way out:</span>
               <ul class="vr-bullet">
                 <li>Deliver a tested product within given time</li>
                 <li>Offer a high-quality output</li>
                 <li>Quick consulting and execution of the concepts</li>
                 <li>Technically and commercially proficient developers</li>
               </ul>
               <ul class="hr-bullet">
                 <li><img src="images/im-icon-2.png"><span>Testing</span> </li>
                 <li><img src="images/im-icon-3.png"><span>Quality output</span> </li>
                 <li><img src="images/im-icon-4.png"><span>Consulting </span></li>
                 <li class="last"><img src="images/im-icon-5.png"><span>Qualified developers</span> </li>
               </ul>
             </div>
           </div>
         </div>
       </div>
       <div id="end-to-end" class="end-to-end">
         <div class="container">
           <div class="row end-to-end-con ">
             <div class="col-md-1 col-sm-1"><img src="images/q-icon1.png"></div>
             <div class="col-md-11 col-sm-11">
               <h3>You need to guide your current developers and train them constantly.
                 This is increasing your development cost. </h3>
               <h4>Did someone say "Business growth"? We know how to fix this, we replace "affecting" to "expanding".</h4>
               <div class="row">
                 <div class="col-md-9 col-sm-8"> <span class="right-arrow-red">Here's our way out:</span>
                   <ul class="vr-bullet-red">
                     <li>Offer highly-reliable developers</li>
                     <li>Maintain consistency in quality / productivity</li>
                     <li>Developers who are updated to the recent technologies</li>
                     <li>Assign project managers to resolve the project concerns (so that you don't have to)</li>
                     <li>Review (Daily, weekly, monthly)</li>
                   </ul>
                   <ul class="hr-bullet-red">
                     <li><img src="images/end-icon-2.png"><span>Reliability </span> </li>
                     <li><img src="images/end-icon-3.png"><span>Higher productivity </span> </li>
                     <li><img src="images/end-icon-4.png"><span>technical advancements </span></li>
                     <li><img src="images/end-icon-5.png"><span>Experienced Project managers </span> </li>
                     <li class="last"><img src="images/end-icon-6.png"><span>Review</span> </li>
                   </ul>
                 </div>
                 <div class="col-md-3 col-sm-4 main-icon"><img src="images/end-icon-1.png"></div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div id="roi" class="roi">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <h3><img src="images/q-icon.png">No decent ROI and plus you are losing your money for the ineffecient resources? </h3>
             </div>
           </div>
           <div class="row roi-con ">
             <div class="col-md-3 col-sm-3 main-icon"><img src="images/roi-icon-1.png"></div>
             <div class="col-md-9 col-sm-9">
               <p>Delivering "higher-than-expected ROI" is in eLuminous' DNA.</p>
               <span class="right-arrow-blue">Here's our way out:</span>
               <ul class="vr-bullet-blue">
                 <li>Save your excessive development and operating cost</li>
                 <li>Concentrate on enhancing GUI. (Cross browser testing, Spell-checks, UI/UX.)</li>
                 <li>Quick Analysis and Outcomes</li>
                 <li>Ensure smart work with the help of technology. (Saves time and money.)</li>
                 <li>Experienced team at lesser cost</li>
               </ul>
               <ul class="hr-bullet hr-bullet-blue">
                 <li><img src="images/roi-icon-2.png"><span>Save cost </span> </li>
                 <li><img src="images/roi-icon-3.png"><span>Best UI/UX </span> </li>
                 <li><img src="images/roi-icon-4.png"><span>Project Analysis </span></li>
                 <li><img src="images/roi-icon-5.png"><span>Smart work </span> </li>
                 <li class="last"><img src="images/roi-icon-6.png"><span>More benefits at less cost</span> </li>
               </ul>
             </div>
           </div>
         </div>
       </div>
       <div id="smart" class="smart">
         <div class="container">
           <div class="row smart-con ">
             <div class="col-md-1 col-sm-1"><img src="images/q-icon1.png"></div>
             <div class="col-md-11 col-sm-11">
               <h3>Totally annoyed with the silly mistakes and improper attention to detail? </h3>
               <h4>Making mistakes is human, but so is correcting them. Don't worry, our outsourced web development solution won't keep any stone unturned while delivering.</h4>
               <div class="row">
                 <div class="col-md-9 col-sm-7"> <span class="right-arrow-le">Here's our way out:</span>
                   <ul class="vr-bullet-le">
                     <li>Quick understanding of the concepts</li>
                     <li>English speaking developers for better after-sale communication</li>
                     <li>Feels like your in-house team</li>
                     <li>Accessibility (Available anytime in an hour of emergency.)</li>
                   </ul>
                   <ul class="hr-bullet-red hr-bullet-le">
                     <li><img src="images/smart-icon-2.png"><span>Better Understanding </span> </li>
                     <li><img src="images/smart-icon-3.png"><span>Good communication </span> </li>
                     <li><img src="images/smart-icon-4.png"><span>Teamwork </span></li>
                     <li class="last"><img src="images/smart-icon-5.png"><span>Accessible </span> </li>
                   </ul>
                 </div>
                 <div class="col-md-3 col-sm-4 main-icon"><img src="images/smart-icon-1.png"></div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div id="business" class="business">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <h3><img src="images/q-icon1.png"> <span>Unable to focus on your Business Growth due to constant disturbance from the developers?</span> </h3>
             </div>
           </div>
           <div class="row roi-con ">
             <div class="col-md-3 col-sm-3 main-icon"><img src="images/business-icon-1.png"></div>
             <div class="col-md-9 col-sm-9">
               <p>How about hiring a team who's good with management as well as technology?</p>
               <span class="right-arrow-ye">Here's our way out:</span>
               <ul class="vr-bullet-ye">
                 <li>Take each goal seriously</li>
                 <li>Support of a big team (big team= multiple ideas for business growth.)</li>
                 <li>Maintain transparency in handling the critical source codes</li>
                 <li>Use best of the technologies to develop your project</li>
               </ul>
               <ul class="hr-bullet hr-bullet-ye">
                 <li><img src="images/business-icon-2.png"><span>Goal Oriented </span> </li>
                 <li><img src="images/business-icon-3.png"><span>Multiple expertise </span> </li>
                 <li><img src="images/business-icon-4.png"><span>Transparency </span></li>
                 <li class="last"><img src="images/business-icon-5.png"><span>Latest Technologies. </span> </li>
               </ul>
             </div>
           </div>
         </div>
       </div>
       <div id="footer-text" class="footer-text">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <h2>Hiring a non-productive team is a massive expense. <span>It's not easy.</span> </h2>
               <p>Outsourcing web development to multiple locations and time zones can save some money, but organising them all can be extremely challenging.We know exactly how it feels. We've spent years studying what our clients precisely expect from their outsourcing partners</p>
               <h3>How can we be so sure about the quality and reliability?</h3>
               <div class="keybeni">KEY BENEFITS</div>
               <p class="benefit-tagline">These are some of the benefits that you too can enjoy, when you use our services:</p>
               <ul class="footer-text-list">
                 <li>We have a pool of over 200 A class developers who perfectly match the skills you and your business domain needs</li>
                 <li>Every developer you hire is a full time employee, fluent in English, and selective because they have the exact skills you need</li>
                 <li>There is no huge upfront financial outlay, and no long time contracts to sign on to </li>
                 <li>You can have a full access to the project management system for transparent reporting and scheduling </li>
                 <li>No cost for non-working days</li>
                 <li>A 12+ year's experienced project manager is assigned to every project that is undertaken</li>
               </ul>              
               <h4>You pay a low monthly rate and hire top-notch developers, who will report directly to you every working day.<br/>
                 <span>You'll have a complete access to the developer that you interview and hire</span></h4>
             </div>
           </div>
         </div>
         
         <div class="testimoni">
         	<div class="container">
            
            <div class="row">
                <div class="col-md-offset-1 col-md-10 text-center">
                <h2> Our Happy Clients</h2>
                </div>
              </div>            
            
            	<div class="row">                	
                    <div class="col-md-12">
                      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                          <li data-target="#quote-carousel" data-slide-to="1"></li>
                          <li data-target="#quote-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner">
                        
                          <!-- Quote 1 -->
                          <div class="item active">
                            <blockquote>
                              <div class="row">                                
                                <div class="col-sm-12">
                                  <p>"eLuminous Technologies has been handling all our software support for one of our sites for about 4 years now. They take care of customers right away in a courteous and professional manner. We've never had a complaint against them and we're very happy with their services."</p>
                                  <span class="testimonial-author-company">Jeremy Gislason,</span><small>Sacramento, California Area</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                          <!-- Quote 2 -->
                          <div class="item">
                            <blockquote>
                              <div class="row">                                
                                <div class="col-sm-12">
                                  <p>"eLuminous Technologies has been more than just an solution to our company's needs and requirements, in fact, they have been mission-critical to many of our inbuilt system processes and I honestly can say that they will continue to be part of our arm in business online and offline. Several applications have been developed to enhance the reach to our customers."</p>
                                 <span class="testimonial-author-company">Ryan Chua,</span><small>Singapore</small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                          <!-- Quote 3 -->
                          <div class="item">
                            <blockquote>
                              <div class="row">                                
                                <div class="col-sm-12">
                                  <p>"eLuminous Technologies has developed for me close to twenty software; that's 20 software. eLuminous Technologies is trustworthy, and that is the most important thing for us internet marketers. I even trusted them with my Paypal account! eLuminous Technologies is hard working. eLuminous Technologies delivers on time. eLuminous Technologies is smart and intelligent."</p><span class="testimonial-author-company">Mike Mograbi,</span><small> (Warrior Member) USA </small>
                                </div>
                              </div>
                            </blockquote>
                          </div>
                        </div>
                        
                        <!-- Carousel Buttons Next/Prev -->
                        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                      </div>                          
                    </div>
                    
                    
                    
                </div>
            </div>
         </div>
         
         
         
       </div>
       	<a href="#" id="thank-you" name="thank-you"></a>
       <div id="footer-contact" class="footer-contact">
       
         <div class="container">
           <div class="row footer-contact-ce">
             <div class="col-md-12">
               <h2>Start Your Free Trial</h2>
               <p>We don't share your information with anyone - We hate spam just as much as you do</p>
             </div>
           </div>
           
           <form name="lower" method="POST" action="#thank-you">
           
            <?php 
				 if(isset($strThankYoumsg_2) && ($strThankYoumsg_2!='')){
					 echo '<p id="success_div_1">'.$strThankYoumsg_2.'</p>';
				 }
				 ?>
             <div class="row footer-form footer-form-mr">
               <div class="col-md-6">
                 <label>Your Name<span>*</span> :</label>
                 <input type="text" name="your_name_2" value="" required>
               </div>
               <div class="col-md-6">
                 <label>Email Address<span>*</span> :</label>
                 <input type="text" name="your_email_address_2" value="" required>
               </div>
             </div>
             <div class="row footer-form">
               <div class="col-md-6">
                 <label>Phone<span>*</span>:</label>
                 <input type="text" name="your_phone_2" value="" required>
               </div>
               <div class="col-md-6">
                 <label>Country<span>*</span> :</label>
                 <select name="country_2" required>
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
             </div>
             <div class="row footer-form footer-form-full">
               <div class="col-md-12">
                 <label>Services<span>*</span> :</label>
                 <select class="" multiple="multiple" name="services_2[]" required>
                   <option value="Web Development">Web Development</option>
                   <option value="Web Design">Web Design</option>
                   <option value="Resources on hire">Resources on hire</option>
                 </select>
                 <p> Press &amp; Hold the Ctrl button to select multiple services </p>
                 <input type="submit" value="GET FREE TRIAL" name="btn_submit_2" id="mc-embedded-subscribe" class="button" onClick="_gaq.push(['_trackEvent', 'DedicatedCategory', 'DedicatedAction', 'dedicatedLable',5]);">
               </div>
             </div>
           </form>
         </div>
       </div>
       <div id="footer" class="footer">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <ul class="footer-nav">
                 <li><a href="http://eluminoustechnologies.com/" target="_blank">Home</a></li>
                 <li><a href="http://eluminoustechnologies.com/about-us/" target="_blank">About us </a></li>
                 <li><a href="http://eluminoustechnologies.com/services/" target="_blank">Services </a></li>
                 <li><a href="http://eluminoustechnologies.com/portfolio/" target="_blank">Portfolio </a></li>
                 <li><a href="http://eluminoustechnologies.com/blog/" target="_blank">Blog </a></li>
                 <li><a href="http://eluminoustechnologies.com/contact/" target="_blank">Contact</a></li>
               </ul>
               <p>Copyright © <?php echo date('Y');?> eLuminous technologies Pvt. Ltd</p>
             </div>
           </div>
         </div>
       </div>
       <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a> 
       <script>

  </script> 
       <script type="text/javascript" src="js/bootstrap.min.js"></script> 
       
       
       <script type="text/javascript">
	   		// When the DOM is ready, run this function
				$(document).ready(function() {
				  //Set the carousel options
				  $('#quote-carousel').carousel({
					pause: true,
					interval: 9000,
				  });
				});
	   </script>
       
       
     </div>
     <!-- wraper end-->
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T48B4X"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T48B4X');</script>
<!-- End Google Tag Manager -->
</body>
</html>
