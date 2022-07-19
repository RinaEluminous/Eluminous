<?php
$pagename = "Logo Maker App Case study - eLuminous";
$pagename1 = "";
$pageTitle = "Logo Maker App Case study - eLuminous";// Default Page title
$metaDesc = "Case study for Logo maker app to design the logos. It's most popular app on app store for logo making with 1 million= downloads ";// Default metaDesc
$keywords = "App for Logo making, Logo maker app , Mobile app for logo making";// Default
require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Logo Maker - Create a design <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/logo-maker/logo-maker.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>
                    <h6>
                        <small>The client wanted us to build a Logo Maker app for the iOS platform. Logo Maker is the
                            easiest app to create logo on your iPhone, iPad, and iPod. Create stunning logos, icons,
                            symbols, posters in just a few clicks. </small>
                    </h6>

                    <div class="portfolio-reviews-details">
                        <strong>
                            <p>Over Millions of downloads and 66K+ Reviews</p>
                        </strong>
                    </div>

                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>100+ fully editable and customizable logo templates</li>
                        <li>Advanced design elements for more personalization</li>
                        <li>Over 100+ fonts to create unique typography artwork</li>
                        <li>Add overlays to your logos for extra punch</li>
                        <li>Filters for poster making</li>
                        <li>Select from over 100 backgrounds for poster making and card making.</li>
                    </ul>
                    </h6>

                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/ios.svg" type=""></object>
                                <p>iOS</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/laravel.svg" type=""></object>
                                <p>Laravel backend</p>
                            </div>
                            <div class="tect_wrapper">
                                <!-- <object data="" type=""></object> -->
                                <p>UI/UX design</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>Logomaker helps the customers to create their business logos by themselves within no time.
                        </li>
                        <li>Provided subscription method helps users to use the specific features based on the plans.
                        </li>
                        <li>Developed a backend dashboard that includes revenue earned from an application.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="https://apps.apple.com/us/app/logo-maker-create-a-design/id1143390028" target="_blank"
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