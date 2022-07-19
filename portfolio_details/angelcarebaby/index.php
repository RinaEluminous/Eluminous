<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Angelcare Baby - website development ";// Default Page title
$metaDesc = "Outsource eCommerce website Development Partner for Angelcare Baby for multilingual web platform development to run over multiple countries. ";// Default metaDesc
$keywords = "Angelcare Baby, website development , ecommerce website development for baby products";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Angelcare Baby<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-5.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-6.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-5.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/angelcarebaby/angelcarebaby-6.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>For over 20 years, Angelcare has been at the forefront of parents’ minds, setting the
                            standard in the world’s best baby items. Our client was seeking an online presence to sell
                            their products globally. So, we have developed the eCommerce website as a solution. We have
                            designed the website including multilingual functionality and country based inventory
                            system.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Comprehensive website to increase the reach of the business</li>
                        <li>Multilingual website to target wide geographical area</li>
                        <li>Country-based inventory system.</li>
                    </ul>


                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/magento.svg" type=""></object>
                                <p>Magento 2</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li> We created a comprehensive online store with multi-lingual capability, which helped the
                            client broaden their reach to diverse countries like France, Canada, the UK, and the USA.
                        </li>
                        <li>We also created local language platforms for certain targeted markets, which enabled the
                            client to boost brand awareness and garner more business opportunities.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="https://angelcarebaby.com/" target="_blank"
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