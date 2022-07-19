<div class="bottom_footer blue_dark2_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7  footer-con">
                <p><a href="https://eluminoustechnologies.com" target="_blank">eLuminous Technologies</a> &copy;
                    <?php echo date("Y"); ?> All Rights Reserved</p>
                <ul class="footer-link">
                    <li> <a href="https://eluminoustechnologies.com/terms-and-conditions/">Terms &amp; Conditions</a>
                    </li>
                    <li><a href="https://eluminoustechnologies.com/privacy-policy/">Privacy &amp; Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-5 d-flex justify-content-center justify-content-md-end">
                <div class="social_details">
                    <ul>
                        <li><a href="https://www.facebook.com/eluminoustech" target="_blank" class="facebook"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/eluminoustech" target="_blank" class="twitter"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li><a href="http://www.linkedin.com/company/eluminous-technologies" target="_blank"
                                class="linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g" target="_blank"
                                class="youtube"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="scrollToTop" style="display: inline-block; right: -50px;">
    <img src="images/icons/white-up-arrow.png" alt="Scroll Top Icon">
</button>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script async='async' src="assets/owlcarousel/owl.carousel.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js
"></script>
<script async='async' src="assets/wow/wow.min.js"></script>
<!-- <script src="js/jquery.countup.js"></script> -->
<script async='async' src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"> </script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
    	"></script>
<script src="https://www.google.com/recaptcha/api.js">
</script>

<script type="text/javascript">
function checkPhoneKey(key) {
    return (key >= '0' && key <= '9') || key == 'ArrowLeft' || key == 'ArrowRight' || key == 'Delete' || key ==
        'Backspace' || key == 'Tab';
}

$.validator.addMethod("nameval", function(value, element) {
    return /^([a-zA-Z ]{3,30})$/.test(value);
}, "Please enter valid name.");

$.validator.addMethod("emailval", function(value, element) {
    return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
}, "Please enter a valid email address.");

$.validator.addMethod("mobileval", function(value, element) {
    return /^[0-9\()\- ]\d{9,10}$/.test(value);
}, "Please enter valid phone number!");


$(document).ready(function() {
    $('#planForm').validate({
        highlight: function(element) {
            $(element).parent().addClass("errorElement");
        },
        rules: {
            name: {
                required: true,
                nameval: true
            },
            company_name: {
                required: true,
                nameval: true
            },
            email: {
                required: true,
                emailval: true
            },
            number: {
                required: true,
                maxlength: 11,
                minlength: 10,
                mobileval: true
            }

        },
        messages: {
            full_name: {
                required: 'This is required.',
            },
            company_name: {
                required: 'This is required.',
            },
            email: {
                required: 'This is required.',
            },
            intPhone: {
                required: 'This is required.',
            }

        },
        submitHandler: function() {

            var country_code = jQuery(".iti__selected-dial-code").text();
            $input = $('<input type="hidden" name="country_code"/>').val(country_code);
            $('#planForm').append($input);

            var formData = $('#planForm').serialize();

            var currentSiteUrl = "https://eluminoustechnologies.com/";
            thank_siteUrl = currentSiteUrl + "thank-you";
            $("#make_proposal").prop('disabled', true);
            $("#make_proposal").attr('value', 'SENDING..');



            $.LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });
            $.ajax({
                method: 'POST',
                url: "../mail-web-development-services.php",
                data: formData,
                success: function(data) {
                    //window.location = "thank-you";


                    setTimeout(function() {
                        window.location = "thank-you";
                    }, 3e3)
                    // if(data.indexOf('mailsuccess') != -1){

                    //document.getElementById("planForm").reset();
                    //$('#Thank_You').modal('show');

                    // }else{
                    //  $('#capchaErr1').html("Invalid reCAPTCHA.");
                    //  $("#make_proposal").prop('disabled', false);
                    //  $("#make_proposal").attr('value', 'SEND');
                    // }
                }
            });

        }
    });

    $('#bookForm').validate({
        highlight: function(element) {
            $(element).parent().addClass("errorElement");
        },
        rules: {
            name: {
                required: true,
                nameval: true
            },
            email: {
                required: true,
                emailval: true
            }




        },
        messages: {
            name: {
                required: 'This is required.',
            },
            email: {
                required: 'This is required.',
            }

        },
        submitHandler: function() {
            var formData = $('#bookForm').serialize();
            var currentSiteUrl = "https://eluminoustechnologies.com/";
            thank_siteUrl = currentSiteUrl + "thank-you";
            $("#make_proposal").prop('disabled', true);
            $("#make_proposal").attr('value', 'SENDING..');

            $.LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });


            $.ajax({
                method: 'POST',
                url: "../book-web-development-services.php",
                data: formData,
                success: function(data) {
                    window.location = "thank-you";

                }
            });
        }
    });
});

