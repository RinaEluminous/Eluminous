<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
add_action( 'init','mohan' );
function mohan()
{
	# code...
	global $wpdb;
	$mytables=$wpdb->get_results("SHOW TABLES");
	foreach ($mytables as $mytable)
	{
	    foreach ($mytable as $t) 
	    {       
	        echo $t . "<br>";
	    }
	}
}
?>