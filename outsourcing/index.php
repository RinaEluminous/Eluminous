<?php
ob_start();
?><script src="js/jquery.min.js"></script>

<!-- This is for sweet alert  -->

<script src="dist/sweetalert-dev.js"></script>

<link rel="stylesheet" href="dist/sweetalert.css">



<?php



include("class.phpmailer.php");

require_once('mail_functions.php');

$strThankYoumsg_1	=	$strThankYoumsg_2	=	'';

$strThankYoumsg		=	'Thank you for submitting enquiry.<br>One of our experts will contact you soon.';

$adminMail			=   'eluminous_sse23@eluminoustechnologies.com';//'eluminous_sse23@eluminoustechnologies.com';//    'sandeep@eluminoustechnologies.com';/

$adminMail_1		=     'priyank_purohit@eluminoustechnologies.com'; //sales@eluminoustechnologies.com';

$adminMail_2		=	  'eluminous_bde7@eluminoustechnologies.com'; //'hrushikeshw@gmail.com' ;

// $adminMail_3        =     'eluminous_se42@eluminoustechnologies.com';

$AdminfromName		=	'Admin';

$adminMailsubject	=	'Received new enquiry';

$CustmorMailsubject	=	'Thanks for reaching out : eLuminous Technologies Pvt. Ltd.';

$AdminMailbody		=	$customerMailBody	=	'';

//--------------------------Request Form Functionality Starts-------------------------------------------------------

