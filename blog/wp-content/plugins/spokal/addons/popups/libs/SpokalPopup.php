<?php

class SpokalPopup{
    
    /*
     * Default instance of Spokal Popup
     */
    public $def_instance = array(
            'title'  => "Enter your name and email and get the weekly newsletter... it's FREE!",
            'buttontext' => 'Register',
            'continueButtonText' => 'Continue',
            'collectfirstname' => false,
            'collectlastname' => false,
            'collectphone' => false,
            'collectcompany' => false,    
            'successmsg' => 'Message has been submitted successfully',      
            'failmsg' =>  'Failed to send your message. Please try later.',
            'invalidEmailMsg' => "Your email address does not appear valid.",
            'toptext' => 'Introduce yourself and your program',
            'emailPlaceholder' => "Email",
            'firstNamePlaceholder' => "First Name",
            'lastNamePlaceholder' => "Last Name",
            'phonePlaceholder' => "Phone",
            'companyPlaceholder' => "Company",
            'cssclassname' => "",
            'spokalPopupLogo' => "",
            'spokalShowProgress' => false,
    );
    
    
    
    /*
     * Used for getting global instance of SpokalPopup class
     */
    public static function init(){
        global $spokalPopup;

        if($spokalPopup == null)
                $spokalPopup = new SpokalPopup();
        return $spokalPopup;
    }
    
    
    
    /*
     * Construct which will add wordpress hooks
     */
    public function __construct() {
        add_action( 'init', array($this, 'registerPopups') );
        add_action('wp_ajax_nopriv_delete_spokal_popup', array($this, 'delete_spokal_popup'));
        add_action('wp_ajax_delete_spokal_popup', array($this, 'delete_spokal_popup'));
        add_action('wp_ajax_nopriv_preview_spokal_popup', array($this, 'preview_spokal_popup'));
        add_action('wp_ajax_preview_spokal_popup', array($this, 'preview_spokal_popup'));
        add_action('wp_ajax_nopriv_submit_spokal_popup_leads', array($this, 'submit_spokal_popup_leads'));
        add_action('wp_ajax_submit_spokal_popup_leads', array($this, 'submit_spokal_popup_leads'));
        add_action('admin_init', array($this, 'switch_exit_intent_to_popup'));
        add_action('wp_footer',array(&$this, 'displayLeadBoxPopups'),1);
    }
    
    public function displayLeadBoxPopups(){
        global $spokal_lead_box_popups;
        if(is_array($spokal_lead_box_popups)){
            foreach($spokal_lead_box_popups as $popup){
                SpokalPopup::renderSpokalPopup(false,$popup["id"],"GraphicWidget",$popup["campaign"]);
            }
        }
    }
    
    
    public function switch_exit_intent_to_popup()
    {
        $instance = get_option('spokal_exit_intent_content');
        $checkEnable = get_option('spokal_exit_intent_enable');
        $css_instance = get_option("spokal_ei_custom_style",array());
        $ei_updated = get_option("spokal_ei_updated",false);
        $new_instance = array();
        
        if(($checkEnable == "enabled") && ($ei_updated == false)){
            if(is_array($instance) && !empty($instance)){
                $new_instance = wp_parse_args($instance,$this->def_instance);
                $new_instance["spokalPopupLogo"] = (isset($new_instance['exitIntentLogo'])) ? $new_instance['exitIntentLogo'] : $this->def_instance["spokalPopupLogo"];
                $id = SpokalPopup::saveSpokalPopup($new_instance,$css_instance,"new","Exit Intent");
                $instance["ei_popup"] = $id["id"];
                update_option('spokal_exit_intent_content',$instance);
            }
        }
        update_option('spokal_ei_updated',true);
        
    }
    
    
    
    /*
     * Register Custom Post Type for Spokal Popups
     */
    public function registerPopups(){
        $args = array(
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => false,
		'show_in_menu'       => false,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' )
	);

	register_post_type( 'spokal_popup', $args );
    }
    
    
    
