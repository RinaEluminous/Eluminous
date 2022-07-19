<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Livia Bielovic-Fashion Industry";// Default Page title
$metaDesc = "Livia Bielovic is a very popular model from South Africa. We have designed a portfolio for her which allows people to check the modeling assignments that she had done in past, present & will be doing in near future.";// Default metaDesc
$keywords = "Model Website, Modeling Website, Model Portfolio Website";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Livia Bielovic<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic5.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic2.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic3.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic4.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/liviabielovic/liviabielovic5.jpg"
                                alt="image" draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>

                    <h6>Description:<br>
                        <small>
                            Livia Bielovic is a very popular model from South Africa. We have designed a portfolio for
                            her which allows people to check the modeling assignments that she had done in past, present
                            & coming future. This website is built using a ‘then’ latest version of Drupal which is
                            Drupal.
                        </small>
                    </h6>
                    <ul class="p_listing">
                        <li>Personal website, responsive in nature.</li>
                        <li>Modeling and fashion industry</li>
                        <li>Responsive and compatible with all screen sizes.</li>

                    </ul>



                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/core_php.svg" type=""></object>
                            <p>Core PHP</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/drupal.svg" type=""></object>
                            <p>Drupal</p>
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
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/ajax.svg" type=""></object>
                            <p>Ajax</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/mysql.svg" type=""></object>
                            <p>MySql</p>
                        </div>
                    </div>

                    <div class="scrool_expertise text-left">
                        <a href="http://liviabielovic.com/" target="_blank"
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