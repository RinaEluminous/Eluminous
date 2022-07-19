<?php header('Access-Control-Allow-Origin: *');
require_once('./includes/constant.php');
error_reporting(E_ALL); 
ini_set('default_charset', 'utf8');
$pagename = "index";
$pagename1 = " ";
$keywords = "web design & development company, custom mobile app development company, front end development company, business intelligence and data analytics"; //Put keywords here
$pageTitle = "Web Design & Development Company - eLuminous Technologies"; //Put page title here
$metaDesc = "eLuminous Technologies is Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises.We Build Custom Web Design & Development, Mobile, Business Intelligence Solutions For Clients From 27+ Countries.";

// require_once PATH.'/includes/head.php';
/*require_once PATH.'../includes/head.php';
require_once PATH.'../include/header.php';
require_once PATH.'/connection.php';
require_once PATH.'/captchaGenerate.php';*/

//require_once ('includes/head.php');
//require_once ('include/header.php');
require_once ('include/header-doc.php');
require_once ('include/header-links.php');
?>
<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/home/index-1.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/home/home-media.css" />

<?php
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;

?>

<title>Web Design & Development Company - eLuminous Technologies</title>
<meta name="description"
    content="eLuminous Technologies is Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises.We Build Custom Web Design & Development, Mobile, Business Intelligence Solutions For Clients From 27+ Countries.">
<meta name="keywords"
    content="web design & development company, custom mobile app development company, front end development company, business intelligence and data analytics">
<meta name="author" content="">
<link href='https://eluminoustechnologies.com/' rel='canonical' />

<?php
require_once ('include/header-menu.php');
//require_once ('include/header-menu.php');
require_once ('connection.php');
require_once ('captchaGenerate.php');
?>
<div class="homeBanner homeBannerImg">
    <div class="container bannerTopWrapper">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="text">
                    <h1 class="title">
                        Front-End <span>Development <br /> Services</span>
                    </h1>
                    <h4 class="fw400">
                        Seamless visualisation across all devices with pixel <br />
                        perfect designs and stunning User experience
                    </h4>
                    <div class="clutch_wrapper">
                        <ul>
                            <li><img src="<?php echo SITE_URL; ?>images/clutch-icon.webp" alt="clutch" loading="lazy">
                            </li>
                            <li><img src="<?php echo SITE_URL; ?>images/goodfirms.webp" alt="goodfirms" loading="lazy">
                            </li>
                        </ul>
                    </div>
                    <a href="https://eluminoustechnologies.com/front-end-development" target="_blank"
                        class="btn small_blue_btn scroll_form btn">Get Started</a>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="img">
                    <img src="<?php echo SITE_URL; ?>images/banner-image-top.webp" alt="Front-End Development"
                        class="img-fluid" width="" height="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Case Studies Section End -->
</div>
<!-- They believed Us -->
<section id="slider_client">
    <div class="container">
        <div class="they_believed_us">
            <div class="slider_title">
                <h3>they<br><span>Trusted Us</span></h3>
            </div>
            <div class="believed_slider">
                <div id="they_believed_us" class="owl-carousel">
                    <div class="client_logo_wrapper"><img src="<?php echo SITE_URL; ?>images/razer.webp" alt="Razer"
                            loading="lazy"></div>
                    <div class="client_logo_wrapper"><img src="<?php echo SITE_URL; ?>images/viacom_18.webp"
                            alt="Viacom 18" loading="lazy"></div>
                    <div class="client_logo_wrapper"><img src="<?php echo SITE_URL; ?>images/color.webp"
                            alt="Colors Viacom" loading="lazy"></div>
                    <div class="client_logo_wrapper"><img src="<?php echo SITE_URL; ?>images/sokule.webp" alt="Sokule"
                            loading="lazy"></div>
                    <div class="client_logo_wrapper"><img src="<?php echo SITE_URL; ?>images/mp_inovation.webp"
                            alt="Mp Inovations.inc" loading="lazy"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- They believed Us -->
