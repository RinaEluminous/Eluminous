<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Crowdt- E-commerce Website Development";// Default Page title
$metaDesc = "This is an e-commerce website which has a large number of t-shirts on sale.";// Default metaDesc
$keywords = "Crowdt, E-commerce Website Development, E-commerce Sites";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Crowdt <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt2.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt3.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt4.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt5.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt2.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt3.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt4.jpg" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/crowdt/crowdt5.jpg" alt="image"
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
                            This is an e-commerce website which has a large number of t-shirts on sale. We have designed
                            a custom template through which the admin can create campaigns, authorize and capture
                            payment, and calculate the price of T-shirts based on colors used for selling purpose.
                        </small>
                    </h6>


                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/opencart.svg" type=""></object>
                            <p>opencart</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/core_php.svg" type=""></object>
                            <p>Core PHP</p>
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
                            <object data="<?php echo SITE_URL;?>images/portfolios/debit-card.svg" type=""></object>
                            <p>Paymet Gateways</p>
                        </div>
                    </div>

                    <div class="scrool_expertise text-left">
                        <a href="http://www.crowdt.com/" target="_blank"
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