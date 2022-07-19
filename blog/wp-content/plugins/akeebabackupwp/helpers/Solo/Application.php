<?php
/**
 * @package     akeebabackupwp
 * @copyright   2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

namespace Solo;

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Awf\Text\Text;
use Awf\Uri\Uri;
use Solo\Helper\SecretWord;

class Application extends \Awf\Application\Application
{
	const secretKeyRelativePath = '/engine/secretkey.php';

	public function initialise()
	{
		// Let AWF know that the prefix for our system JavaScript is 'akeeba.System.'
		\Awf\Html\Grid::$javascriptPrefix = 'akeeba.System.';

		// This line must appear before the user manager initializes, or it won't find the users table!
		$this->container->appConfig->set('user_table', '#__ak_users');

		// Put a small marker to indicate that we run inside another CMS
		$isCMS = $this->setIsCMSFlag();

		// Get the target platform information for updates
		$this->setupUpdatePlatform();

		// If the PHP session save path is not writeable we will use the 'session' subdirectory inside our tmp directory
		$this->discoverSessionSavePath();

		// Set up the template (theme) to use
		if ($isCMS)
		{
			$this->setTemplate('wp');
		}

        // Load language files
		$this->loadLanguages();

		// Load the configuration file if it's present
		$this->container->appConfig->loadConfiguration();

		// Apply cookie parameters.
		$this->applyCookieParameters();

		// Load Akeeba Engine's settings encryption preferences
		$this->loadEngineEncryptionKey();

		// Enforce encryption of the front-end Secret Word
		SecretWord::enforceEncryption('frontend_secret_word');

		// Load Akeeba Engine's configuration
		$this->loadBackupProfile();

		// Attach the user privileges to the user manager
		$manager = $this->container->userManager;

		$this->attachPrivileges($manager);

		// Set up the media query key
		$this->setupMediaVersioning();
	}

	/**
	 * Language file processing callback. It converts _QQ_ to " and replaces the product name in the legacy INI files
	 * imported from Akeeba Backup for Joomla!.
	 *
	 * @param   string  $filename  The full path to the file being loaded
	 * @param   array   $strings   The key/value array of the translations
	 *
	 * @return  boolean|array  False to prevent loading the file, or array of processed language string, or true to
	 *                         ignore this processing callback.
	 */
	public function processLanguageIniFile($filename, $strings)
	{
		foreach ($strings as $k => $v)
		{
			$v = str_replace('_QQ_', '"', $v);
			$v = str_replace('Akeeba Solo', 'Akeeba Backup', $v);
			$v = str_replace('Akeeba Backup', 'Akeeba Backup for WordPress', $v);
			$v = str_replace('Joomla!', 'WordPress', $v);
			$v = str_replace('Joomla', 'WordPress', $v);
			$strings[$k] = $v;
		}

		return $strings;
	}

	/**
	 * Creates or updates the custom session save path
	 *
	 * @param   string   $path    The custom session save path
	 * @param   boolean  $silent  Should I suppress all errors?
	 *
	 * @return  void
	 *
	 * @throws \Exception  If $silent is set to false
	 */
	public function createOrUpdateSessionPath($path, $silent = true)
	{
		try
		{
			$fs = $this->container->fileSystem;
			$protectFolder = false;

			if (!@is_dir($path))
			{
				$fs->mkdir($path, 0777);
			}
			elseif (!is_writeable($path))
			{
				$fs->chmod($path, 0777);
				$protectFolder = true;
			}
			else
			{
				if (!@file_exists($path . '/.htaccess'))
				{
					$protectFolder = true;
				}

				if (!@file_exists($path . '/web.config'))
				{
					$protectFolder = true;
				}
			}

			if ($protectFolder)
			{
				$fs->copy($this->container->basePath . '/.htaccess', $path . '/.htaccess');
				$fs->copy($this->container->basePath . '/web.config', $path . '/web.config');

				$fs->chmod($path . '/.htaccess', 0644);
				$fs->chmod($path . '/web.config', 0644);
			}
		}
		catch (\Exception $e)
		{
			if (!$silent)
			{
				throw $e;
			}
		}
	}

	/**
	 * @return bool
	 */
	private function setIsCMSFlag()
	{
		$isCMS = defined('WPINC');
		$this->container->segment->set('insideCMS', $isCMS);

		return $isCMS;
	}

	/**
	 * @return void
	 * @throws \Exception
	 */
	private function discoverSessionSavePath()
	{
		$sessionPath = $this->container->session->getSavePath();

		if (!@is_dir($sessionPath) || !@is_writable($sessionPath))
		{
			$sessionPath = APATH_BASE . '/tmp/session';
			$this->createOrUpdateSessionPath($sessionPath);
			$this->container->session->setSavePath($sessionPath);
		}
	}

	/**
	 * @return void
	 */
	private function setupUpdatePlatform()
	{
		$platformVersion = function_exists('get_bloginfo') ? get_bloginfo('version') : '0.0';
		$this->container->segment->set('platformNameForUpdates', 'wordpress');
		$this->container->segment->set('platformVersionForUpdates', $platformVersion);
	}

	/**
	 * @return void
	 */
	private function loadLanguages()
	{
// Manually load Solo text files, since we changed them in "com_akeebabackup"
		Text::loadLanguage(null, 'akeebabackup', '.com_akeebabackup.ini', false, $this->container->languagePath);
		Text::loadLanguage('en-GB', 'akeebabackup', '.com_akeebabackup.ini', false, $this->container->languagePath);

		// Load the extra language files
		Text::loadLanguage(null, 'akeeba', '.com_akeeba.ini', false, $this->container->languagePath);
		Text::loadLanguage('en-GB', 'akeeba', '.com_akeeba.ini', false, $this->container->languagePath);
	}

	/**
	 * @return void
	 */
	private function applyCookieParameters()
	{
// Apply cookie parameters. This fixes badly configured servers setting the Secure flag on HTTP sites.
		// This block must be AFTER the appConfig->loadConfiguration() call since we need to set the URIs from
		// the AKEEBA_SOLO_WP_SITEURL and AKEEBA_SOLO_WP_URL constants, set from WordPress functions during bootstrap.
		// See: Solo\Application::applySessionTimeout()
		$sessionTimeout = (int) $this->container->appConfig->get('session_timeout', 1440);
		$uri            = new Uri(Uri::base(false, $this->container), $this);
		$this->container->session->setCookieParams(array(
			'lifetime' => $sessionTimeout * 60,
			'path'     => $uri->getPath(),
			'domain'   => $uri->getHost(),
			'secure'   => $uri->getScheme() == 'https',
			'httponly' => true,
		));
	}

	/**
	 * @return void
	 */
	private function loadEngineEncryptionKey()
	{
		$secretKeyFile = $this->container->basePath . static::secretKeyRelativePath;

		if (@file_exists($secretKeyFile))
		{
			require_once $secretKeyFile;
		}

		Factory::getSecureSettings()->setKeyFilename('secretkey.php');
	}

	/**
	 * @return void
	 */
	private function loadBackupProfile()
	{
		try
		{
			Platform::getInstance()->load_configuration();
		}
		catch (\Exception $e)
		{
			// Ignore database exceptions, they simply mean we need to install or update the database
		}
	}

	/**
	 * @param $manager
	 *
	 * @return void
	 */
	private function attachPrivileges($manager)
	{
		$manager->registerPrivilegePlugin('akeeba', '\\Solo\\Application\\WordpressUserPrivileges');
	}

	/**
	 * @return void
	 */
	private function setupMediaVersioning()
	{
		$this->getContainer()->mediaQueryKey = md5(microtime(false));
		$isDebug                             = !defined('AKEEBADEBUG');
		$hasVersion                          = defined('AKEEBABACKUP_VERSION') && defined('AKEEBABACKUP_DATE');
		$isDevelopment                       = $hasVersion ? ((strpos(AKEEBABACKUP_VERSION, 'svn') !== false) || (strpos(AKEEBABACKUP_VERSION, 'dev') !== false) || (strpos(AKEEBABACKUP_VERSION, 'rev') !== false)) : true;

		if (!$isDebug && !$isDevelopment && $hasVersion)
		{
			$this->getContainer()->mediaQueryKey = md5(AKEEBABACKUP_VERSION . AKEEBABACKUP_DATE);
		}
	}
}