$("#make_proposal").click(function() {
    var rcres = grecaptcha.getResponse();
    if (rcres.length) {
        // grecaptcha.reset();
        return true;
    } else {
        $(".errorCap").html("Please verify CAPTCHA");
        return false;
    }
});
</script>
<!-- <script async='async' src="js/jquery.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/bootstrap-proper.min.js"></script> -->
<!-- <script async='async' src="js/bootstrap.min.js"></script> -->
<!-- <script src="js/jquery.countup.min.js"></script> -->
<!-- <script async='async' src="js/custom.js"></script> -->
<script type="text/javascript">
setTimeout(function() {
    var mybot = document.createElement('mybot');
    mybot.id = 'webchat';
    var body = document.getElementsByTagName('body')[0];
    body.appendChild(mybot, body);
    var userId = document.createElement('input');
    userId.type = 'hidden';
    userId.id = 'userId';
    userId.name = 'userId';
    mybot.parentNode.insertBefore(userId, mybot);
    var userReq = document.createElement('input');
    userReq.type = 'hidden';
    userReq.id = 'userReq';
    userReq.name = 'userReq';
    mybot.parentNode.insertBefore(userReq, mybot);

    var origin = "https://betaeserver.com/elum-chatboat";
    var source = [
        //{"name":"bootstrap", "type":"js", "url": "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"}, 
        {
            "name": "webscript_form",
            "type": "js",
            "url": origin + "/UI/static/js/webscript_form.js"
        },
        {
            "name": "jquery",
            "type": "js",
            "url": "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        },
        // {"name":"bootstrap", "type":"css", "url": "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"},
        {
            "name": "wechatstyle",
            "type": "css",
            "url": origin + "/UI/static/css/wechatstyle.css"
        }
    ]
    source.forEach(importSrc);

    function importSrc(obj) {
        if (obj.type == 'js') {
            if (obj.name == 'jquery' && window.jQuery)
                return
            var be = document.createElement('script');
            be.type = 'text/javascript';
            be.async = true;
            be.src = obj.url;
            var j = document.getElementsByTagName('script')[0];
            j.parentNode.insertBefore(be, j);
        } else {
            var link = document.createElement("link");
            link.type = "text/css";
            link.rel = "stylesheet";
            link.href = obj.url;
            var s = document.getElementsByTagName('head')[0];
            s.appendChild(link, s);
        }
    };
}, 2000);
</script>
<!-- country code -->

<script src="<?php echo SITE_URL;?>build/js/intlTelInput.js"></script>
<script>
var input = document.querySelector("#number");
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
    hiddenInput: "full_number",
    initialCountry: "in",
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
<!--booking-slot-->
<script src="<?php echo SITE_URL;?>js/jquery-ui.js"></script>
<script>
function doSomething() {
    var date1 = jQuery('#dateday').datepicker('getDate');
    var day = date1.getDay();

    var slotDate = jQuery('#dateday').val();

    var checkSlot = "check_slot.php"
    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: checkSlot,
        data: {
            action: "check_slot",
            slotDate: slotDate
        },
        beforeSend: function() { // Before we send the request, remove the .hidden class from the spinner and default to inline-block.
            jQuery('#loader').removeClass('hidden')
        },
        success: function(response) {
            if (response.type == "success") {
                jQuery('#error_datetime').html("");


                jQuery('#datetime').html(
                    '<select name="datetime" id="datetimeSlot"> <option id="Opt09" class="Opt09" value="Opt09">9 AM</option> <option id="Opt010" class="Opt010" value="Opt010">10 AM</option> <option id="Opt011" class="Opt011" value="Opt011">11 AM</option> <option id="Opt12" class="Opt12" value="Opt12">12 PM</option> <option id="Opt1" class="Opt1" value="Opt1">1 PM</option> <option id="Opt2" class="Opt2" value="Opt2">2 PM</option> <option id="Opt3" class="Opt3" value="Opt3">3 PM</option> <option id="Opt4" class="Opt4" value="Opt4">4 PM</option> <option id="Opt5" class="Opt5" value="Opt5">5 PM</option> <option id="Opt6" class="Opt6" value="Opt6">6 PM</option> <option id="Opt7" class="Opt7" value="Opt7">7 PM</option> <option id="Opt8" class="Opt8" value="Opt8">8 PM</option> <option id="Opt9" class="Opt9" value="Opt9">9 PM</option> <option id="Opt10" class="Opt10" value="Opt10">10 PM</option> <option id="Opt11" class="Opt11" value="Opt11">11 PM</option></select>'
                );



                if (response.slot && response.slot.length > 0) {

                    jQuery.each(response.slot, function(i, val) {

                        $("#datetimeSlot option[value=" + val + "]").remove();

                    });


                }
                return true;

            } else {
                console.log(response);
                return false;

                intError = 1;
            }

        },
        complete: function() { // Set our complete callback, adding the .hidden class and hiding the spinner.
            jQuery('#loader').addClass('hidden')
        },

    });



}
jQuery("#dateday").datepicker({
    inline: true,
    minDate: 0,
    beforeShowDay: $.datepicker.noWeekends,
    onSelect: doSomething
});
</script>
</body>

</html>