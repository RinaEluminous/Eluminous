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
			<span class="akion-funnel"></span>
			<?php echo Text::_('COM_AKEEBA_CPANEL_HEADER_INCLUDEEXCLUDE'); ?>
		</h3>
	</header>

	<div class="akeeba-grid--small">
		<?php if (defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO): ?>
			<?php if ($this->canAccess('multidb', 'main')): ?>
				<a class="akeeba-action--green" href="<?php echo $router->route('index.php?view=multidb') ?>">
					<span class="akion-arrow-swap"></span>
					<?php echo Text::_('COM_AKEEBA_MULTIDB') ?>
				</a>
			<?php endif; ?>
			<?php if ($this->canAccess('extradirs', 'main')): ?>
				<a class="akeeba-action--green" href="<?php echo $router->route('index.php?view=extradirs') ?>">
					<span class="akion-folder"></span>
					<?php echo Text::_('COM_AKEEBA_INCLUDEFOLDER') ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->canAccess('fsfilters', 'main')): ?>
			<a class="akeeba-action--red" href="<?php echo $router->route('index.php?view=fsfilters') ?>">
				<span class="akion-filing"></span>
				<?php echo Text::_('COM_AKEEBA_FILEFILTERS') ?>
			</a>
		<?php endif; ?>
		<?php if ($this->canAccess('dbfilters', 'main')): ?>
			<a class="akeeba-action--red" href="<?php echo $router->route('index.php?view=dbfilters') ?>">
				<span class="akion-ios-grid-view"></span>
				<?php echo Text::_('COM_AKEEBA_DBFILTER') ?>
			</a>
		<?php endif; ?>
		<?php if (defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO): ?>
			<?php if ($this->canAccess('regexfsfilters', 'main')): ?>
				<a class="akeeba-action--red" href="<?php echo $router->route('index.php?view=regexfsfilters')?>">
					<span class="akion-ios-folder"></span>
					<?php echo Text::_('COM_AKEEBA_REGEXFSFILTERS') ?>
				</a>
			<?php endif; ?>
			<?php if ($this->canAccess('regexdbfilters', 'main')): ?>
				<a class="akeeba-action--red" href="<?php echo $router->route('index.php?view=regexdbfilters')?>">
					<span class="akion-ios-box"></span>
					<?php echo Text::_('COM_AKEEBA_REGEXDBFILTERS') ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
