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
use Solo\Model\Manage;
use Solo\Model\Remotefiles;
use Solo\Model\Upload;
use WP_CLI;
use WP_CLI\Utils as CliUtils;

/**
 * Take and manage backups.
 *
 * @package     Akeeba\WPCLI\Command
 *
 * @since       version
 */
class Backup
{
	/**
	 * Takes a backup with Akeeba Backup. WARNING! Do NOT use with the --http=<http> option of WP-CLI, it will NOT work on most sites.
	 *
	 * ## OPTIONS
	 *
	 * [--profile=<profile>]
	 * : Take a backup using the given profile ID, uses profile #1 if not specified
	 *
	 * [--description=<description>]
	 * : Apply this backup description, accepts the standard Akeeba Backup archive naming variables
	 *
	 * [--comment=<comment>]
	 * : Use this backup comment, provide it in HTML
	 *
	 * [--overrides=<overrides>]
	 * : Set up configuration overrides in the format "key1=value1,key2=value2"
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup take --profile=2
	 *
	 *     wp akeeba backup take --description="Before changing menu on [DATE] [TIME]"
	 *
	 * @when  after_wp_load
	 * @alias run
	 * @alias backup
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function take($args, $assoc_args)
	{
		if (!defined('AKEEBABACKUP_PRO') || !AKEEBABACKUP_PRO)
		{
			WP_CLI::error("This command is only available in Akeeba Backup Professional");
		}

		$proCommands = new ProFeatures();
		$proCommands->takeBackup($args, $assoc_args);
	}

	/**
	 * Lists the backup records known to Akeeba Backup
	 *
	 * ## OPTIONS
	 *
	 * [--from=<from>]
	 * : How many backup records to skip before starting the output. Default: 0.
	 *
	 * [--limit=<limit>]
	 * : Maximum number of backup records to display. Default: 50.
	 *
	 * [--description=<description>]
	 * : Optional. Listed backup records must match this (partial) description.
	 *
	 * [--after=<after>]
	 * : Optional. List backup records taken after this date.
	 *
	 * [--before=<before>]
	 * : Optional. List backup records taken before this date.
	 *
	 * [--origin=<origin>]
	 * : Optional. List backups from this origin only e.g. backend, frontend, json and so on.
	 *
	 * [--profile=<profile>]
	 * : Optional. List backups taken with this profile. Expect the numeric profile ID.
	 *
	 * [--sort-by=<column>]
	 * : Sort the output by the given column.
	 * ---
	 * default: id
	 * options:
	 *   - id
	 *   - description
	 *   - profile_id
	 *   - backupstart
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
	 *     wp akeeba backup list
	 *
	 *     wp akeeba backup list --profile=2 --format=json
	 *
	 *     wp akeeba backup list --profile=2 --filter="core." --sort-by=key --sort-order=desc
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
	 */
	public function _list($args, $assoc_args)
	{
		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;

		$from   = isset($assoc_args['from']) ? (int) $assoc_args['from'] : 0;
		$limit  = isset($assoc_args['limit']) ? (int) $assoc_args['limit'] : 50;
		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';

		$filters = $this->getFilters($assoc_args);
		$order   = $this->getOrdering($assoc_args);

		$model = new Manage();
		$model->setState('limitstart', $from);
		$model->setState('limit', $limit);

		$output = $model->getStatisticsListWithMeta(false, $filters, $order);

		$keys     = array_keys($output);
		$firstKey = array_shift($keys);
		CliUtils\format_items($format, $output, array_keys($output[$firstKey]));
	}

