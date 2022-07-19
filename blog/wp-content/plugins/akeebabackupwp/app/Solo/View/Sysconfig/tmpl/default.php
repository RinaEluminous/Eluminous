<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;

/** @var \Solo\View\Sysconfig\Html $this */

$config = $this->container->appConfig;
$router = $this->container->router;
$inCMS = $this->container->segment->get('insideCMS', false);

echo $this->loadAnyTemplate('Common/ftp_browser');
echo $this->loadAnyTemplate('Common/sftp_browser');
echo $this->loadAnyTemplate('Common/ftp_test');

?>

<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<form action="<?php echo $router->route('index.php?view=sysconfig') ?>" method="POST" id="adminForm"
      class="akeeba-form--horizontal" role="form">
    <div class="akeeba-tabs">
        <label for="sysconfigAppSetup" class="active">
            <span class="akion-ios-cog"></span>
	        <?php echo Text::_('SOLO_SETUP_LBL_APPSETUP') ?>
        </label>
        <section id="sysconfigAppSetup">
	        <?php echo $this->loadAnyTemplate('Sysconfig/appsetup'); ?>
        </section>

        <label for="sysconfigBackupChecks">
            <span class="akion-android-list"></span>
	        <?php echo Text::_('SOLO_SYSCONFIG_BACKUP_CHECKS') ?>
        </label>
        <section id="sysconfigBackupChecks">
	        <?php echo $this->loadAnyTemplate('Sysconfig/backupchecks'); ?>
        </section>

        <label for="sysconfigPublicAPI">
            <span class="akion-android-globe"></span>
	        <?php echo Text::_('SOLO_SYSCONFIG_FRONTEND') ?>
        </label>
        <section id="sysconfigPublicAPI">
	        <?php echo $this->loadAnyTemplate('Sysconfig/publicapi'); ?>
        </section>

        <label for="sysconfigPushNotifications">
            <span class="akion-chatbubble"></span>
	        <?php echo Text::_('SOLO_SYSCONFIG_PUSH') ?>
        </label>
        <section id="sysconfigPushNotifications">
	        <?php echo $this->loadAnyTemplate('Sysconfig/push'); ?>
        </section>

        <label for="sysconfigUpdate">
            <span class="akion-refresh"></span>
	        <?php echo Text::_('SOLO_SYSCONFIG_UPDATE') ?>
        </label>
        <section id="sysconfigUpdate">
	        <?php echo $this->loadAnyTemplate('Sysconfig/update'); ?>
        </section>

        <label for="sysconfigEmail">
            <span class="akion-email"></span>
	        <?php echo Text::_('SOLO_SYSCONFIG_EMAIL') ?>
        </label>
        <section id="sysconfigEmail">
	        <?php echo $this->loadAnyTemplate('Sysconfig/email'); ?>
        </section>

	    <?php if (!$inCMS): ?>
        <label for="sysconfigDatabase">
            <span class="akion-ios-box"></span>
	        <?php echo Text::_('SOLO_SETUP_SUBTITLE_DATABASE') ?>
        </label>
        <section id="sysconfigDatabase">
	        <?php echo $this->loadAnyTemplate('Sysconfig/database'); ?>
        </section>
	    <?php endif; ?>
    </div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue()?>">
    </div>
</form>

<script type="text/javascript">
// Callback routine to close the browser dialog
var akeeba_browser_callback = null;

akeeba.loadScripts.push(function ()
{
	// Initialise the translations
	akeeba.Setup.translations['UI-BROWSE'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_UI_BROWSE')) ?>';
	akeeba.Setup.translations['UI-REFRESH'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_UI_REFRESH')) ?>';
	akeeba.Setup.translations['UI-FTPBROWSER-TITLE'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_UI_FTPBROWSER_TITLE')) ?>';
	akeeba.Setup.translations['UI-ROOT'] = '<?php echo Escape::escapeJS(Text::_('SOLO_COMMON_LBL_ROOT')) ?>';
	akeeba.Setup.translations['UI-TESTFTP-OK'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_DIRECTFTP_TEST_OK')) ?>';
	akeeba.Setup.translations['UI-TESTFTP-FAIL'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_DIRECTFTP_TEST_FAIL')) ?>';
	akeeba.Setup.translations['UI-TESTSFTP-OK'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_OK')) ?>';
	akeeba.Setup.translations['UI-TESTSFTP-FAIL'] = '<?php echo Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_FAIL')) ?>';

	// Push some custom URLs
	akeeba.Setup.URLs['ftpBrowser'] = '<?php echo Escape::escapeJS($router->route('index.php?view=ftpbrowser')) ?>';
	akeeba.Setup.URLs['sftpBrowser'] = '<?php echo Escape::escapeJS($router->route('index.php?view=sftpbrowser')) ?>';
	akeeba.Setup.URLs['testFtp'] = '<?php echo Escape::escapeJS($router->route('index.php?view=configuration&task=testftp')) ?>';
	akeeba.Setup.URLs['testSftp'] = '<?php echo Escape::escapeJS($router->route('index.php?view=configuration&task=testsftp')) ?>';
});

</script>
