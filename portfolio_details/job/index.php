<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Job Portal Development";// Default Page title
$metaDesc = "A placement company having office in more than 7-8 locations wanted to develop its market by utilizing its limited resources correctly. We have developed an online portal for them.";// Default metaDesc
$keywords = "Job Portal Development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Job portal reporting tool for a big placement company near NYC. <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/job/job.jpg" alt="image"
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
                            A placement company having office in more than 7-8 locations wanted to develop its market by
                            utilizing its limited resources correctly. There were many factors including jobs available
                            vs skills available by registered members, jobs available according to the location vs
                            skills in that area, trend analysis of demand and Trend analysis of areas.
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
                        <a target="_blank" href="<?php echo SITE_URL;?>/images/pdf/Job-portal-reporting.pdf"
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