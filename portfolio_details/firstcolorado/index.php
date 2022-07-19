<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "First Colorado | eLuminous Technologies";// Default Page title
$metaDesc = "First Colorado is a Wordpress website for Realtor.";// Default metaDesc
$keywords = "WordPress Website Development, First Colorado";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>First Colorado</h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado2.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado3.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado4.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado5.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado2.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado3.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado4.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/firstcolorado/firstcolorado5.jpg"
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
                            The requirement was to create a Wordpress website for Realtor. The website will be
                            responsible for creating traffic on the site.
                        </small>
                    </h6>

                    <ul class="p_listing">
                        <li>Integrated a dsIDx plugin which will show properties from IDX.</li>
                        <li>Used Buildium API: By using buildium API tenants and Landlords are redirected to their
                            particular login pages.</li>
                        <li>Added custom pages to maintain the website content.</li>
                    </ul>



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
                            <object data="<?php echo SITE_URL;?>images/portfolios/responsive.svg" type=""></object>
                            <p>Responsive</p>
                        </div>
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                            <p>CSS3</p>
                        </div>
                    </div>

                    <div class="scrool_expertise text-left">
                        <a href="http://www.firstcolorado.com/" target="_blank"
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