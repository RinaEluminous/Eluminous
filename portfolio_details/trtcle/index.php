<?php 
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "TRTCLE - Online Enducation";// Default Page title
$metaDesc = "TRTCLE is an online educational website where study materials, Live Session, Video tutorial can be purchased & viewed online.";// Default metaDesc
$keywords = "Online Education Website Development, Online Educational Website";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>TRTCLE<small></small></h1>
            <!-- <a href="#contact" class="blue_big_btn blue_big_btn_scrool">Let's Grow Together</a> -->
        </div>
    </div>
</section>
<section id="protfolio_slider_details">
    <div class="container-fluid">
        <div class="row justify-content-between">

            <div class="col-md-7">
                <div id="photo-slider">
                    <div class="slider-for">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle2.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle3.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle4.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle5.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle2.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle3.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle4.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>portfolio_details/trtcle/trtcle5.jpg" alt="image"
                                draggable="false" / class="img-fluid" loading="lazy">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>
                    <h6><small>The Client, TRTCLE is a organization dedicated to providing high quality continuing legal
                            education. TRTCLE has grown to be one of the leaders in online CLE.</small>
                        <small>The client wanted to build the website to gain an online presence over the web to educate
                            legal professionals online. We have developed a robust eLearning platform for legal
                            professionals along with PCI Compliance.</small>
                        </small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Online study material live sessions, video tutorial and etc to download</li>
                        <li>real-time tracking system to track the student's progress</li>
                        <li>PCI compliance website</li>
                    </ul>

                    <div class="border-top-bottom-color">

                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/core_php.svg" type=""></object>
                                <p>PHP</p>
                            </div>
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/ci.svg" type=""></object>
                                <p>CI</p>
                            </div>

                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/html5.svg" type=""></object>
                                <p>HTML5</p>
                            </div>

                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/css.svg" type=""></object>
                                <p>CSS3</p>
                            </div>

                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/responsive.svg" type=""></object>
                                <p>Responsive</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li>We designed a comprehensive online learning management solution, which helped the client
                            track their student's progress in real-time based upon their local time. </li>
                        <li>We developed a robust and highly secure eLearning solution, which helped the client's
                            website achieve PCI compliance and take online payments.</li>
                    </ul>



                    <div class="scrool_expertise text-left">
                        <a href="https://www.trtcle.com/" target="_blank"
                            class="small_blue_btn blue_big_btn_scrool">Launch website</a>
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