<!-- Our Expertise -->
<?php require_once 'includes/our_expertise_without_slider.php'; ?>
<!-- Our Expertise -->
<!-- Technology Expertise start here  -->
<section class="technology_expertise gray_bg slider-with-arrow" id="technology_expertise_tab_mobile">
    <div class="container">
        <div class=" ">
            <h2 class="text-center">Technology Proficiency
                <small>We use trending technologies that gives <span>unique IT solutions</span></small>
            </h2>
            <div class="owlCarousel frameworks_slider">
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/kentico-logo.webp" alt="Kentico"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/umbraco.webp" alt="Umbraco" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/share-point.webp" alt="Share Point"
                        class="img-fluid" loading="lazy">
                </div>
                <!-- new end -->
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/net.webp" alt="Microsoft.net" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/shopify.webp" alt="Shopify" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/flutter.webp" alt="Flutter" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/apple-store.webp" alt="Apple Store"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/android.webp" alt="Android" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/magento.webp" alt="Magento" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/ionic-logo.webp" alt="Ionic" class="img-fluid"
                        loading="lazy">
                </div>
                <!-- new -->
                <div class="frem_work wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/reactlogo2.webp" alt="React"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.4s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/angular.webp" alt="Angular"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="0.6s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/back_end/node.js.webp" alt="Node js"
                        class="img-fluid" loading="lazy">
                </div>

                <div class="frem_work power-bi wow fadeInDown" data-wow-delay="1s">
                    <img src="<?php echo SITE_URL; ?>images/home/power-bi.jpg" alt="Power BI" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work pentaho wow fadeInDown" data-wow-delay="1.2s">
                    <img src="<?php echo SITE_URL; ?>images/home/pentaho.webp" alt="Pentaho" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="1.4s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/laravel.webp" alt="Laravel" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="1.6s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/symfony.webp" alt="Symfony" class="img-fluid"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="1.8s">
                    <img src="<?php echo SITE_URL; ?>images/frame_work/yii_framwork.webp" alt="Yii Framwork"
                        loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="2s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/back_end/postgresql-logo.webp"
                        alt="Postgresql" class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="2.2s">
                    <img src="<?php echo SITE_URL; ?>images/web_development/mongo-db-design.webp" alt="Mongo DB"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="2.4s"">
               <img src=" <?php echo SITE_URL; ?>images/front_end_development/html_logo.webp" alt="HTML"
                    class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="2.6s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/css_icon.webp" alt="CSS"
                        class="img-fluid" loading="lazy">
                </div>
                <div class="frem_work wow fadeInDown" data-wow-delay="2.8s">
                    <img src="<?php echo SITE_URL; ?>images/front_end_development/bootstrap_icon.webp" alt="Bootstrap"
                        class="img-fluid" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- engagement models -->
<section class="engagement_models">
    <div class="container text-center">
        <h2>Engagement Models
            <small>We have engagement models to meet your diversified <span>requirement &amp; delivery</span></small>
        </h2>
        <div class="row">
            <!--engagement_contant -->
            <div class="engagement_contant align-items-center d-md-flex container-fluid">
                <div class="overite_image wow fadeInLeft" data-wow-delay="0">
                    <img src="<?php echo SITE_URL; ?>images/team_augmentation.webp" alt="Team Augmentation"
                        loading="lazy">
                </div>
                <div class="overite_section text-left wow fadeInRight" data-wow-delay="0.6s">
                    <h5>Team<span> Augmentation</span></h5>
                    <ul>
                        <li>Flexi-hiring Models with agile teams</li>
                        <li>100% Control on resource as per your priorities</li>
                    </ul>
                    <a href="dedicated-developer" class="small_blue_btn"> Hire Developer Now</a>
                </div>
            </div>
            <!-- engagement_contant -->
            <!--engagement_contant -->
            <div class="engagement_contant align-items-center d-md-flex container-fluid tab_column_reverse">
                <div class="overite_section text-right wow fadeInLeft" data-wow-delay="1s">
                    <h5>Fixed <span>Price Projects</span></h5>
                    <ul>
                        <li>Clearly defined scope</li>
                        <li>Fixed Deadlines</li>
                    </ul>
                    <a href="engagement-models/" class="small_blue_btn blue_big_btn_scrool"> Get My Project Started</a>
                </div>
                <div class="overite_image wow fadeInRight" data-wow-delay="0.4s">
                    <img src="<?php echo SITE_URL; ?>images/fixed_price_projects.webp" alt="Fixed Price Projects"
                        loading="lazy">
                </div>
            </div>
            <!-- engagement_contant -->
        </div>
    </div>
