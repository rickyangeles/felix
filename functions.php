<?php
/**
 * Felix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Felix
 */


require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/rickyangeles/felix',
	__FILE__,
	'felix'
);
$myUpdateChecker->getVcsApi()->enableReleaseAssets();


/* Getting bootstrap nav walker */

function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


if ( ! function_exists( 'felix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function felix_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Felix, use a find and replace
		 * to change 'felix' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'felix', get_template_directory() . '/languages' );

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
		/* Custom Image sizes */
		add_image_size( 'logo', 0, 100 );
		add_image_size( 'page-header', 1300, 400 );
		add_image_size( 'post-thumbnail', 240, 180, true );
		add_image_size( 'column_image_three', 350, 262, true );
		add_image_size( 'column_image_four', 255, 191, true );
		add_image_size( 'slideshow_image', 570, 427, true );
		add_image_size( 'slider_image', 1200, 900, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'felix' ),
			'top-menu' => esc_html__( 'Top Menu', 'felix' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'felix' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'felix' ),
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
		add_theme_support( 'custom-background', apply_filters( 'felix_custom_background_args', array(
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
add_action( 'after_setup_theme', 'felix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function felix_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'felix_content_width', 640 );
}
add_action( 'after_setup_theme', 'felix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function felix_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'felix' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'felix' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'felix_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function felix_scripts() {

	//google font
	wp_enqueue_style( 'google-font-nunito', 'https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,600;1,400&display=swap', array(), null);
	wp_enqueue_style( 'font-awesome-5', 'https://pro.fontawesome.com/releases/v5.12.0/css/all.css', array(), null );
	add_action( 'enqueue_block_editor_assets', 'font-awesome-5' );
	wp_enqueue_style( 'felix-style', get_stylesheet_uri() );
	wp_enqueue_style( 'mmenu', get_template_directory_uri() . '/css/mmenu.css');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'starter', get_template_directory_uri() . '/css/starter.min.css' );

	if ( is_user_logged_in() ) {
		wp_enqueue_style( 'admin', get_template_directory_uri() . '/css/admin.min.css' );
	}

	wp_enqueue_script( 'jQuery', 'https://code.jquery.com/jquery-3.4.1.min.js');
	wp_enqueue_script( 'starter', get_template_directory_uri() . '/js/starter.min.js');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script( 'felix-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'felix-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'mmenu', get_template_directory_uri() . '/js/mmenu.js');
	wp_enqueue_script( 'starter', get_template_directory_uri() . '/js/starter.min.js');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'felix_scripts' );


// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'gutenberg_editor_assets');
function gutenberg_editor_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style('my-gutenberg-editor-styles', get_theme_file_uri('/css/admin.min.css'), FALSE);
	wp_enqueue_style('bootstrap-editor-css', get_theme_file_uri('/css/bootstrap.min.css'), FALSE);
	//wp_enqueue_style( 'starter', get_template_directory_uri() . '/css/starter.min.css' );
}
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
 * Get custom Functions
 **/

 require get_template_directory() . '/inc/custom-functions.php';
 require get_template_directory() . '/inc/custom-widgets.php';
 require get_template_directory() . '/inc/blocks.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


if (is_user_logged_in()) {
	require get_template_directory() . '/inc/browser.php';
}
if( function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
 	   'menu_title'	=> 'Theme Settings',
 	   'menu_slug' 	=> 'theme-settings',
 	   'capability'	=> 'edit_posts',
 	   'redirect'		=> false
    ));
}

if( function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Global Content',
 	   'menu_title'	=> 'Global Content',
 	   'menu_slug' 	=> 'global-content',
 	   'capability'	=> 'edit_posts',
 	   'redirect'		=> false
    ));
}

function add_font_awesome_5_cdn_attributes( $html, $handle ) {
    if ( 'font-awesome-5' === $handle ) {
        return str_replace( "media='all'", "media='all' integrity='sha384-ekOryaXPbeCpWQNxMwSWVvQ0+1VrStoPJq54shlYhR8HzQgig1v5fas6YgOqLoKz' crossorigin='anonymous'", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'add_font_awesome_5_cdn_attributes', 10, 2 );


//Adding Color Palettes to the editor
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Primary', 'genesis-sample' ),
		'slug'  => 'primary',
		'color'	=> '#3D5A80',
	),
	array(
		'name'  => __( 'Secondary', 'genesis-sample' ),
		'slug'  => 'secondary',
		'color' => '#EE6C4D',
	),
	array(
		'name'  => __( 'Light', 'genesis-sample' ),
		'slug'  => 'light',
		'color' => '#E0FBFC',
	),
	array(
		'name'  => __( 'White', 'genesis-sample' ),
		'slug'  => 'white',
		'color' => '#ffffff',
	),
	array(
		'name'  => __( 'Dark', 'genesis-sample' ),
		'slug'  => 'dark',
		'color' => '#293241',
	),
) );

// Disables custom colors in block color palette.
add_theme_support( 'disable-custom-colors' );

add_action('get_header', 'my_filter_head');

function my_filter_head() {
   remove_action('wp_head', '_admin_bar_bump_cb');
}
