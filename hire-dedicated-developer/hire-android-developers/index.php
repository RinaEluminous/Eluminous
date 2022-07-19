<?php
//include('../includes/constant.php');

date_default_timezone_set("Asia/Calcutta");    
ini_set('default_charset', 'utf8');
// include_once("../connection.php");
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

$pagename = "dedicated-developer";
$pagename1 = "hire-android-developers";

$keywords = "hire android developers, hire android developer, hire android app developers, hire dedicated android developers";//Put keywords here
$pageTitle = "Hire Android Developers | Hire Android App Developers"; //Put page title here
$metaDesc = "Hire Android Developers who are able to turn your idea into the reality with extensive experience in emerging technologies like IoT, AI-based mobile app development and many more."; //Put meta description here
require_once(dirname(dirname(__DIR__)).'/include/header-docs.php');
 include_once(PATH."/connection.php");
// require_once('../includes/head.php');
// require_once('../include/header.php');
//require_once('../include/header-doc.php');
require_once(PATH.'/include/header-links.php');
require_once('includes/header.php');
require_once(PATH.'/include/header-menu.php');

$ip_address = $_SERVER['REMOTE_ADDR']; 
$date = date('Y-m-d H:i:s');
$sql_statement= "INSERT INTO `tbl_landing_url`( `country_name`, `page_url`, `ip_address`, `date`) VALUES ('".$countryName."','".$_SESSION['REQUEST_URI']."','".$ip_address."','".$date."')";
$result = mysqli_query($conn,$sql_statement);

function reCaptcha($recaptcha){
      //$secret = "6Lcwm3UdAAAAANcRFsRhbwnebO2SwnJiZ-UAB_YW";//dev
   //$secret = "6LfDP-EeAAAAAAsZHVgerQ8ot4p5qdUn0WcfoTPv";//dev15march2022
    //$secret = "6LcDm38dAAAAADbJ8jcBi_T0iMNq-Yzn-QMRhzyf"; //local
      $secret = "6LfDwH8dAAAAADQW0nP2iRjCDOz_VhVsUjHADr9U";//live

  $ip = $_SERVER['REMOTE_ADDR'];

  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
$url = "https://www.google.com/recaptcha/api/siteverify"; $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); curl_setopt($ch, CURLOPT_RETURNTRANSFER,
1); curl_setopt($ch, CURLOPT_TIMEOUT, 10); curl_setopt($ch, CURLOPT_POSTFIELDS,
$postvars); $data = curl_exec($ch); curl_close($ch); return json_decode($data,
true); } $postData = $statusMsg = $valErr = ''; $status = 'error'; ?>
<!-- Home Banner Start -->
<section class="homeBanner">
   <div class="container">
      <div class="row flex-md-row-reverse">
         <div class="col-lg-6">
            <div class="img">
               <img src="images/hire-android-developers-banner.webp" alt="Hire Android Developers" class="img-fluid" />
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
                     "Their speed and agility were impressive. Nothing was ever an issue for them."
                  </p>
               </div>
               <ul class="list">
                  <li>
                     <span>
                        <div class="icon">
                           <object data="images/icons/scalable.svg" type="image/svg+xml" class="icon"></object>
                        </div>
                        <div class="text">
                           Scalable
                        </div>
                     </span>
                  </li>
                  <li>
                     <span>
                        <div class="icon speedometer">
                           <object data="images/icons/secure.svg" type="image/svg+xml" class="icon"></object>
                        </div>
                        <div class="text">
                           Secure
                        </div>
                     </span>
                  </li>
                  <li>
                     <span>
                        <div class="icon group">
                           <object data="images/icons/user-friendly.svg" type="image/svg+xml" class="icon"></object>
                        </div>
                        <div class="text">
                           User Friendly
                        </div>
                     </span>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="text">
               <h1 class="title blue fw900 text-capitalize">
                  Hire Android
                  <span class="blackTurmeric fw400 d-block text-uppercase">Developers</span>
               </h1>
               <h2 class="subTitle">Meet and Develop Your Mobile App with App Store Award Winners!</h2>
               <h3 class="subSubTitle">
                  Hire Android Developers who are well versed in understanding your project requirements and deliver the
                  code with 100% transparency and efficiency.</h3>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire Android Developers
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Home Banner End -->

