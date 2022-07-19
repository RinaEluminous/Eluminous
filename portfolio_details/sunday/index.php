<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Sunday Streams App";// Default Page title
$metaDesc = "Sunday streams mobile application Where user can watch the live & archive video streams of different church on their mobile.";// Default metaDesc
$keywords = "Sunday Streams, Live Streaming App, Mobile App Development";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Sunday Streams <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/sunday/sunday-streams.png" alt="image"
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
                            <b>Business problem:</b> Sometimes people cannot visit the church due to many possible
                            reasons, but they wish if they could view the live/archives streams of a respective church
                            from their current location.</small>
                        <small>
                            <b>Solution in brief:</b> We have built Sunday streams mobile application. Using this
                            application, user can watch the live and archive video streams of different church on their
                            mobile.
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                            <p>Android</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="https://play.google.com/store/apps/details?id=com.imd.sunday_stream&hl=en"
                            target="_blank" class="small_blue_btn blue_big_btn_scrool">Get it on</a>
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