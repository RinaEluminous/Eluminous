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
			<span class="akion-ios-cog"></span>
			<?php echo Text::_('SOLO_MAIN_LBL_SYSMANAGEMENT'); ?>
		</h3>
	</header>
	<div class="akeeba-grid--small">
		<?php if (!$inCMS): ?>
			<?php if ($this->canAccess('users', 'main')): ?>
				<a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=users') ?>">
					<span class="akion-ios-people"></span>
					<?php echo Text::_('SOLO_MAIN_LBL_USERS') ?>
				</a>
			<?php endif; ?>
		<?php elseif ($isJoomla): ?>
			<a class="akeeba-action--teal" href="#" onclick="akeeba.System.triggerEvent(document.querySelector('#toolbar-options>button'), 'click');">
				<span class="akion-ios-people"></span>
				<?php echo Text::_('SOLO_MAIN_LBL_USERS') ?>
			</a>
		<?php endif; ?>
		<?php if ($this->canAccess('sysconfig', 'main')): ?>
			<a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=sysconfig') ?>">
				<span class="akion-ios-settings-strong"></span>
				<?php echo Text::_('SOLO_MAIN_LBL_SYSCONFIG') ?>
			</a>
		<?php endif; ?>
	</div>
</section>
