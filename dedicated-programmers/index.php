<?php


ob_start();
require_once('mail_functions.php');

include("class.phpmailer.php");

$form=0;

$email_val=1;

$strThankYoumsg_1	=	$strThankYoumsg_2	=	'';

$strThankYoumsg		=	'Thank you for submitting enquiry.<br>One of our experts will contact you soon.';

//$adminMail			=	'eluminous_sse23@eluminoustechnologies.com';

$adminMail			=	'eluminous_bde7@eluminoustechnologies.com';

$adminMail_2		=	'priyank_purohit@eluminoustechnologies.com ' ;

$adminMail_3		=	'eluminous_bde3@eluminoustechnologies.com ' ;

//$adminMail_4		=	'qam@pushgroup.co.uk' ;

//$adminMail_5		=	'reece@pushgroup.co.uk' ;

$AdminfromName		=	'Admin';

$adminMailsubject	=	'Received new enquiry';

$CustmorMailsubject	=	'Your enquiry has been submitted successfully';

$AdminMailbody		=	$customerMailBody	=	'';

//if(isset($_REQUEST['btn_submit_1']) && ($_REQUEST['btn_submit_1']!='')){

	/*if(isset($_REQUEST['btn_submit_2']) && ($_REQUEST['btn_submit_2']!='')){

		

	$strName			=	trim($_REQUEST['your_name_1']) ? trim($_REQUEST['your_name_1']) : '' ;

	$strEmailAddress	=	trim($_REQUEST['your_email_address_1']) ? trim($_REQUEST['your_email_address_1']) : '' ;

	//$strSkyPe			=	trim($_REQUEST['skype_id_1']) ? trim($_REQUEST['skype_id_1']) : '' ;

	$strCountry			=	trim($_REQUEST['country_1']) ? trim($_REQUEST['country_1']) : '' ;

	$strPhone			=	trim($_REQUEST['phone_1']) ? trim($_REQUEST['phone_1']) : '' ;

	*/

	

	

if(isset($_REQUEST['btn_submit_1']) && ($_REQUEST['btn_submit_1']!='')){	

	$strEmailAddress	=	trim($_REQUEST['your_email_address_1']) ? trim($_REQUEST['your_email_address_1']) : '' ;

	//-----------------Add user to mailchimp list start----------------------

	require_once 'MCAPI.class.php';



	$apikey = '76239c417a8a860a3ab4e83b2333c737-us2';

	$listId = '8b1d545a17';

	$apiUrl = 'http://api.mailchimp.com/1.3/';

	
	
	// set $merge_vars to null if you have only one input
	$merge_vars = null;
	$merges = array('FNAME'=>$strName);
	 
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
	$submit_url = "http://us2.api.mailchimp.com/1.3/?method=listSubscribe";
	 
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
		//echo "success, look for the confirmation message\n";die;
	}
	
	//-----------------Add user to mailchimp list end----------------------

}//end of if(isset($_REQUEST['btn_submit_1']) && ($_REQUEST['btn_submit_1']!='')){	

