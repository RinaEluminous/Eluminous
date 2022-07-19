<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Document\Document;
use Awf\Document\Menu\Item;
use Awf\Text\Text;

function _solo_template_renderSubmenu(Document $app, Item $root)
{
	$enabled = $app->getMenu()->isEnabled('main');

	$children = $root->getChildren();

	if (empty($children))
	{
		return;
	}

	/** @var Item $item */
	foreach ($children as $item):
		$class = $item->isActive() ? 'class="active"' : '';
		$link = $item->getUrl();

		if (!$enabled)
		{
			$class = 'class="disabled"';
			$link = '#';
		}
	?>
		<a href="<?php echo $link ?>"><?php echo Text::_($item->getTitle()) ?></a>
		<?php
        // We never had nested submenus, so we completely skipped this feature in FEF :)
        // _solo_template_renderSubmenu($app, $item);
        ?>
	<?php
	endforeach;

}
