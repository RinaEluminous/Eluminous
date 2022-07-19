<?php get_header();?>
<?php
$statusMsg = '';
if(isset($_POST['submit'])){
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			// MailChimp API credentials
		//$api_key = 'b5c5b2260813d92498d241e3299d37ee-us19';
		//$list_id = '1dc7fb5efc';
		
		$api_key = '6588fa5e9b206af340e3b6f154b7255f-us8';
		$list_id = '77a94f10bd';

		$first_name = $fname;
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
<section class="p-0">
	<div class="container p-0">
		<div class="row blog_row m-0">
			<div id="primary" class="content-area col-sm-12 pt-sm-4 col-md-7 pt-lg-5 pb-5 col-lg-8 pt-lg-3 pt-md-2">
				<main id="main" class="site-main pt-lg-4" role="main">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php //get_template_part( 'template-parts/content','ebook' ); ?>
						<?php
						$airkit_post_thumbnail = get_post_thumbnail_id( get_the_ID() );
						$airkit_img_src = wp_get_attachment_url( $airkit_post_thumbnail ,'medium');
						$uploaded_file = get_post_meta(get_the_ID(), 'wpcf-upload-file', true); 
						$download_btn_color = get_post_meta(get_the_ID(), 'wpcf-download-button-color', true); 

						?>
						<div class="e-book-details">
							<div class="row align-items-center justify-content-center">
								<div class="col-md-12 col-lg-3 col-sm-12 mb-3 mb-lg-0 mb-md-0">
									<div class="book-img-sec">
										<img src="<?php echo $airkit_img_src; ?>" alt="" class="img-fluid"/>
									</div>
								</div>
								<div class="col-md-12 col-lg-9 col-sm-12"> 
									<h2>
										<?php the_title(); ?></h2>
										<?php the_excerpt(); ?>
									</div>
									<div class="col-md-12">
										<div class="news-latter-box">
											<?php if (isset($statusMsg) && ($statusMsg!='')) { ?> 
												<h3>Thank you</h3>
											<?php } else { ?>
												<h3>Leave your email to get it for FREE!</h3>
											<?php } ?>
											<div class="popup-form">
												<?php if (isset($statusMsg) && ($statusMsg!='')) { ?> 	
													<div>
														<p><?php echo $message; ?></p>
														<a href="<?php echo $uploaded_file; ?>" target="_blank" class="small_blue_btn">Download Now</a>
													</div>
												<?php }else{ ?>
													<form method="post" action="">
														<div class="row">
															<div class="col-md-12 col-lg-6 mb-md-3 mb-lg-0">
																<input name="fname" id="fname" type="text" placeholder="Your First Name" required="required" />
															</div>
															<div class="col-md-12 col-lg-6">
																<input name="email" id="email" type="email" placeholder="Email ID" required="required" />
															</div>
															<div class="col-md-12">
																<!--<input name="submit" type="submit" value="Download ebook" id="btnSubmit" style="background:<?php echo $download_btn_color; ?>;" />-->
																<input name="submit" type="submit" class="small_blue_btn" value="Download ebook" id="btnSubmit"/>
															</div>
														</div>
													</form>

												<?php } ?>
											</div>
										</div>
									</div>
									<?php if ($statusMsg=='') { ?> 
									<div class="col-md-12"> <div class="popup-footer"> Your email id is safe with us. We hate SPAM as much as you. </div> </div>
								<?php } ?>
								</div>
							</div>
						<?php endwhile; ?>
					</main>
				</div>
				<div class="col-sm-12 col-md-5 drop-shaddow-section pt-lg-5 pb-5 col-lg-4 pt-lg-3 pt-md-2 pr-md-3">
					<div class="side_bar_shaddow pt-3">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php get_footer();?>
	<script type="text/javascript">

		jQuery(document).ready(function() {

			jQuery("#btnSubmit").click(function(){

				var email	=	jQuery("#email").val();
				var fname	=	jQuery("#fname").val();
				var count	=	0;

				if(fname	==	""){
					count = 1;
					jQuery("#fname").css("border","2px solid red");

				}else{
					jQuery("#fname").css("border","none");
				}

				var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

				if (filter.test(email)) {
					jQuery("#email").css("border","none");
				}else {
					count = 1;
					jQuery("#email").css("border","2px solid red");
				}

				if(count ==0){
					return true;
				}else{
					return false;
				}
			});
		});
	</script>