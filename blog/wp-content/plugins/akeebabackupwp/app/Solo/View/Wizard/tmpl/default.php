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

echo $this->loadAnyTemplate('Common/folder_browser');
?>

<div class="akeeba-block--info">
	<?php echo Text::_('SOLO_WIZARD_LBL_INTRO'); ?>
</div>

<form action="<?php echo $router->route('index.php?view=wizard&task=applySiteSettings') ?>" method="post"
      role="form" class="akeeba-form--horizontal--with-hidden" id="adminForm">

    <div class="akeeba-panel--info">
		<header class="akeeba-block-header">
			<h3>
				<?php echo Text::_('SOLO_WIZARD_LBL_SITEROOT_TITLE') ?>
			</h3>
		</header>

        <p><?php echo Text::_('SOLO_WIZARD_LBL_SITEROOT_INTRO');?></p>

        <div class="akeeba-form-group">
            <label for="var[akeeba.platform.site_url]">
			    <?php echo Text::_('SOLO_CONFIG_PLATFORM_SITEURL_TITLE')?>
            </label>
            <input type="text" id="var[akeeba.platform.site_url]"
                   name="var[akeeba.platform.site_url]" size="30"
                   value="<?php echo $this->siteInfo->url ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_SITEURL_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group">
            <label for="var[akeeba.platform.newroot]">
			    <?php echo Text::_('SOLO_CONFIG_PLATFORM_NEWROOT_TITLE')?>
            </label>
            <div class="akeeba-input-group">
                <input type="text"  id="var[akeeba.platform.newroot]"
                       name="var[akeeba.platform.newroot]" size="30"
                       value="<?php echo $this->siteInfo->root ?>">
                <span class="akeeba-input-group-btn">
                    <button title="<?php echo Text::_('COM_AKEEBA_CONFIG_UI_BROWSE')?>" class="akeeba-btn--teal" id="btnBrowse">
                        <span class="akion-android-folder-open"></span>
                    </button>
                </span>
            </div>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_NEWROOT_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group--pull-right">
            <div class="akeeba-form-group--actions">
                <button class="akeeba-btn--green--big" id="btnPythia" onclick="return false;">
                    <span class="akion-wand"></span>
		            <?php echo Text::_('SOLO_WIZARD_BTN_PYTHIA') ?>
                </button>
            </div>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_WIZARD_BTN_PYTHIA_HELP'); ?>
            </p>
        </div>
	</div>

	<div class="akeeba-panel--info">
		<header class="akeeba-block-header">
			<h3>
				<?php echo Text::_('SOLO_WIZARD_LBL_DBINFO_TITLE') ?>
			</h3>
		</header>


        <p><?php echo Text::_('SOLO_WIZARD_LBL_DBINFO_INTRO');?></p>

        <div class="akeeba-form-group">
            <label for="var[akeeba.platform.dbdriver]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBDRIVER_TITLE')?>
            </label>
	        <?php echo \Solo\Helper\Utils::engineDatabaseTypesSelect($config->get('akeeba.platform.dbdriver', 'mysqli'), 'var[akeeba.platform.dbdriver]'); ?>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBDRIVER_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="host-wrapper">
            <label for="var[akeeba.platform.dbhost]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBHOST_TITLE')?>
            </label>
            <input type="text"  id="var[akeeba.platform.dbhost]"
                   name="var[akeeba.platform.dbhost]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbhost', 'localhost') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBHOST_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="port-wrapper">
            <label for="var[akeeba.platform.dbport]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPORT_TITLE')?>
            </label>
            <input type="text"  id="var[akeeba.platform.dbport]"
                   name="var[akeeba.platform.dbport]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbport', '') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPORT_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="user-wrapper">
            <label for="var[akeeba.platform.dbusername]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBUSERNAME_TITLE')?>
            </label>
            <input type="text"  id="var[akeeba.platform.dbusername]"
                   name="var[akeeba.platform.dbusername]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbusername', '') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBUSERNAME_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="pass-wrapper">
            <label for="var[akeeba.platform.dbpassword]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPASSWORD_TITLE')?>
            </label>
            <input type="password"  id="var[akeeba.platform.dbpassword]"
                   name="var[akeeba.platform.dbpassword]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbpassword', '') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPASSWORD_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="name-wrapper">
            <label for="var[akeeba.platform.dbname]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBDATABASE_TITLE')?>
            </label>
            <input type="text"  id="var[akeeba.platform.dbname]"
                   name="var[akeeba.platform.dbname]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbname', '') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBDATABASE_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group" id="prefix-wrapper">
            <label for="var[akeeba.platform.dbprefix]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPREFIX_TITLE')?>
            </label>
            <input type="text"  id="var[akeeba.platform.dbprefix]"
                   name="var[akeeba.platform.dbprefix]" size="30"
                   value="<?php echo $config->get('akeeba.platform.dbprefix', '') ?>">
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_DBPREFIX_DESCRIPTION'); ?>
            </p>
        </div>
    </div>

	<div class="akeeba-panel--info">
		<header class="akeeba-block-header">
			<h3>
				<?php echo Text::_('SOLO_WIZARD_LBL_SITEINFO_TITLE') ?>
			</h3>
		</header>

        <p><?php echo Text::_('SOLO_WIZARD_LBL_SITEINFO_INTRO');?></p>

        <div class="akeeba-form-group">
            <label for="var[akeeba.platform.scripttype]" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_SCRIPTTYPE_TITLE')?>
            </label>
	        <?php echo \Solo\Helper\Setup::scriptTypesSelect($config->get('akeeba.platform.scripttype', 'generic'), 'var[akeeba.platform.scripttype]'); ?>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_SCRIPTTYPE_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group">
            <label for="extradirs" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_EXTRADIRS_TITLE')?>
            </label>
            <span id="pythiaExtradirs">&nbsp;</span>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_EXTRADIRS_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group">
            <label for="extradirs" >
				<?php echo Text::_('SOLO_CONFIG_PLATFORM_EXTRADB_TITLE')?>
            </label>
            <span id="pythiaExtradb">&nbsp;</span>
            <p class="akeeba-help-text">
		        <?php echo Text::_('SOLO_CONFIG_PLATFORM_EXTRADB_DESCRIPTION'); ?>
            </p>
        </div>

        <div class="akeeba-form-group">
            <label for="var[akeeba.advanced.embedded_installer]" >
				<?php echo Text::_('COM_AKEEBA_CONFIG_INSTALLER_TITLE')?>
            </label>
	        <?php echo \Solo\Helper\Setup::restorationScriptSelect($config->get('akeeba.advanced.embedded_installer', 'generic'), 'var[akeeba.advanced.embedded_installer]'); ?>
            <p class="akeeba-help-text">
		        <?php echo Text::_('COM_AKEEBA_CONFIG_INSTALLER_DESCRIPTION'); ?>
            </p>
        </div>
    </div>

    <div class="akeeba-form-group--actions">
        <button id="btnWizardSiteConfigSubmit" type="submit" class="akeeba-btn--primary--big">
		    <?php echo Text::_('SOLO_BTN_SUBMIT') ?>
        </button>
    </div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>"/>
    </div>

</form>
