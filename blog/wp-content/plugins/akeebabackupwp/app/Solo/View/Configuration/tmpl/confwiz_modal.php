<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Configuration\Html $this */

$router = $this->container->router;

// Make sure we only ever add this HTML and JS once per page
if (defined('AKEEBA_VIEW_JAVASCRIPT_CONFWIZ_MODAL'))
{
	return;
}

define('AKEEBA_VIEW_JAVASCRIPT_CONFWIZ_MODAL', 1);

$js = <<< JS

akeeba.loadScripts.push(function(){

	setTimeout(function() {
        akeeba.System.configurationWizardModal = akeeba.Modal.open({
            inherit: '#akeeba-config-confwiz-bubble',
            width: '80%'
        });		
	}, 500);
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

?>

<div id="akeeba-config-confwiz-bubble" class="modal fade" role="dialog"
     aria-labelledby="DialogLabel" aria-hidden="true" style="display: none;">
    <div class="akeeba-renderer-fef">
        <h4>
			<?php echo Text::_('COM_AKEEBA_CONFIG_HEADER_CONFWIZ'); ?>
        </h4>
        <div>
            <p>
				<?php echo Text::_('COM_AKEEBA_CONFIG_LBL_CONFWIZ_INTRO'); ?>
            </p>
            <p>
                <a href="<?php echo $this->getContainer()->router->route('index.php?view=wizard') ?>"
                   class="akeeba-btn--green akeeba-btn--big">
                    <span class="akion-flash"></span>
					<?php echo Text::_('COM_AKEEBA_CONFWIZ'); ?>
                </a>
            </p>
            <p>
				<?php echo Text::_('COM_AKEEBA_CONFIG_LBL_CONFWIZ_AFTER'); ?>
            </p>
        </div>
        <div>
            <a href="#" class="akeeba-btn--ghost akeeba-btn--small" onclick="akeeba.System.configurationWizardModal.close();">
                <span class="akion-close"></span>
				<?php echo Text::_('SOLO_BTN_CANCEL'); ?>
            </a>
        </div>
    </div>
</div>
