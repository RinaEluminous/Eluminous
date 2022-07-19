<?php
//include ('../includes/constant.php');
date_default_timezone_set("Asia/Calcutta");
ini_set('default_charset', 'utf8');
include_once("../connection.php");

$valOne = rand(1, 20);
$valTwo = rand(1, 10);
$newCptcha = $valOne . "+" . $valTwo;

$pagename = "dedicated-developer";
$pagename1 = "hire-dedicated-developers";

$pageTitle = "Hire Dedicated Developers & Programmers in India"; //Put page title here
$metaDesc = "Hire Dedicated Developers from the pool of expert 100+ programmers with Flexi-Hiring Models For Web Development, Mobile App Development & Business Intelligence"; //Put meta description here
$keywords = "hire dedicated developer, hire php developer, hire android developer, hire laravel developer, hire magento developer, hire flutter developer, hire mean stack developer";//Put keywords here

include ('../include/header-docs.php');
include ('../include/header-links.php');
include ('includes/header.php');

include ('../include/header-menu.php');

include_once ("../connection.php");
require_once('includes/header.php');
$ip_address = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$sql_statement = "INSERT INTO `tbl_landing_url`( `country_name`, `page_url`, `ip_address`, `date`) VALUES ('" . $countryName . "','" . $_SESSION['REQUEST_URI'] . "','" . $ip_address . "','" . $date . "')";
$result = mysqli_query($conn, $sql_statement);
function reCaptcha($recaptcha) {
    //$secret = "6Lcwm3UdAAAAANcRFsRhbwnebO2SwnJiZ-UAB_YW";//dev
    //$secret = "6LfDP-EeAAAAAAsZHVgerQ8ot4p5qdUn0WcfoTPv";//dev15march2022
    //$secret = "6LcDm38dAAAAADbJ8jcBi_T0iMNq-Yzn-QMRhzyf"; //local
    $secret = "6LfDwH8dAAAAADQW0nP2iRjCDOz_VhVsUjHADr9U"; //live
    $ip = $_SERVER['REMOTE_ADDR'];
    $postvars = array("secret" => $secret, "response" => $recaptcha, "remoteip" => $ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data, true);
}
$postData = $statusMsg = $valErr = '';
$status = 'error'; ?>
<!-- Home Banner Start -->
<section class="homeBanner">
    <div class="container">
        <div class="row flex-md-row-reverse">
            <div class="col-lg-6">
                <div class="img">
                    <img src="images/hire-dedicated-developers.webp" alt="Hire Dedicated Developers"
                        class="img-fluid" />
                    <div class="imgText">
                        <div class="imgBox">
                            <img src="images/clutch.webp" alt="Clutch" />

                            <div class="star_wrap">
                                <span>5.0</span>
                                <ul>
                                    <li><img src="images/icons/star.webp" alt="Star" /></li>
                                    <li><img src="images/icons/star.webp" alt="Star" /></li>
                                    <li><img src="images/icons/star.webp" alt="Star" /></li>
                                    <li><img src="images/icons/star.webp" alt="Star" /></li>
                                    <li><img src="images/icons/star.webp" alt="Star" /></li>
                                </ul>
                            </div>
                        </div>
                        <p>
                            "I was really grateful that they stuck with me and ensured that it was delivered on time."
                        </p>
                    </div>
                    <ul class="list">
                        <li>
                            <span>
                                <div class="icon">
                                    <img src="images/clutch.webp" alt="Clutch" />
                                </div>
                                <div class="text">
                                    Clutch Rated Top <br /> 100 IT Company
                                </div>
                            </span>
                        </li>
                        <li>
                            <span>
                                <div class="icon speedometer">
                                    <img src="images/icons/dedicated-developers.webp" alt="Dedicated Developers" />
                                </div>
                                <div class="text">
                                    130+ Dedicated Developers
                                </div>
                            </span>
                        </li>
                        <li>
                            <span>
                                <div class="icon group">
                                    <object data="images/icons/happy-clients.svg" type="image/svg+xml"
                                        class="icon"></object>
                                </div>
                                <div class="text">
                                    900+ Happy <br /> Clients
                                </div>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text">
                    <h1 class="title blue fw900 text-capitalize">
                        Hire Dedicated
                        <span class="blackTurmeric fw400 d-block text-uppercase">Developers</span>
                    </h1>
                    <h2 class="subTitle">Agile, PMP Certified Dedicated Developers<br />are here to help You!</h2>
                    <h3 class="subSubTitle">
                        Get access to the <b>Top 1% of the talented development team</b> elected to meet your project
                        needs.
                        Hire
                        dedicated developers who are sourced and screened from extensive vetting process and ready to
                        work for
                        you from Today iteslf!</h3>
                    <a href="#contact-form-top" class="btn borderBtn scroll_form">
                        Get Rate Card in My Inbox
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Banner End -->

