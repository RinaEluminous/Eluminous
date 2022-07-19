<?php
/**
 * Spokal GZIP/Json API for communaction with Spokal production server.
 *
 * @author Jasmin Trbalic <jasmin.trbalic@gmail.com>
 * @version 2.0
 * @package Spokal
 */  
class SpokalGzipAPI {
            
    
    /**
     * An array which contain names of available Spokal json APIs
     * @access private
     * @var array 
     */
    private $actions = array(
        "getPostSummaries",
        "setBlogOptions",
        "getOptions",
        "newPost",
        "editPostv2",
        "getPost",
        "getAllContent",
        "getAvailablePostTypeNames",
        "createUser",
        "uploadCss",
        "uploadFile",
        "getTerms",
        "deletePost",
        "getUsers",
        "getUrlForPost",
        "checkUser",
    );
    
    
    /**
     * An array which contain all possible error messages in API
     * @access private
     * @var array 
     */
    private $messages = array(
        "construct" => array(
            0 => "Something is wrong. Really wrong!",
            1 => "Please insert valid action and try again.",
            2 => "There is no action defined. Default action is called",
            3 => "Zlib support for PHP is not enabled.",
            4 => "Received data in wrong format."
        ),
        "login" => array(
            0 => "Authentication failed!",
            1 => "Mcrypt is not installed!",
            2 => "Mbstring is not installed!"
        )
    );
    
    
    /**
     * Default return from Spokal json API
     * @access private
     * @var array 
     */
    private $resultArray = array(
        "status"    => false,
        "message"   => "",
        "result"    => null
    );
    
    
    /**
     * String which will contain name of requested API
     * @access private
     * @var string
     */
    private $action = "";
    
    
    /**
     * An array which will contain authentication details on requesting API
     * @access private
     * @var array 
     */
    private $authentication = array();
    
    
    /**
     * An array which will contain payload data of requested API
     * @access private
     * @var array 
     */
    private $payload = array();
    
    
    /**
     * Contains name of requested API type
     * @access private
     * @var string 
     */
    private $api_type = "";
    
    
    
    public function __construct($oldPath = false) 
    {
        try 
        {
            $this->includeWpFiles($oldPath);
            
            if(!$this->isValidAction() && !$this->validate_data()) 
            {
                throw new Exception($this->messages["construct"][1]);
            }
            else 
            {
                $this->runAction();
            }
        }
        catch(Exception $e) 
        {
            $this->resultArray["message"] = $e->getMessage();
            $this->resultArray["status"] = false;
            $this->sendResponse();
        }
    }
    
    
    
    private function includeWpFiles($oldPath)
    {
        if (ini_get('display_errors')) {
            ini_set('display_errors', 'off');
        }
                
        if($oldPath)
        {
            require_once('../../../wp-admin/includes/image.php');
            require_once('../../../wp-admin/includes/post.php');
            require_once('../../../wp-load.php');
        }
        else
        {
            require_once(ABSPATH.'/wp-admin/includes/image.php');
            require_once(ABSPATH.'/wp-admin/includes/post.php');
        }
    }
    
    
    
    /**
     * Checks whether the data is are correct and if so it will decode data and set up {@link $action} {@link $authentication} {@link $payload}
     * @return bool
     */
    public function validate_data()
    {
        if ( !isset( $HTTP_RAW_POST_DATA ) ) {
            $HTTP_RAW_POST_DATA = file_get_contents( 'php://input' );
        }

        if ( isset($HTTP_RAW_POST_DATA) )
            $HTTP_RAW_POST_DATA = trim($HTTP_RAW_POST_DATA);
        
        if(!isset($HTTP_RAW_POST_DATA) || empty($HTTP_RAW_POST_DATA)) {return false;}
        
        if($this->sp_gzdecode(base64_decode($HTTP_RAW_POST_DATA)) !== false)
        {            
            $this->api_data = json_decode($this->api_data,true);
            if(isset($this->api_data["authentication"]) && isset($this->api_data["payload"]) && isset($this->api_data["action"]))
            {
                $this->api_type = "gzip_api";
                if(!in_array($this->api_data["action"], $this->actions)){return false;}
                
                $this->action = $this->api_data["action"];
                $this->authentication = $this->api_data["authentication"];
                $this->payload = $this->api_data["payload"];
                return true;
            }
        }
        return false;
    }
    
    
    
    private function isValidAction() 
    {
        if(isset($_POST["action"]) && in_array($_POST["action"], $this->actions)) 
        {
            $this->action = $_POST["action"];
            $this->api_type = "json_api";
            return true;
        }
        else 
        {
            if(isset($_POST["action"])){$this->api_type = "json_api";}
            return false;
        }
    }
    
    
    
    private function runAction() 
    {
        if(is_callable(array($this, $this->action)))
        {
            $action = $this->action;
            $this->$action();
        }
        else
        {
            $this->defaultAction(); //or some kind of error message
        }
    }
    
    
    
    private function defaultAction() 
    {
        $this->resultArray["message"] = $this->messages["construct"][2];
        $this->sendResponse();
    }
    
    
    
    private function sendResponse() 
    {
        if($this->api_type == "json_api")
        {
            echo json_encode($this->resultArray);	
            die();
        }
        elseif($this->api_type == "gzip_api" || empty ($this->api_type))
        {
            echo base64_encode($this->sp_gzencode(json_encode($this->resultArray)));
            die();
        }
        else
        {
            echo "Wrong data";
            die();
        }
    }
    
    
    
