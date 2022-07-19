<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

namespace Solo\Model\Exception;

use RuntimeException;

// Protect from unauthorized access
defined('_JEXEC') or die();

class TransferIgnorableError extends RuntimeException
{

}
