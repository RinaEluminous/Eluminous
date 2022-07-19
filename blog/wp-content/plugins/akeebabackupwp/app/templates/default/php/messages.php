<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Document\Document;

/** @var Document $this */

foreach (array(
	'error'		=> 'failure',
	'warning'	=> 'warning',
	'success'	=> 'success',
	'info'		=> 'info',
	) as $type => $class):
	$messages = $this->getContainer()->application->getMessageQueueFor($type);

	if (!empty($messages)):
		$class = "alert-$class";
?>
<div id="akeeba-backup-message-<?php echo $type ?>" class="akeeba-backup-message akeeba-block--<?php echo $class ?> small">
<?php foreach($messages as $message):?>
	<p><?php echo $message ?></p>
<?php endforeach; ?>
</div>
<?php
	endif;
endforeach;
$this->getContainer()->application->clearMessageQueue();
