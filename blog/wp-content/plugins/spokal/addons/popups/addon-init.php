<?php

/*
 * Addon name: Spokal Popups
 * Author: Trbalic Jasmin
 * Version: 1.0
 */


define('SPOKALPOPUP_ADDON_URL', plugin_dir_url(__FILE__));
define('SPOKALPOPUP_ADDON_DIR', plugin_dir_path(__FILE__));

require_once('libs/SpokalPopup.php');

$spPopups = SpokalPopup::init();