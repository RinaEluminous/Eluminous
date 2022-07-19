<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Manage\Html $this */

$router = $this->container->router;

$token = $this->container->session->getCsrfToken()->getValue();

$dateFormat = $this->getContainer()->appConfig->get('dateformat', '');
$dateFormat = trim($dateFormat);
$dateFormat = !empty($dateFormat) ? $dateFormat : Text::_('DATE_FORMAT_LC4');
$dateFormat = !empty($dateFormat) ? $dateFormat : Text::_('DATE_FORMAT_LC4');

// Timezone settings
$serverTimezone = new DateTimeZone($this->container->appConfig->get('timezone', 'UTC'));
$useLocalTime   = $this->container->appConfig->get('localtime', '1') == 1;
$timeZoneFormat = $this->container->appConfig->get('timezonetext', 'T');

$urlIncludeFolders = addslashes($this->getContainer()->router->route('index.php?view=extradirs&task=ajax'));
$urlBrowser = addslashes($this->getContainer()->router->route('index.php?view=browser&processfolder=1&tmpl=component&folder='));

?>

<?php echo $this->loadAnyTemplate('Main/paypal'); ?>

<?php
// Restoration information prompt
$proKey = (defined('AKEEBABACKUP_PRO') && AKEEBABACKUP_PRO) ? 'PRO' : 'CORE';
if (\Akeeba\Engine\Platform::getInstance()->get_platform_configuration_option('show_howtorestoremodal', 1)):
	echo $this->loadAnyTemplate('Manage/howtorestore_modal');
endif; ?>

<div class="akeeba-block--info">
    <h4><?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_HOWDOIRESTORE_LEGEND') ?></h4>

    <p>
	    <?php echo Text::sprintf('COM_AKEEBA_BUADMIN_LABEL_HOWDOIRESTORE_TEXT_' . $proKey,
		    'https://www.akeebabackup.com/videos/1214-akeeba-solo/1637-abts05-restoring-site-new-server.html',
		    $router->route('index.php?view=Transfer'),
		    'https://www.akeebabackup.com/latest-kickstart-core.zip'
	    ); ?>
    </p>
</div>

