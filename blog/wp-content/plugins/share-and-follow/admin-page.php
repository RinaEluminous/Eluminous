<?php
if (is_user_logged_in() && is_admin() ){
    if (function_exists('json_decode')){ $details = ShareAndFollow::getCDNsets();}
    if (isset($_POST['reset_share-and-follow'])) {
        $shareAdminOptions = ShareAndFollow::return_defaults();
        update_option('ShareAndFollowAdminOptions', $shareAdminOptions);
           ?> <div class="updated"><p><strong><?php _e("Settings Reset.", "share-and-follow");?></strong></p></div>
           <p><?php _e("All setings have now been reset to installation defaults, your widget settings have not been effected.  You will need to re-add your follow links. <a href='options-general.php?page=share-and-follow.php'>Return to the adminstration page</a> to make the changes", "share-and-follow");?></p>
           <?php
        }
    else {

    function getRightImage($value){
        switch($value){
        case "yahoo_buzz":
            $result = "yahoobuzz";
            break;
        case "stumble":
            $result = "stumbleupon";
            break;
        case "post_rss":
            $result = "rss";
            break;
        default:
            $result = $value;
      }
        echo $result;
  }

    function getRightTitle($value){
        switch($value){
        case "post_rss":
            $result = "rss comment feed";
            break;
        default:
            $result = $value;
      }
        return $result;
  }
$devOptions = $this->getAdminOptions();
            if (isset($_POST['update_share-and-follow'])) {//save option changes
     $adminSettings = array('background_color','border_color','follow_location','follow_color','spacing','size','add_content','add_follow',
                        'add_css', 'list_style', 'follow_list_style','excluded_share_pages','css_images','extra_print_css','extra_css','add_image_link',
                        'default_email','default_email_image','author_defaults','logo_image_url','homepage_img','homepage_image_url','archive_img','archive_image_url',
                        'page_image_url','post_image_url','page_img','post_img','background_transparent','border_transparent','tab_size','share','share_text','cssid',
                        'word_text', 'add_follow_text', 'word_value','email','email_share_text','email_body_text','email_popup_text','print_share_text','print','css_print_excludes',
                        'theme_support','print_popup_text','rss_link_text','follow_rss','distance_from_top', 'follow_list_spacing','wp_page','wp_post', 'wp_author',
                        'wp_home','wp_archive', 'bit_ly_code','bit_ly','twitter_text', 'twitter_text_default','twitter_text_suffix','width_of_page_minimum',
                        'wpsc_top_of_products_page', 'wpsc_product_before_description', 'wpsc_product_addon_after_descr','css_follow_images',
                        'excluded_follow_pages','follow_page','follow_post','follow_archive','follow_home','follow_author','cdn-key','icon_set','post_rss','post_rss_share_text',
                        'like_font','post_rss_popup_text','like_topleft','like_topright','like_bottom','like_style','like_width','like_faces','like_verb','like_color','bit_ly_domain',
                        'tweet_width','tweet_style','tweet_topleft','tweet_topright','tweet_bottom','tweet_wpsc_top_of_products_page', 'tweet_wpsc_product_before_description', 'tweet_wpsc_product_addon_after_descr',
                        'like_wpsc_top_of_products_page', 'like_wpsc_product_before_description', 'like_wpsc_product_addon_after_descr','tweet_via','top_padding',
                        'stumble_style','stumble_topleft','stumble_topright','stumble_bottom','stumble_wpsc_top_of_products_page', 'stumble_wpsc_product_before_description', 'stumble_wpsc_product_addon_after_descr','print_support',
                        'rss_style',
                        );

         foreach ($adminSettings as $item){
            $devOptions[$item] = $_POST[$item];
        }


//
//  check for follow sites. 
//
        global $allSites;
        foreach ($allSites as $item => $value){
            if(strstr($value['service'], "follow")){
               $devOptions['follow_'.$item] = $_POST['follow_'.$item];
               $devOptions[$item.'_link'] = $_POST[$item.'_link'];
               $devOptions[$item.'_link_text'] = $_POST[$item.'_link_text'];

            }
        }

        foreach ($allSites as $item => $value){
            if($item=='email'|| $item == 'rss'){}
            else{
            if(strstr($value['service'],"share")){
               $devOptions[$item] = $_POST[$item];
               $devOptions[$item.'_share_text'] = $_POST[$item.'_share_text'];
               $devOptions[$item.'_popup_text'] = $_POST[$item.'_popup_text'];
            }
          }
        }
// print_r($devOptions);
if (isset($_POST['devloungeContent'])) {$devOptions['content'] = apply_filters('content_save_pre', $_POST['devloungeContent']);}
update_option($this->adminOptionsName, $devOptions);?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "share-and-follow");?></strong></p></div>
<?php } ?>
                
<div class="wrap" >
<?php if ($devOptions['cdn']==''|| $devOptions['cdn-key'] == '' || (strlen($devOptions['cdn-key'])<>40 ) ){ ?>
    <div style="float:right; width:400px;padding:10px; background-color:#ccc;border:1px solid #666;margin:5px;">
        <p><?php _e('if your feeling lovely and really like this plug-in, then why not blog about it or give us a <a href="http://wordpress.org/extend/plugins/share-and-follow/">rating on the Wordpress site</a>.... help to spread the love.<br /><br />If you wish to give a <a href="http://share-and-follow.com/wordpress-plugin/donations/">donation</a>, thats cool, but we would rather you got something for your money, so why not <a href="http://www.share-and-follow.com/cdn-subscription/">get the CDN</a> so you can have the extra icons as well.','share-and-follow'); ?></p>
<?php } else { ?>
        <div style="float:right; width:400px;padding:10px; background-color:#ccc;border:1px solid #666;margin:5px;">
            <p><?php _e('Thanks for supporting us by getting the CDN, if you want to go further then please give us a <a href="http://wordpress.org/extend/plugins/share-and-follow/">rating on the Wordpress site</a>.... help to spread the love.','share-and-follow'); ?></p>
<?php } ?>
        </div>
            <div style="margin-right:440px;min-height:200px">
        <h2><?php _e('Share and Follow Administration','share-and-follow'); ?></h2>
        <p><?php _e('Here you can administer either the Follow Tab, or the Share Links on a Post.  If you want to admin the sidebar widget,  you need to goto the ','share-and-follow'); ?><a href="widgets.php"><?php _e('widgets section.','share-and-follow'); ?></a></p> <p><?php _e(' However for the Follow widget to work with anything except RSS you will have to fill out the details below in the ','share-and-follow'); ?><a href="#enterlinks"><?php _e('follow section','share-and-follow'); ?></a></p>
        <p><?php _e('More','share-and-follow'); ?> <a href="http://share-and-follow.com/wordpress-plugin/" target="_blank"><?php _e('documentation','share-and-follow'); ?></a> <?php _e(' on how to use this plugin and it&#39;s options &#40;Share Widget, Follow Widget, Share on Posts, Shortcode in Post, Follow Tab, Theme Tags&#41;','share-and-follow'); ?></p>
        
        </div>

<style>
td img {vertical-align:bottom;}
th {text-align:left;}
td {vertical-align:top}
div.rounded {-moz-border-radius:15px;-webkit-border-radius:15px;padding:0 20px 20px 20px;background-color:white;border:solid 1px #333}
div.cdn-rounded {padding:20px 10px}
div.rounded table{border-collapse:collapse;}
div.rounded table thead tr th {padding:.2em .4em}
div.rounded table tbody tr td {}
table.logic {border:solid 1px #ccc;margin-bottom:20px}
table.logic tr th {padding:.2em .4em}
table.logic tr td {border:solid 1px #ccc;border-width: 1px 0 0 0;padding:.2em .4em}
table.logic tr td h4 {margin:0;}
ul.cdn-listing li {float:left; width:120px;min-height:140px;text-align:center;}
ul.cdn-listing li img {margin:0 10px}
.cdn-setup {position:relative;-moz-border-radius:15px;-webkit-border-radius:15px;background-color:white;border:solid 1px #333}
.cdn-setup h1 {padding-left:20px}
.not-the-cdn {padding:10px;width:120px; position:absolute;}
.the-cdn {margin-left: 142px;padding-left:10px;border-bottom-right-radius:15px;-moz-border-radius-bottomright:15px;-webkit-border-bottom-right-radius:15px;border:dashed 2px #333; border-width:2px 0 0 2px;padding-bottom:10px }
.the-cdn-approved {}
.errors {background-color:#6B0E21;border:solid 1px red;padding:10px 5px;color:white; margin-bottom:10px}
.imageholder{height:150px;overflow:auto;}
table.like th {vertical-align:top;padding-right:.2em;}
table.like td {padding-bottom:4px;}
.ui-tabs .ui-tabs-hide {display: none;}
#tabs ul li {background-color:white;border:solid 1px black;padding:2px;margin-right:5px;float:left;margin-bottom:0px;border-bottom:none;border-top-left-radius:8px;-moz-border-radius-topleft:8px;-webkit-border-top-left-radius:8px;border-top-right-radius:8px;-moz-border-radius-topright:8px;-webkit-border-top-right-radius:8px;}
#tabs ul li a {color:inherit;padding:3px;display:block; text-decoration:none;}
#tabs ul li.ui-state-active {background-color:#333;border:solid 1px #333;color:white;border-bottom:none}
#tabs-open{-moz-border-radius:15px;-webkit-border-radius:15px;background-color:white;border:solid 1px #333;padding:20px;max-width:1210px;margin-bottom:30px}
#tabs-1, #tabs-2 {background-color:white;border:solid 1px black;clear:left; margin-bottom:20px;padding:20px;-webkit-border-radius:15px;border-top-left-radius:0px;-moz-border-radius-topleft:0px;-webkit-border-top-left-radius:0px;max-width:1210px;}
</style>
<?php global $current_user;
get_currentuserinfo();
if ( $devOptions['cdn']['status_txt']=='FAIL'|| $devOptions['cdn-key'] == '' || (strlen($devOptions['cdn-key'])<>40 ) ){
?>
        <script>
	jQuery(document).ready(function(){
		jQuery( "#tabs" ).tabs();
	});
	</script>
        <h1><?php _e('Helpful Videos','share-and-follow'); ?></h1>
        <div id="tabs">
	<ul>
		<li><a href="#tabs-1"><?php _e('Adding the CDN and Extra Icon Sets','share-and-follow'); ?></a></li>
		<li><a href="#tabs-2"><?php _e('Overview video of Share and Follow','share-and-follow'); ?></a></li>
	</ul>
	<div id="tabs-1">
            <div style="float:left;margin-right:20px">
<iframe src="http://player.vimeo.com/video/16185599" width="580" height="325" frameborder="0"></iframe>
            </div>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="28KJ4DA6ZMLGY">
<table>
<tr><td><input type="hidden" name="on0" value="Choose your yearly subscription"><h2><?php _e('Choose your yearly subscription','share-and-follow'); ?></h2></td></tr><tr><td><select name="os0">
	<option value="up to 5000 visitors per month."><?php _e('up to 5000 visitors per month. : €9,99EUR - yearly','share-and-follow'); ?></option>
	<option value="up to 10,000 visitors per month."><?php _e('up to 10,000 visitors per month. : €18,50EUR - yearly','share-and-follow'); ?></option>
	<option value="up to 25,000 visitors per month."><?php _e('up to 25,000 visitors per month. : €45,00EUR - yearly','share-and-follow'); ?></option>
	<option value="up to 50,000 visitors per month."><?php _e('up to 50,000 visitors per month. : €85,00EUR - yearly','share-and-follow'); ?></option>
	<option value="up to 100,000 visitors per month."><?php _e('up to 100,000 visitors per month. : €160,00EUR - yearly','share-and-follow'); ?></option>
</select> </td></tr>
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
<small><?php _e('enter the API code below to activate the CDN and extra icons.','share-and-follow'); ?></small>
            <div style="clear:both"></div>
	</div>
	<div id="tabs-2">
            <div style="float:left;margin-right:20px">
		<iframe src="http://player.vimeo.com/video/15507608" width="580" height="325" frameborder="0"></iframe>
                </div>
                <h2><?php _e('How to setup Share and Follow','share-and-follow'); ?></h2>
                <p><?php _e('An overview of many of the features of share and follow.','share-and-follow'); ?></p>
                        <div style="clear:both"></div> 
	</div>
</div>
<?php } ?>
        <form method="post" action="options-general.php?page=share-and-follow.php">
            <?php  if (function_exists('json_decode')){ ?>
            <?php echo $details; ?>
            
                
             <?php if ($devOptions['cdn']['status']=='FAIL'|| $devOptions['cdn-key'] == '' || (strlen($devOptions['cdn-key'])<>40 ) ) { ?>
            <div class="cdn-setup" style="max-width:1250px;">
                <h1><?php _e('Setup the CDN API key','share-and-follow'); ?></h1>
                <div style="margin:0 20px 20px 20px">
                     <h3><?php _e('Add extra icon sets via optional CDN subscription','share-and-follow'); ?></h3>
                     <p><?php _e('A CDN is the fastest way to get these images to readers of your site. Subscribe to the CDN and get lots of  new icon sets. <a href="http://www.share-and-follow.com/cdn-subscription/">read more about our CDN</a>, or watch the video above.','share-and-follow'); ?></p>
                     <label for="cdn-key">CDN API Key</label><input type="text" name="cdn-key" id="cdn-key"  style="width:30em" value="<?php echo ($devOptions['cdn-key']);?>" /><input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                </div>
                <?php } else { ?>
             <div id="tabs-open">
                 <h1><?php _e('Helpful Video','share-and-follow'); ?></h1>
            <div style="float:left;margin-right:20px">
		<iframe src="http://player.vimeo.com/video/15507608" width="580" height="325" frameborder="0"></iframe>
                </div>
                <h2><?php _e('How to setup Share and Follow','share-and-follow'); ?></h2>
                <p><?php _e('An overview of many of the features of share and follow.','share-and-follow'); ?></p>
                        <div style="clear:both"></div> 
	</div>
                <div class="cdn-setup" style="max-width:1250px;">
                     <h1><?php _e('Choose the icon set','share-and-follow'); ?></h1>
                    <div class="cdn-rounded">
                        <label for="cdn-key"><?php _e('your CDN API Key','share-and-follow'); ?></label><input style="width:30em" type="text" name="cdn-key" id="cdn-key" value="<?php echo ($devOptions['cdn-key']);?>" />
                     <h3><?php _e('Christmas puddings and Autumn leaves have just been added to the CDN, now your ready for christmas','share-and-follow'); ?></h3>
                     <div class="imageholder">
                       <ul class="cdn-listing">
                      <?php
                      if (!empty($devOptions['cdn']['data']['sets']['icons'])){
                      foreach ($devOptions['cdn']['data']['sets']['icons'] as $item ){?>
                     <li><img src="<?php  echo WP_PLUGIN_URL ?>/share-and-follow/images/blank.png" height="72px" width="100px" alt="<?php echo $item['location']; ?> set" style="background-image:url(<?php  echo $devOptions['cdn']['data']['sets']['overview'] ?>);background-position:<?php echo $item['position']; ?>;background-repeat: no-repeat" />
                     <label for="<?php echo $item['location']; ?>_set"><input type="radio" id="<?php echo $item['location']; ?>_set" name="icon_set" value="<?php echo $item['location']; ?>" <?php if ($devOptions['icon_set'] == $item['location'] || $devOptions['icon_set'] == "" ) {echo'checked';} ?>/><br /><?php echo $item['name']; ?></label></li>
                     <?php }} 
                 ?>
             </ul>
              </div>
             <div style="clear:both;"></div>
             <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
             </div>
             <?php } ?>
                </div>
         <?php } ?>
            
        <div style="float:left;width:580px;margin-right:10px;margin-top:20px; clear:both;" class="rounded">
                <?php wp_nonce_field('update-options'); ?>
                <h1><?php _e('Share Icons Setup','share-and-follow'); ?></h1>
                <h3><?php _e('Allow Share Icons to be added to the End of a Post?','share-and-follow'); ?></h3>
                <input type="hidden" name="cssid" id="cssid" value="<?php echo ($devOptions['cssid']+1);?>" />
                <p><?php _e('Selecting &quot;No&quot; will disable the content from being added into the end of a post.','share-and-follow'); ?></p>
                <p><label for="devloungeAddContent_yes"><input type="radio" id="devloungeAddContent_yes" name="add_content" value="true" <?php if ($devOptions['add_content'] == "true") {echo "checked=\"checked\"";} ?> /> <?php _e('Yes','share-and-follow'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="devloungeAddContent_no"><input type="radio" id="devloungeAddContent_no" name="add_content" value="false" <?php if ($devOptions['add_content'] == "false") {echo "checked=\"checked\"";} ?>/> <?php _e('No','share-and-follow'); ?></label></p>
                <h3><?php _e('Where to show the share icons','share-and-follow'); ?></h3>
                <p><?php _e('Choose where on your site the share icons will be automatically added','share-and-follow'); ?></p>
                <?php $args = array ('wp_page'=>__('pages','share-and-follow'), 'wp_post'=>__('posts','share-and-follow'), 'wp_author'=>__ ('author pages','share-and-follow'), 'wp_home'=>__('home page','share-and-follow'), 'wp_archive'=>__('tags, archive or catagory page','share-and-follow'),  ); ?>
                <?php foreach($args as $key=>$value){
                    ?>
                <input type="hidden" value="no" name="<?php echo $key; ?>" />
                <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                    <?php
                } ?>
                <label><?php _e('exclude these IDs :','share-and-follow'); ?></label><input type="text" name="excluded_share_pages" value="<?php echo $devOptions['excluded_share_pages']; ?>">
                <p><?php _e('exclude pages or posts by entering IDs as a comma separated list. i.e. 1, 2, 3, 4   (ideal for About and Contact page)','share-and-follow'); ?></p>
                <ul style="padding:0;margin:0">
                        <li style="float:left;width:50%;padding:0;margin:0">
                            <h3><label for="size"><?php _e('Size of Icons on Posts','share-and-follow'); ?></label></h3>
                            <select  name="size" id="size" style="width:12em">
                                <?php $args = array ('16','24','32','48','60') ?>
                                <?php foreach ($args as $sizeToShow) {?>
                                    <option value="<?php echo $sizeToShow; ?>" <?php if ($sizeToShow == $devOptions['size']) {echo 'selected="selected"';} ?>><?php echo $sizeToShow; ?>x<?php echo $sizeToShow; ?></option>
                                <?php } ?>
                            </select>
                        </li>
                         <li style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><label for="list_style"><?php _e('Share icons display style','share-and-follow'); ?></label></h3>
                            <select id="list_style" name="list_style" style="width:12em">
                                    <option <?php if ( 'icon_text' == $devOptions['list_style'] ) echo 'selected="selected"'; ?> value="icon_text"><?php _e('Icon and Text','share-and-follow'); ?></option>
                                    <option <?php if ( 'text_only' == $devOptions['list_style'] ) echo 'selected="selected"'; ?> value="text_only"><?php _e('Text only','share-and-follow'); ?> </option>
                                    <option <?php if ( 'iconOnly' == $devOptions['list_style'] ) echo 'selected="selected"'; ?> value="iconOnly"><?php _e('Icon only','share-and-follow'); ?> </option>
                            </select>
                         </li>
                </ul>
                <ul style="padding:0;margin:0;clear:left;">
                        <li style="float:left;width:50%;padding:0;margin:0">
                            <h3><?php _e('Use CSS single images or Image Sprites?','share-and-follow'); ?></h3>
                            <p><label for="css_images_yes"><input type="radio" id="css_images_yes" name="css_images" value="yes" <?php if ($devOptions['css_images'] == "yes") {echo "checked=\"checked\"";} ?> /> <?php _e('CSS Single image','share-and-follow'); ?></label><br />
                            <label for="css_images_no"><input type="radio" id="css_images_no" name="css_images" value="no" <?php if ($devOptions['css_images'] == "no") {echo "checked=\"checked\"";;} ?>/> <?php _e('CSS Sprites(default)','share-and-follow'); ?></label></p>
                            <p><?php _e('CSS sprites are massivly faster. CSS Single Images can be easily replaced with your own images','share-and-follow'); ?></p>
                         </li>
                         <li style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><label for="spacing"><?php _e('Icon spacing (in px)','share-and-follow'); ?> </label></h3>
                            <select  name="spacing" id="spacing" style="width:12em">
                                <?php for ( $counter = 0; $counter <= 10; $counter++) {?>
                                        <option value="<?php echo $counter; ?>" <?php if ($counter == $devOptions['spacing']) {echo 'selected="selected"';} ?>><?php echo $counter ?></option>
                                <?php } ?>
                            </select>
                            <h3><label for="top_padding"><?php _e('Padding above icons (in px)','share-and-follow'); ?> </label></h3>
                            <select  name="top_padding" id="top_padding" style="width:12em">
                                <?php for ( $counter = 0; $counter <= 40; $counter += 5) {?>
                                        <option value="<?php echo $counter; ?>" <?php if ($counter == $devOptions['top_padding']) {echo 'selected="selected"';} ?>><?php echo $counter ?></option>
                                <?php } ?>
                            </select>
                         </li>
                </ul>
                
                <ul style="padding:0;margin:0;clear:left;">
                        <li style="float:left;width:50%;padding:0;margin:0;">
                            <h3><?php _e('Show heading prefix','share-and-follow'); ?></h3>
                            <label for="share_yes"><input type="radio" id="share_yes" name="share" value="yes" <?php if ($devOptions['share'] == "yes") {echo "checked=\"checked\"";} ?> /> <?php _e('Yes','share-and-follow'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="share_no"><input type="radio" id="share_no" name="share" value="no" <?php if ($devOptions['share'] == "no" || empty($devOptions['share']) ) {echo "checked=\"checked\"";} ?>/> <?php _e('No','share-and-follow'); ?></label>
                        </li>
                        <li style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><?php _e('Heading text','share-and-follow'); ?></h3>
                                <label for="share_text"><?php _e('Share text ','share-and-follow'); ?></label> <input type="text" name="share_text" value="<?php echo $devOptions['share_text']; ?>" id="share_text"/>
                        </li>
                </ul>
                <h3><?php _e('Share Links to display','share-and-follow'); ?></h3>
                <p><?php _e('The popup text uses two case sensitive keywords, they are <strong>BLOG</strong> &amp; <strong>TITLE</strong>. The word <strong>BLOG</strong> is replaced with the word "post" or "blog", and the word <strong>TITLE</strong> is automatically replaced with the full title of your blog or post. ','share-and-follow'); ?></p>
                <table>
                    <thead>
                        <tr>
                            <th style="width:12em"><?php _e('Show','share-and-follow'); ?></th><th><?php _e('Link text','share-and-follow'); ?></th><th><?php _e('Popup text','share-and-follow'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php // setup sites to show automatically
                        global $allSites;
                        $args = array();
                        foreach ($allSites as $item => $value){
                            if($item == 'email' || $item == 'post_rss' || $item == 'bookmark' || $item == 'print'|| $item=='rss'){}
                            else{
                                if(strstr($value['service'],"share")){
                                    $args[]=$item;
                                }
                            }
                        }
                        sort($args);

                        $args[]='post_rss';
                        $args[]='print';
                        $args[]='bookmark';
                        ?>
                        <?php foreach ($args as $siteToShow) {?>
                        <tr>
                            <td>
                                <?php if ($siteToShow != 'post_rss'){?>
                                <img src="<?php echo WP_PLUGIN_URL; ?>/share-and-follow/images/blank.png" height="16px" width="16px" alt="<?php echo $siteToShow; ?>" style="background:transparent url(<?php echo WP_PLUGIN_URL; ?>/share-and-follow/default/16/sprite-16.png) no-repeat <?php echo str_replace(" ", "px ",$allSites[$siteToShow]['sprites']['16']) ?>px" />
                                <?php } elseif ($siteToShow == 'post_rss'){?>
                                <img src="<?php echo WP_PLUGIN_URL; ?>/share-and-follow/images/blank.png" height="16px" width="16px" alt="<?php echo $siteToShow; ?>" style="background:transparent url(<?php echo WP_PLUGIN_URL; ?>/share-and-follow/default/16/sprite-16.png) no-repeat <?php echo str_replace(" ", "px ",$allSites['rss']['sprites']['16']) ?>px" />
                                <?php } ?>
                                <input type="hidden" name="<?php echo $siteToShow; ?>" value="no" id="<?php echo $siteToShow; ?>">
                                <input type="checkbox" <?php if ( 'yes' == $devOptions[$siteToShow] ) {echo "checked=\"checked\"";} ?> name="<?php echo $siteToShow; ?>" value="yes" id="<?php echo $siteToShow; ?>"><label for="<?php echo $siteToShow; ?>"><?php echo str_replace("_", " ",getRightTitle($siteToShow)) ; ?></label></td>
                            <td><input type="text" name="<?php echo $siteToShow; ?>_share_text" id="<?php echo $siteToShow; ?>_share_text" value="<?php echo stripslashes  ($devOptions[$siteToShow.'_share_text']);?>" style="width:200px"/></td>
                            <td><input type="text" name="<?php echo $siteToShow; ?>_popup_text" id="<?php echo $siteToShow; ?>_popup_text" value="<?php echo stripslashes  ($devOptions[$siteToShow.'_popup_text']);?>" style="width:200px"/></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td><img src="<?php echo WP_PLUGIN_URL; ?>/share-and-follow/default/16/email.png" height="16px" width="16px" alt="post email" />
                                <input type="hidden" value="no" name="email" />
                                <input type="checkbox" <?php if ( 'yes' == $devOptions['email'] ) {echo "checked=\"checked\"";} ?> name="email" value="yes" id="_email"><label for="email">email</label></td>
                            <td><input type="text" name="email_share_text" id="email_share_text" value="<?php echo $devOptions['email_share_text'];?>" style="width:200px"/>
                               
                            </td>
                            <td><input type="text" name="email_popup_text" id="email_popup_text" value="<?php echo stripslashes  ($devOptions['email_popup_text']);?>" style="width:200px"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><h4><?php _e('What it says in the email message','share-and-follow'); ?></h4>
                                <textarea name="email_body_text"  id="email_body_text"  style="width:350px" rows="3" cols="20" ><?php echo stripslashes($devOptions['email_body_text']);?></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <ul style="padding:0;margin:0;clear:left;">
                  <li style="">
                  
                <h3><label for="add_short"><?php _e('Setup short URLs for twitter','share-and-follow'); ?></label></h3>
                <?php if (function_exists('json_decode')){ ?>
                <table class="like">
                <tr><td><label for="bit_ly"><?php _e('Bit.ly user name','share-and-follow'); ?></label></td><td><input type="text" name="bit_ly" value="<?php echo $devOptions['bit_ly'];  ?>" style="width:200px" id="bit_ly"/></td>
                </tr><tr><td><label for="bit_ly_code"><?php _e('Bit.ly API Code','share-and-follow'); ?></label></td><td><input type="text" name="bit_ly_code" value="<?php echo $devOptions['bit_ly_code']; ?>" style="width:200px" id="bit_ly_code"/></td>
                </tr><tr><td><label for="bit_ly_domain"><?php _e('Bit.ly Pro Domain (optional) ','share-and-follow'); ?></label></td><td><input type="text" name="bit_ly_domain" value="<?php echo $devOptions['bit_ly_domain']; ?>" style="width:200px" id="bit_ly_domain"/><br /><small><?php _e("Bit.ly pro domain only without 'http://', i.e. short.ie", 'share-and-follow'); ?></small></td></tr>
                </table>
                <p><?php _e('Setting up a <a href="http://bit.ly/a/sign_up">bit.ly account</a> and entering the details above, the system will automatically make URLs short for sharing on twitter.','share-and-follow'); ?></p><br />

                <?php }
                else {_e("Sorry, but you can't have short URLs until you upgrade your version of PHP to support JSON.  This means you need version PHP 5.2.0 or above to be installed on your server, please talk to your hosting company about it. ", 'share-and-follow');}
                ?>
                <h3><?php _e('What a tweets look like','share-and-follow'); ?></h3>
                <h4>Tweet Message</h4>
                 <input type="radio" <?php if ( 'clean' == $devOptions['twitter_text'] ) {echo "checked=\"checked\"";} ?> name="twitter_text" value="clean" ><label for="twitter_text"><?php _e('Just the URL','share-and-follow'); ?></label><br />
                 <input type="radio" <?php if ( 'title' == $devOptions['twitter_text'] ) {echo "checked=\"checked\"";} ?> name="twitter_text" value="title" ><label for="twitter_text"><?php _e('Title of the post or page and the URL','share-and-follow'); ?></label><br />
                 <b><?php _e('Default message to prefix the URL', 'share-and-follow') ?></b><br />
                 <input type="text" name="twitter_text_default" style="width:200px" value="<?php echo $devOptions['twitter_text_default']; ?>" />
                 <p><?php _e('Entering a message in here will make that the default for all tweets. If you add the custom field of "twitter_text" in a post, the value will be a unique message','share-and-follow'); ?></p>
                 <h4><?php _e('Tweet Suffix','share-and-follow'); ?> <small><?php _e('what it says after the tweet','share-and-follow'); ?></small></h4>
                 <input type="text" name="twitter_text_suffix" style="width:200px"  value="<?php echo $devOptions['twitter_text_suffix']; ?>" />
                 <p><?php _e('Entering a message in here will make that the default for all tweets. The ideal way to use this is for adding "VIA @twittername" to the end of tweets automatically.  If you add the custom field of "twitter_suffix" in a post, the value will be a unique suffix for the tweet','share-and-follow'); ?></p>
                    </li>
                </ul>

                 <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                 </div>
     
            <div style="float:left;width:580px;margin-top:20px;" class="rounded">
                    <?php wp_nonce_field('update-options'); ?>
                <h1><?php _e('Follow Side/Top/Bottom Tab setup','share-and-follow'); ?></h1>
                <h3><?php _e('Show the Follow Tab on Screen','share-and-follow'); ?></h3>
                <p><?php _e('Selecting "No" will disable the content from being added into to your website.','share-and-follow'); ?></p>
                <p><label for="add_follow_yes"><input type="radio" id="add_follow_yes" name="add_follow" value="true" <?php if ($devOptions['add_follow'] == "true") {echo "checked=\"checked\"";} ?> /><?php _e('Yes','share-and-follow'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="add_follow_no"><input type="radio" id="add_follow_no" name="add_follow" value="false" <?php if ($devOptions['add_follow'] == "false") {echo "checked=\"checked\"";} ?>/><?php _e('No','share-and-follow'); ?></label></p>
                <ul style="padding:0;margin:0">
                    <li style="padding:0;margin:0;clear:left;">
                         <h3><?php _e('Where to show the follow tab','share-and-follow'); ?></h3>
                         <p><?php _e('Choose where on your site the follow icons will be automatically added','share-and-follow'); ?></p>
                        <?php $args = array ('follow_page'=>__('pages','share-and-follow'), 'follow_post'=>__('posts','share-and-follow'), 'follow_author'=>__ ('author pages','share-and-follow'), 'follow_home'=>__('home page','share-and-follow'), 'follow_archive'=>__('tags, archive or catagory page','share-and-follow'), ); ?>
                        <?php foreach($args as $key=>$value){
                            ?>
                        <input type="hidden" value="no" name="<?php echo $key; ?>" />
                        <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                            <?php
                        } ?>
                        <label><?php _e('exclude these IDs :','share-and-follow'); ?></label><input type="text" name="excluded_follow_pages" value="<?php echo $devOptions['excluded_follow_pages']; ?>">
                        <p><?php _e('exclude pages or posts by entering IDs as a comma separated list. i.e. 1, 2, 3, 4   (ideal for homepage when you have a splash page, or part of your buy process.)','share-and-follow'); ?></p>

                        </li>
                    <li style="float:left;width:50%;padding:0;margin:0">
                        <h3><?php _e('Background Color','share-and-follow'); ?></h3>
                        <div id="colorSelector"></div>
                                
                               #<input type="text" name="background_color" id="background_color" value="<?php echo $devOptions['background_color'];?>"/><br />
                               <input type="hidden" name="background_transparent" value="no" />
                               <input type="checkbox" <?php if ( 'yes' == $devOptions['background_transparent'] ) {echo "checked=\"checked\"";} ?> name="background_transparent" value="yes" id="background_transparent"> <label for="background_transparent"><?php _e('Transparent','share-and-follow'); ?></label></li>
                    <li  style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                        <h3><?php _e('Border Color','share-and-follow'); ?></h3>
                                
                               #<input type="text" name="border_color" id="border_color" value="<?php echo $devOptions['border_color'];?>"/> <br />
                                <input type="hidden" name="border_transparent" value="no" />
                               <input type="checkbox" <?php if ( 'yes' == $devOptions['border_transparent'] ) {echo "checked=\"checked\"";} ?> name="border_transparent" value="yes" id="border_transparent"><label for="border_transparent"><?php _e('No Border','share-and-follow'); ?></label></li>
                </ul>
                <p style="padding:0;margin:0;font-size:small;clear:left;"><?php _e('for example <b>#f60</b> is entered as <b>f60</b> or <b>#ff6600</b> becomes <b>ff6600</b>, clicking <b>Transparent</b> will make the tab have no color and <b>no border</b> will set the border to disapear','share-and-follow'); ?>.</p>
                 <ul style="padding:0;margin:0">
                        <li style="float:left;width:50%;padding:0;margin:0">
                            <h3><label for="follow_location"><?php _e('Follow Tab Location','share-and-follow'); ?> </label></h3>
                            <select  name="follow_location" id="follow_location" style="width:12em">
                            <option value="right" <?php if ("right" == $devOptions['follow_location'] ) {echo 'selected="selected"';} ?>  ><?php _e('Right','share-and-follow'); ?></option>
                            <option value="left" <?php if ("left" == $devOptions['follow_location']) {echo 'selected="selected"';} ?>><?php _e('Left','share-and-follow'); ?></option>
                            <option value="bottom" <?php if ("bottom" == $devOptions['follow_location']) {echo 'selected="selected"';} ?>><?php _e('Bottom','share-and-follow'); ?></option>
                            <option value="top" <?php if ("top" == $devOptions['follow_location']) {echo 'selected="selected"';} ?>><?php _e('Top','share-and-follow'); ?></option>
                            </select>
                        </li>
                        <li  style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><?php _e('Prefix with a heading','share-and-follow'); ?></h3>
                            <p><label for="add_follow_text_yes"><input type="radio" id="add_follow_text_yes" name="add_follow_text" value="true" <?php if ($devOptions['add_follow_text'] == "true") {echo "checked=\"checked\"";} ?> /><?php _e('Yes','share-and-follow'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="add_follow_text_no"><input type="radio" id="add_follow_text_no" name="add_follow_text" value="false" <?php if ($devOptions['add_follow_text'] == "false") {echo "checked=\"checked\"";} ?>/><?php _e('No','share-and-follow'); ?></label></p>
                        </li>
                        
                        <li style="padding:0;margin:0;width:48%;float:left;">
                            <h3><?php _e('Use CSS single images or Image Sprites?','share-and-follow'); ?></h3>
                            <p><label for="css_follow_images_yes"><input type="radio" id="css_follow_images_yes" name="css_follow_images" value="yes" <?php if ($devOptions['css_follow_images'] == "yes") {echo "checked=\"checked\"";} ?> /> <?php _e('CSS Single image','share-and-follow'); ?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
                            <label for="css_follow_images_no"><input type="radio" id="css_follow_images_no" name="css_follow_images" value="no" <?php if ($devOptions['css_follow_images'] == "no") {echo "checked=\"checked\"";} ?>/> <?php _e('CSS Sprites(default)','share-and-follow'); ?></label></p>
                            <p><?php _e('CSS sprites are massivly faster when dealing with many icons, but are very wasteful if you are just using 1 to 4 icons. Use same size as Share icons or Single Images for faster respose times with less icons. ','share-and-follow'); ?></small></p>
                         </li>
                         <li  style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                           <h3><label for='width_of_page_minimum'><?php _e('Minimum width of screen','share-and-follow'); ?> </label></h3>
                            <input type="text" name='width_of_page_minimum' id='width_of_page_minimum' value="<?php echo $devOptions['width_of_page_minimum']; ?>" />px
                            <p><?php _e('If you set this, it will use a bit of javascript to remove the Right or Left tab from the screen when the screen size is the same or smaller that the entered number.','share-and-follow'); ?></p>
                         </li>
                 </ul>
                    <ul style="padding:0;margin:0">
                        <li style="float:left;width:50%;padding:0;margin:0;clear:left;">
                            <h3><label for="follow_color"><?php _e('Follow Word Color','share-and-follow'); ?></label></h3>
                                <select  name="follow_color" id="follow_color" style="width:12em">
                                    <option value="f00" <?php if ("f00" == $devOptions['follow_color']){echo 'selected="selected"';} ?>><?php _e('Red','share-and-follow'); ?></option>
                                    <option value="f0f" <?php if ("f0f" == $devOptions['follow_color']){echo 'selected="selected"';} ?>><?php _e('Pink','share-and-follow'); ?></option>
                                    <option value="00f" <?php if ("00f" == $devOptions['follow_color']){echo 'selected="selected"';} ?>><?php _e('Blue','share-and-follow'); ?></option>
                                    <option value="fff" <?php if ("fff" == $devOptions['follow_color']){echo 'selected="selected"';} ?>><?php _e('White','share-and-follow'); ?></option>
                                    <option value="ccc" <?php if ("ccc" == $devOptions['follow_color']){echo 'selected="selected"';} ?>>#ccc</option>
                                    <option value="999" <?php if ("999" == $devOptions['follow_color']){echo 'selected="selected"';} ?>>#999</option>
                                    <option value="666" <?php if ("666" == $devOptions['follow_color']){echo 'selected="selected"';} ?>>#666</option>
                                    <option value="333" <?php if ("333" == $devOptions['follow_color']){echo 'selected="selected"';} ?>>#333</option>
                                    <option value="000" <?php if ("000" == $devOptions['follow_color']){echo 'selected="selected"';} ?>><?php _e('Black','share-and-follow'); ?></option>
                                </select>
                        </li>
                        <li style="padding:1px 0 5px 0 ;margin:15px 0 0 50%;">
                            <h3><?php _e('Follow Heading text replacement','share-and-follow'); ?></h3>
                            <p><label for="word_value"><?php _e('On screen text','share-and-follow'); ?></label> <input type="text" name="word_text" id="word_text" value="<?php echo $devOptions['word_text'];?>" style="width:150px"/></p>
                            <p><?php _e('Replacement Word','share-and-follow'); ?> <select  name="word_value" id="word_value" style="width:12em">
                                    <optgroup label="<?php _e('English words','share-and-follow'); ?>">
                                        <?php $eng = array ('follow'=>'follow','followme'=>'follow me','followus'=>'follow us','connect'=>'connect',
                                                            'communicate'=>'communicate','join'=>'join','network'=>'network','review'=>'review',) ?>
                                        <?php foreach ($eng as $key => $value) {?>
                                            <option value="<?php echo $key; ?>"  <?php if ($key == $devOptions['word_value'] ) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="<?php _e('Dutch words','share-and-follow'); ?>">
                                        <?php $nld = array ('aansluiten'=>'aansluiten','deelnemen'=>'deelnemen','mededeling'=>'mededeling','overzichten'=>'overzichten','toevoegen'=>'toevoegen',
                                                            'verbinden'=>'verbinden','volgen'=>'volgen','volgmij'=>'volg mij','volgons'=>'volg ons','volgonze'=>'volg onze',); ?>
                                        <?php foreach ($nld as $key => $value) {?>
                                            <option value="<?php echo $key; ?>"  <?php if ($key == $devOptions['word_value'] ) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="<?php _e('French words','share-and-follow'); ?>">
                                        <?php $fr = array ('ajouter'=>'ajouter','seconnecter'=>'se connecter','publications'=>'publications','rejoindre'=>'rejoindre','reseau'=>'r&eacute;seau','suivre'=>'suivre',); ?>
                                        <?php foreach ($fr as $key => $value) {?>
                                            <option value="<?php echo $key; ?>"  <?php if ($key == $devOptions['word_value'] ) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="<?php _e('Portuguese words','share-and-follow'); ?>">
                                        <?php $pt = array ('conectar'=>'conectar','comunicar'=>'comunicar','juntar'=>'juntar','rede'=>'rede','resenhas'=>'resenhas','seguir'=>'seguir',
                                                            'sigame'=>'siga-me','siganos'=>'siga-nos',); ?>
                                        <?php foreach ($pt as $key => $value) {?>
                                            <option value="<?php echo $key; ?>"  <?php if ($key == $devOptions['word_value'] ) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="<?php _e('Spanish words','share-and-follow'); ?>">
                                        <?php $es = array ('seguir'=>'seguir'); ?>
                                        <?php foreach ($es as $key => $value) {?>
                                            <option value="<?php echo $key; ?>"  <?php if ($key == $devOptions['word_value'] ) {echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                                </p>
                        </li>
                    </ul>
                    <p><?php _e('The text replacement only applies to the side tabs.  It has been made that way to give virtical text, but does limit the word choices.  Use a top or bottom tab to show the text that you want, not the replacement text.','share-and-follow')?></p>
                    <ul style="padding:0;margin:0">
                        <li style="float:left;width:50%;padding:0;margin:0">
                           <h3><label for="follow_list_style"><?php _e('Follow icons display style','share-and-follow'); ?></label></h3>
                            <select id="follow_list_style" name="follow_list_style" style="width:12em">
                                    <?php if ( $devOptions['follow_location'] == 'bottom'||$devOptions['follow_location'] == 'top'){?><option <?php if ( 'icon_text' == $devOptions['follow_list_style'] ) echo 'selected="selected"'; ?> value="icon_text"><?php _e('Icon and Text','share-and-follow'); ?></option><?php } ?>
                                    <?php if ( $devOptions['follow_location'] == 'bottom'||$devOptions['follow_location'] == 'top'){?><option <?php if ( 'text_only' == $devOptions['follow_list_style'] ) echo 'selected="selected"'; ?> value="text_only"><?php _e('Text only','share-and-follow'); ?> </option><?php } ?>
                                    <option <?php if ( 'text_replace' == $devOptions['follow_list_style'] ) echo 'selected="selected"'; ?> value="text_replace"><?php _e('Text replacement','share-and-follow'); ?></option>
                                    <option <?php if ( 'iconOnly' == $devOptions['follow_list_style'] ) echo 'selected="selected"'; ?> value="iconOnly"><?php _e('Icon only','share-and-follow'); ?> </option>
                            </select>
                       </li>
                        <li style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><label for="tab_size"><?php _e('Size of Follow Icons on tab','share-and-follow'); ?></label></h3>
                            <select  name="tab_size" id="tab_size" style="width:12em">
                                <?php $args = array ('16','24','32','48','60') ?>
                                <?php foreach ($args as $sizeToShow) {?>
                                    <option value="<?php echo $sizeToShow; ?>" <?php if ($sizeToShow == $devOptions['tab_size']) {echo 'selected="selected"';} ?>><?php echo $sizeToShow; ?>x<?php echo $sizeToShow; ?></option>
                                <?php } ?>
                            </select>
                        </li>
                    </ul>


                    <ul style="padding:0;margin:0">
                        <li style="float:left;width:50%;padding:0;margin:0">
                           <h3><label for="follow_list_spacing"><?php _e('Follow tab icons spacing','share-and-follow'); ?></label></h3>
                            <select id="follow_list_spacing" name="follow_list_spacing" style="width:12em">
                                <?php   for ( $counter = 0 ; $counter <= 15; $counter += 1) { ?>
                                    <option value="<?php echo $counter; ?>" <?php if ($counter == $devOptions['follow_list_spacing']) {echo 'selected="selected"';} ?>><?php echo $counter; ?>px</option>
                                <?php } ?>
                            </select>
                       </li>
                        <li style="padding:1px 0 5px 0 ;margin:0 0 0 50%">
                            <h3><label for="distance_from_top"><?php _e('Side tab distance from top of screen','share-and-follow'); ?></label></h3>
                            <select  name="distance_from_top" id="distance_from_top" style="width:12em">
                                <?php for ( $counter = 0; $counter <= 200; $counter += 10) { ?>
                                    <option value="<?php echo $counter; ?>" <?php if ($counter == $devOptions['distance_from_top']) {echo 'selected="selected"';} ?>><?php echo $counter?>px</option>
                                <?php } ?>
                            </select>
                        </li>
                    </ul>



                       <h3 id="enterlinks"><?php _e('Follow Links  to display in the follow tab (also needed for follow widget)','share-and-follow'); ?></h3>
                       <table style="width:100%">
                           <thead><tr><th style="width:12em"><?php _e('Show','share-and-follow'); ?></th><th><?php _e('Link Text','share-and-follow'); ?></th><th ><?php _e('Link destination','share-and-follow'); ?></th></tr></thead>
                           <tbody>
                            <?php // setup sites to show automatically ?>

                            <?php 
                            // global $shareAndFollowFollowIcons;
                            global $allSites;
                            $args = array();
                            foreach ($allSites as $item => $value){
                                if(strstr($value['service'],"follow")){
                                    if ($item!='rss'){
                                    $args[]=$item;
                                    }
                                }
                            }

                            ?>
                            <?php // loop through showing all items after sorting it to be alphabetic ?>
                            <?php sort($args); ?>
                            <?php foreach ($args as $siteToShow) {?>
                               <tr>
                                   <td><img src="<?php echo WP_PLUGIN_URL; ?>/share-and-follow/images/blank.png" height="16px" width="16px" alt="<?php echo $siteToShow; ?>" style="background:transparent url(<?php echo WP_PLUGIN_URL; ?>/share-and-follow/default/16/sprite-16.png) no-repeat <?php echo str_replace(" ", "px ",$allSites[$siteToShow]['sprites']['16']) ?>px" />
                                    <input type="hidden" name="follow_<?php echo $siteToShow; ?>" value="no" id="follow_<?php echo $siteToShow; ?>">
                                    <input type="checkbox" <?php if ( 'yes' == $devOptions['follow_'.$siteToShow] ) {echo "checked=\"checked\"";} ?> name="follow_<?php echo $siteToShow; ?>" value="yes" id="follow_<?php echo $siteToShow; ?>"><label for="follow_<?php echo $siteToShow; ?>"><?php echo str_replace("_", " ",$siteToShow) ; ?></label>
                                   </td>
                                   <td><input type="text" name="<?php echo $siteToShow; ?>_link_text" id="<?php echo $siteToShow; ?>_link_text" value="<?php echo stripslashes  ($devOptions[$siteToShow.'_link_text']);?>" style="width:95%"/></td>
                                   <td><input type="text" name="<?php echo $siteToShow; ?>_link" id="<?php echo $siteToShow; ?>_link" value="<?php echo $devOptions[$siteToShow.'_link'];?>" style="width:100%"/><td>
                               </tr>
                            <?php } ?>
                                <tr>
                                   <td><img src="<?php echo WP_PLUGIN_URL; ?>/share-and-follow/default/16/rss.png" height="16px" width="16px" alt="rss" />
                                   <input type="hidden" value="no" name="follow_rss" />
                                   <input type="checkbox" <?php if ( 'yes' == $devOptions['follow_rss'] ) {echo "checked=\"checked\"";} ?> name="follow_rss" value="yes" id="follow_rss"><label for="follow_rss">rss</label></td>
                                   <td><input type="text" name="rss_link_text" id="rss_link_text" value="<?php echo stripslashes  ($devOptions['rss_link_text']);?>" style="width:95%"/></td>
                                   <td>
                                      <label for="rss_style_rss"><input type="radio" id="rss_style_rss" name="rss_style" value="rss_url" <?php if ($devOptions['rss_style'] == "rss_url") {_e('checked="checked"', "shareAndcss");} ?> /><?php _e('rss', 'share-and-follow') ?></label>&nbsp;&nbsp;
                                      <label for="rss_style_rss2"><input type="radio" id="rss_style_rss2" name="rss_style" value="rss2_url" <?php if ($devOptions['rss_style'] == "rss2_url") {_e('checked="checked"', "shareAndcss");} ?>/><?php _e('rss2', 'share-and-follow') ?></label>&nbsp;&nbsp;
                                      <label for="rss_style_atom"><input type="radio" id="rss_style_atom" name="rss_style" value="atom_url" <?php if ($devOptions['rss_style'] == "atom_url") {_e('checked="checked"', "shareAndcss");} ?>/><?php _e('atom', 'share-and-follow') ?></label>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                       <p><b><em><?php _e('Important', 'share-and-follow') ?>:</em></b> <?php _e('Always put in the full URL with http:// at the beginning when entering a Link Destination.', 'share-and-follow') ?> </p>

                    <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                </div>
        <div style="clear:both;"></div>
               <div style="float:left;width:580px;margin-right:10px;margin-top:20px; clear:both;" class="rounded">
                <h1><?php _e('Interactive Share Buttons','share-and-follow'); ?></h1>
                <h2><?php _e('Facebook Like button','share-and-follow'); ?></h2>
                <table class="like">
                    <tr>
                        <th><label for="like_locations"><?php _e('Choose the locations where you want to show the like button', 'share-and-follow') ?></label></th>
                        <td><?php $args =array('like_topleft','like_topright','like_bottom'); ?>
                            <?php foreach ($args as $locations) { ?>
                            <input type="hidden" name="<?php echo $locations; ?>" value="no" id="<?php echo $locations; ?>">
                            <input type="checkbox" <?php if ( 'yes' == $devOptions[$locations] ) {echo "checked=\"checked\"";} ?> name="<?php echo $locations; ?>" value="yes" id="<?php echo $locations; ?>"><label for="<?php echo $locations; ?>"><?php echo str_replace("like_", "",getRightTitle($locations)) ; ?></label><br />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="like_style"><?php _e('Like button style', 'share-and-follow') ?></label></th>
                        <td>
                            <select  name="like_style" id="like_style" style="width:200px">
                            <?php $args =array('standard','box_count','button_count'); ?>
                            <?php foreach ($args as $buttonStyles) { ?>
                                    <option value="<?php echo $buttonStyles; ?>" <?php if ($buttonStyles == $devOptions['like_style']){echo 'selected="selected"';} ?>><?php echo $buttonStyles; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="like_width"><?php _e('Like button width', 'share-and-follow') ?></label>
                        </th>
                        <td>
                            <input type="text" name="like_width" id="like_width" value="<?php echo stripslashes  ($devOptions['like_width']);?>" style="width:200px"/>
                        </td>
                    </tr>
                     <tr>
                        <th>
                            <label for="like_faces"><?php _e('Show faces of people who like the page or post', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <input type="hidden" name="like_faces" value="false" id="like_faces">
                           <input type="checkbox" <?php if ( 'true' == $devOptions['like_faces'] ) {echo "checked=\"checked\"";} ?> name="like_faces" value="true" id="<?php echo $locations; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="like_verb"><?php _e('Like or Recommend?', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <select  name="like_verb" id="like_verb" style="width:200px">
                            <?php $args =array('like','recommend',); ?>
                            <?php foreach ($args as $verb) { ?>
                                    <option value="<?php echo $verb; ?>" <?php if ($verb == $devOptions['like_verb']){echo 'selected="selected"';} ?>><?php echo $verb; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="like_color"><?php _e('Like or Recommend?', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <select  name="like_color" id="like_color" style="width:200px">
                            <?php $args =array('light', 'dark',); ?>
                            <?php foreach ($args as $color) { ?>
                                    <option value="<?php echo $color; ?>" <?php if ($color == $devOptions['like_color']){echo 'selected="selected"';} ?>><?php echo $color; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="like_font"><?php _e('Button font', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <select  name="like_font" id="like_font" style="width:200px">
                            <?php $args =array('arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'); ?>
                            <?php foreach ($args as $font) { ?>
                                    <option value="<?php echo $font; ?>" <?php if ($font == $devOptions['like_font']){echo 'selected="selected"';} ?>><?php echo $font; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>

                </table>
                  <h2><?php _e('Twitter Retweet button','share-and-follow'); ?></h2>
                <table class="like">
                    <tr>
                        <th><label for="tweet_locations"><?php _e('Choose the locations where you want to show the like button', 'share-and-follow') ?></label></th>
                        <td><?php $args =array('tweet_topleft','tweet_topright','tweet_bottom'); ?>
                            <?php foreach ($args as $locations) { ?>
                            <input type="hidden" name="<?php echo $locations; ?>" value="no" id="<?php echo $locations; ?>">
                            <input type="checkbox" <?php if ( 'yes' == $devOptions[$locations] ) {echo "checked=\"checked\"";} ?> name="<?php echo $locations; ?>" value="yes" id="<?php echo $locations; ?>"><label for="<?php echo $locations; ?>"><?php echo str_replace("tweet_", "",getRightTitle($locations)) ; ?></label><br />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tweet_width"><?php _e('Width of the tweet button', 'share-and-follow') ?></label></th>
                        <td> <input type="text" name="tweet_width" id="tweet_width" value="<?php echo stripslashes ($devOptions['tweet_width']);?>" style="width:200px"/>
                        </td>
                    </tr>
                     <tr>
                        <th>
                            <label for="tweet_style"><?php _e('Button style', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <select  name="tweet_style" id="tweet_style" style="width:200px">
                            <?php $args =array('vertical', 'horizontal', 'none'); ?>
                            <?php foreach ($args as $style) { ?>
                                    <option value="<?php echo $style; ?>" <?php if ($style == $devOptions['tweet_style']){echo 'selected="selected"';} ?>><?php echo $style; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <th><label for="tweet_via"><?php _e('Via setting, enter your twitter name (optional)', 'share-and-follow') ?></label></th>
                        <td> <input type="text" name="tweet_via" id="tweet_via" value="<?php echo stripslashes ($devOptions['tweet_via']);?>" style="width:200px"/><br />
                        </td>
                    </tr>
                </table>


                  <h2><?php _e('Stumble Upon button','share-and-follow'); ?></h2>
                <table class="like">
                    <tr>
                        <th><label for="stumble_locations"><?php _e('Choose the locations where you want to show the like button', 'share-and-follow') ?></label></th>
                        <td><?php $args =array('stumble_topleft','stumble_topright','stumble_bottom'); ?>
                            <?php foreach ($args as $locations) { ?>
                            <input type="hidden" name="<?php echo $locations; ?>" value="no" id="<?php echo $locations; ?>">
                            <input type="checkbox" <?php if ( 'yes' == $devOptions[$locations] ) {echo "checked=\"checked\"";} ?> name="<?php echo $locations; ?>" value="yes" id="<?php echo $locations; ?>"><label for="<?php echo $locations; ?>"><?php echo str_replace("stumble_", "",getRightTitle($locations)) ; ?></label><br />
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="stumble_style"><?php _e('Button style', 'share-and-follow') ?></label>
                        </th>
                        <td>
                           <select  name="stumble_style" id="stumble_style" style="width:200px">
                            <?php $args =array('vertical count' =>'5', 'horizontal count rounded'=>'2', 'horizontal count square'=>'1', 'horizontal count borderless' =>'3'); ?>
                            <?php foreach ($args as $style => $value) { ?>
                                    <option value="<?php echo $value; ?>" <?php if ($value == $devOptions['stumble_style']){echo 'selected="selected"';} ?>><?php echo $style; ?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>



            <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
            </div>
      <div style="margin-top:20px;float:left;width:580px;margin-right:10px;"  class="rounded">
             <h1 id="share-image"><?php _e('Setup share image', 'share-and-follow') ?></h1>
             <p><?php _e('By setting up a share image, social networks such as Facebook will choose that share image as its primary image to display on screen in news feeds inside facebook. This is especially useful if the theme is made of only image replacement images rather than HTML tag images, as facebook will now have the opportunity to show an image rather than none at all', 'share-and-follow') ?>.</p>
             <h3><?php _e('Show Share Images', 'share-and-follow') ?></h3>
             <p><?php _e('Add the share image metadata to the head section of your web pages.  Saying "no" will remove the functionality', 'share-and-follow') ?>.</p>
             <p><label for="add_image_link_yes"><input type="radio" id="add_image_link_yes" name="add_image_link" value="true" <?php if ($devOptions['add_image_link'] == "true") {_e('checked="checked"', "shareAndcss");} ?> /><?php _e('Yes', 'share-and-follow') ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="add_image_link_no"><input type="radio" id="add_image_link_no" name="add_image_link" value="false" <?php if ($devOptions['add_image_link'] == "false") {_e('checked="checked"', "shareAndcss");} ?>/><?php _e('No', 'share-and-follow') ?></label></p>
             <h3><?php _e('Setup Default Gravatar image', 'share-and-follow') ?> <small><a href="http://gravatar.com/" target="_blank">goto gravatar</a></small></h3>
                <?php _e('enter your email address', 'share-and-follow') ?> <input type="email" name="default_email" id="default_email" value="<?php echo $devOptions['default_email'];?>" /><br />
                <?php _e('alternative default image', 'share-and-follow') ?> <input type="text" name="default_email_image" id="default_email_image" value="<?php echo $devOptions['default_email_image'];?>" />
                <p><?php _e('You can choose an alternative image to display rather than the standard gravatar one, if so, enter the URL here including http://, useful for high volume sites.', 'share-and-follow') ?></p>
                <h3><?php _e('Author Settings', 'share-and-follow') ?></h3>
                    <input type="radio" <?php if ( 'default' == $devOptions['author_defaults'] ) {echo "checked=\"checked\"";} ?> name="author_defaults" value="default" ><label for="author_defaults"><?php _e('Use default gravatar','share-and-follow'); ?></label><br />
                    <input type="radio" <?php if ( 'authors' == $devOptions['author_defaults'] ) {echo "checked=\"checked\"";} ?> name="author_defaults" value="authors" ><label for="author_defaults"><?php _e('Use author email to generate gravatar','share-and-follow'); ?></label><br />
                <h3><?php _e('Site Logo setup', 'share-and-follow') ?></h3>
                <?php _e('enter image URL', 'share-and-follow') ?> <input type="text" name="logo_image_url" value="<?php echo $devOptions['logo_image_url']; ?>" />
                <p><?php _e('Include http:// in the URL, make sure that the image is no larger than 130px wide by 110px high.', 'share-and-follow') ?></p>
                <p><?php _e('<strong><em>Important:</em></strong> the system will default to this image if there is not an image in a post or page that it can find.','share-and-follow')?></p>
                <h3><?php _e('Setup image logic: Who, What, Where.', 'share-and-follow') ?></h3>
                <table class="logic">
                    <tr><th style="width:160px"><?php _e('Type of page', 'share-and-follow') ?></th><th><?php _e('Display logic', 'share-and-follow') ?></th></tr>
                    <tr>
                        <td><?php _e('Pages', 'share-and-follow') ?></td>
                        <td> <input type="radio" <?php if ( 'gravatar' == $devOptions['page_img'] ) {echo "checked=\"checked\"";} ?> name="page_img" value="gravatar" ><label for="page_img"><?php _e('Author Gravatar','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'logo' == $devOptions['page_img'] ) {echo "checked=\"checked\"";} ?> name="page_img" value="logo" ><label for="page_img"><?php _e('Site Logo','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'postImage' == $devOptions['page_img'] ) {echo "checked=\"checked\"";} ?> name="page_img" value="postImage" ><label for="page_img"><?php _e('Image from page','share-and-follow'); ?></label><br />
                             <h4><?php _e('optional default image', 'share-and-follow') ?></h4>
                             <input type="text" name="page_image_url" value="<?php echo $devOptions['page_image_url']; ?>" />
                             <br /><small><?php _e('Enter full URL including http:// to the image you want to use. Making the field blank will restore the radio button logic', 'share-and-follow') ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Posts', 'share-and-follow') ?></td>
                        <td> <input type="radio" <?php if ( 'gravatar' == $devOptions['post_img'] ) {echo "checked=\"checked\"";} ?> name="post_img" value="gravatar" ><label for="post_img"><?php _e('Author Gravatar','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'logo' == $devOptions['post_img'] ) {echo "checked=\"checked\"";} ?> name="post_img" value="logo" ><label for="post_img"><?php _e('Site Logo','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'postImage' == $devOptions['post_img'] ) {echo "checked=\"checked\"";} ?> name="post_img" value="postImage" ><label for="post_img"><?php _e('Image from post','share-and-follow'); ?></label><br />
                             <h4><?php _e('optional default image', 'share-and-follow') ?></h4>
                             <input type="text" name="post_image_url" value="<?php echo $devOptions['post_image_url']; ?>" />
                             <br /><small><?php _e('Enter full URL including http:// to the image you want to use. Making the field blank will restore the radio button logic', 'share-and-follow') ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Homepage', 'share-and-follow') ?></td>
                        <td> <input type="radio" <?php if ( 'gravatar' == $devOptions['homepage_img'] ) {echo "checked=\"checked\"";} ?> name="homepage_img" value="gravatar" ><label for="homepage_img"><?php _e('Default Author Gravatar','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'logo' == $devOptions['homepage_img'] ) {echo "checked=\"checked\"";} ?> name="homepage_img" value="logo" ><label for="homepage_img"><?php _e('Site Logo','share-and-follow'); ?></label><br />
                             <h4><?php _e('optional default image', 'share-and-follow') ?></h4>
                             <input type="text" name="homepage_image_url" value="<?php echo $devOptions['homepage_image_url']; ?>" />
                             <br /><small><?php _e('Enter full URL including http:// to the image you want to use. Making the field blank will restore the radio button logic', 'share-and-follow') ?></small>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Archive pages', 'share-and-follow') ?></td>
                        <td> <input type="radio" <?php if ( 'gravatar' == $devOptions['archive_img'] ) {echo "checked=\"checked\"";} ?> name="archive_img" value="gravatar" ><label for="archive_img"><?php _e('Default Author Gravatar','share-and-follow'); ?></label><br />
                             <input type="radio" <?php if ( 'logo' == $devOptions['archive_img'] ) {echo "checked=\"checked\"";} ?> name="archive_img" value="logo" ><label for="archive_img"><?php _e('Site Logo','share-and-follow'); ?></label><br />
                             <h4><?php _e('optional default image', 'share-and-follow') ?></h4>
                             <input type="text" name="archive_image_url" value="<?php echo $devOptions['archive_image_url']; ?>" />
                             <br /><small><?php _e('Enter full URL including http:// to the image you want to use. Making the field blank will restore the radio button logic', 'share-and-follow') ?></small>
                        </td>
                    </tr>
                </table>
                <p><?php _e('It is possible to have a specific image setup in a post or page, by adding a custom field called "image_src" and setting an image URL uniquely for that page or post', 'share-and-follow') ?></p>
                <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                <br />
            </div>
          <div style="margin-top:20px;float:left;width:580px;"  class="rounded">
             <h1><?php _e('CSS and style Configuration', 'share-and-follow') ?></h1>
             <h3><?php _e('Use external CSS?', 'share-and-follow') ?></h3>
             <p><?php _e('You have the choice to use an external stylesheet or a style section in the head of the HTML.  If you are using caching and need an ultra fast site, say NO as it will reduce the number of connections.  As it generates the style setion in the head on-the-fly it is slower to do it this way without using caching.  If you need to know, the plugin uses the following external CSS file', 'share-and-follow') ?> <strong>/wp-content/plugins/share-and-follow/css/stylesheet.css</strong>.</p>
                <p><label for="add_css_yes"><input type="radio" id="add_css_yes" name="add_css" value="true" <?php if ($devOptions['add_css'] == "true") {_e('checked="checked"', "shareAndcss");} ?> /><?php _e('Yes', 'share-and-follow') ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="add_css_no"><input type="radio" id="add_css_no" name="add_css" value="false" <?php if ($devOptions['add_css'] == "false") {_e('checked="checked"', "shareAndcss");} ?>/><?php _e('No', 'share-and-follow') ?></label></p>
                <p><?php _e('be careful as it reloads the CSS dynamically evey time there is a change to the admin screen', 'share-and-follow') ?></p>
                <h3><?php _e('Add your own CSS', 'share-and-follow') ?></h3>
                    <textarea cols="20" rows="10" style="width:100%"  name="extra_css" ><?php echo stripslashes($devOptions['extra_css']) ?></textarea>
                <h3><?php _e('Add theme support', 'share-and-follow') ?></h3>
                <p><?php _e('Wordpress has many themes, slowly over time we will be adding more and more CSS packs to support those themes. For now we have a selection of the top ones. <em>Please note</em> that Kubric/Default will work for most themes no matter what the name, as they have been based on this theme originally.', 'share-and-follow') ?></p>
                <select  name="theme_support" id="theme_support" style="width:12em">
                    <option value="none" <?php if ("none" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>none</option>
                    <option value="default" <?php if ("default" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Kubric/Default</option>
                    <option value="choco" <?php if ("choco" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>ChocoTheme</option>
                    <option value="arjuna" <?php if ("arjuna" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Arjuna X</option>
                    <option value="intrepidity" <?php if ("intrepidity" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Intrepidity</option>
                    <option value="dojo" <?php if ("dojo" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Dojo</option>
                    <option value="thesis" <?php if ("thesis" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Thesis</option>
                    <option value="tribune" <?php if ("tribune" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Tribune</option>
                    <option value="mymag" <?php if ("mymag" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>MyMag</option>
                    <option value="frugal" <?php if ("frugal" == $devOptions['theme_support']) {echo 'selected="selected"';} ?>>Frugal</option>
                </select>
                <h3><?php _e('Page Print Support', 'share-and-follow') ?></h3>
                <h3><?php _e('Do you want to load a print CSS file?', 'share-and-follow') ?></h3>
                <p><?php _e('If you already have your own Print CSS file, then it is best to set this to NO, otherwise feel free to use the Share and Follow one.  If you need to find the CSS file it is in <br />', 'share-and-follow') ?> <strong>/wp-content/plugins/share-and-follow/css/print.css</strong>.</p>
                <p><label for="print_support_yes"><input type="radio" id="print_support_yes" name="print_support" value="true" <?php if ($devOptions['print_support'] == "true") {_e('checked="checked"', "shareAndcss");} ?> /><?php _e('Yes', 'share-and-follow') ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label for="print_support_no"><input type="radio" id="print_support_no" name="print_support" value="false" <?php if ($devOptions['print_support'] == "false") {_e('checked="checked"', "shareAndcss");} ?>/><?php _e('No', 'share-and-follow') ?></label></p>
                <p><?php _e('be careful as it reloads the CSS dynamically evey time there is a change to the admin screen', 'share-and-follow') ?></p>
                <p><?php _e('Printing a page is different to reading it from the screen. There are many things that do not need to be there on a printed page, such as the menu or navigation.  Use the entry box to provide a comment list of CSS selectors to help control how your printouts look.  By default a few have been added to help you.', 'share-and-follow') ?></p>
                    <input type="text" name="css_print_excludes" value="<?php echo $devOptions['css_print_excludes']; ?>" style="width:80%"/>
                <br />
                <h3><?php _e('Add your own Print CSS ', 'share-and-follow') ?></h3>
                    <textarea cols="20" rows="10" style="width:100%"  name="extra_print_css" ><?php echo stripslashes($devOptions['extra_print_css']) ?></textarea>
                    <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                <br />
            </div>
        <div style="margin-top:20px;float:left;width:580px;margin-left:10px"  class="rounded">
            <h1><?php _e('Plugin Support', 'share-and-follow') ?></h1>
            <p><?php _e('Some plugins and optional extras for wordpress have different ways of working than the normal wordpress way.  To get over this the makers of these plugins make Hooks and Functions for programmers to use.  Slowly over time we will add more plugin support for plugins that actually have hooks that we can connect to.  Otherwise we will offer support via just a template tag', 'share-and-follow') ?></p>
            <h2><?php _e('WP e-Commerce support', 'share-and-follow') ?></h2>
            <h3><?php _e('The location where the share icons show', 'share-and-follow') ?></h3>
            <?php $args = array ('wpsc_top_of_products_page'=>__('Top of products page','share-and-follow'), 'wpsc_product_before_description'=>__('Before description','share-and-follow'), 'wpsc_product_addon_after_descr'=>__ ('After Description','share-and-follow'), ); ?>
                <?php foreach($args as $key=>$value){
                    ?>
                <input type="hidden" value="no" name="<?php echo $key; ?>" />
                <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                    <?php
                } ?>
                <br />
            <h3><?php _e('The location where the interactive icons show', 'share-and-follow') ?></h3>
            <h4>facebook Like button</h4>
            <?php $args = array ('like_wpsc_top_of_products_page'=>__('Top of products page','share-and-follow'), 'like_wpsc_product_before_description'=>__('Before description','share-and-follow'), 'like_wpsc_product_addon_after_descr'=>__ ('After Description','share-and-follow'), ); ?>
                <?php foreach($args as $key=>$value){
                    ?>
                <input type="hidden" value="no" name="<?php echo $key; ?>" />
                <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                    <?php
                } ?>
                <br />
                <h4>Twitter Retweet</h4>
                <?php $args = array ('tweet_wpsc_top_of_products_page'=>__('Top of products page','share-and-follow'), 'tweet_wpsc_product_before_description'=>__('Before description','share-and-follow'), 'tweet_wpsc_product_addon_after_descr'=>__ ('After Description','share-and-follow'), ); ?>
                <?php foreach($args as $key=>$value){
                    ?>
                <input type="hidden" value="no" name="<?php echo $key; ?>" />
                <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                    <?php
                } ?>
                <h4>Stumble Upon Count Button</h4>
                <?php $args = array ('stumble_wpsc_top_of_products_page'=>__('Top of products page','share-and-follow'), 'stumble_wpsc_product_before_description'=>__('Before description','share-and-follow'), 'stumble_wpsc_product_addon_after_descr'=>__ ('After Description','share-and-follow'), ); ?>
                <?php foreach($args as $key=>$value){
                    ?>
                <input type="hidden" value="no" name="<?php echo $key; ?>" />
                <input type="checkbox" <?php if ( 'yes' == $devOptions[$key] ) {echo "checked=\"checked\"";} ?> name="<?php echo $key; ?>" value="yes" id="<?php echo $key; ?>"/><label for="<?php echo $key; ?>"><?php echo $value; ?></label><br />
                    <?php
                } ?>

                <input type="submit" name="update_share-and-follow" value="<?php _e('Update Settings', 'share-and-follow') ?>" />
                <br />
        </div>
    </form>
        <div class="submit">
        </div>
</div>

     <div style="margin:20px 0 0 10px;float:left;width:580px;"  class="rounded">
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
                <h1 id="reset-settings"><?php _e('Reset settings?', 'share-and-follow') ?></h1>
                <p><?php _e('Want to reset the settings of Share and Follow? click the reset button below to restore the installation defaults.', 'share-and-follow') ?></p>
                <p><?php _e('<em><b>important:</b></em> this will remove all of your settings.  You might want to save this page so you have a listing of your settings before pressing the reset button', 'share-and-follow') ?></p>
                <input type="submit" name="reset_share-and-follow" value="<?php _e('Reset Settings', 'share-and-follow') ?>" />
                </form>
     </div>
<?php } } ?>