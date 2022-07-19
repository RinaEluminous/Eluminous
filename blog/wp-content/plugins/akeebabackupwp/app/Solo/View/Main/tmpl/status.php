<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Akeeba\Engine\Factory;
use Awf\Text\Text;

// Used for type hinting
/** @var \Solo\View\Main\Html $this */

$router = $this->container->router;

$quirks = Factory::getConfigurationChecks()->getDetailedStatus(false);
$status = Factory::getConfigurationChecks()->getShortStatus();

if ($status && empty($quirks))
{
	$alert_status = 'success';
}
elseif ($status && !empty($quirks))
{
	$alert_status = 'warning';

	foreach ($quirks as $quirk)
	{
		if (($quirk['severity'] == 'high') || $quirk['severity'] == 'critical')
		{
			$alert_status = 'failure';
			break;
		}
	}
}
else
{
	$alert_status = 'danger';
}

?>
<div class="akeeba-panel">
    <header class="akeeba-block-header">
        <h3><?php echo Text::_('COM_AKEEBA_CPANEL_LABEL_STATUSSUMMARY'); ?></h3>
    </header>
    <div>
        <div class="akeeba-block--<?php echo $alert_status ?>">
		    <?php if ($alert_status == 'success'): ?>
			    <?php echo Text::_('SOLO_MAIN_LBL_STATUS_OK'); ?>
		    <?php elseif ($alert_status == 'warning'): ?>
			    <?php echo Text::_('SOLO_MAIN_LBL_STATUS_WARNING'); ?>
		    <?php else: ?>
			    <?php echo Text::_('SOLO_MAIN_LBL_STATUS_ERROR'); ?>
		    <?php endif; ?>
        </div>

	    <?php if (!empty($quirks)): ?>
        <div>
            <table class="akeeba-table--striped">
                <thead>
                <tr>
                    <th>
					    <?php echo Text::_('COM_AKEEBA_CPANEL_LABEL_STATUSDETAILS'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
			    <?php foreach ($quirks as $quirk):
				    switch ($quirk['severity'])
				    {
					    case 'critical':
						    $classSufix = 'red';
						    break;

					    case 'high':
						    $classSufix = 'orange';
						    break;

					    case 'medium':
						    $classSufix = 'teal';
						    break;

					    default:
						    $classSufix = 'grey';
						    break;
				    }
				    ?>
                    <tr>
                        <td>
                            <a href="<?php echo $quirk['help_url']; ?>" target="_blank">
								<span class="akeeba-label--<?php echo $classSufix ?>">
									S<?php echo $quirk['code']; ?>
								</span>
							    <?php echo $quirk['description']; ?>
                            </a>
                        </td>
                    </tr>
			    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr/>
	    <?php endif; ?>

        <p>
		    <?php echo Text::_('SOLO_APP_TITLE'); ?>
		    <?php echo AKEEBABACKUP_PRO ? 'Professional' : 'Core' ?>
            <span class="akeeba-label--teal"><?php echo AKEEBABACKUP_VERSION ?></span>

		    <?php echo (strlen(Text::_('SOLO_APP_TITLE')) > 14) ? '<br/>' : '' ?>
            <button class="akeeba-btn--small--dark"
                    onclick="akeeba.Modal.open({inherit: '#changelogModal', width: '80%'}); return false;">
                Changelog
            </button>
        </p>

	    <?php if (!AKEEBABACKUP_PRO): ?>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: center; margin: 0px;">
                <input type="hidden" name="cmd" value="_s-xclick" />
                <input type="hidden" name="hosted_button_id" value="3NTKQ3M2DYPYW" />
                <button onclick="this.form.submit(); return false;" class="akeeba-btn--green">
                    <span class="akion-heart"></span>
                    Donate via PayPal
                </button>
            </form>
	    <?php endif; ?>

    </div>
</div>
