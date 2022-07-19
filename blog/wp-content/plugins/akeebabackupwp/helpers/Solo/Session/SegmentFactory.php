<?php
/**
 * @package     Solo
 * @copyright   2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

namespace Solo\Session;

class SegmentFactory
{
	/**
	 *
	 * Creates a session segment object.
	 *
	 * @param Manager $manager
	 * @param string  $name
	 *
	 * @return Segment
	 */
	public function newInstance(Manager $manager, $name)
	{
		return new Segment($manager, $name);
	}
}
