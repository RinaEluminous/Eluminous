<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var   \Solo\View\Update\Html  $this */

$router = $this->container->router;
$token = $this->container->session->getCsrfToken()->getValue();

?>

<div id="downloadProgress">
	<div class="akeeba-block--warning">
		<span><?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKINGUP')?></span>
	</div>

	<div id="downloadProgressBarContainer" class="akeeba-progress">
		<div id="downloadProgressBar" class="akeeba-progress-fill" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
		</div>
        <div class="akeeba-progress-status" id="downloadProgressBarInfo">0%</div>
    </div>

	<div class="akeeba-block--info" id="downloadProgressInfo">
		<h4>
			<?php echo Text::_('SOLO_UPDATE_DOWNLOAD_LBL_DOWNLOADPROGRESS') ?>
		</h4>
		<div class="panel-body" id="downloadProgressBarText">

		</div>
	</div>
</div>

<div id="downloadError" style="display: none">
	<div class="akeeba-block--failure">
		<h4>
			<?php echo Text::_('SOLO_UPDATE_DOWNLOAD_ERR_DOWNLOADERROR_HEADER') ?>
		</h4>
		<div class="panel-body" id="downloadErrorText"></div>
	</div>
</div>
