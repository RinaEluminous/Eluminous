<?php
$pagename = "Jack Wills - Website Development by eLuminous";
$pagename1 = "";
$pageTitle = "Jack Wills - Website Development by eLuminous";// Default Page title
$metaDesc = "Jack Wills is a heritage fashion and lifestyle brand from the town of Salcombe. They design clothing and accessories for people who relish simple design, high-quality finishes.";// Default metaDesc
$keywords = "Jack Wills";// Default
require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Jack Wills<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/accessories.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/jackwills.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/contact-us.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/aboutus.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/accessories.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/jackwills.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/contact-us.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/jack-wills/aboutus.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>
                    <h6>
                        <small>Jack Wills is a heritage fashion and lifestyle brand from the town of Salcombe. They
                            design clothing and accessories for people who relish simple design, high-quality finishes.
                            The client was seeking for the intuitive user interface for their eCommerce store. So, we
                            have designed the Pixel perfect UI/UX for their online store. <br /><br />

                            We have executed this project combinedly with a UK based team.
                        </small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Goal-Driven Designing</li>
                        <li>Easy Content Management</li>
                        <li>Multi-functional website</li>
                        <li>100% Hand-coded Markup</li>
                        <li>Cross-Browser Compatible</li>
                    </ul>
                    </h6>

                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                                <p>HTML5</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                                <p>CSS3</p>
                            </div>
                            <div class="tect_wrapper_php">
                                <object data="<?php echo SITE_URL;?>images/portfolios/php.png" type=""></object>
                                <p>PHP</p>
                            </div>
                            <div class="tect_wrapper">
                                <!-- <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object> -->
                                <p>UX Design</p>
                            </div>
                            <div class="tect_wrapper">
                                <!-- <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object> -->
                                <p>CRO tools</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We have built a pixel-perfect intentional designs so the website is looking clean & sharp.
                        </li>
                        <li>We optimized the client's website to greater speed and high loading time to cater the smooth
                            experience to users.</li>
                        <li>We have used standard JS Libraries and Frameworks for designing to make Cross-Browser
                            Compatible website designs.</li>
                        <li>We have used SEO Semantic Markup in design which enabled the marketer to optimize the
                            website to get rank in Search Engine.</li>
                        <li>We design the front end using trending technologies, it helps to adopt run time changes
                            despite of version upgrade.</li>
                        <li>We also created the APIs to update the website or app content anytime with APP or Admin Web
                            Interface.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="https://www.jackwills.com/" target="_blank"
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