<?php 

class SpokalHooks {
    
    
    
    
    public function __construct() { 
        
        $this->addActions();
        
    }
    
    
    
    
    public static function getInstance(){
        global $spokalHooks;

        if($spokalHooks == null)
                $spokalHooks = new SpokalHooks();

        return $spokalHooks;
    }
    
    
    
    
    public function addActions(){
        
        //reconection on user change password
        add_action( 'user_profile_update_errors', array(&$this, 'spokalSendNewPassword'), 0, 3 );
        
        //disabling visual editor and displaynig notice for posts added from Spokal.
        add_filter( 'user_can_richedit', array(&$this,'disableVisualEditor'),50 );
        add_action( 'admin_notices', array(&$this,'noticeForSpokalPosts') );
        
        //hooks to triger new post
        add_action('save_post', array(&$this,'trigerNewPost'),10,2);
        add_action('wp_trash_post', array(&$this,'trigerDeletePost'));
        add_action('delete_post', array(&$this,'trigerDeletePost'));
        add_action('transition_post_status',  array($this,'postStatusChanged'), 10, 3 );
        
        //hooks to triger create, delete or update category and post tag
        add_action('created_term', array(&$this,'trigerNewTerm'),10,3);
        add_action('edited_term', array(&$this,'trigerUpdateTerm'),10,3);
        add_action('delete_term', array(&$this,'trigerDeleteTerm'),10,3);
        
        //notify Spokal on plugin upgrade
        add_action('admin_init',array(&$this, 'isPluginUpgraded' ));
        
        //removing wpautop
        $wpautop = get_option('spokal_wpautop','true');
        if($wpautop !== 'false'){
            add_action( 'the_post', array( $this, 'remove_wpautop_filter' ) );
            add_action( 'loop_end', array( $this, 'back_wpautop_filter' ) );
            add_filter( 'post_class', array( $this, 'wpautop_post_class' ), 10, 3 );
        }
    }
    
    
    
    
    public function spokalSendNewPassword( $errors, $update, $user){
        if (empty( $errors->errors ) && !empty ( $_POST['pass1'] )) {
            
            if(!isset($user->ID)){return;}
            if(!isset($user->user_login)){return;}
            if($user->user_login !== 'spokal-user-do-not-delete'){return;}
            
            $options = SpokalVars::getInstance()->options;
            
            $authorizationKey = $options['authorization_key']['value'];
            $apiKey = $options['api_key']['value'];
            $accountID = $options['account_id']['value'];
            
            $args = array(
                'AccountId' => $accountID,
                'UserLogIn' => $user->user_login,
                'NewPassword' => $_POST['pass1'],
                'AuthorizationKey' => $authorizationKey,
                'ApiKey' => $apiKey,
            );  
            
            $response = SP_Request::Post_Array('/api/v1.1/Profile/ChangeWordPressPassword',$args);
        }
        
    }
    
    
    
    
    public function disableVisualEditor( $can ) {
        if(isset($_GET['post'])){
            $spokalPostMeta = get_post_meta($_GET['post'],'spokal_css_url');
            if (!empty($spokalPostMeta)){
                return false;
            }
        }
        return $can;
    }
    
    
    
    
    public function noticeForSpokalPosts(){
        if(isset($_GET['post'])){
        $spokalPostMeta = get_post_meta($_GET['post'],'spokal_css_url');
            if (!empty($spokalPostMeta)){ ?>
                    <div class="updated below-h2" style ="margin-left: 5px; margin-top: 16px;">
                        <p style="font-size:13px; font-weight: bold;">The visual editor has been disabled to preserve Spokal formatting. You can edit this post in Spokal, or in html view.</p>
                        <p style="font-size:13px; font-weight: bold;">(note that if you decide to stop using Spokal, the visual editor will be re-enabled for this post - your content is always yours.)</p>
                    </div>
                <?php
            }
        }
    }
    
    
    public function postStatusChanged($new_status, $old_status, $post)
    {
        update_post_meta($post->ID, "sp_old_status",$old_status);
    }
    
    
    public function trigerNewPost($postId, $post){
                               
        if(isset($_POST["action"]) && $_POST["action"] == "heartbeat"){
            return;
        }

        if($post->post_status === 'auto-draft'){
            return;
        }
//        if($post->post_status !== 'publish' && $post->post_status !== 'draft' && $post->post_status !== 'future'){
//            return;
//        }
        
        if(!in_array($post->post_status,array('publish','draft','future','pending'))){
            return;
        }
        
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post","page");
        if(!in_array($post->post_type,$postTypes)){
            return;
        }
    
        $meta = get_post_meta($postId,'spokal_source',true);
        if(!empty($meta) && $meta == 'spokal_editor'){
            delete_post_meta($postId, 'spokal_source');
            return;
        }
        
        $options = SpokalVars::getInstance()->options;   
        $is_connected = $options['connection_status']['value'];
        if($is_connected != "Connected"){
            return;
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        $apiKey = $options['api_key']['value'];
        $accountID = $options['account_id']['value'];
        
        $keyword_array = array();
        if(isset($_POST["sp_temp_keywords"])){
            $keyword_array = json_decode(base64_decode($_POST["sp_temp_keywords"]),true);
        }
        $keyword_string = get_post_meta($postId, 'spokal_keywords', true);
        if(!empty($keyword_string) && is_array($keyword_array) && !empty($keyword_array)){
            $keyword_id = array_search ($keyword_string, $keyword_array);
            $keyword_id = ($keyword_id === false) ? 0 : $keyword_id;
        }else{
            $keyword_id = 0;
        }
        
        //Collecting Post Focuses
        $focus_string = get_post_meta($postId, 'spokal_focuses', true);
        $focus_ids = SP_Func::get_focuses_ids($focus_string);
                
        // Getting Author name
        $author_first_name = get_the_author_meta( "first_name", $post->post_author );
        $author_last_name = get_the_author_meta( "last_name", $post->post_author );
        if(empty($author_first_name) && empty($author_last_name)){
            $author_name = get_the_author_meta( "user_login", $post->post_author );
        }
        else{
            $author_name = $author_first_name. " ". $author_last_name;
        }
        
        $metadescription = get_post_meta($postId, 'spokal_metadescription', true);
        if(!$metadescription && isset($_POST["sp_fake_meta_description"])){
            $metadescription = $_POST["sp_fake_meta_description"];
        }
        
        
        $postLength = get_post_meta($postId, 'spokal_post_lenght', true);
        $postLength = empty($postLength) ? 0 : $postLength;
        
        $args = array(
            'AccountId' => $accountID,
            'AuthorizationKey' => $authorizationKey,
            'ApiKey' => $apiKey,
            'Title' => $post->post_title,
            'Url' => get_permalink($postId),
            'Status' => ($post->post_status !== "publish") ? "draft" : $post->post_status,
            'PublishDate' => $post->post_date,
            'Id' => $postId,
            'PostType' => $post->post_type,
            'AuthorId' => $post->post_author,
            'AuthorName' => trim($author_name),
            "Metadescription" => $metadescription,
            "PrimaryFocus" => $focus_ids["pri"],
            "SecondaryFocus" => $focus_ids["sec"],
            'Keyword' => $keyword_id,
            "PostLength" => $postLength,
        );
        
        //Hardcoding this property to "true" since plugin version 2.3.3 to tell Spokal that this version of the plugin is sending "EnableRecurring" property
        //Plugins older then version 2.3.3 are not sending property "EnableRecurring"
        //Which cause that on Spokal side property "EnableRecurring" will be allways updated to false for old plugins
        //So Spokal will only update "EnableRecurring" property if "HandleRecurring" is set to "true"
        $args["HandleRecurring"] = true;
        
        //Getting Share Draft GUID
        if($post->post_status !== "publish"){
            $draft_guid = get_post_meta($postId, 'spokal_sharedraftpost', true);
            $args["ShareDraftId"] = $draft_guid;
        }
        
        // Sending Alt Title just for post types different then Page
        if($post->post_type != 'page'){
            $args['AltTitle'] = get_post_meta($postId,'spokal_alt_title',true);
        }
        
                
        //Collecting Facebook Fields
        $fb_title = get_post_meta($postId,'spokal_ogtitle',true);
        if(!$fb_title){
            $fb_title =  get_the_title( $postId );
        }
        $fb_description = get_post_meta($postId,'spokal_ogdescription',true);
        if(!$fb_description && !empty($metadescription)){
            $fb_description = $metadescription;
        }
        $args["Facebook"] = array(
                "Title" => $fb_title,
                "ImageUrl" => get_post_meta($postId, 'spokal_ogimage', true),
                "Description" => $fb_description,
                "StatusComment" => get_post_meta($postId,'spokal_facebook_status_comment',true),
            );
        
        //Collecting Twitter fields
        $tw_title = get_post_meta($postId,'spokal_twittertitle',true);
        if(!$tw_title){
            $tw_title =  get_the_title( $postId ). " [link to article]";
        }
        $args["Twitter"] = array(
                    "Title" => $tw_title,
                    "ImageUrl" => get_post_meta($postId, 'spokal_twitter_image', true),
                );
//        if(isset($args['AltTitle']) && !empty($args['AltTitle']))
//        {
//            $tw_alt_title = get_post_meta($postId,'spokal_twitter_alt_title',true);
//            if(!$tw_alt_title && isset($args['AltTitle']) && !empty($args['AltTitle'])){
//                $tw_alt_title =  $args['AltTitle']. " [link to article]";
//            }
//            $args["Twitter"]["TitleAlt"] = $tw_alt_title;
//        }
        
        //Setting Disabled Social Accounts
//        $socialAccouts = get_post_meta($postId,'spokal_social_accounts',true);
        $isRecurring = false;
        $old_status = get_post_meta($postId,'sp_old_status',true);
        if(
                ((isset($_POST["sp_from_wp_editor"]) && $_POST["sp_from_wp_editor"] === "true") || 
                ($old_status == "future" && $post->post_status == "publish")) && 
                !($old_status == "private" && $post->post_status == "publish")
          )
        {
            $socialData = SP_Func::get_spokal_account_data($postId);
            $socialAccouts = $socialData["SocialProperties"];
            
            //Checking is post enabled for recurring in WP social modal
            if(isset($_POST["sp_recurring_value"]))
            {
                $isRecurring = $_POST["sp_recurring_value"] == "true" ? true : false;
            }
            else if($old_status == "future" && $post->post_status == "publish")
            {
                $isRecurring = $socialData["IsRecurring"];
            }
            
            $disabled = array();
            $enabledSocs = array();
            if(isset($_POST["sp_disabled_soc_accounts"])){
                $disabled_string = trim($_POST["sp_disabled_soc_accounts"]);
                $disabled = array_filter(explode(",",$disabled_string));
            }

            if(isset($_POST["sp_enabled_soc_accounts"])){
                $enabled_string = trim($_POST["sp_enabled_soc_accounts"]);
                $enabledSocs = array_filter(explode(",",$enabled_string));
            }

            foreach($socialAccouts as $key => $value){
                if(in_array($value["Id"], $disabled)){
                    $socialAccouts[$key]["Disabled"] = true;
                }
                elseif(in_array($value["Id"], $enabledSocs))
                {
                    $socialAccouts[$key]["Disabled"] = false;
                }
            }
        }
        else
        {
            $socialAccouts = array();
        }
        $args["EnableRecurring"] = $isRecurring;
        $args["SocialProperties"] = $socialAccouts;
                    
        
        $response = SP_Request::Post_Json('/api/v1.1/CmsUpdate/AddPostv2',  json_encode($args));
    }
    
    
    
    
    public function trigerDeletePost($postId){
        
        if(get_post_meta( $postId, 'spokal_deleting_post', true ) === 'true'){
            return;
        }
        
        $post = get_post($postId);
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post","page");
        if(!in_array($post->post_type,$postTypes)){
            return;
        }
        
        $options = SpokalVars::getInstance()->options;        
        
        $is_connected = $options['connection_status']['value'];
        if($is_connected != "Connected"){
            return;
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        $apiKey = $options['api_key']['value'];
        $accountID = $options['account_id']['value'];

        $args = array(
            'AccountId' => $accountID,
            'AuthorizationKey' => $authorizationKey,
            'ApiKey' => $apiKey,
            'Title' => $post->post_title,
            'Url' => get_permalink($postId),
            'PostType' => $post->post_type,
            'Status' => $post->post_status,
            'Id' => $postId,
            'AuthorId' => $post->post_author,
        );  
        $response = SP_Request::Post_Array('/api/v1.1/CmsUpdate/RemovePost',$args);
    }
    
    
    
    
    public function trigerNewTerm($termId,$ttId,$taxonomy){
        
        if($taxonomy != 'category' && $taxonomy != 'post_tag'){
            return;
        }
        
        $newTerm = get_term($termId,$taxonomy);
        
        if(is_wp_error($newTerm) || empty($newTerm)){
            return;
        }
        
        $options = SpokalVars::getInstance()->options;     
        
        $is_connected = $options['connection_status']['value'];
        if($is_connected != "Connected"){
            return;
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        $apiKey = $options['api_key']['value'];
        $accountID = $options['account_id']['value'];

        $args = array(
            'AccountId' => $accountID,
            'AuthorizationKey' => $authorizationKey,
            'ApiKey' => $apiKey,
            'Type' => $taxonomy,
            'Id' => $termId,
            'Name' =>  $newTerm->name,
        ); 
        $response = SP_Request::Post_Array('/api/v1.1/CmsUpdate/AddTaxonomy',$args);        
    }
    
    
    
    
    public function trigerUpdateTerm($termId,$ttId,$taxonomy){
        
        if($taxonomy != 'category' && $taxonomy != 'post_tag'){
            return;
        }
        
        $newTaxonomy = get_term($termId,$taxonomy);
        if(is_wp_error($newTaxonomy) || empty($newTaxonomy)){
            return;
        }
        
        $options = SpokalVars::getInstance()->options;    
        
        $is_connected = $options['connection_status']['value'];
        if($is_connected != "Connected"){
            return;
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        $apiKey = $options['api_key']['value'];
        $accountID = $options['account_id']['value'];

        $args = array(
            'AccountId' => $accountID,
            'AuthorizationKey' => $authorizationKey,
            'ApiKey' => $apiKey,
            'Type' => $taxonomy,
            'Id' => $termId,
            'Name' => $newTaxonomy->name,
        ); 
        $response = SP_Request::Post_Array('/api/v1.1/CmsUpdate/UpdateTaxonomy',$args); 
    }
    
    
    
    
    public function trigerDeleteTerm($termId, $tt_id, $taxonomy){
        
        if($taxonomy != 'category' && $taxonomy != 'post_tag'){
            return;
        }
        
        $options = SpokalVars::getInstance()->options;
        
        $is_connected = $options['connection_status']['value'];
        if($is_connected != "Connected"){
            return;
        }
        
        $authorizationKey = $options['authorization_key']['value'];
        $apiKey = $options['api_key']['value'];
        $accountID = $options['account_id']['value'];

        $args = array(
            'AccountId' => $accountID,
            'AuthorizationKey' => $authorizationKey,
            'ApiKey' => $apiKey,
            'Id' => $termId,
            'Type' => $taxonomy
        ); 
        $response = SP_Request::Post_Array('/api/v1.1/CmsUpdate/RemoveTaxonomy',$args);
    }
    
    
    
    
    public function isPluginUpgraded(){
        
        $previousVersion = get_option('spokal_plugin_version','1.0');
        $currentVersion = SpokalVars::getInstance()->pluginData['Version'];

        if($previousVersion !== $currentVersion){
            //notify Spokal about plugin upgrade and update option
            do_action('spokal_plugin_upgrated');
            update_option("spokal_flush_rulles","true");
            flush_rewrite_rules();
            if(empty(SpokalVars::getInstance()->options['api_key']['value'])){return;}
            $this->notifySpokalOnPluginUpdate();
            update_option('spokal_plugin_version',$currentVersion);
        }
    }
    
    
    
    public static function notifySpokalOnPluginUpdate(){
        $options = SpokalVars::getInstance()->options; 
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
        
        $args = array(
            'AuthorizationKey' => $options['authorization_key']['value'],
            'AccountId' => $options['account_id']['value'],
            'ApiKey' => $options['api_key']['value'],
            'Version' => SpokalVars::getInstance()->pluginData['Version'],
            'SiteJsonApiEndpoint' => $jsonEndpoint,
            "ExternalCmsVersion" => get_bloginfo('version'),
        );
        
        $response = SP_Request::Post_Array('/api/v1.1/CmsUpdate/UpdatePluginVersion',$args);
    }
   
    
    
    
    
    /**
    * Add or remove the wpautop filter
    *
    * @access public
    * @param mixed $post
    * @return void
    */
    function remove_wpautop_filter( $post ) {
            if ( get_post_meta( $post->ID, 'spokal_css_url', true ) ) {
                    remove_filter( 'the_content', 'wpautop' );
                    remove_filter( 'the_excerpt', 'wpautop' );
            } else {
                    if ( ! has_filter( 'the_content', 'wpautop' ) )
                            add_filter( 'the_content', 'wpautop' );

                    if ( ! has_filter( 'the_excerpt', 'wpautop' ) )
                            add_filter( 'the_excerpt', 'wpautop' );
            }
    }

    /**
     * back_wpautop_filter function.
     * After we run our loop, everything should be set back to normal
     *
     * @access public
     * @return void
     */
    function back_wpautop_filter() {
        if ( ! has_filter( 'the_content', 'wpautop' ) )
                add_filter( 'the_content', 'wpautop' );

        if ( ! has_filter( 'the_excerpt', 'wpautop' ) )
                add_filter( 'the_excerpt', 'wpautop' );
    }

    /**
     * Add a class to posts noting whether they were passed through the wpautop filter
     *
     * @access public
     * @param mixed $classes
     * @param mixed $class
     * @param mixed $post_id
     * @return void
     */
    function wpautop_post_class( $classes, $class, $post_id ) {
        if ( get_post_meta( $post_id, 'spokal_css_url', true ) )
                $classes[] = 'no-wpautop';
        else
                $classes[] = 'wpautop';

        return $classes;
    }
}
?>