<?php

/*
 * Addon name: Lead Generator
 * Author: Kahrimanovic Mersed
 * Version: 1.0
 */

define('LEADGENERATOR_ADDON_URL', plugin_dir_url(__FILE__));

require_once("libs/LeadGenerator.php");
require_once('libs/LeadGeneratorWidget.php');
require_once('libs/LeadGeneratorInit.php');
require_once('libs/LeadGeneratorHandler.php');

new LeadGenerator(__FILE__);
new LeadGeneratorInit();
new LeadGeneratorHandler();