<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
ini_set('default_charset', 'utf8');
$pagename = "event";
$pagename1 = " ";
$keywords = "Web Application Development Company, Mobile Application Development Company, Front End Development, Business Intelligence Services, App Developers For Hire, Hire App Developers, Hire Web Developer, Android App Development Company,Business Intelligence Solutions, Psd To Html, Psd To Wordpress, Web Design Company";//Put keywords here
$pageTitle = "Web Design & Development Company |Mobile Application Development Company |Front End Development| Business Intelligence Services"; //Put page title here
$metaDesc = "eLuminous Technologies is The Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises We Build Custom Web, Mobile & Business Intelligence Solutions For
Clients From 27+ Countries."; //Put meta description here
?>
<?php require_once 'includes/head.php';?>

<section class="event-banner" id="event-banner">
	<div class="container text-center mt-5 pt-5">
		<h2 class="mb-4 mt-4">Meet <b>eLuminous Technologies </b> At</h2>
		<img src="<?php echo SITE_URL;?>images/event/lcbarcelona.png" alt="lcbarcelona" class="mt-4 img-fluid">
		<!-- <h3 class="mt-5">Booth No. <span>CC1-3</span></h3> --><br>
		  <h5 class="mt-4">25-28 February 2019, <small>Barcelona</small></h5><br>
		<a href="#our_heroes_limelight" class="blue_big_btn blue_big_btn_scrool mt-4 mb-5">Book an Appointment</a>
	</div>
</section>
<!-- Our Expertise -->
<section id="lets-unlock-the-power" class="pb-0">
	<div class="container text-center pb-5">
		<h4 class="mb-4 mt-0"><small>Let’s unlock the Power of</small><br>Digital Transformation</h4>
		<h5 class="mb-4">Largest Event is here again!</h5>
		<p>Are you ready to explore the future-proof technology, innovation, power-packed live demos &amp; discussions? eLuminous Technologies is </p>
		<p>breager to learn &amp; explore the new strategic insights at GITEX 2018 to help develop &amp; deliver the next big projects.</p>
		<h5 class="mt-4">Experience the Innovation!</h5>
		<a href="#our_heroes_limelight" class="blue_big_btn blue_big_btn_scrool mt-5 mb-5">Book an Appointment</a>
	</div>