<section class="whyTech who__we__are my-0">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-5">
                <img src="images/hire-dedicated-developers-who-are.webp" alt="Hire Dedicated Developers Who Are"
                    class="img-fluid w-100" />
            </div>
            <div class="col-md-12 col-lg-8 col-xl-7 d-flex justify-content-end align-items-center">
                <div class="bottomWrapper">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="title">Hire Dedicated Developers Who Are</h2>
                        </div>
                        <div class="col-sm-6 col-lg-6 d-flex">
                            <div class="box text-center">
                                <span><object data="images/icons/certified-development.svg"
                                        type="image/svg+xml"></object></span>
                                <p><b>Certified Developers</b> - PMP, Agile, Laravel, Android</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 d-flex">
                            <div class="box text-center">
                                <span><object data="images/icons/fast-quick-onboarding.svg"
                                        type="image/svg+xml"></object></span>
                                <p>Fast/Quick <br />Onboarding</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 d-flex">
                            <div class="box text-center">
                                <span><object data="images/icons/full-control-over-developers.svg"
                                        type="image/svg+xml"></object></span>
                                <p>Full Control Over <br /> Development</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 d-flex">
                            <div class="box text-center">
                                <span><object data="images/icons/daily-weekly-monthly-code-delivery.svg"
                                        type="image/svg+xml"></object></span>
                                <p>Daily/Weekly/Monthly Code Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>

<!-- Exprtise Start -->
<section class="expertise">
    <div class="container text-center">
        <h2 class="title">Scale Up Your Team with as You Need</h2>
        <h3 class="subTitle ml-auto mr-auto">
            We offer a highly flexible and customized team augmentation services as per your business requirements.
        </h3>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="box">
                    <span><object data="images/icons/build-team-from-scratch.svg" type="image/svg+xml"></object></span>
                    <h3 class="title">
                        Build Team<br />
                        from Scratch
                    </h3>
                    <p>
                        Build your own team with distinct skillsets to transform your business idea into product from
                        scratch.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="box">
                    <span><object data="images/icons/easy-ramp-up-and-ramp-down-of-your-team.svg"
                            type="image/svg+xml"></object></span>
                    <h3 class="title">Easy Ramp Up and<br />Ramp Down of Your Team</h3>
                    <p>
                        Hire dedicated developers to quickly scale up the team and easily ramp down once your work gets
                        done.
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="box">
                    <span><object data="images/icons/vendor-transition.svg" type="image/svg+xml"></object></span>
                    <h3 class="title">Vendor <br /> Transition</h3>
                    <p>
                        Having some issues with your current vendor? We are here to help your sinking midway project
                        transition with Agile Transfomation.
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <a href="#contact-form-top" class="btn borderBtn scroll_form">
                Hire Dedicated Developer
            </a>
        </div>
    </div>
</section>
<!-- Exprtise End -->


