<?php
date_default_timezone_set("Asia/Calcutta");    
// include_once("../connection.php");
//require_once('../includes/head.php');
//include('../includes/constant.php');


include '../include/header-docs.php'; 

include '../include/header-links.php'; 

require_once('includes/header.php');
include '../include/header-menu.php'; 

$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

$pagename = "index";
$pagename1 = "hire-reactjs-developers";
$keywords = "web design & development company, custom mobile app development company, front end development company, business intelligence and data analytics";//Put keywords here
$pageTitle = "Web Design & Development Company - eLuminous Technologies"; //Put page title here
$metaDesc = "eLuminous Technologies is Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises.We Build Custom Web Design & Development, Mobile, Business Intelligence Solutions For Clients From 27+ Countries."; //Put meta description here

$ip_address = $_SERVER['REMOTE_ADDR']; 
$date = date('Y-m-d H:i:s');
$sql_statement= "INSERT INTO `tbl_landing_url`( `country_name`, `page_url`, `ip_address`, `date`) VALUES ('".$countryName."','".$_SESSION['REQUEST_URI']."','".$ip_address."','".$date."')";
// $result = mysqli_query($conn,$sql_statement);

function reCaptcha($recaptcha){
      //$secret = "6Lcwm3UdAAAAANcRFsRhbwnebO2SwnJiZ-UAB_YW";//dev
    //$secret = "6LcDm38dAAAAADbJ8jcBi_T0iMNq-Yzn-QMRhzyf"; //local
      $secret = "6LfDwH8dAAAAADQW0nP2iRjCDOz_VhVsUjHADr9U";//live

  $ip = $_SERVER['REMOTE_ADDR'];

  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
$url = "https://www.google.com/recaptcha/api/siteverify"; $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER,
1); curl_setopt($ch, CURLOPT_TIMEOUT, 10); curl_setopt($ch, CURLOPT_POSTFIELDS,
$postvars); $data = curl_exec($ch); curl_close($ch); return json_decode($data,
true); } $postData = $statusMsg = $valErr = ''; $status = 'error'; ?>
<!-- Home Banner Section Start -->
<div class="gradientBgHidden">
    <div class="homeBanner banner homeBannerImg">
        <div class="container bannerTopWrapper">
            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <div class="text">
                        <h1 class="title">
                            <!-- Front-End <span>Development <br /> Services</span> -->
                            <span>Hire</span> Front End <br />Developer
                        </h1>

                        <h4 class="fw400">
                            Seamless visualisation across all devices with pixel <br />
                            perfect designs and stunning User experience
                        </h4>
                        <div class="clutch_wrapper">
                            <ul>
                                <li><img src="images/clutch-icon.png" alt="clutch"></li>
                                <li><img src="images/goodfirms.png" alt="goodfirms"></li>
                            </ul>
                        </div>
                        <a href="#contact-form-top" class="btn blue_btn scroll_form btn">Hire Front End Developer</a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-6">
                    <div class="img">
                        <img src="images/banner-image-top.png" alt="Front-End Development Services" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container-fluid caseStudies">
      <div class="container">
        <h5 class="subTitle subTitleLine">Discover Our Latest Resources</h5>
        <h2 class="title">Case Studies</h2>
      </div>

      <div class="case_studies">
        <div class="container">
          <div class="row justify-content-center caseStudiesRow">
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
              <div class="card white whiteBg">
                <div class="imgWrap">
                  <img src="images/front-end-development.jpg" alt="Partnering Front-end Development"
                    class="img-fluid" />
                </div>
                <div class="text">
                  <h4>
                    Partnering Front-end Development
                    <span>(with European Digital Marketing Agency)</span>
                  </h4>
                  <p>
                    eLuminous reduced the cost of development by 45% and reduced
                    time-to-market by 20% for a European Digital Marketing Agency
                    as part of their IT process stanardization.
                  </p>
                  <a href="images/frontend-development.pdf" class="btn" target="_blank">Download
                    PDF</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
              <div class="card white whiteBg">
                <div class="imgWrap">
                  <img src="images/FDA-compliant-eCommerce.jpg"
                    alt="Getting FDA compliant eCommerce ready within 90 days" class="img-fluid" />
                </div>
                <div class="text">
                  <h4>Developed FDA compliant <br> eComm erce platform in 90 days</h4>
                  <p>
                    UK based Client baby care brand wanted to develop new markets
                    for their expansion. They wanted to develop the abilities to
                    sell through new geographies i.e. Europe and USA.
                  </p>
                  <a href="images/Getting-FDA-compliant-eCommerce-ready-within-90days.pdf" class="btn"
                    target="_blank">Download PDF</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
              <div class="card white whiteBg">
                <div class="imgWrap">
                  <img src="images/ui-using-react-js.jpg" alt="Food delivery app with user friendly UI using React js"
                    class="img-fluid" />
                </div>
                <div class="text">
                  <h4>Food delivery app with user friendly UI using React js</h4>
                  <p>
                    Client offers a platform for home chefs and diners to provide
                    a clean hygienic home cooked meal experience. The client
                    represents a new age startup.
                  </p>
                  <a href="images/Food-delivery-app-with-user-friendly-UI-using-React-js.pdf" class="btn"
                    target="_blank">Download PDF</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
              <div class="card white whiteBg">
                <div class="imgWrap">
                  <img src="images/eLearning-management-solution.jpg" alt="eLearning Management Solution
                        for CLE (Continuing Legal Education)" class="img-fluid" />
                </div>
                <div class="text">
                  <h4>
                    eLearning Management Solution for CLE
                    <span>(Continuing Legal Education)</span>
                  </h4>
                  <p>
                    CLE course certificates are essentials for the Lawyers as a
                    mandatory legal compliance. Hence, the key requirement was to
                    generate course completion certificates based on the User's
                    time zone.
                  </p>
                  <a href="images/eLearning-managemen-t-solution-for-CLE.pdf" class="btn" target="_blank">Download
                    PDF</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    </div>
    <!-- Home Banner Section End -->

    <!-- Review & Service Section Start -->
    <div class="reviewSection reviewServeGradientBg">
        <div class="container-fluid">
            <div class="container p-0 ">
                <div id="review_slider" class="testimonials owl-carousel">
                    <div class="box">
                        <div class="review common">
                            <div class="top">
                                <div class="left">
                                    <span class="project_heading">the review</span>
                                    <p>
                                        "The workflow between both teams has always been open,
                                        streamlined, and responsive."
                                    </p>
                                    <!-- <p class="date">Dec 2, 2020</p> -->

                                    <div class="reviewer common">
                                        <div class="topNew">
                                            <span class="project_heading subTitleLine">the reviewer</span>
                                            <div class="profile">
                                                <div class="img">
                                                    <span class="img_circle"><img src="images/icons/user-profile.png"
                                                            alt="user icon" /></span>
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
                                            <li><img src="images/icons/star.png" alt="star icon" /></li>
                                            <li><img src="images/icons/star.png" alt="star icon" /></li>
                                            <li><img src="images/icons/star.png" alt="star icon" /></li>
                                            <li><img src="images/icons/star.png" alt="star icon" /></li>
                                            <li><img src="images/icons/star.png" alt="star icon" /></li>
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
                                    <span class="project_heading">the review</span>
                                    <p>
                                        "They were very fast, and the team is big enough to tap on each other's
                                        expertise."
                                    </p>
                                    <!-- <p class="date">Dec 2, 2020</p> -->

                                    <div class="reviewer common">
                                        <div class="topNew">
                                            <span class="project_heading subTitleLine">the reviewer</span>
                                            <div class="profile">
                                                <div class="img">
                                                    <span class="img_circle"><img src="images/icons/user-profile.png"
                                                            alt="user icon" /></span>
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
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/half-star.png" alt="star icon"></li>
                                        </ul>
                                    </div>
                                    <hr>
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
                                    <span class="project_heading">the review</span>
                                    <p>
                                        eLuminous dedicated a project manager to our project who had excellent
                                        communication
                                        skills.
                                    </p>
                                    <!-- <p class="date">Dec 2, 2020</p> -->

                                    <div class="reviewer common">
                                        <div class="topNew">
                                            <span class="project_heading subTitleLine">the reviewer</span>
                                            <div class="profile">
                                                <div class="img">
                                                    <span class="img_circle"><img src="images/icons/user-profile.png"
                                                            alt="user icon" /></span>
                                                    <div class="nameDetailsWrap">
                                                        <span class="name">Steve Lim</span>
                                                        <span class="nameDetails">Managing Director, Web Design &amp;
                                                            Development Agency</span>
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
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                            <li><img src="images/icons/star.png" alt="star icon"></li>
                                        </ul>
                                    </div>
                                    <hr>
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

    <div class="container-fluid">
        <div class="container p-0 ">
            <div class="container-fluid caseStudies weOfferSection">
                <!-- <h5 class="subTitle subTitleLine">What We Offer</h5> -->
                <!-- <h2 class="title">Our Front-end Development Services</h2> -->
                <h2 class="title">Our Front-End Developers can help you in</h2>
                <div class="row justify-content-center caseStudiesRow">
                    <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                        <div class="card">
                            <span class="img frontEndIcon"><img src="images/icons/front-end.png"
                                    alt="Front-end Development" /></span>
                            <h4>Front-end Development</h4>
                            <p>
                                Hire front-end developers with expertise in Angular, React and Vue. We use Agile
                                methodology which
                                gives
                                ability for fast time-to-market. Agile-driven approach provide effective product
                                scoping, faster
                                delivery and top-notch quality.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                        <div class="card">
                            <span class="img fullStackWebIcon"><img src="images/icons/full-stack-web.png"
                                    alt="Full Stack Web Development" /></span>
                            <h4>Full Stack Web Development</h4>
                            <p>
                                Hire full stack developers from eLuminous Tecnologies who will work for front-end and
                                back end of the
                                web applications using distinct frameworks, technologies.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                        <div class="card">
                            <span class="img psdToBootstrapIcon"><img src="images/icons/psd-to-bootstrap.png"
                                    alt="PSD to Bootstrap Development" /></span>
                            <h4>PSD to Bootstrap Development</h4>
                            <p>
                                Our front-end experts will help you to convert PSD to Bootstrap, PSD to HTML/CSS, PSD to
                                WordPress,
                                PSD
                                to Magento, PSD to Drupal, PSD to Joomla, etc.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                        <div class="card">
                            <span class="img customApplicationIcon"><img src="images/icons/custom-application.png"
                                    alt="Custom Application Development" /></span>
                            <h4>Custom Application Development</h4>
                            <p>
                                Front-end developers are here to help you in creating simple, intuitive, cross-browser
                                compatible
                                applications following latest UI/UX guidelines.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container technologySection p-0 m-0">
                <h2 class="title">
                    <!-- Technology Expertise for <br />Front-end Development -->
                    <!-- Our Front-End Developers' <br /> -->Technology Stack
                </h2>
                <h4 class="fw400">
                    Experienced front-end development teams equipped with cutting edge
                    tech expertise to tell innovative, responsive and engrossing visual
                    stories for your business applications
                </h4>
                <ul class="technologiesList">
                    <li>
                        <span class="img"><img src="images/icons/AngularJS.png" alt="AngularJS" /></span>
                        Angular JS
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/ReactJS.png" alt="ReactJS" /></span>
                        React JS
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/VueJS.png" alt="Vue JS" /></span>
                        Vue JS
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/Node.js.png" alt="Node.js" /></span>
                        Node.js
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/TypeScript.png" alt="TypeScrip" /></span>
                        TypeScript
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/HTML5.png" alt="HTML5" /></span>
                        HTML5
                    </li>
                    <li>
                        <span class="img"><img src="images/icons/CSS3.png" alt="CSS3" /></span>
                        CSS3
                    </li>
                </ul>
                <a href="#contact-form-top" class="scroll_form btn">Hire Front End Developer</a>
            </div>
        </div>
    </div>


    <div class="homeBanner CaseStudiesWrapper">
        <div class="container-fluid caseStudies">
            <div class="container">
                <!-- <h5 class="subTitle subTitleLine">Discover Our Latest Resources</h5> -->
                <h2 class="title">Case Studies</h2>
            </div>

            <div class="case_studies">
                <div class="container">
                    <div class="row justify-content-center caseStudiesRow">
                        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                            <div class="card white whiteBg">
                                <div class="imgWrap">
                                    <img src="images/front-end-development.jpg" alt="Partnering Front-end Development"
                                        class="img-fluid" />
                                </div>
                                <div class="text">
                                    <h4>
                                        Partnering Front-end Development
                                        <span>(with European Digital Marketing Agency)</span>
                                    </h4>
                                    <p>
                                        eLuminous reduced the cost of development by 45% and reduced
                                        time-to-market by 20% for a European Digital Marketing Agency
                                        as part of their IT process stanardization.
                                    </p>
                                    <a href="images/frontend-development.pdf" class="btn" target="_blank">Download
                                        PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                            <div class="card white whiteBg">
                                <div class="imgWrap">
                                    <img src="images/FDA-compliant-eCommerce.jpg"
                                        alt="Getting FDA compliant eCommerce ready within 90 days" class="img-fluid" />
                                </div>
                                <div class="text">
                                    <h4>Developed FDA compliant <br> eCommerce platform in 90 days</h4>
                                    <p>
                                        UK based Client baby care brand wanted to develop new markets
                                        for their expansion. They wanted to develop the abilities to
                                        sell through new geographies i.e. Europe and USA.
                                    </p>
                                    <a href="images/Getting-FDA-compliant-eCommerce-ready-within-90days.pdf" class="btn"
                                        target="_blank">Download PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                            <div class="card white whiteBg">
                                <div class="imgWrap">
                                    <img src="images/ui-using-react-js.jpg"
                                        alt="Food delivery app with user friendly UI using ReactJs" class="img-fluid" />
                                </div>
                                <div class="text">
                                    <h4>Food delivery app with user friendly UI using ReactJs</h4>
                                    <p>
                                        Client offers a platform for home chefs and diners to provide
                                        a clean hygienic home cooked meal experience. The client
                                        represents a new age startup.
                                    </p>
                                    <a href="images/Food-delivery-app-with-user-friendly-UI-using-React-js.pdf"
                                        class="btn" target="_blank">Download PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
                            <div class="card white whiteBg">
                                <div class="imgWrap">
                                    <img src="images/eLearning-management-solution.jpg" alt="eLearning Management Solution
                        for CLE (Continuing Legal Education)" class="img-fluid" />
                                </div>
                                <div class="text">
                                    <h4>
                                        eLearning Management Solution for CLE
                                        <span>(Continuing Legal Education)</span>
                                    </h4>
                                    <p>
                                        CLE course certificates are essentials for the Lawyers as a
                                        mandatory legal compliance. Hence, the key requirement was to
                                        generate course completion certificates based on the User's
                                        time zone.
                                    </p>
                                    <a href="images/eLearning-managemen-t-solution-for-CLE.pdf" class="btn"
                                        target="_blank">Download
                                        PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Section Start -->
    <section class="whyChoose  whyChooseGradientBg banner pt-0">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-5 col-xl-5 p-0">
                    <div class="imgWrap">
                        <img src="images/why-choose.jpg" alt="Front-End Development" class="img-fluid w-100" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 col-xl-7 d-flex align-items-center">
                    <div class="box">
                        <h2 class="title">
                            <!-- Why Choose <br />
              eLuminous Technologies -->
                            Why Choose <br />eLuminous Technologies?
                        </h2>
                        <h4 class="fw400">
                            Get your team of front-end-developers from Clutch-rated Top 100 Web Application Development
                            Company in 2021!
                        </h4>
                        <ul class="whyChooseList">
                            <li>Choose from 135+ Skilled Resources</li>
                            <li>Choose the most Suitable Technical stack</li>
                            <li>Agile-ACP, PMP, AWS Certified Developers</li>
                            <li>Transparent Billing</li>
                            <li>5 CoEs for Cutting Edge Tech</li>
                        </ul>
                        <h2>Where We Stand?</h2>
                        <ul class="technologiesList">
                            <li>
                                <span class="img">
                                    <img src="images/icons/award.png" alt="19+ Years of Experience" />
                                    19+ Years of Experience
                                </span>
                            </li>
                            <li>
                                <span class="img">
                                    <img src="images/icons/processes.png" alt="Matured Processes" />
                                    Matured Processes
                                </span>
                            </li>
                            <li>
                                <span class="img">
                                    <img src="images/icons/developers.png" alt="135+ Expert Developers" />
                                    135+ Expert Developers
                                </span>
                            </li>
                            <li>
                                <span class="img">
                                    <img src="images/icons/clients.png" alt="600+ Happy Clients" />
                                    600+ Happy Clients
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Section End -->

    <section class="contactForm contactGradientBg banner pb-0">
        <div class="container">
            <div id="contact-form-top" class="contact-form-top">
                <h2 class="text-center black">LET’S tALK</h2>
                <h4 class="text-center black">Ready to create a unique experience? Let's get in touch!</h4>

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
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
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
                        <div class="col-lg-6">
                            <div class="row align-items-center captchaWrapper">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mobile-space mt-sm-0">
                                    <label for="search" class="visuallyhidden">Question: </label>
                                    <input type="text" class="change-design form-control" id="cptchaQues" readonly
                                        name="cptchaQues" value="<?php echo $newCptcha; ?>">
                                </div>

                                <div class="input_white_bg col-xs-12 col-sm-6 col-md-6 col-lg-6 m-sm-0 mobile-space">
                                    <label for="search" class="visuallyhidden">Answer: </label>
                                    <input type="text" class="form-control border-0" name="captchaAnswer"
                                        id="captchaAnswer" value="">
                                </div>
                                <div class="contact-form-error-message new-massage col-md-12 p-0">
                                    <span class="frontEndPageCorrectCaptcha"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group red_btn text-md-right">
                                <button class="btn" name="submit" type="button" id="make_proposal">
                                    SUBMIT
                                </button>
                                <input type="hidden" name="page_url" value="<?php echo $_SESSION['REQUEST_URI'];?>" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--<footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-xl-6">
            <div class="left">
              <div class="logoWrapper">
                <a class="logo scroll_form" href="#contact-form-top">
                  <img src="images/eluminous-logo.png" alt="eLuminous Logo" />
                </a>
                <ul class="socialList">
                  <li><a href="https://www.facebook.com/eluminoustech" target="_blank"><i
                        class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/eluminoustech" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="http://www.linkedin.com/company/eluminous-technologies" target="_blank"><i
                        class="fa fa-linkedin"></i></a></li>
                  <li><a href="https://www.youtube.com/channel/UCfqg8756psg4hflU027Iu9g" target="_blank"><i
                        class="fa fa-youtube-play" aria-hidden="true"></i>
                    </a></li>
                </ul>
              </div>
              <p>eLuminous Technologies © 2022 All Rights Reserved <a
                  href="https://eluminoustechnologies.com/terms-and-conditions/" target="_blank">Terms & Conditions</a>
                <span class="my-1 d-inline-block">|</span> <a href="https://eluminoustechnologies.com/privacy-policy"
                  target="_blank">Privacy
                  & Policy</a>
              </p>
            </div>
          </div>
          <div class="col-lg-8 col-xl-6 pl-lg-0">
            <ul class="bottom_img_list">
              <li><img src="images/icons/leafe-left.png" alt="Leaf Icon"></li>
              <li><img src="images/clutch.png" alt="Clutch"></li>
              <li><img src="images/goodfirms.png" alt="Goodfirms"></li>
              <li><img src="images/icon-3.png" alt="top developers.co"></li>
              <li><img src="images/icons/leafe-right.png" alt="Leaf Icon"></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>-->
    </section>

</div>

<script async='async' src="<?php echo SITE_URL;?>front-end-development/js/custom.js"></script>
<?php require_once("../include/footer-links.php");?>
<?php require_once("includes/footer.php");?>
<?php require_once("../include/footer.php");?>