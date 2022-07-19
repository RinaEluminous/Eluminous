<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;

/** @var $this \Solo\View\Configuration\Html */

$router = $this->container->router;

$urls = array(
	'browser'      => addslashes($router->route('index.php?view=browser&tmpl=component&processfolder=1&folder=')),
	'ftpBrowser'   => addslashes($router->route('index.php?view=ftpbrowser&tmpl=component')),
	'sftpBrowser'  => addslashes($router->route('index.php?view=sftpbrowser&tmpl=component')),
	'testFtp'      => addslashes($router->route('index.php?view=configuration&task=testftp&format=raw')),
	'testSftp'     => addslashes($router->route('index.php?view=configuration&task=testsftp&format=raw')),
	'dpeauthopen'  => addslashes($router->route('index.php?view=configuration&task=dpeoauthopen&format=raw')),
	'dpecustomapi' => addslashes($router->route('index.php?view=configuration&task=dpecustomapi&format=raw')),
);
$this->json = addcslashes($this->json, "'\\");

$keys = array(
	'COM_AKEEBA_CONFIG_UI_BROWSE'            => 'COM_AKEEBA_CONFIG_UI_BROWSE',
	'COM_AKEEBA_CONFIG_UI_CONFIG'            => 'COM_AKEEBA_CONFIG_UI_CONFIG',
	'COM_AKEEBA_CONFIG_UI_REFRESH'           => 'COM_AKEEBA_CONFIG_UI_REFRESH',
	'COM_AKEEBA_CONFIG_UI_FTPBROWSER_TITLE'  => 'COM_AKEEBA_CONFIG_UI_FTPBROWSER_TITLE',
	'COM_AKEEBA_FILEFILTERS_LABEL_UIROOT'    => 'SOLO_COMMON_LBL_ROOT',
	'COM_AKEEBA_CONFIG_DIRECTFTP_TEST_OK'    => 'COM_AKEEBA_CONFIG_DIRECTFTP_TEST_OK',
	'COM_AKEEBA_CONFIG_DIRECTFTP_TEST_FAIL'  => 'COM_AKEEBA_CONFIG_DIRECTFTP_TEST_FAIL',
	'COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_OK'   => 'COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_OK',
	'COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_FAIL' => 'COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_FAIL',
);
$strings = array();

foreach ($keys as $k => $v)
{
    $strings[$k] = Escape::escapeJS(Text::_($v));
}

