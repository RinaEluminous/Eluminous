<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Nashik Cyclists -Mobile App for Cyclist";// Default Page title
$metaDesc = "This application is primarily developed to create health-conscious society by spreading awareness about cycling. ";// Default metaDesc
$keywords = "Cyclist App, Nashik Cyclists, Mobile App for Cyclist";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Nashik Cyclists
                <small> Nashik Cyclists Group App</small>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/nashik-cyclists/nashik-cyclists.jpg"
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
                            <b>Business problem:</b> There was no common platform for the organizers and the
                            participants to interact with each other for e.g., for payments, texts, SMS, performance
                            tracking etc. The Group is highly popular, however, they wanted to encourage more people to
                            join the group and create a healthy lifestyle.
                        </small>
                        <small>
                            <b>Solution in brief:</b> This application is primarily developed to create health-conscious
                            society by spreading awareness about cycling. The mission of the app was to promote a
                            greener Nashik, create an awareness about health Benefits by Cycling, Promote Cycling for
                            masses and Creating High Impact cyclists by 2025 (Working on grass root level, Impacting
                            Global).
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                            <p>Android</p>
                        </div>
                        <div class="scrool_expertise text-left">
                            <a href="https://play.google.com/store/apps/details?id=com.eluminoustechnologies.nashikcyclists"
                                target="_blank" class="small_blue_btn blue_big_btn_scrool">Get it on Playstore</a>
                            <a href="https://itunes.apple.com/in/app/nashik-cyclists/id1118929937?mt=8" target="_blank"
                                class="small_blue_btn blue_big_btn_scrool">Get it on itunes</a>
                        </div>
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