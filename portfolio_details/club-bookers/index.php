<?php
$pagename = "portfolio";
$pagename1 = "";


$pageTitle = "Club-bookers London | eLuminous Technologies";// Default Page title
$metaDesc = "The Club Bookers website is basically about Event Planning, Guest List Reservation and Table Booking. It’s the best place for finding the best night clubs In London. ";// Default metaDesc
$keywords = "Club-bookers London, Responsive Website Development";// Default 



require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Club Bookers</h1>
            <!-- <a href="#contact" class="blue_big_btn blue_big_btn_scrool">Let's Grow Together</a> -->
        </div>
    </div>
</section>
<section id="protfolio_slider_details">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <div class="col-md-7">
                <div id="photo-slider">
                    <div class="slider-for">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/club-bookers/club-bookers4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>The Club Bookers Team lets you and your friends have a great night out in the most
                            prestigious and exclusive nightclubs in London. The client wanted us to build a centralized
                            booking system for the famous clubs in London including the facility to alter the list of
                            the clubs.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Centralized booking platform to integrate the clubs they tie-up with. </li>
                        <li>The central system keeps track of all the clubs</li>
                    </ul>
                    <div class="border-top-bottom-color">
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
                                <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                                <p>CSS3</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/responsive.svg" type=""></object>
                                <p>Responsive</p>
                            </div>
                        </div>
                    </div>


                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We designed and developed a centralized booking system, which made it easier for the client
                            to manage all club bookings. </li>
                        <li>We conceptualized and built a dynamic pricing system that records and analyzes all bookings,
                            which boosted revenue by helping the client optimize club booking prices in peak season.
                        </li>
                    </ul>

                    <div class="scrool_expertise text-left">
                        <a href="https://club-bookers.com/" target="_blank"
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