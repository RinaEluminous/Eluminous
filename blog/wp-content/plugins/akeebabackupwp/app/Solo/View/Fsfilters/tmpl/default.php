<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Fsfilters\Html $this */

$router = $this->container->router;

$js = <<< JS

akeeba.loadScripts.push(function() {
    akeeba.Fsfilters.render(akeeba_fsfilter_data);	
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

echo $this->loadAnyTemplate('Common/error_modal');
?>

<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<div class="akeeba-block--info">
	<strong><?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?></strong>
	#<?php echo $this->profileid; ?> <?php echo $this->profilename; ?>
</div>

<form class="akeeba-form--inline akeeba-panel--info">
    <div class="akeeba-form-group">
		<label><?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_ROOTDIR') ?></label>
		<span><?php echo $this->root_select; ?></span>
	</div>

    <div class="akeeba-form-group--actions">
        <button class="akeeba-btn--red" onclick="akeeba.Fsfilters.nuke(); return false;">
            <span class="akion-ios-trash"></span>
			<?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_NUKEFILTERS'); ?>
        </button>
    </div>
</form>

<div id="ak_crumbs_container" class="akeeba-panel--100 akeeba-panel--information">
    <div>
        <ul id="ak_crumbs" class="akeeba-breadcrumb"></ul>
    </div>
</div>


<div class="akeeba-container--50-50">
    <div>
        <div class="akeeba-panel--info">
            <header class="akeeba-block-header">
                <h3>
					<?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_DIRS'); ?>
                </h3>
            </header>
            <div id="folders"></div>
        </div>
    </div>

    <div>
        <div class="akeeba-panel--info">
            <header class="akeeba-block-header">
                <h3>
					<?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_FILES'); ?>
                </h3>
            </header>
            <div id="files"></div>
        </div>
    </div>
</div>

<div class="clear"></div>
