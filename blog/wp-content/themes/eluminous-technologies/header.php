<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eluminous-technologies
 */
?>
<?php

define("SITE_URL","http://192.168.1.27/AW_proj/elu/Elu-HTML/html/");
define("SITE_TITLE","eLuminous Technologies Pvt Ltd");


if ($pageTitle == "" || $metaDesc == "" || $keywords == "") {
$pageTitle = "Corporate Blog - Create Value to your Business";// Default Page title
$metaDesc = "Know the latest Market , Technology updates to generate value proposition to your business to create higher profits. Subscribe To Us!";// Default metaDesc
$keywords = "mobile development blogs,technical blogs,web development blogs,UI desigining blogs, Business Intelligence and data analytics blogs";// Default keywords
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta name="description" content="<?php echo $metaDesc; ?>">
    <meta name="keywords" content="<?php echo $keywords; ?>">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL; ?>favicon.ico">

    <title><?php echo SITE_TITLE; ?></title>

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
    <?php wp_head(); ?>
</head>

<?php
  $filename = basename($_SERVER['PHP_SELF']);
  $filename1 = basename($filename,".php");
  ?>

<body class="<?php echo $filename1; ?>">
    <header class="top_nav" id="mainNav">
        <div class="top_head">
            <div class="container">
                <div class="row justify-content-between">
                    <ul class="contacts_email">
                        <li>
                            <a href="mailto:sales@eluminoustechnologies.com" class="desktop"><i class="fa fa-envelope"
                                    aria-hidden="true"></i> sales@eluminoustechnologies.com</a>
                            <a href="mailto:sales@eluminoustechnologies.com" class="mobile"><i class="fa fa-envelope"
                                    aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <div class="call_us_today">
                        <!-- <p><img src="<?php //echo SITE_URL;?>images/uk_flag.jpg" alt="UK flag icon" width="21"> +44 208 133 5090</p> -->
                        <p><img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg" alt="USA flag icon" width="21">
                            +1 718 838 9981</p>
                        <p><img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="UK flag icon" width="21">
                            +91 253 238 2566</p>
                    </div>
                </div>
                <div class="contacts_number">
                    <h6><i class="fa fa-phone-square" aria-hidden="true"></i> Give us a call</h6>
                    <ul>
                        <li>
                            <a href="tel:912532382566">
                                <img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg" alt="UK flag icon"
                                    width="21"> +91 253 238 2566</a>
                            <a href="tel:442081335090">
                                <img src="<?php echo SITE_URL;?>images/contact/uk_flag.jpg" alt="UK flag icon"
                                    width="21"> +44 208 133 5090</a>
                            <a href="tel:17188389981">
                                <img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg" alt="USA flag icon"
                                    width="21"> +1 718 838 9981</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <div class="main_box_top">
                    <div class="menu_wrapper">
                        <div class="logo">
                            <a href="<?php echo SITE_URL;?>blog">
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
                            <li class=" <?php if($pagename == 'index') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>index.php">Home</a></li>
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
                                            href="dedicated-developer">Hire Dedicated Developers</a></li>
                                </ul>
                            </li>
                            <li class=" <?php if($pagename == 'portfolio') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>portfolio/">Portfolio</a></li>
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