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
            <span class="akion-home"></span>
			<?php echo Text::_('SOLO_MAIN_LBL_HEAD_BACKUPOPS'); ?>
        </h3>
    </header>

    <div class="akeeba-grid--small">
		<?php if ($this->canAccess('backup', 'main')): ?>
            <a class="akeeba-action--green" href="<?php echo $router->route('index.php?view=backup') ?>">
                <span class="akion-play"></span>
				<?php echo Text::_('COM_AKEEBA_BACKUP') ?>
            </a>
		<?php endif; ?>

		<?php if ($this->canAccess('transfer', 'main')): ?>
            <a class="akeeba-action--green" href="<?php echo $router->route('index.php?view=transfer') ?>">
                <span class="akion-android-open"></span>
				<?php echo Text::_('COM_AKEEBA_TRANSFER'); ?>
            </a>
		<?php endif; ?>

		<?php if ($this->canAccess('manage', 'main')): ?>
            <a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=manage') ?>">
                <span class="akion-ios-list"></span>
                <span class="title"><?php echo Text::_('COM_AKEEBA_BUADMIN') ?></span>
            </a>
		<?php endif; ?>
		<?php if ($this->canAccess('configuration', 'main')): ?>
            <a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=configuration') ?>">
                <span class="akion-ios-gear"></span>
                <span class="title"><?php echo Text::_('COM_AKEEBA_CONFIG') ?></span>
            </a>
		<?php endif; ?>
		<?php if ($this->canAccess('profiles', 'main')): ?>
            <a class="akeeba-action--teal" href="<?php echo $router->route('index.php?view=profiles') ?>">
                <span class="akion-person-stalker"></span>
                <span class="title"><?php echo Text::_('COM_AKEEBA_PROFILES') ?></span>
            </a>
		<?php endif; ?>

		<?php if (!$this->needsDownloadId && $this->canAccess('update', 'main')): ?>
            <a class="akeeba-action--orange" href="<?php echo $router->route('index.php?view=update') ?>" id="soloUpdateContainer">
                <span class="akion-checkmark-circled" id="soloUpdateIcon"></span>
                <span id="soloUpdateAvailable" style="display: none">
                        <?php echo Text::_('SOLO_UPDATE_SUBTITLE_UPDATEAVAILABLE') ?>
                    </span>
                <span id="soloUpdateUpToDate" style="display: none">
                        <?php echo Text::_('SOLO_UPDATE_SUBTITLE_UPTODATE') ?>
                    </span>
            </a>
		<?php endif; ?>
    </div>
</section>
