<?php

/* Template Name: Mobile APP */

get_header();

require_once('mail_functions.php');

include("class.phpmailer.php");


if(isset($_REQUEST['btn_submit']) && ($_REQUEST['btn_submit'] !="")){

	$strFirstName	=	trim($_REQUEST['strFirstName']);

	$strEmail	=	trim($_REQUEST['strEmail']);

	require_once 'mailchimp/MCAPI.class.php';

	$apikey = '5e7454474599937e06be1c04740c87b8-us13';

	$listId = 'dba73e5f02';//'f5f8296e9d'; 

	$apiUrl = 'http://api.mailchimp.com/1.3/';

	$adminMail	=	"eluminous_bde3@eluminoustechnologies.com";

	$adminMail2	=	"eluminous_bde7@eluminoustechnologies.com";

	$adminEmailFrom	=	$customerEmail = $strEmail ;

	$adminMailsubject	=	"eBook Download report";

	$customerMailsubjec	=	"Thank you for downloading Business Intelligence eBook report";

	$AdminMailbody	=	"<p>Dear Admin,</p><p>".$strFirstName." has downloaded <strong>Business Intelligence eBook report</strong>.</p><p>Here are the details: <br/><strong>Name</strong>: ".$strFirstName."<br/><br/><strong>Email</strong>:".$strEmail."</p><p>Team eLuminous</p>";

	$customerMailbody	=	"<p>Dear ".$strFirstName."</p><p>Thank you for showing interest in Business Intelligence eBook report.<p>Team eLuminous</p>";			



	// create a new api object

	$api = new MCAPI($apikey);

	

	// set $merge_vars to null if you have only one input

	$merge_vars = null;

	$merge_vars = array('FNAME'=>$strFirstName);

	

	if($email !== '') {

	

	$return_value = $api->listSubscribe( $listId, $strEmail, $merge_vars, 'html', false, false, false, false );

	

	// check for error code

	$strErrorMessage	=	'';

	if ($api->errorCode){

		$strErrorMessage = "Error: $api->errorCode, $api->errorMessage";

	} else{

	

	$message = "Thank you for showing the interest in this eBook";

	

	// Admin Mail

	$isSend	=	sendmail($adminMail, $adminEmailFrom,	$adminMailsubject, $AdminMailbody, $strPopFname);

	$isSend	=	sendmail($adminMail2, $adminEmailFrom,	$adminMailsubject, $AdminMailbody, $strPopFname);

	// Customer Email

	$isSend	=	sendmail($customerEmail, $adminMail,	$customerMailsubjec, $customerMailbody, 'Admin');

	}

	}else{

		$message = "Email is is not valid";

	}

	//-----------------Add user to mailchimp list end----------------------

	

	

}

?>

<script type="text/javascript">

jQuery(document).ready(function() {

	jQuery("#btnSubmit").click(function(){

		var strEmail	=	jQuery("#strEmail").val();

		var strFirstName	=	jQuery("#strFirstName").val();

		var count	=	0;

		if(strFirstName	==	""){

			count = 1;

			jQuery("#strFirstName").css("border","2px solid red");

		}else{

			jQuery("#strFirstName").css("border","none");

		}

		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

		if (filter.test(strEmail)) {

			jQuery("#strEmail").css("border","none");

		}else {

			count = 1;

			jQuery("#strEmail").css("border","2px solid red");

		}

		if(count ==0){

			return true;

		}else{

			return false;

		}

	});



});



</script>

<div id="primary" class="content-area col-sm-12 col-md-12">

  <main id="main" class="site-main" role="main">

    <div>

      <style>

@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900');

@import url('https://fonts.googleapis.com/css?family=Anton');

/*font-family: 'Anton', sans-serif;*/



a{ text-decoration:none;}

.popup-sec {

  background-color: #fff;

  border: 1px solid #ededed;

  border-radius: 10px;

  font-family: "Roboto",sans-serif;

  margin: auto;

  max-width: 600px;

  overflow: hidden;

  padding: 25px 0px 0;

}

