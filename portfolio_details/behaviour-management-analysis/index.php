<?php
$pagename = "Behaviour Management Analysis App - eLuminous";
$pagename1 = "";
$pageTitle = "Behaviour Management Analysis App - eLuminous";// Default Page title
$metaDesc = "Case study for development of behavioural management system with the mobile app development that enables real-time record";// Default metaDesc
$keywords = "BMA app, Mobile app development ";// Default
require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Behaviour Management Analysis</h1>
            <p class="bma-heading-text">An app for helping the Psychological Research Foundation from the USA</p>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/behaviour-management-analysis/behaviour-management-analysis.png"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>
                    <h6>
                        <small>The Client wanted us to develop an application to manage the behavioral record of the
                            patients including the current medications, diet, and everything.</small>
                        <small>Behaviour Management Analysis (B.M.A) is a real-time record keeping mobile application
                            that allows a carer or care team to record valuable information about an individual’s
                            behavior. It also captures information about their surroundings, interactions, dietary
                            information, and medication.</small>
                    </h6>

                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Real-time record keeping</li>
                        <li>Detailed interactive analysis reports</li>
                    </ul>


                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                                <p>Android <small>(Java)<small></p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/ios.svg" type=""></object>
                                <p>iOS <small>(Swift)</small></p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We segregated patient data using Amazon Web APIs, which helped the client manage patients'
                            records easily.</li>
                        <li>We developed a behavioural management system that enabled real-time record-keeping to
                            observe the behavioral statistics of a patient.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="https://play.google.com/store/apps/details?id=com.behaviourrecordanalysis"
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