<section class="technologySection comparitive_table">
    <div class="container text-center">
        <h2 class="title">Comparitive Analysis</h2>
        <div class="table-responsive">
            <table class="table table-bordered custom_table">
                <thead>
                    <tr>
                        <th scope="col">
                            Parameter
                        </th>
                        <th scope="col">
                            eLuminous
                        </th>
                        <th scope="col" style=" border-right: 1px solid rgba(255,255,255,0.15);">
                            Freelance Developers
                        </th>
                        <th scope="col">
                            In-house Developers
                        </th>
                    </tr>
                </thead>
                <tbody style="border: 0;">
                    <tr>
                        <th scope="row">Time to get right developers</th>
                        <td>1 day - 2 weeks</td>
                        <td>4 - 12 weeks</td>
                        <td>1 - 12 weeks</td>
                    </tr>
                    <tr>
                        <th>Time to start a project</th>
                        <td>1 day - 2 weeks</td>
                        <td>1 - 12 weeks</td>
                        <td>2 - 10 weeks</td>
                    </tr>
                    <tr>
                        <th scope="row">Acquisition cost</th>
                        <td>0</td>
                        <td>0</td>
                        <td>$9,000 - $25,000</td>
                    </tr>
                    <tr>
                        <th>Recurring cost of training &amp; benefits</th>
                        <td>0</td>
                        <td>0</td>
                        <td>$5,000 - $10,000</td>
                    </tr>
                    <th>Pricing (weekly Average)</th>
                    <td>1.5x</td>
                    <td>1x</td>
                    <td>4x</td>
                    </tr>
                    <tr>
                        <th>Time to scale size of team</th>
                        <td>1 day - 2 weeks</td>
                        <td>1 - 12 weeks</td>
                        <td>4 - 16 weeks</td>
                    </tr>
                    <tr>
                    <tr>
                        <th>Project failure risk</th>
                        <td>Extremely Low <br><span style="color: #2d3e62;">We have <b>97% </b>Success Ratio</span></td>
                        <td>Very High</td>
                        <td>Low</td>
                    </tr>
                    <tr>
                        <th>Termination costs</th>
                        <td>NONE</td>
                        <td>None</td>
                        <td>High</td>
                    </tr>
                    <tr>
                        <th>Developers backed by a delivery team</th>
                        <td>YES</td>
                        <td>No</td>
                        <td>Some</td>
                    </tr>
                    <tr>
                        <th>Dedicated resources</th>
                        <td>YES</td>
                        <td>No</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <th>Agile Development methodology</th>
                        <td>YES</td>
                        <td>No</td>
                        <td>Some</td>
                    </tr>
                    <tr>
                        <th>Quality assuarance</th>
                        <td>YES</td>
                        <td>Some</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <th>Impact due to turnover</th>
                        <td>NONE</td>
                        <td>High</td>
                        <td>High</td>
                    </tr>
                    <tr>
                        <th>Structured training programs</th>
                        <td>YES</td>
                        <td>No</td>
                        <td>Some</td>
                    </tr>
                    <tr>
                        <th>Communications</th>
                        <td>Seamless</td>
                        <td>Uncertain</td>
                        <td>Seamless</td>
                    </tr>
                    <tr>
                        <th>Assured work rigor</th>
                        <td>40 hrs/week</td>
                        <td>Uncertain</td>
                        <td>40 hrs/week</td>
                    </tr>
                    <tr>
                        <th>Tools and professional environment</th>
                        <td>Best-in-Class</td>
                        <td>No</td>
                        <td>Varies</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="#contact-form-top" class="scroll_form btn">Get Started Today</a>
    </div>
</section>

