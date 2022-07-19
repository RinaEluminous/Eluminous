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

<?php
// Configuration Wizard prompt
if (!\Akeeba\Engine\Factory::getConfiguration()->get('akeeba.flag.confwiz', 0))
{
	echo $this->loadAnyTemplate('Configuration/confwiz_modal');
}
?>

<?php /* AdBlock warning */ ?>
<?php echo $this->loadAnyTemplate('Main/warning_adblock') ?>

<?php /* Stuck database updates warning */ ?>
<?php if ($this->stuckUpdates):
	$resetUrl = $router->route('index.php?view=Main&task=forceUpdateDb');
	?>
    <div class="akeeba-block--failure">
        <p>
			<?php
			echo Text::sprintf('COM_AKEEBA_CPANEL_ERR_UPDATE_STUCK',
				$this->getContainer()->appConfig->get('prefix', 'solo_'),
				$resetUrl
			) ?>
        </p>
    </div>
<?php endif; ?>

<?php if (!$this->checkMbstring): ?>
    <div class="akeeba-block--failure">
		<?php echo Text::sprintf('COM_AKEEBA_CPANEL_ERR_MBSTRING_' . ($inCMS ? 'WORDPRESS' : 'SOLO'), PHP_VERSION) ?>
    </div>
<?php endif; ?>

<?php if (!empty($this->frontEndSecretWordIssue)): ?>
    <div class="akeeba-block--warning">
        <h3><?php echo Text::_('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_HEADER'); ?></h3>
        <p><?php echo Text::_('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_INTRO'); ?></p>
        <p><?php echo $this->frontEndSecretWordIssue ?></p>
        <p>
			<?php echo Text::_('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_WHATTODO_SOLO'); ?>
			<?php echo Text::sprintf('COM_AKEEBA_CPANEL_ERR_FESECRETWORD_WHATTODO_COMMON', $this->newSecretWord); ?>
        </p>
        <p>
            <a class="akeeba-btn--green--large"
               href="<?php echo $router->route('index.php?view=Main&task=resetSecretWord&' . $token . '=1') ?>">
                <span class="akion-android-refresh"></span>
				<?php echo Text::_('COM_AKEEBA_CPANEL_BTN_FESECRETWORD_RESET'); ?>
            </a>
        </p>
    </div>
<?php endif; ?>

<?php echo $this->loadAnyTemplate('Main/warning_phpversion') ?>
<?php
// Obsolete PHP version check
if (version_compare(PHP_VERSION, '5.6.0', 'lt')):
	$akeebaCommonDatePHP = new \Awf\Date\Date('2016-07-21 00:00:00', 'GMT');
	$akeebaCommonDateObsolescence = new \Awf\Date\Date('2017-04-21 00:00:00', 'GMT');
	?>
    <div id="phpVersionCheck" class="akeeba-block--warning">
        <h3><?php echo Text::_('COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_TITLE'); ?></h3>
        <p>
			<?php echo Text::sprintf(
				'COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_BODY',
				PHP_VERSION,
				$akeebaCommonDatePHP->format(Text::_('DATE_FORMAT_LC1')),
				$akeebaCommonDateObsolescence->format(Text::_('DATE_FORMAT_LC1')),
				'7.0'
			);
			?>
        </p>
    </div>
<?php endif; ?>


<?php if (!empty($this->configUrl)): ?>
    <div class="akeeba-block--failure" id="config-readable-error" style="display: none">
        <h3>
			<?php echo Text::_('SOLO_MAIN_ERR_CONFIGREADABLE_HEAD'); ?>
        </h3>
        <p>
			<?php echo Text::sprintf('SOLO_MAIN_ERR_CONFIGREADABLE_BODY', $this->configUrl); ?>
        </p>
    </div>
<?php endif; ?>

<?php if (!empty($this->backupUrl)): ?>
    <div class="akeeba-block--failure" id="output-readable-error" style="display: none">
        <h3>
			<?php echo Text::_('SOLO_MAIN_ERR_OUTPUTREADABLE_HEAD'); ?>
        </h3>
        <p>
			<?php echo Text::sprintf('SOLO_MAIN_ERR_OUTPUTREADABLE_BODY', $this->backupUrl); ?>
        </p>
    </div>
<?php endif; ?>

<?php if ($this->needsDownloadId): ?>
    <div class="akeeba-block--success">
        <h3>
			<?php echo Text::_('COM_AKEEBA_CPANEL_MSG_MUSTENTERDLID') ?>
        </h3>
        <p>
			<?php if ($inCMS): ?>
				<?php echo Text::sprintf('COM_AKEEBA_LBL_CPANEL_NEEDSDLID', 'https://www.akeebabackup.com/instructions/1557-akeeba-solo-download-id-2.html'); ?>
			<?php else: ?>
				<?php echo Text::sprintf('COM_AKEEBA_LBL_CPANEL_NEEDSDLID', 'https://www.akeebabackup.com/instructions/1539-akeeba-solo-download-id.html'); ?>
			<?php endif; ?>
        </p>
        <form name="dlidform" action="<?php echo $router->route('index.php?view=main') ?>" method="post"
              class="akeeba-form--inline">
            <input type="hidden" name="task" value="applyDownloadId"/>
            <input type="hidden" name="token"
                   value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>">

            <div class="akeeba-form-group">
                <label for="dlid">
					<?php echo Text::_('COM_AKEEBA_CPANEL_MSG_PASTEDLID') ?>
                </label>
                <input type="text" id="dlid" name="dlid"
                       placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_DOWNLOADID_LABEL') ?>" class="form-control">
            </div>
            <div class="akeeba-form-group--actions">
                <button type="submit" class="akeeba-btn--green">
                    <span class="akion-checkmark"></span>
					<?php echo Text::_('COM_AKEEBA_CPANEL_MSG_APPLYDLID') ?>
                </button>
            </div>
        </form>
    </div>
<?php elseif ($this->warnCoreDownloadId): ?>
    <div class="akeeba-block--failure">
		<?php echo Text::_('SOLO_MAIN_LBL_NEEDSUPGRADE'); ?>
    </div>
<?php endif; ?>

<div class="akeeba-block--failure" style="display: none;" id="cloudFlareWarn">
    <h3><?php echo Text::_('COM_AKEEBA_CPANEL_MSG_CLOUDFLARE_WARN') ?></h3>
    <p><?php echo Text::sprintf('COM_AKEEBA_CPANEL_MSG_CLOUDFLARE_WARN1', 'https://support.cloudflare.com/hc/en-us/articles/200169456-Why-is-JavaScript-or-jQuery-not-working-on-my-site-') ?></p>
</div>
