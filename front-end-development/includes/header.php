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

$countryName = $ipdat->geoplugin_countryName;
  
?>
<?php include 'const.php'; ?>


<link rel="icon" href="images/favicon.ico">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<!-- country code -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>front-end-development/build/css/intlTelInput.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>front-end-development/css/j-quary.css">
<link rel="stylesheet" href="<?php echo SITE_URL;?>front-end-development/css/style.css">
<!-- Mediaquery CSS -->
<link rel="stylesheet" href="<?php echo SITE_URL;?>front-end-development/css/mediaquery.css">
<!-- country code -->