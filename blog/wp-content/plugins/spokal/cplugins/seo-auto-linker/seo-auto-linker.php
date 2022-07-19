<?php

/*
Plugin Name: Spokal Auto Linker
Description: Links Keywords
Author: Spokal
Version: 0.9
Author URI: http://www.getspokal.com
 */

define('SPOKAL_SEOAL_PATH', plugin_dir_path(__FILE__));
define('SPOKAL_SEOAL_URL', plugin_dir_url(__FILE__));

if(!is_admin())
{
    require_once(SPOKAL_SEOAL_PATH . 'inc/front.php');
}
