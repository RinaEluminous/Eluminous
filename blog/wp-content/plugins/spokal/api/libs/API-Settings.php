<?php


class Spokal_API_Settings{
    
    public function __construct()
    {
        add_action( 'init', array($this,'spokal_endpoints'), 1 );
        
        add_action( 'template_redirect', array($this,'spokal_api_loaded'), -100 );
        
        add_action( 'init', array($this,'spokal_maybe_flush_rewrites'), 999 );
        
    }
    
    
    public function spokal_endpoints(){
        global $wp_rewrite;

	if ( ! is_object( $GLOBALS['wp'] ) ) {
		return;
	}
        
	$GLOBALS['wp']->add_query_var( 'spokal_api' );

	add_rewrite_rule( '^spokal/api/?$', 'index.php?spokal_api=1', 'top' );
    }
    
    
    public function spokal_api_loaded()
    {
        if ( empty( $GLOBALS['wp']->query_vars['spokal_api'] ) )
		return;
        
        if(!empty($_GET["sp_check"]) && $_GET["sp_check"] == "true"){
            echo  "ok";
            die();
        }
        
        $ajaxHandler = new SpokalGzipAPI(false);
        
	die();
    }
    
    
    public function spokal_maybe_flush_rewrites()
    {
        if(get_option("spokal_flush_rulles",false) === "true")
        {
            add_action( 'shutdown', 'flush_rewrite_rules' );
            delete_option("spokal_flush_rulles");
        }
    }
}