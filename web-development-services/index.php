<?php
date_default_timezone_set("Asia/Calcutta");    
// include_once("../connection.php");
require_once('includes/header.php');
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
$status = 'error';



?>
<!-- Home Banner Section Start -->
<section class="banner home_banner_img home_banner">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                <div class="text white">
                    <h4 class="fw_400">Team Augmentation:</h4>
                    <h1 class="title white">
                        <span class="fw_400">Scale-up Your Business by Hiring</span>
                        <span class="blue fw_700 d-block">Dedicated Developers</span>
                    </h1>
                    <div class="why_us tech_stack p-0">
                <ul class="list">
                    <li><h5>User-Friendly Interfaces</h5></li>
                    <li><h5>Clean Code and APIs</h5></li>
                    <li><h5>Cross Browser Compatibility </h5></li>
                    <li><h5>Result Oriented Development</h5></li>
                    <li><h5>Expertise with React js, Angular js and Vue js </h5></li> 
                </ul>
                    </div>
                    <h6 class="blue">Skills, Processes with Integrity</h6>
                    <h4 class="fw_600">For Startups, Agencies, Enterprises</h4>
                    <ul class="bottom_img_list">
                        <li><img src="images/icons/leafe-left.png" alt="" /></li>
                        <li><img src="images/clutch.png" alt="" /></li>
                        <li><img src="images/goodfirms.png" alt="" /></li>
                        <li><img src="images/icon-3.png" alt="" /></li>
                        <li><img src="images/icons/leafe-right.png" alt="" /></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="contact-form-top" id="contact-form-top">
                    <h2>Get in Touch Now</h2>

                    <form action="" method="post" class="form" id="planForm">
                        <input type="text" name="formType" id="formType" class="form-control" value="laravelDeveloper"
                            style="display: none;" />
                        <div class="form-group">
                            <input type="text" name="name" id="full_name" class="form-control"
                                placeholder="Full Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" name="company_name" id="company_name" class="form-control"
                                placeholder="Company Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" maxlength="11" onkeydown="return checkPhoneKey(event.key)" name="number"
                                id="number" class="form-control" placeholder="Mobile Number" />
                        </div>
                        <!-- <div class="form-group">
                            <input type="text" name="skype_id" id="skype_id" class="form-control " placeholder="Skype ID">
                        </div> -->
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Requirement (Optional)" rows="5" name="comment"
                                id="comment"></textarea>
                        </div>
                        <div class="form-group">
                        <!-- dev<div class="g-recaptcha brochure__form__captcha"
                            data-sitekey="6Lcwm3UdAAAAAFfjQx3yBUSEeD3pIajyuAUvrvXn"></div> -->
                            <div class="g-recaptcha brochure__form__captcha"
                            data-sitekey="6LfDwH8dAAAAAGzHuSNarOff5AgST92CU2atMgS-"></div>
                            <!--local <div class="g-recaptcha brochure__form__captcha"
                            data-sitekey="6LcDm38dAAAAALzKtz_Kuzw5rEV7IW-mPRNVmKIW"></div>-->
                            <div class="errorCap" style="color: red;"></div> 
                        </div>
                        <div class="form-group red_btn mt-4">
                            <button class="btn" name="submit" type="submit" id="make_proposal">SUBMIT</button>
                            <input type="hidden" name="page_url" value="<?php echo $_SESSION['REQUEST_URI'];?>" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Banner Section End -->

<!-- Blue Section Start -->
<section class="blue_bg white blue_section_list">
    <div class="container">
        <ul class="row justify-content-center">
            <li class="col-sm-5 col-md-4 col-lg-4">
                <img src="images/icons/tick.png" alt="" />
                <span>Boost Your Development <br />Speed: Flexi-Scaling</span>
            </li>
            <li class="col-sm-5 col-md-4 col-lg-4">
                <img src="images/icons/tick.png" alt="" />
                <span>Get Full Control <br />Over Development</span>
            </li>
            <li class="col-sm-5 col-md-4 col-lg-4">
                <img src="images/icons/tick.png" alt="" />
                <span>Your Own IP <br />
                    Rights</span>
            </li>
        </ul>
    </div>
