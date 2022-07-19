<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var $this \Solo\View\Configuration\Html */

$router = $this->container->router;

$proKey = (defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO) ? 'PRO' : 'CORE';

$js = <<< JS

akeeba.loadScripts.push(function(){
	setTimeout(function() {
        akeeba.System.howToRestoreModal = akeeba.Modal.open({
            inherit: '#akeeba-config-howtorestore-bubble',
            width: '80%'
        });		
	}, 500);
});

JS;

$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

?>

<div id="akeeba-config-howtorestore-bubble" style="display: none;">
    <div class="akeeba-renderer-fef">
        <h4>
		    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_HOWDOIRESTORE_LEGEND') ?>
        </h4>

        <p>
	        <?php echo Text::sprintf('COM_AKEEBA_BUADMIN_LABEL_HOWDOIRESTORE_TEXT_' . $proKey,
		        'https://www.akeebabackup.com/videos/1214-akeeba-solo/1637-abts05-restoring-site-new-server.html',
		        $router->route('index.php?view=Transfer'),
		        'https://www.akeebabackup.com/latest-kickstart-core.zip'
	        ); ?>
        </p>

        <div>
            <a href="#" onclick="akeeba.System.howToRestoreModal.close(); document.getElementById('akeeba-config-howtorestore-bubble').style.display = 'none'" class="akeeba-btn--primary">
                <span class="akion-close"></span>
		        <?php echo Text::_('COM_AKEEBA_BUADMIN_BTN_REMINDME'); ?>
            </a>
            <a href="<?php echo $router->route('index.php?view=Manage&task=hideModal') ?>" class="akeeba-btn--green">
                <span class="akion-checkmark-circled"></span>
		        <?php echo Text::_('COM_AKEEBA_BUADMIN_BTN_DONTSHOWTHISAGAIN'); ?>
            </a>
        </div>
    </div>
</div>
