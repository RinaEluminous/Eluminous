<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "EHLCOIN | eLuminous Technologies";// Default Page title
$metaDesc = "EHLCOIN is a digital prepaid service (gift card), a digital currency that is easy to use and has several advantages over today's era. ";// Default metaDesc
$keywords = "EHLCOIN, Best Digital Currency App";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>EHLCOIN <small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/ehlcoin/ehlcoin.png" alt="image"
                                draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project description</h2>
                    <h6>Description:<br>
                        <small>EHLCOIN is a digital prepaid service (gift card), a digital currency that is easy to use
                            and has several advantages over today's era. By paying to us and we will contact companies
                            where we get a discount, you will receive a share of our discounts.</small>
                        <small> The money is handled as a gift card without the best before date and which can give you
                            discounts. You can not switch back to cash if you have filled up your balance with us. Your
                            balance may be resold or given away. Your balance is reported as EHLCOIN, each EHLCOIN is
                            worth a kr. With our free purchase, payment and transfer application, you can send assets
                            quickly to anyone with internet and a smartphone.</small>
                        <small>Security is everything. When the value of money is stored digitally, security increases
                            compared with cash. We always strive to have the highest level of security.
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
                        <a href="https://play.google.com/store/apps/details?id=com.ehlcoin" target="_blank"
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