<?php
/**
 * @package   AkeebaBackup
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 *
 * @since     1.3
 */

/** @var  array $record */
/** @var  Solo\View\Manage\Html $this */

use Awf\Text\Text;
use Solo\Helper\Utils as AkeebaHelperUtils;

$router      = $this->container->router;
$cancelLabel = Text::_('SOLO_MANAGE_LBL_CANCELMODAL');

if (!isset($record['remote_filename']))
{
	$record['remote_filename'] = '';
}

$archiveExists    = $record['meta'] == 'ok';
$showManageRemote = in_array($record['meta'], array('ok', 'remote')) && !empty($record['remote_filename']) && (AKEEBABACKUP_PRO == 1);
$showUploadRemote = $this->privileges['backup'] && $archiveExists && @empty($record['remote_filename']) && ($this->enginesPerProfile[$record['profile_id']] != 'none') && ($record['meta'] != 'obsolete') && (AKEEBABACKUP_PRO == 1);
$showDownload     = $this->privileges['download'] && $archiveExists;
$showViewLog      = $this->privileges['backup'] && isset($record['backupid']) && !empty($record['backupid']);
$postProcEngine   = '';
$thisPart         = '';
$thisID           = urlencode($record['id']);

if ($showUploadRemote)
{
	$postProcEngine   = $this->enginesPerProfile[$record['profile_id']];
	$showUploadRemote = !empty($postProcEngine);
}

?>
<div style="display: none">
    <div id="akeeba-buadmin-<?php echo $record['id'] ?>" tabindex="-1" role="dialog">
        <div class="akeeba-renderer-fef">
            <h4><?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_BACKUPINFO') ?></h4>

            <p>
                <strong><?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_ARCHIVEEXISTS') ?></strong><br/>
		        <?php if ($record['meta'] == 'ok'): ?>
                    <span class="akeeba-label--success">
					<?php echo Text::_('SOLO_YES') ?>
				</span>
		        <?php else: ?>
                    <span class="akeeba-label--failure">
					<?php echo Text::_('SOLO_NO') ?>
				</span>
		        <?php endif; ?>
            </p>
            <p>
                <strong><?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_ARCHIVEPATH' . ($archiveExists ? '' : '_PAST')) ?></strong><br/>
                <span class="akeeba-label--information">
		<?php echo htmlentities(AkeebaHelperUtils::getRelativePath(APATH_BASE, dirname($record['absolute_path']))) ?>
		</span>
            </p>
            <p>
                <strong><?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_ARCHIVENAME' . ($archiveExists ? '' : '_PAST')) ?></strong><br/>
                <br/>
                <code>
		            <?php echo htmlentities($record['archivename']); ?>
                </code>
            </p>
        </div>
    </div>

	<?php if ($showDownload): ?>
    <div id="akeeba-buadmin-download-<?php echo $record['id'] ?>" tabindex="-2" role="dialog">
        <div class="akeeba-renderer-fef">
            <div class="akeeba-block--warning">
                <h4>
		            <?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_DOWNLOAD_TITLE') ?>
                </h4>
	            <?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_DOWNLOAD_WARNING') ?>
            </div>

            <?php if ($record['multipart'] < 2): ?>
                <a class="akeeba-btn--primary--small"
                   href="javascript:confirmDownload('<?php echo $thisID ?>', '<?php echo $thisPart ?>');">
                    <span class="akion-ios-download"></span>
                    <?php echo Text::_('COM_AKEEBA_BUADMIN_LOG_DOWNLOAD'); ?>
                </a>
            <?php else: ?>
                <div>
                    <?php echo Text::sprintf('COM_AKEEBA_BUADMIN_LBL_DOWNLOAD_PARTS', $record['multipart']); ?>
                </div>
                <?php for ($count = 0; $count < $record['multipart']; $count++):
                    $thisPart = urlencode($count);
                    $label = Text::sprintf('COM_AKEEBA_BUADMIN_LABEL_PART', $count);
                    ?>
                    <?php if ($count > 0): ?>
                    &bull;
                <?php endif; ?>
                    <a class="akeeba-btn--small--dark"
                       href="javascript:confirmDownload('<?php echo $thisID ?>', '<?php echo $thisPart ?>');">
                        <span class="akion-android-download"></span>
                        <?php echo $label; ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if ($showManageRemote): ?>
    <div style="padding-bottom: 3pt;">
        <a class="akeeba-btn--primary akeeba_remote_management_link"
           href="javascript:akeeba.Manage.onRemoteManagementClick('<?php echo $router->route('index.php?view=Remotefiles&tmpl=component&task=listActions&id=' . $record['id']) ?>', '<?php echo $router->route('index.php?view=Manage') ?>')"
        >
            <span class="akion-cloud"></span>
			<?php echo Text::_('COM_AKEEBA_BUADMIN_LABEL_REMOTEFILEMGMT'); ?>
        </a>
    </div>
<?php elseif ($showUploadRemote): ?>
    <a class="akeeba-btn--primary akeeba_upload"
       href="javascript:akeeba.Manage.onUploadClick('<?php echo $router->route('index.php?view=Upload&tmpl=component&task=start&id=' . $record['id']) ?>', '<?php echo $router->route('index.php?view=Manage') ?>')"
       title="<?php echo Text::sprintf('COM_AKEEBA_TRANSFER_DESC', Text::_("ENGINE_POSTPROC_{$postProcEngine}_TITLE")) ?>"
    >
        <span class="akion-android-upload"></span>
		<?php echo Text::_('COM_AKEEBA_TRANSFER_TITLE') ?>
        (<em><?php echo $postProcEngine ?></em>)
    </a>
<?php endif; ?>

<div style="padding-bottom: 3pt">
	<?php if ($showDownload): ?>
        <a class="akeeba-btn--<?php echo $showManageRemote || $showUploadRemote ? 'smal--grey' : 'green'; ?>"
           href="javascript:akeeba.Manage.onDownloadClick('#akeeba-buadmin-download-<?php echo (int) $record['id']; ?>')"
        >
            <span class="akion-android-download"></span>
			<?php echo Text::_('COM_AKEEBA_BUADMIN_LOG_DOWNLOAD'); ?>
        </a>
	<?php endif; ?>

	<?php if ($showViewLog): ?>
        <a class="akeeba-btn--grey akeebaCommentPopover" <?php echo ($record['meta'] != 'obsolete') ? '' : 'disabled="disabled" onclick="return false;"' ?>
                href="<?php echo $router->route('index.php?view=Log&tag=' . $this->escape($record['tag']) . '.' . $this->escape($record['backupid']) . '&task=start&profileid=' . $record['profile_id']) ?>"
                data-original-title="<?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_LOGFILEID'); ?>"
                data-content="<?php echo $this->escape($record['backupid']) ?>"
        >
            <span class="akion-ios-search-strong"></span>
			<?php echo Text::_('COM_AKEEBA_LOG'); ?>
        </a>
	<?php endif; ?>

    <a class="akeeba-btn--grey--small akeebaCommentPopover"
            href="javascript:akeeba.Manage.onShowInfoClick('#akeeba-buadmin-<?php echo (int)$record['id']; ?>')"
            data-content="<?php echo Text::_('COM_AKEEBA_BUADMIN_LBL_BACKUPINFO'); ?>"
    >
        <span class="akion-information-circled"></span>
    </a>
</div>
