<?php

class GravityFormAddon {
    
    private $file;
    
    private $pluginDir;
    
    private $pluginUrl;
    
    private $email;
    
    private $leadList;
    
    private $status;
    
    private $version;
    
    
    public function __construct($file){
        $this->file = $file;
        $this->pluginDir = plugin_dir_path($file);
        $this->pluginUrl = plugin_dir_url($file);

        self::registerHooks();
    }
    
    
    
    private function registerHooks(){
        //adding gravity from hook action only if gravity plugin is activated
        add_action('gform_after_submission', array(&$this, 'sendGravityFormToSpokal'), 10, 2);
        add_filter( "gform_pre_submission_filter", array(&$this, 'preSubmission'), 9 );
        
        add_filter("gform_add_field_buttons", array(&$this, "addSpokalGravityFields"));
        add_filter( 'gform_field_type_title' , array(&$this, 'changeSpokalFieldTitles') );
        add_action( "gform_field_input" , array(&$this, "companySpokalGravityField"), 10, 5 );
        add_action( "gform_editor_js", array(&$this, "spokalGformEditorJS") );
        add_action("gform_editor_js_set_default_values", array(&$this, "spokalGravityFieldsDefaultLabel"));
        
        //adding hidden piwik input to gravity
        add_action('wp_footer',array(&$this, "spokalGformPiwikInput"),8);

    }
    
    
    
