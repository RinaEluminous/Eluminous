<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

namespace Solo\View\Profiles;

use Akeeba\Engine\Platform;
use Solo\View\DataHtml;

class Html extends DataHtml
{
	public function onBeforeBrowse()
	{
		$document = $this->container->application->getDocument();

		// Buttons (new, edit, copy, delete)
		$buttons = array(
			array(
				'title' 	=> 'SOLO_BTN_ADD',
				'class' 	=> 'akeeba-btn--green',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'add\')',
				'icon' 		=> 'akion-plus-circled'
			),
			array(
				'title' 	=> 'SOLO_BTN_EDIT',
				'class' 	=> 'akeeba-btn--grey',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'edit\')',
				'icon' 		=> 'akion-edit'
			),
			array(
				'title' 	=> 'SOLO_BTN_COPY',
				'class' 	=> 'akeeba-btn--grey',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'copy\')',
				'icon' 		=> 'akion-ios-copy'
			),
			array(
				'title' 	=> 'SOLO_BTN_DELETE',
				'class' 	=> 'akeeba-btn--red',
				'onClick' 	=> 'akeeba.System.submitForm(\'adminForm\', \'remove\')',
				'icon' 		=> 'akion-trash-b'
			),
		);

		$toolbar = $document->getToolbar();

		foreach ($buttons as $button)
		{
			$toolbar->addButtonFromDefinition($button);
		}

		// Pass the profile ID and name
		$this->profileid = Platform::getInstance()->get_active_profile();

		// Get profile name
		$this->profilename = $this->escape(Platform::getInstance()->get_profile_name($this->profileid));

		return parent::onBeforeBrowse();
	}

	protected function onBeforeAdd()
	{
		$document = $this->container->application->getDocument();

		// Buttons (save, save and close, save and new, cancel)
		$buttons = array(
			array(
				'title' 	=> 'SOLO_BTN_SAVECLOSE',
				'class' 	=> 'akeeba-btn--green',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'save\')',
				'icon' 		=> 'akion-checkmark-circled'
			),
			array(
				'title' 	=> 'SOLO_BTN_SAVE',
				'class' 	=> 'akeeba-btn--grey',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'apply\')',
				'icon' 		=> 'akion-checkmark'
			),
			array(
				'title' 	=> 'SOLO_BTN_SAVENEW',
				'class' 	=> 'akeeba-btn--grey',
				'onClick'	=> 'akeeba.System.submitForm(\'adminForm\', \'savenew\')',
				'icon' 		=> 'akion-ios-copy'
			),
			array(
				'title' 	=> 'SOLO_BTN_CANCEL',
				'class' 	=> 'akeeba-btn--orange',
				'onClick' 	=> 'akeeba.System.submitForm(\'adminForm\', \'cancel\')',
				'icon' 		=> 'akion-close-circled'
			),
		);

		$toolbar = $document->getToolbar();

		foreach ($buttons as $button)
		{
			$toolbar->addButtonFromDefinition($button);
		}

		return parent::onBeforeAdd();
	}

	protected function onBeforeEdit()
	{
		$document = $this->container->application->getDocument();

		// Buttons (save, save and close, save and new, cancel)
		$buttons = array(
			array(
				'title' => 'SOLO_BTN_SAVECLOSE',
				'class' => 'akeeba-btn--green',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'save\')',
				'icon' => 'akion-checkmark-circled'
			),
			array(
				'title' => 'SOLO_BTN_SAVE',
				'class' => 'akeeba-btn--grey',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'apply\')',
				'icon' => 'akion-checkmark'
			),
			array(
				'title' => 'SOLO_BTN_SAVENEW',
				'class' => 'akeeba-btn--grey',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'savenew\')',
				'icon' => 'akion-ios-copy'
			),
			array(
				'title' => 'SOLO_BTN_CANCEL',
				'class' => 'akeeba-btn--orange',
				'onClick' => 'akeeba.System.submitForm(\'adminForm\', \'cancel\')',
				'icon' => 'akion-close-circled'
			),
		);

		$toolbar = $document->getToolbar();

		foreach ($buttons as $button)
		{
			$toolbar->addButtonFromDefinition($button);
		}

		return parent::onBeforeEdit();
	}
} 
