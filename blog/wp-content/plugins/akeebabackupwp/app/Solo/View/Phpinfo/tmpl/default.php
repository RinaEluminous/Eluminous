<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

/** @var  Solo\View\Phpinfo\Html $this */

$available = true;

$functions = ini_get('disable_functions') . ',';
$functions .= ini_get('suhosin.executor.func.blacklist');

if ($functions)
{
	$array = preg_split('/,\s*/', $functions);

	if (in_array('phpinfo', $array))
	{
		$available = false;
	}
}

if ($available)
{
	$source = $this->getContainer()->router->route('index.php?view=phpinfo&task=phpinfo');
    echo "<iframe width='100%' height='80%' src='$source'></iframe>";
}
else
{
	?>
    <div>
        <p class="akeeba-block--warning">
			<?php echo \Awf\Text\Text::_('SOLO_PHPINFO_DISABLED') ?>
        </p>

        <p>
            <strong>PHP Version: </strong> <?php echo phpversion() ?>
        </p>
    </div>
	<?php
}
