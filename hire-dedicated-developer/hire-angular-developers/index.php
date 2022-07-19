<?php
//include(dirname(dirname(dirname(__FILE__))).'/includes/constant.php');

//echo PATH; die;
date_default_timezone_set("Asia/Calcutta");    
ini_set('default_charset', 'utf8');
   $pagename = "dedicated-developer";
   $pagename1 = "hire-angular-developers";
   $keywords = "hire angular developers, hire angularjs developers,dedicated angular developers";//Put keywords here
   $pageTitle = "Hire Angular Developers | Hire AngularJS Developers"; //Put page title here
   $metaDesc = "Hire Angular Developers to have seamless visulizations across all devices and help you to build high performace scalable apps to enhance productivity by 70%."; //Put meta description here
   
require_once(dirname(dirname(__DIR__)).'/include/header-docs.php');
include_once(PATH."/connection.php");

// require_once('../includes/head.php');
// require_once('../include/header.php');
//echo $_SERVER['DOCUMENT_ROOT'];


//require_once('../../../include/header-doc-new.php');

require_once(PATH.'/include/header-links.php');
require_once('includes/header.php');
require_once(PATH.'/include/header-menu.php');

$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

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
          <img
            src="images/hire-angular-developers.webp"
            alt="Hire Angular Developers"
            class="img-fluid"
          />          
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
              "When they start a project, they eagerly try to complete it to the best of their abilities."
            </p>
          </div>
          <ul class="list">
            <li>
              <span>
                <div class="icon">
                  <object
                    data="images/icons/cross-platform.svg"
                    type="image/svg+xml"
                    class="icon"
                  ></object>
                </div>
                <div class="text">
                  Cross Platform
                </div>
              </span>
            </li>
            <li>
              <span>
                <div class="icon speedometer">
                  <object
                    data="images/icons/speed-&-performance.svg"
                    type="image/svg+xml"
                    class="icon"
                  ></object>
                </div>
                <div class="text">
                  Speed & Performance
                </div>
              </span>
            </li>
            <li>
              <span>
                <div class="icon group">
                  <object
                    data="images/icons/user-friendly.svg"
                    type="image/svg+xml"
                    class="icon"
                  ></object>
                </div>
                <div class="text">
                User friendly
                </div>
              </span>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="text">
          <h1 class="title blue fw900 text-capitalize">
            Hire Angular
            <span class="blackTurmeric fw400 d-block text-uppercase"
              >Developers</span
            >
          </h1>
          <h2 class="subTitle">Best UI Award Winners are here to help You!</h2>
          <h3 class="subSubTitle">
            Hire angular developers to have seamless visualization across all
            devices. Our angular developers build high-performance and scalable
            apps which enhance your productivity by 70%.
          </h3>
          <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire Angular Developer
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
    <h2 class="title">Hire Angular Developers with Expertise in</h2>
    <h3 class="subTitle">
      Hire angular developers to build robust, secured, dynamic web and mobile
      applications saving up to 63% of your development cost.
    </h3>
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="box">
          <span
            ><object
              data="images/icons/custom-angular-development.svg"
              type="image/svg+xml"
            ></object
          ></span>
          <h3 class="title">
            Custom Angular <br />
            Development
          </h3>
          <p>
            Hire dedicated angular developers who are expert in creating clean
            and interactive UI/UX to build credibility and flawless
            user-experience across all devices. We create real time apps like
            Chat Apps and Insant Messengers with AngularFire or Socket.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="box">
          <span
            ><object
              data="images/icons/enterprise-angular-web-apps.svg"
              type="image/svg+xml"
            ></object
          ></span>
          <h3 class="title">Enterprise Angular <br />Web Apps</h3>
          <p>
            Our angularjs developers build large-scale web applications by
            providing end-to-end services right from consulting, development,
            migration, maintenance to upgradation. We offer advanced Angular API
            services as per specific business needs.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="box">
          <span
            ><object
              data="images/icons/angular-consulting.svg"
              type="image/svg+xml"
            ></object
          ></span>
          <h3 class="title">Angular <br />Consulting</h3>
          <p>
            Our angular developers and consultants can help you in organizing
            your Angular project structure using TypeScripts, Angular CLI,
            managing environment-specific settings and many more.
          </p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="box">
          <span
            ><object
              data="images/icons/updated-with-technology-trends.svg"
              type="image/svg+xml"
            ></object
          ></span>
          <h3 class="title">Updated with<br />Technology Trends</h3>
          <p>
          Angular developers use <b>SSR</b> to make your app <b>SEO friendly</b> and help you to be visible in Google's eye.
          </p>
        </div>
      </div>
    </div>
    <div class="mt-lg-5 text-center">
      <a href="#contact-form-top" class="btn borderBtn scroll_form">
        Hire Angular Developer
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
            eLuminous to Hire Angular<br />
            Developers?
          </h2>
          <p>
            Our angular developers are proficient in building highly scalable
            apps to meet your business needs with evolving market around.
          </p>
          <p class="btnTitle">Let’s innovate together.</p>

          <a href="#contact-form-top" class="btn borderBtn scroll_form">
            Hire Angular Developer
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="img">
          <img src="images/hire-angular.webp" alt="Hire Angular" class="img-fluid" />
        </div>
      </div>
    </div>
    <div class="bottomWrapper">
      <div class="row">
        <div class="col-sm-6 col-lg-3 d-flex">
          <div class="box">
            <span
              ><object
                data="images/icons/trusted-by-people-like-you.svg"
                type="image/svg+xml"
              ></object
            ></span>
            <h3 class="title">Trusted by People <br />Like You!</h3>
            <p>
              Best UI Winner and many 5 Star Reviews on
              <b>Clutch, GoodFirms, Google.</b>
            </p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
          <div class="box">
            <span
              ><object
                data="images/icons/api-on-top-approach.svg"
                type="image/svg+xml"
              ></object
            ></span>
            <h3 class="title">API-On-Top <br />Approach</h3>
            <p>We build exclusive front-end without hampering backend.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
          <div class="box">
            <span
              ><object
                data="images/icons/tested-process.svg"
                type="image/svg+xml"
              ></object
            ></span>
            <h3 class="title">100% Tested<br />Process</h3>
            <p>
              We use manual and automated testing having multiple real in-house
              devices.
            </p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3 d-flex">
          <div class="box">
            <span
              ><object
                data="images/icons/seo-friendly-apps.svg"
                type="image/svg+xml"
              ></object
            ></span>
            <h3 class="title">SEO-friendly <br />Apps</h3>
            <p>
              Angular developers use SSR to make your app SEO friendly and help you to be visible in Google's eye.
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
                <span class="project_heading"
                  >Great Reviews on Clutch and GoodFirms</span
                >
                <p>
                  "The workflow between both teams has always been open,
                  streamlined, and responsive."
                </p>
                <div class="reviewer common">
                  <div class="topNew">
                    <span class="project_heading subTitleLine"
                      >the reviewer</span
                    >
                    <div class="profile">
                      <div class="img">
                        <span class="img_circle"
                          ><img src="images/Stewart-Gauld.webp" alt="Stewart Gauld" />
                      </span>
                        <div class="nameDetailsWrap">
                          <span class="name">Stewart H. Gauld</span>
                          <span class="nameDetails"
                            >Project & Content Director, <br />
                            Business Development Group</span
                          >
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
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
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
                <span class="project_heading"
                  >Great Reviews on Clutch and GoodFirms</span
                >
                <p>
                  "They were very fast, and the team is big enough to tap on
                  each other's expertise."
                </p>
                <div class="reviewer common">
                  <div class="topNew">
                    <span class="project_heading subTitleLine"
                      >the reviewer</span
                    >
                    <div class="profile">
                      <div class="img">
                        <span class="img_circle"
                          >
                        <img src="images/Yeng-Hwee-Tay.webp" alt="Yeng Hwee Tay" />
                      </span>
                        <div class="nameDetailsWrap">
                          <span class="name">Yeng Hwee Tay</span>
                          <span class="nameDetails"
                            >Director, ClickTwoStart</span
                          >
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
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
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
                <span class="project_heading"
                  >Great Reviews on Clutch and GoodFirms</span
                >
                <p>
                  eLuminous dedicated a project manager to our project who had
                  excellent communication skills.
                </p>
                <div class="reviewer common">
                  <div class="topNew">
                    <span class="project_heading subTitleLine"
                      >the reviewer</span
                    >
                    <div class="profile">
                      <div class="img">
                        <span class="img_circle"
                          >
                        <img src="images/Steve-Lim.webp" alt="Steve Lim" />
                      </span>
                        <div class="nameDetailsWrap">
                          <span class="name">Steve Lim</span>
                          <span class="nameDetails"
                            >Managing Director, Web Design &amp; Development
                            Agency</span
                          >
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
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
                    </li>
                    <li>
                      <object
                        data="images/icons/redstar.svg"
                        type="image/svg+xml"
                      ></object>
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
                part of their IT process stanardization.
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
                Food delivery app with user friendly UI using ReactJs
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
            <button
              class="btn-link"
              data-toggle="collapse"
              data-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne"
            >
            What is AngularJS used for?
            </button>
          </h5>
        </div>

        <div
          id="collapseOne"
          class="collapse show"
          aria-labelledby="headingOne"
          data-parent="#accordion"
        >
          <div class="card-body">
            <p>
            AngularJS is a framework used to build dynamic web applications. It allows angular developers to use HTML as a template language and extension of HTML's syntax to clearly express your application's components. Data binding and dependency injection eliminates the requirement of writing code you would have to write otherwise.
            </p>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button
              class="btn-link collapsed"
              data-toggle="collapse"
              data-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo"
            >
            Why Choose AngularJS for Web Application Development?
            </button>
          </h5>
        </div>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordion"
        >
          <div class="card-body">
            <p>
            AngularJS provides dynamic features and exclusive advantages that make it stand out from other frameworks. It put forward an agile web app development process that is highly efficient in saving both time and cost required to complete the entire web app development process. It facilitates complete assistance in the entire process and offers features such as dependency injection, parallel development, simple architecture, and testing.
            </p>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button
              class="btn-link collapsed"
              data-toggle="collapse"
              data-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree"
            >
            What are the advantages of AngularJS?
            </button>
          </h5>
        </div>
        <div
          id="collapseThree"
          class="collapse"
          aria-labelledby="headingThree"
          data-parent="#accordion"
        >
          <div class="card-body">
            <ul>
              <li><b>Open Source:</b> Angularjs is an open-source JavaScript MVC framework, therefore, custom applications can be available to anyone at an affordable cost.</li>
              <li><b>Google-supported framework:</b> AngularJS is supported by a large community, Google. The framework has around 45k stars on <a href="https://github.com/angular/angular" target="_blank">Github</a> and over 500.000 downloads on weekly basis from <a href="https://www.npmjs.com/package/angular" target="_blank">npm</a>.</li>
              <li><b>Single page application (SPA):</b> Single page application means only a single HTML web page is loaded and further updation is done on the same page only. User-friendliness and fast loading are the key features for SPA.</li>
            </ul>            
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
            <button
              class="btn-link collapsed"
              data-toggle="collapse"
              data-target="#collapseFour"
              aria-expanded="false"
              aria-controls="collapseFour"
            >
            Is Angular good for large applications?
            </button>
          </h5>
        </div>
        <div
          id="collapseFour"
          class="collapse"
          aria-labelledby="headingFour"
          data-parent="#accordion"
        >
          <div class="card-body">
          <p>You know the customers need to wait for content to load while connecting with large-scale/enterprise applications.  Angular is the best choice to make it faster loading and seamless visualizations across all devices.</p>
          <p><b>Big Tech-Giants, who are using Angular?</b></p>
            <ul>
              <li>Gmail</li>
              <li>Forbes</li>
              <li>Google</li>
              <li>IBM</li>
              <li>Paypal</li>
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
          <img
            src="images/let's-talk.webp"
            class="img-fluid"
            alt="Contact Us eLuminous"
          />
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center">
        <div id="contact-form-top" class="contact-form-top">
          <h2 class="text-center black title">LET’S tALK</h2>
          <h4 class="text-center black subTitle">
            Ready to create an unique experience? Let's get in touch!
          </h4>
          <form action="" method="post" class="form" id="planForm">
            <input
              type="text"
              name="formType"
              id="formType"
              class="form-control"
              value="laravelDeveloper"
              style="display: none;"
            />
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    name="name"
                    id="full_name"
                    class="form-control"
                    placeholder="Full Name"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    name="company_name"
                    id="company_name"
                    class="form-control"
                    placeholder="Company Name"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    placeholder="Email"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    maxlength="11"
                    onkeydown="return checkPhoneKey(event.key)"
                    name="number"
                    id="number"
                    class="form-control"
                    placeholder="Mobile Number"
                  />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <textarea
                    class="form-control"
                    placeholder="Requirement (Optional)"
                    rows="5"
                    name="comment"
                    id="comment"
                  ></textarea>
                </div>
              </div>
              <div class="col-sm-7">
                <?php /*<div class="form-group captchWrapper">
                  <!-- dev<div class="g-recaptcha brochure__form__captcha"
                  data-sitekey="6Lcwm3UdAAAAAFfjQx3yBUSEeD3pIajyuAUvrvXn"></div> -->
                  <!-- dev15march2022 <div class="g-recaptcha brochure__form__captcha"
                  data-sitekey="6Lcwm3UdAAAAAFfjQx3yBUSEeD3pIajyuAUvrvXn"></div> --->
                  <!---live--->
                  <!-- <div
                    class="g-recaptcha brochure__form__captcha"
                    data-sitekey="6LfDwH8dAAAAAGzHuSNarOff5AgST92CU2atMgS-"
                  ></div> -->
                  <!--local <div class="g-recaptcha brochure__form__captcha"
                  data-sitekey="6LcDm38dAAAAALzKtz_Kuzw5rEV7IW-mPRNVmKIW"></div>-->
                  <!-- <div class="errorCap" style="color: red;"></div> -->
                </div> */?>
                <div class="row align-items-center captchaWrapper">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mobile-space mt-sm-0">
                    <label for="search" class="visuallyhidden">Question: </label>
                    <input type="text" class="change-design form-control" id="cptchaQues" readonly name="cptchaQues" value="<?php echo $newCptcha; ?>">
                  </div>

                  <div class="input_white_bg col-xs-12 col-sm-6 col-md-6 col-lg-6 m-sm-0 mobile-space">
                    <label for="search" class="visuallyhidden">Answer: </label>
                    <input type="text" class="form-control border-0" name="captchaAnswer" id="captchaAnswer" value="">
                  </div>
                  <div class="contact-form-error-message new-massage col-md-12 p-0">
                    <span class="angularPageCorrectCaptcha"></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group red_btn text-md-right">
                  <button
                    class="btn"
                    name="submit"
                    type="submit"
                    id="make_proposal"
                  >
                    SUBMIT
                  </button>
                  <input
                    type="hidden"
                    name="page_url"
                    value="<?php echo $_SESSION['REQUEST_URI'];?>"
                  />
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

