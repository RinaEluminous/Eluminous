<?php
include('constant.php');
ob_start();
$request_uri = explode("/",$_SERVER['REQUEST_URI']);
$hide_meta = 0;
if($request_uri['1'] == 'hire-angular-developers' || $request_uri['1'] == 'hire-reactjs-developers' || $request_uri['1'] == 'hire-vuejs-developers' || $request_uri['1'] == 'front-end-development' || $request_uri['1'] == 'blog'){
   $hide_meta = 1;
}

$pageTitle = isset($pageTitle) ? $pageTitle :'';
$metaDesc = isset($metaDesc) ? $metaDesc :'';
$keywords = isset($keywords) ? $keywords :'';

$pagename = isset($pagename) ? $pagename :'';
$pagename1 = isset($pagename1) ? $pagename1 :'';

if ($pageTitle == "" || $metaDesc == "" || $keywords == "") {
$pageTitle = "Web Design & Development Company |Mobile Application Development Company |Front End Development| Business Intelligence Services";// Default Page title
$metaDesc = "eLuminous Technologies is The Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises We Build Custom Web, Mobile & Business Intelligence Solutions For Clients From 27+ Countries.";// Default metaDesc
$keywords = "Web Application Development Company, Mobile Application Development Company, Front End Development, Business Intelligence Services, App Developers For Hire, Hire App Developers, Hire Web Developer, Android App Development Company,Business Intelligence Solutions, Psd To Html, Psd To Wordpress, Web Design Company";// Default keywords
}
$valOne = rand(1,20);
$valTwo = rand(1,10);
$newCptcha = $valOne ."+". $valTwo;
$strCanonicalUrl = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<!doctype html>
<html lang="en">

<head>
   <?php if($hide_meta == 0){ ?>
   <title><?php echo $pageTitle ?></title>
   <!-- Required meta tags -->
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="<?php echo $metaDesc ?>">
   <meta name="keywords" content="<?php echo $keywords ?>">
   <meta name="author" content="">
   <?php } 
      if (($_SERVER['REQUEST_URI'] == '/contact') || ($_SERVER['REQUEST_URI'] == '/portfolio') ){ ?>

   <?php }
         ?>
   <meta name="p:domain_verify" content="9ccad13bd13ccd2ff56e8911a230d07e" />
   <!--- <link href='<?php echo $_SERVER['REQUEST_URI']; ?>' rel='canonical' />---->
   <!--<link href='https://eluminoustechnologies.com/' rel='canonical' />-->

   <link href='<?php echo $strCanonicalUrl; ?>' rel='canonical' />
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL;?>favicon.ico">
   <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/slick/css/slick.css">
   <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css-progress-wizard-master/css/progress-wizard.min.css">
   <script src="https://apps.elfsight.com/p/platform.js" defer></script>
   <!-- style owlcarousel css -->
   <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/ryxren.css'>
   <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/eezerq.css'>
   <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/animate.css'>

   <?php
         if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com')
         {
         ?>
   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124927455-1"></script>
   <script>
   window.dataLayer = window.dataLayer || [];

   function gtag() {
      dataLayer.push(arguments);
   }
   gtag('js', new Date());
   gtag('config', 'UA-124927455-1');
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
   <?php
      }
      ?>
   <meta name="google-site-verification" content="Kp3IFrEo3FD-Cfs1RCO3kaO8eXOwVjAmxm965qcMGl4" />
   <link href="<?php echo SITE_URL;?>css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?php echo SITE_URL;?>css/font-awesome.min.css" rel="stylesheet" />
   <link href="<?php echo SITE_URL;?>css/style.css" rel="stylesheet" />
   <link href="<?php echo SITE_URL;?>css/mobile.css" rel="stylesheet" />
</head>
<?php
   $filename = basename($_SERVER['PHP_SELF']);
   $filename1 = basename($filename,".php");
   ?>

