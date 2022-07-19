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
			<span class="akion-help-buoy"></span>
			<?php echo Text::_('COM_AKEEBA_CPANEL_HEADER_TROUBLESHOOTING'); ?>
		</h3>
	</header>

	<div class="akeeba-grid--small">
		<?php if ($this->canAccess('log', 'main')): ?>
			<a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=log') ?>">
				<span class="akion-ios-search-strong"></span>
				<?php echo Text::_('COM_AKEEBA_LOG') ?>
			</a>
		<?php endif; ?>
		<?php if ($this->canAccess('alice', 'main')): ?>
			<a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=alice')?>">
				<span class="akion-medkit"></span>
				<?php echo Text::_('COM_AKEEBA_ALICE') ?>
			</a>
		<?php endif; ?>
	</div>
</section>
