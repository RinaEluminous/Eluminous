<?php
class Spokal_Sitemaps_Admin{
    
    /**
     * Holds the Spokal XML Sitemaps options
     *
     * @var array $options
     */
    private $options = array();
    
    
    
    public static function getInstance(){
        global $Spokal_Sitemaps_Admin;

        if($Spokal_Sitemaps_Admin == null)
                $Spokal_Sitemaps_Admin = new Spokal_Sitemaps_Admin();

        return $Spokal_Sitemaps_Admin;
    }
    
    
    
    public function __construct(){
        
        $this->options = get_option('spokal_xml_sitemaps',array(
                                                            'enable' => 'true',
                                                            'exclude_post_types' => array(),
                                                            'exclude_taxonomies' => array(),
                                                            'max_entries' => 1000,
                                                            'disable_user' => "true",
                                                            'exclude_users' => array(),
                                                            'no_author_user' => "true"
                                                        ));
        add_action( 'init', array(&$this,'spokal_xml_sitemaps_init'), 1 );
        add_action( 'spokal_ping_search_engines', array(&$this,'spokal_ping_search_engines') );
        
        add_action( 'transition_post_status', array( $this, 'status_transition' ), 10, 3 );
        add_action( 'admin_init', array( $this, 'delete_sitemaps' ) );
        
        add_action( 'plugins_loaded', array(&$this,'spokal_init'), 14 );
        
        add_action('created_term', array(&$this,'clear_taxonomy_transient'));
        add_action('edited_term', array(&$this,'clear_taxonomy_transient'));
        add_action('delete_term', array(&$this,'clear_taxonomy_transient'));
        
        add_action( 'profile_update', array(&$this,'clear_author_transient'));
        add_action( 'user_register', array(&$this,'clear_author_transient'));
        add_action( 'delete_user', array(&$this,'clear_author_transient') ); 
    }
    
    
    
    
    public function spokal_init(){
        
        if ( $this->options['enable'] === "true" ) {
		$GLOBALS['spokal_sitemaps'] = new Spokal_Sitemaps();
	}
    }
    
    
    
    /**
    * Redirect /sitemap.xml to /sp-sitemap.xml
    */
    public function spokal_xml_redirect_sitemap() {
            global $wp_query;

            $current_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
            $current_url .= sanitize_text_field( $_SERVER['SERVER_NAME'] ) . sanitize_text_field( $_SERVER['REQUEST_URI'] );

            // must be 'sitemap.xml' and must be 404
            if ( home_url( '/sitemap.xml' ) == $current_url && $wp_query->is_404 ) {
                    wp_redirect( home_url( '/sp-sitemap.xml' ), 301 );
                    exit;
            }
    }
    
    
    
    
    /**
    * Create base URL for the sitemaps and applies filters
    *
    * @since 1.5.7
    *
    * @param string $page page to append to the base URL
    *
    * @return string base URL (incl page) for the sitemaps
    */
    public static function spokal_xml_sitemaps_base_url( $page ) {
            $base = $GLOBALS['wp_rewrite']->using_index_permalinks() ? 'index.php/' : '/';

            return home_url( $base . $page );
    }
    
    
    
    
    /**
    * Initialize sitemaps. Add sitemap & XSL rewrite rules and query vars
    */
    public function spokal_xml_sitemaps_init() {
        global $wp_rewrite;

	if ( $this->options['enable'] !== "true" ) {
		return;
	}
        
	// redirects sitemap.xml to sitemap_index.xml
	add_action( 'template_redirect', array(&$this,'spokal_xml_redirect_sitemap'), 0 );
	if ( ! is_object( $GLOBALS['wp'] ) ) {
		return;
	}
        
	$GLOBALS['wp']->add_query_var( 'sp_sitemap' );
	$GLOBALS['wp']->add_query_var( 'sp_sitemap_n' );
	$GLOBALS['wp']->add_query_var( 'sp_xsl' );
	add_rewrite_rule( 'sp-sitemap\.xml$', 'index.php?sp_sitemap=1', 'top' );
	add_rewrite_rule( '([^/]+?)-sp-sitemap([0-9]+)?\.xml$', 'index.php?sp_sitemap=$matches[1]&sp_sitemap_n=$matches[2]', 'top' );
	add_rewrite_rule( '([a-z]+)?-?sp-sitemap\.xsl$', 'index.php?sp_xsl=$matches[1]', 'top' );
    }
    
    
    
    /**
    * Notify search engines of the updated sitemap.
    *
    * @param string|null $sitemapurl
    */
    function spokal_ping_search_engines( $sitemapurl = null ) {
            // Don't ping if blog is not public
            if ( '0' == get_option( 'blog_public' ) ) {
                    return;
            }

            if ( $sitemapurl == null ) {
                $sitemapurl = urlencode( $this->spokal_xml_sitemaps_base_url( 'sp-sitemap.xml' ) );
            }
            
            
            wp_remote_get( 'http://www.google.com/webmasters/tools/ping?sitemap=' . $sitemapurl );
            wp_remote_get( 'http://www.bing.com/ping?sitemap=' . $sitemapurl );
    }
    
    
    
