<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Childcare Jobs Listings";// Default Page title
$metaDesc = " Childcare Jobs Listing is an application that offers childcare job listing from the UK, like Nursery practitioner, childminders, nannies, nursery managers, apprentices, qualified EYFS teachers and much more. ";// Default metaDesc
$keywords = "Childcare Jobs Listings";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Childcare Jobs Listings
                <small> Childcare Jobs Listings</small>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/childcare/childcare.jpg" alt="image"
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
                            <b>Business problem:</b> Early years careers website users had to open the website on their
                            mobile browser and then view the listing for jobs related to childcare. Though the website
                            was responsive, the client wanted to reach out to the young generation who is using mobile
                            phones for almost all of their searches and give them an opportunity to build their careers.
                        </small>
                        <small>
                            <b>Solution in brief:</b> Childcare Jobs Listing is an application that offers childcare job
                            listing from the UK, like Nursery practitioner, childminders, nannies, nursery managers,
                            apprentices, qualified EYFS teachers and much more. Searching & getting jobs for the same is
                            made simple & easy with the help of this mobile application.
                        </small>
                    </h6>

                    <h6>Skills:</h6>
                    <div class="tech_use_port">
                        <div class="tect_wrapper">
                            <object data="<?php echo SITE_URL;?>images/portfolios/ionic.svg" type=""></object>
                        </div>
                        <div class="scrool_expertise text-left">
                            <a href="http://play.google.com/store/apps/details?id=com.earlyyearscareers.edwyn"
                                target="_blank" class="small_blue_btn blue_big_btn_scrool">Get it on</a>
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