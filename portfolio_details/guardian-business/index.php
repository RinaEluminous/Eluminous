<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Guardian Business";// Default Page title
$metaDesc = "Guardian Business mobile app will be a reporting tool for the employee against any kind of abuse, violence, discomfort they are facing in office. ";// Default metaDesc
$keywords = "Guardian Business, Guardian App for Business";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Guardian Business <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/guardian-business/guardian-business.png"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>
                    <h6>Description:<br>
                        <small>Guardian Business mobile app will be a reporting tool for the employee against any kind
                            of abuse, violence, discomfort they are facing in office.</small>
                        <small>This app will provide the employee with a facility to register with the app, raise ticket
                            against ill things happening in the office. The clause of anonymity will be considered in
                            the app development by sending/raising the ticket using a masked email address that is
                            created at the time of employee registration.</small>
                        <small>The app will allow employees to anonymously report transgressions of fellow employees to
                            employers and allow employers to disseminate information to all employees
                            simultaneously.</small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/ionic.svg" type=""></object>
                            <p>Ionic</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="https://play.google.com/store/apps/details?id=com.theguardian.business" target="_blank"
                            class="small_blue_btn blue_big_btn_scrool">Get it on</a>
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