    public function sendGravityFormToSpokal($entry, $form) {
        $options = SpokalVars::getInstance()->options;
        $formId = $form["fields"][0]["formId"];
        $usedForms = get_option('spokal_gravity_and_spokal_forms');
        $campaignsAssociated = get_option("spokal_gravity_form_lead_list");
        if(is_array($usedForms)){
            if(!in_array($formId, $usedForms)) {
                return;
            }
        }else{
            return;
        }
        if(!method_exists('RGFormsModel', 'get_forms_by_id')){
            return;
        }
        //if form is selected, we need to get form fields first
        @$forms = RGFormsModel::get_forms_by_id($formId);
        $fieldsSpokalNeeds = array();
        $i = 0;
        $k = 0;
        $additionalFields = array();
        
        foreach ( $forms[0]["fields"] as $field ) {
            if(is_array($field)) {
                
                if($field['type'] == "email") {
                    $fieldsSpokalNeeds["email_field_id"] = $field["id"];
                }
                
                if($field['type'] == "company_spokal") {
                    $fieldsSpokalNeeds["company_field_id"] = $field["id"];
                }
                
                if($field['type'] == "phone") {
                    $fieldsSpokalNeeds["phone_field_id"] = $field["id"];
                }
                
                if($field['type'] == "subscribe_spokal") {;
                      if(count($field["inputs"]) == count($field["choices"]) && count($field["inputs"]) == 1 ){
                          $fieldsSpokalNeeds["spokal_subscribe"] = (string)$field["inputs"][0]['id'];
                      }
                }
                
                if($field['type'] == "name") {
                    foreach($field as $innerField) {

                        if(is_array($innerField)) {

                            foreach($innerField as $innerField2) {   

                                    //collect first name field id
                                    if(strpos(strval($innerField2["id"]), ".3")) {
                                        $fieldsSpokalNeeds["firstname_field_id"] = (string)$innerField2["id"];
                                    }

                                    if(strpos(strval($innerField2["id"]), ".6")) {
                                        $fieldsSpokalNeeds["lastname_field_id"] = (string)$innerField2["id"];
                                    }

                            }

                        }

                    }
                }

                // Getting id for data fields
                if($field['type'] == "time"     ||
                   $field['type'] == "date"     ||
                   $field['type'] == "website"  ||
                   $field['type'] == "fileupload" ||
                   $field['type'] == "list"     ||
                   $field['type'] == "text"     ||
                   $field['type'] == "textarea" ||
                   $field['type'] == "select"   ||
                   $field['type'] == "multiselect" ||
                   $field['type'] == "number"   ||
                   $field['type'] == "radio"    ||
                   $field['type'] == "hidden" 
                        
                    ){
                    
                    $fieldsSpokalNeeds["additional_simple_field".$i] = array(
                        "field_id" => $field["id"],
                        "name" => $field["label"]
                    );
                    $i++;
                }
                
                if($field['type'] == "address") {
                    foreach($field as $innerField) {
                        if(is_array($innerField)) {
                            for($j = 1; $j <= 6; $j++){
                                foreach($innerField as $innerField2) {    
                                    if(strpos(strval($innerField2["id"]), ".".$j)) {
                                        $fieldsSpokalNeeds["additional_simple_field".$i] = array(
                                            "field_id" => (string)$innerField2["id"],
                                            "name" => $innerField2["label"]
                                        );
                                        $i++;
                                        break;
                                    }
                                }      
                            }
                        }
                    }
                }
                
                if($field['type'] == "checkbox") {
                    $fieldsSpokalNeeds["checkbox_field_id".$k] = array(
                            "field_id" => array(),
                            "name" => $field["label"]
                        );
                    $length = count($field["inputs"]) + 1;
                    for($j = 1; $j <= $length; $j++){
                        if(is_array($field["inputs"])){
                            foreach($field["inputs"] as $innerField2) {   
                                if(strpos(strval($innerField2["id"]), ".".$j)) {
                                    $fieldsSpokalNeeds["checkbox_field_id".$k]['field_id'][$j] = (string)$innerField2["id"];
                                    break;
                                }
                            }
                        }
                    }
                    $k++;
                }
                
                
            }elseif(is_object($field)) {
                
                if($field->type == "email") {
                    $fieldsSpokalNeeds["email_field_id"] = $field->id;
                }
                
                if($field->type == "company_spokal") {
                    $fieldsSpokalNeeds["company_field_id"] = $field->id;
                }
                
                if($field->type == "phone") {
                    $fieldsSpokalNeeds["phone_field_id"] = $field->id;
                }
                
                if($field->type == "subscribe_spokal") {;
                      if(count($field->inputs) == count($field->choices) && count($field->inputs) == 1 ){
                          $fieldsSpokalNeeds["spokal_subscribe"] = (string)$field->inputs[0]['id'];
                      }
                }
                
                if($field->type == "name") {
                    foreach($field as $innerField) {

                        if(is_array($innerField)) {

                            foreach($innerField as $innerField2) {   

                                    //collect first name field id
                                    if(strpos(strval($innerField2["id"]), ".3")) {
                                        $fieldsSpokalNeeds["firstname_field_id"] = (string)$innerField2["id"];
                                    }

                                    if(strpos(strval($innerField2["id"]), ".6")) {
                                        $fieldsSpokalNeeds["lastname_field_id"] = (string)$innerField2["id"];
                                    }

                            }

                        }

                    }
                }

                // Getting id for data fields
                if($field->type == "time"     ||
                   $field->type == "date"     ||
                   $field->type == "website"  ||
                   $field->type == "fileupload" ||
                   $field->type == "list"     ||
                   $field->type == "text"     ||
                   $field->type == "textarea" ||
                   $field->type == "select"   ||
                   $field->type == "multiselect" ||
                   $field->type == "number"   ||
                   $field->type == "radio"    ||
                   $field->type == "hidden" 
                        
                    ){
                    
                    $fieldsSpokalNeeds["additional_simple_field".$i] = array(
                        "field_id" => $field->id,
                        "name" => $field->label
                    );
                    $i++;
                }
                
                if($field->type == "address") {
                    foreach($field as $innerField) {
                        if(is_array($innerField)) {
                            for($j = 1; $j <= 6; $j++){
                                foreach($innerField as $innerField2) {    
                                    if(strpos(strval($innerField2["id"]), ".".$j)) {
                                        $fieldsSpokalNeeds["additional_simple_field".$i] = array(
                                            "field_id" => (string)$innerField2["id"],
                                            "name" => $innerField2["label"]
                                        );
                                        $i++;
                                        break;
                                    }
                                }      
                            }
                        }
                    }
                }
                
                if($field->type == "checkbox") {
                    $fieldsSpokalNeeds["checkbox_field_id".$k] = array(
                            "field_id" => array(),
                            "name" => $field->label
                        );
                    $length = count($field->inputs) + 1;
                    for($j = 1; $j <= $length; $j++){
                        if(is_array($field->inputs)){
                            foreach($field->inputs as $innerField2) {   
                                if(strpos(strval($innerField2["id"]), ".".$j)) {
                                    $fieldsSpokalNeeds["checkbox_field_id".$k]['field_id'][$j] = (string)$innerField2["id"];
                                    break;
                                }
                            }
                        }
                    }
                    $k++;
                }
                
                
            }
            
        } 
        
        
        /*
         * Collecting gravity form fields
         * ------------------------------------------------------
         */
        
        //collecting email
        if(isset($fieldsSpokalNeeds["email_field_id"]) && isset($entry[$fieldsSpokalNeeds["email_field_id"]])) {
            $vars['Email'] = $entry[$fieldsSpokalNeeds["email_field_id"]];
            $this->email = $vars['Email'];
        }
        else {
            $vars['Email'] = "";
        }
        
        //collecting first name
        if(isset($fieldsSpokalNeeds["firstname_field_id"]) && isset($entry[$fieldsSpokalNeeds["firstname_field_id"]])) {
            $vars['FirstName'] = $entry[$fieldsSpokalNeeds["firstname_field_id"]];
        }
        
        //collecting last name
        if(isset($fieldsSpokalNeeds["lastname_field_id"]) && isset($entry[$fieldsSpokalNeeds["lastname_field_id"]])) {
            $vars['LastName'] = $entry[$fieldsSpokalNeeds["lastname_field_id"]];
        }
        
        if(isset($fieldsSpokalNeeds["phone_field_id"]) && isset($entry[$fieldsSpokalNeeds["phone_field_id"]])) {
            $vars['Phone'] = $entry[$fieldsSpokalNeeds["phone_field_id"]];
        }

        if(isset($fieldsSpokalNeeds["company_field_id"]) && isset($entry[$fieldsSpokalNeeds["company_field_id"]])) {
            $vars['Company'] = $entry[$fieldsSpokalNeeds["company_field_id"]];
        }
        
        if(isset($fieldsSpokalNeeds["spokal_subscribe"])){
            if(isset($entry[$fieldsSpokalNeeds["spokal_subscribe"]])) {
                if(empty($entry[$fieldsSpokalNeeds["spokal_subscribe"]])){
                    $vars['SpokalTrackOnly'] = 1;
                }
            }  
        }
        
        foreach($fieldsSpokalNeeds as $key => $fieldSpokalNeed) {
            //skip iteration if this is one of the main fields
            if(
                $key == "email_field_id" ||
                $key == "firstname_field_id" ||
                $key == "lastname_field_id" ||
                $key == "phone_field_id" ||
                $key == "company_field_id"
            ) {
                continue;
            } elseif(substr($key,0,17) == "checkbox_field_id"){
                $additionalFields[$fieldSpokalNeed["name"]] = array();
                $i = 0;
                foreach($fieldSpokalNeed['field_id'] as $fieldSpokalNeed2){
                    if(isset($entry[$fieldSpokalNeed2]) & !empty($entry[$fieldSpokalNeed2])) {
                        $additionalFields[$fieldSpokalNeed["name"]][$i] = maybe_unserialize($entry[$fieldSpokalNeed2]);
                        $i++;
                    }
                }
               continue;
            }
            
            
            
            if(isset($entry[$fieldSpokalNeed["field_id"]]) && !empty($entry[$fieldSpokalNeed["field_id"]])) {
                $additionalFields[$fieldSpokalNeed["name"]] = maybe_unserialize($entry[$fieldSpokalNeed["field_id"]]);
            }
        }
        
        
        if(!empty($additionalFields)) {
            $vars["AdditionalProperties"] = json_encode($additionalFields);
        }
        
        
        /*
         * Collecting of gravity form fields ends here
         * -------------------------------------------------------
         */
 
        //collecting piwik id
        if(isset($_POST['SpokalPiwikId'])) {
            $vars['SpokalPiwikId'] = $_POST['SpokalPiwikId'];
        }
        else {
            $vars['SpokalPiwikId'] = "";
        }
        
        //collecting wordpresss post id. In this case we will have it alyway empty
        if(isset($_POST['SpokalPostId']) && !empty($_POST['SpokalPostId'])) {
            $vars['SpokalPostId'] = $_POST['SpokalPostId'];
        }
        else {
            $vars['SpokalPostId'] = 0;
        }
        
        //collecting wordpress blog id
        $vars['SpokalSpokalWpSiteId'] = get_current_blog_id();
        

        
        //collecting browser info
        $vars['SpokalBrowserOsInfo'] = $_SERVER["HTTP_USER_AGENT"];
        
        //getting campaign
        if(isset($_GET['c'])) {
            $vars['SpokalCampaign'] = htmlspecialchars($_GET["c"]);
        }
        
        //collecting referer info
        $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        
        if(isset($campaignsAssociated[$formId])) {
            $vars['SpokalListIdentifier'] = $campaignsAssociated[$formId];
        }else{
            $vars['SpokalListIdentifier'] = -1;
        }
        $this->leadList = $vars['SpokalListIdentifier'];
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        $vars['SpokalSource'] = 'GravityForms';
        
        $method = "GravityForms";
        if(!empty($vars['Email'])){
            SpokalVars::getInstance()->submitedEmail = $vars['Email'];
            $this->status = SpokalLeads::sendLeads($vars,$method);
        }
        
        add_action('wp_footer',array(&$this,'createCookie'));
    }
    
    
    
