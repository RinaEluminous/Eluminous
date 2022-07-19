<?php
//include('../includes/constant.php');

date_default_timezone_set("Asia/Calcutta");    
ini_set('default_charset', 'utf8');
// include_once("../connection.php");
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

$pagename = "dedicated-developer";
$pagename1 = "hire-laravel-developers";

$keywords = "hire laravel developers, hire laravel developer, hire dedicated laravel developers, laravel development company, laravel developers for hire";//Put keywords here
$pageTitle = "Hire Laravel Developers | Hire Dedicated Laravel Developers"; //Put page title here
$metaDesc = "Hire Laravel Developers of silicon valley competence and can help you in creating feature-rich, dynamic, scalable web applications to drive your business towards the goals."; //Put meta description here
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
               <img src="images/hire-laravel-developers.webp" alt="Hire Laravel Developers" class="img-fluid" />
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
                     "The team has a positive attitude and they truly align with our business"
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
                  Hire Laravel
                  <span class="blackTurmeric fw400 d-block text-uppercase">Developers</span>
               </h1>
               <h2 class="subTitle">Hire Laravel Developers of Silicon Valley competence in 2022!</h2>
               <h3 class="subSubTitle">
                  Hire Laravel Developers to build dynamic, feature-rich, scalable, and secured web applications. We are
                  here to assist you in hiring the right talent with an extensive screening process.</h3>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire Laravel Developer
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
      <h2 class="title">Hire Laravel Developers with Expertise in</h2>
      <h3 class="subTitle">
         Our dedicated laravel developers who are helping fortune 500 companies and have strong working experience in
         PHP frameworks.
      </h3>
      <div class="row">
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span><object data="images/icons/extra-projects-with-tight-deadlines.svg"
                     type="image/svg+xml"></object></span>
               <h3 class="title">
                  Custom Laravel<br />
                  Development
               </h3>
               <p>
                  Get fully customized modern laravel development environment to create an exceptional web app by hiring
                  laravel developers from eLuminous Technologies. Save 60% of the development cost and start 2 weeks
                  risk-free trial
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                 <img src="images/icons/laravel-extension-development.webp" alt="Laravel Extension Development" />
                  <!-- <object data="images/icons/laravel-extension.svg" type="image/svg+xml"></object> -->
                    </span>
               <h3 class="title">Laravel Extension<br />Development</h3>
               <p>
                  Hire laravel developers that perfectly match with your business needs. With profound technical
                  experience, our team offers high-end, feature-rich extensions.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                 <!-- <img src="images/icons/custom-laravel-api-development.webp" alt="Custom Laravel API Development" /> -->
                 <object data="images/icons/custom-laravel-api-development.svg" type="image/svg+xml"></object>
              </span>
               <h3 class="title">Custom Laravel <br />API Development</h3>
               <p>
               We are skilled in building secure, robust API Development to provide access to your data for iOS and Android mobile applications.
               </p>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="box">
               <span>
                 <img src="images/icons/laravel-maintainance-and-support.webp" alt="Laravel Maintenance and Support" />
                 <!-- <object data="images/icons/developers-shortage-on-the-local-market.svg"
                     type="image/svg+xml"></object> -->
                    </span>
               <h3 class="title">Laravel Maintenance<br />and Support</h3>
               <p>
                  Our responsive dedicated laravel developers offer pre and post-maintenance and support services right
                  from overseeing security, server updates, periodic backups and quick bug fixing, etc.
               </p>
            </div>
         </div>
      </div>
      <div class="mt-lg-5 text-center">
         <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire Laravel Developer
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
                  eLuminous to Hire Laravel<br />
                  Developers?
               </h2>
               <p>
                  With the team of average 4-5 years of experience in laravel development, CMMI Level 5 Certified
                  Company ensure to achieve your business goals.
               </p>
               <p class="btnTitle">Let’s innovate together.</p>
               <a href="#contact-form-top" class="btn borderBtn scroll_form">
                  Hire Laravel Developer
               </a>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="img">
               <img src="images/hire-laravel.webp" alt="Hire Laravel" class="img-fluid" />
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
                     Best of App Development Winner and many 5 Star Reviews on <b>Clutch, GoodFirms and Google.</b>
                  </p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/escape-sourcing.svg" type="image/svg+xml"></object></span>
                  <h3 class="title">Escape <br />Sourcing</h3>
                  <p>Get rid of the long and tedious process of sourcing candidates to find the best fit.</p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/updated-with-technology-trends.svg" type="image/svg+xml"></object></span>
                  <h3 class="title">Updated with<br />Technology Trends</h3>
                  <p>Our dedicated laravel developers have built custom solutions using <b>Laravel-Vue, Laravel-Angular, Laravel-React</b> combination</p>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 d-flex">
               <div class="box">
                  <span><object data="images/icons/no-overhead-cost.svg" type="image/svg+xml"></object></span>
                  <h3 class="title">No Overhead <br />Cost</h3>
                  <p>
                     Payroll, taxes, sick leaves and vacations for your team - We have got you covered
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
                     <img src="images/front-end-development.webp" alt="Partnering Front-end Development"
                        class="img-fluid" />
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
                     <a href="images/frontend-development.pdf" class="btn" target="_blank">Download PDF</a>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
               <div class="card white whiteBg">
                  <div class="imgWrap">
                     <img src="images/FDA-compliant-eCommerce.webp"
                        alt="Getting FDA compliant eCommerce ready within 90 days" class="img-fluid" />
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
                     <a href="images/Getting-FDA-compliant-eCommerce-ready-within-90days.pdf" class="btn"
                        target="_blank">Download PDF</a>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
               <div class="card white whiteBg">
                  <div class="imgWrap">
                     <img src="images/ui-using-react-js.webp"
                        alt="Food delivery app with user friendly UI using ReactJS" class="img-fluid" />
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
                     <a href="images/Food-delivery-app-with-user-friendly-UI-using-React-js.pdf" class="btn"
                        target="_blank">Download PDF</a>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-3 col-xl-3 d-flex">
               <div class="card white whiteBg">
                  <div class="imgWrap">
                     <img src="images/eLearning-management-solution.webp" alt="eLearning Management Solution
                      for CLE (Continuing Legal Education)" class="img-fluid" />
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
                     <a href="images/eLearning-managemen-t-solution-for-CLE.pdf" class="btn" target="_blank">Download
                        PDF</a>
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
                     How much does it cost to Hire Laravel Developers?
                  </button>
               </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     The average cost to hire a laravel developer varies from $18 - $25 based on the working experience
                     of the candidate required for your project execution.
                  </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingTwo">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                     aria-expanded="false" aria-controls="collapseTwo">
                     Can we use Laravel to create a scalable app?
                  </button>
               </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     With built-in support for cloud storage, caching, and session drivers, Laravel can definitely use
                     to develop scalable applications. This whole package helps to build from scratch whether it may be
                     a simple website or large scale applications
                  </p>

                  <ul>
                     <li>Facebook</li>
                     <li>Netflix</li>
                     <li>Salesforce</li>
                     <li>Flipboard</li>
                     <li>Instacart</li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingThree">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                     aria-expanded="false" aria-controls="collapseThree">
                     Can we develop mobile apps using Laravel?
                  </button>
               </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
               <div class="card-body">
                  <p>
                     Yes, with stateless Client-Server API. You can serve the backend of your mobile application with a
                     Laravel app, and then create APIs for your client apps(Android and iOS) to consume.</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFour">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"
                     aria-expanded="false" aria-controls="collapseFour">
                     Why Laravel is So Popular?
                  </button>
               </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
               <div class="card-body">
                  <div class="row">
                    <div class="col-lg-9 d-flex flex-column justify-content-center">
                      <p>With over 60,000 stars on GitHub, Laravel’s popularity is already on the rise. Have a look at the
                      following Key Points:</p>
                    <ul>
                      <li>Faster Time-To-Market</li>
                      <li>Better Authentication and Authorization Options</li>
                      <li>Automated Task Execution and Scheduling</li>
                      <li>Automated and Unit Testing Feature</li>
                      <li>Traffic Handling</li>
                    </ul>
                    </div>
                    <div class="col-lg-3">
                  <div class="graph_img">
                     <img
                        src="<?php echo 'http://'.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'].'/images/top-php-frameworks.webp'; ?>"
                        alt="react-gragh" class="w-100">
                  </div>
                    </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-header" id="headingFive">
               <h5 class="mb-0">
                  <button class="btn-link collapsed" data-toggle="collapse" data-target="#collapseFive"
                     aria-expanded="false" aria-controls="collapseFive">
                     Which are the Top Websites Built With Laravel?
                  </button>
               </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
               <div class="card-body">
                  <ul class="top__website__list">
                     <li>
                        <span class="img"><img src="images/icons/disney.webp" alt="Disney" /></span>
                        <span class="text">Disney</span>
                     </li>
                     <li>
                        <span class="img"><img src="images/icons/NYT.webp" alt="The New York Times" /></span>
                        <span class="text">The New York Times</span>
                     </li>
                     <li>
                        <span class="img"><img src="images/icons/warner-bros-removebg-preview.webp" alt="Warner Bros" /></span>
                        <span class="text">Warner Bros</span>
                     </li>
                     <li>
                        <span class="img"><img src="images/icons/St.-Jude-Children’s-Research-Hospital.webp" alt="St. Jude Children’s Research Hospital" /></span>
                        <span class="text">St. Jude Children’s Research Hospital</span>
                     </li>
                  </ul>
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