</section>
<!-- our portfolio -->
<section id="portfolio" class="gray_bg">
    <div class="container text-center">
        <h2>
            Portfolio
            <ul class="portfolio_list">
                <li class="wow fadeInDown" data-wow-delay="0"><span>2589+</span> Websites Developed</li>
                <li class="wow fadeInDown" data-wow-delay="0.6s"><span>657+</span> E-commerce Websites Developed</li>
                <li class="wow fadeInDown" data-wow-delay="0.8s"><span>513+</span> Mobile Apps Developed</li>
            </ul>
        </h2>
        <?php require_once 'includes/portfolio-home.php'; ?>
    </div>
</section>
<!-- Our Insights-->
<section id="testimonials" class="portion wow fadeInDown55 testimonial_new" data-wow-delay="0.8s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center"><small>What our clients think about us</small>
                    Testimonials
                </h5>
                <div id="testimonials_slider" class="owlCarousel">
                    <div class="text-center text-white">
                        <p>"We have been developing advertising sites online for the past 19 years and for the past 10
                            years
                            eLuminous has done the programming for many of them. You can see our sites and that many of
                            them
                            were done by eLuminous. They do great work and they are reliable and helpful."</p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t1.webp"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Jane,
                                <small>President, New york</small></span>
                        </div>
                    </div>
                    <div class="text-center text-white">
                        <p>"eLuminous Technologies has recently completed our first project with them. I was beyond
                            satisfied
                            with their attention to detail and communication. The final project was completed at the
                            highest
                            standard. The team was committed to ensuring that my team was completely satisfied with the
                            project
                            before it went live. Fantastic organisation, we have recently started our second project
                            with
                            them."</p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t2.webp"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Stewart,
                                <small>Project & Content Director, New Zealand</small></span>
                        </div>
                    </div>
                    <div class="text-center text-white">
                        <p>"I am developing a new mobile app and the team at eLuminous provided an excellent quote and
                            delivered the product on time and did a fantastic job, thanks guys"</p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t3.webp"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Peter,
                                <small>Senior Consultant , Australia</small></span>
                        </div>
                    </div>
                    <div class="text-center text-white">
                        <p>"I have used eLuminous Technologies for quite sometime now, and since day one, i have been
                            impressed with their level of professionalism and quality of delivered work. Their staff are
                            always
                            available and very well versed in communication skills so there isnt a language barrier."
                        </p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t4.webp"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Miguel,
                                <small>Chief Operations Officer, South Africa</small></span>
                        </div>
                    </div>
                    <div class="text-center text-white">
                        <p>I am very satisfied with the service I received from eLuminous Technologies. The most
                            trustable
                            company I have ever seen. I appreciate their teamwork, intelligence, domain expertise which
                            helped
                            my business to bring it to the next level. I love eLuminous!</p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t5.webp"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Finn Goswami,
                                <small>Team Lead, Ukraine</small></span>
                        </div>
                    </div>
                    <div class="text-center text-white">
                        <p>"You guys are making all the difference in the world. We had our FIRST SALE on CRM within 30
                            minutes of launch!!! Really happy with this progress and this CRM will be a long term
                            project I am
                            going to work with ELUMINOUS"</p>
                        <div class="username">
                            <div class="profile_img"><img src="<?php echo SITE_URL; ?>images/home/t6.jpg"
                                    alt="eluminous testimonials" class="img-fluid" loading="lazy"></div>
                            <span>Matt,
                                <small>Project manager, USA</small></span>
                        </div>
                    </div>
                </div>
            </div>

</section>

<!-- INDUSTRIES SERVED -->
<section id="industries_served">
    <h2 class="text-center">Industries Served
        <small>19+ Years of journey, more than a service</small>
    </h2>
    <div class="container">
        <div class="row">
            <ul>
                <li class="wow fadeInDown" data-wow-delay="0.2s">
                    <img src="<?php echo SITE_URL; ?>images/home/it_consulting.webp" alt="it_consulting"
                        loading="lazy" />
                    <h6><b>IT &amp;</b><br> Consulting </h6>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.4s">
                    <img src="<?php echo SITE_URL; ?>images/home/ecommerce.webp" alt="Ecommerce" loading="lazy" />
                    <h6>Ecommerce</h6>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.6s">
                    <img src="<?php echo SITE_URL; ?>images/home/banking_finance.webp" alt="Banking &amp; Finance" />
                    <h6><b>Banking &amp;</b><br> Finance</h6>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.8s">
                    <img src="<?php echo SITE_URL; ?>images/home/education.webp" alt="Education" loading="lazy" />
                    <h6>Education</h6>
                </li>
                <li class="wow fadeInDown" data-wow-delay="1s">
                    <img src="<?php echo SITE_URL; ?>images/home/entertainment.webp" alt="Media &amp; Entertainment"
                        loading="lazy" />
                    <h6><b>Media &amp;</b><br> Entertainment</h6>
                </li>
                <li class="wow fadeInDown" data-wow-delay="1.2s">
                    <img src="<?php echo SITE_URL; ?>images/home/healthcare.webp" alt="Healthcare" loading="lazy" />
                    <h6>Healthcare</h6>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- INDUSTRIES SERVED -->

