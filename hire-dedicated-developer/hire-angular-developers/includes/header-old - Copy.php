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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <!-- remove cache  -->
    <title>Hire Angular Developers | Hire AngularJS Developers</title>
    <meta name="description" content="Hire Angular Developers to have seamless visulizations across all devices and help you to build high performace scalable apps to enhance productivity by 70%." />
    <meta name="keywords" content="hire angular developers, hire angularjs developers,dedicated angular developers" />
    <meta name="author" content="eLuminous Technologies" />
    <link rel="canonical" href="" />
	  <?php include('../include/header.php');?>

	  <?php include('../include/header-links.php');?>

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