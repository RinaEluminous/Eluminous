<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JsonHandler
 *
 * @author Korisnik
 */
class JsonHandler {
    
    
    public function HookApi($spokalApiKey,$spokalUser = false) {
        $spokalRequirements = SpokalRequirements::getInstance();
        if($spokalRequirements->isMissingRequirement("cURL")){
            return array('Error' => 'Curl is not installed!');
        }
        
        wp_get_current_user();
        global $current_user;
        
        //getting information for SpokalAdminUser
        $SpokalAdminUserId = isset($spokalUser->ID) ? $spokalUser->ID : "";
        $SpokalAdminUserLogin = isset($spokalUser->user_login) ? $spokalUser->user_login : "";
        $SpokalAdminUserPassword= isset($spokalUser->password) ? $spokalUser->password : "";
 
        $options = SpokalVars::getInstance()->options;
        
        $spokalEndpointUrl = $options["spokal_url"]["value"];
        
        $plugInVersion = get_plugin_data(SpokalVars::getInstance()->file);
        
        $pluginUrl = SpokalVars::getInstance()->pluginUrl;
        $permalinks =  get_option('permalink_structure') ? true : false;
        
        $jsonEndpoint = $pluginUrl."request.php";
        
        if($permalinks)
        {
            $url = get_site_url().'/spokal/api/';
            $response = SP_Request::TestRequest($url, array("sp_check" => "true"));
            
            if($response == "ok")
            {
                $jsonEndpoint = $url;
            }
        }
        
        $vars = json_encode (
                array(
                    'ApiKey' => $spokalApiKey,
                    'SiteUrl' => get_site_url(),
                    'SiteApiEndpoint' => get_site_url()."/xmlrpc.php",
                    'CmsType' => 'Wordpress',
                    'SiteVersion' => get_bloginfo('version'),
                    'SiteJsonApiEndpoint' => $jsonEndpoint,
                    'PluginVersion' => $plugInVersion['Version'], 
                    'AdminUserLogin' => $current_user->user_login,
                    'AdminUserId' => $current_user->ID,
                    'AdminUserDisplayName' => $current_user->display_name,
                    'SpokalAdminUserId' => $SpokalAdminUserId,
                    'SpokalAdminUserLogin' => $SpokalAdminUserLogin,
                    'SpokalAdminUserPassword' => $SpokalAdminUserPassword,
                    "BlogId" => get_current_blog_id()
                )
        );

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $spokalEndpointUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        
        if($result === false){
            
            return array('Error' => curl_error($ch));
            
        }elseif(!is_object(json_decode($result))){
            
            return array('Error' => 'Bad Response');
            
        }
        
        return json_decode($result); 
    }
    
    
}

?>
