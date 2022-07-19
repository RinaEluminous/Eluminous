<?php
$pageTitle = "Contact Eluminous Technoloies Pvt Ltd- Usa, Uk, South Africa, India"; //Put page title here
$metaDesc = "Contact Us- Web Application Development, Mobile Application Development, Front End Development, Business Intelligence Services"; //Put meta description here
$keywords = "Contact Us, Contact Us Email, Contact eLuminous Technologies";//Put keywords here
?>
<?php require_once 'includes/head.php';

$googlCaptchaSiteKey = "6LdpOmAUAAAAAChSg8K_wDpcKcE3ZxtbRhtnhY6n";
?>
<!-- inner_banner -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="inner_banner">
	<img src="images/contact_us_banner.png" alt="main_banner_bg" class="img-fluid">
	<div class="inner_page_title">
		<div class="container">
			<h1>Let's get the converstation started
			<small>Its time to hear your ideas &amp; business challenges</small></h1>
		</div>
	</div>
</section>
<!-- inner_banner -->
<section id="inspire_true_connection">
	<div class="container">
		<!-- <form> -->
			<h2 class="text-center">Inspire A True Connection</h2>
			<div class="row justify-content-between align-center">
				<div class="col-md-7 col-md-7 col-lg-5 col-xs-12">
					<div class="left_section cnt_feild gray_bg">
						
						<div class="form-row">
							
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/name.png" alt="name"></span>
									<input type="text" class="form-control" id="contactPageName" placeholder="Your Name *" value="" required>
								</div>
								<div class="contact-form-error-message">
									<span class="contactPageNameError "></span>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/your_email.png" alt="name"></span>
									<input type="text" class="form-control" id="contactPageEmail" placeholder="Your Email *" required>

								</div>
								<div class="contact-form-error-message">
									<span class="contactPageEmailError"></span>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/mobile_number.png" alt="name"></span>
									<input type="text" class="form-control" onkeydown="return checkPhoneKey(event.key)" id="contactPageMobile" placeholder="Mobile Number " required>
									
								</div>
								<div class="contact-form-error-message">
									<span class="contactPageMobileError"></span>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/company_name.png" alt="name"></span>
									<input type="text" class="form-control" id="contactPageCompanyName" placeholder="Company Name ">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<span><img src="images/contact/website_url.png" alt="name"></span>
									<input type="text" class="form-control" id="contactPageWebsite" placeholder="Website URL ">
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12 mb-3">
								<div class="input_white_bg">
									<select class="custom-select" id="contactPageProjectBudget">
										<option value="">Select Project Budget *</option>
										<option value="Not Sure">Not Sure</option>
										<option value="Under $1,000">Under $1,000</option>
										<option value="$1,000 - $5,000">$1,000 - $5,000</option>
										<option value="$5,000 - $10,000">$5,000 - $10,000</option>
										<option value="$10,000 - $25,000">$10,000 - $25,000</option>
										<option value="$25,000 +">$25,000 +</option>
									</select>
									
								</div>
								<div class="contact-form-error-message">
									<span class="contactPageProjectBudgetError"></span>
								</div>
							</div>
						</div>
						<div class="form-row privacy_policy">
							<div class="col-md-12">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								We respect your privacy. <a href="#">*Privacy Policy</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5 col-md-5 col-lg-7 col-xs-12">
					<!-- <form action=""> -->
						<div class="right_section cnt_feild gray_bg">
							<h3>Select your requirement *</h3>
							
							<div class="check_box_wrapper">
								<div class="check_box">
									<div class="form-row">
										<div class="col-md-12">
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="webDevelopment" value="Web Development">
												<label class="custom-control-label" for="webDevelopment">Web Development  </label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="front_end_development" value="Front End Development">
												<label class="custom-control-label" for="front_end_development">Front End Development  </label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="MobileAppsDevelopment" value="Mobile Apps Development">
												<label class="custom-control-label" for="MobileAppsDevelopment">Mobile Apps Development  </label>
											</div>
											
											
										</div>
									</div>
									
									<!--- Select your requirement -->
									<div class="form-row">
										<div class="col-md-12 ">
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="businessintelligencesolutions" value="Business Intelligence solutions">
												<label class="custom-control-label" for="businessintelligencesolutions">Business Intelligence solutions </label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="hire_DedicatedResources" value="Hire Dedicated Resources">
												<label class="custom-control-label" for="hire_DedicatedResources">Hire Dedicated Resources  </label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="Enterprise_Solution" value="Enterprise Solution"> 
												<label class="custom-control-label" for="Enterprise_Solution">Enterprise Solution  </label>
											</div>
											
										</div>
									</div>
								</div>
								<div class="check_box">
									<div class="form-row">
										<div class="col-md-12">
											<div class="custom-control custom-checkbox mr-sm-2">
												<input type="checkbox" name="requirement" class="service custom-control-input" id="Others" value="Others">
												<label class="custom-control-label" for="Others">Others  </label>
											</div>
										</div>
									</div>

								</div>
								<div class="contact-form-error-message">
									<span class="contact-form-error-message  contactPageProjectServiceError"></span>
								</div>
								
								<!-- Brief Project Information -->
								<div class="form-row">
									<div class="col-md-12 brief_project">
										<div class="textarea_wrapper">
											<textarea name="" id="contactPageBriefProjectInformation" cols="3" rows="3" placeholder="Brief Project Information "></textarea>
										</div>
										<div class="contact-form-error-message">
											<span class="contactPageBriefProject"></span>
										</div>
										<div class="btn-bs-file text-center">
											<label class="btn">
												<span><i class="fa fa-paperclip" aria-hidden="true"></i>
												</span>
												<input type="file" id="contactPageFile" placeholder="Attach file (if any)" />
											</label>
										</div>
										<div class="contact-page-captcha mt-4">
											<div class="g-recaptcha" required="required" data-callback="correctCaptchaContactPage" data-sitekey="<?php echo $googlCaptchaSiteKey;?>"></div>
											<div class="contact-form-error-message">
												<span class="contactPageCorrectCaptcha"></span>
											</div>
										</div>
										<div class="submit_frm text-center"><button class="btn btn-primary blue_big_btn blue_big_btn_scrool1" type="submit" id="contactPageSubmit">REQUEST A QUOTE</button></div>
									</div>
									
								</div>
								<!--- Select your requirement -->
							</div>
						</div>
					<!-- </form> -->
				</div>
			</div>
			
		<!-- </form> -->
	</div>