<!-- Our Insights -->
<section class="main_our_insights">
    <div class="container">
        <h2 class="text-center">Our Insights
            <small>Leverage your business opportunities <span>with the latest digital trends</span></small>
        </h2>
        <div class="row">
            <div class="col-12 p-0">
                <div id="our_insights" class="owl-carousel wow fadeInDown" data-wow-delay="0.4s">
                    <?php
                     $tableName = 'ebg_posts';
                     $tableMetaName = 'ebg_posts_meta';
                     $postIdArray = array();
                     $limit_query = "SELECT ID from `" . $tableName . "` where post_type = 'post' order by id DESC limit 0,6";
                     $query = mysqli_query($conn, $limit_query);
                     while ($row = mysqli_fetch_assoc($query)) {
                        $postIdArray[] = $row['ID'];
                     }
                     foreach ($postIdArray as $key => $value) {
                        $postSql = "SELECT ID,post_title, post_content,guid FROM $tableName where post_type = 'post' and post_status ='publish' AND ID = $value";
                        $postMetaSql = "SELECT meta_value FROM ebg_postmeta where post_id = $value AND meta_key = '_thumbnail_id'";
                        $postMetaSql = mysqli_query($conn, $postMetaSql);
                        $postMetaSqlResult = mysqli_fetch_assoc($postMetaSql);
                        $postMetaSqlResultID = $postMetaSqlResult['meta_value'];
                        $imageSql = "SELECT guid FROM ebg_posts where post_type = 'attachment' AND ID ='" . $postMetaSqlResultID . "'";
                        $postResult = mysqli_query($conn, $postSql);
                        $postFeatureImageResult = mysqli_query($conn, $imageSql);
                        if ($postResult->num_rows > 0) {
                           $row = mysqli_fetch_assoc($postResult);
                           $guid = mysqli_fetch_assoc($postFeatureImageResult);
                           $postUrl = $row['guid'];
                           $postTitle = $row['post_title'];
                           #$postDate = $row['p_date'];
                           $imageUrl = $guid['guid'];
                           $length = 200;
                           $length2 = 45;
                           $excerpt = excerpt($row['post_content'], $length);
                           $excerpt2 = excerpt($row['post_title'], $length2);
                     ?>
                    <div class="blog_wrapper">
                        <a href="<?php echo $postUrl ?>" target="_blank">
                            <div class="img_wrapper"><img src="<?php echo $imageUrl; ?>" alt="blog_image"
                                    loading="lazy"></div>
                        </a>
                        <div class="blog_contant">
                            <a href="<?php echo $postUrl ?>" target="_blank">
                                <h5><?php echo $postTitle; ?></h5>
                            </a>
                            <p><?php echo ($excerpt); ?></p>
                            <a href="<?php echo $postUrl ?>" target="_blank"><i class="fa fa-angle-right"
                                    aria-hidden="true"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php
                        }
                     } ?>
                    <!--  -->
                    <!-- Our Insights-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Insights -->
<section id="news_latter">
    <div class="container">
        <div class="news_latter wow fadeInDown" data-wow-delay="1s">
            <div class="row ">
                <div class="col-md-12 col-lg-4">
                    <h6>Stay updated on technology &amp;<br> sign up for the next<br> good thing.</h6>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div action="" class="d-flex sign_form_wrapper">
                        <input type="text" class="enter mail" id="emailSubscriber" placeholder="your email address">
                        <button type="submit" id="emailSubscriberSignUp" class="green_button">Sign Up Now</button>
                    </div>
                    <p>(We respect your privacy &amp; will not share your email address)</p>
                    <span class="indexPageEmailError"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="wow fadeInDown" data-wow-delay="0.8s">
    <?php require_once 'includes/main_contact.php'; ?>
