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
    <label for="failure_timeout">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_TIMEOUT_LABEL'); ?>
    </label>
    <input type="text" name="options[failure_timeout]" id="failure_timeout"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_TIMEOUT_LABEL'); ?>"
           value="<?php echo $config->get('options.failure_timeout', 180) ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_TIMEOUT_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="failure_email_address">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILADDRESS_LABEL'); ?>
    </label>
    <input type="text" name="options[failure_email_address]" id="failure_email_address"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILADDRESS_LABEL'); ?>"
           value="<?php echo $config->get('options.failure_email_address') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILADDRESS_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="failure_email_subject">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILSUBJECT_LABEL'); ?>
    </label>
    <input type="text" name="options[failure_email_subject]" id="failure_email_subject"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILSUBJECT_LABEL'); ?>"
           value="<?php echo $config->get('options.failure_email_subject') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILSUBJECT_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="failure_email_body">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILBODY_LABEL'); ?>
    </label>
    <textarea type="text" name="options[failure_email_body]" id="failure_email_body"
              placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILBODY_LABEL'); ?>"
              rows="15"><?php echo $config->get('options.failure_email_body') ?></textarea>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FAILURE_EMAILBODY_DESC') ?>
    </p>
</div>
