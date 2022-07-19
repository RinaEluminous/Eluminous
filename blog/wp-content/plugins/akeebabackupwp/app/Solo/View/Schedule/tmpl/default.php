<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var   \Solo\View\Schedule\Html  $this */
?>

<?php if (!AKEEBABACKUP_PRO): ?>
	<div style="border: thick solid green; border-radius: 10pt; padding: 1em; background-color: #f0f0ff; color: #333; font-weight: bold; text-align: center; margin: 1em 0">
		<p><?php echo Text::_('SOLO_MAIN_LBL_SUBSCRIBE_TEXT') ?></p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: center; margin: 0px;">
			<input type="hidden" name="cmd" value="_s-xclick" />
			<input type="hidden" name="hosted_button_id" value="3NTKQ3M2DYPYW" />
			<button onclick="this.form.submit(); return false;" class="akeeba-btn--green">
				<img src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0">
				Donate via PayPal
			</button>
			<a class="small" style="font-weight: normal; color: #666" href="https://www.akeebabackup.com/subscribe/new/backupwp.html?layout=default">
				<?php echo Text::_('SOLO_MAIN_BTN_SUBSCRIBE_UNOBTRUSIVE'); ?>
			</a>
		</form>
	</div>
<?php endif; ?>

<div class="akeeba-tabs">
    <label for="absTabRunBackups" class="active">
		<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_RUN_BACKUPS'); ?>
    </label>
    <section id="absTabRunBackups">
	    <?php echo $this->loadTemplate('runbackups'); ?>
    </section>

    <label for="absTabCheckBackups">
		<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CHECK_BACKUPS'); ?>
    </label>
    <section id="absTabCheckBackups">
	    <?php echo $this->loadTemplate('checkbackups'); ?>
    </section>
</div>

<p></p>
