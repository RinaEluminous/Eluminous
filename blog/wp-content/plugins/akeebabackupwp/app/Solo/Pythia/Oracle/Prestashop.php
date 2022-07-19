<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

namespace Solo\Pythia\Oracle;

use Solo\Pythia\AbstractOracle;

class Prestashop extends AbstractOracle
{
	/**
	 * The name of this oracle class
	 *
	 * @var  string
	 */
	protected $oracleName = 'prestashop';

	/**
	 * Does this class recognises the CMS type as Prestashop?
	 *
	 * @return  boolean
	 */
	public function isRecognised()
	{
		// This file is currently marked deprecated, but it's still included in 1.7 version, so we can check for it
		if (!@file_exists($this->path . '/config/settings.inc.php'))
		{
			return false;
		}

		if (!@file_exists($this->path . '/config/smarty.config.inc.php'))
		{
			return false;
		}

		return true;
	}

	/**
	 * Return the database connection information for this CMS / script
	 *
	 * @return  array
	 */
	public function getDbInformation()
	{
		$ret = array(
			'driver'	=> 'mysqli',
			'host'		=> '',
			'port'		=> '',
			'username'	=> '',
			'password'	=> '',
			'name'		=> '',
			'prefix'	=> '',
		);

		// In Prestashop 1.7 they moved the settings file into another location
		if (file_exists($this->path . '/app/config/parameters.php'))
		{
			$ret = array_merge($ret, $this->getDbInfo_17());
		}
		else
		{
			$ret = array_merge($ret, $this->getDbInfo());
		}

		return $ret;
	}

	private function getDbInfo_17()
	{
		// In Prestashop 1.7 it's just a simple PHP file returning all the configuration settings,
		// so we can safely include it
		$params = include $this->path . '/app/config/parameters.php';

		$ret = array(
			'host'		=> $params['parameters']['database_host'],
			'port'		=> $params['parameters']['database_port'],
			'username'	=> $params['parameters']['database_user'],
			'password'	=> $params['parameters']['database_password'],
			'name'		=> $params['parameters']['database_name'],
			'prefix'	=> $params['parameters']['database_prefix'],
		);

		return $ret;
	}

	private function getDbInfo()
	{
		$ret = array();

		$fileContents = file($this->path . '/config/settings.inc.php');

		foreach ($fileContents as $line)
		{
			$line    = trim($line);

			// Skip commented lines. However it will get the line between a multiline comment, but that's not a problem
			if (strpos($line, '#') === 0 || strpos($line, '//') === 0 || strpos($line, '/*') === 0)
			{
				continue;
			}

			if (strpos($line, 'define') !== false)
			{
				list($key, $value) = $this->parseDefine($line);

				if (!empty($key))
				{

					switch (strtoupper($key))
					{
						case '_DB_SERVER_':
							$ret['host'] = $value;
							break;
						case '_DB_USER_':
							$ret['username'] = $value;
							break;
						case '_DB_PASSWD_':
							$ret['password'] = $value;
							break;
						case '_DB_NAME_' :
							$ret['name'] = $value;
							break;
						case '_DB_PREFIX_':
							$ret['prefix'] = $value;
							break;
						default:
							// Do nothing, it's a variable we're not interested in
							break;
					}
				}
			}
		}

		return $ret;
	}
}
