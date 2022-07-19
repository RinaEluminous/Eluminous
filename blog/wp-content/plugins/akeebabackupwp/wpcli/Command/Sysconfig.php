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
 * View or change the plugin-wide configuration options for Akeeba Backup.
 *
 * @package     Akeeba\WPCLI\Command
 *
 * @since       3.0.0
 */
class Sysconfig
{
	private $defaultOptions = [
		'useencryption'                    => 1,
		'timezone'                         => '',
		'localtime'                        => 1,
		'timezonetext'                     => 'T',
		'forced_backup_timezone'           => 'AKEEBA/DEFAULT',
		'dateformat'                       => '',
		'stats_enabled'                    => 1,
		'fs.driver'                        => 'file',
		'fs.host'                          => '',
		'fs.port'                          => '',
		'fs.username'                      => '',
		'fs.password'                      => '',
		'fs.directory'                     => '',
		'options.failure_timeout'          => 180,
		'options.failure_email_address'    => '',
		'options.failure_email_subject'    => '',
		'options.failure_email_body'       => '',
		'mail.online'                      => 1,
		'mail.mailer'                      => 'mail',
		'mail.mailfrom'                    => '',
		'mail.fromname'                    => '',
		'mail.smtpauth'                    => 1,
		'mail.smtpsecure'                  => 0,
		'mail.smtpport'                    => 25,
		'mail.smtpuser'                    => '',
		'mail.smtppass'                    => '',
		'mail.smtphost'                    => 'localhost',
		'options.frontend_enable'          => 1,
		'options.frontend_secret_word'     => '', // THIS IS ALWAYS STORED ENCRYPTED
		'options.frontend_email_on_finish' => 1,
		'options.frontend_email_address'   => '',
		'options.frontend_email_subject'   => '',
		'options.frontend_email_body'      => '',
		'options.desktop_notifications'    => 0,
		'options.push_preference'          => 0,
		'options.push_apikey'              => '',
	];


	/**
	 * Lists the system (global) configuration options for Akeeba Backup
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
	 *     wp akeeba sysconfig list
	 *
	 *     wp akeeba sysconfig list --format=json
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
		$platform  = Platform::getInstance();
		$config    = $container->appConfig;

		$output = [];

		foreach ($this->defaultOptions as $key => $default)
		{
			switch ($key)
			{
				case 'options.frontend_secret_word':
					$value = $platform->get_platform_configuration_option(substr($key, 8), '');
					break;

				default:
					$value = $config->get($key, $default);
					break;
			}

			$output[] = [
				'key'   => $key,
				'value' => $value,
			];
		}

		$format = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';
		CliUtils\format_items($format, $output, ['key', 'value']);

	}

	/**
	 * Gets the value of a system (global) configuration option for Akeeba Backup
	 *
	 * ## OPTIONS
	 *
	 * <key>
	 * : The option key to retrieve
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
	 *     wp akeeba sysconfig get options.frontend_enable
	 *
	 *     wp akeeba sysconfig get options.frontend_enable --format=var_export
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

		if (!array_key_exists($key, $this->defaultOptions))
		{
			WP_CLI::error("Unknown option '$key'.");
		}

		/** @var  Application $akeebaBackupApplication */
		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		$platform  = Platform::getInstance();
		$config    = $container->appConfig;

		switch ($key)
		{
			case 'options.frontend_secret_word':
				$value = $platform->get_platform_configuration_option(substr($key, 8), '');
				break;

			default:
				$value = $config->get($key, $this->defaultOptions[$key]);
				break;
		}

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
	 * Sets the value of a system (global) configuration option for Akeeba Backup
	 *
	 * ## OPTIONS
	 *
	 * <key>
	 * : The option key to set
	 *
	 * <value>
	 * : The value to set
	 *
	 * ## EXAMPLES
	 *
	 *     wp akeeba sysconfig set options.frontend_enable 1
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

		if (!array_key_exists($key, $this->defaultOptions))
		{
			WP_CLI::error("Unknown option '$key'.");
		}

		global $akeebaBackupApplication;
		$container = $akeebaBackupApplication->getContainer();
		$config    = $container->appConfig;

		$config->set($key, $value);

		try
		{
			$config->saveConfiguration();
		}
		catch (\RuntimeException $e)
		{
			WP_CLI::error("Could not set option '$key'.");
		}

		WP_CLI::success("Successfully set option '$key' to '$value'");
	}
}
