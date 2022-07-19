<?php
/**
 * @package		akeebabackupwp
 * @copyright	2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Akeeba\Engine\Platform;
use Awf\Mvc\Model;
use Solo\Exception\Update\ConnectionError;
use Solo\Exception\Update\PlatformError;

/**
 * This class will take care of bridging WordPress update system and Akeeba Backup package, fetching the info from the
 * plugin and passing back to WordPress.
 */
abstract class AkeebaBackupWPUpdater
{
	/** @var bool Do I need the Download ID? */
	protected static $needsDownloadID = false;

	/** @var bool Did I have a connection error while */
	protected static $connectionError = false;

	/** @var bool Do I have a platform error? (Wrong PHP or WP version) */
	protected static $platformError = false;

	/** @var string	Stores the download link. In this way we can run our logic only on our download links */
	protected static $downloadLink;

	/** @var bool	Am I in an ancient version of WordPress, were the integrated system is not usable? */
	protected static $cantUseWpUpdate = false;

	/**
	 * Fetches update info and reports them to WordPress
	 *
	 * @param	\stdClass	$transient
	 *
	 * @return	\stdClass
	 */
	public static function getupdates($transient)
	{
		global $wp_version;

		// On WordPress < 4.3 we can't use the integrated update system since the hook we're using to tweak
		// the installation is not available (upgrader_package_options).
		// Let's warn the user and tell him to use our own update system
		if (version_compare($wp_version, '4.3', 'lt'))
		{
			static::$cantUseWpUpdate = true;

			return $transient;
		}

		// Do I have to notify the user that he needs to put the
		if (static::needsDownloadID())
		{
			static::$needsDownloadID = true;
		}

		$updateInfo = false;

		try
		{
			$updateInfo = static::getUpdateInfo();
		}
		catch (ConnectionError $e)
		{
			// mhm... an error occurred while connecting to the updates server. Let's notify the user
			static::$connectionError = true;
		}
		catch (PlatformError $e)
		{
			static::$platformError = true;
		}

		if (!$updateInfo)
		{
			return $transient;
		}

		if (!isset($transient->response))
		{
			$transient->response = array();
		}

		$obj              = new stdClass();
		$obj->slug        = 'akeebabackupwp';
		$obj->plugin      = 'akeebabackupwp/akeebabackupwp.php';
		$obj->new_version = $updateInfo->get('version');
		$obj->url         = $updateInfo->get('infourl');
		$obj->package     = $updateInfo->get('link');

		$transient->response['akeebabackupwp/akeebabackupwp.php'] = $obj;

		// Since the event we're hooking to is a global one (triggered for every plugin) we have to store a reference
		// of our download link. In this way we can apply our logic only on our stuff and don't interfere with other people
		static::$downloadLink = $updateInfo->get('link');

		return $transient;
	}

	public static function checkinfo($false, $action, $arg)
	{
		if (!isset($arg->slug))
		{
			return false;
		}

		if ($arg->slug !== 'akeebabackupwp')
		{
			return false;
		}

		$updateInfo = static::getUpdateInfo();

		// This should never occur, since if we get here, it means that we already have an update flagged
		if (!$updateInfo)
		{
			return false;
		}

		$information = array(
			// We leave the "name" index empty, so WordPress won't display the ugly title on top of our banner
			'name' 			=> '',
			'slug' 			=> 'akeebabackupwp',
			'author' 		=> 'Akeeba Ltd.',
			'homepage' 		=> 'https://www.akeebabackup.com',
			'last_updated' 	=> $updateInfo->get('date'),
			'version' 		=> $updateInfo->get('version'),
			'download_link' => $updateInfo->get('link'),
			'requires' 		=> '3.1',
			'tested' 		=> get_bloginfo( 'version' ),
			'sections' 		=> array(
				// 'description' => 'Something description',
				'release_notes' => $updateInfo->get('releasenotes')
			),
			'banners' => array(
				'low' => plugins_url().'/akeebabackupwp/app/media/image/wordpressupdate_banner.jpg',
				'high'  => false
			)
		);

		return (object) $information;
	}

	/**
	 * @param	bool		$bailout
	 * @param 	string		$package
	 * @param 	WP_Upgrader	$upgrader
	 *
	 * @return WP_Error|false	An error if anything goes wrong or is missing, either case FALSE to keep the update process going
	 */
	public static function addDownloadID($bailout, $package, $upgrader)
	{
		// Process only our download links
		if ($package != static::$downloadLink)
		{
			return false;
		}

		// Do we need the Download ID (ie Pro version)?
		if (static::needsDownloadID())
		{
			return new WP_Error(403, 'Please insert your Download ID inside Akeeba Backup to fetch the updates for the Pro version');
		}

		// Our updater automatically sets the Download ID in the link, so there's no need to change anything inside the URL
		return false;
	}

	/**
	 * Helper function to change some update options on the fly. By default WordPress will delete the entire folder
	 * and abort if the folder already exists; by tweaking the options we can force WordPress to extract on top of the
	 * existing folder without deleting it first.
	 *
	 * @param	array	$options	Options to be used while upgrading our plugin
	 *
	 * @return	array	Updated options
	 */
	public static function packageOptions($options)
	{
		if (isset($options['hook_extra']) && isset($options['hook_extra']['plugin']))
		{
			// If this is our package, let's tell WordPress to extract on top of the existing folder,
			// without deleting anything
			if (stripos($options['hook_extra']['plugin'], 'akeebabackupwp.php') !== false)
			{
				$options['clear_destination'] 			= false;
				$options['abort_if_destination_exists'] = false;
			}
		}

		return $options;
	}

