<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Browser\Html $this */

$rootDirWarning = \Solo\Helper\Escape::escapeJS(Text::_('COM_AKEEBA_CONFIG_UI_ROOTDIR'));

$this->container->application->getDocument()->addScriptDeclaration(
	<<<JS
	function akeeba_browser_useThis()
	{
		var rawFolder = document.forms.adminForm.folderraw.value;
		if( rawFolder == '[SITEROOT]' )
		{
			alert('$rootDirWarning');
			rawFolder = '[SITETMP]';
		}
		window.parent.akeeba.Configuration.onBrowserCallback( rawFolder );
	}

JS

);

$router = $this->container->router;
?>

<?php if (empty($this->folder)): ?>
	<form action="<?php echo $router->route('index.php?view=browser&tmpl=component&processfolder=0') ?>" method="post"
		  name="adminForm" id="adminForm">
		<input type="hidden" name="folder" id="folder" value=""/>
		<input type="hidden" name="token"
			   value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>"/>
	</form>
<?php return; endif; ?>

<?php
$writeableText  = Text::_($this->writable ? 'COM_AKEEBA_CPANEL_LBL_WRITABLE' : 'COM_AKEEBA_CPANEL_LBL_UNWRITABLE');
$writeableIcon  = $this->writable ? 'akion-checkmark-circled' : 'akion-ios-close';
$writeableClass = $this->writable ? 'akeeba-label--green' : 'akeeba-label--red';
?>
<div class="akeeba-panel--100 akeeba-panel--primary">
    <div>
        <form action="<?php echo $router->route('index.php?view=browser&tmpl=component') ?>" method="post"
              name="adminForm" id="adminForm" class="akeeba-form--inline--with-hidden--no-margins">

            <div class="akeeba-form-group">
                <span title="<?php echo $writeableText; ?>" class="<?php echo $writeableClass ?>">
                    <span class="<?php echo $writeableIcon; ?>"></span>
                </span>
            </div>

            <div class="akeeba-form-group">
                <input type="text" name="folder" id="folder" size="40"  value="<?php echo $this->folder; ?>" />
            </div>

            <div class="akeeba-form-group--action">
                <button class="akeeba-btn--primary" onclick="this.form.submit(); return false;">
                    <span class="akion-folder"></span>
		            <?php echo Text::_('COM_AKEEBA_BROWSER_LBL_GO'); ?>
                </button>

                <button class="akeeba-btn--green" onclick="akeeba_browser_useThis(); return false;">
                    <span class="akion-share"></span>
		            <?php echo Text::_('COM_AKEEBA_BROWSER_LBL_USE'); ?>
                </button>
            </div>

            <div class="akeeba-hidden-fields-container">
                <input type="hidden" name="token"
                       value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>"/>
                <input type="hidden" name="folderraw" id="folderraw" value="<?php echo $this->folder_raw ?>"/>
                <input type="hidden" name="token"
                       value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>"/>
            </div>
        </form>
    </div>
</div>

<?php if (count($this->breadcrumbs) > 0): ?>
<div class="akeeba-panel--100 akeeba-panel--information">
    <div>
        <ul class="akeeba-breadcrumb">
            <?php $i = 0 ?>
            <?php foreach ($this->breadcrumbs as $crumb): ?>
	            <?php
                $link = $router->route("index.php?view=browser&tmpl=component&folder=" . urlencode($crumb['folder']));
                $label = htmlentities($crumb['label']);
                $i++;
                $bull = $i < count($this->breadcrumbs) ? '&bull;' : '';
                ?>
                <li class="<?php echo $bull ? '' : 'active' ?>">
                    <?php if ($bull): ?>
                        <a href="<?php echo $link ?>">
                            <?php echo $label ?>
                        </a>
                        <span class="divider">&bull;</span>
                    <?php else: ?>
                        <?php echo $label ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

<div class="akeeba-panel--100 akeeba-panel">
    <div>
        <?php if (count($this->subfolders) > 0): ?>
            <table class="akeeba-table akeeba-table--striped">
                <tr>
                    <td>
                        <?php $linkbase = $router->route("index.php?&view=browser&tmpl=component&folder="); ?>
                        <a class="akeeba-btn--dark--small"
                           href="<?php echo $linkbase . urlencode($this->parent); ?>">
                            <span class="akion-arrow-up-a"></span>
                            <?php echo Text::_('COM_AKEEBA_BROWSER_LBL_GOPARENT') ?>
                        </a>
                    </td>
                </tr>
                <?php foreach ($this->subfolders as $subfolder): ?>
                    <tr>
                        <td>
                            <a href="<?php echo $linkbase . urlencode($this->folder . '/' . $subfolder); ?>"><?php echo htmlentities($subfolder) ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <?php if (!$this->exists): ?>
                <div class="akeeba-block--failure">
                    <?php echo Text::_('COM_AKEEBA_BROWSER_ERR_NOTEXISTS'); ?>
                </div>
            <?php elseif (!$this->inRoot): ?>
                <div class="akeeba-block--warning">
                    <?php echo Text::_('COM_AKEEBA_BROWSER_ERR_NONROOT'); ?>
                </div>
            <?php
            elseif ($this->openbasedirRestricted): ?>
                <div class="akeeba-block--failure">
                    <?php echo Text::_('COM_AKEEBA_BROWSER_ERR_BASEDIR'); ?>
                </div>
            <?php
            else: ?>
                <table class="akeeba-table--striped">
                    <tr>
                        <td>
                            <?php $linkbase = $router->route("index.php?&view=browser&tmpl=component&folder="); ?>
                            <a class="akeeba-btn--dark--small"
                               href="<?php echo $linkbase . urlencode($this->parent); ?>">
                                <span class="akion-arrow-up-a"></span>
                                <?php echo Text::_('COM_AKEEBA_BROWSER_LBL_GOPARENT') ?>
                            </a>
                        </td>
                    </tr>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
