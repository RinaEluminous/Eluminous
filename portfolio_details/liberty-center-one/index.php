<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Liberty Center One";// Default Page title
$metaDesc = "Liberty Center One is an enterprise-class, tier 3 data center located in Royal Oak, MI. Liberty offers a full range of technology solutions, including fully managed, co-located, virtual, dedicated and shared hosting services.";// Default metaDesc
$keywords = "Liberty Center One";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Liberty Center One <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone2.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone3.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone4.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone5.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone2.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone3.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone4.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/liberty-center-one/libertycenterone5.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>

                    <h6>Description:<br>
                        <small>
                            Liberty Center One is an enterprise-class, tier 3 data center located in Royal Oak, MI.
                            Liberty offers a full range of technology solutions, including fully managed, co-located,
                            virtual, dedicated and shared hosting services. With its high power density architecture,
                            Liberty can deliver more than 250 watts of fully redundant power per square foot to keep
                            modern, high-density computing equipment running without interruption. Liberty's high
                            availability network is protected by a 100% core Cisco network configured in a redundant
                            mesh. Internet services are provided via multiple ISPs with full gigabit redundancy.
                        </small>
                    </h6>


                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/wordpress.svg" type=""></object>
                            <p>Wordpress</p>
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
                    <div class="scrool_expertise text-left">
                        <a href="http://www.libertycenterone.com/" target="_blank"
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