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
<?php include 'const.php'; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
    />
    <link rel="stylesheet" href="build/css/intlTelInput.css" />
    <link rel="stylesheet" href="css/j-quary.css" />
    <link rel="preload" href="css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="css/style.css"></noscript>
    <!-- Mediaquery CSS -->
    <link rel="stylesheet" href="css/mediaquery.css" />
    <!-- country code -->
    
    <!-- Header Start -->