<section class="technologySection">
    <div class="container text-center">
        <h2 class="title">Hire Dedicated Developers with <br /> Technology Stack</h2>
        <div class="technologiesList__wrapper">
            <div id="technologiesSlider" class="row justify-content-center owl-carousel">
                <div class="col-xl-5 col-lg-7 col-md-9 one">
                    <h4 class="m-0 p-0"><b>Front-End</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-angular-developers/"
                                target=”_blank”>
                                <span class="img"><img src="images/icons/AngularJS.webp" alt="AngularJS" /></span>
                                Angular
                            </a>
                        </li>
                        <li> <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-vuejs-developers/"
                                target=”_blank”>
                                <span class="img"><img src="images/icons/VueJS.webp" alt="Vue JS" /></span>
                                Vue JS
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-reactjs-developers/"
                                target=”_blank”>
                                <span class="img"><img src="images/icons/ReactJS.webp" alt="ReactJS" /></span>
                                React JS
                            </a>
                        </li>
                        <li>

                            <span class="img"><img src="images/icons/nuxt.webp" alt="Nuxt.js" /></span>
                            Nuxt.js

                        </li>
                    </ul>
                </div>
                <div class="col-xl-7 col-lg-8 col-md-11 two">
                    <h4 class="m-0 p-0"><b>Mobile</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-flutter-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Flutter.webp" alt="Flutter" />
                                </span>
                                Flutter
                            </a>
                        </li>
                        <li>

                            <span class="img">
                                <img src="images/icons/ReactNative.webp" alt="React Native" />
                            </span>
                            React Native
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-ios-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/iOS.webp" alt="iOS" />
                                </span>
                                iOS
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-android-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Android.webp" alt="Android" />
                                </span>
                                Android
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-ionic-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Ionic.webp" alt="Ionic" />
                                </span>
                                Ionic
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12 three">
                    <h4 class="m-0 p-0"><b>Back-End</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-laravel-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Laravel.webp" alt="Laravel" />
                                </span>
                                Laravel
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-nodejs-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Node.webp" alt="Node" />
                                </span>
                                Node
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-php-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/PHP.webp" alt="PHP.js" />
                                </span>
                                PHP
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-dotnet-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/net.webp" alt=".net" />
                                </span>
                                .net
                            </a>
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/netCore.webp" alt=".net Core" />
                            </span>
                            .net Core
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/Python.webp" alt="Python" />
                            </span>
                            Python
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/Django.webp" alt="Django" />
                            </span>
                            Django
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-10 four">
                    <h4 class="m-0 p-0"><b>Server</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <span class="img">
                                <img src="images/icons/AWS.webp" alt="AWS" />
                            </span>
                            AWS
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/DigitalOcean.webp" alt="Digital Ocean" />
                            </span>
                            Digital Ocean
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/azure.webp" alt="Azure" />
                            </span>
                            Azure
                        </li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 five">
                    <h4 class="m-0 p-0"><b>Database</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <span class="img">
                                <img src="images/icons/MongoDB.webp" alt="MongoDB" />
                            </span>
                            MongoDB
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/PostgreSQL.webp" alt="PostgreSQL" />
                            </span>
                            PostgreSQL
                        </li>
                        <li>
                            <span class="img">
                                <img src="images/icons/MySQL.webp" alt="MySQL" />
                            </span>
                            MySQL
                        </li>
                    </ul>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 six">
                    <h4 class="m-0 p-0"><b>CMS</b></h4>
                    <ul class="technologiesSliderInner technologiesList owl-carousel">
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-wordpress-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Wordpress.webp" alt="Wordpress" />
                                </span>
                                Wordpress
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-drupal-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/Drupal.webp" alt="Drupal" />
                                </span>
                                Drupal
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-magento-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/magento.webp" alt="Magento" />
                                </span>
                                Magento
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-shopify-developers/"
                                target=”_blank”>
                                <span class="img">
                                    <img src="images/icons/shopify.webp" alt="Shopify" />
                                </span>
                                Shopify
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="#contact-form-top" class="scroll_form btn">Get Started Today</a>
        </div>
    </div>
</section>

