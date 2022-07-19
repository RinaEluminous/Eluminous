<?php

class NinjaFormAddon {
    
    private $file;
    
    private $pluginDir;
    
    private $pluginUrl;
    
    private $email;
    
    private $leadList;
    
    private $status;
    
    
    public function __construct($file){
        $this->file = $file;
        $this->pluginDir = plugin_dir_path($file);
        $this->pluginUrl = plugin_dir_url($file);

        self::registerHooks();
    }
    
    
    
    private function registerHooks(){
        //adding gravity from hook action only if gravity plugin is activated
        add_action( 'ninja_forms_post_process', array(&$this,'sendNinjaFormsToSpokal'),10);
        add_action('wp_footer',array(&$this, "spokalNinjaformPiwikInput"),8);
        add_action( 'init', array(&$this, 'register_my_custom_field'));
        add_filter('ninja_forms_field_wrap_class',array(&$this,'add_wrapp_class'),10,2);
    }
    
    
    
    public function sendNinjaFormsToSpokal(){
    
        global $ninja_forms_processing;
        $vars = array();
        $vars['Email'] = "";
        $vars['FirstName'] = "";
        $vars['LastName'] = "";
        $vars['Phone'] = "";
        $vars['Company'] = "";
        $additionalFields = array();
        $formId = $ninja_forms_processing->get_form_ID();
        $usedForms = get_option('spokal_ninja_and_spokal_forms');
        $campaignsAssociated = get_option("spokal_ninja_form_lead_list");
        if(is_array($usedForms)){
            if(!in_array($formId, $usedForms)) {
                return;
            }
        }else{
            return;
        }
        /*
         * Collecting of Ninja form fields
         * -------------------------------------------------------
         */
        $all_fields = $ninja_forms_processing->get_all_fields();
        if(!is_array($all_fields)){return;}
        
        // Collect Basic Leads
        foreach($all_fields as $key => $value){
            
            $settings = $ninja_forms_processing->get_field_settings($key);
            if($settings['type'] == 'spokal_subscribe'){
                $fieldValue = $ninja_forms_processing->get_field_value($key);
                if($fieldValue !== "checked"){
                    $vars['SpokalTrackOnly'] = true;
                }
                continue;
            }
            
            if($settings['type'] == 'spokal_company'){
                $fieldValue = $ninja_forms_processing->get_field_value($key);
                $vars['Company'] = $fieldValue;
                continue;
            }
            
            if(!isset($settings['data'])){continue;}
            $fieldsData = $settings['data'];
            
            //Getting First Name
            if(isset($fieldsData['first_name']))
            {
                if($fieldsData['first_name'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $vars['FirstName'] = $fieldValue;
                    continue;
                }
            }
            
            //Getting Last Name
            if(isset($fieldsData['last_name']))
            {
                if($fieldsData['last_name'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $vars['LastName'] = $fieldValue;
                    continue;
                }
            }
            
            //Getting Email
            if(isset($fieldsData['email']))
            {
                if($fieldsData['email'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $vars['Email'] = $fieldValue;
                    $this->email = $vars['Email'];
                    continue;
                }
            }
            
            //Getting Phone
            if(isset($fieldsData['user_phone']))
            {
                if($fieldsData['user_phone'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $vars['Phone'] = $fieldValue;
                    continue;
                }
            }

        }
        
        // Additional Fields
        foreach($all_fields as $key => $value){
            $settings = $ninja_forms_processing->get_field_settings($key);
            if($settings['type'] == 'spokal_subscribe'){continue;}
            if($settings['type'] == 'spokal_company'){continue;}
            
            if($settings['type'] == '_country')
            {
                $fieldValue = $ninja_forms_processing->get_field_value($key);
                $additionalFields['Country'] = $fieldValue;
                continue;
            }
            
            if(!isset($settings['data'])){continue;}
            
            $fieldsData = $settings['data'];
            if(isset($fieldsData['first_name']) && ($fieldsData['first_name'] == 1)){continue;}
            if(isset($fieldsData['last_name']) && ($fieldsData['last_name'] == 1)){continue;}
            if(isset($fieldsData['email']) && ($fieldsData['email'] == 1)){continue;}
            if(isset($fieldsData['user_phone']) && ($fieldsData['user_phonee'] == 1)){continue;}
            
            if(
               $settings['type'] == '_text'         ||
               $settings['type'] == '_textarea'     ||
               $settings['type'] == '_number'       ||
               $settings['type'] == '_checkbox'     ||
               $settings['type'] == '_list'         ||
               $settings['type'] == '_hidden'       ||
               $settings['type'] == '_rating'       ||
               $settings['type'] == '_calc'
                    
               ){
                $fieldValue = $ninja_forms_processing->get_field_value($key);
                $additionalFields[$fieldsData['label']] = $fieldValue;
                continue;
            }
            
            if(isset($fieldsData['user_address_1']))
            {
                if($fieldsData['user_address_1'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $additionalFields['Address 1'] = $fieldValue;
                    continue;
                }
            }
            
            if(isset($fieldsData['user_address_2']))
            {
                if($fieldsData['user_address_2'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $additionalFields['Address 2'] = $fieldValue;
                    continue;
                }
            }
            
            if(isset($fieldsData['user_city']))
            {
                if($fieldsData['user_city'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $additionalFields['City'] = $fieldValue;
                    continue;
                }
            }
            
            if(isset($fieldsData['user_state']))
            {
                if($fieldsData['user_state'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $additionalFields['State'] = $fieldValue;
                    continue;
                }
            }
            
            if(isset($fieldsData['user_zip']))
            {
                if($fieldsData['user_zip'] == 1)
                {
                    $fieldValue = $ninja_forms_processing->get_field_value($key);
                    $additionalFields['Zip / Postal Code'] = $fieldValue;
                    continue;
                }
            }
            
        }
        
        if(!empty($additionalFields)) {
            $vars["AdditionalProperties"] = json_encode($additionalFields);
        }
//        
        /*
         * Collecting of Ninja form fields ends here
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
        $vars['SpokalWpSiteId'] = get_current_blog_id();
        
        
        //collecting browser info
        $vars['SpokalBrowserOsInfo'] = $_SERVER["HTTP_USER_AGENT"];
        
        
        //collecting referer info
        $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        
        if(isset($campaignsAssociated[$formId])) {
            $vars['SpokalListIdentifier'] = $campaignsAssociated[$formId];
        }else{
            $vars['SpokalListIdentifier'] = -1;
        }
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        $this->leadList = $vars['SpokalListIdentifier'];
        
        
        $vars['SpokalSource'] = 'NinjaForms';
        $method = "NinjaForms";
        if(!empty($vars['Email'])){
            SpokalVars::getInstance()->submitedEmail = $vars['Email'];
            $this->status = SpokalLeads::sendLeads($vars,$method);
        }
        
        add_action('wp_footer',array(&$this,'createCookie'));
    }
    
    
    
    
    public function spokalNinjaformPiwikInput(){
        
        if(!SP_Func::isPluginActive("ninja-forms.php")){
            return;
        }
        extract(SP_Func::post_id()); ?>
        <script type="text/javascript">jQuery(".ninja-forms-form").append('<input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>"><input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">');jQuery(".ninja-forms-form").append('<input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden">');</script>
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
    
    
    
    
    public function register_my_custom_field() {
        $args = array(
            'name' => 'Company',
            'default_label' => 'Company',		
            'edit_options' => '',
            'display_function' => array(&$this,'my_new_field_display'),
            'sidebar' => 'template_fields',
        );
        
        if( function_exists( 'ninja_forms_register_field' ) ) {
            ninja_forms_register_field('spokal_company', $args);
        }
        
        $args = array(
            'name' => 'Subscribe',
            'default_label' => 'Subscribe me',		
            'label_pos_options' => array(
                            array('name' => __( 'Right of Element', 'ninja-forms' ), 'value' => 'right'),
                        ),
            'edit_options' => array(
                        array(
				'type'    => 'select', //What type of input should this be?
				'options' => array(
                                    array(
                                            'name'  => __( 'Unchecked', 'ninja-forms' ),
                                            'value' => 'unchecked',
                                    ),
                                    array(
                                            'name'  => __( 'Checked', 'ninja-forms' ),
                                            'value' => 'checked',
                                    ),
				),
				'name' => 'default_value', //What should it be named. This should always be a programmatic name, not a label.
				'label' => __( 'Default Value', 'ninja-forms' ),
				'class' => 'widefat', //Additional classes to be added to the input element.
			),
            ),
            'edit_req' => false,
            'edit_help' => false,
            'display_function' => array(&$this,'spokal_subscribe_button'),
            'sidebar' => 'template_fields',
            'edit_conditional' => true,
            'conditional' => array(
			'action' => array(
				'show' => array(
					'name' => __( 'Show This', 'ninja-forms' ),
					'js_function' => 'show',
					'output' => 'show',
				),
				'hide' => array(
					'name' => __( 'Hide This', 'ninja-forms' ),
					'js_function' => 'hide',
					'output' => 'hide',
				),
				'change_value' => array(
					'name' => __( 'Change Value', 'ninja-forms' ),
					'output' => 'select',
					'options' => array(
						'Checked' => 'checked',
						'Unchecked' => 'unchecked',
					),
					'js_function' => 'change_value',

				),

			),
			'value' => array(
				'type' => 'select',
				'options' => array(
					'Checked' => 'checked',
					'Unchecked' => 'unchecked',
				),
			),
                )
        );
        
        if( function_exists( 'ninja_forms_register_field' ) ) {
            ninja_forms_register_field('spokal_subscribe', $args);
        }
    }
    
    
    
    
    public function spokal_subscribe_button($field_id, $data, $form_id = ''){
        $field_class = ninja_forms_get_field_class( $field_id, $form_id );
	$default_value = $data['default_value'];
	if($default_value == 'checked' OR $default_value == 1){
		$checked = 'checked = "checked"';
	}else{
		$checked = '';
	}

	?><input id="" name="ninja_forms_field_<?php echo $field_id;?>" type="hidden" value="unchecked" /><input id="ninja_forms_field_<?php echo $field_id;?>" name="ninja_forms_field_<?php echo $field_id;?>" type="checkbox" class="<?php echo $field_class;?>" value="checked" <?php echo $checked;?> rel="<?php echo $field_id;?>"/><?php
    }
    
    
    
    /*
     * This function only has to output the specific field element. The wrap is output automatically.
     *
     * $field_id is the id of the field currently being displayed.
     * $data is an array the possibly modified field data for the current field.
     *
    */
    public function my_new_field_display( $field_id, $data ){
        if( isset( $data['my_value'] ) ){
          $my_value = $data['my_value'];
        }else{
          $my_value = '';
        }
        ?>
        <input type="text" name="ninja_forms_field_<?php echo $field_id;?>" value="<?php echo $my_value;?>">
        <?php
    }
    
    
    
    
    public function add_wrapp_class($field_wrap_class, $field_id){
        $field = ninja_forms_get_field_by_id( $field_id );
        if($field['type'] == "spokal_company"){
            $field_wrap_class .= " text-wrap";
        }
        return $field_wrap_class;
    }    
}