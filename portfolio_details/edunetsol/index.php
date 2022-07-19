<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Edu-Net | eLuminous Technologies";// Default Page title
$metaDesc = "SAAS based school management portal. This will help student, parent, teachers & principal for manage their task easily as well as see the performance of students, teachers. ";// Default metaDesc
$keywords = "Edu-Net, School Management Portal Development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Edu Net</h1>
            <!-- <a href="#contact" class="blue_big_btn blue_big_btn_scrool">Let's Grow Together</a> -->
        </div>
    </div>
</section>
<section id="protfolio_slider_details">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <div class="col-md-7">
                <div id="photo-slider">
                    <div class=" ">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/edunetsol/edunetsol2020.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>

                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>
                            Edu-Net app helps the major stakeholders related to the school to have effective
                            communication to preserve transparency in the flow of communication. The client wanted us to
                            build an application to eliminate communication issues between the stakeholders and maintain
                            clarity in the flow of information.
                        </small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Real-time notification of important announcements (like holidays, events, etc.)</li>
                        <li>Analytical report of the results </li>
                        <li>Real-time tracking functionality </li>
                    </ul>

                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/laravel.svg" type=""></object>
                                <p>Laravel</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                                <p>HTML5</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/js.svg" type=""></object>
                                <p>Jquery</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                                <p>CSS3</p>
                            </div>
                        </div>
                    </div>

                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We conceptualized the product as SaaS, which enabled the client to service multiple schools
                            while keeping costs and complexity under control. </li>
                        <li>We designed an intuitive and user-friendly UI for the web and mobile apps, which helped the
                            product's users easily work with large amounts of school data.</li>
                        <li>We incorporated a real-time tracking functionality in the ERP, which enabled all
                            stakeholders to remain updated automatically.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="http://edunetsol.com/" target="_blank"
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