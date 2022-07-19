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

?>
<div class="akeeba-block--warning">
	<?php echo Text::_('SOLO_SYSCONFIG_WARNDB'); ?>
</div>

<div class="akeeba-form-group">
	<label for="driver">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_DRIVER'); ?>
	</label>
	<?php echo \Solo\Helper\Setup::databaseTypesSelect($config->get('dbdriver'));?>
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_DRIVER_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="host">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_HOST'); ?>
	</label>
	<input type="text" id="host" name="host" placeholder="<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_HOST'); ?>" value="<?php echo $config->get('dbhost')?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_HOST_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="user">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_USER'); ?>
	</label>
	<input type="text" id="user" name="user" placeholder="<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_USER'); ?>" value="<?php echo $config->get('dbuser')?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_USER_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="pass">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PASS'); ?>
	</label>
	<input type="password" id="pass" name="pass" placeholder="<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PASS'); ?>" value="<?php echo $config->get('dbpass')?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PASS_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="name">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_NAME'); ?>
	</label>
	<input type="text" id="name" name="name" placeholder="<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_NAME'); ?>" value="<?php echo $config->get('dbname')?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_NAME_HELP') ?>
	</p>
</div>

<div class="akeeba-form-group">
	<label for="prefix">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PREFIX'); ?>
	</label>
	<input type="text" id="prefix" name="prefix" placeholder="<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PREFIX'); ?>" value="<?php echo $config->get('prefix')?>">
	<p class="akeeba-help-text">
		<?php echo Text::_('SOLO_SETUP_LBL_DATABASE_PREFIX_HELP') ?>
	</p>
</div>
