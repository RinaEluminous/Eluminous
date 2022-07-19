<?php

class LeadGeneratorHandler{
    
    
    public function __construct(){
        add_action('wp_head',array(&$this, 'handleSpokalForms'));
    }
    
    
    public function handleSpokalForms(){
        if(!isset($_POST['sp_leads_form'])){
            return;
        }
        
        if(isset($_POST['form_id'])){
            $form_id = $_POST['form_id'];
        }else{
            $form_id = "";
        }
        
        if(isset($_POST['Email'])) {
            $vars['Email'] = $_POST['Email'];
            if(!$this->valid_email($vars['Email'],$form_id)){return;}
            $varsemail = $vars['Email'];
        }else{
            $vars['Email']  = "";
        }

        if(isset($_POST['SpokalPiwikId'])) {
            $vars['SpokalPiwikId'] = $_POST['SpokalPiwikId'];
        }
        
        if(isset($_POST['SpokalPostId']) && !empty($_POST['SpokalPostId'])) {
            $vars['SpokalPostId'] = $_POST['SpokalPostId'];
        }
        else {
            $vars['SpokalPostId'] = 0;
        }

        global $blog_id;
        $vars['SpokalWpSiteId'] = $blog_id;

        if(isset($_POST['FirstName'])) {
            $vars['FirstName'] = $_POST['FirstName'];
        }

        if(isset($_POST['LastName'])) {
            $vars['LastName'] = $_POST['LastName'];
        }

        if(isset($_POST['Phone']) && $_POST['Phone'] != "Phone") {
            $vars['Phone'] = $_POST['Phone'];
        }

        if(isset($_POST['Company']) && $_POST['Company'] != "Company") {
            $vars['Company'] = $_POST['Company'];
        }

        if(isset($_POST['SpokalListIdentifier'])) {
            $vars['SpokalListIdentifier'] = $_POST['SpokalListIdentifier'];
        }
        else {
            $vars['SpokalListIdentifier'] = -1;
        }
        $listIdentifier = $vars['SpokalListIdentifier'];

        if(isset($_POST['SpokalBrowserOsInfo'])) {
            $vars['SpokalBrowserOsInfo'] = $_POST['SpokalBrowserOsInfo'];
        }

        if(isset($_POST['sp_leads_form'])) {
            $vars['Source'] = $_POST['sp_leads_form'];
        }
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }

        if(isset($_SERVER["HTTP_REFERER"])) {
            $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        }

        $method = "LeadGenerator";
        if(!empty($vars['Email'])){
            SpokalVars::getInstance()->submitedEmail = $vars['Email'];
            $result = SpokalLeads::sendLeads($vars,$method);
            $this->check_response($result,$form_id);
        }
        
        SP_Func::set_lead_cookie($varsemail,$listIdentifier,$result);
    }
    
    
    public function valid_email($email,$form_id){
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        else
        {
            SpokalVars::getInstance()->form_validation = $form_id;
            return false;
        }
    }
    
    
    
    public function check_response($result,$form_id){
        
        if($result->Result != 'Success'){
            SpokalVars::getInstance()->respons_validation = array(
                                                'form_id' => $form_id,
                                                'status' => 'false'
                                            );
        }else{
            SpokalVars::getInstance()->respons_validation = array(
                                                'form_id' => $form_id,
                                                'status' => 'true'
                                            );
        }
        return;
    }
}
?>