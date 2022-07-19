<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

// Protect from unauthorized access

/** @var  $this  Solo\View\Transfer\Html */

echo $this->loadAnyTemplate('Common/ftp_browser');
echo $this->loadAnyTemplate('Common/sftp_browser');
echo $this->loadAnyTemplate('Common/ftp_test');

?>

