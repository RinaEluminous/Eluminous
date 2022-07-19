<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var   \Solo\View\Restore\Html $this */

$router = $this->container->router;

?>
<div class="akeeba-block--info">
	<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_DONOTCLOSE'); ?>
</div>

<div id="restoration-progress">
	<h3><?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_INPROGRESS') ?></h3>

	<table class="akeeba-table--striped">
		<tr>
			<td width="25%">
				<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_BYTESREAD'); ?>
			</td>
			<td>
				<span id="extbytesin"></span>
			</td>
		</tr>
		<tr>
			<td width="25%">
				<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_BYTESEXTRACTED'); ?>
			</td>
			<td>
				<span id="extbytesout"></span>
			</td>
		</tr>
		<tr>
			<td width="25%">
				<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_FILESEXTRACTED'); ?>
			</td>
			<td>
				<span id="extfiles"></span>
			</td>
		</tr>
	</table>

	<div id="response-timer">
		<div class="color-overlay"></div>
		<div class="text"></div>
	</div>
</div>

<div id="restoration-error" style="display:none">
	<div class="akeeba-block--failure">
		<h4>
            <?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_FAILED'); ?>
        </h4>
		<div id="errorframe">
			<p><?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_FAILED_INFO'); ?></p>
			<p id="backup-error-message">
			</p>
		</div>
	</div>
</div>

<div id="restoration-extract-ok" style="display:none">
	<div class="akeeba-block--success">
		<h4>
            <?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_SUCCESS'); ?>
        </h4>
		<?php if (empty($this->siteURL)): ?>
		<p>
			<?php echo Text::_('SOLO_RESTORE_LABEL_SUCCESS_INFO'); ?>
		</p>
		<?php else: ?>
		<p>
			<?php echo Text::sprintf('SOLO_RESTORE_LABEL_SUCCESS_INFO_HASURL', $this->siteURL, $this->siteURL); ?>
		</p>
		<?php endif; ?>
	</div>

	<?php if (!empty($this->siteURL)): ?>
		<p>
			<button class="akeeba-btn--primary" id="restoration-runinstaller" onclick="akeeba.Restore.runInstaller('<?php echo $this->siteURL?>'); return false;">
				<span class="akion-android-share"></span>
				<?php echo Text::_('SOLO_RESTORE_BTN_INSTALLER'); ?>
			</button>
		</p>
		<p>
			<button class="akeeba-btn--green" id="restoration-finalize" style="display: none;" onclick="akeeba.Restore.finalize(); return false;">
				<span class="akion-android-exit"></span>
				<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_FINALIZE'); ?>
			</button>
		</p>
	<?php else: ?>
		<button class="akeeba-btn--green" id="restoration-finalize" onclick="akeeba.Restore.finalize(); return false;">
			<span class="akion-android-exit"></span>
			<?php echo Text::_('COM_AKEEBA_RESTORE_LABEL_FINALIZE'); ?>
		</button>
	<?php endif; ?>
</div>