    /*
     * Submitting leads to Spokal from Spokal Popup
     */
    public function submit_spokal_popup_leads(){
        
        $results = array(
                    'status' => true,
                    'message' => ''
        );
        
        if(isset($_POST['SpokalSource']) && !empty($_POST['SpokalSource'])) {
            $source = $_POST['SpokalSource'];
        }
        else {
            $source = "";
        }
        
        $vars = SpokalLeads::collect_sp_fields($_POST, $source);
                
        $method = $source;
        if($results['status'] && !empty($vars['Email'])) {
            $this->email = $vars['Email'];
            $this->leadList = $vars['SpokalListIdentifier'];
            $responseDecode = SpokalLeads::sendLeads($vars,$method);
            $this->status = $responseDecode;
            if($responseDecode->Result != 'Success'){
                $results['status'] = false;
                $results['message'] = 'errorResponse';
            }
            
        }
        else{
            $results['status'] = false;
            $results['message'] = 'invalidEmail';
        }
        
        SP_Func::set_lead_cookie($this->email,$this->leadList,$this->status);
  
        header('Content-type: application/json');
        echo json_encode($results);
        die();
    }
    
    
    /*
     * Delete Popup from database
     */
    public function delete_spokal_popup(){
        $id = $_POST["id"];
        $deleted = wp_delete_post( $id );
        $status = ($deleted == false) ? false : true;
        
        $popup_select = $this->render_popup_select();
        
        header('Content-type: application/json');
        echo json_encode(array("status" => $status, "popup_select" => $popup_select));
        die();
    }
    
    
    
    /*
     * Preview Spokal popup
     */
    public function preview_spokal_popup(){
        $id = $_POST["id"];
        ob_start();
        SpokalPopup::renderSpokalPopup(true,$id);
        $popup = ob_get_contents();
        ob_end_clean();
        header('Content-type: application/json');
        echo json_encode(array("popup" => $popup));
        die();
    }
    
    
    
