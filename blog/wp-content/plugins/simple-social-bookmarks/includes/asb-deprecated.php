<?php
/**
* Deprecated Code
*
* Various pieces of code, now deprecated, but kept here for backwards compatibility
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Social Bookmarks
*
* Function to generate social bookmarks code
*
* @deprecated	3.2		Use social_bookmarks() instead.
* @since	    2.0
*
* @uses 	generate_social_bookmarks   Generate the social bookmarks code
*
* @param    string      $url            URL to link to
* @param    string      $shorturl       Short URL to link to
* @param    string      $style          Stylesheet details
* @param    string      $add_paras      Parameters
* @param    string      $title          Alternative title to use for link
* @return   string                      Social bookmarks code
*/

function simple_social_bookmarks( $url = '', $shorturl = '', $style = '', $add_paras = '', $title = '' ) {

    return generate_social_bookmarks( $add_paras, $style, $url, $shorturl, $title );

}
?>