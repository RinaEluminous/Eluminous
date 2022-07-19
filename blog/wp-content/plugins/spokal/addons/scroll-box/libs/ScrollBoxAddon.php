<?php

class ScrollBoxAddon {
    
    private $email;
    
    private $leadList;
    
    private $status;
    
    
    
    
    public function __construct(){
        self::registerHooks();
    }
    
    
    
    
    public function registerHooks(){
        SpokalVars::getInstance()->ScrollBoxOptions = ScrollBoxAddon::getScrollBoxOptions();
        add_action('wp_ajax_handling_form_scrollBoxContent', array(&$this, 'handlingscrollBoxContent'));
        add_action('wp_ajax_handling_enableScrollBoxForm', array(&$this, 'handlingEnableScrollBoxForm'));
        add_action('wp_ajax_handling_disableScrollBoxForm', array(&$this, 'handlingDisableScrollBoxForm'));
        add_action('wp_ajax_submitSrcollBoxLeads', array(&$this, 'submitSrcollBoxLeadsToSpokal'));
        add_action('wp_ajax_nopriv_submitSrcollBoxLeads', array(&$this, 'submitSrcollBoxLeadsToSpokal'));
        add_action('wp_footer',array(&$this, 'displayScrollBox'),1);
        add_action( 'sp_front_script_included', array('ScrollBoxAddon', 'localize_settings_to_js_variable'),99999 );
    }    
    
    
    