elseif(isset($_REQUEST['btn_submit_2']) && ($_REQUEST['btn_submit_2']!='')){

	

	$strName			=	trim($_REQUEST['your_name_1']) ? trim($_REQUEST['your_name_1']) : '' ;

	$strEmailAddress	=	trim($_REQUEST['email']) ? trim($_REQUEST['email']) : '' ;

	//$strSkyPe			=	trim($_REQUEST['skype_id_1']) ? trim($_REQUEST['skype_id_1']) : '' ;

	$strCountry			=	trim($_REQUEST['country_1']) ? trim($_REQUEST['country_1']) : '' ;

	$strPhone			=	trim($_REQUEST['phone_1']) ? trim($_REQUEST['phone_1']) : '' ;

		

	$mail_from			=	$strEmailAddress;

	



	//-----------------Add user to mailchimp list start Ref : https://apidocs.mailchimp.com/api/1.3/listsubscribe.func.php----------------------

	require_once 'MCAPI.class.php';



	$apikey = '76239c417a8a860a3ab4e83b2333c737-us2';

	$listId = '8b1d545a17';

	$apiUrl = 'http://api.mailchimp.com/1.3/';

	

	// set $merge_vars to null if you have only one input

	$merge_vars = null;

	$merges = array('FNAME'=>$strName);

	 

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

	$submit_url = "http://us2.api.mailchimp.com/1.3/?method=listSubscribe";

	 

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $submit_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_POST, true);

	curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($payload));

	 

	$result = curl_exec($ch);

	curl_close ($ch);

	$data = json_decode($result);

	if (isset($data->error)){

		//echo $data->code .' : '.$data->error."\n";

	} else {

		//echo "success, look for the confirmation message\n";

	}

	

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

	$isSend	=	sendmail($adminMail,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	$isSend	=	sendmail($adminMail_3,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	//$isSend	=	sendmail($adminMail_4,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	//$isSend	=	sendmail($adminMail_5,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

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



?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="keywords" itemprop="keywords"
        content="front end Developer, back end developer, mobile app developers, hire php developer, hire mobile app developers, hire php programmers" />

    <meta name="description" itemprop="description"
        content="Hire Front End Developers, Back End Developers From eLuminous Having 14+ Years of Experience In IT Industry. Get A Higher Credibility, Brand Value And Guaranteed On-Time Delivery Of Projects With Us." />

    <title>Hire Front End / Back End Developers</title>



    <link rel="stylesheet" href="css/landio.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/font-awesome.min.css">





    <script src="js/custom.js"></script>

    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {

            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');



    ga('create', 'UA-77243682-1', 'auto');

    ga('send', 'pageview');
    </script>



    <script type="text/javascript">
    setTimeout(function() {
        var a = document.createElement("script");

        var b = document.getElementsByTagName("script")[0];

        a.src = document.location.protocol + "//script.crazyegg.com/pages/scripts/0049/9383.js?" + Math.floor(
            new Date().getTime() / 3600000);

        a.async = true;
        a.type = "text/javascript";
        b.parentNode.insertBefore(a, b)
    }, 1);
    </script>



</head>



<body>



    <div id="home" class="top-menu">

        <div class="container">

            <div class="col-md-4 col-xs-9 logo"><a href="#home-sticky-wrapper"><img src="img/new-img/logo.png"
                        alt="eluminous"></a></div>

            <div class="col-md-8 col-xs-3">

                <div class="telwrap"><span class="call">Toll Free: USA : </span> <a href="tel:02030564373">+1 646 688
                        3509</a>
                    <div class="skype"><img src="./img/skype1.png"><a
                            href="skype:eluminoustechnologies">eluminoustechnologies</a></div>
                </div>



                <nav class="navbar navbar-dark bg-inverse bg-inverse-custom navbar-fixed-top">

                    <div class="container1">

                        <!--<a class="navbar-brand" href="#">

          <span class="icon-logo"></span>

          <span class="sr-only">Land.io</span>

        </a>-->

                        <a class="navbar-toggler hidden-md-up pull-xs-right" data-toggle="collapse"
                            href="#collapsingNavbar" aria-expanded="false" aria-controls="collapsingNavbar">

                            &#9776;

                        </a>



                        <div id="collapsingNavbar" class="collapse navbar-toggleable-custom" role="tabpanel"
                            aria-labelledby="collapsingNavbar">

                            <ul class="nav navbar-nav pull-xs-right">

                                <li class="nav-item nav-item-toggable">

                                    <a class="nav-link" href="#home-sticky-wrapper">Home</a>

                                </li>

                                <li class="nav-item nav-item-toggable">

                                    <a class="nav-link" href="#services">Services</a>

                                </li>

                                <li class="nav-item nav-item-toggable">

                                    <a class="nav-link" href="#package">Package</a>

                                </li>

                                <li class="nav-item nav-item-toggable">

                                    <a class="nav-link" href="http://eluminoustechnologies.com/about-us/">About Us</a>

                                </li>

                                <li class="nav-item nav-item-toggable">

                                    <a class="nav-link" href="#testimonial">Testimonial</a>

                                </li>



                                <li class="nav-item nav-item-toggable hidden-md-up">

                                    <form class="navbar-form">

                                        <input class="form-control navbar-search-input" type="text"
                                            placeholder="Type your search &amp; hit Enter&hellip;">

                                    </form>

                                </li>



                                <li class="nav-item dropdown nav-dropdown-search hidden-sm-down">

                                    <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">

                                        <span class="icon-search"></span>

                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-search"
                                        aria-labelledby="dropdownMenu1">

                                        <form class="navbar-form">

                                            <input class="form-control navbar-search-input" type="text"
                                                placeholder="Type your search &amp; hit Enter&hellip;">

                                        </form>

                                    </div>

                                </li>



                            </ul>

                        </div>

                    </div>

                </nav>







            </div>

        </div>

    </div>



    <!-- Hero Section

    ================================================== -->



    <header class="jumbotron bg-inverse" role="banner">

        <div class="container">

            <div class="row">

                <div class="col-md-6 header-text" style="padding-top:0;">

                    <h1 class="display-3">Hire Front End / Back End Developers</h1>

                    <h2 class="m-b-3">And get a higher credibility, brand value and guaranteed on-time delivery of
                        projects with us.</h2>

                    <ul>

                        <li><i class="fa fa-check"></i> Web Developers </li>

                        <li><i class="fa fa-check"></i> Mobile App Developers</li>

                        <li><i class="fa fa-check"></i> UI / UX Designer</li>

                        <li><i class="fa fa-check"></i> NodeJS Developers </li>

                        <li><i class="fa fa-check"></i> AngularJS Developers</li>

                        <li><i class="fa fa-check"></i> Front End Developers</li>

                        <li><i class="fa fa-check"></i> ReactJS Developers</li>

                        <li><i class="fa fa-check"></i> Laravel Developers</li>

                    </ul>



                </div>



                <?php

      	

		if($form==0 && $email_val==1){

	  ?>

                <div class="col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-1" id="form1">





                    <div class="form-inner">

                        <h2>Ready for a cutting edge solution?</h2>

                        <h3>Start Your Free Trial</h3>

                        <!--<span class="subheading">Discuss your needs with our team and start a free trial as soon as today!</span>-->

                        <?php 

				 

				 if(isset($strThankYoumsg_1) && ($strThankYoumsg_1!='')){

					 echo '<p id="success_div_1">'.$strThankYoumsg_1.'</p>';

				 }

				 ?>

                        <form action="" method="POST" name="upper" id="email">

                            <!-- <p>

                     <label>Your Name<span>*</span></label>

                     <input type="text" required name="your_name_1" value="">

                   </p>-->

                            <p>

                                <label>Email Address<span>*</span></label>

                                <input type="email" required name="your_email_address_1" value="">

                                <input type="hidden" value="1" name="email_val">

                            </p>

                            <!--<p>

                     <label>Skype Id</label>

                     <input  type="text" value="" name="skype_id_1">

                   </p>-->

                            <!--<p>

                     <label>Country<span>*</span></label>

                     <select name="country_1" required>

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

                     <input type="text" required name="phone_1" value="">

                   </p>-->

                            <p>

                                <input type="submit"
                                    onclick="_gaq.push(['_trackEvent', 'DedicatedCategory', 'DedicatedAction', 'dedicatedLable',5]);"
                                    class="button" id="mc-embedded-subscribe" name="btn_submit_1" value="Next">

                            </p>

                        </form>



                    </div>





                </div>

                <?php

		}

		else{

			$email_val=0;

			}

		

	?>





                <?php

	

	  

      if(isset($_REQUEST['btn_submit_1']) && ($_REQUEST['btn_submit_1']!=''))

	  {

		 $form=1;

		 echo "<style>

		 #form1{

			 display:none;

			 }

		 </style>";

		

	  ?>



                <div class="col-lg-4 col-lg-offset-2 col-md-5 col-md-offset-1" id="form2">





                    <div class="form-inner">

                        <h2>Start Your Free Trial</h2>

                        <span class="subheading">Discuss your needs with our team and start a free trial as soon as
                            today!</span>

                        <?php 

				 if(isset($strThankYoumsg_1) && ($strThankYoumsg_1!='')){

					 echo '<p id="success_div_1">'.$strThankYoumsg_1.'</p>';

				 }

				 ?>

                        <form action="" method="POST" name="upper1">

                            <input type="hidden" name="email" value="<?php echo $_POST['your_email_address_1']; ?>">

                            <p>

                                <label>Your Name<span>*</span></label>

                                <input type="text" required name="your_name_1" value="">

                            </p>

                            <p>

                                <label>Country<span>*</span></label>

                                <select name="country_1" required>

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

                                <input type="text" required name="phone_1" value="">

                            </p>

                            <p>

                                <input type="submit"
                                    onclick="_gaq.push(['_trackEvent', 'DedicatedCategory', 'DedicatedAction', 'dedicatedLable',5]);"
                                    class="button" id="mc-embedded-subscribe" name="btn_submit_2"
                                    value="START YOUR FREE TRIAL">

                            </p>

                        </form>

                    </div>

                </div>

                <?php

	  }

	$form=0;

	 ?>





            </div>

        </div>

        <!--<ul class="nav nav-inline social-share">

          <li class="nav-item"><a class="nav-link" href="#"><span class="icon-twitter"></span> 1024</a></li>

          <li class="nav-item"><a class="nav-link" href="#"><span class="icon-facebook"></span> 562</a></li>

          <li class="nav-item"><a class="nav-link" href="#"><span class="icon-linkedin"></span> 356</a></li>

        </ul>-->

    </header>



    <!-- Intro

    ================================================== -->



    <!-- <section id="services" class="section-intro bg-faded">

      <div class="container">

      <div class="row text-xs-center">

      <div class="col-md-12">

        <h3 class="wp wp-1">Why should you Hire Dedicated Programmers from us?</h3>

        <p class="lead wp wp-2">You should hire dedicated programmers with eLuminous Technologies because we offer</p>

        </div>

        </div>

        <div class="row">

        <div class="col-md-6">

        <div class="plan-bg">

        <h2> <i class="fa fa-thumbs-up"></i> Effective Communication.</h2>

        <ul class="">

<li>Round the clock communication facility.</li>

<li>No language barriers unlike other offshore firms.</li>

<li>An intelligent PMS for time tracking &amp; screen capturing feature.</li>

<li>Amazing after-sales service &amp; a dedicate project manager.</li>

</ul></div>

        </div>

        <div class="col-md-6">

        <div class="plan-bg">

        <h2><i class="fa fa-lock"></i> Top Security.</h2>

        <ul class="">

<li>Secured web code that conforms the modern standards.</li>

<li>Backup systems.</li>

</ul></div>

</div>

        </div>

        <div class="row">

        <div class="col-md-6">

        <div class="plan-bg">

        <h2><i class="fa fa-check-square-o"></i> Lucrative</h2>

        <ul class="">

<li>Value added & extremely cost effective solution.</li>

<li>Less investment of time and money from your end to help you allocate more time for your business development.</li>

</ul></div>

</div>

<div class="col-md-6">

<div class="plan-bg">

        <h2><i class="fa fa-trophy"></i> Excellent Quality.</h2>

        <ul class="">

<li>Agile & flexible project development cycle.</li>

<li>Consultative approach to improve quality & reduce development time.</li>

<li>On-time deliveries with transparency, honesty and reliability.</li>

<li>Rated 4.8 out of 5 by 200+ clients.</li>

</ul>

</div>

        </div>

        </div>

        <div class="row">

        <div class="col-md-6">

        <div class="plan-bg">

        <h2><i class="fa fa-line-chart"></i> High level Expertise.</h2>

        <ul class="">

<li>Highly qualified professionals with engineering and master degree.</li>

<li>Advanced SDLC methodologies.</li>

<li>Unique and highly customized solutions to attain maximum ROI.</li>

<li>Over12 years of successful experience on PHP & MySQL.</li>

</ul></div>

        </div>

        <div class="col-md-6">

        <div class="plan-bg">

        <h2><i class="fa fa-money"></i> Hassle free billing</h2>

        <ul class="">

<li>Biweekly – Monthly Billing options</li>

<li>Resource Shifting in case of long leave</li>

<li>Billing Adjustments if long leave</li>

</ul></div>

</div>

        </div>

      </div>

    </section>-->


    <section id="package" class="section-pricing text-xs-center">

        <div class="container">

            <h3>Choose Your Package</h3>

            <div class="row p-y-3">

                <div class="col-md-4 p-t-md wp wp-5">

                    <div class="card pricing-box">

                        <div class="card-header text-uppercase">

                            Hire Front End Developer

                        </div>

                        <div class="card-block">

                            <p class="card-title">The UI / UX Designer works up to 8 hours per day and 20 days in a
                                month.</p>

                            <h4 class="card-text">

                                <sup class="pricing-box-currency">USD</sup>

                                <span class="pricing-box-price">2000</span>

                                <small class="text-muted text-uppercase">/month</small>

                            </h4>

                        </div>

                        <ul class="list-group list-group-flush p-x">

                            <li class="list-group-item">Concept designing and implementation</li>

                            <li class="list-group-item">Certified UI/UX Experts </li>

                            <li class="list-group-item">Experienced designer support</li>

                            <li class="list-group-item">Billing terms would be Monthly.</li>

                            <li class="list-group-item">PMS for time &amp; project tracking</li>

                            <li class="list-group-item">No charges for missing working days</li>

                            <li class="list-group-item">Upgrade for time &amp; resources available</li>

                            <li class="list-group-item">Technology: AngularJS, ReactJS, MEAN Stack</li>

                        </ul>

                        <a href="https://eluminoustechnologies.com/front-end-development/" target="_blank"
                            class="btn btn-primary-outline">Get Started</a>

                    </div>

                </div>

                <div class="col-md-4 stacking-top">

                    <div class="card pricing-box pricing-best p-x-0">

                        <div class="card-header text-uppercase">

                            Hire Back End Developer

                        </div>

                        <div class="card-block">

                            <p class="card-title">The project engineer works up to 8 hours per day and 20 days in a
                                month.</p>

                            <h4 class="card-text">

                                <sup class="pricing-box-currency">USD</sup>

                                <span class="pricing-box-price">1600</span>

                                <small class="text-muted text-uppercase">/month</small>

                            </h4>

                        </div>

                        <ul class="list-group list-group-flush p-x">

                            <li class="list-group-item">Comprehensive Analysis</li>

                            <li class="list-group-item">Billing terms- Weekly/ Monthly.</li>

                            <li class="list-group-item">PMS for time &amp; project tracking</li>

                            <li class="list-group-item">No charges for missing working days</li>

                            <li class="list-group-item">Flexible Upgrades in packages.</li>

                            <li class="list-group-item">Technology: PHP, MySQL, Laravel, CorePHP, CodeIgnitor, Yii,
                                NodeJS, MEAN Stack</li>

                        </ul>

                        <a href="https://eluminoustechnologies.com/front-end-development/" target="_blank"
                            class="btn btn-primary">Get Started</a>

                    </div>

                </div>

                <div class="col-md-4 p-t-md wp wp-6">

                    <div class="card pricing-box">

                        <div class="card-header text-uppercase">

                            Hire Mobile App Developer

                        </div>

                        <div class="card-block">

                            <p class="card-title">The project engineer works up to 8 hours per day and 20 days in a
                                month.</p>

                            <h4 class="card-text">

                                <sup class="pricing-box-currency">USD</sup>

                                <span class="pricing-box-price">2400</span>

                                <small class="text-muted text-uppercase">/month</small>

                            </h4>

                        </div>

                        <ul class="list-group list-group-flush p-x">

                            <li class="list-group-item">160 Hours of guaranteed programming every month</li>

                            <li class="list-group-item">Experienced developers support</li>

                            <li class="list-group-item">Billing terms would be Monthly.</li>

                            <li class="list-group-item">PMS for time &amp; project tracking</li>

                            <li class="list-group-item">No charges for missing working days</li>

                            <li class="list-group-item">Upgrade for time &amp; resources available</li>

                            <li class="list-group-item">Technology: Android, iOS, Hybrid(Ionic), Native</li>

                        </ul>

                        <a href="https://eluminoustechnologies.com/front-end-development/" target="_blank"
                            class="btn btn-primary-outline">Get Started</a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section id="services" class="bg-faded">

        <div class="container">

            <h3 class="text-center">Why choose eLuminous?</h3>

            <div class="row mrbot50">

                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box greenbox">

                        <div class="img-container green">2000+</div>

                        <h5>Websites / Web portals developed &amp; launched</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box bluebox">

                        <div class="img-container blue">500+</div>

                        <h5>Ecommerce websites developed &amp; launched</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box greenbox">

                        <div class="img-container green">100+</div>

                        <h5>Mobile Apps developed and launched</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->

            </div>



            <div class="row mrbot50">

                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box bluebox">

                        <div class="img-container blue">14+</div>

                        <h5>Years of successful Industry experience</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box greenbox">

                        <div class="img-container green">30+</div>

                        <h5>Industry segments served successfully </h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box bluebox">

                        <div class="img-container blue">200+</div>

                        <h5>Strong base of Certified Development Professionals</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->

            </div>



            <div class="row">

                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box greenbox">

                        <div class="img-container green">L - 5
                            <!--<i class="fa fa-trophy" style=" font-size: 60px; margin: 24px 0 0;

}"></i>-->
                        </div>

                        <h5>Addherence to CMMI Level-5</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box bluebox">

                        <div class="img-container blue"><i class="fa fa-star" style=" font-size: 60px; margin: 24px 0 0;

}"></i></i></div>

                        <h5>Recognized by Apple in the ‘Best of 2014’ List.</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->



                <!-- .grid_4 start -->

                <article class="col-md-4">

                    <div class="process-box greenbox">

                        <div class="img-container green">70%</div>

                        <h5>Bussiness from recurring clients</h5>

                    </div>

                </article>

                <!-- .GRID_4 END -->

            </div>



        </div>

    </section>




    <!--<section id="about" class="section-text">

      <div class="container">

      <div class="col-md-6"><div class="about-img"><img src="img/new-img/desk-img.png"></div></div>

      <div class="col-md-6">

      <div class="about-text">

      <h3>About Us</h3>

      <p>We are very confident about our service which has a combination of proficient approach, startling performance, reliable management system, and excellence in delivery which comprises of international standards. We own a high proficiency in offering tailored solutions based on your industry sector, hence, you can be assured about the delivery of out-of-the-box features and functionalities for your project from us. You can hire dedicated Programmers from eLuminous Technologies to customize available open source and extra-ordinary solutions. You can communicate with our Programmer directly and appoint them after the proper interview.</p>

      </div>

      </div>

      </div>

      </section>-->

    <section id="portfolio">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12 text-center">
                    <h3>Our Projects</h3>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="col-md-3 col-sm-6 portfolio-item">

                        <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">

                            <div class="caption">

                                <div class="caption-content">

                                    <i class="fa fa-search-plus fa-3x"></i>

                                </div>

                            </div>

                            <img src="img/portfolio/mbt.jpg" class="img-responsive" alt="MBT">

                            <span>MBT</span>

                        </a>

                    </div>

                    <div class="col-md-3 col-sm-6 portfolio-item">

                        <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">

                            <div class="caption">

                                <div class="caption-content">

                                    <i class="fa fa-search-plus fa-3x"></i>

                                </div>

                            </div>

                            <img src="img/portfolio/trakInvest.png" class="img-responsive" alt="trakInvest">

                            <span>TrakInvest</span>

                        </a>

                    </div>

                    <div class="col-md-3 col-sm-6 portfolio-item">

                        <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">

                            <div class="caption">

                                <div class="caption-content">

                                    <i class="fa fa-search-plus fa-3x"></i>

                                </div>

                            </div>

                            <img src="img/portfolio/dosarrest.png" class="img-responsive" alt="">

                            <span>DOSarrest</span>

                        </a>

                    </div>

                    <div class="col-md-3 col-sm-6 portfolio-item">

                        <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">

                            <div class="caption">

                                <div class="caption-content">

                                    <i class="fa fa-search-plus fa-3x"></i>

                                </div>

                            </div>

                            <img src="img/portfolio/sunday-streams.png" class="img-responsive" alt="">

                            <span>Sunday Streams</span>

                        </a>

                    </div>

                    <div class="col-md-12 view-btn"><a class="viewmore"
                            href="http://eluminoustechnologies.com/portfolio/" target="_blank">View More </a> </div>

                </div>

            </div>

        </div>

    </section>













    <!-- Testimonials

    ================================================== -->



    <section id="testimonial" class="section-testimonials text-xs-center bg-inverse">

        <div class="container">

            <h3 class="">What Our clients Say</h3>

            <div id="carousel-testimonials" class="carousel slide" data-ride="carousel" data-interval="0">

                <div class="carousel-inner" role="listbox">

                    <div class="carousel-item active">

                        <blockquote class="blockquote">

                            <img src="img/new-img/user-tumb.png" height="80" width="80" alt="Avatar" class="img-circle">

                            <p class="h3">You guys are making all the difference in the world. We had our FIRST SALE on
                                CRM within 30 minutes of launch!!! Really happy with this progress and this CRM will be
                                a long term project I am going to work with ELUMINOUS</p>

                            <footer>Matt</footer>

                        </blockquote>

                    </div>

                    <div class="carousel-item">

                        <blockquote class="blockquote">

                            <img src="img/new-img/user-tumb.png" height="80" width="80" alt="Avatar" class="img-circle">

                            <p class="h3">Eluminous Technologies have been instrumental in helping us develop software
                                solutions for our clients. Eluminous are great communicators, efficient and easy to work
                                with. They complete all tasks correctly and on time.</p>

                            <footer>Ben de Haan</footer>

                        </blockquote>

                    </div>

                    <div class="carousel-item">

                        <blockquote class="blockquote">

                            <img src="img/new-img/user-tumb.png" height="80" width="80" alt="Avatar" class="img-circle">

                            <p class="h3">It has been a pleasure working with Sukhada Deo in the last three months. Her
                                ideas and responsiveness with customer requests have definitely exceeded our
                                expectations. We truly appreciate her high level of technical skills. She continuously
                                provides us with helpful advice on web design and infrastructure for some of our
                                critical clients.</p>

                            <footer>Eli</footer>

                        </blockquote>

                    </div>

                    <div class="carousel-item">

                        <blockquote class="blockquote">

                            <img src="img/new-img/user-tumb.png" height="80" width="80" alt="Avatar" class="img-circle">

                            <p class="h3">It was really, really a pleasure to have Mukesh , online and virtually
                                alongside me offering us his guidance, and applying changes to the website needs as and
                                when changes were needed to be made by the client “on the fly”, given everything his
                                else that he has to deal with.</p>

                            <footer>Christian De Wet</footer>

                        </blockquote>

                    </div>

                    <div class="carousel-item">

                        <blockquote class="blockquote">

                            <img src="img/new-img/user-tumb.png" height="80" width="80" alt="Avatar" class="img-circle">

                            <p class="h3">Just a quick message to say Thanks for all the hard work you have done so far.
                                Really enjoying working with you and clients are really happy too with your level of
                                design skill, and great communication skills too. Hoping for a long prosperous business
                                relationship.</p>

                            <footer>Ajay</footer>

                        </blockquote>

                    </div>



                </div>

                <ol class="carousel-indicators">

                    <li class="active"><img src="img/new-img/user-tumb.png" alt="Navigation avatar"
                            data-target="#carousel-testimonials" data-slide-to="0" class="img-fluid img-circle"></li>

                    <li><img src="img/new-img/user-tumb.png" alt="Navigation avatar"
                            data-target="#carousel-testimonials" data-slide-to="1" class="img-fluid img-circle"></li>

                    <li><img src="img/new-img/user-tumb.png" alt="Navigation avatar"
                            data-target="#carousel-testimonials" data-slide-to="2" class="img-fluid img-circle"></li>

                    <li><img src="img/new-img/user-tumb.png" alt="Navigation avatar"
                            data-target="#carousel-testimonials" data-slide-to="3" class="img-fluid img-circle"></li>

                    <li><img src="img/new-img/user-tumb.png" alt="Navigation avatar"
                            data-target="#carousel-testimonials" data-slide-to="4" class="img-fluid img-circle"></li>

                </ol>

            </div>

        </div>

    </section>







    <!-- Sign Up

    ================================================== -->



    <section class="section-signup bg-faded ">

        <div class="container">

            <div class="row">

                <div class="col-md-7 col-lg-9">

                    Hire Front End / Back End Developers who develop high-quality, user-centric and innovative Web and
                    Mobile Apps, Business Intelligence services that deliver actual, measurable value to our clients.
                </div>

                <div class="col-md-5 col-lg-3">

                    <a href="#home-sticky-wrapper" class="btn btn-primary btn-block">Request a Free quote</a>
                </div>

            </div>

        </div>

    </section>



    <!-- Footer

    ================================================== -->



    <footer class="section-footer bg-inverse" role="contentinfo">

        <div class="container">

            <div class="row">

                <div class="col-md-12 col-lg-5">

                    <div class="media">

                        <small class="media-body media-bottom">

                            Copyright © 2017 eLuminous technologies Pvt. Ltd

                        </small>

                    </div>

                </div>

                <div class="col-md-12 col-lg-7">



                    <ul class="nav nav-inline footer-nav">

                        <li><a target="_blank" href="http://eluminoustechnologies.com/">Home</a></li>

                        <li><a target="_blank" href="http://eluminoustechnologies.com/about-us/">About us </a></li>

                        <li><a target="_blank" href="http://eluminoustechnologies.com/services/">Services </a></li>

                        <li><a target="_blank" href="http://eluminoustechnologies.com/portfolio/">Portfolio </a></li>

                        <li><a target="_blank" href="http://eluminoustechnologies.com/blog/">Blog </a></li>

                        <li><a target="_blank" href="http://eluminoustechnologies.com/contact/">Contact</a></li>



                    </ul>

                </div>

            </div>

        </div>

    </footer>




    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-content">

            <div class="close-modal" data-dismiss="modal">

                <div class="lr">

                    <div class="rl">

                    </div>

                </div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="modal-body">

                            <div class="col-md-7">

                                <img src="img/portfolio/mbt.jpg" class="img-responsive img-centered" alt="">
                            </div>

                            <div class="col-md-5">

                                <h2>MBT</h2>

                                <span>Healthcare / Informative</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">Web design, HTML5, CSS3</strong>

                                    </li>

                                </ul>

                                <p>We have developed this amazing website using HTML5. The website has a unique approach
                                    that understands the human benefits of health, wellness and staying on the move.</p>

                                <a target="_blank" href="http://www.mbt.com/en-gb" role="button"
                                    class="btn btn-primary ">View Project</a>

                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-content">

            <div class="close-modal" data-dismiss="modal">

                <div class="lr">

                    <div class="rl">

                    </div>

                </div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="modal-body">

                            <div class="col-md-7">

                                <img src="img/portfolio/trakInvest.png" class="img-responsive img-centered"
                                    alt="trakInvest">
                            </div>

                            <div class="col-md-5">

                                <h2>TrakInvest</h2>

                                <span>Investment and Finance</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">Joomla, jQuery, HTML5, CSS3</strong>

                                    </li>

                                </ul>

                                <p>TrakInvest is the world’s first social investment platform for equities. This portal
                                    allows you to leverage the collective knowledge of investors globally to make better
                                    and more profitable investment decisions.</p>

                                <a target="_blank" href="https://www.trakinvest.com/" role="button"
                                    class="btn btn-primary ">View Project</a>

                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-content">

            <div class="close-modal" data-dismiss="modal">

                <div class="lr">

                    <div class="rl">

                    </div>

                </div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="modal-body">

                            <div class="col-md-7">

                                <img src="img/portfolio/dosarrest.png" class="img-responsive img-centered"
                                    alt="dosarrest">
                            </div>

                            <div class="col-md-5">

                                <h2>DOSarrest External Monitoring Service</h2>

                                <span>Server Monitoring and Datacenter.</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">iOS and Android</strong>

                                    </li>

                                </ul>

                                <p>This service allows you to monitor your website’s performance from 8 different
                                    networks around the globe every minute, view historical or real-time performance
                                    stats.</p>

                                <a target="_blank"
                                    href="https://itunes.apple.com/us/app/dosarrest-external-onitoring/id956768144?ls=1&mt=8"
                                    role="button" class="btn btn-primary ">View Project</a>

                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-content">

            <div class="close-modal" data-dismiss="modal">

                <div class="lr">

                    <div class="rl">

                    </div>

                </div>

            </div>

            <div class="container">

                <div class="row">

                    <div class="col-lg-12 ">

                        <div class="modal-body">

                            <div class="col-md-7">

                                <img src="img/portfolio/sunday-streams.png" class="img-responsive img-centered"
                                    alt="Sunday Streams">
                            </div>

                            <div class="col-md-5">

                                <h2>Sunday Streams</h2>

                                <span>Live streaming service</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">Android</strong>

                                    </li>

                                </ul>

                                <p>The Sunday Streams app works with broadcasts using the Sunday Streams live streaming
                                    service. With the app you can watch your church or organization's live broadcasts
                                    and on-demand videos. </p>

                                <a target="_blank"
                                    href="https://play.google.com/store/apps/details?id=com.imd.sunday_stream&hl=en"
                                    role="button" class="btn btn-primary ">View Project</a>

                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-times"></i> Close</button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

















    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="js/landio.min.js"></script>

    <script src="js/jquery.sticky.js"></script>



    <script>
    $(document).ready(function() {

        $("#home").sticky({
            topSpacing: 0
        });







    });

    setTimeout(function() {

        $('#success_div_1').fadeOut('slow');

    }, 9000);
    </script>

    <script>
    $(function() {

        $('.navbar-nav a[href*=#]:not([href=#])').click(function() {

            //Active - START

            $("a").each(function() {

                $(this).removeClass("active");

            });

            $(this).addClass("active");

            //Active - END



            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location
                .hostname == this.hostname) {

                var target = $(this.hash);

                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

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
    $(document).ready(function() {



        $(window).scroll(function() {

            if ($(this).scrollTop() > 100) {

                $('.scrollup').fadeIn();

            } else {

                $('.scrollup').fadeOut();

            }

        });



        $('.scrollup').click(function() {

            $("html, body").animate({

                scrollTop: 0

            }, 600);

            return false;

        });





        $('a[href^="#"]').on('click', function(event) {



            var target = $($(this).attr('href'));



            if (target.length) {

                event.preventDefault();

                $('html, body').animate({

                    scrollTop: target.offset().top - 75

                }, 600);

            }



        });



    });
    </script>

    <script type="text/javascript">
    jQuery(document).ready(function() {
        <?php
		$cookie_name 	= "ChristmasPopups";
		$cookie_value 	= true;
		if(!isset($_COOKIE[$cookie_name])) {
			?>
        /*setTimeout(function() {
        	//jQuery('#overlay').show();
        	//jQuery('#specialPageHtml').show();
        }, 7000);*/
        <?php
			setcookie($cookie_name, $cookie_value, time() + (86400 * 2), "/"); 
		}
		?>
        jQuery(".no").click(function() {
            jQuery('#overlay').hide();
            jQuery('#specialPageHtml').hide();
        })

        jQuery(".closePospup").click(function() {
            jQuery('#overlay').hide();
            jQuery('#specialPageHtml').hide();
        })

        jQuery(".yes").click(function() {
            jQuery('.poup_fst').hide();
            jQuery('.poup_sec').show();
        })
        jQuery("#submitPopups").click(function() {
            var strPopFname = jQuery("#strPopFname").val().trim();
            var strPopPhone = jQuery("#strPopPhone").val().trim();
            var strPopEmail = jQuery("#strPopEmail").val().trim();
            var count = 0;
            if (strPopFname == "") {
                count = 1;
                jQuery("#strPopFname").css("border", "2px solid red");
            } else {
                jQuery("#strPopFname").css("border", "none");
            }

            if (strPopPhone != "") {
                var filter = /^[0-9-+]+$/;
                if (!filter.test(strPopPhone)) {
                    count = 1;
                    jQuery("#strPopPhone").css("border", "2px solid red");
                } else {
                    jQuery("#strPopPhone").css("border", "none");
                }
            }

            if (strPopEmail == "") {
                count = 1;
                jQuery("#strPopEmail").css("border", "2px solid red");
            } else {
                var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                if (filter.test(strPopEmail)) {
                    jQuery("#strPopEmail").css("border", "none");
                } else {
                    count = 1;
                    jQuery("#strPopEmail").css("border", "2px solid red");
                }


            }
            if (count == 0) {
                jQuery("#img_loading").show("slow");
                jQuery.post("save_data.php", {
                        email: strPopEmail,
                        name: strPopFname,
                        phone: strPopPhone

                    },
                    function(data, status) {
                        var arrData = new Object;
                        try {
                            var arrData = $.parseJSON(data);
                        } catch (ex) {
                            arrData.sts = 'ERR'
                        }
                        jQuery("#status").html(arrData.msg);
                        setTimeout(function() {
                            jQuery('#overlay').show('slow');
                            jQuery('#specialPageHtml').show('slow');
                        }, 1200);
                    });
            }

        })


    });
    </script>
    <div id="overlay"></div>
    <div id="specialPageHtml" style="display:none;">
        <style>
        #overlay {
            display: none;
            position: fixed;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 150%;
            background-color: #000;
            z-index: 1001;
            -moz-opacity: 0.4;
            opacity: 0.6;
            filter: alpha(opacity=80);
        }

        #specialPageHtml {
            z-index: 9999999;
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .subscribe_button {
            margin: 18px;
            padding: 10px;
            width: auto !important;
        }

        @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900');
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');

        /*font-family: 'Roboto Condensed', sans-serif;*/
        a {
            text-decoration: none;
        }

        .popup-sec {
            background-color: #1887e4;
            background-image: url("img/popup-bg.png");
            background-position: right bottom;
            background-repeat: no-repeat;
            border-radius: 10px;
            font-family: "Roboto", sans-serif;
            margin: auto;
            max-width: 560px;
            padding: 26px 0 136px;
            text-align: center;
            position: relative;
        }

        .popup-sec h2 {
            color: #fff;
            font-family: "Roboto Condensed", sans-serif;
            font-size: 30px;
            font-weight: 400;
            margin-bottom: 20px;
            margin-top: 0;
            text-shadow: 1px 1px 1px #385e9f;
        }

        .popup-sec h4 {
            color: #000;
        }

        .popup-sec h3 {
            color: #fff;
            font-size: 25px;
            line-height: 35px;
            margin-bottom: 30px;
            margin-top: 0;
            padding: 0 90px;
            text-transform: uppercase;
        }

        .popup-sec h3 span {
            color: #061244;
            font-size: 27px;
            font-weight: 900;
        }

        .popup-sec h5 {
            color: #fff;
            font-size: 14px;
            font-weight: 400;
            margin-top: 35px;
        }

        .popup-sec1 a {
            border-radius: 50px;
            display: inline-block;
            font-family: "Roboto Condensed", sans-serif;
            font-size: 30px;
            font-weight: 700;
            padding: 0px 70px;
            color: #fff;
        }

        .popup-sec1 a span {
            display: block;
            font-family: "Roboto", sans-serif;
            font-size: 12px;
            font-weight: 400;
        }

        .popup-sec1 small {
            color: #000;
            padding: 20px;
            position: relative;
            top: -10px;
        }

        .yes {
            background: #f88015;
            box-shadow: 1px 4px 0 #a54e01;
        }

        .no {
            background: #2d2d2d;
            box-shadow: 1px 4px 0 #0d0d0d;
        }

        .yes:hover {
            background: #fc8d2a;
        }

        .no:hover {
            background: #4b4b4b;
        }

        .popup-sec2 [type="text"],
        .popup-sec2 [type="phone"],
        .popup-sec2 [type="email"] {
            border: medium none;
            border-radius: 5px;
            padding: 10px 10px;
            width: 56%;
        }

        .popup-sec2 .col {
            margin-bottom: 13px;
        }

        .popup-sec2 [type="button"] {
            background: #f88015 none repeat scroll 0 0;
            border: medium none;
            border-radius: 5px;
            box-shadow: 1px 4px 0 #a54e01;
            color: #fff;
            cursor: pointer;
            font-family: "Roboto Condensed", sans-serif;
            font-size: 25px;
            font-weight: 700;
            line-height: 45px;
            margin-left: 2px;
            text-transform: uppercase;
            width: 56%;
        }

        .popup-sec2 [type="button"]:hover {
            background: #fc8d2a;
        }

        .popup-sec2 [type="button"]:hover {
            background: #fc8d2a;
        }

        .closePospup {
            position: absolute;
            right: -12px;
            top: -7px;
            background: #000;
            color: #fff;
            border-radius: 50px;
            width: 25px;
            height: 25px;
            line-height: 19px;
            border: 2px solid #fff;
            padding: 0px 6px;
            cursor: pointer;
        }

        #status {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            padding-top: 10px;
        }

        @media (max-width: 767px) {
            .popup-sec {
                width: 90%;
                padding: 26px 0 20px;
                background-image: url("img/popup-mobile-bg.png");
                max-width: 400px;
            }

            .popup-sec h2 {
                font-size: 20px;
            }

            .popup-sec2 [type="text"],
            .popup-sec2 [type="phone"],
            .popup-sec2 [type="email"] {
                padding: 10px 10px;
                width: 88% !important;
            }

            .popup-sec2 [type="submit"] {
                width: 88%;
            }

            .popup-sec h3 {
                font-size: 18px;
                line-height: 26px;
                padding: 0px;
            }

            .popup-sec h3 span {
                font-size: 17px;
            }

            .popup-sec1 a {
                font-size: 22px;
                padding: 12px 30px 12px;
            }

            .popup-sec1 a span {
                display: none;
            }

            .popup-sec h5 {
                margin-top: 24px;
                padding: 0 20px;
            }

            .popup-sec2 [type="button"] {
                width: 87%;
            }

        }
        </style>

        <div class="popup-sec poup_fst">
            <h2>Hire a Dedicated Developer and Get 40 Additional Hours FREE! </h2>
            <h4>(Worth $400/ Month)</h4>
            <div class="popup-sec1">
                <h3>Free Analysis , Consulting & Documentation.</h3>
                <a class="yes" href="#">YES</a> <small>OR</small> <a class="no" href="#">NO</a>
                <h5>Note: This offer is valid for all the Web & Mobile Apps projects</h5>
            </div>
        </div>
        <br>
        <br>
        <div class="popup-sec poup_sec" style="display:none;">
            <div class="closePospup"><i class="fa fa-times" aria-hidden="true"></i></div>
            <h2>It is christmas time !</h2>
            <div class="popup-sec2">
                <p style="text-align:center;">
                    <img src="img/reload.gif" id="img_loading" style="display:none;">

                </p>
                <form action="" method="post">
                    <div class="col">
                        <input name="strPopFname" id="strPopFname" type="text" placeholder="Name" required />
                    </div>
                    <div class="col">
                        <input name="strPopPhone" id="strPopPhone" type="phone" placeholder="Phone" />
                    </div>
                    <div class="col">
                        <input name="strPopEmail" id="strPopEmail" type="email" placeholder="Email" required />
                    </div>
                    <div class="col">
                        <input name="strPopBtn" type="button" value="subscribe" id="submitPopups" />&nbsp;&nbsp;<br>
                        <div id="status"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start of Async Drift Code -->
    <script>
    ! function() {
        var t;
        if (t = window.driftt = window.drift = window.driftt || [], !t.init) return t.invoked ? void(window.console &&
            console.error && console.error("Drift snippet included twice.")) : (t.invoked = !0,
            t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off",
                "on"
            ],
            t.factory = function(e) {
                return function() {
                    var n;
                    return n = Array.prototype.slice.call(arguments), n.unshift(e), t.push(n), t;
                };
            }, t.methods.forEach(function(e) {
                t[e] = t.factory(e);
            }), t.load = function(t) {
                var e, n, o, i;
                e = 3e5, i = Math.ceil(new Date() / e) * e, o = document.createElement("script"),
                    o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src =
                    "https://js.driftt.com/include/" + i + "/" + t + ".js",
                    n = document.getElementsByTagName("script")[0], n.parentNode.insertBefore(o, n);
            });
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('9ux9xi5dgsdx');
    </script>
    <!-- End of Async Drift Code -->


</body>

</html>