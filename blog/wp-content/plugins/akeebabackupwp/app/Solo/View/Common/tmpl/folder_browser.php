<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/* Filesystem browser */
?>
<div class="modal" id="folderBrowserDialog" tabindex="-1" role="dialog" aria-labelledby="folderBrowserDialogLabel"
     aria-hidden="true" style="display: none;">
    <div class="akeeba-renderer-fef">
        <h4 id="folderBrowserDialogLabel">
	        <?php echo Text::_('COM_AKEEBA_CONFIG_UI_BROWSER_TITLE'); ?>
        </h4>
        <div id="folderBrowserDialogBody">
        </div>
    </div>
</div>
