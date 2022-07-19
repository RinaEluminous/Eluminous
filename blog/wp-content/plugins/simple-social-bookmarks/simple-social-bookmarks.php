<?php
/*
Plugin Name: Social Bookmarks
Plugin URI: https://wordpress.org/plugins/simple-social-bookmarks/
Description: Social Bookmarks adds icons to your posts and/or pages that allow your visitors to easily submit them on social bookmarking and network sites.
Version: 3.2.8
Author: David Artiss
Author URI: https://artiss.blog
Text Domain: simple-social-bookmarks
*/

/**
* Social Bookmarks
*
* Main code - include various functions
*
* @package	Artiss-Social-Bookmarks
* @since	3.2
*/

define( 'artiss_social_bookmarks_version', '3.2.8' );

$functions_dir = WP_PLUGIN_DIR . '/simple-social-bookmarks/includes/';

include_once( $functions_dir . 'asb-shared-functions.php' );			        // Shared functions

// Include all the various functions

include_once( $functions_dir . 'asb-admin-config.php' );		            // Assorted admin configuration changes

include_once( $functions_dir . 'asb-define-bookmarks.php' );			    // Set up the bookmark definitions

include_once( $functions_dir . 'asb-generate-bookmarks.php' );			    // Generate the bookmarks

include_once( $functions_dir . 'asb-shortcodes.php' );			            // Shortcode definitions

include_once( $functions_dir . 'asb-functions.php' );			            // Function calls

include_once( $functions_dir . 'asb-deprecated.php' );			            // Deprecated functions}
?>