    public function preSubmission($form) {
        extract(SP_Func::post_id());
        $_POST["SpokalPostId"] = $wordpressPostId;
        $_POST["SpokalSubmittedUrl"] = $subscribeURL;
        return $form;
    }
    
    
    
    public function addSpokalGravityFields($field_groups) {
        
        foreach($field_groups as &$group){

            if($group["name"] == "advanced_fields"){
                $this->version = $this->gravity_version();
                if($this->version == "new"){
                    $group["fields"][] = array(
                                        "class" =>   "button", 
                                        "value" => __("Company", "gravityforms"), 
                                        "onclick" => "StartAddField('company_spokal');",
                                        "data-type" => 'company_spokal',
                                    );
                    $group["fields"][] = array(
                                        "class" =>   "button", 
                                        "value" => __("Subscribe", "gravityforms"), 
                                        "onclick" => "StartAddField('subscribe_spokal');",
                                        "data-type" => 'subscribe_spokal',
                                    );
                    break;
                }else{
                    $group["fields"][] = array(
                                            "class" =>   "button", 
                                            "value" => __("Company", "gravityforms"), 
                                            "onclick" => "StartAddField('company_spokal');",
                                        );
                    $group["fields"][] = array(
                                            "class" =>   "button", 
                                            "value" => __("Subscribe", "gravityforms"), 
                                            "onclick" => "StartAddField('subscribe_spokal');",
                                        );
                    break;
                }
            }

        }

        return $field_groups;

    }
    
    
    
