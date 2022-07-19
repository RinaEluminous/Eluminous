<?php

class RelatedPostsWidgetInit{
    
    
    public function __construct() {
        global $sp_related_impressions;
        $sp_related_impressions = array();
        
        // register LeadGeneratorWidget widget
        add_action( 'widgets_init', create_function( '', 'register_widget( "RelatedPostsWidget" );' ) );
        add_action('wp_footer', array(&$this, 'trackCompesion'),10);
    }
        
    
    
    
    public function trackCompesion(){
        if(SpokalVars::getInstance()->scriptRelatedInteractions){
            echo SpokalVars::getInstance()->scriptRelatedInteractions;
        }
    }
    
}




class RelatedPostsWidget extends WP_Widget {
    
    public $stop_list;
    
    public function __construct() {
        $this->stop_list = $this->get_stop_list();
        parent::__construct(
            'Spokal_Related_Posts', // Base ID
            'Spokal A/B Test Related Posts', // Name
            array( 'description' => __( 'Spokal A/B Test Related Posts', 'text_domain' ),
                    'classname' => 'spokal_related_posts widget_recent_entries'
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
        
        if(is_single()){
            echo $before_widget;
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            
            $posts_by_title = array();
            $post_by_taxs = array();
            
            $missing = $posts_number - count($post_by_taxs);
            
            $post_by_taxs = $this->get_related_by_taxonomies($posts_number,$ab_posts,$selected_cat,$custom_posts);
            if(count($post_by_taxs) < $posts_number){
                $posts_by_title = $this->get_related_by_title($ab_posts,$selected_cat,$missing,$custom_posts);
            }
            
            $rellated_posts = $this->merge_arrays($posts_by_title, $post_by_taxs,$missing);
            
            $widget_posts = $this->prepare_related_posts($rellated_posts, $posts_number,$ab_posts,$widget_id);
            
           ?>

            <div id="result_<?php echo $widget_id; ?>"></div>
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
    }
    
    
    
    public function merge_arrays($posts_by_title,$post_by_taxs,$posts_number){
        if(empty($posts_by_title)){ return $post_by_taxs;}
        
        $ids_by_tax = array();
        foreach($post_by_taxs as $single){
            $ids_by_tax[] = $single->ID; 
        }

        $title_cleared = array();
        $k= 1; 
        foreach($posts_by_title as $single){
            if(count($title_cleared) == $posts_number){break;}
            if(in_array($single->ID,$ids_by_tax)){continue;}
            $title_cleared[] = $single;
            $k++;
        }

        return array_merge($post_by_taxs,$title_cleared);
    }
    
    
    
    
    public function prepare_related_posts($posts_array, $posts_number,$ab_posts,$widget_id){
        $widget_posts = array();
        
        SpokalVars::getInstance()->scriptRelatedInteractions = '<script type="text/javascript">';
        global $sp_related_impressions;
        
        $counter = 1;
        foreach($posts_array as $post){

            if($counter > $posts_number){break;}

            $alternative_url = get_post_meta( $post->ID, 'spokal_alt_title', true);

            if(empty($alternative_url)){
            if(!$ab_posts){
                $widget_posts[] = array(
                                    'permalink' => get_permalink($post->ID),
                                    'title' => $post->post_title,
                                    'postID' => $post->ID
                                   );
                $counter++;
            }
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
                $sp_related_impressions["AB:$title_ID:$spTitle"] = "_paq.push(['trackContentImpression','AB:relatedposts', 'AB:RL:".$title_ID.":".$spTitle."']);";
                SpokalVars::getInstance()->scriptRelatedInteractions .= "document.getElementById('spTrack_".$post->ID."-".$widget_id."').addEventListener('click',function(){_paq.push(['trackContentInteraction', 'tabActivated', 'AB:relatedposts', 'AB:RL:".$title_ID.":".$spTitle."']);});";
            }

            $widget_posts[] = array(
                    'permalink' => $permalink,
                    'title' => $titles[$random],
                    'postID' => $post->ID,
            );
            $counter++;
        }
        SpokalVars::getInstance()->scriptRelatedInteractions .= '</script>';
        return $widget_posts;
    }
    
    
    
    
    public function get_related_by_taxonomies($posts_number,$ab_posts,$selected_cat,$custom_posts){
        global $post;
        $tag_ids = array();
        $tax_query = array();
        
        if($ab_posts){
            $alt_title = "spokal_alt_title";
        }else{
            $alt_title = "";
        }
        
        $tags_of_current_post = wp_get_post_tags( $post->ID);
        $args = array(
                'posts_per_page'   => $posts_number,
                'offset'           => 0,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'meta_key'         => $alt_title,
                'post_type'        => $custom_posts,
                'post_status'      => 'publish',
                'post__not_in'     => array($post->ID),
                'category'         => implode(",",$selected_cat),
            );

        if(!empty($tags_of_current_post)){
            foreach ($tags_of_current_post as $tag){
                $tag_ids[] = $tag->term_id;
            }
        }else{
            return array();
        }
        
        if(!empty($tag_ids)){
            $tax_query[] = array(
                    'taxonomy' => 'post_tag',
                    'terms' => $tag_ids
                );
        }
        
        if(!empty($tax_query)){
            $tax_query['relation'] = 'OR';
            $args['tax_query'] = $tax_query;
        }
        return  get_posts($args);
    }
    
    
    
    
    public function get_related_by_title($ab_posts,$selected_cat,$missing,$custom_posts){
        global $post,$wpdb;
        $exploded_title = explode( " ", $post->post_title );
                
        if($ab_posts){
            $or_query = "";
            foreach($exploded_title as $word){
                $word = rtrim($word,".,!?\"'");
                $word = ltrim($word,".,!?\"'");
                if(strlen($word) > 2 && !in_array(strtolower($word),$this->stop_list)){ 
                    $or_query .= ' p.post_title LIKE "%'.$word.'%" OR';
                }
            }
            if(empty($or_query)){return array();}
            
            if(!empty($custom_posts) && is_array($custom_posts)){
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
            }else{
                $type_query = 'p.post_type = "post"';
            }
            
            $title_query = 'SELECT * FROM '.$wpdb->posts.' AS p, '.$wpdb->postmeta.' AS m WHERE '
                        . 'p.post_status = "publish" AND '
                        . $type_query.' AND '
                        . 'p.ID != '.$post->ID.' AND '
                        . 'm.post_id = p.ID AND '
                        . 'm.meta_key = "spokal_alt_title" AND '
                        . '('.substr($or_query, 0, -2).') '
                        . 'ORDER BY post_date DESC';
            $post_array = $wpdb->get_results($title_query);
            
        }else{
            $or_query = "";
            foreach($exploded_title as $word){
                $word = rtrim($word,".,!?\"'");
                $word = ltrim($word,".,!?\"'");
                if(strlen($word) > 2 && !in_array(strtolower($word),$this->stop_list)){ 
                    $or_query .= ' post_title LIKE "%'.$word.'%" OR';
                }
            }
            
            if(empty($or_query)){return array();}
            
            if(!empty($custom_posts) && is_array($custom_posts)){
                if(count($custom_posts) == 1 && in_array("post", $custom_posts)){
                    $type_query = 'post_type = "post"';
                }else{
                    $type_query = "(";
                    foreach($custom_posts as $type){
                        $type_query .= 'post_type = "'.$type.'" OR ';
                    }
                    $type_query = rtrim($type_query,"OR ");
                    $type_query .= ")";
                }
            }else{
                $type_query = 'post_type = "post"';
            }
            
            $title_query = 'SELECT * FROM '.$wpdb->posts.' WHERE '
                        . 'post_status = "publish" AND '
                        . $type_query.' AND '
                        . 'ID != '.$post->ID.' AND '
                        . '('.substr($or_query, 0, -2).') '
                        . 'ORDER BY post_date DESC';
            
            $post_array = $wpdb->get_results($title_query);
        }
        
        if(!empty($selected_cat)){
            $posts_ids = $this->category_filter_post($ab_posts,$selected_cat);
            if(empty($posts_ids)) return $posts_ids;
        }else{
            return $post_array;
        }
        return $this->clear_by_category($posts_ids,$post_array,$missing);
    }
    
    
    
    
    public function clear_by_category($posts_ids,$post_array,$missing){ 
        $new_post_array =  array();
        $i = 0;
        foreach($post_array as $key => $post){
            if($i == $missing){break;}
            if(in_array($post->ID,$posts_ids)){
                $new_post_array[] = $post;
            }
            $i++;
        }        
        return $new_post_array;
    }
    
    
    
    
    public function category_filter_post($ab_posts,$selected_cat){
        if($ab_posts){
            $alt_title = "spokal_alt_title";
        }else{
            $alt_title = "";
        }
         $args = array(
            'posts_per_page'   => $posts_number,
            'offset'           => 0,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'meta_key'         => $alt_title,
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'category'         => implode(",",$selected_cat),
             'fields'          => 'ids',
        ); 
        $posts_ids = get_posts( $args );
        return $posts_ids;
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
            $title = __( 'Related Posts', 'text_domain' );
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
            <label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo esc_attr( $posts_number ); ?>" size="3">
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
    
    
    
    public function get_stop_list(){
        return array(
            'a',
            'about',
            'above',
            'across',
            'after',
            'again',
            'against',
            'all',
            'almost',
            'alone',
            'along',
            'already',
            'also',
            'although',
            'always',
            'among',
            'an',
            'and',
            'another',
            'any',
            'anybody',
            'anyone',
            'anything',
            'anywhere',
            'are',
            'area',
            'areas',
            'around',
            'as',
            'ask',
            'asked',
            'asking',
            'asks',
            'at',
            'away',
            'b',
            'back',
            'backed',
            'backing',
            'backs',
            'be',
            'became',
            'because',
            'become',
            'becomes',
            'been',
            'before',
            'began',
            'behind',
            'being',
            'beings',
            'best',
            'better',
            'between',
            'big',
            'both',
            'but',
            'by',
            'c',
            'came',
            'can',
            'cannot',
            'case',
            'cases',
            'certain',
            'certainly',
            'clear',
            'clearly',
            'come',
            'could',
            'd',
            'did',
            'differ',
            'different',
            'differently',
            'do',
            'does',
            'done',
            "didn't",
            "don't",
            "doesn't",
            'down',
            'down',
            'downed',
            'downing',
            'downs',
            'during',
            'e',
            'each',
            'early',
            'either',
            'end',
            'ended',
            'ending',
            'ends',
            'enough',
            'even',
            'evenly',
            'ever',
            'every',
            'everybody',
            'everyone',
            'everything',
            'everywhere',
            'f',
            'face',
            'faces',
            'fact',
            'facts',
            'far',
            'felt',
            'few',
            'find',
            'finds',
            'first',
            'for',
            'four',
            'from',
            'full',
            'fully',
            'further',
            'furthered',
            'furthering',
            'furthers',
            'g',
            'gave',
            'general',
            'generally',
            'get',
            'gets',
            'give',
            'given',
            'gives',
            'go',
            'going',
            'good',
            'goods',
            'got',
            'great',
            'greater',
            'greatest',
            'group',
            'grouped',
            'grouping',
            'groups',
            'h',
            'had',
            'has',
            'have',
            'having',
            'he',
            'her',
            'here',
            'herself',
            'high',
            'higher',
            'highest',
            'him',
            'himself',
            'his',
            'how',
            'however',
            'i',
            'if',
            'important',
            'in',
            'interest',
            'interested',
            'interesting',
            'interests',
            'into',
            'is',
            'it',
            'its',
            'itself',
            'j',
            'just',
            'k',
            'keep',
            'keeps',
            'kind',
            'knew',
            'know',
            'known',
            'knows',
            'l',
            'large',
            'largely',
            'last',
            'later',
            'latest',
            'least',
            'less',
            'let',
            'lets',
            'like',
            'likely',
            'long',
            'longer',
            'longest',
            'm',
            'made',
            'make',
            'making',
            'man',
            'many',
            'may',
            'me',
            'member',
            'members',
            'men',
            'might',
            'more',
            'most',
            'mostly',
            'mr',
            'mrs',
            'much',
            'must',
            'my',
            'myself',
            'n',
            'necessary',
            'need',
            'needed',
            'needing',
            'needs',
            'never',
            'new',
            'newer',
            'newest',
            'next',
            'no',
            'nobody',
            'non',
            'noone',
            'not',
            'nothing',
            'now',
            'nowhere',
            'number',
            'numbers',
            'o',
            'of',
            'off',
            'often',
            'old',
            'older',
            'oldest',
            'on',
            'once',
            'one',
            'only',
            'open',
            'opened',
            'opening',
            'opens',
            'or',
            'order',
            'ordered',
            'ordering',
            'orders',
            'other',
            'others',
            'our',
            'out',
            'over',
            'p',
            'part',
            'parted',
            'parting',
            'parts',
            'per',
            'perhaps',
            'place',
            'places',
            'point',
            'pointed',
            'pointing',
            'points',
            'possible',
            'present',
            'presented',
            'presenting',
            'presents',
            'problem',
            'problems',
            'put',
            'puts',
            'q',
            'quite',
            'r',
            'rather',
            'really',
            'right',
            'right',
            'room',
            'rooms',
            's',
            'said',
            'same',
            'saw',
            'say',
            'says',
            'second',
            'seconds',
            'see',
            'seem',
            'seemed',
            'seeming',
            'seems',
            'sees',
            'several',
            'shall',
            'she',
            'should',
            'show',
            'showed',
            'showing',
            'shows',
            'side',
            'sides',
            'since',
            'small',
            'smaller',
            'smallest',
            'so',
            'some',
            'somebody',
            'someone',
            'something',
            'somewhere',
            'state',
            'states',
            'still',
            'still',
            'such',
            'sure',
            't',
            'take',
            'taken',
            'than',
            'that',
            'the',
            'their',
            'them',
            'then',
            'there',
            'therefore',
            'these',
            'they',
            'thing',
            'things',
            'think',
            'thinks',
            'this',
            'those',
            'though',
            'thought',
            'thoughts',
            'three',
            'through',
            'thus',
            'to',
            'today',
            'together',
            'too',
            'took',
            'toward',
            'turn',
            'turned',
            'turning',
            'turns',
            'two',
            'u',
            'under',
            'until',
            'up',
            'upon',
            'us',
            'use',
            'used',
            'uses',
            'v',
            'very',
            'w',
            'want',
            'wanted',
            'wanting',
            'wants',
            'was',
            'way',
            'ways',
            'we',
            'well',
            'wells',
            'went',
            'were',
            'what',
            'when',
            'where',
            'whether',
            'which',
            'while',
            'who',
            'whole',
            'whose',
            'why',
            'will',
            'with',
            'within',
            'without',
            'work',
            'worked',
            'working',
            'works',
            'would',
            'x',
            'y',
            'year',
            'years',
            'yet',
            'you',
            'young',
            'younger',
            'youngest',
            'your',
            'yours',
            'z',
        );
    }
} 
