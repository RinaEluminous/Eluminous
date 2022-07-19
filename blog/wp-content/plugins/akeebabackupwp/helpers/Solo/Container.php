<?php
/**
 * @package     Solo
 * @copyright   2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

namespace Solo;

use Awf\Session\CsrfTokenFactory;
use Awf\Session\Randval;
use Awf\Utils\Phpfunc;
use Solo\Session\Manager;
use Solo\Session\SegmentFactory;

/**
 * Dependency injection container for Solo
 *
 * @property-read  string  $iconBaseName  The base name for logo icon files
 */
class Container extends \Awf\Container\Container
{
	public function __construct(array $values = array())
	{
		$this->iconBaseName = 'abwp';

		// Set the application name (must be Solo, used in the PHP namespaces)
		if (!isset($values['application_name']))
		{
			$values['application_name'] = 'Solo';
		}

		// Set up a segment name unique to this installation
		if (!isset($values['session_segment_name']))
		{
			$installationId = 'default';

			if (function_exists('base64_encode'))
			{
				$installationId = base64_encode(__DIR__);
			}

			if (function_exists('md5'))
			{
				$installationId = md5(__DIR__);
			}

			if (function_exists('sha1'))
			{
				$installationId = sha1(__DIR__);
			}

			$values['session_segment_name'] = $values['application_name'] . '_' . $installationId;
		}

		/**
		 * Provide our custom session manager emulation service inside WordPress. Outside WordPress we have to use the
		 * regular AWF session manager, otherwise the CLI script fails (since it runs outside of WordPress).
		 */
		if (defined('WPINC'))
		{
			$this['session'] = function ()
			{
				return new Manager(
					new SegmentFactory(),
					new CsrfTokenFactory(
						new Randval(
							new Phpfunc()
						)
					)
				);
			};
		}

		// Application Session Segment service
		$this['segment'] = function (Container $c)
		{
			return $c->session->newSegment($c->session_segment_name);
		};

		parent::__construct($values);
	}
}
