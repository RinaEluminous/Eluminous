<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\Model\Json\Task;

use Solo\Model\Json\TaskInterface;
use Solo\Model\Profiles;

/**
 * Delete a backup profile
 */
class DeleteProfile implements TaskInterface
{
	/**
	 * Return the JSON API task's name ("method" name). Remote clients will use it to call us.
	 *
	 * @return  string
	 */
	public function getMethodName()
	{
		return 'deleteProfile';
	}

	/**
	 * Execute the JSON API task
	 *
	 * @param   array $parameters The parameters to this task
	 *
	 * @return  mixed
	 *
	 * @throws  \RuntimeException  In case of an error
	 */
	public function execute(array $parameters = array())
	{
		// Get the passed configuration values
		$defConfig = array(
			'profile' => 0,
		);

		$defConfig = array_merge($defConfig, $parameters);

		$profile = (int)$defConfig['profile'];

		// You need to specify the profile
		if (empty($profile))
		{
			throw new \RuntimeException('Invalid profile ID', 404);
		}

		if ($profile == 1)
		{
			throw new \RuntimeException('You cannot delete the default backup profile', 404);
		}

		// Get a profile model
		$profileModel = new Profiles();

		$profileModel->findOrFail($profile);

		$profileModel->delete();

		return true;
	}
}
