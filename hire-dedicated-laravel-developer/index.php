<?php
function getVisIpAddr()
{
	$vis_ip = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$vis_ip = $_SERVER['HTTP_CLIENT_IP'];
	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$vis_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$vis_ip = $_SERVER['REMOTE_ADDR'];
	}
}

// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents(
	"http://www.geoplugin.net/json.gp?ip=" . $ipdat
));

$countryName = $ipdat->geoplugin_countryName;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Hire Dedicated Laravel Developer - eLuminous Technologies</title>
    <meta name="description"
        content="eLuminous offers expert dedicated Laravel developers develops world-class IT web solutions as per your business needs,which increases profit margin ratio">
    <meta name="keywords"
        content="hire laravel developer, hire offshore laravel developer ,laravel web application development company ,top laravel development companies,laravel development company usa">
    <meta name="author" content="eLuminous Technologies">
    <link rel="icon" href="images/favicon.ico">
    <link rel="canonical" href="" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Owlcarousel CSS -->
    <link rel="stylesheet" href="assets/owlcarousel/owl.carousel.min.css">
    <!-- Font Awesome CSS -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/wow/animate.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Mediaquery CSS -->
    <link rel="stylesheet" href="css/mediaquery.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <?php if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com' || $_SERVER['HTTP_HOST'] == 'dev.eluminousdev.com'){ ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124927455-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-124927455-1');
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-55PLZGM');
    </script>
    <!-- Hotjar Tracking Code for https://eluminoustechnologies.com/hire-dedicated-laravel-developer/ -->
    <script>
    (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
            (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = {
            hjid: 1875311,
            hjsv: 6
        };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <?php } ?>
</head>

<body class="">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55PLZGM" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Header Start -->
    <header>
        <div class="container">
            <div class="d-flex justify-content-md-between justify-content-center flex-wrap align-items-center">
                <div class="logo">
                    <img src="images/eluminous-logo.png" alt="eLuminous Logo" />
                </div>
                <ul class="contact_info">
                    <li>
                        <a href="https://api.whatsapp.com/send?phone=+918308764279" class="whatsapp-contact">
                            <span class="whatsapp_icons icons"><img src="images/icons/whatsapp-icon.png"
                                    alt="Whatsapp Icons" /></span>
                            +91 8308764279
                        </a>
                    </li>
                    <li class="red_btn call_contact">
                        <?php if ($countryName == 'India') { ?>
                        <a href="tel:+912532382566" class="call_contact btn">
                            <span class="call_icons icons"><img src="images/icons/call-white.png"
                                    alt="Call Icon" /></span>
                            +91 253 238 2566
                        </a>
                        <?php }
						if ($countryName == 'United States') { ?>
                        <a href="tel:+17188389981" class="call_contact btn">
                            <span class="call_icons icons"><img src="images/icons/call-white.png"
                                    alt="Call Icon" /></span>
                            +1 718 838 9981
                        </a>
                        <?php }
						if ($countryName == 'United Kingdom') { ?>
                        <a href="tel:+442081335090" class="call_contact btn">
                            <span class="call_icons icons"><img src="images/icons/call-white.png"
                                    alt="Call Icon" /></span>
                            +44 208 133 5090
                        </a>
                        <?php }
						if ($countryName == 'South Africa') { ?>
                        <a href="tel:+27798748495" class="call_contact btn">
                            <span class="call_icons icons"><img src="images/icons/call-white.png"
                                    alt="Call Icon" /></span>
                            +27 (79)874-8495
                        </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Home Section Start -->
    <section id="home_banner" class="home_banner banner overlay overlay_blue">
        <div class="container text-white">
            <div class="row">
                <div class="col-lg-7 col-md-6 pr-lg-0 d-flex align-items-center">
                    <div class="content">
                        <div class="top">
                            <h1 class="text-white">Hire <span class="red_03b">Laravel</span> Experts</h1>

                            <div class="why_laravel top_new_text">
                                <p>Struggling Communicating with Dev team?</p>
                                <p>Sleepless nights to manage Time zone Difference?</p>
                                <p>Worrying about a delayed delivery?</p>
                            </div>
                        </div>
                        <div class="why_laravel">
                            <h3 class="text-white">Why eLuminous?</h3>
                            <ul class="why_laravel_list">
                                <li>Quick Turnaround Time</li>
                                <li>Help to Boost ROI</li>
                                <li>Agile CI/CD Approach</li>
                                <li>Overlapping Time Zone</li>

                            </ul>
                        </div>
                        <div class="partner_img_wrap ">
                            <ul class="d-flex  justify-content-center flex-wrap align-items-center">

                                <li class="good_firms_img"><a
                                        href="https://www.goodfirms.co/company/eluminous-technologies-pvt-ltd"
                                        target="_blank"><img src="images/good-firms.png" alt="Good Firms" /></a></li>
                                <li class="google_img"><a
                                        href="https://www.google.com/search?client=firefox-b-d&q=eluminous#lrd=0x3bddeb9b18662f97:0xf01ac94e1e46503f,1,,"
                                        target="_blank"><img src="images/google.png" alt="Google" /></a></li>
                                <li class="pmi_img"><img src="images/project-management-institute.png"
                                        alt="Project Management Institute" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="contact-form-top" id="contact-form-top">
                        <h2>Let's Get Started
                            <small>Get in touch with us today for more information.</small>
                        </h2>
                        <form action="" method="post" class="form" id="planForm">
                            <input type="text" name="formType" id="formType" class="form-control "
                                value="laravelDeveloper" style="display: none;">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control "
                                    placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control "
                                    placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <input type="text" maxlength="11" onkeydown="return checkPhoneKey(event.key)"
                                    name="number" id="number" class="form-control "
                                    placeholder="Enter your mobile number">
                            </div>
                            <div class="form-group">
                                <input type="text" name="skype_id" id="skype_id" class="form-control "
                                    placeholder="Skype ID">
                            </div>
                            <!-- <div class="form-group">
                            <select class="custom-select required" name="packagePlan" id="packagePlan">
                                <option value="">Choose Package</option>
                                <option value="Free">Free</option>
                                <option value="Plus">Plus</option>
                                <option value="Pro">Pro</option>
                                <option value="Premium">Premium</option>
                            </select>
                          </div> -->
                            <div class="form-group">
                                <label for="comment">Write your message (Optional)</label>
                                <textarea class="form-control " rows="5" name="comment" id="comment"></textarea>
                            </div>
                            <div class="form-group red_btn">
                                <button class="btn" type="submit" id="make_proposal">Get A Quote Today</button>
                                <!-- <input class="btn" type="submit" id="make_proposal" value="Make My Proposal"/> -->
                            </div>
                        </form>
                        <span class="form_bottom_text">*8 Days Risk-Free Trial!</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section End -->
    <!-- Trusted Clients Section Start -->
    <section class="trusted_client">
        <div class="container text-center">
            <div class="top">
                <p class="testimonial">Your help improved our web visitors' experience on the B1G1 & made our messaging
                    much more effective, so thank you! <span class="red_03b fw_400">- Sharon</span></p>
                <div class="bottom_box_testi">
                    <ul>
                        <li>Customer Storyboards</li>
                        <li>Campaign Management, Integration with mailing</li>
                        <li>Business Listings, Widgets</li>
                    </ul>
                </div>
                <div class="star icons d-block"><img src="images/orange-star.png" alt="Star Images" /></div>
            </div>
            <h2>Trusted Clients</h2>
            <div id="trusted_partner" class="trusted_partner owl-carousel owl-theme">
                <div class="box">
                    <img src="images/client/trtcle.jpg" alt="Trtcle Image" />
                </div>
                <div class="box">
                    <img src="images/client/razer.jpg" alt="Razer Image" />
                </div>
                <div class="box">
                    <img src="images/client/business-for-good.jpg" alt="Business for Good Image" />
                </div>
                <div class="box">
                    <img src="images/client/cpenation.jpg" alt="Cpenation Image" />
                </div>
                <div class="box">
                    <img src="images/client/simply-land.jpg" alt="Simply Land Image" />
                </div>
                <div class="box">
                    <img src="images/client/auto-help.jpg" alt="Sauto-help Image" />
                </div>
            </div>
        </div>
    </section>
    <!-- Trusted Clients Section End -->
    <!-- Home Section Start -->
    <section class="assist_sec blue_977_bg map_banner banner">
        <div class="container text-white">
            <div class="row">
                <div class="col-lg-7 col-md-7 pr-lg-0">
                    <div class="content">
                        <div class="why_laravel">
                            <h2 class="text-white">How Do We Assist?</h2>
                            <ul class="why_laravel_list">
                                <li>Technical Consulting & Planning</li>
                                <li>Product Design & Development</li>
                                <li>Quality Assurance</li>
                                <li>Post Development Support & Maintenance</li>
                            </ul>
                        </div>
                        <p>We offers in-depth solutions to keep your application Secure and Optimized as per your
                            business needs.</p>
                        <p>We offer handpicked developers, who will assist you in Continuous Integration & Deployment
                            with Agile approach.</p>
                        <div class="red_btn">
                            <a href="#contact-form-top" class="btn scroll_form">
                                Talk To Developer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 d-flex justify-content-md-end justify-content-sm-center">
                    <div class="team">
                        <h4 class="text-center text-white">Hire a Professional</h4>
                        <div class="team_slider owl-carousel">
                            <div class="box">
                                <div class="image">
                                    <img src="images/ashwini.jpg" alt="Ashwini" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Ashwini</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">6+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/dk.jpg" alt="Dnyaneshwar" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Dnyaneshwar</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">6+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/akshay.jpg" alt="Akshay" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Akshay</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">5+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/nisha.jpg" alt="Nisha" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Nisha</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">5+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/gautami.jpg" alt="Gautami" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Gautami</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">4+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/amit.jpg" alt="Amit" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Amit</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">5+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/pooja.jpg" alt="Pooja" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Pooja</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">4+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/sonali.jpg" alt="Sonali" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Sonali</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">4+</span> exp</span></p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="image">
                                    <img src="images/shesh.jpg" alt="Sheshkumar" class="img-fluid">
                                </div>
                                <div class="team_info">
                                    <h4>Sheshkumar</h4>
                                    <p>Laravel Developer, <span><span class="fw_600">5+</span> exp</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section End -->
    <!-- case_studay section start -->
    <section class="case_studies">
        <div class="container">
            <h2 class="text-center">Case Studies</h2>
            <div
                class="row m-auto flex-column flex-md-row justify-content-sm-center align-content-center studies_slider owl-carousel">
                <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6 col-12 d-sm-flex w-100 mw-100 box">
                    <div class="box d-flex">
                        <a href="#" data-toggle="modal" data-target="#Trtcle">
                            <div class="outer_wrap">
                                <div class="case_study_img">
                                    <img src="images/portfolio1.jpg" alt="case_study" class="img-fluid">
                                </div>
                                <div class="project_details">
                                    <h4>trtcle</h4>
                                    <p>ELearning Management System for CLE (Continuing Legal Education)</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6 col-12 d-sm-flex w-100 mw-100 box">
                    <div class="box d-flex">
                        <a href="#" data-toggle="modal" data-target="#B1G1">
                            <div class="outer_wrap">
                                <div class="case_study_img">
                                    <img src="images/portfolio2.jpg" alt="case_study" class="img-fluid">
                                </div>
                                <div class="project_details">
                                    <h4>b1g1</h4>
                                    <p>Highly optimised website for a global NGO on a mission to create "A World Full of
                                        Giving"</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-4 col-md-4 col-sm-6 col-12 d-sm-flex w-100 mw-100 box">
                    <div class="box d-flex">
                        <a href="#" data-toggle="modal" data-target="#CPENation">
                            <div class="outer_wrap">
                                <div class="case_study_img">
                                    <img src="images/portfolio3.jpg" alt="case_study" class="img-fluid">
                                </div>
                                <div class="project_details">
                                    <h4>CPENation</h4>
                                    <p>Online Learning Management Solution To Make You Compliant</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- case_studay section end -->
    <!-- Hiring Process Start -->
    <section class="hiring_process">
        <div class="container mw-100">
            <h2 class="text-center">Hire Developer<small class="d-block">Within 2 Working Days</small></h2>
            <ul>
                <li>
                    <span class="circle_heading">1</span>
                    <span class="arrow wow fadeInLeft d-lg-flex" data-wow-duration="0.5s" data-wow-delay="0.5s"></span>
                    <p><span class="fw_700 d-block">Submit Your </span>Requirements</p>
                </li>
                <li>
                    <span class="circle_heading">2</span>
                    <span class="arrow wow fadeInLeft d-lg-flex" data-wow-duration="1s" data-wow-delay="1s"></span>
                    <!-- <p><span class="fw_700 d-block">Screen </span>Resumes</p> -->
                    <p><span class="fw_700 d-block">Matching Skill Sets </span>with Experts</p>
                </li>
                <li>
                    <span class="circle_heading">3</span>
                    <span class="arrow wow fadeInLeft d-lg-flex" data-wow-duration="1.5s" data-wow-delay="1.5s"></span>
                    <p><span class="fw_700 d-block">Interview </span>Shortlisted Candidate</p>
                </li>
                <li>
                    <span class="circle_heading">4</span>
                    <span class="arrow wow fadeInLeft d-lg-flex" data-wow-duration="2s" data-wow-delay="2s"></span>
                    <p><span class="fw_700 d-block">Final </span>Selection</p>
                </li>
                <li>
                    <span class="circle_heading">5</span>
                    <p><span class="fw_700 d-block">Terms & </span>Contract</p>
                </li>
            </ul>
            <div class="red_btn d-flex justify-content-center">
                <a href="#contact-form-top" class="btn scroll_form">
                    Hire Laravel Developer
                </a>
            </div>
        </div>
    </section>
    <!-- Hiring Process End -->
    <!-- Trusted Clients Section Start -->
    <section class="trusted_client blue_977_bg second_testi">
        <div class="container text-center text-white">
            <div class="top">
                <p class="testimonial">I have deal with eLuminous Technologies for over 5 years and I can say that their
                    professionalism and mannerism is the best I have ever worked with. They are always available and
                    have a top of the line team. <span class="red_03b fw_400">- Omar</span></p>
                <div class="bottom_box_testi">
                    <ul>
                        <li>Online Learning & Tracking</li>
                        <li>Instant Certificates</li>
                        <li>Over 2 Million courses sold</li>
                    </ul>
                </div>
                <div class="star icons d-block"><img src="images/orange-star.png" alt="Star Images" /></div>
            </div>
        </div>
    </section>
    <!-- Trusted Clients Section End -->
    <!-- Experience Section Start -->
    <section class="experience_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="box">
                        <span><span class="counter">19</span>+</span>
                        <p>Years of Excellence</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="box">
                        <span><span class="counter">10</span>0+</span>
                        <p>IT Professionals</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="box">
                        <span><span class="counter">1</span>M+</span>
                        <p>Development Hours</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="box">
                        <span><span class="counter">70</span>%</span>
                        <p>Client Retention</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experience Section Start -->
    <!-- Our Promise Section Start -->
    <!-- <section class="our_promise banner our_promise_banner">
              	<div class="container text-white">
              		<div class="row">
              			<div class="col-lg-9 col-md-8 d-flex align-items-center">
              				<div class="text_wrap">
              					<h2 class="text-white">Our Promise</h2>
              					<h6 class="red_03b fw_600">100% Satisfaction Or Moneyback</h6>
              					<p>We just don’t make applications. We build targeted solutions that actually work, creating powerful user experiences that will meet to your business goals.</p>
              				</div>
              			</div>
              			<div class="col-lg-3 col-md-4 d-flex justify-content-lg-end">
              				<div class="img_wrap">
              					<img src="images/satifaction-guaranteed.png" alt="Satifaction Guaranteed" />
              				</div>
              			</div>
              		</div>
                </div>
              	</section> -->
    <!-- Our Promise Section End -->


    <!-- Why eLuminous Section Start -->
    <section class="why_elu">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="box">
                        <h2>Why Clients Opt Us?</h2>
                        <p>We build targeted solutions that actually work, creating powerful user experiences that will
                            meet your business goals.</p>
                        <ul class="why_laravel_list">
                            <li>PMP Certified Developers</li>
                            <li>Flexi Hiring Models</li>
                            <li>19+ Years of Experience</li>
                            <li>Process Driven Approach</li>
                        </ul>

                        <div class="consulting_partners">
                            <h6>Consulting Partners</h6>
                            <ul class="consulting_partners_wrap">
                                <li><img src="images/gartner.png" alt="Gartner" /></li>
                                <li><img src="images/nasscom.png" alt="Nasscom" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-flex justify-content-lg-end align-items-center">
                    <div id="elu_slider" class="elu_slider owl-carousel">
                        <div class="img_box">
                            <img src="images/eluminous-slider-1.jpg" alt="eLuminous Slider" />
                        </div>
                        <div class="img_box">
                            <img src="images/eluminous-slider-2.jpg" alt="eLuminous Slider" />
                        </div>
                        <div class="img_box">
                            <img src="images/eluminous-slider-3.jpg" alt="eLuminous Slider" />
                        </div>
                        <div class="img_box">
                            <img src="images/eluminous-slider-4.jpg" alt="eLuminous Slider" />
                        </div>
                        <div class="img_box">
                            <img src="images/eluminous-slider-5.jpg" alt="eLuminous Slider" />
                        </div>
                    </div>
                </div>
    </section>
    <!-- Why eLuminous Section End -->

    <!-- <footer>
              		<div class="container">
              			<div class="row">
              				<div class="col-lg-12">
              					<div class="footer_logo">
              						<img src="images/eluminous-footer-logo.png" alt="eLuminouse" />
              					</div>
              				</div>
              				<div class="col-lg-7 col-md-6">
              					<div class="footer_text text-justify">
              						<p>The Leading IT Solutions provider serves App development services across the globe for the last 17 years. We provide solutions that work by accepting challenges & delivering on commitment. Our transparent working models, communication methods, on-time delivery let our clients focus on their competencies to grow their profit margins.</p>
              					</div>
              				</div>
              				<div class="col-lg-5 col-md-6 d-flex justify-content-sm-center">
              					<div class="consulting_partners">
              						<h6>Consulting Partners</h6>
              						<ul class="consulting_partners_wrap">
              							<li><img src="images/gartner.png" alt="Gartner" /></li>
              							<li><img src="images/nasscom.png" alt="Nasscom" /></li>
              						</ul>
              					</div>
              				</div>
              			</div>
              		</div>
              	</footer> -->

    <div class="bottom_footer">
        <div class="container">
            <div class="row">
                <div
                    class="col-lg-6 col-md-7 d-flex align-items-center justify-content-center justify-content-md-start">
                    <p><a href="https://eluminoustechnologies.com" target="_blank">eLuminous Technologies</a> &copy;
                        <?php echo date("Y"); ?> All Rights Reserved</p>
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

    <!-- Trtcle Modal -->
    <div class="wrapper modal fade" id="Trtcle" tabindex="-1" role="dialog" aria-labelledby="AutomobileTitle"
        aria-hidden="true">
        <div class="wrapper modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="images/icons/close.png" alt=""></span>
                </button>
                <div class="modal-body">
                    <div class="container wrapper">
                        <div class="row top_wrap">
                            <div class="col-lg-5 pr-lg-0">
                                <div class="text_wrap">
                                    <h4 class="fw_600">TRTCLE </h4>
                                    <p class="fw_400 text-justify">The Client, TRTCLE is a organization dedicated to
                                        providing high quality continuing legal education. TRTCLE has grown to be one of
                                        the leaders in online CLE.</p>
                                    <p class="fw_400 text-justify">The client wanted to build the website to gain an
                                        online presence over the web to educate legal professionals online. We have
                                        developed a robust eLearning platform for legal professionals along with PCI
                                        Compliance.</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="img_wrap">
                                    <img class="w-100" src="images/trtcle-popup.jpg" alt="Trtcle Image" />
                                </div>
                            </div>
                        </div>
                        <div class="list_wrap">
                            <h5 class="fw_600">Key Features:</h5>
                            <ul class="why_laravel_list">
                                <li>Online study material live sessions, video tutorial and etc to download</li>
                                <li>Real-time tracking system to track the student's progress</li>
                                <li>PCI compliance website</li>
                            </ul>
                        </div>
                        <div class="list_wrap gray_wrap">
                            <h5 class="fw_600">Business Impact :</h5>
                            <ul class="why_laravel_list mb-0">
                                <li>We designed a comprehensive online learning management solution, which helped the
                                    client track their student's progress in real-time based upon their local time.</li>
                                <li>We developed a robust and highly secure eLearning solution, which helped the
                                    client's website achieve PCI compliance and take online payments.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- B1G1 Modal -->
    <div class="wrapper modal fade" id="B1G1" tabindex="-1" role="dialog" aria-labelledby="AutomobileTitle"
        aria-hidden="true">
        <div class="wrapper modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="images/icons/close.png" alt=""></span>
                </button>
                <div class="modal-body">
                    <div class="container wrapper">
                        <div class="row top_wrap">
                            <div class="col-lg-5 pr-lg-0">
                                <div class="text_wrap">
                                    <h4 class="fw_600">B1G1 </h4>
                                    <p class="fw_400 text-justify">B1G1 is a social enterprise and non-profit
                                        organization with a mission to create a world full of giving. It helps small-
                                        and medium-sized businesses achieve more social impact by embedding giving
                                        activities into everyday business operations and creating unique giving stories.
                                        The Client wanted to revamp their website as it take a long time to load.</p>
                                    <p class="fw_400 text-justify">It makes the user leave the website in the middle of
                                        the process.</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="img_wrap">
                                    <img class="w-100" src="images/b1g1-popup.jpg" alt="B1G1 Image" />
                                </div>
                            </div>
                        </div>
                        <div class="list_wrap">
                            <h5 class="fw_600">Key Features:</h5>
                            <ul class="why_laravel_list">
                                <li>Inbuilt analytics to get detailed reporting facility on a regular basis</li>
                                <li>Speed optimized website</li>
                                <li>You can embed Your GIVINGS directly in business</li>
                            </ul>
                        </div>
                        <div class="list_wrap gray_wrap">
                            <h5 class="fw_600">Business Impact :</h5>
                            <ul class="why_laravel_list mb-0">
                                <!-- <li>We optimized the client's website for greater speed, which reduced its loading time as well as bounce rate.</li>
								<li>We enhanced the user navigation experience by improving technical and visual elements, which lowered the website's exit rate within a month.</li>
								<li>We made the admin section's website statistics more interactive, which helped the client measure the ratio of impact to revenue.</li> -->
                                <li>We optimized the client's website for greater speed, which reduced its loading time
                                    as well as bounce rate (upto 12%).</li>
                                <li>We enhanced the user navigation experience by improving technical and visual
                                    elements, which lowered the website's exit rate (around 21%) within a month.</li>
                                <li>Client could go live with the latest version and important functional changes needed
                                    within 6 months; while working with the previous team the client waited 12 months
                                    for these results. Hence Go Live was 200% faster and had a positive impact on the
                                    customer and business.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trtcle Modal -->
    <div class="wrapper modal fade" id="CPENation" tabindex="-1" role="dialog" aria-labelledby="AutomobileTitle"
        aria-hidden="true">
        <div class="wrapper modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="images/icons/close.png" alt=""></span>
                </button>
                <div class="modal-body">
                    <div class="container wrapper">
                        <div class="row top_wrap">
                            <div class="col-lg-5 pr-lg-0">
                                <div class="text_wrap">
                                    <h4 class="fw_600">CPENation </h4>
                                    <p class="fw_400 text-justify">The Client, CPENation is the continuing education
                                        platform that offers innovative courses for personal and professional growth.
                                    </p>
                                    <p class="fw_400 text-justify">The Client was seeking an online presence over the
                                        web. So, we have developed a secure website according to our client's
                                        requirements.</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="img_wrap">
                                    <img class="w-100" src="images/cpenation-popup.jpg" alt="Cpenation Image" />
                                </div>
                            </div>
                        </div>
                        <div class="list_wrap">
                            <h5 class="fw_600">Key Features:</h5>
                            <ul class="why_laravel_list">
                                <li>Pre-defined bundles of the courses include a complete set of courses for individual
                                </li>
                                <li>Subscription facility for individual course</li>
                                <li>Customer loyalty program(credits based) to increase an engagement</li>
                            </ul>
                        </div>
                        <div class="list_wrap gray_wrap">
                            <h5 class="fw_600">Business Impact :</h5>
                            <ul class="why_laravel_list mb-0">
                                <li>We have enhanced the learning experience of the user with seamless navigation by
                                    providing responsive and user-friendly UI.</li>
                                <li>We designed a comprehensive eLearning solution, where people of any age group can
                                    grow their personal and professional skills.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ScrollTop Button Start -->
    <!-- <div class="scrolltop">
    <div class="scroll icon">
        <i class="fa fa-4x fa-angle-up"></i>
        <img src="images/icons/white-up-arrow.png" alt="Scroll Top Icon" />
    </div>
  </div> -->
    <button class="scrollToTop" style="display: inline-block; right: -50px;">
        <img src="images/icons/white-up-arrow.png" alt="Scroll Top Icon">
    </button>
    <!-- ScrollTop Button End -->
    <div class="quote" style="">
        <a href="#contact-form-top" id="quote" class="scroll_form">Get A Quote</a>
    </div>
    <!-- <a href="#contact-form-top" class="btn scroll_form"> -->

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script async='async' src="assets/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script async='async' src="assets/wow/wow.min.js"></script>
    <script src="js/jquery.countup.js"></script>
    <script async='async' src="js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"> </script>
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
                email: {
                    required: 'This is required.',
                },
                intPhone: {
                    required: 'This is required.',
                }

            },
            submitHandler: function() {
                var formData = $('#planForm').serialize();
                var currentSiteUrl = "https://eluminoustechnologies.com/";
                thank_siteUrl = currentSiteUrl + "thank-you";
                $("#make_proposal").prop('disabled', true);
                $("#make_proposal").attr('value', 'SENDING..');
                $.ajax({
                    method: 'POST',
                    url: "../mail-laravel-dedicated-developer.php",
                    data: formData,
                    success: function(data) {
                        // setTimeout(function() {
                        window.location = thank_siteUrl
                        // }, 3e3)
                        // if(data.indexOf('mailsuccess') != -1){
                        // 	alert("success");
                        // }else{
                        // 	$('#capchaErr1').html("Invalid reCAPTCHA.");
                        // 	$("#make_proposal").prop('disabled', false);
                        // 	$("#make_proposal").attr('value', 'SEND');
                        // }
                    }
                });
            }
        });
    });
    </script>
    <!-- <script async='async' src="js/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/bootstrap-proper.min.js"></script> -->
    <!-- <script async='async' src="js/bootstrap.min.js"></script> -->
    <!-- <script src="js/jquery.countup.min.js"></script> -->
    <!-- <script async='async' src="js/custom.js"></script> -->
</body>

</html>