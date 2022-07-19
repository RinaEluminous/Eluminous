<?php
$pagename = "portfolio";
$pagename1 = "";
$pageTitle = "Stratgrow";// Default Page title
$metaDesc = "Startgrow is the website for a project, leads & sales management for the client";// Default metaDesc
$keywords = "Stratgrow, Project Management Panel Development";// Default
require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Stratgrow <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/stratgrowportal/stratgrowportal.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center pt-5 pb-5">
                    <h2>Project description</h2>

                    <h6>Description:<br>
                        <small>
                            Startgrow is the website for a project, leads &amp; sales management for the client. It is
                            made easy to manage all the activities for the admin on real-time basis &amp; get updates on
                            status related to it.
                        </small>
                    </h6>

                    <ul class="p_listing">
                        <h6 class="mb-4">Admin is now able to do &amp; view the following: </h6>
                        <li>Manage the projects from admin panel</li>
                        <li>Provide the update to client related to a particular project.</li>
                        <li>Management of task and milestone.</li>
                        <li>Display reports related to projects which get added by admin using GTMatrix, Raven tools,
                            Quickbooks, Google analytics.</li>
                        <li>Lead management, Sales forecast.</li>

                    </ul>


                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/yii.svg" type=""></object>
                            <p>YII2</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                            <p>HTML5</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                            <p>CSS3</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/js.svg" type=""></object>
                            <p>Jquery</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="http://stratgrowportal.com/" target="_blank"
                            class="small_blue_btn blue_big_btn_scrool">Launch website</a>
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