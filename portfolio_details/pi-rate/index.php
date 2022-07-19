<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Pi-rate - Content Discovery Platform by eLuminous";// Default Page title
$metaDesc = "Eluminous is mobile app development partner for Pi-rate to develop CDP with the advertiser and publisher panels";// Default metaDesc
$keywords = "Pi-rate Content discovery platform , Mobile app development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Pi-Rate<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate2.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate3.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate4.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate5.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate2.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate3.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate4.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/pi-rate/pi-rate5.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>The Client wanted to build the Demand Side Platform (DSP) website with the two separate
                            modules Advertiser and publishers. The Pi- rate (DSP) incorporates over 35 years of media
                            learning and knowledge. Highly experienced team that helps lower your cost chain by
                            connecting you directly to source publishers.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Segregated advertiser and publishers platform</li>
                        <li>Generate leads through advertiser platform</li>
                        <li>High engagement website owners can become publisher to earn passive income</li>
                    </ul>
                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/angular.svg" type=""></object>
                                <p>Angular 6</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We developed a Demand Side Platform, which enabled the marketer to advertise and publish
                            content to get more website traffic.</li>
                        <li>We designed and developed separate advertiser and publisher modules for the client, which
                            enhanced the platform's overall security. </li>
                        <li>We helped create a platform that enables publishers with their own websites to widen their
                            reach and monetize their content.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="http://ec2-18-237-149-174.us-west-2.compute.amazonaws.com/#/" target="_blank"
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