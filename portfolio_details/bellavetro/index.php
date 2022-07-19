<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Bella Vetro | eLuminous Technologies";// Default Page title
$metaDesc = "Design Optimizaton for Bella Vetro";// Default metaDesc
$keywords = "Bella Vetro, Responsive Website Development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Bella Vetro </h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/bellavetro/bellavetro.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>


                    </div>

                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>

                    <h6>Description:<br>
                        <small>
                            We worked on Bellavetro design optimization so that it will work on latest mobile devices &
                            tabs with different resolution.
                            Users can send an enquiry to the admin regarding the design/work and admin will create a
                            user, send message through message thread for an inquiry, then users will pay 40% amount of
                            work as Down payment and remaining 60% as the final amount.
                        </small>
                        <small>We have integrated the PayPal payment gateway to collect the inquiry payments. Admin can
                            mark inquiry as "Closed" or can re-open it anytime. We have integrated the language
                            translation plugin in this website.</small>
                    </h6>


                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/wordpress.svg" type=""></object>
                            <p>Wordpress</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/js.svg" type=""></object>
                            <p>Jquery</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                            <p>HTML5</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/responsive.svg" type=""></object>
                            <p>Responsive</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                            <p>CSS3</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="http://eluminousdev.com/bellavetro/" target="_blank"
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