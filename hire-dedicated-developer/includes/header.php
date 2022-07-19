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

$countryName = $ipdat->geoplugin_countryName; 
  include 'const.php'; 
  //require_once ('../include/header-doc.php');
?>
<link rel="canonical" href="" />
<?php //include('../include/header-links.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
<!-- country code -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/build/css/intlTelInput.css" />
<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/css/j-quary.css" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/css/style.css" />
<!-- Mediaquery CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>hire-dedicated-developer/css/mediaquery.css" />
<?php //include('../include/header-menu.php');?>

<div id="main-head"></div>