<?php
/**
* Shared Functions
*
* Various functions that are shared across code
*
* @package	Artiss-Social-Bookmarks
*/

/**
* Extract Parameters (1.1)
*
* Function to extract parameters from an input string
*
* @since	1.0
*
* @param	$input	string	Input string
* @param	$para	string	Parameter to find
* @return			string	Parameter value
*/

function asb_get_parameters( $input, $para, $divider = '=', $seperator = '&' ) {

    $start = strpos( strtolower( $input ), $para . $divider);
    $content = '';
    if ( $start !== false ) {
        $start = $start + strlen( $para ) + 1;
        $end = strpos( strtolower( $input ), $seperator, $start );
        if ( $end !== false ) { $end = $end - 1; } else { $end = strlen( $input ); }
        $content = substr( $input, $start, $end - $start + 1 );
    }
    return $content;
}