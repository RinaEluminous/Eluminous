<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Business Intelligence solution for MP Innovations";// Default Page title
$metaDesc = "MP Innovations works in various verticals of Online Leads processing & eCommerce strategy n execution for its clientele.";// Default metaDesc
$keywords = "Business Intelligence solution for MP Innovations";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Developing MAR Management Analysis Reports for MP Innovations<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/mp-innovations/vaseo-new.jpg" alt="image"
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
                            MP Innovations works in various verticals of Online Leads processing & eCommerce strategy n
                            execution for its clientele. In every vertical they have many clients and process for each
                            vertical is different.
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <img src="<?php echo SITE_URL;?>images/portfolios/pentaho.png" alt="pentaho"
                                class="img-fluid">

                        </div>
                        <div class="tect_wrapper">
                            <img src="<?php echo SITE_URL;?>images/portfolios/talend.png" alt="talend"
                                class="img-fluid">

                        </div>
                        <div class="tect_wrapper">
                            <img src="<?php echo SITE_URL;?>images/portfolios/power-bi_logo.png" alt="power-bi_logo"
                                class="img-fluid">
                        </div>
                        <div class="tect_wrapper">
                            <img src="<?php echo SITE_URL;?>images/portfolios/tableau.png" alt="tableau"
                                class="img-fluid">
                        </div>
                        <div class="tect_wrapper">
                            <img src="<?php echo SITE_URL;?>images/portfolios/qlik.png" alt="qlik" class="img-fluid">
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a target="_blank" href="<?php echo SITE_URL;?>/images/pdf/developing-mar-management.pdf"
                            target="_blank" class="small_blue_btn blue_big_btn_scrool">Download PDF</a>
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