<?php
//include('../includes/constant.php');

date_default_timezone_set("Asia/Calcutta");    
ini_set('default_charset', 'utf8');
// include_once("../connection.php");
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

$pagename = "dedicated-developer";
$pagename1 = "hire-wordpress-developers";

$keywords = "hire wordpress developer, hire wordpress developers, wordpress development company, hire dedicated wordpress developers";//Put keywords here
$pageTitle = "Hire WordPress Developers | Hire WordPress Developer"; //Put page title here
$metaDesc = "Hire WordPress Developers with expertise in providing customized WordPress solutions as per your business requirements. Get our rate card in your inbox now!"; //Put meta description here
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
               <img src="images/hire-wordpress-developers-banner.webp" alt="Hire WordPress Developers"
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
                     "eLuminous always responds positively to requests."
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
                  Hire WordPress
                  <span class="blackTurmeric fw400 d-block text-uppercase">Developers</span>
               </h1>
               <h2 class="subTitle">Hire WordPress developers with 5 Star Rating throughout the Journey!</h2>
               <h3 class="subSubTitle">
                  Hire WordPress developers to deliver business-winning websites with a clean user interface. 8.1
                  millions websites are developed using WordPress CMS. We want you to be the next!</h3>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire WordPress Developers
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
      <h2 class="title">Hire WordPress Developers with Expertise in</h2>
      <h3 class="subTitle">
         Hire WordPress developers who can help you in adding new features with 100% customized approach just for you.
      </h3>
      <div class="row">
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span><object data="images/icons/customized-wordpress-development.svg"
                     type="image/svg+xml"></object></span>
               <h3 class="title">
               Customized WordPress<br />Development
               </h3>
               <p>
                  Our WordPress developers are experts in building customized solutions for any business requirement. We
                  are having proven track record of tailor-made, SEO-friendly websites following W3C standards.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/wordpress-theme-and-plugin-development.svg" type="image/svg+xml"></object>
               </span>
               <h3 class="title">WordPress Theme and <br /> Plugin Development</h3>
               <p>
                  Dedicated WordPress developers are here to help you in creating pixel-perfect, user-friendly themes by
                  following current trends in the industry. Create custom plugins to extend your app's
                  features/functionalities.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/woocommerce-development.svg"
                     type="image/svg+xml"></object>
               </span>
               <h3 class="title">WooCommerce <br /> Development</h3>
               <p>
                  Build an on-demand, result-driven WooCommerce online store with a top WordPress development company.
                  We help you to create sites that assist your prospects through each step of your conversion path.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                  <object data="images/icons/api-integration-and-customization.svg" type="image/svg+xml"></object>
               </span>
               <h3 class="title">API Integration and <br /> Customization</h3>
               <p>
                  Mobile-First update of Google is being the game-changer in online world. Websites need to cope with
                  this kind of change and seamless data synchronization, API integration makes it happen.
               </p>
            </div>
         </div>
      </div>
      <div class="mt-lg-5 text-center">
         <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire WordPress Developers
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
                  eLuminous to Hire WordPress<br />
                  Developers?
               </h2>
               <p>Hire WordPress developers with flexible engagement models like full-time, part-time, or Adhoc
                  basis as per your business need.</p>
               <p class="btnTitle">Let’s innovate together.</p>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire WordPress Developers
               </a>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="img">
               <img src="images/hire-wordpress.webp" alt="Hire WordPress" class="img-fluid" />
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
                  <span><object data="images/icons/tested-process.svg"
                        type="image/svg+xml"></object></span>
                  <h3 class="title">100% Tested <br /> Process</h3>
                  <p>Hands-on experience in building rich applications. We use Rest APIs for integration with ERP/SAP.</p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/seo-friendly-apps.svg"
                        type="image/svg+xml"></object></span>
                  <h3 class="title">SEO-friendly <br /> Apps</h3>
                  <p>
                  We create Websites indexable and visible to Search Engines. We deploy best code practices to develop Google-friendly apps.
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


