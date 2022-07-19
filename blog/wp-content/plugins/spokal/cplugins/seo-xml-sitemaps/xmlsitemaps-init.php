<?php

/*
 * Addon name: Smart Bar Addon
 * Author: Trbalic Jasmin
 * Version: 1.0
 */

define('SP_XML_SITEMAPS_URL', plugin_dir_url(__FILE__));

require_once("libs/Sitemaps.php");
require_once("libs/Sitemaps-admin.php");
//new Spokal_Sitemaps();
Spokal_Sitemaps_Admin::getInstance();