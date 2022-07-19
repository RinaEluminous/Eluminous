<?php

class ContactForm7Addon {
    
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
        //adding contact from 7 hook action only if contact form7 plugin is activated
        add_action('wpcf7_mail_sent', array(&$this, 'sendContactForm7ToSpokal'),10,1);
        add_action('wp_footer',array(&$this, 'createHiddenFieldInCF7'),8);

    }
    
    
    
    public function sendContactForm7ToSpokal($cf7){
        $options = SpokalVars::getInstance()->options;
        $hasSubscribeField = false;
        $tags = array();
        
        if(method_exists( $cf7 , 'form_scan_shortcode' ))
        {
            if(is_callable(array($cf7, 'form_scan_shortcode')))
            {
                $tags = $cf7->form_scan_shortcode();
            }
        }
        
        if(is_array($tags) && !empty($tags))
        {
            foreach($tags as $value)
            {
                if(isset($value['basetype']) && isset($value['name']))
                {
                    if($value['basetype'] == 'checkbox' && $value['name'] == 'subscribe')
                    {
                        $hasSubscribeField = true;
                    }
                }          
            }
        }
        
        $formId = $cf7->id;
        $usedForms = get_option('spokal_cf7_and_spokal_forms');
        $campaignsAssociated = get_option("spokal_cf7_form_lead_list");
        
        if(is_array($usedForms)){
            if(!in_array($formId, $usedForms)) {
                return;
            }
        }else{
            return;
        }
        
        $vars = array();
        
        /*
         * Collecting value of Contact Form 7 fields
         * ------------------------------------------------------
         */ 
        
        
        //Collecting Additional Fields
        
        $_data = $_POST;
        $additionalFields = array();
        foreach($_data as $key => $value){
            if($key == 'email') {continue;}
            if($key == 'fname') {continue;}
            if($key == 'lname') {continue;}
            if($key == 'company') {continue;}
            if($key == 'phone') {continue;}
            if($key == 'SpokalPiwikId') {continue;}
            if($key == 'SpokalPostId') {continue;}
            if($key == 'SpokalSubmittedUrl') {continue;}
            if(strpos($key,'_wpcf7') !== false) {continue;}
            if(strpos($key,'_wpnonce') !== false) {continue;}
            if(empty($value)){continue;}
            
            $newKey = ucfirst($key);
            $newKey = str_replace('_',' ',$newKey);
            $newKey = str_replace('-',' ',$newKey);
            $additionalFields[$newKey] = $value;
        }
        if(!empty($additionalFields)) {
            $vars["AdditionalProperties"] = json_encode($additionalFields);
        }
        
        //Collecting aditional fields ends here
        
        
        //Collecting First Name
            if(isset($_POST['fname'])){
                $vars['FirstName'] = $_POST['fname'];
            }else{
                $vars['FirstName'] = '';
            }

        //Collecting Last Name
            if(isset($_POST['lname'])){
                $vars['LastName'] = $_POST['lname'];
            }else{
                $vars['LastName'] = '';
            }
            
        //Collecting Email
            if(isset($_POST['email'])){
                $vars['Email'] = $_POST['email'];
                $this->email = $vars['Email'];
            }else{
                $vars['Email'] = '';
            }
 
        //Collecting Company
            if(isset($_POST['company'])){
                $vars['Company'] = $_POST['company'];
            }else{
                $vars['Company'] = '';
            }     

        //Collecting Phone
            if(isset($_POST['phone'])){
                $vars['Phone'] = $_POST['phone'];
            }else{
                $vars['Phone'] = '';
            }
            
            if($hasSubscribeField){
                if(!isset($_POST['subscribe'])){
                    $vars['SpokalTrackOnly'] = true;
                }
            }
        
        /*
         * Collecting value of Contact Form 7 fields ends here
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

        $this->leadList = $vars['SpokalListIdentifier'];
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        $vars['SpokalSource'] = 'ContactForm7';
        
        $method = "ContactForm7";
        if(!empty($vars['Email'])){
            $this->status = SpokalLeads::sendLeads($vars,$method); 
        }        
        SP_Func::set_lead_cookie($this->email,$this->leadList,$this->status);
         
         
    }
 
    public function createHiddenFieldInCF7(){
        
        if(!SP_Func::isPluginActive("wp-contact-form-7.php")){
            return;
        }
        extract(SP_Func::post_id()); ?>

        <script type="text/javascript">jQuery(document).ready(function(){jQuery(".wpcf7-form").append('<input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>"><input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">');});jQuery(".wpcf7-form").append('<input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden">');</script>
        <?php
    }
}