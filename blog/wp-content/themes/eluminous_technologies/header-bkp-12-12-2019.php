<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eluminous_technologies
 */
?>
<?php

define("SITE_URL","https://eluminoustechnologies.com/");
define("SITE_TITLE","eLuminous Technologies Pvt Ltd");

$pageTitle = "";
$metaDesc = "";
$keywords = "";

if ($pageTitle == "" || $metaDesc == "" || $keywords == "") {
$pageTitle = "Web Design & Development Company |Mobile Application Development Company |Front End Development| Business Intelligence Services";// Default Page title
$metaDesc = "eLuminous Technologies is The Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises We Build Custom Web, Mobile & Business Intelligence Solutions For Clients From 27+ Countries.";// Default metaDesc
$keywords = "Web Application Development Company, Mobile Application Development Company, Front End Development, Business Intelligence Services, App Developers For Hire, Hire App Developers, Hire Web Developer, Android App Development Company,Business Intelligence Solutions, Psd To Html, Psd To Wordpress, Web Design Company";// Default keywords
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>favicon.ico">



    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo SITE_URL;?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL;?>css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL;?>css/style.css" rel="stylesheet" />
    <link href="<?php echo SITE_URL;?>css/mobile.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/slick/css/slick.css">
    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css-progress-wizard-master/css/progress-wizard.min.css">
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>
    <!-- style owlcarousel css -->
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/ryxren.css'>
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/eezerq.css'>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-49810628-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-49810628-1');
    </script>
    <?php wp_head(); ?>
</head>

<?php
  $filename = basename($_SERVER['PHP_SELF']);
  $filename1 = basename($filename,".php");

  //Dynamic values
  $headerEmail = get_option('headerEmail');
  $usaNumber = get_option('usaNumber');
  $indiaNumber = get_option('indiaNumber');
  $giveUsCall = get_option('giveUsCall');
  $ukNumber = get_option('ukNumber');
  ?>

