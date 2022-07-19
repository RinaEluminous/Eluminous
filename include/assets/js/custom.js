var currentSiteUrl = "https://eluminoustechnologies.com/",
    captchaValidationsiteUrl = "https://eluminoustechnologies.com/captchaValidation.php",
    thank_siteUrl = currentSiteUrl + "thank-you",
    homeResponcePage = currentSiteUrl + "homePageFormResponse";
function indexPageEmailValidation() {
    var e = $("#emailSubscriber").val();
    if (e)
        return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? ($(".indexPageEmailError").html("You have entered wrong email"), !1)
            : ($(".indexPageEmailError").html(""), (formDataArray.email = $("#emailSubscriber").val()), !0);
    $(".indexPageEmailError").html("Please fill your email");
}
function indexPageEmailValidationdw() {
    var e = $("#emailSubscriberdw").val();
    if (e)
        return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? ($(".indexPageEmailError").html("You have entered wrong email"), !1)
            : ($(".indexPageEmailError").html(""), (formDataArray.email = $("#emailSubscriberdw").val()), !0);
    $(".indexPageEmailError").html("Please fill your email");
}
function aboutPageNameValidation() {
    var e = $("#aboutPageName").val();
    return (e = e.trim())
        ? /^[A-Za-z\s]+$/.test(e)
            ? ($(".aboutPageNameError").html(""), !0)
            : ($(".aboutPageNameError").html("You have entered wrong name"), !1)
        : ($("#aboutPageName").val(""), $(".aboutPageNameError").html("Please fill your name"), !1);
}
function aboutPageEmailValidation() {
    var e = $("#aboutPageEmail").val();
    if (e) return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e) ? ($(".aboutPageEmailError").html("You have entered wrong email"), !1) : ($(".aboutPageEmailError").html(""), !0);
    $(".aboutPageEmailError").html("Please fill your email");
}
$(document).ready(function () {
    $(window).scroll(function () {
        $(window).scrollTop() >= 3 ? $("header").addClass("sticky") : $("header").removeClass("sticky");
    }),
    $("#nav-icon").click(function () {
        $(this).toggleClass("open");
    }),
    $("#nav-icon").click(function () {
        $("ul.menu").toggleClass("active"), $("body").toggleClass("stop");
    }),
    screen.width < 991 &&
        $(".dropdown_menu>a").click(function () {
            $(this).siblings("a + .sub_menu").stop().slideToggle().prev().toggleClass("drop"), 
            $(this).parent("li").siblings("li").find("a + .sub_menu").slideUp();
        }),
    $(".servises_box").mouseenter(function () {
        $("#f_end").removeClass("active_expertise");
    }),
    $(".servises_box").mouseleave(function () {
        $("#f_end").addClass("active_expertise");
    }),
    $("#they_believed_us").owlCarousel({
        loop: !0,
        margin: 15,
        autoplay: !0,
        nav: !1,
        autoplayTimeout: 3e3,
        responsiveClass: !0,
        responsive: { 0: { items: 1, loop: !0 }, 481: { items: 2, loop: !0 }, 600: { items: 3, loop: !0 }, 1000: { items: 3, loop: !0 }, 1200: { items: 4, loop: !0 } },
    }),
    $("#our_expert").owlCarousel({
        loop: !0,
        margin: 0,
        autoplay: !0,
        nav: !1,
        nav: !0,
        navText: ['<img src="images/home/arrow-previous.png" alt="arrow-previous">', '<img src="images/home/arrow-next.png" alt="arrow-next">'],
        autoplayTimeout: 8e3,
        responsiveClass: !0,
        responsive: { 0: { items: 1, loop: !0 }, 600: { items: 2, loop: !1, margin: 15 }, 767: { items: 2, loop: !1, margin: 15 }, 991: { items: 3, loop: !1 }, 1366: { items: 4, loop: !1 } },
    }),
        $("#our_portfolio").owlCarousel({
            loop: !0,
            margin: 20,
            autoplay: !0,
            nav: !1,
            autoplayTimeout: 3e3,
            responsiveClass: !0,
            responsive: { 0: { items: 1, loop: !0 }, 600: { items: 2, loop: !1 }, 1000: { items: 3, loop: !1 }, 1200: { items: 4, loop: !1 } },
        }),
        $("#our_insights").owlCarousel({
            loop: !0,
            margin: 20,
            autoplay: !0,
            nav: !1,
            autoplayTimeout: 3e3,
            responsiveClass: !0,
            responsive: { 0: { items: 1, loop: !0 }, 600: { items: 2, loop: !1 }, 1000: { items: 3, loop: !1 }, 1200: { items: 3, loop: !1 } },
        }),
        $("#testimonials_slider").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 3e5, responsiveClass: !0, responsive: { 0: { items: 1, loop: !0 }, 1200: { items: 1, loop: !0 } } }),
        $(".gallery_wrapper_slider").owlCarousel({
            loop: !0,
            autoplay: !0,
            nav: !0,
            autoplayTimeout: 3e3,
            responsiveClass: !0,
            navText: ['<img src="images/left_arrow.png">', '<img src="images/right_arrow.png">'],
            responsive: { 0: { items: 1, loop: !0 }, 641: { items: 2, loop: !0 }, 1200: { items: 4, loop: !0 } },
        }),
        $("#competencies_slider").owlCarousel({
            loop: !0,
            margin: 0,
            autoplay: !0,
            nav: !1,
            autoplayTimeout: 3e3,
            responsiveClass: !0,
            responsive: { 0: { items: 1, loop: !0 }, 540: { items: 1, loop: !1 }, 541: { items: 2, loop: !1 }, 860: { items: 3, loop: !1 }, 1400: { items: 4, loop: !1 }, 1600: { items: 6, loop: !1 } },
        }),
        $("#client_logo_slider").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 3e3, responsiveClass: !0, responsive: { 0: { items: 1, loop: !0 }, 767: { items: 3, loop: !0 }, 1200: { items: 5, loop: !0 } } }),
        $("#team_member_talk").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 5e3, responsiveClass: !0, responsive: { 0: { items: 1, loop: !0 }, 1024: { items: 1, loop: !0 } } }),
        $(".frameworks_slider").owlCarousel({
            loop: !0,
            autoplay: !0,
            nav: !0,
            loop: !0,
            autoplayTimeout: 3e3,
            responsiveClass: !0,
            navText: ['<img src="images/home/arrow-previous.png" alt="arrow-previous">', '<img src="images/home/arrow-next.png" alt="arrow-next">'],
            responsive: { 0: { items: 2, loop: !0 }, 480: { items: 3, loop: !0 }, 768: { items: 4, loop: !0 }, 1200: { items: 5, loop: !0 }, 1400: { items: 6, loop: !0 } },
        }),
        $(".csm_fremwork_slider").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 3e3, margin: 0, responsiveClass: !0, responsive: { 0: { items: 2, loop: !0 }, 700: { items: 4, loop: !1 }, 1100: { items: 4, loop: !1 } } }),
        $(".frameworks_three_slider").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 3e3, responsiveClass: !0, responsive: { 0: { items: 2, loop: !0 }, 700: { items: 4, loop: !1 }, 1100: { items: 3, loop: !1 } } }),
        $(".portfolio_details_slider").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 2e3, responsiveClass: !0, responsive: { 0: { items: 1, loop: !0 } } }),
        $(".goodfirm").owlCarousel({ loop: !0, autoplay: !0, nav: !1, autoplayTimeout: 5e3, responsiveClass: !0, responsive: { 0: { items: 1, loop: !0 }, 700: { items: 1, loop: !0 }, 1100: { items: 1, loop: !0 } } }),
        $(".call_us_today ").click(function () {
            $(".contacts_number").slideToggle();
        }),
        $(".blue_big_btn_scrool").on("click", function (e) {
            if ("" !== this.hash) {
                e.preventDefault();
                var a = this.hash;
                $("html, body").animate({ scrollTop: $(a).offset().top }, 800, function () {
                    window.location.hash = a;
                });
            }
        }),
        $("#pop-up-btn").click(function () {
            $("#myModal2").toggleClass("left-popup");
        }),
        $(window).scroll(function () {
            $(this).scrollTop() > 100 ? $(".scrollup").fadeIn() : $(".scrollup").fadeOut();
        }),
        $(".scrollup").click(function () {
            return $("html, body").animate({ scrollTop: 0 }, 600), !1;
        }),
        $(".blue_big_btn_scrool").on("click", function (e) {
            var a = $($(this).attr("href"));
            a.length && (e.preventDefault(), $("html, body").animate({ scrollTop: a.offset().top - 80 }, 600));
        }),
        $(window).scroll(function () {
            $(this).scrollTop() > 50 ? $(".scrolltop:hidden").stop(!0, !0).fadeIn() : $(".scrolltop").stop(!0, !0).fadeOut();
        }),
        $(function () {
            $(".scroll").click(function () {
                return $("html,body").animate({ scrollTop: $("html").offset().top }, "1000"), !1;
            });
        }),
        $(".slider-for").slick({ slidesToShow: 1, slidesToScroll: 1, arrows: !0, fade: !0, asNavFor: ".slider-nav", autoplay: !1 }),
        $(".slider-nav").slick({ slidesToShow: 4, slidesToScroll: 1, asNavFor: ".slider-for", dots: !1, centerMode: !0, arrows: !1, variableWidth: !0, focusOnSelect: !0 }),
        $(".grid-view").click(function (e) {
            e.preventDefault(), $(".grid-view a").addClass("active"), $(".slider-view a").removeClass("active"), $("#photo-grid").css("display", "block"), $("#photo-slider").css({ visibility: "hidden", height: "0", overflow: "hidden" });
        }),
        $(".slider-view").click(function (e) {
            e.preventDefault(), $(".slider-view a").addClass("active"), $(".grid-view a").removeClass("active"), $("#photo-slider").css({ visibility: "visible", height: "auto", overflow: "hidden" }), $("#photo-grid").css("display", "none");
        }),
        $(".video_fream button").click(function () {
            $(this).data("src");
        });
}),
    jQuery(document).ready(function () {
        $("#contBtn").click(function () {
            $("#cookieStrip").hide(),
                $.ajax({
                    url: "cookieAccept.php",
                    type: "post",
                    dataType: "json",
                    data: { authentication: "cookieAccept" },
                    success: function (e) {
                        $("#cookieStrip").hide();
                    },
                });
        });
    }),
    jQuery(document).ready(function () {
        $("#emailSubscriberSignUp").click(function () {
            var e = indexPageEmailValidation();
            (formDataArray.authentication = "emailSubscriber"),
                e &&
                    (jQuery("#emailSubscriberSignUp").attr("disabled", !0),
                    jQuery("#emailSubscriberSignUp").addClass("disableBtn"),
                    $.ajax({ url: "indexPageFormEmailSubscrption.php", type: "GET", dataType: "json", data: { authentication: "emailSubscriber", email: formDataArray.email }, success: function (e) {} }),
                    setTimeout(function () {
                        window.location = "thank-you-subcriber.php";
                    }, 3e3));
        });
    }),
    $(document).ready(function () {
        $("#aboutUsServicesBtn").click(function () {
            var e = aboutPageNameValidation(),
                a = aboutPageEmailValidation();
            e &&
                a &&
                (jQuery("#aboutUsServicesBtn").attr("disabled", !0),
                jQuery("#aboutUsServicesBtn").addClass("disableBtn"),
                $.ajax({ url: "aboutPageFormResponse.php", type: "GET", dataType: "json", data: { authentication: "aboutPage", name: $("#aboutPageName").val(), email: $("#aboutPageEmail").val() }, success: function (e) {} }),
                setTimeout(function () {
                    window.location = "thank-you-service.php";
                }, 3e3));
        });
    }),
    jQuery(document).ready(function () {
        $("#emailSubscriberSignUpdw").click(function () {
            var e = indexPageEmailValidationdw();
            $.LoadingOverlay("show", { background: "rgba(165, 190, 100, 0.5)" }),
                (formDataArray.authentication = "emailSubscriberdw"),
                e &&
                    (jQuery("#emailSubscriberSignUpdw").attr("disabled", !0),
                    jQuery("#emailSubscriberSignUpdw").addClass("disableBtn"),
                    $.ajax({ url: "../indexPageFormEmailDownloadBrochure.php", type: "GET", dataType: "json", data: { authentication: "emailSubscriberdw", email: formDataArray.email }, success: function (e) {} }),
                    setTimeout(function () {
                        window.location = "../thank-you-brochure-download.php";
                    }, 3e3));
        });
    });
