<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Html;
use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

$router   = $this->container->router;
$inCMS    = $this->container->segment->get('insideCMS', false);
$isJoomla = defined('_JEXEC');
$token    = $this->container->session->getCsrfToken()->getValue();

?>
<section class="akeeba-panel--info">
	<header class="akeeba-block-header">
		<h3>
			<span class="akion-wand"></span>
			<?php echo Text::_('COM_AKEEBA_CPANEL_HEADER_ADVANCED'); ?>
		</h3>
	</header>

	<div class="akeeba-grid--small">
		<?php if ($this->canAccess('schedule', 'main')): ?>
			<a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=schedule') ?>">
				<span class="akion-calendar"></span>
				<?php echo Text::_('COM_AKEEBA_SCHEDULE') ?>
			</a>
		<?php endif; ?>
		<?php if (defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO): ?>
			<?php if ($this->canAccess('discover', 'main')): ?>
				<a class="akeeba-action--orange" href="<?php echo $router->route('index.php?view=discover') ?>">
					<span class="akion-ios-download"></span>
					<?php echo Text::_('COM_AKEEBA_DISCOVER') ?>
				</a>
			<?php endif; ?>
			<?php if ($this->canAccess('s3import', 'main')): ?>
				<a class="akeeba-action--orange" href="<?php echo $router->route('index.php?view=s3import') ?>">
					<span class="akion-ios-cloud-download"></span>
					<?php echo Text::_('COM_AKEEBA_S3IMPORT') ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
