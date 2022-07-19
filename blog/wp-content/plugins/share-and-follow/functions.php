<?php
//
// prints html share links (the basic ones)
//
function the_share_links(){
        
        $perma=get_permalink();
        $title=get_the_title();
        $postid = get_the_ID();
        $args = array (
                    'page_id' => $postid,
                    'heading' => "0",
                    'list_style' => "icon_text",
                    'direction' => 'row',
                    'page_title'=>$title,
                    'page_link'=>$perma,
                    'echo'=>'0',
                    'facebook_share_text' => __('Recommend','share-and-follow'),
                    'stumble_share_text'=> __('Stumble uppon','share-and-follow'),
                    'twitter_share_text'=>__('Tweet','share-and-follow'),
                    'delicious_share_text'=>__('Bookmark','share-and-follow'),
                    'digg_share_text'=>__('Digg','share-and-follow'),
                    'reddit_share_text'=>__('Share','share-and-follow'),
                    'hyves_share_text'=>__('Tip','share-and-follow'),
                    'orkut_share_text'=>__('Share','share-and-follow'),
                    'myspace_share_text'=>__('Share','share-and-follow'),
        );
        social_links($args);
}
//
// Shows the links that are clicked in the admin screen.
//
function my_share_links(){
        $optionname = "ShareAndFollowAdminOptions";
        $devOptions = get_option($optionname);
        $perma=get_permalink();
        $title=get_the_title();
        $postid = get_the_ID();
        $args = array (
                    'page_id' => $postid,
                    'heading' => "0",
                    'direction' => 'row',
                    'page_title'=>$title,
                    'page_link'=>$perma,
                    'echo'=>'0',

        );
        $adminSettings = array('size','spacing','share','list_style','email_body_text','share_text','css_images');
        global $allSites;
        foreach ($allSites as $item => $value){
            if($item=='rss'){}
            else{
                if(strstr($value['service'],"share")){
                    $adminSettings[]=$item;
                }
            }
        }
        $adminSettings[]='post_rss';
        foreach ($adminSettings as $item){
            $args[$item] = $devOptions[$item];
        }
        social_links($args);
}

function my_wp_ecommerce_share_links(){
        $optionname = "ShareAndFollowAdminOptions";
        $devOptions = get_option($optionname);
        $perma=wpsc_the_product_permalink();
        $title=wpsc_the_product_title();
        // $postid = get_the_ID();
        $args = array (
                    'heading' => "0",
                    'direction' => 'row',
                    'page_title'=>$title,
                    'page_link'=>$perma,
                    'echo'=>'0',

        );
        $adminSettings = array('size','spacing','share','list_style','email_body_text','share_text','css_images');
        foreach ($adminSettings as $item){
            $args[$item] = $devOptions[$item];
        }
        global $allSites;
        foreach ($allSites as $item => $value){
            if($item=='rss'){}
            else{
                if(strstr($value['service'],"share")){
                    $shareIcons[]=$item;
                }
            }
        }
        $shareIcons[]='post_rss';
        foreach ($shareIcons as $item){
            $args[$item] = $devOptions[$item];
            $args[$item.'_share_text'] = $devOptions[$item.'_share_text'];
            $args[$item.'_popup_text'] = $devOptions[$item.'_popup_text'];
        }
        social_links($args);
}


function my_follow_links(){
    $optionname = "ShareAndFollowAdminOptions";
    $devOptions = get_option($optionname);

        $adminSettings = array ('list_style'=>$devOptions['follow_list_style'],    'size'=>$devOptions['tab_size'],
                'add_follow_text'=>$devOptions['add_follow_text'],                 'css_images'=>'yes',
                'spacing'=>$devOptions['spacing'],                                  'add_content'=>'true',
                'word_value'=>$devOptions['word_value'],                            'word_text'=>$devOptions['word_text'],
                'add_follow'=>$devOptions['add_follow'],                            'add_css'=>$devOptions['add_css'],
                'follow_rss'=>$devOptions['follow_rss'],                            'rss_text'=>$devOptions['rss_link_text'],
                'border_color'=>$devOptions['border_color'],                        'sidebar_tab'=>'',
                'follow_location'=>'none',                                          'list_style' => 'iconOnly',
        );
    foreach ($adminSettings as $item => $settings){
        $args[$item] = $settings;
    }
    global $allSites;
    foreach ($allSites as $item => $value){
            if(strstr($value['service'], "follow")){
            $args['follow_'.$item] = $devOptions['follow_'.$item];
            $args[$item.'_link'] = $devOptions[$item.'_link'];
            $args[$item.'_link_text'] = $devOptions[$item.'_link_text'];
            }
        }
      follow_links($args);
}

