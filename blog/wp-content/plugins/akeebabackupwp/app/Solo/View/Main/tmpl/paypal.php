<?php
/**
 * @package     Solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use Awf\Html;
use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

$router   = $this->container->router;
$inCMS    = $this->container->segment->get('insideCMS', false);
$isJoomla = defined('_JEXEC');
$token    = $this->container->session->getCsrfToken()->getValue();

// Only show in the Core version with a 10% probability
if (AKEEBABACKUP_PRO || (rand(0, 9) != 0)) return;

?>
<div class="akeeba-panel--success">
    <header class="akeeba-block-header">
        <p><?php echo Text::_('SOLO_MAIN_LBL_SUBSCRIBE_TEXT') ?></p>
    </header>

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: center; margin: 0px;">
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="3NTKQ3M2DYPYW" />
        <button onclick="this.form.submit(); return false;" class="btn btn-success">
            <img src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0">
            Donate via PayPal
        </button>
        <a class="small" style="font-weight: normal; color: #666" href="https://www.akeebabackup.com/subscribe/new/backupwp.html?layout=default">
			<?php echo Text::_('SOLO_MAIN_BTN_SUBSCRIBE_UNOBTRUSIVE'); ?>
        </a>
    </form>
</div>