.popup-sec h2 {

  color: #ef8720;

  font-family: "Anton",sans-serif;

  font-size: 36px;

  font-weight: normal;

  line-height: 43px;

  margin-bottom: 11px;

  margin-top: 10px;

  text-transform: uppercase;

}

  .popup-sec h3 {

  color: #323232;

  font-size: 18px;

  margin-bottom: 0px;

  margin-top: 0;

  font-weight:normal;

 }

.popup-sec img {

  float: left;

  margin-left: 30px;

  margin-right: 50px;

}

.popup-form {

  background: #efede1 none repeat scroll 0 0;

  clear: both;

  float: left;

  margin-top: 10px;

  padding: 15px 25px;

  width: 100%;

  text-align:center;

}

.popup-form a {

  background: #333;

  color: #fff;

  padding: 10px 20px;

  border-radius: 5px;

}

.popup-form a:hover {

  background: #434343;

  }

.popup-footer {

  background: #ef8720 none repeat scroll 0 0;

  clear: both;

  color: #fff;

  display: block;

  float: left;

  font-size: 12px;

  line-height: 36px;

  padding: 0 25px;

  text-align: center;

  width: 100%;

}

.popup-form [type="text"], .popup-form [type="phone"], .popup-form [type="email"] {

  border: 1px solid #e1e1e1;

  border-radius: 5px;

  box-sizing: border-box;

  padding: 6px 10px;

  width: 100%;

}

.popup-form .col {

  float: left;

  margin-bottom: 9px;

  width: 60%;

}

.popup-form [type="submit"] {

  background: #171717 none repeat scroll 0 0;

  border: medium none;

  border-radius: 5px;

  color: #fff;

  cursor: pointer;

  font-family: "Roboto Condensed",sans-serif;

  font-size: 20px;

  font-weight: 700;

  line-height: 87px;

  margin-top: -55px;

  text-transform: uppercase;



}

.popup-form [type="button"]:hover{ background:#0d0d0d;}

.col-last {

  float: left;

  margin-left: 20px;

  width: 36%;

}

.popup-form .col:nth-child(2) {

  margin: 0;

}

.popup-sec2 {

  margin-top: 30px;

}

@media (max-width: 640px){

	.popup-sec {text-align: center;}

	.popup-sec h2 {font-size: 23px;line-height: 26px;}

	.popup-form {padding: 15px;}

	.popup-form .col {width: 100%;}

	.col-last {margin-left: 0;width: 100%;}

	.popup-form [type="submit"] {line-height: 29px;margin-top: 10px;font-size: 17px;}

	.popup-footer {line-height: 15px;padding: 7px 25px;width: 130%;}

	.popup-sec img {float: none;}

	}





</style>

      <div class="popup-sec"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/book.png" alt="" />

        <h3>Read our</h3>

        <h2>Exclusive Report on:<br>

          Business Intelligence <br>

          Trends for 2017</h2>

        <h3>Leave your email to get it for FREE!</h3>

        <div class="popup-form">

         <?php

         if(isset($strErrorMessage) && ($strErrorMessage!="")){

			 ?>

             <div class="error_message">

             	<p><?php echo $strErrorMessage; ?></p>

                

             </div>

             <?php

			 

		 }

		 if(isset($message) && ($message!="")){

			 ?>

             <div>

             	<p><?php echo $message; ?></p>

                <p><a href="http://eluminoustechnologies.com/blog/wp-content/uploads/2016/12/BI-Trends-eBook-min.pdf" target="_blank">Download Now</a></p>

             </div>

             <?php

			 

		 }else{

		 ?>

          <form action="" method="post">

            <div class="col">

              <input name="strFirstName" id="strFirstName" type="text" placeholder="Your First Name" required="required" />

            </div>

            <div class="col">

              <input name="strEmail" id="strEmail" type="email" placeholder="Email ID" required="required" />

            </div>

            <div class="col-last">

              <input name="btn_submit" type="submit" value="Download ebook" id="btnSubmit" />

            </div>

          </form>

          <?php

          }

          ?>

        </div>

        <div class="popup-footer"> Your email id is safe with us. We hate SPAM as much as you. </div>

      </div>

    </div>

  </main>

</div>

<?php get_footer(); ?>

