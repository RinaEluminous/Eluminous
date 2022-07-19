<?php 
$pagename = "whitepapers";
$pagename1 = "whitepapers";
$pageTitle = "Whitepapers By eLuminous - Creating Values"; //Put page title here
$metaDesc = "Download the latest whitepapers published by eLuminous! Create value proposition to your business to grab higher profits."; //Put meta description here
$keywords = "Technology whitepapers,data integration whitepaper,technology documents";//Put keywords here
?>
<?php require_once 'includes/head.php';?>
<?php
$statusMsg = '';
if(isset($_POST['submit'])){
	$name = $_POST['yname'];
	$email = $_POST['yemail'];
	// echo $email;die;
	if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
		// MailChimp API credentials
		//$api_key = 'b5c5b2260813d92498d241e3299d37ee-us19';
		//$list_id = '1dc7fb5efc';
		
		$api_key = '6588fa5e9b206af340e3b6f154b7255f-us8';
		$list_id = '0bc00caa54';

		$first_name = $name;
		$last_name = '';
		
		
		// server name followed by a dot. 
		// We use us13 because us13 is present in API KEY
		$server = 'us8.'; 


		$auth = base64_encode( 'user:'.$api_key );

		$data = array(
			'apikey'        => $api_key,
			'email_address' => $email,
			 'status'        => 'subscribed',
			'merge_fields'  => array(
				'FNAME' => $first_name,
				'LNAME'    => $last_name
			)    
		);
		$json_data = json_encode($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://'.$server.'api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
			'Authorization: Basic '.$auth));
		curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_POST, true);    
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

		$result = curl_exec($ch);
		//print_r($result);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

			// store the status message based on response code
		if ($httpCode == 200) {
			$statusMsg = '<p style="color: #34A853">You have successfully subscribed to Eluminous Blog.</p>';

		} else {
			switch ($httpCode) {
				case 214:
				$msg = 'You are already subscribed.';
				break;
				default:
				$msg = 'Some problem occurred, please try again.';
				break;
			}
				//$_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
			$statusMsg = '<p style="color: #EA4335">'.$msg.'</p>';
		}
	}else{
		$statusMsg = '<p style="color: #EA4335">Please enter valid email address.</p>';
	}
}
?> 
<!-- inner_banner -->
<section class="inner_banner">
	<img src="<?php echo SITE_URL; ?>images/whitepapers/whitepapers.png" alt="Whitepapers" class="img-fluid">
	<div class="inner_page_title">
		<div class="container">
			<h1>Whitepapers
			<small>Read the Whitepapers published by our Technical Experts in Data Analytics &amp; BI, <br>Web Application Development, Mobile Apps Development</small></h1>
		</div>
	</div>
</section>
<!-- inner_banner -->

