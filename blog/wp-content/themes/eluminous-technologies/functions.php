<?php
/**
 * eluminous-technologies functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eluminous-technologies
 */

if ( ! function_exists( 'eluminous_technologies_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eluminous_technologies_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on eluminous-technologies, use a find and replace
		 * to change 'eluminous-technologies' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eluminous-technologies', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'eluminous-technologies' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'eluminous_technologies_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'eluminous_technologies_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eluminous_technologies_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'eluminous_technologies_content_width', 640 );
}
add_action( 'after_setup_theme', 'eluminous_technologies_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eluminous_technologies_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'eluminous-technologies' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'eluminous-technologies' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'eluminous_technologies_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eluminous_technologies_scripts() {
	wp_enqueue_style( 'eluminous-technologies-style', get_stylesheet_uri() );

	wp_enqueue_script( 'eluminous-technologies-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'eluminous-technologies-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eluminous_technologies_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* change  excerpt Lenght */
function custom_excerpt_length( $length ) {
	return 12;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function wpdocs_excerpt_more( $more ) {
    return "...";
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


// add submenu for header address
add_action('admin_menu', 'elu_theme_settings');
function elu_theme_settings() {
	 add_menu_page('Theme Options', 'Theme Options', 'manage_options', 'elu_settings', 'elu_theme_options');	
}

function elu_theme_options(){
	require_once("theme_options/dashboard.php");
}

//length for title
function elu_shorten_title( $title ) {
	$newTitle = substr( $title, 0, 40 ); // Only take the first 40 characters
	return $newTitle . "..."; // Append the elipsis to the text (...) 
}

//category short code
add_shortcode('all_categories', 'show_categories');
function show_categories(){ ?>
	<!-- category listing -->
<section class="category gray_bg" id="category">
	<div class="container">
		<h2 class="text-center">Featured Blogs</h2> 
		<div class="row justify-content-center">
		<?php
			$arrayCategories = get_categories();
			foreach($arrayCategories as $category) {

			$intId = $category->term_id;
			$strDescription = $category->description;
			$image_url = z_taxonomy_image_url( $intId, NULL, TRUE );
		?> 
			<div class="compe_wrapper">
				<a href="<?php echo get_category_link($intId); ?>">
					<div class="servises_images">
						<img src="<?php echo $image_url; ?>"/>
					</div>
				<h5><span>
				<?php      
					$strCatName = $category->name; 
					$string = explode(' ', $strCatName)[0];
					$string2 = explode(' ', $strCatName)[1];
					$strCat = '<b>'.$string.'</b><br/>'.$string2;       
				?>
				<?php echo $strCat; ?>
	      		</span></h5>
	      		</a>
			</div> 

		<?php } ?>
		</div>
	</div>
</section>
<!-- category listing -->
<?php }