</div>
<!-- video-wrapper css start -->
<style type="text/css">
#testimonials.testimonial_new>.container {
    max-width: 1650px;
}

section.videowrapper {
    position: relative;
    height: 350px;
    background: #000;
}

.videowrapper iframe,
.videowrapper video {
    height: 280px;
    max-width: 455px;
    width: 100%;
}

.main-wrapper {
    width: 100%;
}

h1.play-video {
    text-transform: capitalize;
    text-align: center;
    color: #ff5733;
}

section#testimonials {
    z-index: 1;
}

.blue_big_btn,
.small_blue_btn {
    z-index: inherit;
}

/** Use .sticky */
.ytvideo .is-sticky,
.videoTag .is-sticky {
    position: fixed;
    bottom: 3px;
    top: auto;
    right: auto;
    left: 20px;
    max-width: 290px;
    max-height: 168px;
    width: 290px;
    height: 168px;
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

@-webkit-keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
    }

    100% {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
    }

    100% {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
    }
}

section.main-wrapper {
    max-width: 100%;
    width: 100%;
    margin: 0 auto;
}

section#testimonials {
    padding-bottom: 100px;
}

/*    .close-button {
   position: fixed;
   box-sizing: border-box;
   display: block;
   right: 72%;
   bottom: 20%;
   top: auto;
   left: 0;
   -webkit-animation-name: fadeInUp;
   animation-name: fadeInUp;
   -webkit-animation-duration: 1s;
   animation-duration: 1s;
   -webkit-animation-fill-mode: both;
   animation-fill-mode: both;
   display: none;
} */
.close-button {
    position: fixed;
    box-sizing: border-box;
    display: block;
    right: auto;
    bottom: 175px;
    top: auto;
    left: 310px;
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    display: none;
}

.close-button:before,
.close-button:after {
    width: 20px;
    height: 5px;
    transform: rotate(-45deg);
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    display: block;
    background-color: #333;
    transition: all 0.2s ease-out;
}

.close-button:after {
    transform: rotate(45deg);
}

.close-button:hover:after {
    transform: rotate(-45deg);
}

.close-button:hover:before {
    transform: rotate(45deg);
}

.gradient-overlay {
    position: fixed;
    right: 3px;
    bottom: 3px;
    top: auto;
    left: auto;
    max-width: 280px;
    max-height: 158px;
    width: 280px;
    height: 158px;
    opacity: .01;
    background: #000;
    z-index: 1;
    display: none;
}

i.fa.fa-arrows-alt {
    position: fixed;
    right: 8px;
    bottom: 5px;
    top: auto;
    left: auto;
    color: #fff;
    z-index: 2;
    cursor: pointer;
    display: none;
}

.social_media ul li a {
    position: relative;
    /*z-index: -1;*/
}


footer {
    position: relative;
    /*z-index: -1;*/
}

.videowrapper.ytvideo {
    text-align: center;
}

@media (max-width: 1199px) {
    .close-button {}

    section#testimonials {
        padding-bottom: 30px;
    }

    .videowrapper.ytvideo {
        text-align: center;
    }

    .videowrapper iframe,
    .videowrapper video {
        max-width: 450px;
        width: 100% !important;
        height: 290px;
        margin-top: 40px;
        margin-left: auto;
        margin-right: auto;
    }
}

@media (max-width: 991px) {
    /*      .videowrapper iframe, .videowrapper video {
    max-width: 100%;
    width: 100% !important;
    height: auto;
    margin-top: 40px;
}*/
}

@media (max-width: 767px) {
    .copy_right {
        z-index: -1;
    }
}
</style>

