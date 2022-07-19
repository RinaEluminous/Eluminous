<?php
/*
Plugin Name: Verify Bing Webmaster Tools
Plugin URI: http://wordpress.org/extend/plugins/verify-bing-webmaster-tools/
Description: Adds <a href="http://www.google.com/webmasters/">Bing Webmaster Tools</a> verification meta-tag.
Version: 1.3
Author: Audrius Dobilinskas
Author URI: http://onlineads.lt/author/audrius
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activate_bing_webmaster_tools() {
  add_option('bwebmasters_code', 'Paste your Bing Webmaster Tools verification code here');
}

function deactive_bing_webmaster_tools() {
  delete_option('bwebmasters_code');
}

function admin_init_bing_webmaster_tools() {
  register_setting('bing_webmaster_tools', 'bwebmasters_code');
}

function admin_menu_bing_webmaster_tools() {
  add_options_page('Bing Webmaster Tools', 'Bing Webmaster Tools', 'manage_options', 'bing_webmaster_tools', 'options_page_bing_webmaster_tools');
}

function options_page_bing_webmaster_tools() {
  include(WP_PLUGIN_DIR.'/verify-bing-webmaster-tools/options.php');  
}

function bing_webmaster_tools() {
  $bwebmasters_code = get_option('bwebmasters_code');
?>

<?php echo $bwebmasters_code ?>

<?php
}

register_activation_hook(__FILE__, 'activate_bing_webmaster_tools');
register_deactivation_hook(__FILE__, 'deactive_bing_webmaster_tools');

if (is_admin()) {
  add_action('admin_init', 'admin_init_bing_webmaster_tools');
  add_action('admin_menu', 'admin_menu_bing_webmaster_tools');
}

if (!is_admin()) {
  add_action('wp_head', 'bing_webmaster_tools');
}

?>