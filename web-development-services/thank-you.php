<?php require_once('includes/header.php');?>
<style>
section#home_banner {
    background: url(https://eluminoustechnologies.com/web-development-services/images/banner.jpg);
    height: calc(100% - 100px);
    background-repeat: no-repeat;
    background-size: cover;
}

section.our_partner {
    display: none;
}

.tick_icon.text-center img {
    width: 70px;
    margin-bottom: 10px !important;
}

section#home_banner * {
    color: #fff;
}

section#home_banner p {
    margin: 20px 0 60px 0;
}
</style>
<section id="home_banner" class="home_banner banner overlay overlay_blue">
    <div class="mb-5 mt-5 thank_you_bg">
        <div class="container">
            <div class="text-center thank_you">
                <div class="tick_icon text-center col-12"><img src="images/check.png" alt="thank you"
                        class="mt-1 mb-4 img-fluid"></div>
                <!-- <h1>Thank You <?php echo $_SESSION['name']?></h1>
			<p><strong>We have received your contact request.</strong> <br>
			We believe that we will be offering the best solution &amp; service to you.
		</p> -->

                <h1>Thank You!!</h1>
                <p style="color: #fff;"><strong>We have received your contact request.</strong> <br>
                    We believe that we will be offering the best solution &amp; service to you.</p>
                <p class="red_btn call_contact call">
                    <a href="https://eluminoustechnologies.com/web-development-services"
                        class="call_contact btn scroll_form" id="quote">
                        Back to Home Page
                    </a>
                </p>
                <!--  <a href="#" class="blue_big_btn blue_big_btn_scrool mt-5"><img src="images/call_center.png" alt="call center" style="margin-right: 10px;" /> Live Chat Now!</a>  -->

            </div>
        </div>
</section>
<section class="our_partner">
    <div class="container">
        <!-- Why eLuminous Section End -->
        <div class=" last-wrapper-row-footer">
            <h2 class="text-center">Our Esteemed Partners</h2>
            <div class="row custom-row-wrapper-box">
                <div class="footer-logos-wrapper">
                    <div class="clutch-widget-wrapper">
                        <script type="text/javascript" src="https://widget.clutch.co/static/js/widget.js"></script>
                        <div class="clutch-widget" data-url="https://widget.clutch.co" data-widget-type="2"
                            data-height="50" data-clutchcompany-id="432429"><iframe id="iframe-0.9791840081512366"
                                style="border: medium none; display: block;"
                                src="https://widget.clutch.co/widgets/get/2?ref_domain=eluminoustechnologies.com&amp;uid=432429&amp;ref_path=/web-application-development/"
                                title="eLuminous Technologies Pvt Ltd Clutch Review Widget 2" width="100%"
                                height="50px"></iframe></div>
                    </div>
                    <div class="mobile-app-logo">
                        <a href="https://www.topdevelopers.co/directory/mobile-app-developers" target="_blank"> <img
                                src="https://eluminoustechnologies.com/images/home/Badges-Mobile-App-Developers-2020.png"
                                alt="Gartner" /></a>
                    </div>
                    <div class="goodfirms"><a target="_blank"
                            href="https://www.goodfirms.co/companies/view/6738/eluminous-technologies-pvt-ltd"><img
                                style="width:243px" src="https://assets.goodfirms.co/categories/goodfirms-blue.svg"
                                alt="GoodFirms Badge" /></a>
                    </div>
                    <div class="logo-itfirms"><a href="https://www.itfirms.co/top-web-development-companies/"
                            target="_blank"><img
                                src="https://www.itfirms.co/wp-content/uploads/2020/01/app-developers-usa-2020.png"
                                alt="itfirms" /></a></div>
                    <div class="gartner-logo">
                        <img src="https://eluminoustechnologies.com/images/home/gartner-logo.png" alt="Gartner">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once("includes/footer.php");?>