<!-- video-wrapper script start -->
<!-- video-wrapper css end -->
<?php include('include/footer-top.php'); ?>
<!-- video-wrapper script start -->
<script type="text/javascript">
var ytIframeList, videoList, currentPlayer, closeButton, gradientOverlay, fullScreenIcon;
var inViewPortBol = true;
var ytIframeIdList = [];
var ytVideoId = [];
var ytPlayerId = [];
var videoTagId = [];
var events = new Array("ended", "pause", "playing");
document.addEventListener('DOMContentLoaded', function() {
    /*Adding Youtube Iframe API to body*/
    var youTubeVideoTag = document.createElement('script');
    youTubeVideoTag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    document.body.appendChild(youTubeVideoTag, firstScriptTag);
    /*Getting all the iframe from the Page and finding out valid URL and ID. Then creating instance of players*/
    // ytIframeList = document.getElementsByTagName("iframe");
    ytIframeList = document.getElementsByClassName("featured-video");
    for (i = 0; i < ytIframeList.length; i++) {
        if (new RegExp("\\b" + "enablejsapi" + "\\b").test(ytIframeList[i].src)) {
            var url = ytIframeList[i].src.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
            if (url[2] !== undefined) {
                ID = url[2].split(/[^0-9a-z_\-]/i);
                ID = ID[0];
                ytIframeIdList.push(ID);
                ytIframeList[i].id = "featured-video" + i;
                ytVideoId.push("ytVideoId" + i);
                ytVideoId[i] = document.getElementById(ytIframeList[i].id);
                ytPlayerId.push("player" + i);
            }
        }
    }
    /*Getting Video Tag List and Creating instances*/
    videoList = document.getElementsByTagName("video");
    for (i = 0; i < videoList.length; i++) {
        videoList[i].id = "video-featured" + i;
        videoTagId.push("videoPlayerId" + i);
        videoTagId[i] = document.getElementById(videoList[i].id);
    }
    for (i = 0; i < videoTagId.length; i++) {
        for (var j in events) {
            videoTagId[i].addEventListener(events[j], videoTagPlayerhandler, false);
        }
    }
    closeButton = document.querySelector("a.close-button");
    gradientOverlay = document.querySelector(".gradient-overlay");
    fullScreenIcon = document.querySelector("i.fa.fa-arrows-alt");
    fullScreenPlay();
});
window.onYouTubeIframeAPIReady = function() {
    for (i = 0; i < ytIframeIdList.length; i++) {
        ytPlayerId[i] = new YT.Player(ytIframeList[i].id, {
            events: {
                "onStateChange": onPlayerStateChange
            }
        });
    }
};

function videoTagPlayerhandler(e) {
    /*Play Rules*/
    for (i = 0; i < videoTagId.length; i++) {
        if (e.target == videoTagId[i]) {
            if (e.type == "playing") {
                currentPlayer = videoTagId[i];
                videoTagId[i].classList.remove("is-paused");
                videoTagId[i].classList.add("is-playing");
                break;
            }
        }
    }
    for (i = 0; i < videoTagId.length; i++) {
        if (currentPlayer == videoTagId[i]) {
            continue;
        }
        videoTagId[i].classList.remove("is-playing");
        videoTagId[i].classList.add("is-paused");
    }
    /*Pause Rules*/
    for (i = 0; i < videoTagId.length; i++) {
        if (e.target == videoTagId[i]) {
            if (e.type == "pause") {
                videoTagId[i].classList.add("is-paused");
                videoTagId[i].classList.remove("is-playing");
                videoTagId[i].pause();
            }
        }
    }
    /*Sticky Rules*/
    for (i = 0; i < videoTagId.length; i++) {
        if (videoTagId[i].classList.contains("is-sticky")) {
            videoTagId[i].pause();
            fullScreenIcon.style.display = "none";
        }
    }
    for (i = 0; i < ytPlayerId.length; i++) {
        if (ytVideoId[i].classList.contains("is-sticky")) {
            ytPlayerId[i].pauseVideo();
            fullScreenIcon.style.display = "none";
        }
    }
    /*End Rules*/
    for (i = 0; i < videoTagId.length; i++) {
        if (e.target == videoTagId[i]) {
            if (e.type == "ended") {
                videoTagId[i].classList.remove("is-playing");
                videoTagId[i].classList.remove("is-paused");
            }
        }
    }
    videohandler();
};

function onPlayerStateChange(event) {
    /*Play Rules*/
    for (i = 0; i < ytPlayerId.length; i++) {
        if (ytPlayerId[i].getPlayerState() === 1) {
            currentPlayer = ytVideoId[i];
            ytVideoId[i].classList.remove("is-paused");
            ytVideoId[i].classList.add("is-playing");
            break;
        }
    }
    for (i = 0; i < ytVideoId.length; i++) {
        if (currentPlayer == ytVideoId[i]) {
            continue;
        }
        ytVideoId[i].classList.remove("is-playing");
        ytVideoId[i].classList.add("is-paused");
    }
    /*Pause Rules*/
    for (i = 0; i < ytPlayerId.length; i++) {
        if (ytPlayerId[i].getPlayerState() === 2) {
            ytVideoId[i].classList.add("is-paused");
            ytVideoId[i].classList.remove("is-playing");
            ytPlayerId[i].pauseVideo();
        }
    }
    /*Sticky Rules*/
    for (i = 0; i < ytPlayerId.length; i++) {
        if (ytVideoId[i].classList.contains("is-sticky")) {
            ytPlayerId[i].pauseVideo();
            fullScreenIcon.style.display = "none";
        }
    }
    for (i = 0; i < videoTagId.length; i++) {
        if (videoTagId[i].classList.contains("is-sticky")) {
            videoTagId[i].pause();
            fullScreenIcon.style.display = "none";
        }
    }
    /*End Rule*/
    for (i = 0; i < ytPlayerId.length; i++) {
        if (ytPlayerId[i].getPlayerState() === 0) {
            ytVideoId[i].classList.remove("is-playing");
            ytVideoId[i].classList.remove("is-paused");
        }
    }
    videohandler();
}

