<?php

/*
Plugin Name: Spokal API
Plugin URI: http://getspokal.com
Description: Extends Wordpress API
Author: Chris Mack & Chris Hrica
Version: 0.4
*/

class PostSummary
{
	public $post_id;
	public $post_title;
	public $comment_count;
	public $post_name;
	public $post_date;
	public $keyword;
}

function spokal_getShortcodes ($args)
{
	//Parse and escape parameters
	global $wp_xmlrpc_server;
	$wp_xmlrpc_server->escape($args);
	
	$username	= $args[0];
	$password	= $args[1];

	//Authenticated?
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	return private_fillShortcodeList();
}



function private_fillShortcodeList()
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


function spokal_getOptions( $args )
{
	//Parse and escape parameters
	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[0]);
	$wp_xmlrpc_server->escape($args[1]);;
	
	$username	= $args[0];
	$password	= $args[1];
	$content	= $args[2];

	//Authenticated?
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	$blogId = $content['blogId'];
	$options = $content['options'];

	$returnArray = array();

	foreach ($options as $key) {
		
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

	return $returnArray;
}



function spokal_setBlogOptions( $args )
{
        //Parse and escape parameters
	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[0]);
	$wp_xmlrpc_server->escape($args[1]);;
	
	$username	= $args[0];
	$password	= $args[1];
	$content	= $args[2];

	//Authenticated?
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	$blogId = $content['blogId'];
	$optionsNew = $content['options'];

	foreach ($optionsNew as $key => $val) {
		
                //We need to check if its multisite cuz get_blog_option working only for that one
                //get_option (get_blog_option) will return false if there is no option like that in database
                if(is_multisite()) {
                    $optionOld = get_blog_option($blogId, $key);
                }
                else {
                    $optionOld = get_option($key);
                }

                //if get_option returns "false" then here (because of nature of spokal_mergeOptions function
                //we will have false vs string comparation and it will not pass
                //wich means that after execution of line "$optionOld = spokal_mergeOptions($optionOld, $val);", $optionOld = false
                //if we want to preform update_option function with "false" option value, nothing will happen
                
                //this will repair bug with "no creating new options" on first update
                if($optionOld) {
                    $optionOld = spokal_mergeOptions($optionOld, $val);
                }
                else {
                    $optionOld = $val;
                }

		if(is_multisite()) {
                    update_blog_option($blogId, $key, $optionOld );
                }
                else {
                    update_option($key, $optionOld); 
                }
                
	}

	return (string) $blogId;
}



function spokal_mergeOptions($optionOld, $optionNew, $gaurd = 0) 
{
	if((gettype($optionOld) == gettype($optionNew)) && $gaurd < 10) {

		if(is_array($optionOld) && is_array($optionNew)) {

			foreach ($optionNew as $key => $value) {
				
				if(array_key_exists($key, $optionOld))
				{
					$optionOld[$key] = spokal_mergeOptions($optionOld[$key], $optionNew[$key], $gaurd + 1);
				}
			}
		} else {
			$optionOld = $optionNew;
		}
	}

	return $optionOld;
}


function sp_isUpdatePostMeta($data)
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


function sp_updatePostMeta($data)
{
    $custom_fields = $data["custom_fields"];
    $post_id = $data["post_id"];

    foreach($custom_fields as $custom_field)
    {
        update_post_meta($post_id, $custom_field['key'], $custom_field['value']);
    }
    
    return true;
}