//
// returns html share links as HTML
//

function get_the_share_links(){
        $perma=get_permalink();
        $title=get_the_title();
        $postid = get_the_ID();
        $args = array (
                    'page_id' => $postid,
                    'heading' => "0",
                    'list_style' => "icon_text",
                    'direction' => 'row',
                    'page_title'=>$title,
                    'page_link'=>$perma,
                    'echo'=>'1',
                    'facebook_share_text' => __('Recommend','share-and-follow'),
                    'stumble_share_text'=> __('Stumble uppon','share-and-follow'),
                    'twitter_share_text'=>__('Tweet','share-and-follow'),
                    'delicious_share_text'=>__('Bookmark','share-and-follow'),
                    'digg_share_text'=>__('Digg','share-and-follow'),
                    'reddit_share_text'=>__('Share','share-and-follow'),
                    'hyves_share_text'=>__('Tip','share-and-follow'),
                    'orkut_share_text'=>__('Share','share-and-follow'),
                    'myspace_share_text'=>__('Share','share-and-follow'),
        );
        social_links($args);
}
//
//show social links function, complete function.
//
function social_links($args){
    $defaults = array(
                    'page_id' => '0',                                           'heading' => "1",
                    'size' => "16",                                             'list_style' => "icon_text",
                    'direction' => 'down',                                      'facebook' => 'yes',
                    'twitter'=>'yes',                                           'delicious'=>'yes',
                    'digg'=>'yes',                                              'reddit'=>'yes',
                    'myspace'=>'',                                              'linkedin'=>'',
                    'hyves'=>'',                                                'tumblr'=>'',
                    'orkut'=>'',                                                'print'=>'',
                    'google_buzz'=>'',                                          'yahoo_buzz'=>'',
                    'vkontakte'=>'',
                    'bookmark'=>'',                                             'sphinn'=>'',
                    'nujij'=>'',
                    'bebo'=>'',
                    'bebo_share_text'=>__('Share on bebo','share-and-follow'),
                    'bebo_popup_text'=>__('Share this BLOG : TITLE on bebo','share-and-follow'),
                    'blogger'=>'',
                    'blogger_share_text'=>__('Share on blogger','share-and-follow'),
                    'blogger_popup_text'=>__('Share this BLOG : TITLE on blogger','share-and-follow'),
                   'fark'=>'',
                    'fark_share_text'=>__('Share on fark','share-and-follow'),
                    'fark_popup_text'=>__('Share this BLOG : TITLE on fark','share-and-follow'),
                    'faves'=>'',
                    'faves_share_text'=>__('Share on faves','share-and-follow'),
                    'faves_popup_text'=>__('Share this BLOG : TITLE on faves','share-and-follow'),
                    'identica'=>'',
                    'identica_share_text'=>__('Share on identica','share-and-follow'),
                    'identica_popup_text'=>__('Share this BLOG : TITLE on identica','share-and-follow'),
                    'linkagogo'=>'',
                    'linkagogo_share_text'=>__('Share on linkagogo','share-and-follow'),
                    'linkagogo_popup_text'=>__('Share this BLOG : TITLE on linkagogo','share-and-follow'),
                    'mrwong'=>'',
                    'mrwong_share_text'=>__('Share on mrwong','share-and-follow'),
                    'mrwong_popup_text'=>__('Share this BLOG : TITLE on mrwong','share-and-follow'),
                    
                    'netvibes'=>'',
                    'netvibes_share_text'=>__('Share on netvibes','share-and-follow'),
                    'netvibes_popup_text'=>__('Share this BLOG : TITLE on netvibes','share-and-follow'),
                     'post_rss'=>'',                                             'mixx'=>'',
                    'email'=>'',                                            'iconset'=>'default',
                    'share'=>'yes',                                             'page_excerpt'=>get_bloginfo('description'),
                    'phat'=>'',                                                 'page_title'=>'',
                    'page_link'=>'',                                            'echo'=>'0',
                    'words'=>'long',                                            'css_images'=>'no',
                    'share_text'=>__('share:','share-and-follow'),              'mixx_share_text' => __('Mixx it up','share-and-follow'),
                    'mixx_popup_text' => __('Share this BLOG : TITLE on Mixx','share-and-follow'),
                    'vkontakte_popup_text' => __('Share this BLOG : TITLE on vkontakte','share-and-follow'),
                    'linkedin_share_text' => __('Share on Linkedin','share-and-follow'),
                    'linkedin_popup_text' => __('Share this BLOG : TITLE on Linkedin','share-and-follow'),
                    'facebook_share_text' => __('Recommend on Facebook','share-and-follow'),
                    'facebook_popup_text' => __('Recommend this BLOG : TITLE on Facebook','share-and-follow'),
                    'stumble_share_text'=> __('Share with Stumblers','share-and-follow'),
                    'stumble_popup_text'=> __('Share this BLOG : TITLE with Stumblers','share-and-follow'),
                    'twitter_share_text'=>__('Tweet this','share-and-follow'),
                    'twitter_popup_text'=>__('Tweet this BLOG : TITLE on Twitter','share-and-follow'),
                    'tumblr_share_text'=>__('Tumblr. this','share-and-follow'),
                    'tumblr_popup_text'=>__('Tumblr. this BLOG : TITLE ','share-and-follow'),
                    'delicious_share_text'=>__('Bookmark on Delicious','share-and-follow'),
                    'delicious_popup_text'=>__('Bookmark this BLOG : TITLE on Delicious','share-and-follow'),
                    'digg_share_text'=>__('Digg this','share-and-follow'),
                    'digg_popup_text'=>__('Digg this BLOG : TITLE','share-and-follow'),
                    'reddit_share_text'=>__('Share on Reddit','share-and-follow'),
                    'reddit_popup_text'=>__('Share this BLOG : TITLE on Reddit','share-and-follow'),
                    'hyves_share_text'=>__('Tip on Hyves','share-and-follow'),
                    'hyves_popup_text'=>__('Tip this BLOG : TITLE on Hyves','share-and-follow'),
                    'orkut_share_text'=>__('Share on Orkut','share-and-follow'),
                    'orkut_popup_text'=>__('Share this BLOG : TITLE on Orkut','share-and-follow'),
                    'myspace_share_text'=>__('Share via MySpace','share-and-follow'),
                    'myspace_popup_text'=>__('Share this BLOG : TITLE via MySpace','share-and-follow'),
                    'post_rss_share_text'=>__('Follow this posts comments','share-and-follow'),
                    'post_rss_popup_text'=>__('Follow this BLOG : TITLE comments','share-and-follow'),
                    'print_share_text'=>__('Print for later','share-and-follow'),
                    'print_popup_text'=>__('Print this BLOG : TITLE for reading later','share-and-follow'),
                    'email_share_text'=>__('Tell a friend','share-and-follow'),
                    'email_popup_text'=>__('Tell a friend about this BLOG : TITLE ','share-and-follow'),
                    'google_buzz_share_text'=>__('Buzz up','share-and-follow'),
                    'google_buzz_popup_text'=>__('Buzz up this BLOG : TITLE ','share-and-follow'),

                    'sphinn_share_text'=>__('Sphinn this','share-and-follow'),
                    'sphinn_popup_text'=>__('Sphinn this BLOG : TITLE ','share-and-follow'),

                    'technorati'=>'',
                    'technorati_share_text'=>__('Share on nuJIJ','share-and-follow'),
                    'technorati_popup_text'=>__('Share this BLOG : TITLE on nuJIJ','share-and-follow'),

                    'xing'=>'',
                    'xing_share_text'=>__('Share on Xing','share-and-follow'),
                    'xing_popup_text'=>__('Share this BLOG : TITLE on Xing','share-and-follow'),

                    'nujij_share_text'=>__('Share on nuJIJ','share-and-follow'),
                    'nujij_popup_text'=>__('Share this BLOG : TITLE on nuJIJ','share-and-follow'),

                    'bookmark_share_text'=>__('bookmark','share-and-follow'),
                    'bookmark_popup_text'=>__('bookmark this BLOG : TITLE ','share-and-follow'),

                    'yahoo_buzz_share_text'=>__('Buzz it','share-and-follow'),
                    'yahoo_buzz_popup_text'=>__('Buzz it this BLOG : TITLE ','share-and-follow'),
                    'email_body_text'=>__('Found this and thought of you...','share-and-follow'),
                );
    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );
    if ($page_id != 0){ $page_excerpt = substr(strip_tags(get_the_content($page_id)),0,320);}
    if (empty($page_title) && empty($page_link)){
       $page_title = get_bloginfo('name');
       if(is_category() || is_archive() || is_tag() || is_month()) {
               if ( is_category() || is_archive()) {
                   $category = get_the_category();
                   $page_title = $page_title."&nbsp;|&nbsp;".$category[0]->cat_name;
                }
               if ( is_tag() ) {
                    $page_title = get_bloginfo('name')."&nbsp;|&nbsp;".single_tag_title("", false);
                }
           $page_link = ShareAndFollow::currentPageURI();
           $page_id = 0;
       }
       else if(is_front_page()) {
             $page_title = get_bloginfo('name');
             $page_link = get_option('home');
             $page_id = 0;
       }
       else{
            $page_title = get_the_title($page_id);
            $page_link = get_permalink($page_id);
            $page_excerpt = substr(get_the_content($page_id),0,120);
       }
    }
