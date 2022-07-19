<?php
define("SITE_URL","https://eluminoustechnologies.com/");
define("SITE_TITLE","eLuminous Technologies Pvt Ltd");
$pageTitle = "";
$metaDesc = "";
$keywords = "";
if ($pageTitle == "" || $metaDesc == "" || $keywords == "") {
$pageTitle = "Corporate Blog - Create Value to your Business";// Default Page title
$metaDesc = "Know the latest Market , Technology updates to generate value proposition to your business to create higher profits. Subscribe To Us!";// Default metaDesc
$keywords = "mobile development blogs,technical blogs,web development blogs,UI desigining blogs, Business Intelligence and data analytics blogs";// Default keywords
}
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;
$strCanonicalUrl = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="p:domain_verify" content="9ccad13bd13ccd2ff56e8911a230d07e" />
    <!--<link href='https://eluminoustechnologies.com/' rel='canonical' />-->

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
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/animate.css'>


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


    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-55PLZGM');
    </script>
    <!-- End Google Tag Manager -->
    <?php wp_head();?>
    <meta name="google-site-verification" content="Kp3IFrEo3FD-Cfs1RCO3kaO8eXOwVjAmxm965qcMGl4" />
</head>
<?php
$filename = basename($_SERVER['PHP_SELF']);
$filename1 = basename($filename,".php");
?>

<body class="<?php echo $filename1; ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55PLZGM" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!--all envent code 1) popup 2) side icon -->
    <?php //require_once 'includes/all-event.php';?>
    <!--all envent code END-->
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
                    <div class="whatsapp_wrapper d-flex flex-row">
                        <div class="call_us_today">
                            <p class="hide" id="zaCode"><img
                                    src="<?php //echo SITE_URL;?>images/contact/south_africa_flag.png"
                                    alt="UK flag icon" width="21"> +27 16 423 1893</p>
                            <p class="hide" id="ukCode"><img src="<?php //echo SITE_URL;?>images/uk_flag.jpg"
                                    alt="UK flag icon" width="21"> +44 208 133 5090</p>
                            <p class="hide" id="usCode"><img src="<?php echo SITE_URL;?>images/contact/usa_flag.jpg"
                                    alt="USA flag icon" width="21">
                                <a href="tel:17188389981"> +1 718 838 9981</a>
                            </p>
                            <p class="hide" id="inCode"><img src="<?php echo SITE_URL;?>images/contact/india_flag.jpg"
                                    alt="UK flag icon" width="21">
                                <a href="tel:912532382566">+91 253 238 2566</a>
                            </p>
                        </div>
                        <a href="https://wa.me/+918208222939" class="whatsapp" target="_blank">
                            <img src="<?php echo SITE_URL;?>images/whatsapp.png" alt="whatsapp" class="img-fluid"
                                id="whatsapp-massage" data-ccw="whatsapp-massage">
                        </a>
                    </div>
                </div>
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
                                <img src="<?php echo SITE_URL;?>images/19-years.png" alt="eluminous-pvt-ltd 19 years"
                                    class="img-fluid sixtnyears">
                            </a>
                        </div>
                        <div class="get_wrapper">
                            <ul class="mobile">
                                <li class="get_quote_btn" id="pop-up-btn">
                                    <a href="<?php echo SITE_URL;?> contact_us" id="get-quote" data-ccw="get-quote">Get
                                        a Quote</a>
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
                            <li class="dropdown_menu <?php if($pagename == 'about-us') { echo 'active'; } ?>">
                                <a href="#">About Us</a>
                                <ul class="sub_menu">
                                    <li class="" <?php if($pagename1 == 'about-us') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>about-us/">Our company</a></li>
                                    <li class="" <?php if($pagename1 == 'why-us') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>why-us">Why Us</a></li>
                                    <li class=""
                                        <?php if($pagename1 == 'engagement-models') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>engagement-models/">Engagement Models</a></li>
                                    <li class="" <?php if($pagename1 == 'career') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>career/">Careers</a></li>
                                    <li class=""
                                        <?php if($pagename1 == 'Company Brochure') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>company-brochure" target="_blank">Company
                                            Brochure</a></li>
                                </ul>
                            </li>
                            <li class="dropdown_menu <?php if($pagename == 'services') { echo 'active'; } ?>">
                                <a href="#">Services</a>
                                <ul class="sub_menu">
                                    <li <?php if($pagename1 == 'Data Analytics &amp; BI') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>data-analytics-and-bi/">Data Analytics &amp;
                                            BI</a>
                                    </li>
                                    <li><a href="https://www.franchisorpal.com/" target="_blank">Data Analytics & BI
                                            Solution (Franchisor Pal) </a></li>
                                    <li class="active"
                                        <?php if($pagename1 == 'web-application-development') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>web-application-development/">Web Development</a>
                                    </li>
                                    <li <?php if($pagename1 == 'mobile-app-development') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>mobile-app-development/">Mobile Apps
                                            Development</a>
                                    </li>
                                    <li class=""
                                        <?php if($pagename1 == 'front-end-development') { echo 'class="active"'; } ?>><a
                                            href="<?php echo SITE_URL;?>front-end-development">Front End Development</a>
                                    </li>

                                    <li class=""
                                        <?php if($pagename1 == 'digital-marketing-services') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>digital-marketing-services/">Digital
                                            Marketing</a>
                                    </li>

                                    <li class=""
                                        <?php if($pagename1 == 'virtual-assistant-services') { echo 'class="active"'; } ?>>
                                        <a href="<?php echo SITE_URL;?>virtual-assistant-services/">Virtual
                                            Assistant</a>
                                    </li>

                                </ul>

                            </li>
                            <!--                   <li class="dropdown_menu">
                    <a href="#">Support</a>
                    <ul class="sub_menu">
                      <li><a href="https://etdigitalmarketing.com/" target="_blank">Digital Marketing</a></li>
                      <li><a href="https://eluminousva.com/" target="_blank">Virtual Assistant</a></li>
                    </ul>
                </li> -->
                            <li <?php if($pagename1 == 'dedicated-developer') { echo 'class="active"'; } ?>><a
                                    href="<?php echo SITE_URL;?>dedicated-developer">Hire Dedicated Developer</a></li>
                            <li class=" <?php if($pagename == 'portfolio') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>portfolio/">Portfolio</a></li>
                            <li class=" <?php if($pagename == 'Blog') { echo 'active'; } ?>"><a
                                    href="<?php echo SITE_URL;?>blog">Blog</a></li>

                            <li class="get_quote_btn desktop" id="pop-up-btn">
                                <a href="<?php echo SITE_URL;?>contact" id="get-quote" data-ccw="get-quote">Get a
                                    Quote</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php if ( is_single() && 'post' == get_post_type() ) {
	?>
    <!-- Add your design here for single page -->
    <?php
}else { ?>
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
    <?php } ?>
    <!--/.Navbar-->