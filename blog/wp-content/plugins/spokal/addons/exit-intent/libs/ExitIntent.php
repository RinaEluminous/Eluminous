<?php

class ExitIntent 
{
    
    private $email;
    
    private $leadList;
    
    private $status;
    
    public function __construct(){
        self::registerHooks();
    }
    
    public function registerHooks(){
        SpokalVars::getInstance()->ExitIntentOptions = ExitIntent::getExitIntentOptions();
        add_action('wp_ajax_handling_form_exitIntentContent', array(&$this, 'handlingExitIntentContent'));
        add_action('wp_ajax_handling_enableExitIntentForm', array(&$this, 'handlingEnableExitIntentForm'));
        add_action('wp_ajax_handling_disableExitIntentForm', array(&$this, 'handlingDisableExitIntentForm'));
        add_action('wp_head',array(&$this, 'displayExitIntent'));
        add_action( 'sp_front_script_included', array('ExitIntent', 'localize_settings_to_js_variable'),99999 );
    }
    
    public static function renderFormContentSettings($checkEnable,$tabOptions){
        $options = SpokalVars::getInstance()->options;
        if($checkEnable === 'enabled') {
            $exitIntentSettingsDisplay = 'display:block;';
            $class = "enabled-settings";
        }else{
            $exitIntentSettingsDisplay = 'display:none;';
            $class = "";
        }
        extract(SpokalVars::getInstance()->ExitIntentOptions);
        ?>
         
        <div id="exitIntentSettings" class="settings_tab_wrapper <?php echo $class; ?>" style="<?php echo $exitIntentSettingsDisplay; ?>">
            <div class="submit-button-box">Please choose your Exit Intent settings</div>
            <div class="from_wrapp">
                <form action="" method="post" name="exitIntentContentForm" id="exitIntentContentForm">
                     <?php echo '<input type="hidden" name="action" value="handling_form_exitIntentContent" />'; ?>
                    <h3 class="cta-behavior-head">Exit Intent Behavior:</h3> 
                    <?php $popups = SpokalPopup::get_popups();?>
                    
                    <div class="option-block">
                        <p><?php _e( 'Choose the lead generator popup to display when clicked:' ); ?></p> 
                  <?php if(is_array($popups) && !empty($popups) ){?>
                        <select id="exit_intent_popups" name="ei_popup"  >
                            <option value="">Choose Popup</option>
                            <?php
                            foreach($popups as $popup){ 
                                $checked = ($popup->ID == $ei_popup) ? "selected" : "";
                                ?>
                                <option <?php echo $checked; ?> value="<?php echo $popup->ID; ?>"><?php echo $popup->post_title; ?></option>
                      <?php } ?>
                        </select>
                  <?php }else{?>
                            <span id="exit_intent_popups"><br>You haven't created any popups. Click <a href="<?php echo admin_url("admin.php?page=spokal_options&sp_tab=tab8-5");?>">here</a> here to create one now.</span>
                  <?php } ?>
                    </div>

                    <?php 
                    $postTypes = get_post_types(array('show_ui' => true,),'objects');
                    $postTypes['home_page'] = new stdClass();
                    $postTypes['home_page']->labels = new stdClass();
                    $postTypes['home_page']->labels->name = "Home Page";
                    $postTypes['home_page']->public = true;
                    $postTypes['category_page'] = new stdClass();
                    $postTypes['category_page']->labels = new stdClass();
                    $postTypes['category_page']->labels->name = "Category Page";
                    $postTypes['category_page']->public = true;
                    if(is_array($postTypes)){
                        ?><p>Show Exit Intent only on:</p><?php
                        foreach($postTypes as $key => $value){
                            if(in_array($key, array("attachment","revision","nav_menu_item","sp-landingpage"))){continue;}
                            if(!$value->public){continue;}

                            $checked = '';
                            if(in_array($key, $exit_intent_pages)){
                                $checked = 'checked';
                            }
                            ?>
                            <div class="option-block">
                                <input id="post_<?php echo $key;?>" type="checkbox" class="pages-specific" popup="exit-intent" name="disabled_post_types[]" value="<?php echo $key; ?>" <?php echo $checked; ?>>
                                <label class="option-label" for="post_<?php echo $key;?>"><?php echo $value->labels->name; ?></label>
                            </div>
                  <?php }
                    } ?>
                        
                    <?php 
                    $args = array(
                            'numberposts'   => -1,
                            'orderby'          => 'post_date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'post_status'      => 'publish',
                    );
                    $posts = SpokalVars::getInstance()->allPosts;
                    $display_opt = in_array('post', $exit_intent_pages) ? "" : "hide-opt"; ?>
                        
                    <div id="exit-intent-post" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Exit Intent on specific post:</p>
                        <select  class="specific_post_multiselect" name="exclude_posts[]" multiple>
                            <?php
                            foreach($posts as $page){ 
                                $selected = "";
                                if(in_array($page->ID, $exclude_posts)) $selected = "selected"; ?>
                                <option value="<?php echo $page->ID; ?>" <?php echo $selected; ?>><?php echo $page->post_title; ?></option>
                      <?php }
                            ?>
                        </select>
                    </div>    
                        
                        
                    <?php 
                    $args = array(
                            'sort_order' => 'ASC',
                            'sort_column' => 'post_title',
                            'hierarchical' => 1,
                            'child_of' => 0,
                            'parent' => -1,
                            'offset' => 0,
                            'post_type' => 'page',
                            'post_status' => 'publish'
                    ); 
                    $pages = get_pages($args);
                    $display_opt = in_array('page', $exit_intent_pages) ? "" : "hide-opt"; ?>
                        
                    <div id="exit-intent-page" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Exit Intent on specific page:</p>
                        <select class="specific_post_multiselect" name="exclude_pages[]" multiple>
                            <?php
                            foreach($pages as $page){
                                $selected = "";
                                if(in_array($page->ID, $exclude_pages)) $selected = "selected"; ?>
                                <option value="<?php echo $page->ID; ?>" <?php echo $selected; ?>><?php echo $page->post_title; ?></option>
                      <?php }
                            ?>
                        </select>
                    </div>
                    <p>
                        <span class="option-label">When user closes, keep hidden for at least:</span>
                        <input class="form-element" style="width: 41px; text-align: center;" type="text" name="timeShowing" value="<?php echo $timeShowing; ?>">
                        <select style="width: 85px; vertical-align:baseline; height: 32px; margin-left: -5px;" name="timeShowingMeasure">
                            <?php $timeOptions = array(
                                                '1' => 'minutes',
                                                '60' => 'hours',
                                                '1440' => 'days',
                                                '43829' => 'months',
                                                '525949' => 'years',
                            );
                            foreach($timeOptions as $key => $value){
                                if($key == $timeShowingMeasure) {
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }
                                else {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            } ?>
                        </select>
                    </p>
                    <p>
                        <label class="option-label" for="exitIntentCampaigns"><?php _e( 'Campaign: ' ); ?></label> 
                        <select id="exitIntentCampaigns" name="exitIntentCampaigns">
                            <?php
                                $campaigns = SpokalVars::getInstance()->campaigns;
                                if(is_array($campaigns) && isset($campaigns["Lists"]) && is_array($campaigns["Lists"]) ) {
                                        foreach($campaigns["Lists"] as $key => $value) {
                                            if($key == $campaign) {
                                                echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                            }
                                            else {
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            }
                                        }
                                }
                                else {
                                    echo '<option value="-1" selected>default</option>';
                                }
                            ?>
                        </select>
                    </p>
                    <div class="scrollbox-placeholders sp-dynamic" style="margin-top: 10px; margin-bottom: 17px; position: relative;">
                        <p class="placeholder-left" >
                            <label class="option-label" for="exitIntentCssClass"><?php _e( 'Css Class' ); ?></label> 
                            <input class="form-element widefat" id="exitIntentCssClass" name="exitIntentCssClass" type="text" value="<?php echo esc_attr( $cssclassname ); ?>" />
                        </p>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="float:right; margin: 0px;">
                        <?php SpokalAdminView::submitButton('Save','exitIntentContentButton','primary');?>
                    </div>
                    <div style="float:right;" class="spinner-container">
                        <span id="exitIntentContentForm-spiner" class="sp_spinner" style="display:none"></span>
                    </div>
                    <div style="clear:both;"></div>
                </form>
            </div>
        </div>
        
<?php }
    
    public static function renderEnableDisableSmartBar($checkEnable){ 
        
        if($checkEnable === 'enabled') {
            $disableFormDisplay = 'display:block;';
            $enableFormDisplay = 'display:none;';
            $class = "enabled-instructions";
        }else{
            $disableFormDisplay = 'display:none;';
            $enableFormDisplay = 'display:block;';
            $class = "";
        } ?>
        <div id="exitintent-instructions-wrap" class="scrollBoxInstructions <?php echo $class; ?>">
            <p class="instruction">
                The Exit Intent popup is a lightweight popup that appears when it appears that the visitor is going to leave your site. It's a simple, non-intrusive way to make a last-minute offer to the visitor before they leave. You can customize the look of the popup through css.  Check out the <a target="_blank" href="http://www.getspokal.com/how-to-customize-the-look-of-the-exit-intent-popup/">tutorial</a>
            </p>
            <div id="smartBarEnableShowButtons">
                <div id="disableExitIntent" style="<?php echo $disableFormDisplay; ?>">
                    <form action="" method="post" name="disableExitIntentForm" id="disableExitIntentForm">
                        <input type="hidden" name="action" value="handling_disableExitIntentForm" />
                        <?php wp_nonce_field("spokal-settings-disableExitIntentForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Disable Exit Intent','disableExitIntentButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="disableExitIntent-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <div id="enableExitIntent" style="<?php echo $enableFormDisplay; ?> ">
                    <form action="" method="post" name="enableExitIntentForm" id="enableExitIntentForm">
                        <input type="hidden" name="action" value="handling_enableExitIntentForm" />
                        <?php wp_nonce_field("spokal-settings-enableExitIntentForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Enable Exit Intent','enableExitIntentButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="enableExitIntent-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                    </form>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
        </div>
        
<?php }
    
    public function handlingExitIntentContent(){
        
        $newInstance = stripslashes_deep($_POST);
        $instance = array();
        
        if ( isset( $newInstance[ 'disabled_post_types' ] ) ) {
            $instance[ 'exit_intent_pages' ] = $newInstance[ 'disabled_post_types' ];
        }else{
            $instance[ 'exit_intent_pages' ] = array(0 => 'post');
        }
        
        if(isset($newInstance[ 'exclude_posts' ])) {
            $instance[ 'exclude_posts' ] = $newInstance[ 'exclude_posts' ];
        }
        
        if(isset($newInstance[ 'exclude_pages' ])) {
            $instance[ 'exclude_pages' ] = $newInstance[ 'exclude_pages' ];
        }
    
        if(isset($newInstance[ 'exitIntentCssClass' ])) {
            $instance[ 'cssclassname' ] = $newInstance[ 'exitIntentCssClass' ];
        }
        
        if(isset($newInstance[ 'exitIntentCampaigns' ])) {
            $instance[ 'campaign' ] = $newInstance[ 'exitIntentCampaigns' ];
        }
        
        if(isset($newInstance[ 'timeShowing' ])) {
            $instance[ 'timeShowing' ] = $newInstance[ 'timeShowing' ];
        }
        
        if(isset($newInstance[ 'timeShowingMeasure' ])) {
            $instance[ 'timeShowingMeasure' ] = $newInstance[ 'timeShowingMeasure' ];
        }
        
        if(isset($newInstance[ 'ei_popup' ])) {
            $instance[ 'ei_popup' ] = $newInstance[ 'ei_popup' ];
        }
        
        if(isset($instance[ 'campaign' ])){
            if(empty($instance[ 'campaign' ]) || $instance[ 'campaign' ] == -1){
                $instance[ 'campaign' ] = $this->getDefaultCampaign();
            }
        }else{
            $instance[ 'campaign' ] = $this->getDefaultCampaign();
        }
        $oldInstance = get_option('spokal_exit_intent_content');
        $instance = array_merge($oldInstance,$instance);
        update_option('spokal_exit_intent_content',$instance);
      
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    public function handlingEnableExitIntentForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-enableExitIntentForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_exit_intent_enable','enabled');
        
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    public function handlingDisableExitIntentForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-disableExitIntentForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_exit_intent_enable','disabled');
        
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    public static function is_allowed(){
        global $post;
        $display = true;
        $options = SpokalVars::getInstance()->options;
        $isEnableHiding = $options['cooking_disable']['value'];
        extract(SpokalVars::getInstance()->ExitIntentOptions);
        
        //checking is Exit Intent enabled
        $display = ($options['exit_intent_enable']['value'] === "enabled") ? true : false;
        
        //Checking is user already subscribed to the same lead list      
        if(isset($_COOKIE['sp_lists']) && $isEnableHiding === 'true'){
            $leadListCookie = json_decode(base64_decode($_COOKIE['sp_lists']));
            if(in_array($campaign, $leadListCookie)){
                $display = false;
            }
        }
        
        //checking is Exit Intent turned of for current post type
        $currentPostType = "";
        if(is_front_page()){
            $currentPostType = "home_page";
        }elseif(is_single() || is_page()){
            $currentPostType = get_post_type();
        }elseif(is_category() || is_tax()){
            $currentPostType = "category_page";
        }
        
        if(function_exists("is_shop")){
            if( is_shop() && !empty($exclude_pages)) {
                $shopID = get_option( 'woocommerce_shop_page_id');
                if(in_array($shopID, $exclude_pages)){
                    $display = false;
                }
            } 
        }
        
        if(!empty($currentPostType)){
            if(!in_array($currentPostType, $exit_intent_pages)){
                $display = false;
            }elseif(is_page() && !empty($exclude_pages)){
                if(in_array($post->ID, $exclude_pages)){
                    $display = false;
                }
            }elseif(is_single() && !empty($exclude_posts)){
                if(in_array($post->ID, $exclude_posts)){
                    $display = false;
                }
            }
        }
        
        return $display;
    }
    
    public function displayExitIntent(){
        extract(SpokalVars::getInstance()->ExitIntentOptions);
        if($this->is_allowed()){
            if(!empty($ei_popup)){
                SpokalPopup::renderSpokalPopup(false,$ei_popup,"ExitIntent",$campaign);
            }
        }
    }
    
    public function localize_settings_to_js_variable(){ 
        if(ExitIntent::is_allowed()){
            $options = SpokalVars::getInstance()->ExitIntentOptions;
            wp_localize_script( 'spokal_front_js', 'spEI', $options );
        }
    }

    public static function getExitIntentOptions(){
        $instance = get_option('spokal_exit_intent_content');
        if($instance === false){
            $instance = array();
       
            $instance[ 'title' ] = __( "Enter your name and email and get the weekly newsletter... it's FREE!", 'text_domain' );
            $instance[ 'buttontext' ] = __( 'Register', 'text_domain' );
            $instance[ 'continueButtonText' ] = __( 'Continue', 'text_domain' );
            $instance[ 'collectfirstname' ] = false;
            $instance[ 'collectlastname' ] = false;
            $instance[ 'collectphone' ] = false;
            $instance[ 'collectcompany' ] = false;     
            $instance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );      
            $instance[ 'failmsg' ] =  __( 'Failed to send your message. Please try later.', 'text_domain' );
            $instance[ 'invalidEmailMsg' ] =  __( "Your email address does not appear valid." ); 
            $instance[ 'toptext' ] = __( 'Introduce yourself and your program', 'text_domain' );
            $instance[ 'emailPlaceholder' ] = "Email";
            $instance[ 'firstNamePlaceholder' ] = "First Name";
            $instance[ 'lastNamePlaceholder' ] = "Last Name";
            $instance[ 'phonePlaceholder' ] = "Phone";
            $instance[ 'companyPlaceholder' ] = "Company";
            $instance[ 'cssclassname' ] = "";
            $instance[ 'exclude_pages' ] = array();
            $instance[ 'exclude_posts' ] = array();
            $instance[ 'exit_intent_pages' ] = array(0 => 'post');
            $instance[ 'campaign' ] = -1;
            $instance[ 'exitIntentLogo' ] = "";
            $instance[ 'timeShowing' ] = "1";
            $instance[ 'timeShowingMeasure' ] = "60";
            $instance[ 'ei_popup' ] = "";
            update_option('spokal_exit_intent_content',$instance);
        }
        return ExitIntent::mergeWithDefault($instance);
    }

    public static function mergeWithDefault($instance){
            
  
            if(!isset($instance[ 'title' ]) || empty($instance[ 'title' ])){
                $instance[ 'title' ] = __( "Enter your name and email and get the weekly newsletter... it's FREE!", 'text_domain' );
            }
  
            if(!isset($instance[ 'buttontext' ]) || empty($instance[ 'buttontext' ])){
                $instance[ 'buttontext' ] = __( 'Register', 'text_domain' );
            }
            
            if(!isset($instance[ 'exclude_pages' ]) || empty($instance[ 'exclude_pages' ])){
                $instance[ 'exclude_pages' ] = array();
            }
            
            if(!isset($instance[ 'exclude_posts' ]) || empty($instance[ 'exclude_posts' ])){
                $instance[ 'exclude_posts' ] = array();
            }
            
            if(!isset($instance[ 'continueButtonText' ]) || empty($instance[ 'continueButtonText' ])){
                $instance[ 'continueButtonText' ] = __( 'Continue', 'text_domain' );
            }
            
            if(!isset($instance[ 'collectfirstname' ]) || empty($instance[ 'collectfirstname' ])){
                $instance[ 'collectfirstname' ] = false;
            }
            
            if(!isset($instance[ 'collectlastname' ]) || empty($instance[ 'collectlastname' ])){
                $instance[ 'collectlastname' ] = false;
            }
            
            if(!isset($instance[ 'collectphone' ]) || empty($instance[ 'collectphone' ])){
                $instance[ 'collectphone' ] = false;
            }
            
            if(!isset($instance[ 'collectcompany' ]) || empty($instance[ 'collectcompany' ])){
                $instance[ 'collectcompany' ] = false;
            }
            
            if(!isset($instance[ 'successmsg' ]) || empty($instance[ 'successmsg' ])){
                $instance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );
            }
            
            if(!isset($instance[ 'failmsg' ]) || empty($instance[ 'failmsg' ])){
                $instance[ 'failmsg' ] =  __( 'Failed to send your message. Please try later.', 'text_domain' );
            }
            
            if(!isset($instance[ 'invalidEmailMsg' ]) || empty($instance[ 'invalidEmailMsg' ])){
                $instance[ 'invalidEmailMsg' ] =  __( "Your email address does not appear valid." );
            }
            
            if(!isset($instance[ 'toptext' ]) || empty($instance[ 'toptext' ])){
                $instance[ 'toptext' ] = __( 'Introduce yourself and your program', 'text_domain' );
            }
            
            if(!isset($instance[ 'emailPlaceholder' ]) || empty($instance[ 'emailPlaceholder' ])){
                $instance[ 'emailPlaceholder' ] = "Email";
            }
            
            if(!isset($instance[ 'firstNamePlaceholder' ]) || empty($instance[ 'firstNamePlaceholder' ])){
                $instance[ 'firstNamePlaceholder' ] = "First Name";
            }
            
            if(!isset($instance[ 'lastNamePlaceholder' ]) || empty($instance[ 'lastNamePlaceholder' ])){
                $instance[ 'lastNamePlaceholder' ] = "Last Name";
            }
            
            if(!isset($instance[ 'phonePlaceholder' ]) || empty($instance[ 'phonePlaceholder' ])){
                $instance[ 'phonePlaceholder' ] = "Phone";
            }
            
            if(!isset($instance[ 'companyPlaceholder' ]) || empty($instance[ 'companyPlaceholder' ])){
                $instance[ 'companyPlaceholder' ] = "Company";
            }
            
            if(!isset($instance[ 'cssclassname' ]) || empty($instance[ 'cssclassname' ])){
                $instance[ 'cssclassname' ] = "";
            }
            
            if(!isset($instance[ 'campaign' ]) || empty($instance[ 'campaign' ])){
                $instance[ 'campaign' ] = -1;
            }
                    
            if(!isset($instance[ 'exit_intent_pages' ]) || empty($instance[ 'exit_intent_pages' ])){
                $instance[ 'exit_intent_pages' ] = array(0 => 'post');
            }
            
            if(!isset($instance[ 'exitIntentLogo' ]) || empty($instance[ 'exitIntentLogo' ])){
                $instance[ 'exitIntentLogo' ] = "";
            }
            
            if(!isset($instance[ 'timeShowing' ]) || empty($instance[ 'timeShowing' ])){
                $instance[ 'timeShowing' ] = "1";
            }
            
            if(!isset($instance[ 'timeShowingMeasure' ]) || empty($instance[ 'timeShowingMeasure' ])){
                $instance[ 'timeShowingMeasure' ] = "60";
            }
            
            if(!isset($instance[ 'ei_popup' ]) || empty($instance[ 'ei_popup' ])){
                $instance[ 'ei_popup' ] = "";
            }   
            
            return $instance;   
    }

    public function getDefaultCampaign(){
        $campaigns = Spokal::fetchCampaigns();
        if(is_array($campaigns) && isset($campaigns["Lists"]) && is_array($campaigns["Lists"]) ) {
                foreach($campaigns["Lists"] as $key => $value) {
                    if($value == 'default'){
                        return $key;
                    } 
                }
        }
        return -1;
    }

    public static function renderAdditionalCss(){
        $css_instance = get_option("spokal_ei_custom_style",array());
        
        $classes = array(
            "background" => ".sp_exit_intent",
            "title" => ".sp_exit_intent_title",
            "top-text" => ".sp_exit_intent_top_text",
            "close" => "#close_sp_exit_intent",
            "input-text" => ".exit_intent_field .ei-input",
            "button" => ".sp_exit_intent input.exit_intent_submit",
            "success-msg" => ".exit_intent_succes_message",
            "error-msg" => ".exit_intent_error_message"
        );
        
                
        $css = "";
        foreach($css_instance as $key => $value ){
            if(isset($classes[$key])){
                $css .= $classes[$key]."{";
                    if(isset($value["back-color"]) && !empty($value["back-color"])){
                        $css .= "background-color:#".$value["back-color"].";";
                    }
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                        $css .= "color:#".$value["font-color"].";";
                    }
                    if(isset($value["font-family"]) && !empty($value["font-family"])){
                        $css .= "font-family:".$value["font-family"].";";
                    }
                    if(isset($value["text-bold"]) && !empty($value["text-bold"])){
                        $css .= "font-weight:".$value["text-bold"].";";
                    }
                    if(isset($value["text-italic"]) && !empty($value["text-italic"])){
                        $css .= "font-style:".$value["text-italic"].";";
                    }
                    if(isset($value["text-align"]) && !empty($value["text-align"])){
                        $css .= "text-align:".$value["text-align"].";";
                    }
                    if(isset($value["text-decoration"]) && !empty($value["text-decoration"])){
                        $css .= "text-decoration:".$value["text-decoration"].";";
                    }
                $css .= "}";

                //make sure to keep it responsive
                $css .="@media all and (min-width: 686px) {";
                    if(isset($value["font-size"]) && !empty($value["font-size"])){
                        $css .= $classes[$key]."{font-size:".$value["font-size"]."px;}";
                    }
                    
                    if(isset($value["width"]) && !empty($value["width"])){
                        $margin = intval(intval($value["width"])/2);
                        $css .= $classes[$key]."{width:".$value["width"]."px;margin-left:-".$margin."px;}";
                        
                    }
                $css .= "}";

                if(isset($value["placeholder-color"]) && !empty($value["placeholder-color"]) && ($value["placeholder-color"] !=="none")){
                    $css .= $classes[$key]."::-webkit-input-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key]."::-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-ms-input-placeholder{color:#".$value["placeholder-color"].";}";
                }

                if(isset($value["hover-color"]) && !empty($value["hover-color"])){
                    $css .= $classes[$key].":hover{background-color:#".$value["hover-color"].";}";
                }
            }
        }
        
        if(!empty($css)){
            echo "<style type='text/css' scoped>".$css."</style>";
        }
        
    }
}