var validateFormRecaptcha = "",
    formDataArray = [];
function careerPageNameValidation() {
    var e;
    return (e = (e = $("#careerPageName").val()).trim())
        ? /^[A-Za-z\s]+$/.test(e)
            ? ($(".careerPageNameError").html(""), (formDataArray.name = $("#careerPageName").val()), !0)
            : ($(".careerPageNameError").html("You have entered wrong name"), !1)
        : ($(".careerPageNameError").html("Please fill your name"), $("#careerPageName").val(""), !1);
}
function careerPageEmailValidation() {
    var e = $("#careerPageEmail").val();
    if (e)
        return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? ($(".careerPageEmailError").html("You have entered wrong email"), !1)
            : ($(".careerPageEmailError").html(""), (formDataArray.email = $("#careerPageEmail").val()), !0);
    $(".careerPageEmailError").html("Please fill your email");
}
function checkPhoneKey(e) {
    return (e >= "0" && e <= "9") || "ArrowLeft" == e || "ArrowRight" == e || "Delete" == e || "Backspace" == e;
}
function phoneLimitCheck() {
    return $("#careerPageMobile").val()
        ? ((length = document.getElementById("careerPageMobile").length),
          length < 10 || length > 14 ? ($(".careerPageMobileError").html("You have entered wrong phone number"), !1) : ($(".careerPageMobileError").html(""), (formDataArray.mobile = $("#careerPageMobile").val()), !0))
        : ($(".careerPageMobileError").html(""), !0);
}
function pareerPagePositionValidation() {
    return $("#careerPageProjectPosition").val()
        ? ($(".careerPageProjectPositionError").html(""), (formDataArray.position = $("#careerPageProjectPosition").val()), !0)
        : ($(".careerPageProjectPositionError").html("Please enter your existing position"), !1);
}
($ = jQuery)(document).ready(function () {
    var e;
    if (window.location.href.indexOf("job-apply") > -1) var a = new RegExp("[?&]job_title=([^&#]*)").exec(window.location.href)[1];
    "TL" == a ? (e = "Team Leader") : "SEO" == a ? (e = "Search Engine Optimization Executive") : "BDE" == a ? (e = "Business Development Executive") : "DM" == a ? (e = "Digital Marketing") : "VA" == a && (e = "Virtual Assistance"),
        $("#careerPageJobTitle").val(e),
        $("#careerPageApplyJobSubmitBtn").click(function () {
            var e = careerPageNameValidation(),
                a = careerPageEmailValidation(),
                t = (phoneLimitCheck(), pareerPagePositionValidation());
            capthchaCareerPageValidation(),
                e && a && t
                    ? ((formDataArray.jobTitle = $("#careerPageJobTitle").val()),
                      (formDataArray.companyName = $("#careerPageCompanyName").val()),
                      (formDataArray.relevantExperience = $("#careerPageRelevantExperience").val()),
                      (formDataArray.totalExperience = $("#careerPageTotalExperience").val()),
                      (formDataArray.currentCtc = $("#careerPageCurrentCtc").val()),
                      (formDataArray.authentication = "careerFormDetailsSubmittedByEmployee"))
                    : event.preventDefault();
        });
});
var correctCaptcha = function (e) {
    e && (validateFormRecaptcha = 1);
};
function capthchaCareerPageValidation() {
    return validateFormRecaptcha
        ? (jQuery(".careerPageCorrectCaptcha").hide(), jQuery(".careerPageCorrectCaptcha").html(""), !0)
        : (jQuery(".careerPageCorrectCaptcha").show(), jQuery(".careerPageCorrectCaptcha").html("Please verify that you are a Human"), !1);
}
var correctCaptchaCareerPage = function (e) {
    e && (validateFormRecaptcha = 1);
};
function contactPageNameValidation() {
    var e = $("#contactPageName").val();
    return (e = e.trim())
        ? /^[A-Za-z\s]+$/.test(e)
            ? ($(".contactPageNameError").html(""), (formDataArray.name = $("#contactPageName").val()), !0)
            : ($(".contactPageNameError").html("You have entered wrong name"), !1)
        : ($("#contactPageName").val(""), $(".contactPageNameError").html("Please fill your name"), !1);
}
function contactPageEmailValidation() {
    var e = $("#contactPageEmail").val();
    if (e)
        return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? ($(".contactPageEmailError").html("You have entered wrong email"), !1)
            : ($(".contactPageEmailError").html(""), (formDataArray.email = $("#contactPageEmail").val()), !0);
    $(".contactPageEmailError").html("Please fill your email");
}
function checkPhoneKey(e) {
    return (e >= "0" && e <= "9") || "ArrowLeft" == e || "ArrowRight" == e || "Delete" == e || "Backspace" == e;
}
function phoneLimitCheck() {
    return $("#contactPageMobile").val()
        ? ((length = document.getElementById("contactPageMobile").length),
          length < 10 || length > 14 ? ($(".contactPageMobileError").html("You have entered wrong Phone Number"), !1) : ($(".contactPageMobileError").html(""), (formDataArray.mobile = $("#contactPageMobile").val()), !0))
        : ($(".contactPageMobileError").html(""), !0);
}
function contactPageBudgetValidation() {
    return $("#contactPageProjectBudget").val()
        ? ($(".contactPageProjectBudgetError").html(""), (formDataArray.budget = $("#contactPageProjectBudget").val()), !0)
        : ($(".contactPageProjectBudgetError").html("Please Select Your Budget"), !1);
}
function serviceCheckBoxValidation() {
    var e = document.getElementById("webDevelopment").checked,
        a = document.getElementById("front_end_development").checked,
        t = document.getElementById("MobileAppsDevelopment").checked,
        o = document.getElementById("businessintelligencesolutions").checked,
        r = document.getElementById("hire_DedicatedResources").checked,
        i = document.getElementById("Enterprise_Solution").checked,
        l = document.getElementById("Others").checked;
    e || a || t || o || r || i || l ? $(".contactPageProjectServiceError").html("") : $(".contactPageProjectServiceError").html("Please Select Your Requirement");
}
function contactPageMessageValidation() {
    return $(".contactPageBriefProject").html(""), (formDataArray.projectDetails = $("#contactPageBriefProjectInformation").val()), !0;
}
(validateFormRecaptcha = ""),
    (formDataArray = []),
    ($ = jQuery)(document).ready(function () {
        $("#contactPageSubmit").click(function () {
            var e = contactPageNameValidation(),
                a = contactPageEmailValidation(),
                t = (phoneLimitCheck(), contactPageBudgetValidation()),
                o = (serviceCheckBoxValidation(), contactPageMessageValidation(), capthchaContactPageValidation());
            (e && a && t && o) || event.preventDefault();
        });
    }),
    (correctCaptcha = function (e) {
        e && (validateFormRecaptcha = 1);
    });
