<?php

global $spokal_lead_box_popups;
$spokal_lead_box_popups = array();

include_once('admin/settings.php');
include_once('libs/SpokalSocial.php');
include_once('libs/SpokalClasses.php');
include_once('libs/SpokalRequirements.php');
include_once('libs/SpokalPhpErrorLog.php');
include_once('libs/SpokalAdminView.php');
include_once('libs/Spokal.php');
include_once('libs/SpokalVars.php');
include_once('libs/JsonHandler.php');
include_once('libs/SpokalDecrypt.php');
include_once('libs/SpokalHooks.php');
include_once('libs/SpokalShareDraft.php');
include_once('libs/SpokalStyleCta.php');
include_once('libs/SpokalEditorFields.php');

/*
 * Including plugins
 */
include_once('libs/XMLRPC/SpokalApi.php');
include_once('cplugins/seo-auto-linker/seo-auto-linker.php');
include_once('cplugins/seo-xml-sitemaps/xmlsitemaps-init.php');

include_once('api/api-init.php');

//including addons
include_once('addons/lead-generator/addon-init.php');
include_once('addons/plugin-gravityform/addon-init.php');
include_once('addons/gplus/addon-init.php');
include_once('addons/active-campaign/addon-init.php');
include_once('addons/plugin-contactform7/addon-init.php');
include_once('addons/universal-form/addon-init.php');
include_once('addons/plugin-jetpack/addon-init.php');
include_once('addons/scroll-box/addon-init.php');
include_once('addons/exit-intent/addon-init.php');
include_once('addons/widget-relatedposts/addon-init.php');
include_once('addons/smart-bar/addon-init.php');
include_once('addons/widget-recentposts/addon-init.php');
include_once('addons/widget-popularposts/addon-init.php');
include_once('addons/plugin-ninjaform/addon-init.php');
include_once('addons/lead-box/addon-init.php');
include_once('addons/popups/addon-init.php');
?>