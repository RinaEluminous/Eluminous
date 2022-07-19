<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 *
 * @var \Solo\View\Backup\Html $this
 */

use Akeeba\Engine\Factory;
use Awf\Text\Text;

/** @var \Solo\View\Backup\Html $this */

$router = $this->container->router;
$config = Factory::getConfiguration();

$quirks_style = $this->hasErrors ? 'akeeba-block--failure' : 'akeeba-block--warning';
$formstyle = $this->hasErrors ? 'style="display: none"' : '';

$configuration = Factory::getConfiguration();

?>
<?php
// Configuration Wizard prompt
if (!\Akeeba\Engine\Factory::getConfiguration()->get('akeeba.flag.confwiz', 0))
{
	echo $this->loadAnyTemplate('Configuration/confwiz_modal');
}
?>

<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<?php echo $this->loadAnyTemplate('Main/warning_phpversion') ?>

<div id="backup-setup" class="akeeba-panel--primary">
    <header class="akeeba-block-header">
        <h3>
	        <?php echo Text::_('COM_AKEEBA_BACKUP_HEADER_STARTNEW') ?>
        </h3>
    </header>

	<?php if ($this->hasQuirks && !$this->unwritableOutput): ?>
		<div id="quirks" class="<?php echo $quirks_style ?>">
            <h3 class="alert-heading">
				<?php if (!$this->hasCriticalErrors): ?>
					<?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_DETECTEDQUIRKS') ?>
				<?php else: ?>
					<?php echo Text::_('COM_AKEEBA_CPANEL_LBL_STATUS_ERROR') ?>
				<?php endif; ?>
			</h3>
			<p>
                <?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_QUIRKSLIST') ?>
            </p>
			<ul>
			<?php foreach ($this->quirks as $quirk):
				switch ($quirk['severity'])
				{
					case 'critical':
						$classSufix = 'red';
						break;

					case 'high':
						$classSufix = 'orange';
						break;

					case 'medium':
						$classSufix = 'teal';
						break;

					default:
						$classSufix = 'grey';
						break;
				}
			?>
			<li>
				<a href="<?php echo $quirk['help_url']; ?>" target="_blank">
					<span class="akeeba-label--<?php echo $classSufix ?>">
						S<?php echo $quirk['code']; ?>
					</span>
					<?php echo $quirk['description']; ?>
				</a>
			</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if($this->unwritableOutput): $formstyle="style=\"display: none;\"" ?>
		<div id="akeeba-fatal-outputdirectory" class="akeeba-block--failure">
            <h3>
				<?php echo Text::_('COM_AKEEBA_BACKUP_ERROR_UNWRITABLEOUTPUT_' . ($this->autoStart ? 'AUTOBACKUP' : 'NORMALBACKUP')); ?>
            </h3>

			<p>
				<?php echo Text::sprintf(
					'COM_AKEEBA_BACKUP_ERROR_UNWRITABLEOUTPUT_COMMON',
					$router->route('index.php?view=configuration'),
					'https://www.akeebabackup.com/warnings/q001.html'
				) ?>
			</p>
		</div>
	<?php endif; ?>

	<?php if(!$this->unwritableOutput && !$this->hasCriticalErrors):?>
    <form action="<?php echo $router->route('index.php?view=backup')?>" method="post" name="profileForm"
          id="profileForm" autocomplete="off" class="akeeba-formstyle-reset akeeba-panel--information akeeba-form--inline">

        <div class="akeeba-form-group">
            <label for="profile">
                <?php echo Text ::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?>: #<?php echo $this->profileId; ?>
            </label>
            <?php echo \Awf\Html\Select::genericList($this->profileList, 'profile', array('onchange' => "document.forms.profileForm.submit()"), 'value', 'text', $this->profileId); ?>
        </div>

        <div class="akeeba-form-group--actions">
            <button class="akeeba-btn--grey" onclick="this.form.submit(); return false;">
                <span class="akion-refresh"></span>
                <?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_BUTTON'); ?>
            </button>
        </div>

        <div class="akeeba-form-group--actions akeeba-hidden-fields-container">
            <input type="hidden" name="returnurl" value="<?php htmlentities($this->returnURL, ENT_COMPAT, 'UTF-8', false) ?>" />
            <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>" />
        </div>
    </form>
	<?php endif; ?>

	<form id="dummyForm" <?php echo $formstyle ?> class="akeeba-form--horizontal" role="form">
		<div class="akeeba-form-group">
			<label for="description">
				<?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_DESCRIPTION'); ?>
			</label>
            <input type="text" name="description" value="<?php echo $this->description; ?>"
                   maxlength="255" size="80" id="backup-description"
                   autocomplete="off" />
            <span class="akeeba-help-text"><?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_DESCRIPTION_HELP'); ?></span>
		</div>

		<?php if ($this->showJPSKey): ?>
			<div class="akeeba-form-group">
				<label for="jpskey">
					<?php echo Text::_('COM_AKEEBA_CONFIG_JPS_KEY_TITLE'); ?>
				</label>
                <input type="password" name="jpskey" value="<?php echo htmlentities($this->jpsKey, ENT_COMPAT, 'UTF-8', false) ?>"
                       size="50" id="jpskey" autocomplete="off" />
                <span class="akeeba-help-text"><?php echo Text::_('COM_AKEEBA_CONFIG_JPS_KEY_DESCRIPTION'); ?></span>
			</div>
		<?php endif; ?>
		<?php if ($this->showANGIEKey): ?>
			<div class="akeeba-form-group">
				<label for="angiekey">
					<?php echo Text::_('COM_AKEEBA_CONFIG_ANGIE_KEY_TITLE'); ?>
				</label>
                <input type="password" name="angiekey" value="<?php echo htmlentities($this->angieKey, ENT_COMPAT, 'UTF-8', false) ?>"
                       size="50" id="angiekey" autocomplete="off" />
                <span class="akeeba-help-text"><?php echo Text::_('COM_AKEEBA_CONFIG_ANGIE_KEY_DESCRIPTION'); ?></span>
			</div>
		<?php endif; ?>
		<div class="akeeba-form-group">
			<label for="comment">
				<?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_COMMENT'); ?>
			</label>
            <textarea name="comment" id="comment" rows="5" cols="73" autocomplete="off"><?php echo $this->comment ?></textarea>
            <span class="akeeba-help-text"><?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_COMMENT_HELP'); ?></span>
		</div>
		<div class="akeeba-form-group--pull-right">
			<div class="akeeba-form-group--actions">
				<button class="akeeba-btn--primary" id="backup-start" onclick="return false;">
					<span class="akion-play"></span>
					<?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_START') ?>
				</button>
				<span class="akeeba-btn--orange" id="backup-default">
					<span class="akion-refresh"></span>
					<?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_RESTORE_DEFAULT')?>
				</span>
				<a class="akeeba-btn--red--small" id="backup-cancel" href="<?php echo $router->route('index.php?view=main') ?>">
					<span class="akion-chevron-left"></span>
					<?php echo Text::_('COM_AKEEBA_CONTROLPANEL')?>
				</a>
			</div>
		</div>
	</form>
