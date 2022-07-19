<?php
/* 
Plugin Name: Share and Follow
Plugin URI: http://share-and-follow.com/wordpress-plugin/
Version: 1.53.1
Author: Andy Killen
Author URI: http://phat-reaction.com
Description: A simple plugin to manage sharing and following. We've just made it so that you can have icons sets delivered via our CDN -ultra~fast~stuff-, why not <a href="http://share-and-follow.com/wordpress-plugin/what-do-you-want/" >tell us what you want next</a>, or join the <a href="http://twitter.com/shareandfollow/" >twitter feed</a> or <a href="http://www.facebook.com/pages/Share-and-Follow/115725341775417">facebook page</a> to findout what's going on.  Soon to come, mobile device support, so you can choose how things are presented to a range of mobile devices. <br />  <a href="options-general.php?page=share-and-follow.php">Options &amp; configuration</a> | <a href="http://share-and-follow.com/wordpress-plugin/" >Documentation</a> | <a href="http://share-and-follow.com/wordpress-plugin/support/" >Support</a> | <a href="http://share-and-follow.com/wordpress-plugin/suggest-a-share-or-follow-social-network-to-us/" >Tell us about social network we should add</a> | <a href="http://share-and-follow.com/wordpress-plugin/suggest-a-share-or-follow-social-network-to-us/" >Let us know what icon set to add next to the CDN</a>
Copyright 2010 Andy Killen  (email : andy  [a t ] phat hyphen reaction DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

    please note that under the GNU GPL license only the code is usable,
    the images are not part of the code and therefore under seperate
    copyrights and licensing.

*/