function spokal_editPost( $args )
{
        update_option ('spokal_last_update', date("F d, Y, H:i"));
        update_option ('spokal_connection_status', "Connected");
        
	global $wp_xmlrpc_server;
        global $wpdb;
        
	//do not double escape content
	$wp_xmlrpc_server->escape($args[1]);
	$wp_xmlrpc_server->escape($args[2]);
	
	$username	= $args[1];
	$password	= $args[2];

        //authenticated
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}
        
        $custom_fields = (isset($args[4]['custom_fields']) && is_array($args[4]['custom_fields'])) ? $args[4]['custom_fields'] : array();
        
        //Check are we trying to update just Post meta
        //And if so, update just post meta and don't update the whole post
        if(sp_isUpdatePostMeta($args[4]))
        {
            sp_updatePostMeta($args[4]);
            $post = get_post($args[3], ARRAY_A);
            $post =  spokal_prepare_post( $post, array( 'post', 'terms', 'custom_fields' ));
            $post['custom_fields'] = $custom_fields;
            return $post;
        }
        
        //XMlRPC wp_newPost API will set this post as post parrent of the attachment which URL is in the post content if attachment parent_id is "0".
        //Here we will get all attachments from database with parent_id=0, before post is published,
        //so we can remove this post as parent after it is published, from each attachment for which wp_newPost will set it
        $attachments_before = $wpdb->get_results( "SELECT ID, guid FROM {$wpdb->posts} WHERE post_parent = '0' AND post_type = 'attachment'" );
	
        $alreadyPublished = false;

	//copy custom fields and do not allow them to be saved in newPost
	$post_id = $args[3];
        spokal_checkTaxonomies($post_id, $args[4]);
        
	$args[4]['custom_fields'] = array();
        $args[4]['custom_fields'][0] = array(
                                'key' => 'spokal_source',
                                'value' => 'spokal_editor'
                                );
        
        //If post_author does not exist setting it to another administrator
        $authorChanged = false;
        if(isset($args[4]['post_author']) && $args[4]['post_author'] == 0) 
        {
            unset($args[4]['post_author']);
        }else if(isset($args[4]['post_author']))
        {
            $user = get_userdata( $args[4]['post_author'] );
            if ( $user === false ) {
                unset($args[4]['post_author']);
                $authorChanged = true;
            }
        }
        
	$args2 = $args;
        if(isset($args2[4])){
            unset($args2[4]);
        }
        
	$oldPost = $wp_xmlrpc_server->wp_getPost($args2);
        if ( $oldPost instanceof IXR_Error) {
            return $oldPost;
        }else if(is_wp_error($oldPost)){
            return new IXR_Error( 404, __( $oldPost->get_error_message() ) );
        }

	if ($oldPost['post_status'] == 'publish')
	{
		//post is already published
		$alreadyPublished = true;
	}
        
	//edit the post
	$result = $wp_xmlrpc_server->wp_editPost($args);
        
        if ( $result instanceof IXR_Error) {
            return $result;
        }else if(is_wp_error($result)){
            return new IXR_Error( 404, __( $result->get_error_message() ) );
        }
        
        //call this function after post is published to remove uploads
        remove_uploads($attachments_before,$post_id);
        
	//unset the content struct to fake getPost
	unset( $args[4] );

	//get the post
	$post = $wp_xmlrpc_server->wp_getPost($args);

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
			update_post_meta($post_id, $custom_field['key'], $custom_field['value']);
		}
	}

	array_push($custom_fields, array( 'key' => 'post_url', 'value' => get_permalink($post_id)));
	
        if($authorChanged){
            $post["publish_warnings"] = "The author couldn't be found in your WordPress site. The post has been published as the site administrator instead. Please contact support to resolve this.";
        }
        
	//set the new custom fields without grabbing the post again
	$post['custom_fields'] = $custom_fields;
	return $post;
}



/*
 * This function will be called when user creates new post via spokal dashboard (from spokal side)
 * This is xmlrpc function, and will create new post
 */
