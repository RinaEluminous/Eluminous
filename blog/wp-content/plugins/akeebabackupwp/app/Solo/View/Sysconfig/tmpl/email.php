<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;
use Solo\Helper\Escape;
use Solo\Helper\FEFSelect;

/** @var \Solo\View\Sysconfig\Html $this */

$config = $this->container->appConfig;
$router = $this->container->router;
$inCMS  = $this->container->segment->get('insideCMS', false);

/**
 * Remember to update wpcli/Command/Sysconfig.php in the WordPress application whenever this file changes.
 */
?>
<div class="akeeba-form-group">
	<label for="mail_online">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_ONLINE'); ?>
	</label>
	<div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('mail_online', array('forToggle' => 1), $config->get('mail.online', 1)) ?>
	</div>
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_ONLINE_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="options_mail_mailer">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_MAILER'); ?>
	</label>
	<?php echo \Solo\Helper\Setup::mailerSelect($config->get('mail.mailer'), 'mail_mailer'); ?>
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_MAILER_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_mailfrom">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_MAILFROM'); ?>
	</label>
	<input type="email" name="mail_mailfrom" id="mail_mailfrom" value="<?php echo $config->get('mail.mailfrom') ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_MAILFROM_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_fromname">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_FROMNAME'); ?>
	</label>
	<input type="text" name="mail_fromname" id="mail_fromname" value="<?php echo $config->get('mail.fromname') ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_FROMNAME_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtpauth">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPAUTH'); ?>
	</label>
	<div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('mail_smtpauth', array('forToggle' => 1), $config->get('mail.smtpauth', 1)) ?>
	</div>
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPAUTH_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtpsecure">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPSECURE'); ?>
	</label>
	<?php echo \Solo\Helper\Setup::smtpSecureSelect($config->get('mail.smtpsecure'), 'mail_smtpsecure'); ?>
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPSECURE_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtpport">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPPORT'); ?>
	</label>
	<input type="number" name="mail_smtpport" id="mail_smtpport"
	       value="<?php echo $config->get('mail.smtpport', 25) ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPPORT_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtpuser">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPUSER'); ?>
	</label>
	<input type="text" name="mail_smtpuser" id="mail_smtpuser" value="<?php echo $config->get('mail.smtpuser', '') ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPUSER_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtppass">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPPASS'); ?>
	</label>
	<input type="password" name="mail_smtppass" id="mail_smtppass"
	       value="<?php echo $config->get('mail.smtppass', '') ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPPASS_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="mail_smtphost">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPHOST'); ?>
	</label>
	<input type="text" name="mail_smtphost" id="mail_smtphost"
	       value="<?php echo $config->get('mail.smtphost', 'localhost') ?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SYSCONFIG_LBL_EMAIL_SMTPHOST_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group--pull-right">
	<div class="akeeba-form-group--actions">
		<button class="akeeba-btn--grey" onclick="akeeba.System.submitForm('adminForm', 'testemail'); return false;">
			<span class="akion-email"></span>
			<?php echo Text::_('SOLO_SYSCONFIG_LBL_SEND_TEST_EMAIL') ?>
		</button>
	</div>
</div>