<!-- Review & Service Section Start -->
<div class="reviewSection reviewServeGradientBg">
    <div class="container-fluid">
        <div class="container">
            <div id="review_slider" class="testimonials owl-carousel">
                <div class="box">
                    <div class="review common">
                        <div class="top">
                            <div class="left">
                                <span class="project_heading">Great Reviews on Clutch and GoodFirms</span>
                                <p>
                                    "The workflow between both teams has always been open,
                                    streamlined, and responsive."
                                </p>
                                <div class="reviewer common">
                                    <div class="topNew">
                                        <span class="project_heading subTitleLine">the reviewer</span>
                                        <div class="profile">
                                            <div class="img">
                                                <span class="img_circle"><img src="images/Stewart-Gauld.webp"
                                                        alt="Stewart Gauld" />
                                                </span>
                                                <div class="nameDetailsWrap">
                                                    <span class="name">Stewart H. Gauld</span>
                                                    <span class="nameDetails">Project & Content Director, <br />
                                                        Business Development Group</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="rate_wrapper">
                                    <span>5.0</span>
                                    <ul class="rate_list">
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                    </ul>
                                </div>
                                <hr />
                                <ul class="rating_point">
                                    <li>Quality: <span>5.0</span></li>
                                    <li>Schedule: <span>5.0</span></li>
                                    <li>Cost: <span>4.5</span></li>
                                    <li>Willing to refer: <span>5.0</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="review common">
                        <div class="top">
                            <div class="left">
                                <span class="project_heading">Great Reviews on Clutch and GoodFirms</span>
                                <p>
                                    "They were very fast, and the team is big enough to tap on
                                    each other's expertise."
                                </p>
                                <div class="reviewer common">
                                    <div class="topNew">
                                        <span class="project_heading subTitleLine">the reviewer</span>
                                        <div class="profile">
                                            <div class="img">
                                                <span class="img_circle">
                                                    <img src="images/Yeng-Hwee-Tay.webp" alt="Yeng Hwee Tay" />
                                                </span>
                                                <div class="nameDetailsWrap">
                                                    <span class="name">Yeng Hwee Tay</span>
                                                    <span class="nameDetails">Director, ClickTwoStart</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="rate_wrapper">
                                    <span>4.5</span>
                                    <ul class="rate_list">
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                    </ul>
                                </div>
                                <hr />
                                <ul class="rating_point">
                                    <li>Quality: <span>5.0</span></li>
                                    <li>Schedule: <span>5.0</span></li>
                                    <li>Cost: <span>4.5</span></li>
                                    <li>Willing to refer: <span>5.0</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="review common">
                        <div class="top">
                            <div class="left">
                                <span class="project_heading">Great Reviews on Clutch and GoodFirms</span>
                                <p>
                                    eLuminous dedicated a project manager to our project who had
                                    excellent communication skills.
                                </p>


                                <div class="reviewer common">
                                    <div class="topNew">
                                        <span class="project_heading subTitleLine">the reviewer</span>
                                        <div class="profile">
                                            <div class="img">
                                                <span class="img_circle">
                                                    <img src="images/Steve-Lim.webp" alt="Steve Lim" />
                                                </span>
                                                <div class="nameDetailsWrap">
                                                    <span class="name">Steve Lim</span>
                                                    <span class="nameDetails">Managing Director, Web Design &amp;
                                                        Development
                                                        Agency</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="right">
                                <div class="rate_wrapper">
                                    <span>5.0</span>
                                    <ul class="rate_list">
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                        <li>
                                            <object data="images/icons/redstar.svg" type="image/svg+xml"></object>
                                        </li>
                                    </ul>
                                </div>
                                <hr />
                                <ul class="rating_point">
                                    <li>Quality: <span>5.0</span></li>
                                    <li>Schedule: <span>4.0</span></li>
                                    <li>Cost: <span>5.0</span></li>
                                    <li>Willing to refer: <span>5.0</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Review & Service Section End -->

