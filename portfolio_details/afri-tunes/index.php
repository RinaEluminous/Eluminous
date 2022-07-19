<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Afrik Tunes";// Default Page title
$metaDesc = "AfrikTunes mobile application is developed to provide an access to the radio service to the African music.";// Default metaDesc
$keywords = "Music Mobile App, Afrik Tunes";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Afrik Tunes <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afri-tunes/afrik.jpg" alt="image"
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
                            <b>Business problem:</b> AfrikTunes website users had to open the website on their mobile
                            browser and then view and listen to the songs, which was not convenient to access from a
                            mobile screen.
                        </small>
                        <small>
                            <b>Solution in brief:</b> AfrikTunes mobile application is developed to provide an access to
                            the radio service to the African music. It allows the users to listen to their favorite
                            artist’s music on the phones using mobile application. Searching and listening to music is
                            so much of fun now.
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                            <p>Android</p>
                        </div>
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