    /*
     * Getting list of Spokal Popups From database
     */
    public static function get_popups(){
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
    
    
    
    /*
     * Rendering Popups tab under Spokal plugin page
     */
    public static function renderAdmin($tabOptions){
        $popups = SpokalPopup::get_popups(); 
        ?>
        <div class="information_box html_form_info_box third_party_info_box">
            <p class="header_info">Popups</p>
            <p style="margin: 0.5em;">Create popups here that are used for both the Exit-Intent popup feature and the Graphical Lead Generator widget.</p>
        </div>
        <div class="spokal-popup-content">
            <div>
                <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                        <input type="hidden" name="action" value="sp_style_cta">
                        <input type="hidden" name="style_file" value="<?php echo SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css';?>">
                        <input type="hidden" name="sp_cta" value="sppopup">
                        <input type="hidden" name="boxId" value="<?php echo $tabOptions['box_id']; ?>">
                        <input type="hidden" name="popup_id" value="new">
                        <input type="hidden" name="version" value="">
                        <?php SpokalAdminView::submitButton('Create New Popup','sp_new_popup','primary');?>
                        <div style="float:left;" class="spinner-container">
                            <span  class="sp_spinner sp_style_cta_form_spiner" style="display:none"></span>
                        </div>
                        <div style="clear:both;"></div>
                </form>
            </div>
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                <table class="table table-striped table-bordered table-hover dataTable" id="DataTables_Table_0">
                    <thead>
                        <tr role="row">
                            <th style="min-width: 200px; width: 418px;" class="ui-state-default" role="columnheader" tabindex="0" rowspan="1" colspan="1" >
                                <div class="DataTables_sort_wrapper">
                                    <a rel="tooltip" title="" data-original-title="Name of the Popup">Popup Name</a>
                                </div>
                            </th>

                            <th style="width:58px;" class="ui-state-default" role="columnheader" rowspan="1" colspan="1" aria-label="">
                                <div class="DataTables_sort_wrapper">
                                    <a rel="tooltip" title="" data-original-title="Edit or Delete">Actions</a>
                                </div>
                            </th>
                        </tr>
                    </thead>
            
                    <tbody id="spokal_popups_admin_body"style="" role="alert" aria-live="polite" aria-relevant="all">
                 <?php  if(is_array($popups) && !empty($popups)){ ?>
                            <tr id="no-spokal-popups" style="display: none;"><td valign="top" colspan="7" class="dataTables_empty">There are no Popups created.</td></tr>
                        <?php foreach($popups as $popup){ ?>
                                <tr class="sp_popups_list" id="sp_popup_row_<?php echo $popup->ID; ?>">
                                    <td>
                                        <span title="Preview" onclick="previewPopup('<?php echo $popup->ID; ?>')" class="popup_title"><?php echo $popup->post_title; ?></span>
                                    </td>
                                    <td>
                                        <div style="float: left;" class=""  title="Edit Popup" >
                                            <form action="" method="post" name="sp_style_cta_form" id="sp_style_cta_form" class="sp_style_cta_form">
                                                <input type="hidden" name="action" value="sp_style_cta">
                                                <input type="hidden" name="style_file" value="<?php echo SpokalVars::getInstance()->pluginDir.'css/front/spokal.min.css';?>">
                                                <input type="hidden" name="sp_cta" value="sppopup">
                                                <input type="hidden" name="boxId" value="<?php echo $tabOptions['box_id']; ?>">
                                                <input type="hidden" name="popup_id" value="<?php echo $popup->ID; ?>">
                                                <input type="hidden" name="version" value="">
                                                <!--<i class="icon-eraser bigger-150" onclick="console.log(this.parentNode)">Edit</i>-->
                                                <input class="popup_edit" type="submit" name="submit_cta" value="" > 
                                                <div style="clear:both;"></div>
                                            </form>
                                        </div>
                                        <div title="Delete Popup" style="float: left;" class="popup_delete" onclick="deleteSpPopup('<?php echo $popup->ID; ?>','sp_popup_row_<?php echo $popup->ID; ?>')"></div>
                                        <div style="clear:both;"></div>
                                    </td>
                                </tr>
                     <?php  } 
                        } else{ ?>
                            <tr id="no-spokal-popups"><td valign="top" colspan="7" class="dataTables_empty">There are no Popups created.</td></tr>
                  <?php }?>
                            
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }
    
    
    
    /*
     * Saving Popup to database
     */
    public static function saveSpokalPopup($content,$css,$id,$popup_name){
        $response = array();
        $popup_name = ($popup_name) ? $popup_name : "Spokal Popup";
        if($id == "new"){
            $post = array(
                'post_title'    => $popup_name,
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type' => 'spokal_popup'
              );
            $id = wp_insert_post( $post );
            update_post_meta($id,"sp_popup_custom_css",$css);
            update_post_meta($id,"sp_popup_options",$content);
            $response["action"] = "new";
        }else{
            $post = array(
                'ID'           => $id,
                'post_title'    => $popup_name,
            );
            wp_update_post($post);
            update_post_meta($id,"sp_popup_custom_css",$css);
            update_post_meta($id,"sp_popup_options",$content);
            $response["action"] = "edit";
        }
        $response["id"] = $id;
        
        return $response;
    }
    
    
    
    /*
     * Rendering Spokal Popup on frontend
     */
    public static function renderSpokalPopup($isStyleCta = false,$id="",$method = "",$leadList = -1){
        $popup = get_post( $id );
        if(($popup == NULL) && !$isStyleCta){
            return;
        }
        $options = SpokalPopup::getSpokalPopupOptions($id);
        extract($options);
        if((is_single() || is_page()) && !is_home()) {
            $wordpressPostId = get_the_ID();
            $subscribeURL = get_permalink(get_the_ID());
        } else {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $wordpressPostId = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $subscribeURL = $wordpressPostId;
        }
        
        $widg_identifi = ($method == "GraphicWidget") ? "widget" : "";
        ?>

        
        <div id="sp_popup_overlay-<?php echo $widg_identifi.$id; ?>" class="sp_popup_overlay">
            <style type='text/css' scoped>
                .sp_popup_LoadGif{
                    background: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/loader.gif) no-repeat center center;
                }
                
                .sp_popup_progressValue .sp_popup_inner {
                    background-image: url(<?php echo SpokalVars::getInstance()->pluginUrl; ?>images/prog_bar.png);
                }
            </style>
            <?php SpokalPopup::renderAdditionalCss($id,$method); ?>
            <div class="<?php echo $cssclassname; ?>">
                <div class="sp_popup_wrapp">
                    <div onclick="sp_remove_popup('sp_popup_overlay-<?php echo $widg_identifi.$id; ?>','<?php echo $isStyleCta; ?>','<?php echo $method; ?>')" class="close_sp_popup"></div>
                    <div id="sp_popup_form_content-<?php echo $id; ?>" class="sp_popup_form_content">
                        <?php if($spokalShowProgress || $isStyleCta){?>
                            <div class="sp_popup_prog_header" style="<?php echo ($isStyleCta && !$spokalShowProgress) ? "display:none;" : ""; ?>">50% Complete
                                <div class="sp_popup_progress">
                                    <span class="sp_popup_progressValue">
                                        <span class="sp_popup_inner"></span>
                                    </span>
                                </div>
                            </div>
                         <?php } ?>
                        <script type="text/javascript">var spPSuccMsg<?php echo $id;?> = <?php echo json_encode($successmsg); ?>;var spPFailMsg<?php echo $id;?> = <?php echo json_encode($failmsg); ?>;var spPInvEmMsg<?php echo $id;?> = <?php echo json_encode($invalidEmailMsg); ?>;</script>
                        <form method="post" name="sp_popup_form" id="sp_popup_form-<?php echo $id; ?>" class="sp_popup_form" onsubmit="return submitSpPopup(this,spPSuccMsg<?php echo $id;?>,spPFailMsg<?php echo $id;?>,spPInvEmMsg<?php echo $id;?>)">
                            <p class="sp_popup_title"><?php echo $title; ?></p>
                            <div class="sp_popup_content">
                          <?php if(!empty($spokalPopupLogo)){ 
                                    $text_class = "align-left"; ?>
                                    <img id="sp_popup_logo" class="sp_popup_logo" src="<?php echo $spokalPopupLogo; ?>" alt>
                          <?php }else{
                                    $text_class = "align-center";
                                } ?>
                                <div class="sp_popup_top_text <?php echo $text_class; ?>"><?php echo $toptext; ?></div>
                                <div style="clear:both;"></div>
                            </div>

                            <div class="sp_popup_field">
                                <input  id="sp-pop-email-field" name="Email" type="text" placeholder="<?php echo esc_attr( $emailPlaceholder ); ?>" class = 'sp-popup-input spokal-required email'>
                            </div> 

                            <?php if($collectfirstname || $isStyleCta){ ?>
                                <div class="sp_popup_field" style="<?php echo ($isStyleCta && !$collectfirstname) ? "display:none;" : ""; ?>">
                                    <input class="sp-popup-input" id="sp-pop-fname-field" name="FirstName" type="text" placeholder="<?php echo esc_attr( $firstNamePlaceholder ); ?>">
                                </div>
                            <?php } ?>

                            <?php if($collectlastname || $isStyleCta){ ?>
                                <div class="sp_popup_field" style="<?php echo ($isStyleCta && !$collectlastname) ? "display:none;" : ""; ?>">
                                    <input class="sp-popup-input" id="sp-pop-lname-field" name="LastName" type="text" placeholder="<?php echo esc_attr( $lastNamePlaceholder ); ?>">
                                </div>
                            <?php } ?>

                            <?php if($collectphone || $isStyleCta) { ?>
                                <div class="sp_popup_field" style="<?php echo ($isStyleCta && !$collectphone) ? "display:none;" : ""; ?>">
                                    <input class="sp-popup-input" id="sp-pop-phone-field" name="Phone" placeholder="<?php echo esc_attr( $phonePlaceholder ); ?>" type="text">
                                </div>
                            <?php } ?>

                            <?php if($collectcompany || $isStyleCta) { ?>
                                <div class="sp_popup_field" style="<?php echo ($isStyleCta && !$collectcompany) ? "display:none;" : ""; ?>">
                                    <input class="sp-popup-input" id="sp-pop-company-field" name="Company" placeholder="<?php echo esc_attr( $companyPlaceholder ); ?>" type="text">
                                </div>
                            <?php } ?>

                            <input id="SpokalPostId" name="SpokalPostId" type="hidden" value="<?php echo $wordpressPostId; ?>">

                            <input id="SpokalPiwikId" name="SpokalPiwikId" type="hidden">
                            
                            <input id="SpokalSource" name="SpokalSource" type="hidden" value="<?php echo $method; ?>">
                            
                            <input type="hidden" name="SpokalSubmittedUrl" value="<?php echo $subscribeURL; ?>">

                            <input type='hidden' name='action' value='submit_spokal_popup_leads' >

                            <input  id="SpokalListIdentifier" name="SpokalListIdentifier" type="hidden" value="<?php echo $leadList; ?>">

                            <input  id="SpokalBrowserOsInfo" name="SpokalBrowserOsInfo" type="hidden" value = "<?php if(isset($_SERVER["HTTP_USER_AGENT"])){echo $_SERVER["HTTP_USER_AGENT"];} ?>"/>

                            <input class='sp_popup_submit sp_popup_cta_submit_text' name='submit' value="<?php echo $buttontext; ?>" type="submit" />
                            <div id="sp_popup_LoadGif-<?php echo $id; ?>" class="sp_popup_LoadGif"></div>
                        </form>
                    </div>
                    <div class='sp_popup_succes_message' id="sp_popup_succes_message-<?php echo $id; ?>"></div>
                    <div id="sp_popup_error_message-<?php echo $id; ?>" class="sp_popup_error_message"></div>
                    <input onclick="sp_continue_popup('sp_popup_overlay-<?php echo $widg_identifi.$id; ?>')" id="sp_popup_continue-<?php echo $id; ?>" class='sp_popup_continue sp_popup_submit sp_popup_cta_continue_text' name='submit' value="<?php echo $continueButtonText; ?>" type="submit" onclick="sp_remove_popup('sp_popup_overlay-<?php echo $id; ?>','<?php echo $isStyleCta; ?>','<?php echo $method; ?>')" />
                </div>
            </div>
        </div>
<?php }
    
    
    

    
    /*
     * Getting Popup options
     */
    public static function getSpokalPopupOptions($id = "")
    {
        if(empty($id)){
            if(isset($_POST["popup_id"])){
                if($_POST["popup_id"] == "new"){
                   return SpokalPopup::init()->def_instance;
                }else{
                    return SpokalPopup::merge_popup_options($_POST["popup_id"]);
                }
            }
        }else{
            return SpokalPopup::merge_popup_options($id);
        }
        
    }
    
    
    
