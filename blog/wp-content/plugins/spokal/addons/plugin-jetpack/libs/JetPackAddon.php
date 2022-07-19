<?php

class JetPackAddon {
    
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
        $this->leadList = -1;
        $this->getCampaigns();
        self::registerHooks();
    }
    
    
    
    
    private function registerHooks(){
        //adding jetpack hook action only if jetpack plugin is activated
        add_action('grunion_pre_message_sent',array(&$this,'sendJetPackFormToSpokal'),10, 3);
        add_action('wp_footer',array(&$this, 'createHiddenFieldInJetPack'),8);

    }
    
    
    
    
    public function sendJetPackFormToSpokal($post_id, $all_values, $extra_values){
        $options = SpokalVars::getInstance()->options;
        $vars = array();
        $postID = '';
        
        $jetpack_disabled = get_option("spokal_disable_jetpack",false);
        if($jetpack_disabled == "true"){
            return;
        }
        
        //Collecting additional fields starts here
        
        $counter = 1;
        $additionalFields = array();
        foreach($all_values as $key => $value){
            $newKey = str_replace($counter.'_','',$key);
            $counter++;
            if(strpos($key,'Email')) {continue;}
            if(strpos($key,'First Name')) {continue;}
            if(strpos($key,'Last Name')) {continue;}
            if(strpos($key,'Phone')) {continue;}
            if(strpos($key,'Company')) {continue;}
            if(empty($value)){continue;}       
            
            $additionalFields[$newKey] = $value;
        }
        if(!empty($additionalFields)) {
            $vars["AdditionalProperties"] = json_encode($additionalFields);
        }
        
        //Collecting aditional fields ends here
        
        if(isset($_POST['contact-form-id'])){
            $postID = $_POST['contact-form-id'];

            if(isset($_POST['g'.$postID.'-firstname'])){
                $vars['FirstName'] = $_POST['g'.$postID.'-firstname'];
            }else{
                $vars['FirstName'] = '';
            }

            if(isset($_POST['g'.$postID.'-lastname'])){
                $vars['LastName'] = $_POST['g'.$postID.'-lastname'];
            }else{
                $vars['LastName'] = '';
            }

            if(isset($_POST['g'.$postID.'-email'])){
                $vars['Email'] = $_POST['g'.$postID.'-email'];
                $this->email = $vars['Email'];
            }else{
                $vars['Email'] = '';
            }

            if(isset($_POST['g'.$postID.'-company'])){
                $vars['Company'] = $_POST['g'.$postID.'-company'];
            }else{
                $vars['Company'] = '';
            }     

            if(isset($_POST['g'.$postID.'-phone'])){
                $vars['Phone'] = $_POST['g'.$postID.'-phone'];
            }else{
                $vars['Phone'] = '';
            }     
        }
        
        if(empty($postID) || !isset($vars['Email']) || empty($vars['Email'])){
            
            foreach ($all_values as $key => $value){

                if(strpos($key,'Email')){
                    $vars['Email'] = $value;
                    $this->email = $vars['Email'];
                }else{
                    $vars['Email'] = '';
                }

                if(strpos($key,'First Name')){
                     $vars['FirstName'] = $value;
                }

                if(strpos($key,'Last Name')){
                    $vars['LastName'] = $value;
                }

                if(strpos($key,'Phone')){
                    $vars['Phone'] = $value;
                }

                if(strpos($key,'Company')){
                    $vars['Company'] = $value;
                }
                
            }
            
        }
        
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

        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        
        //collecting referer info
        $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        
        $lead_list = get_option("spokal_jetpack_lead_lists",false);
        
        if($lead_list == false){
            $vars['SpokalListIdentifier'] = $this->leadList;
        }
        else{
             $vars['SpokalListIdentifier'] = $lead_list;
             $this->leadList = $lead_list;
        }
                
        $vars['SpokalSource'] = 'Jetpack';
        
        $method = "Jetpack";
        if(!empty($vars['Email'])){
            $this->status = SpokalLeads::sendLeads($vars,$method);
            $sub_email = base64_encode( $vars['Email'] );
            setcookie("sp_temp_email",$sub_email, time()+ 2, '/');
        }
        
        SP_Func::set_lead_cookie($this->email,$this->leadList,$this->status);
                 
    }
    
    public function createHiddenFieldInJetPack(){
        
        if(!SP_Func::isPluginActive("jetpack.php")){
            return;
        }
        extract(SP_Func::post_id()); ?>

        <script type="text/javascript">jQuery(document).ready(function(){jQuery(".contact-form.commentsblock").append('<input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>"><input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">');});jQuery(".contact-form.commentsblock").append('<input id="SpokalPiwikID" name="SpokalPiwikId" type="hidden">');</script>
        
        <?php
    }
    
    
    
    
    public function getCampaigns(){
        if(!SP_Func::isPluginActive("jetpack.php")){
            return;
        }  
        
        $spokalCampaigns = get_option('spokal_current_campaigns');
        if(is_array($spokalCampaigns)){
            if(isset($spokalCampaigns['Lists'])){
                $spokalCampaign = $spokalCampaigns['Lists'];

                if(is_array($spokalCampaign)){
                    foreach($spokalCampaign as $key => $value){
                        if($value === 'default'){
                            $this->leadList = $key;
                        }
                    }
                }
            }
        }     
        
    }    

}