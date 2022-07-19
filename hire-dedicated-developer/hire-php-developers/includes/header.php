<?php
ob_start();
session_start();
$_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];

function getVisIpAddr()
{
    $vis_ip = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $vis_ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $vis_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $vis_ip = $_SERVER['REMOTE_ADDR'];
    }
}

// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ipdat
));

$countryName = $ipdat->geoplugin_countryName; ?>
<?php include 'const.php'; 

//require_once ('include/header-top.php');
?>

<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" /> -->
<!-- remove cache  -->
<!-- <title>Hire ReactJS Developers | Hire React Developers</title>
    <meta name="description" content="Hire React Developers who have been awarded as 'Best UI Winner', Trusted by 97% of CTO and 4.8 Star rated on Clutch and GoodFirms. Remote React Developers immediate available for hire." />
    <meta name="keywords" content="hire reactjs developers, hire reactjs developer, hire react developer, hire reactjs developer" />
    <meta name="author" content="eLuminous Technologies" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="canonical" href="" /> -->
<!-- <?php include('../include/header.php');?> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
<!-- country code -->
<link rel="stylesheet"
    href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-php-developers/build/css/intlTelInput.css" />
<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-php-developers/css/j-quary.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-php-developers/css/style.css" />
<!-- Mediaquery CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-php-developers/css/mediaquery.css" />
<?php //include('../include/header-bottom.php');?>
<!-- country code -->
<?php if($_SERVER['HTTP_HOST'] == 'eluminoustechnologies.com' || $_SERVER['HTTP_HOST'] == 'dev.eluminousdev.com'){ ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124927455-1"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag("js", new Date());
gtag("config", "UA-124927455-1");
</script>
<!-- Google Tag Manager -->
<script>
(function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
        "gtm.start": new Date().getTime(),
        event: "gtm.js",
    });
    var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != "dataLayer" ? "&l=" + l : "";
    j.async = true;
    j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
    f.parentNode.insertBefore(j, f);
})(window, document, "script", "dataLayer", "GTM-55PLZGM");
</script>
<?php } ?>
</head>

<!-- <body class="<?php echo $filename1; ?>"> -->
<div id="main-head"></div>

<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55PLZGM" height="0" width="0"
        style="display: none; visibility: hidden;"></iframe>
</noscript>