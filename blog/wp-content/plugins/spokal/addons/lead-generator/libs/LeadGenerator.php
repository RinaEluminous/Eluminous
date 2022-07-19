<?php

class LeadGenerator {
    
    private $file;
    
    private $pluginDir;
    
    private $pluginUrl;
     
    
    public function __construct($file){
        $this->file = $file;
        $this->pluginDir = plugin_dir_path($file);
        $this->pluginUrl = plugin_dir_url($file);

        self::registerHooks();
    }
    
    
    
    private function getAjaxUrl() {
        return admin_url( 'admin-ajax.php', 'relative' );
    }
    
    
    
    private function registerHooks(){
        
        global $shortcodeID;
        $shortcodeID = 1;
        add_shortcode( 'optin', array($this, 'shortcodeOptin') );
        
    }
    
    
    
    public function shortcodeOptin( $atts ) {
        
        global $shortcodeID;
        
        extract( shortcode_atts( array(
            'title'             => '',
            'text'              => '',
            'collectfirstname'  => 'false',
            'collectlastname'   => 'false',
            'buttontext'        => 'Submit',
            'successmessage'    => 'Message has been submitted successfully.',
            'invalidemailmessage' => 'Your email address does not appear valid.',
            'failmessage'       => 'Failed to send your message. Please try later.',
            'shortcode'         => '[optin]',
            'cssclass'          => 'optin-form',
            'cssclassbordered'  => 'optin-form-border',
            'border'            => 'false',
            'image'             => '',
            'leadlist'          => -1,
            'collectphone'      => 'false',
            'collectcompany'    => 'false'
            
        ), $atts ) );
        
        $htmlPrefix  = "spokal_"; 
        
        //Getting placeholders from database. Placeholders can be changes from Inlince Cta Tab
        $placeholders = get_option("spokal_inlineCta_ph",array());
        $emailPlaceholder = (isset($placeholders["emailPlaceholder"])) ? $placeholders["emailPlaceholder"] : "Email";
        $firstNamePlaceholder = (isset($placeholders["firstNamePlaceholder"])) ? $placeholders["firstNamePlaceholder"] : "First Name";
        $lastNamePlaceholder = (isset($placeholders["lastNamePlaceholder"])) ? $placeholders["lastNamePlaceholder"] : "Last Name";
        $phonePlaceholder = (isset($placeholders["phonePlaceholder"])) ? $placeholders["phonePlaceholder"] : "Phone";
        $companyPlaceholder = (isset($placeholders["companyPlaceholder"])) ? $placeholders["companyPlaceholder"] : "Company";
            
        
        
        $formID = $htmlPrefix."lead_generator_".$shortcodeID;
        $loadGifId = $htmlPrefix."inline_loading_gif_".$shortcodeID;
        $form_wrap_id = $htmlPrefix."inline_cta_".$shortcodeID;
        $borderClass = "";
        if($border == 'true') {
            $borderClass = $cssclassbordered;
        }
        else {
            $borderClass = $cssclass;
        }
        $currentUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}".'#'.$form_wrap_id;
        ob_start();
        ?>