</section> 

<section class="testimonials blue_light_bg">
    <div class="container">
        <h2 class="title text-center">Customer Testimonials</h2>
        <h6 class="sub_title text-center">
            We are favourite Front End and Custom Development Partner!
        </h6>
        <div id="review_slider" class="review_slider owl-carousel">
            <div class="box">
                <div class="review common">
                    <div class="top">
                        <div class="left">
                            <span class="project_heading">the review</span>
                            <p>"The workflow between both teams has always been open, streamlined, and responsive."</p>
                            <p class="date">Dec 2, 2020</p>
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
                                <li>Schedule: <span>5.0</span></li>
                                <li>Cost: <span>4.5</span></li>
                                <li>Willing to refer: <span>5.0</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="reviewer common">
                    <div class="top">
                        <span class="project_heading">the reviewer</span>
                        <h6 class="heading">
                        Project & Content Director, Business Development Group
                        </h6>
                        <div class="profile">
                            <div class="img">
                                <span class="img_circle"><img src="images/icons/user-profile.png"
                                        alt="user icon"></span>
                                <span class="name">Stewart H. Gauld</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <!-- 2 Number Testimonial -->
            <div class="box">
                <div class="review common">
                    <div class="top">
                        <div class="left">
                            <span class="project_heading">the review</span>
                            <p>"They were very fast, and the team is big enough to tap on each other's expertise."</p>
                            <p class="date">May 1, 2021</p>
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
                <div class="reviewer common">
                    <div class="top">
                        <span class="project_heading">the reviewer</span>
                        <h6 class="heading">
                        Director, ClickTwoStart 
                        </h6>
                        <div class="profile">
                            <div class="img">
                                <span class="img_circle"><img src="images/icons/user-profile.png"
                                        alt="user icon"></span>
                                <span class="name">Yeng Hwee Tay</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3 Number Testimonial -->
            <div class="box">
                <div class="review common">
                    <div class="top">
                        <div class="left">
                            <span class="project_heading">the review</span>
                            <p>eLuminous dedicated a project manager to our project who had excellent communication
                                skills.</p>
                            <p class="date">Mar 17, 2021</p>
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
                <div class="reviewer common">
                    <div class="top">
                        <span class="project_heading">the reviewer</span>
                        <h6 class="heading">
                            Managing Director, Web Design &amp; Development Agency
                        </h6>
                        <div class="profile">
                            <div class="img">
                                <span class="img_circle"><img src="images/icons/user-profile.png"
                                        alt="user icon"></span>
                                <span class="name">Steve Lim</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Testimonials Section End -->

<!-- Tech Stack Section Start -->
<section class="tech_stack">
    <div class="container">
        <h2 class="title text-center">Tech Stack</h2>
        <h6 class="sub_title mb-1 text-center">Technologies We Work With</h6>
        <h6 class="sub_title second  text-center">Hire dedicated developers as per your business needs to stay forefront <br /> of
            the application development innovation.</h6>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-xl-5">
                <ul class="list mt-0">
                    <li>
                        <h5>Front-end</h5>
                        <p>Angular, React JS, Vue JS, HTML5, CSS3</p>
                    </li>
                    <li>
                        <h5>Back-end</h5>
                        <p>.Net, Node, PHP, Python, Java</p>
                    </li>
                    <li>
                        <h5>Full Stack</h5>
                        <p>MEAN, MERN</p>
                    </li>
                    <li>
                        <h5>Mobile apps Development</h5>
                        <p>iOS, Android, Flutter, React Native, Hybrid</p>
                    </li>
                    <li>
                        <h5>Collaboration Tools</h5>
                        <p>JIRA, Confluence, Slack, Trello</p>
                    </li>
                    <li>
                        <h5>Data Analytics & BI</h5>
                        <p>QlikView, Pentaho, Power BI, Tableau</p>
                    </li>
                    <li>
                        <h5>Cloud Studio</h5>
                        <p>AWS, Azure, DevOps, Git, Jenkins, Kubernetes, Docker</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-7 col-xl-6 pl-xl-0 d-flex align-items-center">
                <div class="framework_list">
                    <ul>
                        <li><img src="images/angular-react.png" alt="Angular React" /></li>
                        <li><img src="images/html-css.png" alt="HTML CSS" /></li>
                    </ul>
                    <ul>
                        <li>
                            <img src="images/microsoft-cakephp.png" alt="Microsoft Cake PHP" />
                        </li>
                        <li><img src="images/paython-js.png" alt="Paython" /></li>
                        <li><img src="images/php.png" alt="PHP" /></li>
                    </ul>
                    <ul>
                        <li><img src="images/amazon.png" alt="Amazon" /></li>
                        <li><img src="images/azure.png" alt="Azure" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tech Stack Section End -->

