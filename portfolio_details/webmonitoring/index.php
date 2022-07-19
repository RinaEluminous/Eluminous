<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Website Monitoring App";// Default Page title
$metaDesc = " This Monitoring App is developed to provide an instant access to their application/website status summary and details. ";// Default metaDesc
$keywords = "Website Monitoring App, App Development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Website Monitoring
                <small>The users who are constantly traveling or heading away for holidays to relax had to carry their
                    laptop wherever they went.</small>
            </h1>
            <!-- <a href="#contact" class="blue_big_btn blue_big_btn_scrool">Let's Grow Together</a> -->
        </div>
    </div>
</section>
<section id="protfolio_slider_details">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <div class="col-md-7">
                <div id="photo-slider">
                    <div class="">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/webmonitoring/webmonitoring.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>
                    <h6>Description:<br>
                        <small>
                            <b>Business problem:</b> Client had a Website monitoring website previously. The users who
                            are constantly traveling or heading away for holidays to relax had to carry their laptop
                            wherever they went. Monitoring their websites and mission critical applications all the time
                            was a challenge for these users.</small>
                        <small>
                            <b>Solution in brief:</b> We built a website monitoring mobile application to avoid this
                            challenge. This Monitoring App is developed to provide an instant access to their
                            application/website status summary and details. Now the client doesn’t need to carry his
                            laptop everywhere as he can check his critical apps through his phone anytime.
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                            <p>Android</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="https://play.google.com/store/apps/details?id=com.webdirect.websitemonitoring"
                            target="_blank" class="small_blue_btn blue_big_btn_scrool">Get it on</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="portfolio-nav">
    <a href="<?php echo SITE_URL;?>#" rel="next">
        <i class="fa fa-angle-left"></i>
    </a>
    <a href="<?php echo SITE_URL;?>portfolio/" class="close-portfolio external">
        <i class="fa fa-th"></i>
    </a>
    <a href="<?php echo SITE_URL;?>#" rel="prev">
        <i class="fa fa-angle-right"></i>
    </a>
</div>
<section class="gray_bg">
    <div class="container">

        <?php require_once '../../includes/portfolio.php';?>
    </div>
</section>
<?php require_once '../../includes/main_contact.php';?>
<?php require_once '../../includes/footer.php';?>
<?php //require_once 'includes/free_quote.php';?>