</div>

<div id="angie-password-warning" class="akeeba-block--warning" style="display: none">
	<h3><?php echo Text::_('COM_AKEEBA_BACKUP_ANGIE_PASSWORD_WARNING_HEADER')?></h3>

	<p><?php echo Text::_('COM_AKEEBA_BACKUP_ANGIE_PASSWORD_WARNING_1')?></p>
	<p><?php echo Text::_('COM_AKEEBA_BACKUP_ANGIE_PASSWORD_WARNING_2')?></p>
	<p><?php echo Text::_('COM_AKEEBA_BACKUP_ANGIE_PASSWORD_WARNING_3')?></p>
</div>

<div id="backup-progress-pane" style="display: none">
	<div class="akeeba-block--info">
		<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKINGUP'); ?>
	</div>

    <div class="akeeba-panel--primary">
        <header class="akeeba-block-header">
            <h3>
	            <?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_PROGRESS') ?>
            </h3>
        </header>

		<div id="backup-progress-content">
			<div id="backup-steps">
			</div>
			<div id="backup-status" class="backup-steps-container">
				<div id="backup-step"></div>
				<div id="backup-substep"></div>
			</div>
			<div id="backup-percentage" class="akeeba-progress">
				<div class="bar akeeba-progress-fill" role="progressbar" style="width: 0%"></div>
			</div>
			<div id="response-timer">
				<div class="color-overlay"></div>
				<div class="text"></div>
			</div>
		</div>
		<span id="ajax-worker"></span>
	</div>
</div>

<div id="backup-complete" style="display: none">
	<div class="akeeba-panel--success">
        <header class="akeeba-block-header">
            <h3>
		        <?php echo Text::_(empty($this->returnURL) ? 'COM_AKEEBA_BACKUP_HEADER_BACKUPFINISHED' : 'COM_AKEEBA_BACKUP_HEADER_BACKUPWITHRETURNURLFINISHED'); ?>
            </h3>
        </header>

		<div id="finishedframe">
			<p>
				<?php if(empty($this->returnURL)): ?>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_CONGRATS') ?>
				<?php else: ?>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_PLEASEWAITFORREDIRECTION') ?>
				<?php endif; ?>
			</p>

			<?php if(empty($this->returnURL)): ?>
				<a class="akeeba-btn--primary--big" href="<?php echo $router->route('index.php?view=manage') ?>">
					<span class="akion-ios-list"></span>
					<?php echo Text::_('COM_AKEEBA_BUADMIN'); ?>
				</a>
				<a class="akeeba-btn--grey" id="ab-viewlog-success" href="<?php echo $router->route('index.php?view=log&latest=1') ?>">
					<span class="akion-ios-search-strong"></span>
					<?php echo Text::_('COM_AKEEBA_LOG'); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="backup-warnings-panel" style="display:none">
	<div class="akeeba-panel--warning">
        <header class="akeeba-block-header">
            <h3><?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_WARNINGS') ?></h3>
        </header>
		<div id="warnings-list">
		</div>
	</div>