        <script type="text/javascript">jQuery(document).ready(function(){jQuery("#<?php echo $formID; ?>").submit(function(e){e.preventDefault();if(validWidgetLeadGeneratorRequest("<?php echo $formID; ?>",<?php echo json_encode($invalidemailmessage); ?>)){jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").html("");jQuery.ajax({beforeSend: function(){jQuery("#<?php echo $loadGifId; ?>").show();jQuery(".buttonshortcode-<?php echo $shortcodeID; ?>").hide();},url: "<?php echo $this->getAjaxUrl(); ?>",type: "POST",data: jQuery("#<?php echo $formID; ?>").serialize(),success: function(spokaldata){jQuery("#<?php echo $loadGifId; ?>").hide();var n = spokaldata.search('Success');if(n == -1){jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").html(<?php echo json_encode($failmessage); ?>);jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").css("color","#ff0000");jQuery(".buttonshortcode-<?php echo $shortcodeID; ?>").show();}else{jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>_succes").html(<?php echo json_encode($successmessage); ?>);jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>_succes").css("color","#33cc00");jQuery("#<?php echo $formID; ?>").remove();}},error: function(){jQuery("#<?php echo $loadGifId; ?>").hide();jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").html(<?php echo json_encode($failmessage); ?>);jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").css("color","#ff0000");jQuery(".buttonshortcode-<?php echo $shortcodeID; ?>").show();}});}else{jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").html(<?php echo json_encode($invalidemailmessage); ?>);jQuery("#<?php echo $htmlPrefix; ?>OptinFormResult_<?php echo $shortcodeID; ?>").show();}});});</script>
        <?php $this->renderAdditionalCss(); ?>
        <div id="<?php echo $form_wrap_id; ?>" class="<?php echo $borderClass; ?>  sp_skip_autolink inlince-cta-wrap" style="padding: 15px 15px;">
            <?php extract(SP_Func::post_id()); ?>
            
            <?php if ($title != "") { ?>
                <div class="<?php echo $cssclass; ?>-title">
                    <h2 class="inline-title" ><?php echo $title; ?></h2>
                </div>
            <?php } ?>

            <?php 
                if ($text != ""){
                    echo '<p class="inline-top-text" id="'.$htmlPrefix.'Toptext_'.$shortcodeID.'">';
                }
                if($image != '') { ?>
                    <img src="<?php echo $image; ?>" class="optinform-image" style="margin: 0 0 0 15px; float:right;"><?php
                }
                if ($text != ""){ 
                    echo $text; 
                    echo "</p>"; 
                }                


                $shortcode_result_id = $htmlPrefix."OptinFormResult_".$shortcodeID;
                $invalidEmail = $this->check_email($shortcode_result_id);
                $submission_result = $this->check_submission($shortcode_result_id,$failmessage,$successmessage);

                if($submission_result === "wrong_form"){
                    $result_style = "display: none;";
                    $result_style_succes = "display: none;";
                    $result_message = "";
                    $rez_succes_msg = "";
                    $show_form = true;
                }elseif($submission_result === "true"){
                    $result_style = 'display: none;';
                    $result_style_succes = "";
                    $rez_succes_msg = $successmessage;
                    $result_message = "";
                    $show_form = false;
                }elseif($submission_result === "false"){
                    $result_style = "";
                    $result_style_succes = "display: none;";
                    $rez_succes_msg = "";
                    $result_message = $failmessage;
                    $show_form = true;
                }
                
                if(!$invalidEmail && $submission_result === "wrong_form"){
                    $result_style = "";
                    $result_style_succes = "display: none;";
                    $result_message = $invalidemailmessage;
                    $rez_succes_msg = "";
                    $show_form = true;
                }

             ?> 
                <div <?php echo $result_style_succes; ?> class="inline_succes_msg" id="<?php echo $shortcode_result_id; ?>_succes"><?php echo $rez_succes_msg; ?></div>
                <?php if($show_form){?>    
                    <form action="<?php echo $currentUrl; ?>" method="post" name="<?php echo $formID; ?>" id="<?php echo $formID; ?>" style="width: 230px; max-width: 100%;">
                        <input name="action" type="hidden" value="spokal_cf" />

                        <div class="editor-field">
                            <input style="float:none;" id="Email_<?php echo $shortcodeID; ?>" name="Email" placeholder="<?php echo $emailPlaceholder; ?>" class="spokal-required email icta-input" type="text">
                        </div>
                        <?php if($collectfirstname == 'true'){ ?>
                            <div class="editor-field">
                                <input style="float:none;" class="icta-input" placeholder="<?php echo $firstNamePlaceholder; ?>" name="FirstName" type="text">
                            </div>
                        <?php } ?>
                        <?php if($collectlastname == 'true') { ?>
                            <div class="editor-field">
                                <input style="float:none;" class="icta-input" name="LastName" placeholder="<?php echo $lastNamePlaceholder; ?>" type="text">
                            </div>
                        <?php }; ?>
                        <?php if($collectphone == 'true') { ?>
                            <div class="editor-field">
                                <input style="float:none;" class="icta-input" name="Phone" placeholder="<?php echo $phonePlaceholder; ?>" type="text">
                            </div>
                        <?php }; ?>
                         <?php if($collectcompany == 'true') { ?>
                            <div class="editor-field">
                                <input style="float:none;" class="icta-input" name="Company" placeholder="<?php echo $companyPlaceholder; ?>" type="text">
                            </div>
                        <?php }; ?>
                        <div id="<?php echo $loadGifId; ?>" class="formLoader" style=" display:none; width: 20px; height: 20px; float: left; margin: 5px 5px 0 20px;  background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/loader.gif) no-repeat center center;"></div>
                        <input type="hidden" name="action" value="spokal_lead_generator"><input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>"><input name="form_id" type="hidden" value="<?php echo $shortcode_result_id; ?>"><input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden"><input name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>"><input name="SpokalBrowserOsInfo" type="hidden" value = "<?php if(isset($_SERVER["HTTP_USER_AGENT"])){echo $_SERVER["HTTP_USER_AGENT"];} ?>"/><input name="sp_leads_form" type="hidden" value = "InlineCta"/><input name="SpokalListIdentifier" type="hidden" value="<?php echo $leadlist; ?>"/><input style="float:none;" name = '<?php echo $htmlPrefix; ?>submitbutton' value="<?php echo $buttontext; ?>" type="submit" class = 'buttonshortcode-<?php echo $shortcodeID; ?> icta-submit' />
                        <div style="clear:both;"></div>
                    </form>
                    <div style="clear:both;"></div>
                <?php } ?>
                    <div style="<?php echo $result_style; ?>" class="inline_error_msg" id="<?php echo $shortcode_result_id; ?>"><?php echo $result_message; ?></div>
            </div>

        <?php
        $output = ob_get_contents();
        ob_end_clean();
        
        
        $shortcodeID++;
        return $output;
     
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
    
    
    
    public function renderAdditionalCss(){
        $css_instance = get_option("spokal_icta_custom_style",array());
        
        $classes = array(
            "background" => ".inlince-cta-wrap",
            "title" => ".inlince-cta-wrap .inline-title",
            "top-text" => ".inline-top-text",
            "input-text" => ".inlince-cta-wrap .icta-input",
            "button" => ".inlince-cta-wrap .icta-submit",
            "success-msg" => ".inline_succes_msg",
            "error-msg" => ".inline_error_msg"
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
                    
                    if($key === "title"){
                        $css .= "margin: 15px 0 15px 0;";
                    }
                    
                    if($key === "input-text"){
                        $css .= "background-image: none;line-height: normal;box-sizing: border-box;-webkit-appearance: none;-webkit-border-radius: 0;border-radius: 0;max-width: 100%;";
                    }
                    
                    if($key === "button"){
                        $css .= "background-image: none;border: 0;border-radius: 2px;padding: 8px 15px 8px;text-align:center;cursor:pointer;margin-top: 10px;box-sizing: border-box;max-width: 100%;";
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
                    $css .= $classes[$key].":hover{background-image: none;background-color:#".$value["hover-color"].";}";
                }
            }
        }
        if(!empty($css)){
            $css .=  ".inlince-cta-wrap .editor-field{margin-bottom: 5px;}";
            echo "<style type='text/css'>".$css."</style>";
        }
    }
    
    
    
}