</section>
<div class="container">
	<div class="modal fade" id="myModal" role="dialog" >
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="background-color: #fff;">
				<div class="modal-header">
					<button type="button" class="close modalClose" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body"> Thanks For contacting with us
				</div>          
				<div class="modal-footer">
					<button type="button" class="btn btn-default modalClose" data-dismiss="modal" >Close</button>
				</div>
			</div>
		</div>

	</div>
</div>
<section class="gray_bg branches_all_wrapper">
	<div class="container">
		<h2 class="text-center"> Corporate Office</h2>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="branches_all_over_world">
					<span><img src="images/contact/india_flag.jpg" alt="">HQ Nashik</span>
					<address>
						IT Park-29/7, Near Power House, MIDC Ambad, Ambad Industrial Area, Nashik, Maharashtra,India - 422010
					</address>
					<div class="contact_details">
						<a href="mailto:sales@eluminoustechnologies.com">
							<img src="images/contact/country_mail.png" alt="">
						sales@eluminoustechnologies.com</a>
					</div>
					<div class="contact_details">
						<a href="tel:[912532382566]">
							<img src="images/contact/country_phone.png" alt="">
						+91 253 238 2566</a>
					</div>
				</div>
			</div>
			<div class="col-md-12 three_branhes">
				<div class="row">
					<div class="col-md-12 col-lg-4 col-sm-12">
						<div class="branches_all_over_world">
							<span><img src="images/contact/usa_flag.jpg" alt="">USA</span>
							<address>
								708, 3rd Avenue,<br>New York-10017, <br>USA
							</address>
							<div class="contact_details">
								<a href="mailto:sales@eluminoustechnologies.com">
									<img src="images/contact/country_mail.png" alt="">
								sales@eluminoustechnologies.com</a>
							</div>
							<div class="contact_details">
								<a href="tel:[912532382566]">
									<img src="images/contact/country_phone.png" alt="">
								+91 253 238 2566</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-4 col-sm-12">
						<div class="branches_all_over_world">
							<span><img src="images/contact/uk_flag.jpg" alt="">UK</span>
							<address>
								12 Hammersmith <br>Grove London W6 7AP,<br>UK
							</address>
							<div class="contact_details">
								<a href="mailto:sales@eluminoustechnologies.com">
									<img src="images/contact/country_mail.png" alt="">
								sales@eluminoustechnologies.com</a>
							</div>
							<div class="contact_details">
								<a href="tel:[912532382566]">
									<img src="images/contact/country_phone.png" alt="">
								+91 253 238 2566</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-4 col-sm-12">
						<div class="branches_all_over_world">
							<span><img src="images/contact/south_africa_flag.png" alt="">South Africa</span>
							<address>
								81 General Hertzog, Three Rivers,<br> Vereeniging, 1929 Gauteng,<br> South Africa.
							</address>
							<div class="contact_details">
								<a href="mailto:sales@eluminoustechnologies.com">
									<img src="images/contact/country_mail.png" alt="">
								sales@eluminoustechnologies.com</a>
							</div>
							<div class="contact_details">
								<a href="tel:[912532382566]">
									<img src="images/contact/country_phone.png" alt="">
								+91 253 238 2566</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<?php require_once 'includes/footer.php';?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script type="text/javascript">
var $ = jQuery;	
var validateFormRecaptcha="";
var formDataArray = [];

