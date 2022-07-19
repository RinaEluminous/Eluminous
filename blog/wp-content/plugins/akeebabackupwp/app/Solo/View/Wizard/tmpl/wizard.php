<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 *
 * @var \Solo\View\Setup\Html $this
 */

use Awf\Text\Text;

/** @var \Solo\View\Wizard\Html $this */

$router = $this->container->router;
$config = \Akeeba\Engine\Factory::getConfiguration();

?>
<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<div id="akeeba-confwiz">
	<div id="backup-progress-pane" style="display: none">
		<div class="akeeba-block--warning">
			<?php echo Text::_('COM_AKEEBA_CONFWIZ_INTROTEXT'); ?>
		</div>

		<div id="backup-progress-header" class="akeeba-panel--info">
            <header class="akeeba-block-header">
                <h3>
                    <?php echo Text::_('COM_AKEEBA_CONFWIZ_PROGRESS') ?>
                </h3>
            </header>

            <div id="backup-progress-content">
				<div id="backup-steps">
					<div id="step-ajax" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_AJAX'); ?></div>
					<div id="step-minexec" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_MINEXEC'); ?></div>
					<div id="step-directory" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_DIRECTORY'); ?></div>
					<div id="step-dbopt" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_DBOPT'); ?></div>
					<div id="step-maxexec" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_MAXEXEC'); ?></div>
					<div id="step-splitsize" class="akeeba-label--grey"><?php echo Text::_('COM_AKEEBA_CONFWIZ_SPLITSIZE'); ?></div>
				</div>
				<div class="backup-steps-container">
					<div id="backup-substep">
					</div>
				</div>
			</div>
			<span id="ajax-worker"></span>
		</div>

	</div>

	<div id="error-panel" class="akeeba-block--failure" style="display:none">
		<h3 class="alert-heading"><?php echo Text::_('COM_AKEEBA_CONFWIZ_HEADER_FAILED'); ?></h3>
		<div id="errorframe">
			<p id="backup-error-message">
			</p>
		</div>
	</div>

	<div id="backup-complete" style="display: none">
		<div class="akeeba-block--success">
			<h2 class="alert-heading"><?php echo Text::_('COM_AKEEBA_CONFWIZ_HEADER_FINISHED'); ?></h2>
			<div id="finishedframe">
				<p>
					<?php echo Text::_('COM_AKEEBA_CONFWIZ_CONGRATS') ?>
				</p>
			</div>

            <button class="akeeba-btn--primary--big" onclick="window.location='<?php echo $router->route('index.php?&view=backup') ?>'; return false;">
				<span class="akion-play"></span>
				<?php echo Text::_('COM_AKEEBA_BACKUP'); ?>
			</button>

            <button class="akeeba-btn--ghost" onclick="window.location='<?php echo $router->route('index.php?&view=configuration') ?>'; return false;">
				<span class="akion-wrench"></span>
				<?php echo Text::_('COM_AKEEBA_CONFIG'); ?>
			</button>

            <button class="akeeba-btn--ghost" onclick="window.location='<?php echo $router->route('index.php?&view=schedule') ?>'; return false;">
				<span class="akion-calendar"></span>
				<?php echo Text::_('COM_AKEEBA_SCHEDULE'); ?>
			</button>
		</div>

	</div>
</div>
