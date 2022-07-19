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

?>
<section class="akeeba-panel--primary">
    <header class="akeeba-block-header">
        <h3>
            <span class="akion-ios-play"></span>
			<?php echo Text::_('COM_AKEEBA_CPANEL_HEADER_QUICKBACKUP'); ?>
        </h3>
    </header>
    <div class="akeeba-grid--small">
		<?php foreach($this->quickIconProfiles as $qiProfile): ?>
            <a class="akeeba-action--green" href="<?php echo $router->route('index.php?view=backup&autostart=1&profile=' . (int) $qiProfile->id) . '&' . $token . '=1' ?>">
                <span class="akion-play"></span>
                <span>
							<?php echo htmlentities($qiProfile->description) ?>
						</span>
            </a>
		<?php endforeach; ?>
    </div>
</section>
