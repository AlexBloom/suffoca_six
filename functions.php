<?php
/**
 * Suffoca Six functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Suffoca_Six
 */

if ( ! function_exists( 'suffoca_six_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function suffoca_six_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Suffoca Six, use a find and replace
	 * to change 'suffoca_six' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'suffoca_six', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'suffoca_six' ),
		'filters' => esc_html__( 'Filter Menu', 'suffoca_six' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'suffoca_six_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // suffoca_six_setup
add_action( 'after_setup_theme', 'suffoca_six_setup' );



/*
 * ============================= WOOCOMMERCE DECLARATIONS
 */

// remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
// remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
// add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

// function my_theme_wrapper_start() {
//   echo '<section id="main">';
// }

// function my_theme_wrapper_end() {
//   echo '</section>';
// }

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function suffoca_six_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'suffoca_six_content_width', 640 );
}
add_action( 'after_setup_theme', 'suffoca_six_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


function suffoca_six_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'suffoca_six' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Load More Footer Widget', 'suffoca_six' ),
		'id'            => 'footer-widget',
		'description'   => __( 'Add widget shortcode here to appear in the load more footer.', 'suffoca_six' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Instagram Widget', 'suffoca_six' ),
		'id'            => 'insta-widget',
		'description'   => __( 'Add widget shortcode here to appear in the insta area.', 'suffoca_six' ),
		'before_widget' => '<div id="%1$s" class="">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'suffoca_six_widgets_init' );


// Media Specifications
function add_image_sizes() {
  if( function_exists( 'add_image_size' )) {
  	add_image_size( 'small', '400', '400', false );
	add_image_size( 'medium_large', '800', '0', false );
	add_image_size( 'extra_large', '1200', '0', false );
  }
}
add_action('after_setup_theme', 'add_image_sizes');

function add_image_choices( $sizes ) {
  return array_merge( $sizes, array(
    'small' => __( 'Small' ),
    'medium_large' => __( 'Medium Large' ),
    'extra_large' => __( 'Extra Large' ),
  ) );
}
add_filter( 'image_size_names_choose', 'add_image_choices' );



/**
 * Enqueue scripts and styles.
 */
function suffoca_six_scripts() {
	wp_enqueue_style( 'suffoca_six-style', get_template_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ),'all' );
//	wp_enqueue_style( 'suffoca_six-style', get_stylesheet_uri() );
//	wp_enqueue_style( 'cinereach-main',  get_template_directory_uri() . '/main.css', array(), filemtime( get_stylesheet_directory() . '/main.css' ),'screen' );

	wp_deregister_script('jquery');
    wp_register_script('jquery', "http" .
    ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") .
    "://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", false, null);
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'suffoca_six-plugins', get_template_directory_uri() . '/js/min/plugins-min.js', array(), '20161121a', true );
	wp_enqueue_script( 'suffoca_six-main', get_template_directory_uri() . '/js/min/main-min.js', array(), '20161121a', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'suffoca_six_scripts' );


add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

function wp_enqueue_woocommerce_style(){
wp_register_style( 'suffoca_six-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array(), filemtime( get_stylesheet_directory() . '/css/woocommerce.css' ) );

if ( class_exists( 'woocommerce' ) ) {
	wp_enqueue_style( 'suffoca_six-woocommerce' );
}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );


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