</div>

<div id="retry-panel" style="display: none">
    <div class="akeeba-panel--warning">
        <header class="akeeba-block-header">
            <h3>
		        <?php echo Text::_('COM_AKEEBA_BACKUP_HEADER_BACKUPRETRY'); ?>
            </h3>
        </header>
        <div id="retryframe">
            <p><?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPFAILEDRETRY') ?></p>
            <p>
                <strong>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_WILLRETRY') ?>
                    <span id="akeeba-retry-timeout">0</span>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_WILLRETRYSECONDS') ?>
                </strong>
                <br/>
                <button class="akeeba-btn--red--small" onclick="akeeba.Backup.cancelResume(); return false;">
                    <span class="akion-android-cancel"></span>
					<?php echo Text::_('COM_AKEEBA_MULTIDB_GUI_LBL_CANCEL'); ?>
                </button>
                <button class="akeeba-btn--green--small" onclick="akeeba.Backup.resumeBackup(); return false;">
                    <span class="akion-ios-redo"></span>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BTNRESUME'); ?>
                </button>
            </p>

            <p><?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_LASTERRORMESSAGEWAS') ?></p>
            <p id="backup-error-message-retry">
            </p>
        </div>
    </div>
</div>

<div id="error-panel" style="display: none">
	<div class="akeeba-panel--red">
        <header class="akeeba-block-header">
            <h3>
		        <?php echo Text::_('COM_AKEEBA_BACKUP_HEADER_BACKUPFAILED'); ?>
            </h3>
        </header>

        <div id="errorframe">
			<p>
				<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKUPFAILED') ?>
			</p>
			<p id="backup-error-message">
			</p>

			<p>
				<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_READLOGFAILPRO') ?>
			</p>

            <div class="akeeba-block--info" id="error-panel-troubleshooting">
				<p>
					<?php if(AKEEBABACKUP_PRO): ?>
					<?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_RTFMTOSOLVEPRO') ?>
                    <?php endif; ?>
					<?php echo Text::sprintf('COM_AKEEBA_BACKUP_TEXT_RTFMTOSOLVE', 'https://www.akeebabackup.com/documentation/troubleshooter/abbackup.html?utm_source=akeeba_backup&utm_campaign=backuperrorlink') ?>
				</p>
				<p>
					<?php if(AKEEBABACKUP_PRO):?>
						<?php echo Text::sprintf('COM_AKEEBA_BACKUP_TEXT_SOLVEISSUE_PRO', 'https://www.akeebabackup.com/support.html?utm_source=akeeba_backup&utm_campaign=backuperrorpro') ?>
					<?php else: ?>
						<?php echo Text::sprintf('COM_AKEEBA_BACKUP_TEXT_SOLVEISSUE_CORE', 'https://www.akeebabackup.com/subscribe.html?utm_source=akeeba_backup&utm_campaign=backuperrorcore','https://www.akeebabackup.com/support.html?utm_source=akeeba_backup&utm_campaign=backuperrorcore') ?>
					<?php endif; ?>
					<?php echo Text::sprintf('COM_AKEEBA_BACKUP_TEXT_SOLVEISSUE_LOG', 'index.php?view=log&latest=1') ?>
				</p>
			</div>

			<button id="ab-alice-error" class="akeeba-btn--green" onclick="window.location='<?php echo $router->route('index.php?view=alice') ?>'; return false;">
				<span class="akion-medkit"></span>
				<?php echo Text::_('COM_AKEEBA_BACKUP_ANALYSELOG') ?>
			</button>

            <button class="akeeba-btn--primary" onclick="window.location='https://www.akeebabackup.com/documentation/troubleshooter/abbackup.html?utm_source=akeeba_backup&utm_campaign=backuperrorbutton'; return false;">
				<span class="akion-ios-book"></span>
				<?php echo Text::_('COM_AKEEBA_BACKUP_TROUBLESHOOTINGDOCS') ?>
			</button>

            <button id="ab-viewlog-error" class="akeeba-btn-grey" onclick="window.location='<?php echo $router->route('index.php?view=log&latest=1') ?>'; return false;">
				<span class="akion-ios-search-strong"></span>
				<?php echo Text::_('COM_AKEEBA_LOG'); ?>
			</button>
		</div>
	</div>
</div>
