<?php

//we will wrapp it within the hooks in meanwhile
require_once(ABSPATH . '/wp-admin/includes/plugin.php');

class Spokal {
    
    
    
    
    /*
     * Constructor
     * Call: When we create instance of this class (we are doing that in spokal_init.php)
     * Use: Gets pluginDir, pluginUrl, fetch options and register necessary hooks
     */
    public function __construct($file) 
    {        
        SpokalVars::getInstance()->file = $file;
        SpokalVars::getInstance()->pluginDir = plugin_dir_path($file);
        SpokalVars::getInstance()->pluginUrl = plugin_dir_url($file);
        SpokalVars::getInstance()->pluginOptionKey = "spokal_options";
        SpokalVars::getInstance()->pluginData = get_plugin_data($file);
        
        $this->registerHooks();
        
        new SP_Settings();
        
        SpokalHooks::getInstance();
        new SpokalShareDraft();
    }
    
    /*
     * Method name: registerHooks
     * Call: In constructor of our class
     * Use: This method registers all (start point) necessary hooks
     */
    private function registerHooks()
    {
        register_activation_hook(SpokalVars::getInstance()->file, array(&$this, 'activationHook'));
        register_uninstall_hook(SpokalVars::getInstance()->file, array('Spokal', 'unistallHook'));
        register_deactivation_hook(SpokalVars::getInstance()->file, array(&$this, 'deactivationHook'));
        
        add_action('init', array(&$this, 'fetchOptions'),1);
        
        add_action('admin_menu', array(&$this, 'addOptionsPage'));
        add_action( 'admin_notices', array(&$this, 'noticeValidation' ) );
               
        
        add_action( 'edit_post_link', array(&$this, 'removeEditButton'));
        add_action('admin_init', array('Spokal', 'spokalPluginUpdate'));
        add_action( 'wp_enqueue_scripts', array('Spokal', 'includeJavascripts') );
        add_action('admin_notices', array('Spokal', 'agresiveUpdateNotification'));
        
        //LibXML2 Fix
        add_filter( 'xmlrpc_methods', array(&$this, 'spokal_libxml2_fix') );
        
        //header and footer hooks
        add_action('wp_head', array(&$this, 'wpHeadHookHandler'));
        add_action('wp_footer', array($this, 'set_spokal_cta_fields'),1);
        add_action('wp_footer', array(&$this, 'wpFooterHookHandler'),9);
        add_action('wp_footer', array(&$this, 'functionSetPiwkId'),8);
        
        //hook for deleting error_log file
        add_action('delete_error_log_file',array(&$this,'functionDeleteErrorLogFile'),10,1);
        
    }
    
    /*$_POST['option_page']
     * Method name: activationHook
     * Call: This method is going to be called when our plugin is activated
     * Use: Adding options to the options table in wordpress database
     */
    public function activationHook( $network_wide)
    {
        if($network_wide){
            $this->multisite_activate_plugin($url);
            return;
        }
        update_option("spokal_flush_rulles","true");
        foreach($this->getOptions() as $name => $option){
            if($option['database']) {
                add_option('spokal_'. $name, $option['default']);
            }
        }
        do_action('spokal_install');
    }
    
    /*
     * Method name: unistallHook
     * Call: This method is going to be called when our plugin is deactivated.
     * Use: Delete options from options table in wordpress database
     */
    public static function unistallHook()
    {
        Spokal::notifySpokalOnUnistallOrDeactivate('unistall');
    }
    
    public function deactivationHook($network_wide) 
    {
        if($network_wide){
            $this->multisite_deactivate_plugin('deactivate');
            return;
        }
        Spokal::notifySpokalOnUnistallOrDeactivate('deactivate');
    }
    