<form action="<?php echo $router->route('index.php?view=manage') ?>" method="post" name="adminForm" id="adminForm"
      role="form" class="akeeba-form">

    <table class="akeeba-table--striped" id="itemsList">
        <thead>
        <tr>
            <th width="20">
                <input type="checkbox" name="toggle" value="" onclick="akeeba.System.checkAll(this);"/>
            </th>
            <th width="20" class="akeeba-hidden-phone">
				<?php echo \Awf\Html\Grid::sort('COM_AKEEBA_BUADMIN_LABEL_ID', 'id', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
            </th>
            <th width="30%">
				<?php echo \Awf\Html\Grid::sort('COM_AKEEBA_BUADMIN_LABEL_DESCRIPTION', 'description', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
            </th>
            <th class="akeeba-hidden-phone">
				<?php echo \Awf\Html\Grid::sort('COM_AKEEBA_BUADMIN_LABEL_PROFILEID', 'profile_id', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
            </th>
            <th width="80">
				<?php echo \Awf\Html\Grid::sort('COM_AKEEBA_BUADMIN_LABEL_DURATION', 'backupstart', $this->lists->order_Dir, $this->lists->order, 'default'); ?>
            </th>
            <th width="80">
				<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS'); ?>
            </th>
            <th width="110" class="akeeba-hidden-phone">
				<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_SIZE'); ?>
            </th>
            <th class="akeeba-hidden-phone">
				<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_MANAGEANDDL'); ?>
            </th>
        </tr>
        <tr>
            <td></td>
            <td class="akeeba-hidden-phone"></td>
            <td>
                <input type="text" name="filter_description" id="description"
                       onchange="document.adminForm.submit();" style="width: 100%;"
                       value="<?php echo $this->escape($this->lists->fltDescription) ?>"
                       placeholder="<?php echo Text::_('SOLO_MANAGE_FIELD_DESCRIPTION') ?>">
            </td>
            <td class="akeeba-hidden-phone">
				<?php echo \Awf\Html\Select::genericList($this->profileList, 'filter_profile', array(
					'onchange' => "document.forms.adminForm.submit()",
					'width'    => '100%'
				), 'value', 'text', $this->lists->fltProfile); ?>
            </td>
            <td></td>
            <td></td>
            <td colspan="2" class="akeeba-hidden-phone"></td>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="11" class="center"><?php echo $this->pagination->getListFooter(); ?></td>
        </tr>
        </tfoot>
        <tbody>
		<?php if (!empty($this->list)): ?>
			<?php $i = 0;
			foreach ($this->list as $record):?>
				<?php
				$check = \Awf\Html\Grid::id(++$i, $record['id']);

				$backupId          = isset($record['backupid']) ? $record['backupid'] : '';

				if (array_key_exists($record['type'], $this->backupTypes))
				{
					$type = $this->backupTypes[$record['type']];
				}
				else
				{
					$type = '&ndash;';
				}

				$gmtTimezone = new DateTimeZone('GMT');
				$startTime   = new \Awf\Date\Date($record['backupstart'], $gmtTimezone);
				$endTime     = new \Awf\Date\Date($record['backupend'], $gmtTimezone);

				if ($useLocalTime)
				{
					$startTime->setTimezone($serverTimezone);
				}

				$duration = $endTime->toUnix() - $startTime->toUnix();

				if ($duration > 0)
				{
					$seconds  = $duration % 60;
					$duration = $duration - $seconds;

					$minutes  = ($duration % 3600) / 60;
					$duration = $duration - $minutes * 60;

					$hours    = $duration / 3600;
					$duration = sprintf('%02d', $hours) . ':' . sprintf('%02d', $minutes) . ':' . sprintf('%02d', $seconds);
				}
				else
				{
					$duration = '';
				}

				// Label class based on status
				$status      = Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS_' . $record['meta']);
				$statusClass = '';
				switch ($record['meta'])
				{
					case 'ok':
						$statusIcon  = 'akion-checkmark';
						$statusClass = 'akeeba-label--green';
						break;
					case 'pending':
						$statusIcon  = 'akion-play';
						$statusClass = 'akeeba-label--orange';
						break;
					case 'fail':
						$statusIcon  = 'akion-android-cancel';
						$statusClass = 'akeeba-label--red';
						break;
					case 'remote':
						$statusIcon  = 'akion-cloud';
						$statusClass = 'akeeba-label--teal';
						break;
					default:
						$statusIcon  = 'akion-trash-a';
						$statusClass = 'akeeba-label--grey';
						break;
				}

				$edit_link = $router->route('index.php?view=manage&task=showComment&id=' . $record['id'] . '&token=' . $token);

				if (empty($record['description']))
				{
					$record['description'] = Text::_('COM_AKEEBA_BUADMIN_LABEL_NODESCRIPTION');
				}

				list($originDescription, $originIcon) = $this->getOriginInformation($record);
				?>
                <tr>
                    <td>
						<?php echo $check; ?>
                    </td>
                    <td class="akeeba-hidden-phone">
						<?php echo $record['id']; ?>
                    </td>
                    <td>
                        <span class="akeeba-label--grey akeebaCommentPopover" rel="popover"
                              data-original-title="<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_ORIGIN'); ?>"
                              data-content="<?php echo htmlentities($originDescription) ?>"
                              style="padding: 0.4em 0.6em;"
                        ><span class="<?php echo $originIcon ?>"></span></span>

						<?php if (!empty($record['comment'])): ?>
                            <span class="akeebaCommentPopover"
                                  data-content="<?php echo $this->escape($record['comment']) ?>"
                                  style="padding: 0.4em 0.6em;"
                            ><span class="akion-help-circled"></span></span>
						<?php endif; ?>
                        <a href="<?php echo $edit_link; ?>">
							<?php echo $this->escape($record['description']) ?>
                        </a>
                        <br/>
                        <div style="border-top: 1px solid #eee; color: #999; padding-top: 2px; margin-top: 2px"
                             title="<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_START') ?>">
                            <small>
                                <span class="akion-calendar"></span>
								<?php echo $startTime->format($dateFormat, true); ?>
								<?php echo empty($timeZoneFormat) ? '' : $startTime->format($timeZoneFormat, true); ?>
                            </small>
                        </div>
                    </td>
                    <td class="akeeba-hidden-phone">
						<?php
						$profileName = '&mdash;';

						if (isset($this->profiles[$record['profile_id']]))
						{
							$profileName = $this->escape($this->profiles[$record['profile_id']]->description);
						}
						?>
                        #<?php echo $record['profile_id'] ?>. <?php echo $profileName ?>
                        <br/>
                        <small>
                            <em><?php echo $type ?></em>
                        </small>
                    </td>
                    <td>
						<?php if ($duration): ?>
							<?php echo $duration; ?>
						<?php endif; ?>
                    </td>
                    <td>
                        <span class="<?php echo $statusClass; ?> akeebaCommentPopover" rel="popover"
                              data-original-title="<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_STATUS') ?>"
                              data-content="<?php echo $status ?>"
                              style="padding: 0.4em 0.6em;"
                        >
                            <span class="<?php echo $statusIcon; ?>"></span>
                        </span>
                    </td>
                    <td class="akeeba-hidden-phone"><?php echo ($record['meta'] == 'ok') ? \Solo\Helper\Format::fileSize($record['size']) : ($record['total_size'] > 0 ? "(<i>" . \Solo\Helper\Format::fileSize($record['total_size']) . "</i>)" : '&mdash;') ?></td>
                    <td class="akeeba-hidden-phone">
						<?php echo $this->loadAnyTemplate('Manage/manage_column', array(
							'record' => &$record,
						)); ?>
                    </td>
                </tr>
			<?php endforeach; ?>
		<?php else: ?>
            <tr>
                <td colspan="11">
					<?php echo Text::_('SOLO_LBL_NO_RECORDS') ?>
                </td>
            </tr>
		<?php endif; ?>
        </tbody>
    </table>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="boxchecked" id="boxchecked" value="0">
        <input type="hidden" name="task" id="task" value="default">
        <input type="hidden" name="filter_order" id="filter_order" value="<?php echo $this->lists->order ?>">
        <input type="hidden" name="filter_order_Dir" id="filter_order_Dir" value="<?php echo $this->lists->order_Dir ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
    </div>
</form>
