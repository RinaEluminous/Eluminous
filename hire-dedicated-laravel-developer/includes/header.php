<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'const.php'; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $pageTitle;?>
    </title>
    <meta name="description" content="<?php echo $metaDesc ; ?>">
    <meta name="keywords" content="<?php echo $metaKey ; ?>">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo SITE_URL;?>images/favicon.ico">    
    <?php 
        $strCanonicalUrl='https://' .$_SERVER[ 'HTTP_HOST'].$_SERVER[ 'REQUEST_URI']; ?>
    <link rel="canonical" href="<?php echo $strCanonicalUrl; ?>" />
    <?php ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL;?>css/bootstrap.min.css">
    <!-- Owlcarousel CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/owlcarousel/owl.carousel.min.css">
    <!-- Font Awesome CSS -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="<?php echo SITE_URL;?>assets/wow/animate.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL;?>css/style.css">
    <!-- Mediaquery CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL;?>css/mediaquery.css">    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
</head>

<body class="<?php echo $filename1; ?>">
   

   <!-- Header Start -->
   <header>
        <div class="container">
            <div class="d-flex justify-content-md-between justify-content-center flex-wrap align-items-center">
                <div class="logo">
                    <img src="images/eluminous-logo.png" alt="eLuminous Logo" />
                </div>
                <ul class="contact_info">
                    <li>    
                        <a href="https://api.whatsapp.com/send?phone=+918308764279"class="whatsapp-contact">
                            <span class="whatsapp_icons icons"><img src="images/icons/whatsapp-icon.png" alt="Whatsapp Icons" /></span>
                            +91 8308764279
                        </a>
                    </li>
                    <li class="red_btn call_contact">                        
                        <a href="tel:+442081335090" class="call_contact btn">
                            <span class="call_icons icons"><img src="images/icons/call-white.png" alt="Call Icon" /></span>
                             +44 208 133 5090
                        </a>
                    </li>
                </ul>
            </div>
        </div>        
    </header>
   <!-- Header End -->