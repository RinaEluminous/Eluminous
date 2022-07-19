<?php

class Spokal_SEO_Auto_Linker_Front 
{
    
    /*
     * Javascript to fill global keywords variable
     */
    private static $keywords_script = "";
    
    /*
     * Adds actions and filters and such
     *
     * @since 0.7
     */
    public function __construct()
    {
        add_filter('the_content', array($this, 'content'), 1);
        add_action('wp_footer', array($this, 'push_keywords'), 1);
    }
    
    public static function getKeywords()
    {
        global $wpdb;
        
        $query = " SELECT * FROM $wpdb->postmeta WHERE meta_key = 'spokal_keywords' AND meta_value IS NOT NULL AND meta_value <> ''";
        return $wpdb->get_results($query);
    }
    
    public function push_keywords()
    {
        
        if(!self::is_enabled()){
            return;
        }
        
        if(empty(self::$keywords_script)){
            return;
        }
        
        $scriptAddition = '<script type="text/javascript">keywords.push(';
        $scriptAddition .= rtrim(self::$keywords_script, ",");
        $scriptAddition .= ');</script>'; 
        
        echo $scriptAddition;
    }
    
    /*
     * Main event.  Filters the conntent to add links
     *
     * @since 0.7
     */
    public function content($content){
        global $post;
        if(!self::is_enabled()){
            return $content;
        }
        
        if(!in_the_loop()){
            return $content;
        }
        /*
         * Fetching all keywords and post links associated with them
         */
        $keywords = self::getKeywords();
        if(empty($keywords)) {
            return $content;
        }
        
        
        /*
         * Here we are going to loop throught all keywords and will check wich of them are inside our current post
         * If there is not keywords at all, we will just return content how it is
         * If there is, we will extract those keywords for further looping
         */
        self::$keywords_script = "";
        $climiter = 0;
        $options = SpokalVars::getInstance()->options;
        
        foreach($keywords as $keyword) {
            if($options["auto_linking_single_word"]["value"] === "true" && (str_word_count($keyword->meta_value) <= 1 )){continue;}
            if($climiter > 15) {break;}
            if(get_post_status( $keyword->post_id ) !== "publish" ){continue;}
            if((strpos(wp_specialchars_decode($content), $keyword->meta_value) != false) && $post->ID != $keyword->post_id) {
                self::$keywords_script .= '['.json_encode($keyword->meta_value).', "'.get_permalink($keyword->post_id).'"],';
                $climiter++;
            }
        }
        
        if(empty(self::$keywords_script)) {
            return $content;
        }

        return '<div data-spokal="postcontainer">'.$content.'</div>';
    }
        
    public static function is_enabled(){
        global $post;
        
        /*
         * We are calling this function as part of the "the_content" hook.
         * We need to make sure that this will be called only on single post page.
         * If somene used "the_content" function on homepage in their themes, we will have problems.
         * With statement bellow we are making sure that this linking thing will happpen only on single post page
         */
        if(!is_singular('post')) {
            return false;
        }
        
        /*
         * Checking is linking allowed
         * (for example on standalone installation user is able to enable or disable linking
         */
        if(!self::allowed($post)) {
            return false;
        }
        
        /*
         * Checking is linking allowed
         * (for example on standalone installation user is able to enable or disable linking
         */
        if(!self::is_spokal_post($post)) {
            return false;
        }

        return true;
    }    
    
    /*
     * Determins whether or not a post can be editted
     * By Spokal: Main version of this method contains inbuilt seoal things
     * Spokal added one more thing, "spokal_auto_linking" in order to allow user to enable or to disable
     * linking
     */
    protected static function allowed($post){
        $rv = true;
        $options = SpokalVars::getInstance()->options;
        
	//see if this thing should be turned on or not
	if ($options['auto_linking']['value'] === 'true')
		$rv = false;

        if(!is_singular()) 
            $rv = false;

        if(strpos($post->post_content, '<!--nolinks-->') !== false)
            $rv = false;

	//modded 21 Jan 2013
	if (get_post_type($post) != 'post')
		$rv = false;

        return $rv;
    }
    
    /*
     * Determins whether or not a post comes from Spokal editor
     */
    protected static function is_spokal_post($post){
        $spokalPostMeta = get_post_meta($post->ID,'spokal_css_url');
        return !empty($spokalPostMeta);
    }
}

$sp_auto_linker = new Spokal_SEO_Auto_Linker_Front();
