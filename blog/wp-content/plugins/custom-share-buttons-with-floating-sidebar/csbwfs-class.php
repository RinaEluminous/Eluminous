<?php
/*
 * Custom Share Buttons With Floating Sidebar (C)
 * @get_csbwf_sidebar_options()
 * @get_csbwf_sidebar_content()
 * */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
// get all options value for "Custom Share Buttons with Floating Sidebar"
	function get_csbwf_sidebar_options() {
		global $wpdb;
		$ctOptions = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'csbwfs_%'");
								
		foreach ($ctOptions as $option) {
			$ctOptions[$option->option_name] =  $option->option_value;
		}
	
		return $ctOptions;	
	}
/** Get the current url*/
if(!function_exists('csbwfs_current_path_protocol')):
function csbwfs_current_path_protocol($s, $use_forwarded_host=false)
{
    $pwahttp = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $pwasprotocal = strtolower($s['SERVER_PROTOCOL']);
    $pwa_protocol = substr($pwasprotocal, 0, strpos($pwasprotocal, '/')) . (($pwahttp) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$pwahttp && $port=='80') || ($pwahttp && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $pwa_protocol . '://' . $host;
}
endif;
if(!function_exists('csbwfs_get_current_page_url')):
function csbwfs_get_current_page_url($s, $use_forwarded_host=false)
{
    return csbwfs_current_path_protocol($s, $use_forwarded_host) . $s['REQUEST_URI'];
}
endif;
/* 
 * Site is browsing in mobile or not
 * @csbwfsIsMobile()
 * */
 if(!function_exists('csbwfsIsMobile')):
function csbwfsIsMobile() {
// Check the server headers to see if they're mobile friendly
if(isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
    return true;
}
// Let's NOT return "mobile" if it's an iPhone, because the iPhone can render normal pages quite well.
if(isset($_SERVER["HTTP_USER_AGENT"])):
if(strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
    return false;
}
endif;

// If the http_accept header supports wap then it's a mobile too
if(isset($_SERVER["HTTP_ACCEPT"])):
if(preg_match("/wap\.|\.wap/i",$_SERVER["HTTP_ACCEPT"])) {
    return true;
}
endif;
// Still no luck? Let's have a look at the user agent on the browser. If it contains
// any of the following, it's probably a mobile device. Kappow!
if(isset($_SERVER["HTTP_USER_AGENT"])){
    $user_agents = array("midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows\ ce", "mmp\/", "blackberry", "mib\/", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up\.b", "audio", "SIE\-", "SEC\-", "samsung", "HTC", "mot\-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "\d\d\di", "moto");
    foreach($user_agents as $user_string){
        if(preg_match("/".$user_string."/i",$_SERVER["HTTP_USER_AGENT"])) {
            return true;
        }
    }
}
// None of the above? Then it's probably not a mobile device.
return false;
}	
endif;
// Get plugin options
$pluginOptionsVal=get_csbwf_sidebar_options();
//check plugin in enable or not
if(isset($pluginOptionsVal['csbwfs_active']) && $pluginOptionsVal['csbwfs_active']==1){
	
if((csbwfsIsMobile()) && 
isset($pluginOptionsVal['csbwfs_deactive_for_mob']) && $pluginOptionsVal['csbwfs_deactive_for_mob']!='')
{
// silent is Gold;
}else
{
add_action('wp_footer','get_csbwf_sidebar_content');
add_action( 'wp_enqueue_scripts', 'csbwf_sidebar_scripts' );
add_action('wp_footer','csbwf_sidebar_load_inline_js');
add_action('wp_footer','csbwfs_cookie');
}

}

function csbwfs_cookie()
{
echo $cookieVal='<script>csbwfsCheckCookie();function csbwfsSetCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function csbwfsGetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(\';\');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==\' \') c = c.substring(1);
        if (c.indexOf(name) != -1) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function csbwfsCheckCookie() {
	var hideshowhide = "'.get_option('csbwfs_rmSHBtn').'"
    var button_status=csbwfsGetCookie("csbwfs_show_hide_status");
    if (button_status != "") {
        
    } else {
        csbwfsSetCookie("csbwfs_show_hide_status", "active",1);
    }
    if(hideshowhide=="yes")
    {
    csbwfsSetCookie("csbwfs_show_hide_status", "active",0);
    }
}

</script>';
}
if(isset($pluginOptionsVal['csbwfs_buttons_active']) && $pluginOptionsVal['csbwfs_buttons_active']==1){
add_filter( 'the_content', 'csbfs_the_content_filter', 20);
add_action( 'wp_enqueue_scripts', 'csbwf_sidebar_scripts' );
}
//register style and scrip files
function csbwf_sidebar_scripts() {
wp_enqueue_script( 'jquery' ); // wordpress jQuery
wp_register_style( 'csbwf_sidebar_style', plugins_url( 'css/csbwfs.css',__FILE__ ) );
wp_enqueue_style( 'csbwf_sidebar_style' );
}
/*********************************************************
"Add the jQuery code in head section using hooks"
*********************************************************/
function csbwf_sidebar_load_inline_js()
{
   $pluginOptionsVal=get_csbwf_sidebar_options();
	$jscnt='<script>
	  var windWidth=jQuery( window ).width();
	  //alert(windWidth);
	  var animateWidth;
	  var defaultAnimateWidth;';
  $jscnt.='
	jQuery(document).ready(function()
  { 
	animateWidth="55";
    defaultAnimateWidth= animateWidth-10;
	animateHeight="49";
	defaultAnimateHeight= animateHeight-2;';
  if($pluginOptionsVal['csbwfs_delayTimeBtn']!='0'):
     $jscnt.='jQuery("#csbwfs-delaydiv").hide();
	  setTimeout(function(){
	  jQuery("#csbwfs-delaydiv").fadeIn();}, '.$pluginOptionsVal['csbwfs_delayTimeBtn'].');';
  endif;  
  
if($pluginOptionsVal['csbwfs_position']=='right' || $pluginOptionsVal['csbwfs_position']=='left'){
 
  $jscnt.='jQuery("div.csbwfsbtns a").hover(function(){
  jQuery(this).animate({width:animateWidth});
  },function(){
    jQuery(this).stop( true, true ).animate({width:defaultAnimateWidth});
  });';
}else
{  
 //silent
  
}

if(isset($pluginOptionsVal['csbwfs_auto_hide']) && $pluginOptionsVal['csbwfs_auto_hide']!=''):
$jscnt.='csbwfsSetCookie("csbwfs_show_hide_status","in_active","1");';
endif;

  $jscnt.='jQuery("div.csbwfs-show").hide();
  jQuery("div.csbwfs-show a").click(function(){
    jQuery("div#csbwfs-social-inner").show(500);
     jQuery("div.csbwfs-show").hide(500);
    jQuery("div.csbwfs-hide").show(500);
    csbwfsSetCookie("csbwfs_show_hide_status","active","1");
  });
  
  jQuery("div.csbwfs-hide a").click(function(){
     jQuery("div.csbwfs-show").show(500);
      jQuery("div.csbwfs-hide").hide(500);
     jQuery("div#csbwfs-social-inner").hide(500);
     csbwfsSetCookie("csbwfs_show_hide_status","in_active","1");
  });';
  
   $jscnt.='var button_status=csbwfsGetCookie("csbwfs_show_hide_status");
    if (button_status =="in_active") {
      jQuery("div.csbwfs-show").show();
      jQuery("div.csbwfs-hide").hide();
     jQuery("div#csbwfs-social-inner").hide();
    } else {
      jQuery("div#csbwfs-social-inner").show();
     jQuery("div.csbwfs-show").hide();
    jQuery("div.csbwfs-hide").show();
    }';

  
$jscnt.='});

</script>';
	
	echo $jscnt;
}	
 
/********************************************************
"Custom Share Buttons with Floating Sidebar" HTML
*********************************************************/
function get_csbwf_sidebar_content() {
global $post;
$pluginOptionsVal=get_csbwf_sidebar_options();
$shareurl = htmlspecialchars(csbwfs_get_current_page_url($_SERVER), ENT_QUOTES, 'UTF-8');
$ShareTitle = (is_front_page() && is_home()) ? get_bloginfo('name'): trim(wp_title('',false));
$ShareTitle= htmlspecialchars(rawurlencode($ShareTitle));
$ShareTitle = str_replace("%26%23039%3B","",$ShareTitle);// remove single quate
/* Get All buttons Image */
//get facebook button image
if($pluginOptionsVal['csbwfs_fb_image']!=''){ $fImg=$pluginOptionsVal['csbwfs_fb_image'];} 
   else{$fImg='';}   
//get twitter button image  
if($pluginOptionsVal['csbwfs_tw_image']!=''){ $tImg=$pluginOptionsVal['csbwfs_tw_image'];} 
   else{$tImg='';}   
//get Linkedin button image
if($pluginOptionsVal['csbwfs_li_image']!=''){ $lImg=$pluginOptionsVal['csbwfs_li_image'];} 
   else{$lImg='';}   
//get mail button image  
if($pluginOptionsVal['csbwfs_mail_image']!=''){ $mImg=$pluginOptionsVal['csbwfs_mail_image'];} 
   else{$mImg='';}   
//get pinterest button image   
if($pluginOptionsVal['csbwfs_pin_image']!=''){ $pImg=$pluginOptionsVal['csbwfs_pin_image'];} 
   else{$pImg='';}   
//get youtube button image
if(isset($pluginOptionsVal['csbwfs_yt_image']) && $pluginOptionsVal['csbwfs_yt_image']!=''){ $ytImg=$pluginOptionsVal['csbwfs_yt_image'];} 
   else{$ytImg='';}    
//get reddit plus button image 
if(isset($pluginOptionsVal['csbwfs_re_image']) && $pluginOptionsVal['csbwfs_re_image']!=''){ $reImg=$pluginOptionsVal['csbwfs_re_image'];} 
   else{$reImg='';}
//get stumbleupon button image   
if(isset($pluginOptionsVal['csbwfs_st_image']) && $pluginOptionsVal['csbwfs_st_image']!=''){ $stImg=$pluginOptionsVal['csbwfs_st_image'];} 
   else{$stImg='';}   
/* Get All buttons Image Alt/Title */
//get facebook button image alt/title
if($pluginOptionsVal['csbwfs_fb_title']!=''){ $fImgAlt=$pluginOptionsVal['csbwfs_fb_title'];} 
else{$fImgAlt='Share On Facebook';}   
//get twitter button image alt/title
if($pluginOptionsVal['csbwfs_tw_title']!=''){ $tImgAlt=$pluginOptionsVal['csbwfs_tw_title'];} 
else{$tImgAlt='Share On Twitter';}   
//get Linkedin button image alt/title
if($pluginOptionsVal['csbwfs_li_title']!=''){ $lImgAlt=$pluginOptionsVal['csbwfs_li_title'];} 
else{$lImgAlt='Share On Linkedin';}   
//get mail button image alt/title 
if($pluginOptionsVal['csbwfs_mail_title']!=''){ $mImgAlt=$pluginOptionsVal['csbwfs_mail_title'];} 
else{$mImgAlt='Contact us';}   
//get pinterest button image alt/title  
if($pluginOptionsVal['csbwfs_pin_title']!=''){ $pImgAlt=$pluginOptionsVal['csbwfs_pin_title'];} 
else{$pImgAlt='Share On Pinterest';}   
//get youtube button image alt/title
if(isset($pluginOptionsVal['csbwfs_yt_title']) && $pluginOptionsVal['csbwfs_yt_title']!=''){ $ytImgAlt=$pluginOptionsVal['csbwfs_yt_title'];} 
else{$ytImgAlt='Share On Youtube';}
//get reddit plus button image alt/title
if(isset($pluginOptionsVal['csbwfs_re_title']) && $pluginOptionsVal['csbwfs_re_title']!=''){ $reImgAlt=$pluginOptionsVal['csbwfs_re_title'];} 
else{$reImgAlt='Share On Reddit';}  
//get stumbleupon button image alt/title  
if(isset($pluginOptionsVal['csbwfs_st_title']) && $pluginOptionsVal['csbwfs_st_title']!=''){ $stImgAlt=$pluginOptionsVal['csbwfs_st_title'];} 
else{$stImgAlt='Share On Stumbleupon';}
//get email message
if(is_page() || is_single() || is_category() || is_archive()){
		if($pluginOptionsVal['csbwfs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['csbwfs_mailMessage'];} else{
		 $mailMsg='?subject='.$ShareTitle.'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
// Top Margin
if($pluginOptionsVal['csbwfs_top_margin']!=''){
	$margin=$pluginOptionsVal['csbwfs_top_margin'];
}else
{
	$margin='25%';
	}

//Sidebar Position
if($pluginOptionsVal['csbwfs_position']=='right'){
$style=' style="top:'.$margin.';right:-5px;"';	$idName=' id="csbwfs-right"'; $showImg='hide-r.png'; $hideImg='show.png';	
}else if($pluginOptionsVal['csbwfs_position']=='bottom'){
$style=' style="bottom:0;"'; $idName=' id="csbwfs-bottom"'; $showImg='hide-b.png'; $hideImg='show.png';
}
else
{
$idName=' id="csbwfs-left"'; $style=' style="top:'.$margin.';left:0;"'; $showImg='hide-l.png';$hideImg='hide.png';
}
/* Get All buttons background color */
//get facebook button image background color 
if($pluginOptionsVal['csbwfs_fb_bg']!=''){ $fImgbg=' style="background:'.$pluginOptionsVal['csbwfs_fb_bg'].';"';} 
else{$fImgbg='';}   
//get twitter button image  background color 
if($pluginOptionsVal['csbwfs_tw_bg']!=''){ $tImgbg=' style="background:'.$pluginOptionsVal['csbwfs_tw_bg'].';"';} 
else{$tImgbg='';}   
//get Linkedin button image background color 
if($pluginOptionsVal['csbwfs_li_bg']!=''){ $lImgbg=' style="background:'.$pluginOptionsVal['csbwfs_li_bg'].';"';} 
else{$lImgbg='';}   
//get mail button image  background color 
if($pluginOptionsVal['csbwfs_mail_bg']!=''){ $mImgbg=' style="background:'.$pluginOptionsVal['csbwfs_mail_bg'].';"';} 
else{$mImgbg='';}   
//get pinterest button image   background color 
if($pluginOptionsVal['csbwfs_pin_bg']!=''){ $pImgbg=' style="background:'.$pluginOptionsVal['csbwfs_pin_bg'].';"';}
else{$pImgbg='';}  

//get youtube button image   background color 
if(isset($pluginOptionsVal['csbwfs_yt_bg']) && $pluginOptionsVal['csbwfs_yt_bg']!=''){ $ytImgbg=' style="background:'.$pluginOptionsVal['csbwfs_yt_bg'].';"';}else{$ytImgbg='';}   
//get reddit button image   background color 
if(isset($pluginOptionsVal['csbwfs_re_bg']) && $pluginOptionsVal['csbwfs_re_bg']!=''){ $reImgbg=' style="background:'.$pluginOptionsVal['csbwfs_re_bg'].';"';}else{$reImgbg='';}  
//get stumbleupon button image   background color 
if(isset($pluginOptionsVal['csbwfs_st_bg']) && $pluginOptionsVal['csbwfs_st_bg']!=''){ $stImgbg=' style="background:'.$pluginOptionsVal['csbwfs_st_bg'].';"';} else{$stImgbg='';}
     
/** Message */ 
if($pluginOptionsVal['csbwfs_show_btn']!=''){ $showbtn=$pluginOptionsVal['csbwfs_show_btn'];} 
   else{$showbtn='Show Buttons';}   
//get show/hide button message 
if($pluginOptionsVal['csbwfs_hide_btn']!=''){ $hidebtn=$pluginOptionsVal['csbwfs_hide_btn'];} 
   else{$hidebtn='Hide Buttons';}   
//get mail button message 
if($pluginOptionsVal['csbwfs_share_msg']!=''){ $sharemsg=$pluginOptionsVal['csbwfs_share_msg'];} 
   else{$sharemsg='Share This With Your Friends';}   

/** Check display Show/Hide button or not*/
if(isset($pluginOptionsVal['csbwfs_rmSHBtn']) && $pluginOptionsVal['csbwfs_rmSHBtn']!=''):
$isActiveHideShowBtn='yes';
else:
$isActiveHideShowBtn='no';
endif;
$floatingSidebarContent='<div id="csbwfs-delaydiv"><div class="csbwfs-social-widget" '.$idName.' title="'.$sharemsg.'" '.$style.'>';

if($isActiveHideShowBtn!='yes') :
$floatingSidebarContent .= '<div class="csbwfs-show"><a href="javascript:" title="'.$showbtn.'" id="csbwfs-show"><img src="'.plugins_url('custom-share-buttons-with-floating-sidebar/images/'.$showImg).'" alt="'.$showbtn.'"></a></div>';
endif;

$floatingSidebarContent .= '<div id="csbwfs-social-inner">';

/** FB */
if($pluginOptionsVal['csbwfs_fpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-fb" class="csbwfs-fb"><a href="javascript:" onclick="javascript:window.open(\'//www.facebook.com/sharer/sharer.php?u='.$shareurl.'\', \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;" target="_blank" title="'.$fImgAlt.'" '.$fImgbg.'>';

if($fImg!=''){
$floatingSidebarContent .='<img src="'.$fImg.'" alt="'.$fImgAlt.'" width="35" height="35" >';
}else{
$floatingSidebarContent .='<i class="csbwfs_facebook"></i>';
}
$floatingSidebarContent .='</a></div></div>';
endif;

/** TW */
if($pluginOptionsVal['csbwfs_tpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-tw" class="csbwfs-tw"><a href="javascript:" onclick="window.open(\'//twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'\',\'_blank\',\'width=800,height=300\')" title="'.$tImgAlt.'" '.$tImgbg.'>';
	if($tImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$tImg.'" alt="'.$tImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_twitter"></i>';
	}
$floatingSidebarContent .='</a></div></div>';

endif;

/**  LI */
if($pluginOptionsVal['csbwfs_lpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-li" class="csbwfs-li"><a href="javascript:" onclick="javascript:window.open(\'//www.linkedin.com/cws/share?mini=true&url='. $shareurl.'\',\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" title="'.$lImgAlt.'" '.$lImgbg.'>';
	if($lImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$lImg.'" alt="'.$lImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_linkedin"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** PIN */
if($pluginOptionsVal['csbwfs_ppublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-pin" class="csbwfs-pin"><a onclick="javascript:void((function(){var e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'//assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)})());" href="javascript:void(0);" '.$pImgbg.' title="'.$pImgAlt.'">';
	if($pImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$pImg.'" alt="'.$pImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_pinterest"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** Reddit */
if(isset($pluginOptionsVal['csbwfs_republishBtn']) && $pluginOptionsVal['csbwfs_republishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-re" class="csbwfs-re"><a onclick="window.open(\'//reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);" '.$reImgbg.' title="'.$reImgAlt.'">';
	if($reImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$reImg.'" alt="'.$reImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_reddit"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

/** Stumbleupon/Mix */
if(isset($pluginOptionsVal['csbwfs_stpublishBtn']) && $pluginOptionsVal['csbwfs_stpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-st" class="csbwfs-st"><a onclick="window.open(\'//mix.com/mixit?su=submit&url='.$shareurl.'\',\'Mix\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" '.$stImgbg.' title="'.$stImgAlt.'">';
	if($stImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$stImg.'" alt="'.$stImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_stumbleupon"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif; 
/** YT */	 	 
if(isset($pluginOptionsVal['csbwfs_ytpublishBtn']) && $pluginOptionsVal['csbwfs_ytpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-yt" class="csbwfs-yt"><a onclick="window.open(\''.$pluginOptionsVal['csbwfs_ytPath'].'\');" href="javascript:void(0);" '.$ytImgbg.' title="'.$ytImgAlt.'">';
	if($ytImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$ytImg.'" alt="'.$ytImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_youtube"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;
/** Skype */	 	 
if((isset($pluginOptionsVal['csbwfs_skpublishBtn']) && $pluginOptionsVal['csbwfs_skpublishBtn']!='') && (isset($pluginOptionsVal['csbwfs_skPath']) && $pluginOptionsVal['csbwfs_skPath']!='')):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-sk" class="csbwfs-sk"><a href="skype:'.$pluginOptionsVal['csbwfs_skPath'].'" >';
$floatingSidebarContent .='<i class="csbwfs_skype"></i>';
$floatingSidebarContent .='</a></div></div>';
endif;
/** Mail*/
if($pluginOptionsVal['csbwfs_mpublishBtn']!=''):
$floatingSidebarContent .='<div class="csbwfs-sbutton csbwfsbtns"><div id="csbwfs-ml" class="csbwfs-ml"><a href="mailto:'.$mailMsg.'" title="'.$mImgAlt.'" '.$mImgbg.' >';
	if($mImg!='')
	{
	  $floatingSidebarContent .='<img src="'.$mImg.'" alt="'.$mImgAlt.'" width="35" height="35" >';
	}else{
	  $floatingSidebarContent .='<i class="csbwfs_mail"></i>';
	}
$floatingSidebarContent .='</a></div></div>';
endif;

$floatingSidebarContent .='</div>'; //End social-inner

if($isActiveHideShowBtn!='yes') :
$floatingSidebarContent .='<div class="csbwfs-hide"><a href="javascript:" title="'.$hidebtn.'" id="csbwfs-hide"><img src="'.plugins_url('custom-share-buttons-with-floating-sidebar/images/'.$hideImg).'" alt="'.$hidebtn.'"></a></div>';
endif;

$floatingSidebarContent .='</div></div>'; //End social-inner
/** Check conditions */
// Returns the content.
if(isset($pluginOptionsVal['csbwfs_hide_home'])){$hideOnHome=$pluginOptionsVal['csbwfs_hide_home'];	}else{			$hideOnHome='';}
  
if((is_home() && is_front_page()) && $hideOnHome=='yes'):
$floatingSidebarContent='';
endif;
if(is_front_page() && $hideOnHome=='yes' ):
$floatingSidebarContent='';
endif;
/** hide on 404 pages */
if(is_404()):$floatingSidebarContent='';endif;

print $floatingSidebarContent; 
}

/**
 * Add social share bottons to the end of every post/page.
 *
 * @uses is_home()
 * @uses is_page()
 * @uses is_single()
 */
function csbfs_the_content_filter( $content ) {

global $post;
$pluginOptionsVal=get_csbwf_sidebar_options();
if(is_category())
	{
	   $category_id = get_query_var('cat');  
	   $cats = get_the_category();
	   $ShareTitle=$cats[0]->name;
	}elseif($post && is_singular($post->post_type))
	{
	   $ShareTitle=$post->post_title;
	}
	elseif(is_archive()){
	   global $wp;
       if ( is_day() ) :
		 $ShareTitle='Daily Archives: '. get_the_date(); 
		elseif ( is_month() ) : 
		 $ShareTitle='Monthly Archives: '. get_the_date('F Y'); 
		elseif ( is_year() ) : 
		 $ShareTitle='Yearly Archives: '. get_the_date('Y'); 
		elseif ( is_author() ) : 
		 $ShareTitle='Author Archives: '. get_the_author(); 
		else :
		 $ShareTitle ='Blog Archives';
		endif;			
	}
	else
	{
        $ShareTitle=get_bloginfo('name');
		}
/* Set title and url for home page */  
if(is_home() && is_front_page()){
$ShareTitle=get_bloginfo('name');	
}	

$shareurl = htmlspecialchars(csbwfs_get_current_page_url($_SERVER), ENT_QUOTES, 'UTF-8');

$ShareTitle= htmlspecialchars(rawurlencode($ShareTitle));

/* Get All buttons Image */

//get facebook button image
if($pluginOptionsVal['csbwfs_page_fb_image']!=''){ $fImg=$pluginOptionsVal['csbwfs_page_fb_image'];} 
   else{$fImg='';}   
//get twitter button image  
if($pluginOptionsVal['csbwfs_page_tw_image']!=''){ $tImg=$pluginOptionsVal['csbwfs_page_tw_image'];} 
   else{$tImg='';}   
//get Linkedin button image
if($pluginOptionsVal['csbwfs_page_li_image']!=''){ $lImg=$pluginOptionsVal['csbwfs_page_li_image'];} 
   else{$lImg='';}   
//get mail button image  
if($pluginOptionsVal['csbwfs_page_mail_image']!=''){ $mImg=$pluginOptionsVal['csbwfs_page_mail_image'];} 
   else{$mImg='';}   
//get pinterest button image   
if($pluginOptionsVal['csbwfs_page_pin_image']!=''){ $pImg=$pluginOptionsVal['csbwfs_page_pin_image'];} 
   else{$pImg='';}   
   
//get youtube button image   
if(isset($pluginOptionsVal['csbwfs_page_yt_image']) && $pluginOptionsVal['csbwfs_page_yt_image']!=''){ $ytImg=$pluginOptionsVal['csbwfs_page_yt_image'];} 
   else{$ytImg='';}   
//get reddit plus button image 
if(isset($pluginOptionsVal['csbwfs_page_re_image']) && $pluginOptionsVal['csbwfs_page_re_image']!=''){ $reImg=$pluginOptionsVal['csbwfs_page_re_image'];} 
   else{$reImg='';}  
//get stumbleupon button image   
if(isset($pluginOptionsVal['csbwfs_page_st_image']) && $pluginOptionsVal['csbwfs_page_st_image']!=''){ $stImg=$pluginOptionsVal['csbwfs_page_st_image'];} 
   else{$stImg='';}  

/* Get All buttons Image Alt/Title */
//get facebook button image alt/title
if($pluginOptionsVal['csbwfs_page_fb_title']!=''){ $fImgAlt=$pluginOptionsVal['csbwfs_page_fb_title'];} 
else{$fImgAlt='Share On Facebook';}   
//get twitter button image alt/title
if($pluginOptionsVal['csbwfs_page_tw_title']!=''){ $tImgAlt=$pluginOptionsVal['csbwfs_page_tw_title'];} 
else{$tImgAlt='Share On Twitter';}   
//get Linkedin button image alt/title
if($pluginOptionsVal['csbwfs_page_li_title']!=''){ $lImgAlt=$pluginOptionsVal['csbwfs_page_li_title'];} 
else{$lImgAlt='Share On Linkedin';}   
//get mail button image alt/title 
if($pluginOptionsVal['csbwfs_page_mail_title']!=''){ $mImgAlt=$pluginOptionsVal['csbwfs_page_mail_title'];} 
else{$mImgAlt='Contact us';}   
//get pinterest button image alt/title  
if($pluginOptionsVal['csbwfs_page_pin_title']!=''){ $pImgAlt=$pluginOptionsVal['csbwfs_page_pin_title'];} 
else{$pImgAlt='Share On Pinterest';}   
//get youtube button image alt/title
if(isset($pluginOptionsVal['csbwfs_page_yt_title']) && $pluginOptionsVal['csbwfs_page_yt_title']!=''){ $ytImgAlt=$pluginOptionsVal['csbwfs_page_yt_title'];} 
else{$ytImgAlt='Share On Youtube';}
//get reddit plus button image alt/title
if(isset($pluginOptionsVal['csbwfs_page_re_title']) && $pluginOptionsVal['csbwfs_page_re_title']!=''){ $reImgAlt=$pluginOptionsVal['csbwfs_page_re_title'];} 
else{$reImgAlt='Share On Reddit';}  
//get stumbleupon button image alt/title  
if(isset($pluginOptionsVal['csbwfs_page_st_title']) && $pluginOptionsVal['csbwfs_page_st_title']!=''){ $stImgAlt=$pluginOptionsVal['csbwfs_page_st_title'];} 
else{$stImgAlt='Share On Stumbleupon';}

/* Get All buttons background color */
//get facebook button image background color 
if($pluginOptionsVal['csbwfs_page_fb_bg']!=''){ $fImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_fb_bg'].';"';} 
else{$fImgbg='';}   
//get twitter button image  background color 
if($pluginOptionsVal['csbwfs_page_tw_bg']!=''){ $tImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_tw_bg'].';"';} 
else{$tImgbg='';}   
//get Linkedin button image background color 
if($pluginOptionsVal['csbwfs_page_li_bg']!=''){ $lImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_li_bg'].';"';} 
else{$lImgbg='';}   
//get mail button image  background color 
if($pluginOptionsVal['csbwfs_page_mail_bg']!=''){ $mImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_mail_bg'].';"';} 
else{$mImgbg='';}   
//get pinterest button image   background color 
if($pluginOptionsVal['csbwfs_page_pin_bg']!=''){ $pImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_pin_bg'].';"';}
else{$pImgbg='';}  

//get youtube button image   background color 
if(isset($pluginOptionsVal['csbwfs_page_yt_bg']) && $pluginOptionsVal['csbwfs_page_yt_bg']!=''){ $ytImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_yt_bg'].';"';}else{$ytImgbg='';}   
//get reddit button image   background color 
if(isset($pluginOptionsVal['csbwfs_page_re_bg']) && $pluginOptionsVal['csbwfs_page_re_bg']!=''){ $reImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_re_bg'].';"';}else{$reImgbg='';}  
//get stumbleupon button image   background color 
if(isset($pluginOptionsVal['csbwfs_page_st_bg']) && $pluginOptionsVal['csbwfs_page_st_bg']!=''){ $stImgbg=' style="background:'.$pluginOptionsVal['csbwfs_page_st_bg'].';"';} else{$stImgbg='';}
//get email message 
if(is_page() || is_single() || is_category() || is_archive()){
	
		if($pluginOptionsVal['csbwfs_mailMessage']!=''){ $mailMsg=$pluginOptionsVal['csbwfs_mailMessage'];} else{
		 $mailMsg='?subject='.get_the_title().'&body='.$shareurl;}
 }else
 {
	 $mailMsg='?subject='.get_bloginfo('name').'&body='.home_url('/');
	 }
if(isset($pluginOptionsVal['csbwfs_btn_position']) && $pluginOptionsVal['csbwfs_btn_position']!=''):
$btnPosition=$pluginOptionsVal['csbwfs_btn_position'];
else:
$btnPosition='left';
endif;

if(isset($pluginOptionsVal['csbwfs_btn_text']) && $pluginOptionsVal['csbwfs_btn_text']!=''):
$btnText=$pluginOptionsVal['csbwfs_btn_text'];
else:
$btnText='';
endif;

$shareButtonContent='<div id="socialButtonOnPage" class="'.$btnPosition.'SocialButtonOnPage">';
if($btnText!=''):
$shareButtonContent.='<div class="sharethis-arrow" title="'.$btnText.'"><span>'.$btnText.'</span></div>';
endif;
/* Facebook*/
if($pluginOptionsVal['csbwfs_fpublishBtn']!=''):
	$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="fb-p" class="csbwfs-fb"><a href="javascript:"  onclick="window.open(\'//www.facebook.com/sharer/sharer.php?u='.$shareurl.'\',\'Facebook\',\'width=800,height=300\');return false;"
   target="_blank" title="'.$fImgAlt.'" '.$fImgbg.'>';
if($fImg!=''){
$shareButtonContent .='<img src="'.$fImg.'" alt="'.$fImgAlt.'" width="35" height="35" >';
}else{
$shareButtonContent .='<i class="csbwfs_facebook"></i>';
}
$shareButtonContent .='</a></div></div>';
endif;

/* Twitter */
if($pluginOptionsVal['csbwfs_tpublishBtn']!=''):
	$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="tw-p" class="csbwfs-tw"><a href="javascript:" onclick="window.open(\'//twitter.com/share?url='.$shareurl.'&text='.$ShareTitle.'&nbsp;&nbsp;\', \'_blank\', \'width=800,height=300\')" title="'.$tImgAlt.'" '.$tImgbg.'>';
	if($tImg!='')
	{
	  $shareButtonContent .='<img src="'.$tImg.'" alt="'.$tImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_twitter"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Linkedin */
if($pluginOptionsVal['csbwfs_lpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="li-p" class="csbwfs-li"><a href="javascript:" onclick="javascript:window.open(\'//www.linkedin.com/shareArticle?mini=true&url='.$shareurl.'\',\'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" title="'.$lImgAlt.'" '.$lImgbg.'>';
	if($lImg!='')
	{
	  $shareButtonContent .='<img src="'.$lImg.'" alt="'.$lImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_linkedin"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;

/* Pinterest */
if($pluginOptionsVal['csbwfs_ppublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="pin-p" class="csbwfs-pin"><a onclick="javascript:void((function(){var e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'//assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)})());" href="javascript:void(0);" title="'.$pImgAlt.'" '.$pImgbg.'>';
	if($pImg!='')
	{
	  $shareButtonContent .='<img src="'.$pImg.'" alt="'.$pImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_pinterest"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Reddit */
if(isset($pluginOptionsVal['csbwfs_republishBtn']) && $pluginOptionsVal['csbwfs_republishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="re-p" class="csbwfs-re"><a onclick="window.open(\'//reddit.com/submit?url='.$shareurl.'&amp;title='.$ShareTitle.'\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);" title="'.$reImgAlt.'" '.$reImgbg.'>';
	if($reImg!='')
	{
	  $shareButtonContent .='<img src="'.$reImg.'" alt="'.$reImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_reddit"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Stumbleupon/Mix */
if(isset($pluginOptionsVal['csbwfs_stpublishBtn']) && $pluginOptionsVal['csbwfs_stpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="st-p" class="csbwfs-st"><a onclick="window.open(\'//mix.com/mixit?su=submit&url='.$shareurl.'\',\'Mix\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);" title="'.$stImgAlt.'" '.$stImgbg.'>';
	if($stImg!='')
	{
	  $shareButtonContent .='<img src="'.$stImg.'" alt="'.$stImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_stumbleupon"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/* Youtube */
if(isset($pluginOptionsVal['csbwfs_ytpublishBtn']) && $pluginOptionsVal['csbwfs_ytpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="yt-p" class="csbwfs-yt"><a onclick="window.open(\''.$pluginOptionsVal['csbwfs_ytPath'].'\');" href="javascript:void(0);" title="'.$ytImgAlt.'" '.$ytImgbg.'>';
	if($ytImg!='')
	{
	  $shareButtonContent .='<img src="'.$ytImg.'" alt="'.$ytImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_youtube"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
/** Skype */	 	 
if((isset($pluginOptionsVal['csbwfs_skpublishBtn']) && $pluginOptionsVal['csbwfs_skpublishBtn']!='') && (isset($pluginOptionsVal['csbwfs_skPath']) && $pluginOptionsVal['csbwfs_skPath']!='')):
$shareButtonContent .='<div class="csbwfs-sbutton-post"><div id="sk-p" class="csbwfs-sk"><a href="skype:'.$pluginOptionsVal['csbwfs_skPath'].'" >';
$shareButtonContent .='<i class="csbwfs_skype"></i>';
$shareButtonContent .='</a></div></div>';
endif;
/* Email */
if($pluginOptionsVal['csbwfs_mpublishBtn']!=''):
$shareButtonContent.='<div class="csbwfs-sbutton-post"><div id="ml-p" class="csbwfs-ml"><a href="mailto:'.$mailMsg.'" title="'.$mImgAlt.'"  '.$mImgbg.'>';
	if($mImg!='')
	{
	  $shareButtonContent .='<img src="'.$mImg.'" alt="'.$mImgAlt.'" width="35" height="35" >';
	}else{
	  $shareButtonContent .='<i class="csbwfs_mail"></i>';
	}
$shareButtonContent .='</a></div></div>';
endif;
$shareButtonContent.='</div>';

	// Returns the content.
global $post;
    $shareButtonContentReturn='';
	/* DEFAULT HOME */
	if((is_home() && is_front_page()) && $pluginOptionsVal['csbwfs_page_hide_home']=='yes'):
	$shareButtonContentReturn=$shareButtonContent;
    endif;
	/* STATIC front page */
	if(is_front_page() && $pluginOptionsVal['csbwfs_page_hide_home']=='yes'):
    $shareButtonContentReturn=$shareButtonContent;
    endif;
	//post
    if(is_single() && $pluginOptionsVal['csbwfs_page_hide_post']=='yes'):
     $shareButtonContentReturn=$shareButtonContent;
    endif;
    //page
    if(is_page() && $pluginOptionsVal['csbwfs_page_hide_page']=='yes'):
	if(!is_front_page()):
     $shareButtonContentReturn=$shareButtonContent;
     endif;
    endif;
    //archive
    if(is_archive() && $pluginOptionsVal['csbwfs_page_hide_archive']=='yes'):
     $shareButtonContentReturn=$shareButtonContent;
    endif;
   // 404
    if(is_404()):
     $shareButtonContentReturn='';
    endif;
	/** Buttons position on content */
  if(isset($pluginOptionsVal['csbwfs_btn_display']) && $pluginOptionsVal['csbwfs_btn_display']=='above'){ 
		 $finalContent= $shareButtonContentReturn.$content;
		}else
		{
			$finalContent = $content.$shareButtonContentReturn;
			}
return $finalContent;
}