</section>
<?php require_once 'includes/our_expertise.php';?>
<!-- Our Expertise -->
<section class="gray_bg mb-5" id="our_heroes_limelight">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 elu_video align-self-center">
				<h2 class="text-center mb-4">Our Heroes on Limelight</h2>
				<div class="row">
					<div class="video_fream ">
						<div id="video_banner">
							<img src="images/banner.jpg" alt="elu_video" class="img-fluid " />
						</div>
						<button type="button" class="btn custom_btn" data-toggle="modal" data-target="#myModal">
							<div class="waves d-flex justify-content-center align-items-center"><img src="images/icon.png" alt="elu_video"/></div>
						</button>
					</div>
					<div class="company_info">
						<ul>
							<li>
								<img src="images/years_of_excellence.png" alt="years_of_excellence">
								<span><b>16+</b>Years of<br> Excellence</span>
							</li>
							<li>
								<img src="images/it_professionals.png" alt="years_of_excellence">
								<span><b>100+</b>IT <br> Professionals</span>
							</li>
							<li>
								<img src="images/happy_clients-home.png" alt="years_of_excellence">
								<span><b>600+</b>Happy <br>Clients</span>
							</li>
							
						</ul>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog bd-example-modal-lg modal-dialog-centered" role="document">
							<div class="modal-content">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<object data="images/close-cross-circular-button-symbol.svg" type="image/png" alt="elu_video" class="img-fluid" ></object>
								</button>
								<video id="video_close" poster="images/about_us/eluminous_infra_video_bg.jpg" height="600" controls muted autoplay="false">
									<source src="images/eLuminous_video.webm" type="video/webm">
										<source src="images/eLuminous_video.ogg" type="video/ogg">
											<source src="images/eLuminous_video.mp4" type="video/mp4">
											</video>

										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-lg-6" id="inspire_true_connection">
							<div class="row">
								<div class="col-md-12 p-0 p-lg-3 mt-4 mt-lg-0 mt-sm-3">
									<div class="left_section cnt_feild gray_bg">
										<h2 class="mb-4 text-center">Book An Appointment</h2>
										<div class="form-row">

											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/name.png" alt="name"></span>
													<input type="text" class="form-control" id="careerPageName" name="name" placeholder="Your Name *" value="<?php echo $_SESSION['name']; ?>" >
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
											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/your_email.png" alt="name"></span>
													<input type="email" pattern="[^ @]*@[^ @]*" class="form-control" id="careerPageEmail" name="email" placeholder="Your Email *" value="<?php echo $_SESSION['email']; ?>" >
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/mobile_number.png" alt="Mobile Number"></span>
													<input type="text" class="form-control" onkeydown="return checkPhoneKey(event.key)" id="careerPageMobile" placeholder="Contact Number " name="mobile" >
												</div>
											</div>
										</div>

										<div class="form-row">
											<div class="col-md-12 mb-0">
												<div class="input_white_bg">
													<span><img src="images/contact/calendar.png" alt="Mobile Number"></span>
													<div class="form-group m-0 container-fluid p-0">
														<div class="input-group">
															<input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
														</div>
													</div>										
												</div>
												<div class="form-row">
													<div class="col-md-12 mb-3 mt-3">
														<div class="textarea_wrapper">
															<textarea name="message" id="contactPageBriefProjectInformation" cols="3" rows="3" placeholder="Agenda "></textarea>
														</div>
													</div>
												</div>
	<button type="submit" class="blue_big_btn blue_big_btn_scrool mt-0 mb-0">Book an Appointment</button> 
												<button type="submit" id="bookAppointment" class="blue_big_btn mt-0 mb-0">Book an Appointment</button>
											</div>
										</div>
									</div>						
								</div>
							</div>
						</div> -->

						<div class="col-lg-6" id="inspire_true_connection">
							<div class="row">
								<div class="col-md-12 p-0 p-lg-3 mt-4 mt-lg-0 mt-sm-3">
									<div class="left_section cnt_feild gray_bg">
										<h2 class="mb-4 text-center">Book An Appointment</h2>
										<div class="form-row">

											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/name.png" alt="name"></span>
													<input type="text" class="form-control" id="appointmentName" name="name" placeholder="Your Name *" value="<?php echo $_SESSION['name']; ?>" />
												</div>
												<div class="contact-form-error-message">
													<span id="appointmentNameError" class="error"></span>
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/company_name.png" alt="name"></span>

													<input type="text" class="form-control" id="appointmentCompanyName" name="companyName" placeholder="Current Company" />
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/your_email.png" alt="name"></span>
													<input type="email" pattern="[^ @]*@[^ @]*" class="form-control" id="appointmentEmail" name="email" placeholder="Your Email *" value="<?php echo $_SESSION['email']; ?>" />
												</div>
												<div class="contact-form-error-message">
													<span id="appointmentEmailError" class="error"></span>
												</div>
											</div>
										</div>
										<div class="form-row">
											<div class="col-md-12 mb-3">
												<div class="input_white_bg">
													<span><img src="images/contact/mobile_number.png" alt="Mobile Number"></span>
													<input type="text" class="form-control" onkeydown="return checkPhoneKey(event.key)" id="appointmentMobile" placeholder="Contact Number " name="mobile" />
												</div>
											</div>
										</div>

										<div class="form-row">
											<div class="col-md-12 mb-0">
												<div class="input_white_bg">
													<span><img src="images/contact/calendar.png" alt="Mobile Number"></span>
													<div class="form-group m-0 container-fluid p-0">
														<div class="input-group">
															<input class="form-control" id="appointmentDate" name="date" placeholder="MM/DD/YYYY" type="text"/>
														</div>
													</div>

												</div>
												<div class="form-row">
													<div class="col-md-12 mb-3 mt-3">
														<div class="textarea_wrapper">
															<textarea name="message" id="appointmentInformation" cols="3" rows="3" placeholder="Agenda "></textarea>
														</div>
													</div>
												</div>
												<div class="loader">
													<button type="submit" id="bookAppointment" class="blue_big_btn mt-0 mb-0">Book an Appointment</button>
													<div id="loading"></div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php require_once 'includes/footer.php';?>

			<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>
			<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
			<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
			<!-- Include Date Range Picker -->
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
			<script>
				$(document).ready(function(){
					var date_input=$('input[name="date"]'); 
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					var onlyThisDates = ['25/02/2019', '26/02/2019', '27/02/2019', '28/02/2019'];
					var date = new Date();

					var From_date = (date.getMonth()+1)+"/"+date.getDate()+"/"+date.getFullYear();
					var start =  new Date(From_date);	
					var end = new Date('02/25/2019');
					var days = (end - start) / (1000 * 60 * 60 * 24);
					date_input.datepicker({
						format: 'mm/dd/yyyy',
						container: container,
						todayHighlight: false,
						autoclose: true,
						startDate:'+'+days+'d',
						endDate: new Date('02/28/2019')
					});
					$('#bookAppointment').click(function () {
						
						var nameResult = NameValidation();
						var EmailResult = EmailValidation();
						var image = "<?php echo SITE_URL. 'images/loader.gif'; ?>";
						if (nameResult && EmailResult)  {
							var appointmentName 		= $("#appointmentName").val();
							var appointmentCompanyName  = $("#appointmentCompanyName").val();
							var appointmentEmail 		= $("#appointmentEmail").val();
							var appointmentMobile 		= $("#appointmentMobile").val();
							var appointmentDate 		= $("#appointmentDate").val();
							var appointmentInformation  = $("#appointmentInformation").val();
							$.ajax({
								url: "gitex-2018FormResponse",
								type: "POST", 
								data: {
									appointmentName: appointmentName,
									appointmentCompanyName : appointmentCompanyName,
									appointmentEmail : appointmentEmail,
									appointmentMobile : appointmentMobile,
									appointmentDate : appointmentDate,
									appointmentInformation : appointmentInformation
								},
								beforeSend: function() {
									$("#bookAppointment").attr('disabled', 'disabled');
									$('#loading').html("<img src='"+image+"' />");
								},
								success: function(result) {

									$("#bookAppointment").removeAttr("disabled");
									$('#loading').hide();
									window.location = "/thank-you-event.php";
								}
							});
						}
					});
					function NameValidation()
					{
						var name = $('#appointmentName').val();
						if(name == "")
						{
							$("#appointmentNameError").html("Please Enter Name");
							return false;
						}
						else
						{
							$("#appointmentNameError").html("");
							return true;
						}
					}
					function EmailValidation(){
						var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
						var email = $('#appointmentEmail').val();
						if (email) {
							if (reg.test(email) == false)
							{
								$("#appointmentEmailError").html("Wrong Email");
								return false;
							}else {
								$("#appointmentEmailError").html("");
								return true;
							}
						}else {
							$("#appointmentEmailError").html("Please Enter Email");
						}
					}

				})
			</script>