	/**
	 * Display detailed information about a backup attempt known to Akeeba Backup.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to display
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
	 *     wp akeeba backup info 123
	 *
	 *     wp akeeba backup info 123 --format=json
	 *
	 * @when    after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function info($args, $assoc_args)
	{
		$id     = isset($args[0]) ? (int) $args[0] : 0;
		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		$record = Platform::getInstance()->get_statistics($id);

		CliUtils\format_items($format, [$record], array_keys($record));
	}

	/**
	 * Change the description and/or comment of a backup attempt known to Akeeba Backup.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to modify
	 *
	 * [--description=<description>]
	 * : The new description to save into the backup attempt record.
	 *
	 * [--comment=<comment>]
	 * : The new comment to save into the backup attempt record.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup modify 123 --description="Something"
	 *
	 *     wp akeeba backup modify 123 --comment="More info about this backup"
	 *
	 *     wp akeeba backup modify 123 --description="Something" --comment="More info about this backup"
	 *
	 * @when  after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function modify($args, $assoc_args)
	{
		$id          = isset($args[0]) ? (int) $args[0] : 0;
		$description = isset($assoc_args['description']) ? $assoc_args['description'] : null;
		$comment     = isset($assoc_args['comment']) ? $assoc_args['comment'] : null;

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		if (is_null($description) && is_null($comment))
		{
			throw new WP_CLI\ExitException("You must specify either --comment or --description.");
		}

		$record = Platform::getInstance()->get_statistics($id);

		if (!is_null($description))
		{
			$record['description'] = $description;
		}

		if (!is_null($comment))
		{
			$record['comment'] = $comment;
		}

		$dummy  = null;
		$result = Platform::getInstance()->set_or_update_statistics($id, $record, $dummy);

		if ($result === false)
		{
			WP_CLI::error("Backup record '$id' could not be modified.");

			return;
		}

		WP_CLI::success("Backup record '$id' modified successfully.");
	}

	/**
	 * Delete the backup record and / or backup archives associated with it.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to delete
	 *
	 * [--only-files]
	 * : Only delete the backup archive files, if they are stored on the site's server. Otherwise deletes the entire backup record.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup delete 123
	 *
	 *     wp akeeba backup delete 123 --only-files
	 *
	 * @when  after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function delete($args, $assoc_args)
	{
		$id        = isset($args[0]) ? (int) $args[0] : 0;
		$onlyFiles = isset($assoc_args['only-files']) ? (bool) $assoc_args['only-files'] : false;

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		$model = new Manage();
		$model->setState('id', $id);

		try
		{
			if ($onlyFiles)
			{
				$model->deleteFile();

				WP_CLI::success("The files of backup record '$id' have been deleted successfully.");

				return;
			}

			$model->delete();

			WP_CLI::success("The backup record '$id' has been deleted successfully.");

		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Cannot delete backup record '$id': {$e->getMessage()}");
		}

	}

	/**
	 * Retry uploading the archive of a backup attempt known to Akeeba Backup to the remote storage configured in the respective backup profile.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to re-upload
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup upload 123
	 *
	 * @when  after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function upload($args, $assoc_args)
	{
		$id        = isset($args[0]) ? (int) $args[0] : 0;

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		$model = new Upload();
		$part = 0;
		$frag = 0;

		while (true)
		{
			$model->setState('id', $id);
			$model->setState('part', $part);
			$model->setState('frag', $frag);
			WP_CLI::log("Trying to re-upload backup record '$id', part file #{$part}, fragment #{$frag}. This may take a while.");

			// Try uploading
			$result = $model->upload();

			// Get the modified model state
			$id   = $model->getState('id');
			$part = $model->getState('part');
			$frag = $model->getState('frag');

			if (($part >= 0) && ($result === true))
			{
				WP_CLI::success("Re-upload of backup record '$id' is complete.");

				return;
			}

			if ($result === false)
			{
				$errorMessage = $model->getState('errorMessage', '');
				WP_CLI::error("Re-upload of backup record '$id' failed: $errorMessage");

				return;
			}
		}
	}

	/**
	 * Download the archive of a backup attempt known to Akeeba Backup from the remote storage configured in the respective backup profile back to the site's server.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to fetch
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup fetch 123
	 *
	 * @when  after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function fetch($args, $assoc_args)
	{
		$id        = isset($args[0]) ? (int) $args[0] : 0;

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		$model = new Remotefiles();
		$part = 0;
		$frag = 0;

		while (true)
		{
			$model->setState('id', $id);
			$model->setState('part', $part);
			$model->setState('frag', $frag);
			WP_CLI::log("Trying to re-upload backup record '$id', part file #{$part}, fragment #{$frag}. This may take a while.");

			// Try uploading
			$ret = $model->downloadToServer();

			// Get the modified model state
			$id   = $model->getState('id');
			$part = $model->getState('part');
			$frag = $model->getState('frag');

			if ($ret['finished'])
			{
				WP_CLI::success("Fetching back backup record '$id' is complete.");

				return;
			}

			if ($ret['error'])
			{
				WP_CLI::error("Fetching back of backup record '$id' failed: {$ret['error']}");

				return;
			}
		}
	}

	/**
	 * Output the archive of a backup attempt known to Akeeba Backup, as long as it's stored on the site's server. WARNING! You SHOULD NOT use this with the --http=<http> option of WP-CLI, it will most likely result in a corrupt or truncated backup archive.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 * : The numeric id of the backup attempt you want to download
	 *
	 * [<part>]
	 * : The part number to download: 0 (.jpa), 1 (.j01) etc. If a part does not exist you get an error.
	 *
	 * [--file=<file>]
	 * : The file you want to write to. Otherwise the raw binary data is output to STDOUT. The extension will be changed automatically.
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba backup download 123 > foobar.jpa
	 *
	 *     wp akeeba backup download 123 --file=foobar.jpa
	 *
	 * @when  after_wp_load
	 *
	 * @param   array $args       Positional arguments (literal arguments)
	 * @param   array $assoc_args Associative arguments (--flag, --no-flag, --key=value)
	 *
	 * @return  void
	 *
	 * @throws  WP_CLI\ExitException
	 */
	public function download($args, $assoc_args)
	{
		// TODO Complain if we're under the --http connection method

		$id      = isset($args[0]) ? (int) $args[0] : 0;
		$part    = isset($args[1]) ? (int) $args[1] : 0;
		$outFile = isset($assoc_args['file']) ? $assoc_args['file'] : null;

		if ($id <= 0)
		{
			throw new WP_CLI\ExitException("The backup ID must be a positive integer.");
		}

		$model = new \Solo\Model\Manage();
		$model->setState('id', $id);

		$stat         = Platform::getInstance()->get_statistics($id);
		$allFileNames = Factory::getStatistics()->get_all_filenames($stat);

		if (empty($allFileNames))
		{
			WP_CLI::error("Backup record '$id' does not have any files available for download. Have you already deleted them?");
		}

		if (is_null($allFileNames))
		{
			WP_CLI::error("Backup record '$id' does not have any files available for download on the server. If they are stored remotely you may need to use the fetch command first.");
		}

		if (($part >= count($allFileNames)) || !isset($allFileNames[$part]))
		{
			WP_CLI::error("There is no part '$part' of backup record '$id'.");
		}

		$fileName = $allFileNames[$part];

		if (!@file_exists($fileName))
		{
			WP_CLI::error("Can not find part '$part' of backup record '$id' on the server.");
		}

		$basename  = @basename($fileName);
		$fileSize  = @filesize($fileName);
		$extension = strtolower(str_replace(".", "", strrchr($fileName, ".")));

		if (empty($outFile))
		{
			readfile($fileName);

			return;
		}

		if (is_dir($outFile))
		{
			$outFile = rtrim($outFile, '//\\') . DIRECTORY_SEPARATOR . $basename;
		}
		else
		{
			$dotPos = strrpos($outFile, '.');
			$outFile = ($dotPos === false) ? $outFile : (substr($outFile, 0, $dotPos) . '.' . $extension);
		}

		// Read in 1M chunks
		$blocksize = 1048576;
		$handle = @fopen($fileName, "r");

		if ($handle === false)
		{
			WP_CLI::error("Cannot open '$fileName' for reading. Check the permissions / ACLs of the file.");
		}

		$fp = @fopen($outFile, 'wb');

		if ($fp === false)
		{
			fclose($handle);
			WP_CLI::error("Cannot open '$outFile' for writing. Check whether the folder exists and the permissions / ACLs of both the enclosing folder and the file.");
		}

		while (!@feof($handle))
		{
			fwrite($fp, @fread($handle, $blocksize));
		}

		@fclose($handle);
		@fclose($fp);
	}