if(isset($_REQUEST['btn_request_callback']) && ($_REQUEST['btn_request_callback']!='')){

    $strName			=	trim($_REQUEST['your_name_1']) ? trim($_REQUEST['your_name_1']) : '' ;

	$strEmailAddress	=	trim($_REQUEST['your_email_address_1']) ? trim($_REQUEST['your_email_address_1']) : '' ;

	$strPhone			=	trim($_REQUEST['phone_1']) ? trim($_REQUEST['phone_1']) : '' ;

	$strCountry			=	trim($_REQUEST['country_1']) ? trim($_REQUEST['country_1']) : '' ;

	$strBriefrequirement=	trim($_REQUEST['brief_requirement_1']) ? trim($_REQUEST['brief_requirement_1']) : '' ;



	

//-----------------Add user to mailchimp list start----------------------

  require_once 'MCAPI.class.php';



  $apikey = 'cd3fd2e7e4d879f3a4cddf90de30dd7d-us14';//'aead6c3d89c238208f6928a2e34f34cb-us13';

  $listId = '3bf3adc75e';//'f5f8296e9d'; 

  $apiUrl = 'https://api.mailchimp.com/1.3/';

   
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
	$submit_url = "https://us14.api.mailchimp.com/1.3/?method=listSubscribe";
	 
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
   

  // create a new api object
  /*$api = new MCAPI($apikey);


  // set $merge_vars to null if you have only one input

  $merge_vars = null;

  $merge_vars = array('FNAME'=>$strName);
 

  if($email !== '') {

   

    $return_value = $api->listSubscribe( $listId, $strEmailAddress, $merge_vars, 'html', false, false, true, true );

  

    // check for error code

    if ($api->errorCode){

    //echo "<p>Error: $api->errorCode, $api->errorMessage</p>";

    } 

  }*/

//-----------------Add user to mailchimp list end----------------------





  

    $mail_from			=	$strEmailAddress;

	

    $AdminMailbody		=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">

  <tr>

    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="https://eluminoustechnologies.com/"><img src="http://eluminoustechnologies.com/outsourcing/img/eluminous-admin-logo-crm.png"  alt="logo" border="0" style="display:block; margin-left:15px;width:300px;height:96px;" /></a></td>

  </tr>

  <tr>

    <td valign="top" align="center"><img src="https://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>

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

		<tr style="background: #f4f4f4;">

          <td><strong>Brief Requirement:</strong></td>

          <td>'. strip_tags($strBriefrequirement) .'</td>

        </tr>

	    

      </table></td>

  </tr>

  <tr>

    <td valign="top" align="center"><img src="https://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>

  </tr>

</table>

';

	// Admin Mail

	//$isSend	=	sendmail($adminMail, $mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	$isSend	=	sendmail($adminMail_1,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	$isSend	=	sendmail($adminMail_2,	$mail_from,	$adminMailsubject, $AdminMailbody, $strName);

	$isSend =   sendmail($adminMail_3,  $mail_from, $adminMailsubject, $AdminMailbody, $strName);

	if($isSend){

		$strThankYoumsg_1	=	$strThankYoumsg;

	}

	// Custome Mail

	$customerMailBody	=	'<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #08293D;">

  <tr>

    <td align="center" bgcolor="#EB8516"  height="130" style="border-bottom: 1px solid #EB8516; border-top: 1px solid rgb #EB8516;"><a href="https://eluminoustechnologies.com/"><img src="https://eluminoustechnologies.com/outsourcing/img/eluminous-client-logo.png" alt="logo" border="0" style="display:block; margin-left:15px;width:300px; height:96px;" /></a></td>

  </tr>

  <tr>

    <td valign="top" align="center"><img src="https://eluminoustechnologies.com/outsourcing/img/shadow_header.png" width="515" height="19" alt="shadow" style="display:block;" /></td>

  </tr>

  <tr>

    <td style="padding:10px 20px; font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; line-height:21px;"><strong style="font-size:13px;">Dear '.strip_tags($strName).',</strong><br>

      <p style="padding-top:10px; margin:0;">Thanks for taking the time to check out our site, and showing your interest!</p>

      <p style="padding-top:10px; margin:0;">One of our experts will contact you soon to talk about your potential fit with the service offering. Can you confirm the preferred time for calling you? Also, it will be great if you can let us know a bit about your requirements to make the conversation easier. </p>

      <p style="padding-top:10px; margin:0;">Look forward to your mail !  </p>

      

     </td>

  </tr>

  

  <tr>

    <td valign="top" align="center"><img src="https://eluminoustechnologies.com/outsourcing/img/divider.png" width="584" height="18" alt="border" style="display:block; margin:10px 0;" /></td>

  </tr>

</table>

';

	sendmail($strEmailAddress, $adminMail,$CustmorMailsubject, $customerMailBody, $AdminfromName);

        ?>



<script type="text/javascript">
$(document).ready(function() {

    swal("Thank you!",
        "Thank you for sharing your details. Our Sales Team will soon connect with you for further discussion.",
        "success");

    //window.location.href = 'http://eluminoustechnologies.com/thankyou/';

    setTimeout(function() {

        //window.location.href = 'http://eluminousdev.com/mobile-app-development/';

        window.location.href = 'https://eluminoustechnologies.com/thank-you/';

    }, 3000);

});
</script>

<!-- Google Code for Outsourcing Conversion Page -->
<script type="text/javascript">
/ <![CDATA[ /
var google_conversion_id = 880466289;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "2mOECNzPnG8Q8bLrowM";
var google_remarketing_only = false;
/ ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt=""
            src="//www.googleadservices.com/pagead/conversion/880466289/?label=2mOECNzPnG8Q8bLrowM&amp;guid=ON&amp;script=0" />
    </div>
</noscript>

<?php

        unset($_POST['your_name_1']);

        unset($_POST['your_email_address_1']);

		unset($_REQUEST['phone_1']);

		unset($_REQUEST['country_1']);

		unset($_REQUEST['brief_requirement_1']);

       ?>



<?php

}

?>

<!DOCTYPE html>

<html lang="en">



<head>



    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="eLuminous Is Best Web & Mobile Apps Development Outsourcing Company Focusing On Creative, Value Added Solution, Amazing User-Experience To Enhance Your ROI.">

    <meta name="keywords" itemprop="keywords"
        content="outsource web development, web development company in india, web developers in india, outsource web development india" />

    <meta name="author" content="">

    <title>Outsourcing Web Development</title>

    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: https://bootswatch.com/flatly/ -->

    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom CSS -->

    <link href="css/style.css" rel="stylesheet">



    <!-- Custom Fonts -->

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->



    <!--Google Analytics Code:-->

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



    ga('create', 'UA-85705817-1', 'auto');

    ga('send', 'pageview');
    </script>



    <script type="text/javascript">
    setTimeout(function() {
        var a = document.createElement("script");

        var b = document.getElementsByTagName("script")[0];

        a.src = document.location.protocol + "//script.crazyegg.com/pages/scripts/0056/8882.js?" + Math.floor(
            new Date().getTime() / 3600000);

        a.async = true;
        a.type = "text/javascript";
        b.parentNode.insertBefore(a, b)
    }, 1);
    </script>



</head>



<body id="page-top" class="index">



    <!-- Navigation -->

    <nav class="navbar navbar-default navbar-fixed-top navbar-custom">

        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header page-scroll">

                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="https://eluminoustechnologies.com/" target="_blank"><img
                        src="img/logo.png" alt="eluminous logo"></a>

            </div>



            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <div class="telwrap"><span class="call">Toll Free: USA : </span> <a href="tel:02030564373">+1 646 688
                        3509</a>
                    <div class="skype"><img src="./img/skype1.png"><a
                            href="skype:eluminoustechnologies">eluminoustechnologies</a></div>
                </div>

                <ul class="nav navbar-nav navbar-right">

                    <li class="hidden">

                        <a href="#page-top"></a>

                    </li>

                    <li class="page-scroll">

                        <a href="#whyus">Why Choose Us</a>

                    </li>

                    <li class="page-scroll"><a href="#venus">Services</a></li>



                    <li class="page-scroll">

                        <a href="#portfolio">Portfolio</a>

                    </li>

                    <li class="page-scroll">

                        <a href="#saturn">FAQ</a>

                    </li>

                    <li class="page-scroll">

                        <a href="#jupiter">The Team</a>

                    </li>

                </ul>

            </div>

            <!-- /.navbar-collapse -->

        </div>

        <!-- /.container-fluid -->

    </nav>



    <!-- Header -->

    <header>

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="intro-text">

                        <h1 class="name">Enjoy More Profit by Outsourcing Web Development to Us!</h1>

                        <span class="skills">No Big Upfront Cost & Deliver Projects On-Time</span>

                        <span class="highlight skills2">Interested?</span>

                        <span class="page-scroll"><a class="btn btn-primary" href="#themainform">Please Click
                                Here</a></span>


                    </div>

                </div>

            </div>
        </div>
    </header>



    <!-- why choose us Grid Section -->

    <section id="mercury">

        <div class="container">

            <div class="col-md-6 thelist">

                <div class="row">

                    <div class="col-sm-12 mrbot50"> <img src="img/devlopment-icon.png" alt="web development icon"
                            class="webappIcon"></div>

                    <div class="col-sm-12">

                        <h2>We create value to our clients through</h2>

                        <ul class="poiul mrbot30">

                            <li>Incredible UI/ UX.</li>

                            <li>Customized solution that are best-fit for clients.</li>

                            <li>Commercially successful applications.</li>

                            <li>Guaranteed on-time delivery.</li>

                            <li>Competitor &amp; business model analysis.</li>

                            <li>Committed 24/7 support.</li>

                            <li>Innovative solutions as per your industry standards.</li>

                            <li>Average experience of resources is 4-5 years.</li>

                            <li>Good communication skills of resources.</li>

                            <li>Goal oriented &amp; target driven.</li>

                            <li>Works just like your in-house team.</li>

                            <li>Zealous about innovation.</li>

                            <li>You are visible to your customers all the time.</li>

                            <li>Builds a Direct Marketing Channel.</li>

                            <li>Creates a brand & recognition.</li>

                            <li>Forms Engaged Customer Community.</li>

                            <li>Skyrockets your revenues.</li>

                        </ul>

                    </div>

                </div>

            </div>



            <div class="col-md-6 thelrfrm">

                <div id="themainform" class="theform">

                    <div class="frmhead">Let’s Discuss<h2>Your Requirements</h2>
                    </div>

                    <p class="frmheading"><b>You are Just 60 seconds away from your Desire !</b></p>

                    <p>Fill in the form &amp; we will <span class="highlight">callback today</span></p>

                    <form action="" method="post" name="request_callback">

                        <fieldset>

                            <div class="form-group">

                                <span><input class="form-control" required type="text" placeholder="Name" size="40"
                                        value="" name="your_name_1"></span>

                            </div>

                            <div class="form-group">

                                <span><input class="form-control" required type="email" placeholder="Email" size="40"
                                        value="" name="your_email_address_1"></span>

                            </div>

                            <div class="form-group">

                                <span>

                                    <!--<input class="form-control" required type="text" placeholder="Country" size="40" value="" name="country_1">			-->

                                    <select required name="country_1" required class="form-control">

                                        <option value="">Select Your Country</option>

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

                                </span>

                            </div>

                            <div class="form-group">

                                <span><input class="form-control" required type="text" placeholder="Cell Number"
                                        size="40" value="" name="phone_1"></span>

                            </div>

                            <div class="form-group">

                                <span><textarea class="form-control" placeholder="Brief Requirements" rows="10"
                                        cols="40" name="brief_requirement_1"></textarea></span>

                            </div>

                            <input class="btn btn-primary submit-btn" type="submit" value="Submit"
                                name="btn_request_callback">

                        </fieldset>

                    </form>

                </div>

            </div>



        </div>

    </section>



    <section id="whyus">

        <div class="container">

            <h2 class="text-center">Why choose eLuminous?</h2>

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



    <section id="venus">

        <div class="container">

            <h2 class="text-center">Expand Your Team</h2>

            <h4 class="text-center vensub">&amp; Outsource To Our <span class="highlight">Qualified</span> Experts</h4>

            <h3 class="text-center highlight">Web Development</h3>

            <hr class="star-primary">



            <div class="row mrtop30">

                <div class="col-md-4 exblock">

                    <h2>Customised PHP-MySQL solutions</h2>

                    <p>We develop &amp; design websites, portals, partner sites, responsive sites. </p>

                </div>

                <div class="col-md-4 exblock">

                    <h2>E-Commerce Solutions</h2>

                    <p>We have developed 100+ sites in Magneto, Woo Commerce, Wordpress, and Drupal.</p>

                </div>

                <div class="col-md-4 exblock">

                    <h2>Open Source Solutions</h2>

                    <p>We offer open source solutions with our Wordpress developers, Joomla developers, Magneto
                        developers, Drupal developers etc.</p>

                </div>

            </div>





            <!--<h3 class="text-center highlight">Mobile Apps Development</h3>
        <hr class="star-primary"> -->

            <div class="row mrtop30">

                <div class="col-md-4 exblock">

                    <h2>API integration</h2>

                    <p>Payment Processors- PayPal, AIM, 2CO, epay, Social Networking integration – Facebook, Twitter,
                        Hi5, etc.</p>

                </div>

                <div class="col-md-4 exblock">

                    <h2>Collaborative Work</h2>

                    <p>Our developers work in a collaborative way with their involvement right from your concept to
                        implementation and make it unique.</p>

                </div>

                <div class="col-md-4 exblock">

                    <h2>We also offer</h2>

                    <p>SEO, Business Consulting, Microsoft Sharepoint, and Virtual Assistant Services.</p>

                </div>

            </div>

        </div>

    </section>





    <section id="earth">

        <div class="container">

            <div class="col-sm-4 block3img"><img src="img/left.jpg"></div>

            <div class="col-sm-4 hidden-xs block3img"><img src="img/middle.jpg"></div>

            <div class="col-sm-4 hidden-xs block3img"><img src="img/right.jpg"></div>

        </div>

    </section>







    <!-- Portfolio Grid Section -->

    <section id="portfolio">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12 text-center">

                    <h2>Our Projects</h2>

                    <h3 class="text-center vensub">Have a look at some of our<span class="highlight"> work in
                            detail</span></h3>

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

                            <img src="img/portfolio/progenesisivf.jpg" class="img-responsive" alt="">

                            <span>Progenesis </span>

                        </a>

                    </div>

                    <div class="col-md-3 col-sm-6 portfolio-item">

                        <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">

                            <div class="caption">

                                <div class="caption-content">

                                    <i class="fa fa-search-plus fa-3x"></i>

                                </div>

                            </div>

                            <img src="img/portfolio/grandballroom.jpg" class="img-responsive" alt="">

                            <span>Grand Dallroom</span>

                        </a>

                    </div>

                    <div class="col-md-12 text-center"><a class="viewmore"
                            href="https://eluminoustechnologies.com/portfolio/" target="_blank">View More </a> </div>

                </div>

            </div>

        </div>

    </section>





    <section id="jupiter">

        <div class="container-fluid">

            <h2 class="text-center">Meet Our <span class="highlight">Experts</span></h2>

            <div class="container">

                <div class="row items mrbot30">



                    <div class="xpert col-md-4 col-sm-6">

                        <div class="xpertwrap">

                            <div class="xpertimg"><img class="img-responsive" src="img/Sachin.png"></div>

                            <div class="xpertname">Sachin Shelke</div>

                            <div class="xpertdesc">Sachin is our Sr. Project Team Lead (Products segment) with 10 years
                                of experience, incorporating the skills of our project managers and business analysts
                            </div>

                        </div>

                    </div>

                    <div class="xpert col-md-4 col-sm-6">

                        <div class="xpertwrap">

                            <div class="xpertimg"><img class="img-responsive" src="img/Nitin.png"></div>

                            <div class="xpertname">Nitin Mahajan</div>

                            <div class="xpertdesc">Nitin has over 10+ years of corporate experience in Project
                                management as a developer, consultant and project leader, now managing our major
                                corporate projects</div>

                        </div>

                    </div>

                    <div class="xpert col-md-4 col-sm-6">

                        <div class="xpertwrap">

                            <div class="xpertimg"><img class="img-responsive" src="img/Priyank.png"></div>

                            <div class="xpertname">Priyank Purohit</div>

                            <div class="xpertdesc">He has over 9+ years of experience in web &amp; mobile apps
                                consulting. He conceptualizes the ideas of clients & help them to visualize their
                                products.</div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

        <div class="container">

            <div class="row item">

                <div class="xpert col-md-4 col-sm-6">

                    <div class="xpertwrap">

                        <div class="xpertimg"><img class="img-responsive" src="img/Shruti-.png"></div>

                        <div class="xpertname">Shruti Shah</div>

                        <div class="xpertdesc">Shruti is an amazing innovator and an extremely detailed orientated
                            individual. She has been a key resource to our in-house product development since its
                            inception</div>

                    </div>

                </div>

                <div class="xpert col-md-4 col-sm-6">

                    <div class="xpertwrap">

                        <div class="xpertimg"><img class="img-responsive" src="img/tejal.png"></div>

                        <div class="xpertname">Tejal Balak</div>

                        <div class="xpertdesc">Tejal has 5 years experience in IT, excelling in programming, project
                            management. He also has an extensive knowledge in Angular JS, jQuery and various upcoming
                            technologies.</div>

                    </div>

                </div>

                <div class="xpert col-md-4 col-sm-12">

                    <div class="xpertwrap">

                        <div class="xpertimg"><img class="img-responsive" src="img/asif.png"></div>

                        <div class="xpertname">Asif Shaikh</div>

                        <div class="xpertdesc">Asif is a perfectionist when it comes to creativity. Since joining
                            eLuminous, he has been able to introduce a unique and incredible UI/UX within his designs
                        </div>

                    </div>

                </div>

            </div>

        </div>







    </section>



    <section id="saturn">

        <div class="saturn">

            <div class="container">

                <h2>FAQ’s</h2>

            </div>

        </div>

    </section>





    <!-- About Section -->

    <section class="success" id="about">

        <div class="container">
            <div data-ride="carousel" data-interval="false" class="carousel slide col-sm-10 col-sm-offset-1 text-center"
                id="faqCarousel">
                <p></p>
                <div role="listbox" class="carousel-inner">
                    <div class="item">
                        <h2>Can you help me build a concept for my app or website?</h2>
                        <p>We always take full interest in your concept, understand your business model, your
                            competitors or reference apps and form a strategy by understanding your SWOT. Our consulting
                            experts will then bring your idea into a framework or prototype that you like. Then our
                            developers turn it into reality.</p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>
                    <div class="item active">
                        <h2>How can I get in touch with the developers according to my Time zone?</h2>
                        <p>The developers are online on Gtalk, Skype &amp; other Instant Messengers. For big projects,
                            we tweak our team’s timings depending on the client’s time zone to ensure the timings don’t
                            crumple the “communication�? &amp; of course our “On Time Deliveries�?.</p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>
                    <div class="item">
                        <h2>How will you manage my project?</h2>
                        <p>Based on your preferences and size of project, we choose daily status emails, Online PMS i.e.
                            using popular time tracking and project management tools like Teamwork Basecamp, Mavenlink
                        </p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>

                    <div class="item">
                        <h2>What forms of payment are available?</h2>
                        <p>Our customers have the choice to pay via Bank Wire Transfer/ Bank TT, 2Checkout, Paypal with
                            credit or debit cards.</p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>
                    <div class="item">
                        <h2>Will my code and database be secure? Can you sign NDA?</h2>
                        <p>eLuminous has handled a large variety of sensitive information including millions of CC
                            numbers, emails and details of your customers as well. Our business is based on strong
                            ethical foundation and we take decisions based on highest level of ethical integrity and our
                            core values. We welcome signing NDA (Non-Disclosure Agreement) as needed</p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>
                    <div class="item">
                        <h2>What if I there are bugs after delivery?</h2>
                        <p>We provide 90 days FREE service from beta delivery of your application. Hence you can relax
                            as even if any bugs arises, it won’t eat your pocket</p>
                        <div class="faqbtnwrap"><a href="#faqCarousel" role="button" class="faqbtn"
                                data-slide="next">Next Question </a></div>
                    </div>
                </div>
                <h4 class="highlight">eLuminous helps you transform your thoughts into extenstible, simple &amp;
                    perceptive technology based solution.</h4>
            </div>
        </div>

    </section>





    <section class="line9" id="uranus">

        <div class="container">

            <div class="col-sm-10 col-sm-offset-1 text-center">

                <h2>We offer truly value added solution in web development to our clients </h2>

            </div>

        </div>

    </section>



    <section class="line10" id="neptune">

        <div class="container">

            <div class="col-md-4 col-sm-3  tfqleft hidden-xs"></div>

            <div class="col-md-4 col-sm-6 tfqmid page-scroll"><span>Interested?</span><a class="btn btn-primary"
                    href="#themainform">Please Click Here</a></div>

            <div class="col-md-4 col-sm-3  tfqright hidden-xs"></div>

        </div>

    </section>









    <!-- Footer -->

    <footer class="text-center">

        <div class="footer-above">

            <div class="container">

                <div class="col-md-4 footblock">

                    <div class="foottitle">

                        <p class="help-block"><a data-toggle="modal" data-target="#privacyPolicy">PRIVACY POLICY</a></p>

                    </div>

                    <p>COPYRIGHT &copy; 2016<br>

                        ELUMINOUS TECHNOLOGIES PVT. LTD.</p>

                </div>

                <div class="col-md-4 footblock">

                    <div class="foottitle">LOCATION</div>

                    <p><strong class="highlight">A:</strong> 708 3rd Ave, New York,<br> NY 10017, USA</p>



                    <p><strong class="highlight">T:</strong> +1 646 688 3509<br>

                        <strong class="highlight">E:</strong> <a
                            href="mailto:sales@eluminoustechnologies.com">sales@eluminoustechnologies.com</a>
                    </p>

                </div>

                <div class="col-md-4 footblock">

                    <div class="foottitle">ABOUT THE COMPANY</div>

                    <p>With 14 years of experience we understand its not about the project / technology but about the
                        Purpose.<br>

                        Understanding the purpose behind your software needs makes us unique from competition.</p>

                </div>

            </div>



        </div>

    </footer>



    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->

    <div class="scroll-top page-scroll visible-xs visible-sm">

        <a class="btn btn-primary" href="#page-top">

            <i class="fa fa-chevron-up"></i>

        </a>

    </div>



    <!-- Portfolio Modals -->

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

                                <a target="_blank" href="https://www.mbt.com/en-gb" role="button"
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

                                <img src="img/portfolio/progenesisivf.jpg" class="img-responsive img-centered"
                                    alt="progenesisivf">
                            </div>

                            <div class="col-md-5">

                                <h2>Progenesis</h2>

                                <span>Healthcare Website</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">Wordpress</strong>

                                    </li>

                                </ul>

                                <p>his website belongs to healthcare. It is an informative site about Fertility
                                    Treatments & Procedures, Pregnancy Plan etc.</p>

                                <a target="_blank" href="https://www.progenesisivf.com/" role="button"
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

                                <img src="img/portfolio/grandballroom.jpg" class="img-responsive img-centered"
                                    alt="grandballroom">
                            </div>

                            <div class="col-md-5">

                                <h2> Grand Ballroom </h2>

                                <span>Grand ballroom and its services.</span>

                                <hr class="star-primary">

                                <ul class="list-inline item-details">

                                    <li>Technology:

                                        <strong class="highlight">WordPress, HTML5, Jquery, CSS3, Responsive</strong>

                                    </li>

                                </ul>

                                <p>This is an informative website for one of our client who wanted to promote their
                                    grand ballroom and its services. It’s a simple WordPress site that gives an
                                    information about the sitting arrangements and the banquet room plan of the
                                    ballroom.</p>

                                <a target="_blank" href="https://www.grandballroom.in/" role="button"
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







    <!-- jQuery -->

    <script src="js/jquery.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="js/bootstrap.min.js"></script>



    <!-- Plugin JavaScript -->

    <script src="js/jquery.easing.min.js"></script>

    <script src="js/classie.js"></script>

    <script src="js/cbpAnimatedHeader.js"></script>



    <!-- Custom Theme JavaScript -->

    <script src="js/custom.js"></script>



    <script>
    $(document).ready(function() {

        $(this).scrollTop(0);

    });
    </script>



    <script type="text/javascript">
    jQuery(document).ready(function() {
        <?php
		$cookie_name 	= "ChristmasPopups";
		$cookie_value 	= true;
		if(!isset($_COOKIE[$cookie_name])) {
			?>
        setTimeout(function() {
            //jQuery('#overlay').show();
            //jQuery('#specialPageHtml').show();
        }, 7000);
        <?php
			setcookie($cookie_name, $cookie_value, time() + (86400 * 2), "/"); 
		}
		?>
        jQuery(".no").click(function() {
            jQuery('#overlay').hide('slow');
            jQuery('#specialPageHtml').hide('slow');
        })
        jQuery(".yes").click(function() {
            jQuery('.poup_fst').hide();
            jQuery('.poup_sec').show();
        })
        jQuery(".closePospup").click(function() {
            jQuery('#overlay').hide('slow');
            jQuery('#specialPageHtml').hide('slow');
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
                            jQuery('#overlay').hide('slow');
                            jQuery('#specialPageHtml').hide('slow');
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
            font-size: 30px;
            font-weight: 400;
            margin-bottom: 20px;
            margin-top: 0;
            padding: 0 40px;
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
            padding: 8px 70px;
            color: #fff;
        }

        .popup-sec1 a span {
            display: block;
            font-family: "Roboto", sans-serif;
            font-size: 12px;
            font-weight: 400;
        }

        .popup-sec1 small {
            padding: 20px;
            position: relative;
            top: -20px;
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
            padding: 10px;
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
            line-height: 42px;
            margin-left: 3px;
            text-transform: uppercase;
            width: 56%;
        }

        .popup-sec2 [type="button"]:hover {
            background: #fc8d2a;
        }

        .closePospup {
            background: #000 none repeat scroll 0 0;
            border: 2px solid #fff;
            border-radius: 50px;
            color: #fff;
            cursor: pointer;
            height: 25px;
            line-height: 43px;
            padding: 2px 6px;
            position: absolute;
            right: -12px;
            top: -7px;
            width: 25px;
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
    <script>
    window.addEventListener('load', function() {
        jQuery('[name="btn_request_callback"]').click(function() {
            (new Image()).src =
                "//www.googleadservices.com/pagead/conversion/880466289/?label=2mOECNzPnG8Q8bLrowM&guid=ON&script=0";
        })
    })
    </script>


</body>



</html>