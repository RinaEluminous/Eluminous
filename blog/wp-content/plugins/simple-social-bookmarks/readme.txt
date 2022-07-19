=== Social Bookmarks ===
Contributors: dartiss
Tags: bookmark, share, social, link, network, facebook, google+, pinterest, twitter
Requires at least: 4.6
Tested up to: 4.8
Stable tag: 3.2.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Social Bookmarks adds icons to your posts and/or pages that allow your visitors to easily submit them on social bookmarking and network sites.

== Description ==

**If upgrading from a version before 3.2 and you have used your own bookmarks then you must move the folder from your theme folder to `wp-content` - see the FAQ for more details**

Social Bookmarks is an easy but powerful way to implement social bookmarking on your WordPress blog. The plugin will display a row of social bookmarking icons wherever you add its code - for an individual post and page or in a sidebar. They are split between bookmarking services and tools (e.g. printing, converting to PDF, etc).

Key features include...

* Links to over 270 social bookmarking networks - more than any other plugin!
* Many non-English bookmarking sites are included - particularly Russian, Chinese and Japanese
* No administration screens and no translation therefore required
* Displays links to useful tools as well as social services
* Style and alternative image options allow for various animation effects
* Output can be cached to minimize impact to your website
* Icons provided for all bookmarking services, but you can specify your own
* Shortcode available for adding inline within a post or page
* And much, much more!

Technical specification...