<section class="whyTech">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="title">
                    Engagement Models for Hiring Dedicated Developers
                </h2>
                <p class="subTitle">Software outsourcing has never been so easy ! We can help you to hire skilled
                    Developers, Testers, Business Analysts and Technology Architects as per your need in optimum time.
                    This
                    will help you to accelerate software development, reduce cost and nitty-gritties of hiring best
                    talent.
                </p>
            </div>
        </div>
        <div class="bottomWrapper">
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-4 d-flex">
                    <div class="box">
                        <span>
                            <img src="images/icons/dedicated-developers.webp" alt="Dedicated Developers" />
                        </span>
                        <h3 class="title">Individual Developers/<br />Testers</h3>
                        <ul>
                            <li>Hire skilled Developers or testers who can operate remotely</li>
                            <li>Onsite developers or testers with relevant work culture awareness</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 d-flex">
                    <div class="box">
                        <span>
                            <img src="images/icons/fully-functional-pods.webp" alt="Fully Functional PODs" />
                        </span>
                        <h3 class="title">Fully Functional <br /> PODs</h3>
                        <ul>
                            <li>Agile Development PODs with Technology Architect, Developers, Testers and Bas</li>
                            <li>Flexibility of designing a POD by selecting right roles</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 d-flex">
                    <div class="box">
                        <span><object data="images/icons/fast-quick-onboarding.svg"
                                type="image/svg+xml"></object></span>
                        <h3 class="title">Pizza PODs</h3>
                        <ul>
                            <li>Hire specialists in development or testing who will faciliate to your existing POD or
                                software
                                team</li>
                            <li>Flexibility of hiring specialists on need basis saves significant cost and reduce talent
                                risk
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 mt-lg-5 mt-3 text-center">
                    <a href="#contact-form-top" class="btn borderBtn scroll_form">
                        Get Started Today
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="step__wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2 class="title">
                    Hire Top 1% Talent with this Process
                </h2>
                <p class="subTitle">Our quick 4 steps process to get you best option for Hiring Dedicated Developers
                </p>
            </div>
        </div>
        <div class="stepper-wrapper">
            <div class="stepper-item completed">
                <div class="step-counter">
                    <object data="images/icons/hired.svg" type="image/svg+xml"></object>
                </div>
                <div class="step-name">01</div>
                <div class="step-text">Share your <br /> requirements</div>
            </div>
            <div class="stepper-item completed">
                <div class="step-counter">
                    <object data="images/icons/happy-clients.svg" type="image/svg+xml" class="icon"></object>
                </div>
                <div class="step-name">02</div>
                <div class="step-text">We shortlist the most<br />suitable talent</div>
            </div>
            <div class="stepper-item active">
                <div class="step-counter">
                    <object data="images/icons/candidate.svg" type="image/svg+xml"></object>
                </div>
                <div class="step-name">03</div>
                <div class="step-text">Select the right fit for<br />your business</div>
            </div>
            <div class="stepper-item">
                <div class="step-counter">
                    <object data="images/icons/hand-shake.svg" type="image/svg+xml"></object>
                </div>
                <div class="step-name">04</div>
                <div class="step-text">Remote Onboarding &<br />Support</div>
            </div>
        </div>
        <div class="text-center">
            <a href="#contact-form-top" class="btn borderBtn scroll_form">
                Hire Dedicated Developer
            </a>
        </div>
    </div>
</section>

