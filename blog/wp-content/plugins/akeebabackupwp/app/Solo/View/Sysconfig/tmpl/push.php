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
    <label for="desktop_notifications">
		<?php echo Text::_('COM_AKEEBA_CONFIG_DESKTOP_NOTIFICATIONS_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[desktop_notifications]',
            array('id' => 'desktop_notifications', 'forToggle' => 1),
            $config->get('options.desktop_notifications', 0)) ?>
    </div>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_DESKTOP_NOTIFICATIONS_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="push_preference">
		<?php echo Text::_('COM_AKEEBA_CONFIG_PUSH_PREFERENCE_LABEL'); ?>
    </label>
    <div class="akeeba-toggle">
		<?php echo FEFSelect::booleanList('options[push_preference]',
            array('id' => 'push_preference', 'forToggle' => 1),
            $config->get('options.push_preference', 0)) ?>
    </div>
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_PUSH_PREFERENCE_DESC') ?>
    </p>
</div>

<div class="akeeba-form-group">
    <label for="push_apikey">
		<?php echo Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_LABEL'); ?>
    </label>
    <input type="text" name="options[push_apikey]" id="push_apikey"
           placeholder="<?php echo Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_LABEL'); ?>"
           value="<?php echo $config->get('options.push_apikey') ?>">
    <p class="akeeba-help-text">
		<?php echo Text::_('COM_AKEEBA_CONFIG_PUSH_APIKEY_DESC') ?>
    </p>
</div>
