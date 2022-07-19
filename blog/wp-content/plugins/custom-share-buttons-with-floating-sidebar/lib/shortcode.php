<?php
/*
 * Template files to define CSBWFS Shortcodes
 * @add_shortcode()
 * @do_shortcode()
 * shortcode [csbwfs_buttons]
 **/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('CsbwfsShortcodeClass')):
class CsbwfsShortcodeClass {
	   /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
			add_shortcode( 'csbwfs_buttons', array(&$this, 'csbwfs_shortcode_func' ) );
			add_filter( 'widget_text', 'do_shortcode' );
        } // END public function __construct
        
        
       public function csbwfs_shortcode_style_func() {
			echo '<style type="text/css">.csbwfs-shortcode a{box-shadow:inherit}.csbwfs-shortcode a i{display:inline-block;position:relative;width:35px;height:36px;background-image:url('.plugin_dir_url( __FILE__ ).'../images/minify-social.png)}.csbwfs-shortcode{display:inline-block;position:relative;width:auto;}.csbwfs-shortcode i.csbwfs_facebook{background-position:68% 4%}.csbwfs-shortcode i.csbwfs_twitter{background-position:14% 4%}.csbwfs-shortcode i.csbwfs_plus{background-position:80% 4%}.csbwfs-shortcode i.csbwfs_linkedin{background-position:92% 4%}.csbwfs-shortcode i.csbwfs_pinterest{background-position:14% 19%}.csbwfs-shortcode i.csbwfs_youtube{background-position:32% 4%}.csbwfs-shortcode i.csbwfs_reddit{background-position:26% 19%}.csbwfs-shortcode i.csbwfs_stumbleupon{background-position:44% 19%}.csbwfs-shortcode i.csbwfs_mail{background-position:8% 19%}.csbwfs-shortcode i.csbwfs_skype {background-position: 38% 19%;}</style>';
		}

	   public static function csbwfs_shortcode_func($atts) {
		//[csbwfs_buttons buttons='fb,tw,li,pi,yt,re,st,ml']
		$shortcode_html = '';
		$btnsordaryy = isset($atts['buttons']) ? explode(',',$atts['buttons']) : array();
		$class = isset($atts['class']) ? $atts['class'] : '';
		if(is_array($btnsordaryy) && count($btnsordaryy) > 0 ){
			add_action( 'wp_footer', array(&$this,'csbwfs_shortcode_style_func' ));
			$shortcode_html .= '<div id="csbwfs-shortcode" class="'.$class.'">';
				foreach($btnsordaryy as $btnsVal)
				{
						/** FB */
						if($btnsVal=='fb'):
						$shortcode_html .='<div id="csbwfs-fb" class="csbwfs-shortcode"><a href="javascript:" onclick="javascript:window.open(\'//www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title)+\'&jump=close\', \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;" target="_blank" ><i class="csbwfs_facebook"></i></a></div>';
						endif;
						/** TW */
						if($btnsVal=='tw'):
						$shortcode_html .='<div id="csbwfs-tw" class="csbwfs-shortcode"><a href="javascript:" onclick="window.open(\'//twitter.com/share?url=\'+encodeURIComponent(location.href)+\'&text=\'+encodeURIComponent(document.title)+\'&jump=close\',\'_blank\',\'width=800,height=300\')" ><i class="csbwfs_twitter"></i></a></div>';

						endif;

						/**  LI */
						if($btnsVal=='li'):
						$shortcode_html .='<div id="csbwfs-li" class="csbwfs-shortcode"><a href="javascript:" onclick="javascript:window.open(\'//www.linkedin.com/shareArticle?mini=true&url=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title)+\'&jump=close\',\'\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800\');return false;" ><i class="csbwfs_linkedin"></i></a></div>';
						endif;

						/** PIN */
						if($btnsVal=='pi'):
						$shortcode_html .='<div id="csbwfs-pin" class="csbwfs-shortcode"><a onclick="javascript:void((function(){var e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'//assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)})());" href="javascript:void(0);"><i class="csbwfs_pinterest"></i></a></div>';
						endif;

						/** Reddit */
						if($btnsVal=='re'):
						$shortcode_html .='<div id="csbwfs-re" class="csbwfs-shortcode"><a onclick="window.open(\'//reddit.com/submit?url=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title)+\'&jump=close\',\'Reddit\',\'toolbar=0,status=0,width=1000,height=800\');" href="javascript:void(0);"><i class="csbwfs_reddit"></i></a></div>';
						endif;

						/** Stumbleupon/Mix */
						if($btnsVal=='st'):
						$shortcode_html .='<div id="csbwfs-st" class="csbwfs-shortcode"><a onclick="window.open(\'//mix.com/mixit?su=submit&url=\'+encodeURIComponent(location.href)+\'&title=\'+encodeURIComponent(document.title)+\'&jump=close\',\'Mix\',\'toolbar=0,status=0,width=1000,height=800\');"  href="javascript:void(0);"><i class="csbwfs_stumbleupon"></i></a></div>';
						endif; 
						/** YT */	 	 
						if($btnsVal=='yt'):
						$shortcode_html .='<div id="csbwfs-yt" class="csbwfs-shortcode"><a onclick="window.open(\''.get_option('csbwfs_ytPath').'\');" href="javascript:void(0);"><i class="csbwfs_youtube"></i></a></div>';
						endif;
						/** Skype */	 	 
						if($btnsVal=='sk'):
						$shortcode_html .='<div id="csbwfs-sk" class="csbwfs-shortcode"><a href="skype:'.get_option('csbwfs_skPath').'"><i class="csbwfs_skype"></i></a></div>';
						endif;
						/** Mail*/
						if($btnsVal=='ml'):
						$shortcode_html .='<div id="csbwfs-ml" class="csbwfs-shortcode"><a onclick="javascript:window.location=(\'mailto:'.get_bloginfo('admin_email').'\'+\'?subject=\'+encodeURIComponent(document.title)+\'&body=\'+encodeURIComponent(location.href));"  href="javascript:void(0);"  ><i class="csbwfs_mail"></i></a></div>';
						endif;
				}		
				$shortcode_html .='</div>'; //End #csbwfs-shortcode	
	  }	
		return $shortcode_html;
	}
 }
//init class
new CsbwfsShortcodeClass(); //init
endif;
