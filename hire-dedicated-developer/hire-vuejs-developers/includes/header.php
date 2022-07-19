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
$ipdat = isset($ipdat) ? $ipdat : '';
$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ipdat
));

$countryName = $ipdat->geoplugin_countryName; ?>
<?php include 'const.php'; ?>

<link rel="icon" href="images/favicon.ico" />
<link rel="canonical" href="" />
<?php //include('../include/header.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
<!-- country code -->
<link rel="stylesheet"
    href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-vuejs-developers/build/css/intlTelInput.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-vuejs-developers/css/j-quary.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-vuejs-developers/css/style.css" />
<!-- Mediaquery CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/hire-vuejs-developers/css/mediaquery.css" />
<!-- country code -->

</head>

<!-- <body class="<?php echo $filename1; ?>"> -->
<div id="main-head"></div>