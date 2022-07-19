<?php

class SP_Settings
{
    
    public function __construct()
    {
        //for each tab which have an options we will have different ajax function
        add_action('wp_ajax_handling_forms_via_ajax', array($this, 'connect_spokal_account'));
        add_action('wp_ajax_handling_sp_main_settings', array($this, 'sp_main_settings'));
        add_action('wp_ajax_handling_second_form_via_ajax', array($this, 'addvanced_settings'));
        add_action('wp_ajax_handling_third_form_via_ajax', array($this, 'gravity_forms_settings'));
        add_action('wp_ajax_handling_fifth_form_via_ajax', array($this, 'cf7_settings'));
        add_action('wp_ajax_handling_tenth_form_via_ajax', array($this, 'ninja_forms_settings'));
        add_action('wp_ajax_handling_jetpack_settings_form', array(this, 'jetpack_settings'));
        add_action('wp_ajax_generate_HMLForm', array($this, 'wp_html_form_settings'));
        add_action('wp_ajax_generate_3rdPartyHMLForm', array($this, 'third_party_html_form_settings'));
        add_action('wp_ajax_generate_NetHMLForm', array(&$this, 'net_html_form_settings'));
        add_action('wp_ajax_handling_clearLeadListCookieForm', array($this, 'clear_lead_list_cookie'));
        add_action('wp_ajax_handling_xml_sitemaps_form', array($this, 'xml_sitemaps_settings'));
        add_action('wp_ajax_sp_clear_cache_action', array($this, 'sp_clear_cache_action'));
        add_action('wp_ajax_handling_form_error_log', array($this, 'error_log_settings'));
    }
    
    
    
