<?php

class LeadGeneratorWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Spokal_Widget', // Base ID
            'Spokal Lead Generator', // Name
            array( 'description' => __( 'Lead Generator Widget', 'text_domain' ),
                    'classname' => 'spokal_widget'
                ) // Widget Options
        );

    }

    
    
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $buttontext = $instance['buttontext']; 
        $collectfirstname = $instance['collectfirstname'];
        $collectlastname = $instance['collectlastname'];	
        $collectphone = $instance['collectphone'];
        $collectcompany = $instance['collectcompany'];
        $failmsg = $instance['failmsg'];		
        $successmsg = $instance['successmsg'];
        $firstNamePlaceholder = $instance['firstNamePlaceholder'];
        $lastNamePlaceholder = $instance['lastNamePlaceholder'];
        $phonePlaceholder = $instance['phonePlaceholder'];		
        $companyPlaceholder = $instance['companyPlaceholder'];
        $emailPlaceholder = $instance['emailPlaceholder'];
        $invalidEmailMessage = $instance['invalidEmailMessage'];
        $hideSpokalWidget = $instance['hideSpokalWidget'];
        $custom_css = (isset($instance['custom_css'])) ? $instance['custom_css'] : "";
        
        
        //checking Spokal Lead campany and setting it to -1 if it is not set
        if(is_numeric($instance['lead_campaign'])) {
            $campaign = $instance['lead_campaign'];
        }
        else {
            $campaign = -1;
        }
        
        //checking for post id, and if tehre is no post id setting it to current URL
        extract(SP_Func::post_id());
        
        $display = true;
        //Checking did current visitor already subscribe and is option Hide Widget if user is already registered to list
        if(isset($_COOKIE['sp_lists']) && $hideSpokalWidget){
            $leadListCookie = json_decode(base64_decode($_COOKIE['sp_lists']));
            if(in_array($campaign, $leadListCookie)){
                $display = false;
            }
        }
        
        //Checking is general option "Hide CTA for subscribed users" enabled
        $isEnableHiding = SpokalVars::getInstance()->options['cooking_disable']['value'];
        if($isEnableHiding === 'false'){
            $display = true;
        }
        if($display){
            
            /*
             * Handling Browsers which doesn't support Javascript starts here
             */
            
            //Getting Current URL to set form action to it. 
            //And appending $widget_public_id to the URL as ID of Widget wrapper to focus page on Widget after submission 
            $widget_public_id = $widget_id."_form";
            $currentUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}".'#'.$widget_public_id;
            
            //Checking is current widget submited on Non JS browser and checking validation for email and response from Spokal
            $widget_result_id = "result_".$widget_id;
            $invalidEmail = $this->check_email($widget_result_id);
            $submission_result = $this->check_submission($widget_result_id,$failmsg,$successmsg);
            
            
            //In depends of result from checking above setting properly messages to be displayed
            if($submission_result === "wrong_form"){
                $result_style = "display: none;";
                $result_style_succes = "display: none;";
                $result_message = "";
                $rez_succes_msg = "";
                $show_form = true;
            }elseif($submission_result === "true"){
                $result_style = 'display: none;';
                $result_style_succes = "";
                $rez_succes_msg = $successmsg;
                $result_message = "";
                $show_form = false;
            }if($submission_result === "false"){
                $result_style = "";
                $result_style_succes = "display: none;";
                $result_message = $failmsg;
                $show_form = true;
            }
            
            if(!$invalidEmail && $submission_result === "wrong_form"){
                $result_style = "";
                $result_style_succes = "display: none;";
                $result_message = $invalidEmailMessage;
                $rez_succes_msg = "";
                $show_form = true;
            }
            /*
             * Handling Browsers which doesn't support Javascript Ends here
             */
            
            echo $before_widget;
            
            //Displaying default style for Widget messages ?>  
            <style type="text/css">
                .swg_error_message{
                    color: #FF0000;
                    line-height: 1.2;
                }
                .swg_success_msg{
                    color: #008000;
                    line-height: 1.2;
                }
            </style>
            
            <?php
            //checking for custom CSS from Spokal popup styler
            if(!empty($custom_css)){
                $custom_css = json_decode(base64_decode($custom_css),true);
                if(is_array($custom_css)){
                    $this->renderAdditionalCss($custom_css,"#".$widget_id."-front_wrapp");
                }
            }
            echo "<div id='".$widget_id."-front_wrapp' class='sp_widget_wrap'>";
            
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            } ?>
            <script type="text/javascript">jQuery(document).ready(function(){jQuery("#myForm_<?php echo $widget_id; ?>").submit(function(e){e.preventDefault();if(validWidgetLeadGeneratorRequest("myForm_<?php echo $widget_id; ?>",<?php echo json_encode($invalidEmailMessage); ?>)){jQuery("#result_<?php echo $widget_id; ?>").html('');jQuery.ajax({beforeSend: function() {jQuery("#swg_load_gif_<?php echo $widget_id; ?>").show();jQuery(".button_<?php echo $widget_id; ?>").hide();},url: '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',type: "POST",data: jQuery("#myForm_<?php echo $widget_id; ?>").serialize(),success: function(spokaldata){jQuery("#swg_load_gif_<?php echo $widget_id; ?>").hide();var n = spokaldata.search('Success');if(n == -1){jQuery("#result_<?php echo $widget_id; ?>").html(<?php echo json_encode($failmsg); ?>);jQuery("#result_<?php echo $widget_id; ?>").show();jQuery(".button_<?php echo $widget_id; ?>").show();}else{jQuery("#result_<?php echo $widget_id; ?>").html('');jQuery("#result_<?php echo $widget_id; ?>").hide();jQuery("#result_<?php echo $widget_id; ?>_succes").html(<?php echo json_encode($successmsg); ?>);jQuery("#result_<?php echo $widget_id; ?>_succes").show();jQuery("#myForm_<?php echo $widget_id; ?>").remove();}},error: function(){jQuery("#swg_load_gif_<?php echo $widget_id; ?>").hide();jQuery("#result_<?php echo $widget_id; ?>").html(<?php echo json_encode($failmsg); ?>);jQuery("#result_<?php echo $widget_id; ?>").show();jQuery(".button_<?php echo $widget_id; ?>").show();}});}else{var Respon = jQuery("#result_<?php echo $widget_id; ?>").html(<?php echo json_encode($invalidEmailMessage); ?>);jQuery("#result_<?php echo $widget_id; ?>").show();}});});</script>
            
            <div id="<?php echo $widget_public_id; ?>" ></div>
            <div style="<?php echo $result_style_succes; ?>" id="<?php echo $widget_result_id; ?>_succes" class="swg_success_msg"><?php echo $rez_succes_msg; ?></div>
            <?php if($show_form){ ?>
                    <form action="<?php echo $currentUrl; ?>" method="post" name="myForm_<?php echo $widget_id; ?>" id="myForm_<?php echo $widget_id; ?>" class="widget-spokal-opt-in">   

                        <?php if($instance['toptext'] != strip_tags($instance['toptext'])){ ?>
                                <div class="swg_top_text" id = 'spokalToptext_<?php echo $widget_id; ?>'><?php echo $instance['toptext']; ?></div>
                        <?php }else{ ?>
                                <p class="swg_top_text" id = 'spokalToptext_<?php echo $widget_id; ?>' style="overflow: hidden;"><?php echo $instance['toptext']; ?></p>
                        <?php }?>

                        <div class="editor-field">
                            <input style="float: none;" id="Email_<?php echo $widget_id; ?>" name="Email" type="text" placeholder="<?php echo $emailPlaceholder; ?>" class = 'spokal-required email swg-input'>
                        </div>    
                        <?php if($collectfirstname){ ?>
                            <div class="editor-field">
                                <input style="float: none;" class="swg-input" id="FirstName_<?php echo $widget_id;?>" name="FirstName" type="text" placeholder="<?php echo $firstNamePlaceholder ?>">
                            </div>
                        <?php } ?>           
                        <?php if($collectlastname){ ?>
                            <div class="editor-field">
                                <input style="float: none;" class="swg-input" id="LastName_<?php echo $widget_id; ?>" name="LastName" type="text" placeholder="<?php echo $lastNamePlaceholder ?>">
                            </div>
                        <?php } ?>           
                        <?php if($collectphone) { ?>
                            <div class="editor-field">
                                <input style="float: none;" class="swg-input" name="Phone" placeholder="<?php echo $phonePlaceholder ?>" type="text">
                            </div>
                        <?php }; ?>
                        <?php if($collectcompany) { ?>
                            <div class="editor-field">
                                <input style="float: none;" class="swg-input" name="Company" placeholder="<?php echo $companyPlaceholder ?>" type="text">
                            </div>
                        <?php }; ?>
                        <div id="swg_load_gif_<?php echo $widget_id; ?>" style="width: 20px; height: 20px; display: none; margin: 0 auto; background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/loader.gif) no-repeat center center;" class="formLoader"></div>
                        <input type="hidden" name="action" value="spokal_lead_generator"><input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>"><input name="form_id" type="hidden" value="<?php echo $widget_result_id; ?>"><input id="SpokalPostId_<?php echo $widget_id;?>" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>"><input id="SpokalPiwikId_<?php echo $widget_id; ?>" name="SpokalPiwikId" type="hidden"><input id="SpokalListIdentifier_<?php echo $widget_id; ?>" name="SpokalListIdentifier" type="hidden" value="<?php echo $campaign; ?>"><input id="SpokalBrowserOsInfo_<?php echo $widget_id; ?>" name="SpokalBrowserOsInfo" type="hidden" value = "<?php if(isset($_SERVER["HTTP_USER_AGENT"])){echo $_SERVER["HTTP_USER_AGENT"];} ?>"/><input name="sp_leads_form" type="hidden" value = "Widget"/><input style="float: none;" name = 'spokalsubmitbutton' id = 'button_<?php echo $widget_id; ?>' value="<?php echo $buttontext; ?>" type="submit" class='button_<?php echo $widget_id; ?> swg_submit' />
                    </form>
                    <div style="<?php echo $result_style; ?>" id="<?php echo $widget_result_id; ?>" class="swg_error_message"><?php echo $result_message; ?></div>
            <?php } ?>
            <?php
                echo "</div>";
                echo $after_widget;
        }
    }
    
    
    
    
    public function check_submission($shortcode_result_id,$failmessage,$successmessage){
        $submission_result = "wrong_form";
        if(SpokalVars::getInstance()->respons_validation){
            $respons_array = SpokalVars::getInstance()->respons_validation;
            if(isset($respons_array['form_id'])){
                if($respons_array['form_id'] === $shortcode_result_id){
                    if(isset($respons_array['status'])){
                        if($respons_array['status'] === 'true'){
                            return 'true';
                        }elseif($respons_array['status'] === 'false'){
                            return 'false';
                        }
                    }
                }
            }
        }
        return $submission_result;
    }
    
    
    
    
    public function check_email($shortcode_result_id){
        $invalidEmail = "";
        if(SpokalVars::getInstance()->form_validation){
            $submited_form_id = SpokalVars::getInstance()->form_validation;
            if($submited_form_id === $shortcode_result_id){return false;}
        }
        return true;
    }
    
    
    
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
            $instance = array();
            if(isset($new_instance["widget_content"])){
                $widget_content = json_decode(base64_decode($new_instance["widget_content"]),true);
                
                if(is_array($widget_content)){
                    $instance['title'] = strip_tags( $widget_content['title'] );
                    $instance['toptext'] = $widget_content['toptext'];
                    $instance['buttontext'] = strip_tags( $widget_content['buttontext'] );
                    $instance['collectfirstname'] = ! empty($widget_content['collectfirstname']);
                    $instance['collectlastname'] = ! empty($widget_content['collectlastname']);
                    $instance['collectphone'] = ! empty($widget_content['collectphone']);
                    $instance['collectcompany'] = ! empty($widget_content['collectcompany']);
                    $instance['failmsg'] = strip_tags( $widget_content['failmsg'] );
                    $instance['successmsg'] = strip_tags( $widget_content['successmsg'] );
                    $instance['firstNamePlaceholder'] = strip_tags( $widget_content['firstNamePlaceholder'] );
                    $instance['lastNamePlaceholder'] = strip_tags( $widget_content['lastNamePlaceholder'] );
                    $instance['phonePlaceholder'] = strip_tags( $widget_content['phonePlaceholder'] );
                    $instance['companyPlaceholder'] = strip_tags( $widget_content['companyPlaceholder'] );
                    $instance['emailPlaceholder'] = strip_tags( $widget_content['emailPlaceholder'] );
                    
                    //Because of DUMP two diferent key name for Invalid Email Message we need to handle two casses
                    if(isset($widget_content['invalidEmailMsg'])){
                        $instance['invalidEmailMessage'] = strip_tags( $widget_content['invalidEmailMsg'] );
                    }elseif(isset($widget_content['invalidEmailMessage'])){
                        $instance['invalidEmailMessage'] = strip_tags( $widget_content['invalidEmailMessage'] );
                    }else{
                        $instance['invalidEmailMessage'] = "";
                    }
                }
            }
            
            $instance['spokalcssclassname'] = strip_tags( $new_instance['spokalcssclassname'] );
            $instance['lead_campaign'] = strip_tags( $new_instance['lead_campaign'] );
            $instance['hideSpokalWidget'] = ! empty($new_instance['hideSpokalWidget']);
            $instance['custom_css'] = $new_instance['custom_css'];
            return $instance;
    }

    
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        global $sp_widget_form_displayed;
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Signup', 'text_domain' );
            $newInstance[ 'title' ] = __( 'Signup', 'text_domain' );
        }
        
        if ( isset( $instance[ 'buttontext' ] ) ) {
            $buttontext = $instance[ 'buttontext' ];
        }
        else {
            $buttontext = __( 'Register', 'text_domain' );
            $newInstance[ 'buttontext' ] = __( 'Register', 'text_domain' );
        }
        
        if ( isset( $instance[ 'collectfirstname' ] ) ) {
            $collectfirstname = $instance[ 'collectfirstname' ];
        }
        else {
            $collectfirstname = false;
            $newInstance[ 'collectfirstname' ] = false;
        }
        
        if ( isset( $instance[ 'collectlastname' ] ) ) {
            $collectlastname = $instance[ 'collectlastname' ];
        }
        else {
            $collectlastname = false;
            $newInstance[ 'collectlastname' ] = false;
        }
        
        if ( isset( $instance[ 'collectphone' ] ) ) {
            $collectphone = $instance[ 'collectphone' ];
        }
        else {
            $collectphone = false;
            $newInstance[ 'collectphone' ] = false;
        }
        
        if ( isset( $instance[ 'collectcompany' ] ) ) {
            $collectcompany = $instance[ 'collectcompany' ];
        }
        else {
            $collectcompany = false;
            $newInstance[ 'collectcompany' ] = false;
        }
        
        if ( isset( $instance[ 'hideSpokalWidget' ] ) ) {
            $hideSpokalWidget = $instance[ 'hideSpokalWidget' ];
        }
        else {
            $hideSpokalWidget = true;
        }
        
        if ( isset( $instance[ 'successmsg' ] ) ) {
            $successmsg = $instance[ 'successmsg' ];
        }
        else {
            $successmsg = __( 'Message has been submitted successfully', 'text_domain' );
            $newInstance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );
        }
        
        if ( isset( $instance[ 'failmsg' ] ) ) {
            $failmsg = $instance[ 'failmsg' ];
        }
        else {
            $failmsg = __( 'Failed to send your message. Please try later.', 'text_domain' );
            $newInstance[ 'failmsg' ] = __( 'Failed to send your message. Please try later.', 'text_domain' );
        }
        
        if ( isset( $instance[ 'invalidEmailMessage' ] ) ) {
            $invalidEmailMessage = $instance[ 'invalidEmailMessage' ];
        }
        else {
            $invalidEmailMessage = __( 'Your email address does not appear valid.', 'text_domain' );
            $newInstance[ 'invalidEmailMessage' ] = __( 'Your email address does not appear valid.', 'text_domain' );
        }
        
        
        if ( isset( $instance[ 'toptext' ] ) ) {
            $toptext = $instance[ 'toptext' ];
        }
        else {
            $toptext = __( 'Enter your personal information below:', 'text_domain' );
            $newInstance[ 'toptext' ] = __( 'Enter your personal information below:', 'text_domain' );
        }
                
        if(isset($instance[ 'spokalcssclassname' ])) {
            $cssClass = $instance[ 'spokalcssclassname' ];
        }
        else {
            $cssClass = "";
        }
        
        if(isset($instance[ 'lead_campaign' ])) {
            $campaign = $instance[ 'lead_campaign' ];
        }
        else {
            $campaign = "";
        }   
        
        if(isset($instance[ 'firstNamePlaceholder' ])) {
            $firstNamePlaceholder = $instance[ 'firstNamePlaceholder' ];
        }
        else {
            $firstNamePlaceholder = 'First Name';
            $newInstance[ 'firstNamePlaceholder' ] = 'First Name';
        }
        
        if(isset($instance[ 'lastNamePlaceholder' ])) {
            $lastNamePlaceholder = $instance[ 'lastNamePlaceholder' ];
        }
        else {
            $lastNamePlaceholder = "Last Name";
            $newInstance[ 'lastNamePlaceholder' ] = "Last Name";
        }
        
        if(isset($instance[ 'phonePlaceholder' ])) {
            $phonePlaceholder = $instance[ 'phonePlaceholder' ];
        }
        else {
            $phonePlaceholder = "Phone";
            $newInstance[ 'phonePlaceholder' ] = "Phone";
        }
        
        if(isset($instance[ 'companyPlaceholder' ])) {
            $companyPlaceholder = $instance[ 'companyPlaceholder' ];
        }
        else {
            $companyPlaceholder = "Company";
            $newInstance[ 'companyPlaceholder' ] = "Company";
        }
        
        if(isset($instance[ 'emailPlaceholder' ])) {
            $emailPlaceholder = $instance[ 'emailPlaceholder' ];
        }
        else {
            $emailPlaceholder = "Email";
            $newInstance[ 'emailPlaceholder' ] = "Email";
        }
        
        
        if(isset($instance[ 'custom_css' ])) {
            $custom_css = $instance[ 'custom_css' ];
            $newInstance[ 'custom_css' ] = $instance[ 'custom_css' ];
        }
        else {
            $custom_css = "";
            $newInstance[ 'custom_css' ] = "";
        }
        
        $data_for_cta = (empty($instance)) ? $newInstance : $instance;
        $data_for_cta["widget_id"] = $this->id;
        
        //Rendering Style for Widget Customize Box. We are doing this because it doesn't work fine on IE if we append style with js.
        if(!$sp_widget_form_displayed){
            $sp_widget_form_displayed = true;
            SP_Style_CTA::renderTempCss(true);
        }
        
        ?>
        <script type="text/javascript">
                function showStyler(_this,spinner){
                    jQuery(spinner).toggleClass("is-active");
                    
                    var _parent = _this.parentNode;
                    var data = "action=sp_style_cta&";
                    jQuery("#"+_parent.id + " input[type=hidden]").each(function(){
                        data += this.name + "=" + this.value + "&"
                    });
                    data = data.replace(/&+$/,'');
                    
                    jQuery.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: data,
                        success: function(data) {
                            jQuery(spinner).toggleClass("is-active");
                            jQuery("body").append(data.html);
                        }
                    });
                }
        </script>
        <style type="text/css">
            .sp_spinner2 {
                background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/spinner.gif) 0 0/20px 20px no-repeat;
                -webkit-background-size: 20px 20px;
                display: inline-block;
                visibility: hidden;
                float: right;
                vertical-align: middle;
                opacity: .7;
                filter: alpha(opacity=70);
                width: 20px;
                height: 20px;
                margin: 4px 10px 0;
            }
            .sp_spinner2.is-active {
                visibility: visible;
            }
        </style>
        
        
        <div id="sp_style_cta_form-<?php echo $this->id;?>" style="text-align: center; margin-top: 12px; margin-bottom: 12px;">
            <input type="hidden" name="style_file" value="">
            <input type="hidden" name="sp_cta" value="spokalwidget">
            <input type="hidden" name="sp_widget_instace" value="<?php echo base64_encode(json_encode($data_for_cta)); ?>">
            <input type="hidden" name="boxId" value="">
            <input type="hidden" name="version" value="">
            <input type="hidden" name="swg_css" value="<?php echo $this->get_field_id( 'swg_css' ); ?>">
            <input type="hidden" name="swg_content" value="<?php echo $this->get_field_id( 'swg_content' ); ?>">
            <span  class="button button-primary" onclick="showStyler(this,'#cta_spinner-<?php echo $this->id;?>')">Customize Widget</span>
            <span  id="cta_spinner-<?php echo $this->id;?>" class="sp_spinner2 sp_style_cta_form_spiner"></span>
        </div>
        
        <h3>Preview: </h3>
        <div class="sp-widget-preview" style="border: 1px solid #e5e5e5; padding: 10px;">
            <?php   SP_Style_CTA::renderSpokalWidget(base64_encode(json_encode($data_for_cta)),true); ?>
        </div>
        <input id="<?php echo $this->get_field_id( 'swg_css' ); ?>" type="hidden" name="<?php echo $this->get_field_name( 'custom_css' ); ?>" value="<?php echo $custom_css; ?>">
        <input id="<?php echo $this->get_field_id( 'swg_content' ); ?>" type="hidden" name="<?php echo $this->get_field_name( 'widget_content' ); ?>" value="<?php echo base64_encode(json_encode($data_for_cta)); ?>">
        
        
         <h3>Settings: </h3>
        <p>
            <label for="<?php echo $this->get_field_id( 'spokalcssclassname' ); ?>"><?php _e( 'Css Class' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'spokalcssclassname' ); ?>" name="<?php echo $this->get_field_name( 'spokalcssclassname' ); ?>" type="text" value="<?php echo esc_attr( $cssClass ); ?>" />
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hideSpokalWidget' ); ?>" name="<?php echo $this->get_field_name( 'hideSpokalWidget' ); ?>" <?php echo  checked($hideSpokalWidget, true, false); ?> />
            <label style = "letter-spacing: -0.5px" for="<?php echo $this->get_field_id( 'hideSpokalWidget' ); ?>"><?php _e( 'Hide if user is already registered to list.' ); ?></label>  
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'lead_campaign' ); ?>"><?php _e( 'Campaign: ' ); ?></label> 
            <select id="<?php echo $this->get_field_id( 'lead_campaign' ); ?>" name="<?php echo $this->get_field_name( 'lead_campaign' ); ?>">
                <?php
                
                    $campaigns = $this->getLeadList();
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
        <?php 
    }
    
    
    
    private function getLeadList() {
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            return "string and not array";
        }
        
        $params = array(
            "AccountId" => $accountID,
            "AuthorizationKey" => $authorizationKey
        );
        $result = SP_Request::GETRequest("/api/v1.1/Leads/LeadLists",$params);
        $decodedResult = json_decode($result, true);
        
        return $decodedResult;
    }
    
    
    
    
    public function renderAdditionalCss($css_instance,$id){
        
        $classes = array(
            "background" => $id,
            "title" => $id." > :first-child",
            "top-text" => $id." .swg_top_text",
            "input-text" => $id." .swg-input",
            "button" => $id." .swg_submit",
            "success-msg" => $id." .swg_success_msg",
            "error-msg" => $id." .swg_error_message"
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
                                    
                    if($key === "input-text"){
                        $css .= "line-height: normal;box-sizing: border-box;-webkit-appearance: none;-webkit-border-radius: 0;border-radius: 0;width: 100%;";
                    }
                    
                    if($key === "button"){
                        $css .= "background-image: none;border: 0;border-radius: 2px;padding: 8px 15px 8px;text-align:center;cursor:pointer;margin-top: 10px;box-sizing: border-box;max-width: 100%;";
                    }
                    
                    if($key === "title"){
                        $css .= "border:0px;";
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
                    $css .= $classes[$key].":hover{background-image: none;background-color:#".$value["hover-color"].";}";
                }
            }
        }
        if(!empty($css)){
             $css .=  $id."{padding: 10px;}".$id." .editor-field{margin-bottom: 5px;}";
            echo "<style type='text/css' scoped>".$css."</style>";
        }
    }
} 
