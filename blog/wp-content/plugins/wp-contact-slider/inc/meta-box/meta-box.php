<?php
/**
 *
 * @package Meta Box
 */

if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$rwmb_loader = new RWMB_Loader();
	$rwmb_loader->init();
}
