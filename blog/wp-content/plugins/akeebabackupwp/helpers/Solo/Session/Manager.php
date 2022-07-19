<?php
/**
 * @package     Solo
 * @copyright   2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

namespace Solo\Session;

use Awf\Session\CsrfToken;
use Awf\Session\CsrfTokenFactory;
use Awf\Session\Randval;
use Awf\Session\SegmentInterface;
use Awf\Utils\Phpfunc;

class Manager extends \Awf\Session\Manager
{
	/**
	 * A session segment factory.
	 *
	 * @var SegmentFactory
	 */
	protected $segment_factory;

	/**
	 * The CSRF token for this session.
	 *
	 * @var CsrfToken
	 */
	protected $csrf_token;

	/**
	 * A CSRF token factory, for lazy-creating the CSRF token.
	 *
	 * @var CsrfTokenFactory
	 */
	protected $csrf_token_factory;

	/**
	 * Session cookie parameters. Ignored in this implementation.
	 *
	 * @var   array
	 */
	protected $cookie_params = array();

	/**
	 * Session segments
	 *
	 * @var  Segment[]
	 */
	protected $segments = array();

	/**
	 * Session name. Used as a prefix of the user meta values.
	 *
	 * @var  string
	 */
	private $sessionName = 'AkeebaSession';

	/**
	 * Session ID. This is set to a random string every time we "start a session" (load stuff from the database).
	 *
	 * @var string
	 */
	private $sessionId = '';

	public function __construct(SegmentFactory $segment_factory, CsrfTokenFactory $csrf_token_factory
	)
	{
		$this->segment_factory = $segment_factory;
		$this->csrf_token_factory = $csrf_token_factory;
	}

	/**
	 * Gets a new session segment instance by name. Segments with the same name will be different objects but will
	 * reference the same registry values, so it is possible to have two or more objects that share state.
	 *
	 * @param   string  $name  The name of the session segment
	 *
	 * @return  Segment
	 */
	public function newSegment($name)
	{
		if (!isset($this->segments[$name]))
		{
			$this->segments[$name] = $this->segment_factory->newInstance($this, $name);
		}

		return $this->segments[$name];
	}

	/**
	 * Tells us if a session is available to be reactivated. It won't tell you if it has started yet.
	 *
	 * @return bool
	 */
	public function isAvailable()
	{
		// Checks if the <session name>_id user meta key exists in WP's database
		$metaKey    = $this->getName() . '_id';
		$userId     = get_current_user_id();

		// If the user meta key doesn't exist WP will return an empty string...
		$id = get_user_meta($userId, $metaKey, true);

		// ...which means we are available UNLESS $id is an empty string
		return $id !== '';
	}

	/**
	 * Tells us if a session has started.
	 *
	 * @return  bool
	 */
	public function isStarted()
	{
		return $this->getStatus() == PHP_SESSION_ACTIVE;
	}

	/**
	 * Starts a new session, or resumes an existing one.
	 *
	 * @return bool
	 */
	public function start()
	{
		if (!$this->isStarted())
		{
			// Create a random ID
			$this->regenerateId();

			// Save the random ID to the database
			$metaKey    = $this->getName() . '_id';
			$userId     = get_current_user_id();

			update_user_meta($userId, $metaKey, $this->getId());
		}
	}

	/**
	 * Clears all session variables across all segments. This is implemented by removing all WordPress user meta for
	 * the current user. Note that this does NOT close the session, it simply nukes its data.
	 *
	 * @return  void
	 */
	public function clear()
	{
		$this->clearUserMeta();
	}

	/**
	 * Writes session data from all segments and ends the session.
	 *
	 * @return  void
	 */
	public function commit()
	{
		if (count($this->segments))
		{
			/** @var SegmentInterface $segment */
			foreach ($this->segments as $segment)
			{
				$segment->save();
			}
		}

		// Close the session (remove the user meta with the session ID)
		$userId = get_current_user_id();
		delete_user_meta($userId, $this->getName() . '_id');

		// Clear the ID, marking the session as closed
		$this->sessionId = '';
	}

	/**
	 * Destroys the session entirely.
	 *
	 * @return bool
	 */
	public function destroy()
	{
		$this->clearUserMeta(true);

		// Clear the ID, marking the session as closed
		$this->sessionId = '';

		return true;
	}

	/**
	 * Returns the CSRF token, creating it if needed (and thereby starting a session).
	 *
	 * @return  CsrfToken
	 *
	 */
	public function getCsrfToken()
	{
		if (!$this->csrf_token)
		{
			$this->csrf_token = $this->csrf_token_factory->newInstance($this);
		}

		return $this->csrf_token;
	}

	/**
	 * Sets the session cache expire time. Completely ignored in this implementation.
	 *
	 * @param   int  $expire  The expiration time in seconds.
	 *
	 * @return  int
	 */
	public function setCacheExpire($expire)
	{
		return $this->getCacheExpire();
	}

	/**
	 * Gets the session cache expire time. Faked in this implementation to return PHP's default of 180 seconds.
	 *
	 * @return  int  The cache expiration time in seconds.
	 */
	public function getCacheExpire()
	{
		return 180;
	}

	/**
	 * Sets the session cache limiter value. Ignored in this implementation (we always emulate nocache).
	 *
	 * @param   string  $limiter  The limiter value.
	 *
	 * @return  string
	 */
	public function setCacheLimiter($limiter)
	{
		return $this->getCacheLimiter();
	}

	/**
	 * Gets the session cache limiter value.
	 *
	 * @return  string  The limiter value.
	 */
	public function getCacheLimiter()
	{
		return <<< END_HEADERS
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache

END_HEADERS;

	}

	/**
	 * Sets the session cookie params.
	 *
	 * Cookies are completely ignored in this implementation
	 *
	 * @param   array  $params  The array of session cookie param keys and values.
	 *
	 * @return  void
	 */
	public function setCookieParams(array $params)
	{
		$this->cookie_params = array_merge($this->cookie_params, $params);
	}

	/**
	 * Gets the current session id.
	 *
	 * @return  string
	 */
	public function getId()
	{
		return $this->sessionId;
	}

	/**
	 * Regenerates and replaces the current session id; also regenerates the CSRF token value if one exists.
	 *
	 * @return  bool  True is regeneration worked, false if not.
	 *
	 */
	public function regenerateId()
	{
		$phpfunc         = new Phpfunc();
		$randval         = new Randval($phpfunc);
		$this->sessionId = md5($randval->generate());

		if ($this->csrf_token)
		{
			$this->csrf_token->regenerateValue();
		}

		return true;
	}

	/**
	 * Sets the current session name.
	 *
	 * @param   string  $name  The session name to use.
	 *
	 * @return  string
	 */
	public function setName($name)
	{
		$oldName           = $this->sessionName;
		$this->sessionName = $name;

		return $oldName;
	}

	/**
	 * Returns the current session name.
	 *
	 * @return  string
	 */
	public function getName()
	{
		return $this->sessionName;
	}

	/**
	 * Sets the session save path. Not supported by this implementation.
	 *
	 * @param   string  $path  The new save path.
	 *
	 * @return  string
	 */
	public function setSavePath($path)
	{
		return $this->getSavePath();
	}

	/**
	 * Gets the session save path. Not supported by this implementation
	 *
	 * @return  string
	 *
	 */
	public function getSavePath()
	{
		return null;
	}

	/**
	 * Returns the current session status:
	 *
	 * - `PHP_SESSION_DISABLED` if sessions are disabled.
	 * - `PHP_SESSION_NONE` if sessions are enabled, but none exists.
	 * - `PHP_SESSION_ACTIVE` if sessions are enabled, and one exists.
	 *
	 * @return  int
	 *
	 */
	public function getStatus()
	{
		$sid = $this->getId();

		if (empty($sid))
		{
			return PHP_SESSION_NONE;
		}
		else
		{
			return PHP_SESSION_ACTIVE;
		}
	}

	/**
	 * Clear the user meta which hold the session data
	 *
	 * @param   $clearId  bool  Should I also clear the session ID (close the session)?
	 *
	 * @return  void
	 */
	private function clearUserMeta($clearId = false)
	{
		$this->segments = array();

		$userId         = get_current_user_id();
		$allMeta        = get_user_meta($userId);
		$sessionName    = $this->getName();
		$idKey          = $sessionName . '_id';

		foreach ($allMeta as $key => $value)
		{
			if (($key == $idKey) && !$clearId)
			{
				continue;
			}

			if (strpos($key, $sessionName . '_') === 0)
			{
				delete_user_meta($userId, $key);
			}
		}
	}
}