    public function changeSpokalFieldTitles( $type ) {
        if ( $type == 'company_spokal' ) {
            return __( 'Company' , 'gravityforms' );
        }
        
        if ( $type == 'subscribe_spokal' ) {
            return __( 'Subscribe' , 'gravityforms' );
        }
    }
    
    
    
    // Adds the input area to the external side
    public function companySpokalGravityField ( $input, $field, $value, $lead_id, $form_id ){
        if(is_object($field)){
            if ( $field->type == "company_spokal" ) {
                $max_chars = "";

                if(!IS_ADMIN && !empty($field->maxLength) && is_numeric($field->maxLength)) {
                    $max_chars = self::get_counter_script($form_id, $field->id, $field->maxLength);
                }

                $input_name = $form_id .'_' . $field->id;

                $tabindex = GFCommon::get_tabindex();

                $css = isset( $field->cssClass ) ? $field->cssClass : '';

                return sprintf("
                        <div class='ginput_container'>
                            <input type='text'  name='input_%s' id='%s' class='gform_company %s' $tabindex value='%s'>
                        </div>{$max_chars}", 
                    $field->id, 
                    'company-'.$field->id , 
                    $field->type . ' ' . esc_attr( $css ) . ' ' . $field->size , 
                    esc_html($value)
                );

            }

            if ( $field->type == "subscribe_spokal" ) {
                $is_form_editor  = GFCommon::is_form_editor();
                $disabled_text = $is_form_editor ? 'disabled="disabled"' : '';
                $css = isset( $field->cssClass ) ? $field->cssClass : '';
                
                return sprintf("<div class='ginput_container'><ul class='gfield_checkbox %s' id='%s'>%s</ul></div>",
                        $css,
                        $field["id"], 
                        $this->sp_get_checkbox_choices($field, $value, $disabled_text, $form_id)
                        );
            }
        }elseif(is_array($field)){
            if ( $field["type"] == "company_spokal" ) {
                $max_chars = "";

                if(!IS_ADMIN && !empty($field["maxLength"]) && is_numeric($field["maxLength"])) {
                    $max_chars = self::get_counter_script($form_id, $field["id"], $field["maxLength"]);
                }


                $input_name = $form_id .'_' . $field["id"];

                $tabindex = GFCommon::get_tabindex();

                $css = isset( $field['cssClass'] ) ? $field['cssClass'] : '';

                return sprintf("
                        <div class='ginput_container'>
                            <input type='text'  name='input_%s' id='%s' class='gform_company %s' $tabindex value='%s'>
                        </div>{$max_chars}", 
                    $field["id"], 
                    'company-'.$field['id'] , 
                    $field["type"] . ' ' . esc_attr( $css ) . ' ' . $field['size'] , 
                    esc_html($value)
                );

            }

            if ( $field["type"] == "subscribe_spokal" ) {              

                $disabled_text = (IS_ADMIN && RG_CURRENT_VIEW != "entry") ? "disabled='disabled'" : "";


                $css = isset( $field['cssClass'] ) ? $field['cssClass'] : '';

                return sprintf("<div class='ginput_container'><ul class='gfield_checkbox %s' id='%s'>%s</ul></div>",
                        $css,
                        $field["id"], 
                        GFCommon::get_checkbox_choices($field, $value, $disabled_text)
                        );

            }
        }

        return $input;

    }
    
    
    
    
    public function spokalGravityFieldsDefaultLabel(){
    ?>
        //this hook is fired in the middle of a switch statement,
        //so we need to add a case for our new field type

        case "company_spokal" :
            field.label = "Company"; //setting the default field label
        break;
        
        case "subscribe_spokal" :
            field.label = "Subscribe"; //setting the default field label
        
            if(!field.choices)
                field.choices = new Array(new Choice("<?php _e("Subscribe me", "gravityforms"); ?>"));

            field.inputs = new Array();
            for(var i=1; i<=field.choices.length; i++) {
                field.inputs.push(new Input(field.id + (i/10), field.choices[i-1].text));
            }
        break;

    <?php

    }
    
    
    
    
    // Now we execute some javascript technicalitites for the field to load correctly

