<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Akeeba\WPCLI\Command;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Mvc\Model;
use Solo\Application;
use WP_CLI;
use WP_CLI\Utils as CliUtils;

/**
 * Add, remove, reset, modify, import or export your Akeeba Backup profiles.
 *
 * @package     Akeeba\WPCLI\Command
 *
 * @since       3.0.0
 */
class Profile
{
	/**
	 * Lists the Akeeba Backup backup profiles
	 *
	 * ## OPTIONS
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
	 *     wp akeeba profile list
	 *
	 *     wp akeeba profile list --format=json
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

		$format    = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';
		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model    = Model::getTmpInstance($container->application_name, 'Profiles', $container);
		$profiles = $model->get();

		CliUtils\format_items($format, $profiles->toArray(), ['id', 'description', 'quickicon']);
	}

	/**
	 * Creates a copy of an Akeeba Backup profile
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric ID of the profile to copy
	 *
	 * [--filters]
	 * : Include filters in the copy. Enabled by default. Use --no-filters to disable.
	 *
	 * [--description=<description>]
	 * : Description for the new backup profile. Uses the old profile's description if not specified.
	 *
	 * [--quickicon=<quickicon>]
	 * : Should the new backup profile have a one-click backup icon? Copies the old profile's setting if not specified.
	 *
	 * [--format=<format>]
	 * : The format for the response. Use JSON to get a JSON-parseable numeric ID of the new backup profile.
	 * ---
	 * default: text
	 * options:
	 *   - text
	 *   - json
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile copy 1
	 *
	 *     wp akeeba profile copy 1 --description="Default profile without any filters" --no-filters
	 *
	 *     wp akeeba profile copy 1 --quickicon=0 --description="Cloned default profile"
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
	public function copy($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		if (!isset($args[0]))
		{
			WP_CLI::error("You must specify the backup profile ID to copy.");
		}

		$profileID = (int) $args[0];

		if ($profileID <= 0)
		{
			WP_CLI::error("The backup profile ID to copy from must be a positive integer.");
		}

		$withFilters = isset($assoc_args['filters']) ? (bool) $assoc_args['filters'] : true;

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$source = $model->findOrFail($profileID);
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot copy profile $profileID; profile not found.");
		}

		$profileData = $source->getData();
		unset($profileData['id']);

		if (!$withFilters)
		{
			$profileData['filters'] = '';
		}

		if (isset($assoc_args['description']))
		{
			$profileData['description'] = trim($assoc_args['description']);
		}

		if (isset($assoc_args['quickicon']))
		{
			$profileData['quickicon'] = (bool) $assoc_args['quickicon'] ? 1 : 0;
		}

		try
		{
			$newProfile = $model->create($profileData);
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot copy profile #$profileID: {$e->getMessage()}");
		}

		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'text';

		if ($format == 'json')
		{
			echo json_encode($newProfile->getData());

			return;
		}

		WP_CLI::success("Copy successful. Created new profile with ID {$newProfile->getId()}.");
	}

	/**
	 * Creates a new Akeeba Backup profile
	 *
	 * ## OPTIONS
	 *
	 * [--description=<description>]
	 * : Description for the new backup profile. Default: "New backup profile".
	 *
	 * [--quickicon=<quickicon>]
	 * : Should the new backup profile have a one-click backup icon? Default: 1.
	 *
	 * [--format=<format>]
	 * : The format for the response. Use JSON to get a JSON-parseable numeric ID of the new backup profile.
	 * ---
	 * default: text
	 * options:
	 *   - text
	 *   - json
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile create
	 *
	 *     wp akeeba profile create --description="For moving site to example.com"
	 *
	 *     wp akeeba profile create --description="Backup after post creation" --quickicon=1
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
	public function create($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		// Set up the new profile data
		$profileData = [
			'description'   => 'New backup profile',
			'quickicon'     => '1',
			'configuration' => '',
			'filters'       => '',
		];

		if (isset($assoc_args['description']))
		{
			$profileData['description'] = trim($assoc_args['description']);
		}

		if (isset($assoc_args['quickicon']))
		{
			$profileData['quickicon'] = (bool) $assoc_args['quickicon'] ? 1 : 0;
		}

		// Create the profile
		try
		{
			$newProfile = $model->create($profileData);
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot create profile: {$e->getMessage()}");
		}

		/**
		 * Create a new profile configuration.
		 *
		 * Loading the new profile's empty configuration causes the Platform code to revert to the default options and
		 * save them automatically to the database.
		 */
		$profileId = $newProfile->getId();
		Platform::getInstance()->load_configuration($profileId);

