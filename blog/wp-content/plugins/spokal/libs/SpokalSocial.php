<?php

class SP_Social
{
    private $types = array(
        "2" => "Twitter",
        "3" => "Facebook",
        "4" => "LinkedIn",
        "5" => "Buffer",
    );
    
    private $site_url = "";
    
    public $socialAccouts = array();
        
    private $disabeld_accounts = array();
    
    private $enabled_accounts = array();
    
    private $plugin_url = "";
    
    private $enable_social = true;
    
    private $post_ID = 0;
    
    private $post_type = "";
    
    private $display_twitter = true;
    
    private $is_recurring = false;
    
    public function __construct($post)
    {
        $this->is_recurring = SpokalVars::getInstance()->is_recurring;
        $this->post_ID = ($post->post_status != "auto-draft") ? $post->ID : 0;
        $this->post_type = $post->post_type;
        $this->plugin_url = SpokalVars::getInstance()->pluginUrl;
        $this->socialAccouts = SpokalVars::getInstance()->social_properties;
        $this->is_social_enabled($post);
        $this->get_modal_data($post);
        $this->check_enable_social();
        update_post_meta($post->ID, "spokal_social_accounts",$this->socialAccouts);
        
    }
    
    private function is_social_enabled($post)
    {
        $options = SpokalVars::getInstance()->options;
        $spokalPostMeta = get_post_meta($post->ID,'spokal_css_url');
        if($options["social_media_enable"]["value"]){
            $this->enable_social = true;
        }elseif(!empty($spokalPostMeta)){
            $this->enable_social = true;
        }else{
            $this->enable_social = false;
        }
    }
    
    private function check_enable_social()
    {
        if(!empty($this->socialAccouts))
        {
            foreach($this->socialAccouts as $key => $social)
            {
//                if($social["Type"] == "2" && !$social["Disabled"])
//                {
//                    $this->display_twitter = true;
//                }
                if((!$this->enable_social && $this->post_ID == 0) || ($this->post_type === "page"))
                {
                    $this->disabeld_accounts[] = $social["Id"];
                    $this->socialAccouts[$key]["Disabled"] = true;
//                    $this->display_twitter = false;
                }
                elseif($social["Disabled"] == true)
                {
                    $this->disabeld_accounts[] = $social["Id"];
                }
                else
                {
                    $this->enabled_accounts[] = $social["Id"];
                }
                
                if($social["Type"] == "5")
                {
                    $this->socialAccouts[$key]["ImageUrl"] = $this->plugin_url."images/social/icon-social-buffer-48.png";
                }
                else if(strpos($social["ImageUrl"], "default-user-icon-profile" != false))
                {
                    $this->socialAccouts[$key]["ImageUrl"] = $this->plugin_url."images/social/default-user-icon-profile.gif";
                }
            }
        }     
    }
    
    private function get_modal_data($post)
    {
        $this->set_site_url();
        $this->get_metadescription($post);
        $this->get_fb_data($post);
        $this->get_twt_data($post);
    }
    
    private function set_site_url()
    {
        $home_url = get_home_url();
        $parsed_url = parse_url($home_url);
        $home_url = rtrim($home_url,"/");
        $this->site_url = str_replace($parsed_url["scheme"]."://","",$home_url);
    }
    
    private function get_metadescription($post)
    {
        //Getting metadescription for google
        $metaDescription = get_post_meta($post->ID, 'spokal_metadescription', true);
        $meta_counter = 160 - strlen($metaDescription);
        $meta_title = "";
        $meta_permalink = "";
        
        if($post->post_status != "auto-draft"){
            $meta_title = get_the_title($post->ID);
            $meta_permalink = get_permalink($post->ID);
        }
        
        $this->meta_desc = array(
                            "text" => $metaDescription,
                            "title" => $meta_title,
                            "link" => $meta_permalink,
                            "count" => $meta_counter
                    );
    }
    
    private function get_fb_data($post)
    {
        //Getting Facebog Tags
        $fb_image = get_post_meta($post->ID, 'spokal_ogimage', true);
        $fb_title = get_post_meta($post->ID,'spokal_ogtitle',true);
        $fb_description = get_post_meta($post->ID,'spokal_ogdescription',true);
        $fb_post_description = get_post_meta($post->ID,'spokal_facebook_status_comment',true);
        
        $this->fb_tags = array(
                            "text" => $fb_description,
                            "title" => $fb_title,
                            "img" => $fb_image,
                            "status" => $fb_post_description
                    );
    }
    
