<?php
ob_start();
//echo PATH.'includes/constant.php';die;
//include(PATH.'includes/constant.php');
$pagename1 = isset($pagename1) ? $pagename1 : '';
/*to check url*/
$request_uri = explode("/", $_SERVER['REQUEST_URI']);

$pageTitle = isset($pageTitle) ? $pageTitle :'';
$metaDesc = isset($metaDesc) ? $metaDesc :'';
$keywords = isset($keywords) ? $keywords :'';

if ($pageTitle == "" || $metaDesc == "" || $keywords == "") {
$pageTitle = "Web Design & Development Company |Mobile Application Development Company |Front End Development| Business Intelligence Services";// Default Page title
$metaDesc = "eLuminous Technologies is The Trusted IT Partner For Digital Agencies, Tech Startups, Enterprises We Build Custom Web, Mobile & Business Intelligence Solutions For Clients From 27+ Countries.";// Default metaDesc
$keywords = "Web Application Development Company, Mobile Application Development Company, Front End Development, Business Intelligence Services, App Developers For Hire, Hire App Developers, Hire Web Developer, Android App Development Company,Business Intelligence Solutions, Psd To Html, Psd To Wordpress, Web Design Company";// Default keywords
}

$filename = basename($_SERVER['PHP_SELF']);
$filename1 = basename($filename, ".php");
?>
<!doctype html>
<html lang="en">
   <head>
      <title><?php echo $pageTitle ?></title>
      <!-- Required meta tags -->   
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="<?php echo $metaDesc ?>">
      <meta name="keywords" content="<?php echo $keywords ?>">
      <meta name="author" content="">
      <meta name="p:domain_verify" content="9ccad13bd13ccd2ff56e8911a230d07e"/>
      <meta name="google-site-verification" content="Kp3IFrEo3FD-Cfs1RCO3kaO8eXOwVjAmxm965qcMGl4" />
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL;?>favicon.ico">
      <meta name="google-site-verification" content="Kp3IFrEo3FD-Cfs1RCO3kaO8eXOwVjAmxm965qcMGl4" />