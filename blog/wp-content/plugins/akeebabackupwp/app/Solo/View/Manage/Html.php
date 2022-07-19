<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\View\Manage;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Html\Select;
use Awf\Mvc\Model;
use Awf\Text\Text;
use Awf\Utils\Template;
use Solo\Helper\Escape;
use Solo\Model\Profiles;

class Html extends \Solo\View\Html
{
	/**
	 * The record lists of this view
	 *
	 * @var   \stdClass
	 */
	public $lists = null;

	/**
	 * Cache the user privileges
	 *
	 * @var  array
	 */
	public $privileges = array();

	/**
	 * Post-processing engines per backup profile in the format profile id => post-processing enging
	 *
	 * @var   array
	 */
	public $enginesPerProfile = array();

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->lists = new \stdClass();

		Template::addJs('media://js/solo/manage.js', $this->container->application);
	}

	public function onBeforeMain()
	{
		$user                          = $this->container->userManager->getUser();
		$this->privileges['backup']    = $user->getPrivilege('akeeba.backup');
		$this->privileges['download']  = $user->getPrivilege('akeeba.download');
		$this->privileges['configure'] = $user->getPrivilege('akeeba.configure');

		$buttons  = array();
		$document = $this->container->application->getDocument();
		$router   = $this->container->router;

		$task = $this->container->segment->get('solo_manage_task', 'main');

		/**
		 * $document->getMenu()->addItem(new Item(array(
		 * 'title' => Text::_('BUADMIN_LABEL_BACKUPS'),
		 * 'name'  => 'show-main',
		 * 'url'   => $router->route('index.php?view=manage&task=main'),
		 * 'show'  => array('submenu')
		 * )));
		 * $document->getMenu()->addItem(new Item(array(
		 * 'title' => Text::_('BUADMIN_LABEL_SRP'),
		 * 'name'  => 'show-srp',
		 * 'url'   => $router->route('index.php?view=manage&task=restorePoints'),
		 * 'show'  => array('submenu')
		 * )));
		 * /**/

		/** @var \Solo\Model\Manage $model */
		$model = $this->getModel();

		$this->lists->order          = $model->getState('filter_order', 'backupstart');
		$this->lists->order_Dir      = $model->getState('filter_order_Dir', 'DESC');
		$this->lists->fltDescription = $model->getState('filter_description', null);
		$this->lists->fltFrom        = $model->getState('filter_from', null);
		$this->lists->fltTo          = $model->getState('filter_to', null);
		$this->lists->fltOrigin      = $model->getState('filter_origin', null);
		$this->lists->fltProfile     = $model->getState('filter_profile', null);

		$filters  = $this->_getFilters();
		$ordering = $this->_getOrdering();

		$this->list = $model->getStatisticsListWithMeta(false, $filters, $ordering);

		$containerClone               = clone $this->getContainer();
		$containerClone['mvc_config'] = array(
			'modelTemporaryInstance' => true,
			'modelClearState'        => true,
			'modelClearInput'        => true
		);

		/** @var Profiles $profileModel */
		$profileModel        = Model::getInstance(null, 'Profiles', $containerClone);
		$this->profiles      = $profileModel->get(true);
		$this->profileList   = array();
		$this->profileList[] = Select::option('', '&mdash;');

		if (!empty($this->profiles))
		{
			foreach ($this->profiles as $profile)
			{
				$this->profileList[] = Select::option($profile->id, $profile->description);
			}
		}

		$this->pagination = $model->getPagination($filters);

		$this->enginesPerProfile = $model->getPostProcessingEnginePerProfile();

		$scripting         = Factory::getEngineParamsProvider()->loadScripting();
		$this->backupTypes = array();

		foreach ($scripting['scripts'] as $key => $data)
		{
			$this->backupTypes[$key] = Text::_($data['text']);
		}

		$buttons = array(
			'view'        => array(
				'task'    => 'main',
				'title'   => 'COM_AKEEBA_BUADMIN_LOG_EDITCOMMENT',
				'class'   => 'akeeba-btn--grey',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'showComment\')',
				'icon'    => 'akion-edit'
			),
			'discover'    => array(
				'task'  => 'main',
				'title' => 'COM_AKEEBA_DISCOVER',
				'class' => 'akeeba-btn--grey',
				'url'   => $router->route('index.php?view=discover'),
				'icon'  => 'akion-search'
			),
			's3import'    => array(
				'task'  => 'main',
				'title' => 'COM_AKEEBA_S3IMPORT',
				'class' => 'akeeba-btn--grey',
				'url'   => $router->route('index.php?view=s3import'),
				'icon'  => 'akion-ios-cloud-download'
			),
			'restore'     => array(
				'task'    => '',
				'title'   => 'COM_AKEEBA_BUADMIN_LABEL_RESTORE',
				'class'   => 'akeeba-btn--teal',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'restore\')',
				'icon'    => 'akion-android-open'
			),
			'deletefiles' => array(
				'task'    => 'main',
				'title'   => 'COM_AKEEBA_BUADMIN_LABEL_DELETEFILES',
				'class'   => 'akeeba-btn--orange',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'deleteFiles\')',
				'icon'    => 'akion-trash-a'
			),
			'delete'      => array(
				'task'    => '',
				'title'   => 'SOLO_MANAGE_BTN_DELETE',
				'class'   => 'akeeba-btn--red',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'remove\')',
				'icon'    => 'akion-trash-b'
			),
		);

		if (!$this->privileges['configure'])
		{
			unset($buttons['discover']);
			unset($buttons['s3import']);
			unset($buttons['restore']);
		}
		elseif (!AKEEBABACKUP_PRO)
		{
			unset($buttons['discover']);
			unset($buttons['s3import']);
		}

		if (!$this->privileges['backup'])
		{
			unset($buttons['delete']);
			unset($buttons['deletefiles']);
		}

		$toolbar = $document->getToolbar();

		foreach ($buttons as $button)
		{
			if (empty($button['task']) || ($button['task'] == $task))
			{
				$toolbar->addButtonFromDefinition($button);
			}
		}

		// "Show warning first" download button.
		$confirmationText = Escape::escapeJS(Text::_('COM_AKEEBA_BUADMIN_LOG_DOWNLOAD_CONFIRM'));
		$confirmationText = str_replace('\\\\n', '\\n', $confirmationText);
		$newURL           = Escape::escapeJS($router->route('index.php?view=manage&task=download&format=raw'));
		$js               = <<<JS

;// This comment is intentionally put here to prevent badly written plugins from causing a Javascript error
// due to missing trailing semicolon and/or newline in their code.
function confirmDownloadButton()
{
	var answer = confirm("$confirmationText");
	if (answer)
	{
		akeeba.System.submitForm('adminForm', 'download');
	}
}

function confirmDownload(id, part)
{
	var answer = confirm("$confirmationText");
	var newURL = '$newURL';
	if (answer)
	{
		var query = 'id=' + id;

		if (part != '')
		{
			query += '&part=' + part
		}

		window.location = newURL + (newURL.indexOf('?') != -1 ? '&' : '?') + query;
	}
}

akeeba.loadScripts.push(function() {
	setTimeout(function() {
		akeeba.Tooltip.enableFor(document.querySelectorAll('.akeebaCommentPopover'), false);
	}, 500);
});

JS;

		$this->getContainer()->application->getDocument()->addScriptDeclaration($js);

		// All done, show the page!
		return true;
	}

	public function onBeforeRestorePoints()
	{
		return $this->onBeforeMain();
	}

	public function onBeforeShowComment()
	{
		$model = $this->getModel();

		$this->recordId = $model->getState('id', -1);
		$this->record   = Platform::getInstance()->get_statistics($this->recordId);

		$buttons = array(
			array(
				'title'   => 'SOLO_BTN_SAVECLOSE',
				'class'   => 'akeeba-btn--green',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'save\')',
				'icon'    => 'akion-checkmark-circled'
			),
			array(
				'title'   => 'SOLO_BTN_CANCEL',
				'class'   => 'akeeba-btn--orange',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'cancel\')',
				'icon'    => 'akion-close-circled'
			),
		);

		$toolbar = $this->container->application->getDocument()->getToolbar();

		foreach ($buttons as $button)
		{
			$toolbar->addButtonFromDefinition($button);
		}

		return true;
	}

	private function _getFilters()
	{
		$filters = array();
		$task    = $this->container->segment->get('solo_manage_task', 'main');

		if ($this->lists->fltDescription)
		{
			$filters[] = array(
				'field'   => 'description',
				'operand' => 'LIKE',
				'value'   => $this->lists->fltDescription
			);
		}

		if ($this->lists->fltFrom && $this->lists->fltTo)
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => 'BETWEEN',
				'value'   => $this->lists->fltFrom,
				'value2'  => $this->lists->fltTo
			);
		}
		elseif ($this->lists->fltFrom)
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => '>=',
				'value'   => $this->lists->fltFrom,
			);
		}
		elseif ($this->lists->fltTo)
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => '<=',
				'value'   => $this->lists->fltTo,
			);
		}

		if ($this->lists->fltOrigin)
		{
			$filters[] = array(
				'field'   => 'origin',
				'operand' => '=',
				'value'   => $this->lists->fltOrigin
			);
		}

		if ($this->lists->fltProfile)
		{
			$filters[] = array(
				'field'   => 'profile_id',
				'operand' => '=',
				'value'   => (int) $this->lists->fltProfile
			);
		}

		if ($task == 'restorePoints')
		{
			$filters[] = array(
				'field'   => 'tag',
				'operand' => '=',
				'value'   => 'restorepoint'
			);
		}
		else
		{
			$filters[] = array(
				'field'   => 'tag',
				'operand' => '<>',
				'value'   => 'restorepoint'
			);
		}


		if (empty($filters))
		{
			$filters = null;
		}

		return $filters;
	}

	private function _getOrdering()
	{
		$order = array(
			'by'    => $this->lists->order,
			'order' => strtoupper($this->lists->order_Dir)
		);

		return $order;
	}

	/**
	 * Returns the origin's translated name and the appropriate icon class
	 *
	 * @param   array $record A backup record
	 *
	 * @return  array  array(originTranslation, iconClass)
	 */
	protected function getOriginInformation($record)
	{
		$originLanguageKey = 'COM_AKEEBA_BUADMIN_LABEL_ORIGIN_' . $record['origin'];
		$originDescription = Text::_($originLanguageKey);

		switch (strtolower($record['origin']))
		{
			case 'backend':
				$originIcon = 'akion-android-desktop';
				break;

			case 'frontend':
				$originIcon = 'akion-ios-world';
				break;

			case 'json':
				$originIcon = 'akion-android-cloud';
				break;

			case 'cli':
				$originIcon = 'akion-ios-paper-outline';
				break;

			case 'xmlrpc':
				$originIcon = 'akion-code';
				break;

			case 'restorepoint':
				$originIcon = 'akion-refresh';
				break;

			case 'lazy':
				$originIcon = 'akion-cube';
				break;

			default:
				$originIcon = 'akion-help';
				break;
		}

		if (empty($originLanguageKey) || ($originDescription == $originLanguageKey))
		{
			$originDescription = '&ndash;';
			$originIcon        = 'akion-help';

			return array($originDescription, $originIcon);
		}

		return array($originDescription, $originIcon);
	}

} 
