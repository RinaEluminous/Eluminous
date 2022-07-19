<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Akeeba\WPCLI\Command;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Akeeba\Engine\Util\ParseIni;
use Awf\Mvc\Model;
use Exception;
use Solo\Application;
use WP_CLI;
use WP_CLI\Utils as CliUtils;

/**
 * View and change the configuration options of your Akeeba Backup profiles.
 *
 * @package     Akeeba\WPCLI\Command
 *
 * @since       3.0.0
 */
class Option
{
	/**
	 * Lists the configuration options for an Akeeba Backup profile, including their titles
	 *
	 * ## OPTIONS
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--filter=<filter>]
	 * : Only return records whose keys begin with the given filter
	 *
	 * [--sort-by=<column>]
	 * : Sort the output by the given column.
	 * ---
	 * default: none
	 * options:
	 *   - none
	 *   - key
	 *   - value
	 *   - type
	 *   - default
	 *   - title
	 *   - description
	 *   - section
	 * ---
	 *
	 * [--sort-order=<sortOrder>]
	 * : Sort order
	 * ---
	 * default: asc
	 * options:
	 *   - asc
	 *   - desc
	 * ---
	 *
	 * [--format=<format>]
	 * : The format for the returned list
	 * ---
	 * default: table
	 * options:
	 *   - table
	 *   - json
	 *   - csv
	 *   - yaml
	 *   - count
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba option list
	 *
	 *     wp akeeba option list --profile=2 --format=json
	 *
	 *     wp akeeba option list --profile=2 --filter="core." --sort-by=key --sort-order=desc
	 *
	 * @when       after_wp_load
	 * @subcommand list
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 *
	 * @since       3.0.0
	 */
	public function _list($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();

		$format    = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$profileID = max(1, $profileID);

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$model->findOrFail($profileID);
		}
		catch (Exception $e)
		{
			WP_CLI::error("Could not find profile #$profileID.");
		}

		unset($model);

		// Get the profile's configuration
		Platform::getInstance()->load_configuration($profileID);
		$config = Factory::getConfiguration();
		$ini    = $config->exportAsINI();

		unset($config);

		// Get the key information from the GUI data
		$info = $this->parseJsonGuiData();

		// Convert the INI data we got into an array we can print
		$rawValues = ParseIni::parse_ini_file($ini, true, true);

		unset($ini);

		$output = [];

		foreach ($rawValues as $section => $contents)
		{
			foreach ($contents as $k => $v)
			{
				$key          = $section . '.' . $k;
				$output[$key] = array_merge([
					'key'          => $key,
					'value'        => $v,
					'title'        => '',
					'description'  => '',
					'type'         => '',
					'default'      => '',
					'section'      => '',
					'options'      => [],
					'optionTitles' => [],
					'limits'       => [],
				], $this->getOptionInfo($key, $info));
			}
		}

		// Filter the returned options
		$filter = isset($assoc_args['filter']) ? $assoc_args['filter'] : '';

		$output = array_filter($output, function ($item) use ($filter) {
			if (!empty($filter) && strpos($item['key'], $filter) !== 0)
			{
				return false;
			}

			return $item['type'] != 'hidden';
		});

		// Sort the results
		$sort  = isset($assoc_args['sort-by']) ? $assoc_args['sort-by'] : 'none';
		$order = isset($assoc_args['sort-order']) ? $assoc_args['sort-order'] : 'asc';

		if ($sort != 'none')
		{
			usort($output, function ($a, $b) use ($sort, $order) {
				if ($a[$sort] == $b[$sort])
				{
					return 0;
				}

				$signChange = ($order == 'asc') ? 1 : -1;
				$isGreater  = $a[$sort] > $b[$sort] ? 1 : -1;

				return $signChange * $isGreater;
			});
		}

		// Output the list
		if (empty($output))
		{
			WP_CLI::error("No options found matching your criteria.");
		}

