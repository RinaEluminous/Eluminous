<?php
/**
 * Sticky Popup Class
 *
 * @package   Sticky_Popup
 * @author    Numix Technologies <numixtech@gmail.com>
 * @author    Gaurav Padia <gauravpadia14u@gmail.com>
 * @author    Asalam Godhaviya <godhaviya.asalam@gmail.com>
 * @license   GPL-2.0+
 * @link      http://numixtech.com
 * @copyright 2014 Numix Techonologies
 */

/**
 * @package Sticky_Popup
 * @author  Numix Technologies <numixtech@gmail.com>
 * @author  Gaurav Padia <gauravpadia14u@gmail.com>
 * @author  Asalam Godhaviya <godhaviya.asalam@gmail.com>
 */
class Sticky_Popup {
	
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 * 
	 * @since 1.0
	 *
	 * @var string
	 */
	const VERSION = '1.2';

	/**
	 * Unique identifier for plugin.
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $plugin_slug = 'sticky_popup';

	/**
	 * Instance of this class.
	 *
	 * @since 1.0
	 * 
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Stores popup active status
	 *
	 * @since 1.2
	 * 
	 * @var string
	 */
	protected $popup_active;

	/**
	 * Stores popup title option
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $popup_title;

	/**
	 * Stores popup title Colour
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $popup_title_color;

	/**
	 * Stores popup icon url
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $popup_title_image;

	/**
	 * Stores popup header color
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $popup_header_color;

	/**
	 * Stores popup header border color
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $popup_header_border_color;

	/**
	 * Stores popup place
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $popup_place;

	/**
	 * Stores popup top margin in percentage
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $popup_top_margin;
	
	/**
	 * Stores popup content
	 *
	 * @since 1.0
	 * 
	 * @var string
	 */
	protected $popup_content;

	/**
	 * Stores popup option for show in homepage
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $show_on_homepage;	

	/**
	 * Stores popup option for show in posts
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $show_on_posts;

	/**
	 * Stores popup option for show in pages
	 *
	 * @since 1.1
	 * 
	 * @var string
	 */
	protected $show_on_pages;

