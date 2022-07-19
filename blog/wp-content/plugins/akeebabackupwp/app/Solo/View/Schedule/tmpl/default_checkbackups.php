<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var   \Solo\View\Schedule\Html  $this */
?>
<h2>
	<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CHECK_BACKUPS'); ?>
</h2>

<p>
    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_HEADERINFO'); ?>
</p>

<div class="akeeba-panel--information">
    <header class="akeeba-block-header">
        <h3>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CLICRON') ?>
        </h3>
    </header>

	<?php if (AKEEBABACKUP_PRO): ?>
    <div class="akeeba-block--info">
        <p>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CLICRON_INFO') ?>
        </p>
        <p>
            <a class="akeeba-btn--teal" href="https://www.akeebabackup.com/documentation/akeeba-solo/native-cron-script.html" target="_blank">
		        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_GENERICREADDOC') ?>
            </a>
        </p>
    </div>

    <p>
        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_GENERICUSECLI') ?>
        <code>
            <?php echo $this->checkinfo->info->php_path ?>
            <?php echo $this->checkinfo->cli->path ?>
        </code>
    </p>
    <p>
        <span class="akeeba-label--warning"><?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CLIGENERICIMPROTANTINFO'); ?></span>
        <?php echo Text::sprintf('COM_AKEEBA_SCHEDULE_LBL_CLIGENERICINFO', $this->croninfo->info->php_path); ?>
    </p>
    <?php else: ?>
        <div class="akeeba-block--warning">
            <p>
				<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_UPGRADETOPRO'); ?></p>
            <p>
                <a class="akeeba-btn--green" href="https://www.akeebabackup.com/subscribe.html" target="_blank">
                    <span class="akion-card"></span>
					<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_UPGRADENOW'); ?>
                </a>
            </p>
        </div>
    <?php endif; ?>
</div>

<div class="akeeba-panel--information">
    <header class="akeeba-block-header">
        <h3>
	        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_ALTCLICRON') ?>
        </h3>
    </header>

	<?php if (AKEEBABACKUP_PRO): ?>
        <div class="akeeba-block--info">
            <p>
                <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_ALTCLICRON_INFO') ?>
            </p>
            <p>
                <a class="akeeba-btn--teal" href="https://www.akeebabackup.com/documentation/akeeba-solo/alternative-cron-script.html" target="_blank">
		            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_GENERICREADDOC') ?>
                </a>
            </p>
        </div>
        <?php if(!$this->checkinfo->info->feenabled): ?>
            <div class="akeeba-block--failure">
                <p>
	                <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_DISABLED'); ?>
                </p>
            </div>
        <?php elseif(!trim($this->croninfo->info->secret)): ?>
            <div class="akeeba-block--failure">
                <p>
	                <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_SECRET'); ?>
                </p>
            </div>
        <?php else: ?>
            <p>
                <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_GENERICUSECLI') ?>
                <code>
                    <?php echo $this->checkinfo->info->php_path ?>
                    <?php echo $this->checkinfo->altcli->path ?>
                </code>
            </p>
            <p>
                <span class="akeeba-label--warning"><?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_CLIGENERICIMPROTANTINFO'); ?></span>
                <?php echo Text::sprintf('COM_AKEEBA_SCHEDULE_LBL_CLIGENERICINFO', $this->checkinfo->info->php_path); ?>
            </p>
        <?php endif; ?>
	<?php else: ?>
        <div class="akeeba-block--warning">
            <p>
				<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_UPGRADETOPRO'); ?></p>
            <p>
                <a class="akeeba-btn--green" href="https://www.akeebabackup.com/subscribe.html" target="_blank">
                    <span class="akion-card"></span>
					<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_UPGRADENOW'); ?>
                </a>
            </p>
        </div>
	<?php endif; ?>
</div>

<div class="akeeba-panel--information">
    <header>
        <h3>
	        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP') ?>
        </h3>
    </header>

    <div class="<?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP') ?>">
        <p>
	        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_INFO') ?>
        </p>
        <p>
            <a class="akeeba-btn--info" href="https://www.akeebabackup.com/documentation/akeeba-solo/automating-your-backup.html#frontend-backup" target="_blank">
		        <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_GENERICREADDOC') ?>
            </a>
        </p>
    </div>
    <?php if(!$this->checkinfo->info->feenabled): ?>
        <div class="akeeba-block--failure">
            <p>
                <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_DISABLED'); ?>
            </p>
        </div>
    <?php elseif(!trim($this->checkinfo->info->secret)): ?>
        <div class="akeeba-block--failure">
            <p>
	            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_SECRET'); ?>
            </p>
        </div>
    <?php else: ?>
        <p>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_MANYMETHODS'); ?>
        </p>


        <h4>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_WEBCRON'); ?>
        </h4>

        <p>
		    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON') ?>
        </p>

        <table class="akeeba-table--striped" width="100%">
            <tr>
                <td></td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_NAME') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_NAME_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_TIMEOUT') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_TIMEOUT_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_URL') ?>
                </td>
                <td>
				    <?php echo $this->checkinfo->info->root_url.'/'.$this->checkinfo->frontend->path ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGIN') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGINPASSWORD_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_PASSWORD') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_LOGINPASSWORD_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_EXECUTIONTIME') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_EXECUTIONTIME_INFO') ?>
                </td>
            </tr>
            <tr>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_ALERTS') ?>
                </td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_ALERTS_INFO') ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
				    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WEBCRON_THENCLICKSUBMIT') ?>
                </td>
            </tr>
        </table>

        <h4>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_WGET'); ?>
        </h4>

        <p>
		    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_WGET') ?>
            <code>
                wget --max-redirect=10000 "<?php echo $this->checkinfo->info->root_url.'/'.$this->checkinfo->frontend->path ?>" -O - 1>/dev/null 2>/dev/null
            </code>
        </p>

        <h4>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_CURL'); ?>
        </h4>

        <p>
		    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_CURL') ?>
            <code>
                curl -L --max-redirs 1000 -v "<?php echo $this->checkinfo->info->root_url.'/'.$this->checkinfo->frontend->path ?>" 1>/dev/null 2>/dev/null
            </code>
        </p>

        <h4>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_SCRIPT'); ?>
        </h4>


        <p>
		    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_CUSTOMSCRIPT') ?>
        </p>

        <pre>
<?php echo '&lt;?php'; ?>

$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL, '<?php echo $this->checkinfo->info->root_url.'/'.$this->checkinfo->frontend->path ?>');
curl_setopt($curl_handle,CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl_handle,CURLOPT_MAXREDIRS, 10000);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER, 1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);
if (empty($buffer))
    echo "Sorry, the backup didn't work.";
else
    echo $buffer;
<?php echo '?&gt;'; ?>
        </pre>

        <h4>
            <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTENDBACKUP_TAB_URL'); ?>
        </h4>

        <p>
		    <?php echo Text::_('COM_AKEEBA_SCHEDULE_LBL_FRONTEND_RAWURL') ?>
            <code>
			    <?php echo $this->checkinfo->info->root_url ?>/<?php echo $this->checkinfo->frontend->path ?>
            </code>
        </p>
<?php endif; ?>