var resultCont = "false";
function capthchaContactPageValidation() {
    var e = $("#cptchaQues").val().split("+"),
        a = parseInt(e[0]) + parseInt(e[1]),
        t = parseInt($("#captchaAnswer").val());
    return $("#captchaAnswer").val()
        ? a == t
            ? (jQuery(".contactPageCorrectCaptcha").html(""), !0)
            : ($.ajax({
                  url: captchaValidationsiteUrl,
                  type: "post",
                  dataType: "json",
                  data: { authentication: "HomePageCaptchaValidation", answer: $("#captchaAnswer").val(), question: $("#cptchaQues").val() },
                  success: function (e) {
                      "true" == e ? jQuery(".contactPageCorrectCaptcha").html("") : (jQuery(".contactPageCorrectCaptcha").html("Please fill correct captcha"), jQuery("#cptchaQues").val(e));
                  },
              }),
              !1)
        : (jQuery(".contactPageCorrectCaptcha").html("Please enter captcha value"), !1);
}
var correctCaptchaContactPage = function (e) {
    e && (validateFormRecaptcha = 1);
};
function homePageNameValidation() {
    var e = $("#homePageName").val();
    return (e = e.trim())
        ? /^[A-Za-z\s]+$/.test(e)
            ? ($(".homePageNameError").html(""), (formDataArray.name = $("#homePageName").val()), !0)
            : ($(".homePageNameError").html("You have entered wrong name"), !1)
        : ($("#homePageName").val(""), $(".homePageNameError").html("Please fill your name"), !1);
}
function homePageEmailValidation() {
    var e = $("#homePageEmail").val();
    return e
        ? 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? (jQuery(".homePageEmailError").show(), jQuery(".homePageEmailError").html("You have entered wrong email"), !1)
            : (jQuery(".homePageEmailError").html(""), jQuery(".homePageEmailError").hide(), (formDataArray.email = jQuery("#homePageEmail").val()), !0)
        : (jQuery(".homePageEmailError").show(), jQuery(".homePageEmailError").html("Please fill your email"), !1);
}
function checkPhoneKeyHome(e) {
    return (e >= "0" && e <= "9") || "ArrowLeft" == e || "ArrowRight" == e || "Delete" == e || "Backspace" == e;
}
function hearAboutUs() {
    return jQuery("#inputState").val()
        ? ((formDataArray.HearAboutUs = jQuery("#inputState").val()), jQuery(".homeHearAboutUsError").hide(), jQuery(".homeHearAboutUsError").html(""), !0)
        : (jQuery(".homeHearAboutUsError").show(), jQuery(".homeHearAboutUsError").html("Please, Did You Hear About Us? Select"), !1);
}
function phoneLimitCheckHome() {
    return jQuery("#homePageMobile").val()
        ? ((length = document.getElementById("homePageMobile").length),
          length < 10 || length > 14
              ? (jQuery(".homePageMobileError").show(), $(".homePageMobileError").html("You have entered wrong Phone Number"), !1)
              : (jQuery(".homePageMobileError").hide(), jQuery(".homePageMobileError").html(""), (formDataArray.mobile = jQuery("#homePageMobile").val()), !0))
        : (jQuery(".homePageMobileError").html(""), (formDataArray.mobile = jQuery("#homePageMobile").val()), !0);
}
function homePageMessageValidation() {
    return jQuery(".homePageBriefProject").hide(), jQuery(".homePageBriefProject").html(""), (formDataArray.projectDetails = jQuery("#homePageBriefProjectInformation").val()), !0;
}
(formDataArray = []),
    (validateFormRecaptcha = ""),
    jQuery(document).ready(function () {
        jQuery("#homePageSubmit").on("click", function () {
            var e = jQuery(".iti__selected-dial-code").text();
            console.log(e), console.log(thank_siteUrl);
            var a = capthchaHomePageValidation(),
                t = homePageNameValidation(),
                o = homePageEmailValidation();
            phoneLimitCheckHome(),
                homePageMessageValidation(),
                hearAboutUs(),
                t &&
                    o &&
                    a &&
                    (jQuery(".homePageCorrectCaptcha").html(""),
                    jQuery("#homePageSubmit").attr("disabled", !0),
                    jQuery("#homePageSubmit").addClass("disableBtn"),
                    (formDataArray.companyName = jQuery("#homePageCompanyName").val()),
                    (formDataArray.projectType = jQuery("input:radio[name=size]:checked").val()),
                    (formDataArray.ReasonContact = jQuery("input:radio[name=ReasonContact]:checked").val()),
                    window.location.href.indexOf("business-intelligence-services") > -1 && (formDataArray.businessintelligencesolutions = "sachine"),
                    $.ajax({
                        url: homeResponcePage,
                        type: "post",
                        dataType: "json",
                        data: {
                            authentication: "homeFormSubmissionDetails",
                            name: formDataArray.name,
                            email: formDataArray.email,
                            mobile: formDataArray.mobile,
                            country_code: e,
                            projectDetails: formDataArray.projectDetails,
                            businessintelligencesolutions: formDataArray.businessintelligencesolutions,
                        },
                        success: function (e) {
                            return !1;
                        },
                    }),
                    setTimeout(function () {
                        window.location = thank_siteUrl;
                    }, 3e3));
        });
    });
