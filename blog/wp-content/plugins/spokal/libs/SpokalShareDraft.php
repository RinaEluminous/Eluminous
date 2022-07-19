<?php
/*
Feature Name: Share a Draft
Author: Jasmin Trbalic
Version: 1.0
*/ 

class SpokalShareDraft{
        
        public $shared_post = null;       
        
	public function __construct(){
            add_action('init', array(&$this, 'setHooks'));
	}
        
	public function setHooks(){
            add_filter('the_posts', array(&$this, 'show_intercepted_post'));
            add_filter('posts_results', array(&$this, 'intercept_post'));
	}        
        
        public function is_shared($post_id){
            $postMeta = '';
            $postMeta = get_post_meta($post_id,'spokal_sharedraftpost',true);
            if (!isset($_GET['spokaldraftshare']) || empty($postMeta)){
                return false;
            }
            if ($postMeta == $_GET['spokaldraftshare']){
                return true;
            }
            return false;
	} 
        
        public function show_intercepted_post($posts){
            if (empty($posts) && !is_null($this->shared_post)){
                return array($this->shared_post);
            }else {
                $this->shared_post = null;
                return $posts;
            }
	}
        
	public function intercept_post($posts){
            if (1 != count($posts)){
                return $posts;
            }
            $post = $posts[0];
            $status = get_post_status($post);
            if (('draft' == $status || 'future' == $status || 'pending' == $status) && $this->is_shared($post->ID)) {
                    $this->shared_post = $post;
            }
            return $posts;
	}       

}

