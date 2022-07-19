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
    akeeba.Dbfilters.renderTab(akeeba_dbfilter_data);	
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

echo $this->loadAnyTemplate('Common/error_modal');
?>

<div class="akeeba-block--info">
    <strong><?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?></strong>
    #<?php echo $this->profileid; ?> <?php echo htmlentities($this->profilename); ?>
</div>

<form class="akeeba-form--inline akeeba-panel--info">
    <div class="akeeba-form-group">
		<label><?php echo Text::_('COM_AKEEBA_DBFILTER_LABEL_ROOTDIR') ?></label>
	    <?php echo $this->root_select; ?>
    </div>
	<div id="addnewfilter" class="akeeba-form-group--actions">
		<label>
			<?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_ADDNEWFILTER') ?>
        </label>
		<button class="akeeba-btn--grey" onclick="akeeba.Dbfilters.addNew('tables'); return false;">
			<?php echo Text::_('COM_AKEEBA_DBFILTER_TYPE_TABLES') ?>
		</button>
		<button class="akeeba-btn--grey" onclick="akeeba.Dbfilters.addNew('tabledata'); return false;">
			<?php echo Text::_('COM_AKEEBA_DBFILTER_TYPE_TABLEDATA') ?>
		</button>
	</div>
</form>

<div class="akeeba-panel--primary">
    <div id="ak_list_container">
        <table id="ak_list_table" class="akeeba-table--striped">
            <thead>
            <tr>
                <td width="250px"><?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_TYPE'); ?></td>
                <td><?php echo Text::_('COM_AKEEBA_FILEFILTERS_LABEL_FILTERITEM'); ?></td>
            </tr>
            </thead>
            <tbody id="ak_list_contents">
            </tbody>
        </table>
    </div>
</div>
