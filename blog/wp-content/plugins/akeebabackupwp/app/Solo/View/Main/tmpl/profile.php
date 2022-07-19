<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Html;
use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

$router   = $this->container->router;
$inCMS    = $this->container->segment->get('insideCMS', false);
$isJoomla = defined('_JEXEC');
$token    = $this->container->session->getCsrfToken()->getValue();

?>

<div class="akeeba-panel--info">
	<form action="<?php echo $router->route('index.php?view=main') ?>" method="post" name="profileForm" class="akeeba-form--inline">
		<div class="akeeba-form-group">
			<label>
				<?php echo Text ::_('COM_AKEEBA_CPANEL_PROFILE_TITLE'); ?>: #<?php echo $this->profile; ?>
			</label>
			<?php echo Html\Select::genericList($this->profileList, 'profile', array('onchange' => "document.forms.profileForm.submit()"), 'value', 'text', $this->profile); ?>
		</div>
		<div class="akeeba-form-group--actions">
			<button class="akeeba-btn--small--grey" onclick="this.form.submit(); return false;">
				<span class="akion-android-share"></span>
				<?php echo Text::_('COM_AKEEBA_CPANEL_PROFILE_BUTTON'); ?>
			</button>
		</div>
		<div class="akeeba-form-group--actions">
			<input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>">
			<input type="hidden" name="task" value="switchProfile" />
		</div>
	</form>
</div>