// setup some constants 
$phpVersion = explode('.',phpversion());
if (!class_exists("ShareAndFollow")) {
	class ShareAndFollow {
            var $adminOptionsName = "ShareAndFollowAdminOptions";
                //
                // class constructor
                //
		function ShareAndFollow() { 
		}
		function init() {
			$this->getAdminOptions();
                        $this->getCDNsets();
                }
                //
                // function to run when activating the plugin and upgrading as it activates then also
                //
                function activate() {
                    
                       $optionname = "ShareAndFollowAdminOptions";
                       $devOptions = get_option($optionname);
                       if (!isset($devOptions['css_follow_images'])||empty($devOptions['css_follow_images']) ){
                           $devOptions['css_follow_images'] = 'yes';
                       }
                       $devOptions['cssid']=1;
                       update_option ($optionname, $devOptions);
                }


		function stylesheet_loader($name, $media){
                        $myStyleUrl = WP_PLUGIN_URL . "/share-and-follow/css/".$name.".css" ;
                        $myStyleFile = WP_PLUGIN_DIR . "/share-and-follow/css/".$name.".css" ;
                            if ( file_exists($myStyleFile) ) {
                                wp_register_style("share-and-follow-".$name."" , $myStyleUrl,array(),1,"".$media."" );
                                wp_enqueue_style( "share-and-follow-".$name."");
                            }
                    }

		 function stylesheetAutoloader(){
                        $sheets = array('stylesheet'=>'screen',
                                        'print'=>'print',
                                        );
                        foreach ($sheets as $name => $media){
                        $myStyleUrl = WP_PLUGIN_URL . "/share-and-follow/css/".$name.".css" ;
                        $myStyleFile = WP_PLUGIN_DIR . "/share-and-follow/css/".$name.".css" ;
                            if ( file_exists($myStyleFile) ) {
                                wp_register_style("share-and-follow-".$name."" , $myStyleUrl,array(),1,"".$media."" );
                                wp_enqueue_style( "share-and-follow-".$name."");
                            }
                    }
		 } 
                //
                // get an image from the wordpress image library to be the share image url
                //
                function getPostImage($postID)
                    {
                        $image_src = ShareAndFollow::findMetaImageURL($postID); // check for existing metadata
                            if (!$image_src){
                            $photos = get_children( array('post_parent' => $postID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
                            // DOES NOT WORK IF ALL IMAGES ARE JUST HTML NEEDS CMS LIBRARY
                            //
                            if($photos)
                            {
                                    $theImages = array_keys($photos);
                                    $iNum=$theImages[0];
                                    $sThumbUrl = wp_get_attachment_url($iNum);
                            }
                            if(!isset($sThumbUrl) || empty($sThumbUrl)) //default to site image if none there
                            {
                                $devOptions = $this->getAdminOptions();
                                if (isset($devOptions['logo_image_url'])){$sThumbUrl=$devOptions['logo_image_url'];}

                            // DEFAULTS to author gravatar, then site image, needs to be added
                            //
                            }
                            // return image url
                            return $sThumbUrl ;
                            }
                            else {return $image_src;}
                    }
                function findMetaImageURL($post_ID){
                    $image_src = get_post_meta($post_ID, 'image_src', true);
                    if (empty($image_src) || !isset($image_src)){return false;}
                    else {return $image_src;}
                }
                //
                //shows follow links on the page top/bottom/left/right
                //
                function show_follow_links(){
                $devOptions = $this->getAdminOptions();
                if ($devOptions['add_follow'] == "true") {
                    $include_page = "yes";
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    if (!empty($devOptions['excluded_follow_pages'])){// exclude pages
                        $arr = explode(",", $devOptions['excluded_follow_pages']);
                        foreach ($arr as $value){
                            if ($value == $curauth->ID){$include_page="";}
                        }
                    }
                    if ( is_page()&&$devOptions['follow_page']=='no'){}
                    elseif ( is_single()&&$devOptions['follow_post']=='no'){}
                    elseif ( is_archive()&&$devOptions['follow_archive']=='no'){}
                    elseif ( is_home()&&$devOptions['follow_home']=='no'){}
                    elseif ( is_author()&&$devOptions['follow_author']=='no'){}
                    elseif ($include_page == ""){}
                    elseif (is_feed()){}
                    else {
                $items =array('spacing','word_value','word_text','add_follow','add_css',
            );
                $args=array('list_style'=>$devOptions['follow_list_style'],  'size'=>$devOptions['tab_size'],'add_content'=>'true', 'spacing'=>$devOptions['spacing'],'follow_location'=>$devOptions['follow_location'],'add_follow_text'=>$devOptions['add_follow_text'],
                                'word_value'=>$devOptions['word_value'],'word_text'=>$devOptions['word_text'],'add_follow'=>$devOptions['add_follow'],'add_css'=>$devOptions['add_css'],'follow_rss'=>$devOptions['follow_rss'],'rss_text'=>$devOptions['rss_link_text'],'css_images'=>$devOptions['css_follow_images'],);
                            global $allSites;
                            foreach ($allSites as $item => $value){
                                if(strstr($value['service'],"follow")){
                                    $args['follow_'.$item] = $devOptions['follow_'.$item];
                                    $args[$item.'_link'] = $devOptions[$item.'_link'];
                                    $args[$item.'_text'] = $devOptions[$item.'_link_text'];
                                }
                   }
                   follow_links($args);  // does the follow links tab from the args above
                 }
                }
            }

            //
            //
            //
            function return_defaults(){
                $array = array( 'cdn-key'=>'', 'cdn'=>'', 'icon_set'=>'default','top_padding'=>'','print_support'=>'true','rss_style'=>"rss_url",
                                'nujij'=>'',                            'nujij_share_text'=>'Share on nuJIJ',                          'nujij_popup_text'=>'Share this BLOG : TITLE on nuJIJ',
                                'bookmark'=>'',                         'bookmark_share_text'=>'Bookmark in Browser',                          'bookmark_popup_text'=>'Bookmark this BLOG : TITLE',
                                'sphinn'=>'',                           'sphinn_share_text'=>'Share this on sphinn',                       'sphinn_popup_text'=>'Share this BLOG : TITLE on sphinn',
                                'show_header' => 'true',                'iconset' => 'default',                  'follow_location'=>'right',             'background_color'=>'878787',
                                'border_color'=>'fff',                  'follow_color'=>'000',                   'extra_print_css'=>'',                  'content' => '',
                                'twitter_text_suffix'=>'',              'width_of_page_minimum'=>'',
                                'extra_css'=>'',                        'excluded_share_pages'=>'',              'list_style'=>'iconOnly',               'size'=>'32',
                                'spacing'=>'3',                         'add_content'=>'true',                   'add_follow'=>'true',                   'add_css'=>'false',
                                'post_rss'=>'yes',                      'facebook' => 'yes',                     'twitter'=>'yes',                       'stumble' => 'yes',
				'digg'=> 'yes',                         'reddit'=> 'yes',                        'hyves' => '',                          'delicious'=>'yes',
                                'print'=>'',                            'orkut'=>'',                             'myspace'=>'',                          'google_buzz'=>'',
                                'yahoo_buzz'=>'',                       'yahoo_buzz_link'=>'',                   'google_buzz_link'=>'',                 'youtube'=>'',
                                'linkedin'=>'',                         'dailymotion_link'=>'',                  'soundcloud_link'=>'',                  'foursquare_link'=>'',
                                'vkontakte_link'=>'',                   'plaxo_link'=>'',                        'coconex_link'=>'',                     'gowalla_link'=>'',
                                'xing_link'=>'',                        'twitter_suffix'=>'',                    'vimeo_link'=>'',                       'distance_from_top'=>'100',
                                'follow_list_spacing' =>'10',           'vkontakte'=>'',                         'mixx'=>'',                             'email'=>'',
                                'tumblr_link'=>'',                      'tumblr'=>'',                            'email_link'=>'',                       'email_body'=>'',
                                'facebook_link' => '',                  'twitter_link'=>'',                      'stumble_link' => '',                   'digg_link'=> '',
                                'reddit_link'=> '',                     'hyves_link' => '',                      'delicious_link'=>'',                   'orkut_link'=>'',
                                'myspace_link'=>'',                     'rss_link'=>'',                          'newsletter_link'=>'',                  'follow_newsletter'=>'',
                                'cssid'=>'1',                           'add_follow_text'=>'true',               'word_value'=>'follow',                 'theme_support'=>'none',
                                'follow_list_style'=>'iconOnly',        'follow_facebook' => '',                 'follow_twitter'=>'',                   'follow_stumble' => '',
				'follow_digg'=> '',                     'follow_reddit'=> '',                    'follow_hyves' => '',                   'follow_delicious'=>'',
                                'follow_orkut'=>'',                     'follow_myspace'=>'',                    'follow_lastfm'=>'',                    'follow_flickr'=>'',
                                'lastfm'=>'',                           'follow_google_buzz'=>'',                'follow_linkedin'=>'',                  'follow_tumblr'=>'',
                                'follow_yelp'=>'',                      'follow_xfire'=>'',                      'follow_yahoo_buzz'=>'',                'follow_vkontakte'=>'',
                                'follow_plaxo'=>'',                     'follow_gowalla'=>'',                    'follow_xing'=>'',                      'twitter_text_default'=>'',
                                'follow_dailymotion'=>'',               'follow_soundcloud'=>'',                 'follow_vimeo'=>'',                     'follow_coconex' => '',
                                'follow_rss'=>'yes',                    'follow_youtube'=>'',                    'tab_size'=>'24',                       'css_images'=>'no',
                                'wp_post'=>'yes',                       'wp_page'=>'yes',                        'wp_home'=>'yes',                       'wp_archive'=>'yes',
                                'wp_author'=>'yes',                     'bit_ly'=>'',                            'bit_ly_code'=>'',                      'follow_foursquare'=>'',
                                'twitter_text'=>'clean',                'add_image_link'=>'true',                'default_email'=>'',                    'word_text'=>__('follow:','share-and-follow'),
                                'default_email_image'=>'',              'author_defaults'=>'authors',            'logo_image_url'=>'',                   'homepage_img'=>'logo',
                                'homepage_image_url'=>'',               'archive_img'=>'logo',                   'archive_image_url'=>'',                'page_image_url'=>'',
                                'post_image_url'=>'',                   'page_img' =>'logo',                     'post_img' =>'gravatar',                'share_text'=>__('share:','share-and-follow'),
                                'share'=>'no',                          'lastfm_link'=>'',                       'flickr_link'=>'',                      'linkedin_link'=>'',
                                'xfire_link'=>'',                       'yelp_link'=>'',                         'background_transparent'=>'no',         'border_transparent'=>'no',
                                'youtube_link'=>'',                     'css_print_excludes'=>'#menu, #navigation, #navi, .menu',
                                'follow_digg'=>'',                      'digg_link'=>'',                          'follow_posterous'=>'',                'follow_ya'=>'',
                                'posterous_link'=>'',                   'ya_link'=>'',                            'css_follow_images'=>'no',
                                'posterous_link_text'=>__('Check my phone feed','share-and-follow'),              'follow_feedburner'=>'',              'feedburner_link'=>'',
                                'technorati'=> '',                           'technorati_share_text'=>__('Share on technorati','share-and-follow'),           'technorati_popup_text'=>__('Share this BLOG : TITLE on technorati','share-and-follow'),
                                'xing'=> '',                           'xing_share_text'=>__('Share on xing','share-and-follow'),           'xing_popup_text'=>__('Share this BLOG : TITLE on xing','share-and-follow'),
                                'ya_link_text'=>__('Connect with me','share-and-follow'),
                                'follow_slideshare'=>'',                'slideshare_link_text'=>__('See my presentations','share-and-follow'), 'slideshare_link'=>'',

                                'follow_wordpress'=>'',           'wordpress_link_text'=>__('Me on wordpress','share-and-follow'), 'wordpress_link'=>'',
                                'follow_technet'=>'',             'technet_link_text'=>__('My technical items','share-and-follow'), 'technet_link'=>'',
                                'follow_squidoo'=>'',             'squidoo_link_text'=>__('Check me on Squidoo','share-and-follow'), 'squidoo_link'=>'',
                                'follow_plurk'=>'',               'plurk_link_text'=>__('Connect with me on Plurk','share-and-follow'), 'plurk_link'=>'',
                                'follow_meetup'=>'',              'meetup_link_text'=>__('Come to the Meeting','share-and-follow'), 'meetup_link'=>'',
                                'follow_getglue'=>'',             'getglue_link_text'=>__('Wanna see my stickers?','share-and-follow'), 'getglue_link'=>'',
                                'follow_ning'=>'',                'ning_link_text'=>__('Wanna see my stickers?','share-and-follow'), 'ning_link'=>'',

                                'follow_bebo'=>'',                'bebo_link_text'=>__('Find me on Bebo','share-and-follow'), 'bebo_link'=>'',
                                'follow_faves'=>'',               'faves_link_text'=>__('See my Faves','share-and-follow'), 'faves_link'=>'',
                                'follow_identica'=>'',            'identica_link_text'=>__('Connect with me on identi.ca','share-and-follow'), 'identica_link'=>'',
                                'follow_bandcamp'=>'','follow_deviantart'=>'','follow_imdb'=>'', 'follow_itunes'=>'','follow_moddb'=>'','follow_picasa'=>'','follow_sphinn'=>'',
                                'bandcamp_link'=>'','deviantart_link'=>'','imdb_link'=>'', 'itunes_link'=>'','moddb_link'=>'','picasa_link'=>'','sphinn_link'=>'',


                                'bebo'=> '',               'bebo_share_text'=>__('Share on bebo','share-and-follow'),          'bebo_popup_text'=>__('Share this BLOG : TITLE on bebo','share-and-follow'),
                                'identica'=> '',           'identica_share_text'=>__('Share on identica','share-and-follow'),  'identica_popup_text'=>__('Share this BLOG : TITLE on identica','share-and-follow'),
                                'dzone'=> '',              'dzone_share_text'=>__('Share on dzone','share-and-follow'),        'dzone_popup_text'=>__('Share this BLOG : TITLE on dzone','share-and-follow'),
                                'fark'=> '',               'fark_share_text'=>__('Share on fark','share-and-follow'),          'fark_popup_text'=>__('Share this BLOG : TITLE on fark','share-and-follow'),
                                'faves'=> '',              'faves_share_text'=>__('Share on faves','share-and-follow'),        'faves_popup_text'=>__('Share this BLOG : TITLE on faves','share-and-follow'),
                                'linkagogo'=> '',          'linkagogo_share_text'=>__('Share on linkagogo','share-and-follow'),'linkagogo_popup_text'=>__('Share this BLOG : TITLE on linkagogo','share-and-follow'),
                                'mrwong'=> '',             'mrwong_share_text'=>__('Share on mrwong','share-and-follow'),      'mrwong_popup_text'=>__('Share this BLOG : TITLE on mrwong','share-and-follow'),
                                'netvibes'=> '',           'netvibes_share_text'=>__('Share on netvibes','share-and-follow'),  'netvibes_popup_text'=>__('Share this BLOG : TITLE on netvibes','share-and-follow'),
                                'friendfeed'=> '',         'friendfeed_share_text'=>__('Share on FriendFeed','share-and-follow'),  'friendfeed_popup_text'=>__('Share this BLOG : TITLE on FriendFeed','share-and-follow'),
                                'friendfeed_ning'=>'',     'friendfeed_link_text'=>__('Check my feeds','share-and-follow'), 'friendfeed_link'=>'',

                                'wpsc_top_of_products_page'=>'no','wpsc_product_before_description'=>'no', 'wpsc_product_addon_after_descr'=>'no',

                                'follow_email'=>'', 'email_link_text'=>__('Sign up for emails','share-and-follow'), 'email_link'=>'',
                                'excluded_follow_pages'=>'','follow_page'=>'yes','follow_post'=>'yes','follow_archive'=>'yes','follow_home'=>'yes','follow_author'=>'yes',
                                'vkontakte_share_text'=>__('Share on vkontakte','share-and-follow'),
                                'mixx_share_text' =>__('Mixx it up','share-and-follow'),
                                'linkedin_share_text' =>__('Share on Linkedin','share-and-follow'),
                                'facebook_share_text' =>__('Recommend on Facebook','share-and-follow'),
                                'twitter_share_text' =>__('Tweet about it','share-and-follow'),
                                'tumblr_share_text' =>__('Tumblr it','share-and-follow'),
                                'stumble_share_text' =>__('Share with Stumblers','share-and-follow'),
                                'digg_share_text' =>__('Digg this post','share-and-follow'),
                                'reddit_share_text' =>__('share via Reddit','share-and-follow'),
                                'hyves_share_text' =>__('Tip on Hyves','share-and-follow'),
                                'delicious_share_text' =>__('Bookmark on Delicious','share-and-follow'),
                                'orkut_share_text' =>__('Share on Orkut','share-and-follow'),
                                'myspace_share_text' =>__('Share via MySpace','share-and-follow'),
                                'facebook_link_text' => __('Become my Facebook friend','share-and-follow'),
                                'twitter_link_text'=>__('Tweet with me','share-and-follow'),
                                'tumblr_link_text'=>__('Read my Tumbles.','share-and-follow'),
                                'xfire_link_text'=>__('Come on a mission','share-and-follow'),
                                'stumble_link_text' => __('Follow my Stumbles','share-and-follow'),
                                'hyves_link_text' => __('Become my friend on Hyves','share-and-follow'),
                                'orkut_link_text'=>__('Become Orkut Buddies','share-and-follow'),
                                'myspace_link_text'=>__('Become a myspace follower','share-and-follow'),
                                'foursquare_link_text'=>__('Follow me on FourSquare','share-and-follow'),
                                'soundcloud_link_text'=>__('Listen to my music','share-and-follow'),
                                'feedburner_link_text'=>__('Stay updated','share-and-follow'),

                                'coconex_link_text'=>__('Connect with us','share-and-follow'),
                                'plaxo_link_text'=>__('Join my address book','share-and-follow'),
                                'vkontakte_link_text'=>__('Become Friends','share-and-follow'),
                                'gowalla_link_text'=>__('Follow my actions','share-and-follow'),
                                'xing_link_text'=>__('Connect with us','share-and-follow'),

                                'sphinn_link_text'=>__('Read my posts','share-and-follow'),
                                'itunes_link_text'=>__('Listen to me','share-and-follow'),
                                'deviantart_link_text'=>__('See my artwork','share-and-follow'),
                                'moddb_link_text'=>__('Gamer? my mods','share-and-follow'),
                                'picasa_link_text'=>__('See my pictures','share-and-follow'),
                                'bandcamp_link_text'=>__('Listen to the band','share-and-follow'),
                                'imdb_link_text'=>__('Read my reviews','share-and-follow'),
                                'delicious_link_text'=>__('See what I share','share-and-follow'),
                                'digg_link_text'=>__('Digg my stuff','share-and-follow'),

                                'vimeo_link_text'=>__('Watch my videos','share-and-follow'),
                                'dailymotion_link_text'=>__('Tune to my channel','share-and-follow'),
                                'yahoo_buzz_share_text'=>__('Buzz it up','share-and-follow'),
                                'google_buzz_share_text'=>__('Buzz it up','share-and-follow'),
                                'yahoo_buzz_link_text'=>__('Follow me','share-and-follow'),
                                'lastfm_link_text'=>__('Check my tunes','share-and-follow'),
                                'google_buzz_link_text'=>__('Join my conversations','share-and-follow'),
                                'linkedin_link_text'=>__('Connect with me','share-and-follow'),
                                'yelp_link_text'=>__('Read reviews','share-and-follow'),
                                'flickr_link_text'=>__('See my photos','share-and-follow'),
                                'newsletter_link_text'=>__('Join the newsletter','share-and-follow'),
                                'rss_link_text'=>__('RSS','share-and-follow'),
                                'email_share_text'=>__('Tell a friend','share-and-follow'),
                                'email_body_text'=>__('here is a link to a site I really like. ','share-and-follow'),
                                'youtube_link_text'=>__('Subscribe to my YouTube Channel','share-and-follow'),
                                'post_rss_share_text'=>__('Subscribe to the comments on this post','share-and-follow'),
                                'print_share_text'=>__('Print for later','share-and-follow'),
                                'mixx_popup_text' => __('Share this BLOG : TITLE on Mixx','share-and-follow'),
                                'linkedin_popup_text' => __('Share this BLOG : TITLE on Linkedin','share-and-follow'),
                                'facebook_popup_text' => __('Recommend this BLOG : TITLE on Facebook','share-and-follow'),
                                'stumble_popup_text'=> __('Share this BLOG : TITLE with Stumblers','share-and-follow'),
                                'twitter_popup_text'=>__('Tweet this BLOG : TITLE on Twitter','share-and-follow'),
                                'tumblr_popup_text'=>__('Tumblr. this BLOG : TITLE ','share-and-follow'),
                                'delicious_popup_text'=>__('Bookmark this BLOG : TITLE on Delicious','share-and-follow'),
                                'vkontakte_popup_text'=>__('Share this BLOG : TITLE on vkontakte','share-and-follow'),
                                'digg_popup_text'=>__('Digg this BLOG : TITLE','share-and-follow'),
                                'reddit_popup_text'=>__('Share this BLOG : TITLE on Reddit','share-and-follow'),
                                'hyves_popup_text'=>__('Tip this BLOG : TITLE on Hyves','share-and-follow'),
                                'orkut_popup_text'=>__('Share this BLOG : TITLE on Orkut','share-and-follow'),
                                'myspace_popup_text'=>__('Share this BLOG : TITLE via MySpace','share-and-follow'),
                                'post_rss_popup_text'=>__('Follow this BLOG : TITLE comments','share-and-follow'),
                                'print_popup_text'=>__('Print this BLOG : TITLE for reading later','share-and-follow'),
                                'email_popup_text'=>__('Tell a friend about this BLOG : TITLE ','share-and-follow'),
                                'google_buzz_popup_text'=>__('Buzz up this BLOG : TITLE ','share-and-follow'),
                                'yahoo_buzz_popup_text'=>__('Buzz up this BLOG : TITLE ','share-and-follow'),

                                'blogger_popup_text'=>__('Share this BLOG : TITLE on Blogger','share-and-follow'),  'blogger'=>'',  'follow_blogger'=>'',   'blogger_share_text'=>'Blog this!',  'blogger_link' => '', 'blogger_link_text' => 'Follow me on Blogger',


                                'like_topleft'=>'no','like_topright'=>'no','like_bottom'=>'no','like_style'=>'box_count','like_width'=>__('65','share-and-follow'),'like_faces'=>'false','like_verb'=>'like',
                                'like_color'=>'light','like_font'=>'arial','bit_ly_domain'=>'','tweet_topleft'=>'no','tweet_topright'=>'no','tweet_bottom'=>'no','tweet_width'=>'65','tweet_style'=>'vertical',
                                'tweet_wpsc_top_of_products_page'=>'', 'tweet_wpsc_product_before_description'=>'', 'tweet_wpsc_product_addon_after_descr'=>'',
                                'like_wpsc_top_of_products_page'=>'', 'like_wpsc_product_before_description'=>'', 'like_wpsc_product_addon_after_descr'=>'',
                                'posterous'=>'','posterous_share_text'=>__('Share on Posterous','share-and-follow'),          'posterous_popup_text'=>__('Share this BLOG : TITLE on Posterous','share-and-follow'),
                                'tweet_via'=>'',
                                'stumble_style'=>'5','stumble_topleft'=>'','stumble_topright'=>'','stumble_bottom'=>'','stumble_wpsc_top_of_products_page'=>'', 'stumble_wpsc_product_before_description'=>'', 'stumble_wpsc_product_addon_after_descr'=>'',

                    );
                                return $array;
            }
                //
                //
                // setup defaults for all the options
                //
		function getAdminOptions() {
                        $shareAdminOptions = ShareAndFollow::return_defaults();
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$shareAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $shareAdminOptions);
			return $shareAdminOptions;
		}

                function getCSSOptions() {
                        $cssAdminOptions = array('cssid'=>'0','print'=>'','screen'=>'');
			$cssOptions = get_option("ShareAndFollowCSS");
			if (!empty($cssOptions)) {
				foreach ($cssOptions as $key => $option)
					$cssAdminOptions[$key] = $option;
			}
			update_option("ShareAndFollowCSS", $cssAdminOptions);
			return $cssAdminOptions;
		}

                //
                //  check CSS ID to see if it matches the admin screen, update settting for CSS as needed
                //
                function checkCss($devOptions){
                    $sheets = array( array('name'=>'stylesheet','id'=>$devOptions['cssid']),
                              array('name'=>'print','id'=>$devOptions['cssid']),
                    );
                    foreach ($sheets as $sheet){
                    $pd = WP_PLUGIN_DIR;
                    $fp = fopen("$pd/share-and-follow/css/".$sheet['name'].".css",'r');
                    $readLevel = fgets($fp, 999);
                    $versionStart = stripos($readLevel, '=')+1;
                    $version = substr($readLevel,$versionStart,6);
                    $version = trim($version);
                    if($sheet['id'] == $version){}
                    else {
                        require_once('create-styles.php'); // loading style maker when needed
                        $fp = fopen("$pd/share-and-follow/css/".$sheet['name'].".css",'w');
                        switch($sheet['name']){
                            case 'stylesheet':
                                fwrite($fp, $buildCss, strlen($buildCss));
                                break;
                            case 'print':
                                fwrite($fp, $printCSS, strlen($printCSS));
                                break;
                        }
                        fclose($fp);
                    }
                }
               }
               //
               // add items to head section as needed
               //

               function addHeaderCodeEndBlock () {
                   $devOptions = $this->getAdminOptions();
                    if (!empty ($devOptions['width_of_page_minimum'])){
                        wp_enqueue_script('jquery');
                        ?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {
    function tabAction(){
      if (jQuery(window).width() <= <?php echo $devOptions['width_of_page_minimum']; ?> ){
          if (jQuery("div#follow").hasClass('display_none')){}
          else {jQuery("div#follow").addClass('display_none')}
      }
      else {
          if (jQuery("div#follow").hasClass('display_none')){jQuery("div#follow").removeClass('display_none')}
      }
    }
    tabAction();
    jQuery(window).resize(function() {
      tabAction();
    });
});
//]]>
</script>
                        <?php
                    }
               }

                function addHeaderCode() {
                $devOptions = $this->getAdminOptions();

                    if ($devOptions['bookmark']=="yes"){
?>
<script type="text/javascript">
//<![CDATA[
var BrowserDetect = {
init: function () {
this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
this.version = this.searchVersion(navigator.userAgent)|| this.searchVersion(navigator.appVersion)|| "an unknown version";
this.OS = this.searchString(this.dataOS) || "an unknown OS";
},
searchString: function (data) {
for (var i=0;i<data.length;i++)	{
        var dataString = data[i].string;
        var dataProp = data[i].prop;
        this.versionSearchString = data[i].versionSearch || data[i].identity;
        if (dataString) {if (dataString.indexOf(data[i].subString) != -1)
                return data[i].identity;}
        else if (dataProp){return data[i].identity;}
}
},
searchVersion: function (dataString) {
var index = dataString.indexOf(this.versionSearchString);
if (index == -1) return;
return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
},
dataBrowser: [
        {string: navigator.userAgent,subString: "Chrome",identity: "Chrome"},
        {string: navigator.userAgent,subString: "OmniWeb",versionSearch: "OmniWeb/",identity: "OmniWeb"},
        {string: navigator.vendor,subString: "Apple",identity: "Safari",versionSearch: "Version"},
        {prop: window.opera,identity: "Opera"},
        {string: navigator.vendor,subString: "iCab",identity: "iCab"},
        {string: navigator.vendor,subString: "KDE",identity: "Konqueror"},
        {string: navigator.userAgent,subString: "Firefox",identity: "Firefox"},
        {string: navigator.vendor,subString: "Camino",identity: "Camino"},
        {string: navigator.userAgent,subString: "Netscape",identity: "Netscape"},
        {string: navigator.userAgent,subString: "MSIE",identity: "Explorer",versionSearch: "MSIE"},
        {string: navigator.userAgent,subString: "Gecko",identity: "Mozilla",versionSearch: "rv"},
        {string: navigator.userAgent,subString: "Mozilla",identity: "Netscape",versionSearch: "Mozilla"}],
dataOS:[{string: navigator.platform,subString: "Win",identity: "Windows"},
        {string: navigator.platform,subString: "Mac",identity: "Mac"},
        {string: navigator.userAgent,subString: "iPhone",identity: "iPhone/iPod"},
        {string: navigator.platform,subString: "Linux",identity: "Linux"}]
};
BrowserDetect.init();

function bookMark(theurl, thetitle, browser){
    switch(browser){
        case "Firefox":
            window.sidebar.addPanel(thetitle, theurl,"");
            break;
        case "Explorer":
            window.external.AddFavorite( theurl, thetitle);
            break;
        case "Chrome":
        case "Safari":
        case "Opera":
        case "Netscape":
            switch(BrowserDetect.OS){
            case "Windows":
            case "Linux":
            alert('press ctrl+D to bookmark this page');
            break;
            case "Mac":
                alert('press cmd+D to bookmark this page');
            break;
            }
            break;
    }
}
//]]>
</script>
<?php
                    }

                    if (!empty($devOptions['width_of_page_minimum'])){
                    wp_enqueue_script("jquery");
                    }
                    // do add of inline styles in to head section
                    if ($devOptions['add_css'] == "false") {
                        require_once('create-styles.php');  // loading style maker
                        ?>
                        <style type="text/css" media="screen" >
                                <?php echo $buildCss; ?>
                        </style>
                        <?php if ($devOptions['print_support']=='true'){ ?>
                        <style type="text/css" media="print" >
                                <?php echo $printCSS; ?>
                        </style>
                        <?php }
                   }
                   //
                   // do add of css StyleSheets into head section
                   //
                if ($devOptions['add_css'] == "true") {
                    // check sheets and call for new sheets if needed
                    $this->checkCss($devOptions);
                     ///  add the possibly newly created sheet
                        $sheets['stylesheet'] = 'screen';
                        if ($devOptions['print_support']=='true'){
                            $sheets['print'] = 'print';
                        }
                        foreach ($sheets as $name => $media){
                        $myStyleUrl = WP_PLUGIN_URL . "/share-and-follow/css/".$name.".css" ;
                        $myStyleFile = WP_PLUGIN_DIR . "/share-and-follow/css/".$name.".css" ;
                            if ( file_exists($myStyleFile) ) {
                                wp_register_style("share-and-follow-".$name."" , $myStyleUrl,array(),1,"".$media."" );
                                wp_enqueue_style( "share-and-follow-".$name."");
                            }
                    }
              }
                // add share image url
                if ($devOptions['add_image_link']=="true"){
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    $default = '';
                    if ( is_page()){  
                            if (empty ($devOptions['page_image_url'])) {$share_image_base=$devOptions['page_img'];}
                            else{$share_image_base=$devOptions['page_image_url'];}
                            }
                    elseif ( is_single()){
                            if (empty ($devOptions['post_image_url'])) {$share_image_base=$devOptions['post_img'];}
                            else{$share_image_base=$devOptions['post_image_url'];}
                    }
                    elseif ( is_archive()){
                            if (empty ($devOptions['archive_image_url'])) {$share_image_base=$devOptions['archive_img'];}
                            else{$share_image_base=$devOptions['archive_image_url'];}
                    }
                    elseif ( is_home()){
                            if (empty ($devOptions['homepage_image_url'])) {$share_image_base=$devOptions['homepage_img'];}
                            else{$share_image_base=$devOptions['homepage_image_url'];}
                    }
                    elseif (is_404()){$share_image_base = "no";}
                    elseif (is_search()){$share_image_base = "no";}
                       
                       switch($share_image_base){
                       case "gravatar":
                            if ($devOptions['author_defaults']=='authors'){ // generated email
                                $email = get_the_author_meta('user_email', $curauth->post_author);
                            }
                            else { // default email
                                $email = $devOptions['default_email'];
                                if(!empty($devOptions['default_email_image'])){$default = $devOptions['default_email_image'];}
                            }
                            $image_src = $this->doGravatarLink($email,$default).".jpg"; // adds .jpg for extra compatibilty
                        break;
                        case "logo":
                            if (!isset($devOptions['logo_image_url']) || empty($devOptions['logo_image_url']) ){
                                if (!isset($curauth->ID)){
                                    $image_src= "";
                                }
                                else {$image_src = $this->getPostImage($curauth->ID);}
                            }
                            else {$image_src = $devOptions['logo_image_url'];}
                        break;
                        case "postImage":
                            $image_src = $this->getPostImage($curauth->ID);
                            if (empty($image_src)){$image_src = $devOptions['logo_image_url'];}
                        break;
                        case "no":
                            $image_src = $devOptions['logo_image_url'];
                            break;
                        default:
                            $image_src = $share_image_base;
                       }
                 
                    echo "<link rel=\"image_src\" href=\"".$image_src."\" /> \n";
                }
		}
                //
                // is it a post or a blog?
                //
                function pagepost($page_id = 0){
                    if ($page_id==0){$html =__('blog','share-and-follow');}
                    else {$html =__('post','share-and-follow');}
                    return $html;
                }
                //
                // find Current page URI
                //
                 function currentPageURI() {
                 $pageURL = 'http';
                 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
                 $pageURL .= "://";
                 if ($_SERVER["SERVER_PORT"] != "80") {
                  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
                 } else {
                  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                 }
                 return $pageURL;
                }
                //
                // do the gravatar stuff
                //
                function doGravatarLink ($email, $default = '', $size=110){
                // construct the gravatar url, default to no alt image and 110px square
                $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( $email ) ) .
                "?default=" . urlencode( $default ) .
                "&amp;size=" . $size;
                return $grav_url;
                }
                //
                // plugin support for wp-ecommerce
                //
                function plugin_support (){
                    $devOptions = $this->getAdminOptions();
                    // share buttons
                    if ($devOptions['wpsc_top_of_products_page']=="yes"){add_action('wpsc_top_of_products_page', 'my_wp_ecommerce_share_links' );}
                    if ($devOptions['wpsc_product_before_description']=="yes"){add_action('wpsc_product_before_description', 'my_wp_ecommerce_share_links' );}
                    if ($devOptions['wpsc_product_addon_after_descr']=="yes"){add_action('wpsc_product_addon_after_descr', 'my_wp_ecommerce_share_links' );}

                    // interactive buttons
                    // after description
                    if ($devOptions['like_wpsc_product_addon_after_descr']=="yes" || $devOptions['tweet_wpsc_product_addon_after_descr']=="yes" || $devOptions['stumble_wpsc_product_addon_after_descr']=='yes')
                    {
                    add_action('wpsc_product_addon_after_descr',array($this, 'wp_ecommerce_interactive_links_top'  ));}
                    // before
                    if ($devOptions['like_wpsc_product_before_description']=="yes"||$devOptions['tweet_wpsc_product_before_description']=="yes" || $devOptions['stumble_wpsc_product_before_description']=='yes'){
                    add_action('wpsc_product_before_description',array($this, 'wp_ecommerce_interactive_links_top' ));
                    }
                    // title
                    if ($devOptions['tweet_wpsc_top_of_products_page']=="yes"||$devOptions['like_wpsc_top_of_products_page']=="yes"||$devOptions['stumble_wpsc_top_of_products_page']=="yes"){
                    add_action('wpsc_top_of_products_page',array($this, 'wp_ecommerce_interactive_links_top' ));
                    }
                }


                function wp_ecommerce_interactive_links_top(){
                    $devOptions = $this->getAdminOptions();
                    $tweet=$devOptions['tweet_wpsc_top_of_products_page'];$like=$devOptions['like_wpsc_top_of_products_page'];$stumble=$devOptions['stumble_wpsc_top_of_products_page'];
                    ShareAndFollow::wp_ecommerce_interactive_links($like,$tweet,$stumble);
                }
                function wp_ecommerce_interactive_links_before(){
                    $devOptions = $this->getAdminOptions();
                    $tweet = $devOptions['tweet_wpsc_product_before_description']; $like=$devOptions['like_wpsc_product_before_description']; $stumble=$devOptions['stumble_wpsc_product_before_description'];
                    ShareAndFollow::wp_ecommerce_interactive_links($like,$tweet,$stumble);
                }
                function wp_ecommerce_interactive_links_after(){
                    $devOptions = $this->getAdminOptions();
                    $tweet = $devOptions['tweet_wpsc_product_addon_after_descr']; $like=$devOptions['like_wpsc_product_addon_after_descr'];$stumble=$devOptions['stumble_wpsc_product_addon_after_descr'];
                    ShareAndFollow::wp_ecommerce_interactive_links($like,$tweet,$stumble);
                }
                function wp_ecommerce_interactive_links($like = '', $tweet='', $stumble=''){
                    $perma=wpsc_the_product_permalink();
                    $title=wpsc_the_product_title();
                    $buildup='<div style="padding:10px 0">';
                    if($tweet=='yes'){
                    $buildup.= ShareAndFollow::doTweetiFrame('', $perma, $title );
                    }
                    if($like=="yes"){
                    $buildup.= ShareAndFollow::doLikeiFrame('', $perma);
                    }
                    if($stumble=='yes'){
                    $buildup.= ShareAndFollow::doStumbleScript('', $perma );
                    }
                    echo $buildup."</div>";
                }


                function getLikeHeight($style, $face){
                    switch ($style){
                        case 'box_count':
                            return '65';
                            break;
                        case 'standard':

                            if($face=='true'){return '80';}
                            else {
                            return '31';
                            }
                            break;
                        case 'button_count':
                            return '21';
                            break;
                    }
                }
                function getTweetHeight($style){
                    switch ($style){
                        case 'vertical':
                            return '65';
                            break;
                        case 'horizontal':
                            return '21';
                            break;
                        case 'none':
                            return '31';
                            break;
                    }
                }

                function doLikeiFrame($postid,$url='',$style='', $size='', $faces=''){
                    $devOptions = $this->getAdminOptions();
                    if ($url==''){$url = urlencode(get_permalink($postid));}
                    if ($style==''){$style=$devOptions['like_style'];}
                    if ($faces==''){$faces=$devOptions['like_faces'];}
                    if ($size==''){$size=$devOptions['like_width'];}
                    return "<iframe src=\"http://www.facebook.com/plugins/like.php?href=".$url."&amp;layout=".$style."&amp;show_faces=".$faces."&amp;width=".$size."&amp;action=".$devOptions['like_verb']."&amp;font=".$devOptions['like_font']."&amp;colorscheme=".$devOptions['like_color']."&amp;height=".$this->getLikeHeight($devOptions['like_style'],$devOptions['like_faces'] )."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:".$size."px; height:".$this->getLikeHeight($style,$faces )."px;\" allowTransparency=\"true\"></iframe>";
                }

                function doTweetiFrame($postid, $url = '', $title = '', $via='', $style='', $size=''){
                    $devOptions = $this->getAdminOptions();
                    if ($url==''){$url = urlencode(get_permalink($postid));}
                    if ($title==''){$title = get_the_title($postid);}
                    if ($style==''){$style=$devOptions['tweet_style'];}
                    if ($size==''){$size=$devOptions['tweet_width'];}

                    if (!empty($devOptions['tweet_via'])){$via = "&amp;via=".$devOptions['tweet_via'];}
                    return "<iframe allowtransparency=\"true\" frameborder=\"0\" scrolling=\"no\" src=\"http://platform.twitter.com/widgets/tweet_button.html?url=".$url."&amp;text=".$title."&amp;count=".$style."&amp;lang=".WPLANG.$via."  \" style=\"width:".$size."px; height:".$this->getTweetHeight($style)."px;\"></iframe>";
                }
                function doStumbleScript($postid, $url = '', $title = '', $via='',$style='', $size=''){
                    $devOptions = $this->getAdminOptions();
                    if ($url==''){$url = urlencode(get_permalink($postid));}
                    if ($style==''){$style=$devOptions['stumble_style'];}
                    return "<script src=\"http://www.stumbleupon.com/hostedbadge.php?s=".$style."&r=".$url."\"></script>";
                }
                //
                // add content to the end of posts and pages to make icons show
                //
                function addContent($content = '') {
                $devOptions = $this->getAdminOptions();
                    $include_page = "yes";
                    global $wp_query;
                    $curauth = $wp_query->get_queried_object();
                    if (!empty($devOptions['excluded_share_pages'])){// exclude pages
                        $arr = explode(",", $devOptions['excluded_share_pages']);
                        foreach ($arr as $value){
                            if ($value == $curauth->ID){$include_page="";}
                        }
                    }
                    
                    if ( is_page()&&$devOptions['wp_page']=='no'){}
                    elseif ( is_single()&&$devOptions['wp_post']=='no'){}
                    elseif ( is_archive()&&$devOptions['wp_archive']=='no'){}
                    elseif ( is_home()&&$devOptions['wp_home']=='no'){}
                    elseif ( is_author()&&$devOptions['wp_author']=='no'){}
                    elseif ($include_page == ""){}
                    elseif (is_404()){}
                    elseif (is_search()){}
                    elseif (is_feed()){}
                    else {
                    $postid = get_the_ID();
                    if ($devOptions['like_topleft']=='yes'||$devOptions['tweet_topleft']=='yes'||$devOptions['stumble_topleft']=='yes'){
                        $buildspace = '<div style="float:left;padding: 0 10px 10px 0" class="interactive_left">';
                        if($devOptions['tweet_topleft']=='yes'){
                                $buildspace .= $this->doTweetiFrame($postid);
                        }
                        if($devOptions['like_topleft']=='yes'){
                                $buildspace .= $this->doLikeiFrame($postid);
                        }
                          if($devOptions['stumble_topleft']=='yes'){
                                $buildspace .= $this->doStumbleScript($postid);
                        }
                       
                       $content = $buildspace."</div>".$content;
                    }
                 if ($devOptions['like_topright']=='yes'||$devOptions['tweet_topright']=='yes'||$devOptions['stumble_topright']=='yes'){
                        $buildspace = '<div style="float:right;padding: 0 0 10px 10px" class="interactive_right">';
                       if($devOptions['tweet_topright']=='yes'){
                                $buildspace .= $this->doTweetiFrame($postid);
                        }
                       if($devOptions['like_topright']=='yes'){
                                $buildspace .= $this->doLikeiFrame($postid);
                        }
                       if($devOptions['stumble_topright']=='yes'){
                                $buildspace .= $this->doStumbleScript($postid);
                        }
                       $content = $buildspace."</div>".$content;
                    }

                        if ($devOptions['add_content'] == "true") {
                            $perma=get_permalink();
                            $title=get_the_title();
                            $postid = get_the_ID();
                            // $twitter_text = ShareAndFollow::get_twitter_text($postid);
                                $args = array('page_id' => $postid,
                                   'heading' => '2',
                                   'list_style'=>$devOptions['list_style'],
                                   'size'=>$devOptions['size'],
                                   'direction' => 'row',
                                   'page_title'=>$title,
                                   'page_link'=>$perma,
                                   'echo'=>'1',
                                   'share'=>$devOptions['share'],
                                   'share_text'=>$devOptions['share_text'],
                                   'email_body_text'=>$devOptions['email_body_text'],
                                   'css_images'=>$devOptions['css_images'],
                                   'email_popup_text'=>$devOptions['email_popup_text'],
                                   'email'=>$devOptions['email'],
                                   'email_share_text'=>$devOptions['email_share_text'],
                                   'post_rss'=>$devOptions['post_rss'],
                                   'post_rss_share_text'=>$devOptions['post_rss_share_text'],
                                   'post_rss_popup_text'=>$devOptions['post_rss_popup_text'],
                                );

     global $allSites;
     foreach ($allSites as $item => $value){
            if($item=='email'|| $item == 'rss'){}
            else{
            if(strstr($value['service'],"share")){
               $args[$item] = $devOptions[$item];
               $args[$item.'_share_text'] = $devOptions[$item.'_share_text'];
               $args[$item.'_popup_text'] = $devOptions[$item.'_popup_text'];
            }
          }
        }
                          $content .= "<div class='shareinpost'>";
                          $content .= social_links($args);
                          $content .= "</div>";
                        }
                        if ($devOptions['like_bottom']=='yes'||$devOptions['tweet_bottom']=='yes'||$devOptions['stumble_bottom']=='yes'){
                        $buildspace = '<div style="padding: 10px 0 "  class="interactive_bottom">';
                       
                       if($devOptions['tweet_bottom']=='yes'){
                                $buildspace .= $this->doTweetiFrame($postid);
                        }
                        if($devOptions['like_bottom']=='yes'){
                                $buildspace .= $this->doLikeiFrame($postid);
                        }
                        if($devOptions['stumble_bottom']=='yes'){
                                $buildspace .= $this->doStumbleScript($postid);
                        }
                       $content .= $buildspace."</div>";
                    }
                    }
                    return $content;
                }
                //
                // get twitter text for putting into tweets in advance
                //
                function get_twitter_text($postid){
                    $twitter_text = get_post_meta($postid, 'twitter_text', true);  // beginning of tweet
                    if (empty($twitter_text) || !isset($twitter_text)){
                        $devOptions = get_option('ShareAndFollowAdminOptions');
                        if (!empty($devOptions['twitter_text_default'])){
                           $completeTweet =   stripslashes($devOptions['twitter_text_default'])." - ";
                           } // over ride text default
                        else {
                            switch($devOptions['twitter_text']){
                            case "clean":
                                $completeTweet = "";
                                break;
                            case "title":
                               $completeTweet = get_the_title($postid)." - ";
                                break;
                            }
                        }
                    }
                    else {$completeTweet = $twitter_text." - ";}
                   return $completeTweet;
                }

                function get_twitter_suffix($postid, $tweet){
                    $twitter_suffix = get_post_meta($postid, 'twitter_suffix', true); // end of tweet
                    if (empty($twitter_suffix) || !isset($twitter_suffix)){
                        $devOptions = get_option('ShareAndFollowAdminOptions');
                        if (!empty($devOptions['twitter_text_suffix'])){
                           $tweet =   $tweet." ".urlencode(stripslashes($devOptions['twitter_text_suffix']));
                           }
                    }
                    else {$tweet = $tweet." ".urlencode(stripslashes($twitter_suffix));}
                   return $tweet;
                }

                //
                // share shortcode
                //
                function share_func($atts, $content) {
                        extract(shortcode_atts(array(
                                'heading' => '0',                                'size' => "16",
                                'list_style' => "icon_text",                     'direction' => 'down',
                                'share'=>'no',                                   'facebook'=>'yes',
                                'stumble'=>'yes',                                'hyves'=>'no',
                                'orkut'=>'yes',                                  'digg'=>'yes',
                                'print'=>'no',                                   'reddit'=>'yes',
                                'delicious'=>'yes',                              'yahoo_buzz'=>'',
                                'linkedin'=>'',                                  'vkontakte'=>'',
                                'google_buzz'=>'',                               'twitter'=>'yes',
                                'myspace'=>'yes',                                'mixx'=>'no',
                                'email'=>'no',                                   'post_rss'=>'yes',
                                'css_images'=>'yes',
                                'xing'=>'no',
                        ), $atts));
                        //shortcode defaults
                        $postid=get_the_ID();
                        $page_title=get_the_title();
                        $page_link=get_permalink($postid);
                        $args = array(
                                'list_style'=>$list_style,
                                'post_id'=>$postid,                              'facebook'=>$facebook,
                                'stumble'=>$stumble,                             'hyves'=>$hyves,
                                'orkut'=>$orkut,                                 'mixx'=>$mixx,
                                'linkedin'=>$linkedin,                           'vkontakte'=>$vkontakte,
                                'digg'=>$digg,                                   'reddit'=>$reddit,
                                'delicious'=>$delicious,                         'twitter'=>$twitter,
                                'myspace'=>$myspace,                             'share'=>$share,
                                'heading' => $heading,                           'size' => $size,
                                'email' => $email,                               'echo'=>'1',
                                'direction' => $direction,                       'page_title'=>$page_title,
                                'page_link'=>$page_link,                         'post_rss'=>$post_rss,
                                'print'=>$print,                                 'tumbler'=>$tumbler,
                                'xing'=>$xing,
                                        );
                        
                        $html = $content.social_links($args);
                        return $html; // shortcodes should be a return, not a print or echo as it only puts it at the top of the post
                }
                //
                //
                //
                function interactive_func($atts, $content) {
                        extract(shortcode_atts(array(
                                'like' => 'yes',                                'tweet' => "yes",
                                'stumble' => "no",                              'style' => 'box_count',

                        ), $atts));
                        //shortcode defaults
                        $postid=get_the_ID();
                        $title=get_the_title();
                        $perma=urlencode(get_permalink($postid));
                        $buildup ='';
                        $faces='false';
                        switch ($style){
                            case 'box_count':
                                $tweet_size = '65';
                                $facebook_size = '65';
                                $stumble_size = '65';
                                $tweet_look = 'vertical';
                                $like_look = 'box_count';
                                $stumble_look = '5';
                                break;
                            case 'side_count':
                                $tweet_size = '100';
                                $facebook_size = '100';
                                $stumble_size = '100';
                                $tweet_look = 'horizontal';
                                $like_look = 'button_count';
                                $stumble_look = '1';
                                break;
                        }


                        if($tweet=='yes'){
                        $buildup.= ShareAndFollow::doTweetiFrame($postid, $perma, '', $title, $tweet_look, $tweet_size, $faces);
                        }
                        if($like=="yes"){
                        $buildup.= ShareAndFollow::doLikeiFrame($postid, $perma, $like_look,$facebook_size);
                        }
                        if($stumble=='yes'){
                        $buildup.= ShareAndFollow::doStumbleScript($postid, $perma, $stumble_look, $size,$stumble_size );
                        }
                        $html = $content.$buildup;
                        return $html; // shortcodes should be a return, not a print or echo as it only puts it at the top of the post
                }

                //
                // replace keywords in URL so that it shares properly, check for php4 as html_entity_decode is a bug on there. 
                //
                function replaceKeyWordsInURL($share_url,$page_link, $page_title, $page_excerpt ){
                    global $phpVersion;
                        $share_url = str_replace('EXCERPT' ,urlencode($page_excerpt), $share_url );
                    if ($phpVersion[0]!=4){
                        $share_url = str_replace('TITLE' ,urlencode(html_entity_decode(str_replace('&#038;',__('and','share-and-follow'),$page_title), ENT_QUOTES, 'UTF-8')), $share_url );
                        }
                    else {
                        $share_url = str_replace('TITLE' ,urlencode($page_title), $share_url );
                        }
                        $share_url = str_replace('URI' ,urlencode($page_link), $share_url );
                    return $share_url;
                }
                //
                // replace keywords in popup text
                //
                function replaceKeyWordsInPopup ($page_id, $page_title, $popup_text){
                    $popup_text = str_replace('TITLE',strip_tags($page_title),$popup_text);
                    $popup_text = str_replace('BLOG',strip_tags(ShareAndFollow::pagepost($page_id)),$popup_text);
                    return $popup_text;
                }
                //
                // make follow links
                //
                function makeFollowLink($args){
                     $defaults = array(
                        'list_style'=>'iconOnly',
                        'icon_set'=>'default',
                        'css_class'=>'',
                        'follow_text'=> __('Follow this','share-and-follow'),
                        'follow_popup_text'=> __('Follow this','share-and-follow'),
                        'size'=>'24',
                        'css_images'=>'no',
                        'image_name'=>'',
                        'sprite_address'=>'0,0',
                        'rel'=>'nofollow me',
                        'target'=>'_blank',
                        'add_li'=>'yes',
                        'special'=>'no',
                        'echo'=>'0',
                        'follow_url'=>'',
                    );
                 $args = wp_parse_args( $args, $defaults );
                 extract( $args, EXTR_SKIP );
                 // create result
                 $optionname = "ShareAndFollowAdminOptions";
                 $devOptions = get_option($optionname);
                 $result = '';
                 global $allSites;
                    switch ($css_images){
                          case "yes":
                              $result = "<a rel=\"".$rel."\" target=\"".$target."\"  ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"".$follow_url."\" title=\"".stripslashes  ($follow_text)."\"><span class=\"head\">".stripslashes  ($follow_text)."</span></a>";
                              break;
                          case "no":
                              $result = "<a rel=\"".$rel."\" target=\"".$target."\" href=\"".$follow_url."\" title=\"".stripslashes  ($follow_text)."\" >";
                                switch ($list_style){
                                    case 'text_replace':
                                        $result .= "<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" class=\"".$css_class."\"  alt=\"".stripslashes  ($follow_text)."\"/> ";
                                    break;
                                    case 'iconOnly':
                                        $result .= "<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\"  width=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\"  alt=\"".stripslashes  ($follow_text)."\"/> ";
                                    break;
                                    case 'icon_text':
                                        $result .= "<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\"  width=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" alt=\"".stripslashes  ($follow_text)."\"/> ";
                                    break;
                                }
                   
                              $result .= "<span class=\"head\">".stripslashes  ($follow_text)."</span></a>";
                              break;  
                    }
                 // add LI
                 if($add_li=='yes'){$result = "<li class=\"".$list_style."\">".$result."</li>";}
                 // return result as echo or variable depending on choice.
                 if($echo==1){echo $result;}
                 else {return $result;}

                }
                //
                // make a share link that goes inside a socialwrap
                //
                function makeShareLink($args){
                    // $devOptions =
                    $defaults = array(
                        'list_style'=>'iconOnly',
                        'css_class'=>'',
                        'icon_set'=>'default',
                        'page_link'=>'',
                        'page_title'=>'',
                        'page_excerpt'=>'',
                        'page_id'=>'0',
                        'excerpt'=>'',
                        'share_text'=> __('Share this','share-and-follow'),
                        'popup_text'=> __('Share this','share-and-follow'),
                        'email_body'=> __('Here is a link to a site I really like','share-and-follow'),
                        'twitter_text'=>'',
                        'size'=>'16',
                        'css_images'=>'no',
                        'image_name'=>'',
                        'sprite_address'=>'0,0',
                        'rel'=>'nofollow',
                        'target'=>'_blank',
                        'add_li'=>'yes',
                        'short_url'=>'no',
                        'special'=>'no',
                        'echo'=>'0',
                        'share_url'=>'',
                    );
                 $args = wp_parse_args( $args, $defaults );
                 extract( $args, EXTR_SKIP );
                 // create result
                 $result = '';
                 global $allSites;
                 $optionname = "ShareAndFollowAdminOptions";
                 $devOptions = get_option($optionname);
                 // define the type of icon to create.  deals with post RSS and email
                 switch ($special){
                     case "no":
                        if ($css_images=="yes"){$result = "<a rel=\"".$rel."\" target=\"".$target."\" ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)."  href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                        else{$result="<a rel=\"".$rel."\" target=\"".$target."\" href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\" >";
                             if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\" width=\"".$size."\" alt=\"".$image_name."\"/> ";}
                             $result.="<span class=\"head\">".stripslashes ($share_text)."</span></a>";}
                     break;
                     case "short-url":
                         if ($css_images=="yes"){$result = "<a rel=\"".$rel."\" target=\"".$target."\" ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], ShareAndFollow::shortenURL ($page_link, $page_id), $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         else{$result="<a rel=\"".$rel."\" target=\"".$target."\" href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], ShareAndFollow::shortenURL ($page_link, $page_id), $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\" >";
                             if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\"  width=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt']).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\"  class=\"image-".$size."\"  alt=\"".$image_name."\"/> ";}
                             $result.="<span class=\"head\">".stripslashes ($share_text)."</span></a>";}
                         break;
                     case "twitter":
                         if ($css_images=="yes"){$result = "<a rel=\"".$rel."\" target=\"".$target."\" ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"".ShareAndFollow::get_twitter_suffix ($page_id,ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], ShareAndFollow::shortenURL ($page_link, $page_id), ShareAndFollow::get_twitter_text($page_id), $page_excerpt ))."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         else{$result="<a rel=\"".$rel."\" target=\"".$target."\" href=\"".ShareAndFollow::get_twitter_suffix ($page_id, ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], ShareAndFollow::shortenURL ($page_link, $page_id), ShareAndFollow::get_twitter_text($page_id), $page_excerpt ))."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\" >";
                         if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\"  width=\"".$size."\"  alt=\"".$image_name."\"/> ";}
                         $result.="<span class=\"head\">".stripslashes ($share_text)."</span></a>";}
                         break;
                     case "clean":
                         if ($css_images=="yes"){$result = "<a rel=\"".$rel."\" target=\"".$target."\"  ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         else{$result.="<a rel=\"".$rel."\" target=\"".$target."\" href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\" ><img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\" height=\"".$size."\"  width=\"".$size."\"  alt=\"".$image_name."\"/> <span class=\"head\">".stripslashes ($share_text)."</span></a>";}
                         break;
                     case "bookmark":
                         if ($css_images=="yes"){$result = "<a ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         else{$result="<a href=\"".ShareAndFollow::replaceKeyWordsInURL($allSites[$css_class]['share_url'], $page_link, $page_title, $page_excerpt )."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\" >";
                         if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\" height=\"".$size."\"  width=\"".$size."\"  alt=\"".$image_name."\"/> ";}
                             $result.="<span class=\"head\">".stripslashes ($share_text)."</span></a>";
                         }
                         break;
                     case "email":
                         if ($css_images=='yes'){$result ="<a rel=\"".$target."\" ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." href=\"mailto:?".str_replace(" ", '%20', "subject=".get_bloginfo('name')." : ".str_replace('&#038;',__('and','share-and-follow'),$page_title)."&amp;body=".stripslashes  ($email_body)."  ".$page_link)."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         else {$result ="<a rel=\"".$target."\" href=\"mailto:?".str_replace(" ", '%20', "subject=".get_bloginfo('name')." : ".$page_title."&amp;body=".stripslashes  ($email_body)."  ".$page_link)."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\">";
                         if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\"  width=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\"  alt=\"".$image_name."\" /> ";}
                             $result.="<span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                         break;
                     case "rss":
                        $rssAdminOption = "permalink_structure";
                        $rssSettigns = get_option($rssAdminOption);
                        if (empty($rssSettigns)){$rss_link = $page_link."&feed=rss2";}
                         else {$rss_link = trailingslashit($page_link)."feed";}
                        if ($css_images=='yes'){$result ="<a rel=\"".$target."\" ".ShareAndFollow::doImageStyle($css_class, $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'], $list_style)." title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\"><span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                            else {$result ="<a rel=\"".$target."\" href=\"".$rss_link."\" title=\"".ShareAndFollow::replaceKeyWordsInPopup ($page_id, $page_title, $popup_text)."\">";
                                 if ($devOptions['list_style']!='text_only'){$result.="<img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\" height=\"".$size."\"  width=\"".$size."\" style=\"background: transparent url(".ShareAndFollow::getIconSprites( $size, $devOptions['icon_set'], $devOptions['cdn']['status_txt'] ).") no-repeat;padding:0;margin:0;height:".$size."px;width:".$size."px;background-position:".str_replace(" ", "px ",$allSites[$css_class]['sprites'][$size])."px\" class=\"image-".$size."\"  alt=\"".$image_name."\" /> ";}
                                 $result.="<span class=\"head\">".stripslashes  ($share_text)."</span></a>";}
                        break;
                 }
                 // LI wrap it
                 if($add_li=='yes'){$result = "<li class=\"".$list_style."\">".$result."</li>";}

                 // return result as echo or variable depending on choice.
                 if($echo==1){echo $result;}
                 else {return $result;}
                }
                //
                //
                //do image style
                //css single images only
                //
                function doImageStyle($image, $size, $set, $status, $list_style){
                    switch($list_style){
                        case 'iconOnly':
                        return "style=\"display:block;background: transparent url(".ShareAndFollow::getIconSetDetails($image, $size, $set, $status ).") no-repeat top left;height:".($size)."px;width:".($size)."px;\" class=\"".$image."\"";
                        break;
                        case 'text_only':
                        return "";
                        break;
                        case 'icon_text':
                        return "style=\"background: transparent url(".ShareAndFollow::getIconSetDetails($image, $size, $set, $status ).") no-repeat top left;padding-left:".($size + 4)."px;line-height:".($size + 4)."px;\" class=\"".$image."\"";
                        break;
                    }
                }
                //
                // make urls shorter, at this time only with bit.ly
                //
                function shortenURL($url, $post_ID){
                    if (function_exists('json_decode')){
                    $devOptions = get_option('ShareAndFollowAdminOptions');
                    //check for bit.ly settings
                    if (!empty($devOptions['bit_ly'])&&!empty($devOptions['bit_ly_code'])){
                        // check to see if the URL has been setup before
                        // using wordpress postmeta
                        $short_url = get_post_meta($post_ID, 'short-url', true);
                        // get current settings
                        if (empty($short_url) || (strlen($short_url) > 20) ){
                            // get a new short URL if empty or over 21 characters long
                            $buildURL = "http://api.bit.ly/v3/shorten?login=".$devOptions['bit_ly']."&apiKey=".$devOptions['bit_ly_code']."&longUrl=".urlencode($url)."&format=json";
                            $request = curl_init();
                            curl_setopt($request,CURLOPT_URL, $buildURL);
                            curl_setopt($request,CURLOPT_HEADER,false);
                            curl_setopt($request,CURLOPT_RETURNTRANSFER,1);
                            $result = curl_exec($request);
                            curl_close( $request );
                            $obj = json_decode($result, true);
                            if ($obj['status_code']==200){
                                // setup new url for return
                                $endURL = $obj['data']['url'];
                                // setup optional bit.ly pro domain
                                if (!empty($devOptions['bit_ly_domain'])){
                                $endURL = str_replace('bit.ly',  $devOptions['bit_ly_domain'],$endURL);
                                }
                                // add it as metadata
                                add_post_meta($post_ID, 'short-url', $endURL, true);
                            }
                            else {// if it fails for any reason use existing URL
                                $endURL=urlencode($url);
                                }
                        }
                        else { // use short-url already from the postmeta table
                            $endURL=$short_url;
                        }
                    }
                    else {$endURL=$url;}// if not setup for Bit.ly use existing url... does not like encoded URL for twitter
                    return $endURL;
                    }
                    else {return $url;} // if no JSON support return existing URL... does not like encoded URL for twitter
                }
                // Load widgets
               function load_widgets() {
                    register_widget( 'Share_Widget' );
                    register_widget( 'Follow_Widget' );
                }
                function getCDNurlStamped($file, $time = '30' ){
                $expire = time()+(60*60*24*$time);
                $signing_url = $file . "?".CDNEXPIRE."=" . $expire . "&".PASSPHRASE."=".PASSCODE;
                $signature = MD5($signing_url);
                $output_url = CDNSERVER.$file."?".CDNEXPIRE."=" . $expire . "&".PASSTOKEN."=" . $signature;
                return $output_url;
                }
                //
                // choose the right icons
                //
                 function getIconSetDetails($image, $size, $iconset = 'default', $cdn='no' ){
                    // warning, without the correct passcode or passphrase there is no way into the CD
                    if($cdn!='OK'){
                       $directory =  "".WP_PLUGIN_URL."/share-and-follow/default/".$size."/".$image.".png";
                    }
                    else if(PASSCODE== ""||PASSPHRASE==""||PASSTOKEN==""||CDNEXPIRE==""||CDNDIRECTORY==""||CDNSERVER==""){
                        $directory =  "".WP_PLUGIN_URL."/share-and-follow/default/".$size."/".$image.".png";
                    }
                    else {
                        $file = CDNDIRECTORY.$iconset."/".$size."/".$image.".png";
                        $directory = ShareAndFollow::getCDNurlStamped($file);
                    }
                return $directory;
                }
                //
                // choose the right sprites
                //
                function getIconSprites( $size, $iconset = 'default', $cdn='no' ){
                    // warning, without the correct passcode or passphrase there is no way into the CDN
                    if($cdn!='OK'){
                           $directory =  "".WP_PLUGIN_URL."/share-and-follow/default/".$size."/sprite-".$size.".png";
                    }
                    else if(PASSCODE== ""||PASSPHRASE==""||PASSTOKEN==""||CDNEXPIRE==""||CDNDIRECTORY==""||CDNSERVER==""){
                           $directory =  "".WP_PLUGIN_URL."/share-and-follow/default/".$size."/sprite-".$size.".png";
                    }
                    else {
                        $file = CDNDIRECTORY.$iconset."/".$size."/sprite-".$size.".png";
                        $directory = ShareAndFollow::getCDNurlStamped($file);
                    }
                return $directory;
                }

            function printAdminPage() {
                        require_once('admin-page.php');
             }//End function printAdminPage()

                function loadLangauge ()
                {
                  //load languages
                  load_plugin_textdomain( 'share-and-follow', false, 'share-and-follow/language' );
                }


              function getCDNcodes(){
                $devOptions = $this->getAdminOptions();

                if ((strlen($devOptions['cdn-key']) == 40)&&!empty($devOptions['cdn'])){
                 $url = "http://api.share-and-follow.com/v1/getCodes.php?url=".trailingslashit(get_bloginfo('url'))."&challange=".md5(trailingslashit(get_bloginfo('url')).$devOptions['cdn-key']);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // curl_setopt($ch, CURLOPT_GET, true);
                    if(curl_exec($ch) === false)
                    {
                        echo 'Curl error: ' . curl_error($ch);
                    }
                    else
                    {
                    $result = curl_exec($ch);
                    $replies = json_decode($result, true);
                    curl_close($ch);
                    if ($replies['status_txt']=='FAIL'){
                        $devOptions['cdn']['status_txt']="FAIL";
                        update_option('ShareAndFollowAdminOptions',$devOptions);
                    define("PASSCODE", "");
                    define("PASSPHRASE", "");
                    define("PASSTOKEN", "");
                    define("CDNEXPIRE", "");
                    define("CDNDIRECTORY", "");
                    define("CDNSERVER", "");
                        // echo "<div class='errors'>The following error has happened : ".$replies['data']."</div>";
                    }
                    else {
                    define("PASSCODE", $replies['data']['passcode']);
                    define("PASSPHRASE", $replies['data']['passphrase']);
                    define("PASSTOKEN", $replies['data']['passtoken']);
                    define("CDNEXPIRE", $replies['data']['expire']);
                    define("CDNDIRECTORY", $replies['data']['directory']);
                    define("CDNSERVER", $replies['data']['server']);
                    }
                  }
                }
                else{
                    define("PASSCODE", "");
                    define("PASSPHRASE", "");
                    define("PASSTOKEN", "");
                    define("CDNEXPIRE", "");
                    define("CDNDIRECTORY", "");
                    define("CDNSERVER", "");
                }
            }

            function getIpAddress() {
                return (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])?
                        $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
            }

            function doAnalytics(){
                $devOptions = $this->getAdminOptions();
                if (strlen($devOptions['cdn-key'])=="40"){
                    ?>
<script type="text/javascript">
//<![CDATA[
var pl = [];
pl['acc']="<?php echo md5(trailingslashit(get_bloginfo('url')).$devOptions['cdn-key']); ?>";
pl['site']="<?php echo trailingslashit(get_bloginfo('url')); ?>";
pl['url']=window.location.href;
pl['ip']="<?php echo $this->getIpAddress(); ?>";
(function() {
var holder = document.createElement('script'); holder.type = 'text/javascript'; holder.async = true;
holder.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.share-and-follow.com/stats/stats.js';
var makescript = document.getElementsByTagName('script')[0]; makescript.parentNode.insertBefore(holder, makescript);
})();
//]]>
</script>
                          <?php
                    }
                }

                

                    function getCDNsets(){
                        $devOptions = $this->getAdminOptions();
                        if ($devOptions['cdn-key']==''){}
                        else if (strlen($devOptions['cdn-key']) <> 40){
                            echo "<div class='errors'>It looks like you have put in an incorrect CDN API key.</div>";
                        }
                        else {
                        $url = "http://api.share-and-follow.com/v1/getSets.php?url=".trailingslashit(get_bloginfo('url'))."&challange=".md5(trailingslashit(get_bloginfo('url')).$devOptions['cdn-key']);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        // curl_setopt($ch, CURLOPT_GET, true);
                        if(curl_exec($ch) === false)
                        {
                            echo 'Curl error: ' . curl_error($ch);
                        }
                        else
                        {
                        $result = curl_exec($ch);
                        $replies = json_decode($result, true);
                        curl_close($ch);
                        if ($replies['status_txt']=='FAIL'){
                            $devOptions['cdn']['status_txt']='FAIL';
                            update_option('ShareAndFollowAdminOptions',$devOptions);
                            return "<div class='errors'>The following error has happened : ".$replies['data']."</div>";
                        }
                        else {
                        $devOptions['cdn'] = json_decode($result, true); // jason format
                        update_option('ShareAndFollowAdminOptions',$devOptions);
                        
                        }
                      }
                    }
                    }
                    //
                    //
                    // what it does
                    function dashboard_widget_function() {
                    ?>
                      <iframe src="http://player.vimeo.com/video/16185599" width="100%" height="280" frameborder="0"></iframe><p>We've been adding more icon sets to the CDN, <a href="https://www.share-and-follow.com/cdn-subscription/">Read more</a> about the CDN here or , or subscribe now via paypal</p>
                      <?php global $current_user; get_currentuserinfo(); ?>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="28KJ4DA6ZMLGY">
                        <table>
                        <tr><td><input type="hidden" name="on0" value="Choose your yearly subscription">Choose your yearly subscription
                            <select name="os0">
                                <option value="up to 5000 visitors per month.">up to 5000 visitors per month. : €9,99EUR - yearly</option>
                                <option value="up to 10,000 visitors per month.">up to 10,000 visitors per month. : €18,50EUR - yearly</option>
                                <option value="up to 25,000 visitors per month.">up to 25,000 visitors per month. : €45,00EUR - yearly</option>
                                <option value="up to 50,000 visitors per month.">up to 50,000 visitors per month. : €85,00EUR - yearly</option>
                                <option value="up to 100,000 visitors per month.">up to 100,000 visitors per month. : €160,00EUR - yearly</option>
                        </select> </td>
                        </tr>
                        </table>
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="on1" value="website address">
                        <input type="hidden" name="os1" maxlength="60" value="<?php echo trailingslashit(get_bloginfo('url')); ?>" >

                        <input type="hidden" name="on2" value="signup email">
                        <input type="hidden" name="os2" maxlength="60" value="<?php echo $current_user->user_email; ?>" >

                        <input type="hidden" name="first_name" value="<?php echo $current_user->user_firstname; ?>">
                        <input type="hidden" name="last_name" value="<?php echo $current_user->user_lastname; ?>">
                        <input type="hidden" name="email" value="<?php echo $current_user->user_email; ?>">
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_subscribeCC_LG_global.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                        <?php
                    }
                    //
                    //
                    // hook function from action
                    function add_dashboard_widgets() {
                        $devOptions = $this->getAdminOptions();
                         if ($devOptions['cdn']==''|| $devOptions['cdn-key'] == '' || (strlen($devOptions['cdn-key'])<>40 ) ){
                            wp_add_dashboard_widget('dashboard_widget', 'Share and Follow', array($this,'dashboard_widget_function'));
                          }
                    }



                    function admin_init_shareFollow()
                    {
                        if (isset($_GET['page']) && $_GET['page'] == 'share-and-follow.php'){
                        /* Register the script. */
                       wp_register_script('colourpicker', WP_PLUGIN_URL . '/share-and-follow/js/colorpicker.js');
                       wp_register_script('adminpages', WP_PLUGIN_URL . '/share-and-follow/js/admin.js');
                       wp_enqueue_script('jquery');
                       wp_enqueue_script('jquery-ui-core');
                       wp_enqueue_script('jquery-ui-tabs');
                       wp_enqueue_script('colourpicker');
                       wp_enqueue_script('adminpages');
                       $this->stylesheet_loader('colorpicker', 'screen');
                        }
                    }

                    function screenAdminPage(){
                          require_once('look-and-feel.php');
                    }

                    function defaultsAdminPage(){
                        
                    }

        }
}

