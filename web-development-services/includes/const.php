<?php 
$baseUrl = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$filename = basename($_SERVER['PHP_SELF']);
$filename1 = basename($filename,".php");

// Images Dynamically To Call 
$site_Url = $_SERVER['HTTP_HOST'];
define("SITE_URL", "http://$site_Url/laravel-landing/");


// Company Details Links
define('PHONE808', '<a href="tel:01702309808">01702 309 808</a>');
define('EMAIL', '<a href="mailto:info@mansionconstruction.com">info@mansionconstruction.com</a>');
define('ADD', '<a href="https://goo.gl/maps/UYFGZMu3w5vgir3t8" target="_blank">41 Vanguard Way <br/> Shoeburyness Essex SS3 9QY</a>');

// Social Links
define('TWITTER', '<a href="#" class="twitter icons" target="_blank"></a>');
define('FACEBOOK', '<a href="https://www.facebook.com/mansionconstruction/" class="facebook icons" target="_blank"></a>');
define('LINKEDIN', '<a href="https://www.linkedin.com/company/mansion-construction-limited/" class="linkedin icons" target="_blank"></a>');

// Button Links 
define('COVERAGE', '<a href="coverage.php" class="btn">Coverage</a>');
define('CALLUSNOW', '<a href="tel:01702309808" class="btn">Call Us Now</a>');

if($pageTitle == ''){ $pageTitle = "Web Design and Development Company UK"; }
if($metaDesc == ''){ $metaDesc = "Digitally Transform Your Business with Our Custom Web Development Service. Look no further as with our web application development services, you can put a virtual face to your business and turn your idea into a scalable and profitable product.."; }
if($metaKey == ''){ $metaKey = "custom web development service, custom web design & development company, web application development, hire dedicated developer, web application development services"; }

?>