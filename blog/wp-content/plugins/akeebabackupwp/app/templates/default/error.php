<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

if (!isset($exc))
{
	die();
}
switch ($exc->getCode())
{
	case 400:
		header('HTTP/1.1 400 Bad Request');
		$appError = 'Bad Request';
		break;
	case 401:
		header('HTTP/1.1 401 Unauthorized');
		$appError = 'Unauthorised';
		break;
	case 403:
		header('HTTP/1.1 403 Forbidden');
		$appError = 'Access Denied';
		break;
	case 404:
		header('HTTP/1.1 404 Not Found');
		$appError = 'Not Found';
		break;
	case 501:
		header('HTTP/1.1 501 Not Implemented');
		$appError = 'Not Implemented';
		break;
	case 503:
		header('HTTP/1.1 503 Service Unavailable');
		$appError = 'Service Unavailable';
		break;
	case 500:
	default:
		header('HTTP/1.1 500 Internal Server Error');
		$appError = 'Application Error';
		break;
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-152.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-152.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-120.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-57.png">
	<link rel="icon" href="<?php echo \Awf\Uri\Uri::base() ?>media/logo/solo-32.png" sizes="32x32">

	<title><?php echo \Awf\Text\Text::_('SOLO_APP_TITLE_ERROR') ?></title>

	<script type="text/javascript" src="<?php echo \Awf\Uri\Uri::base(); ?>media/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo \Awf\Uri\Uri::base(); ?>media/js/jquery-migrate.min.js"></script>
    <script type="text/javascript">
		if (typeof akeeba == 'undefined') { var akeeba = {}; }
		if (typeof akeeba.loadScripts == 'undefined') { akeeba.loadScripts = []; }
    </script>
	<script type="text/javascript" src="<?php echo \Awf\Uri\Uri::base(); ?>media/js/fef/menu.min.js"></script>
	<script type="text/javascript" src="<?php echo \Awf\Uri\Uri::base(); ?>media/js/fef/tabs.min.js"></script>
    <script type="text/javascript">window.addEventListener('DOMContentLoaded', function(event) { akeeba.fef.menuButton(); akeeba.fef.tabs(); });</script>
	<link rel="stylesheet" type="text/css" href="<?php echo \Awf\Uri\Uri::base(); ?>/media/css/fef.min.css" />
	<?php if (defined('AKEEBADEBUG') && AKEEBADEBUG && @file_exists(APATH_BASE . '/media/css/theme.css')): ?>
	<link rel="stylesheet" type="text/css" href="<?php echo \Awf\Uri\Uri::base(); ?>/media/css/theme.css" />
	<?php else: ?>
	<link rel="stylesheet" type="text/css" href="<?php echo \Awf\Uri\Uri::base(); ?>/media/css/theme.min.css" />
	<?php endif; ?>
</head>
<body class="akeeba-renderer-fef" id="error-wrap">
    <div class="akeeba-panel--danger">
        <header class="akeeba-block-header">
            <h2>
                <span class="akeeba-label--grey"><?php echo $exc->getCode() ?></span> <?php echo $appError ?>
            </h2>
        </header>

	    <?php if (defined('AKEEBADEBUG')): ?>
            <p>&nbsp;</p>
            <p>
                Please submit the following error message and trace in its entirety when requesting support
            </p>
            <h4 class="text-info">
			    <?php echo $exc->getCode() . ' :: ' . $exc->getMessage(); ?>
                in
			    <?php echo $exc->getFile() ?>
                <span class="label label-info">L <?php echo $exc->getLine(); ?></span>
            </h4>
            <p>Debug backtrace</p>
            <pre class="bg-info"><?php echo $exc->getTraceAsString(); ?></pre>
	    <?php else: ?>
            <p id="error-message-text">
			    <?php echo $exc->getMessage(); ?>
            </p>
	    <?php endif; ?>
    </div>
    <script type="text/javascript">
        akeeba.System.documentReady(function(){
            for (i = 0; i < akeeba.loadScripts.length; i++)
            {
                akeeba.loadScripts[i]();
            }
        });
    </script>
</body>
</html>
