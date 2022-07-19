<?php
/**
* Shortcodes
*
* Define all the shortcodes
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Social Bookmarks shortcode
*
* Generate a Social Bookmarks output via shortcode
*
* @since	3.1
*
* @uses 	generate_social_bookmarks   Generate the social bookmarks code
*
* @param    string      $paras          Shortcode parameters
* @param    string      $content        Shortcode content
* @return   string                      Social bookmarks code
*/

function asb_shortcode( $paras = '', $content = '' ) {

    extract( shortcode_atts( array( 'url' => '', 'shorturl' => '', 'style' => '', 'options' => '', 'title' => '' ), $paras ) );

    return generate_social_bookmarks( $options, $style, $url, $shorturl, $title );
}
add_shortcode( 'bookmarks', 'asb_shortcode' );
?>