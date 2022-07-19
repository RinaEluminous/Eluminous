<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Akeeba\WPCLI\Command;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Akeeba\Engine\Util\RandomValue;
use Akeeba\WPCLI\Utils\UUID4;
use Awf\Application\Application;
use Awf\Mvc\Model;
use WP_CLI;
use WP_CLI\Utils as CliUtils;

/**
 * Tell Akeeba Backup which files, directories and database tables to exclude from; or which directories and databases external to your site to include to your backup.
 *
 * @package     Akeeba\WPCLI\Command
 *
 * @since       3.0.0
 */
class Filter
{
	/**
	 * Get the filter values known to Akeeba Backup.
	 *
	 * ## OPTIONS
	 *
	 * [--root=<root>]
	 * : Which filter root to use. Defaults to [SITEROOT] or [SITEDB] depending on the --target option. Ignored for --type=include. Tip: the filesystem and database roots are the "filter" column for --type-include. There are two special roots, [SITEROOT] (the filesystem root of the WordPress site) and [SITEDB] (the main database of the WordPress site).
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--target=<target>]
	 * : The target of filters you want to list
	 * ---
	 * default: fs
	 * options:
	 *   - fs
	 *   - db
	 * ---
	 *
	 * [--type=<type>]
	 * : The type of filters you want to list
	 * ---
	 * default: exclude
	 * options:
	 *   - exclude
	 *   - include
	 *   - regex
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
	 *     wp akeeba filter list --target=db --type=exclude
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
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$this->activateProfile($profileID);

		$root   = isset($assoc_args['root']) ? $assoc_args['root'] : '';
		$target = isset($assoc_args['target']) ? $assoc_args['target'] : 'fs';
		$type   = isset($assoc_args['type']) ? $assoc_args['type'] : 'exclude';
		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';
		$output = [];

		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();

		$roots = $this->getRoots($target);

		if (empty($root))
		{
			$root = ($target == 'fs') ? '[SITEROOT]' : '[SITEDB]';
		}

		if (!in_array($root, $roots))
		{
			WP_CLI::error("Unknown $target root '$root'.");
		}

		switch ("$target.$type")
		{
			case "fs.exclude":
				/** @var \Solo\Model\Fsfilters $model */
				$model      = Model::getTmpInstance($container->application_name, 'Fsfilters', $container);
				$allFilters = $model->get_filters($root);

				foreach ($allFilters as $item)
				{
					$output[] = [
						'filter' => $item['node'],
						'type'   => $item['type'],
					];
				}

				break;

			case "fs.regex":
				/** @var \Solo\Model\Regexfsfilters $model */
				$model      = Model::getTmpInstance($container->application_name, 'Regexfsfilters', $container);
				$allFilters = $model->get_regex_filters($root);

				foreach ($allFilters as $item)
				{
					$output[] = [
						'filter' => $item['item'],
						'type'   => $item['type'],
					];
				}

				break;

			case "fs.include":
				/** @var \Solo\Model\Extradirs $model */
				$model      = Model::getTmpInstance($container->application_name, 'Extradirs', $container);
				$allFilters = $model->get_directories();

				foreach ($allFilters as $uuid => $item)
				{
					$output[] = [
						'filter'               => $uuid,
						'type'                 => 'extradirs',
						'filesystem_directory' => $item[0],
						'virtual_directory'    => $item[1],
					];
				}

				break;

			case "db.exclude":
				/** @var \Solo\Model\Dbfilters $model */
				$model      = Model::getTmpInstance($container->application_name, 'Dbfilters', $container);
				$allFilters = $model->get_filters($root);

				foreach ($allFilters as $item)
				{
					$output[] = [
						'filter' => $item['node'],
						'type'   => $item['type'],
					];
				}

				break;

			case "db.regex":
				/** @var \Solo\Model\Regexdbfilters $model */
				$model      = Model::getTmpInstance($container->application_name, 'Regexdbfilters', $container);
				$allFilters = $model->get_regex_filters($root);

				foreach ($allFilters as $item)
				{
					$output[] = [
						'filter' => $item['item'],
						'type'   => $item['type'],
					];
				}

				break;

			case "db.include":
				/** @var \Solo\Model\Multidb $model */
				$model      = Model::getTmpInstance($container->application_name, 'Multidb', $container);
				$allFilters = $model->get_databases();

				foreach ($allFilters as $uuid => $item)
				{
					$output[] = [
						'filter'   => $uuid,
						'type'     => 'multidb',
						'host'     => $item['host'],
						'driver'   => $item['driver'],
						'port'     => $item['port'],
						'username' => $item['username'],
						'password' => $item['password'],
						'database' => $item['database'],
						'prefix'   => $item['prefix'],
						'dumpFile' => $item['dumpFile'],
					];
				}