<!-- Our Team Top-notch coding talent -->
<section class="data_analytics">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5">
				<div class="data_analytics_inside"><img src="<?php echo SITE_URL; ?>images/whitepapers/data-integration-2020.jpg" alt="Data Integration 2020" class="img-fluid"></div></div>
			<div class="col-lg-7 col-md-7">
				<h4><strong>Topic:</strong> Data Analytics &amp; BI</h4>
				<p>Data is the new oil; goes the conventional saying. But with an explosion of data-generating apps and devices over the past decade, it would be prudent to refer to data as the new crude oil. That is because data in its raw and unprocessed form comprises documents, files, logs, etc. from a variety of applications, devices and systems. Add to that data from non-conventional channels like social media, and it becomes imperative to seam all the data together to make informed business decisions.</p>
				<p class="whitepaper-following"><strong>This whitepaper include the following:</strong></p>
				<ul class="data_analytics_list">
					<li>Why Traditional Data Integration Approach, Architecture and Methodologies Need An Overhaul?</li>
					<li>Next-Generation Data Integration Approach</li>
					<li>What a Next-Generation Data Integration Architecture Looks Like?</li>
					<li>Case Study</li>
					<li>Conclusion</li>
				</ul>
			</div>
		</div>
		<div id="boxDiv" class="<?php echo (isset($statusMsg) && ($statusMsg!='')) ? '' : 'data_analytics_latter_box' ?> ">
			<!-- <h3><span>Download Whitepaper Now!</span> Leave your email to get it for FREE!</h3>
			<p>* We care about your data. It won't get misused. Its our Promise!</p> -->
			<div class="data_analytics_latter_box_form">
				<?php if (isset($statusMsg) && ($statusMsg!='')) { ?>
					<!-- <h3><span>Download Whitepaper Now!</span></h3>  -->
					<?php } else { ?>
					<h3><span>Download Whitepaper Now!</span> Leave your email to get it for FREE!</h3>
					<p>* We care about your data. It won't get misused. Its our Promise!</p>
					<!-- <h3>Leave your email to get it for FREE!</h3> -->
					<?php } ?>
					<div class="popup-form">
					<?php if (isset($statusMsg) && ($statusMsg!='')) { ?> 	
					<div>
					<p><?php echo $message; ?></p>
					<div class="thank-you-box" id="thank-you-box">
						<h3>Thank you</h3>
						<a href="<?php echo SITE_URL; ?>images/pdf/data-integration-whitepaper-2020.pdf" target="_blank" class="small_blue_btn">Download Now</a>
					</div>
					</div>
					</div>
					<?php }else{ ?>
				    <form method="post" action="" data-form-processed="true" id="whitepaperForm">
					<div class="row">
						<div class="col-md-4 col-lg-4">
							<input name="yname" id="yname" type="text" placeholder="Your Name">
						</div>
						<div class="col-md-4 col-lg-4">
							<input name="yemail" id="yemail" type="email" placeholder="Email Adderss">
						</div>
						<div class="col-md-4 col-lg-2">
							<!--<input name="submit" type="submit" value="Download ebook" id="btnSubmit" style="background:;" />-->
							<input name="submit" type="submit" class="small_blue_btn" value="Download" data-toggle="modal" data-target="#thank-you-modal" id="btnSubmit" >
						</div>
					</div>
				    </form>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php require_once 'includes/footer.php';?>
<!-- <script type="text/javascript">
    $.validator.addMethod("nameval", function(value, element) { 
        return  /^([a-zA-Z ]{3,30})$/.test(value); 
    }, "Please enter valid name.");

    $.validator.addMethod("emailval", function(value, element) { 
        return  /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value); 
    }, "Please enter a valid email address.");

     // $(document).ready(function(){
        $('#whitepaperForm').validate({
            highlight: function(element) {
                $(element).parent().addClass("errorElement");
            },
            rules: {
                yname: {
                    required: true,
                    nameval: true
                },
                yemail: {
                    required: true,
                    emailval: true
                },
            },
            messages: {
                yname: {
                    required: 'This is required.',
                },
                yemail: {
                    required: 'This is required.',
                },
            },
            submitHandler: function(){
                var name = $('#homePageName').val();
                var email = $('#homePageEmail').val();
                var currentSiteUrl = "http://dev.eluminousdev.com/vaibhavi/elu/";
                var homeResponcePage = currentSiteUrl + "homePageFormResponse";
                $.ajax({
                    method: 'POST',
                    url: homeResponcePage,
                    data: {
                        'homePageName' : 'name',
                        'homePageEmail': 'email',
                        'authentication': 'whitepaperSubmission'
                    },
                    success: function(data){
                        console.log('success');
                    }
                });
            }
        // });
    });
</script> -->
<script type="text/javascript">

		jQuery(document).ready(function() {

			jQuery("#btnSubmit").click(function(){

				var email	=	jQuery("#yemail").val();
				var name	=	jQuery("#yname").val();
				var count	=	0;

				if(name	==	""){
					count = 1;
					jQuery("#yname").css("border","2px solid red");

				}else{
					jQuery("#yname").css("border","none");
				}

				var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

				if (filter.test(email)) {
					jQuery("#yemail").css("border","none");
				}else {
					count = 1;
					jQuery("#yemail").css("border","2px solid red");
				}

				if(count ==0){
					return true;
				}else{
					return false;
				}
			});
		});
	</script>