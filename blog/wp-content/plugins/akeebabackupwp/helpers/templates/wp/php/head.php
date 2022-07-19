<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

defined('WPINC') or die;

$mediaquery = md5(@filemtime(__DIR__ . '/../../../../akeebabackupwp.php'));
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-152.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152"
		  href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-152.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
		  href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120"
		  href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-120.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
		  href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72"
		  href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-57.png">
	<link rel="icon" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/abwp-32.png" sizes="32x32">

	<title><?php echo \Awf\Text\Text::_('SOLO_APP_TITLE') ?></title>

	<script type="text/javascript">
        if (typeof Solo == 'undefined') {
            var Solo = {};
        }
        if (typeof akeeba.loadScripts == 'undefined') {
            akeeba.loadScripts = [];
        }
	</script>

	<?php

	use Awf\Uri\Uri;

	$scripts            = array();
	$scriptDeclarations = array();
	$styles             = array();
	$styleDeclarations  = array();

	// Fetch the scripts only if we have a reference to $this: it could be not instantiated if an error occurs
	// while creating it
	if (isset($this))
	{
		$scripts            = $this->getScripts();
		$scriptDeclarations = $this->getScriptDeclarations();
		$styles             = $this->getStyles();
		$styleDeclarations  = $this->getStyleDeclarations();

		// Scripts before the template ones
		if (!empty($scripts))
		{
			foreach ($scripts as $url => $params)
			{
				if ($params['before'])
				{
					echo "\t<script type=\"{$params['mime']}\" src=\"$url\"></script>\n";
				}
			}
		}

		$mediaquery = $this->container->mediaQueryKey;
	}

	$wpVersion = get_bloginfo('version', 'raw');

	if (version_compare($wpVersion, '4.0', 'lt')):
// Template scripts
		?>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/akjqnamespace.min.js?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo content_url() . '/js/jquery/jquery-migrate.js' ?>?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/fef/menu.min.js?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/fef/tabs.min.js?<?php echo $mediaquery ?>"></script>
        <script type="text/javascript">window.addEventListener('DOMContentLoaded', function(event) { akeeba.fef.menuButton(); akeeba.fef.tabs(); });</script>
	<?php
	else:
	?>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/akjqnamespace.min.js?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo includes_url() . '/js/jquery/jquery-migrate.js' ?>?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/fef/menu.min.js?<?php echo $mediaquery ?>"></script>
		<script type="text/javascript"
				src="<?php echo Uri::base(); ?>media/js/fef/tabs.min.js?<?php echo $mediaquery ?>"></script>
		<?php
	endif;

	// Scripts after the template ones
	if (!empty($scripts))
	{
		foreach ($scripts as $url => $params)
		{
			if (!$params['before'])
			{
				echo "\t<script type=\"{$params['mime']}\" src=\"$url\"></script>\n";
			}
		}
	}

	// onLoad scripts
	?>
	<script type="text/javascript"
			src="<?php echo Uri::base(); ?>media/js/solo/loadscripts.min.js?<?php echo $mediaquery ?>"></script>
	<?php

	// Script declarations
	if (!empty($scriptDeclarations))
	{
		foreach ($scriptDeclarations as $type => $content)
		{
			echo "\t<script type=\"$type\">\n$content\n</script>";
		}
	}

	// CSS files before the template CSS
	if (!empty($styles))
	{
		foreach ($styles as $url => $params)
		{
			if ($params['before'])
			{
				$media = ($params['media']) ? "media=\"{$params['media']}\"" : '';
				echo "\t<link rel=\"stylesheet\" type=\"{$params['mime']}\" href=\"$url\" $media></script>\n";
			}
		}
	}
	?>
	<link rel="stylesheet" type="text/css"
		  href="<?php echo Uri::base(); ?>/media/css/fef-wp.min.css?<?php echo $mediaquery ?>"/>
	<?php if (defined('AKEEBADEBUG') && AKEEBADEBUG && @file_exists(dirname(AkeebaBackupWP::$absoluteFileName) . '/app/media/css/theme.css')): ?>
		<link rel="stylesheet" type="text/css"
			  href="<?php echo \Awf\Uri\Uri::base(); ?>/media/css/theme.css?<?php echo $mediaquery ?>"/>
	<?php else: ?>
		<link rel="stylesheet" type="text/css"
			  href="<?php echo \Awf\Uri\Uri::base(); ?>/media/css/theme.min.css?<?php echo $mediaquery ?>"/>
	<?php endif; ?>
	<?php
	// CSS files before the template CSS
	if (!empty($styles))
	{
		foreach ($styles as $url => $params)
		{
			if (!$params['before'])
			{
				$media = ($params['media']) ? "media=\"{$params['media']}\"" : '';
				echo "\t<link rel=\"stylesheet\" type=\"{$params['mime']}\" href=\"$url\" $media></script>\n";
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
	?>
</head>
<body>