    private function login() 
    {
        if(isset($_POST["username"])) 
        {
            $username = $_POST["username"];
        }
        elseif(isset($this->authentication["username"])) 
        {
            $username = $this->authentication["username"];
        }
        
        if(isset($_POST["password"])) 
        {
            $passwordEncrypted = $_POST["password"];
        }
        elseif(isset($this->authentication["password"])) 
        {
            $passwordEncrypted = $this->authentication["password"];
        }
        
        $decryptInstance = new DecryptPassword;
        $password = rtrim($decryptInstance->decrypt($passwordEncrypted), "\0..\32");
        
        if($password == false)
        {
            throw new Exception($this->messages["login"][1]);
        }
        
        if($password === 'mbstring')
        {
            throw new Exception($this->messages["login"][2]);
        }
        
        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) 
        {
            throw new Exception($this->messages["login"][0]);
        }
        else 
        {
            return $user;
        }
    }
    
    
    private function checkUser()
    {
        $this->login();
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = true;
        
        $this->sendResponse();
    }
    
    
    private function getUrlForPost()
    {
        $this->login();
        
        $postId = isset($this->payload["postId"]) ? $this->payload["postId"] : 0;
        
	$permalink = "";
	if(is_multisite()) {
		$blogId = $content['blogId'];
		$permalink = get_blog_permalink($blogId, $postId);
	}
	else {
		$permalink = get_permalink( $postId );
	}
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $permalink;
        
        $this->sendResponse();
    }
    
    
    
    private function getUsers()
    {
        $this->login();
        
	$users = get_users('fields=all_with_meta');
        
        $spokal_filter = array($this,'spokal_filter_two_roles');
        if($this->payload["contributors"]){
            if($this->payload["contributors"]){
                $spokal_filter = array($this,'spokal_filter_four_roles');
            }   
        }
        
	foreach(array_filter($users, $spokal_filter) as $user) {
            if($user->user_login != $this->authentication["username"]) {
 		$tempUser = array();
		$tempUser['userId'] = $user->ID;
		$tempUser['blogId'] = get_current_blog_id(); //this needs to update for multisite
           	$tempUser['user_name'] = $user->user_login;
		$tempUser['email'] = $user->user_email;
		
		//get first and last name
		$tempUser['firstName'] = get_user_meta($user->ID, 'first_name', true);
           	$tempUser['lastName'] =  get_user_meta($user->ID, 'last_name', true);
            
           	$object = json_decode(json_encode($tempUser), FALSE);
                    
           	$returnArray[] = $object;
            }
	}
        
        if(is_multisite() && !is_main_site()){
            $super_admins = get_super_admins();
            foreach($super_admins as $login){
                $sp_user = get_user_by("login", $login);
                $tempUser = array();
		$tempUser['userId'] = $sp_user->ID;
		$tempUser['blogId'] = get_current_blog_id(); //this needs to update for multisite
           	$tempUser['user_name'] = $sp_user->user_login;
		$tempUser['email'] = $sp_user->user_email;
		
		//get first and last name
		$tempUser['firstName'] = get_user_meta($sp_user->ID, 'first_name', true);
           	$tempUser['lastName'] =  get_user_meta($sp_user->ID, 'last_name', true);
           	$object = json_decode(json_encode($tempUser), FALSE);
                    
           	$returnArray[] = $object;
            }
        }

        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $returnArray;
        
        $this->sendResponse();
    }
    
    
    
    public function spokal_filter_two_roles($user) 
    {
        $roles = array('editor','administrator');
        return in_array($user->roles[0], $roles);
    }
    
    
    
    public function spokal_filter_four_roles($user) 
    {
        $roles = array('editor','administrator','author','contributor');
        return in_array($user->roles[0], $roles);
    }
    
    
    
    private function deletePost()
    {
        $this->login();
        $post_id = isset($this->payload["post_id"]) ? $this->payload["post_id"] : 0;

        $post = get_post( $post_id, ARRAY_A );
        if ( empty( $post['ID'] ) ){
            throw new Exception('Invalid post ID.' );
        }
        
        update_post_meta($post_id,'spokal_deleting_post','true');

        $result = wp_delete_post( $post_id );

        if ( ! $result ){
            throw new Exception('The post cannot be deleted.' );
        }

        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = true;
        
        $this->sendResponse();
    }
    
    
    
    private function getAvailablePostTypeNames()
    {
        $this->login();
        
        $postTypes = get_post_types(array('show_ui' => true,"public" => true),'objects');
        foreach($postTypes as $key => $value){
            if(in_array($key, array("attachment","revision","nav_menu_item","sp-landingpage"))){continue;}
            $count = wp_count_posts($key);
            $count_publish = $count->publish;
            $post_counts[] = array(
                            "name" => $key,
                            "count" => intval($count_publish)
                
            );
        }        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $post_counts;
        
        $this->sendResponse();
    }
    
    
    
    private function getAllContent()
    {
        $this->login();
                
        $offset = isset($this->payload["offset"]) ? $this->payload["offset"] : 0;
        $numberOfPosts = isset($this->payload["number_of_posts"]) ? $this->payload["number_of_posts"] : 30;
        $post_type = isset($this->payload["post_type"]) ? $this->payload["post_type"] : "post";
            
        $args = array(
            'numberposts'     => $numberOfPosts,
            'offset'          => $offset,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_type'       => array($post_type),
            'post_status'     => array('publish')
        );
        $posts_array = get_posts( $args );
        $result = array();
        
        foreach($posts_array as $postItem) {
            $tempSummary = array();
            $tempSummary['post_id'] = (string)$postItem->ID;
            $tempSummary['post_title'] = $postItem->post_title;
            $tempSummary['post_date'] = $postItem->post_date;
            $tempSummary['post_modified'] = $postItem->post_modified;
            $tempSummary['post_type'] = $postItem->post_type;
            $tempSummary['post_url'] = get_permalink( $postItem->ID);
            $tempSummary['spokal_focuses'] = get_post_meta($postItem->ID, 'spokal_focuses', true); 

            $result[] = $tempSummary;
        }
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $result;
        
        $this->sendResponse();
    }
    
    
    
    private function getPostSummaries() 
    {
        update_option ('spokal_last_update', date("F d, Y, H:i"));
        update_option ('spokal_connection_status', "Connected");
        
        $this->login();
        if($this->api_type == "json_api")
        {
            $offset = isset($_POST["offset"]) ? $_POST["offset"] : 0;
            $numberOfPosts = isset($_POST["number_of_posts"]) ? $_POST["number_of_posts"] : 30;
            $fromDate = isset($_POST["from"]) ? $_POST["from"] : "1920-02-16";
        }
        elseif($this->api_type == "gzip_api")
        {
            $offset = isset($this->payload["offset"]) ? $this->payload["offset"] : 0;
            $numberOfPosts = isset($this->payload["number_of_posts"]) ? $this->payload["number_of_posts"] : 30;
            $fromDate = isset($this->payload["from"]) ? $this->payload["from"] : "1920-02-16";
        }
        else
        {
            throw new Exception($this->messages["construct"][4]);
        }
        
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'names');
        array_push($postTypes, "post","page");
        
        $args = array(
            'numberposts'     => $numberOfPosts,
            'offset'          => $offset,
            'orderby'         => 'modified',
            'order'           => 'DESC',
            'post_type'       => $postTypes,
            'post_status'     => array("publish","draft","future","pending")
        );
        $posts_array = get_posts( $args );
        $result = array();
        
        foreach($posts_array as $postItem) {
            
            $modifiedDate = date('Y-m-d', strtotime($postItem->post_modified));
            $modifiedParametar = date('Y-m-d', strtotime($fromDate));
            
            //skip loop iteration
            if(strtotime($modifiedDate) < strtotime($modifiedParametar)) {
                continue;
            }
            
            $tempSummary = array();
            $tempSummary['post_id'] = (string)$postItem->ID;
            $tempSummary['post_title'] = $postItem->post_title;
            $tempSummary['comment_count'] = $postItem->comment_count;
            $tempSummary['post_name'] = $postItem->post_name;
            $tempSummary['post_date'] = $postItem->post_date;
            $tempSummary['post_modified'] = $postItem->post_modified;
            $tempSummary['post_author'] = $postItem->post_author;
            $tempSummary['post_type'] = $postItem->post_type;
            $tempSummary['keyword'] = get_post_meta($postItem->ID, 'spokal_keywords', true); 
            $tempSummary['post_status'] = ($postItem->post_status !== "publish") ? "draft" : $postItem->post_status;
            $tempSummary['post_url'] = get_permalink( $postItem->ID);

            $result[] = $tempSummary;
        }
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $result;
        
        $this->sendResponse();
    }
    
    
    
    private function setBlogOptions()
    {
        $this->login();
        if($this->api_type == "json_api")
        {
            $blogId = $_POST['blogId'];
            $optionsNew = json_decode(stripslashes($_POST['options']),true);
        }
        elseif($this->api_type == "gzip_api")
        {
            $blogId = isset($this->authentication['blogId']) ? $this->authentication['blogId'] : "";
            $optionsNew = isset($this->payload['options']) ? $this->payload['options'] : "";
        }
        else
        {
            throw new Exception($this->messages["construct"][4]);
        }
        
        if(!is_array($optionsNew))
        {
            throw new Exception("Bad formated options");
        }
        
        foreach ($optionsNew as $key => $val) 
        {
            //We need to check if its multisite cuz get_blog_option working only for that one
            //get_option (get_blog_option) will return false if there is no option like that in database
            if(is_multisite()) 
            {
                $optionOld = get_blog_option($blogId, $key);
            }
            else 
            {
                $optionOld = get_option($key);
            }

            //if get_option returns "false" then here (because of nature of spokal_mergeOptions function
            //we will have false vs string comparation and it will not pass
            //wich means that after execution of line "$optionOld = spokal_mergeOptions($optionOld, $val);", $optionOld = false
            //if we want to preform update_option function with "false" option value, nothing will happen

            //this will repair bug with "no creating new options" on first update
            if($optionOld) 
            {
                $optionOld = $this->mergeOptions($optionOld, $val);
            }
            else 
            {
                $optionOld = $val;
            }

            if(is_multisite()) 
            {
                update_blog_option($blogId, $key, $optionOld );
            }
            else 
            {
                update_option($key, $optionOld); 
            }
	}
        
	$this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $blogId;
        
        $this->sendResponse();
    }
    
    
    
    private function getOptions()
    {
        $login = $this->login();
        
        if($this->api_type == "json_api")
        {
            $blogId = $_POST['blogId'];
            $options = json_decode(stripslashes($_POST['options']),true);
        }
        elseif($this->api_type == "gzip_api")
        {
            $blogId = isset($this->authentication['blogId']) ? $this->authentication['blogId'] : "";
            $options = isset($this->payload['options']) ? $this->payload['options'] : "";
        }
        else
        {
            throw new Exception($this->messages["construct"][4]);
        }
        
        if(!is_array($options)){
            throw new Exception("Bad formated options");
        }
        
	$returnArray = array();

	foreach ($options as $key) 
        {
		
                //We need to check if its multisite cuz get_blog_option working only for that one
                //get_option (get_blog_option) will return false if there is no option like that in database
                if(is_multisite()) {
                    $optionNew = get_blog_option($blogId, $key);
                }
                else {
                    $optionNew = get_option($key);
                }

		$returnArray[$key] = $optionNew;
	}
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $returnArray;
        
        $this->sendResponse();
        
    }
    
    
    
    private function uploadCss()
    {
        $login = $this->login();
            
        $fileName = $this->payload["fileName"];
        $fileContent = base64_decode($this->payload["fileContents"]);

        $upload_dir = wp_upload_dir();
        $directory = $upload_dir['basedir']."/spokal_files";
        if (!is_dir($directory)) {
        // dir doesn't exist, make it
            mkdir($directory);
        }

        $fileUrl = $upload_dir['baseurl']."/spokal_files/".$fileName;
        $filePath = $directory."/".$fileName;
                
        if(!file_exists($filePath)) {
            if(file_put_contents($filePath, $fileContent)) {
                //Skip
            }
            else {
                throw new Exception("Something went wrong with creating css file");
            }
        }
        
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $fileName;
        
        $this->sendResponse();
    }
     
    
    
    private function getTerms()
    {
        $login = $this->login();

        $taxonomies = $this->payload['taxonomies'];

        $returnArray = array();
        
        $struct = array();
        
        foreach($taxonomies as $taxonomy)
        {
                if ( ! taxonomy_exists( $taxonomy ) ){
                        throw new Exception('Invalid taxonomy');
                }

                $taxonomy = get_taxonomy( $taxonomy );
                
                $query = array();

                if ( isset( $this->payload['number'] ) )
                                $query['number'] = absint( $this->payload['number'] );

                if ( isset( $this->payload['offset'] ) )
                                $query['offset'] = absint( $this->payload['offset'] );

                if ( isset( $this->payload['orderby'] ) ) {
                                $query['orderby'] = $this->payload['orderby'];

                                if ( isset( $this->payload['order'] ) )
                                                $query['order'] = $this->payload['order'];
                }

                if ( isset( $this->payload['hide_empty'] ) )
                                $query['hide_empty'] = $this->payload['hide_empty'];
                else
                                $query['get'] = 'all';

                if ( isset( $this->payload['search'] ) )
                                $query['search'] = $this->payload['search'];

                $terms = get_terms( $taxonomy->name, $query );

                if ( is_wp_error( $terms ) ){
                        throw new Exception($terms->get_error_message());
                }

                foreach ( $terms as $term ) {
                                $struct[] = $this->_prepare_term( $term );
                }
        }

        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $struct;

        $this->sendResponse();
    }
    
    
    
    private function newPost()
    {
        update_option ('spokal_last_update', date("F d, Y, H:i"));
        update_option ('spokal_connection_status', "Connected");
        
        $user = $this->login();
        wp_set_current_user($user->ID);
        $content_struct = $this->payload['post'];
        if(!is_array($content_struct)){
            throw new Exception("Bad formated post data!");
        }
        
        $custom_fields = (isset($content_struct['custom_fields']) && is_array($content_struct['custom_fields'])) ? $content_struct['custom_fields'] : array(); 
        $content_struct['custom_fields'] = array();
        $content_struct['custom_fields'][0] = array(
                                    'key' => 'spokal_source',
                                    'value' => 'spokal_editor'
                                    );

        unset( $content_struct['ID'] );
        
        if(isset($content_struct['post_type']) && $content_struct['post_type'] === "post"){
            $content_struct['comment_status'] = get_option("default_comment_status");
        }
       
        // Checking for post date
        if ( ! empty( $content_struct['post_date_gmt'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_date_gmt'], true );

                if ( ! empty( $date_data ) ) {
                        list( $content_struct['post_date'], $content_struct['post_date_gmt'] ) = $date_data;
                }
        }
        elseif ( ! empty( $content_struct['post_date'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_date'] );

                if ( ! empty( $content_struct ) ) {
                        list( $content_struct['post_date'], $content_struct['post_date_gmt'] ) = $date_data;
                }
        }
        
        // Checking for post modified date
        if ( ! empty( $content_struct['post_modified_gmt'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_modified_gmt'], true );

                if ( ! empty( $date_data ) ) {
                        list( $content_struct['post_modified'], $content_struct['post_modified_gmt'] ) = $date_data;
                }
        }
        elseif ( ! empty( $content_struct['post_modified'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_modified'] );

                if ( ! empty( $content_struct ) ) {
                        list( $content_struct['post_modified'], $content_struct['post_modified_gmt'] ) = $date_data;
                }
        }
        
        //If post_author does not exist setting it to another administrator
        $authorChanged = false;
        if(isset($content_struct["post_author"])){
            $user = get_userdata( $content_struct["post_author"] );
            if ( $user === false ) {
                $author_id = $this->get_site_administrator();
                if($author_id != false){
                    $content_struct["post_author"] = $author_id;
                    $authorChanged = true;
                }
            }
        }
        
        $post_id = $this->_insert_post( $user, $content_struct );
        if ( is_wp_error($post_id) ) {
            throw new Exception($post_id->get_error_message());
        }

        //get the post
        $post = get_post($post_id, ARRAY_A);
        $post =  $this->_prepare_post( $post, array( 'post', 'terms', 'custom_fields' ));

        //this will merge instead of creating new ones
        foreach ($custom_fields as $custom_field) {
            $value = ($custom_field['key'] == "spokal_keywords") ? wp_slash($custom_field['value']) : $custom_field['value'];
            update_post_meta($post_id, $custom_field['key'], $value);
        }

        array_push($custom_fields, array( 'key' => 'post_url', 'value' => get_permalink($post_id)));
        
        if($authorChanged){
            $post["publish_warnings"] = "The author couldn't be found in your WordPress site. The post has been published as the site administrator instead. Please contact support to resolve this.";
        }
        
        //set the new custom fields without grabbing the post again
        $post['custom_fields'] = $custom_fields;
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $post;

        $this->sendResponse();
    }
    
    
    private function isUpdatePostMeta($data)
    {
        if(
            count($data) == 3 && 
            isset($data["custom_fields"]) &&
            isset($data["post_id"]) &&
            isset($data["terms_names"]) &&
            empty($data["terms_names"]) &&
            is_array($data["custom_fields"])
        )
        {
            return true;
            
        }
        return false;
    }
    
    
    private function updatePostMeta($data)
    {
        $custom_fields = $data["custom_fields"];
        $post_id = $data["post_id"];
        
        foreach($custom_fields as $custom_field)
        {
            $value = ($custom_field['key'] == "spokal_keywords") ? wp_slash($custom_field['value']) : $custom_field['value'];
            update_post_meta($post_id, $custom_field['key'], $value);
        }
        
        $post = get_post($post_id, ARRAY_A);
        $post =  $this->_prepare_post( $post, array( 'post', 'terms', 'custom_fields' ));
        
        //set the new custom fields without grabbing the post again
        $post['custom_fields'] = $custom_fields;
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $post;

        $this->sendResponse();
    }
    
    
    private function editPostv2()
    {
        update_option ('spokal_last_update', date("F d, Y, H:i"));
        update_option ('spokal_connection_status', "Connected");
        
        $user = $this->login();
        wp_set_current_user($user->ID);
        
        $alreadyPublished = false;
        
	//copy custom fields and do not allow them to be saved in newPost
	$content_struct = $this->payload['post'];
        if(!is_array($content_struct) || !isset($content_struct["post_id"])){
            throw new Exception("Bad formated post data!");
        }
        
        //Check are we trying to update just Post meta
        //And if so, update just post meta and don't update the whole post
        if($this->isUpdatePostMeta($content_struct))
        {
            $this->updatePostMeta($content_struct);
        }
        
        if(empty($content_struct['post_name'])){
            unset($content_struct['post_name']);
        }
        
        $this->checkTaxonomies($content_struct);
       
        $post_id = $content_struct["post_id"];
        $custom_fields = (isset($content_struct['custom_fields']) && is_array($content_struct['custom_fields'])) ? $content_struct['custom_fields'] : array(); 
        $content_struct['custom_fields'] = array();
        $content_struct['custom_fields'][0] = array(
                                    'key' => 'spokal_source',
                                    'value' => 'spokal_editor'
                                    );
        
        //If post_author does not exist setting it to another administrator
        $authorChanged = false;
        if(isset($content_struct['post_author']) && $content_struct['post_author'] == 0) 
        {
            unset($content_struct['post_author']);
        }else if(isset($content_struct['post_author']))
        {
            $user = get_userdata( $content_struct['post_author'] );
            if ( $user === false ) {
                unset($content_struct['post_author']);
                $authorChanged = true;
            }
        }
        
	$oldPost = get_post($post_id, ARRAY_A);

	if ($oldPost['post_status'] == 'publish')
	{
		//post is already published
		$alreadyPublished = true;
	}
        
        if ( empty( $oldPost['ID'] ) )
                throw new Exception( 'Invalid post ID.');

        if ( isset( $content_struct['if_not_modified_since'] ) ) {
            // If the post has been modified since the date provided, return an error.
            if ( mysql2date( 'U', $oldPost['post_modified_gmt'] ) > $content_struct['if_not_modified_since']->getTimestamp() ) {
                    throw new Exception( 'There is a revision of this post that is more recent.' );
            }
        }
        
        
        // Checking for post date
        if ( ! empty( $content_struct['post_date_gmt'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_date_gmt'], true );

                if ( ! empty( $date_data ) ) {
                        list( $content_struct['post_date'], $content_struct['post_date_gmt'] ) = $date_data;
                }
        }
        elseif ( ! empty( $content_struct['post_date'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_date'] );

                if ( ! empty( $content_struct ) ) {
                        list( $content_struct['post_date'], $content_struct['post_date_gmt'] ) = $date_data;
                }
        }
        
        // Checking for post modified date
        if ( ! empty( $content_struct['post_modified_gmt'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_modified_gmt'], true );

                if ( ! empty( $date_data ) ) {
                        list( $content_struct['post_modified'], $content_struct['post_modified_gmt'] ) = $date_data;
                }
        }
        elseif ( ! empty( $content_struct['post_modified'] ) ) 
        {
                $date_data = $this->sp_get_date_with_gmt( $content_struct['post_modified'] );

                if ( ! empty( $content_struct ) ) {
                        list( $content_struct['post_modified'], $content_struct['post_modified_gmt'] ) = $date_data;
                }
        }
                
        $merged_content_struct = array_merge( $oldPost, $content_struct );
	//edit the post
	$retval = $this->_insert_post( $user, $merged_content_struct );

	//get the post
	$post = get_post($post_id, ARRAY_A);
        $post =  $this->_prepare_post( $post, array( 'post', 'terms', 'custom_fields' ));
        //add custom spokal (changed from seoal) fields
	if($post['post_status'] == 'publish') {
		array_push($custom_fields, array( 'key' => 'spokal_url', 'value' => get_permalink($post_id)));
	}
	
	//this will merge instead of creating new ones
	foreach ($custom_fields as $custom_field) {
		//if it's already been published, remove the post dates
		if ($alreadyPublished == true && ($custom_field['key'] == 'post_date' || $custom_field['key'] == 'post_date_gmt'))
		{
                    //skip
		}
		else
		{
                    $value = ($custom_field['key'] == "spokal_keywords") ? wp_slash($custom_field['value']) : $custom_field['value'];
                    update_post_meta($post_id, $custom_field['key'], $value);
		}
	}

	array_push($custom_fields, array( 'key' => 'post_url', 'value' => get_permalink($post_id)));
	
        if($authorChanged){
            $post["publish_warnings"] = "The author couldn't be found in your WordPress site. The post has been published as the site administrator instead. Please contact support to resolve this.";
        }
        
	//set the new custom fields without grabbing the post again
	$post['custom_fields'] = $custom_fields;
	$this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $post;
        
        $this->sendResponse();
    }
        
    
    
    private function getPost() 
    {

        $user = $this->login();
        wp_set_current_user($user->ID);
        
        $post_id = $this->payload['postId'];
        
        if ( isset( $this->payload['fields'] ) ) {
                $fields = $this->payload['fields'];
        } else {
                $fields = array( 'post', 'terms', 'custom_fields' );
        }

        $post = get_post( $post_id, ARRAY_A );
        
        if(!is_array($post)){
            throw new Exception("Wrong post format.");
        }
        
        if ( empty( $post['ID'] ) )
            throw new Exception("Invalid post ID.");
                
        $post =  $this->_prepare_post( $post, $fields );
        $post["shortcodes"] = $this->private_fillShortcodeList();
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $post;
        
        $this->sendResponse();
    }
    
    
    
    private function createUser()
    {
        $this->login();
        $blogId = isset($this->authentication['blogId']) ? $this->authentication['blogId'] : "";
        $email = isset($this->payload['email']) ? $this->payload['email'] : "";
        $f_name = isset($this->payload['first_name']) ? $this->payload['first_name'] : "";
        $l_name = isset($this->payload['last_name']) ? $this->payload['last_name'] : "";
        $password = isset($this->payload['password']) ? $this->payload['password'] : "";
        $user_login = isset($this->payload['user_login']) ? $this->payload['user_login'] : "";
        $twitter_user_id = isset($this->payload['twitter_user_id']) ? $this->payload['twitter_user_id'] : "";
        
        
        if(empty($email)){
            $this->resultArray["message"] = "Email field is required!";
            $this->resultArray["status"] = false;
            $this->sendResponse();
        }
        
        if(empty($user_login)){
            $this->resultArray["message"] = "Username field is required!";
            $this->resultArray["status"] = false;
            $this->sendResponse();
        }
        
        if(empty($password)){
            $this->resultArray["message"] = "Password field is required!";
            $this->resultArray["status"] = false;
            $this->sendResponse();
        }
        
        
        $userdata = array(
            'user_email' => $email,
            'user_login'  =>  $user_login,
            'user_pass'   =>  $password,
            'role' => 'contributor',
            'first_name' => $f_name,
            'last_name' => $l_name,
        );
        
        $userID = wp_insert_user( $userdata );
        
        $response = $this->checkSpokalUser($userID,$password);
        
        if($response['status']){
            if(!empty($twitter_user_id)){
                update_user_meta( $userID, "spokal_twitter_user_id", $twitter_user_id);
            }
            $this->resultArray["message"] = "Completed";
            $this->resultArray["status"] = true;
            $this->resultArray["result"] = $response['result'];
        }else{
            $this->resultArray["message"] = $response['result'];
            $this->resultArray["status"] = false;
        }
        
        $this->sendResponse();
    }
    
    
    
    private function uploadFile()
    {
        $this->login();
        
        global $wpdb;
        
        $data     = $this->payload;

        $name = sanitize_file_name( $this->payload['name'] );
        $type = $this->payload['type'];
        $bits = base64_decode($this->payload['bits']);

        if ( !empty($this->payload['overwrite']) && ($this->payload['overwrite'] == true) ) {
            // Get postmeta info on the object.
            $old_file = $wpdb->get_row("
                    SELECT ID
                    FROM {$wpdb->posts}
                    WHERE post_title = '{$name}'
                            AND post_type = 'attachment'
            ");

            if(isset($old_file->ID)){
                // Delete previous file.
                wp_delete_attachment($old_file->ID);

                // Make sure the new name is different by pre-pending the
                // previous post id.
                $filename = preg_replace('/^wpid\d+-/', '', $name);
                $name = "wpid{$old_file->ID}-{$filename}";
            }
        }

        $upload = wp_upload_bits($name, null, $bits);
        if ( ! empty($upload['error']) ) {
            $errorString = sprintf(__('Could not write file %1$s (%2$s)'), $name, $upload['error']);
            throw new Exception($errorString);
        }
        
        // Construct the attachment array
        $post_id = 0;
        if ( ! empty( $this->payload['post_id'] ) ) {
            $post_id = (int) $this->payload['post_id'];
        }
        
        $attachment = array(
                'post_title' => $name,
                'post_content' => '',
                'post_type' => 'attachment',
                'post_parent' => $post_id,
                'post_mime_type' => $type,
                'guid' => $upload[ 'url' ]
        );
        
        // Save the data
        $id = wp_insert_attachment( $attachment, $upload[ 'file' ], $post_id );
        wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );


        $struct = array(
                'id'   => strval( $id ),
                'file' => $name,
                'url'  => $upload[ 'url' ],
                'type' => $type
        );
        
        $this->resultArray["message"] = "Completed";
        $this->resultArray["status"] = true;
        $this->resultArray["result"] = $struct;
        
        $this->sendResponse();
    }
    
    
    
    private function private_fillShortcodeList()
    {

	global $shortcode_tags;
	$result = array();
        if(isset($shortcode_tags) && is_array($shortcode_tags)){
            foreach($shortcode_tags as $tag => $function) {
		$result[] = $tag;	
            }
        }
	
	return $result;	
    }
    
    
    
    private function mergeOptions($optionOld, $optionNew, $gaurd = 0) 
    {
        if((gettype($optionOld) == gettype($optionNew)) && $gaurd < 10) {

            if(is_array($optionOld) && is_array($optionNew)) {

                foreach ($optionNew as $key => $value) {

                    if(array_key_exists($key, $optionOld))
                    {
                            $optionOld[$key] = $this->mergeOptions($optionOld[$key], $optionNew[$key], $gaurd + 1);
                    }
                }
            } else {
                    $optionOld = $optionNew;
            }
        }

	return $optionOld;
    }
    
    
    
    /**
    * Get a local date with its GMT equivalent, in MySQL datetime format.
    *
    * @param string $date      RFC3339 timestamp
    * @param bool   $force_utc Whether a UTC timestamp should be forced.
    * @return array|null Local and UTC datetime strings, in MySQL datetime format (Y-m-d H:i:s), null on failure.
    */
    private function sp_get_date_with_gmt( $date, $force_utc = false ) 
    {
            $date = $this->sp_parse_date( $date, $force_utc );

            if ( empty( $date ) ) {
                    return null;
            }

            $utc = date( 'Y-m-d H:i:s', $date );
            $local = get_date_from_gmt( $utc );

            return array( $local, $utc );
    }
    
    
    
    /**
    * Parse an RFC3339 timestamp into a DateTime.
    *
    * @param string $date      RFC3339 timestamp.
    * @param bool   $force_utc Force UTC timezone instead of using the timestamp's TZ.
    * @return DateTime DateTime instance.
    */
    private function sp_parse_date( $date, $force_utc = false ) 
    {
	if ( $force_utc ) {
		$date = preg_replace( '/[+-]\d+:?\d+$/', '+00:00', $date );
	}

	$regex = '#^\d{4}-\d{2}-\d{2}[Tt ]\d{2}:\d{2}:\d{2}(?:\.\d+)?(?:Z|[+-]\d{2}(?::\d{2})?)?$#';

	if ( ! preg_match( $regex, $date, $matches ) ) {
		return false;
	}

	return strtotime( $date );
    }
    
    
    
    private function _insert_post( $user, $content_struct ) 
    {
        $defaults = array( 'post_status' => 'draft', 'post_type' => 'post', 'post_author' => 0,
                'post_password' => '', 'post_excerpt' => '', 'post_content' => '', 'post_title' => '' );

        $post_data = wp_parse_args( $content_struct, $defaults );

        $post_type = get_post_type_object( $post_data['post_type'] );
        if ( ! $post_type )
            throw new Exception('Invalid post type');

        $update = ! empty( $post_data['ID'] );
        $current_user = wp_get_current_user();
        
        if ( $update ) {
            if ( ! get_post( $post_data['ID'] ) )
                throw new Exception('Invalid post ID.');
            if ( ! current_user_can( 'edit_post', $post_data['ID'] ) )
                throw new Exception('Sorry, you are not allowed to edit this post.');
            if ( $post_data['post_type'] != get_post_type( $post_data['ID'] ) )
                throw new Exception('The post type may not be changed.');
        } else {
            if ( ! current_user_can( $post_type->cap->create_posts ) || ! current_user_can( $post_type->cap->edit_posts ) )
                throw new Exception('Sorry, you are not allowed to post on this site.');
        }
        
        switch ( $post_data['post_status'] ) {
            case 'draft':
            case 'pending':
                    break;
            case 'private':
                if ( ! current_user_can( $post_type->cap->publish_posts ) )
                    throw new Exception('Sorry, you are not allowed to create private posts in this post type' );
                break;
            case 'publish':
            case 'future':
                if ( ! current_user_can( $post_type->cap->publish_posts ) )
                    throw new Exception('Sorry, you are not allowed to publish posts in this post type' );
                break;
            default:
                if ( ! get_post_status_object( $post_data['post_status'] ) )
                    $post_data['post_status'] = 'draft';
            break;
        }
        
        if ( ! empty( $post_data['post_password'] ) && ! current_user_can( $post_type->cap->publish_posts ) )
            throw new Exception('Sorry, you are not allowed to create password protected posts in this post type' );

        $post_data['post_author'] = absint( $post_data['post_author'] );
        if ( ! empty( $post_data['post_author'] ) && $post_data['post_author'] != $user->ID ) {
            if ( ! current_user_can( $post_type->cap->edit_others_posts ) )
                throw new Exception('You are not allowed to create posts as this user.' );

            $author = get_userdata( $post_data['post_author'] );

            if ( ! $author )
                throw new Exception('Invalid author ID.' );
        } else {
            $post_data['post_author'] = $user->ID;
        }
        
        if ( isset( $post_data['comment_status'] ) && $post_data['comment_status'] != 'open' && $post_data['comment_status'] != 'closed' )
            unset( $post_data['comment_status'] );

        if ( isset( $post_data['ping_status'] ) && $post_data['ping_status'] != 'open' && $post_data['ping_status'] != 'closed' )
            unset( $post_data['ping_status'] );
        
        // Do some timestamp voodoo
        if ( ! empty( $post_data['post_date_gmt'] ) ) {
                // We know this is supposed to be GMT, so we're going to slap that Z on there by force
                $dateCreated = $post_data['post_date_gmt'];
        } elseif ( ! empty( $post_data['post_date'] ) ) {
                $dateCreated = $post_data['post_date'];
        }

        if ( ! empty( $dateCreated ) ) {
                $post_data['post_date'] = get_date_from_gmt($dateCreated,"Y-m-d H:i:s");
                $post_data['post_date_gmt'] = $dateCreated;
        }
        
        
        if ( ! isset( $post_data['ID'] ) )
            $post_data['ID'] = get_default_post_to_edit( $post_data['post_type'], true )->ID;
        $post_ID = $post_data['ID'];

        if ( $post_data['post_type'] == 'post' ) {
            // Private and password-protected posts cannot be stickied.
            if ( $post_data['post_status'] == 'private' || ! empty( $post_data['post_password'] ) ) {
                // Error if the client tried to stick the post, otherwise, silently unstick.
                if ( ! empty( $post_data['sticky'] ) )
                    throw new Exception('Sorry, you cannot stick a private post.' );
                if ( $update )
                    unstick_post( $post_ID );
            } elseif ( isset( $post_data['sticky'] ) )  {
                if ( ! current_user_can( $post_type->cap->edit_others_posts ) )
                    throw new Exception('Sorry, you are not allowed to stick this post.' );
                if ( $post_data['sticky'] )
                    stick_post( $post_ID );
                else
                    unstick_post( $post_ID );
            }
        }

        if ( isset( $post_data['post_thumbnail'] ) ) {
            // empty value deletes, non-empty value adds/updates
            if ( ! $post_data['post_thumbnail'] )
                    delete_post_thumbnail( $post_ID );
            elseif ( ! get_post( absint( $post_data['post_thumbnail'] ) ) )
                    throw new Exception('Invalid attachment ID.');
            set_post_thumbnail( $post_ID, $post_data['post_thumbnail'] );
            unset( $content_struct['post_thumbnail'] );
        }

        if ( isset( $post_data['custom_fields'] ) )
                $this->set_custom_fields( $post_ID, $post_data['custom_fields'] );

        if ( isset( $post_data['terms'] ) || isset( $post_data['terms_names'] ) ) {
            $post_type_taxonomies = get_object_taxonomies( $post_data['post_type'], 'objects' );

            // accumulate term IDs from terms and terms_names
            $terms = array();

            // first validate the terms specified by ID
            if ( isset( $post_data['terms'] ) && is_array( $post_data['terms'] ) ) {
                $taxonomies = array_keys( $post_data['terms'] );

                // validating term ids
                foreach ( $taxonomies as $taxonomy ) {
                    if ( ! array_key_exists( $taxonomy , $post_type_taxonomies ) )
                        throw new Exception('Sorry, one of the given taxonomies is not supported by the post type.');

                    if ( ! current_user_can( $post_type_taxonomies[$taxonomy]->cap->assign_terms ) )
                        throw new Exception('Sorry, you are not allowed to assign a term to one of the given taxonomies.');

                    $term_ids = $post_data['terms'][$taxonomy];
                    $terms[ $taxonomy ] = array();
                    foreach ( $term_ids as $term_id ) {
                        $term = get_term_by( 'id', $term_id, $taxonomy );

                        if ( ! $term )
                            throw new Exception('Invalid term ID');

                        $terms[$taxonomy][] = (int) $term_id;
                    }
                }
            }

            // now validate terms specified by name
            if ( isset( $post_data['terms_names'] ) && is_array( $post_data['terms_names'] ) ) {
                $taxonomies = array_keys( $post_data['terms_names'] );

                foreach ( $taxonomies as $taxonomy ) {
                    if ( ! array_key_exists( $taxonomy , $post_type_taxonomies ) )
                        throw new Exception('Sorry, one of the given taxonomies is not supported by the post type.');

                    if ( ! current_user_can( $post_type_taxonomies[$taxonomy]->cap->assign_terms ) )
                        throw new Exception('Sorry, you are not allowed to assign a term to one of the given taxonomies.');

                    // for hierarchical taxonomies, we can't assign a term when multiple terms in the hierarchy share the same name
                    $ambiguous_terms = array();
                    if ( is_taxonomy_hierarchical( $taxonomy ) ) {
                        $tax_term_names = get_terms( $taxonomy, array( 'fields' => 'names', 'hide_empty' => false ) );

                        // count the number of terms with the same name
                        $tax_term_names_count = array_count_values( $tax_term_names );

                        // filter out non-ambiguous term names
                        $ambiguous_tax_term_counts = array_filter( $tax_term_names_count, array( $this, '_is_greater_than_one') );

                        $ambiguous_terms = array_keys( $ambiguous_tax_term_counts );
                    }

                    $term_names = $post_data['terms_names'][$taxonomy];
                    foreach ( $term_names as $term_name ) {
                        if ( in_array( $term_name, $ambiguous_terms ) )
                            throw new Exception('Ambiguous term name used in a hierarchical taxonomy. Please use term ID instead.');

                        $term = get_term_by( 'name', $term_name, $taxonomy );

                        if ( ! $term ) {
                            // term doesn't exist, so check that the user is allowed to create new terms
                            if ( ! current_user_can( $post_type_taxonomies[$taxonomy]->cap->edit_terms ) )
                                throw new Exception('Sorry, you are not allowed to add a term to one of the given taxonomies.');

                            // create the new term
                            $term_info = wp_insert_term( $term_name, $taxonomy );
                            if ( is_wp_error( $term_info ) )
                                throw new Exception($term_info->get_error_message());

                            $terms[$taxonomy][] = (int) $term_info['term_id'];
                        } else {
                            $terms[$taxonomy][] = (int) $term->term_id;
                        }
                    }
                }
            }

            $post_data['tax_input'] = $terms;
            unset( $post_data['terms'], $post_data['terms_names'] );
        } else {
                // do not allow direct submission of 'tax_input', clients must use 'terms' and/or 'terms_names'
                unset( $post_data['tax_input'], $post_data['post_category'], $post_data['tags_input'] );
        }

        if ( isset( $post_data['post_format'] ) ) {
                $format = set_post_format( $post_ID, $post_data['post_format'] );

                if ( is_wp_error( $format ) )
                        throw new Exception($format->get_error_message());

                unset( $post_data['post_format'] );
        }

        // Handle enclosures
        $enclosure = isset( $post_data['enclosure'] ) ? $post_data['enclosure'] : null;
        $this->add_enclosure_if_new( $post_ID, $enclosure );

            //this function will set post ID as parent_id for each attachment in post content and we don't want it
//        $this->attach_uploads( $post_ID, $post_data['post_content'] );

        $post_ID = $update ? wp_update_post( $post_data, true ) : wp_insert_post( $post_data, true );
        if ( is_wp_error( $post_ID ) )
                throw new Exception($post_ID->get_error_message());

        if ( ! $post_ID )
                throw new Exception('Sorry, your entry could not be posted. Something wrong happened.');

        return strval( $post_ID );
    }
    
    
    
    private function _prepare_post( $post, $fields ) 
    {
        // holds the data for this post. built up based on $fields
        $_post = array( 'post_id' => strval( $post['ID'] ) );

        // prepare common post fields
        $post_fields = array(
                'post_title'        => $post['post_title'],
                'post_date'         => $post['post_date'],
                'post_date_gmt'     => $this->_convert_date_gmt($post['post_date_gmt'], $post['post_date']),
                'post_modified'     => $post['post_modified'],
                'post_modified_gmt' => $this->_convert_date_gmt($post['post_modified_gmt'], $post['post_modified']),
                'post_status'       => $post['post_status'],
                'post_type'         => $post['post_type'],
                'post_name'         => $post['post_name'],
                'post_author'       => $post['post_author'],
                'post_password'     => $post['post_password'],
                'post_excerpt'      => $post['post_excerpt'],
                'post_content'      => $post['post_content'],
                'post_parent'       => strval( $post['post_parent'] ),
                'post_mime_type'    => $post['post_mime_type'],
                'link'              => post_permalink( $post['ID'] ),
                'guid'              => $post['guid'],
                'menu_order'        => intval( $post['menu_order'] ),
                'comment_status'    => $post['comment_status'],
                'ping_status'       => $post['ping_status'],
                'sticky'            => ( $post['post_type'] === 'post' && is_sticky( $post['ID'] ) ),
        );

        // Thumbnail
        $post_fields['post_thumbnail'] = array();
        $thumbnail_id = get_post_thumbnail_id( $post['ID'] );
        if ( $thumbnail_id ) {
            $thumbnail_size = current_theme_supports('post-thumbnail') ? 'post-thumbnail' : 'thumbnail';
            $post_fields['post_thumbnail'] = $this->_prepare_media_item( get_post( $thumbnail_id ), $thumbnail_size );
        }

        // Consider non published posts as draft
        if ( $post_fields['post_status'] !== 'publish' )
                $post_fields['post_status'] = 'draft';

        // Fill in blank post format
        $post_fields['post_format'] = get_post_format( $post['ID'] );
        if ( empty( $post_fields['post_format'] ) )
            $post_fields['post_format'] = 'standard';

        // Merge requested $post_fields fields into $_post
        if ( in_array( 'post', $fields ) ) {
            $_post = array_merge( $_post, $post_fields );
        } else {
            $requested_fields = array_intersect_key( $post_fields, array_flip( $fields ) );
            $_post = array_merge( $_post, $requested_fields );
        }

        $all_taxonomy_fields = in_array( 'taxonomies', $fields );

        if ( $all_taxonomy_fields || in_array( 'terms', $fields ) ) {
            $post_type_taxonomies = get_object_taxonomies( $post['post_type'], 'names' );
            $terms = wp_get_object_terms( $post['ID'], $post_type_taxonomies );
            $_post['terms'] = array();
            foreach ( $terms as $term ) {
                    $_post['terms'][] = $this->_prepare_term( $term );
            }
        }

        if ( in_array( 'custom_fields', $fields ) )
            $_post['custom_fields'] = $this->get_custom_fields( $post['ID'] );

        if ( in_array( 'enclosure', $fields ) ) {
            $_post['enclosure'] = array();
            $enclosures = (array) get_post_meta( $post['ID'], 'enclosure' );
            if ( ! empty( $enclosures ) ) {
                $encdata = explode( "\n", $enclosures[0] );
                $_post['enclosure']['url'] = trim( htmlspecialchars( $encdata[0] ) );
                $_post['enclosure']['length'] = (int) trim( $encdata[1] );
                $_post['enclosure']['type'] = trim( $encdata[2] );
            }
        }
        
        return $_post;
    }
    
    
    
    /**
     * Prepares media item data for return in an XML-RPC object.
     *
     * @access private
     *
     * @param object $media_item The unprepared media item data
     * @param string $thumbnail_size The image size to use for the thumbnail URL
     * @return array The prepared media item data
     */
    private function _prepare_media_item( $media_item, $thumbnail_size = 'thumbnail' ) 
    {
        $_media_item = array(
                'attachment_id'    => strval( $media_item->ID ),
                'date_created_gmt' => $this->_convert_date_gmt( $media_item->post_date_gmt, $media_item->post_date ),
                'parent'           => $media_item->post_parent,
                'link'             => wp_get_attachment_url( $media_item->ID ),
                'title'            => $media_item->post_title,
                'caption'          => $media_item->post_excerpt,
                'description'      => $media_item->post_content,
                'metadata'         => wp_get_attachment_metadata( $media_item->ID ),
        );

        $thumbnail_src = image_downsize( $media_item->ID, $thumbnail_size );
        if ( $thumbnail_src )
                $_media_item['thumbnail'] = $thumbnail_src[0];
        else
                $_media_item['thumbnail'] = $_media_item['link'];

        return $_media_item;
    }
    
    
    
    /**
    * Prepares term data for return in an XML-RPC object.
    *
    * @access private
    *
    * @param array|object $term The unprepared term data
    * @return array The prepared term data
    */
    private function _prepare_term( $term ) 
    {
        $_term = $term;
        if ( ! is_array( $_term) )
                $_term = get_object_vars( $_term );

        // For integers which may be larger than XML-RPC supports ensure we return strings.
        $_term['term_id'] = strval( $_term['term_id'] );
        $_term['term_group'] = strval( $_term['term_group'] );
        $_term['term_taxonomy_id'] = strval( $_term['term_taxonomy_id'] );
        $_term['parent'] = strval( $_term['parent'] );

        // Count we are happy to return as an integer because people really shouldn't use terms that much.
        $_term['count'] = intval( $_term['count'] );

        return $_term;
    }
    
    
    
    /**
    * Convert a WordPress GMT date string to an IXR_Date object.
    *
    * @access private
    *
    * @param string $date_gmt
    * @param string $date
    * @return IXR_Date
    */
    private function _convert_date_gmt( $date_gmt, $date ) 
    {
            if ( $date !== '0000-00-00 00:00:00' && $date_gmt === '0000-00-00 00:00:00' ) {
                    return get_gmt_from_date( mysql2date( 'Y-m-d H:i:s', $date, false ));
            }
            return $date_gmt;
    }
    
    
        
    /**
     * Set custom fields for post.
     *
     * @since 2.0.0
     *
     * @param int $post_id Post ID.
     * @param array $fields Custom fields.
     */
    public function set_custom_fields($post_id, $fields) 
    {
        $post_id = (int) $post_id;

        foreach ( (array) $fields as $meta ) {
            if ( isset($meta['id']) ) {
                $meta['id'] = (int) $meta['id'];
                $pmeta = get_metadata_by_mid( 'post', $meta['id'] );
                if ( isset($meta['key']) ) {
                    $meta['key'] = wp_unslash( $meta['key'] );
                    if ( $meta['key'] !== $pmeta->meta_key )
                            continue;
                    $meta['value'] = wp_unslash( $meta['value'] );
                    if ( current_user_can( 'edit_post_meta', $post_id, $meta['key'] ) )
                            update_metadata_by_mid( 'post', $meta['id'], $meta['value'] );
                } elseif ( current_user_can( 'delete_post_meta', $post_id, $pmeta->meta_key ) ) {
                    delete_metadata_by_mid( 'post', $meta['id'] );
                }
            } elseif ( current_user_can( 'add_post_meta', $post_id, wp_unslash( $meta['key'] ) ) ) {
                    add_post_meta( $post_id, $meta['key'], $meta['value'] );
            }
        }
    }
    
    
    
    /**
    * Retrieve custom fields for post.
    *
    * @since 2.0.0
    *
    * @param int $post_id Post ID.
    * @return array Custom fields, if exist.
    */
    public function get_custom_fields($post_id) 
    {
        $post_id = (int) $post_id;

        $custom_fields = array();

        foreach ( (array) has_meta($post_id) as $meta ) {
                // Don't expose protected fields.
                if ( ! current_user_can( 'edit_post_meta', $post_id , $meta['meta_key'] ) )
                        continue;

                $custom_fields[] = array(
                        "id"    => $meta['meta_id'],
                        "key"   => $meta['meta_key'],
                        "value" => $meta['meta_value']
                );
        }

        return $custom_fields;
    }
    
    
    
    /**
     * @param integer $post_ID
     * @param array   $enclosure
     */
    public function add_enclosure_if_new( $post_ID, $enclosure ) 
    {
        if ( is_array( $enclosure ) && isset( $enclosure['url'] ) && isset( $enclosure['length'] ) && isset( $enclosure['type'] ) ) {
            $encstring = $enclosure['url'] . "\n" . $enclosure['length'] . "\n" . $enclosure['type'] . "\n";
            $found = false;
            if ( $enclosures = get_post_meta( $post_ID, 'enclosure' ) ) {
                foreach ( $enclosures as $enc ) {
                    // This method used to omit the trailing new line. #23219
                    if ( rtrim( $enc, "\n" ) == rtrim( $encstring, "\n" ) ) {
                        $found = true;
                        break;
                    }
                }
            }
            if ( ! $found )
                add_post_meta( $post_ID, 'enclosure', $encstring );
        }
    }
        
        
        
    /**
     * Attach upload to a post.
     *
     * @since 2.0.0
     *
     * @param int $post_ID Post ID.
     * @param string $post_content Post Content for attachment.
     */
    public function attach_uploads( $post_ID, $post_content ) 
    {
        global $wpdb;

        // find any unattached files
        $attachments = $wpdb->get_results( "SELECT ID, guid FROM {$wpdb->posts} WHERE post_parent = '0' AND post_type = 'attachment'" );
        if ( is_array( $attachments ) ) {
            foreach ( $attachments as $file ) {
                if ( ! empty( $file->guid ) && strpos( $post_content, $file->guid ) !== false )
                    $wpdb->update($wpdb->posts, array('post_parent' => $post_ID), array('ID' => $file->ID) );
            }
        }
    } 
    
    
    
    private function checkTaxonomies($content_struct)
    {
        if ( isset($content_struct['post_category']) && is_array($content_struct['post_category'])
                         && 0 === count($content_struct['post_category']) )
        {
            wp_set_post_categories( $content_struct["post_id"], array());
        }
		
        if(isset($content_struct['terms_names']['post_tag'])
                && is_array($content_struct['terms_names']['post_tag'])
                && 0 === count($content_struct['terms_names']['post_tag'])){
            wp_set_post_tags( $content_struct["post_id"], array());
        }
        
        return true;
    }
    
    
    
    
    /**
    * Helper method for filtering out elements from an array.
    *
    * @since 2.0.0
    *
    * @param int $count Number to compare to one.
    */
    private function _is_greater_than_one( $count ) 
    {
            return $count > 1;
    }
    
    
    
    private function sp_gzdecode($data)
    {
        if(!function_exists('gzinflate') || !function_exists('gzencode'))
        {
            throw new Exception($this->messages["construct"][3]);
        }
        
        if(method_exists('WP_Http_Encoding','decompress'))
        {
            $this->api_data = WP_Http_Encoding::decompress($data);
            return true;
        }
        else
        {
            $this->api_data = @gzinflate(substr($data,10,-8));
            return true;
        }
        return false;
    }
    
    
    
    
    private function sp_gzencode($data) 
    {
        if(!function_exists('gzencode'))
        {
            return "Function gzencode doesn't exist!";
        }
        return gzencode($data);
    }
    
    
    
    private function checkSpokalUser($userID,$password)
    {
        $return = array(
            'status' => true,
            'result' => ""
        );
        if ( is_wp_error( $userID ) ) 
        {
            return array(
                'status' => false,
                'result' => $userID->get_error_message()
            );
        }
        else
        {
            $user = get_user_by( 'id' , $userID );
            if($user === false)
            {
                return array(
                    'status' => false,
                    'result' => 'Unable to get details of user'
                );
                return array("Error" => 'Unable to get details of user: "spokal-user-do-not-delete".');
            }else
            {
                $user = wp_authenticate($user->user_login, $password);
                if (is_wp_error($user)) 
                {
                    return array(
                        'status' => false,
                        'result' => $user->get_error_message()
                    );
                }else
                {
                    if(isset($user->ID)){
                        return array(
                        'status' => true,
                        'result' => array("user_id" => $user->ID)
                    );
                    }
                    return array(
                        'status' => false,
                        'result' => "Soemthing goes wrong"
                    );
                }
            }
        }
    }
    
    
    
    private function get_site_administrator()
    {
        $users = get_users(array('role' => "administrator"));
        if(is_array($users) && !empty($users)){
            foreach($users as $user)
            {
                if($user->ID == 1)
                {
                    return $user->ID;
                }
                elseif(strpos($user->data->user_login,"spokal-user-do-not-delete") == false)
                {
                    return $user->ID;
                }
            }
        }
        
        return false;
    }
    
}
