<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script async='async' src="js/custom.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
        "></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"> </script>

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
            name: {
                required: 'This is required.',
            },
            company_name: {
                required: 'This is required.',
            },
            email: {
                required: 'This is required.',
            },
            number: {
                required: 'This is required.',
            }

        },
        submitHandler: function() {

            var country_code = jQuery(".iti__selected-dial-code").text();
            $input = $('<input type="hidden" name="country_code"/>').val(country_code);
            $('#planForm').append($input);

            var formData = $('#planForm').serialize();

            var currentSiteUrl = "https://eluminoustechnologies.com/";
            //var currentSiteUrl = "http://dev.eluminousdev.com/elumindev/2022/";
            thank_siteUrl = currentSiteUrl + "thank-you";

            var valid = capthchaReactPageValidation();
            if (valid == true) {
                $.LoadingOverlay("show", {
                    background: "rgba(165, 190, 100, 0.5)"
                });
                $.ajax({
                    method: 'POST',
                    url: "<?php echo SITE_URL; ?>/mail-hire-developers.php",
                    data: formData,
                    success: function(data) {

                        setTimeout(function() {
                            window.location = "thank-you/";
                        }, 3e3)

                    }
                });
            }


        }
    });

});

/*$('#make_proposal').on("click", function () {
    var a = capthchaReactPageValidation();
    if(a == true){
        $('#planForm').submit();
    }
});*/

function capthchaReactPageValidation() {
    var captchaValidationsiteUrl = '<?php echo SITE_URL."captchaValidation.php";?>';
    var e = $("#cptchaQues").val().split("+"),
        a = parseInt(e[0]) + parseInt(e[1]),
        t = parseInt($("#captchaAnswer").val());
    return $("#captchaAnswer").val() ?
        a == t ?
        (jQuery(".reactPageCorrectCaptcha").html(""), !0) :
        ($.ajax({
                url: captchaValidationsiteUrl,
                type: "post",
                dataType: "json",
                data: {
                    authentication: "HomePageCaptchaValidation",
                    answer: $("#captchaAnswer").val(),
                    question: $("#cptchaQues").val()
                },
                success: function(e) {
                    "true" == e ? jQuery(".reactPageCorrectCaptcha").html("") : (jQuery(
                        ".reactPageCorrectCaptcha").html("Please fill correct captcha"), jQuery(
                        "#cptchaQues").val(e));
                },
            }),
            !1) :
        (jQuery(".reactPageCorrectCaptcha").html("Please enter captcha value"), !1);
}
</script>
<!-- country code -->
<script src="<?php echo SITE_URL;?>build/js/intlTelInput.js"></script>
<script>
var input = document.querySelector("#number");
window.intlTelInput(input, {
    hiddenInput: "full_number",
    initialCountry: "us",
    separateDialCode: true,
    utilsScript: "build/js/utils.js",
});
</script>
<!-- country code -->
<script src="<?php echo SITE_URL;?>hire-dedicated-developer/hire-ios-developers/js/jquery-ui.js"></script>