    /*
     * Method name: addOptionsPage
     * Call: In registerHooks() method -> in constructor -> every time when plugin is activated
     * Use: Ths method will add menu page (in dashboard) and will register all settings (we added) for our plugin
     */
    public function addOptionsPage()
    {
        $mypage = add_menu_page('Spokal Plugin Page', 'Spokal', 'manage_options', SpokalVars::getInstance()->pluginOptionKey, array($this, 'renderSpokalOptionsPage'), SpokalVars::getInstance()->pluginUrl."/images/small-spokey.png");

        add_action( "admin_print_scripts-$mypage", array($this, 'spokal_admin_head_scripts') );
        add_action( "admin_print_styles-$mypage", array($this, 'spokal_admin_head_styles') );

        /*
         * TODO
         * Registering settings need to be separate method, where we are going to register all
         * settings which will be avilalbe for update from dashboard
         */
        foreach($this->getOptions() as $name => $option){
            if($option['database']) {
                register_setting($option['settingsGroup'],'spokal_'. $name);
            }
        }
    }
    
    /*
     * Method name: renderSpokalOptionsPage
     * Call: In addOptionsPage method where we are hook this method to be called when plugin page is rendered
     * Use: Will display plugin page in dashboard (Will create instance of view, wich will take things in own hands)
     */
    public function renderSpokalOptionsPage()
    {
        $adminView = new SpokalAdminView();
        $adminView->render();
    }
        
    public function spokal_admin_head_styles()
    {
        wp_enqueue_style( 'spokal_front_css', SpokalVars::getInstance()->pluginUrl."css/front/spokal.min.css" , false, SpokalVars::getInstance()->pluginData['Version'], 'all' );
        wp_enqueue_style( 'spokalcss', SpokalVars::getInstance()->pluginUrl."css/admin/spokal.min.css" , false, SpokalVars::getInstance()->pluginData['Version'], 'all' );
        wp_enqueue_style( 'spcoolorpickcss', SpokalVars::getInstance()->pluginUrl."addons/colorPicker/css/colpick.min.css" , false, SpokalVars::getInstance()->pluginData['Version'], 'all' );
    }    
    
    public function spokal_admin_head_scripts() 
    {
        if(function_exists("wp_enqueue_media")){
            wp_enqueue_media();
        }
        wp_enqueue_script('spokaljs', SpokalVars::getInstance()->pluginUrl.'js/admin/spokal.min.js', array('jquery'), SpokalVars::getInstance()->pluginData['Version']);
        wp_enqueue_script('spcoolorpickcjs', SpokalVars::getInstance()->pluginUrl.'addons/colorPicker/js/colpick.min.js', array('jquery'), SpokalVars::getInstance()->pluginData['Version']);
    }
    
    public function set_spokal_cta_fields()
    {
        extract(SP_Func::post_id());
        ?>
            <script type="text/javascript">jQuery(document).ready(function(){var PostId = "<?php echo $wordpressPostId; ?>";var SubmittedURL = "<?php echo $subscribeURL; ?>";jQuery("input[name=SpokalPostId]").each(function(){this.value = PostId;});jQuery("input[name=SpokalSubmittedUrl]").each(function(){if(!this.value){this.value = SubmittedURL;}});jQuery("input[name=SpokalRedirectUrl]").each(function(){if(!this.value){this.value = SubmittedURL;}});});</script>
        <?php        
    }
    