$( document ).ready(function() {
	
	$( "#contactPageSubmit" ).click(function() {
		var nameResult 							= 	contactPageNameValidation();
		var contactPageEmailResult  			= 	contactPageEmailValidation();
		var contactPageMobileResult  			= 	phoneLimitCheck();
		var contactPageProjectBudgetResult  	=   contactPageBudgetValidation();
		var contactPageProjectServiceResult 	=   serviceCheckBoxValidation();
		var contactPageProjectMessageResult 	=   contactPageMessageValidation();
		var contactPageCaptchaResult 			=   capthchaContactPageValidation();
		var checkedValue = [];
		$("input:checkbox[name=requirement]:checked").each(function(){
			checkedValue.push($(this).val());
		});
        formDataArray['service'] = checkedValue;

		if (nameResult && contactPageEmailResult && contactPageProjectBudgetResult && contactPageCaptchaResult)  {
			
			formDataArray['companyName'] 	= $("#contactPageCompanyName").val();
			formDataArray['website'] 		= $("#contactPageWebsite").val();
			formDataArray['file'] 		= $("#contactPageFile").val();
			formDataArray['authentication'] = "contctFormSubmissionDetails";

			$.ajax({
                url: "contactPageFormResponse.php",
                type: "post", //request type,
                dataType: "json",
       			data: {
					authentication: formDataArray['authentication'],
					service : formDataArray['service'],
					companyName : formDataArray['companyName'],
					website : formDataArray['website'],
					authentication : formDataArray['authentication'],
					name : formDataArray['name'],
					email : formDataArray['email'],
					mobile : formDataArray['mobile'],
					budget : formDataArray['budget'],
					file : formDataArray['file'],
					projectDetails : formDataArray['projectDetails']
                },
                success: function(result) {
                	        
                }

            });
            setTimeout(function() {

				jQuery("#myModal").show();
				jQuery("#myModal").addClass('show');
				jQuery('#myModal').removeAttr('aria-hidden', 'true');

            }, 1000);  
            window.location = "/thank-you";
                  
					
		}else {
			
		}
	
	});
	jQuery(".modalClose").click(function() {
		jQuery("#myModal").hide();
		jQuery("#myModal").removeClass('show');
		jQuery('#myModal').attr('aria-hidden', 'true');
		location.reload();
	});
	    
});	
function contactPageNameValidation(){

	if ($("#contactPageName").val()) {
		$('.contactPageNameError').html('');
		formDataArray['name'] = $("#contactPageName").val();
		return true;

	}else {
		$('.contactPageNameError').html('Please Fill Your Name');
		return false;
	}
}

function contactPageEmailValidation(){
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var email = $('#contactPageEmail').val();
    if (email) {
        if (reg.test(email) == false) 
        {
            $(".contactPageEmailError").html("Wrong Email");
            return false;
        }else {
            $(".contactPageEmailError").html("");
            formDataArray['email'] = $("#contactPageEmail").val();
            
            return true;            
        }
    }else {
        $(".contactPageEmailError").html("Please Fill Your Email");
    }
}
function checkPhoneKey(key) {    
    return (key >= '0' && key <= '9') || key == 'ArrowLeft' || key == 'ArrowRight' || key == 'Delete' || key == 'Backspace';
}

function phoneLimitCheck(){    
    var numberMobile = $('#contactPageMobile').val();
    length = numberMobile.length;
    if (numberMobile) {
        if (length < 10 || length > 14){
            $(".contactPageMobileError").html("Wrong Phone");
            return false;
        }else{
            $(".contactPageMobileError").html("");
            formDataArray['mobile'] = $("#contactPageMobile").val();
            return true;
        }
    }else{
        $(".contactPageMobileError").html("");
        return true;
    }
}

function contactPageBudgetValidation(){
  
    var budget = $('#contactPageProjectBudget').val();
    if (budget) {
        $(".contactPageProjectBudgetError").html('');
        formDataArray['budget'] = $("#contactPageProjectBudget").val();
        return true;
    }else {
        $(".contactPageProjectBudgetError").html('Please Select Your Budget');
        return false;
    }
}

function serviceCheckBoxValidation(){
    flag = false;
    var checkedValue;
    
    $("input:checkbox[name=requirement]:checked").each(function(){
		flag = true;
	});
    if (flag) {
        $('.contactPageProjectServiceError').html("");
        
    }else {
        $('.contactPageProjectServiceError').html("Please Select Your Requirement");
    }
}
function contactPageMessageValidation(){


	
	$('.contactPageBriefProject').html('');
	formDataArray['projectDetails'] = $("#contactPageBriefProjectInformation").val();
	return true;
}
var correctCaptcha = function(response) {
	//console.log(response)
    if (response) {
    	validateFormRecaptcha = 1;
    }    
};

function capthchaContactPageValidation(){
	if (validateFormRecaptcha) {
		jQuery('.contactPageCorrectCaptcha').hide();
		jQuery('.contactPageCorrectCaptcha').html('');
		return true;
	}else {
		jQuery('.contactPageCorrectCaptcha').show();
		jQuery('.contactPageCorrectCaptcha').html('Please verify that you are a Human');
		return false;
	}
}

var correctCaptchaContactPage = function(response) {
	//console.log(response)
    if (response) {
    	validateFormRecaptcha = 1;
    }  
};

</script>