	/**
	 * Helper function to display some custom text AFTER the row regarding our update.
	 * Usually is used to warn the user that something bad happened while trying to fetch new updates
	 *
	 * @param $plugin_file
	 * @param $plugin_data
	 * @param $status
	 */
	public static function updateMessage($plugin_file, $plugin_data, $status)
	{
		$html 	  = '';
		$warnings = array();

		if (static::$platformError)
		{
			$warnings[] = <<<HTML
<p id="akeebabackupwp-error-update-platform-mismatch">
	There is a new version available, but it requires a newer version of PHP or WordPress than the one you have. As a result it will not be installed.
</p>
HTML;
		}

		if (static::$needsDownloadID)
		{
			$warnings[] = <<<HTML
<p id="akeebabackupwp-error-update-nodownloadid">
	You have to supply your Download ID indside Akeeba Backup for WordPress System Configuration before trying to upgrade to the latest release.
</p>
HTML;
		}

		if (static::$connectionError)
		{
			$updateUrl = 'admin.php?page=akeebabackupwp/akeebabackupwp.php&view=update&force=1';

			$warnings[] = <<<HTML
<p id="akeebabackupwp-error-update-noconnection">
	An error occurred while trying to connect Akeeba Backup for WordPress update server. Please try again later
	or <a href="$updateUrl">manually check for updates</a>.
</p>
HTML;
		}

		if (static::$cantUseWpUpdate)
		{
			$updateUrl = 'admin.php?page=akeebabackupwp/akeebabackupwp.php&view=update&force=1';

			$warnings[] = <<<HTML
<p id="akeebabackupwp-error-update-noconnection">
	In WordPress versions previous to 4.3 you can't use the integrated update system. 
	Please use  <a href="$updateUrl">our update system</a> to install the latest version of Akeeba Backup for WordPress.
</p>
HTML;
		}

		if ($warnings)
		{
			$warnings = implode('', $warnings);

			$html = <<<HTML
<tr class="">
	<th></th>
	<td></td>
	<td>
		<div style="border: 1px solid #F0AD4E;border-radius: 3px;background: #fdf5e9;padding:10px">
			<strong>Warning!</strong><br/>
			$warnings		
		</div>
	</td>
</tr>
HTML;
		}

		if ($html)
		{
			echo $html;
		}
	}

	/**
	 * Fetches the info from the remote server
	 *
	 * @return \Awf\Registry\Registry|bool
	 */
	private static function getUpdateInfo()
	{
		static $updates;

		// If I already have some update info, simply return them
		if ($updates)
		{
			return $updates;
		}

		$container = static::loadAkeebaBackup();

		if (!$container)
		{
			return false;
		}

		/** @var \Solo\Model\Update $updateModel */
		$updateModel = Model::getInstance($container->application_name, 'Update', $container);
		$updateModel->load(true);

		// No updates? Let's stop here
		if (!$updateModel->hasUpdate())
		{
			// Ok, we didn't have an update, but maybe there's another reason for it
			$updateInfo = $updateModel->getUpdateInformation();

			// Did we get a connection error?
			if ($updateInfo->get('loadedUpdate') == false)
			{
				throw new ConnectionError();
			}

			// mhm... maybe we're on a old WordPress version?
			if (!$updateInfo->get('platformMatch', 0))
			{
				throw new PlatformError();
			}

			return false;
		}

		$updates = $updateModel->getUpdateInformation();

		return $updates;
	}

	/**
	 * Includes all the required pieces to load Akeeba Backup from within a standard WordPress page
	 *
	 * @return \Solo\Container|false
	 */
	private static function loadAkeebaBackup()
	{
		static $localContainer;

		// Do not run the whole logic if we already have a valid Container
		if ($localContainer)
		{
			return $localContainer;
		}

		if (!defined('AKEEBASOLO'))
		{
			define('AKEEBASOLO', 1);
		}

		require_once __DIR__.'/../app/version.php';

		// Include the autoloader
		if (!include_once __DIR__ . '/../app/Awf/Autoloader/Autoloader.php')
		{
			return false;
		}

		if (!file_exists(__DIR__ . '/../helpers/integration.php'))
		{
			return false;
		}

		/** @var \Solo\Container $container */
		require_once __DIR__ . '/../helpers/integration.php';

		// Ok, really don't know why but this function gets called TWICE. It seems to completely ignore the first result
		// (even if we report that there's an update) and calls it again. This means that the require_once above will be ignored.
		// I can't simply return the current $transient because it doesn't contain the updated info.
		// So I'll save a previous copy of the container and then use it later.
		if (!$localContainer)
		{
			$localContainer = $container;
		}

		if (!$localContainer)
		{
			return false;
		}

		// Get all info saved inside the configuration
		$container->appConfig->loadConfiguration();
		$container->basePath = WP_PLUGIN_DIR.'/akeebabackupwp/app/Solo';

		return $localContainer;
	}

	private static function needsDownloadID()
	{
		$container = static::loadAkeebaBackup();

		// With the core version we're always good to go
		if (!AKEEBABACKUP_PRO)
		{
			return false;
		}

		// Do we need the Download ID (ie Pro version)?
		$dlid = $container->appConfig->get('options.update_dlid');

		if (!preg_match('/^([0-9]{1,}:)?[0-9a-f]{32}$/i', $dlid))
		{
			return true;
		}

		return false;
	}
}
