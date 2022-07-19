<?php
$pagename = "portfolio";
$pagename1 = "";
require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Development of comprehensive BI reporting <br> solution with Pentaho</h1>
        </div>
    </div>
</section>
<section id="protfolio_slider_details">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <div class="col-md-7 align-items-lg-center d-lg-flex">
                <div id="photo-slider">
                    <div class="">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/consulting_and_development_graph/productivity-increase.png"
                                alt="image" draggable="false" class="img-fluid">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>

                    <h6>Description:<br>
                        <small>
                            A leading Valves Manufacturing company in USA, having presence in 12 different locations out
                            of which 8 are manufacturing plants and 4 are the regional controlling offices looking after
                            the overall operations including Production, Finance and Sales
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
                        <a target="_blank" href="<?php echo SITE_URL;?>/images/pdf/Tyre-manufacturing-case-study.pdf"
                            class="small_blue_btn blue_big_btn_scrool">Download PDF</a>
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