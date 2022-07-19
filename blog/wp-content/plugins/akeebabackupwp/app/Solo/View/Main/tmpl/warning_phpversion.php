<?php
/**
 * @package     Solo
 * @copyright   Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

// Obsolete PHP version check
if (!version_compare(PHP_VERSION, '5.6.0', 'lt'))
{
	return;
}

$akeebaCommonDatePHP          = new \Awf\Date\Date('2016-07-21 00:00:00', 'GMT');
$akeebaCommonDateObsolescence = new \Awf\Date\Date('2017-04-21 00:00:00', 'GMT');
?>
<div id="phpVersionCheck" class="akeeba-block--warning">
    <h3><?php echo Text::_('COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_TITLE'); ?></h3>
    <p>
		<?php echo Text::sprintf(
			'COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_BODY',
			PHP_VERSION,
			$akeebaCommonDatePHP->format(Text::_('DATE_FORMAT_LC1')),
			$akeebaCommonDateObsolescence->format(Text::_('DATE_FORMAT_LC1')),
			'7.0'
		);
		?>
    </p>
</div>
