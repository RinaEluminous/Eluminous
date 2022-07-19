<?php

/**
* This class have assigment to deal with rendering subpage (Spokal Option Page in wordpress dashboard).
* This includes, rendering content, forms, fields, tabs etc...
*/
class SpokalAdminView{
    
    /*
     * Title we are going to use at the top of the Spokal Setings page
     */
    private $spokalSettingsTitle = "My Spokal Settings";

    private $tabsAndBoxes = array ();


    

    /*
     * Construct.
     * We will do only two things in this construct:
     * 1. We will get instance of the "SpokalVars" variable where we have fetched
     *    all of the options from the database ralated with forms which we are displaying within spokal options page
     * 2. We are populating tabs and boxes (options) which we are going to render
     */
    public function __construct(){
        SpokalVars::getInstance()->campaigns = Spokal::fetchCampaigns();
        update_option('spokal_current_campaigns',SpokalVars::getInstance()->campaigns);
        $this->vars = SpokalVars::getInstance();  
        $this->populateTabsAndBoxes();
        SpokalVars::getInstance()->allPosts = $this->get_all_posts();
    }
    
    public function get_all_posts(){
        global $wpdb;
        $post_array = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ORDER BY $wpdb->posts.post_date DESC");
        return $post_array;
    }
        
    /*
     * This method contains all tabs/boxes which we are going to use in this class and loop through these options in order
     * to display things dynamicly.
     * If we want to add more tabs, we are going to add them here.
     */    
    private function populateTabsAndBoxes() {

        $this->tabsAndBoxes = array(

            "tab1" => array(
                "tab_id" => "tab1",             //id of tab which will be used for javascript
                "tab_name" => "Account",        //name of the tab which will be visible like title of tab
                "box_id" => "box1",             //id of box which will be displayed when someone click on the tab
                "display" => true,              //are we going to display this or not (tabs which depends from something else, like gravity tab)
                "dropable" =>false,
                "content_method" => "boxContentAccount",       //method name which will be called in order to render a content. It needs to display content. Default will be used if we dont provide this one
                "default_tab" => true
            ),
           "tab3" => array(
                "tab_id" => "tab3",
                "tab_name" => "Plugins",
                "box_id" => "box3", 
                "display" => true,
                "dropable" =>true,
                "default_tab" => false,
                "children" => array(
                        "tab3-1" => array(
                        "tab_id" => "tab3-1",
                        "tab_name" => "Gravity Forms",
                        "box_id" => "box3-1", 
                        "display" => SP_Func::isPluginActive("gravityforms.php"),
                        "dropable" =>false,
                        "default_tab" => false,
                        "content_method" => "boxContentGravity",
                    ),
                    "tab3-2" => array(
                        "tab_id" => "tab3-2",
                        "tab_name" => "Ninja Forms",
                        "box_id" => "box3-2", 
                        "display" => SP_Func::isPluginActive("ninja-forms.php"),
                        "dropable" =>false,
                        "default_tab" => false,
                        "content_method" => "boxContentNinjaForms",
                    ),
                     "tab3-3" => array(
                        "tab_id" => "tab3-3",
                        "tab_name" => "Contact Form 7",
                        "box_id" => "box3-3", 
                        "display" => SP_Func::isPluginActive("wp-contact-form-7.php"),
                        "dropable" =>false,
                        "default_tab" => false,
                        "content_method" => "boxContentCF7",
                    ),           
                     "tab3-4" => array(
                        "tab_id" => "tab3-4",
                        "tab_name" => "JetPack",
                        "box_id" => "box3-4", 
                        "display" => SP_Func::isPluginActive("jetpack.php"),
                        "dropable" =>false,
                        "default_tab" => false,
                        "content_method" => "boxContentJetPack",
                    ),
                    "tab3-5" => array(
                        "tab_id" => "tab3-5",
                        "tab_name" => "Other",
                        "box_id" => "box3-5", 
                        "display" => true,
                        "dropable" =>false,
                        "default_tab" => false,
                        "content_method" => "boxWpContentHTMLForm"
                    ),
                ),
            ),
            "tab7" => array(
                "tab_id" => "tab7",
                "tab_name" => "Non-WP Integrations",
                "box_id" => "box7", 
                "display" => true,
                "dropable" =>true,
                "default_tab" => false,
                "children" => array(
                            "tab7-1" => array(
                                "tab_id" => "tab7-1",
                                "tab_name" => "Simple HTML Form",
                                "box_id" => "box7-1", 
                                "display" => true,
                                "dropable" =>false,
                                "default_tab" => false,
                                "content_method" => "boxNetContentHTMLForm"
                            ),
                            "tab7-2" => array(
                                "tab_id" => "tab7-2",
                                "tab_name" => "3rd Party Integrations",
                                "box_id" => "box7-2", 
                                "display" => true,
                                "dropable" =>false,
                                "default_tab" => false,
                                "default_tab" => false,
                                "content_method" => "boxContent3rdIntegrations"
                            ),
                 ), 
            ),
            "tab8" => array(
                "tab_id" => "tab8",
                "tab_name" => "CTAs",
                "box_id" => "box8", 
                "display" => true,
                "dropable" =>true,
                "default_tab" => false,
                "children" => array(
                            "tab8-1" => array(
                            "tab_id" => "tab8-1",
                            "tab_name" => "Scroll Box",
                            "box_id" => "box8-1", 
                            "display" => true,
                            "dropable" =>false,
                            "default_tab" => false,
                            "content_method" => "boxContentScrollBox" 
                        ),
                        "tab8-2" => array(
                            "tab_id" => "tab8-2",
                            "tab_name" => "Smart Bar",
                            "box_id" => "box8-2", 
                            "display" => true,
                            "dropable" =>false,
                            "default_tab" => false,
                            "content_method" => "boxContentSmartBar" 
                        ),
                        "tab8-3" => array(
                            "tab_id" => "tab8-3",
                            "tab_name" => "Exit Intent",
                            "box_id" => "box8-3", 
                            "display" => true,
                            "dropable" =>false,
                            "default_tab" => false,
                            "content_method" => "boxContentExitIntent" 
                        ),
                        "tab8-4" => array(
                            "tab_id" => "tab8-4",
                            "tab_name" => "Inline CTA",
                            "box_id" => "box8-4", 
                            "display" => true,
                            "dropable" =>false,
                            "default_tab" => false,
                            "content_method" => "boxContentInlineCta" 
                        ),
                        "tab8-5" => array(
                            "tab_id" => "tab8-5",
                            "tab_name" => "Popups",
                            "box_id" => "box8-5", 
                            "display" => true,
                            "dropable" =>false,
                            "default_tab" => false,
                            "content_method" => "boxContentSpPopups" 
                        ),
                 ), 
            ),
            "tab12" => array(
                "tab_id" => "tab12",
                "tab_name" => "XML Sitemaps",
                "box_id" => "box12", 
                "display" => true,
                "dropable" =>false,
                "default_tab" => false,
                "content_method" => "boxContentXmlSitemaps" 
            ),
            "tab4" => array(
                "tab_id" => "tab4",
                "tab_name" => "Status",
                "box_id" => "box4", 
                "display" => true,
                "dropable" =>false,
                "default_tab" => false,
                "content_method" => "boxContentStatus"
            ),
            "tab2" => array(
                "tab_id" => "tab2",
                "tab_name" => "Advanced Settings",
                "box_id" => "box2", 
                "display" => true,
                "dropable" =>false,
                "default_tab" => false,
                "content_method" => "boxContentSettings"
            ),

        );


    }
    
