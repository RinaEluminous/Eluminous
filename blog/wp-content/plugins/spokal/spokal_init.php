<?php
/*
Plugin Name: Spokal
Plugin URI: http://www.getspokal.com
Description: Spokal Inbound Marketing Automation
Author: Spokal
Version: 2.4.0

Author URI: http://www.getspokal.com
 */
global $isPartOfSpokal; 
$isPartOfSpokal = true;

global $spokalVars;
$spokalVars = null;

include_once('SpokalInclude.php');
 
$spokalInstance = new Spokal(__FILE__);
?>