var resultVar = "false";
function capthchaHomePageValidation() {
    var e = $("#cptchaQues").val().split("+"),
        a = parseInt(e[0]) + parseInt(e[1]),
        t = parseInt($("#captchaAnswer").val());
    return $("#captchaAnswer").val()
        ? a == t
            ? (jQuery(".homePageCorrectCaptcha").html(""), !0)
            : ($.ajax({
                  url: captchaValidationsiteUrl,
                  type: "post",
                  dataType: "json",
                  data: { authentication: "HomePageCaptchaValidation", answer: $("#captchaAnswer").val(), question: $("#cptchaQues").val() },
                  success: function (e) {
                      "true" == e ? jQuery(".homePageCorrectCaptcha").html("") : (jQuery(".homePageCorrectCaptcha").html("Please fill correct captcha"), jQuery("#cptchaQues").val(e));
                  },
              }),
              !1)
        : (jQuery(".homePageCorrectCaptcha").html("Please enter captcha value"), !1);
}
var dynamicCountryName,
    randNum,
    correctCaptchaHomePage = function (e) {
        e && (validateFormRecaptcha = 1);
    };
/*jQuery(document).ready(function () {
    jQuery.get(
        "https://ipinfo.io",
        function (e) {
            (randNum = Math.floor(100 * Math.random() + 400)),
                (randNum += "+"),
                (dynamicCountryName = " Happy Clients From " + e.country),
                "IN" == e.country
                    ? $("#inCode").show()
                    : "US" == e.country
                    ? ($("#usCode").show(), $("#inCode").hide())
                    : "ZA" == e.country
                    ? ($("#zaCode").show(), $("#inCode").hide())
                    : "UK" == e.country || "GB" == e.country
                    ? ($("#ukCode").show(), $("#inCode").hide())
                    : $("#inCode").show();
        },
        "jsonp"
    ),
        setTimeout(function () {
            jQuery("#randNumber").text(randNum), jQuery("#randvalue").text(dynamicCountryName);
        }, 1e3);
});*/