<section class="step__wrapper about__elu">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2 class="title">
                    About eLuminous
                </h2>
            </div>
        </div>
        <div class="wrapper">
            <ul class="common key__list">
                <li>
                    Key Highlights
                </li>
                <li>
                    <span>19+ years</span>
                    <span>of experience</span>
                </li>
                <li>
                    <span>600+</span>
                    <span>Happy Client</span>
                </li>
                <li>
                    <span>130+</span>
                    <span>IT Professionals</span>
                </li>
                <li>
                    <span>70%</span>
                    <span>Client Retention Rate</span>
                </li>
            </ul>
            <ul class="common recongnitions__list">
                <li>
                    Recongnitions
                </li>
                <li>
                    <img src="../images/clutch-icon.webp" alt="Clutch" />
                </li>
                <li>
                    <img src="../images/home/Badges-Mobile-App-Developers-2020.webp"
                        alt="Badges-Mobile-App-Developers-2020" />
                </li>
                <li>
                    <img src="https://www.itfirms.co/wp-content/uploads/2020/01/app-developers-usa-2020.png"
                        alt="ITFirms-Top-App-Developers-USA" />
                </li>
                <li>
                    <img src="https://assets.goodfirms.co/categories/goodfirms-blue.svg" alt="GoodFirms Badge" />
                </li>
            </ul>
            <ul class="common clients__list">
                <li>
                    Our Esteemed Clients
                </li>
                <li>
                    <img src="../images/razer.webp" alt="Razer" />
                </li>
                <li>
                    <img src="../images/viacom_18.webp" alt="Viacom 18" />
                </li>
                <li>
                    <img src="../images/color.webp" alt="Color" />
                </li>
                <li>
                    <img src="../images/sokule.webp" alt="sokule" />
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- FAQ Section Start -->
<section class="expertise faq_wrapper">
    <h2 class="title black text-center">FAQ's</h2>
    <div class="container">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                            Why hire dedicated developers instead of freelancers?
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <p>
                            When you hire dedicated developers, what you get is comprehensive expertise in one place
                            with
                            reputation and maximum commitment. In the case of freelancing, there is a little bit of
                            insecurity
                            about above-mentioned points. With hire dedicated development model you can easily ramp-up
                            and ramp
                            down the team as per your project requirement.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                            How much does it cost to hire dedicated developers?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <p>
                            If you want to hire dedicated developers full-time, then it will cost you in between $2400
                            to $4000
                            per month which is subjective to the skillset and experience of the candidate.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                            aria-expanded="false" aria-controls="collapseThree">
                            What kind of company would use a dedicated team?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <p>
                            Companies with non-technical executives and have some limitations while managing and leading
                            software development projects can hire dedicated developers to get their work done in
                            systematic
                            approach.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                            aria-expanded="false" aria-controls="collapseFour">
                            What are the benefits of hiring dedicated developers?
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <ul>
                            <li>Save money and time</li>
                            <li>Improve productivity</li>
                            <li>IP security and ownership</li>
                            <li>Direct communication</li>
                            <li>Flexible hiring</li>
                            <li>Multiple skillsets</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                            aria-expanded="false" aria-controls="collapseFive">
                            What is your resource backup strategy? If my existing resource is unavailable due to some
                            emergency
                            or plans to change the organization?
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        <p>Don't worry. We have a pool of 130+ developers and we always take care of mandatory
                            provisions for
                            smooth project execution within committed time period.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSix">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseSix"
                            aria-expanded="false" aria-controls="collapseSix">
                            What if I am not satisfied?
                        </button>
                    </h5>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                        <p>Be assured. It will never happen as we choose our resources carefully. Still, if you are
                            unhappy we
                            shall be sharing an escalation process. You can share your concern with our Account manager
                            and
                            Delivery managers. We shall replace the resource as soon as possible. Generally, when we
                            onboard a
                            new resource, our Seniors pay close attention and ensure you a timely and quality outcome.
                            According to the business scenario or any reason all parties have the right to give 30 days'
                            notice
                            and opt for adding/removing the resources.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">
                        <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven"
                            aria-expanded="false" aria-controls="collapseSeven">
                            How do you do manage timezone difference in Outsourcing?
                        </button>
                    </h5>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body">
                        <p>We provide time overlapping between clients' timezone (GMT/CST/PST/EST) and eLuminous teams.
                            Time
                            overlapping will allow smooth communication between stakeholders and assured quality work
                            and
                            on-time delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FAQ Section End -->

