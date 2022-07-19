<?php
/**
 * eluminous functions and definitions
 *
 * @package eluminous
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 730; /* pixels */
}
/**
 * Set the content width for full width pages with no sidebar.
 */
function eluminous_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) || is_page_template( 'front-page.php' ) ) {
    global $content_width;
    $content_width = 1110; /* pixels */
  }
}
add_action( 'template_redirect', 'eluminous_content_width' );
if ( ! function_exists( 'eluminous_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eluminous_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on eluminous, use a find and replace
   * to change 'eluminous' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'eluminous', get_template_directory() . '/languages' );
  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );
  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'eluminous-featured', 730, 410, true );
  add_image_size( 'tab-small', 60, 60 , true); // Small Thumbnail
  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary'      => __( 'Primary Menu', 'eluminous' ),
    'footer-links' => __( 'Footer Links', 'eluminous' ) // secondary menu in footer
  ) );
  // Enable support for Post Formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
  // Setup the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'eluminous_custom_background_args', array(
    'default-color' => 'ffffff',
    'default-image' => '',
  ) ) );
  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );
}
endif; // eluminous_setup
add_action( 'after_setup_theme', 'eluminous_setup' );
/**
 * Register widgetized area and update sidebar with default widgets.
 */
function eluminous_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'eluminous' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
  register_sidebar(array(
    'id'            => 'home-widget-1',
    'name'          => __( 'Homepage Widget 1', 'eluminous' ),
    'description'   => __( 'Displays on the Home Page', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'id'            => 'home-widget-2',
    'name'          =>  __( 'Homepage Widget 2', 'eluminous' ),
    'description'   => __( 'Displays on the Home Page', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'id'            => 'home-widget-3',
    'name'          =>  __( 'Homepage Widget 3', 'eluminous' ),
    'description'   =>  __( 'Displays on the Home Page', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'id'            => 'footer-widget-1',
    'name'          =>  __( 'Footer Widget 1', 'eluminous' ),
    'description'   =>  __( 'Used for footer widget area', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'id'            => 'footer-widget-2',
    'name'          =>  __( 'Footer Widget 2', 'eluminous' ),
    'description'   =>  __( 'Used for footer widget area', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'id'            => 'footer-widget-3',
    'name'          =>  __( 'Footer Widget 3', 'eluminous' ),
    'description'   =>  __( 'Used for footer widget area', 'eluminous' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_widget( 'eluminous_social_widget' );
  register_widget( 'eluminous_popular_posts_widget' );
}
add_action( 'widgets_init', 'eluminous_widgets_init' );
include(get_template_directory() . "/inc/widgets/widget-popular-posts.php");
include(get_template_directory() . "/inc/widgets/widget-social.php");
/**
 * Enqueue scripts and styles.
 */
function eluminous_scripts() {
  wp_enqueue_style( 'eluminous-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );
  wp_enqueue_style( 'eluminous-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );
  if( ( is_home() || is_front_page() ) && of_get_option('eluminous_slider_checkbox') == 1 ) {
    wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
  }
  if ( class_exists( 'jigoshop' ) ) { // Jigoshop specific styles loaded only when plugin is installed
    wp_enqueue_style( 'jigoshop-css', get_template_directory_uri().'/inc/css/jigoshop.css' );
  }
  wp_enqueue_style( 'eluminous-style', get_stylesheet_uri() );
  wp_enqueue_script('eluminous-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );
  if( ( is_home() || is_front_page() ) && of_get_option('eluminous_slider_checkbox') == 1 ) {
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '2.5.0', true );
  }
  wp_enqueue_script( 'eluminous-main', get_template_directory_uri() . '/inc/js/main.js', array('jquery'), '1.5.4', true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'eluminous_scripts' );
/**
 * Add HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries
 */
function eluminous_ie_support_header() {
  echo '<!--[if lt IE 9]>'. "\n";
  echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/html5shiv.min.js' ) . '"></script>'. "\n";
  echo '<script src="' . esc_url( get_template_directory_uri() . '/inc/js/respond.min.js' ) . '"></script>'. "\n";
  echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'eluminous_ie_support_header', 11 );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Load custom nav walker
 */
require get_template_directory() . '/inc/navwalker.php';
if ( class_exists( 'woocommerce' ) ) {
/**
 * WooCommerce related functions
 */
require get_template_directory() . '/inc/woo-setup.php';
}
if ( class_exists( 'jigoshop' ) ) {
/**
 * Jigoshop related functions
 */
require get_template_directory() . '/inc/jigoshop-setup.php';
}
/**
 * Metabox file load
 */
require get_template_directory() . '/inc/metaboxes.php';
/**
 * Register Social Icon menu
 */
add_action( 'init', 'register_social_menu' );
function register_social_menu() {
  register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'eluminous' ) );
}
/* Globals variables */
global $options_categories;
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
}
global $site_layout;
$site_layout = array('side-pull-left' => esc_html__('Right Sidebar', 'eluminous'),'side-pull-right' => esc_html__('Left Sidebar', 'eluminous'),'no-sidebar' => esc_html__('No Sidebar', 'eluminous'),'full-width' => esc_html__('Full Width', 'eluminous'));
// Typography Options
global $typography_options;
$typography_options = array(
        'sizes' => array( '6px' => '6px','10px' => '10px','12px' => '12px','14px' => '14px','15px' => '15px','16px' => '16px','18px'=> '18px','20px' => '20px','24px' => '24px','28px' => '28px','32px' => '32px','36px' => '36px','42px' => '42px','48px' => '48px' ),
        'faces' => array(
                'arial'          => 'Arial,Helvetica,sans-serif',
                'verdana'        => 'Verdana,Geneva,sans-serif',
                'trebuchet'      => 'Trebuchet,Helvetica,sans-serif',
                'georgia'        => 'Georgia,serif',
                'times'          => 'Times New Roman,Times, serif',
                'tahoma'         => 'Tahoma,Geneva,sans-serif',
                'Open Sans'      => 'Open Sans,sans-serif',
                'palatino'       => 'Palatino,serif',
                'helvetica'      => 'Helvetica,Arial,sans-serif',
                'helvetica-neue' => 'Helvetica Neue,Helvetica,Arial,sans-serif'
        ),
        'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
        'color'  => true
);
// Typography Defaults
global $typography_defaults;
$typography_defaults = array(
        'size'  => '14px',
        'face'  => 'helvetica-neue',
        'style' => 'normal',
        'color' => '#6B6B6B'
);
/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {
  $option_name = '';
  // Get option settings from database
  $options = get_option( 'eluminous' );
  // Return specific option
  if ( isset( $options[$name] ) ) {
    return $options[$name];
  }
  return $default;
}
endif;
/* Custom function added by Akash*/
function wpdocs_custom_excerpt_length( $length ) {
    return 75;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
function pagination_nav() {
   global $wp_query;
 
    $total_pages = $wp_query->max_num_pages;
 
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
 
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
			'mid_size'		=>2,
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
//mod content
function hatom_mod_post_content ($content) {
  if ( in_the_loop() && !is_page() ) {
    $content = '<span class="entry-content">'.$content.'</span>';
  }
  return $content;
}
add_filter( 'the_content', 'hatom_mod_post_content');
//add hatom datato remove the hatom issue.
function add_mod_hatom_data($content) {
	$t = get_the_modified_time('F jS, Y');
	$author = get_the_author();
	$title = get_the_title();
	if(is_single()) {
		$content .= '<div class="hatom-extra"><span class="entry-title">'.$title.'</span> was last modified: <span class="updated"> '.$t.'</span> by <span class="author vcard"><span class="fn">'.$author.'</span></span></div>';
	}
	return $content;
	}
add_filter('the_content', 'add_mod_hatom_data');
function themeslug_remove_hentry( $classes ) {
    if ( is_page() ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
    return $classes;
}
add_filter( 'post_class','themeslug_remove_hentry' );

//add_action( 'wp_head','changeLogoUrl' );
function changeLogoUrl()
{
  ?><script type="text/javascript">
    jQuery( document ).ready(function() {
      
      jQuery("#logo a").attr("href", "https://beta.eluminoustechnologies.com")
      jQuery("#menu-item-1331 a").attr("href", "https://beta.eluminoustechnologies.com")
      jQuery("#menu-item-1559 a").attr("href", "https://beta.eluminoustechnologies.com/about-us.php")
      jQuery("#menu-item-1574 a").attr("href", "https://beta.eluminoustechnologies.com/contact.php")
    });
  </script>
  
 <?php
 
}
?>