function videohandler() {
    if (currentPlayer) {
        if (closeButton) {
            closeButton.addEventListener("click", function(e) {
                if (currentPlayer.classList.contains("is-sticky")) {
                    currentPlayer.classList.remove("is-sticky");
                    closeFloatVideo();
                    for (i = 0; i < ytVideoId.length; i++) {
                        if (currentPlayer == ytVideoId[i]) {
                            ytPlayerId[i].pauseVideo();
                        }
                    }
                    for (i = 0; i < videoTagId.length; i++) {
                        if (currentPlayer == videoTagId[i]) {
                            videoTagId[i].pause();
                        }
                    }
                } else {
                    for (i = 0; i < ytVideoId.length; i++) {
                        if (currentPlayer != ytVideoId[i]) {
                            ytVideoId[i].classList.remove("is-sticky");
                            closeFloatVideo();
                        }
                    }
                    for (i = 0; i < videoTagId.length; i++) {
                        if (currentPlayer != videoTagId[i]) {
                            videoTagId[i].classList.remove("is-sticky");
                            closeFloatVideo();
                        }
                    }
                }
            });
        }
    }
}
window.addEventListener('scroll', function() {
    inViewPortBol = inViewPort();
    if (currentPlayer) {
        if (!inViewPortBol && currentPlayer.classList.contains("is-playing")) {
            for (i = 0; i < ytVideoId.length; i++) {
                if (currentPlayer != ytVideoId[i]) {
                    ytVideoId[i].classList.remove("is-sticky");
                }
            }
            for (i = 0; i < videoTagId.length; i++) {
                if (currentPlayer != videoTagId[i]) {
                    videoTagId[i].classList.remove("is-sticky");
                }
            }
            currentPlayer.classList.add("is-sticky");
            openFloatVideo();
        } else {
            if (currentPlayer.classList.contains("is-sticky")) {
                currentPlayer.classList.remove("is-sticky");
                closeFloatVideo();
            }
        }
    }
});

function fullScreenPlay() {
    if (fullScreenIcon) {
        fullScreenIcon.addEventListener("click", function() {
            if (currentPlayer.requestFullscreen) {
                currentPlayer.requestFullscreen();
            } else if (currentPlayer.msRequestFullscreen) {
                currentPlayer.msRequestFullscreen();
            } else if (currentPlayer.mozRequestFullScreen) {
                currentPlayer.mozRequestFullScreen();
            } else if (currentPlayer.webkitRequestFullscreen) {
                currentPlayer.webkitRequestFullscreen();
            }
        });
    }
}

function inViewPort() {
    if (currentPlayer) {
        var videoParentLocal = currentPlayer.parentElement.getBoundingClientRect();
        return videoParentLocal.bottom > 0 &&
            videoParentLocal.right > 0 &&
            videoParentLocal.left < (window.innerWidth || document.documentElement.clientWidth) &&
            videoParentLocal.top < (window.innerHeight || document.documentElement.clientHeight);
    }
}

function openFloatVideo() {
    closeButton.style.display = "block";
    gradientOverlay.style.display = "block";
    fullScreenIcon.style.display = "block";
}

function closeFloatVideo() {
    closeButton.style.display = "none";
    gradientOverlay.style.display = "none";
    fullScreenIcon.style.display = "none";
}
</script>
<!--<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflCK7GzY/www-widgetapi.js" async=""></script>-->
<!--<script src="//www.youtube.com/iframe_api"></script>-->

<?php include('include/footer-links.php'); ?>
<?php include('include/footer.php'); ?>