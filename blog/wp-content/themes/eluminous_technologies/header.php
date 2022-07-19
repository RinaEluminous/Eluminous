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
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/ryxren.css'>
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/eezerq.css'>
    <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/animate.css'>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com' || $_SERVER['HTTP_HOST'] == 'dev.eluminousdev.com'){ ?>
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
    <?php } ?>
    <?php wp_head();?>
    <meta name="google-site-verification" content="Kp3IFrEo3FD-Cfs1RCO3kaO8eXOwVjAmxm965qcMGl4" />
</head>
<?php

require_once('../includes/head.php');


if ( is_single() && 'post' == get_post_type() ) {
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