    public static function renderFormContentSettings($checkEnable,$tabOptions){ 
        $options = SpokalVars::getInstance()->options;
        if($checkEnable === 'enabled') {
            $scrollBoxSettingsDisplay = 'display:block;';
            $class = "enabled-settings";
        }else{
            $scrollBoxSettingsDisplay = 'display:none;';
            $class = "";
        }
        
        extract(SpokalVars::getInstance()->ScrollBoxOptions);?>

        <div id="scrollBoxSettings" class="settings_tab_wrapper <?php echo $class; ?>" style="<?php echo $scrollBoxSettingsDisplay; ?>">
            <div class="submit-button-box">Please choose your Scroll Box settings</div>
            <div class="from_wrapp">
                <div class="sp_style_cta_form_wrapp">
                    <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                        <input type="hidden" name="action" value="sp_style_cta">
                        <input type="hidden" name="style_file" value="<?php echo SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css';?>">
                        <input type="hidden" name="sp_cta" value="scrollbox">
                        <input type="hidden" name="boxId" value="<?php echo $tabOptions['box_id']; ?>">
                        <input type="hidden" name="version" value="">
                        <?php SpokalAdminView::submitButton('Customize Scroll Box','sbStyle','primary');?>
                        <div style="float:right;" class="spinner-container">
                            <span  class="sp_spinner sp_style_cta_form_spiner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <form action="" method="post" name="scrollBoxContentForm" id="scrollBoxContentForm">
                     <?php echo '<input type="hidden" name="action" value="handling_form_scrollBoxContent" />'; ?>
                    
                    <h3 class="cta-behavior-head">Scroll Box Behavior:</h3> 
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
                    $scrollbox_pages = get_option('spokal_scrollbox_pages',array());
                    if(is_array($postTypes)){
                        ?><p>Show Scroll Box only on:</p><?php
                        foreach($postTypes as $key => $value){
                            if(in_array($key, array("attachment","revision","nav_menu_item","sp-landingpage"))){continue;}
                            if(!$value->public){continue;}

                            $checked = '';
                            if(in_array($key, $scrollbox_pages)){
                                $checked = 'checked';
                            }
                            ?>
                            <div class="option-block">
                                <input id="post_<?php echo $key;?>" type="checkbox" class="pages-specific" popup="scrollbox" name="disabled_post_types[]" value="<?php echo $key; ?>" <?php echo $checked; ?>>
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
                    $display_opt = in_array('post', $scrollbox_pages) ? "" : "hide-opt"; ?>
                        
                    <div id="scrollbox-post" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Scroll Box on specific post:</p>
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
                    $display_opt = in_array('page', $scrollbox_pages) ? "" : "hide-opt"; ?>
                        
                    <div id="scrollbox-page" class="<?php echo $display_opt; ?>" style="margin-top: 25px;">
                        <p>Turn off Scroll Box on specific page:</p>
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
                        <span class="option-label">Scroll Box position:</span>
                        <select style="vertical-align:baseline; height: 31px;" name="position">
                            <?php $positions = array(
                                                'right' => 'Bottom right',
                                                'left' => 'Bottom left',
                            );
                            foreach($positions as $key => $value){
                                if($key == $position) {
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }
                                else {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            } ?>
                        </select>
                    </p>
                    <p>
                        <span class="option-label">Scroll percent:</span>
                        <input class="form-element" style="width: 70px; text-align: center;" type="text" name="showingPercent" value="<?php echo $showingPercent; ?>">
                        <span class="option-label">%</span>
                    </p>
                    <p>
                        <label class="option-label" for="scrolBoxCampaigns"><?php _e( 'Campaign: ' ); ?></label> 
                        <select id="scrolBoxCampaigns" name="scrolBoxCampaigns">
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
                            <label class="option-label" for="scrolBoxCssClass"><?php _e( 'Css Class' ); ?></label> 
                            <input class="form-element widefat" id="scrolBoxCssClass" name="scrolBoxCssClass" type="text" value="<?php echo esc_attr( $cssclassname ); ?>" />
                        </p>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="float:right; margin: 0px;">
                        <?php SpokalAdminView::submitButton('Save','scrollBoxContentButton','primary');?>
                        <!--<input type="submit" name="scrollBoxContentButton" id="scrollBoxContentButton" class="button button-primary" value="Save">-->
                    </div>
                    <div style="float:right;" class="spinner-container">
                        <span id="scrollBoxContentForm-spiner" class="sp_spinner" style="display:none"></span>
                    </div>
                    <div style="clear:both;"></div>
                </form>
            </div>
        </div>
        
<?php }
    
    
    
    
    public static function renderEnableDisableScrollBox($checkEnable){ 
        
        if($checkEnable === 'enabled') {
            $disableFormDisplay = 'display:block;';
            $enableFormDisplay = 'display:none;';
            $class = "enabled-instructions";
        }else{
            $disableFormDisplay = 'display:none;';
            $enableFormDisplay = 'display:block;';
            $class = "";
        } ?>  
        <div id="scrollbox-instructions-wrap" class="scrollBoxInstructions <?php echo $class; ?>">
            <p class="instruction">
                Scroll Box is a widget that slides in at the bottom of the page when a reader scrolls past a certain point on the page. It's a simple, non-intrusive way to request leads. 
                You can customize the look of the widget through css. Check out the <a target="_blank" href="http://www.getspokal.com/scrollbox-tutorial">tutorial</a>
            </p>
            <div id="scrollBoEnableShowButtons">
                <div id="disableScrollBox" style="<?php echo $disableFormDisplay; ?>">
                    <form action="" method="post" name="disableScrollBoxForm" id="disableScrollBoxForm">
                        <input type="hidden" name="action" value="handling_disableScrollBoxForm" />
                        <?php wp_nonce_field("spokal-settings-disableScrollBoxForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Disable Scroll Box','disableScrollBoxButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="disableScrollBox-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <div id="enableScrollBox" style="<?php echo $enableFormDisplay; ?>">
                    <form action="" method="post" name="enableScrollBoxForm" id="enableScrollBoxForm">
                        <input type="hidden" name="action" value="handling_enableScrollBoxForm" />
                        <?php wp_nonce_field("spokal-settings-enableScrollBoxForm"); ?>
                        <div style="float:left">
                            <?php SpokalAdminView::submitButton('Enable Scroll Box','enableScrollBoxButton','primary');?>
                        </div>
                        <div class="spinner-container">
                            <span id="enableScrollBox-spiner" class="sp_spinner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            </div>
        </div>
        
<?php }
    
    
    
    
    public function handlingscrollBoxContent(){
        
        $newInstance = stripslashes_deep($_POST);
        $instance = array();
        
        if(isset($_POST['disabled_post_types'])){
            $disabledPostTypes = $_POST['disabled_post_types'];
        }
        else{
            $disabledPostTypes = array();
        }
        update_option('spokal_scrollbox_pages',$disabledPostTypes);
        
        if(isset($newInstance[ 'exclude_posts' ])) {
            $instance[ 'exclude_posts' ] = $newInstance[ 'exclude_posts' ];
        }
        
        if(isset($newInstance[ 'exclude_pages' ])) {
            $instance[ 'exclude_pages' ] = $newInstance[ 'exclude_pages' ];
        }
                
        if(isset($newInstance[ 'scrolBoxCssClass' ])) {
            $instance[ 'cssclassname' ] = $newInstance[ 'scrolBoxCssClass' ];
        }
        
        if(isset($newInstance[ 'scrolBoxCampaigns' ])) {
            $instance[ 'campaign' ] = $newInstance[ 'scrolBoxCampaigns' ];
        }
        
        if(isset($newInstance[ 'timeShowing' ])) {
            $instance[ 'timeShowing' ] = $newInstance[ 'timeShowing' ];
        }
        
        if(isset($newInstance[ 'showingPercent' ])) {
            $instance[ 'showingPercent' ] = $newInstance[ 'showingPercent' ];
        }
        
        if(isset($newInstance[ 'timeShowingMeasure' ])) {
            $instance[ 'timeShowingMeasure' ] = $newInstance[ 'timeShowingMeasure' ];
        }
        
        if(isset($newInstance[ 'position' ])) {
            $instance[ 'position' ] = $newInstance[ 'position' ];
        }
        
        if(isset($instance[ 'campaign' ])){
            if(empty($instance[ 'campaign' ]) || $instance[ 'campaign' ] == -1){
                $instance[ 'campaign' ] = $this->getDefaultCampaign();
            }
        }else{
            $instance[ 'campaign' ] = $this->getDefaultCampaign();
        }
        
        $oldInstance = get_option('spokal_scroll_box_content');
        $instance = array_merge($oldInstance,$instance);
        update_option('spokal_scroll_box_content',$instance); 
      
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    
    
    public function handlingEnableScrollBoxForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-enableScrollBoxForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_scroll_box_enable','enabled');
        
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    
    
    public function handlingDisableScrollBoxForm(){
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-disableScrollBoxForm' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_scroll_box_enable','disabled');
        
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
        extract(SpokalVars::getInstance()->ScrollBoxOptions);
        
         //checking is Smart Bar enabled
        $display = ($options['scroll_box_enable']['value'] === "enabled") ? true : false;
        
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
            if(!in_array($currentPostType, $options['scrollbox_pages']['value'])){
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
    
    
    
    
    public function displayScrollBox(){
        if($this->is_allowed()){
            $this->renderFrontScrollBox();
        }
    }
    
    
    
    
    public static function localize_settings_to_js_variable(){
        if(ScrollBoxAddon::is_allowed()){
            $options = SpokalVars::getInstance()->ScrollBoxOptions;
        wp_localize_script( 'spokal_front_js', 'spSCBX', $options );
        }
    }
    
    
    
    
    public static function renderFrontScrollBox($isStyleCta = false){
        extract(SpokalVars::getInstance()->ScrollBoxOptions); 
        extract(SP_Func::post_id()); ?>

        <div id="spokalScrollBoxShowOnScrole" >
            <?php // ScrollBoxAddon::scrollBoxFrontentScript(); ?>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#spokalScrollBoxShowOnScrole").on("click", function (e) {e.preventDefault();});
                    jQuery("#spokalScrollBoxShowOnScrole .scrollBoxSubmit").on("click", function (e) { e.preventDefault(); e.stopPropagation(); jQuery(this).parent().submit();});
                    jQuery("#scrollBoxContinue").on("click", function (e) { e.preventDefault();});
                });
            </script>
            <style type='text/css' scoped>
                .scrollBoxLoadGif{background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/loader.gif) no-repeat center center;} 
                #spokalScrollBoxShowOnScrole{<?php echo ($position == "right") ? "right: 0px;" : "left: 0px;";?>}
            </style>
            <?php ScrollBoxAddon::renderAdditionalCss(); ?>
            <div class="sp_design_class <?php echo $cssclassname; ?>">
                <div class="spokalScrollBox" >
                    <div id="closeScrollBox"></div>
                    <p class="scrollBoxTitle"><?php echo $title; ?></p>
                    <div id="spokalScrollBoxFormContent">
                        <form  method="post" name="spokalLeadsScrollBox" id="spokalLeadsScrollBox" >

                            <div  class="scrollBoxTopText"><?php echo $toptext; ?></div>

                            <div  class="scrollBox-field">
                                <input id="sbx-email-field" name="Email" type="text" placeholder="<?php echo esc_attr( $emailPlaceholder ); ?>" class = 'sbx-input spokal-required email'>
                            </div>    

                            <?php if($collectfirstname || $isStyleCta){ ?>
                                <div class="scrollBox-field" style="<?php echo ($isStyleCta && !$collectfirstname) ? "display:none;" : ""; ?>">
                                    <input class="sbx-input" id="sbx-fname-field" name="FirstName" type="text" placeholder="<?php echo esc_attr( $firstNamePlaceholder ); ?>">
                                </div>
                            <?php } ?>

                            <?php if($collectlastname || $isStyleCta){ ?>
                                <div class="scrollBox-field" style="<?php echo ($isStyleCta && !$collectlastname) ? "display:none;" : ""; ?>">
                                    <input class="sbx-input" id="sbx-lname-field" name="LastName" type="text" placeholder="<?php echo esc_attr( $lastNamePlaceholder ); ?>">
                                </div>
                            <?php } ?>

                            <?php if($collectphone || $isStyleCta) { ?>
                                <div class="scrollBox-field" style="<?php echo ($isStyleCta && !$collectphone) ? "display:none;" : ""; ?>">
                                    <input class="sbx-input" id="sbx-phone-field" name="Phone" placeholder="<?php echo esc_attr( $phonePlaceholder ); ?>" type="text">
                                </div>
                            <?php } ?>

                            <?php if($collectcompany || $isStyleCta) { ?>
                                <div class="scrollBox-field" style="<?php echo ($isStyleCta && !$collectcompany) ? "display:none;" : ""; ?>">
                                    <input class="sbx-input" id="sbx-company-field" name="Company" placeholder="<?php echo esc_attr( $companyPlaceholder ); ?>" type="text">
                                </div>
                            <?php } ?>

                            <input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>">

                            <input id="SpokalPiwikID" name="SpokalPiwikId" type="hidden">

                            <input type='hidden' name='action' value='submitSrcollBoxLeads' >
                            
                            <input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">

                            <input  name="SpokalListIdentifier" type="hidden" value="<?php echo $campaign; ?>">

                            <input  name="SpokalBrowserOsInfo" type="hidden" value = "<?php if(isset($_SERVER["HTTP_USER_AGENT"])){echo $_SERVER["HTTP_USER_AGENT"];} ?>"/>

                            <input class='scrollBoxSubmit sbx_cta_submit_text' name='submit' value="<?php echo $buttontext; ?>" type="submit" />
                            <div id="scrollBoxLoadGif" class="scrollBoxLoadGif"></div>
                        </form>
                    </div>
                    <div id='scrollBoxSuccesMessage' class="scrollBoxSuccesMessage"></div>
                    <div id="ScrollBoxErrorMessage" class="scrollBoxErrorMessage"></div>
                    <input id="scrollBoxContinue" class="scrollBoxSubmit sbx_cta_continue_text" name='submit' value="<?php echo $continueButtonText; ?>" type="submit" />
                    <?php
                        $isEnabled = SpokalVars::getInstance()->options['scrollBox_footer_enable']['value'];
                        if($isEnabled !== 'true'){
                            ScrollBoxAddon::scrollBoxFooter();
                        }
                    ?>
                </div>
            </div>
        </div>
<?php }
    
    
    
    
    public static function scrollBoxFooter(){ ?>
        <div class="scrollBox_footer">
            <div class="scrollBox_footer_wrap" style="float: right; padding-right: 10px;">
                <a href="http://www.getspokal.com/?c=scrollbox" target="_blanck">Powered By Spokal</a>
            </div>
            <div style="clear: both;"></div>
        </div>
<?php }
    
    
    
    
    public function submitSrcollBoxLeadsToSpokal(){
        
        $results = array(
                    'status' => true,
                    'message' => ''
        );
        
        $vars = SpokalLeads::collect_sp_fields($_POST, 'Scrollbox');
        
        $method = "ScrollBox";
        if(!empty($vars['Email'])) {
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
   
    
    public static function getScrollBoxOptions(){
        $instance = get_option('spokal_scroll_box_content');
        
        if($instance === false){
            $instance = array();
       
            $instance[ 'title' ] = __( 'Signup', 'text_domain' );
            $instance[ 'buttontext' ] = __( 'Register', 'text_domain' );
            $instance[ 'continueButtonText' ] = __( 'Continue', 'text_domain' );
            $instance[ 'collectfirstname' ] = false;
            $instance[ 'collectlastname' ] = false;
            $instance[ 'collectphone' ] = false;
            $instance[ 'collectcompany' ] = false;     
            $instance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );      
            $instance[ 'failmsg' ] =  __( 'Failed to send your message. Please try later.', 'text_domain' );
            $instance[ 'invalidEmailMsg' ] =  __( "Your email address does not appear valid." ); 
            $instance[ 'toptext' ] = __( 'Enter your personal information below:', 'text_domain' );
            $instance[ 'emailPlaceholder' ] = "Email";
            $instance[ 'firstNamePlaceholder' ] = "First Name";
            $instance[ 'lastNamePlaceholder' ] = "Last Name";
            $instance[ 'phonePlaceholder' ] = "Phone";
            $instance[ 'companyPlaceholder' ] = "Company";
            $instance[ 'cssclassname' ] = "";
            $instance[ 'exclude_pages' ] = array();
            $instance[ 'exclude_posts' ] = array();
            $instance[ 'campaign' ] = -1;
            $instance[ 'showingPercent' ] = "80";
            $instance[ 'timeShowing' ] = "1";
            $instance[ 'timeShowingMeasure' ] = "60";
            $instance[ 'position' ] = "right";
            update_option('spokal_scroll_box_content',$instance);
        }
        
        return ScrollBoxAddon::mergeWithDefault($instance);
        
    }
    
    
    
    
    public static function mergeWithDefault($instance){
            
            if(!isset($instance[ 'title' ]) || empty($instance[ 'title' ])){
                $instance[ 'title' ] = __( 'Signup', 'text_domain' );
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
                $instance[ 'toptext' ] = __( 'Enter your personal information below:', 'text_domain' );
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
            
            if(!isset($instance[ 'showingPercent' ]) || empty($instance[ 'showingPercent' ])){
                $instance[ 'showingPercent' ] = "80";
            }
            
            if(!isset($instance[ 'timeShowing' ]) || empty($instance[ 'timeShowing' ])){
                $instance[ 'timeShowing' ] = "1";
            }
            
            if(!isset($instance[ 'timeShowingMeasure' ]) || empty($instance[ 'timeShowingMeasure' ])){
                $instance[ 'timeShowingMeasure' ] = "60";
            }  
            
            if(!isset($instance[ 'position' ]) || empty($instance[ 'position' ])){
                $instance[ 'position' ] = "right";
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
        $css_instance = get_option("spokal_sbx_custom_style",array());
        
        $classes = array(
            "background" => ".spokalScrollBox",
            "title" => ".scrollBoxTitle",
            "top-text" => ".scrollBoxTopText",
            "close" => "#closeScrollBox",
            "input-text" => ".scrollBox-field .sbx-input",
            "button" => ".spokalScrollBox input[type='submit']",
            "footer" => ".scrollBox_footer",
            "success-msg" => ".scrollBoxSuccesMessage",
            "error-msg" => ".scrollBoxErrorMessage"
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
                    if(isset($value["width"]) && !empty($value["width"])){
                        $css .= $classes[$key]."{width:".$value["width"]."px;}";
                    }

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

                if($key === "footer"){
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                        $css .= $classes[$key]." a{color:#".$value["font-color"].";}";
                    }
                }
            }
        }
        if(!empty($css)){
            echo "<style type='text/css' scoped>".$css."</style>";
        }
    }
    
}