<!-- Exprtise Start -->
<section class="expertise">
   <div class="container">
      <h2 class="title">Hire Android Developers with Expertise in</h2>
      <h3 class="subTitle">
         Hire android app developers with adherence to the best code practices, standards, and guidelines and offer
         quick project launch and ramp-up time.
      </h3>
      <div class="row">
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span><object data="images/icons/custom-android-app-development.svg"
                     type="image/svg+xml"></object></span>
               <h3 class="title">
                  Custom Android<br />
                  App Development
               </h3>
               <p>
                  Our dedicated Android app developers are experts in building native android personalized apps. We use
                  Android Studio, C, C++, HTML, CSS, and Google Material to make your own unique look and feel of the
                  app.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/android-app-ui-ux-design.svg" type="image/svg+xml"></object>
               </span>
               <h3 class="title">Android App<br />UI/UX Design</h3>
               <p>
                  Being <b>Best UI Award Winners</b>, we are specialized in offering seamless visualizations, intuitive
                  UI for your android app. The user-centered approach has been helping us to create interactive
                  applications.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/iot-and-ai-based-android-app-development.svg"
                     type="image/svg+xml"></object>
               </span>
               <h3 class="title">IoT and AI-Based Android<br /> App Development</h3>
               <p>
                  We have a team of skilled Android application developers with deep knowledge and experience in
                  creating IoT-based mobile applications. They have created apps for healthcare, education, media and
                  entertainment and many more.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/android-app-testing-&-upgradation.svg" type="image/svg+xml"></object>
               </span>
               <h3 class="title">Android App Testing<br /> & Upgradation</h3>
               <p>
                  Our aim is to provide bug-free android apps. We do manual and automated testing. Check functionality,
                  accessibility, and usability before launching your app to the market. Get easy upgradations for
                  multiple Android OS here.
               </p>
            </div>
         </div>
      </div>
      <div class="mt-lg-5 text-center">
         <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire Android Developers
         </a>
      </div>
   </div>
</section>
<!-- Exprtise End -->

<!-- Why Tech Managers Start -->
<section class="whyTech mt-0">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="text">
               <h6 class="subTitle fw400 black">Why Tech Managers opt</h6>
               <h2 class="title black">
                  eLuminous to Hire Android<br />
                  Developers?
               </h2>
               <p>
                  Hire android app developers with flexible engagement models like full-time, part-time, or Adhoc basis
                  as per your business need.
               </p>
               <p class="btnTitle">Let’s innovate together.</p>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire Android Developers
               </a>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="img">
               <img src="images/hire-android.webp" alt="Hire Android" class="img-fluid" />
            </div>
         </div>
      </div>
      <div class="bottomWrapper">
         <div class="row">
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/trusted-by-people-like-you.svg" type="image/svg+xml"></object></span>
                  <h3 class="title">Trusted by People <br />Like You!</h3>
                  <p>
                     Best UI Winner and many 5 Star Reviews on <b>Clutch, GoodFirms, Google.</b>
                  </p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/quick-onboarding.svg" type="image/svg+xml"></object></span>
                  <h3 class="title">Quick<br />Onboarding</h3>
                  <p>We have a straightforward process for hiring android application developers for quick onboarding.
                  </p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/access-to-cutting-edge-technologies.svg"
                        type="image/svg+xml"></object></span>
                  <h3 class="title">Access to Cutting-Edge Technologies</h3>
                  <p>Hands-on experience in building IoT and AI-based mobile apps. We use Rest APIs for integration with
                     ERP/SAP.</p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/3-months-post-delivery-support.svg"
                        type="image/svg+xml"></object></span>
                  <h3 class="title">3-Months Post-Delivery Support</h3>
                  <p>
                     We promise free technical support of 3-Months after app delivery.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Why Tech Managers End -->

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
                                    <span class="img_circle"><img src="images/Stewart-Gauld.webp" alt="Stewart Gauld" />
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
                                       <span class="nameDetails">Managing Director, Web Design &amp; Development
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