    private function get_twt_data($post)
    {
        // Grabing twitter tags
        $twitter_title = get_post_meta($post->ID,'spokal_twittertitle',true);
        $twitter_image = get_post_meta($post->ID,'spokal_twitter_image',true);
        $twitter_alt_title = get_post_meta($post->ID,'spokal_twitter_alt_title',true);
        $alt_title = get_post_meta($post->ID,'spokal_alt_title',true);
        
        $this->twt_tags = array(
                            "title" => $twitter_title,
                            "alt_title" => $twitter_alt_title,
                            "img" => $twitter_image,
                            "has_alt" => !empty($alt_title)
                    );
    }
    
    private function set_js_flags()
    {
        $fb_title = !empty($this->fb_tags['title']) ? 'true' : 'false';
        $fb_desc = !empty($this->fb_tags['text']) ? 'true' : 'false';
        $twt_title = !empty($this->twt_tags['title']) ? 'true' : 'false';
        $twt_alt_title = !empty($this->twt_tags['title']) ? 'true' : 'false';
        $sp_meta = !empty($this->meta_desc['text']) ? 'true' : 'false';
        echo "<script type='text/javascript'>"
                . "var sp_fb_title_set = ".$fb_title.";"
                . "var sp_fb_desc_set = ".$fb_desc.";"
                . "var sp_twt_title_set = ".$twt_title.";"
                . "var sp_twt_alt_title_set = ".$twt_alt_title.";"
                . "var sp_meta_desc_set = ".$sp_meta.";"
            . "</script>";
    }
    