    /*
     * Ajax function which will save API key and connect with Spokal account
     */
    public function connect_spokal_account() 
    {
        if(isset($_POST['option_page'])) {
            $optionsPage = $_POST['option_page'];
        }
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        if(isset($_POST['_wp_http_referer'])) {
            $wphttpRefer = $_POST['_wp_http_referer'];
        }
        
        if(isset($_POST['spokal_api_key'])) {
            $spokalApiKey = $_POST['spokal_api_key'];
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-options' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_api_key', $spokalApiKey);
        
        //get Spokal User from the database
        $SpokalAdminUser = new SpokalAdminUser();
        $spokalUser =  $SpokalAdminUser->createSpokalAdminUser();
        
        if(is_array($spokalUser) && isset($spokalUser['Error'])){
            $returnedData = $spokalUser;
        }else{
            //we need to call json to connect with spokal server
            $jsonHandler = new JsonHandler();
            $returnedData = $jsonHandler->HookApi($spokalApiKey,$spokalUser);
        }
         
        //error or success
        $responseType = "";
        $responseMessage = "";
        $response_warning = "";
        foreach($returnedData as $keyName => $value) {
            if($keyName == 'Error' || $keyName == 'Message')   {
                $responseType = "Error";
                $responseMessage = $value;
                update_option ('spokal_error_message', $value);
                update_option ('spokal_connection_status', "Not connected");
            }
            else if($keyName == 'AccountId') {
                $responseType = "Success";
                update_option ('spokal_last_update', date("F d, Y, H:i"));
                update_option ('spokal_account_id', $value);
                update_option ('spokal_error_message', ""); //we need to resset error message
                update_option ('spokal_connection_status', "Connected");
            }
            else if($keyName == 'Warning') {
                if(($value !== NULL) && !empty($value)){
                   $response_warning = $value; 
                }
            }
        }
        
        $resultarray = array(
            'response_type' => $responseType,
            'response_message' => $responseMessage,
            "response_warning" => $response_warning,
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
        
    }
    
    /*
     * Ajax function which will save settings under Account tab
     */
    public function sp_main_settings()
    {
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        if(isset($_POST['_wp_http_referer'])) {
            $wphttpRefer = $_POST['_wp_http_referer'];
        }
        
        if(isset($_POST['sp_social_media_enable'])) {
            $spokalMediaEnable = true;
        }else{
            $spokalMediaEnable = false;
        }
        
        if(isset($_POST['spokal_cooking_disable'])){
            $enableCookingLeads = true;
        }
        
        if(isset($enableCookingLeads)){
            update_option('spokal_cooking_disable','true');
        }else{
            update_option('spokal_cooking_disable','false');
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-options-b' )) {
            die("Permission denied!");
        }
        
        update_option('spokal_social_media_enable', $spokalMediaEnable);
        $resultarray = array("status" => $_POST);
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function jetpack_settings()
    {
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-55-options' )) {
            die("Permission denied!");
        } 
        
        if(isset($_POST['disable_jetpack'])){
            $disable_jetpack = true;
        }
        
        if(isset($_POST['jetpack_form_campaign'])){
            update_option('spokal_jetpack_lead_lists',$_POST['jetpack_form_campaign']);
        }else{
            update_option('spokal_jetpack_lead_lists',false);
        }
        
        if(isset($disable_jetpack)){
            update_option('spokal_disable_jetpack','true');
        }else{
            update_option('spokal_disable_jetpack','false');
        }        
        
        $resultarray = array("status" => true);
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function sp_clear_cache_action()
    {
        
        if(function_exists("wp_cache_flush")){
            wp_cache_flush();
        }
        
        $resultarray = array(
            'status' => "Cache Cleared"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function addvanced_settings() 
    {
        
        if(isset($_POST['option_page'])) {
            $optionsPage = $_POST['option_page'];
        }
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        if(isset($_POST['_wp_http_referer'])) {
            $wphttpRefer = $_POST['_wp_http_referer'];
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-2-options' )) {
            die("Permission denied!");
        }
        
        
        if(isset($_POST['spokal_spokal_url'])) {
            $spokalEndpointUrl = $_POST['spokal_spokal_url'];
        }
        
        
        if(isset($_POST['spokal_remove_edit_button'])) {
            $removeEditButton = true;
        }
        
        if(isset($_POST['spokal_wpautop'])){
            $spokalWPautop = true;
        }
        
        if(isset($spokalWPautop)) {
            update_option('spokal_wpautop', "true");
        }
        else {
            update_option('spokal_wpautop', "false");
        }
        
        if($spokalEndpointUrl){
           update_option('spokal_spokal_url', $spokalEndpointUrl); 
        }
        
        if(isset($removeEditButton)) {
            update_option('spokal_remove_edit_button', "true");
        }
        else {
            update_option('spokal_remove_edit_button', "false");
        }
        
        $resultarray = array(
            'status' => "success"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function gravity_forms_settings() 
    {
         
        if(isset($_POST['option_page'])) {
            $optionsPage = $_POST['option_page'];
        }
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-3-options' ) ||
             $optionsPage != "spokal-settings-group-3"
          ) {
            die("Permission denied!");
        }
        
        //clear option to allow disable form
        if(get_option('spokal_gravity_and_spokal_forms')){
            update_option('spokal_gravity_and_spokal_forms','');
        }
        
        if(isset($_POST['gravity_and_spokal'])){
            $gForms = array();
            foreach($_POST['gravity_and_spokal'] as $gravityForm){
                $gForms[] = $gravityForm;
            }
            update_option('spokal_gravity_and_spokal_forms', $gForms);
        }
        
         //clear option to allow disable or change lead list
        if(get_option('spokal_gravity_form_lead_list')){
            update_option('spokal_gravity_form_lead_list','');
        }
        if(method_exists('RGFormsModel', 'get_forms')){
            $forms = RGFormsModel::get_forms( null, 'title' );
            if(!empty($forms) && is_array($forms)) {
                $campaigns = array();
                foreach( $forms as $form ){
                    $postKey = "gravity_form_campaign_".$form->id;
                    if(isset($_POST[$postKey])) {
                        $campaigns[$form->id] = $_POST[$postKey];
                    }
                }
                update_option('spokal_gravity_form_lead_list', $campaigns);
            }
        }
        
        $resultarray = array(
            'status' => "success"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function ninja_forms_settings()
    {
        if(isset($_POST['option_page'])) {
            $optionsPage = $_POST['option_page'];
        }
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-10-options' ) ||
             $optionsPage != "spokal-settings-group-10"
          ) {
            die("Permission denied!");
        }
        
        //clear option to allow disable form
        if(get_option('spokal_ninja_and_spokal_forms')){
            update_option('spokal_ninja_and_spokal_forms','');
        }
        
        if(isset($_POST['ninja_and_spokal'])){
            $gForms = array();
            foreach($_POST['ninja_and_spokal'] as $gravityForm){
                $gForms[] = $gravityForm;
            }
            update_option('spokal_ninja_and_spokal_forms', $gForms);
        }
        
         //clear option to allow disable or change lead list
        if(get_option('spokal_ninja_form_lead_list')){
            update_option('spokal_ninja_form_lead_list','');
        }
        if(function_exists ('ninja_forms_get_all_forms')){
            $forms = ninja_forms_get_all_forms();
            if(!empty($forms) && is_array($forms)) {
                $campaigns = array();
                foreach( $forms as $form ){
                    $postKey = "ninja_form_campaign_".$form['id'];
                    if(isset($_POST[$postKey])) {
                        $campaigns[$form['id']] = $_POST[$postKey];
                    }
                }
                update_option('spokal_ninja_form_lead_list', $campaigns);
            }
        }
        
        $resultarray = array(
            'status' => "success"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function xml_sitemaps_settings()
    {
        $options = array();
        
        update_option("spokal_flush_rulles","true");
        
        if(isset($_POST['enable'])){
            $options['enable'] = "true";
        }else{
            $options['enable'] = "false";
        }
        
        if(isset($_POST['max_entries'])){
            $options['max_entries'] = $_POST['max_entries'];
        }else{
            $options['max_entries'] = 1000;
        }
        
        if(isset($_POST['disable_user'])){
            $options['disable_user'] = "true";
        }else{
            $options['disable_user'] = "false";
        }
        
        if(isset($_POST['exclude_post_types'])){
            $options['exclude_post_types'] = $_POST['exclude_post_types'];
        }else{
            $options['exclude_post_types'] = array('attachment');
        }
        
        if(isset($_POST['exclude_taxonomies'])){
            $options['exclude_taxonomies'] = $_POST['exclude_taxonomies'];
        }else{
            $options['exclude_taxonomies'] = array();
        }
        
        if(isset($_POST['exclude_users'])){
            $options['exclude_users'] = $_POST['exclude_users'];
        }else{
            $options['exclude_users'] = array();
        }
        
        if(isset($_POST['no_author_user'])){
            $options['no_author_user'] = "true";
        }else{
            $options['no_author_user'] = "false";
        }
        
        $sp_sitemaps_admin = Spokal_Sitemaps_Admin::getInstance();
        $sp_sitemaps_admin->clear_sitemap_cache();
        update_option('spokal_xml_sitemaps',$options);
        
        $resultarray = array(
            'status' => "success"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
    
    
    
    public function cf7_settings() 
    {
         
        if(isset($_POST['option_page'])) {
            $optionsPage = $_POST['option_page'];
        }
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-group-5-options' ) ||
             $optionsPage != "spokal-settings-group-5"
          ) {
            die("Permission denied!");
        }
        
        
        //clear option to allow disable form
        if(get_option('spokal_cf7_and_spokal_forms')){
            update_option('spokal_cf7_and_spokal_forms','');
        }
        
        
        if(isset($_POST['cf7_and_spokal'])){
            $cf7Forms = array();
            foreach($_POST['cf7_and_spokal'] as $cf7Form){
                $cf7Forms[] = $cf7Form;
            }
            update_option('spokal_cf7_and_spokal_forms', $cf7Forms);
        }
        
        
        //clear option to allow disable or change lead list
        if(get_option('spokal_cf7_form_lead_list')){
            update_option('spokal_cf7_form_lead_list','');
        }
        
        
        if(method_exists('WPCF7_ContactForm','find')){
            $forms = WPCF7_ContactForm::find( array('orderby' => 'title',) );
            $campaigns = array();
            if(!empty($forms) && is_array($forms)) {
                foreach( $forms as $form ){
                    $postKey = "cf7_form_campaign_".$form->id;
                    if(isset($_POST[$postKey])) {
                        $campaigns[$form->id] = $_POST[$postKey];
                    }
                }
                update_option('spokal_cf7_form_lead_list', $campaigns);
            }
        }
        
        $resultarray = array(
            'status' => "success"
        );
        
        header('Content-type: application/json');
        echo json_encode($resultarray);
        die();
    }
   
    
    
    public function error_log_settings()
    {

        $homePath = get_home_path();
        $wpConfigPath = $homePath."wp-config.php";
        $errorLogFile = $homePath.'php-errors.log';
        $wpConfigContent = "\n \n//Enabling Error Log - Added by Spokal \nini_set('log_errors', 'On'); \n" . "ini_set('error_log', '".$errorLogFile."');";
        $resultWriteWpConfig = true;
        $results = array(
            'status' => true,
            'message' => 'Error Log is Enabled.<br />Please reload your page to see error logs.',
        );
       
        $resultCreateErrorLog = fopen($errorLogFile, 'a');
        if($resultCreateErrorLog != false){
            
            wp_schedule_single_event( time() + 3600, 'delete_error_log_file' ,array($errorLogFile));
            
            if(!strpos(file_get_contents($wpConfigPath),"ini_set('log_errors', 'On');")){
                if(is_writable($wpConfigPath)){
                    $wpConfigFile = file_get_contents($wpConfigPath);
                    
                    if(strpos($wpConfigFile, "?>") === false){
                        $resultWriteWpConfig = file_put_contents($wpConfigPath,$wpConfigContent,FILE_APPEND);
                    }else{
                        $results = array(
                            'status' => false,
                            'message' => "There appears to be a problem with the WordPress configuration file on this site. We can't activate error logging until this is fixed.",
                        );
                    }
                    
                }
                else{
                    if(file_exists($errorLogFile)){
                        unlink($errorLogFile);
                    }
                    $results['status'] = false;
                    $results['message'] = 'File wp-config.php does not exist or is not writable!';
                }
            }
            
            fclose($resultCreateErrorLog);
            
            if($resultWriteWpConfig == false){
                if(file_exists($errorLogFile)){
                    unlink($errorLogFile);
                }
                $results['status'] = false;
                $results['message'] = 'Unable to write in wp-config.php!<br />Please check permission on wp-config.php.';
            }
            
            if($results['status'] === false){
                if(file_exists($errorLogFile)){
                    unlink($errorLogFile);
                }
            }
            
        }
        else{
            $results['status'] = false;
            $results['message'] = 'Failed to create error log file!<br />Please check your permision on root folder.';
        }
        
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    
    public function functionDeleteErrorLogFile($fileToDelete)
    {
        if(file_exists($fileToDelete)){
            if(!unlink($fileToDelete)){
              wp_schedule_single_event( time() + 3600, 'delete_error_log_file' ,array($fileToDelete));
            }
        }
    }
    
    
    
    public function wp_html_form_settings()
    {
        $results = array();
        $redUrl = '';
        $chosenList = $_POST['html_form_leadList'];
        if(isset($_POST['enableWpRedirectUrl'])){
            if(isset($_POST['wpRedirectUrl'])){
                $redUrl = $_POST['wpRedirectUrl'];
            }
        }
        $htmlForm = self::generate_html_from($chosenList,"WpHtml", $redUrl);
        
        header('Content-type: application/json');
        $results['form']= $htmlForm;
        echo json_encode($results);
        die();
    }
    
    
    
    public function third_party_html_form_settings()
    {
        $results = array();
        $chosenList = $_POST['html_form_leadList'];
        if(isset($_POST['enableWpRedirectUrl'])){
            if(isset($_POST['wpRedirectUrl'])){
                $redUrl = $_POST['wpRedirectUrl'];
            }
        }
        $htmlForm = self::generate_html_from($chosenList,"HtmlForm", $redUrl);
        
        header('Content-type: application/json');
        $results['form']= $htmlForm;
        echo json_encode($results);
        die();
    }
    
    
    
    public static function generate_html_from($leadListId, $source, $redUrl)
    {
        $options = SpokalVars::getInstance()->options;
        $authorizationKey = $options['authorization_key']['value'];
        $acountId = $options['account_id']['value'];
        if(!empty($options["base_url"]["value"])){
            $optin_url = $options["base_url"]["value"]."/Lead/Create";
        }elseif($options["api_url"]["value"]){
            $optin_url = str_replace("/api/v1.1", "/Lead/Create", $options["api_url"]["value"]);
        }else{
            $optin_url = "https://app.getspokal.com/Lead/Create";
        }
        $form ='<div style="padding-top:15px;">'
                . '<textarea rows="11" cols="100" readonly="" onclick="this.select();" style="background: white; resize: none; width: 100%;">'
                . '<form action="'.$optin_url.'"  method="post" onsubmit="sp_set_fields()">'
                .'<input id="SpokalEmail" type="email" placeholder="Email" name="Email" value="" >'
                    .'<input id="SpokalFirstName" type="text" placeholder="First Name" name="FirstName" value="" >'
                    .'<input id="SpokalLastName" type="text" placeholder="Last Name" name="LastName" value="" >'
                    .'<input id="SpokalCompany" type="text" placeholder="Company" name="Company" value="" >'
                    .'<input id="SpokalPhone" type="text" placeholder="Phone" name="Phone" value="" >'
                    .'<input id="SpokalPiwikId" type="hidden" name="SpokalPiwikId" value="">'
                    .'<input id="SpokalPostId" type="hidden" name="SpokalPostId" value="">'
                    .'<input id="SpokalAuthorizationCode" type="hidden" name="SpokalAuthorizationCode" value="'.$authorizationKey.'">'
                    .'<input id="SpokalAccountIdExternal" type="hidden" name="SpokalAccountIdExternal" value="'.$acountId.'" >'
                    .'<input id="SpokalSource" type="hidden" name="SpokalSource" value="'.$source.'">'
                    .'<input id="SpokalRedirectUrl" type="hidden" name="SpokalRedirectUrl" value="'.$redUrl.'">'
                    .'<input type="hidden" name="SpokalSubmittedUrl" value="">'
                    .'<input id="SpokalListIdentifier" type="hidden" name="SpokalListIdentifier"  value="'.$leadListId.'">'
                    .'<input id="SpokalSubmitButton" type="submit" name="SpokalSubmitButton"  value="Register" />'
                .'</form>'
                . '</textarea>'
                . '</div>';
        return $form;
    }
    
    
    
    public function net_html_form_settings()
    {
        if ( isset( $_POST[ 'successMessage' ] ) ) {
            $instance[ 'successMessage' ] = $_POST[ 'successMessage' ];
        }
        
        if ( isset( $_POST[ 'invalidEmailMessage' ] ) ) {
            $instance[ 'invalidEmailMessage' ] = $_POST[ 'invalidEmailMessage' ];
        }
        
        if ( isset( $_POST[ 'failMessage' ] ) ) {
            $instance[ 'failMessage' ] = $_POST[ 'failMessage' ];
        }
        
        if ( isset( $_POST[ 'buttonText' ] ) ) {
            $instance[ 'buttonText' ] = $_POST[ 'buttonText' ];
        }
        
        if ( isset( $_POST[ 'hmlBoxFirstName' ] ) ) {
            $instance[ 'collectfirstname' ] = true;
        }else{
            $instance[ 'collectfirstname' ] = false;
        }
        
        if ( isset( $_POST[ 'htmlBoxLastName' ] ) ) {
            $instance[ 'collectlastname' ] = true;
        }else{
            $instance[ 'collectlastname' ] = false;
        }
        
        if ( isset( $_POST[ 'htmlBoxPhone' ] ) ) {
            $instance[ 'collectphone' ] = true;
        }else{
            $instance[ 'collectphone' ] = false;
        }
        
        if ( isset( $_POST[ 'htmlBoxCompany' ] ) ) {
            $instance[ 'collectcompany' ] = true;
        }else{
            $instance[ 'collectcompany' ] = false;
        }
        
        if ( isset( $_POST[ 'enableRedirectUrl' ] ) ) {
            $instance[ 'enableRedirectUrl' ] = true;
        }else{
            $instance[ 'enableRedirectUrl' ] = false;
        }
        
        if ( isset( $_POST[ 'redirectUrl' ] ) ) {
            $instance[ 'redirectUrl' ] = $_POST[ 'redirectUrl' ];
        }else{
            $instance[ 'redirectUrl' ] = "";
        }
        
        if ( isset( $_POST[ 'firstNamePlaceholder' ] ) ) {
            $instance[ 'firstNamePlaceholder' ] = $_POST[ 'firstNamePlaceholder' ];
        }
        
        if ( isset( $_POST[ 'lastNamePlaceholder' ] ) ) {
            $instance[ 'lastNamePlaceholder' ] = $_POST[ 'lastNamePlaceholder' ];
        }
        
        if ( isset( $_POST[ 'phonePlaceholder' ] ) ) {
            $instance[ 'phonePlaceholder' ] = $_POST[ 'phonePlaceholder' ];
        }
        
        if ( isset( $_POST[ 'companyPlaceholder' ] ) ) {
            $instance[ 'companyPlaceholder' ] = $_POST[ 'companyPlaceholder' ];
        }
        
        if(isset($_POST[ 'net_html_form_leadList' ])) {
            $instance[ 'campaign' ] = $_POST[ 'net_html_form_leadList' ];
        }
        
        if(isset($_POST[ 'net_html_form_leadList' ])) {
            $instance[ 'campaign' ] = $_POST[ 'net_html_form_leadList' ];
        }else{
            $instance[ 'campaign' ] = -1;
        }
        
        extract($instance);
        
        if($enableRedirectUrl){
            $urlToRedirect = $redirectUrl;
        }else{
            $urlToRedirect = "";
        }
        
        $options = SpokalVars::getInstance()->options;
        
        if(!empty($options["base_url"]["value"])){
            $optin_url = $options["base_url"]["value"]."/api/v1.1/Lead/Create";
        }elseif($options["api_url"]["value"]){
            $optin_url = str_replace("/api/v1.1", "/api/v1.1/Lead/Create", $options["api_url"]["value"]);
        }else{
            $optin_url = "https://app.getspokal.com/api/v1.1/Lead/Create";
        }
        
        
        $authorizationKey = $options['authorization_key']['value'];
        $acountId = $options['account_id']['value'];
        $piwikJs = $options['hooks_footer']['value'];
        
        $htmlForm = '<div style="padding-top:15px;">
            <textarea rows="11"  readonly onClick="this.select();" style="background: white; resize: none; width: 100%;">
            <div class="spokalHtmlForm_wrapper">
                <div id="spokalHtmlForm">
                    <form id="spokalLeadsForm" name="spokalForm" action="'.$optin_url.'" target="spokalIframe" method="post">
                        <div class="field_row">
                            <input id="SpokalEmail" type="email" name="Email" value="" placeholder="Email" >
                        </div>';
        
            if($collectfirstname){
                $htmlForm .= '
                        <div class="field_row">
                            <input id="firstname" type="text" name="FirstName" value="" placeholder="'.$firstNamePlaceholder.'">
                        </div>';
            }
            if($collectlastname){
                $htmlForm .= '
                        <div class="field_row">
                            <input id="lastname" type="text" name="LastName" value="" placeholder="'.$lastNamePlaceholder.'">
                        </div>';
            }
            if($collectcompany){
                $htmlForm .= '
                        <div class="field_row">
                            <input id="company" type="text" name="Company" value="" placeholder="'.$companyPlaceholder.'">
                        </div>';
            }
            if($collectphone){
                $htmlForm .= '
                        <div class="field_row">
                            <input id="phone" type="text" name="Phone" value="" placeholder="'.$phonePlaceholder.'">
                        </div>';
            }
            if(strpos($piwikJs,'spokalSavePiwikId') !== false){
                 $postIdJs = '<script type="text/javascript">document.getElementById("SpokalPostId").value = window.location.href;document.getElementById("SpokalSubmittedUrl").value = window.location.href;</script>';
                 $piwikIdJs = '<script type="text/javascript">var globalPiwikId;function spokalSavePiwikId(piwikID){globalPiwikId = piwikID;document.getElementById("SpokalPiwikId").value = piwikID;}</script>';
                 $piwikJs = $postIdJs.$piwikIdJs.$piwikJs;
            }elseif(strpos($piwikJs,'var spokalPluginCodes;') !== false){
                $piwikJs = str_replace('var spokalPluginCodes;', "_spaq.push(['setAuthCode', '".$authorizationKey."']);_spaq.push(['setAccountId', ".$acountId."]);", $piwikJs);
            }
        
        $htmlForm .= '
                        <div class="hiddenFields">
                            <input id="SpokalPiwikId" type="hidden" name="SpokalPiwikId" value="">
                            <input id="SpokalAuthorizationCode" type="hidden" name="SpokalAuthorizationCode" value="'.$authorizationKey.'">
                            <input id="SpokalAccountIdExternal" type="hidden" name="SpokalAccountIdExternal" value="'.$acountId.'" >
                            <input id="SpokalSource" type="hidden" name="SpokalSource" value="NonWpHtml">
                            <input id="SpokalListIdentifier" type="hidden" name="SpokalListIdentifier"  value="'.$campaign.'">
                            <input id="SpokalPostId" type="hidden" name="SpokalPostId" value="">
                            <input id="SpokalSubmittedUrl" type="hidden" name="SpokalSubmittedUrl" value="">
                        </div>

                        <input type="button" name="SpokalSubmitButton" id="SpokalSubmitButton" value="'.$buttonText.'" />
                    </form>
                    <div id="HtmlSuccesMessage"></div>
                    <div id="HtmlErrorMessage" ></div>
                </div>
                <iframe style="display:none;" name="spokalIframe" src=""></iframe>
                
                <script type="text/javascript">
                    var redirectUrl = "'.$urlToRedirect.'";
                    function validateEmail(email) { 
                        var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,22}/i;
                        return re.test(email);
                    } 
                    function handleTheForm() {
                        var userEMail = document.getElementById("SpokalEmail").value;
                        if(validateEmail(userEMail)){
                            document.spokalForm.submit();
                            if (redirectUrl) {
                                setTimeout(function() {
                                    window.location = redirectUrl;
                                }, 600);
                            }
                            document.spokalForm.reset();
                            document.getElementById("HtmlErrorMessage").innerHTML = "";
                            document.getElementById("HtmlSuccesMessage").innerHTML = "'.$successMessage.'";
                        }else{
                            document.getElementById("HtmlSuccesMessage").innerHTML = "";
                            document.getElementById("HtmlErrorMessage").innerHTML = "'.$invalidEmailMessage.'";
                        }
                    }
                    document.getElementById("SpokalSubmitButton").addEventListener("click", function() {
                        handleTheForm();
                    }, false);
                    document.getElementById("spokalLeadsForm").addEventListener("keypress", function(e) {
                        var key = e.which || e.keyCode;
                        var enterKey = 13;
                        if (key == enterKey) {
                            handleTheForm();
                        }
                    });
                </script>
                '.$piwikJs.'
            </div>
            </textarea>
        </div>';
        
        header('Content-type: application/json');
        $results['form']= $htmlForm;
        echo json_encode($results);
        die();
    }
    
    
    
    public function clear_lead_list_cookie()
    {
        
        if(isset($_POST['_wpnonce'])) {
            $wpNonce = $_POST['_wpnonce'];
        }
        
        //we need to save our data into database...
        if(!isset($wpNonce) || !wp_verify_nonce( $wpNonce, 'spokal-settings-clearLeadListCookieForm' )) {
            die("Permission denied!");
        }
        setcookie("sp_lists", "", time()-3600, '/');
        $results = array(
                    'status' => true,
        );
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
}