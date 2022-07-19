<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\View\Update;

use Awf\Registry\Registry;
use Awf\Text\Text;
use Awf\Utils\Template;
use Solo\Model\Main;
use Solo\Model\Update;

class Html extends \Solo\View\Html
{
	/**
	 * The update information registry
	 *
	 * @var   Registry
	 */
	public $updateInfo;

	public function display($tpl = null)
	{
		Template::addJs('media://js/solo/update.js', $this->container->application);

		return parent::display($tpl);
	}

	public function onBeforeMain()
	{
		/** @var Update $model */
		$model = $this->getModel();

		/** @var Main $modelMain */
		$modelMain = $this->getModel('Main');

		$this->updateInfo      = $model->getUpdateInformation();
		$this->needsDownloadId = $modelMain->needsDownloadID();

		if ($this->updateInfo->get('stuck', 0))
		{
			$this->layout = 'stuck';
		}

		return true;
	}

	public function onBeforeDownload()
	{
		$token = $this->getContainer()->session->getCsrfToken()->getValue();
		$router = $this->getContainer()->router;
		$invalidDownloadID = \Solo\Helper\Escape::escapeJS(Text::_('SOLO_UPDATE_ERR_INVALIDDOWNLOADID'));
		$ajaxUrl = $router->route('index.php?view=update&task=downloader&format=raw');
		$nextStepUrl = $router->route('index.php?view=update&task=extract&token=' . $token);

		$js = <<< JS
akeeba.loadScripts.push(function() {
	akeeba.System.errorCallback = akeeba.Update.downloadErrorCallback;
	akeeba.Update.errorCallback = akeeba.Update.downloadErrorCallback;
	akeeba.Update.translations['ERR_INVALIDDOWNLOADID'] = '$invalidDownloadID';
	akeeba.System.params.AjaxURL = '$ajaxUrl';
	akeeba.Update.nextStepUrl = '$nextStepUrl';
	akeeba.System.params.errorCallback = akeeba.Update.downloadErrorCallback;
	akeeba.Update.startDownload();		  
});

JS;

		$document = $this->getContainer()->application->getDocument();
		$document->addScriptDeclaration($js);

		return true;
	}

	public function onBeforeExtract()
	{
		$router = $this->getContainer()->router;
		$ajaxUrl = \Awf\Uri\Uri::base(false, $this->container) . 'restore.php';
		$finalizeUrl = $router->route('index.php?view=update&task=finalise');
		$password = $this->getModel()->getState('update_password', '');

		$js = <<< JS
akeeba.loadScripts[akeeba.loadScripts.length] = function () {
	akeeba.System.documentReady(function() {
	    akeeba.System.params.AjaxURL = '$ajaxUrl';
	    akeeba.Update.finaliseUrl = '$finalizeUrl';
	    akeeba.System.errorCallback = akeeba.Update.extractErrorCallback;
	    akeeba.Update.errorCallback = akeeba.Update.extractErrorCallback;
	    akeeba.System.params.password = '$password';
	    akeeba.Update.pingExtract();
	});
};

JS;

		$document = $this->getContainer()->application->getDocument();
		$document->addScriptDeclaration($js);

		return true;
	}
}