		// Display the results
		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'text';

		if ($format == 'json')
		{
			echo json_encode($newProfile->getId());

			return;
		}

		WP_CLI::success("Copy successful. Created new profile with ID {$newProfile->getId()}.");
	}

	/**
	 * Deletes an Akeeba Backup profile
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric ID of the profile to copy. It CAN NOT be 1; the default backup profile must always be present.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile delete 2
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
	public function delete($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		if (!isset($args[0]))
		{
			WP_CLI::error("You must specify the backup profile ID to delete.");
		}

		$profileID = (int) $args[0];

		if ($profileID <= 0)
		{
			WP_CLI::error("The backup profile ID to delete must be a positive integer.");
		}

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$profile = $model->findOrFail($profileID);
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot delete profile $profileID; profile not found.");
		}

		try
		{
			$profile->forceDelete($profile->getId());
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot delete profile $profileID; {$e->getMessage()}.");
		}

		WP_CLI::success("Profile $profileID has been deleted.");
	}

	/**
	 * Change the description or quick icon setting of an Akeeba Backup profile.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric ID of the profile to modify
	 *
	 * [--description=<description>]
	 * : Description for the new backup profile. Uses the old profile's description if not specified.
	 *
	 * [--quickicon=<quickicon>]
	 * : Should the new backup profile have a one-click backup icon? Copies the old profile's setting if not specified.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile modify 1 --description="Foo bar"
	 *
	 *     wp akeeba profile modify 1 --quickicon=0
	 *
	 *     wp akeeba profile modify 1 --description="Foo bar" --quickicon=0
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
	public function modify($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		if (!isset($args[0]))
		{
			WP_CLI::error("You must specify the backup profile ID to modify.");
		}

		$profileID = (int) $args[0];

		if ($profileID <= 0)
		{
			WP_CLI::error("The backup profile ID to modify must be a positive integer.");
		}

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$profile = $model->findOrFail($profileID);
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot modify profile $profileID; profile not found.");
		}

		if (isset($assoc_args['description']))
		{
			$profile->description = trim($assoc_args['description']);
		}

		if (isset($assoc_args['quickicon']))
		{
			$profile->quickicon = (bool) $assoc_args['quickicon'] ? 1 : 0;
		}

		try
		{
			$profile->save();
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot save profile #$profileID: {$e->getMessage()}");
		}

		WP_CLI::success("Profile $profileID modified successfully.");
	}

	/**
	 * Reset the filters and / or backup engine configuration of an Akeeba Backup profile.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric ID of the profile to reset
	 *
	 * [--filters]
	 * : Reset filters. Enabled by default. Use --no-filters to disable.
	 *
	 * [--configuration]
	 * : Reset the engine configuration. Enabled by default. Use --no-configuration to disable.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile reset 1
	 *
	 *     wp akeeba profile reset 1 --no-filters
	 *
	 *     wp akeeba profile reset 1 --no-configuration
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
	public function reset($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		if (!isset($args[0]))
		{
			WP_CLI::error("You must specify the backup profile ID to reset.");
		}

		$profileID = (int) $args[0];

		if ($profileID <= 0)
		{
			WP_CLI::error("The backup profile ID to reset must be a positive integer.");
		}

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$profile = $model->findOrFail($profileID);
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot reset profile $profileID; profile not found.");
		}

		$filters       = isset($assoc_args['filters']) ? $assoc_args['filters'] : true;
		$configuration = isset($assoc_args['configuration']) ? $assoc_args['configuration'] : true;

		if ($filters)
		{
			$profile->filters = '';
		}

		if ($configuration)
		{
			$profile->configuration = '';
		}

		if (!$filters && !$configuration)
		{
			WP_CLI::error("You have chosen to reset neither filters nor configuration. There is nothing for me to do.");
		}

		try
		{
			$profile->save();
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot save profile #$profileID: {$e->getMessage()}");
		}

		/**
		 * Loading the new profile's empty configuration causes the Platform code to revert to the default options and
		 * save them automatically to the database.
		 */
		if ($configuration)
		{
			Platform::getInstance()->load_configuration($profileID);
		}

		WP_CLI::success("Profile $profileID reset successfully.");
	}

	/**
	 * Exports an Akeeba Backup profile as a JSON string.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric ID of the profile to export
	 *
	 * [--filters]
	 * : Include filter settings. Enabled by default. Use --no-filters to disable.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile export 1
	 *
	 *     wp akeeba profile export 1 --no-filters
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
	public function export($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		if (!isset($args[0]))
		{
			WP_CLI::error("You must specify the backup profile ID to export.");
		}

		$profileID = (int) $args[0];

		if ($profileID <= 0)
		{
			WP_CLI::error("The backup profile ID to export must be a positive integer.");
		}

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$profile = $model->findOrFail($profileID);
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot export profile $profileID; profile not found.");
		}

		$data    = $profile->toArray();
		$filters = isset($assoc_args['filters']) ? $assoc_args['filters'] : true;

		if (!$filters)
		{
			unset($data['filters']);
		}

		// The ID must not be included in the export
		unset($data['id']);

		// Decrypt configuration data if necessary
		if (substr($data['configuration'], 0, 12) == '###AES128###')
		{
			// Load the server key file if necessary
			$key = Factory::getSecureSettings()->getKey();

			$data['configuration'] = Factory::getSecureSettings()->decryptSettings($data['configuration'], $key);
		}

		echo json_encode($data);
	}

	/**
	 * Exports an Akeeba Backup profile from JSON.
	 *
	 * ## OPTIONS
	 *
	 * [<fileOrJSON>]
	 * : A path to an Akeeba Backup profile export JSON file or a literal JSON string. Uses STDIN if ommited.
	 *
	 * [--format=<format>]
	 * : The format for the response. Use JSON to get a JSON-parseable numeric ID of the new backup profile.
	 * ---
	 * default: text
	 * options:
	 *   - text
	 *   - json
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba profile import /path/to/profile.json --format=json
	 *
	 *     cat /path/to/profile.json | wp akeeba profile
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
	public function import($args, $assoc_args)
	{
		global $akeebaBackupApplication;

		$json     = null;
		$filename = isset($args[0]) ? $args[0] : '';

		$json    = $this->getJSON($filename);
		$decoded = json_decode($json, true);

		if (empty($decoded))
		{
			WP_CLI::error("Cannot process input; invalid JSON string or file not found.");
		}

		// We must never pass an ID, forcing the model to create a new record
		if (isset($decoded['id']))
		{
			unset($decoded['id']);
		}

		$container = $akeebaBackupApplication->getContainer();

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$newProfile = $model->create($decoded);
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Cannot import profile: {$e->getMessage()}");
		}

		$profileID = $newProfile->getId();
		$format    = isset($assoc_args['format']) ? $assoc_args['format'] : 'text';

		if ($format == 'json')
		{
			echo json_encode($profileID);

			return;
		}

		WP_CLI::success("Successfully imported JSON as profile #$profileID");
	}

	/**
	 * Get the JSON input for import()
	 *
	 * @param   string $filename The filename to read from, raw JSON data or an empty string
	 *
	 * @return  string  The JSON data
	 *
	 * @since       3.0.0
	 */
	private function getJSON($filename)
	{
		// No filename or JSON string passed to script; use STDIN
		if (empty($filename))
		{
			$json = '';

			while (!feof(STDIN))
			{
				$json .= fgets(STDIN) . "\n";
			}

			return rtrim($json);
		}

		// An existing file path was passed. Return the contents of the file.
		if (@file_exists($filename))
		{
			$ret = @file_get_contents($filename);

			if ($ret === false)
			{
				return '';
			}
		}

		// Otherwise assume raw JSON was passed back to us.
		return $filename;
	}

}