function spokal_newPost( $args )
{
    update_option ('spokal_last_update', date("F d, Y, H:i"));
    update_option ('spokal_connection_status', "Connected");
    
    global $wp_xmlrpc_server;
    global $wpdb;
    
    //do not double escape content
    $wp_xmlrpc_server->escape($args[1]);
    $wp_xmlrpc_server->escape($args[2]);

    $username	= $args[1];
    $password	= $args[2];
    //authenticated
    if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
        return $wp_xmlrpc_server->error;
    }
    
    //XMlRPC wp_newPost API will set this post as post parrent of the attachment which URL is in the post content if attachment parent_id is "0".
    //Here we will get all attachments from database with parent_id=0, before post is published,
    //so we can remove this post as parent after it is published, from each attachment for which wp_newPost will set it
    $attachments_before = $wpdb->get_results( "SELECT ID, guid FROM {$wpdb->posts} WHERE post_parent = '0' AND post_type = 'attachment'" );
    
    //copy custom fields and do not allow them to be saved in newPost
    $custom_fields = (isset($args[3]['custom_fields']) && is_array($args[3]['custom_fields'])) ? $args[3]['custom_fields'] : array();; 
    $args[3]['custom_fields'] = array();
    $args[3]['custom_fields'][0] = array(
                                'key' => 'spokal_source',
                                'value' => 'spokal_editor'
                                );
    
    if(isset($args[3]['post_type']) && $args[3]['post_type'] === "post"){
        $args[3]['comment_status'] = get_option("default_comment_status");
    }
    
    //If post_author does not exist setting it to another administrator
    $authorChanged = false;
    if(isset($args[3]["post_author"])){
        $user = get_userdata( $args[3]["post_author"] );
        if ( $user === false ) {
            $author_id = spokal_get_site_administrator();
            if($author_id != false){
                $args[3]["post_author"] = $author_id;
                $authorChanged = true;
            }
        }
    }
    
    //save the post
    $post_id = $wp_xmlrpc_server->wp_newPost($args);
    
    if ( $post_id instanceof IXR_Error) {
        return $post_id;
    }else if(is_wp_error($post_id)){
        return new IXR_Error( 404, __( $post_id->get_error_message() ) );
    }
    
    //call this function after post is published to remove uploads
    remove_uploads($attachments_before,$post_id);
    
    //unset the content struct to fake getPost
    unset( $args[3] );
    $args[3] = $post_id;

    //get the post
    $post = $wp_xmlrpc_server->wp_getPost($args);
    //add custom spokal (was seoal) fields
    if($post['post_status'] == 'publish') {
        array_push($custom_fields, array( 'key' => 'spokal_url', 'value' => get_permalink($post_id)));
    }

    //this will merge instead of creating new ones
    foreach ($custom_fields as $custom_field) {
        update_post_meta($post_id, $custom_field['key'], $custom_field['value']);
    }
    
    array_push($custom_fields, array( 'key' => 'post_url', 'value' => get_permalink($post_id)));

    //set the new custom fields without grabbing the post again
    $post['custom_fields'] = $custom_fields;
    if($authorChanged){
        $post["publish_warnings"] = "The author couldn't be found in your WordPress site. The post has been published as the site administrator instead. Please contact support to resolve this.";
    }
    return $post;
}



