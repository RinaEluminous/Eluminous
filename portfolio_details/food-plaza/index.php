<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Food Plaza - Restaurant App";// Default Page title
$metaDesc = "Looking for a place to dine or unwind? Food Plaza will help you out. If you look close by for a deal, restaurants nearby will offer you a steal. ";// Default metaDesc
$keywords = "Food Plaza, Restaurant Apps";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Food Plaza <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/food-plaza/food-plaza.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>
                    <h6>Description:<br>
                        <small>Looking for a place to dine or unwind? Food Plaza will help you out.
                            If you look close by for a deal, restaurants nearby will offer you a steal.
                        </small>
                    </h6>


                    <ul class="p_listing">
                        <h6 class="mb-4">Key features:</h6>
                        <li>Find your restaurant Choose by category, proximity or by name and scroll through
                            restaurants.</li>
                        <li>Find out open hours, get their phone number and get directions with live map. Receive offers
                            from nearby restaurants The app will search for offers and let you know if it finds
                            anything. If you are looking actively, you can use our hungry search to receive instant
                            deals from
                            nearby restaurants.</li>
                        <li>Save your favorites If you find a good place, make sure to save it. Whenever you find
                            something interesting, add it to your list of favorites for easy access or when you feel
                            like eating out but are out of ideas.</li>
                    </ul>


                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/android.svg" type=""></object>
                            <p>Android</p>
                        </div>
                    </div>
                    <div class="scrool_expertise text-left">
                        <a href="https://play.google.com/store/apps/details?id=com.food.plaza" target="_blank"
                            class="small_blue_btn blue_big_btn_scrool">Get it on</a>
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