    /*
     * Getting Popup Custom css
     */
    public static function getSpokalPopupCss($id = "")
    {
        if(empty($id)){
            if(isset($_POST["popup_id"])){
                if($_POST["popup_id"] == "new"){
                   return array();
                }else{
                    return get_post_meta($_POST["popup_id"],"sp_popup_custom_css",true);
                }
            }
        }else{
            return get_post_meta($id,"sp_popup_custom_css",true);
        }
        
    }
    
    
    
    /*
     * Merging popup option with default
     */
    public static function merge_popup_options($id){
            
            $instance = get_post_meta($id,"sp_popup_options",true);
            
            if(!isset($instance[ 'title' ]) || empty($instance[ 'title' ])){
                $instance[ 'title' ] = __( "Enter your name and email and get the weekly newsletter... it's FREE!", 'text_domain' );
            }
  
            if(!isset($instance[ 'buttontext' ]) || empty($instance[ 'buttontext' ])){
                $instance[ 'buttontext' ] = __( 'Register', 'text_domain' );
            }
            
            if(!isset($instance[ 'continueButtonText' ]) || empty($instance[ 'continueButtonText' ])){
                $instance[ 'continueButtonText' ] = __( 'Continue', 'text_domain' );
            }
            
            if(!isset($instance[ 'collectfirstname' ]) || empty($instance[ 'collectfirstname' ])){
                $instance[ 'collectfirstname' ] = false;
            }
            
            if(!isset($instance[ 'collectlastname' ]) || empty($instance[ 'collectlastname' ])){
                $instance[ 'collectlastname' ] = false;
            }
            
            if(!isset($instance[ 'collectphone' ]) || empty($instance[ 'collectphone' ])){
                $instance[ 'collectphone' ] = false;
            }
            
            if(!isset($instance[ 'collectcompany' ]) || empty($instance[ 'collectcompany' ])){
                $instance[ 'collectcompany' ] = false;
            }
            
            if(!isset($instance[ 'successmsg' ]) || empty($instance[ 'successmsg' ])){
                $instance[ 'successmsg' ] = __( 'Message has been submitted successfully', 'text_domain' );
            }
            
            if(!isset($instance[ 'failmsg' ]) || empty($instance[ 'failmsg' ])){
                $instance[ 'failmsg' ] =  __( 'Failed to send your message. Please try later.', 'text_domain' );
            }
            
            if(!isset($instance[ 'invalidEmailMsg' ]) || empty($instance[ 'invalidEmailMsg' ])){
                $instance[ 'invalidEmailMsg' ] =  __( "Your email address does not appear valid." );
            }
            
            if(!isset($instance[ 'toptext' ]) || empty($instance[ 'toptext' ])){
                $instance[ 'toptext' ] = __( 'Introduce yourself and your program', 'text_domain' );
            }
            
            if(!isset($instance[ 'emailPlaceholder' ]) || empty($instance[ 'emailPlaceholder' ])){
                $instance[ 'emailPlaceholder' ] = "Email";
            }
            
            if(!isset($instance[ 'firstNamePlaceholder' ]) || empty($instance[ 'firstNamePlaceholder' ])){
                $instance[ 'firstNamePlaceholder' ] = "First Name";
            }
            
            if(!isset($instance[ 'lastNamePlaceholder' ]) || empty($instance[ 'lastNamePlaceholder' ])){
                $instance[ 'lastNamePlaceholder' ] = "Last Name";
            }
            
            if(!isset($instance[ 'phonePlaceholder' ]) || empty($instance[ 'phonePlaceholder' ])){
                $instance[ 'phonePlaceholder' ] = "Phone";
            }
            
            if(!isset($instance[ 'companyPlaceholder' ]) || empty($instance[ 'companyPlaceholder' ])){
                $instance[ 'companyPlaceholder' ] = "Company";
            }
            
            if(!isset($instance[ 'cssclassname' ]) || empty($instance[ 'cssclassname' ])){
                $instance[ 'cssclassname' ] = "";
            }
            
            if(!isset($instance[ 'exitIntentLogo' ]) || empty($instance[ 'exitIntentLogo' ])){
                $instance[ 'spokalPopupLogo' ] = "";
            }
            else{
                $instance[ 'spokalPopupLogo' ] = $instance[ 'exitIntentLogo' ];
            }
                
            return $instance;   
    }
    
    
    