function spokal_prepare_post( $post, $fields ) {
    // Holds the data for this post. built up based on $fields.
    $_post = array( 'post_id' => strval( $post['ID'] ) );

    // Prepare common post fields.
    $post_fields = array(
            'post_title'        => $post['post_title'],
            'post_date'         => spokal_convert_date( $post['post_date'] ),
            'post_date_gmt'     => spokal_convert_date_gmt( $post['post_date_gmt'], $post['post_date'] ),
            'post_modified'     => spokal_convert_date( $post['post_modified'] ),
            'post_modified_gmt' => spokal_convert_date_gmt( $post['post_modified_gmt'], $post['post_modified'] ),
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
    
    // Consider future posts as published.
    if ( $post_fields['post_status'] === 'future' )
            $post_fields['post_status'] = 'publish';

    // Fill in blank post format.
    $post_fields['post_format'] = get_post_format( $post['ID'] );
    if ( empty( $post_fields['post_format'] ) )
            $post_fields['post_format'] = 'standard';

    // Merge requested $post_fields fields into $_post.
    if ( in_array( 'post', $fields ) ) {
            $_post = array_merge( $_post, $post_fields );
    } else {
            $requested_fields = array_intersect_key( $post_fields, array_flip( $fields ) );
            $_post = array_merge( $_post, $requested_fields );
    }
    
    return $_post;
}


function spokal_convert_date( $date ) {
       if ( $date === '0000-00-00 00:00:00' ) {
               return new IXR_Date( '00000000T00:00:00Z' );
       }
       return new IXR_Date( mysql2date( 'Ymd\TH:i:s', $date, false ) );
}

function spokal_convert_date_gmt( $date_gmt, $date ) {
       if ( $date !== '0000-00-00 00:00:00' && $date_gmt === '0000-00-00 00:00:00' ) {
               return new IXR_Date( get_gmt_from_date( mysql2date( 'Y-m-d H:i:s', $date, false ), 'Ymd\TH:i:s' ) );
       }
       return spokal_convert_date( $date_gmt );
}

function spokal_get_site_administrator()
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



/*
 * This function will be calle from spokal_newPost. 
 * It will compare array of attachments with parent_id=0 before post is published with array of attachments with parent_id={thisPostID}.
 * If some attachments matches, it will reset parent_id to "0" again to revert it as it was before post is published
 * We are doing this because this behavior is not the same like from WP Editor, and we want it to be the same
 */
function remove_uploads($attachments_before,$post_id)
{
    global $wpdb;
    $attachments_after = $wpdb->get_results( "SELECT ID, guid FROM {$wpdb->posts} WHERE post_parent = {$post_id} AND post_type = 'attachment'" );
    
    if(is_array($attachments_before) && is_array($attachments_after)){
        foreach($attachments_after as $file){
            if(in_array($file,$attachments_before)){
                $wpdb->update($wpdb->posts, array('post_parent' => '0'), array('ID' => $file->ID) );
            }
        }
    }
}



function spokal_checkTaxonomies($postId, $args)
{
    if ( isset($args['post_category']) && is_array($args['post_category'])
                         && 0 === count($args['post_category']) )
        {
            wp_set_post_categories( $postId, array());
        }
		
        if(isset($args['terms_names']['post_tag'])
                && is_array($args['terms_names']['post_tag'])
                && 0 === count($args['terms_names']['post_tag'])){
            wp_set_post_tags( $postId, array());
        }
}



function spokal_deletePost($args){
    global $wp_xmlrpc_server;
    
    $post_id = $args[3];
    update_post_meta($post_id,'spokal_deleting_post','true');
    
    return $wp_xmlrpc_server->wp_deletePost($args);
}



function spokal_updatePostMeta($args)
{
    global $wp_xmlrpc_server;

    //do not double escape content
    $wp_xmlrpc_server->escape($args[0]);
    $wp_xmlrpc_server->escape($args[1]);

    $username	= $args[0];
    $password	= $args[1];
    //authenticated
    if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
        return $wp_xmlrpc_server->error;
    }
    
    $post_id = $args[2]['post_id'];
    $custom_fields = $args[2]['post_meta'];
    
    foreach($custom_fields as $custom_field){
        update_post_meta($post_id, $custom_field['key'], $custom_field['value']);
    }
    
    return true;
}




function spokal_getPostMeta($args)
{
    //Parse and escape parameters
    global $wp_xmlrpc_server;

    //do not double escape content
    $wp_xmlrpc_server->escape($args[0]);
    $wp_xmlrpc_server->escape($args[1]);;

    $username	= $args[0];
    $password	= $args[1];
    $content	= $args[2];

    //Authenticated?
    if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
            return $wp_xmlrpc_server->error;
    }

    $post_id = $content['post_id'];
    $meta_fields = $content['post_meta'];

    $returnArray = array();

    foreach ($meta_fields as $key) {

        $optionNew = get_post_meta( $post_id, $key, true );

        $returnArray[$key] = $optionNew;
    }

    return $returnArray;
}



function spokal_getAvailablePostTypeNames($args)
{
    global $wp_xmlrpc_server;

    //do not double escape content
    $wp_xmlrpc_server->escape($args[1]);
    $wp_xmlrpc_server->escape($args[2]);

    //siteId is $args[0]. really should keep to a consistent pattern...

    $username	= $args[1];
    $password	= $args[2];

    //authenticated
    if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
            return $wp_xmlrpc_server->error;
    }
    
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
    
    return $post_counts;
}



function spokal_getAllContent( $args )
{
	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[1]);
	$wp_xmlrpc_server->escape($args[2]);

	//siteId is $args[0]. really should keep to a consistent pattern...

	$username	= $args[1];
	$password	= $args[2];

	//authenticated
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}
        
        $offset = $args[3];
	$number = $args[4];
        $post_type = $args[5];

	if (!is_numeric($number))
	{
	     $number = 50;
	}
        
        $returnArray = array();
        $args = array(
	    'numberposts'     => $number,
	    'offset'	      => $offset,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_type'       => array($post_type),
            'post_status'     => array('publish')
        );
        
        $posts_array = get_posts( $args );
        foreach($posts_array as $postItem) {
            $tempSummary = array();
            $tempSummary['post_id'] = (string)$postItem->ID;
            $tempSummary['post_title'] = $postItem->post_title;
	    $tempSummary['post_date'] = $postItem->post_date;
	    $tempSummary['post_modified'] = $postItem->post_modified;
	    $tempSummary['post_type'] = $postItem->post_type;
            $tempSummary['post_url'] = get_permalink( $postItem->ID);
            $tempSummary['spokal_focuses'] = get_post_meta($postItem->ID, 'spokal_focuses', true); 
            
            $object = json_decode(json_encode($tempSummary), FALSE);
                    
                    
            $returnArray[] = $object;
        }

	return $returnArray;
}