    /*
     * This method will generate and display html for tabs
     */
    private function displayTabs() {
        ?>
        <ul class="tabs group">

            <?php foreach($this->tabsAndBoxes as $tab) { ?>
            <?php 
                if(isset($_GET["sp_tab"])){
                    $tab["default_tab"] = ($tab["tab_id"] == $_GET["sp_tab"]) ? true : false;
                }
                if($tab["dropable"]) { 
                    $child_active = false;
                    foreach($tab["children"] as $childTab){ 
                        if(isset($_GET["sp_tab"])){
                            $childTab["default_tab"] = ($childTab["tab_id"] == $_GET["sp_tab"]) ? true : false;
                        }
                        if($childTab["default_tab"]) { $child_active = true; } 
                    }
                    ?>
                    
                    <!-- <?php echo $tab["tab_id"]; ?> -->
                    <li class="<?php echo ($child_active) ? "open active-li" : "main-menu";?>" id="<?php echo $tab["tab_id"].'-parent'; ?>">
                        <a class="tab-button <?php echo ($child_active) ? "" : "colapsed";?> <?php if($tab["default_tab"]) { echo "active"; } ?>" id="<?php echo $tab["tab_id"]; ?>" href="javascript:colapseTabs('<?php echo $tab["box_id"]; ?>submenu','<?php echo $tab["tab_id"]; ?>')">
                            <i class="menu-icon"></i>
                            <span class="menu-text"> <?php echo $tab["tab_name"]; ?> </span>
                            <b class="submenuarrow icon-angle-down"></b>
                        </a>
                        <ul class="submenu" id="<?php echo $tab["box_id"].'submenu'; ?>" style="<?php echo ($child_active) ? "display:block;" : "";?>">

                            <?php
                            foreach($tab["children"] as $childTab){ 
                                if(isset($_GET["sp_tab"])){
                                    $childTab["default_tab"] = ($childTab["tab_id"] == $_GET["sp_tab"]) ? true : false;
                                }
                                if($childTab["display"]){
                                    $disabled = "";
                                    $href = "javascript:switchSubTabs('".$childTab["box_id"]."', '".$childTab["tab_id"]."')";
                                }else{
                                    $disabled = "tab-disabled";
                                    $href = "javascript:disabledTab()";
                                }
                                ?>
                              <li class="main-menu" >
                                <a class="tab-button <?php echo $disabled; ?> <?php if($childTab["default_tab"]) { echo "active"; } ?>" id="<?php echo $childTab["tab_id"]; ?>" href="<?php echo $href; ?>">
                                    <span class="menu-text"> <?php echo $childTab["tab_name"]; ?> </span>
                                </a>
                            </li>  
                     <?php  }
                            ?>
                        </ul>
                    </li>

                <?php }else{ ?>
                    <?php 
                        if($tab["display"]){
                            $disabled = "";
                            $href = "javascript:switchTabs('".$tab['box_id']."', '".$tab['tab_id']."')";
                        }else{
                            $disabled = "tab-disabled";
                            $href = "javascript:disabledTab()";
                        }
                    ?>
                    <!-- <?php echo $tab["tab_id"]; ?> -->
                    <li class="main-menu <?php if($tab["default_tab"]) { echo "active-li"; } ?>">
                        <a class="tab-button <?php if($tab["default_tab"]) { echo "active"; } ?> <?php echo $disabled; ?>" id="<?php echo $tab["tab_id"]; ?>" href="<?php echo $href; ?>">
                            <i class="menu-icon"></i>
                            <span class="menu-text"> <?php echo $tab["tab_name"]; ?> </span>
                        </a>
                    </li>
         <?php   } ?>

            <?php } ?>

            <div style="clear:both;"></div>
        </ul>
        <?php
    }
    
    /*
     * This method will generate and display html for boxes (for each box we have corresponding tab
     */
    public function displayBoxes() {
        ?>
            <?php foreach($this->tabsAndBoxes as $tab) { 
                if(isset($_GET["sp_tab"])){
                    $tab["default_tab"] = ($tab["tab_id"] == $_GET["sp_tab"]) ? true : false;
                }
                ?>
                <?php if($tab["display"] && $tab["dropable"]) { ?>
                    <?php foreach($tab["children"] as $childTab){
                        //checking is tab disabled and should box be displayed
                            if($childTab["display"]){ 
                                if(isset($_GET["sp_tab"])){
                                    $childTab["default_tab"] = ($childTab["tab_id"] == $_GET["sp_tab"]) ? true : false;
                                }
                                ?>
                                <!-- <?php echo $childTab["box_id"]; ?> -->
                                <div class="tab-box" id="<?php echo $childTab["box_id"]; ?>" style="<?php if(!$childTab["default_tab"]) { echo "display:none;"; } ?>">
                                    <?php
                                        if(method_exists($this, $childTab["content_method"])) {
                                            $contentMethod = $childTab["content_method"];
                                            if(is_callable(array($this, $contentMethod))){
                                                $this->$contentMethod($childTab);
                                            }else{
                                                $this->displayDefaultBoxContent();
                                            }
                                        }
                                        else {
                                            $this->displayDefaultBoxContent();
                                        }
                                    ?>
                                </div>
                   <?php    }
                     } ?>
                <?php }elseif($tab["display"]){ ?>
                         <!-- <?php echo $tab["box_id"]; ?> -->
                        <div class="tab-box" id="<?php echo $tab["box_id"]; ?>" style="<?php if(!$tab["default_tab"]) { echo "display:none;"; } ?>">
                            <?php
                                if(method_exists($this, $tab["content_method"])) {
                                    $contentMethod = $tab["content_method"];
                                    if(is_callable(array($this, $contentMethod))){
                                        $this->$contentMethod($tab);
                                    }else{
                                        $this->displayDefaultBoxContent();
                                    }
                                }
                                else {
                                    $this->displayDefaultBoxContent();
                                }
                            ?>
                        </div>
          <?php } ?>
                    
            <?php } ?>
        <?php
    }
    