<!-- Industries Section Start -->
<section class="industries banner wave_texture_img blue_dark2_bg">
    <div class="container text-center white">
        <h2 class="title">Industries</h2>
        <h6 class="sub_title white">Serving Clients from Distinct Verticals</h6>
        <ul class="industries_list">
            <li>
                <img src="images/icons/healthcare.png" alt="Healthcare" style="max-width: 65px;" />
                <span>Healthcare</span>
            </li>
            <li>
                <img src="images/icons/it-and-consulting.png" alt="IT & Consulting" style="max-width: 67px;" />
                <span>IT & Consulting</span>
            </li>
            <li>
                <img src="images/icons/ecommerce.png" alt="Ecommerce" style="max-width: 72px;" />
                <span>Ecommerce</span>
            </li>
            <li>
                <img src="images/icons/education.png" alt="Education" style="max-width: 61px;" />
                <span>Education</span>
            </li>
            <li>
                <img src="images/icons/retail.png" alt="Retail" style="max-width: 72px;" />
                <span>Retail</span>
            </li>
            <li>
                <img src="images/icons/logistics.png" alt="Logistics" style="max-width: 72px;" />
                <span>Logistics</span>
            </li>
            <li>
                <img src="images/icons/fintech.png" alt="Fintech" style="max-width: 60px;" />
                <span>Fintech</span>
            </li>
        </ul>
    </div>
</section>
<!-- Industries Section End -->

<!-- Why US Section Start -->
<section class="why_us tech_stack blue_light_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 pr-lg-0">
                <div class="img_wrap">
                    <img src="images/why-us.jpg" alt="Why Us" class="img-fluid" />
                    <ul>
                        <li><img src="images/clutch-icon.png" alt="Clutch" /></li>
                        <li><img src="images/goodfirms-icon.png" alt="Goodfirms" /></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7 d-flex flex-column justify-content-center">
                <div class="text_wrap">
                    <h2 class="title">Why Choose <br /> eLuminous Technologies?</h2>
                    <h6 class="sub_title">
                        Get your dedicated team from Clutch-rated Top 100 Web Application Development Company in 2021!
                    </h6>
                    <ul class="list">
                        <li>
                            <h5>Choose from <b>135+ Skilled resources</b></h5>
                        </li>
                        <li>
                            <h5>Choose the most suitable <b>Technical stack</b></h5>
                        </li>
                        <li>
                            <h5><b>Agile-ACP, PMP, AWS</b> Certified developers</h5>
                        </li>
                        <li>
                            <h5>Transparent <b>Billing</b></h5>
                        </li>
                        <li>
                            <h5>5 CoEs for <b>Cutting edge tech</b></h5>
                        </li>
                    </ul>
                    <a href="#contact-form-top" class="btn scroll_form">get in touch</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why US Section End -->

