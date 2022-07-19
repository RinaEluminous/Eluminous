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
<div id="extractProgress">
	<div class="akeeba-block--warning">
		<span><?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKINGUP')?></span>
	</div>

	<div id="extractProgressBarContainer" class="akeeba-progress">
		<div id="extractProgressBar" class="akeeba-progress-fill" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
		</div>
        <div class="akeeba-progress-status" id="extractProgressBarInfo">0%</div>
    </div>

	<div class="akeeba-block--info" id="extractProgressInfo">
		<h4>
			<?php echo Text::_('SOLO_UPDATE_EXTRACT_LBL_EXTRACTPROGRESS') ?>
		</h4>
		<div id="extractProgressBarText">
			<span class="akion-pie-graph"></span>
			<span id="extractProgressBarTextPercent">0</span> %
			<br/>
			<span class="akion-android-folder-open"></span>
			<span id="extractProgressBarTextIn">0 KiB</span>
			<br/>
			<span class="akion-stats-bars"></span>
			<span id="extractProgressBarTextOut">0 KiB</span>
			<br/>
			<span class="akion-document-text"></span>
			<span id="extractProgressBarTextFile"></span>
		</div>
	</div>
</div>

<div id="extractPingError" style="display: none">
	<div class="akeeba-block--failure">
		<h3>
			<?php echo Text::_('SOLO_UPDATE_EXTRACT_ERR_CANTPING_TEXT'); ?>
		</h3>
		<p>
			<?php echo Text::_('SOLO_UPDATE_EXTRACT_ERR_CANTPING_CONTACTHOST'); ?>
		</p>
	</div>
</div>

<div id="extractError" style="display: none">
	<div class="akeeba-block--failure">
		<h4>
			<?php echo Text::_('SOLO_UPDATE_EXTRACT_ERR_EXTRACTERROR_HEADER') ?>
		</h4>
		<div class="panel-body" id="extractErrorText"></div>
	</div>
</div>