	/**
	 * Initialize the plugin by loading public scripts and styels or admin page
	 *
	 * @since 1.0
	 */
	public function __construct() {

		$this->popup_active = get_option( 'sp_popup_active' );
		$this->popup_title  = get_option( 'sp_popup_title' );
		$this->popup_title_color  = get_option( 'sp_popup_title_color' );
		$this->popup_title_image = get_option( 'sp_popup_title_image' );
		$this->popup_header_color = get_option( 'sp_popup_header_color' );
		$this->popup_header_border_color = get_option( 'sp_popup_header_border_color' );
		$this->popup_place = get_option( 'sp_popup_place' );
		$this->popup_top_margin = get_option( 'sp_popup_top_margin' );
		$this->popup_content = get_option( 'sp_popup_content' );

		$this->show_on_homepage = get_option( 'sp_show_on_homepage' );
		$this->show_on_posts = get_option( 'sp_show_on_posts' );
		$this->show_on_pages = get_option( 'sp_show_on_pages' );
		if ( is_admin() ) {
			// Add the settings page and menu item.
			add_action( 'admin_menu', array( $this, 'plugin_admin_menu' ) );
			// Add an action link pointing to the settings page.
			$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_slug . '.php' );
			add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		} else {

			add_action( 'wp', array( $this, 'load_sticky_popup' ) );
		}
	}

	public function load_sticky_popup () {
		
		$show_sticky_poup=false;
		if($this->popup_active)
		{
			if($this->show_on_homepage!=1 && $this->show_on_posts!=1 && $this->show_on_pages!=1 )
			{
				$show_sticky_poup=true;
					
			}
			else
			{				
				if( $this->show_on_homepage==1 && is_front_page() )
				{
					$show_sticky_poup=true;					
				}
				if( $this->show_on_posts==1 && ( is_single() || is_home() || is_archive() ) )
				{
					$show_sticky_poup=true;	
				}
				if( $this->show_on_pages==1 && is_page() )
				{
					$show_sticky_poup=true;
				}
			}
			if($show_sticky_poup)
			{
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'wp_head', array( $this, 'head_styles' ) );
				add_filter( 'wp_footer', array( $this, 'get_sticky_popup' ) );
				add_action( 'wp_footer', array( $this, 'footer_scripts' ) );
			}
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0
	 * 
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register the settings menu for this plugin into the WordPress Settings menu.
	 * 
	 * @since 1.0
	 */
	public function plugin_admin_menu() {
		add_options_page( __( 'Sticky Popup Settings', 'sticky-popup' ), __( 'Sticky Popup', 'sticky-popup' ), 'manage_options', $this->plugin_slug, array( $this, 'sticky_popup_options' ) );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {
	
		$screen = get_current_screen();
		if ( 'settings_page_'.$this->plugin_slug == $screen->id ) {			
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), Sticky_Popup::VERSION );
			wp_enqueue_media();        	
		}
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since  1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {
		
		$screen = get_current_screen();		
		if ( 'settings_page_'.$this->plugin_slug == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug . '-admin-style', plugins_url( 'css/admin.css', __FILE__ ), Sticky_Popup::VERSION );
			wp_enqueue_style( 'wp-color-picker' );
		}		
	}

	/**
	 * Add settings action link to the plugins page.
	 * 
	 * @param array $links
	 *
	 * @since 1.0
	 *
	 * @return array Plugin settings links
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);	
	}

	/**
	 * Render the settings page for this plugin.
	 * 
	 * @since 1.0
	 */
	public function sticky_popup_options() {
		if ( ! current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ( ! empty( $_POST ) && check_admin_referer( 'sticky_popup', 'save_sticky_popup' ) ) {


			

			//add or update sticky popup active stats
			if ( $this->popup_active !== false ) {
				update_option( 'sp_popup_active', $_POST['popup_active'] );
			} else {
				add_option( 'sp_popup_active', $_POST['popup_active'], null, 'no' );
			}

			//add or update sticky popup title options
			if ( $this->popup_title !== false ) {
				update_option( 'sp_popup_title', $_POST['popup_title'] );
			} else {
				add_option( 'sp_popup_title', $_POST['popup_title'], null, 'no' );
			}			
			//add or update sticky popup title colour since version 1.1
			if ( $this->popup_title_color !== false ) {
				update_option( 'sp_popup_title_color', $_POST['popup_title_color'] );
			} else {
				add_option( 'sp_popup_title_color', $_POST['popup_title_color'], null, 'no' );
			}
			//add or update sticky popup title icon
			if ( $this->popup_title_image !== false ) {
				update_option( 'sp_popup_title_image', $_POST['popup_title_image'] );
			} else {
				add_option( 'sp_popup_title_image', $_POST['popup_title_image'], null, 'no' );
			}
			//add or update sticky popup header color
			if ( $this->popup_header_color !== false ) {
				update_option( 'sp_popup_header_color', $_POST['popup_header_color'] );
			} else {
				add_option( 'sp_popup_header_color', $_POST['popup_header_color'], null, 'no' );
			}
			
			//add or update sticky popup header border color since version 1.1
			if ( $this->popup_header_border_color !== false ) {
				update_option( 'sp_popup_header_border_color', $_POST['popup_header_border_color'] );
			} else {
				add_option( 'sp_popup_header_border_color', $_POST['popup_header_border_color'], null, 'no' );
			}

			//add or update sticky popup place
			if ( $this->popup_place !== false ) {
				update_option( 'sp_popup_place', $_POST['popup_place'] );
			} else {
				add_option( 'sp_popup_place', $_POST['popup_place'], null, 'no' );
			}
			//add or update sticky popup Top Margin when position is left or right included since 1.1
			if ( $this->popup_top_margin !== false ) {
				update_option( 'sp_popup_top_margin', $_POST['popup_top_margin'] );
			} else {
				add_option( 'sp_popup_top_margin', $_POST['popup_top_margin'], null, 'no' );
			}
			//add or update sticky popup content
			if ( $this->popup_content !== false ) {				
				update_option( 'sp_popup_content', wp_unslash( $_POST['popup_content'] ) );
			} else {
				add_option( 'sp_popup_content', wp_unslash( $_POST['popup_content'] ), null, 'no' );
			}

			//add or update sticky popup option for show on homepage
			if ( $this->show_on_homepage !== false ) {				
				update_option( 'sp_show_on_homepage', wp_unslash( $_POST['show_on_homepage'] ) );
			} else {
				add_option( 'sp_show_on_homepage', wp_unslash( $_POST['show_on_homepage'] ), null, 'no' );
			}

			//add or update sticky popup option for show on posts
			if ( $this->show_on_posts !== false ) {				
				update_option( 'sp_show_on_posts', wp_unslash( $_POST['show_on_posts'] ) );
			} else {
				add_option( 'sp_show_on_posts', wp_unslash( $_POST['show_on_posts'] ), null, 'no' );
			}

			//add or update sticky popup option for show on pages
			if ( $this->show_on_pages !== false ) {				
				update_option( 'sp_show_on_pages', wp_unslash( $_POST['show_on_pages'] ) );
			} else {
				add_option( 'sp_show_on_pages', wp_unslash( $_POST['show_on_pages'] ), null, 'no' );
			}

			wp_redirect( admin_url( 'options-general.php?page='.$_GET['page'].'&updated=1' ) );
		}
		?>
		<div class="wrap">
			<h2><?php _e( 'Sticky Popup Settings', 'sticky-popup' );?></h2>
			<form method="post" action="<?php echo esc_url( admin_url( 'options-general.php?page='.$_GET['page'].'&noheader=true' ) ); ?>" enctype="multipart/form-data">
				<?php wp_nonce_field( 'sticky_popup', 'save_sticky_popup' ); ?>
				<div class="sticky_popup_form">
					<table class="form-table" width="100%">
						<tr>
							<th scope="row"></th>
							<td>								
								<input type="checkbox" name="popup_active" id="popup_active" value="1" <?php if($this->popup_active)  echo 'checked="checked"'; else '';?>>&nbsp;<label for="popup_active"><strong><?php _e( 'Enable', 'sticky-popup' );?></strong></label></td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_title"><?php _e( 'Popup Title', 'sticky-popup' );?></label></th>
							<td><input type="text" name="popup_title" id="popup_title" maxlength="255" size="25" value="<?php echo $this->popup_title; ?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_title_color"><?php _e( 'Popup Title Color', 'sticky-popup' );?></label></th>
							<td><input type="text" name="popup_title_color" id="popup_title_color" maxlength="255" size="25" value="<?php echo $this->popup_title_color; ?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_title_image"><?php _e( 'Popup Title Right Side Icon', 'sticky-popup' );?></label></th>
							<td><input type="text" name="popup_title_image" id="popup_title_image" maxlength="255" size="25" value="<?php echo $this->popup_title_image; ?>"><input id="popup_title_image_button" class="button" type="button" value="Upload Image" />
	    					<br />Enter a URL or upload an image</td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_header_color"><?php _e( 'Popup Header Color', 'sticky-popup' );?></label></th>
							<td><input type="text" name="popup_header_color" id="popup_header_color" maxlength="255" size="25" value="<?php echo $this->popup_header_color; ?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_header_border_color"><?php _e( 'Popup Header Border Color', 'sticky-popup' );?></label></th>
							<td><input type="text" name="popup_header_border_color" id="popup_header_border_color" maxlength="255" size="25" value="<?php echo $this->popup_header_border_color; ?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="popup_place"><?php _e( 'Popup Place', 'sticky-popup' );?></label></th>
							<td><select name="popup_place" id="popup_place">
							<?php foreach ( $this->get_popup_place() as $key => $value ): ?>
							<option value="<?php esc_attr_e( $key ); ?>"<?php esc_attr_e( $key == $this->popup_place ? ' selected="selected"' : '' ); ?>><?php esc_attr_e( $value ); ?></option>
							<?php endforeach;?>
						</select></td>
						</tr>
						
						<tr>
							<th scope="row"><label for="popup_top_margin"><?php _e( 'Popup Top Margin', 'sticky-popup' );?></label></th>
							<td><input type="number" name="popup_top_margin" id="popup_top_margin" maxlength="255" size="25" value="<?php echo $this->popup_top_margin; ?>">%<br>
								<small>Top margin is only included if popup place Left or Right is selected. Please enter numeric value.</td>
						</tr>

						<tr>
							<th></th>
							<td>
								<table border="0">
									<tr>
										<td><input type="checkbox" name="show_on_homepage" value="1" <?php if($this->show_on_homepage==1) echo 'checked="checked"';?> ><label for="show_on_homepage"><?php _e( 'Show on Homepage', 'sticky-popup' );?></label><br><br>
										<input type="checkbox" name="show_on_posts" value="1" <?php if($this->show_on_posts==1) echo 'checked="checked"';?> ><label for="show_on_posts"><?php _e( 'Show on Posts', 'sticky-popup' );?></label>
										<br><br>
										<input type="checkbox" name="show_on_pages" value="1" <?php if($this->show_on_pages==1) echo 'checked="checked"';?> ><label for="show_on_pages"><?php _e( 'Show on Pages', 'sticky-popup' );?></label>
									</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<th scope="row"><label for="popup_content"><?php _e( 'Popup Content', 'sticky-popup' );?><br></label><small><?php _e( 'you can add shortcode or html', 'sticky-popup' );?></small></th>
							<td></td>
						</tr>		
						<tr>
							<td colspan="2">
								<div style="100%;">
									<?php 							
									$args = array(
										'textarea_name' => 'popup_content',
									    'textarea_rows' => 10,
									    'editor_class'	=> 'sp_content',
									    'wpautop'		=> true,
									);
									wp_editor( $this->popup_content, 'popup_content', $args ); 
									?>
								</div>
							</td>
						</tr>			
					</table>
					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ) ?>" />
					</p>
				</div>
			</form>
			<?php
			$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) );
			?>
			<p>
				<a href="http://wordpress.org/plugins/numix-post-slider/" target="_blank"><img src="<?php echo plugins_url( $plugin_basename ); ?>/images/numix_post_slider.png" /></a>
			</p>
		</div>
		<?php
	}	

	/**
	 * Returns list of Popup Place
	 * 
	 * @since 1.0
	 *
	 * @return array Popup Place
	 */
	public function get_popup_place() {
		return array(
				'right-bottom' => 'Right Bottom',
				'left-bottom' => 'Left Bottom',
				'top-left' => 'Top Left',
				'top-right' => 'Top Right',				
				'right' => 'Right',
				'left' => 'Left',				
			);
	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since 1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-style', plugins_url( 'css/sticky-popup.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since 1.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-modernizr-script', plugins_url( 'js/modernizr.custom.js', __FILE__ ), array(), self::VERSION );		
	}

	/**
	 * Print popup html code
	 *	 
	 * @since 1.0
	 */
	public function get_sticky_popup(){
		$this->popup_active = get_option( 'sp_popup_active' );
		$this->popup_place  = get_option( 'sp_popup_place' );
		$this->popup_title  = get_option( 'sp_popup_title' );
		$this->popup_title_color  = get_option( 'sp_popup_title_color' );
		$this->popup_title_image = get_option( 'sp_popup_title_image' );
		$this->popup_header_color = get_option( 'sp_popup_header_color' );
		$this->popup_header_border_color = get_option( 'sp_popup_header_border_color' );
		$this->popup_top_margin = get_option( 'sp_popup_top_margin' );
		$this->popup_content = get_option( 'sp_popup_content' );
		$this->show_on_homepage = get_option( 'sp_show_on_homepage' );
		$this->show_on_posts = get_option( 'sp_show_on_posts' );
		$this->show_on_pages = get_option( 'sp_show_on_pages' );

		$popup_html  = '<div class="sticky-popup">';
		$popup_html .= '<div class="popup-wrap">';
		if($this->popup_place!='top-left' && $this->popup_place!='top-right')
		{
			$popup_html .= '<div class="popup-header">';
			$popup_html .= '<span class="popup-title">';
			if( $this->popup_title != '') {
				$popup_html .= $this->popup_title;
			}
			$popup_html .= '<div class="popup-image">';
			if( $this->popup_title_image != '') {
				$popup_html .= '<img src="'.$this->popup_title_image.'">';	
			}
			$popup_html .= '</div>';
			$popup_html .= '</span>';
			$popup_html .= '</div>';
		}
		
		$popup_html .= '<div class="popup-content">';
		$popup_html .= '<div class="popup-content-pad">';
		if( $this->popup_content != '') {

			$this->popup_content = apply_filters('the_content', $this->popup_content );
			$this->popup_content = str_replace( ']]>', ']]&gt;', $this->popup_content );
			$popup_html .= $this->popup_content;			
		}
		$popup_html .= '</div>';
		$popup_html .= '</div>';

		if($this->popup_place == 'top-left' || $this->popup_place == 'top-right')
		{
			$popup_html .= '<div class="popup-header">';
			$popup_html .= '<span class="popup-title">';
			if( $this->popup_title != '') {
				$popup_html .= $this->popup_title;
			}
			$popup_html .= '<div class="popup-image">';
			if( $this->popup_title_image != '') {
				$popup_html .= '<img src="'.$this->popup_title_image.'">';	
			}
			$popup_html .= '</div>';
			$popup_html .= '</span>';
			$popup_html .= '</div>';
		}

		$popup_html .= '</div>';
		$popup_html .= '</div>';
		echo $popup_html;
	}

	/**
	 * Add styles for popup header color
	 * 
	 * @since 1.0
	 */
	public function head_styles() {
		$this->popup_title_color = get_option( 'sp_popup_title_color' );
		$this->popup_header_color = get_option( 'sp_popup_header_color' );
		$this->popup_header_border_color = get_option( 'sp_popup_header_border_color' );
		$this->popup_place = get_option( 'sp_popup_place' );
		$this->popup_top_margin = get_option( 'sp_popup_top_margin' );
		?>
		<style type="text/css">
			.sticky-popup .popup-header
			{
			<?php
			if( $this->popup_header_color !='' ) {
			?>	
				background-color : <?php echo $this->popup_header_color; ?>;		
			<?php
			} else {
			?>
				background-color : #2C5A85;		
			<?php
			}
			?>
			<?php
			if( $this->popup_header_border_color !='' ) {
			?>	
				border-color : <?php echo $this->popup_header_border_color; ?>;		
			<?php
			} else {
			?>
				background-color : #2c5a85;		
			<?php
			}
			?>			
		}
		.popup-title
		{
			<?php
			if( $this->popup_title_color !='' ) {
			?>	
				color : <?php echo $this->popup_title_color; ?>;		
			<?php
			} else {
			?>
				color : #ffffff;		
			<?php
			}
			?>
		}
		<?php
		if($this->popup_place == 'left' || $this->popup_place == 'right')
		{
		?>
			.sticky-popup-right, .sticky-popup-left
			{
				<?php
				if( $this->popup_top_margin !='' ) {
				?>	
					top : <?php echo $this->popup_top_margin; ?>%;		
				<?php
				} else {
				?>
					top : 25%;		
				<?php
				}
				?>
			}

		<?php } ?>
		</style>
		<?php
	}

	/**
	 * Add Javascript for popup place
	 * 
	 * @since 1.0
	 */
	public function footer_scripts() {
		if( $this->popup_place == 'right-bottom' ){			
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					jQuery( ".sticky-popup" ).addClass('right-bottom');
					var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
			      	jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );

			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-up");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "bottom", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php	
		} elseif( $this->popup_place == 'left-bottom' ) {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					jQuery( ".sticky-popup" ).addClass('left-bottom');
					var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
			      	jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );

			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-up");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "bottom", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		} elseif( $this->popup_place == 'left' ) {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					if (/*@cc_on!@*/true) {						
						var ieclass = 'ie' + document.documentMode; 
						jQuery( ".popup-wrap" ).addClass(ieclass);
					} 
					jQuery( ".sticky-popup" ).addClass('sticky-popup-left');
					var contwidth = jQuery( ".popup-content" ).outerWidth()+2;      	
			      	jQuery( ".sticky-popup" ).css( "left", "-"+contwidth+"px" );

			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup_left");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-left");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "left", "-"+contwidth+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "left", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		} elseif( $this->popup_place == 'right' ) {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					if (/*@cc_on!@*/true) { 						
						var ieclass = 'ie' + document.documentMode; 
						jQuery( ".popup-wrap" ).addClass(ieclass);
					} 
					jQuery( ".sticky-popup" ).addClass('sticky-popup-right');
					
					var contwidth = jQuery( ".popup-content" ).outerWidth()+2;      	
			      	jQuery( ".sticky-popup" ).css( "right", "-"+contwidth+"px" );

			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup_right");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-right");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "right", "-"+contwidth+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "right", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		} elseif( $this->popup_place == 'top-left' ) {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					jQuery( ".sticky-popup" ).addClass('top-left');
					var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
			      	jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
					
			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup_top");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-down");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "top", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		} elseif( $this->popup_place == 'top-right' ) {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					jQuery( ".sticky-popup" ).addClass('top-right');
					var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
			      	jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
					
			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup_top");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-down");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "top", "-"+contheight+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "top", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		} else {
		?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {	
					jQuery( ".sticky-popup" ).addClass('right-bottom');
					var contheight = jQuery( ".popup-content" ).outerHeight()+2;      	
			      	jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );

			      	jQuery( ".sticky-popup" ).css( "visibility", "visible" );

			      	jQuery('.sticky-popup').addClass("open_sticky_popup");
			      	jQuery('.sticky-popup').addClass("popup-content-bounce-in-up");
			      	
			        jQuery( ".popup-header" ).click(function() {
			        	if(jQuery('.sticky-popup').hasClass("open"))
			        	{
			        		jQuery('.sticky-popup').removeClass("open");
			        		jQuery( ".sticky-popup" ).css( "bottom", "-"+contheight+"px" );
			        	}
			        	else
			        	{
			        		jQuery('.sticky-popup').addClass("open");
			          		jQuery( ".sticky-popup" ).css( "bottom", 0 );		
			        	}
			          
			        });		    
				});
			</script>
		<?php
		}
	}
}