require_once('share-widget.php');   //  includes the code for the share widget
require_once('follow-widget.php');  //  includes the code for the follow widget
require_once('functions.php');      //  includes the functions social_links(), follow_links() and share_links() and any needed items
require_once('items.php');          //  list of known sites

//
//  setup new instance of plugin
if (class_exists("ShareAndFollow")) {$cons_shareFollow = new ShareAndFollow();}
//Actions and Filters	
if (isset($cons_shareFollow)) {
    //Initialize the admin panel
        if (!function_exists("shareFollow_ap")) {
	function shareFollow_ap() {
		global $cons_shareFollow;
		if (!isset($cons_shareFollow)) {
			return;
		}
		if (function_exists('add_options_page')) {
                    add_options_page('Share and Follow', 'Share and Follow', 'manage_options', basename(__FILE__), array(&$cons_shareFollow, 'printAdminPage'));
//                    add_menu_page('Share &amp; Follow', 'Share &amp; Follow', 'administrator', 'share-and-follow-menu',  array(&$cons_shareFollow, 'printAdminPage'), WP_PLUGIN_URL.'/share-and-follow/images/icon.png');
//                    add_submenu_page('share-and-follow-menu', 'Auto added share icons', 'How it looks', 'administrator', 'share-and-follow-submenu-screen', array(&$cons_shareFollow, 'screenAdminPage'));
//                    add_submenu_page('share-and-follow-menu', 'Follow Tab', 'Setup Defaults', 'administrator', 'share-and-follow-submenu-defaults', array(&$cons_shareFollow, 'defaultsAdminPage'));
                  //  add_submenu_page('share-and-follow-menu', 'Share Image URL', 'Share Image', 'administrator', 'share-and-follow-submenu-image', array(&$cons_shareFollow, 'shareImageAdminPage'));
                  //  add_submenu_page('share-and-follow-menu', 'Theme and CSS support', 'Theme support', 'administrator', 'share-and-follow-submenu-theme', array(&$cons_shareFollow, 'themeSupportAdminPage'));

		}
	}
}
//Actions
        add_action('admin_menu', 'shareFollow_ap',1); //admin page
	add_action('wp_head', array(&$cons_shareFollow, 'getCDNcodes'),1); // adds items into head section
        add_action('wp_head', array(&$cons_shareFollow, 'addHeaderCode'),1); // adds items into head section
        add_action('wp_head', array(&$cons_shareFollow, 'addHeaderCodeEndBlock'),10); // adds items into head section
        add_action('wp_footer',array(&$cons_shareFollow, 'show_follow_links'),1); // adds follow links
        add_action('wp_head',array(&$cons_shareFollow, 'doAnalytics'),10); // analytics
        add_action('widgets_init',array(&$cons_shareFollow, 'load_widgets'),1); // loads widgets
        add_action('activate_share-and-follow/share-and-follow.php',  array(&$cons_shareFollow, 'init'),1); // plugin activation (meeds to be tested)
        add_action ('init',array(&$cons_shareFollow, 'loadLangauge'),1);  // add languages
        add_action ('admin_init',array(&$cons_shareFollow, 'admin_init_shareFollow'));  // add admin page scripts
        add_action ('init',array(&$cons_shareFollow, 'plugin_support'),10);  // add plugin support
//Filters
        add_filter('the_content', array(&$cons_shareFollow, 'addContent'),10); // adds the icons automatically to the content
// short codes
        add_shortcode('share_links', array(&$cons_shareFollow,'share_func'),1); // setup shortcode [share_links]
        add_shortcode('interactive_links', array(&$cons_shareFollow,'interactive_func'),1); // setup shortcode [interactive_links]
// installation type stuff
        register_activation_hook( __FILE__, array(&$cons_shareFollow, 'activate') );
// add video to dashboard
        add_action('wp_dashboard_setup',array(&$cons_shareFollow,'add_dashboard_widgets'),1  );
//
}
?>
