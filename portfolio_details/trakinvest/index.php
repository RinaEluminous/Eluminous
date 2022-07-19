<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "TrakInvest -Website Development";// Default Page title
$metaDesc = "TrakInvest is the world's first social investment platform for equities. This portal allows you to leverage the collective knowledge of investors globally to make better and more profitable investment decisions.";// Default metaDesc
$keywords = "TrakInvest, Social Investment Platform Development, Share Market Sites";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Trakinvest <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest1.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest2.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest3.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest4.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest1.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest2.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest3.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/trakinvest/trakinvest4.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>The client wanted us to develop the website for the virtual trading platform. TrackInvest
                            is the world's first social investment platform for equities. User is provided with virtual
                            currency and account for trading. Internships, contests, and TrakPRO fund manager.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Access to real-time market information</li>
                        <li>Access TrakInvest’s global trading resources</li>
                    </ul>


                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/wordpress.svg" type=""></object>
                                <p>WordPress</p>
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
                                <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                                <p>HTML5</p>
                            </div>
                        </div>
                    </div>

                    <h6>Client Benefits :</h6>
                    <ul>
                        <li> We built a one-stop solution for online trading, which helped the client reduce operating
                            costs while boosting overall profit margins.</li>
                        <li>We developed a virtual trading platform that enabled users to trade online using social
                            media networks, which helped the client widen their reach.</li>
                    </ul>


                    <div class="scrool_expertise text-left">
                        <a href="http://www.trakinvest.com/" target="_blank"
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