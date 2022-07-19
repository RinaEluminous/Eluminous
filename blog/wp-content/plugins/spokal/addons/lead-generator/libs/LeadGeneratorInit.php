<?php

class LeadGeneratorInit{
    
    
    public function __construct() {
        // register LeadGeneratorWidget widget
        add_action( 'widgets_init', create_function( '', 'register_widget( "LeadGeneratorWidget" );' ) );
        // register filter to add user css class
        add_filter( "widget_display_callback", array($this, "run_before_spokal_widget_is_displayed"), 10, 3 );
        
        add_action('wp_ajax_spokal_lead_generator',array(&$this,'submitLeadGeneratorLeads'));
        add_action('wp_ajax_nopriv_spokal_lead_generator',array(&$this,'submitLeadGeneratorLeads'));

    }
    
    
    
    
    /*
     * Executing this function before widget is displayed. We want to send additional widget class with this one
     */
    public function run_before_spokal_widget_is_displayed($instance, $widget, $args)  {
        if(!isset($instance['spokalcssclassname'])){return $instance;}
        
        $widget_classname = $widget->widget_options['classname'];
        $cssClass = "";
        $cssClass = apply_filters( 'widget_title', $instance['spokalcssclassname'] );
        $args['before_widget'] = str_replace($widget_classname, "{$widget_classname} {$cssClass}", $args['before_widget']);
       
        $widget->widget($args, $instance);
        return false;
    }
    
    
    
    
    public function submitLeadGeneratorLeads(){
        $vars = array();
        $options = SpokalVars::getInstance()->options;

        if(isset($_POST['Email'])) {
            $vars['Email'] = $_POST['Email'];
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
            $vars['SpokalSource'] = $_POST['sp_leads_form'];
        }

        if(isset($_SERVER["HTTP_REFERER"])) {
            $vars['SpokalReferrerInfo'] = $_SERVER["HTTP_REFERER"];
        }
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
        
        $method = "LeadGenerator";
        if(!empty($vars['Email'])){
            $result = SpokalLeads::sendLeads($vars,$method);
        }
        SP_Func::set_lead_cookie($varsemail,$listIdentifier,$result);
        var_dump($result);

        die();
    }
}
?>