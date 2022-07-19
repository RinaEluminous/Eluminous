<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

namespace Solo\Helper;

abstract class Format
{
	/**
	 * Format a size in bytes in a human readable format (e.g. 1.2Gb)
	 *
	 * @param   integer         $sizeInBytes     The size to convert, in bytes
	 * @param   integer         $decimals        Accuracy, in decimal points (default: 2)
	 * @param   boolean|string  $force_unit      Force a particular unit? Choose one of b, Kb, Mb, Gb, Tb or false for
	 *                                           automatic determination of the best unit.
	 * @param   string          $dec_char        Decimal separator character, default dot
	 * @param   string          $thousands_char  Thousands separator character, default none
	 *
	 * @return  string  The formatted number
	 */
	public static function fileSize($sizeInBytes, $decimals = 2, $force_unit = false, $dec_char = '.', $thousands_char = '')
	{
		if ($sizeInBytes <= 0)
		{
			return '-';
		}

		$units = array('b', 'KB', 'MB', 'GB', 'TB', 'PB');

		if ($force_unit === false)
		{
			$unit = floor(log($sizeInBytes, 2) / 10);
		}
		else
		{
			$unit = $force_unit;
		}
		if ($unit == 0)
		{
			$decimals = 0;
		}

		return number_format($sizeInBytes / pow(1024, $unit), $decimals, $dec_char, $thousands_char) . ' ' . $units[$unit];
	}
} 
