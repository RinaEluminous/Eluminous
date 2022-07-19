<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Cosmetic Plant";// Default Page title
$metaDesc = "Cosmetic plant website sells the cosmetic related products which have a different type of ingredients. ";// Default metaDesc
$keywords = "Cosmetic Plant";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Cosmetic Plant</h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant1.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/cosmeticplant/cosmeticplant4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>The client, Cosmetic Plant is one of the leading Romanian personal care producers. With
                            its wide range of nature-inspired quality products, winners of several international awards
                            & prizes.</small>
                        <small>The client wanted to revamp the website as the previous website version non-responsive
                            and messy causes a lower conversion rate.</small>
                        <small>We have redesigned the optimized and responsive eCommerce website for cosmetics as per
                            the client's requirements.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Multilingual website (English & Romania) to increase the geography scope</li>
                        <li>Inbuilt marketing functionality</li>
                        <li>Customer loyalty program to increase sales and customer retention</li>
                    </ul>

                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/magento.svg" type=""></object>
                                <p>Magento 2</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                                <p>HTML5</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                                <p>CSS3</p>
                            </div>
                        </div>
                    </div>

                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We added a sales and promotions functionality, which enabled the client to plan and execute
                            marketing tasks in-house. </li>
                        <li>We made the online store multi-lingual, which helped the client reach targeted locations
                            easily and increase their footprint. </li>
                        <li>We planned and created a customer loyalty program using a points system, which boosted the
                            client's conversion rate and overall sales.</li>
                    </ul>


                    <div class="scrool_expertise text-left">
                        <a href="https://cosmeticplant.ro/" target="_blank"
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