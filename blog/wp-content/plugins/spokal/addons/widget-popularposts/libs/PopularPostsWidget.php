<?php

class PopularPostsWidgetInit{
    
    
    public function __construct() {
        global $sp_popular_impressions;
        $sp_popular_impressions = array();
        // register LeadGeneratorWidget widget
        add_action( 'widgets_init', create_function( '', 'register_widget( "PopularPostsWidget" );' ) );
        add_action('wp_footer', array(&$this, 'trackCompesion'),10);
    }
    
    
    
    
    public function trackCompesion(){
        if(SpokalVars::getInstance()->scriptPopularInteractions){
            echo SpokalVars::getInstance()->scriptPopularInteractions;
        }
    }
    
}




class PopularPostsWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Spokal_Most_Popular_Posts', // Base ID
            'Spokal A/B Test Most Popular Posts', // Name
            array( 'description' => __( 'Spokal A/B Test Most Popular Posts', 'text_domain' ),
                    'classname' => 'spokal_popular_posts widget_recent_entries'
                ) // Widget Options
        );

    }
    
    
    
    
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $posts_number = $instance['posts_number'];
        $ab_posts = $instance['ab_posts'];
        if(isset($instance['categories'])){
            $selected_cat = is_array($instance['categories']) ? $instance['categories'] : array();
        }else{
            $selected_cat = array();
        }
        
        if(isset($instance['custom_posts']) && !empty($instance['custom_posts'])){
            $custom_posts = is_array($instance['custom_posts']) ? $instance['custom_posts'] : array("post");
        }else{
            $custom_posts = array("post");
        }

        
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        
        $posts_array = array();
        $popular_posts = get_option("spokal_most_popular",false);
        if($popular_posts){
            $popular_posts = explode(",",$popular_posts);
            $posts_array = $this->get_popular_posts($ab_posts,$posts_number,$popular_posts,$selected_cat,$custom_posts);
        }else{
            $posts_array = $this->get_recent_posts($ab_posts,$posts_number,$selected_cat,$custom_posts);
        }
        
        $widget_posts = $this->prepare_posts($posts_array,$widget_id);
        ?>

        <ul>
            <?php 
            foreach($widget_posts as $post){ ?>
                <li >
                    <a id="spTrack_<?php echo $post['postID']."-".$widget_id; ?>" href="<?php echo $post['permalink']; ?>"><?php echo $post['title']; ?></a>
                </li>
      <?php }
            ?>
        </ul>
        <?php
        
        echo $after_widget;   
    }    
    
    
    
    
    public function get_recent_posts($ab_posts,$posts_number,$selected_cat,$custom_posts){
        if($ab_posts){
            global $wpdb;
            $title_query = $this->create_posts_query($custom_posts,$posts_number,$selected_cat);
            $posts_array = $wpdb->get_results($title_query);
        }else{
            $args = array(
                'posts_per_page'   => $posts_number,
                'offset'           => 0,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => $custom_posts,
                'post_status'      => 'publish',
                'category'         => implode(",",$selected_cat),
            ); 
            $posts_array = get_posts( $args );
        }
        
        return $posts_array;
    }
    
    
    
    
    public function create_posts_query($custom_posts,$posts_number,$selected_cat,$popular_posts = array())
    {
        global $wpdb;
        
        if(count($custom_posts) == 1 && in_array("post", $custom_posts)){
            $type_query = 'p.post_type = "post"';
        }else{
            $type_query = "(";
            foreach($custom_posts as $type){
                $type_query .= 'p.post_type = "'.$type.'" OR ';
            }
            $type_query = rtrim($type_query,"OR ");
            $type_query .= ")";
        }
        
        $id_query = "";
        if(!empty($popular_posts)){
            $id_query = "(";
            foreach($popular_posts as $id){
                $id_query .= 'p.ID = "'.$id.'" OR ';
            }
            $id_query= rtrim($id_query,"OR ");
            $id_query .= ") AND";
        }
        
        if(!$posts_number == false)
        { 
            $limit = ' LIMIT '.$posts_number;
        }
        
        if(empty($selected_cat)){
            return 'SELECT * FROM '.$wpdb->posts.' AS p, '.$wpdb->postmeta.' AS m WHERE '
                        . 'p.post_status = "publish" AND '
                        . $id_query
                        . $type_query.' AND '
                        . 'm.post_id = p.ID AND '
                        . 'm.meta_key = "spokal_alt_title" AND '
                        . 'm.meta_value != "" '
                        . 'ORDER BY post_date DESC'
                        . $limit.';';
        }
        
        $cat_query = "t.object_id = p.ID AND (";
        foreach($selected_cat as $cat_id){
            $cat_query .= 't.term_taxonomy_id = "'.$cat_id.'" OR ';
        }
        $cat_query = rtrim($cat_query,"OR ");
        $cat_query .= ")";
        
        return 'SELECT * FROM '.$wpdb->posts.' AS p, '.$wpdb->postmeta.' AS m, '.$wpdb->term_relationships.' AS t WHERE '
                        . 'p.post_status = "publish" AND '
                        . $id_query
                        . $type_query.' AND '
                        . 'm.post_id = p.ID AND '
                        . 'm.meta_key = "spokal_alt_title" AND '
                        . 'm.meta_value != "" AND '
                        . $cat_query. ' '
                        . 'ORDER BY post_date DESC'
                        . $limit.';';
                
    }
    
    
    
    
    public function get_popular_posts($ab_posts,$posts_number,$popular_posts,$selected_cat,$custom_posts){
        
        if($ab_posts){
            global $wpdb;
            $title_query = $this->create_posts_query($custom_posts,false,$selected_cat,$popular_posts);
            $posts = $wpdb->get_results($title_query);
        }else{
            $args = array(
                'offset'           => 0,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => $custom_posts,
                'post__in'         => $popular_posts,
                'post_status'      => 'publish',
                'category'         => implode(",",$selected_cat),
            ); 
           
            $posts =  get_posts( $args );
        }
        
        $limit = count($popular_posts);
        $sorted = array();
        for($i=0; $i < $limit; $i++){
            foreach($posts as $post){
                if($post->ID == $popular_posts[$i] ){
                    $sorted[] = $post;
                    break;
                }
            }
            if(count($sorted) >= $posts_number){
                break;
            }
        }
        
        return $sorted;
    }
    
    
    
    
    public function prepare_posts($posts_array,$widget_id){
        $widget_posts = array();
        
        SpokalVars::getInstance()->scriptPopularInteractions = '<script type="text/javascript">';
        global $sp_popular_impressions;
        
        foreach($posts_array as $post){
            $alternative_url = get_post_meta( $post->ID, 'spokal_alt_title', true);
            
            if(empty($alternative_url)){
                $widget_posts[] = array(
                                    'permalink' => get_permalink($post->ID),
                                    'title' => $post->post_title,
                                    'postID' => $post->ID
                                   );
                continue;
            }
            
            $titles = array(
                        0 => $post->post_title,
                        1 => $alternative_url
                      );
            
            $random = mt_rand(0,1);
            $spTitle = $random ? 'B' : 'A';
            
            $params = array(
                        "spTitle" => $spTitle,
                      );
            
            $permalink = get_permalink($post->ID);
            $permalink .= parse_url($permalink, PHP_URL_QUERY) ? '&' : '?';
            $permalink .= http_build_query($params);
            
            $title_ID = get_post_meta( $post->ID, 'spokal_alt_title_testid', true);
            if(!empty($title_ID) && ($title_ID != 0)){
                $sp_popular_impressions["AB:$title_ID:$spTitle"] = "_paq.push(['trackContentImpression','AB:popularposts', 'AB:PP:".$title_ID.":".$spTitle."']);";
                SpokalVars::getInstance()->scriptPopularInteractions .= "document.getElementById('spTrack_".$post->ID."-".$widget_id."').addEventListener('click',function(){_paq.push(['trackContentInteraction', 'tabActivated', 'AB:popularposts', 'AB:PP:".$title_ID.":".$spTitle."']);});";
            }
            
            $widget_posts[] = array(
                    'permalink' => $permalink,
                    'title' => $titles[$random],
                    'postID' => $post->ID,
            );
        }
        SpokalVars::getInstance()->scriptPopularInteractions .= '</script>';
        
        return $widget_posts;
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = strip_tags( $new_instance['title'] );
            $instance['posts_number'] = strip_tags( $new_instance['posts_number'] );
            $instance['spokalcssclassname'] = strip_tags( $new_instance['spokalcssclassname'] );
            $instance['ab_posts'] = !empty($new_instance['ab_posts']);
            $instance['categories'] = isset($new_instance['categories']) ? $new_instance['categories'] : array();
            $instance['custom_posts'] = isset($new_instance['custom_posts']) ? $new_instance['custom_posts'] : array("post");

            return $instance;
    }
    
    
    
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Most Popular Posts', 'text_domain' );
        }
        
        if ( isset( $instance[ 'posts_number' ] ) ) {
            $posts_number = $instance[ 'posts_number' ];
        }
        else {
            $posts_number = __( 5, 'text_domain' );
        }
        
        if ( isset( $instance[ 'ab_posts' ] ) ) {
            $ab_posts = $instance[ 'ab_posts' ];
        }
        else {
            $ab_posts = false;
        }
        
        if(isset($instance[ 'spokalcssclassname' ])) {
            $cssClass = $instance[ 'spokalcssclassname' ];
        }
        else {
            $cssClass = "";
        }
        
        if ( isset( $instance[ 'categories' ] ) ) {
            $selected_cat = $instance[ 'categories' ];
        }
        else {
            $selected_cat = array();
        }
        
        if ( isset( $instance[ 'custom_posts' ] ) ) {
            $selected_post_type = $instance[ 'custom_posts' ];
        }
        else {
            $selected_post_type = array();
        }
        
        $categories = $this->get_all_categories();
        
        $postTypes = get_post_types(array('show_ui' => true,"public" => true, "_builtin" => false),'objects');
        
        $popular_posts = get_option("spokal_most_popular",false);
        if(!$popular_posts){ ?>
            <style type="text/css">
                .sp_notification{
                    margin: 15px 0 15px;
                    padding: 5px 12px;
                    box-shadow: 0 1px 1px 0;
                    -webkit-font-smoothing: subpixel-antialiased;
                    background: #fff;
                    border-left: 4px solid #7ad03a;
                }
            </style>
            <div  class="sp_notification" >
                We don't have any popularity data yet. 
                So for now we're showing the most recent posts, but we'll swap that out as soon as we've collected a bit of data. 
                You don't have to do anything - this will happen automatically.
            </div>
        <?php }
        
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'spokalcssclassname' ); ?>"><?php _e( 'Css Class' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'spokalcssclassname' ); ?>" name="<?php echo $this->get_field_name( 'spokalcssclassname' ); ?>" type="text" value="<?php echo esc_attr( $cssClass ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e( 'Number of posts to show (max 10):' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="number" value="<?php echo esc_attr( $posts_number ); ?>" style="width: 55px;" max="10">
        </p>
        
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'ab_posts' ); ?>" name="<?php echo $this->get_field_name( 'ab_posts' ); ?>" <?php echo  checked($ab_posts, true, false); ?> />
            <label style="letter-spacing: -0.5px;" for="<?php echo $this->get_field_id( 'ab_posts' ); ?>"><?php _e( 'Only display posts that have A/B titles set' ); ?></label> 
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'categories' ); ?>"><?php _e( 'Filter by category:' ); ?></label><br>
            <select id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name( 'categories' ); ?>[]" multiple>
                <?php 
                foreach ($categories as $category){
                    $selected = "";
                    if(in_array($category->term_id, $selected_cat)) $selected = "selected"; ?>
                    <option value="<?php echo $category->term_id; ?>" <?php echo $selected; ?>><?php echo $category->name; ?></option>
          <?php } ?>
            </select>
        </p>
        
        <?php
        if(!empty($postTypes) && is_array($postTypes)){ ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'custom_posts' ); ?>"><?php _e( 'Choose post types to show:' ); ?></label><br>
                <select id="<?php echo $this->get_field_id( 'custom_posts' ); ?>" name="<?php echo $this->get_field_name( 'custom_posts' ); ?>[]" multiple>
                    <?php 
                    $selected = (in_array("post", $selected_post_type) || empty($selected_post_type)) ? $selected = "selected" : ""; ?>
                    <option value="post" <?php echo $selected; ?>>Post</option>
                    <?php 
                    foreach ($postTypes as $slug => $name){
                        $selected = in_array($slug, $selected_post_type) ? $selected = "selected" : ""; ?>
                        <option value="<?php echo $slug; ?>" <?php echo $selected; ?>><?php echo $name->labels->name ?></option>
              <?php } ?>
                </select>
            </p>
  <?php }
       
    }
    
    
    
    
    public function get_all_categories(){
        $args = array(
            'type'                     => 'post',
            'child_of'                 => 0,
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'taxonomy'                 => 'category',
        );
        
        $all_categories =  get_categories($args);
        
        if(!is_array($all_categories)){
            return array();
        }
        
        return $all_categories;
    }
    
} 
