<?php
/**
* Admin Menu Functions
*
* Various functions relating to the various administration screens
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	3.2
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function asb_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'simple-social-bookmarks.php' ) !== false ) { $links = array_merge( $links, array( '<a href="https://wordpress.org/support/plugin/simple-social-bookmarks">' . __( 'Support', 'simple-social-bookmarks' ) . '</a>' ) ); }

	return $links;
}
add_filter( 'plugin_row_meta', 'asb_set_plugin_meta', 10, 2 );
?>