<section class="portfolio__wrapper">
   <div class="container">
      <h2 class="title black">Portfolio</h2>
      <div class="row justify-content-center">
         <div class="col-sm-6 col-md-5 col-lg-3 d-flex">
            <div class="portfolio__box">
               <a href="https://play.google.com/store/apps/details?id=com.fakturakollen" target="_blank">
                  <div class="img">
                     <picture class="ds-image img loaded">
                        <img src="images/fakturakollen.webp" alt="Fakturakollen" />
                     </picture>
                  </div>
                  <div class="text">
                     <h4>Fakturakollen</h4>
                     <p>App Development for keeping all your Invoices from emails at One Place with keyword mangement
                     </p>
                  </div>
               </a>
            </div>
         </div>
         <div class="col-sm-6 col-md-5 col-lg-3 d-flex">
            <div class="portfolio__box">
               <a href="https://play.google.com/store/apps/details?id=com.puremed" target="_blank">
                  <div class="img">
                     <picture class="ds-image img loaded">
                        <img src="images/puremed.webp" alt="Puremed" />
                     </picture>
                  </div>
                  <div class="text">
                     <h4>Puremed</h4>
                     <p>IoT based User-Friendly App to track Medical Appointments & Tests</p>
                  </div>
               </a>
            </div>
         </div>
         <div class="col-sm-6 col-md-5 col-lg-3 d-flex">
            <div class="portfolio__box">
               <a href="https://play.google.com/store/apps/details?id=com.behaviourrecordanalysis" target="_blank">
                  <div class="img">
                     <picture class="ds-image img loaded">
                        <img src="images/behaviour-management-analysis.webp" alt="Behaviour Management Analysis" />
                     </picture>
                  </div>
                  <div class="text">
                     <h4>Behaviour Management Analysis</h4>
                     <p>App Development in Healthcare Industry - Behaviuor Analysis</p>
                  </div>
               </a>
            </div>
         </div>
         <div class="col-sm-6 col-md-5 col-lg-3 d-flex">
            <div class="portfolio__box">
               <a href="https://play.google.com/store/apps/details?id=com.musta2z" target="_blank">
                  <div class="img">
                     <picture class="ds-image img loaded">
                        <img src="images/MustAToZ-Clothing.webp" alt="MustAToZ Clothing" />
                     </picture>
                  </div>
                  <div class="text">
                     <h4>MustAToZ Clothing</h4>
                     <p>Mobile App Development for Online Store</p>
                  </div>
               </a>
            </div>
         </div>
      </div>
      <div class="mt-lg-5 mt-sm-4 mt-3 text-center">
         <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire Android Developers
         </a>
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
                     Which tools are used to develop Android App?
                  </button>
               </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     Our dedicated Android app developers use the following tools for android app development:
                  </p>
                  <ul>
                     <li>Android Studio</li>
                     <li>Android SDK</li>
                     <li>Android NDK43. Instabug</li>
                     <li>Android Debug Bridge</li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingTwo">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                     aria-expanded="false" aria-controls="collapseTwo">
                     Can you show me your previous work samples?
                  </button>
               </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     We have extensive expertise in android application development for distinct verticles.</p>
                  <ul class="mb-2">
                     <li>Puremed</li>
                     <li>Fakturakollen</li>
                     <li>Behaviour Management Analysis</li>
                     <li>MustAToZ Clothing </li>
                  </ul>
                  <p>Check out our portfolio page to get to know in detail.</p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingThree">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                     aria-expanded="false" aria-controls="collapseThree">
                     What if I need any modification or change in the mobile app after project completion?
                  </button>
               </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     Based on the type/format of change or modification you need, we will be happy to provide upcoming
                     development.
                  </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFour">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                     aria-expanded="false" aria-controls="collapseFour">
                     Do you sign NDA? I want to keep My Android App idea confidential.
                  </button>
               </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
               <div class="card-body">
                  <p>Yes, of course. We respect your confidentiality. By signing a non-disclosure agreement with you, we
                     keep shared ideas safe and secure with us. </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFive">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                     aria-expanded="false" aria-controls="collapseFive">
                     Will I own Source Code?
                  </button>
               </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
               <div class="card-body">
                  <p>Though we develop the Android app for you, App's source code belongs to you. The property rights
                     are exclusively yours. </p>
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
                           <input type="text" name="name" id="full_name" class="form-control" placeholder="Full Name" />
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
                           <input type="text" maxlength="11" onkeydown="return checkPhoneKey(event.key)" name="number"
                              id="number" class="form-control" placeholder="Mobile Number" />
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                           <textarea class="form-control" placeholder="Requirement (Optional)" rows="5" name="comment"
                              id="comment"></textarea>
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
                                 <input type="text" class="change-design form-control" id="cptchaQues" readonly
                                    name="cptchaQues" value="<?php echo $newCptcha; ?>">
                              </div>
                              <div class="input_white_bg col-xs-12 col-sm-6 col-md-6 col-lg-6 m-sm-0 mobile-space">
                                 <label for="search" class="visuallyhidden">Answer: </label>
                                 <input type="text" class="form-control border-0" name="captchaAnswer"
                                    id="captchaAnswer" value="">
                              </div>
                              <div class="contact-form-error-message new-massage col-md-12 p-0">
                                 <span class="reactPageCorrectCaptcha"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-5">
                        <div class="form-group red_btn text-md-right">
                           <button class="btn" name="submit" type="submit" id="make_proposal">
                              SUBMIT
                           </button>
                           <input type="hidden" name="page_url" value="<?php echo $_SESSION['REQUEST_URI'];?>" />
                           <input type="hidden" name="hire_for" value="Android" />
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


<?php require_once(PATH."/include/footer-links.php");?>
<?php require_once("includes/footer.php");?>
<?php require_once(PATH."/include/footer.php");?>