<!-- Form Section Start -->
<section class="contactForm contactGradientBg banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="img">
                    <img src="images/let's-talk.webp" class="img-fluid" alt="Contact Us eLuminous" />
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center">
                <div id="contact-form-top" class="contact-form-top">
                    <h2 class="text-center black title">LET’S tALK</h2>
                    <h4 class="text-center black subTitle">
                        Ready to create an unique experience? Let's get in touch!
                    </h4>
                    <form action="" method="post" class="form" id="planForm">
                        <input type="text" name="formType" id="formType" class="form-control" value="laravelDeveloper"
                            style="display: none;" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="full_name" class="form-control"
                                        placeholder="Full Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="company_name" id="company_name" class="form-control"
                                        placeholder="Company Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" maxlength="11" onkeydown="return checkPhoneKey(event.key)"
                                        name="number" id="number" class="form-control" placeholder="Mobile Number" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Requirement (Optional)" rows="5"
                                        name="comment" id="comment"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-7 col-md-6 col-lg-6">
                                <div class="form-group captchWrapper">
                                    <!-- dev15march2022 <div class="g-recaptcha brochure__form__captcha"
                           data-sitekey="6Lcwm3UdAAAAAFfjQx3yBUSEeD3pIajyuAUvrvXn"></div> --->
                                    <!---live--->
                                    <!-- <div
                           class="g-recaptcha brochure__form__captcha"
                           data-sitekey="6LfDwH8dAAAAAGzHuSNarOff5AgST92CU2atMgS-"
                           ></div>  -->
                                    <!-- dev15march2022<div class="g-recaptcha brochure__form__captcha"
                           data-sitekey="6Lcwm3UdAAAAAFfjQx3yBUSEeD3pIajyuAUvrvXn"></div>--->
                                    <!--local <div class="g-recaptcha brochure__form__captcha"
                           data-sitekey="6LcDm38dAAAAALzKtz_Kuzw5rEV7IW-mPRNVmKIW"></div>-->
                                    <!-- <div class="errorCap" style="color: red;"></div> -->
                                    <!-- <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 pl-0 mobile-space mt-sm-0">
                              <label for="search" class="visuallyhidden">Question: </label>
                              <input type="text" class="change-design form-control" id="cptchaQues" readonly name="cptchaQues" value="<?php echo $newCptcha; ?>">
                           </div>

                           <div class="input_white_bg col-xs-12 col-sm-4 col-md-6 col-lg-4 m-0 mobile-space">
                              <label for="search" class="visuallyhidden">Answer: </label>
                              <input type="text" class="form-control" name="captchaAnswer" id="captchaAnswer" value=""></div>
                              <div class="contact-form-error-message new-massage col-md-12 p-0">
                              <span class="homePageCorrectCaptcha"></span> -->


                                    <div class="row align-items-center captchaWrapper">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mobile-space mt-sm-0">
                                            <label for="search" class="visuallyhidden">Question: </label>
                                            <input type="text" class="change-design form-control" id="cptchaQues"
                                                readonly name="cptchaQues" value="<?php echo $newCptcha; ?>">
                                        </div>

                                        <div
                                            class="input_white_bg col-xs-12 col-sm-6 col-md-6 col-lg-6 m-sm-0 mobile-space">
                                            <label for="search" class="visuallyhidden">Answer: </label>
                                            <input type="text" class="form-control border-0" name="captchaAnswer"
                                                id="captchaAnswer" value="">
                                        </div>
                                        <div class="contact-form-error-message new-massage col-md-12 p-0">
                                            <span class="PageCorrectCaptcha"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="form-group red_btn text-md-right">
                                    <button class="btn" name="submit" type="submit" id="make_proposal">
                                        SUBMIT
                                    </button>
                                    <input type="hidden" name="page_url"
                                        value="<?php echo $_SESSION['REQUEST_URI'];?>" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Form Section End -->

<?php require_once("../include/footer-links.php");?>
<?php require_once("includes/footer.php");?>
<?php require_once("../include/footer.php");?>