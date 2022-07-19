<?php
session_start();
$metaID = $_GET['job_title'] ? " - ".$_GET['job_title'] : '';
$pagename = "about-us";
$pagename1 = "job-apply";
$pageTitle = "Job Apply | eLuminous Technologies".$metaID; //Put page title here
$metaDesc = "Job Application Form - Join the team of Technology Enthusiasts".$metaID; //Put meta description here
$keywords = "Job apply, Careers in Nashik";//Put keywords here

$googlCaptchaSiteKey = "6LdpOmAUAAAAAChSg8K_wDpcKcE3ZxtbRhtnhY6n";
?>
<?php require_once 'includes/head.php';?> 
<!-- inner_banner -->
<section class="inner_banner">
	<img src="images/main_banner_bg.png" alt="main_banner_bg" class="img-fluid">
	<div class="inner_page_title">
		<div class="container">
			<h1>Job Application Form
			<small>You are just 60 seconds away from your desire</small></h1>
		</div>
	</div>
</section>
<!-- inner_banner -->  

	<!-- inner_banner -->
	<section id="inspire_true_connection">
		<div class="container">
		<form action="careerPageFormResponse" method="POST" enctype="multipart/form-data" id="carrForm">
			<h2 class="text-center">Join the team of Technology Enthusiasts</h2>
			<div class="row justify-content-between align-center">
				<div class="col-md-6 col-lg-6 col-xs-12">
					<div class="left_section cnt_feild gray_bg">
						
						<div class="form-row">
							
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/name.png" alt="name"></span>
									<input type="text" class="form-control" id="careerPageName" name="name" placeholder="Your Name *" value="<?php echo $_SESSION['name']; ?>" >
								</div>
								<div class="contact-form-error-message">
									<span class="careerPageNameError"><?php echo $_SESSION['careerPageNameError']; ?></span>
								</div>
								
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/your_email.png" alt="name"></span>
									<input type="email" pattern="[^ @]*@[^ @]*" class="form-control" id="careerPageEmail" name="email" placeholder="Your Email *" value="<?php echo $_SESSION['email']; ?>" >
								</div>
								<div class="contact-form-error-message">
									<span class="careerPageEmailError"><?php echo $_SESSION['careerPageEmailError']; ?></span>
								</div>
								
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/mobile_number.png" alt="Mobile Number"></span>
									<input type="text" class="form-control" onkeydown="return checkPhoneKey(event.key)" id="careerPageMobile" placeholder="Mobile Number " name="mobile" >									
								</div>
								<div class="contact-form-error-message">
									<span class="careerPageMobileError"></span>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="<?php echo SITE_URL;?>images/contact/job_title.png" alt="job_title"></span>
									<input type="text" class="form-control" id="careerPageJobTitle" name="jobTitle" placeholder="Job Title">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/company_name.png" alt="name"></span>
									
									<input type="text" class="form-control" id="careerPageCompanyName" name="companyName" placeholder="Current Company">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-0">
								<div class="input_white_bg">
									<span><img src="<?php echo SITE_URL;?>images/contact/job_title.png" alt="job_title"></span>
									<input type="text" class="form-control" id="careerPageProjectPosition" name="option" placeholder="Your existing position">
									<!-- <select class="custom-select" id="careerPageProjectPosition" name="option" >
										<option value="">Select Your position *</option>
										<option value="Graphic/Web Designer">Graphic/Web Designer </option>
										<option value="PHP Developer​">PHP Developer​</option>
										<option value="UI/Web Developer"> UI/Web Developer</option>
										<option value="Magento Developer​"> Magento Developer​</option>
										<option value="Content Writer"> Content Writer </option>
										<option value="Digital Marketing Executive">Digital Marketing Executive</option>
									</select> -->
									
								</div>
								<div class="contact-form-error-message">
									<span class="careerPageProjectPositionError"><?php echo $_SESSION['careerPageProjectPositionError']; ?></span>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-md-6 col-lg-6 col-xs-12">
					<!-- <form action=""> -->
					<div class="right_section cnt_feild gray_bg">
						<h3>Your Experience ( years )</h3>
						
						<div class="check_box_wrapper">
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<div class="input_white_bg">
										<span><img src="images/contact/relevant.png" alt="relevant"></span>
										
										<input type="text" class="form-control" name="relevant" id="careerPageRelevantExperience" placeholder="Relevant">
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<div class="input_white_bg">
										<span><img src="images/contact/relevant.png" alt="relevant"></span>
										<input type="text" class="form-control" name="executive" id="careerPageTotalExperience" placeholder="Total">
									</div>
								</div>
							</div>
							
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<div class="input_white_bg">
										<span><img src="images/contact/indian-rupee.png" alt="name"></span>
										
										<input type="text" class="form-control" name="ctc" id="careerPageCurrentCtc" placeholder="Current CTC">
									</div>
								</div>
							</div>
							
							
							<!-- Brief Project Information -->
							<div class="form-row">
								<div class="col-md-12 brief_project">
									<div class="row">										
										<!-- <div class="btn-bs-file text-center col-lg-12 col-xs-12 col-sm-12 col-md-12">
											<label class="btn">
												<span><i class="fa fa-paperclip" aria-hidden="true"></i>
												</span>
												<input type="file" name="file" id="careerPageEmployeeUploadYourCV" placeholder="Upload your CV" />
											</label>

										</div> -->
										<div class="contact-form-error-message">
											<span class="fileError"><?php echo $_SESSION['fileError']; ?></span>
										</div>

										<div class="submit_frm text-center col-12">
										<button name="submit" class="btn btn-primary blue_big_btn blue_big_btn_scrool1" type="submit" id="careerPageApplyJobSubmitBtn">Apply Now</button></div>
									</div>
								</div>
								
							</div>
							<!--- Select your requirement -->
						</div>
					</div>
					</form> 
				</div>
			</div>
			
			</form>
		</div>
	</section>	
		
		<?php require_once 'includes/footer.php';?>