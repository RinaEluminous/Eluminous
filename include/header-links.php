<?php //echo $_SERVER['REQUEST_URI'];die();
$strCanonicalUrl = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

 ?>

<link href='<?php echo $strCanonicalUrl; ?>' rel='canonical' />

<!-- Root Site Css Start-->


<!-- <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/css-progress-wizard-master/css/progress-wizard.min.css"> -->
<script src="https://apps.elfsight.com/p/platform.js" defer></script>
<!-- <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/ryxren.css'> -->
<!-- <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/eezerq.css'> -->
<!-- <link rel='stylesheet prefetch' href='<?php echo SITE_URL;?>css/animate.css'> -->
<!-- <link href="<?php echo SITE_URL;?>css/style.css" rel="stylesheet"/> -->
<!-- <link href="<?php echo SITE_URL;?>css/mobile.css" rel="stylesheet"/> -->
<!-- Root Site Css End-->

<?php 
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else $link = "http";
    
    $link .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



$slick_used = array('index-1','index-1/');//Add last segment of url

foreach($slick_used as $url_seg){
    if(SITE_URL.$url_seg == $link){
        ?>
        <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/slick/css/slick.css">
        <?php
    }
}
?>


        


<!-- All Common CSS Start -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/common.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>/include/assets/css/header.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>/include/assets/css/footer.css" />
<!-- <link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/allpages.css" /> -->

<?php 

$portfolio_used = array('index-1','index-1/','dedicated-developer/','portfolio/');//Add last segment of url
 
foreach($portfolio_used as $url_seg){
    if(SITE_URL.$url_seg == $link){
        ?>
        <link rel="stylesheet" href="<?php echo SITE_URL;?>/include/assets/css/portfolio.css" />
        <?php
    }
}
?>

<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/common-media.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/header-media.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/footer-media.css" /> 
<!-- <link rel="stylesheet" href="<?php echo SITE_URL;?>include/assets/css/allpagesmedia.css" /> -->
<!-- All Common CSS End -->


