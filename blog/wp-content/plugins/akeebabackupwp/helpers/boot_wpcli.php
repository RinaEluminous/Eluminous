<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

// Bootstrap file for Akeeba Solo for WordPress

defined('AKEEBASOLO') or define('AKEEBASOLO', 1);

require_once 'integration.php';

// Set up autoloader for our WP-CLI commands
Awf\Autoloader\Autoloader::getInstance()->addMap('Akeeba\\WPCLI\\', [
	__DIR__ . '/../wpcli',
]);

global $akeebaBackupApplication;

try
{
	// Create the application
	$akeebaBackupApplication = $container->application;

	/**
	 * Initialise the application.
	 *
	 * Yes, this is also required under WP-CLI. The AWF Models need to connect to the WordPress database. This is done
	 * by magically creating a database connector with the same db connection parameters as WP itself. That's
	 * implemented through a custom application configuration object which is created during the application
	 * intialization.
	 */
	$akeebaBackupApplication->initialise();
}
catch (Exception $exc)
{
	WP_CLI::error("Cannot initialize Akeeba Backup WP-CLI commands. Error: " . $e->getMessage());
}
