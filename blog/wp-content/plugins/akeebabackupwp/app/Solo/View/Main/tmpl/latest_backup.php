<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Main\Html $this */

?>
<div class="akeeba-panel">
	<header class="akeeba-block-header">
        <h3>
            <?php echo Text::_('SOLO_MAIN_LBL_LATEST_BACKUP') ?>
        </h3>
	</header>

    <div>
	    <?php if(empty($this->latestBackupDetails)): ?>
            <div class="akeeba-label--info">
			    <?php echo Text::_('COM_AKEEBA_BACKUP_STATUS_NONE'); ?>
            </div>
	    <?php else: ?>
            <table class="akeeba-table--striped">
                <tr>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_START'); ?>
                    </td>
                    <td>
					    <?php $backupDate = new \Awf\Date\Date($this->latestBackupDetails['backupstart'], 'UTC');
					    $tz = new DateTimeZone(\Awf\Application\Application::getInstance()->getContainer()->appConfig->get('timezone', 'UTC'));
					    $backupDate->setTimezone($tz);
					    echo $backupDate->format(Text::_('DATE_FORMAT_LC2'), true); ?>
                    </td>
                </tr>
                <tr>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_DESCRIPTION'); ?>
                    </td>
                    <td>
					    <?php echo $this->escape($this->latestBackupDetails['description']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS'); ?>
                    </td>
                    <td>
					    <?php switch ($this->latestBackupDetails['status']):
						    case 'run': ?>
                                <span class="akeeba-label--orange"><?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS_PENDING') ?></span>
							    <?php break;case 'fail': ?>
                                <span class="akeeba-label--red"><?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS_FAIL') ?></span>
							    <?php break;case 'ok':
						    case 'complete': ?>
                                <span class="akeeba-label--green"><?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS_OK') ?></span>
						    <?php endswitch; ?>
                    </td>
                </tr>
                <tr>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_ORIGIN'); ?>
                    </td>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_ORIGIN_' . $this->latestBackupDetails['origin']) ?>
                    </td>
                </tr>
                <tr>
                    <td>
					    <?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_TYPE'); ?>
                    </td>
                    <td>
					    <?php echo $this->escape($this->latestBackupDetails['type_translated']); ?>
                    </td>
                </tr>
            </table>
	    <?php endif; ?>
    </div>
</div>