jQuery(document).ready(function () {
    jQuery.get(
        "https://ipinfo.io",
        function (e) {
            (randNum = Math.floor(100 * Math.random() + 400)),
                (randNum += "+"),
                (dynamicCountryName = " Happy Clients From " + e.country),
                "US" == e.country
                    ? $("#usCode").show()
                    : "IN" == e.country
                    ? ($("#inCode").show(), $("#usCode").hide())
                    : "ZA" == e.country
                    ? ($("#zaCode").show(), $("#usCode").hide())
                    : "UK" == e.country || "GB" == e.country
                    ? ($("#ukCode").show(), $("#usCode").hide())
                    : $("#usCode").show();
        },
        "jsonp"
    ),
        setTimeout(function () {
            jQuery("#randNumber").text(randNum), jQuery("#randvalue").text(dynamicCountryName);
        }, 1e3);
});

var $,
    formDedidatedDataArray = [];
function dedicatedPageNameValidation() {
    var e = $("#dedicatedPageName").val();
    return (e = e.trim())
        ? /^[A-Za-z\s]+$/.test(e)
            ? ($(".dedicatedPageNameError").html(""), (formDedidatedDataArray.name = $("#dedicatedPageName").val()), !0)
            : ($(".dedicatedPageNameError").html("You have entered wrong name"), !1)
        : ($("#dedicatedPageName").val(""), $(".dedicatedPageNameError").html("Please fill your name"), !1);
}
function dedicatedPageEmailValidation() {
    var e = $("#dedicatedPageEmail").val();
    if (e)
        return 0 == /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(e)
            ? ($(".dedicatedPageEmailError").html("You have entered wrong email"), !1)
            : ($(".dedicatedPageEmailError").html(""), (formDedidatedDataArray.email = $("#dedicatedPageEmail").val()), !0);
    $(".dedicatedPageEmailError").html("Please fill your email");
}
function checkPhoneKey(e) {
    return (e >= "0" && e <= "9") || "ArrowLeft" == e || "ArrowRight" == e || "Delete" == e || "Backspace" == e;
}
function dedicatedPagephoneLimitCheck() {
    return $("#dedicatedPageMobile").val()
        ? ((length = document.getElementById("dedicatedPageMobile").length),
          length < 10 || length > 14 ? ($(".dedicatedPageMobileError").html("You have entered wrong Phone Number"), !1) : ($(".dedicatedPageMobileError").html(""), (formDedidatedDataArray.mobile = $("#dedicatedPageMobile").val()), !0))
        : ($(".dedicatedPageMobileError").html(""), !0);
}
function scrollNav() {
    $(".scroll-down").click(function () {
        return (
            $("html, body")
                .stop()
                .animate({ scrollTop: $($(this).attr("href")).offset().top - 90 }, 400),
            !1
        );
    }),
        $(".scrollTop a").scrollTop();
}
($ = jQuery)(document).ready(function () {
    $("#dedicatedDeveloperSubmit").click(function () {
        var e = dedicatedPageNameValidation(),
            a = dedicatedPageEmailValidation();
        dedicatedPagephoneLimitCheck(),
            e &&
                a &&
                (jQuery("#dedicatedDeveloperSubmit").attr("disabled", !0),
                jQuery("#dedicatedDeveloperSubmit").addClass("disableBtn"),
                (formDedidatedDataArray.skypeId = $("#dedicatedPageSkypeId").val()),
                (formDedidatedDataArray.message = $("#dedicatedPageName").val()),
                (formDedidatedDataArray.authentication = "dedicatedFormSubmissionDetails"),
                $.ajax({
                    url: currentSiteUrl + "dedicatedPageFormResponse",
                    type: "post",
                    dataType: "json",
                    data: {
                        authentication: "dedicatedFormSubmissionDetails",
                        name: formDedidatedDataArray.name,
                        email: formDedidatedDataArray.email,
                        mobile: formDedidatedDataArray.mobile,
                        skypeId: formDedidatedDataArray.skypeId,
                        message: formDedidatedDataArray.message,
                    },
                    success: function (e) {},
                }),
                setTimeout(function () {
                    window.location = thank_siteUrl;
                }, 3e3));
    });
}),
    scrollNav();
