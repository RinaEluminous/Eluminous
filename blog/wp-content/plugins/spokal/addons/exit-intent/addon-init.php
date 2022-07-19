<?php

/*
 * Addon name: Smart Bar Addon
 * Author: Trbalic Jasmin
 * Version: 1.0
 */

define('EXITINTENT_ADDON_URL', plugin_dir_url(__FILE__));
define('EXITINTENT_ADDON_DIR', plugin_dir_path(__FILE__));

require_once("libs/ExitIntent.php");

new ExitIntent(__FILE__);