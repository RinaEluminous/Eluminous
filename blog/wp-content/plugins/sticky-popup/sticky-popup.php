<?php
/**
 * Sticky Popup main plugin file
 *
 * @package   Sticky_Popup
 * @author    Numix Technologies <numixtech@gmail.com>
 * @author    Gaurav Padia <gauravpadia14u@gmail.com>
 * @author    Asalam Godhaviya <godhaviya.asalam@gmail.com>
 * @license   GPL-2.0+
 * @link      http://numixtech.com
 * @copyright 2014 Numix Techonologies
 *
 * @wordpress-plugin
 * Plugin Name: 	Sticky Popup
 * Plugin URI: 		http://numixtech.com
 * Description: 	Sticky Popup is a simple and easy wordpress plugin used to add popup on CSS3 animations. Show html code and shortcodes in popup.
 * Version: 1.2
 * Author: 			Numix Technologies, Gaurav Padia, Asalam Godhaviya
 * Author URI: 		http://numixtech.com
 * Text Domain: 	sticky-popup
 * License: 		GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'class-sticky-popup.php';

add_action( 'plugins_loaded', array( 'Sticky_Popup', 'get_instance' ) );