<!-- Case Study Start -->
<section class="caseStudies pt-0">
  <div class="case_studies">
    <div class="container">
      <h2 class="title">Case Studies</h2>
      <div class="row justify-content-center caseStudiesRow">
        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
          <div class="card white whiteBg">
            <div class="imgWrap">
              <img
                src="images/front-end-development.webp"
                alt="Partnering Front-end Development"
                class="img-fluid"
              />
            </div>
            <div class="text">
              <h4 class="title">
                Partnering Front-end Development
              </h4>
              <p>
                eLuminous reduced the cost of development by 45% and reduced
                time-to-market by 20% for a European Digital Marketing Agency as
                part of their IT process standardization.
              </p>
              <a
                href="images/frontend-development.pdf"
                class="btn"
                target="_blank"
                >Download PDF</a
              >
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
          <div class="card white whiteBg">
            <div class="imgWrap">
              <img
                src="images/FDA-compliant-eCommerce.webp"
                alt="Getting FDA compliant eCommerce ready within 90 days"
                class="img-fluid"
              />
            </div>
            <div class="text">
              <h4 class="title">
                Developed FDA compliant <br />
                eCommerce platform in 90 days
              </h4>
              <p>
                UK based Client baby care brand wanted to develop new markets
                for their expansion. They wanted to develop the abilities to
                sell through new geographies i.e. Europe and USA.
              </p>
              <a
                href="images/Getting-FDA-compliant-eCommerce-ready-within-90days.pdf"
                class="btn"
                target="_blank"
                >Download PDF</a
              >
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
          <div class="card white whiteBg">
            <div class="imgWrap">
              <img
                src="images/ui-using-react-js.webp"
                alt="Food delivery app with user friendly UI using ReactJS"
                class="img-fluid"
              />
            </div>
            <div class="text">
              <h4 class="title">
                Food delivery app with user friendly UI using ReactJS
              </h4>
              <p>
                Client offers a platform for home chefs and diners to provide a
                clean hygienic home cooked meal experience. The client
                represents a new age startup.
              </p>
              <a
                href="images/Food-delivery-app-with-user-friendly-UI-using-React-js.pdf"
                class="btn"
                target="_blank"
                >Download PDF</a
              >
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
          <div class="card white whiteBg">
            <div class="imgWrap">
              <img
                src="images/eLearning-management-solution.webp"
                alt="eLearning Management Solution
                      for CLE (Continuing Legal Education)"
                class="img-fluid"
              />
            </div>
            <div class="text">
              <h4 class="title">
                eLearning Management Solution for CLE
              </h4>
              <p>
                CLE course certificates are essentials for the Lawyers as a
                mandatory legal compliance. Hence, the key requirement was to
                generate course completion certificates based on the User's time
                zone.
              </p>
              <a
                href="images/eLearning-managemen-t-solution-for-CLE.pdf"
                class="btn"
                target="_blank"
                >Download PDF</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Case Study End -->

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
                     What is WordPress and Why it is used?
                  </button>
               </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     WordPress is basically CMS (Content Management System) which allows you to build and host websites.
                     It has a huge number of plugins that allows customization for any kind of website like blogs,
                     online store,etc.
                  </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingTwo">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                     aria-expanded="false" aria-controls="collapseTwo">
                     How to choose a reliable WordPress development company?
                  </button>
               </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     Here is the checklist to go for a reliable WordPress development company:</p>
                  <ul class="mb-2">
                     <li>Check for reviews on Clutch, GoodFirms, Google </li>
                     <li>Clear Communication </li>
                     <li>Understanding of the Project </li>
                     <li>Check Quality of Code </li>
                     <li>Work Transparency</li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingThree">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                     aria-expanded="false" aria-controls="collapseThree">
                     What does WordPress Developer do?
                  </button>
               </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
               <div class="card-body">
                  <p>
                  WordPress developers do front-end and back-end development, create plugins and themes for specific business needs. They help you to build SEO friendly websites to make your business visible in Google's Eye.
                  </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFour">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                     aria-expanded="false" aria-controls="collapseFour">
                     Is Wix or WordPress is better?
                  </button>
               </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
               <div class="card-body">
                  <p>WordPress is all time better option than Wix. Though Wix is an easy-to-use website builder, WordPress offers extensive features and customization for any business. </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFive">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                     aria-expanded="false" aria-controls="collapseFive">
                     What can be WordPress used for?
                  </button>
               </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
               <div class="card-body">
                  <p>You can use WordPress to create blogs, eCommerce stores, social networks, forums, clone themes, job portals and many more.</p>
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
                           <input type="hidden" name="hire_for" value="Wordpress" />
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