	private function getArg($argument, array $argList, $default = null)
	{
		return isset($argList[$argument]) ? $argList[$argument] : $default;
	}

	private function getFilters($args)
	{
		$filters = array();

		if ($this->getArg('description', $args))
		{
			$filters[] = array(
				'field'   => 'description',
				'operand' => 'LIKE',
				'value'   => $this->getArg('description', $args)
			);
		}

		if ($this->getArg('after', $args) && $this->getArg('before', $args))
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => 'BETWEEN',
				'value'   => $this->getArg('after', $args),
				'value2'  => $this->getArg('before', $args)
			);
		}
		elseif ($this->getArg('after', $args))
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => '>=',
				'value'   => $this->getArg('after', $args),
			);
		}
		elseif ($this->getArg('before', $args))
		{
			$filters[] = array(
				'field'   => 'backupstart',
				'operand' => '<=',
				'value'   => $this->getArg('before', $args),
			);
		}

		if ($this->getArg('origin', $args))
		{
			$filters[] = array(
				'field'   => 'origin',
				'operand' => '=',
				'value'   => $this->getArg('origin', $args)
			);
		}

		if ($this->getArg('profile', $args))
		{
			$filters[] = array(
				'field'   => 'profile_id',
				'operand' => '=',
				'value'   => (int) $this->getArg('profile', $args)
			);
		}

		$filters[] = array(
			'field'   => 'tag',
			'operand' => '<>',
			'value'   => 'restorepoint'
		);


		if (empty($filters))
		{
			$filters = null;
		}

		return $filters;
	}

	private function getOrdering($args)
	{
		$order = array(
			'by'    => $this->getArg('sort-by', $args),
			'order' => $this->getArg('sort-order', $args)
		);

		return $order;
	}
}