<body class="<?php echo $filename1; ?>">
   <?php
         if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com')
         {
         ?>
   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55PLZGM" height="0" width="0"
         style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->
   <?php
        }
     ?>

   <!--all envent code 1) popup 2) side icon -->
   <?php //require_once 'includes/all-event.php';?>
   <!--all envent code END-->
   <header class="top_nav" id="mainNav">
      <div class="top_head">
         <div class="container">
            <div class="row justify-content-end">
               <div class="whatsapp_wrapper d-flex flex-row">
                  <ul class="contacts_email">
                     <li>
                        <a href="mailto:biz@eluminoustechnologies.com" class="desktop"><i class="fa fa-envelope"
                              aria-hidden="true"></i> biz@eluminoustechnologies.com</a>
                        <a href="mailto:biz@eluminoustechnologies.com" class="mobile"><i class="fa fa-envelope"
                              aria-hidden="true"></i></a>
                     </li>
                  </ul>
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
                        <img src="<?php echo SITE_URL;?>images/eluminous-pvt-ltd_black.png" alt="eluminous-pvt-ltd"
                           class="img-fluid logo_elu">
                        <!-- <img src="<?php echo SITE_URL;?>images/19-years.png" alt="eluminous-pvt-ltd 17 years" class="img-fluid sixtnyears"> -->
                     </a>
                  </div>
                  <div class="get_wrapper">
                     <ul class="mobile">
                        <li class="get_quote_btn" id="pop-up-btn">
                           <a href="<?php echo SITE_URL;?>contact/" id="get-quote" data-ccw="get-quote">Get a
                              Quote</a>
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
                     <li class="dropdown_menu <?php if($pagename == 'services') { echo 'active'; } ?>">
                        <a href="#">Services</a>
                        <ul class="sub_menu">
                           <li class=""
                              <?php if ($pagename1=='hire-dedicated-developers' ) { echo 'class="active"'; } ?>>
                              <a href="<?php echo SITE_URL; ?>hire-dedicated-developer" class="text-normal">Hire
                                 Dedicated Developers</a>
                           </li>
                           <li class="active"
                              <?php if($pagename1 == 'web-application-development') { echo 'class="active"'; } ?>>
                              <a href="<?php echo SITE_URL;?>web-application-development/">Web Development</a>
                           </li>
                           <li <?php if($pagename1 == 'mobile-app-development') { echo 'class="active"'; } ?>>
                              <a href="<?php echo SITE_URL;?>mobile-app-development/">Mobile Apps
                                 Development</a>
                           </li>
                           <li class="" <?php if($pagename1 == 'front-end-development') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>front-end-development">Front End Development</a>
                           </li>
                           <li <?php if($pagename1 == 'Data Analytics &amp; BI') { echo 'class="active"'; } ?>>
                              <a href="<?php echo SITE_URL;?>data-analytics-and-bi/">Data Analytics &amp;
                                 BI</a>
                           </li>
                           <li><a href="https://www.franchisorpal.com/" target="_blank">Data Analytics & BI
                                 Solution
                                 (Franchisor Pal) </a></li>

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
                     <!-- <li class="dropdown_menu <?php //if($pagename == 'Support') { echo 'active'; } ?>">
                              <a href="#">Support</a>
                              <ul class="sub_menu"> -->
                     <!--                                  <li><a href="https://etdigitalmarketing.com/" target="_blank">Digital Marketing</a></li>
                                 <li><a href="https://eluminousva.com/" target="_blank">Virtual Assistant</a></li> -->
                     <!--                                  <li class="" <?php //if($pagename1 == 'digital-marketing-services') { echo 'class="active"'; } ?>><a href="<?php //echo SITE_URL;?>digital-marketing-services/">Digital Marketing</a></li>
                                 
                                 <li class="" <?php //if($pagename1 == 'virtual-assistant-services') { echo 'class="active"'; } ?>><a href="<?php //echo SITE_URL;?>virtual-assistant-services/">Virtual Assistant</a></li> -->
                     <!--           </ul>
                           </li> -->
                     <li class="dropdown_menu mega__menu__wrapper <?php if ($pagename == 'dedicated-developer') {
                                             echo 'active';
                                          } ?>">
                        <a href="#">Hire Dedicated Developers</a>
                        <div class="mega__menu sub_menu">
                           <div class="container">
                              <div class="menu__wrapper">
                                 <h5>Backend</h5>
                                 <ul class="sub_menu">
                                    <li class=""
                                       <?php if ($pagename1=='hire-php-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-php-developers/"
                                          class="text-normal">Hire PHP Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-laravel-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-laravel-developers/"
                                          class="text-normal">Hire Laravel Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-dotnet-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-dotnet-developers/"
                                          class="text-normal">Hire .Net Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-nodejs-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-nodejs-developers/"
                                          class="text-normal">Hire NodeJS Developers</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="menu__wrapper">
                                 <h5>Mobile</h5>
                                 <ul class="sub_menu">
                                    <li class=""
                                       <?php if ($pagename1=='hire-ios-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-ios-developers/"
                                          class="text-normal">Hire iOS Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-android-developers' ) { echo 'class="active"'; } ?>>
                                       <a
                                          href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-android-developers/">Hire
                                          Android Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-ionic-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-ionic-developers/"
                                          class="text-normal">Hire Ionic Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-flutter-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-flutter-developers/"
                                          class="text-normal">Hire Flutter Developers</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="menu__wrapper">
                                 <h5>Frontend</h5>
                                 <ul class="sub_menu">
                                    <li class=""
                                       <?php if ($pagename1=='hire-angular-developers' ) { echo 'class="active"'; } ?>>
                                       <a
                                          href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-angular-developers">Hire
                                          Angular Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-reactjs-developers' ) { echo 'class="active"'; } ?>>
                                       <a
                                          href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-reactjs-developers">Hire
                                          ReactJS Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-vuejs-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-vuejs-developers/">Hire
                                          VueJS Developers</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="menu__wrapper">
                                 <h5>CMS</h5>
                                 <ul class="sub_menu">
                                    <li class=""
                                       <?php if ($pagename1=='hire-wordpress-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-wordpress-developers/"
                                          class="text-normal">Hire WordPress Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-shopify-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-shopify-developers/"
                                          class="text-normal">Hire Shopify Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-magento-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-magento-developers/"
                                          class="text-normal">Hire Magento Developers</a>
                                    </li>
                                    <li class=""
                                       <?php if ($pagename1=='hire-drupal-developers' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer/hire-drupal-developers/"
                                          class="text-normal">Hire Drupal Developers</a>
                                    </li>
                                 </ul>
                              </div>
                              <div class="menu__wrapper dedicated__menu">
                                 <h5>Full Stack</h5>
                                 <ul class="sub_menu">
                                    <li class=""
                                       <?php if ($pagename1=='hire-dedicated-developer' ) { echo 'class="active"'; } ?>>
                                       <a href="<?php echo SITE_URL; ?>hire-dedicated-developer" class="btn">
                                          Hire Dedicated Developers
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class=" <?php if($pagename == 'Hire-Dedicated-VA') { echo 'active'; } ?>">
                        <a href="https://eluminousva.com/" target="_blank">Hire Dedicated <span
                              class="desktop-view">VA</span><span class="mobile-view">VIRTUAL
                              ASSISTANT</span></a>
                     </li>
                     <li class=" <?php if($pagename == 'portfolio') { echo 'active'; } ?>"><a
                           href="<?php echo SITE_URL;?>portfolio/">Portfolio</a></li>
                     <li class=" <?php if($pagename == 'Blog') { echo 'active'; } ?>"><a
                           href="<?php echo SITE_URL;?>blog/">Blog</a></li>
                     <li class="dropdown_menu <?php if($pagename == 'about-us') { echo 'active'; } ?>">
                        <a href="#">About Us</a>
                        <ul class="sub_menu">
                           <li class="" <?php if($pagename1 == 'about-us') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>about-us/">Our company</a></li>
                           <li class="" <?php if($pagename1 == 'why-us') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>why-us/">Why Us</a></li>
                           <li class="" <?php if($pagename1 == 'engagement-models') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>engagement-models/">Engagement Models</a></li>
                           <li class="" <?php if($pagename1 == 'career') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>career/">Careers</a></li>
                           <li class="" <?php if($pagename1 == 'Company Brochure') { echo 'class="active"'; } ?>><a
                                 href="<?php echo SITE_URL;?>company-brochure/" target="_blank">Company
                                 Brochure</a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <div class="menu_heigh_box d-none d-lg-block">
                  <ul class="menu">
                     <!--      <li class=" <?php //if($pagename == 'Contact') { echo 'active'; } ?>"><a href="<?php //echo SITE_URL;?>contact">Contact Us</a></li> -->
                     <li class="get_quote_btn desktop" id="pop-up-btn">
                        <a href="<?php echo SITE_URL;?>contact/" id="get-quote" data-ccw="get-quote" class="mt-0">Get a
                           Quote</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
   </header>