<!-- Engagement Models Section Start -->
<section class="engagement engagement_img banner">
    <div class="container text-center">
        <div class="btn_text">Engagement Models</div class="btn_text">
        <ul class="list">
            <li class="light_red_bg">
                <span class="img"><img src="images/icons/agile-team.png" alt="Agile Team Scrum Manager, Devs, QAs"
                        class="img-fluid" /></span>
                <span class="text"><b>Agile Team</b> <br /> Scrum Manager, <br />Devs, QAs </span>
                <span class="bottom_text">Pay per sprint</span>
                <span class="big_text light_red">01</span>
            </li>
            <li>
                <span class="img"><img src="images/icons/dedicated.png" alt="Dedicated
                    Team" class="img-fluid" /></span>
                <span class="text"><b>Dedicated</b> <br /> Team</span>
                <span class="bottom_text">Get your extended team,
                    scale up faster</span>
                <span class="big_text blue">02</span>
            </li>
            <li class="orange_bg">
                <span class="img"><img src="images/icons/bot.png" alt="BOT" class="img-fluid" /></span>
                <span class="text"><b>BOT</b></span>
                <span class="bottom_text">Build-Operate <br />Transfer</span>
                <span class="big_text orange">03</span>
            </li>
        </ul>
        <h6>We have engagement models to meet your diversified requirement & delivery</h6>
    </div>
</section>
<!-- Home Banner Section End -->

<!-- Case Studies Section Start -->
<section class="case_studies blue_bg">
    <div class="container">
        <h2 class="title text-center white">Case Studies</h2>
        <h6 class="sub_title text-center white">Discover Our Latest Resources</h6>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-lg-5 col-xl-3 d-flex">
                <div class="card">
                    <div class="img_wrap">
                        <img src="images/agile-implementation-for-a.png" alt="Agile implementation for a Tech startup"
                            class="img-fluid" />
                    </div>
                    <div class="text">
                        <h6>Agile implementation for a smart shoes tech start up</h6>
                        <p>Droplabs is a product based funded Startup from California who sell smart sport shoes to all
                            the Fitness Enthusiasts through an online store.
                        </p>
                        <a href="images/agile-implementati-on-for-a-tech-startup.pdf" class="btn"
                            target="_blank">Download PDF</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 col-xl-3 d-flex">
                <div class="card">
                    <div class="img_wrap">
                        <img src="images/FDA-compliant-eCommerce.jpg"
                            alt="Getting FDA compliant eCommerce ready within 90 days" class="img-fluid" />
                    </div>
                    <div class="text">
                        <h6>Getting FDA compliant eCommerce ready within 90 days</h6>
                        <p>
                            UK based Client baby care brand wanted to develop new markets for their expansion. They
                            wanted to develop the abilities to sell through new geographies i.e. Europe and USA.
                        </p>
                        <a href="images/Getting-FDA-compliant-eCommerce-ready-within-90days.pdf" class="btn"
                            target="_blank">Download PDF</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 col-xl-3 d-flex">
                <div class="card">
                    <div class="img_wrap">
                        <img src="images/ui-using-react-js.jpg"
                            alt="Food delivery app with user friendly UI using React js" class="img-fluid" />
                    </div>
                    <div class="text">
                        <h6>Food delivery app with user friendly UI using React js</h6>
                        <p>
                            Client offers a platform for home chefs and diners to provide a clean hygienic home cooked
                            meal experience. The client represents a new age startup.
                        </p>
                        <a href="images/Food-delivery-app-with-user-friendly-UI-using-React-js.pdf" class="btn"
                            target="_blank">Download PDF</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 col-xl-3 d-flex">
                <div class="card">
                    <div class="img_wrap">
                        <img src="images/eLearning-management-solution.jpg" alt="eLearning Management Solution
                        for CLE (Continuing Legal Education)" class="img-fluid" />
                    </div>
                    <div class="text">
                        <h6>eLearning Management Solution for CLE <span>(Continuing Legal Education)</span></h6>
                        <p>
                            CLE course certificates are essentials for the Lawyers as a mandatory legal compliance.
                            Hence, the key requirement was to generate course completion certificates based on the
                            User's time zone.
                        </p>
                        <a href="images/eLearning-managemen-t-solution-for-CLE.pdf" class="btn" target="_blank">Download
                            PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Case Studies Section End -->