$html='';
if($heading==1){
         $html = "<h2 class=\"clean\" >". _e('Share this ');
         if ($page_id==0){$html .='blog';}
         else {$html .='page';}
         $html.= "</h2>";
}
if ($css_images=='yes'){$html .= "<ul class=\"socialwrap size".$size." ".$direction."\">";}
if ($css_images=='no'){$html .= "<ul class=\"socialwrap ".$direction."\">";}
if($share=='yes'){$html.="<li class=\"".$list_style." share\">".$share_text."</li>";}
global $allSites;
    foreach ($allSites as $item => $value){
            if(strstr($value['service'], "share")){
            if ($args[$item]=="yes"){
                if ($item!='email'){
                switch ($item){
                    case 'print':
                    case 'bookmark':
                        $shareLinks=array('css_class'=>$item,'page_id'=>$page_id,'page_link'=>$page_link,  'list_style'=>$list_style, 'target'=>"_self",
                        'page_title'=>$page_title, 'css_images'=>$css_images, 'size'=>$size, 'image_name'=>$item, 'share_text'=>$args[$item.'_share_text'], 'popup_text'=>$args[$item.'_popup_text'],);
                        break;
                    case 'post_rss':
                        $shareLinks=array('css_class'=>'rss','page_id'=>$page_id,'page_link'=>$page_link,  'list_style'=>$list_style, 'target'=>"_self",'special'=>'rss',
                        'page_title'=>$page_title, 'css_images'=>$css_images, 'size'=>$size, 'image_name'=>'rss', 'share_text'=>$args[$item.'_share_text'], 'popup_text'=>$args[$item.'_popup_text'],);
                        break;
                    case 'twitter':
                        $shareLinks=array('css_class'=>$item,'page_id'=>$page_id,'page_link'=>$page_link,  'list_style'=>$list_style, 'target'=>"_blank",'special'=>'twitter',
                        'page_title'=>$page_title, 'css_images'=>$css_images, 'size'=>$size, 'image_name'=>$item, 'share_text'=>$args[$item.'_share_text'], 'popup_text'=>$args[$item.'_popup_text'],);
                        break;
                    default:
                    $shareLinks=array('css_class'=>$item, 'page_id'=>$page_id, 'page_link'=>$page_link, 'list_style'=>$list_style, 'page_excerpt'=>$page_excerpt,
                    'page_title'=>$page_title, 'css_images'=>$css_images, 'size'=>$size, 'image_name'=>$item, 'share_text'=>$args[$item.'_share_text'], 'popup_text'=>$args[$item.'_popup_text'],);
                }
                $html.=ShareAndFollow::makeShareLink($shareLinks);
              }
            }
          }
        }
        if($email=='yes'){
            $args=array('css_class'=>'email','page_id'=>$page_id,'page_link'=>$page_link, 'target'=>"_self", 'special'=>"email", 'email_body'=>$email_body_text, 'list_style'=>$list_style,
                        'page_title'=>$page_title, 'css_images'=>$css_images, 'size'=>$size, 'image_name'=>'email', 'share_text'=>$email_share_text, 'popup_text'=>$email_popup_text);
            $html.=ShareAndFollow::makeShareLink($args);
            }
