<?php
/**
* Functions
*
* Define all the functions
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Social Bookmarks
*
* Function to generate social bookmarks code
*
* @since	3.2
*
* @uses 	generate_social_bookmarks   Generate the social bookmarks code
*
* @param    string      $add_paras      Parameters
* @param    string      $style          Stylesheet details
* @param    string      $url            URL to link to
* @param    string      $shorturl       Short URL to link to
* @param    string      $title          Alternative title to use for link
* @return   string                      Social bookmarks code
*/

function social_bookmarks( $add_paras = '', $style = '', $url = '', $shorturl = '',  $title = '' ) {

    return generate_social_bookmarks( $add_paras, $style, $url, $shorturl, $title );

}
?>