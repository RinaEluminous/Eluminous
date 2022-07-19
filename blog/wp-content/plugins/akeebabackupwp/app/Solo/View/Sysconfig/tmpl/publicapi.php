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
    <label for="frontend_enable">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEBENABLE_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[frontend_enable]',
            array('id' => 'frontend_enable', 'forToggle' => 1),
            $config->get('options.frontend_enable', 1)) ?>
    </div>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEBENABLE_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="frontend_secret_word">
		<?php echo Text::_('COM_AKEEBA_CONFIG_SECRETWORD_LABEL'); ?>
    </label>
    <input type="text" name="options[frontend_secret_word]" id="frontend_secret_word"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_SECRETWORD_LABEL'); ?>"
           value="<?php echo \Akeeba\Engine\Platform::getInstance()->get_platform_configuration_option('frontend_secret_word', '') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_SECRETWORD_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="frontend_email_on_finish">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FRONTENDEMAIL_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[frontend_email_on_finish]',
            array('id' => 'frontend_email_on_finish', 'forToggle' => 1),
            $config->get('options.frontend_email_on_finish', 1)) ?>
    </div>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FRONTENDEMAIL_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="frontend_email_address">
		<?php echo Text::_('COM_AKEEBA_CONFIG_ARBITRARYFEEMAIL_LABEL'); ?>
    </label>
    <input type="email" name="options[frontend_email_address]" id="frontend_email_address"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_ARBITRARYFEEMAIL_LABEL'); ?>"
           value="<?php echo $config->get('options.frontend_email_address') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_ARBITRARYFEEMAIL_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="frontend_email_subject">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEEMAILSUBJECT_LABEL'); ?>
    </label>
    <input type="text" name="options[frontend_email_subject]" id="frontend_email_subject"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_FEEMAILSUBJECT_DESC'); ?>"
           value="<?php echo $config->get('options.frontend_email_subject') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEEMAILSUBJECT_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="frontend_email_body">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEEMAILBODY_LABEL'); ?>
    </label>
    <textarea rows="10" name="options[frontend_email_body]"
              id="frontend_email_body"><?php echo $config->get('options.frontend_email_body') ?></textarea>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_FEEMAILBODY_DESC') ?>
    </p>
</div>
