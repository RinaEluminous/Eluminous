<?php
class SpokalLeads
{
    
    public static function sendLeads($vars,$method)
    {
        $options = SpokalVars::getInstance()->options;
        
        $accountId = $options['account_id']['value'];
        if($accountId) {
            $vars['SpokalAccountIdExternal'] = $accountId;
        }
        else {
            $accountId = get_option('spokal_account_id',false);
            if(!$accountId){
                $vars['SpokalAccountIdExternal'] = 0;
            }
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        if($authorizationKey) {
            $vars['SpokalAuthorizationCode'] = $authorizationKey;
        }
        else {
            $authorizationKey = get_option('spokal_authorization_key',false);
            if(!$authorizationKey){
                $vars['SpokalAuthorizationCode'] = "";
            }
        }
        $varsToSend =  json_encode($vars);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        
        $result = SP_Request::Post_Json("/api/v1.1/Lead/Create",$varsToSend);
        if($result === false){
            $result = json_decode(json_encode(array('Error' => curl_error($ch))));
        }else{
            $result = json_decode($result);
        }

        if(!SpokalLeads::checkResponse($result)){
            SpokalLeads::notifySpokalAboutFailedLeads($result,$vars,$method);
        }
        return $result;
    }
    
    public static function checkResponse($result)
    {
        if(isset($result->Result)){
            if($result->Result === 'Success'){
                return true;
            }
        }
        return false;
    }
    
    public static function is_known_error($result)
    {
        $know_errors = array(
                "This lead has been submitted before to the same list, more than twice, within 12 hours. Rejecting as likely spam bot.",
                "This account is no longer active."
        );
        $tm_str = json_encode($result);
        foreach($know_errors as $error){
            if(strpos($tm_str,$error) !== false){
                return true;
            }
        }
        
        return false;
    }
    
    public static function notifySpokalAboutFailedLeads($result,$vars,$method)
    {
        if(!SpokalLeads::callSpokalLeadErrorApi($result,$vars,$method)){
            SpokalLeads::sendEmailToSpokal($result,$vars,$method);
        }
    }
    
    public static function callSpokalLeadErrorApi($result,$vars,$method)
    {
        $options = SpokalVars::getInstance()->options;
        $is_known = SpokalLeads::is_known_error($result);
        if($is_known)
        {
            return true;
        }
        
        date_default_timezone_set('Canada/Eastern');
        $repport = array(
            'AcountID' => $vars['SpokalAccountIdExternal'],
            'LeadsFromURL' => SpokalLeads::getCurrentLeadsUrl($vars),
            'ErrorMessage' => print_r($result,true),
            'LeadsMethod' => $method,
            'Leads' => $vars,
            'Time' => date("F d, Y, H:i")
        ); 
       
        $args = array('Error' => json_encode($repport));
        $output = SP_Request::Post_Array('/api/v1.1/CmsUpdate/ErrorNotification',$args);

        if($output === false){
            $output = curl_error($ch);
        }else{
            $output = json_decode($output);
        }
        if(isset($output->Result)){
            if($output->Result === 'Successfully logged'){
                return true;
            }
        }
        
        return false;
    }
    
    public static function sendEmailToSpokal($result,$vars,$method)
    {
        $message = '<div>'
                        .'<h1>Leads Failed</h1>'
                        .'<p><strong>Account ID: </strong>'.$vars['AccountIdExternal'].'</p>'
                        .'<p><strong>Leads from URL: </strong>'.SpokalLeads::getCurrentLeadsUrl($vars).'</p>'
                        .'<p><strong>Error message: </strong>'.print_r($result,true).'</p>'
                        .'<p><strong>Leads Method: </strong>'.$method.'</p>'
                        .'<p><strong>Leads: </strong>'.print_r($vars,true).'</p>'
                    .'</div>';
        $headers = 'From: Spokal <heretohelp@getspokal.com>' . "\r\n";
        $recipients = array(
            'chris@getspokal.com',
            'jasmin.trbalic@gmail.com'
        );
        add_filter( 'wp_mail_content_type', array('SpokalLeads','set_html_content_type'));
        wp_mail($recipients,'A lead from a wp site failed to be sent to Spokal',$message,$headers);
        remove_filter( 'wp_mail_content_type', array('SpokalLeads','set_html_content_type'));
    }
    
    public static function set_html_content_type() 
    {
	return 'text/html';
    }
    
    public static function getCurrentLeadsUrl($vars)
    {
        if(isset($vars['PostId'])){
            $url = $vars['PostId'];
            
            if($url === 'ActiveCampaign'){
                return get_home_url();
            }
            if(filter_var($url, FILTER_VALIDATE_URL) !== FALSE){
                return $url;
            }else{
                $url =  get_permalink($url);
                if(filter_var($url, FILTER_VALIDATE_URL) !== FALSE){
                    return $url;
                }else{
                    return get_home_url();
                }
            }
        }else{
            return get_home_url();
        }
    }  
    
    public static function collect_sp_fields($_post, $source)
    {
        $vars = array();
        
        if(isset($_post['Email']) && is_email($_post['Email'])) {
            $vars['Email'] = $_post['Email'];
        }else{
            $vars['Email'] = "";
        }

        if(isset($_post['SpokalPiwikId'])) {
            $vars['SpokalPiwikId'] = $_post['SpokalPiwikId'];
        }

        if(isset($_post['SpokalPostId']) && !empty($_post['SpokalPostId'])) {
            $vars['SpokalPostId'] = $_post['SpokalPostId'];
        }
        else {
            $vars['SpokalPostId'] = 0;
        }

        global $blog_id;
        $vars['SpokalWpSiteId'] = $blog_id;

        if(isset($_post['FirstName'])) {
            $vars['FirstName'] = $_post['FirstName'];
        }

        if(isset($_post['LastName'])) {
            $vars['LastName'] = $_post['LastName'];
        }

        if(isset($_post['Phone']) && $_post['Phone'] != "Phone") {
            $vars['Phone'] = $_post['Phone'];
        }

        if(isset($_post['Company']) && $_post['Company'] != "Company") {
            $vars['Company'] = $_post['Company'];
        }

        if(isset($_post['SpokalListIdentifier']) && !empty($_post['SpokalListIdentifier'])) {
            $vars['SpokalListIdentifier'] = $_post['SpokalListIdentifier'];
        }
        else {
            $vars['SpokalListIdentifier'] = -1;
        }
        

        if(isset($_post['SpokalBrowserOsInfo'])) {
            $vars['SpokalBrowserOsInfo'] = $_post['SpokalBrowserOsInfo'];
        }


        $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        
        $vars['SpokalSource'] = $source;
        
        if(isset($_post["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_post["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        return $vars;
    }
    
}


class SpokalAdminUser
{
    
    /**
     * Username of Spokal admin Username
     * @access public
     * @var string
     */
    public $spokal_username = 'spokal-user-do-not-delete';
    
    
    public function __construct(){
        
    }
    
    
    
    
    public function createSpokalAdminUser(){
        
        if(is_multisite()){
            $this->spokal_username = 'spokal-user-do-not-delete-'.get_current_blog_id();
        }else{
            $this->spokal_username = 'spokal-user-do-not-delete';
        }
        
        $spokalUser = get_user_by( 'login', $this->spokal_username );
        if($spokalUser !== false && isset($spokalUser->ID)){
            $spokalUser = $this->updatePassword($spokalUser);
            return $spokalUser;
        }
        
        $spokalUser = $this->createUser();

        return $spokalUser;
    }
    
    
    
    
    public function updatePassword($spokalUser){
        $password = wp_generate_password(20,true,true);
        wp_set_password( $password, $spokalUser->ID );
        $spokalUser->password = $password;
        $spokalUser = $this->checkSpokalUser($spokalUser);
        return $spokalUser;
    }
    
    
    
    public function createUser(){
        $password = wp_generate_password(20,true,true);
        $userdata = array(
            'user_login'  =>  $this->spokal_username,
            'user_pass'   =>  $password,
            'role' => 'administrator'
        );
        $spokalUser = wp_insert_user( $userdata );
        
        if ( is_wp_error( $spokalUser ) ) 
        {
            return array("Error" => $spokalUser->get_error_message());
        }
        else
        {
            $spokalUser = get_user_by( 'id' , $spokalUser );
            if($spokalUser === false){
                return array("Error" => 'Unable to get details of user: "spokal-user-do-not-delete".');
            }else{
                $spokalUser->password = $password;
                return $this->checkSpokalUser($spokalUser);
            }
        }
    }
    
    
    
    
    public function checkSpokalUser($spokalUser){
        $aprrove = get_user_meta($spokalUser->ID, "aiowps_account_status", true);
        
        if(!empty($aprrove))
        {
            update_user_meta( $spokalUser->ID, "aiowps_account_status", "");
        }
        $user = wp_authenticate($this->spokal_username, $spokalUser->password);
        if (is_wp_error($user)) {
            $result['Error'] = 'There is a problem. It appears a security plugin may be interfering with the connection to Spokal.<br><br> We are getting this error message:<br>"'.$user->get_error_message().'" <br><br>Please ensure the user "spokal-do-not-delete" is permitted through your security plugin.';
            return $result;
        }else{
            return $spokalUser;
        }
    }
}


class SP_Request
{
    public static function Post_Array($api,$args)
    {
        $spokalRequirements = SpokalRequirements::getInstance();
        if($spokalRequirements->isMissingRequirement("cURL")){
            return json_encode(array("Error" => "Curl is not instaled!"));
        }
        
        $options = SpokalVars::getInstance()->options;
        $url = SP_Request::base_url().$api;
        
        $postData = '';
        //create name value pairs seperated by &
        foreach($args as $k => $v) { 
           $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');
        
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
    public static function Post_Json($api,$vars,$blogId="")
    {
        $spokalRequirements = SpokalRequirements::getInstance();
        if($spokalRequirements->isMissingRequirement("cURL")){
            return json_encode(array("Error" => "Curl is not instaled!"));
        }
        
        $url = SP_Request::base_url($blogId).$api;
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    public static function GETRequest($api, $params) 
    {
        $spokalRequirements = SpokalRequirements::getInstance();
        if($spokalRequirements->isMissingRequirement("cURL")){
            return json_encode(array("Error" => "Curl is not instaled!"));
        }
        
        $options = SpokalVars::getInstance()->options;
        $url = SP_Request::base_url().$api;
        /* Update URL to container Query String of Paramaters */
        $url .= '?' . http_build_query($params);
        
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    public static function TestRequest($url, $params) {
        return "ok";
    }
        
    public static function base_url($blogId="")
    {
        if($blogId){
            $base_url = get_blog_option($blogId,"spokal_base_url",false);
            $base_url = ($base_url) ? $base_url : get_blog_option($blogId,"spokal_api_url",false);
            $base_url = ($base_url) ? $base_url : "";
            $base_url = str_replace("/api/v1.1", "", $base_url);
            return $base_url;
        }
        $options = SpokalVars::getInstance()->options;
        if(empty($options)){
            $base_url = get_option("spokal_base_url",false);
            $base_url = ($base_url) ? $base_url : get_option("spokal_api_url",false);
            $base_url = ($base_url) ? $base_url : "";
            $base_url = str_replace("/api/v1.1", "", $base_url);            
        }else{
            if(!empty($options["base_url"]["value"])){
                $base_url = $options["base_url"]["value"];
            }elseif($options["api_url"]["value"]){
                $base_url = str_replace("/api/v1.1", "", $options["api_url"]["value"]);
            }else{
                $base_url = "";
            }
        }
        return $base_url;
    }
}


class SP_Func
{
    
    public static function post_id()
    {
        if((is_single() || is_page()) && !is_home()) {
            $wordpressPostId = get_the_ID();
            $subscribeURL = get_permalink(get_the_ID());
        }else{
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $wordpressPostId = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $subscribeURL = $wordpressPostId;
        }
        
        if(function_exists("is_shop")){
            if(is_shop()) {
                $shopID = get_option( 'woocommerce_shop_page_id');
                if($shopID){
                    $wordpressPostId = $shopID;
                }
            } 
        }
        return array("wordpressPostId" => $wordpressPostId,"subscribeURL" => $subscribeURL);
    }
    
    /*
     * Getting primary focus for post
     */
    public static function get_focuses_ids($focus_string)
    {
        $result = array("pri" => 0,"sec" => 0);
        if(empty($focus_string)){return $result;}
        
        $focus_array = explode(",",$focus_string);
        foreach($focus_array as $focus){
            if(strpos($focus,"pri-") !== false){
                $result["pri"] = str_replace("pri-", "", $focus);
            }
            if(strpos($focus,"sec-") !== false){
                $result["sec"] = str_replace("sec-", "", $focus);
            }
        }
        return $result;
    }
    
    public static function isPluginActive($pluginName)
    {
        return (SP_Func::isPluginSingleActive($pluginName) || SP_Func::spPluginNetworkActive($pluginName));
    }
    
    public static function isPluginSingleActive($pluginName)
    {
        
        $activePlugins = get_option('active_plugins');
        if(is_array($activePlugins)){
            foreach($activePlugins as $plugin){
                if(strpos($plugin,$pluginName)){
                    return true;
                }
            }
        }
        return false;
    }    
    
    public static function spPluginNetworkActive($pluginName)
    {
        if ( !is_multisite() )
	    return false;
	
        $plugins = get_site_option( 'active_sitewide_plugins');
        if(is_array($plugins)){
            foreach($plugins as $key => $plugin){
                if(strpos($key,$pluginName)){
                    return true;
                }
            }
        }
        return false;
    }
    
    public static function set_lead_cookie($email, $leadList, $status)
    {
        if(isset(SpokalVars::getInstance()->options["hooks_footer_ac"])) {
             if(!empty(SpokalVars::getInstance()->options["hooks_footer_ac"]["value"])){ 
                if(isset($email)){
                    if(!empty($email)){
                        $emailCookie = base64_encode( $email );
                        if(!isset($_COOKIE['acemail'])){
                            setrawcookie("acemail",$emailCookie, time()+ (30000*36000), '/', '.'.$_SERVER['HTTP_HOST']);
                        }
                    }
                }

            }
         }  

        if(isset($leadList) && isset($status)){
            if(!empty($leadList) && !empty($status)){
                if($status->Result === 'Success'){

                    if(!isset($_COOKIE['sp_lists'])){

                        $cookieNew = base64_encode(json_encode(array($leadList))); 
                        setcookie("sp_lists",$cookieNew, time()+ (30000*36000), '/');                        

                    }else{

                        $cookieOld = json_decode(base64_decode($_COOKIE['sp_lists']));
                        if(!in_array($leadList, $cookieOld)){
                            $cookieOld[] = $leadList;
                            $cookieOld = base64_encode(json_encode($cookieOld)); 
                            setcookie("sp_lists",$cookieOld, time()+ (30000*36000), '/');
                        }

                    }
                }
            }
        }
    }
    
    public static function remove_link_from_twitter($twitter)
    {
        $twitter = str_replace("[link to article]", "", $twitter);
        $regex = '"https?://(-\.)?([^\s/?\.#]+\.?)+(/[^\s]*)?"';
            
        $html_links = preg_replace($regex, '', $twitter);
        
        return trim($html_links);
    }
    
    public static function get_spokal_account_data($post_ID)
    {
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            SpokalVars::getInstance()->focuses = array();
            return false;
        }
        
        $params = array(
                "AccountId" => $accountID,
                "AuthorizationKey" => $authorizationKey,
                "PostId" => $post_ID
            );
        
        $result = SP_Request::GETRequest("/api/v1.1/CmsUpdate/GetExternalEditorData",$params);
        $result = json_decode($result,true);
       
        $social_properties = array();
        $social_properties["SocialProperties"] = array();
        $social_properties["IsRecurring"] = false;
        
        if(isset($result["PostLevel"]))
        {
            $postData = $result["PostLevel"];
            if(isset($postData["SocialProperties"]) && is_array($postData["SocialProperties"])){
                $socialProp = $postData["SocialProperties"];
                if(isset($socialProp["Result"]) && !empty($socialProp["Result"]))
                {
                    $social_properties["SocialProperties"] = $socialProp["Result"];
                }
            }
            
            if(isset($postData["IsRecurring"])){
                $social_properties["IsRecurring"] = $postData["IsRecurring"];
            }
        }
        
        return $social_properties;
        
    }
}
?>