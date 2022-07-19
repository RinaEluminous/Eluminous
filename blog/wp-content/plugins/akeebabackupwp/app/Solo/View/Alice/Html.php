<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\View\Alice;

use Akeeba\Engine\Platform;
use Awf\Text\Text;
use Awf\Utils\Template;
use Solo\Helper\Escape;
use Solo\Model\Log;

class Html extends \Solo\View\Html
{
	/**
	 * List of log files detected
	 *
	 * @var  array
	 */
	public $logs = array();

	/**
	 * Selected log tag
	 *
	 * @var  string
	 */
	public $tag = '';

	/**
	 * Numeric ID of the current profile
	 *
	 * @var  int
	 */
	public $profileid = 1;

	/**
	 * Human readable name of the current profile
	 *
	 * @var  string
	 */
	public $profilename = '';

	/**
	 * Setup the main log page
	 *
	 * @return  boolean
	 */
	public function onBeforeMain()
	{
		// Load the necessary Javascript
		Template::addJs('media://js/solo/stepper.js', $this->container->application);
		Template::addJs('media://js/solo/alice.js', $this->container->application);

		$model      = new Log();
		$this->logs = $model->getLogList();
		$this->tag  = $this->input->getCmd('tag', null);

		// Get profile ID and name
		$this->profileid = Platform::getInstance()->get_active_profile();;
		$this->profilename = $this->escape(Platform::getInstance()->get_profile_name($this->profileid));

		// Set up the page's Javascript
		$strings  = array();
		$langKeys = array(
			'UI-LASTRESPONSE'     => 'COM_AKEEBA_BACKUP_TEXT_LASTRESPONSE',
			'UI-STW-CONTINUE'     => 'STW_MSG_CONTINUE',
			'SOLO_ALICE_SUCCESSS' => 'SOLO_ALICE_SUCCESSS',
			'SOLO_ALICE_WARNING'  => 'SOLO_ALICE_WARNING',
			'SOLO_ALICE_ERROR'    => 'SOLO_ALICE_ERROR',
		);

		foreach ($langKeys as $key => $langKey)
		{
			$strings[$key] = Escape::escapeJS(Text::_($langKey));
		}

		$akeebaUrl 	  = $this->getContainer()->router->route('index.php?view=alice');
		$translateUrl = $this->getContainer()->router->route('index.php?view=Alice&task=translate');

		$js = <<< JS
	akeeba.loadScripts.push(function() {
		  // Push translations
        akeeba.Alice.translations['UI-LASTRESPONSE']	    = '{$strings['UI-LASTRESPONSE']}';
        akeeba.Alice.translations['UI-STW-CONTINUE']	    = '{$strings['UI-STW-CONTINUE']}';
        akeeba.Alice.translations['SOLO_ALICE_SUCCESSS']  = '{$strings['SOLO_ALICE_SUCCESSS']}';
        akeeba.Alice.translations['SOLO_ALICE_WARNING']	= '{$strings['SOLO_ALICE_WARNING']}';
        akeeba.Alice.translations['SOLO_ALICE_ERROR']	    = '{$strings['SOLO_ALICE_ERROR']}';
		akeeba.Alice.akeebaUrl = '$akeebaUrl';
		akeeba.Alice.translateUrl = '$translateUrl';

		akeeba.Alice.analyze = document.getElementById('analyze-log');
		akeeba.Alice.download = document.getElementById('download-log');
		akeeba.Alice.log_selector = document.getElementById('soloLogSelect');
		akeeba.Alice.raw_output = document.getElementById('output-plain');

		akeeba.Alice.log_selector.removeAttribute('disabled');
		akeeba.System.addEventListener(akeeba.Alice.log_selector, 'change', akeeba.Alice.onLogChange);
		akeeba.System.addEventListener(akeeba.Alice.analyze, 'click', akeeba.Alice.onAnalyze);
		akeeba.System.addEventListener(akeeba.Alice.download, 'click', akeeba.Alice.onDownload);

    	if ('{$this->tag}')
    	{
    		akeeba.System.triggerEvent(akeeba.Alice.log_selector, 'change');
    		akeeba.System.triggerEvent(akeeba.Alice.analyze, 'click');
    	}
	});

JS;

		$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

		return true;
	}
}
