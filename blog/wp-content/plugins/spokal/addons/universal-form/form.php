<?php 

        //Old WP HTML form was redired to this file which collect fields and send them to Spokal
        //The WP HTML form is changed and now it submitting the leads directly to Spokal URL
        //We are going to keep this file because some users can still use the old WP HTML form
        //But in future this can be probably removed. 
        require_once("../../../../../wp-load.php");
        $varsemail = '';
        $options = SpokalVars::getInstance()->options;
        
        //collecting name
        if(isset($_REQUEST['FirstName']) && !is_email($_REQUEST['FirstName'])){
            $vars['FirstName'] = $_REQUEST['FirstName'];
        }elseif(isset($_REQUEST['name']) && !is_email($_REQUEST['name'])){
            $vars['FirstName'] = $_REQUEST['name'];
        }else{
            $vars['FirstName'] = '';
        }
        
        
        //collecting name
        if(isset($_REQUEST['LastName']) && !is_email($_REQUEST['LastName'])){
            $vars['LastName'] = $_REQUEST['LastName'];
        }else{
            $vars['LastName'] = '';
        }
        
        if($vars['FirstName'] === $vars['LastName']){
            $vars['LastName'] = "";
        }
        
        //collecting email
        if(isset($_REQUEST['Email'])){
            $vars['Email'] = $_REQUEST['Email'];
            $varsemail = $vars['Email'];
        }elseif(isset($_REQUEST['email'])){
            $vars['Email'] = $_REQUEST['email'];
            $varsemail = $vars['Email'];
        }else{
            $vars['Email'] = '';
        }
        
        if(isset($_REQUEST['Company']) && !is_email($_REQUEST['Company'])){
            $vars['Company'] = $_REQUEST['Company'];
        }elseif(isset($_REQUEST['company']) && !is_email($_REQUEST['company'])){
            $vars['Company'] = $_REQUEST['company'];
        }else{
            $vars['Company'] = '';
        }
        
        
        if(isset($_REQUEST['Phone']) && !is_email($_REQUEST['Phone'])){
            $vars['Phone'] = $_REQUEST['Phone'];
        }elseif(isset($_REQUEST['phone']) && !is_email($_REQUEST['phone'])){
            $vars['Phone'] = $_REQUEST['phone'];
        }else{
            $vars['Phone'] = '';
        }
        
        
        
        // Collecting piwik id
        // We relased new Html Form with changed input field name for piwik id to "SpokalPiwikId",
        // so we need to handle both forms, old one with old input name "PiwikId" and new one with input name "SpokalPiwikId"
        // This is because some user can still have set up old Html form
        if(isset($_REQUEST['PiwikId']) && !empty($_REQUEST['PiwikId'])) {
            // Getting value from old Html form for piwik id
            $vars['SpokalPiwikId'] = $_REQUEST['PiwikId'];
            
        }elseif(isset($_REQUEST['SpokalPiwikId']) && !empty($_REQUEST['SpokalPiwikId']) ){
            // Getting value from new Html form for piwik id
            $vars['SpokalPiwikId'] = $_REQUEST['SpokalPiwikId'];
        }
        else {
            $vars['SpokalPiwikId'] = "";
        }
        
        
        // Collecting wordpresss post id.
        // We relased new Html Form with changed input field name for post id to "SpokalPostId", so we need to handle
        // both forms, old one with old input name "PostId" and new one with input name "SpokalPostId"
        // This is because some user can still have set up old Html form
        if(isset($_REQUEST['PostId']) && !empty($_REQUEST['PostId'])) {
            // Getting value from old Html form for post id
            $vars['SpokalPostId'] = $_REQUEST['PostId'];
            
        }elseif(isset($_REQUEST['SpokalPostId']) && !empty($_REQUEST['SpokalPostId'])){
            // Getting value from new Html form for post id
            $vars['SpokalPostId'] = $_REQUEST['SpokalPostId'];
        }
        else {
            $vars['SpokalPostId'] = 0;
        }
        
        if(isset($_REQUEST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_REQUEST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        
        if(isset($_REQUEST['SpokalListIdentifier']) && !empty($_REQUEST['SpokalListIdentifier'])) {
            $vars['SpokalListIdentifier'] = $_REQUEST['SpokalListIdentifier'];
        }elseif(isset($_REQUEST['ListIdentifier']) && !empty($_REQUEST['ListIdentifier'])) {
            $vars['SpokalListIdentifier'] = $_REQUEST['ListIdentifier'];
        }
        else {
            $vars['SpokalListIdentifier'] = -1;
        }
        $listIdentifier = $vars['SpokalListIdentifier'];
        
        //collecting wordpress blog id
        $vars['SpokalWpSiteId'] = get_current_blog_id();

        //collecting browser info
        $vars['SpokalBrowserOsInfo'] = $_SERVER["HTTP_USER_AGENT"];


        //collecting referer info
        $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        
        $vars['SpokalSource'] = 'WpHtml';  
        
        $vars["IsFromOldForm"] = true; 
        
        $method = "WpHtml";
        if(!empty($vars['Email'])){
            $resutl = SpokalLeads::sendLeads($vars,$method);
            $sub_email = base64_encode( $vars['Email'] );
            setcookie("sp_temp_email",$sub_email, time()+ 2, '/');
        }
        SP_Func::set_lead_cookie($varsemail,$listIdentifier,$resutl);

         if(isset($_REQUEST['redirectUrl'])){
            $redirectUrl = $_REQUEST['redirectUrl'];
            if(filter_var($redirectUrl, FILTER_VALIDATE_URL) !== FALSE){
                header("Location: ".$redirectUrl);
                die();
            }
        }
        
        if(isset($_REQUEST['SpokalPostId'])){
            $url = $_REQUEST['SpokalPostId'];

            if(filter_var($url, FILTER_VALIDATE_URL) !== FALSE){
                header("Location: ".$url);
                die();
            }else{
                $url =  get_permalink($url);
                if(filter_var($url, FILTER_VALIDATE_URL) !== FALSE){
                    header("Location: ".$url);
                    die();
                }
            }
        }
        header("Location: ".get_home_url());
        die();
    
?>