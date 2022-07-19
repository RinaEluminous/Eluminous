<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Dbfilters\Html $this */

$router = $this->container->router;

$js = <<< JS

akeeba.loadScripts.push(function() {
    akeeba.Dbfilters.render(akeeba_dbfilter_data);	
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

echo $this->loadAnyTemplate('Common/error_modal');
?>

<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<div class="akeeba-block--info">
	<strong><?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?></strong>
	#<?php echo $this->profileid; ?> <?php echo htmlentities($this->profilename); ?>
</div>

<form class="akeeba-form--inline akeeba-panel--info">
    <div class="akeeba-form-group">
        <label>
		    <?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_ROOTDIR'); ?>
        </label>
        <span><?php echo $this->root_select; ?></span>
    </div>

    <div class="akeeba-form-group--actions">
		<button class="akeeba-btn--red" onclick="akeeba.Dbfilters.nuke(); return false;">
			<span class="akion-ios-loop-strong"></span>
			<?php echo Text::_('COM_AKEEBA_DBFILTER_LABEL_NUKEFILTERS'); ?>
		</button>
		<button class="akeeba-btn--green" onclick="akeeba.Dbfilters.excludeNonCMS(); return false;">
			<span class="akion-ios-flag"></span>
			<?php echo Text::_('COM_AKEEBA_DBFILTER_LABEL_EXCLUDENONCORE'); ?>
		</button>
	</div>
</form>

<div class="akeeba-panel--info">
    <header class="akeeba-block-header">
        <h3>
			<?php echo Text::_('COM_AKEEBA_DBFILTER_LABEL_TABLES'); ?>
        </h3>
    </header>
    <div id="tables"></div>
</div>
