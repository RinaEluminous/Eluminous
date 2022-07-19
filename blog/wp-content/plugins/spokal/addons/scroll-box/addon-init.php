<?php

/*
 * Addon name: Scroll Box Addon
 * Author: Trbalic Jasmin
 * Version: 1.0
 */

define('SCROLLBOX_ADDON_URL', plugin_dir_url(__FILE__));
define('SCROLLBOX_ADDON_DIR', plugin_dir_path(__FILE__));
require_once("libs/ScrollBoxAddon.php");

new ScrollBoxAddon(__FILE__);