    /**
    * Find sitemaps residing on disk as they will block our rewrite.
    *
    * @todo issue #561 https://github.com/Yoast/wordpress-seo/issues/561
    */
    function delete_sitemaps() {
            // HARDCODED
            $options['blocking_files'] = array();
            // HARDCODED
            
            if ( $this->options['enable'] === "true" ) {

                    $file_to_check_for = array(
                            // ABSPATH . 'sitemap.xml',
                            // ABSPATH . 'sitemap.xslt',
                            // ABSPATH . 'sitemap.xsl',
                            ABSPATH . 'sp-sitemap.xml',
                    );

                    $new_files_found = false;

                    foreach ( $file_to_check_for as $file ) {
                            if ( ( $options['blocking_files'] === array() || ( $options['blocking_files'] !== array() && in_array( $file, $options['blocking_files'] ) === false ) ) && file_exists( $file ) ) {
                                    $options['blocking_files'][] = $file;
                                    $new_files_found             = true;
                            }
                    }
                    if ( $new_files_found === true ) {
                            update_option( 'sp_blocking_files', $options );
                    }
            }
    }

    /**
     * Hooked into transition_post_status. Will initiate search engine pings
     * if the post is being published, is a post type that a sitemap is built for
     * and is a post that is included in sitemaps.
     *
     * @param string   $new_status New post status.
     * @param string   $old_status Old post status.
     * @param \WP_Post $post       Post object.

     */
    function status_transition( $new_status, $old_status, $post ) {
            delete_transient('spokal_sitemap_cache_1_1');
            $this->clear_post_transient($post->post_type);
            
            if ( $new_status != 'publish' ) {
                    return;
            }
            
            wp_cache_delete( 'lastpostmodified:gmt:' . $post->post_type, 'timeinfo' ); 

            if (in_array($post->post_type, $this->options['exclude_post_types'])
                || in_array($post->post_type, array('attachment'))
                ) {
                    return;
            }
            
            if ( WP_CACHE ) {
                    wp_schedule_single_event( (time() + 300), 'spokal_hit_sitemap_index' );
            }

            if ( defined( 'SPOKAL_PING_IMMEDIATELY' ) && SPOKAL_PING_IMMEDIATELY ) {
                    $this->spokal_ping_search_engines();
            }
            else {
                    wp_schedule_single_event( ( time() + 300 ), 'spokal_ping_search_engines' );
            }
    }
    
    
    
    
    public function clear_post_transient($post_type){
            global $wpdb;
            $query = $wpdb->prepare( "SELECT COUNT(ID) FROM $wpdb->posts WHERE post_status IN ('publish','inherit') AND post_password = '' AND post_author != 0 AND post_date != '0000-00-00 00:00:00' AND post_type = %s ", $post_type );
            $count = $wpdb->get_var( $query );
            $n = ( $count > $this->options['max_entries'] ) ? (int) ceil( $count / $this->options['max_entries'] ) : 1;
            for($i=1; $i <= $n; $i++){
                $tranzient = get_transient( 'spokal_sitemap_cache_' . $post_type . '_' . $i );
                if($tranzient || '' == $tranzient){
                    delete_transient('spokal_sitemap_cache_' . $post_type . '_' . $i );
                }
            }
    }
    
    
    
    
    public function clear_author_transient(){
            delete_transient('spokal_sitemap_cache_1_1');
            if ( $this->options['no_author_user'] === "true" ) {
                $users = get_users( array( 'fields' => 'id' ) );
            }else{
                $users = get_users( array( 'who' => 'authors', 'fields' => 'id' ) );
            }

            $count = count( $users );
            $n = ( $count > $this->options['max_entries'] ) ? (int) ceil( $count / $this->options['max_entries'] ) : 1;
            for($i=1; $i <= $n; $i++){
                $tranzient = get_transient( 'spokal_sitemap_cache_' . 'author' . '_' . $i );
                if($tranzient || '' == $tranzient){
                    delete_transient('spokal_sitemap_cache_' . 'author' . '_' . $i );
                }
            }
    }
    
    
    
    
    public function clear_taxonomy_transient(){
        global $wpdb;
        delete_transient('spokal_sitemap_cache_1_1');
        $taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
        $taxonomy_names = array_keys( $taxonomies );
        $query = "SELECT taxonomy, term_id FROM $wpdb->term_taxonomy WHERE  taxonomy IN ('" . implode( "','", $taxonomy_names ) . "');";
        $all_taxonomy_terms = $wpdb->get_results( $query );
        
        $all_taxonomies     = array();
        foreach ( $all_taxonomy_terms as $obj ) {
                $all_taxonomies[ $obj->taxonomy ][] = $obj->term_id;
        }
        unset( $all_taxonomy_terms );
        foreach ( $taxonomies as $tax_name => $tax ) {
            $count = ( isset ( $all_taxonomies[ $tax_name ] ) ) ? count( $all_taxonomies[ $tax_name ] ) : 1;
            $n     = ( $count > $this->options['max_entries'] ) ? (int) ceil( $count / $this->options['max_entries'] ) : 1;
            for ( $i = 1; $i <= $n; $i ++ ) {
                $tranzient = get_transient( 'spokal_sitemap_cache_' . $tax_name . '_' . $i );
                if($tranzient || '' == $tranzient){
                    delete_transient('spokal_sitemap_cache_' . $tax_name . '_' . $i );
                }
            }
        }
    }
    
    
    
    
    public function clear_sitemap_cache(){
        delete_transient('spokal_sitemap_cache_1_1');
        $post_types = get_post_types( array( 'public' => true ), 'objects');
        if ( is_array( $post_types ) && $post_types !== array() ) {
            foreach ( $post_types as $pt ) { 
                $this->clear_post_transient($pt->name);
            }
        }
        $this->clear_taxonomy_transient();
        $this->clear_author_transient();
    }
}
?>