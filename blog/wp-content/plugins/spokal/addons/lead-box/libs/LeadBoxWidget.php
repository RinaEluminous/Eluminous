<?php

class SpLeadBoxWidgetInit{
    
    
    public function __construct() {
        global $spokalLbxWidget;
        $spokalLbxWidget = 1;
        // register LeadGeneratorWidget widget
        add_action( 'widgets_init', create_function( '', 'register_widget( "SpLeadBoxWidget" );' ) );
        add_action('wp_ajax_nopriv_upload_canva_image', array($this, 'upload_canva_image'));
        add_action('wp_ajax_upload_canva_image', array($this, 'upload_canva_image'));
        add_action( 'admin_enqueue_scripts', array($this, 'enquineMedia') ); 
        add_action('init', array($this, 'addUploadImageSize'));
    }
    
    
    public function addUploadImageSize($sizes){
        add_image_size( 'sp_size', 360, 540, false );
    }
    
    
    public function enquineMedia(){
        if(function_exists("wp_enqueue_media")){
            wp_enqueue_media();
        }
    }
    /*
     * Uploading Image to the server from the URL returned by Canva API. Because returned URL is temporary 
     */
    public function upload_canva_image(){
        if(isset($_POST["url"])){
            $img = $this->media_sideload_image($_POST["url"],0,"",'src');
            $status = (is_wp_error($img['url']) || empty($img["id"])) ? false : true;
                        
        }else{
            $img = array(
               "id" => "",
               "url" => "",
            );
            $status = false;
        }
        
        header('Content-type: application/json');
        echo json_encode(array("url" => $img['url'], "status" => $status, "id" => $img["id"]));
        die();
        
    }
    
    /**
    * Download an image from the specified URL and attach it to a post.
    *
    * @since 2.6.0
    *
    * @param string $file The URL of the image to download
    * @param int $post_id The post ID the media is to be associated with
    * @param string $desc Optional. Description of the image
    * @param string $return Optional. What to return: an image tag (default) or only the src.
    * @return string|WP_Error Populated HTML img tag on success
    */
   function media_sideload_image( $file, $post_id, $desc = null, $return = 'html' ) {
           $response = array(
               "id" => "",
                "url" => ""
           );
           if ( ! empty( $file ) ) {
                   // Set variables for storage, fix file filename for query strings.
                   preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
                   $file_array = array();
                   $file_array['name'] = basename( $matches[0] );

                   // Download file to temp location.
                   $file_array['tmp_name'] = download_url( $file );

                   // If error storing temporarily, return the error.
                   if ( is_wp_error( $file_array['tmp_name'] ) ) {
                           return $file_array['tmp_name'];
                   }

                   // Do the validation and storage stuff.
                   $id = media_handle_sideload( $file_array, $post_id, $desc );

                   // If error storing permanently, unlink.
                   if ( is_wp_error( $id ) ) {
                           @unlink( $file_array['tmp_name'] );
                           return $id;
                   }

                   $src = wp_get_attachment_url( $id );
                   $response["id"] = $id;
           }
           
           // Finally check to make sure the file has been saved, then return the HTML.
           if ( ! empty( $src ) ) {
               $response["url"] = $src;
           } else {
                   $response["url"] = WP_Error( 'image_sideload_failed' );
           }
           
           return $response;
   }
 
    /**
     * Return an ID of an attachment by searching the database with the file URL.
     *
     * First checks to see if the $url is pointing to a file that exists in
     * the wp-content directory. If so, then we search the database for a
     * partial match consisting of the remaining path AFTER the wp-content
     * directory. Finally, if a match is found the attachment ID will be
     * returned.
     *
     * @param string $url The URL of the image (ex: http://mysite.com/wp-content/uploads/2013/05/test-image.jpg)
     * 
     * @return int|null $attachment Returns an attachment ID, or null if no attachment is found
     */
    public function fjarrett_get_attachment_id_by_url( $url ) {
            // Split the $url into two parts with the wp-content directory as the separator
            $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

            // Get the host of the current site and the host of the $url, ignoring www
            $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
            $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

            // Return nothing if there aren't any $url parts or if the current host and $url host do not match
            if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
                    return;
            }

            // Now we're going to quickly search the DB for any attachment GUID with a partial path match
            // Example: /uploads/2013/05/test-image.jpg
            global $wpdb;

            $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

            // Returns null if no attachment is found
            return $attachment[0];
    }
    
}




class SpLeadBoxWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Spokal_Graphic_Lead_Generator', // Base ID
            'Spokal Graphic Lead Generator', // Name
            array( 'description' => __( 'Spokal Graphic Lead Generator Widget', 'text_domain' ),
                    'classname' => 'spokal_graphic_lead_generator'
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
        $cta_url = $instance['cta_url'];
        $sp_popup = $instance['sp_popup'];
        $hideSpokalWidget = $instance['hideSpokalWidget'];
        
        //checking Spokal Lead campany and setting it to -1 if it is not set
        if(is_numeric($instance['lead_campaign'])) {
            $campaign = $instance['lead_campaign'];
        }
        else {
            $campaign = -1;
        }
        
        
        if(is_single() || is_page()){
            if(
                isset($instance['sp_focus']) && 
                isset($instance['focus_image']) && 
                !empty($instance['sp_focus']) && 
                !empty($instance['focus_image'])
               ){
                $prim = $this->get_primary_focus();
                if(!empty($prim) && is_array($instance['sp_focus'])){
                    $key = array_search($prim, $instance['sp_focus']);
                    $cta_url = (($key !== false) && isset($instance['focus_image'][$key])) ? $instance['focus_image'][$key] : $cta_url;
                }
            }
        }
        
        $display = true;
        //Checking did current visitor already subscribe and is option Hide Widget if user is already registered to list
        if(isset($_COOKIE['sp_lists']) && $hideSpokalWidget){
            $leadListCookie = json_decode(base64_decode($_COOKIE['sp_lists']));
            if(in_array($campaign, $leadListCookie)){
                $display = false;
            }
        }
        
        
        if($display){
            echo $before_widget;
            $popup = get_post( $sp_popup );
            $cta_style = "";
            if($popup)
            {
//                if(is_readable(SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css')){
//                    $cta_style = file_get_contents(SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css');
//                }
//                if($cta_style){echo '<style type="text/css">'.$cta_style.'</style>';} 
                if(!empty($sp_popup)){
                    global $spokal_lead_box_popups;
                    $spokal_lead_box_popups[] = array("id" => $sp_popup,"campaign" => $campaign);
                }
            }
            
            
            //Getting Cta image URL from database
            $meta = wp_get_attachment_metadata($cta_url);
            if(is_array($meta) && isset($meta["width"]) && ($meta["width"] <= 400)){
                $cta_src = wp_get_attachment_url( $cta_url );
            }else{
                $medium = wp_get_attachment_image_src($cta_url,"sp_size");
                $cta_src = "";
                if($medium != false && isset($medium[0]) && (!filter_var($medium[0], FILTER_VALIDATE_URL) === false)){
                    $cta_src = $medium[0];
                }else{
                    $cta_src = wp_get_attachment_url( $cta_url );
                }
            }
            
            $img_style = (!filter_var($cta_src, FILTER_VALIDATE_URL) === false) ? "" : "display: none;"; ?>

            <style type="text/css">
                .sp_lead_image{
                    max-width: 100%; 
                    height: auto; 
                    cursor: pointer;
                }
            </style>
            <img  class="sp_lead_image" src="<?php echo $cta_src; ?>" style="<?php echo $img_style; ?>" onclick="sp_show_popup('sp_popup_overlay-<?php echo "widget".$sp_popup; ?>')">
            <?php
            echo $after_widget;
        }
    }
    
    
    /*
     * Getting primary focus for post
     */
    public function get_primary_focus(){
        global $post;
        $prim = "";
        $focuses = get_post_meta($post->ID,"spokal_focuses",true);
        
        if(empty($focuses)){return $focuses;}
        
        $focus_array = explode(",",$focuses);
        foreach($focus_array as $focus){
            if(strpos($focus,"pri-") !== false){
                $prim = str_replace("pri-", "", $focus);
            }
        }
        return $prim;
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
            $instance['cta_url'] = strip_tags( $new_instance['cta_url'] );
            $instance['sp_popup'] = (isset($new_instance['sp_popup'])) ? strip_tags($new_instance['sp_popup']) : "";
            $instance['lead_campaign'] = strip_tags( $new_instance['lead_campaign'] );
            $instance['hideSpokalWidget'] = ! empty($new_instance['hideSpokalWidget']);
            $instance['focus_image'] = isset($new_instance['focus_image']) ? $new_instance['focus_image'] : array();
            $instance['sp_focus'] = isset($new_instance['sp_focus']) ? $new_instance['sp_focus'] : array();

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
        
        global $spokalLbxWidget;
        global $sp_canva_javacsript;
        
        if ( isset( $instance[ 'cta_url' ] ) ) {
            $cta_url = $instance[ 'cta_url' ];
        }
        else {
            $cta_url = "";
        }
        
        if ( isset( $instance[ 'sp_popup' ] ) && !empty($instance[ 'sp_popup' ])) {
            $sp_popup = $instance[ 'sp_popup' ];
        }
        else {
            $sp_popup = "";
        }
        
        if(isset($instance[ 'lead_campaign' ])) {
            $campaign = $instance[ 'lead_campaign' ];
        }
        else {
            $campaign = "";
        }
        
        if ( isset( $instance[ 'hideSpokalWidget' ] ) ) {
            $hideSpokalWidget = $instance[ 'hideSpokalWidget' ];
        }
        else {
            $hideSpokalWidget = true;
        }
        
        $this->sp_focuses = $this->get_focuses();
                
        //Getting Cta image URL from database
        $medium = wp_get_attachment_image_src($cta_url,"medium");
        $cta_src = "";
        if($medium != false && isset($medium[0]) && (!filter_var($medium[0], FILTER_VALIDATE_URL) === false)){
            $cta_src = $medium[0];
        }else{
            $cta_src = wp_get_attachment_url( $cta_url );
        }

        $img_style = (!filter_var($cta_src, FILTER_VALIDATE_URL) === false) ? "" : "display: none;";
        
        ?>
            <div class="sp_lbx_wrapp" id="<?php echo $this->get_field_id( 'widget_wrapper' ); ?>">
        <?php
        $popups = $this->get_popups(); 
        if(!$sp_canva_javacsript){ 
            $sp_canva_javacsript = true; ?>
            <script>jQuery(document).ready(function(){<?php echo $this->render_canva_js(); ?>});</script>
            <script type="text/javascript" >
                var spokal_focus_custom_uploader;
                 <?php echo $this->renderTemporaryJs(); ?>
                function spFocusTmp(_this){
                    var main_par = _this.parentNode.parentNode;
                    jQuery(main_par).addClass("cnv_foc_temp");
                }
                 
                function remove_focus_cta(_this){
                    var parent = _this.parentNode;
                    jQuery(parent).remove();
                    
                }
                
                function is_focus_choosen(_this){
                    jQuery(_this).removeClass("sp_focus_select");
                    var _focuses_wrapp = _this.parentNode.parentNode;
                    var f_selects = _focuses_wrapp.getElementsByClassName("sp_focus_select");
                    
                    jQuery(f_selects).each(function(){
                        if(_this.value == this.value){
                            var par = _this.parentNode;
                            var x = par.getElementsByClassName("sp_wr_focus_popup");
                            jQuery(x).show();
                            var body = document.getElementsByTagName("body")[0];
                            setTimeout(function(){body.addEventListener("click", hide_focus_popup);}, 300);
                            setTimeout(function(){ 
                                jQuery(x).fadeOut();
                                var body = document.getElementsByTagName("body")[0];
                                body.removeEventListener("click", hide_focus_popup);
                            }, 4000);;
                            jQuery(_this)[0].selectedIndex = 0;
                        }
                    });
                    jQuery(_this).addClass("sp_focus_select");
                }
                
                function hide_focus_popup(){
                    jQuery(".sp_wr_focus_popup").hide();
                    var body = document.getElementsByTagName("body")[0];
                    body.removeEventListener("click", hide_focus_popup);
                }
                                
                jQuery(document).ready(function ($) {
                    var spokal_custom_uploader;
                    $('.sp_image_upload_button').click(function (e) {
                            var parent = this.parentNode;
                            var mainParent = parent.parentNode;
                            var tmpUrl = mainParent.getElementsByClassName("sp_cta_url");
                            var tmpIMG = mainParent.getElementsByClassName("sp_cta_img");
                            var tmpFocus = mainParent.getElementsByClassName("focus_canva_wrapp");
                            var tmpFocusButt = mainParent.getElementsByClassName("focus_canva_button");
                            e.preventDefault();
//                            if (spokal_custom_uploader) {
//                                    spokal_custom_uploader.open();
//                                    return;
//                            }

                            spokal_custom_uploader = wp.media.frames.file_frame = wp.media({
                                    title   : "Use Image",
                                    button  : { text: "Use Image" },
                                    multiple: false
                            });
                            spokal_custom_uploader.on('select', function () {
                                    var attachment = spokal_custom_uploader.state().get('selection').first().toJSON();
                                    $(tmpUrl).val(attachment.id);
                                    $(tmpIMG).attr("src",attachment.url);
                                    $(tmpIMG).show();
                                    <?php if(gettype($this->number) == "string"){ ?>
                                       $(tmpFocusButt).html('<?php echo $this->render_focus_button(); ?>');
                                       <?php echo $this->render_canva_js(); ?>
                              <?php }?>
                                    $(tmpFocus).show();
                            });
                            spokal_custom_uploader.open();
                    });
                });
            
                function sp_upload_image(_this){
                    var parent = _this.parentNode;
                    var mainParent = parent.parentNode;
                    var focuses_wrap = mainParent.getElementsByClassName("cta_wrap");
                    var focus_img_field = jQuery(_this).attr("focus-image");
                    var focus_sel_field = jQuery(_this).attr("focus-select");
                    
                    var select = '<span class="sp_wr_focus_popup tooltip fade top in" style="left: 6px; top: -42px; width: 170px; position: absolute; background-color: #000; display: none;"><span class="tooltip-arrow"></span><span class="tooltip-inner">The same focus can not be used twice!</span></span>';
                    select += '<label style="text-align: left;">Focus:</label><select onchange="is_focus_choosen(this)" class="sp_focus_select widefat"  name="' + focus_sel_field +'"  style="display: block; margin-bottom: 5px;"><option value="">Choose Focus</option>';
                    <?php 
                    foreach($this->sp_focuses["Focuses"] as $key => $focus){ 
                        $selected = ($id == $key) ? "selected" : ""; ?>
                        select += <?php echo json_encode("<option ".$selected." value='".$key."'>".$focus."</option>"); ?>;
                    <?php } ?>     
                    select += "</select>";
//                    if (spokal_focus_custom_uploader) {
//                            spokal_focus_custom_uploader.open();
//                            return;
//                    }

                    spokal_focus_custom_uploader = wp.media.frames.file_frame = wp.media({
                            title   : "Use Image",
                            button  : { text: "Use Image" },
                            multiple: false
                    });
                    spokal_focus_custom_uploader.on('select', function () {
                            var attachment = spokal_focus_custom_uploader.state().get('selection').first().toJSON();
                            jQuery(focuses_wrap).append('<p style="float:left; margin-right: 1%; margin-top: 0px; width: 32%; text-align:center; position: relative;">'+select+'<input type="hidden" name="'+focus_img_field+'" value="'+attachment.id+'"><img class="sp_focus_cta_img" src="'+attachment.url+'" style="max-width: 85%;"><span class="sp_remove_focus" onclick="remove_focus_cta(this)">Remove</span></p>');
                    });
                    spokal_focus_custom_uploader.open();
                }
                
                function spTempCanva(_this){
                    var parent = _this.parentNode;
                    var mainParent = parent.parentNode;
                    var spinner = mainParent.getElementsByClassName("sp_canva_loader");
                    jQuery(spinner).addClass("is-active");

                    //creating fake canva button because originnal doeasn't work when widget is just dropped
                    var span = document.createElement("SPAN");
                    span.setAttribute("data-url-callback", "spdesignCallbackTemp");
                    span.setAttribute("data-type", "blogGraphic");
                    span.setAttribute("data-label", "Create Image With Canva");
                    span.setAttribute("data-apikey", "dmf4YXt7Oz8IQ6S7GYCDKIaF");
                    span.setAttribute("class", "canva-design-button");
                    //creating P hidden element to be sure that fake canva button is not displayed
                    var P = document.createElement("P");
                    P.setAttribute("style", "display: none;");
                    P.appendChild(span);
                    mainParent.insertBefore(P, parent);

                    //loading canva javascript againg to have fake button working
                    <?php echo $this->render_canva_js(); ?>

                    // beceause javascript is slow, adding some timeout on fake button clik
                    setTimeout(function(){ span.click(); jQuery(spinner).removeClass("is-active"); P.remove();}, 1500);

                    //adding temporary classes because this is the only way to have unique selectors for dropped widget
                    var tmpUrl = mainParent.getElementsByClassName("sp_cta_url");
                    var tmpIMG = mainParent.getElementsByClassName("sp_cta_img");
                    var tmpError = mainParent.getElementsByClassName("sp_cta_error_msg");
                    var focus_canva = mainParent.getElementsByClassName("focus_canva_button");
                    var focus_canva_wrapp = mainParent.getElementsByClassName("focus_canva_wrapp");
                    jQuery(tmpUrl).addClass('tmp_sp_cta_url');
                    jQuery(tmpIMG).addClass('tmp_sp_cta_img');
                    jQuery(tmpError).addClass('tmp_cta_error_msg');
                    jQuery(focus_canva).addClass('tmp_focus_canva_button');
                    jQuery(focus_canva_wrapp).addClass('tmp_focus_canva_wrapp');
                    jQuery(".tmp_focus_canva_button").html('<?php echo $this->render_focus_button(); ?>');
                }
                
                window.spFocusCanvaTMP = function (url) {
                    jQuery(".sp_focus_canva_loader").addClass("is-active");
                    jQuery.ajax({
                        type: "POST",
                        url: '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
                        data: {
                            action: "upload_canva_image",
                            url: url
                        },
                        success: function(data) {
                            jQuery(".sp_focus_canva_loader").removeClass("is-active");
                            if(data.status){
                                var jsonSelect = <?php echo json_encode($this->renderSelect()); ?>;
                                jQuery(".cnv_foc_temp .cta_wrap").append('<p style="float:left; margin-right: 1%; margin-top: 0px; width: 32%; text-align:center; position: relative;">'+jsonSelect+'<input type="hidden" name="<?php echo $this->get_field_name( 'focus_image' ); ?>[]" value="'+data.id+'"><img class="sp_focus_cta_img" src="'+data.url+'" style="max-width: 85%;"><span class="sp_remove_focus" onclick="remove_focus_cta(this)">Remove</span></p>');
                            }
                            jQuery(".cnv_foc_temp").removeClass("cnv_foc_temp");
                        }
                    });
                };
            </script>
            <style type="text/css">
                
                .tooltip.top {
                    padding: 5px 0;
                    margin-top: -3px;
                }
                
                .tooltip.top .tooltip-arrow {
                    border-top-color: #333;
                }
                
                .tooltip.top .tooltip-arrow {
                    bottom: -5px;
                    left: 50%;
                    margin-left: -5px;
                    border-top-color: #000;
                    border-width: 5px 5px 0;
                }
                
                .tooltip-arrow {
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-color: transparent;
                    border-style: solid;
                }

                .tooltip-inner {
                    background-color: #333;
                    color: #fff;
                    font-family: Arial,Helvetica,sans-serif;
                    font-size: 11px;
                    font-weight: bold;
                    text-shadow: 1px 1px 0 rgba(42,45,50,.5);
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 0;
                }

                .tooltip-inner {
                    max-width: 200px;
                    color: #fff;
                    text-align: center;
                    text-decoration: none;
                    background-color: #000;
                    -webkit-border-radius: 4px;
                    -moz-border-radius: 4px;
                    border-radius: 4px;
                }
                
                .cta_wrap:after{
                    content: " ";
                    display: block;
                    clear: both;
                }
                .sp_canva_loader,
                .sp_focus_canva_loader{
                    background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/lead_box_canva.gif) no-repeat;
                    -webkit-background-size: 20px 20px;
                    display: inline-block;
                    visibility: hidden;
                    vertical-align: middle;
                    opacity: .7;
                    filter: alpha(opacity=70);
                    width: 20px;
                    height: 20px;
                    margin: 4px 10px 0;
                }
                .sp_canva_loader.is-active,
                .sp_focus_canva_loader.is-active{
                    visibility: visible;
                }

                .spokal-cta-upload {
                    cursor: pointer;
                    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                    text-decoration: none;
                    display: inline-block;
                    position: relative;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    -webkit-border-radius: 3px;
                    -moz-border-radius: 3px;
                    border-radius: 3px;
                    padding: 0 7px 0 10px;
                    background-color: rgba(38, 205, 215, 1);
                    background-image: -webkit-gradient(linear,left top,left bottom,from(rgba(38,205,215,1)),to(rgba(6,173,179,1)));
                    background-image: -moz-linear-gradient(top,rgba(38,205,215,1),rgba(6,173,179,1));
                    background-image: linear-gradient(to bottom,rgba(38,205,215,1),rgba(6,173,179,1));
                    color: #fff;
                    font-size: 14px;
                    height: 28px;
                    line-height: 26px;
                    font-weight: 400;
                    letter-spacing: 0.03em;
                    text-shadow: 0 -1px 0 rgba(0,0,0,0.333);
                    border: 1px solid rgba(0, 167, 174, 1);
                }
                .sp_lbx_wrapp .canva-design-button,
                .sp_lbx_wrapp .sp_image_upload_button{
                    margin-bottom: 5px;
                }
                
                .sp_remove_focus{
                    color: #395997;
                    font-weight: bold;
                    cursor: pointer;
                }
                
                .focus_canva_wrapp{
                    margin-top: 20px;
                }
            </style>
      <?php }  ?>
        <?php $this->renderLbxJavascript(); ?>
        <p>
            <input class="widefat sp_cta_url" id="<?php echo $this->get_field_id( 'cta_url' ); ?>" name="<?php echo $this->get_field_name( 'cta_url' ); ?>" type="hidden" value="<?php echo esc_attr( $cta_url ); ?>" />
        </p>
        <p>
            <span>Create or upload the image that will be used as a call to action.</span>
        </p>
        <p style="text-align: center;">
            <span <?php if(gettype($this->number) == "string"){ echo "onclick='spTempCanva(this)'"; }?> data-url-callback="spdesignCallback<?php echo $spokalLbxWidget; ?>" data-type="blogGraphic" data-label="Create Image With Canva" data-apikey="dmf4YXt7Oz8IQ6S7GYCDKIaF" class="canva-design-button">Create Image With Canva</span>
            <span class="sp_image_upload_button btn spokal-cta-upload">Upload Image</span>
            <br><span class="sp_canva_loader"></span>
        </p>
        <p>
            <span class="sp_cta_error_msg" id="<?php echo $this->get_field_id( 'cta_error_msg' ); ?>" style="display:none; color: red;"></span>
           <img class="sp_cta_img" id="<?php echo $this->get_field_id( 'cta_img' ); ?>" src="<?php echo $cta_src; ?>" style="max-width: 25%; height: auto; <?php echo $img_style; ?>"> 
        </p>
        
        
  <?php if(is_array($this->sp_focuses) && !empty($this->sp_focuses) ){
            if(isset($this->sp_focuses["Focuses"]) && is_array($this->sp_focuses["Focuses"]) && !empty($this->sp_focuses["Focuses"]) ){ ?>
                <?php $focus_display = (isset($cta_url) && !empty($cta_url)) ? "": "style='display: none;'";?>
                <div class="focus_canva_wrapp" id="<?php echo $this->get_field_id( 'focuses_menu' ); ?>" <?php echo $focus_display; ?> >
                    <label for="<?php echo $this->get_field_id( 'sp_focus' ); ?>"><?php _e( 'Create or upload image for specific focus:' ); ?></label>
                    <p class="focus_canva_button" style="text-align: center; margin-bottom: 0px;">
                        <span data-url-callback="spdesignCallbackFocus<?php echo $spokalLbxWidget; ?>" data-type="blogGraphic" data-label="Create Image With Canva" data-apikey="dmf4YXt7Oz8IQ6S7GYCDKIaF" class="canva-design-button">Create Image With Canva</span>
                        <span focus-select="<?php echo $this->get_field_name( "sp_focus" ) ;?>[]" focus-image="<?php echo $this->get_field_name( 'focus_image' ); ?>[]" class="sp_focus_image_upload_button btn spokal-cta-upload" onclick="sp_upload_image(this)">Upload Image</span>
                        <br><span class="sp_focus_canva_loader"></span>
                    </p>
                    <div class="cta_wrap" id="<?php echo $this->get_field_id( 'focuses_ctas' ); ?>">
                        <?php
                        if(
                            isset($instance['sp_focus']) && 
                            isset($instance['focus_image']) && 
                            !empty($instance['sp_focus']) && 
                            !empty($instance['focus_image'])
                           ){
                                foreach($instance['sp_focus'] as $key => $value){ ?>
                                    <p style="float:left; margin-right: 1%; margin-top: 0px; width: 32%; text-align:center; position: relative;">
                                        <?php echo $this->renderSelect($value); ?>
                                        <input type="hidden" name="<?php echo $this->get_field_name( 'focus_image' ); ?>[]" value="<?php echo $instance['focus_image'][$key]; ?>">
                                        <img class="sp_focus_cta_img" src="<?php echo $this->get_focus_image($instance['focus_image'][$key]); ?>" style="max-width: 85%;">
                                        <span class="sp_remove_focus" onclick="remove_focus_cta(this)">Remove</span>
                                    </p>
                          <?php }
                
                            } ?>
                    </div>
                </div>
      <?php }
        } ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'sp_popup' ); ?>"><?php _e( 'Then select a popup to use when they click on the image CTA. This is called a two-step opt-in and results in higher opt-in rates in many cases.' ); ?></label> 
      <?php if(is_array($popups) && !empty($popups) ){?>
            <select class="widefat" id="<?php echo $this->get_field_id( 'sp_popup' ); ?>" name="<?php echo $this->get_field_name( 'sp_popup' ); ?>"  style="display: block;">
                <option value="">Choose Popup</option>
                <?php
                foreach($popups as $popup){ 
                    $checked = ($popup->ID == $sp_popup) ? "selected" : "";
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $popup->ID; ?>"><?php echo $popup->post_title; ?></option>
          <?php } ?>
            </select>
      <?php }else{?>
                <br>You haven't created any popups. Click <a href="<?php echo admin_url("admin.php?page=spokal_options&sp_tab=tab8-5");?>">here</a> here to create one now.
      <?php } ?>
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'hideSpokalWidget' ); ?>" name="<?php echo $this->get_field_name( 'hideSpokalWidget' ); ?>" <?php echo  checked($hideSpokalWidget, true, false); ?> />
            <label style = "letter-spacing: -0.5px" for="<?php echo $this->get_field_id( 'hideSpokalWidget' ); ?>"><?php _e( 'Hide if user is already registered to list.' ); ?></label>  
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'lead_campaign' ); ?>"><?php _e( 'Campaign: ' ); ?></label> 
            <select id="<?php echo $this->get_field_id( 'lead_campaign' ); ?>" name="<?php echo $this->get_field_name( 'lead_campaign' ); ?>">
                <?php
                
                    $campaigns = $this->getLeadList();
                    if(is_array($campaigns) && isset($campaigns["Lists"]) && is_array($campaigns["Lists"]) ) {
                            foreach($campaigns["Lists"] as $key => $value) {
                                if($key == $campaign) {
                                    echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                }
                                else {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            }
                    }
                    else {
                        echo '<option value="-1" selected>default</option>';
                    }
                ?>
            </select>
        </p>
        </div>
        <?php    
        $spokalLbxWidget++;
    }
    
    
    public function renderSelect($id = ""){
        $select = '<span class="sp_wr_focus_popup tooltip fade top in" style="left: 6px; top: -42px; width: 170px; position: absolute; background-color: #000; display: none;"><span class="tooltip-arrow"></span><span class="tooltip-inner">The same focus can not be used twice!</span></span>';
        $select .= '<label style="text-align: left;">Focus:</label><select onchange="is_focus_choosen(this)" class="sp_focus_select widefat"  name="'.$this->get_field_name( "sp_focus" ).'[]"  style="display: block; margin-bottom: 5px;"><option value="">Choose Focus</option>';
        foreach($this->sp_focuses["Focuses"] as $key => $focus){ 
            $selected = ($id == $key) ? "selected" : "";
            $select .= '<option '.$selected.' value="'.$key.'">'.$focus.'</option>';
        }      
        return $select."</select>";
    }
    
    
    public function get_focus_image($cta_url){
        $medium = wp_get_attachment_image_src($cta_url,"medium");
        $cta_src = "";
        if($medium != false && isset($medium[0]) && (!filter_var($medium[0], FILTER_VALIDATE_URL) === false)){
            $cta_src = $medium[0];
        }else{
            $cta_src = wp_get_attachment_url( $cta_url );
        }
        
        return $cta_src;
    }
    
    
    public function render_canva_js(){
        return '(function(c,a,n){var w=c.createElement(a),s=c.getElementsByTagName(a)[0];w.src=n;s.parentNode.insertBefore(w,s);})(document,"script","https://sdk.canva.com/v1/api.js");';
    }
    
    //TODO: Modify this function to not return focuses inxed in "Focuses" and to return just array of focuses
    public function get_focuses(){   
        
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            return "string and not array";
        }
        $params = array(
            "AccountId" => $accountID,
            "AuthorizationKey" => $authorizationKey,
        );
        $result = SP_Request::GETRequest("/api/v1.1/Focus/GetFocuses",$params);
        $focuses = json_decode($result, true);
        
        if(isset($focuses["Focuses"]) && is_array($focuses["Focuses"])){
            return $focuses;
        }
        else
        {
            return array("Focuses" => array());
        }
    }
    
    
    /*
     * Getting List of Spokal Popups
     */
    public function get_popups(){
        $args = array(
                'numberposts'   => -1,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'spokal_popup',
                'post_status'      => 'publish',
        );
        $posts = get_posts( $args );
        
        if(!is_array($posts)){
            return array();
        }
        
        return $posts;
    }
    
    
    public function renderTemporaryJs(){
        return 'window.spdesignCallbackTemp = function (url) {jQuery(".sp_canva_loader").addClass("is-active");jQuery(".tmp_cta_error_msg").html("");jQuery(".tmp_cta_error_msg").hide();jQuery.ajax({type: "POST",url: "'.admin_url( 'admin-ajax.php', 'relative' ).'",data: {action: "upload_canva_image",url: url},success: function(data) {jQuery(".sp_canva_loader").removeClass("is-active");if(data.status){jQuery(".tmp_sp_cta_url").val(data.id);jQuery(".tmp_sp_cta_img").attr("src",data.url);jQuery(".tmp_sp_cta_img").show();jQuery(".tmp_focus_canva_wrapp").show();}else{jQuery(".tmp_cta_error_msg").html("Something goes wrong. Please refresh the page and try again!");jQuery(".tmp_cta_error_msg").css("dispaly","inline");}}});};'; 
    }
    
    
    public function render_focus_button(){
         $onclick = (gettype($this->number) == "string") ? 'onclick="spFocusTmp(this)"' : "";
        return '<span '.$onclick.' data-url-callback="spFocusCanvaTMP" data-type="blogGraphic" data-label="Create Image With Canva" data-apikey="dmf4YXt7Oz8IQ6S7GYCDKIaF" class="canva-design-button">Create Image With Canva</span><span focus-select="'.$this->get_field_name( "sp_focus" ).'[]" focus-image="'.$this->get_field_name( 'focus_image' ).'[]" class="sp_focus_image_upload_button btn spokal-cta-upload" onclick="sp_upload_image(this)" style="margin-left: 3px;">Upload Image</span><br><span class="sp_focus_canva_loader"></span>';
    }
    
    public function renderLbxJavascript(){ 
        global $spokalLbxWidget; ?>
        <script type="text/javascript">
            window.spdesignCallbackFocus<?php echo $spokalLbxWidget; ?> = function (url) {
                jQuery(".sp_focus_canva_loader").addClass("is-active");
                var f_ctas = document.getElementById("<?php echo $this->get_field_id( 'focuses_ctas' ); ?>");
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
                    data: {
                        action: "upload_canva_image",
                        url: url
                    },
                    success: function(data) {
                        jQuery(".sp_focus_canva_loader").removeClass("is-active");
                        if(data.status){
                            var jsonSelect = <?php echo json_encode($this->renderSelect()); ?>;
                            jQuery(f_ctas).append('<p style="float:left; margin-right: 1%; margin-top: 0px; width: 32%; text-align:center; position: relative;">'+jsonSelect+'<input type="hidden" name="<?php echo $this->get_field_name( 'focus_image' ); ?>[]" value="'+data.id+'"><img class="sp_focus_cta_img" src="'+data.url+'" style="max-width: 85%;"><span class="sp_remove_focus" onclick="remove_focus_cta(this)">Remove</span></p>');
                        }
                    }
                });
            };
                
            window.spdesignCallback<?php echo $spokalLbxWidget; ?> = function (url) {
                jQuery(".sp_canva_loader").addClass("is-active");
                document.getElementById("<?php echo $this->get_field_id( 'cta_error_msg' ); ?>").innerHTML = "";
                document.getElementById("<?php echo $this->get_field_id( 'cta_error_msg' ); ?>").style.display = "none";
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
                    data: {
                        action: "upload_canva_image",
                        url: url
                    },
                    success: function(data) {
                        jQuery(".sp_canva_loader").removeClass("is-active");
                        if(data.status){
                            document.getElementById("<?php echo $this->get_field_id( 'focuses_menu' ); ?>").style.display = "block";
                            document.getElementById("<?php echo $this->get_field_id( 'cta_url' ); ?>").value = data.id;
                            document.getElementById("<?php echo $this->get_field_id( 'cta_img' ); ?>").src = data.url;
                            document.getElementById("<?php echo $this->get_field_id( 'cta_img' ); ?>").style.display = 'block';
                        }else{
                            document.getElementById("<?php echo $this->get_field_id( 'cta_error_msg' ); ?>").innerHTML = "Something goes wrong. Please refresh the page and try again!";
                            document.getElementById("<?php echo $this->get_field_id( 'cta_error_msg' ); ?>").style.display = "inline";
                        }
                    }
                });
            };
        </script>
<?php }
    
    
    /*
     * Getting Lead Lists from Spokal
     */
    private function getLeadList() {
        $options = SpokalVars::getInstance()->options;
        $accountID = $options['account_id']['value'];
        $authorizationKey = $options['authorization_key']['value'];
        
        if(empty($accountID) || empty($authorizationKey)) {
            return "string and not array";
        }
        
        $params = array(
            "AccountId" => $accountID,
            "AuthorizationKey" => $authorizationKey
        );
        $result = SP_Request::GETRequest("/api/v1.1/Leads/LeadLists",$params);
        $decodedResult = json_decode($result, true);
        
        return $decodedResult;
    }
    
} 
