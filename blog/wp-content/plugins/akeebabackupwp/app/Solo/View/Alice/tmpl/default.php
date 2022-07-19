<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Html;
use Awf\Text\Text;

// Used for type hinting
/** @var  \Solo\View\Alice\Html  $this */

$router = $this->container->router;

?>
<?php if(count($this->logs)): ?>
<form name="adminForm" id="adminForm" action="<?php echo $router->route('index.php?view=alice') ?>" method="POST" class="akeeba-form--inline--with-hidden">

    <?php if($this->input->getInt('autorun', 0)): ?>
        <div class="akeeba-block--warning">
            <p>
                <?php echo Text::_('ALICE_AUTORUN_NOTICE')?>
            </p>
        </div>
    <?php endif; ?>

    <div class="akeeba-form-group">
		<label for="tag">
			<?php echo Text::_('COM_AKEEBA_LOG_CHOOSE_FILE_TITLE'); ?>
		</label>
		<?php echo Html\Select::genericList($this->logs, 'log', '', 'value', 'text', $this->tag, 'soloLogSelect') ?>

        <div class="akeeba-form-group--actions">
            <button class="akeeba-btn--primary" id="analyze-log" style="display:none">
                <span class="akion-ios-analytics"></span>
		        <?php echo Text::_('SOLO_ALICE_ANALYZE'); ?>
            </button>

            <button class="akeeba-btn--dark" id="download-log" data-url="<?php echo $router->route('index.php?view=log&format=raw&task=download&tag=') ?>" style="display: none;">
                <span class="akion-ios-download"></span>
		        <?php echo Text::_('COM_AKEEBA_LOG_LABEL_DOWNLOAD'); ?>
            </button>
        </div>
	</div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>" >
    </div>
</form>

<div id="stepper-holder" style="margin-top: 15px">
    <div id="stepper-loading" style="text-align: center;display: none">
        <img src="<?php echo \Awf\Uri\Uri::base(false, $this->container) . 'media/loading.gif' ?>" />
    </div>
    <div id="stepper-progress-pane" style="display: none">
        <div class="akeeba-block--information">
            <?php echo Text::_('COM_AKEEBA_BACKUP_TEXT_BACKINGUP'); ?>
        </div>

        <h4>
            <?php echo Text::_('COM_AKEEBA_ALICE_ANALYZE_LABEL_PROGRESS') ?>
        </h4>

        <div id="stepper-progress-content">
            <div id="stepper-steps">
            </div>
            <div id="stepper-status">
                <div id="stepper-step"></div>
                <div id="stepper-substep"></div>
            </div>
            <div id="stepper-percentage" class="akeeba-progress">
                <div class="akeeba-progress-fill" style="width: 0%"></div>
            </div>
            <div id="response-timer">
                <div class="color-overlay"></div>
                <div class="text"></div>
            </div>
        </div>
        <span id="ajax-worker"></span>
    </div>
    <div id="output-plain" class="akeeba-panel--information" style="display:none;margin-bottom: 20px;">
        <div class="akeeba-block--warning">
            <p>
	            <?php echo Text::_('COM_AKEEBA_ALICE_ANALYZE_RAW_OUTPUT')?>
            </p>
        </div>

        <textarea style="width:50%;margin:auto;display:block;height: 100px;" readonly="readonly"></textarea>
    </div>
    <div id="stepper-complete" style="display: none">
        <table class="akeeba-table--striped">
            <thead>
            <tr>
                <th>
				    <?php echo Text::_('COM_AKEEBA_ALICE_HEADER_CHECK'); ?>
                </th>
                <th width="120">
				    <?php echo Text::_('COM_AKEEBA_ALICE_HEADER_RESULT'); ?>
                </th>
            </tr>
            </thead>
            <tbody id="alice-messages"></tbody>
        </table>
    </div>
</div>

<?php else: ?>
<div class="akeeba-block--failure">
	<p>
		<?php echo Text::_('COM_AKEEBA_LOG_NONE_FOUND') ?>
    </p>
</div>
<?php endif; ?>