$js = <<< JS
akeeba.loadScripts.push(function() {
    	// Initialise the translations
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_UI_BROWSE'] = '{$strings['COM_AKEEBA_CONFIG_UI_BROWSE']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_UI_CONFIG'] = '{$strings['COM_AKEEBA_CONFIG_UI_CONFIG']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_UI_REFRESH'] = '{$strings['COM_AKEEBA_CONFIG_UI_REFRESH']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_UI_FTPBROWSER_TITLE'] = '{$strings['COM_AKEEBA_CONFIG_UI_FTPBROWSER_TITLE']}';
	akeeba.Configuration.translations['COM_AKEEBA_FILEFILTERS_LABEL_UIROOT'] = '{$strings['COM_AKEEBA_FILEFILTERS_LABEL_UIROOT']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_DIRECTFTP_TEST_OK'] = '{$strings['COM_AKEEBA_CONFIG_DIRECTFTP_TEST_OK']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_DIRECTFTP_TEST_FAIL'] = '{$strings['COM_AKEEBA_CONFIG_DIRECTFTP_TEST_FAIL']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_OK'] = '{$strings['COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_OK']}';
	akeeba.Configuration.translations['COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_FAIL'] = '{$strings['COM_AKEEBA_CONFIG_DIRECTSFTP_TEST_FAIL']}';

	// Push some custom URLs
	akeeba.Configuration.URLs['browser'] = '{$urls['browser']}';
	akeeba.Configuration.URLs['ftpBrowser'] = '{$urls['ftpBrowser']}';
	akeeba.Configuration.URLs['sftpBrowser'] = '{$urls['sftpBrowser']}';
	akeeba.Configuration.URLs['testFtp'] = '{$urls['testFtp']}';
	akeeba.Configuration.URLs['testSftp'] = '{$urls['testSftp']}';
	akeeba.Configuration.URLs['dpeauthopen'] = '{$urls['dpeauthopen']}';
	akeeba.Configuration.URLs['dpecustomapi'] = '{$urls['dpecustomapi']}';
	akeeba.System.params.AjaxURL = akeeba.Configuration.URLs['dpecustomapi'];

	// Load the configuration UI data
	akeeba_ui_theme_root = '{$this->mediadir}';
	var data = JSON.parse('{$this->json}');

    // Render the configuration UI in the timeout to prevent Safari from auto-filling the password fields
    akeeba.Configuration.parseConfigData(data);

    // Work around browsers which blatantly ignore autocomplete=off
    setTimeout('akeeba.Configuration.restoreDefaultPasswords();', 1000);

	setTimeout(function(){
		// Enable popovers. Must obviously run after we have the UI set up.
		akeeba.Configuration.enablePopoverFor(document.querySelectorAll('[rel="popover"]'));

		akeeba.jQuery(document.getElementById('var[akeeba.platform.dbdriver]')).change(function(){
			var myVal = this.value;
            var elHost = document.getElementById('akconfigrow.akeeba.platform.dbhost');
            var elPort = document.getElementById('akconfigrow.akeeba.platform.dbport');
            var elUsername = document.getElementById('akconfigrow.akeeba.platform.dbusername');
            var elPassword = document.getElementById('akconfigrow.akeeba.platform.dbpassword');
            var elPrefix = document.getElementById('akconfigrow.akeeba.platform.dbprefix');
            var elName = document.getElementById('akconfigrow.akeeba.platform.dbname');
            
            elHost.style.display = 'grid';
            elPort.style.display = 'grid';
            elUsername.style.display = 'grid';
            elPassword.style.display = 'grid';
            elPrefix.style.display = 'grid';
            elName.style.display = 'grid';

			if ((myVal == 'sqlite') || (myVal == 'none'))
			{
                elHost.style.display = 'none';
                elPort.style.display = 'none';
                elUsername.style.display = 'none';
                elPassword.style.display = 'none';
                elPrefix.style.display = 'none';

                elHost.value = '';
                elPort.value = '';
                elUsername.value = '';
                elPassword.value = '';
                elPrefix.value = '';
			}
			
			if (myVal == 'none')
            {
            	elName.value = '';
            	elName.style.display = 'none';
            }
		})
			.change();
	}, 500);
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

?>

<?php
// Configuration Wizard prompt
if (!\Akeeba\Engine\Factory::getConfiguration()->get('akeeba.flag.confwiz', 0))
{
	echo $this->loadAnyTemplate('Configuration/confwiz_modal');
}
?>

<?php
// Load modal box prototypes
echo $this->loadAnyTemplate('Common/ftp_browser');
echo $this->loadAnyTemplate('Common/sftp_browser');
echo $this->loadAnyTemplate('Common/ftp_test');
echo $this->loadAnyTemplate('Common/error_modal');
echo $this->loadAnyTemplate('Common/folder_browser');

echo $this->loadAnyTemplate('Main/paypal');
?>

<?php if ($this->secureSettings): ?>
    <div class="akeeba-block--success">
		<?php echo Text::_('COM_AKEEBA_CONFIG_UI_SETTINGS_SECURED'); ?>
    </div>
<?php elseif ($this->secureSettings == 0): ?>
    <div class="akeeba-block--failure">
		<?php echo Text::_('COM_AKEEBA_CONFIG_UI_SETTINGS_NOTSECURED'); ?>
    </div>
<?php endif; ?>

<div class="akeeba-block--info">
    <strong><?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?></strong>:
    #<?php echo $this->profileId; ?> <?php echo $this->profileName; ?>
</div>

<div class="akeeba-block--info">
	<?php echo Text::_('COM_AKEEBA_CONFIG_WHERE_ARE_THE_FILTERS'); ?>
</div>


<form name="adminForm" id="adminForm" method="post"
	  action="<?php echo $router->route('index.php?view=configuration') ?>"
      class="akeeba-form--horizontal akeeba-form--with-hidden akeeba-form--configuration">

    <div class="akeeba-panel--info" style="margin-bottom: -1em">
        <header class="akeeba-block-header">
            <h5>
	            <?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION') ?>
            </h5>
        </header>

		<div class="akeeba-form-group">
			<label for="profilename" rel="popover"
				   data-original-title="<?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION') ?>"
				   data-content="<?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION_TOOLTIP') ?>">
				<?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION') ?>
			</label>
            <input type="text" name="profilename" id="profilename" value="<?php echo $this->escape($this->profileName); ?>" />
		</div>

		<div class="akeeba-form-group">
			<label for="quickicon" rel="popover"
				   data-original-title="<?php echo Text::_('COM_AKEEBA_CONFIG_QUICKICON_LABEL') ?>"
				   data-content="<?php echo Text::_('COM_AKEEBA_CONFIG_QUICKICON_DESC') ?>">
				<?php echo Text::_('COM_AKEEBA_CONFIG_QUICKICON_LABEL') ?>
			</label>
            <div>
                <input type="checkbox" name="quickicon"
                       id="quickicon" <?php echo $this->quickicon ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
	</div>

	<!-- This div contains dynamically generated user interface elements -->
	<div id="akeebagui">
	</div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>"/>
    </div>

</form>