function spokal_getPostSummaries( $args )
{
    
        update_option ('spokal_last_update', date("F d, Y, H:i"));
        update_option ('spokal_connection_status', "Connected");
        
	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[1]);
	$wp_xmlrpc_server->escape($args[2]);

	//siteId is $args[0]. really should keep to a consistent pattern...

	$username	= $args[1];
	$password	= $args[2];

	//authenticated
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	$offset = $args[3];
	$number = $args[4];

	if (!is_numeric($number))
	{
	     $number = 50;
	}
        
        $returnArray = array();
        $args = array(
	    'numberposts'     => $number,
	    'offset'	      => $offset,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_type'       => array('post', 'page'),
            'post_status'     => array("publish","draft","future","pending")
        );
        
        $posts_array = get_posts( $args );
        //$tempSummary = new PostSummary();
        foreach($posts_array as $postItem) {
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
	    $tempSummary['post_status'] = ($postItem->post_status !== "publish") ? "draft" : $postItem->post_status;;
            $tempSummary['post_url'] = get_permalink( $postItem->ID);
            
            $object = json_decode(json_encode($tempSummary), FALSE);
                    
                    
            $returnArray[] = $object;
        }

	
	return $returnArray;
}



function spokal_getUsers($args){
    
	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[0]);
	$wp_xmlrpc_server->escape($args[1]);
	
	$username	= $args[0];
	$password	= $args[1];
	//authenticated
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	$users = get_users('fields=all_with_meta');
        
        $spokal_filter = 'spokal_filter_two_roles';
        if(isset($args[2])){
            if($args[2]){
                $spokal_filter = 'spokal_filter_four_roles';
            }   
        }
        
	foreach(array_filter($users, $spokal_filter) as $user) {
            if($user->user_login != $username) {
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

	return $returnArray;
}


function spokal_filter_two_roles($user) {
    $roles = array('editor','administrator');
    return in_array($user->roles[0], $roles);
}


function spokal_filter_four_roles($user) {
    $roles = array('editor','administrator','author','contributor');
    return in_array($user->roles[0], $roles);
}



//does nothing but ensure the user has rights
function spokal_checkUser($args)
{
  	global $wp_xmlrpc_server;

	//do not double escape content
	$wp_xmlrpc_server->escape($args[0]);
	$wp_xmlrpc_server->escape($args[1]);
	
	$username	= $args[0];
	$password	= $args[1];
	//authenticated
	if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
		return $wp_xmlrpc_server->error;
	}

	return true;
}



function spokal_getUrlForPost($args) 
{
	$content = $args[2];
	$postId = $content['postId'];
	$permalink = "";
	if(is_multisite()) {
		$blogId = $content['blogId'];
		$permalink = get_blog_permalink($blogId, $postId);
	}
	else {
		$permalink = get_permalink( $postId );
	}
	return $permalink;
}



function spokal_uploadCss($args) 
{
    global $wp_xmlrpc_server;

    //do not double escape content
    $wp_xmlrpc_server->escape($args[0]);
    $wp_xmlrpc_server->escape($args[1]);

    $username	= $args[0];
    $password	= $args[1];
    //authenticated
    if ( !$user = $wp_xmlrpc_server->login($username, $password) ) {
            return $wp_xmlrpc_server->error;
    }
    
    $content = $args[2];
    
    $fileName = $content["fileName"];
    $fileContent = base64_decode($content["fileContents"]);
    
    
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
            return $fileName;
        }
        else {
            return "Something went wrong";
        }
    }
    else {
        return $fileName;
    }
}



function spokal_filter_get_post($_post, $post, $fields)
{
    if(is_array($_post)){
        $_post["shortcodes"] = private_fillShortcodeList();
        $_post["post_status"] = $post["post_status"] != "publish" ? "draft" : $_post["post_status"];
    }
    
    return $_post;
}


