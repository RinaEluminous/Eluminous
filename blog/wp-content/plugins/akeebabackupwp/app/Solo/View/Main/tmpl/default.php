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

echo $this->loadAnyTemplate('Main/warnings');
?>
<div id="soloUpdateNotification">

</div>

<div class="akeeba-container--66-33">
	<div>
        <?php echo $this->loadAnyTemplate('Main/profile'); ?>

        <?php echo $this->loadAnyTemplate('Main/paypal'); ?>

		<?php if(!empty($this->quickIconProfiles) && $this->canAccess('backup', 'main')): ?>
			<?php echo $this->loadAnyTemplate('Main/oneclick'); ?>
		<?php endif; ?>

		<?php echo $this->loadAnyTemplate('Main/icons_basic'); ?>

        <?php echo $this->loadAnyTemplate('Main/icons_troubleshooting'); ?>

		<?php echo $this->loadAnyTemplate('Main/icons_advanced'); ?>

        <?php if ($this->container->userManager->getUser()->getPrivilege('akeeba.configure')): ?>
	        <?php echo $this->loadAnyTemplate('Main/icons_includeexclude'); ?>
        <?php endif; ?>


		<?php if ($this->container->userManager->getUser()->getPrivilege('akeeba.configure')): ?>
			<?php echo $this->loadAnyTemplate('Main/icons_system'); ?>
        <?php endif; ?>
	</div>

	<div>
		<?php echo $this->loadAnyTemplate('Main/status') ?>

		<?php echo $this->loadAnyTemplate('Main/latest_backup') ?>
	</div>
</div>

<div class="modal fade" id="changelogModal" tabindex="-1" role="dialog" aria-labelledby="changelogModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
        <h4 class="modal-title" id="changelogModalLabel">Changelog</h4>
    </div>
    <div class="modal-body">
		<?php echo $this->loadAnyTemplate('Main/changelog') ?>
    </div>
</div>

<?php
if ($this->statsIframe)
{
    echo $this->statsIframe;
}
?>