    public function renderSocialModal()
    { 
        $this->set_js_flags(); ?>
        <div id="sp_social_blank"></div>
        <div id="sp_social_modal" class="">
            <div class="sp-modal-body">
                <input id="sp_disabled_soc_accounts" type="hidden" name="sp_disabled_soc_accounts" value="<?php echo implode(",",$this->disabeld_accounts); ?>">
                <input id="sp_enabled_soc_accounts" type="hidden" name="sp_enabled_soc_accounts" value="<?php echo implode(",",$this->enabled_accounts); ?>">
                <div class="sp-row-fluid" style="border-bottom: 1px solid #ccc; margin-bottom: 20px; width: 680px;">
                    <div class="span1">
                        <span id="sp_google_message" class="sp_fb_messag" style="margin-top: 0px; top: -6px; padding: 5px 2px; width: 195px;"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">This is an approximation of what your page will look like in Google's search results. (meta description)</span></span>
                        <div id="sp_google_icon" class="sp_google_icon"></div>
                        <span style="display: block;" id="sp_metaCharacterCount"><?php echo $this->meta_desc["count"]; ?></span>
                    </div>
                    <div class="span11" style="width: 620px;">
                        <div style="width: 600px;">
                            <div id="sp_meta_desc_title" class="sp_meta_desc_title"><?php echo $this->meta_desc["title"]; ?></div>
                            <div class="sp_meta_desc_permalink" ><?php echo $this->meta_desc["link"]; ?></div>
                            <textarea id="sp_meta_desc" name="sp_meta_description_input" placeholder="What should the search result in Google say?" style="width: 100%; overflow: hidden; word-wrap: break-word; max-height: 50px; min-height: 30px;" rows="1" class="sp-contenteditable"><?php echo $this->meta_desc["text"]; ?></textarea>  
                        </div>
                    </div>
                </div>
                <?php 
                if(empty($this->socialAccouts)){ ?>
                    <div class="sp-row-fluid" style="margin-right: 10px;">
                        <div class="sp-no-social-accounts">You haven't connected any social accounts. Once you do, you will be able to select them here for automatic sharing. Login to your Spokal account and connect them from the Account &gt; Connect Accounts menu.</div>
                    </div>
                <?php
                }else{ ?>
                    <div id="sp_social_accounts" class="sp-row-fluid" style="margin-bottom: 10px; width: 680px; position: relative;" >
                        <span id="sp-acc-popup-msg" class="sp_soc_acc_pop_message" style="display: none;"><span class="sp-arrow"></span><span id="sp-acc-inner-msg" class="sp-fb-msg-inner"></span></span>
                        <?php 
                        foreach($this->socialAccouts as $social){ ?>
                            <div class="sp-social-account" <?php echo !$social["AlreadyPublished"] ? 'onclick="sp_disable_soc_account(this)"' : ""; ?> style="background-image: url('<?php echo $social["ImageUrl"] ?>');" sp-account-disabled = "<?php  echo $social["Disabled"] ? "true" : "false"; ?>" sp-soc-id="<?php echo $social["Id"] ?>" sp-soc-type="<?php echo $social["Type"]; ?>" sp-soc-title="<?php echo $social["AlreadyPublished"] ? "This post has already been published to" :"Post to";?> <?php echo ($social["Type"] == "5") ? "Buffer" : $social["Name"]?>">
                            <?php 
                            switch($social["Type"]):
                                case "2":
                                    $class = "sp_twt_icon";
                                    break;
                                case "3";
                                    $class = "sp_fb_icon";
                                    break;
                                case "4";
                                    $class = "sp_li_icon";
                                    break;
                                default:
                                    $class = "sp_bf_icon";
                                    break;
                            endswitch;
                            
                            $class = $social["AlreadyPublished"] ? "sp_lock_icon" : $class;
                            ?>
                                <span class="<?php echo $class; ?>"></span>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
            <?php } ?>
                
                <div id="sp_twt_modal" class="sp-row-fluid" style="border: 1px dotted rgb(211, 218, 232); margin-bottom: 10px; width: 680px; <?php echo ($this->display_twitter == false) ? "display:none;" : ""; ?>">
                    <div style="float:left; width: 74.35897435897436%; margin-right: 2.564102564102564%;">
                        <div id="sp_twiter_main_title">
                            <!--<span id="tw_span_sitle_a" class="twt_title_a" style="margin-top: 5px; <?php echo ($this->twt_tags["has_alt"]) ? "display: inline-block;" : "display: none;"; ?>" data-relsmmodal="tooltip" title=""  data-original-title="This is the twitter description for title A">A</span>-->
                            <textarea id="sp_twt_desc" name="sp_twt_desc_input" placeholder="What do you want to share on Twitter?" style="width: 460px; overflow: hidden; word-wrap: break-word; max-height: 50px; min-height: 30px;" rows="1" class="sp-contenteditable"><?php echo $this->twt_tags["title"];?></textarea>
                        </div>
<!--                        <div id="twitter_title_b_wrapp" style="margin-top: 10px; <?php echo ($this->twt_tags["has_alt"]) ? "display: block;" : "display: none;"; ?>">
                            <span class="twt_title_b" style="margin-top: 8px;" data-relsmmodal="tooltip" title="" data-original-title="This is the twitter description for title B">B</span>
                            <textarea id="sp_twt_alt_title" name="sp_twt_alt_title_input" placeholder="What do you want to share on Twitter as the alternate?" style="width: 460px; overflow-x: hidden; word-wrap: break-word; overflow-y: visible; max-height: 50px; min-height: 30px;" rows="1" class="sp-contenteditable" ><?php echo $this->twt_tags["alt_title"];?></textarea>
                        </div>-->
                        <div id="sp-twt-link-info" style="font-size: 70%; color: #337ab7; display:none;" class="smaller-70 text-primary">* Note: [link to article] will be replaced with a shortened &amp; tracked link to this post before being published.</div>
                    </div>
                    <div id="sp_twt_img">
                        <a id="sp_twt_img_set" href="#" class="smaller-80" style="<?php echo (empty($this->twt_tags["img"])) ? "" :"display:none;";?>">(Add an image to this tweet.)</a>
                        <span id="sp_social_twt_img_messag" class="sp_social_twt_img_messag"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">Click to choose another image.</span></span>
                        <img id="sp_twt_img_elem" style="max-width: 100px; max-height: 100px; <?php echo (empty($this->twt_tags["img"])) ? "display:none;" :"";?>" title=""  alt=""  src="<?php echo $this->twt_tags["img"]; ?>">
                        <input type="hidden" id="sp_twt_img_input" name="sp_twt_img_input" value="<?php echo $this->twt_tags["img"]; ?>">
                        <a id="sp_twt_img_remove" href="#" class="smaller-80" style="font-size: 12px; <?php echo (empty($this->twt_tags["img"])) ? "display:none;" :"";?>">Remove image</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-top: 1px dotted #D3DAE8; width: 700px; padding: 5px 0;">
                    <textarea id="sp_fb_post_desc" style="max-height: 50px; min-height: 30px;" name="sp_fb_post_desc_input" placeholder="What comment do you want to make on this story on FB &amp; LinkedIn?" rows="1" class="sp-contenteditable" ><?php echo $this->fb_tags["status"];?></textarea>

                    <div class="sp-row-fluid sp-fb-background" style="border: 1px solid #D3DAE8; margin-left: 0; min-height: 100px; width: 698px; padding: 10px 0;">

                        <div id="sp_fb_img" class="sp_fb_img " style="text-align: center; position: relative;">
                            <a id="sp_fb_img_set" href="#" class="smaller-80" style="<?php echo (empty($this->fb_tags["img"])) ? "" :"display:none;";?>">(Add image)</a>
                            <span id="sp_social_fb_img_messag" class="sp_social_fb_img_messag"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">Click to choose another image.</span></span>
                            <span style="width: 100%; display:block; text-align: center;">
                                <img id="sp_fb_img_elem" style="margin-right: 10px; max-width: 115px; max-height: 115px; <?php echo (empty($this->fb_tags["img"])) ? "display:none;" :"";?>;" data-relsmmodal="tooltip" title="" data-original-title="Click to choose another image from the post" src="<?php echo $this->fb_tags["img"]; ?>">
                            </span>
                            <input type="hidden" id="sp_fb_img_input" name="sp_fb_img_input" value="<?php echo $this->fb_tags["img"]; ?>">
                            <a id="sp_fb_img_remove" href="#" class="smaller-80" style="font-size: 12px; <?php echo (empty($this->fb_tags["img"])) ? "display:none;" :"";?>">Remove image</a>
                        </div>
                        <div class="span9">
                            <textarea id="sp_fb_title" name="sp_fb_title_input" placeholder="Give this story a title." style="width: 500px; color: #3b5998; font-size: 11px; font-weight: bold; line-height: 14px; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;" rows="1" class="sp-contenteditable sp-fb-background" ><?php echo $this->fb_tags["title"];?></textarea>
                            <div class="sp-facebookdesc" style="width: 450px; padding-left: 5px;" ><?php echo $this->site_url; ?></div>
                            <textarea id="sp_fb_desc" name="sp_fb_desc_input" placeholder="Add a description for this story." style="width: 500px; max-height: 70px; min-height: 30px; overflow: hidden; word-wrap: break-word;" rows="1" class="sp-contenteditable sp-facebookdesc sp-fb-background" ><?php echo $this->fb_tags["text"];?></textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="sp_clearfix sp-optin-footer" style="position: relative;">
                    <span id="sp_social_recover_messag" class="sp_social_recover_messag"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">Will reset to the auto-generated descriptions. Any changes you made on this screen will be lost.</span></span>
                    <span id="sp_is_recurring_message" style="<?php echo $this->is_recurring ? "top: -73px": "top: -53px"; ?>" class="sp_social_recurring_messag"><span class="sp-arrow"></span><span id="sp_recurring_inner" class="sp-fb-msg-inner"><?php echo $this->is_recurring ? "This post is in or will be added to your recurring queue. It will assume the same focus as the post (if any)" : "This post is not in or will be removed from your recurring queue."; ?></span></span>
                    <a href="#" style="float: left;" id="sp_soc_reset">Regenerate Descriptions</a>
                    <span id="sp-social-save" type="submit" class="sp-social-save" style="z-index: 0;">Done</span>
                    <!--<span style="font-weight: normal; float: right; <?php echo ($this->twt_tags["has_alt"]) ? "display: block;" : "display: none;"; ?>" class="twt_title_b" id="tweetCharacterCountB" >116</span>-->
                    <span style="display: block; font-weight: normal; float: right; margin-top: 10px;" class="twt_title_a" id="sp_tweetCharacterCount" >116</span>
                    <span id="sp_enable_recurring" onclick="sp_set_recurring(this)" style="float: right;" class="<?php echo $this->is_recurring ? "sp_recurring_enabled" : "sp_recurring_disabled"; ?> sp_post_recurring"></span>
                    <input id="sp_recurring_value" type="hidden" name="sp_recurring_value" value="<?php echo $this->is_recurring ? "true" : "false"; ?>">
                </div>
            </div>
            <div id="sp-content-hidden" class="sp-contenteditable" style="display: none; max-height: 700px; height: auto;"></div>
        </div>
    <?php
    }
    
}