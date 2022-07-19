<?php

class GPlus {
    
    
    public static $options = array(
        'googlePlusUrl' => array(
                                'name' => 'spokal_googleplus',
                                'get_function' => 'get_the_author_meta'
                            )
    );
    
    
    
    public static function init() {
        add_action('wp_head', array('GPlus', 'head'));
        add_action('spokal_unistall', array('GPlus', 'clearGPlus')); 
    }
    
    
    
    
    public static function head() {
        GPlus::author();
    }
    
    
    
    public static function author() {
        
        $gplus = "";
        
        if ( is_singular() ) {
            global $post;
            $gplus = get_the_author_meta( GPlus::$options['googlePlusUrl']['name'], $post->post_author );
        } 

        if ( $gplus ) {
                echo '<link rel="author" href="' . $gplus . '"/>' . "\n";
        }
    }
    
    
    public static function clearGPlus() {
        global $wpdb;
        $wpdb->query( 
            $wpdb->prepare( 
		"
                DELETE FROM $wpdb->usermeta
		 WHERE meta_key = %s
		",
	        GPlus::$options['googlePlusUrl']['name'] 
            )
        );
    }
    
}

GPlus::init();



?>