<?php
$pagename = "portfolio";
$pagename1 = "";

$pageTitle = "Afra Furniture - Website Development by eLuminous";// Default Page title
$metaDesc = "Outsource website Development Partner for Afra furniture to improve thier business digitally.Explore more for such case studies";// Default metaDesc
$keywords = "Afra Furniture, website development ";// Default 

require_once '../../includes/head.php';
?>
<!-- inner_banner -->
<section class="inner_banner">
    <img src="<?php echo SITE_URL;?>images/portfolios/portfolio_banner_details.jpg" alt="main_banner_bg"
        class="img-fluid">
    <div class="inner_page_title">
        <div class="container">
            <h1>Afra Furniture<small></small></h1>
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
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-furniture-home.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-about.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-catalogue.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-contact-us.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-products.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                    <div class="slider-nav">
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-furniture-home.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-about.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-catalogue.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-contact-us.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>
                        <div class="item">
                            <img src="<?php echo SITE_URL;?>/portfolio_details/afra-furniture/afra-products.jpg"
                                alt="image" draggable="false" / class="img-fluid">
                        </div>

                    </div>
                </div>


            </div>
            <div class="col-md-5 gray_bg d-flex align-items-center ">
                <div class="project_details align-self-center">
                    <h2>Project Description</h2>

                    <h6>
                        <!-- Description:<br> -->
                        <small>AFRA FURNITURE offers a commercial and industrial furniture design representing comfort
                            and innovation, using a broad spectrum of materials, technologies, finishes, and colors. The
                            client wanted to revamp their website because the limited search functionality on the
                            website created a hassle for the suppliers as they had to contact sales and support for a
                            small bit of product information.</small>
                    </h6>
                    <ul class="p_listing">
                        <h6 class="mb-4">Key Features:</h6>
                        <li>Smarter search filters to get information of the required product</li>
                        <li>Instant PDF generation function to generate dynamic spreadsheets, shop drawings, and 3D
                            models</li>
                    </ul>



                    <div class="border-top-bottom-color">
                        <h6>Skills:</h6>
                        <div class="tech_use_port">
                            <div class="tect_wrapper">
                                <object data="<?php echo SITE_URL;?>images/portfolios/wordpress.svg" type=""></object>
                                <p>Wordpress</p>
                            </div>
                        </div>
                    </div>
                    <h6>Client Benefits :</h6>
                    <ul>
                        <li> We created smarter search filters, which helped the client's suppliers find specific
                            products quickly by reducing navigation.</li>
                        <li>We developed a feature that generated instant PDFs of dynamic spreadsheets, shopdrawings,
                            and 3D models, which helped the client's suppliers obtain a product's technical information
                            with just a single click. </li>
                        <li>As a result of adding these and other new features to their web portal, , the client
                            reported their supplier retention rate increased by 20%.</li>
                    </ul>
                    <div class="scrool_expertise text-left">
                        <a href="https://afrafurniture.com/" target="_blank"
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