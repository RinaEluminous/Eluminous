<?php
class SP_Editor
{   
    
        
    public function __construct()
    {
        //Adding Spokal and saving Spokal metabox fields
//        add_action("add_meta_boxes_post", array($this,"sp_add_metaboxes"));
//        add_action("add_meta_boxes_page", array($this,"sp_add_metaboxes"));
        
        add_action("add_meta_boxes", array($this,"sp_add_metaboxes"));
        add_action("save_post", array($this,"sp_save_spokal_metaboxes"),1,2);
        
        //Adding Spokal field for A/B testing title
        add_action("admin_head", array($this,"spokal_sec_title"));
        
        
        // Including script for Spokal fields in wp-editor
        add_action( 'admin_enqueue_scripts', array($this,'add_admin_scripts'), 10, 1 );
        
        //Adding image size and ajax callback for Inlince CTA image
        add_action( 'after_setup_theme', array($this,'set_inline_cta_image_size' ));
        add_action( 'wp_ajax_sp_inline_cta_img', array($this,'return_inline_cta_image' ));
        
    }

    
    /*
     * Include Spokal Scripts for wp-editor and call Spokal Apis to get focuses and keywords
     */
    public function add_admin_scripts( $hook ) 
    {
        $current_screen = get_current_screen();
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post","page");
        
        /** Don't insert the text input when not viewing the post or edit page */
        if(!in_array($current_screen->post_type, $postTypes)) {
                return false;
        }
        
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            $this->get_spokal_account_data();
            // Build in tag auto complete script
            wp_enqueue_script( 'jquery-ui-autocomplete' );
            wp_enqueue_script('spokaleditorjs', SpokalVars::getInstance()->pluginUrl.'js/editor/spokal-editor.min.js', array('jquery'), SpokalVars::getInstance()->pluginData['Version']);
            wp_enqueue_style( 'spokaleditorcss', SpokalVars::getInstance()->pluginUrl."css/editor/spokal-editor.min.css" , false, SpokalVars::getInstance()->pluginData['Version'], 'all' );
        
            $this->localize_keyword_js_variable();
            $this->localize_focus_js_variable();
        }
        
    }
    
    
    public function localize_keyword_js_variable()
    {
        $sp_keywords = SpokalVars::getInstance()->keywords;
        if(!is_array($sp_keywords) || empty($sp_keywords)){
            return false;
        }
        wp_localize_script( 'spokaleditorjs', 'spKeywords', array_values($sp_keywords) );
    }
    
    /*
     * Call add_meta_box function to add Spokal custom post fields
     */
    public function sp_add_metaboxes() 
    {
        $current_screen = get_current_screen();
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post","page");
        
        /** Don't insert the text input when not viewing the post or edit page */
        if(!in_array($current_screen->post_type, $postTypes)) {
                return false;
        }
        
        add_meta_box('sp_focus_metabox',"Spokal",array($this,'render_spokal_metabox'),null,'side','high');
    }
    
    
    
    /*
     * Rendering Spokal Custom post fields
     */
    /**
    * Prints the box content.
    * 
    * @param WP_Post $post The object for the current post/page.
    */
    public function render_spokal_metabox( $post ) 
    {        
            // Add a nonce field so we can check for it later.
            wp_nonce_field( 'spokal_save_focus_metabox', 'spokal_meta_box_nonce' );
            
            $this->render_draft_preview($post);
            $this->render_spokal_social_modal($post);
            $this->render_keywords_field($post);
            $this->render_focus_field($post);
            $this->render_inline_cta(); 
            ?>
            
            <p style="position: relative;">
                <span id="sp_inline_cta_short" class="button button-primary button-large" value="Inline CTA">Inline CTA</span>
            </p>
            <div id="sp_seo_analyser"></div>
            <input id="sp_post_lenght" name="sp_post_lenght" type="hidden">
            <input id="sp_post_lenght" name="sp_from_wp_editor" type="hidden" value="true">
            <?php
    }
    
    
    /*
     * Saving Spokal Post Meta fields
     */
    public function sp_save_spokal_metaboxes($post_id,$post)
    {
        
        if(isset($_POST["post_type"]) && "page" == $_POST["post_type"]) {
            if(!current_user_can("edit_page", $post_id)) {
                return false;
            }
        }
        else {
            if(!current_user_can("edit_post", $post_id)) {
                return false;
            }
        }
        
        if($post->post_status !== 'publish'){
            $draft_guid = get_post_meta($post_id, "spokal_sharedraftpost");
            if(empty($draft_guid)){
                $draft_guid = strtolower($this->sp_GUID());
                update_post_meta($post_id, "spokal_sharedraftpost",$draft_guid);
            }
        }
        
        if(isset($_POST["spokal_sec_title"])){
            update_post_meta($post_id, "spokal_alt_title", stripslashes(esc_attr($_POST["spokal_sec_title"])));
        }
        
        if(isset($_POST["spokal_keywords"])){
            $keyword_to_save = stripslashes($_POST["spokal_keywords"]);
            //User should not be able to save post with keyword which don't exist in Spokal
            //But we are going to check it anyway
            if(isset($_POST["sp_temp_keywords"])){                
                $keyword_array = json_decode(base64_decode($_POST["sp_temp_keywords"]),true);
                if(!empty($keyword_to_save) && is_array($keyword_array)){
                    if(!in_array($keyword_to_save,$keyword_array)){
                        $keyword_to_save = "";
                    }
                }
            }
            update_post_meta($post_id, "spokal_keywords", wp_slash($keyword_to_save));
        }
        
        if(isset($_POST["spokal_focuses_hidden"])){
            $focuses_temp = stripslashes_deep($_POST["spokal_focuses_hidden"]);
            $focuses = explode(",",$focuses_temp);
            $focuses = array_filter($focuses);
            $counter = 1;
            $db_value = "";
            $prim = "";
            $sec = "";
            
            $focuses_array = array();
            if(isset($_POST["sp_temp_focuses"])){
                $focuses_array = json_decode(base64_decode($_POST["sp_temp_focuses"]),true);
            }
            if(!is_array($focuses_array)){
                $focuses_array = array();
            }
            foreach($focuses as $name){
                $id = array_search($name, $focuses_array);
                
                if($counter == 1){
                   $prim = "pri-".$id;
                   $sec = "sec-0";
                }
                if($counter == 2){
                    $sec = "sec-".$id; 
                }
                $counter++;
            }
            $db_value = (empty($prim)) ? "" : $prim.",".$sec;
            update_post_meta($post_id, "spokal_focuses", $db_value);
            
	}
        
        
        if(isset($_POST["sp_post_lenght"])){
            update_post_meta($post_id, "spokal_post_lenght", $_POST["sp_post_lenght"]);
        }
        
//        if(isset($_POST["sp_sm_single_enable_input"])){
//            update_post_meta($post_id, "spokal_social_enable", $_POST["sp_sm_single_enable_input"]);
//        }
        
        
        //Saving twitter field from Social modal
        if(isset($_POST["sp_twt_img_input"])){
            update_post_meta($post_id, "spokal_twitter_image", $_POST["sp_twt_img_input"]);
        }
        
        if(isset($_POST["sp_twt_alt_title_input"])){
            update_post_meta($post_id, "spokal_twitter_alt_title", $_POST["sp_twt_alt_title_input"]);
        }
        
        if(isset($_POST["sp_twt_desc_input"])){
            update_post_meta($post_id, "spokal_twittertitle", $_POST["sp_twt_desc_input"]);
        }
        
        
        // Saving fields from facebook social modal
        if(isset($_POST["sp_fb_post_desc_input"])){
            update_post_meta($post_id, "spokal_facebook_status_comment", $_POST["sp_fb_post_desc_input"]);
        }
        
        if(isset($_POST["sp_fb_title_input"])){ 
            update_post_meta($post_id, "spokal_ogtitle", $_POST["sp_fb_title_input"]);
        }
        
        if(isset($_POST["sp_fb_desc_input"])){
            update_post_meta($post_id, "spokal_ogdescription", $_POST["sp_fb_desc_input"]);
        }
        
        if(isset($_POST["sp_fb_img_input"])){
            
            update_post_meta($post_id, "spokal_ogimage", $_POST["sp_fb_img_input"]);
        }
        
        //Saving metadescription
        if(isset($_POST["sp_meta_description_input"])){
            update_post_meta($post_id, "spokal_metadescription", $_POST["sp_meta_description_input"]);
        }
        return true;
    }
    
    
    
    /*
     * Adding input field to wordpress editor for secondary title (A/B testing)
     */
    public function spokal_sec_title()
    {
        $current_screen = get_current_screen();
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post");
        
        /** Don't insert the text input when not viewing the post or edit page */
        if(($current_screen->base != "post" && $current_screen->base != "edit") 
            || strstr($current_screen->id, "edit-") 
            || !in_array($current_screen->post_type, $postTypes)) {
                return false;
        } 
        
        global $post;
        
        $alternate_title = get_post_meta(get_the_ID(),'spokal_alt_title',true);
        $display = (empty($alternate_title)) ? "display: none;" : "display: inline-block;";
        $display_show = (empty($alternate_title)) ? "display: inline-block;" : "display: none;";
        
        $title_ID = get_post_meta( get_the_ID(), 'spokal_alt_title_testid', true);
                
        if(!empty($title_ID) && ($title_ID != 0) && ($post->post_status == "publish")){
           ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#title").attr("readonly",true);
                    jQuery("#title").css("color","#848484");
                    jQuery("#title").css("background-color","#eee");
                });
            </script>
            <?php
        }
        ?>

        <span id="hide-secondary-title" hidden="hidden">
            <div id="sp_ab_title_wrap">
                <span class="button button-primary button-large" id="sp-sec-title-test-show" style="<?php echo ((!empty($title_ID) && ($title_ID != 0)) || (!empty($alternate_title))) ? "" : "display: none;"; ?>">View B</span>
                <span class="button button-primary button-large" id="sp-sec-title-show" style="<?php echo ((!empty($title_ID) && ($title_ID != 0)) || (!empty($alternate_title))) ? "display: none;" : ""; ?>">A/B Test</span>
                <span class="button button-primary button-large" id="sp-sec-title-hide"><i class=""></i></span>
                <input style="display: none; width: 90%; margin-top: 4px; line-height: 24px; <?php echo (!empty($title_ID) && ($title_ID != 0) && ($post->post_status == "publish")) ? "color: #848484; background-color: #eee;" : ""; ?>" type="text" size="30" id="spokal-secondary-title-input" placeholder="<?php _e("Alternative Title", "spokal"); ?>" name="spokal_sec_title" value="<?php echo esc_attr($alternate_title); ?>" <?php echo (!empty($title_ID) && ($title_ID != 0) && ($post->post_status == "publish")) ? "readonly" : ""; ?>/>
            </div>
        </span>
        <?php
        return true;
    }
    
    /*
     * Renreding button to share draft post
     */
    public function render_draft_preview($post)
    {
        if($post->post_status == "draft"){
            $draft_guid = get_post_meta($post->ID, 'spokal_sharedraftpost', true);
            $permalink  = get_permalink($post->ID);
            $params = array(
                        "preview" => "true",
                        "spokaldraftshare" => $draft_guid,
                      );
            
            $permalink .= parse_url($permalink, PHP_URL_QUERY) ? '&' : '?';
            $permalink .= http_build_query($params);
            ?>
            <div style="position: relative; float: right;">
                <span id="sp_preview_pop_messag" class="sp_preview_pop_messag" style="display: none;"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">Preview the post using Spokal Share A Draft. Use this link to share this draft with anyone (no login needed), do not share this link publicly.</span></span>
                <a href="<?php echo $permalink; ?>" target="_blank" class="sp_draft_preview_link"><span id="sp_draft_preview">Share A Draft</span></a>
            </div>
            <?php
        }
    }
    
    /*
     * Render Spokal Keyword Field
     */
    public function render_keywords_field($post)
    {
        $keyword = get_post_meta($post->ID, 'spokal_keywords', true); 
        $sp_keywords = SpokalVars::getInstance()->keywords;
                
        if(!is_array($sp_keywords) || empty($sp_keywords)){
            return false;
        }
        ?>

        <p id="sp-keywords-wrapp">
            <label for="spokal_keywords">Keywords:</label><br>
            <input style="width: 100%;" type="text" id="spokal_keywords" autocomplete="off" name="spokal_keywords" value="<?php echo esc_attr( $keyword ); ?>" />
            <input type="hidden" name="sp_temp_keywords" value="<?php echo base64_encode(json_encode($sp_keywords)); ?>">
            <span id="sp-no-keyword-error" style="color: red; font-weight: bold; font-size: 12px;"></span>
        </p>
        <?php
    }
    
    
    public function localize_focus_js_variable()
    {
        global $post;
        $focuses = SpokalVars::getInstance()->focuses;
        if(!is_array($focuses) || empty($focuses)){
            return false;
        }
        
        $saved_focuses = $this->get_focuses_id($post);
        $f_names = $focuses;
        
        if(isset($saved_focuses["prim"]) && isset($f_names[$saved_focuses["prim"]])){
            unset($f_names[$saved_focuses["prim"]]);
        }

        wp_localize_script( 'spokaleditorjs', 'spFocusBackup', array_values($focuses) );
        wp_localize_script( 'spokaleditorjs', 'spFocus', array_values($f_names) );
    }
    
    /*
     * Render Spokal Focus Field
     */
    public function render_focus_field($post)
    {
        $focuses = SpokalVars::getInstance()->focuses;
        if(!is_array($focuses) || empty($focuses)){
            return false;
        }
        
        $value = "";
        $saved_focuses = $this->get_focuses_id($post);
        if(is_array($focuses) && !empty($focuses)){
            //rendering JS array of focuses
            if(isset($saved_focuses["prim"]) && $saved_focuses["prim"] != 0){
                $prim = $saved_focuses["prim"];
                $value = $focuses[$prim].",";
            }

            if(isset($saved_focuses["sec"]) && $saved_focuses["sec"] != 0){
                $sec = $saved_focuses["sec"];
                $value .= $focuses[$sec].",";
            }
        } 

        ?>
            
        <label for="spokal_focuses">Focuses:</label><br>
        <div id="spokal_focus_wrap" class="sp-div-input" >
            <?php 
            $focus_array = empty($value) ? array() : explode(",",$value);
            $focus_array = array_filter($focus_array);
            if(count($focus_array) > 0){
                $placeholer = "";
                $style = "width: 4px;";
            }else{
                $placeholer = "Choose...";
                $style = "";
            }
            foreach($focus_array as $focus_name){if(empty($focus_name)){continue;} ?><div tabindex='0' class='sp_focus_tag'><?php echo $focus_name; ?></div> <?php } ?><input type="text" style="<?php echo $style; ?>" id="spokal_focuses" class="spokal_focuses_input" placeholder="<?php echo $placeholer; ?>" name="spokal_focuses" onfocus="javascript:jQuery(this).autocomplete('search','');" value="" />
            <input type="hidden" id="spokal_focuses_hidden" autocomplete="off" name="spokal_focuses_hidden" value="<?php echo esc_attr( $value ); ?>" />
            <input type="hidden" name="sp_temp_focuses" value="<?php echo base64_encode(json_encode($focuses)); ?>">
        </div>
        <?php
    }
    
    
    
    /*
     * Render Spokal Social Modal
     */
    public function render_spokal_social_modal($post)
    {  ?>
        <div id="sp-social-modal-metabox"style="position: relative; float:left;">
            <span style="vertical-align: top; position:relative; cursor: pointer;" id="sp_social_button" class="sp_social_button">
                <span id="sp_social_pop_messag" class="sp_social_pop_messag"><span class="sp-arrow"></span><span class="sp-fb-msg-inner">Customize what gets posted to social media</span></span>
            </span>
        </div>
        <div style="clear:both; border: 0px;"></div>
        <?php 
        $spSocial = new SP_Social($post);
        $spSocial->renderSocialModal();
    }
    
    
    /*
     * Render Modal for generating shortcode of Spokal Inline Cta
     */
    public function render_inline_cta()
    { ?>
        <style type="text/css">
            .sp_inline_spinner{
                background: url(<?php echo SpokalVars::getInstance()->pluginUrl?>/images/spinner.gif) 0 0/20px 20px no-repeat;
            }
        </style>
        
        <div id="sp_inline_cta_settings">
            <div class="sp_inline_cta_header">
                <div id="close_inline_cta_settings"></div>
                <div class="sp_inline_title">Generate Optin Shortcode</div>
            </div>
            
            <div class="sp-inlince-CTA-modal-body">
                <div class="sp_clearfix">
                    <label for="sp-optin-title" style="font-size: 1.1em; margin-top: 0.5em;">Title*</label>
                    <input id="sp-optin-title" name="sp-optin-title" type="text" value="Inline CTA" style="width: 350px; margin-bottom: 5px;" >
                </div>
                <div class="sp_clearfix">
                    <label for="sp-optin-text" style="font-size: 1.1em; margin-top: 0.5em;" >Text*</label>
                    <input id="sp-optin-text" name="sp-optin-text" type="text" value="" style="width: 350px; margin-bottom: 5px;" >
                </div>
                <div class="sp_clearfix">
                    <label for="sp-optin-buttontext" style="font-size: 1.1em; margin-top: 0.5em;" >Button Text*</label>
                    <input id="sp-optin-buttontext" name="sp-optin-buttontext" type="text" value="" style="width: 350px; margin-bottom: 5px;" class="pull-right" >
                </div>
                <div class="sp_clearfix">
                    <label for="sp-optin-success-message" style="font-size: 1.1em; margin-top: 0.5em;" >Success Message</label>
                    <input id="sp-optin-success-message" name="sp-optin-success-message" type="text" value="Message has been submitted successfully." style="width: 350px; margin-bottom: 5px;">
                </div>
                <div class="sp_clearfix">
                    <label for="sp-optin-error-message" style="font-size: 1.1em; margin-top: 0.5em;" >Error Message</label>
                    <input id="sp-optin-error-message" name="sp-optin-error-message" type="text" value="Failed to send your message. Please try later." style="width: 350px; margin-bottom: 5px;" >
                </div>
                <div class="sp_clearfix">
                    <label for="sp-optin-invalid-email-message" style="font-size: 1.1em; margin-top: 0.5em;">Invalid Email Message</label>
                    <input id="sp-optin-invalid-email-message" name="sp-optin-invalid-email-message" type="text" value="Your email address does not appear valid." style="width: 350px;" >
                </div>
                
                <div class="sp_clearfix" style="margin-top: 10px;">
                    <div style="width:180px; float:right;">
                        <div style="width: 150px; height: 120px; overflow: hidden; margin: 0 auto;" class="sp_img_wrapp">
                            <input type="hidden" name="sp-optin-image-hidden" id="sp-optin-image-hidden">
                            <img id="sp-optin-image" alt="" src="">
                        </div>
                    </div>
                    <div class="sp-uplad-image-btn" style="width:180px; float:right;" >
                        <span class="sp-inline-upload" style="z-index: 0;" >Upload Image</span>
                        <span class="sp-inline-remove disabled">Remove Image</span>
                        <div style="text-align: right">
                            <i id="sp_inline_spinner" class="sp_inline_spinner"></i>
                        </div>
                        <label class="checkbox inline pull-right" for="optin-border" style="display: block; margin-left:10px; text-align: right; margin-top: 10px">
                            <input id="sp-optin-border" name="sp-optin-border" type="checkbox">
                            Show Border
                        </label>
                    </div>
                </div>
                
                <div style="margin-top: 10px; margin-bottom: 10px; font-size: 1.1em; margin-top: 0.5em;">Additional fields:</div>
                <div>
                    <label class="sp-optin-check" for="sp-optin-collectfirstname" ><input id="sp-optin-collectfirstname" name="sp-optin-collectfirstname" type="checkbox" >First Name</label>
                    <label class="sp-optin-check" for="sp-optin-collectlastname" ><input id="sp-optin-collectlastname" name="sp-optin-collectlastname" type="checkbox" >Last Name</label>
                    <label class="sp-optin-check" for="sp-optin-collectphone" ><input id="sp-optin-collectphone" name="sp-optin-collectphone" type="checkbox" >Phone Number</label>
                    <label class="sp-optin-check" for="sp-optin-collectcompany" ><input id="sp-optin-collectcompany" name="sp-optin-collectcompany" type="checkbox">Company Name</label>
                </div>
                <div class="sp-optin-alert-error" style="font-size: 1em; padding: 0.5em; line-height: normal; margin: 0.5em 0px 0px; display: none;" >dasdas</div>
                
                <div id="optin-value-wrapp" style="display: none;">
                    <label style="display:block; font-size: 1.1em; margin-bottom: 6px; margin-top: 26px;">Copy the shortcode and paste it in the post content:</label>
                    <textarea id="sp-optin-shortcode-value" rows="7" cols="100" readonly onClick="this.select();" style="background: white; resize: none; width: 100%;"></textarea>
                </div>
            </div>
            <div class="sp_clearfix sp-optin-footer">
                <span class="sp-optin-generate" style="z-index: 0;">Generate</span>
                <span class="sp-optin-cancel" >Cancel</span>
            </div>
        </div>
        <?php
    }
    
    
    
    /*
     * Adding new image size for Inline CTA 
     */
    public function set_inline_cta_image_size() 
    {
        add_image_size( 'sp_inline_cta', 150,150 ); // 300 pixels wide (and unlimited height)
    }
    
    
    
    /*
     * Ajax callback which will return featured image for Inline CTA
     */
    public function return_inline_cta_image()
    {
        $image_ID = $_POST["id"];
        $meta = wp_get_attachment_metadata($image_ID);
        if(is_array($meta) && isset($meta["width"]) && ($meta["width"] <= 150)){
            $cta_src = wp_get_attachment_url( $image_ID );
        }else{
            $medium = wp_get_attachment_image_src($image_ID,"sp_inline_cta");
            $cta_src = "";
            if($medium != false && isset($medium[0]) && (!filter_var($medium[0], FILTER_VALIDATE_URL) === false)){
                $cta_src = $medium[0];
            }else{
                $cta_src = wp_get_attachment_url( $image_ID );
            }
        }
            
        header('Content-type: application/json');
        echo json_encode(array("url" => $cta_src, "status" => true));
        die();
    }
    
    
    /*
     * Getting Account data from Spokal
     * Focuses, Keywords and Social Properties
     */
    public function get_spokal_account_data()
    {
        global $post;
        $post_ID = ($post->post_status != "auto-draft") ? $post->ID : 0;
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            SpokalVars::getInstance()->focuses = array();
            return false;
        }
        
        $params = array(
                "AccountId" => $accountID,
                "AuthorizationKey" => $authorizationKey,
                "PostId" => $post_ID
            );
        
        $result = SP_Request::GETRequest("/api/v1.1/CmsUpdate/GetExternalEditorData",$params);
        $result = json_decode($result,true);
                
        //Reading Account Data from response
        $this->read_focuses($result);
        $this->read_keywords($result);
        $this->read_post_data($result);
        
    }
    
    
    public function read_focuses($result)
    {
        SpokalVars::getInstance()->focuses = array();
        if(isset($result["AccountLevel"]))
        {
            $accountData = $result["AccountLevel"];
            if(isset($accountData["Focuses"]) && is_array($accountData["Focuses"])){
                $focuses = $accountData["Focuses"];
                if(isset($focuses["Result"]) && !empty($focuses["Result"]))
                {
                    SpokalVars::getInstance()->focuses = $focuses["Result"];
                }
            }
            
        }
    }
    
    
    public function read_keywords($result)
    {
        SpokalVars::getInstance()->keywords = array();
        if(isset($result["AccountLevel"]))
        {
            $accountData = $result["AccountLevel"];
            if(isset($accountData["Keywords"]) && is_array($accountData["Keywords"])){
                $keywords = $accountData["Keywords"];
                if(isset($keywords["Result"]) && !empty($keywords["Result"]))
                {
                    SpokalVars::getInstance()->keywords = $keywords["Result"];
                }
            }
        }
    }
    
    public function read_post_data($result)
    {
        SpokalVars::getInstance()->social_properties = array();
        SpokalVars::getInstance()->is_recurring = false;
        if(isset($result["PostLevel"]))
        {
            $postData = $result["PostLevel"];
            if(isset($postData["SocialProperties"]) && is_array($postData["SocialProperties"])){
                $socialProp = $postData["SocialProperties"];
                if(isset($socialProp["Result"]) && !empty($socialProp["Result"]))
                {
                    SpokalVars::getInstance()->social_properties = $socialProp["Result"];
                }
            }
            
            if(isset($postData["IsRecurring"])){
                SpokalVars::getInstance()->is_recurring = $postData["IsRecurring"];
            }
        }
    }
    
    /*
     * Returns Focuses ID from Focus Model returned from Spokal
     * TODO: replace this with function from SP_func
     */
    public function get_focuses_id($post)
    {
        $prim = "";
        $sec = "";
        $focuses = get_post_meta($post->ID,"spokal_focuses",true);
        if(empty($focuses)){return array();}
        
        $focus_array = explode(",",$focuses);
        foreach($focus_array as $focus){
            if(strpos($focus,"pri-") !== false){
                $prim = str_replace("pri-", "", $focus);
            }
            
            if(strpos($focus,"sec-") !== false){
                $sec = str_replace("sec-", "", $focus);
            }
        }
        return array("prim"=>$prim,"sec"=>$sec);
    }
    
    
    /*
     * Functin for generating unique GUID
     */
    public function sp_GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}

new SP_Editor();