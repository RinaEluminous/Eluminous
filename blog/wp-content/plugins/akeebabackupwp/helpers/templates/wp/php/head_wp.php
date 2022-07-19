<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Uri\Uri;

?>
<script type="text/javascript">
if (typeof Solo === 'undefined') { var Solo = {}; }
if (typeof akeeba.loadScripts === 'undefined') { akeeba.loadScripts = []; }
</script>
<?php

$scripts = $this->getScripts();
$scriptDeclarations = $this->getScriptDeclarations();
$styles = $this->getStyles();
$styleDeclarations = $this->getStyleDeclarations();

AkeebaBackupWP::enqueueScript(Uri::base() . 'media/js/akjqnamespace.min.js');

// Scripts before the template ones
if(!empty($scripts)) foreach($scripts as $url => $params)
{
	if($params['before'])
	{
		AkeebaBackupWP::enqueueScript($url);
	}
}

$wpVersion = get_bloginfo('version', 'raw');

if (version_compare($wpVersion, '4.0', 'lt'))
{
	// Template scripts
	AkeebaBackupWP::enqueueScript(content_url() . '/js/jquery/jquery-migrate.js');
}
else
{
	AkeebaBackupWP::enqueueScript(includes_url() . '/js/jquery/jquery-migrate.js');
}

AkeebaBackupWP::enqueueScript(Uri::base() . 'media/js/fef/menu.min.js');
AkeebaBackupWP::enqueueScript(Uri::base() . 'media/js/fef/tabs.min.js');

// Scripts after the template ones
if(!empty($scripts)) foreach($scripts as $url => $params)
{
	if(!$params['before'])
	{
		AkeebaBackupWP::enqueueScript($url);
	}
}

// onLoad scripts
AkeebaBackupWP::enqueueScript(Uri::base() . 'media/js/solo/loadscripts.min.js');

// Script declarations
if (!empty($scriptDeclarations))
{
	foreach ($scriptDeclarations as $type => $content)
	{
		echo "\t<script type=\"$type\">\n$content\n</script>";
	}
}
// Hardcoded FEF initialization
?>
    <script type="text/javascript">window.addEventListener('DOMContentLoaded', function(event) { akeeba.fef.menuButton(); akeeba.fef.tabs(); });</script>
<?php


// CSS files before the template CSS
if (!empty($styles))
{
	foreach ($styles as $url => $params)
	{
		if ($params['before'])
		{
			AkeebaBackupWP::enqueueStyle($url);
		}
	}
}

AkeebaBackupWP::enqueueStyle(Uri::base() . 'media/css/fef-wp.min.css');

if (defined('AKEEBADEBUG') && AKEEBADEBUG && @file_exists(dirname(AkeebaBackupWP::$absoluteFileName) . '/app/media/css/theme.css'))
{
	AkeebaBackupWP::enqueueStyle(Uri::base() . 'media/css/theme.css');
}
else
{
	AkeebaBackupWP::enqueueStyle(Uri::base() . 'media/css/theme.min.css');
}

// CSS files before the template CSS
if (!empty($styles))
{
	foreach ($styles as $url => $params)
	{
		if (!$params['before'])
		{
			AkeebaBackupWP::enqueueStyle($url);
		}
	}
}

// Script declarations
if (!empty($styleDeclarations))
{
	foreach ($styleDeclarations as $type => $content)
	{
		echo "\t<style type=\"$type\">\n$content\n</style>";
	}
}