		$keys     = array_keys($output);
		$firstKey = array_shift($keys);
		CliUtils\format_items($format, $output, array_keys($output[$firstKey]));
	}

	/**
	 * Gets the value of a configuration option for an Akeeba Backup profile
	 *
	 * ## OPTIONS
	 *
	 * <key>
	 * : The option key to retrieve
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--format=<format>]
	 * : The format for the returned value
	 * ---
	 * default: text
	 * options:
	 *   - text
	 *   - json
	 *   - print_r
	 *   - var_dump
	 *   - var_export
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba option get akeeba.basic.archive_name
	 *
	 *     wp akeeba option get akeeba.basic.archive_name --profile=2
	 *
	 *     wp akeeba option get akeeba.basic.archive_name --profile=2 --format=var_export
	 *
	 * @when       after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 *
	 * @since       3.0.0
	 */
	public function get($args, $assoc_args)
	{
		$key = isset($args[0]) ? $args[0] : null;

		if (empty($key))
		{
			WP_CLI::error("You must specify the option key to retrieve.");
		}

		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();

		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$profileID = max(1, $profileID);

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$model->findOrFail($profileID);
		}
		catch (Exception $e)
		{
			WP_CLI::error("Could not find profile #$profileID.");
		}

		unset($model);

		// Get the profile's configuration
		Platform::getInstance()->load_configuration($profileID);
		$config = Factory::getConfiguration();

		$value = $config->get($key, '', false);

		switch ($assoc_args['format'])
		{
			case 'text':
			default:
				echo $value;
				break;

			case 'json':
				echo json_encode($value);
				break;

			case 'print_r':
				print_r($value);
				break;

			case 'var_dump':
				var_dump($value);
				break;

			case 'var_export':
				var_export($value);
				break;

		}
	}

	/**
	 * Sets the value of a configuration option for an Akeeba Backup profile
	 *
	 * ## OPTIONS
	 *
	 * <key>
	 * : The option key to set
	 *
	 * <value>
	 * : The value to set
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--force]
	 * : Allow setting of protected options.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba option set akeeba.basic.archive_name "site-[HOST]-[DATE]-[TIME]"
	 *
	 *     wp akeeba option set akeeba.basic.archive_name "site-[HOST]-[DATE]-[TIME]" --profile=2
	 *
	 * @when       after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 *
	 * @since       3.0.0
	 */
	public function set($args, $assoc_args)
	{
		$key   = isset($args[0]) ? $args[0] : null;
		$value = isset($args[1]) ? $args[1] : null;

		if (empty($key))
		{
			WP_CLI::error("You must specify the option key to set.");
		}

		if (is_null($value))
		{
			WP_CLI::error("You must specify the option value to set.");
		}

		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();

		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$profileID = max(1, $profileID);

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$model->findOrFail($profileID);
		}
		catch (Exception $e)
		{
			WP_CLI::error("Could not find profile #$profileID.");
		}

		unset($model);

		// Get the profile's configuration
		Platform::getInstance()->load_configuration($profileID);
		$config = Factory::getConfiguration();

		// Get the key information from the GUI data
		$info = $this->parseJsonGuiData();

		// Does the key exist?
		if (!array_key_exists($key, $info['options']))
		{
			WP_CLI::error("Invalid option key '$key'.");
		}

		// Validate / sanitize the value
		$optionInfo = $this->getOptionInfo($key, $info);

		switch ($optionInfo['type'])
		{
			case 'integer':
				$value = (int) $value;

				if (($value < $optionInfo['limits']['min']) || ($value > $optionInfo['limits']['max']))
				{
					WP_CLI::error("Invalid value '$value': out of bounds.");
				}
				break;

			case 'bool':
				if (is_numeric($value))
				{
					$value = (int) $value;
				}
				elseif (is_string($value))
				{
					$value = strtolower($value);
				}

				if (in_array($value, [false, 0, '0', 'false', 'no', 'off'], true))
				{
					$value = 0;
				}
				elseif (in_array($value, [true, 1, '1', 'true', 'yes', 'on'], true))
				{
					$value = 1;
				}
				else
				{
					WP_CLI::error("Invalid boolean value '$value': use one of 0, false, no, off, 1, true, yes or on.'");
				}

				break;

			case 'enum':
				if (!in_array($value, $optionInfo['options']))
				{
					$options = array_map(function ($v) {
						return "'$v'";
					}, $optionInfo['options']);
					$options = implode(', ', $options);

					WP_CLI::error("Invalid enumerated value '$value'. Must be one of $options.");
				}

				break;

			case 'hidden':
				WP_CLI::error("Setting hidden option '$key' is not allowed.");
				break;

			case 'string':
				break;

			default:
				WP_CLI::error("Unknown type {$optionInfo['type']} for option '$key'. Have you manually tampered with the option INI files?");
				break;
		}

		$protected = $config->getProtectedKeys();
		$force     = isset($assoc_args['force']) && $assoc_args['force'];

		if (in_array($key, $protected) && !$force)
		{
			WP_CLI::error("Cannot set protected option '$key'. Please use the --force option to override the protection.");
		}

		if (in_array($key, $protected) && $force)
		{
			$config->setKeyProtection($key, false);
		}

		$result = $config->set($key, $value, false);

		if ($result === false)
		{
			WP_CLI::error("Could not set option '$key'.");
		}

		Platform::getInstance()->save_configuration($profileID);

		WP_CLI::success("Successfully set option '$key' to '$value'");
	}

	/**
	 * Parse the JSON GUI definition returned by Akeeba Engine into something I can use to provide information about
	 * the options.
	 *
	 * @return  array
	 *
	 * @since       3.0.0
	 */
	private function parseJsonGuiData()
	{
		$jsonGUIData = Factory::getEngineParamsProvider()->getJsonGuiDefinition();
		$guiData     = json_decode($jsonGUIData, true);

		$ret = [
			'engines'    => [],
			'installers' => [],
			'options'    => [],
		];

		// Parse engines
		foreach ($guiData['engines'] as $engineType => $engineRecords)
		{
			if (!isset($ret['engines'][$engineType]))
			{
				$ret['engines'][$engineType] = [];
			}

			foreach ($engineRecords as $engineName => $record)
			{
				$ret['engines'][$engineType][$engineName] = [
					'title'       => $record['information']['title'],
					'description' => $record['information']['description'],
				];

				foreach ($record['parameters'] as $key => $optionRecord)
				{
					$ret['options'][$key] = array_merge($optionRecord, [
						'section' => $record['information']['title'],
					]);
				}
			}
		}

		// Parse installers
		foreach ($guiData['installers'] as $installerName => $installerInfo)
		{
			$ret['installers'][$installerName] = $installerInfo['name'];
		}

		// Parse GUI sections
		foreach ($guiData['gui'] as $section => $options)
		{
			foreach ($options as $key => $optionRecord)
			{
				$ret['options'][$key] = array_merge($optionRecord, [
					'section' => $section,
				]);
			}
		}

		return $ret;
	}

	/**
	 * Get the information for an option record.
	 *
	 * @param   string $key  The option key
	 * @param   array  $info The array returned by parseJsonGuiData
	 *
	 * @return  array
	 *
	 * @since       3.0.0
	 */
	private function getOptionInfo($key, &$info)
	{
		$ret = [];

		if (!isset($info['options'][$key]))
		{
			return $ret;
		}

		$keyInfo = $info['options'][$key];

		$ret = [
			'title'        => $keyInfo['title'],
			'description'  => $keyInfo['description'],
			'section'      => $keyInfo['section'],
			'type'         => $keyInfo['type'],
			'default'      => $keyInfo['default'],
			'options'      => [],
			'optionTitles' => [],
			'limits'       => [],
		];

		switch ($keyInfo['type'])
		{
			case 'integer':
				if (isset($keyInfo['shortcuts']))
				{
					$ret['options'] = explode('|', $keyInfo['shortcuts']);
				}

				$ret['limits'] = [
					'min' => $keyInfo['min'],
					'max' => $keyInfo['max'],
				];
				break;

			case 'bool':
				$ret['type']    = 'integer';
				$ret['options'] = [0, 1];
				$ret['limits']  = [
					'min' => 0,
					'max' => 1,
				];
				break;

			case 'engine':
				$ret['type']         = 'enum';
				$ret['type']         = 'string';
				$ret['options']      = array_keys($info['engines'][$keyInfo['subtype']]);
				$ret['optionTitles'] = [];

				foreach ($info['engines'][$keyInfo['subtype']] as $k => $details)
				{
					$ret['optionTitles'][$k] = $details['title'];
				}

				break;

			case 'installer':
				$ret['type']         = 'enum';
				$ret['type']         = 'string';
				$ret['options']      = array_keys($info['installers']);
				$ret['optionTitles'] = $info['installers'];

				break;

			case 'enum':
				$ret['type']         = 'string';
				$ret['options']      = explode('|', $keyInfo['enumvalues']);
				$ret['optionTitles'] = explode('|', $keyInfo['enumkeys']);

				break;

			case 'hidden':
			case 'button':
			case 'separator':
				$ret['type'] = 'hidden';
				break;

			case 'string':
			case 'browsedir':
			case 'password':
			default:
				$ret['type'] = 'string';
				break;
		}

		return $ret;
	}
}