<!-- Why US Section Start -->
<section class="get_in_touch top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="text">
                    <h5 class="fw_700 text-center title">We just don't Code, We create an Experience</h5>
                    <!-- <h5>We just don't Code, <span class="blue fw_700">We create an Experience</span></h5> -->
                    <ul id="partner_slider" class="list owl-carousel">
                        <div class="partner_box">
                            <img src="images/trtcle.jpg" alt="Trtcle" />
                        </div>
                        <div class="partner_box">
                            <img src="images/razer.jpg" alt="Razer" />
                        </div>
                        <div class="partner_box">
                            <img src="images/b1g1.jpg" alt="B1G1" />
                        </div>
                        <div class="partner_box">
                            <img src="images/cpenation.jpg" alt="CPE Nation" />
                        </div>
                        <div class="partner_box">
                            <img src="images/simply-landlord.jpg" alt="Simply Landlord" />
                        </div>
                        <div class="partner_box">
                            <img src="images/autohelp.jpg" alt="Auto Help" />
                        </div>
                        <div class="partner_box">
                            <img src="images/snydeo-media.jpg" alt="Snydeo Media" />
                        </div>
                        <div class="partner_box">
                            <img src="images/link11.jpg" alt="Link 11" />
                        </div>
                        <div class="partner_box">
                            <img src="images/colors.jpg" alt="Colors" />
                        </div>
                    </ul>
                </div>
            </div>
            <!-- <div class="col-lg-5 col-md-6">
                <div class="contact-form-top" id="contact-form-top">
                    <h2>Book A Free Consultation</h2>
                    <p>Let's discuss, and create something unique and amazing for your business! Today is the Time!</p>
                    <form action="" method="post" class="form" id="bookForm">
                        <input type="text" name="formType" id="formType" class="form-control " value="laravelDeveloper"
                            style="display: none;">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control " placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control " placeholder="Email">
                        </div>

                        <div class="form-group">
                            <input type="text" name="dateday" id="dateday" placeholder="dd-mm-yyyy"
                                class="form-control">
                            <span id="error_dateday" class="red"></span>
                        </div>
                        <div class="form-group">
                            <span id="datetime"></span>
                        </div>
                       
                        <div class="form-group red_btn mb-0 mt-4">
                            <button class="btn" type="submit" id="make_proposal">Book Now!</button>
                            <input type="hidden" name="page_url" value="<?php echo $_SESSION['REQUEST_URI'];?>">
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
        
        <div class="text-center">
            <a href="#contact-form-top" class="btn scroll_form">get in touch</a>
        </div>
    </div>
</section>


<section class="get_in_touch lets_talks ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text new_project_list_wrap text-center">
                    <!-- <h5 class="text-center">Let’s Talk About your <b>new project</b>, call
                        <a href="tel:+919823074884 " class="blue fw_700 call_contact ">
                            +1 718 838 9981
                        </a>
                    </h5> -->
                    <ul class="new_project_list">
                        <li>
                            <span class="icon"><img src="images/icons/cup.png" alt="Excellence" /></span>
                            <span class="text"><b class="fw_700">19+</b> Years of <br />
                                Excellence</span>
                        </li>
                        <li>
                            <span class="icon"><img src="images/icons/user.png" alt="Professionals" /></span>
                            <span class="text"><b class="fw_700">135+</b> IT <br />
                                Professionals</span>
                        </li>
                        <li>
                            <span class="icon"><img src="images/icons/group.png" alt="Happy Clients" /></span>
                            <span class="text"><b class="fw_700">600+</b> <br />
                                Happy Clients</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Home Banner Section End -->
<?php require_once("includes/footer.php");?>