function spokal_getPost($args)
{
    global $wp_xmlrpc_server;
        
    $post =  $wp_xmlrpc_server->wp_getPost($args);
        
    if(is_array($post) && !isset($post["shortcodes"]))
    {
        $post["shortcodes"] = private_fillShortcodeList();
    }
    
    return $post;
}

function spokal_getTerms($args)
{
    global $wp_xmlrpc_server;
    
    $wp_xmlrpc_server->escape($args[1]);
    $wp_xmlrpc_server->escape($args[2]);

    $username       = $args[1];
    $password       = $args[2];
    $taxonomies     = $args[3];
    $filter         = isset( $args[4] ) ? $args[4] : array();

    if ( ! $user = $wp_xmlrpc_server->login( $username, $password ) )
            return $wp_xmlrpc_server->error;

    $struct = array();

    foreach($taxonomies as $taxonomy)
    {
        if ( ! taxonomy_exists( $taxonomy ) )
                return new IXR_Error( 403, __( 'Invalid taxonomy' ) );

        $taxonomy = get_taxonomy( $taxonomy );

        if ( ! current_user_can( $taxonomy->cap->assign_terms ) )
                return new IXR_Error( 401, __( 'You are not allowed to assign terms in this taxonomy.' ) );

        $query = array();

        if ( isset( $filter['number'] ) )
                $query['number'] = absint( $filter['number'] );

        if ( isset( $filter['offset'] ) )
                $query['offset'] = absint( $filter['offset'] );

        if ( isset( $filter['orderby'] ) ) {
                $query['orderby'] = $filter['orderby'];

                if ( isset( $filter['order'] ) )
                        $query['order'] = $filter['order'];
        }

        if ( isset( $filter['hide_empty'] ) )
                $query['hide_empty'] = $filter['hide_empty'];
        else
                $query['get'] = 'all';

        if ( isset( $filter['search'] ) )
                $query['search'] = $filter['search'];

        $terms = get_terms( $taxonomy->name, $query );

        if ( is_wp_error( $terms ) )
                return new IXR_Error( 500, $terms->get_error_message() );

        foreach ( $terms as $term ) {
                $struct[] = spokal_prepare_term( $term );
        }
    }

    return $struct;
}

function spokal_prepare_term( $term ) {
    $_term = $term;
    if ( ! is_array( $_term ) )
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

function spokal_uploadFile($args)
{
    global $wp_xmlrpc_server;
    
    return $wp_xmlrpc_server->mw_newMediaObject($args);
}



function spokal_new_xmlrpc_methods( $methods ) {
	$methods['spokal.setBlogOptions'] = 'spokal_setBlogOptions';
	$methods['spokal.getShortcodes'] = 'spokal_getShortcodes';
	$methods['spokal.editPost'] = 'spokal_editPost';
	$methods['spokal.deletePost'] = 'spokal_deletePost';
        $methods['spokal.newPost'] = 'spokal_newPost';
        $methods['spokal.updatePostMeta'] = 'spokal_updatePostMeta';
        $methods['spokal.getPostMeta'] = 'spokal_getPostMeta';
        $methods['spokal.getPostSummaries'] = 'spokal_getPostSummaries';
        $methods['spokal.getAllContent'] = 'spokal_getAllContent';
        $methods['spokal.getAvailablePostTypeNames'] = 'spokal_getAvailablePostTypeNames';
	$methods['spokal.getUrlForPost'] = 'spokal_getUrlForPost';
	$methods['spokal.getUsers'] = 'spokal_getUsers';
	$methods['spokal.checkUser'] = 'spokal_checkUser';
	$methods['spokal.getOptions'] = 'spokal_getOptions';
        $methods['spokal.uploadCss'] = 'spokal_uploadCss';
        $methods['spokal.getPost'] = 'spokal_getPost';
        $methods['spokal.getTerms'] = 'spokal_getTerms';
        $methods['spokal.uploadFile'] = 'spokal_uploadFile';
        
    return $methods;   
}
add_filter( 'xmlrpc_methods', 'spokal_new_xmlrpc_methods');
add_filter('xmlrpc_prepare_post', 'spokal_filter_get_post',10,3);


?>
