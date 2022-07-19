<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "BI project for Tyre (tire) manufacturing company";// Default Page title
$metaDesc = "Consulting and Development- BI project for Tyre (tire) manufacturing company";// Default metaDesc
$keywords = "Business Intelligence Solution for Tyre (tire) Manufacturing Company, Business Intelligence Services";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Consulting and Development- BI project for Tyre (tire) manufacturing company
            </h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/BI-tyre-manufacturer/productivity-increase.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <small>Our client is a market leader with multinational distribution in the tire
                            (tire)industry.</small>
                        <small>With 3300 retail locations across 30 countries, the client found it increasingly
                            difficult to accurately gather and analyze critical operating data to determine key
                            operational efficiency and profitability metrics.
                        </small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">eLuminous Solution:</h6>
                        <li>eLuminous worked with our client to provide a comprehensive analysis of their business
                            operations, current systems and business challenges faced, to accurately assess pain points
                            and to build a solution model which directly addressed their operational challenges.</li>
                        <li>In addition, dashboards were developed to provide the client with instant top-level views of
                            critical data, allowing accurate business decisions to be made.</li>
                    </ul>

                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <img src="<?php echo SITE_URL;?>images/portfolios/pentaho.png" alt="pentaho"
                                    class="img-fluid" loading="lazy">

                            </div>
                            <div class="tect_wrapper">
                                <img src="<?php echo SITE_URL;?>images/portfolios/talend.png" alt="talend"
                                    class="img-fluid" loading="lazy">

                            </div>
                            <div class="tect_wrapper">
                                <img src="<?php echo SITE_URL;?>images/portfolios/power-bi_logo.png" alt="power-bi_logo"
                                    class="img-fluid" loading="lazy">
                            </div>
                            <div class="tect_wrapper">
                                <img src="<?php echo SITE_URL;?>images/portfolios/tableau.png" alt="tableau"
                                    class="img-fluid" loading="lazy">
                            </div>
                            <div class="tect_wrapper">
                                <img src="<?php echo SITE_URL;?>images/portfolios/qlik.png" alt="qlik" class="img-fluid"
                                    loading="lazy">
                            </div>
                        </div>
                    </div>

                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We created a BI system that enabled the client to obtain, organize, and analyze vast amounts
                            of data for taking business-critical decisions.</li>
                        <li>We developed a smart purchasing and inventory management system, which helped the client
                            reduce costs by 7% thanks to accurate reporting.</li>
                        <li>Our data analytics and machine learning solution helped the client make data-driven business
                            decisions, which increased sales while reducing operational costs.</li>
                    </ul>

                    <div class="scrool_expertise text-left">
                        <a target="_blank" href="<?php echo SITE_URL;?>images/pdf/tyre-manufacturing.pdf"
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