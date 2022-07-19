<?php
/**
 * @package        akeebabackupwp
 * @copyright      2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

include __DIR__ . '/php/menu.php';

$this->outputHTTPHeaders();

if (defined('AKEEBA_SOLOWP_OBFLAG'))
{
	include __DIR__ . '/php/head.php';
}
else
{
	include __DIR__ . '/php/head_wp.php';
}

?>
<div class="akeeba-renderer-fef akeeba-wp">
<?php if (\Awf\Application\Application::getInstance()->getContainer()->input->getCmd('tmpl', '') != 'component'): ?>
    <header class="akeeba-navbar">
        <div class="akeeba-maxwidth akeeba-flex">
            <!-- Branding -->
            <div class="akeeba-nav-logo">
                <a href="<?php echo $this->getContainer()->router->route('index.php') ?>">
                    <span class="aklogo-backup-wp"></span>
                    <span class="akeeba-product-name">
                        <?php echo \Awf\Text\Text::_('SOLO_APP_TITLE') ?>
                    </span>
                    <span class="akeeba-product-<?php echo AKEEBABACKUP_PRO ? 'pro' : 'core' ?>">
                        <?php echo AKEEBABACKUP_PRO ? 'Professional' : 'Core' ?>
                    </span>

					<?php if ((substr(AKEEBABACKUP_VERSION, 0, 3) == 'rev') || (strpos(AKEEBABACKUP_VERSION, '.a') !== false)): ?>
                        <span class="akeeba-label--red--small">Alpha</span>
					<?php elseif (strpos(AKEEBABACKUP_VERSION, '.b') !== false): ?>
                        <span class="akeeba-label--orange--small">Beta</span>
					<?php elseif (strpos(AKEEBABACKUP_VERSION, '.rc') !== false): ?>
                        <span class="akeeba-label--grey--small">RC</span>
					<?php endif; ?>
                </a>
                <a href="#" class="akeeba-menu-button akeeba-hidden-desktop akeeba-hidden-tablet"
                   title="<?php echo \Awf\Text\Text::_('SOLO_COMMON_TOGGLENAV') ?>"><span class="akion-navicon-round"></span></a>
            </div>
            <!-- Navigation -->

            <nav>
				<?php _solo_template_renderSubmenu($this, $this->getMenu()->getMenuItems('main'), 'nav navbar-nav'); ?>
            </nav>
        </div>
    </header>

<?php include __DIR__ . '/php/toolbar.php' ?>

<div class="akeeba-maxwidth">
<?php endif; ?>

<?php include __DIR__ . '/php/messages.php' ?>
<?php echo $this->getBuffer() ?>

<?php if (\Awf\Application\Application::getInstance()->getContainer()->input->getCmd('tmpl', '') != 'component'): ?>
</div>
<footer id="akeeba-footer">
    <div class="akeeba-maxwidth">
        <p class="muted credit">
            Copyright &copy;2013 &ndash; <?php echo date('Y') ?> <a href="https://www.akeeba.com">Akeeba Ltd</a>. All legal rights reserved.
        </p>
        <p>
            <?php echo \Awf\Text\Text::_('SOLO_APP_TITLE') ?> is Free Software distributed under the
            <a href="http://www.gnu.org/licenses/gpl.html">GNU GPL version 3</a> or any later version published by the FSF.
        </p>
        <?php if (defined('AKEEBADEBUG')): ?>
            <p class="small">
                Page creation <?php echo sprintf('%0.3f', \Awf\Application\Application::getInstance()->getTimeElapsed()) ?> sec
                &bull;
                Peak memory usage <?php echo sprintf('%0.1f', memory_get_peak_usage() / 1048576) ?> Mb
            </p>
        <?php endif; ?>
    </div>
</footer>
<?php endif; ?>
</div>
<?php if (defined('AKEEBA_SOLOWP_OBFLAG')): ?>
</body>
</html>
<?php endif; ?>
