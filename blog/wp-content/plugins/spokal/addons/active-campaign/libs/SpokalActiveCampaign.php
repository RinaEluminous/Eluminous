<?php



class SpokalActiveCampaign{
    
    
    
    public function __construct($file){
       add_action('wp_footer',array(&$this,'sniffEmail'));
       add_action('wp_ajax_sendToSpokal', array(&$this, 'sendToSpokal'));
       add_action('wp_ajax_nopriv_sendToSpokal', array(&$this, 'sendToSpokal'));
         
    }
    
    
    
    
    public function sniffEmail(){
        if(isset($_GET['acemail'])){ 
            $vars = array();
            $emailEncoded = $_GET['acemail'];
            $vars['Email'] = rawurldecode($emailEncoded);
            extract(SP_Func::post_id()); ?>
            <script type="text/javascript">var Email = "<?php echo $vars['Email']; ?>";<?php if(isset(SpokalVars::getInstance()->options["hooks_footer_ac"])){if(!empty(SpokalVars::getInstance()->options["hooks_footer_ac"]["value"])){ ?>var EmailCookie = base64_encode(Email);if(document.cookie.indexOf("acemail") < 0){document.cookie = "acemail=" + EmailCookie;}<?php }}?>jQuery(document).ready(function(){function setAcInterval(){return window.setInterval(ActivCampaignLeads, 1000 );}var AcInterval = setAcInterval();function ActivCampaignLeads(){if(globalPiwikId){window.clearInterval(AcInterval);jQuery.ajax({url: '<?php echo admin_url()."admin-ajax.php"; ?>',type: "POST",data: {action : 'sendToSpokal',Email : Email,SpokalPostId: '<?php echo $wordpressPostId; ?>',SpokalPiwikId : globalPiwikId,SpokalSubmittedUrl:"<?php echo $subscribeURL;?>",SpokalBrowserOsInfo: '<?php echo $_SERVER["HTTP_USER_AGENT"]; ?>'},succes: function(spokaldata){console.log('good');},error: function(){console.log('bad');}});}}});</script>
        <?php
        }
    }
    
    
    
    
    public function sendToSpokal(){
        $options = SpokalVars::getInstance()->options;
        
        $vars = array();

        if(isset($_POST['Email'])) {
            $vars['Email'] = stripslashes($_POST['Email']);
        }else{
            $vars['Email']  = "";
        }

        if(isset($_POST['SpokalPiwikId'])) {
            $vars['SpokalPiwikId'] = $_POST['SpokalPiwikId'];
        }
        
        if(isset($_POST['SpokalPostId'])){
            $vars['SpokalPostId'] = $_POST['SpokalPostId'];
        }
        
        if(isset($_POST['SpokalBrowserOsInfo'])){
            $vars['SpokalBrowserOsInfo'] = $_POST['SpokalBrowserOsInfo'];
        }
        
        if(isset($_POST["SpokalSubmittedUrl"])){
            $vars['SpokalSubmittedUrl'] = $_POST["SpokalSubmittedUrl"];
        }else{
            $vars['SpokalSubmittedUrl'] = "";
        }
                
        $vars['SpokalSource'] = 'QueryString';
        
        global $blog_id;
        $vars['SpokalWpSiteId'] = $blog_id;
        
        $method = "ActiveCampaign";
        if(!empty($vars['Email'])){
            $result = SpokalLeads::sendLeads($vars,$method);
        }
        var_dump($result);
        die();
    }
    
    
    public function remove_acemail_query($query,$url){
        $url_data = parse_url($url);
        $query_string = $this->unset_query_string_var($query,$url_data['query']);
        $page_url_new = $url_data['scheme'].'://'.$url_data['host'].$url_data['path'];
        if (!empty($query_string)) $page_url_new .= '?'.$query_string;
        if(isset($url_data['fragment'])){$page_url_new .= $url_data['fragment'];}
        return $page_url_new;
    }
    
    
    public function unset_query_string_var($varname,$query_string) {
        $query_array = array();
        parse_str($query_string,$query_array);
        unset($query_array[$varname]);
        $query_string = http_build_query($query_array);
        return $query_string;
    }
    
    
    
    public function get_page_id(){
        if((is_single() || is_page()) && !is_home()) {
            $wordpressPostId = get_the_ID();
        }else {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $wordpressPostId = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $wordpressPostId = $this->remove_acemail_query('acemail',$wordpressPostId);
        }
        
       return $wordpressPostId;
    }
    
    
    public function get_page_URL(){
        if((is_single() || is_page()) && !is_home()) {
            $wordpressPostId = get_permalink(get_the_ID());
        }else {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $wordpressPostId = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $wordpressPostId = $this->remove_acemail_query('acemail',$wordpressPostId);
        }
        
       return $wordpressPostId;
    }
}