    function spokalGformEditorJS(){
    ?>
        <script type='text/javascript'>jQuery(document).ready(function($){fieldSettings["company_spokal"] = ".label_setting, .description_setting, .admin_label_setting, .size_setting, .default_value_textarea_setting, .error_message_setting, .css_class_setting, .rules_setting, .visibility_setting, .tos_setting";/*this will show all the fields of the Paragraph Text field minus a couple that I didn't want to appear.*//*binding to the load field settings event to initialize the checkbox*/$(document).bind("gform_load_field_settings", function(event, field, form){jQuery("#field_company").attr("checked", field["field_company"] == true);$("#field_company_value").val(field["company"]);});});</script>
        <script type='text/javascript'>jQuery(document).ready(function($){fieldSettings["subscribe_spokal"] = ".conditional_logic_field_setting, .prepopulate_field_setting, .error_message_setting, .label_setting, .admin_label_setting, .choices_setting, .rules_setting, .visibility_setting, .description_setting, .css_class_setting";});</script>
    <?php

    } 
    
    
    
    
    public function createCookie(){
        if(isset(SpokalVars::getInstance()->options["hooks_footer_ac"])) {
            if(!empty(SpokalVars::getInstance()->options["hooks_footer_ac"]["value"])){ 
                if(isset($this->email)){
                    if(!empty($this->email)){ ?>
                        <script type="text/javascript">var Email = "<?php echo $this->email; ?>";var EmailCookie = base64_encode(Email);if(document.cookie.indexOf("acemail") < 0){document.cookie = "acemail=" + EmailCookie;}</script>
        <?php       }
                }
            }
        }
        
        if(isset($this->leadList) && isset($this->status)){
            if(!empty($this->leadList) && !empty($this->status)){
                $status = $this->status;
                if($status->Result === 'Success'){
                    
                    if(!isset($_COOKIE['sp_lists'])){
                        
                        $cookieNew = base64_encode(json_encode(array($this->leadList))); ?>
                        <script type="text/javascript">var LeadList = "<?php echo $cookieNew; ?>";document.cookie = "sp_lists=" + LeadList + "; expires=Thu, 18 Dec 206812:00:00 UTC; path=/";</script>                        
                   <?php 
                    }else{
                        
                        $cookieOld = json_decode(base64_decode($_COOKIE['sp_lists']));
                        if(!in_array($this->leadList, $cookieOld)){
                            $cookieOld[] = $this->leadList;
                            $cookieOld = base64_encode(json_encode($cookieOld)); 
                            ?>
                            <script type="text/javascript">var LeadList = "<?php echo $cookieOld; ?>";document.cookie = "sp_lists=" + LeadList + "; expires=Thu, 18 Dec 2068 12:00:00 UTC; path=/";</script> 
                        <?php
                        }
 
                    }
                }
            }
        }
    }
    
    
    
