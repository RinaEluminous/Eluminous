=== Display Latest Tweets ===
Contributors: sayful
Tags: twitter, tweets, twitter tweets, widget, twitter timeline
Requires at least: 4.0
Tested up to: 4.9
Stable tag: 2.1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A widget that displays your latest tweets from your twitter account using Twitter API 1.1

== Description ==

Connect your Twitter account to this plugin and the widget will display your latest tweets on your site. This plugin is compatible with the new Twitter API 1.1 and provides full OAuth authentication via the WordPress admin area.

= Usages =

1. At first, Install and activate the plugin.
2. Go to `Dashboard >> Appearance >> Widgets` and you will find a widget `Latest Tweets` click on it and select at which Widget Area you want to show it.
3. Fill Widget detail and click `Save`.
4. You need Consumer Key, Consumer Secret, Access Token and Access Token Secret.

To get this create an account at [Twitter Developers](https://apps.twitter.com/app/new).

== Installation ==

Installing the plugins is just like installing other WordPress plugins. If you don't know how to install plugins, please review the two options below:

Install by Search

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Search for 'Display Latest Tweets' a plugin will come called 'Display Latest Tweets by Sayful Islam' and Click 'Install Now' and confirm your installation by clicking 'ok'
* The plugin will download and install. Just click 'Activate Plugin' to activate it.

Install by ZIP File

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Select 'Upload' from the set of links at the top of the page (the second link)
* From here, browse for the zip file included in your plugin titled 'display-latest-tweets.zip' and click the 'Install Now' button
* Once installation is complete, activate the plugin to enable its features.

Install by FTP

* Find the directory titles 'display-latest-tweets' and upload it and all files within to the plugins directory of your WordPress install (WORDPRESS-DIRECTORY/wp-content/plugins/) [e.g. www.yourdomain.com/wp-content/plugins/]
* From your WordPress dashboard, choose 'Installed Plugins' option under the 'Plugins' category
* Locate the newly added plugin and click on the 'Activate' link to enable its features.


== Frequently Asked Questions ==
Do you have questions or issues with Display Latest Tweets? [Ask for support here](http://wordpress.org/support/plugin/display-latest-tweets)

== Screenshots ==

1. Screenshot of Display Latest Tweets Widget
2. Screenshot of Display Latest Tweets Widget Front-end at Twenty Fifteen theme

== Changelog ==

= 2.1.0 - 2018-02-16 =
* Feature - Add transient option replacing cache option to improve performance.
* Add - Add transient duration option.
* Dev - Update Twitter_API_WordPress core code.
* Dev - Update Display_Latest_Tweets_Widget core code.


= 2.0.0 - 2017-06-16 =
* New     - Add cache option to improve performance
* Updated - Update core code with latest WordPress API
* Updated - Replaced TwitterAPIExchange class with custom Twitter_API_WordPress class
* Tweak   - Some tweak over css

= version 1.3.0 =
* Update code with latest WordPress standard

= version 1.2 =
* Added some style.

= version 1.1 =
* Fixed some bug to work perfectly at latest WordPress version.
* Making it translation ready.

= version 1.0 =
* Implementation of basic functionality.