<body class="<?php echo $filename1; ?>">
    <header class="top_nav" id="mainNav">
        <div class="top_head">
            <div class="container">
                <div class="row justify-content-between whatsapp_wrapper">
                    <ul class="contacts_email">
                        <li>
                            <a href="mailto:<?php echo $headerEmail ?>" class="desktop"><i class="fa fa-envelope"
                                    aria-hidden="true"></i> <?php echo $headerEmail; ?></a>
                            <a href="mailto:<?php echo $headerEmail ?>" class="mobile"><i class="fa fa-envelope"
                                    aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <div class="call_us_today">
                        <p class="hide" id="zaCode"><img
                                src="<?php echo SITE_URL;?>images/contact/south_africa_flag.png" alt="UK flag icon"
                                width="21"> +27 16 423 1893</p>
                        <p class="hide" id="ukCode"><img src="<?php echo SITE_URL;?>images/uk_flag.jpg"
                                alt="UK flag icon" width="21"> +44 208 133 5090</p>
                        <p class="hide" id="usCode"><img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg"
                                alt="USA flag icon" width="21">
                            <a href="tel:17188389981"> +1 718 838 9981</a>
                        </p>
                        <p class="hide" id="inCode" style="display: block;"><img
                                src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="UK flag icon" width="21">
                            <a href="tel:912532382566">+91 253 238 2566</a>
                        </p>
                    </div>
                    <!-- <a href="https://wa.me/+918308764279" class="whatsapp" target="_blank">
              <img src="<?php echo SITE_URL;?>images/whatsapp.png" alt="whatsapp" class="img-fluid" id="whatsapp-massage" data-ccw="whatsapp-massage">
              </a> -->

                    <!-- <div class="call_us_today"> -->
                    <!-- <p><img src="<?php //echo SITE_URL;?>images/uk_flag.jpg" alt="UK flag icon" width="21"> +44 208 133 5090</p> -->
                    <!-- <p> <img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg" alt="USA flag icon" width="21"> +1 718 838 9981</p>
              <p> <img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="UK flag icon" width="21"> +91 253 238 2566</p>
            </div> -->
                </div>
                <!-- <div class="contacts_number">
              <h6><i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo $giveUsCall; ?></h6>
              <ul>
                <li>
                  <a href="tel:912532382566">
                  <img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="INDIA flag icon" width="21">  +91 253 238 2566</a>
                  <a href="tel:442081335090">
                  <img src="<?php echo SITE_URL;?>images/contact/uk_flag.jpg" alt="UK flag icon" width="21"> +44 208 133 5090</a>
                  <a href="tel:17188389981">
                  <img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg" alt="USA flag icon" width="21"> +1 718 838 9981</a>
                </li>
              </ul>
            </div> -->
            </div>
        </div>
        <nav>
            <div class="container">
                <div class="main_box_top">
                    <div class="menu_wrapper">
                        <div class="logo">
                            <a href="<?php echo SITE_URL;?>">
                                <img src="<?php echo SITE_URL;?>images/eluminous-pvt-ltd_black.png"
                                    alt="eluminous-pvt-ltd_black" class="img-fluid logo_elu">
                                <img src="<?php echo SITE_URL;?>images/17-years.png" alt="eluminous-pvt-ltd 17 years"
                                    class="img-fluid sixtnyears">
                            </a>
                        </div>
                        <div class="get_wrapper">
                            <ul class="mobile">
                                <li class="get_quote_btn" id="pop-up-btn">
                                    <a href="<?php echo SITE_URL;?>contact_us.php">Get a Quote</a>
                                </li>
                            </ul>
                            <div id="nav-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                    </div>
                    <div class="menu_heigh_box">
                        <ul class="menu float-right">
                            <!-- <li class=" <?php if($pagename == 'index') { echo 'active'; } ?>"><a href="<?php echo SITE_URL;?>index.php">Home</a></li> -->
                            <li class="dropdown_menu <?php if($pagename == 'about-us') { echo 'active'; } ?>"><a
                                    href="#">About Us</a>
                                <ul class="sub_menu">
                                    <li class="" <?php if($pagename1 == 'about-us') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>about-us.php">Our company</a></li>
                                    <li class=""
                                        <?php if($pagename1 == 'engagement-models') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>engagement-models.php">Engagement Models</a>
                                    </li>
                                    <li class="" <?php if($pagename1 == 'career') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>career.php">Careers</a></li>
                                    <li class=""
                                        <?php if($pagename1 == 'Company Brochure') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>company-brochure" target="_blank">Company
                                            Brochure</a></li>
                                </ul>
                            </li>
                            <li class="dropdown_menu <?php if($pagename == 'services') { echo 'active'; } ?>"><a
                                    href="#">Services</a>
                                <ul class="sub_menu">
                                    <li class="active"
                                        <?php if($pagename1 == 'web-application-development') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>web-application-development.php">Web
                                            Development</a>
                                    </li>
                                    <li <?php if($pagename1 == 'mobile-app-development') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>mobile-app-development.php">Mobile Apps
                                            Development</a>
                                    </li>
                                    <li class=""
                                        <?php if($pagename1 == 'front-end-development') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>front-end-development.php">Front End
                                            Development</a></li>
                                    <li <?php if($pagename1 == 'Data Analytics &amp; BI') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>data-analytics-and-bi/">Data Analytics &amp;
                                            BI</a>
                                    </li>
                                    <li <?php if($pagename1 == 'dedicated-developer') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>dedicated-developer">Hire Dedicated
                                            Developers</a></li>
                                </ul>
                            </li>
                            <li class="dropdown_menu">
                                <a href="#">Support</a>
                                <ul class="sub_menu">
                                    <li><a href="https://etdigitalmarketing.com/" target="_blank">Digital Marketing</a>
                                    </li>
                                    <li><a href="https://eluminousva.com/" target="_blank">Virtual Assistant</a></li>
                                </ul>
                            </li>
                            <li class=" <?php if($pagename == 'portfolio') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>portfolio.php">Portfolio</a></li>
                            <li class=" <?php if($pagename == 'Blog') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>blog/">Blog</a></li>
                            <li class=" <?php if($pagename == 'Contact') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>contact.php">Contact Us</a></li>
                            <li class="get_quote_btn desktop" id="pop-up-btn">
                                <a href="<?php echo SITE_URL;?>contact.php">Get a Quote</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- inner_banner -->
    <section class="inner_banner">
        <img src="<?php echo get_template_directory_uri(); ?>/img/blog-img.jpg" alt="blog" class="img-fluid">
        <div class="inner_page_title">
            <div class="container">
                <h1>Sharing Our Secrets</h1>
            </div>
        </div>
    </section>
    <!-- inner_banner -->
    <div class="deasktop-categary">
        <?php echo do_shortcode('[all_categories]'); ?>
    </div>


    <div class="mobile-categary">
        <!--Navbar-->
        <nav class="navbar navbar-light navbar-1 white">

            <!-- Navbar brand -->
            <a class="navbar-brand" href="#">Select Categories</a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent15"
                aria-controls="navbarSupportedContent15" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse p-0" id="navbarSupportedContent15">
                <?php echo do_shortcode('[all_categories]'); ?>
            </div>
            <!-- Collapsible content -->

        </nav>
    </div>
    <!--/.Navbar-->