    public function spokalGformPiwikInput(){
        
        if(!SP_Func::isPluginActive("gravityforms.php")){
            return;
        }
        ?>
            <script type="text/javascript">jQuery(".gform_body").append('<input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden">');</script>
        <?php
    }
    
    
    public function sp_get_checkbox_choices($field, $value, $disabled_text,$form_id){
        $choices = "";
        $is_entry_detail = GFCommon::is_entry_detail();
        $is_form_editor  = GFCommon::is_form_editor();
        
        if(is_array($field->choices)){
            $choice_number = 1;
            $count = 1;
            foreach($field->choices as $choice){
                if($choice_number % 10 == 0) //hack to skip numbers ending in 0. so that 5.1 doesn't conflict with 5.10
                    $choice_number++;

                $input_id = $field->id . '.' . $choice_number;
                
                if ( $is_entry_detail || $is_form_editor || $form_id == 0 ){
                    $id = $field->id . '_' . $choice_number ++;
                } else {
                    $id = $form_id . '_' . $field->id . '_' . $choice_number ++;
                }

                if(empty($_POST) && rgar($choice,"isSelected")){
                    $checked = "checked='checked'";
                }
                else if(is_array($value) && RGFormsModel::choice_value_match($field, $choice, rgget($input_id, $value))){
                    $checked = "checked='checked'";
                }
                else if(!is_array($value) && RGFormsModel::choice_value_match($field, $choice, $value)){
                    $checked = "checked='checked'";
                }
                else{
                    $checked = "";
                }
                
                $logic_event = self::sp_get_logic_event($field, "click");
                
                $tabindex = GFCommon::get_tabindex();
                $choice_value = $choice["value"];
                if($field->enablePrice){
                    $price = rgempty( 'price', $choice ) ? 0 : GFCommon::to_number( rgar( $choice, 'price' ) );
                    $choice_value .= '|' . $price;
                }

                $choice_value = esc_attr( $choice_value );
                $choices .= "<li class='gchoice_{$id}'>
                                            <input name='input_{$input_id}' type='checkbox' $logic_event value='{$choice_value}' {$checked} id='choice_{$id}' {$tabindex} {$disabled_text} />
                                            <label for='choice_{$id}' id='label_{$id}'>{$choice['text']}</label>
                                    </li>";
                                            
                $is_entry_detail = GFCommon::is_entry_detail();
                $is_form_editor  = GFCommon::is_form_editor();
                $is_admin = $is_entry_detail || $is_form_editor;
                if ( $is_admin && RG_CURRENT_VIEW != 'entry' && $count >= 5 ) {
                    break;
                }

                $count++;
            }

            $total = sizeof($field->choices);
            if($count < $total)
                $choices .= "<li class='gchoice_total'>" . sprintf(__("%d of %d items shown. Edit field to view all", "gravityforms"), $count, $total) . "</li>";
        
            return apply_filters("gform_field_choices_" . rgget("formId", $field), apply_filters("gform_field_choices", $choices, $field), $field);
        }
        
    }
    
    
    
    public static function sp_get_logic_event($field, $event){
        if(empty($field->conditionalLogicFields) || GFCommon::is_entry_detail() || GFCommon::is_form_editor())
            return "";

        switch($event){
            case "keyup" :
                return "onchange='gf_apply_rules(" . $field->formId . "," . GFCommon::json_encode($field->conditionalLogicFields) . ");' onkeyup='clearTimeout(__gf_timeout_handle); __gf_timeout_handle = setTimeout(\"gf_apply_rules(" . $field->formId . "," . GFCommon::json_encode($field->conditionalLogicFields) . ")\", 300);'";
            break;

            case "click" :
                return "onclick='gf_apply_rules(" . $field->formId . "," . GFCommon::json_encode($field->conditionalLogicFields) . ");'";
            break;

            case "change" :
                return "onchange='gf_apply_rules(" . $field->formId . "," . GFCommon::json_encode($field->conditionalLogicFields) . ");'";
            break;
        }
    }
    
    
    
    
    public function gravity_version(){
        $activePlugins = get_option('active_plugins');
        $path = "";
        if(is_array($activePlugins)){
            foreach($activePlugins as $plugin){
                if(strpos($plugin,"gravityforms.php")){
                    $path = $plugin;
                }
            }
        }
        
        if(empty($path)){
            $version = "1.0";
        }else{
            $plugin_data = get_plugin_data(ABSPATH.'wp-content/plugins/'.$path);
            $version = $plugin_data["Version"];
        }
        
        if(version_compare($version,"1.9") == -1){
            return "old";
        }else{
            return "new";
        }
    }


}