				break;
		}

		if (empty($output))
		{
			WP_CLI::error('No records found.');
		}

		$keys     = array_keys($output);
		$firstKey = array_shift($keys);
		CliUtils\format_items($format, $output, array_keys($output[$firstKey]));
	}

	/**
	 * Activate an Akeeba Backup profile, after checking it actually exists
	 *
	 * @param   int $profileID The profile ID to activate
	 *
	 * @return void
	 * @throws WP_CLI\ExitException
	 *
	 * @since       3.0.0
	 */
	private function activateProfile($profileID)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		$profileID = max(1, $profileID);

		/** @var \Solo\Model\Profiles $model */
		$model = Model::getTmpInstance($container->application_name, 'Profiles', $container);

		try
		{
			$model->findOrFail($profileID);
		}
		catch (\Exception $e)
		{
			WP_CLI::error("Could not find profile #$profileID.");
		}

		unset($model);

		// Get the profile's configuration
		Platform::getInstance()->load_configuration($profileID);
	}

	/**
	 * @param   string $target
	 *
	 * @return  array
	 *
	 * @since       3.0.0
	 */
	private function getRoots($target)
	{
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		$filters   = Factory::getFilters();
		$output    = [];

		switch ($target)
		{
			case 'fs':
				$rootInfo = $filters->getInclusions('dir');

				foreach ($rootInfo as $item)
				{
					$output[] = $item[0];
				}

				break;

			case 'db':
				/** @var \Solo\Model\Dbfilters $model */
				$model    = Model::getTmpInstance($container->application_name, 'Dbfilters', $container);
				$rootInfo = $model->get_roots();

				foreach ($rootInfo as $item)
				{
					$output[] = $item->value;
				}

				break;
		}

		return $output;
	}

	/**
	 * Delete (remove) an exclusion or inclusion filter from Akeeba Backup
	 *
	 * ## OPTIONS
	 *
	 * <filter>
	 * : Which filter to remove. Consult the output `akeeba filter list`.
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--root=<root>]
	 * : Which filter root to use. Defaults to [SITEROOT] or [SITEDB] depending on the --target option. Ignored for --type=include.
	 *
	 * [--type=<type>]
	 * : The type of filters you want to list.
	 * ---
	 * default: files
	 * options:
	 *   - files
	 *   - directories
	 *   - skipdirs
	 *   - skipfiles
	 *   - regexfiles
	 *   - regexdirectories
	 *   - regexskipdirs
	 *   - regexskipfiles
	 *   - tables
	 *   - tabledata
	 *   - regextables
	 *   - regextabledata
	 *   - extradirs
	 *   - multidb
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba filter delete  "wp-content/subfolder/file.txt" --type=files
	 *
	 *     wp akeeba filter delete "wp-content/subfolder/exclude_me" --profile=2 --type=directories --root=DF3A2314-DE9D-4A56-BB74-43CCC2C44F42
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
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$this->activateProfile($profileID);

		$root     = isset($assoc_args['root']) ? $assoc_args['root'] : '';
		$type     = isset($assoc_args['type']) ? $assoc_args['type'] : 'exclude';
		$rootType = (strpos($type, 'table') === false) ? 'fs' : 'db';
		$roots    = $this->getRoots($rootType);

		if (empty($root))
		{
			$root = ($rootType == 'fs') ? '[SITEROOT]' : '[SITEDB]';
		}

		if (!in_array($root, $roots))
		{
			WP_CLI::error("Unknown $rootType root '$root'.");
		}

		// Get filter, make sure it exists
		$filter = isset($args[0]) ? $args[0] : null;

		if (is_null($filter))
		{
			WP_CLI::error("You must specify the filter to delete");
		}

		// Is this a regex filter? Check for PRO
		$isPro = defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO;

		if ((stripos($type, 'regex') !== false) && !$isPro)
		{
			WP_CLI::error("Filters of the '{$type}' type are only available with Akeeba Backup Professional.");
		}

		// Delete the filter
		$filterObject = Factory::getFilterObject($type);

		switch ($type)
		{
			case 'extradirs':
			case 'multidb':
				if (!$isPro)
				{
					WP_CLI::error("Filters of the '{$type}' type are only available with Akeeba Backup Professional.");
				}

				$success = $filterObject->remove($filter);
				break;

			default:
				$success = $filterObject->remove($root, $filter);
				break;
		}


		if (!$success)
		{
			WP_CLI::error("Could not delete filter '$filter' of type '$type'.");
		}

		// Finally, save the filters back to the database
		Factory::getFilters()->save();

		WP_CLI::success("Deleted filter '$filter' of type '$type'.");
	}

	/**
	 * Set an exclusion filter to Akeeba Backup
	 *
	 * ## OPTIONS
	 *
	 * <filter>
	 * : Which filter to add. This is the full path to a file/directory, a table name or a regular expression, depending on the filter type.
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Default: 1.
	 *
	 * [--root=<root>]
	 * : Which filter root to use. Defaults to [SITEROOT] or [SITEDB] depending on the --target option. Ignored for --type=include.
	 *
	 * [--type=<type>]
	 * : The type of filters you want to list.
	 * ---
	 * default: files
	 * options:
	 *   - files
	 *   - directories
	 *   - skipdirs
	 *   - skipfiles
	 *   - regexfiles
	 *   - regexdirectories
	 *   - regexskipdirs
	 *   - regexskipfiles
	 *   - tables
	 *   - tabledata
	 *   - regextables
	 *   - regextabledata
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba filter exclude  "wp-content/subfolder/file.txt" --type=files
	 *
	 *     wp akeeba filter exclude "wp-content/subfolder/exclude_me" --profile=2 --type=directories --root=DF3A2314-DE9D-4A56-BB74-43CCC2C44F42
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
	public function exclude($args, $assoc_args)
	{
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$this->activateProfile($profileID);

		$root     = isset($assoc_args['root']) ? $assoc_args['root'] : '';
		$type     = isset($assoc_args['type']) ? $assoc_args['type'] : 'exclude';
		$rootType = (strpos($type, 'table') === false) ? 'fs' : 'db';
		$roots    = $this->getRoots($rootType);

		if (empty($root))
		{
			$root = ($rootType == 'fs') ? '[SITEROOT]' : '[SITEDB]';
		}

		if (!in_array($root, $roots))
		{
			WP_CLI::error("Unknown $rootType root '$root'.");
		}

		// Get filter, make sure it exists
		$filter = isset($args[0]) ? $args[0] : null;

		if (is_null($filter))
		{
			WP_CLI::error("You must specify the filter to add");
		}

		// Is this a regex filter? Check for PRO
		$isPro = defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO;

		if ((stripos($type, 'regex') !== false) && !$isPro)
		{
			WP_CLI::error("Filters of the '{$type}' type are only available with Akeeba Backup Professional.");
		}

		// Delete the filter
		$filterObject = Factory::getFilterObject($type);
		$success      = $filterObject->set($root, $filter);

		if (!$success)
		{
			WP_CLI::error("Could not add filter '$filter' of type '$type'.");
		}

		// Finally, save the filters back to the database
		Factory::getFilters()->save();

		WP_CLI::success("Added filter '$filter' of type '$type'.");
	}

	/**
	 * Tells Akeeba Backup to back up an off-site directory. If the directory is already added it throws an error.
	 *
	 * ## OPTIONS
	 *
	 * <directory>
	 * : Which off-site directory to add to the backup
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Inclusions are per profile. Default: 1.
	 *
	 * [--virtual=<folder>]
	 * : The subfolder inside the backup archive where these files will be stored. This is a subfolder of the "virtual directory" whose name is set in the Configuration page.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba filter include-directory "[ROOTPARENT]/secret_files"
	 *
	 *     wp akeeba filter include-directory "[ROOTPARENT]/secret_files" --profile=2 --virtual=my_secret_files
	 *
	 * @when       after_wp_load
	 * @subcommand include-directory
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
	public function includeDirectory($args, $assoc_args)
	{
		if (!defined('AKEEBABACKUP_PRO') || !AKEEBABACKUP_PRO)
		{
			WP_CLI::error("This command is only available with Akeeba Backup Professional.");
		}

		// Activate the correct profile
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$this->activateProfile($profileID);

		// Initialization
		$uuidObject = new UUID4(true);
		$virtual    = isset($assoc_args['virtual']) ? $assoc_args['virtual'] : '';
		$uuid       = $uuidObject->get('-');
		$directory  = isset($args[0]) ? $args[0] : null;

		if (empty($directory))
		{
			WP_CLI::error("You must specify the directory to include.");
		}

		// Check if there is another inclusion filter for the same directory
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		/** @var \Solo\Model\Extradirs $model */
		$model      = Model::getTmpInstance($container->application_name, 'Extradirs', $container);
		$allFilters = $model->get_directories();

		foreach ($allFilters as $root => $filterData)
		{
			if ($filterData[0] == $directory)
			{
				WP_CLI::error("The directory '$directory' is already included with root '$root'. Delete the old inclusion filter before trying to add the directory again.");
			}
		}

		// Create a new inclusion filter
		if (empty($virtual))
		{
			$randomValue  = new RandomValue();
			$randomPrefix = ($randomValue)->generateString(8);
			$virtual      = $randomPrefix . '-' . basename($directory);
		}

		$data = array(
			0 => $directory,
			1 => $virtual,
		);

		$filterObject = Factory::getFilterObject('extradirs');
		$success      = $filterObject->set($uuid, $data);

		$filters = Factory::getFilters();

		if (!$success)
		{
			WP_CLI::error("Could not add directory '$directory'.");
		}

		// Save to the database
		$filters->save();

		WP_CLI::success("Added directory '$directory'.");
	}

	/**
	 * Tells Akeeba Backup to back up a database other then the site's main database. If the database is already added it throws an error.
	 *
	 * ## OPTIONS
	 *
	 * [--profile=<profile>]
	 * : The backup profile to use. Inclusions are per profile. Default: 1.
	 *
	 * [--dbdriver=<driver>]
	 * : The database driver to use. Required.
	 * ---
	 * default: mysqli
	 * options:
	 *   - mysqli
	 *   - mysql
	 *   - pdomysql
	 *   - postgresql
	 *   - sqlazure
	 *   - sqlite
	 *   - sqlsrv
	 * ---
	 *
	 * [--dbport=<port>]
	 * : The database server port. Skip to use the driver's default. Optional.
	 *
	 * [--dbusername=<username>]
	 * : The database connection username. Required.
	 *
	 * [--dbpassword=<password>]
	 * : The database connection password. Required.
	 *
	 * [--dbname=<database>]
	 * : The database name. Required.
	 *
	 * [--dbprefix=<prefix>]
	 * : The common prefix of the database table names, allows you to change it on restoration. Optional.
	 *
	 * [--check]
	 * : Check the database connection before adding the filter. Enabled by default. Use --no-check to prevent checking.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba filter include-database --database=foo --username=myuser --password=mypass
	 *
	 *     wp akeeba filter include-database --profile=2 --database=foo --username=myuser --password=mypass --prefix="foo_"
	 *
	 * @when       after_wp_load
	 * @subcommand include-database
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
	public function includeDatabase($args, $assoc_args)
	{
		if (!defined('AKEEBABACKUP_PRO') || !AKEEBABACKUP_PRO)
		{
			WP_CLI::error("This command is only available with Akeeba Backup Professional.");
		}

		// Activate the correct profile
		$profileID = isset($assoc_args['profile']) ? (int) $assoc_args['profile'] : 1;
		$this->activateProfile($profileID);

		// Initialization
		$uuidObject = new UUID4(true);
		$virtual    = isset($assoc_args['virtual']) ? $assoc_args['virtual'] : '';
		$uuid       = $uuidObject->get('-');
		$check      = isset($assoc_args['check']) ? $assoc_args['check'] : true;

		// Retrieve the data from the options
		$data = [
			'driver'   => isset($assoc_args['dbdriver']) ? $assoc_args['dbdriver'] : 'mysqli',
			'host'     => isset($assoc_args['dbhost']) ? $assoc_args['dbhost'] : 'localhost',
			'port'     => isset($assoc_args['dbport']) ? $assoc_args['dbport'] : '',
			'user'     => isset($assoc_args['dbusername']) ? $assoc_args['dbusername'] : '',
			'password' => isset($assoc_args['dbpassword']) ? $assoc_args['dbpassword'] : '',
			'database' => isset($assoc_args['dbname']) ? $assoc_args['dbname'] : '',
			'prefix'   => isset($assoc_args['dbprefix']) ? $assoc_args['dbprefix'] : '',
		];

		// Does the database definition already exist?
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		/** @var \Solo\Model\Multidb $model */
		$model = Model::getTmpInstance($container->application_name, 'Multidb', $container);

		if ($model->filterExists($data))
		{
			WP_CLI::error("The database '{$data['database']}' is already included. Delete the old inclusion filter before trying to add the database again.");
		}

		// Can I connect to the database?
		$checkResults = $model->test($data);

		if ($check && !$checkResults['status'])
		{
			WP_CLI::error("Could not connect to the database '{$data['database']}'. Server reported '{$checkResults['message']}'. Use the --no-check option to continue anyway but be advised that your backup will most likely result in an error.");
		}

		die('lakama');

		// Add the filter
		if (!$model->setFilter($uuid, $data))
		{
			WP_CLI::error("Could not include database '{$data['database']}'.");
		}

		WP_CLI::success("Added database '{$data['database']}'.");
	}


}