* Licensed under [GPLv2 (or later)](http://wordpress.org/about/gpl/ "GNU General Public License")
* Designed for both single and multi-site installations
* PHP7 compatible
* Fully internationalized, ready for translations **If you would like to add a translation to his plugin then please head to our [Translating WordPress](https://translate.wordpress.org/projects/wp-plugins/simple-social-bookmarks "Translating WordPress") page**

For the latest known issue and planned enhancements, please see [my Bug Tracker site](https://artiss.uk/bugtracker/index.php?project=13 "Bug Tracker") site.

== Adding the function to your theme ==

The code for Social Bookmarks should be added to your theme's code, where required. In the case of posts this should be within "the loop". Here is an example on use...

`<?php echo social_bookmarks( 'iconfolder=24x24', 'padding-left: 5px; padding-right: 5px' ); ?>`

There are 5 parameters in total that can be specified, but all are optional.

The first parameter can contain a number of options, all of which are separated by an ampersand. These options are as follows...

**default=** : This should be `on`, `off` or `basic` and defines which social bookmarks should display by default. `on` means all should display, `off` means none should be displayed and `basic` shows a basic few. Not specifying this sub-parameter will cause the basic set to be displayed.

**iconfolder=** : If not specified, a default set of 16x16 pixel icons will be used. If, however, you'd like to use your own icons then you will need to add a sub-folder in `wp-content` and then use this parameter to specify the sub-folders name. In the above example, I am specifying a sub-folder named `24x24`. Icons should all have a `.PNG` extension and the file names must match the bookmarking service name, as specified below. Bookmarking services are shown first and tools afterwards.

**priority=** : Allows you to specify whether a bookmark link should be via AddThis (1), Shareaholic (2) or AddtoAny (3) (if a link via more than one is available). This is defined by providing a series of numbers representing the order of the services. So, a priority of 231 would be Shareaholic first, followed by AddToAny and then AddThis. The default priority is 123.

**nofollow=** : By default, `REL=NOFOLLOW` will be added to all links. However, if this is specified as `NO` then this will be deactivated.

**target=** : Allows you to specify a `TARGET`. By default this is not used.

**separator=** : If you wish to display a separator image between the bookmark and icon lists then you must specify `separator=Yes`. An image named `separator.png` will then be displayed. If using your own folder for images then this image will be required as well.

**id=** : If using the animation option (see the later section) then a unique ID must be specified for each set of social bookmarks on the screen. If there is only one set of bookmarks per post and page, then the best option is to pass the post ID via `get_the_ID()`. By default, no ID is specified so animation is turned off.

**cache=** : This indicates how long, in hours, to cache the output. If nothing is specified, 24 hours is assumed. To switch off caching set this to `false`.

There are also options for EACH of the social bookmarking services allowing you to specify whether they should be turned on or off. So, for example, to turn Digg off, you would specify `digg=off`.

So, as a further example, if you ONLY wanted the Delicious and Digg bookmarks to appear, it would be best to specify the `default` as `off` and then turn Delicious and Digg on individually, like so...

`<?php echo social_bookmarks( 'default=off&delicious=on&digg=on' ); ?>`

The full list of social bookmark services are listed separately. However, the basic set of services are as follows...

Delicious, Digg, Facebook, Google+, LinkedIn, Pinterest, reddit, StumbleUpon, Twitter, Email and Print Friendly (Print)

The second parameter is a style definition which applies to the bookmark icons. This should, where possible, not be used in preference to using CSS definitions. Instead each element generated has a `class` of `ssb` so that it can be defined via your own stylesheet. The separator `class` is `ssb_sep`.

The third parameter is the URL that you wish the social sites to bookmark. If left blank (and this is probably the default for most people) it will use the URL of the current post or page.

The fourth parameter is where you can specify a shortened URL to bookmark (if you have one available). To maintain backward compatibility with previous version of this plugin, the URL must begin with "http" to be accepted. At the moment Twitter, Identica and Blip will be passed shortened URLs. If you think any other services should be included, please [ask in the forum](https://wordpress.org/support/plugin/simple-social-bookmarks “Forum”). If no short URL is specified then the post/page short link will be used - if this is not available then a short URL will not be used. Alternatively, set the short URL to `No` to prevent a short URL from being used at all.

Finally, the fifth parameter is an optional title - if this is not specified the title of the current page or post is used.

== Using the shortcode ==

If you wish to add social bookmarks directly into a post or page you can use the shortcode `[bookmarks]`. All the same parameters as the PHP function are available and are named `url`, `shorturl`, `style`, `options` and `title`.

An example would be...

`[bookmarks options="iconfolder=24x24" style="padding-left: 5px; padding-right: 5px" url="https://artiss.blog”]`

== Adding To Your Feed ==

It's possible to add the Social Bookmarks to your WordPress feed. Open up your `functions.php` file within your theme folder and add the following code...

`<?php
function insert_rss( $content ) {
    if ( ( is_feed() ) && ( function_exists ( 'social_bookmarks' ) ) ) {
        $content = $content . '<p>' . social_bookmarks( 'iconfolder=16x16', 'padding-left: 2px; padding-right: 2px' ) . '</p>';
    }
    return $content;
}
add_filter( 'the_content', 'insert_rss' );
?>`

Obviously, you will need to modify the parameters that are passed to the Social Bookmarks plugin, to make it appropriate for yourself. In the above example you may notice that I'm using an alternative set of icons with a small padded space between them.

== Animation ==

A basic animation option is available and is switched on by providing a unique ID parameter (see earlier details).

Once specified, hovering over a bookmark option will switch it from the standard icon to another with `_hov` on the end.

For instance, hovering over `twitter.png` will switch the image to `twitter_hov.png`. When you move away, it will return to the original image. This extra image will need to exist in the same folder as the first.

However, although basic, it can be used for all sorts of effects, such as black & white icons becoming colored when hovered over or icons that expand in size.

Here is an example where I'm switching on the animation option by specifying a unique ID...

`<?php echo social_bookmarks( 'separator=Yes&id=' . get_the_ID(), 'padding-left: 2px; padding-right: 2px' ); ?>`

Animation can also be performed by modifying the stylesheet. The following example will cause the images to move up by 5 pixels whenever they are hovered over, in a similar way to the SexyBookmarks or Simple Social plugins.

`.ssb img, .ssb_sep {
    padding-top: 5px;
    padding-bottom: 0;
    padding-left: 5px;
    padding-right: 5px
}
.ssb img:hover {
    padding-top: 0;
    padding-bottom: 5px;
}`

== Installation ==

Social Bookmarks can be found and installed via the Plugin menu within WordPress administration (Plugins -> Add New). Alternatively, it can be downloaded from WordPress.org and installed manually...

1. Upload the entire `simple-social-bookmarks` folder to your `wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress administration.

Voila! It's ready to go.

== Available Bookmarking Services ==

Any of the following bookmarking service codes can be used...

100zakladok, 7live7, a1webmarks, addthis, addtoany, adfty, adifni, allvoices, amazon_ca, amazon_de, amazon_fr, amazon_jp, amazon_uk, amazon_us, aollifestream, armenix, arto, azadegu, baang, baidu, balatarin, barrapunto, bebo, bibsonomy, biggerpockets, bitacoras, bland, blinklist, blip, blogger, bloggy, blogkeen, bloglines, blogmarks, blogpoint, blogtercimlap, blurpalicious, bobrdobr, bolt, bonzobox, bookmark_it, socialbookmarkingnet, bookmarks_fr, bookmarky_cz, boxdotnet, bryderi, businessweek, buzzurl, care2, choix, citeulike, comments, connotea, corank, cosmiq, current, dailyme, dealsplus, delicious, designbump, diaspora, digg, diggita, diggitsport, dihitt, diigo, dipdive, domelhor, dotnetkicks, douban, draugiem, dzone, edelight, efactor, ekudos, elefantapl, evernote, ezyspot, facebook, informazione, fark, faves, favoriten_de, fc2bookmark, flaker, folkd, formspring, thefreedictionary, fresqui, friendfeed, friendster, funp, gamekicker, ghidoo, givealink, globalgrind, govn, godudu, googlebookmarks, googlebuzz, reader, googleplus, grono, gwar, habergentr, hackernews, hadashhot, haohao, hatena, healthimize, hedgehogs, hellotxt, hotklix, hyves, icio, identica, igoogle, iwiw, jamespot, jappy, jolly, jumptags, kaboodle, kaixin, ketnooi, kledy, laaikit, ladenzeile, latafaneracat, linkninja, linkagogo, linkarena, linkedin, linkter, linkuj, livedoor, livejournal, mawindo, meinvz, mekusharim, memori, mendeley, meneame, messenger, misterwong, misterwong_de, mixx, moemesto, moikrug, mototagz, msdn, msnreporter, multiply, muti, mymailru, myaol, myhayastan, mylinkvault, myshare, myspace, n4g, netlog, netvibes, netvouz, newsing, newsmeback, newstrust, newsvine, niftyclip, ning, naszaklasa, nowpublic, nujij, odnoklassniki, oknotizie, oneview, orkut, pfbuzz, pingfm, pinterest, plaxo, plurk, pochvalcz, posterous, pratiba, preferate, proddit, pusha, quantcast, readitlater, readwriteweb, reddit, rediff, redkum, researchgate, scoopat, scoopit, scoopeo, sekoman, select2gether, shaveh, shetoldme, sinaweibo, skyrock, slashdot, smiru, socl, socialdust, sodahead, sonico, soupio, sphinn, sportpost, springpad, spurl, squidoo, startlap, strands, studivz, stumbleupon, stylehive, supr, svejo, swik, taaza, tagmarksde, tagvn, tagza, techmeme, technet, technorati, thinkfinity, thisnext, tuenti, tulinq, tumblr, tweetmeme, twitter, typepad, upnews, urlaubswerkde, viadeo, virb, visitezmonsite, vk, vkrugudruzei, vodpod, vybralisme, webmoneyru, webnews, webnews_de, wikio, wikio_fr, wikio_it, winlivespaces, windycitizen, wink, wists, wordpress, wykop, xanga, xing, yahoobookmarks, yahoobookmarks_jp, yahoobuzz, yahoomessenger, yandex, yardbarker, yemle, yigg, yuuby, zakladoknet, ziczac, zilei, zingme and zootool.

In addition, the following tools can be specified....

2tag, bookmark, aolmail, aviarycapture, bitly , cleanprint, clickyme, clipdo, curateus, domaintoolswhois, email, gmail , googletranslate, hootsuite, hotmail, instapaper, isgd, jmp, joliprint, kindleit, osxdashboard, page2rss, pdfmyurl, pdfonline, printfriendly, qrf_in, qrsrc, tidyread, tinyurl, toly, w3validator, windowsgadgets and yahoomail.

== Reviews & Mentions ==

"[David Artiss brings version 3.0 of the Simple Social Bookmarks plugin](http://wpcandy.com/reports/simple-social-bookmarks-plugin-version-3-0 "David Artiss brings version 3.0 of the Simple Social Bookmarks plugin")" at WPCandy.

"I think this is the best social plugin at this very moment, keep up your good job, and thanks for sharing." - Miguel, a happy Social Bookmarks customer!

== Frequently Asked Questions ==

= I'm upgrading from a version prior to 3.2. What do I need to do? =

If you don't use your own bookmark icons, nothing. Otherwise, the default folder location has changed - this is so that upgrading a theme doesn't cause them to go missing. Simply move your icon folder to your installations `wp-content` folder for it to continue to work.

= The Social Bookmarking site is not appearing =

If you've not specified `default=on` then new sites will not appear - you will need to specifically switch it on.

Here's an example of switching on LinkaGoGo...

`<?php echo social_bookmarks( 'linkagogo=on', 'padding-left: 5px; padding-right: 5px' ); ?>`

= Where can I find some alternative icons? =

The icons provided with the plugin are the standard icons for each of the sites (usually the site's favicon). There are many good, free collections available. However, none have the full set that this plugin uses, which is why I use this generic group.

None-the-less, most people will probably only want to display a few, popular, sites and therefore various icon collections will be ideal.

My favorites include [Vector Social Media Icons](http://icondock.com/free/vector-social-media-icons "Vector Social Media Icons") by IconDock and [Social Network Icon Pack](http://www.komodomedia.com/download/ "Social Network Icon Pack") by Komodo Media.

Alternatively, read [75 Beautiful Free Social Bookmarking Icon Sets](http://www.bloggodown.com/2009/07/75-beautiful-free-social-bookmarking.html "75 Beautiful Free Social Bookmarking Icon Sets") from Blog Godown or [21 Sets of Free Social Bookmarking Icons for Your Blog](http://www.wpzoom.com/design/21-sets-of-free-social-bookmarking-icons-for-your-blog/ "21 Sets of Free Social Bookmarking Icons for Your Blog") from wpzoom.

= You haven't included my favorite Social Bookmarking service =

I keep a huge database of over 500 bookmarking services. However, I only use those that appear to be the most popular, based on Google search results. If you think I have missed one of great importance, please request it on the forum and plead your case!

== Screenshots ==

1. An example of the plugin in use, showing color and movement animation
2. A full list of the default icons

== Changelog ==

[Learn more about my version numbering methodology](https://artiss.blog/2016/09/wordpress-plugin-versioning/ "WordPress Plugin Versioning")

= 3.2.8 =
* Maintenance: README revised to better reflect new plugin directory
* Maintenance: The minimum level of WordPress required is now 4.6, allowing some code to be excised, including the languages folder
* Maintenance: Shortcode is loaded at all times, not just when outside of the admin. Doing otherwise adds no benefit
* Maintenance: Website links corrected
* Maintenance: All the icons have been compressed. Again. Because you can’t have too much lossless image compression

= 3.2.7 =
* Maintenance: Added text domain and domain path as well as correcting the domain name

= 3.2.6 =
* Enhancement: Added internationalization

= 3.2.5 =
* Maintenance: Updated support forum link

= 3.2.4 =
* Maintenance: Added Microsoft's So.cl

= 3.2.3 =
* Maintenance: Fixed Google+ AddThis link - it would be helpful if AddThis documentation was correct!
* Maintenance: AddThis has withdrawn their bookmark to their own site! Removed and replaced with a URL script that will do it instead!

= 3.2.2 =
* Bug: Key used for caching wasn't using the final URL and title, but only the one passed (if one was passed) - this mean that the same cache could be used for multiple posts

= 3.2.1 =
* Bug: Deprecated functions hadn't been included

= 3.2 =
* Maintenance: Brought code up to standards, including splitting code
* Maintenance: Reviewed all bookmark services from scratch. There are now 275 services and 33 tools. Add to Bookmarks, Google+ and Pinterest have been added as defaults
* Maintenance: Modified some of the code in preparation for the next big release
* Enhancement: Plugin would not work on WP before version 3. Improved this to 2.6 and documented
* Enhancement: Default image folder is now wp-content/social-bookmarks
* Enhancement: Added option to not have short URL generated
* Enhancement: Added Google Analytics tracking
* Enhancement: Added option to add to your own bookmarks (service name `bookmark`)
* Enhancement: Added caching of output

= 3.1.2 =
* Added child theme compatibility - users own icon folder can be added to the child theme
* Fixed Google+ - previous link was a temporary solution after Google+ was initially released

= 3.1.1 =
* Enhancement: Added Elefanta.pl, Fresqui, Gamekicker, Google+, Hao Hao Report, Hellotxt, Hyves, LaTafanera, Link-a-go-go, meinVZ, Netvouz, NewsTrust, She Told Me, Sportpost, Springpad, Strands, Tagmarks.de, Tagza, Techmeme and Zilei. There are now 238 services available

= 3.1 =
* Bug: Corrected ampersand in AddToAny URL to ensure code is XHTML valid
* Enhancement: If no short URL is specified the WordPress shortlink will be used
* Enhancement: Ability to specify own titles as well as URL
* Enhancement: Added a shortcode option

= 3.0 =
* Maintenance: Another re-write of the base code
* Maintenance: Split bookmark service definition function to a separate file
* Maintenance: Improved the instructions and spell checked them for once!
* Enhancement: There are now 218 bookmarking services and 23 tools available
* Enhancement: Now uses AddToAny, AddThis and Shareaholic for the majority of links
* Enhancement: Removed use of Simple URL Shortener plugin - you now pass the shortened URL yourself, allowing any shortening plugin to be used
* Enhancement: Output HTML comments containing plugin information
* Enhancement: Added new parameter - priority - to allow user to give priority to one sharing service
* Enhancement: New default icons
* Enhancement: Existing icon filenames changed (ffeed is now friendfeed, ybuzz is now yahoobuzz, gbuzz is now googlebuzz and print is now printfriendly)
* Enhancement: The bookmark service previously named ping.fm is now named pingfm
* Enhancement: Removed Twitter text parameter (no longer used) and replaced with the ability to pass a shortened URL
* Enhancement: Propeller has been removed as it is no longer available
* Enhancement: Separated bookmarks and tools - added optional new separator icon
* Enhancement: Used smush.it to compress images (23% average reduction)
* Enhancement: The default is now for `REL=NOFOLLOW` to be on for all links generated to ensure maximum SEO optimization.
* Enhancement: The default for the `target` is now for it not to be specified (and therefore be XHTML valid)
* Enhancement: Added a default CLASS to all elements plus an ID to the images
* Enhancement: Added basic animation effect, allowing you to switch between two images

= 2.0 =
* Maintenance: Re-written base code
* Maintenance: Help file re-written
* Enhancement: Added LOTS of new social services

= 1.8 =
* Enhancement: Added new, official, link for Google Buzz

= 1.7 =
* Enhancement: Icon folders are now stored in the theme directory, to prevent them from being deleted whenever the plugin is updated
* Enhancement: API key and user details can now be passed to shortening services
* Enhancement: Added new 'default' parameter setting - this should not impact existing installation unless you've explicitly requested 'default=on'

= 1.6 =
* Enhancement: Added Yahoo! Bookmarks, Yahoo! Buzz and Google Buzz to the list of providers. By default these will be turned off (including using the default=on option) so as to not to suddenly appear on existing installs

= 1.5 =
* Enhancement: Use different encoding for email links
* Enhancement: Added Technorati to the list of providers. By default this will be turned off (including using the default=on option) so as to not to suddenly appear on existing installs.

= 1.4 =
* Maintenance: Removed caching, as this is now handled by [Simple URL Shortener](http://wordpress.org/extend/plugins/simple-url-shortener/ "Simple URL Shortener"). Please ensure you update to the latest version of this plugin to ensure that caching continues to work - once you know it does, the cache folder for this plugin can be removed
* Maintenance: Tidied code and updated shared functions
* Enhancement: Added additional parameter - cache=

= 1.3 =
* Enhancement: Updated default icons to a set kindly provided by komodomedia.com (With the exception of the AddToAny and Ping.FM icons)
* Enhancement: Added AddToAny, Ping.fm, Google Bookmarks, Google Reader and email to the list of providers. By default these will be turned off so as to not to suddenly appear on existing installs and cause problems!
* Enhancement: Further improvement to blog title issues
* Enhancement: Removed URL shortening on all services with the exception of Twitter, as it was not required and may have even have caused some issues (such as some services not being able to get hold of thumbnails and general page content).
* Enhancement: Now using [Simple URL Shortener](http://wordpress.org/extend/plugins/simple-url-shortener/ "Simple URL Shortener") plugin to provide URL shortening
* Enhancement: Caching of short URLs now takes place providing large performance improvements
* Enhancement: NOFOLLOW and TARGET parameters added
* Enhancement: Compressed default icons

= 1.2 =
* Bug: Fixed issue with ampersands (and probably other characters) in the blog title causing linking issues
* Enhancement: Added su.pr as another URL shortening service

= 1.1 =
* Enhancement: Now XHTML compliant

= 1.0 =
* Initial release

== Upgrade Notice ==

= 3.2.8 =
* A minor maintenance release