    /*
     * Method name: getOptions
     * Call: Several calls, when ever we need to back options array
     * Use: This method will define options we are using in our plugin. If we need to add/remove/edit current
     *      options for our plugin we will do it here, in this array
     */
    private function getOptions()
    {
        return array(
            
            /*
             * Three ways to get option values:
             * 1. from database, if value is saved in database (if we have 'database' => true it will be saved)
             * 2. directly from default value
             * 3. from method (method written for this one need to return a value)
             */
            
            //options wich are going to be displayed under tab1
            'api_key' => array(         //key of the option which will be used to store option in database
                'name' => 'ApiKey',     //name of the option which will be used for a label within dashboard
                'default' => '',        //default value of option
                'type' => 'text',       //type of option
                'tabGroup' => "tab1",   //tab id where this option belongs
                'database' => true,     //are we going to store this option within database or not
                'settingsGroup' => 'spokal-settings-group'  //group for this option which we are going to use during register_setting function
            ),
            'connection_status' => array(
                'name' => 'Connection Status', 
                'default' => '', 
                'method' => 'getConnectionStatus',
                'type' => 'statictext', 
                'tabGroup' => "tab1",
                'database' => false,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'error_message' => array(
                'name' => 'ErrorMessage', 
                'default' => '', 
                'method' => 'getConnectionError',
                'type' => 'statictext', 
                'tabGroup' => "tab1",
                'database' => false,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'warning_message' => array(
                'name' => 'Warning', 
                'default' => '', 
                'method' => 'getConnectionWarning',
                'type' => 'statictext', 
                'tabGroup' => "tab1",
                'database' => false,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'cooking_disable' => array(
                'name' => 'Don\'t show CTAs once a contact has signed up', 
                'default' => 'true', 
                'type' => 'checkbox', 
                'tabGroup' => "tab1",
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            
            
            
            //options wich are going to be displayed under tab2
            'spokal_url' => array(
                'name' => 'Spokal Url', 
                'default' => 'https://app.getspokal.com/api/v1/connection', 
                'type' => 'text', 
                'tabGroup' => "tab2",
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-4'
            ),
            'remove_edit_button' => array(
                'name' => 'Remove Edit Button', 
                'default' => 'true', 
                'type' => 'checkbox', 
                'tabGroup' => "tab2",
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'wpautop' => array(
                'name' => 'Wpautop', 
                'default' => 'true', 
                'type' => 'checkbox', 
                'tabGroup' => "tab2",
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            
            
            //options wich are not displayed into admin dashboard
            'buffer_is_connected' => array(
                'name' => 'Buffer is connected', 
                'default' => "false", 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'linkedin_is_connected' => array(
                'name' => 'LinkedIn is connected', 
                'default' => "false", 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'twitter_is_connected' => array(
                'name' => 'Twitter is connected', 
                'default' => "false", 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'facebook_is_connected' => array(
                'name' => 'Facebook is connected', 
                'default' => "false", 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'social_media_enable' => array(
                'name' => 'Social Media Disable', 
                'default' => false, 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'base_url' => array(
                'name' => 'Base Url', 
                'default' => '', 
                'type' => 'text', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'auto_linking' => array(
                'name' => 'Disable Auto Linking', 
                'default' => 'false', 
                'type' => 'none', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
             'auto_linking_single_word' => array(
                'name' => "Don't auto link single word keywords", 
                'default' => 'true', 
                'type' => 'none', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            'scrollBox_footer_enable' => array(
                'name' => 'Remove Scrollbox footer', 
                'default' => 'false', 
                'type' => 'none', 
                'database' => true,
                'settingsGroup' => 'spokal-settings-group-2'
            ),
            
            'account_id' => array(
                'name' => 'AccountId', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            
            'authorization_key' => array(
                'name' => 'AuthorizationKey', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            
            'hooks_head' => array(
                'name' => 'Header Hook', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            
            'hooks_footer' => array(
                'name' => 'Footer Hook', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            
            'hooks_footer_ac' => array(
                'name' => 'Active Campaign Footer Script', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'twitter_widget_js' => array(
                'name' => 'Twitter Widget Js', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'api_url' => array(
                'name' => 'Spokal Api Url', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'scroll_box_enable' => array(
                'name' => 'Scroll Box Enable', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'smart_bar_enable' => array(
                'name' => 'Smart Bar Enable', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'exit_intent_enable' => array(
                'name' => 'Exit Intent Enable', 
                'default' => '', 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'scrollbox_turned_off' => array(
                'name' => 'Scroll Box Off', 
                'default' => array(), 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'smartbar_turned_off' => array(
                'name' => 'Scroll Box Off', 
                'default' => array(), 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'last_update' => array(
                'name' => 'Last plugin update', 
                'default' => false, 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'deactivate_last_check_date' => array(
                'name' => 'Date of last call ConnectionStatus Api', 
                'default' => "November 09, 2014, 10:30", 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'smartbar_pages' => array(
                'name' => 'Scroll Box Off', 
                'default' => array(), 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'scrollbox_pages' => array(
                'name' => 'Scroll Box Off', 
                'default' => array(), 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
            'xml_sitemaps' => array(
                'name' => 'Spokal Xml Sitemaps', 
                'default' => array(
                                'enable' => 'true',
                                'exclude_post_types' => array('attachment'),
                                'exclude_taxonomies' => array(),
                                'max_entries' => 1000,
                                'disable_user' => "true",
                                'exclude_users' => array(),
                                'no_author_user' => "true"
                            ), 
                'type' => 'none',
                'database' => true,
                'settingsGroup' => 'spokal-settings-group'
            ),
        );
    }
    
    /*
     * Method name: fetchOptions
     * Call: In constructor of this class -> wich means every time on dashboard load
     * Use: This method will acctualy fetch options, and store it in attributes of SpokalVars class
     *      wich we are using for storing our variables
     */
    public function fetchOptions()
    {
        $opts = array();

        foreach($this->getOptions() as $name => $option){
            
            /*
             * If method is provided, then we will value get from that method
             */
            if(isset($option["method"]) && !empty($option["method"])) {
                $method = $option["method"];
                if(is_callable(array($this, $method))){
                    $option['value'] = $this->$method();
                } else{
                    $option['value'] = "There is no method defined for this option!";
                }
                $opts[$name] = $option;
            }
            else {
                $value = get_option('spokal_'. $name);
                $option['value'] = empty($value) ? $option['default'] : $value;
                if($name === 'connected_user'){
                    $option['display'] = !empty($value);
                }
                $opts[$name] = $option;
            }
            
        }

        SpokalVars::getInstance()->options = $opts;
    }    
    
    public function multisite_activate_plugin(){
        if(function_exists("wp_get_sites")){
            $blogs = wp_get_sites();
        }elseif(function_exists("get_blog_list")){
            $blogs = get_blog_list();
        }
                
        foreach($blogs as $blog){
            foreach($this->getOptions() as $name => $option){
                update_blog_option($blog['blog_id'],"spokal_flush_rulles","true");
                if($option['database']) {
                    add_blog_option($blog['blog_id'],'spokal_'. $name, $option['default']);
                }
            }
        }
    }
    
    public function multisite_deactivate_plugin($disconnectType){
        if(function_exists("wp_get_sites")){
            $blogs = wp_get_sites();
        }elseif(function_exists("get_blog_list")){
            $blogs = get_blog_list();
        }
        
        wp_get_current_user();
        global $current_user;
                
        foreach($blogs as $blog){
            $account_id = get_blog_option($blog['blog_id'],"spokal_account_id",false);
            if($account_id){
                $args = array(
                    'AuthorizationKey' => get_blog_option($blog['blog_id'],"spokal_authorization_key",false),
                    'AccountId' => $account_id,
                    'DisconnectType' => $disconnectType,
                    'UserWhoDisconnectedId' => $current_user->ID,
                    'UserWhoDisconnectedDisplayName' => $current_user->user_firstname." ".$current_user->user_lastname
                );
                $response = SP_Request::Post_Json("/api/v1/disconnection",$args,$blog['blog_id']);
            }
        }
    }
    
    public static function notifySpokalOnUnistallOrDeactivate($disconnectType = "unistall" ) {
        
        wp_get_current_user();
        global $current_user;
        
        $options = SpokalVars::getInstance()->options;
        
        $disconnectApiUrl = $options['spokal_url']['value'];
        $parsingData = parse_url($disconnectApiUrl);
        $disconnectApiUrl = $parsingData['scheme']."://".$parsingData['host']."/api/v1/disconnection";
        
        $vars = array(
            'AuthorizationKey' => $options['authorization_key']['value'],
            'AccountId' => $options['account_id']['value'],
            'DisconnectType' => $disconnectType,
            'UserWhoDisconnectedId' => $current_user->ID,
            'UserWhoDisconnectedDisplayName' => $current_user->user_firstname." ".$current_user->user_lastname
        );
        
        $vars =  json_encode($vars);
        $response = SP_Request::Post_Json("/api/v1/disconnection",$vars);
    }    
    
    public function noticeValidation() {
        global $pagenow;
        if ($pagenow == 'admin.php' && $_GET['page'] =='spokal_options') { 

            if ( (isset($_GET['updated']) && $_GET['updated'] == 'true') || (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') ) {
                    
                    $jsonHandler = new JsonHandler();
                    $returnedData = $jsonHandler->HookApi();
                    
                    foreach($returnedData as $keyName => $value) {
                        if($keyName == 'Error')   {
                            update_option ('spokal_error_message', $value);
                            update_option ('spokal_connection_status', "Not connected");
                        }
                        else if($keyName == 'AccountId') {
                            update_option ('spokal_last_update', date("F d, Y, H:i"));
                            update_option ('spokal_account_id', $value);
                            update_option ('spokal_error_message', ""); //we need to resset error message
                            update_option ('spokal_connection_status', "Connected");
                        }
                    }
            }
        }
    }
    
    public function removeEditButton($link) {
        if(is_home() || is_single()) {
            if(SpokalVars::getInstance()->options['remove_edit_button']['value'] === "false") {
                return $link;
            }
            else {
                return false;
            }
        }
    }
    
    public static function headMetaInjector() {
        echo '<script type="text/javascript">var sp_ajaxurl = "'.admin_url( 'admin-ajax.php', 'relative' ).'";</script>';
        if(is_single() || is_page()) {
            global $post;
            $metaDescription = get_post_meta($post->ID, 'spokal_metadescription', true);
            $metaImage = get_post_meta($post->ID, 'spokal_ogimage', true);
            $siteName = get_bloginfo('name');
            $postLink = get_permalink($post->ID);
           
            // Grabing metafieds for titles if they exists
            $ogtitle = get_post_meta($post->ID,'spokal_ogtitle',true);
            $ogdescription = get_post_meta($post->ID,'spokal_ogdescription',true);
            $twittertitle = get_post_meta($post->ID,'spokal_twittertitle',true);
                        
            $twittertitle = SP_Func::remove_link_from_twitter($twittertitle);
            
            //setting og:title from metafield if exist
            if(!empty($ogtitle)){
                $fbTags = '<meta property="og:title" content="'.htmlspecialchars($ogtitle, ENT_QUOTES).'" />';
            }else{
                $fbTags = '<meta property="og:title" content="'.htmlspecialchars($post->post_title, ENT_QUOTES).'" />';
            }
            //these metas will be always available
            $fbTags .= '<meta property="og:url" content="'.$postLink.'" />';
            
            $twitterTags = '<meta name="twitter:url" content="'.$postLink.'" />';
            
            //setting twitter:title from metafield if exist
            if(!empty($twittertitle)){
                $twitterTags .= '<meta name="twitter:title" content="'.htmlspecialchars($twittertitle, ENT_QUOTES).'" />';
            }else{
                $twitterTags .= '<meta name="twitter:title" content="'.htmlspecialchars($post->post_title, ENT_QUOTES).'" />';
            }
                        
            if(!empty($siteName)) {
                $fbTags .= '<meta property="og:site_name" content="'.$siteName.'" />';
            }
            
            //setting og:description from metafield if exist
            if(!empty($ogdescription)){
                $fbTags .= '<meta property="og:description" content="'.htmlspecialchars($ogdescription, ENT_QUOTES).'" />';
            }
            
            if(!empty($metaDescription)) {
                echo '<meta name="description" content="'.htmlspecialchars($metaDescription, ENT_QUOTES).'" />';
            }
            
            if(!empty($metaImage)) {
                $fbTags .= '<meta property="og:image" content="'.$metaImage.'"/>';
                $twitterTags .= '<meta name="twitter:image" content="'.$metaImage.'" />';
            }elseif(has_post_thumbnail()){
                $fetured_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
                if(isset($fetured_url[0]) && (filter_var($fetured_url[0], FILTER_VALIDATE_URL) !== FALSE)){
                    $fbTags .= '<meta property="og:image" content="'.$fetured_url[0].'"/>';
                    $twitterTags .= '<meta name="twitter:image" content="'.$fetured_url[0].'">';
                }
            }
            
            if(!empty($metaImage) || !empty($ogtitle) || !empty($ogdescription) || !empty($twittertitle)){
               $fbTags .= '<meta property="og:type" content="article" />';
               $twitterTags .= '<meta name="twitter:card" content="summary" />';
            }
            $fbTags .= '<meta property="article:published_time" content="'.$post->post_date.'" />';
            
            $tags = get_the_tags($post->ID);
            if($tags) {
                foreach($tags as $tag) {
                    $fbTags .= '<meta property="article:tag" content="'.$tag->name.'" />';
                }
            }
            
            echo $fbTags;
            echo $twitterTags;
            
        }
    }
    
    public static function headCssInjector() {
        $rawCss = "";
        //then its single post
        if(is_single()) {
            global $post;
            $link = get_post_meta($post->ID, 'spokal_css_url', true);
            $rawCss = get_post_meta($post->ID, 'spokal_custom_styles', true);
            
        }
        //other pages
        else {
            $link = get_option('spokal_latest_css_url');
        }
        
        if($link) {
            if(filter_var($link, FILTER_VALIDATE_URL) !== FALSE){
                echo '<link type="text/css" rel="stylesheet" href="'.$link.'" />';
            }else{
                $upload_dir = wp_upload_dir();
                $link = $upload_dir['baseurl']."/spokal_files/".$link;
                echo '<link type="text/css" rel="stylesheet" href="'.$link.'" />';
            }
        }
        
        if(!empty($rawCss)){
            echo '<style type="text/css">'.$rawCss.'</style>';
        }
        
        if((is_single() || is_page()) && empty($rawCss)){
            echo '<style type="text/css">.optin-form-border{border: 3px solid #ccc;padding: 15px 15px;border-radius: 10px;-moz-border-radius: 10px;}</style>';
        }
    }
    
    public static function spokalPluginUpdate()  {  
        require_once ('WPAutoUpdate.php');  
        $pluginData = get_plugin_data(SpokalVars::getInstance()->file);
        $plugin_current_version = $pluginData['Version'];
        $plugin_remote_path = 'https://app.getspokal.com/spokal';  
        $plugin_slug = plugin_basename(SpokalVars::getInstance()->file); 
        if(is_admin()){
             new WPAutoUpdate ($plugin_current_version, $plugin_remote_path, $plugin_slug);
        }  
    } 
    
    public static function agresiveUpdateNotification() { 
        $updateTransient = get_site_transient( 'update_plugins' );
        $response = $updateTransient->response;
        if(is_array($response) && !empty($response)){
            foreach($response as $res){ 
               if($res->slug == "spokal_init"){ 
                   echo '<div class="updated">
                            <p><b>There is new version of Spokal plugin available. Please update your plugin.</b></p>
                        </div>';
               }
            }
        }
    }
    
    public static function includeJavascripts() {
        $options = SpokalVars::getInstance()->options;
        
        wp_enqueue_script( 'jquery' );
        
        do_action('spokal_javascripts_include');
        

        wp_enqueue_style( 'spokal_front_css', SpokalVars::getInstance()->pluginUrl."css/front/spokal.min.css" , false, SpokalVars::getInstance()->pluginData['Version'], 'all' );
        
        wp_enqueue_script('spokal_front_js', SpokalVars::getInstance()->pluginUrl . 'js/front/spokal.min.js', array('jquery'),SpokalVars::getInstance()->pluginData['Version']);
        do_action("sp_front_script_included");
    }    
    
    private function getConnectionStatus() {

        //we need to check is user logged in, and if is user on spokal page
        if(!$this->isSpokalOptionPage()) {
            return get_option("spokal_connection_status");
        }
        
        //we will fetch connection status from spokal side only if plugin claims that its connected
        
        $apiKey = get_option("spokal_api_key");
        $accountId = get_option("spokal_account_id"); 
        
        if(!$apiKey || !$accountId) {
            return "Not Connected";
        }

        $connectionStatus = "";
        if(!empty($apiKey) && !empty($accountId)) {
            $params = array(
                "apiKey"    =>  $apiKey,
                "accountId" => $accountId,
                'siteUrl' => get_site_url(),
            );
            $result = json_decode(SP_Request::GETRequest("/api/v1/connectionstatus",$params));
            update_option("spokal_deactivate_last_check_date",date("F d, Y, H:i"));
            if(isset($result->AccountId)) {
                $connectionStatus = "Connected";
            }
            else {
                $connectionStatus = "Not Connected";
            }
            
        }
        else {
            $connectionStatus = "Not Connected";
        }
        
        //Saving response to use it later like on Rendering Error field
        if(isset($result->AccountId)) {
            $accountId = $result->AccountId;
        }
        else {
            $accountId = "";
        }
        
        if(isset($result->Error)) {
            $error = $result->Error;
        }
        else {
            $error = "";
        }
        
        if(isset($result->Message)) {
            $message = $result->Message;
        }
        else {
            $message = "";
        }
        
        
        SpokalVars::getInstance()->connection_status = array(
            "account_id" => $accountId,
            "error" => $error,
            "message" => $message,
        );
        
        return $connectionStatus;
    }
    
    public static function fetchCampaigns() {
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            return "string and not array";
        }
        
        $params = array(
            "AccountId" => $accountID,
            "AuthorizationKey" => $authorizationKey
        );
        $result = SP_Request::GETRequest("/api/v1.1/Leads/LeadLists",$params);
        $decodedResult = json_decode($result, true);
        return $decodedResult;
    }
    
    private function getConnectionError() {
        if(isset(SpokalVars::getInstance()->connection_status["error"])) {
            return SpokalVars::getInstance()->connection_status["error"];
        }else{
            return get_option('spokal_error_message','');
        }
    }
    
    private function getConnectionWarning(){
        return "";
    }
    
    private function isSpokalOptionPage() {
        if(
                is_user_logged_in() && 
                current_user_can('manage_options') && 
                isset($_GET["page"]) &&
                $_GET["page"] == "spokal_options"
        ) 
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function spokal_libxml2_fix($methods) {
        global $HTTP_RAW_POST_DATA;

	// See http://core.trac.wordpress.org/ticket/7771
	if ( 
		version_compare( LIBXML_DOTTED_VERSION, '2.7.3', '<' ) 
		|| (
			LIBXML_DOTTED_VERSION == '2.7.3'
			&& version_compare( PHP_VERSION, '5.2.9', '<' )
		)
	) {
		$HTTP_RAW_POST_DATA = str_replace( '&lt;', '&#60;', $HTTP_RAW_POST_DATA );
		$HTTP_RAW_POST_DATA = str_replace( '&gt;', '&#62;', $HTTP_RAW_POST_DATA );
		$HTTP_RAW_POST_DATA = str_replace( '&amp;', '&#38;', $HTTP_RAW_POST_DATA );
	}

	return $methods;
    }
    
    /**
     * Echoes whatever the user wants in the header.
     */
    public function wpHeadHookHandler() { 
        Spokal::headMetaInjector();
        Spokal::headCssInjector();
        echo SpokalVars::getInstance()->options["hooks_head"]["value"]; 
    }
    
    public function wpFooterHookHandler() {
        
        $this->set_custom_variables();
        $this->display_tracking_script(); 
 
        if(isset(SpokalVars::getInstance()->options["hooks_footer_ac"])) {
            echo SpokalVars::getInstance()->options["hooks_footer_ac"]["value"];
        }
        
        //Outputting Twitter Widget Js for Embeded Tweets in Spokal posts
        if(SpokalVars::getInstance()->options["twitter_widget_js"]["value"]) {
            echo SpokalVars::getInstance()->options["twitter_widget_js"]["value"];
        }
    }
    
    public function set_custom_variables(){ 
        $focus = false;
        $postID = "";
        if(is_single() || is_page()){
            global $post;
            $focus = get_post_meta($post->ID,"spokal_focuses",true);
            if(isset($post->ID)){
                $postID = $post->ID;
            }
        } ?>
        <script type="text/javascript">
            function sp_set_cv(){
            <?php if(isset($_GET['sp_url'])){ ?>
                _paq.push(['setCustomVariable',1,'SP_URL','<?php echo $_GET['sp_url']; ?>','page']);
            <?php } ?>
                
            <?php if(!empty($focus)){ ?>
                _paq.push(['setCustomVariable',2,'SP_FOCUS','<?php echo $focus; ?>','page']);
            <?php } ?>
            
            <?php if(!empty($postID)){ ?>
                _paq.push(['setCustomVariable',3,'SP_POST_ID','<?php echo $post->ID; ?>','page']);
            <?php } ?>
            }
        </script>
<?php }
    
    public function check_is_site_active()
    {
        $options = SpokalVars::getInstance()->options;   
        $is_connected = $options['connection_status']['value'];
        $last_update = $options["last_update"]["value"];
        $last_check_date = $options["deactivate_last_check_date"]["value"];
        
        if($is_connected != "Connected"){
            return false;
        }
        
        if($last_update && is_string($last_update)){
            $last_update = strtotime($last_update);
            $result = (time() - (60*60*24*15)) - $last_update;
            if($result > 0){
                $last_check_date = strtotime($last_check_date);
                $is_api_called = (time() - (60*60*24)) - $last_check_date;
                if($is_api_called > 0){
                    
                    if(!$this->isSiteConnected()){
                        return false;
                    }
                }
            }
        }
        
        return true;
    }
    
    public function display_tracking_script(){
        if(SpokalVars::getInstance()->options["hooks_footer"]) {
            try{
                
                $piwik_track = SpokalVars::getInstance()->options["hooks_footer"]["value"];
                if(empty($piwik_track) || !is_string($piwik_track)){
                    return;
                }
                
                if(!$this->check_is_site_active())
                {
                    return;
                }
                
                $piwik_js = substr($piwik_track, 0,strpos($piwik_track, "<noscript>"));
                $piwik_img = substr($piwik_track,strpos($piwik_track, "<noscript>"));
                
                if(is_string($piwik_js) && is_string($piwik_img)){
                    echo $piwik_js;
                }else{
                    echo $piwik_track;
                    throw new Exception("Failed to split js and img tracking api!");
                }
                
                $piwik_img1 = substr($piwik_img,0,strpos($piwik_img, "style")-1);
                
                if(!is_string($piwik_img1)){
                    echo $piwik_img;
                    throw new Exception("Failed to cut right side of img!");
                }
                
                $piwik_img2 = substr($piwik_img1,strpos($piwik_img1, "src=")+4);
                
                if(!is_string($piwik_img2)){
                    echo $piwik_img;
                    throw new Exception("Failed to cut left side of img!");
                }
                
                $piwik_http = str_replace("'","",$piwik_img2);
                
                if(!is_string($piwik_http)){
                    echo $piwik_img;
                    throw new Exception("Failed to remove single quotes!");
                }
                
                $_cvar= "";
                if(SpokalVars::getInstance()->submitedEmail){
                    $sub_email = SpokalVars::getInstance()->submitedEmail;
                    $_cvar = "&_cvar=".urlencode('{"1":["user","'.$sub_email.'"]}');
                }elseif(isset($_COOKIE["sp_temp_email"])){
                    $sub_email = base64_decode($_COOKIE["sp_temp_email"]);
                    $_cvar = "&_cvar=".urlencode('{"1":["user","'.$sub_email.'"]}');
                }
                
                $rand = "&rand=".uniqid();
                if(!empty($piwik_http) && !preg_match('/\s/',$piwik_http) ){
                    echo "<noscript>";
                    echo "<img src='".$piwik_http.$_cvar.$rand."' style='border:0;'>";
                    echo "</noscript>";
                }else{
                    echo $piwik_img;
                }
                
            }catch (Exception $ex) {
                $exceptionMessage = $ex->getMessage();
                $repport = array(
                        'Error_from' => "Error in sanitizing piwik tracking API",
                        'Message' => $exceptionMessage
                );
            }
        }
    }
    
    public function isSiteConnected(){
        $connectionStatus = false;
        $options = SpokalVars::getInstance()->options;
        $apiKey = $options["api_key"]["value"];
        $accountId = $options["account_id"]["value"]; 
        
        if(empty($apiKey) || empty($accountId)) {
            update_option("spokal_connection_status","Not Connected");
            return false;
        }
        
        $params = array(
            "apiKey"    =>  $apiKey,
            "accountId" => $accountId 
        );
        $result = json_decode(SP_Request::GETRequest("/api/v1/connectionstatus",$params));
        update_option("spokal_deactivate_last_check_date",date("F d, Y, H:i"));
        if(isset($result->AccountId)) {
            update_option("spokal_connection_status","Connected");
            $connectionStatus = true;
        }
        else {
            update_option("spokal_connection_status","Not Connected");
            $connectionStatus = false;
        }

        return $connectionStatus;
    }
    
    public function functionSetPiwkId(){
    ?>
        <script type="text/javascript">var globalPiwikId;function spokalSavePiwikId(piwikID){globalPiwikId = piwikID;jQuery(".spokalPiwikID").val(piwikID);jQuery("input[name=SpokalPiwikId]").val(piwikID);}</script>
    <?php 
    }
    
}
?>
