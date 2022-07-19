<!-- country code -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>build/css/intlTelInput.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>build/css/demo.css">
<section class="conatact_frm_footer" id="contact">
    <h2 class="text-center">Let's talk now </h2>
    <div class="container">
        <div class="form-row_custom">
            <div class="row">
                <div class="col-md-6  col-lg-8 col-xs-8"></div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xs-12 m-auto">
                    <div class="left_section">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input_white_bg">
                                    <span><img src="<?php echo SITE_URL; ?>images/contact/name.webp" alt="name"></span>
                                    <input type="text" class="form-control" id="homePageName" placeholder="Your name *"
                                        value="" required>
                                </div>
                                <div class="contact-form-error-message">
                                    <span class="homePageNameError "></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-6 col-xs-6 col-lg-6">
                                <div class="input_white_bg">
                                    <span><img src="<?php echo SITE_URL; ?>images/contact/your_email.webp"
                                            alt="your_email"></span>
                                    <input type="text" class="form-control" id="homePageEmail"
                                        placeholder="Email Address *" required>
                                </div>
                                <div class="contact-form-error-message">
                                    <span class="homePageEmailError "></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6 col-lg-6">
                                <div class="input_white_bg justify-content-start text-left">
                                    <span><img src="<?php echo SITE_URL; ?>images/contact/mobile_number.webp"
                                            alt="mobile_number"></span>
                                    <input type="text" class="form-control"
                                        onkeydown="return checkPhoneKeyHome(event.key)" id="homePageMobile"
                                        name="homePageMobile" placeholder="Cell Number " required maxlength="15">

                                </div>
                                <div class="contact-form-error-message">
                                    <span class="homePageMobileError "></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input_white_bg textarea_box">
                                    <textarea type="text" class="form-control" id="homePageBriefProjectInformation"
                                        placeholder="Project Details" required></textarea>
                                </div>
                                <div class="contact-form-error-message">
                                    <span class="homePageBriefProject "></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xs-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-lg-12">
                                    <div class="row align-items-center">
                                        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 pl-0 mobile-space mt-sm-0">
                                            <label for="search" class="visuallyhidden">Question: </label>
                                            <input type="text" class="change-design form-control" id="cptchaQues"
                                                readonly name="cptchaQues" value="<?php echo $newCptcha; ?>">
                                        </div>

                                        <div
                                            class="input_white_bg col-xs-12 col-sm-4 col-md-6 col-lg-4 m-0 mobile-space">
                                            <label for="search" class="visuallyhidden">Answer: </label>
                                            <input type="text" class="form-control" name="captchaAnswer"
                                                id="captchaAnswer" value="">
                                        </div>
                                        <div class="contact-form-error-message new-massage col-md-12 p-0">
                                            <span class="homePageCorrectCaptcha"></span>
                                        </div>
                                    </div>
                                    <div class="form-row privacy_policy mt-3 ml-0">
                                        <div class="row align-items-center">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                            We respect your privacy. <a href="/privacy-policy/" target="_blank">*Privacy
                                                Policy</a>
                                        </div>
                                    </div>
                                    <div class="text-right align_mobile_sec">
                                        <div class="row">
                                            <button type="button" id="homePageSubmit"
                                                class="small_blue_btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END here  -->
            </div>
        </div>
        <!-- form-row -->


        <!-- </form> -->

    </div>
</section>

<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> -->
<!-- country code -->
<script src="<?php echo SITE_URL;?>build/js/intlTelInput.js"></script>
<script src="<?php echo SITE_URL;?>build/js/utils.js"></script>
<script>
var input = document.querySelector("#homePageMobile");
window.intlTelInput(input, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    // formatOnDisplay: false,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    hiddenInput: "full_homePageMobile",
    initialCountry: "us",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    // preferredCountries: ['cn', 'jp'],
    separateDialCode: true,
    utilsScript: "build/js/utils.js",
});
</script>
<!-- country code -->