    /**
     * This method will display output of box related with Account tab
     */    
    private function boxContentAccount($tabOptions)  { 
        try{ ?>
            <div class="row">
                <div class="col-sm-7 spokal-connection-form">
                    <div class="settings_tab_wrapper">
                        <div class="submit-button-box">Enter the ApiKey and connect your site with your Spokal account</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="first-form" id="first-form">
                                <?php //ugly hack for settings_fields( 'spokal-settings-group' ) function ?>
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_forms_via_ajax" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-options"); ?>

                                <?php do_settings_sections( 'spokal-settings-group' ); ?>
                                <?php $connectionOpt = $this->vars->options; ?>
                                <?php if(isset($connectionOpt['connection_status'])){unset($connectionOpt['connection_status']);} ?>
                                <?php if(isset($connectionOpt['error_message'])){unset($connectionOpt['error_message']);} ?>
                                <?php if(isset($connectionOpt['warning_message'])){unset($connectionOpt['warning_message']);} ?>
                                <?php if(isset($connectionOpt['cooking_disable'])){unset($connectionOpt['cooking_disable']);} ?>

                                <?php SpokalAdminView::displayDashboardOptions($connectionOpt, $tabOptions["tab_id"]); ?>
                                <?php $button_text = ($this->vars->options['connection_status']['value'] !== "Connected" ) ? "Connect" : "Reconnect"; ?>
                                <div style="float:left;">
                                    <?php $this->submitButton($button_text,'connection_button','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="first-form-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 connections-status-wrapp">
                    <?php foreach($this->vars->options as $name => $option):  
                            if($name === "connection_status"): 
                                if($option['value'] !== "Connected"):  
                                    $className = "spokal_warning_box"; 
                                else: 
                                    $className = "spokal_success_box"; 
                                endif; ?>

                                <div class="<?php  echo $className; ?> connection_status">
                                    <span style="font-weight:bold;"><?php echo $option['name']; ?></span>:
                                    <span id="<?php echo $name; ?>" ><?php echo $option['value']; ?></span>
                                </div>

                            <?php
                            endif;
                            if($name === "warning_message"):
                                $style = (empty($option['value'])) ? "display:none" : ""; ?>

                                    <div class="spokal_warning_box" style="<?php echo $style; ?>">
                                        <!--<span style="font-weight:bold;"><?php // echo $option['name']; ?></span>:-->
                                        <span id="<?php echo $name; ?>" ><?php echo $option['value']; ?></span>
                                    </div>

                            <?php
                            endif;
                            if($name === "error_message"):
                                $style = (empty($option['value'])) ? "display:none" : ""; ?>
                                    <?php 
                                    if (strpos($option['value'],'This account is no longer active. Please login to Spokal and re-activate it.') !== false) {
                                        $link = '<a href="'.SP_Request::base_url().'/Account/LogOn" target="_blank">login</a>';
                                        $option['value'] = str_replace("login",$link,$option['value']);
                                    }
                                    ?>
                                    <div class="spokal_error_box" style="<?php echo $style; ?>">
<!--                                        <span style="font-weight:bold;"><?php // echo $option['name']; ?></span>:-->
                                        <span id="<?php echo $name; ?>" ><?php echo $option['value']; ?></span>
                                    </div>

                            <?php
                            endif;
                        ?>

                    <?php endforeach; ?>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-7 spokal-connection-form">
                    <div class="settings_tab_wrapper">
                        <div class="submit-button-box">Settings</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="sp-main-settings" id="sp-main-settings">
                                <?php //ugly hack for settings_fields( 'spokal-settings-group' ) function ?>
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_sp_main_settings" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-options-b"); ?>

                                <?php $social_enable = $this->vars->options["social_media_enable"]["value"]; ?>
                                <div class="option-block" style="position: relative;">
                                    <span id="sp_enable_social_settings" class="sp_enable_social_settings" style="display: none;"><span class="sp-arrow"></span><span class="sp-popupover-msg-inner">Social media sharing can be enabled/disabled per post when publishing through WordPress - here you can set if you want it to be enabled by default.</span></span>
                                    <input style="vertical-align: top; margin-top: 3px;" id="sp_social_media_enable" type="checkbox" name="sp_social_media_enable"  <?php echo  checked($social_enable, true, false); ?> >
                                    <label for="sp_social_media_disable" id="sp_social_media_disable_label" style="display: inline-block; width: 85%;">
                                        Enable social media publishing by default on all new blog posts created in WordPress.<br>(you can turn this off or on per post)
                                    </label>
                                </div>
                                <?php $connectionOpt = $this->vars->options; ?>
                                <?php if(isset($connectionOpt['api_key'])){unset($connectionOpt['api_key']);} ?>
                                <?php if(isset($connectionOpt['connection_status'])){unset($connectionOpt['connection_status']);} ?>
                                <?php if(isset($connectionOpt['error_message'])){unset($connectionOpt['error_message']);} ?>
                                <?php if(isset($connectionOpt['warning_message'])){unset($connectionOpt['warning_message']);} ?>
                                <?php SpokalAdminView::displayDashboardOptions($connectionOpt, $tabOptions["tab_id"]); ?>
                                
                                <div style="float:left;">
                                    <?php $this->submitButton("Save Changes",'mainSettings_button','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="sp-main-settings-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    /**
     * This method will display output of box related with Settings tab
     */    
    public function boxContentSettings($tabOptions) {
        try{ ?>
            <div class="settings_tab_wrapper">     
                <div class="submit-button-box">We recommend leaving these settings at their default values unless Spokal support suggests you change them.</div>
                <div class="from_wrapp">
                    <form action="" method="post" name="second-form" id="second-form">
                        <?php //ugly hack for settings_fields( 'spokal-settings-group-2' ) function ?>
                        <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group-2') . "' />" ?>
                        <?php echo '<input type="hidden" name="action" value="handling_second_form_via_ajax" />'; ?>
                        <?php wp_nonce_field("spokal-settings-group-2-options"); ?>

                        <?php do_settings_sections( 'spokal-settings-group-2' ); ?>

                        <?php SpokalAdminView::displayDashboardOptions($this->vars->options, $tabOptions["tab_id"]); ?>
                        
                        <div class="save-settings-button-wrapp">
                            <div style="float:left;">
                                <?php $this->submitButton('Save Changes','submit-2','primary');?>
                            </div>
                            <div class="spinner-container save-settings-button">
                                <span id="second-form-spiner" class="sp_spinner" style="display:none"></span>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        
                        <div class="clear-cache-wrapp">
                            <div class="clear-cache-button" style="">
                                <?php $this->submitButton('Clear Cache','clear-cache','primary');?>
                            </div>
                            <div  class="spinner-container">
                                <span id="sp_clear_cache-spiner" class="sp_spinner" style="display:none"></span>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                    
                </div>
            </div>

        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    /**
     * This method will display output of box related with Gravity tab
     */    
    public function boxContentGravity($tabOptions) {
        try{
            $options = SpokalVars::getInstance()->options;
            if(!method_exists('RGFormsModel', 'get_forms')){
                return;
            }
            $forms = RGFormsModel::get_forms( null, 'title' );
            if(empty($forms) || !is_array($forms)) {
                echo "<p class='spokal_warning_box'>You need to create a form using the gravity form plugin in order to use it with Spokal.</p>";
                return;
            }
        ?>
            <div class="row">
                <div class="col-sm-7">
                    <div class="settings_tab_wrapper cf7-wrapp" > 
                        <div class="submit-button-box">Please select which forms you want to submit to Spokal.</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="third-form" id="third-form">
                                <?php //ugly hack for settings_fields( 'spokal-settings-group-2' ) function ?>
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group-3') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_third_form_via_ajax" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-3-options"); ?>

                                <?php do_settings_sections( 'spokal-settings-group-3' ); ?>
                                <!--<div style="font-size: 13px; margin-bottom: 15px;">Please select which forms you want to submit to Spokal.</div>-->

                                <?php

                                $usedForms = get_option('spokal_gravity_and_spokal_forms');

                                $campaigns = SpokalVars::getInstance()->campaigns;

                                $campaignsAssociated = get_option("spokal_gravity_form_lead_list");

                                $apiKey = $options['api_key']['value'];

                                $html = "";

                                foreach( $forms as $form ){
                                    $checked = "";
                                    if(is_array($usedForms)){
                                        if(in_array($form->id, $usedForms)) {
                                            $checked = "checked";
                                        }else {
                                            $checked = "";
                                        }
                                    }

                                    ?>
                                    <div class="leads_selection" style="margin-bottom:18px;">

                                        <div class="leads_checkbox" >
                                            <input style="margin-right:3px;" type="checkbox" name="gravity_and_spokal[]" <?php echo $checked; ?> value="<?php echo $form->id; ?>"><?php echo $form->title; ?>
                                        </div>


                                        <?php if($apiKey && is_array($campaigns["Lists"])) { ?>
                                            <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                                <select name="gravity_form_campaign_<?php echo $form->id; ?>">
                                                    <?php foreach($campaigns["Lists"] as $key => $value) { ?>

                                                        <?php 
                                                            $campaingChecked = "";
                                                            if(isset($campaignsAssociated[$form->id])) {
                                                                if($campaignsAssociated[$form->id] == $key) {
                                                                    $campaingChecked = "selected";
                                                                }
                                                                else {
                                                                    $campaingChecked = "";
                                                                }
                                                            } 
                                                        ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $campaingChecked; ?>><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                                <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                                    <select name="gravity_form_campaign_<?php echo $form->id; ?>">
                                                        <option value="-1">default</option>
                                                    </select>
                                                </div>
                                        <?php } ?>

                                        <div style="clear:both;"></div>

                                    </div>
                                    <?php

                                }
                                echo $html;
                                ?>
                                <div style="float:left;">
                                    <?php $this->submitButton('Save Changes','submit-3','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="third-form-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentStatus($tabOptions) {
        try{ ?>
            
            <?php $spokalRequirements = SpokalRequirements::getInstance(); ?>
            <div class="spokal-requirements-wrapp">
                <div class="settings_tab_wrapper spokal-requirements"> 
                    <div class="submit-button-box">REQUIREMENTS</div>
                    <div class="from_wrapp">
                        <?php $spokalRequirements->renderRequirements(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="error_logging_overlay">
                    <div id="error_log_popup">
                        <div class="warning_message">
                            <span class="el_popup_note">Please note:</span>
                            <br /> 
                            <p>We strongly do NOT recommend activating this unless you've been directed to by Spokal support.</p>
                            <p>Please click <span class="el_cancel">Cancel</span> unless Spokal support has directed you to do this.</p>
                        </div>
                        <div class="el_popup_footer">
                            <?php $this->submitButton('Enable','confirm_logging','primary');?>
                            <?php $this->cancelButton('Cancel', 'cancel_logging', 'cancel'); ?>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7a spokal-error-box-wrapp">
                    <div class="settings_tab_wrapper spokal-error-box"> 
                        <div class="submit-button-box">ERROR LOG</div>
                        <div class="from_wrapp">
                            <div class="error-renderer"><?php SpokalPhpErrorLog::render(); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5a">
                    <div class="clearSpokalCookie">
                        <div class="resetCookieExplanation">
                            Reset the Scroll Box, Smart Bar, Exit Intent and Lead Generator Widget - so it will behave like it would if your next visit to the site was your first. Will only reset it for this computer and browser, it won't affect anyone else.
                        </div>
                        <div class="resetCookieForm">
                            <form action="" method="post" name="clearLeadListCookieForm" id="clearLeadListCookieForm">
                                <input type="hidden" name="action" value="handling_clearLeadListCookieForm" />
                                <?php wp_nonce_field("spokal-settings-clearLeadListCookieForm"); ?>
                                <div style="float:left;">
                                    <?php $this->submitButton('Reset','clearLeadListCookieForm','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="clearLeadListCookieForm-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentCF7($tabOptions) { 
        try{
            $options = SpokalVars::getInstance()->options;
            if(!method_exists('WPCF7_ContactForm','find')){
                echo '<p class="spokal_error_box">The version of ContactForm7 on this site is old. You need to upgrade to a newer version in order to use it with Spokal.</p>';
                return;
            } ?>
            <div class="row cf7-row">
                <div class="col-sm-5a">
                    <p class="cf7-instructions" style="margin-bottom: 20px;">
                        The form field names <b>MUST</b> be named in a very specific way as per the table below.
                        Only the email field is mandatory.
                        <br><br>
                        <b>NOTE:</b> Make sure you modify the CF7 <a href="http://contactform7.com/setting-up-mail/" target="_blank">mail settings</a> to match if you change the field names
                    </p> 
                    <table class="table cf7-table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Field</th>
                                <th>FormFieldName/Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Email</td>
                                <td>email</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>First Name</td>
                                <td>fname</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Last Name</td>
                                <td>lname</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Company</td>
                                <td>company</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Phone</td>
                                <td>phone</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                $forms = WPCF7_ContactForm::find( array('orderby' => 'title',) );
                if(empty($forms) || !is_array($forms)) {
                    echo "<p class='spokal_error_box'>You need to create a form using the Contact Form 7 form plugin in order to use it with Spokal.</p>";
                    return;
                }
                ?>
                <div class="col-sm-7a">
                    <div class="settings_tab_wrapper cf7-wrapp" > 
                        <div class="submit-button-box">Please select which forms you want to submit to Spokal.</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="fifth-form" id="fifth-form">
                                <?php //ugly hack for settings_fields( 'spokal-settings-group-2' ) function ?>
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group-5') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_fifth_form_via_ajax" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-5-options"); ?>
                                <?php do_settings_sections( 'spokal-settings-group-5' ); ?>
                                <?php
                                $usedForms = get_option('spokal_cf7_and_spokal_forms');
                                $campaignsAssociated = get_option("spokal_cf7_form_lead_list");
                                $campaigns = SpokalVars::getInstance()->campaigns;
                                $apiKey = $options['api_key']['value'];

                                foreach( $forms as $form ){
                                    $checked = "";
                                    if(is_array($usedForms)){
                                        if(in_array($form->id, $usedForms)) {
                                            $checked = "checked";
                                        }else {
                                            $checked = "";
                                        }
                                    }
                                    ?>
                                    <div class="leads_selection" >
                                        <div class="leads_checkbox">
                                            <input style="margin-right:3px;" type="checkbox" name="cf7_and_spokal[]" <?php echo $checked; ?> value="<?php echo $form->id; ?>"><?php echo $form->title; ?>
                                        </div>
                                        <?php if($apiKey && is_array($campaigns["Lists"])) { ?>
                                                <div class="lead-list-select" >
                                                    <select name="cf7_form_campaign_<?php echo $form->id; ?>">
                                                        <?php foreach($campaigns["Lists"] as $key => $value) { ?>
                                                            <?php 
                                                                $campaingChecked = "";
                                                                if(isset($campaignsAssociated[$form->id])) {
                                                                    if($campaignsAssociated[$form->id] == $key) {
                                                                        $campaingChecked = "selected";
                                                                    }
                                                                    else {
                                                                        $campaingChecked = "";
                                                                    }
                                                                } 
                                                            ?>
                                                            <option value="<?php echo $key; ?>" <?php echo $campaingChecked; ?>><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class="lead-list-select">
                                                    <select name="cf7_form_campaign_<?php echo $form->id; ?>">
                                                        <option value="-1">default</option>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div style="float:left;">
                                    <?php $this->submitButton('Save Changes','submit-5','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="fifth-form-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentJetPack($tabOptions) { 
        try{ ?>
            <div class="row cf7-row">
                <div class="col-sm-5a">
                    <p class="cf7-instructions" style="margin-bottom: 20px;">
                        The form field labels <b>MUST</b> be named in a very specific way.
                        Only the email field is mandatory.
                    </p>
                    <table class="table cf7-table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Field</th>
                                <th>FormFieldLabel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Email</td>
                                <td>Email</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>First Name</td>
                                <td>First Name</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Last Name</td>
                                <td>Last Name</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Company</td>
                                <td>Company</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Phone</td>
                                <td>Phone</td>
                            </tr>
                        </tbody>
                </table>
                </div>
                <div class="col-sm-7a">
                    <div class="settings_tab_wrapper cf7-wrapp" > 
                        <div class="submit-button-box">Jetpack Settings</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="jetpack-settings-form" id="jetpack-settings-form">
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group-5') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_jetpack_settings_form" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-55-options"); ?>
                                <?php do_settings_sections( 'spokal-settings-group-55' ); ?>
                                <?php
                                $campaigns = SpokalVars::getInstance()->campaigns;
                                $jetpack_lead_list = get_option("spokal_jetpack_lead_lists",false);
                                $jetpack_disabled = get_option("spokal_disable_jetpack",false); ?>
                                    <div class="leads_selection" >
                                        <div class="leads_checkbox" style="float:none; margin-bottom: 5px;">
                                            <input style="margin-right:3px;" type="checkbox" name="disable_jetpack" <?php echo ($jetpack_disabled == "true") ? "checked" : ""; ?> value="">Do not send to Spokal
                                        </div>
                                        <label>Lead list:</label>
                                        <?php if(is_array($campaigns["Lists"])) { ?>
                                                <div class="lead-list-select jetpack-list" >
                                                    <select name="jetpack_form_campaign">
                                                    <?php foreach($campaigns["Lists"] as $key => $value) { 
                                                        $selected = ($jetpack_lead_list == $key) ? "selected" : "";
                                                        ?>
                                                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>  ><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class="lead-list-select jetpack-list" >
                                                    <select name="jetpack_form_campaign">
                                                        <option value="-1">default</option>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                    </div>
                                    <?php
                                ?>
                                <div style="float:left;">
                                    <?php $this->submitButton('Save Changes','submit-5','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="jetpack-settings-form-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxWpContentHTMLForm($tabOptions){ 
        try{ ?>
        <div class="wp-html-form">
            <div class="information_box html_form_info_box">
                <p class="header_info">For WordPress plugins</p>
                <p style="margin: 0.5em;">This form can be used with certain WordPress plugins and themes, like HybridConnect and OptimizePress.</p>
            </div>
            <?php
            $campaigns = SpokalVars::getInstance()->campaigns;
            $leadLists = array();

            if(!isset($campaigns['Lists']) || !is_array($campaigns['Lists']) || empty($campaigns['Lists'])){ ?>
                <script>jQuery(document).ready(function(){jQuery('#enableWpRedirectUrl').change(function(){jQuery('#htmlWpFormRedirectUrl').toggleClass('displayUrl');});});</script> 
                <div class="settings_tab_wrapper wp_html_settings_wrap">
                    <div class="submit-button-box">Copy your HTML form for WordPress plugins</div>
                    <div class="from_wrapp">
                        <form action="" method="post" name="htmlGenerateForm" id="htmlGenerateForm">
                            <?php echo '<input type="hidden" name="action" value="generate_HMLForm" />'; ?>
                            <input type="hidden" name="html_form_leadList" value="-1">
                            <div style="padding-bottom: 1px;">
                                <p>
                                    <input type="checkbox" id="enableWpRedirectUrl" class="checkbox" name="enableWpRedirectUrl" />
                                    <label for="enableRedirectUrl"><?php _e( 'Set form to redirect after submit.' ); ?></label>  
                                </p>
                            </div>
                            <div id="htmlWpFormRedirectUrl" style="display:none;">
                                <p class="redirect-url">
                                    <label for="wpRedirectUrl"><?php _e( 'Enter redirect url and generate new form:' ); ?></label> 
                                    <input class="widefat" name="wpRedirectUrl" type="text" value="" />
                                </p>
                                <div style="float:left;  margin-left: 10px;">
                                    <?php $this->submitButton('Generate','submit-7','primary');?>
                                </div>

                                <div class="spinner-container">
                                    <span id="htmlGenerateForm-spiner" class="sp_spinner" style="display:none"></span>
                                </div>

                                <div style="clear:both;"></div>
                            </div>
                        </form>
                        <div id='appendHtmlForm'>
                        <?php echo SP_Settings::generate_html_from(-1,"WpHtml", ""); ?>
                    </div>
                    </div>
                </div>

      <?php }else{
                foreach($campaigns['Lists'] as $key => $value){
                    $leadLists[] = array(
                                    'id' => $key,
                                    'name' => $value
                    );
                }


                if(count($leadLists) == 1){ ?>
                    <script>jQuery(document).ready(function(){jQuery('#enableWpRedirectUrl').change(function(){jQuery('#htmlWpFormRedirectUrl').toggleClass('displayUrl');});});</script> 
                    <div class="settings_tab_wrapper">
                        <div class="submit-button-box">Copy your HTML form for WordPress plugins</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="htmlGenerateForm" id="htmlGenerateForm">
                                <?php echo '<input type="hidden" name="action" value="generate_HMLForm" />'; ?>
                                <input type="hidden" name="html_form_leadList" value="<?php echo $leadLists[0]['id']; ?>">
                                <div style="padding-bottom: 1px;">
                                    <p>
                                        <input type="checkbox" id="enableWpRedirectUrl" class="checkbox" name="enableWpRedirectUrl" />
                                        <label for="enableRedirectUrl"><?php _e( 'Set form to redirect after submit.' ); ?></label>  
                                    </p>
                                </div>
                                <div id="htmlWpFormRedirectUrl" style="display:none;">
                                    <p class="redirect-url">
                                        <label for="wpRedirectUrl"><?php _e( 'Enter redirect url and generate new form:' ); ?></label> 
                                        <input class="widefat" name="wpRedirectUrl" type="text" value="" />
                                    </p>
                                    <div style="float:left;  margin-left: 10px;">
                                        <?php $this->submitButton('Generate','submit-7','primary');?>
                                    </div>

                                    <div class="spinner-container">
                                        <span id="htmlGenerateForm-spiner" class="sp_spinner" style="display:none"></span>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                            <div id='appendHtmlForm'>
                        <?php echo SP_Settings::generate_html_from($leadLists[0]['id'],"WpHtml", ""); ?>
                    </div>
                        </div>
                    </div>
                    
            <?php }elseif(count($leadLists) > 1){ ?>
                    <script>jQuery(document).ready(function(){jQuery('#enableWpRedirectUrl').change(function(){jQuery('#htmlWpFormRedirectUrl').toggleClass('displayUrl');});});</script> 
                    <div class="settings_tab_wrapper">
                        <div class="submit-button-box">Choose Lead List and click "Generate" to get HTML form.</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="htmlGenerateForm" id="htmlGenerateForm">
                            <?php echo '<input type="hidden" name="action" value="generate_HMLForm" />'; ?>
                            <div>

                                <div style="float:left; width:65px; line-height: 21px; font-size: 14px;">
                                    <span>Lead List:</span>
                                </div>

                                <?php if(is_array($campaigns["Lists"])) { ?>

                                        <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                            <select name="html_form_leadList">
                                                <?php foreach($campaigns["Lists"] as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                <?php } ?>
                                <div style="clear:both;"></div>
                            </div>
                                <div style="padding-bottom: 1px;">
                                    <p>
                                        <input type="checkbox" id="enableWpRedirectUrl" class="checkbox" name="enableWpRedirectUrl" />
                                        <label for="enableRedirectUrl"><?php _e( 'Redirect after submit.' ); ?></label>  
                                    </p>
                                    <p id="htmlWpFormRedirectUrl" style="display:none; width: 260px;">
                                        <label for="wpRedirectUrl"><?php _e( 'Redirect Url:' ); ?></label> 
                                        <input class="widefat" name="wpRedirectUrl" type="text" value="" />
                                    </p>
                                </div>
                                <div>
                                    <div style="float:left;">
                                        <?php $this->submitButton('Generate','submit-7','primary');?>
                                    </div>

                                    <div class="spinner-container">
                                        <span id="htmlGenerateForm-spiner" class="sp_spinner" style="display:none"></span>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                            <div id='appendHtmlForm'></div>
                        </div>
                    </div>
            <?php } 

            }?>
        </div>
<?php } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
}
    
    public function boxNetContentHTMLForm($tabOptions){ 
        try{ ?>
            <div class="universal-html-form" >
                <script>jQuery(document).ready(function(){jQuery('#enableRedirectUrl').change(function(){jQuery('#htmlFormRedirectUrl').toggleClass('displayUrl');});});</script> 
                <div class="information_box html_form_info_box net_html_form_info_box">
                    <p class="header_info">A simple HTML form that lets you collect contacts.</p>
                    <p style="margin: 0.5em;">Fill out the details below, then copy and paste the HTML we provide you into any NON-WORDPRESS pages or sites you have where you want to collect email addresses.  Note: The sites you use this on MUST be on the same top level domain as your primary site (a different subdomain is fine).</p>
                </div>
                <div class="settings_tab_wrapper">
                    <div class="submit-button-box" id="netSettingsInstruc">Choose Your settings and click "Generate" to get HTML form.</div>
                    <div class="submit-button-box" id="netGetFormInstruc">Copy your HTML form</div>
                    <div class="from_wrapp">
                        <div id="netHtmlForm">
                            <form action="" method="post" name="netHtmlGenerateForm" id="netHtmlGenerateForm">
                                <?php echo '<input type="hidden" name="action" value="generate_NetHMLForm" />'; ?>
                                <div>
                                    <p>
                                        <label class="option-label" for="successMessage"><?php _e( 'Success Message:' ); ?></label> 
                                        <input class="form-element widefat" name="successMessage" type="text" value="Message has been submitted successfully" />
                                    </p>

                                    <p>
                                        <label class="option-label" for="invalidEmailMessage"><?php _e( 'Invalid Email Message:' ); ?></label> 
                                        <input class="form-element widefat" name="invalidEmailMessage" type="text" value="Your email address does not appear valid." />
                                    </p>

                                    <p>
                                        <label class="option-label" for="failMessage"><?php _e( 'Default Fail Message:' ); ?></label> 
                                        <input class="form-element widefat" name="failMessage" type="text" value="Failed to send your message. Please try later." />
                                    </p>

                                    <p>
                                        <label class="option-label" for="buttonText"><?php _e( 'Button Text:' ); ?></label> 
                                        <input class="form-element widefat" name="buttonText" type="text" value="Register" />
                                    </p>

                                    <div>
                                        <p class="placeholder-left" style=" margin-top: 0px; margin-bottom: 0px;">
                                            <label class="option-label" for="firstNamePlaceholder" ><?php _e( 'First Name Placeholder:' ); ?></label>
                                            <input class="form-element widefat" name="firstNamePlaceholder" type="text" value="First Name" />
                                        </p>
                                        <p class="placeholder-right" style=" margin-bottom: 0px; margin-top: 0px;">
                                            <label class="option-label" for="phonePlaceholder" ><?php _e( 'Phone Placeholder:' ); ?></label>
                                            <input class="form-element widefat" id="phonePlaceholder" name="phonePlaceholder" type="text" value="Phone" />
                                        </p>
                                        <div style="clear:both;"></div>

                                        <p class="placeholder-left" >
                                            <label class="option-label" for="lastNamePlaceholder" ><?php _e( 'Last Name Placeholder:' ); ?></label>
                                            <input class="form-element widefat" id="lastNamePlaceholder" name="lastNamePlaceholder" type="text" value="Last Name" />                        
                                        </p>
                                        <p class="placeholder-right">
                                            <label class="option-label" for="companyPlaceholder" ><?php _e( 'Company Placeholder:' ); ?></label>
                                            <input class="form-element widefat" id="companyPlaceholder" name="companyPlaceholder" type="text" value="Company" />
                                        </p>
                                        <div style="clear:both;"></div>
                                    </div>

                                    <div class="scrollBoxCheckbox">
                                        <div class="CheckboxLeft">
                                            <p>
                                                <input type="checkbox" class="checkbox" name="hmlBoxFirstName"  />
                                                <label class="option-label" for="hmlBoxFirstName"><?php _e( 'Collect first name.' ); ?></label>  
                                            </p>

                                            <p>
                                                <input  type="checkbox" class="checkbox" name="htmlBoxLastName" />
                                                <label class="option-label" for="htmlBoxLastName"><?php _e( 'Collect last name.' ); ?></label> 
                                            </p>
                                        </div>
                                        <div class="CheckboxRight">
                                            <p>
                                                <input type="checkbox" class="checkbox" name="htmlBoxPhone"  />
                                                <label class="option-label" for="htmlBoxPhone"><?php _e( 'Collect phone.' ); ?></label> 
                                            </p>

                                            <p>
                                                <input type="checkbox" class="checkbox" name="htmlBoxCompany"  />
                                                <label class="option-label" for="htmlBoxCompany"><?php _e( 'Collect company.' ); ?></label> 
                                            </p>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>

                                    <div style="padding-bottom: 1px;">
                                        <p>
                                            <input type="checkbox" id="enableRedirectUrl" class="checkbox" name="enableRedirectUrl" />
                                            <label class="option-label" for="enableRedirectUrl"><?php _e( 'Redirect after submit.' ); ?></label>  
                                        </p>
                                        <p id="htmlFormRedirectUrl" style="display:none;">
                                            <label class="option-label" for="redirectUrl"><?php _e( 'Redirect Url:' ); ?></label> 
                                            <input class="form-element widefat" name="redirectUrl" type="text" value="" />
                                        </p>
                                    </div>

                                    <p>
                                    <?php
                                    $campaigns = SpokalVars::getInstance()->campaigns;
                                    if(is_array($campaigns) && isset($campaigns["Lists"])){
                                        if(is_array($campaigns["Lists"])) { ?>

                                            <label for="net_html_form_leadList"><?php _e( 'Lead List: ' ); ?></label>
                                            <select name="net_html_form_leadList">
                                                <?php foreach($campaigns["Lists"] as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>

                                    <?php } 
                                    }?>
                                    </p>
                                    <div style="float:right; ">
                                        <?php $this->submitButton('Generate','netHtmlFormGen','primary');?>
                                    </div>

                                    <div style="float:right; " class="spinner-container">
                                        <span id="netHtmlGenerateForm-spiner" class="sp_spinner" style="display:none"></span>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                        </div>
                        <div id="extHtmlFormContent"></div>
                        <div id="cancelHtmlButton">
                             <?php $this->cancelButton('Cancel', 'cancelHtmlForm', 'cancel'); ?>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
    <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentScrollBox($tabOptions){
        try{
            ?>
            <div class="scrollbox-settings-wrapp">
                <div class="row">
                    <?php
                    $checkEnable = SpokalVars::getInstance()->options['scroll_box_enable']['value'];
                    if(class_exists("ScrollBoxAddon")){
                        ScrollBoxAddon::renderEnableDisableScrollBox($checkEnable);
                        ScrollBoxAddon::renderFormContentSettings($checkEnable,$tabOptions);
                    }
                    ?>
                </div>
            </div>
            <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentSmartBar($tabOptions){
        try{
            ?>
            <div class="scrollbox-settings-wrapp">
                <div class="row">
                    <?php
                    $checkEnable = SpokalVars::getInstance()->options['smart_bar_enable']['value'];
                    if(class_exists("SmartBarAddon")){
                        SmartBarAddon::renderEnableDisableSmartBar($checkEnable);
                        SmartBarAddon::renderFormContentSettings($checkEnable,$tabOptions);
                    }
                    ?>
                </div>
            </div>
            <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentExitIntent($tabOptions){
        try{
            ?>
            <div class="scrollbox-settings-wrapp">
                <div class="row">
                    <?php
                    $checkEnable = SpokalVars::getInstance()->options['exit_intent_enable']['value'];
                    if(class_exists("ExitIntent")){
                        ExitIntent::renderEnableDisableSmartBar($checkEnable);
                        ExitIntent::renderFormContentSettings($checkEnable,$tabOptions);
                    }
                    ?>
                </div>
            </div>
            <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentInlineCta($tabOptions){ ?>
        <div class="inlineCTAInstructions">
            <p class="instruction">
                The in-line CTA can be dragged and dropped from in the Spokal editor right within your content. You can configure the CTA wording and options in Spokal (which is best, as it should be contextually specific to the blog post you drop it into) - but here you can customize the look and CSS of the CTA so it best fits your site's design.
            </p>
            <div class="sp_style_cta_form_wrapp">
                <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                    <input type="hidden" name="action" value="sp_style_cta">
                    <input type="hidden" name="style_file" value="">
                    <input type="hidden" name="sp_cta" value="inlineCta">
                    <input type="hidden" name="boxId" value="<?php echo $tabOptions['box_id']; ?>">
                    <input type="hidden" name="version" value="">
                    <?php SpokalAdminView::submitButton('Customize Inline CTA','sbStyle','primary');?>
                    <div style="float:right;" class="spinner-container">
                        <span  class="sp_spinner sp_style_cta_form_spiner" style="display:none"></span>
                    </div>
                    <div style="clear:both;"></div>
                </form>
            </div>
        </div>
<?php }
    
    public function boxContentXmlSitemaps($tabOptions){
        try{ 
            $options = SpokalVars::getInstance()->options['xml_sitemaps']['value'];
            $permalinks =  get_option('permalink_structure') ? true : false; 
            if(!$permalinks){
                if($options['enable'] === "true"){
                    $options['enable'] = "false";
//                    update_option('spokal_xml_sitemaps',$options);
                }
                ?>
            <div class="spokal_error_box xml_sitemaps_error" style=""><a href="<?php echo admin_url('options-permalink.php'); ?>">Permalinks</a> must be enabled on this site to generate an XML Sitemap. It's also a really good idea for SEO and usability to use permalinks.</div>
      <?php }
            ?>
            <div class="settings_tab_wrapper">     
                <div class="submit-button-box">Xml Sitemaps Settings</div>
                <div class="from_wrapp">
                    <form action="" method="post" name="xml-sitemaps-form" id="xml-sitemaps-form">
                        <?php echo '<input type="hidden" name="action" value="handling_xml_sitemaps_form" />'; ?>
                        
                        <?php $checked = ($options['enable'] === "true") ? "checked" : ""; ?>
                        <?php $class = ($options['enable'] === "false") ? "hide-opt" : ""; ?>
                        <h2 class="xml-sitemaps-header">Enable XML Sitemaps <small id="sp-sitemap-url" class="<?php echo $class; ?>">You can find your XML Sitemap here: <a target="_blank" class="sp_sitemap_url" href="<?php echo esc_url( Spokal_Sitemaps_Admin::spokal_xml_sitemaps_base_url( 'sp-sitemap.xml' ) ); ?>">Xml Sitemap</a></small></h2>
                        <div class="option-block">
                            <input id="xmlsitemas_enable" type="checkbox" name="enable" <?php if(!$permalinks) echo "disabled"; ?> value="true" <?php echo $checked; ?> size="60">
                            Check this box to enable XML Sitemaps functionality
                        </div>
                        
                        <?php $class = ($options['enable'] === "false") ? "hide-opt" : "show-opt"; ?>
                        <div id="sp-xmlsitemaps-detail-settings" class="<?php echo $class; ?>">
                                                        
                            <div class="opt-left">
                                <?php 
                                $post_types = get_post_types( array( 'public' => true ), 'objects');
                                if ( is_array( $post_types ) && $post_types !== array() ) {
                                    echo '<h2 class="xml-sitemaps-header" >Exclude post types <small>Post type that you don\'t want to include in sitemap</small></h2>';
                                    foreach ( $post_types as $pt ) { 
                                        if(in_array($pt->name,array('attachment'))){continue;}
                                        $checked = (in_array($pt->name, $options['exclude_post_types'])) ? "checked" : ""; ?>
                                        <div class="option-block">
                                            <input id="exclude-<?php echo $pt->name; ?>" type="checkbox" name="exclude_post_types[]" value="<?php echo $pt->name; ?>" <?php echo $checked; ?> size="60">
                                            <?php echo $pt->labels->name; ?>
                                        </div>
                              <?php }   
                                } ?>
                            </div>
                            
                            <div class="opt-right">
                                <?php 
                                $taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
                                if ( is_array( $taxonomies ) && $taxonomies !== array() ) {
                                    echo '<h2 class="xml-sitemaps-header" >Exclude taxonomies <small>Taxonomy that you don\'t want to include in sitemap</small></h2>';
                                    foreach ( $taxonomies as $tax ) { 
                                        if ( isset( $tax->labels->name ) && trim( $tax->labels->name ) != '' ) {
                                            $checked = (in_array($tax->name, $options['exclude_taxonomies'])) ? "checked" : ""; ?>
                                            <div class="option-block">
                                                <input id="exclude-<?php echo $tax->name; ?>" type="checkbox" name="exclude_taxonomies[]" value="<?php echo $tax->name; ?>" <?php echo $checked; ?> size="60">
                                                <?php echo $tax->labels->name; ?>
                                            </div>
                                  <?php }
                                    }   
                                } ?>
                            </div>
                            <div style="clear:both;"></div>
                            
                            
                            <div class="opt-left">
                                <?php $checked = ($options['disable_user'] === "true") ? "checked" : ""; ?>
                                <h2 class="xml-sitemaps-header" >User Sitemap</h2>
                                <div class="option-block">
                                    <input id="xmlsitemas_user" type="checkbox" name="disable_user" value="true" <?php echo $checked; ?> size="60">
                                    Disable author/user sitemap
                                </div>

                                <?php $class = ($options['disable_user'] === "true") ? "hide-opt" : "show-opt"; ?>
                                <div id="user-sitemap-settings" class="<?php echo $class; ?>">
                                    <p><strong>Exclude users without posts:</strong><br/>
                                    <?php $checked = ($options['no_author_user'] === "true") ? "checked" : ""; ?>
                                    <div class="option-block">
                                        <input id="xmlsitemas_noauthor_user" type="checkbox" name="no_author_user" value="true" <?php echo $checked; ?> size="60">
                                        Disable all users with zero posts
                                    </div>


                                    <?php 
                                    global $wp_roles;
                                    if ( ! isset( $wp_roles ) ) {
                                            $wp_roles = new WP_Roles();
                                    }
                                    $roles = $wp_roles->get_names();
                                    if ( is_array( $roles ) && $roles !== array() ) {
                                        echo '<p><strong>Exclude user roles:</strong></p>';
                                        foreach ( $roles as $role_key => $role_name ) {
                                            $checked = (in_array($role_key, $options['exclude_users'])) ? "checked" : ""; ?>
                                            <div class="option-block">
                                                <input id="exclude-<?php echo $role_key; ?>" type="checkbox" name="exclude_users[]" value="<?php echo $role_key; ?>" <?php echo $checked; ?> size="60">
                                                <?php echo $role_name; ?>
                                            </div>
                                  <?php }   
                                    } ?>
                                </div>
                            </div>
                            <div class="opt-right">
                                <h2 class="xml-sitemaps-header" >Entries per page <small>Max entries per sitemap page</small></h2>
                                <div class="option-block">
                                    <input class="form-element" id="max_sitemaps" type="number" name="max_entries" value="<?php echo $options['max_entries']; ?>" size="60">
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            
                            
                            
                        </div>
                        <div style="float:left;">
                            <?php $this->submitButton('Save Changes','submit-2','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="xml-sitemaps-form-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>

        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentNinjaForms($tabOptions){      
        try{
            $options = SpokalVars::getInstance()->options;
            if(!function_exists ('ninja_forms_get_all_forms')){
                return;
            }
            $forms = ninja_forms_get_all_forms();
            if(empty($forms) || !is_array($forms)) {
                echo "<p class='spokal_warning_box'>You need to create a form using the ninja form plugin in order to use it with Spokal.</p>";
                return;
            }
        ?>
            <div class="row">
                <div class="col-sm-7">
                    <div class="settings_tab_wrapper cf7-wrapp" > 
                        <div class="submit-button-box">Please select which forms you want to submit to Spokal.</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="tenth-form" id="tenth-form">
                                <?php //ugly hack for settings_fields( 'spokal-settings-group-2' ) function ?>
                                <?php echo "<input type='hidden' name='option_page' value='" . esc_attr('spokal-settings-group-10') . "' />" ?>
                                <?php echo '<input type="hidden" name="action" value="handling_tenth_form_via_ajax" />'; ?>
                                <?php wp_nonce_field("spokal-settings-group-10-options"); ?>

                                <?php do_settings_sections( 'spokal-settings-group-10' ); ?>
                                <!--<div style="font-size: 13px; margin-bottom: 15px;">Please select which forms you want to submit to Spokal.</div>-->

                                <?php

                                $usedForms = get_option('spokal_ninja_and_spokal_forms');

                                $campaigns = SpokalVars::getInstance()->campaigns;

                                $campaignsAssociated = get_option("spokal_ninja_form_lead_list");

                                $apiKey = $options['api_key']['value'];

                                $html = "";

                                foreach( $forms as $form ){
                                    $checked = "";
                                    if(is_array($usedForms)){
                                        if(in_array($form['id'], $usedForms)) {
                                            $checked = "checked";
                                        }else {
                                            $checked = "";
                                        }
                                    }

                                    ?>
                                    <div class="leads_selection" style="margin-bottom:18px;">

                                        <div class="leads_checkbox" >
                                            <input style="margin-right:3px;" type="checkbox" name="ninja_and_spokal[]" <?php echo $checked; ?> value="<?php echo $form['id']; ?>"><?php echo $form['name']; ?>
                                        </div>


                                        <?php if($apiKey && is_array($campaigns["Lists"])) { ?>
                                            <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                                <select name="ninja_form_campaign_<?php echo $form['id']; ?>">
                                                    <?php foreach($campaigns["Lists"] as $key => $value) { ?>

                                                        <?php 
                                                            $campaingChecked = "";
                                                            if(isset($campaignsAssociated[$form['id']])) {
                                                                if($campaignsAssociated[$form['id']] == $key) {
                                                                    $campaingChecked = "selected";
                                                                }
                                                                else {
                                                                    $campaingChecked = "";
                                                                }
                                                            } 
                                                        ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $campaingChecked; ?>><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                                <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                                    <select name="ninja_form_campaign_<?php echo $form['id']; ?>">
                                                        <option value="-1">default</option>
                                                    </select>
                                                </div>
                                        <?php } ?>

                                        <div style="clear:both;"></div>

                                    </div>
                                    <?php

                                }
                                echo $html;
                                ?>
                                <div style="float:left;">
                                    <?php $this->submitButton('Save Changes','submit-10','primary');?>
                                </div>
                                <div class="spinner-container">
                                    <span id="tenth-form-spiner" class="sp_spinner" style="display:none"></span>
                                </div>
                                <div style="clear:both;"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContentSpPopups($tabOptions)
    {
        try{ ?>
            <div class="scrollbox-settings-wrapp">
                <div class="row">
                    <?php
                    if(class_exists("SpokalPopup")){
                        SpokalPopup::renderAdmin($tabOptions);
                    }
                    ?>
                </div>
            </div>
            <?php
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    public function boxContent3rdIntegrations($tabOptions){ 
        try{ 
            $options = SpokalVars::getInstance()->options;
            $authorizationKey = $options['authorization_key']['value'];
            $acountId = $options['account_id']['value'];
            $campaigns = SpokalVars::getInstance()->campaigns;
            ?>
            <div class="information_box html_form_info_box third_party_info_box">
                <p class="header_info">For use with other software - like landing pages</p>
                <p style="margin: 0.5em;">Do not use this on your WordPress site. This is for use on sites you may use alongside your main site, like landing pages. For advanced users only - or those following our setup guides with other pieces of software.</p>
            </div>
            <script>jQuery(document).ready(function(){jQuery('#enable3rdFromRedirectUrl').change(function(){jQuery('#html3rdFormRedirectUrl').toggleClass('displayUrl');});});</script>
            <div class="tracking_js_wrapp third_party_wrapp">
                <div class="settings_tab_wrapper ">
                    <div class="submit-button-box">Copy your Tracking Javascript</div>
                    <div class="from_wrapp">
                        <div style="padding-top:15px;">
                        <?php if(!empty(SpokalVars::getInstance()->options["hooks_footer"]["value"])){ 
                                    $tracking_script = SpokalVars::getInstance()->options["hooks_footer"]["value"];
                                    $set_piwikId = "";
                                    $set_form_fields = "";
                                    if(strpos($tracking_script,'spokalSavePiwikId') !== false){
                                        $set_piwikId = '<script type="text/javascript">function spokalSavePiwikId(piwikID){sp_set_form_fields();jQuery("input[name=SpokalPiwikId]").val(piwikID);}</script>';
                                        $set_form_fields = '<script type="text/javascript">function sp_set_form_fields(){jQuery("input[name=SpokalPostId]").each(function(){if(!this.value){this.value = window.location.href ;}});jQuery("input[name=SpokalSubmittedUrl]").each(function(){if(!this.value){this.value = window.location.href ;}});jQuery("input[name=SpokalAuthorizationCode]").each(function(){if(!this.value){this.value = "'.$authorizationKey.'";}});jQuery("input[name=SpokalAccountIdExternal]").each(function(){if(!this.value){this.value = '.$acountId.';}});}</script>';
                                    }elseif(strpos($tracking_script,'var spokalPluginCodes;') !== false){
                                        $tracking_script = str_replace('var spokalPluginCodes;', "_spaq.push(['setAuthCode', '".$authorizationKey."']);_spaq.push(['setAccountId', ".$acountId."]);", $tracking_script);
                                    }
                                    ?>
                                <textarea rows="11" cols="100" readonly="" onclick="this.select();" style="background: white; resize: none; width: 100%;"><?php echo $set_form_fields.$set_piwikId.$tracking_script; ?></textarea>
                        <?php }else{ ?>
                                <div class="spokal_warning_box connection_status" style="text-align:center; font-weight: bold;">
                                    You need to connect your site in order to get your Tracking Javascript.
                                </div>
                        <?php } ?>
                        </div>                   
                    </div>
                </div>
            </div>
            
            <?php 
            if(isset($campaigns['Lists']) && is_array($campaigns['Lists'])){
                foreach($campaigns['Lists'] as $key => $value){
                    $leadLists[] = array(
                                    'id' => $key,
                                    'name' => $value
                    );
                }
                if(count($leadLists) == 1){
                    $leadLists = $leadLists[0]["id"];
                }
            }else{
                $leadLists = -1;
            }
            if(is_array($leadLists)){ ?>
            <div class="third_party_Html_form_wrap third_party_wrapp">
                <div class="settings_tab_wrapper">
                    <div class="submit-button-box">Choose Lead List and click "Generate" to get HTML form.</div>
                    <div class="from_wrapp">
                        <form action="" method="post" name="generate_3rdPartyHMLForm" id="generate_3rdPartyHMLForm">
                            <?php echo '<input type="hidden" name="action" value="generate_3rdPartyHMLForm" />'; ?>
                            <div>
                                <div style="float:left; width:65px; line-height: 21px; font-size: 14px;">
                                    <span>Lead List:</span>
                                </div>
                                <?php if(is_array($campaigns["Lists"])) { ?>

                                        <div style="float:left; margin-left: 10px; margin-top: -4px;">
                                            <select name="html_form_leadList">
                                                <?php foreach($campaigns["Lists"] as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                <?php } ?>
                                <div style="clear:both;"></div>
                            </div>
                            <div style="padding-bottom: 1px;">
                                <p>
                                    <input type="checkbox" id="enable3rdFromRedirectUrl" class="checkbox" name="enableWpRedirectUrl" />
                                    <label for="enableRedirectUrl"><?php _e( 'Redirect after submit.' ); ?></label>  
                                </p>
                                <p id="html3rdFormRedirectUrl" style="display:none; width: 260px;">
                                    <label for="wpRedirectUrl"><?php _e( 'Redirect Url:' ); ?></label> 
                                    <input class="widefat" name="wpRedirectUrl" type="text" value="" />
                                </p>
                            </div>
                            <div>
                                <div style="float:left;">
                                    <?php $this->submitButton('Generate','submit-7-2','primary');?>
                                </div>

                                <div class="spinner-container">
                                    <span id="generate_3rdPartyHMLForm-spiner" class="sp_spinner" style="display:none"></span>
                                </div>

                                <div style="clear:both;"></div>
                            </div>
                        </form>
                        <div id='append3rdPartyHtmlForm'></div>
                    </div>
                </div>
            </div>
      <?php }else{?>
                <div class="third_party_Html_form_wrap third_party_wrapp">
                    <div class="settings_tab_wrapper ">
                        <div class="submit-button-box">Copy your Html Form</div>
                        <div class="from_wrapp">
                            <form action="" method="post" name="generate_3rdPartyHMLForm" id="generate_3rdPartyHMLForm">
                                <input type="hidden" name="action" value="generate_3rdPartyHMLForm" />
                                <input type="hidden" name="html_form_leadList" value="<?php echo $leadLists; ?>">
                                <div style="padding-bottom: 1px;">
                                    <p>
                                        <input type="checkbox" id="enable3rdFromRedirectUrl" class="checkbox" name="enableWpRedirectUrl" />
                                        <label for="enableRedirectUrl"><?php _e( 'Set form to redirect after submit.' ); ?></label>  
                                    </p>
                                </div>
                                <div id="html3rdFormRedirectUrl" style="display:none;">
                                    <p class="redirect-url">
                                        <label for="wpRedirectUrl"><?php _e( 'Enter redirect url and generate new form:' ); ?></label> 
                                        <input class="widefat" name="wpRedirectUrl" type="text" value="" />
                                    </p>
                                    <div style="float:left;">
                                        <?php $this->submitButton('Generate','submit-7-2','primary');?>
                                    </div>

                                    <div class="spinner-container">
                                        <span id="generate_3rdPartyHMLForm-spiner" class="sp_spinner" style="display:none"></span>
                                    </div>

                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                            <div id='append3rdPartyHtmlForm'>
                                <?php echo SP_Settings::generate_html_from($leadLists, "HtmlForm", ""); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
      <?php }
        } catch (Exception $ex) {
            $exceptionMessage= $ex->getMessage();
        }
    }
    
    /*
     * This method will be used if we have a tab in options, but we dont have a method which displays content for that tab.
     */
    private function displayDefaultBoxContent() {
        echo "You need to provide and to define method which will render content for this tab.";
    }
    
    /*
     * This is the main method, which will render Spokal Options page using methods within this class
     */
    public function render(){
        ob_start();
        ?>
        
        <?php 
        
        //Rendering Style for CTA Customize Box. We are doing this because it doesn't work fine on IE if we append style with js.
        SP_Style_CTA::renderTempCss(false);
        
        
        $spokalRequirements = SpokalRequirements::getInstance();
        
        if($spokalRequirements->checkIsMissed()) { ?>
            <div class="updated" style="padding: 11px 15px; margin: 15px 24px 0px 3px;">
                <?php $spokalRequirements->mainTabRequirementsError(); ?>
            </div>
 <?php  } ?>
        
        <?php if( ini_get('safe_mode') ){ ?>
            <div class="spokal-warning">
                You are running an old version of PHP with 'safe_mode' enabled - and that is likely to cause warnings with Spokal.<br />
                We recommend upgrading your version of PHP, or disabling safe_mode which has been deprecated in newer versions of PHP.
            </div>
        <?php } ?>
                
        <?php
        $local = false;
        if( isset($_SERVER['HTTP_HOST']) ){ 
            $localhosts = array("localhost","127.0.0.1","192.168.0.","10.0.0.");
            foreach($localhosts as $host){
                if(strpos($host, $_SERVER['HTTP_HOST']) !== false){
                    $local = true;
                }
            }
        }
        if( isset($_SERVER['REMOTE_ADDR']) ){ 
            if (substr($_SERVER['REMOTE_ADDR'], 0, 4) == '127.'
                    || $_SERVER['REMOTE_ADDR'] == '::1') {
                    $local = true;
            }
        }
        if($local){ ?>
            <div class="updated" style="padding: 11px 15px; margin: 15px 24px 0px 3px; border-color: red;" >
                Oops. This looks like a locally hosted WordPress site. Spokal won't work with locally hosted sites because it can't communicate with a site on your private network.<br />
                You will need to host this site somewhere publicly accessible, or use a tunnel.
            </div>
  <?php } ?>

        <div class="spokal_header">
            <button type="button" class="navbar-toggle menu-toggler pull-left fixed" id="nav-menu-button" data-target="#sidebar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>
            <div class="spokal-head-title"><?php echo $this->spokalSettingsTitle; ?></div>
            <div style="clear:both;"></div>
        </div>

        <div id="spokal-settings-wrap" class="spokal-settings-wraper">
            <table class="table-wrapp">
                <tbody>
                    <tr>
                        <td id="spokal-tabs-wrapper" class="tabs-wrapper tabs-wrapper-hidde">
                            <?php $this->displayTabs(); ?>
                            <div class="spokal-login"><a href="https://app.getspokal.com" target="_blank">Log in to Spokal</a></div>
                            <div id="copyright">Copyright &copy; <?php echo date("Y"); ?> Spokal</div>
                        </td>
                        <td class="box-wrap">
                            <?php $this->displayBoxes(); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }
         
    public static function displayDashboardOptions ($options, $tabGroup) {
        $currentStatus = "";
         foreach($options as $name => $option): ?>
            <?php if(isset($option['tabGroup'])) { ?>
        
                <?php if($option['tabGroup'] == $tabGroup) { ?>

                    <div class="option-block" >
                        <?php if($option['type'] == 'checkbox'): ?>

                            <input id="<?php echo $name; ?>" type="checkbox" name="spokal_<?php echo $name; ?>" value="true" <?php if($option['value'] == 'true') echo 'checked';?> size="60"/>
                            <?php echo $option['name']; ?>

                        <?php else: ?>

                            <?php if($option['type'] == 'textarea'){ ?>

                                <span class="option-label"><?php echo $option['name']; ?></span>: <br/>
                                <textarea class="form-element" id="<?php echo $name; ?>" cols="40" name="spokal_<?php echo $name; ?>"><?php echo $option['value']; ?></textarea>

                            <?php } elseif($option['type'] == 'text') { ?>

                                <span class="option-label"><?php echo $option['name']; ?></span>: <br/>
                                <input class="form-element" id="<?php echo $name; ?>" type="text" name="spokal_<?php echo $name; ?>" value="<?php echo $option['value']; ?>" size="60"/>

                            <?php } elseif($option['type'] == 'statictext') { ?>

                                <span class="option-label"><?php echo $option['name']; ?></span>:
                                <span id="<?php echo $name; ?>" ><?php echo $option['value']; ?></span>

                            <?php } elseif($option['type'] == 'password') { ?>

                                <span class="option-label"><?php echo $option['name']; ?></span>: <br/>
                                <input class="form-element" id="<?php echo $name; ?>" type="password" name="spokal_<?php echo $name; ?>" value="" size="60"/>
                                <?php if($name == 'user_password'){ ?>    
                                    <div id="<?php echo $name; ?>_error">Sorry, the password must be 30 characters or shorter</div>
                                <?php } ?>
                            <?php } ?>

                        <?php endif; ?>
                    </div>

                 <?php } ?>
        
            <?php } ?>
        
        <?php endforeach;
    }
    
    public static function submitButton($text="Submit", $id = "", $class = ""){        
        if(!empty($class)){$class = "spokal-".$class;}
        ?>
        <p class="spokal_buttons">
            <input type="submit" value="<?php echo $text; ?>" id="<?php echo $id; ?>" class="<?php echo "btn spokal_submit ".$class;?>">
        </p>
<?php }
     
    public static function cancelButton($text="Cancel", $id = "", $class = ""){     
        if(!empty($class)){$class = "spokal-".$class;}
        ?>
        <p class="spokal_buttons">
            <input type="submit" value="<?php echo $text; ?>" id="<?php echo $id; ?>" class="<?php echo "btn ".$class;?>">
        </p>
<?php }
}
?>