$html .= "</ul>";

if ($direction=='row'){$html .= "<div class=\"clean\"></div> ";}
if ($echo=='0'){
    echo $html;
}
else {return $html;}
}
//
// the follow links setup
//

function follow_links($args){
    $optionname = "ShareAndFollowAdminOptions";
    $devOptions = get_option($optionname);
    $defaults = array(
                    'size' => "16",
                    'list_style' => 'text_replacement',
                    'icon_set'=>'default',
                    'direction' => 'down',
                    'iconset'=>'default',
                    'word_value'=>'follow',
                    'word_text'=>__('follow:','share-and-follow'),
                    'phat'=>'',
                    'page_title'=>'',
                    'page_link'=>'',
                    'echo'=>'0',
                    'words'=>'long',
                    'sidebar_tab'=>'tab',
                    'add_follow_text'=>'true',
                    'css_images'=>'no',
                    'follow_location'=>'right',
                );
    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );
if ($list_style=='text_replace' && $sidebar_tab=='tab' ){$css_images='no';}
$html ='';
$rss_link = get_bloginfo($devOptions['rss_style']);
if ($sidebar_tab=='tab'){$html .="<div id=\"follow\" class=\"".$follow_location."\">";}
    if ($css_images=='yes'){$html .= "<ul class=\"".$sidebar_tab." size".$size." ".$direction."\">";}
    if ($css_images=='no'){$html .= "<ul class=\"".$sidebar_tab." ".$direction."\">";}
    if($add_follow_text=='true') {$html .= "<li class=\"".$word_value."\"><img src=\"".WP_PLUGIN_URL."/share-and-follow/images/blank.png\"  alt=\"".$word_text."\"/><span>".$word_text."</span></li>";}

    global $allSites;
    foreach ($allSites as $item => $value){
            if(strstr($value['service'], "follow")){
                if ($item == 'rss' && $args['follow_'.$item]=="yes"){
                          $followLinks = array('icon_set'=>$icon_set,'css_class'=>$item,'follow_text'=>$args[$item.'_text'], 'follow_popup_text'=>$args[$item.'_text'], 'size'=>$size,
                           'css_images'=>$css_images,'image_name'=>$item ,'rel'=>'nofollow me','target'=>'_blank','follow_url'=>$rss_link,'list_style'=>$list_style);
                          $html.=ShareAndFollow::makeFollowLink($followLinks);
                    }
                if ($args['follow_'.$item]=="yes"&&!empty($args[$item.'_link'])){
                       $followLinks = array('icon_set'=>$icon_set,'css_class'=>$item,'follow_text'=>$args[$item.'_text'], 'follow_popup_text'=>$args[$item.'_text'], 'size'=>$size,
                       'css_images'=>$css_images,'image_name'=>$item ,'rel'=>'nofollow me','target'=>'_blank','follow_url'=>$args[$item.'_link'],'list_style'=>$list_style);
                      $html.=ShareAndFollow::makeFollowLink($followLinks);
                }
            }
        }
$html .= "</ul>";
if ($direction=='row'){$html .= "<div class=\"clean\"></div> ";}
if ($sidebar_tab=='tab'){$html .="</div>";}
if ($echo=='0'){echo $html;}
else {return $html;}
}
?>