    /*
     * Displaying custom css for Popup
     */
    public static function renderAdditionalCss($id,$method){
        $css_instance = SpokalPopup::getSpokalPopupCss($id);
        if(!is_array($css_instance) || empty($css_instance)){
            return;
        }
        $widg_identifi = ($method == "GraphicWidget") ? "widget" : "";
        $prefix = '#sp_popup_overlay-'.$widg_identifi.$id;
        
        $classes = array(
            "background" => $prefix." .sp_popup_wrapp",
            "title" => $prefix." .sp_popup_title",
            "top-text" => $prefix." .sp_popup_top_text",
            "close" => $prefix." .close_sp_popup",
            "input-text" => $prefix." .sp_popup_field .sp-popup-input",
            "button" => $prefix." .sp_popup_wrapp input.sp_popup_submit",
            "success-msg" => $prefix." .sp_popup_succes_message",
            "error-msg" => $prefix." .sp_popup_error_message",
            "show-field" => $prefix." .sp_popup_progressValue"
        );
                
        $css = "";
        foreach($css_instance as $key => $value ){
            if(isset($classes[$key])){
                $css .= $classes[$key]."{";
                    if(isset($value["back-color"]) && !empty($value["back-color"])){
                        $css .= "background-color:#".$value["back-color"].";";
                    }
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                        $css .= "color:#".$value["font-color"].";";
                    }
                    if(isset($value["font-family"]) && !empty($value["font-family"])){
                        $css .= "font-family:".$value["font-family"].";";
                    }
                    if(isset($value["text-bold"]) && !empty($value["text-bold"])){
                        $css .= "font-weight:".$value["text-bold"].";";
                    }
                    if(isset($value["text-italic"]) && !empty($value["text-italic"])){
                        $css .= "font-style:".$value["text-italic"].";";
                    }
                    if(isset($value["text-align"]) && !empty($value["text-align"])){
                        $css .= "text-align:".$value["text-align"].";";
                    }
                    if(isset($value["text-decoration"]) && !empty($value["text-decoration"])){
                        $css .= "text-decoration:".$value["text-decoration"].";";
                    }
                $css .= "}";
                
                if($key == "show-field"){
                    if(isset($value["font-color"]) && !empty($value["font-color"])){
                            $css .= $prefix." .sp_popup_prog_header{color:#".$value["font-color"].";}";
                    }
                }

                //make sure to keep it responsive
                $css .="@media all and (min-width: 686px) {";
                    if(isset($value["font-size"]) && !empty($value["font-size"])){
                        $css .= $classes[$key]."{font-size:".$value["font-size"]."px;}";
                    }
                    
                    if(isset($value["width"]) && !empty($value["width"])){
                        $margin = intval(intval($value["width"])/2);
                        $css .= $classes[$key]."{width:".$value["width"]."px;margin-left:-".$margin."px;}";
                        
                    }
                $css .= "}";

                if(isset($value["placeholder-color"]) && !empty($value["placeholder-color"]) && ($value["placeholder-color"] !=="none")){
                    $css .= $classes[$key]."::-webkit-input-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key]."::-moz-placeholder{color:#".$value["placeholder-color"].";}";
                    $css .= $classes[$key].":-ms-input-placeholder{color:#".$value["placeholder-color"].";}";
                }

                if(isset($value["hover-color"]) && !empty($value["hover-color"])){
                    $css .= $classes[$key].":hover{background-color:#".$value["hover-color"].";}";
                }
            }
        }
        
        if(!empty($css)){
            echo "<style type='text/css' scoped>".$css."</style>";
        }
        
    }
    
    
    /*
     * Rendering Popup select to dynamically popluate it in Exit intent Options
     */
    public function render_popup_select()
    {
        extract(SpokalVars::getInstance()->ExitIntentOptions);
        $popups = SpokalPopup::get_popups();
        
        $select = "";
        
        if(is_array($popups) && !empty($popups) ){ 
            $select = '<select id="exit_intent_popups" name="ei_popup" ><option value="">Choose Popup</option>';
            foreach($popups as $popup){ 
                $checked = ($popup->ID == $ei_popup) ? "selected" : "";
                $select .= '<option '.$checked.' value="'.$popup->ID.'">'.$popup->post_title.'</option>';
            } 
            $select .= '</select>';
        }else{
            $select .= '<span id="exit_intent_popups" ><br>You haven\'t created any popups. Click <a href="'.admin_url("admin.php?page=spokal_options&sp_tab=tab8-5").'">here</a> here to create one now.</span>';
        } 
        return $select;
    }
}
