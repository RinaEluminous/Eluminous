<?php

class SmartBarAddon {
    
    private $email;
    
    private $leadList;
    
    private $status;
    
    
    
    
    public function __construct(){
        self::registerHooks();
    }
    
    
    
    
    public function registerHooks(){
        SpokalVars::getInstance()->SmartBarOptions = SmartBarAddon::getSmartBarOptions();
        add_action('wp_ajax_handling_form_smartBarContent', array(&$this, 'handlingsmartBarContent'));
        add_action('wp_ajax_handling_enableSmartBarForm', array(&$this, 'handlingEnableSmartBarForm'));
        add_action('wp_ajax_handling_disableSmartBarForm', array(&$this, 'handlingDisableSmartBarForm'));
        add_action('wp_ajax_submitSmartBarLeads', array(&$this, 'submitSmartBarLeadsToSpokal'));
        add_action('wp_ajax_nopriv_submitSmartBarLeads', array(&$this, 'submitSmartBarLeadsToSpokal'));
        add_action('wp_footer',array(&$this, 'displaySmartBar'),1);
        add_action( 'sp_front_script_included', array('SmartBarAddon', 'localize_settings_to_js_variable'),99999 );
    }
    
    public static function renderFormContentSettings($checkEnable,$tabOptions){
        $options = SpokalVars::getInstance()->options;
        if($checkEnable === 'enabled') {
            $smartBarSettingsDisplay = 'display:block;';
            $class = "enabled-settings";
        }else{
            $smartBarSettingsDisplay = 'display:none;';
            $class = "";
        }
        
        extract(SpokalVars::getInstance()->SmartBarOptions);
        ?>
        
        <div id="smartBarSettings" class="settings_tab_wrapper <?php echo $class; ?>" style="<?php echo $smartBarSettingsDisplay; ?>">
            <div class="submit-button-box">Please choose your Smart Bar settings</div>
            <div class="from_wrapp">
                <div class="sp_style_cta_form_wrapp">
                    <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                        <input type="hidden" name="action" value="sp_style_cta">
                        <input type="hidden" name="style_file" value="<?php echo SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css';?>">
                        <input type="hidden" name="sp_cta" value="smartbar">
                        <input type="hidden" name="boxId" value="<?php echo $tabOptions['box_id']; ?>">
                        <input type="hidden" name="version" value="">
                        <?php SpokalAdminView::submitButton('Customize Smart Bar','smbStyle','primary');?>
                        <div style="float:right;" class="spinner-container">
                            <span  class="sp_spinner sp_style_cta_form_spiner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <form action="" method="post" name="smartBarContentForm" id="smartBarContentForm">
                    <?php echo '<input type="hidden" name="action" value="handling_form_smartBarContent" />'; ?>
                    <h3 class="cta-behavior-head">Smart Bar Behavior:</h3> 
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
                    $smartbar_pages = get_option('spokal_smartbar_pages',array());
                    if(is_array($postTypes)){
                        ?> <p>Show Smart Bar only on:</p> <?php
                        foreach($postTypes as $key => $value){
                            if(in_array($key, array("attachment","revision","nav_menu_item","sp-landingpage"))){continue;}
                            if(!$value->public){continue;}
                            
                            $checked = '';
                            if(in_array($key, $smartbar_pages)){
                                $checked = 'checked';
                            }
                            ?>
                            <div class="option-block">
                                <input id="post_<?php echo $key;?>" type="checkbox" class="pages-specific" popup="smartbar" name="disabled_post_types[]" value="<?php echo $key; ?>" <?php echo $checked; ?>>
                                <label class="option-label" for="post_<?php echo $key;?>"><?php echo $value->labels->name; ?></label>
                            </div>
                  <?php }
                    } 
                    ?>
                    
                    <?php 
                    $args = array(
                            'numberposts'   => -1,
                            'orderby'          => 'post_date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'post_status'      => 'publish',
                    );
                    $posts = SpokalVars::getInstance()->allPosts;
                    $display_opt = in_array('post', $smartbar_pages) ? "" : "hide-opt"; ?>
                        
                    <div id="smartbar-post" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Smart Bar on specific post:</p>
                        <select class="specific_post_multiselect" name="exclude_posts[]" multiple>
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
                    $display_opt = in_array('page', $smartbar_pages) ? "" : "hide-opt"; 
                    ?>
                        
                    <div id="smartbar-page" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Smart Bar on specific page:</p>
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
                        <span class="option-label">Smart Bar Behavior:</span>
                        <select style="vertical-align:baseline; height: 31px;" name="behavior">
                            <?php $timeOptions = array(
                                                'scroll' => 'Show on scroll up',
                                                'fixed' => 'Stay at the top',
                                                'absolute' => 'Scroll with the page',
                            );
                            foreach($timeOptions as $key => $value){
                                if($key == $behavior) {
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }
                                else {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            } ?>
                        </select>
                    </p>
                    <p>
                        <label class="option-label" for="smartBarCampaigns"><?php _e( 'Campaign: ' ); ?></label> 
                        <select id="smartBarCampaigns" name="smartBarCampaigns">
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
                    <div class="scrollbox-placeholders">
                        <p class="placeholder-left" >
                            <label class="option-label" for="smartBarCssClass"><?php _e( 'Css Class' ); ?></label> 
                            <input class="form-element widefat" id="smartBarCssClass" name="smartBarCssClass" type="text" value="<?php echo esc_attr( $cssclassname ); ?>" />
                        </p>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="float:right; margin: 0px;">
                        <?php SpokalAdminView::submitButton('Save','smartBarContentButton','primary');?>
                        <!--<input type="submit" name="smartBarContentButton" id="smartBarContentButton" class="button button-primary" value="Save">-->
                    </div>
                    <div style="float:right;" class="spinner-container">
                        <span id="smartBarContentForm-spiner" class="sp_spinner" style="display:none"></span>
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
        <div id="smartbar-instructions-wrap" class="scrollBoxInstructions <?php echo $class; ?>">
            <p class="instruction">
                Smart Bar is a high-impact way to get leads to sign up for either your list or a time-limited offer. It shows up at the top of your site. It's simple, non-intrusive, and because it's small - limited in what data it can capture. You can customize the look of it through css. Check out the <a target="_blank" href="http://www.getspokal.com/smartbar-tutorial">tutorial</a>
            </p>
            <div id="smartBarEnableShowButtons">
                <div id="disableSmartBar" style="<?php echo $disableFormDisplay; ?>">
                    <form action="" method="post" name="disableSmartBarForm" id="disableSmartBarForm">
                        <input type="hidden" name="action" value="handling_disableSmartBarForm" />
                        <?php wp_nonce_field("spokal-settings-disableSmartBarForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Disable Smart Bar','disableSmartBarButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="disableSmartBar-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <div id="enableSmartBar" style="<?php echo $enableFormDisplay; ?> ">
                    <form action="" method="post" name="enableSmartBarForm" id="enableSmartBarForm">
                        <input type="hidden" name="action" value="handling_enableSmartBarForm" />
                        <?php wp_nonce_field("spokal-settings-enableSmartBarForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Enable Smart Bar','enableSmartBarButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="enableSmartBar-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                    </form>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
        </div>
        
<?php }
    
    
    
    
    public function handlingSmartBarContent(){
        
        $newInstance = stripslashes_deep($_POST);
        $instance = array();
        if(isset($_POST['disabled_post_types'])){
            $disabledPostTypes = $_POST['disabled_post_types'];
        }
        else{
            $disabledPostTypes = array();
        }
        update_option('spokal_smartbar_pages',$disabledPostTypes);
       
        if(isset($newInstance[ 'smartBarCssClass' ])) {
            $instance[ 'cssclassname' ] = $newInstance[ 'smartBarCssClass' ];
        }
        
        if(isset($newInstance[ 'smartBarCampaigns' ])) {
            $instance[ 'campaign' ] = $newInstance[ 'smartBarCampaigns' ];
        }
        
        if(isset($newInstance[ 'timeShowing' ])) {
            $instance[ 'timeShowing' ] = $newInstance[ 'timeShowing' ];
        }
        
        if(isset($newInstance[ 'exclude_posts' ])) {
            $instance[ 'exclude_posts' ] = $newInstance[ 'exclude_posts' ];
        }
        
        if(isset($newInstance[ 'exclude_pages' ])) {
            $instance[ 'exclude_pages' ] = $newInstance[ 'exclude_pages' ];
        }
        
        if(isset($newInstance[ 'behavior' ])) {
            $instance[ 'behavior' ] = $newInstance[ 'behavior' ];
        }
        
        if(isset($newInstance[ 'timeShowingMeasure' ])) {
            $instance[ 'timeShowingMeasure' ] = $newInstance[ 'timeShowingMeasure' ];
        }
        
        if(isset($instance[ 'campaign' ])){
            if(empty($instance[ 'campaign' ]) || $instance[ 'campaign' ] == -1){
                $instance[ 'campaign' ] = $this->getDefaultCampaign();
            }
        }else{
            $instance[ 'campaign' ] = $this->getDefaultCampaign();
        }
        
        $oldInstance = get_option('spokal_smart_bar_content');
        $instance = array_merge($oldInstance,$instance);
        update_option('spokal_smart_bar_content',$instance);
      
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    
    
    public function handlingEnableSmartBarForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-enableSmartBarForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_smart_bar_enable','enabled');
        
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    
    
    public function handlingDisableSmartBarForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-disableSmartBarForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_smart_bar_enable','disabled');
        
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
        extract(SpokalVars::getInstance()->SmartBarOptions);
        
         //checking is Smart Bar enabled
        $display = ($options['smart_bar_enable']['value'] === "enabled") ? true : false;
        
        //Checking is user already subscribed to the same lead list
        if(isset($_COOKIE['sp_lists']) && $isEnableHiding === 'true'){
            $leadListCookie = json_decode(base64_decode($_COOKIE['sp_lists']));
            if(in_array($campaign, $leadListCookie)){
                $display = false;
            }
        }
        
        //checking is Scroll Box turned of for current post type
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
            if(!in_array($currentPostType, $options['smartbar_pages']['value'])){
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
    
    
    
    public function displaySmartBar(){
        if($this->is_allowed()){
            $this->renderFrontSmartBar();
        }
    }
    
    
    
    
    public static function localize_settings_to_js_variable(){ 
        if(SmartBarAddon::is_allowed()){
            $options = SpokalVars::getInstance()->SmartBarOptions;
            wp_localize_script( 'spokal_front_js', 'spSMBR', $options );
        }
    }
    
    
    
    
    public static function renderFrontSmartBar($isStyleCta = false){
        extract(SpokalVars::getInstance()->SmartBarOptions);
        extract(SP_Func::post_id());
        
        $displayNone = '';
        if($behavior === 'scroll'){
            $barStyle = 'display: none;';
        }else{
            if(isset($_COOKIE['sp_smbr_shown'])){
                $displayNone = ' display: none;';
            }
            $barStyle = 'position: '.$behavior.';';
        }
        ?>
        <div id="spokalSmartBarShowOnScrole" style="<?php echo $barStyle; echo $displayNone; ?>" >
            <?php // SmartBarAddon::smartBarFrontentScript(); ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#spokalSmartBarShowOnScrole").on("click", function (e) {e.preventDefault();});
                    jQuery("#spokalSmartBarShowOnScrole .smartBarSubmit").on("click", function (e) { e.preventDefault(); e.stopPropagation(); jQuery(this).parent().submit();});
                    jQuery("#smartBarContinue").on("click", function (e) { e.preventDefault();});
                });
            </script>
            <style type='text/css' scoped>
                .smartBarLoadGif{
                    background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/loader.gif) no-repeat center center;
                }   
            </style>
            <?php SmartBarAddon::renderAdditionalCss(); ?>
            <form method="post" name="spokalLeadsSmartBar" id="spokalLeadsSmartBar">
                <div class="<?php echo $cssclassname; ?>">
                    <div class="spokalSmartBar" >
                        <div id="smartBarFormContent">
                            <div id="smartBarTopText" class="smartBarTopText"><?php echo $toptext; ?></div>

                            <div id="smartBarForm" class="smartBar-field">

                                    <input id="spokalSmartbarEmail" name="Email" type="text" placeholder="<?php echo esc_attr( $emailPlaceholder ); ?>" class = 'smb-input spokal-required email'>

                                    <?php if($collectfirstname || $isStyleCta){ ?>
                                            <input class="smb-input" style="<?php echo ($isStyleCta && !$collectfirstname) ? "display:none;" : ""; ?>" id="spokalSmartbarName" name="FirstName" type="text" placeholder="<?php echo esc_attr( $firstNamePlaceholder ); ?>">
                                    <?php } ?>

                                    <input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>">

                                    <input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden">

                                    <input type='hidden' name='action' value='submitSmartBarLeads' >
                                    
                                    <input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">

                                    <input  name="SpokalListIdentifier" type="hidden" value="<?php echo $campaign; ?>">

                                    <input  name="SpokalBrowserOsInfo" type="hidden" value = "<?php if(isset($_SERVER["HTTP_USER_AGENT"])){echo $_SERVER["HTTP_USER_AGENT"];} ?>"/>

                                    <button class='smartBarSubmit smb_cta_submit_text' type="submit" ><?php echo $buttontext; ?></button>
                                    <div class="smartBarGifWrapper"><div id="smartBarLoadGif" class="smartBarLoadGif"></div></div>
                            </div>
                        </div>
                        <div id='smartBarSuccesMessage' class="smartBarSuccesMessage"></div>
                        <div id="SmartBarErrorMessage" class="smartBarErrorMessage"></div>
                        <button id="smartBarContinue" class='smartBarSubmit smb_cta_continue_text'><?php echo $continueButtonText; ?></button>
                        <div id="closeSmartBar"></div>

                    </div>
                </div>
            </form>
        </div>
<?php }
    
    
    
    
    public function submitSmartBarLeadsToSpokal(){
        
        $results = array(
                    'status' => true,
                    'message' => ''
        );
        
        $vars = SpokalLeads::collect_sp_fields($_POST, 'Smartbar');
        
        $method = "SmartBar";
        if($results['status'] && !empty($vars['Email'])) {
            $this->email = $vars['Email'];
            $this->leadList = $vars['SpokalListIdentifier'];
            $responseDecode = SpokalLeads::sendLeads($vars,$method);
            $this->status = $responseDecode;
            if($responseDecode->Result != 'Success'){
                $results['status'] = false;
                $results['message'] = 'errorResponse';
            }
            
        }
        else{
            $results['status'] = false;
            $results['message'] = 'invalidEmail';
        }
        
        SP_Func::set_lead_cookie($this->email,$this->leadList,$this->status);
  
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    public static function getSmartBarOptions(){
        $instance = get_option('spokal_smart_bar_content');
        
        if($instance === false){
            $instance = array();
 
            $instance[ 'buttontext' ] = __( 'Register', 'text_domain' );
            $instance[ 'continueButtonText' ] = __( 'Continue', 'text_domain' );
            $instance[ 'collectfirstname' ] = false;   
            $instance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );      
            $instance[ 'failmsg' ] =  __( 'Failed to send your message. Please try later.', 'text_domain' );
            $instance[ 'invalidEmailMsg' ] =  __( "Your email address does not appear valid." ); 
            $instance[ 'toptext' ] = __( 'Enter your personal information:', 'text_domain' );
            $instance[ 'firstNamePlaceholder' ] = "First Name";
            $instance[ 'emailPlaceholder' ] = "Email";
            $instance[ 'cssclassname' ] = "";
            $instance[ 'exclude_pages' ] = array();
            $instance[ 'exclude_posts' ] = array();
            $instance[ 'campaign' ] = -1;
            $instance[ 'behavior' ] = "scroll";
            $instance[ 'timeShowing' ] = "1";
            $instance[ 'timeShowingMeasure' ] = "60";
            update_option('spokal_smart_bar_content',$instance);
        }
        
        return SmartBarAddon::mergeWithDefault($instance);
    }
    
    
    
    
    public static function mergeWithDefault($instance){
            
  
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
                $instance[ 'toptext' ] = __( 'Enter your personal information below:', 'text_domain' );
            }
            
            if(!isset($instance[ 'emailPlaceholder' ]) || empty($instance[ 'emailPlaceholder' ])){
                $instance[ 'emailPlaceholder' ] = "Email";
            }
            
            if(!isset($instance[ 'firstNamePlaceholder' ]) || empty($instance[ 'firstNamePlaceholder' ])){
                $instance[ 'firstNamePlaceholder' ] = "First Name";
            }
            
            if(!isset($instance[ 'cssclassname' ]) || empty($instance[ 'cssclassname' ])){
                $instance[ 'cssclassname' ] = "";
            }
            
            if(!isset($instance[ 'campaign' ]) || empty($instance[ 'campaign' ])){
                $instance[ 'campaign' ] = -1;
            }
            
            if(!isset($instance[ 'behavior' ]) || empty($instance[ 'behavior' ])){
                $instance[ 'behavior' ] = "scroll";
            }
            
            if(!isset($instance[ 'timeShowing' ]) || empty($instance[ 'timeShowing' ])){
                $instance[ 'timeShowing' ] = "1";
            }
            
            if(!isset($instance[ 'timeShowingMeasure' ]) || empty($instance[ 'timeShowingMeasure' ])){
                $instance[ 'timeShowingMeasure' ] = "60";
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
        $css_instance = get_option("spokal_smb_custom_style",array());
        
        $classes = array(
            "background" => ".spokalSmartBar",
            "top-text" => ".smartBarTopText",
            "close" => "#closeSmartBar",
            "input-text" => ".smartBar-field .smb-input",
            "button" => ".spokalSmartBar button",
            "footer" => ".scrollBox_footer",
            "success-msg" => ".smartBarSuccesMessage",
            "error-msg" => ".smartBarErrorMessage"
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
                $css .="@media all and (min-width: 650px) {";
                    if(isset($value["font-size"]) && !empty($value["font-size"])){
                        $css .= $classes[$key]."{font-size:".$value["font-size"]."px;}";
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