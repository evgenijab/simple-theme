<?php
/**
 * simple-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package simple-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simple_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on simple-theme, use a find and replace
		* to change 'simple-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'simple-theme', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'simple-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'simple_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'simple_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function simple_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simple_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'simple_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simple_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'simple-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'simple-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'simple_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simple_theme_scripts() {
	wp_enqueue_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap-grid.min.css' );

	wp_enqueue_style( 'simple-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'simple-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'simple-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simple_theme_scripts' );

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

add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );
/**
 * Save ACF fields to json file.
 *
 * @param array $path returns file path.
 * @return array
 */
function my_acf_json_save_point( $path ) {

	// update path.
	$path = get_template_directory() . '/acf-json';

	// return.
	return $path;
}

add_filter( 'acf/settings/load_json', 'my_acf_json_load_point' );
/**
 * Load acf json file.
 *
 * @param array $paths return the path.
 * @return array
 */
function my_acf_json_load_point( $paths ) {

	// remove original path (optional).
	unset( $paths[0] );

	// append path.
	$paths[] = get_template_directory() . '/acf-json';

	// return.
	return $paths;
}

/**
 * Adding inline SVG icons with PHP function.
 *
 * @param   string $name The SVG file name.
 * @param   string $type The icon type (f.e 'icons', 'picto', 'logo').
 * @param   bool   $echo Echo SVG or return.
 */
function inline_svg( $name = '', $type = 'icon', $echo = true ) {
	if ( strlen( $name ) > 0 ) {
		$svgfolder = '/assets/svgs/';
		$ext = '.svg';
		if ( $type && 'icon' !== $type && strpos( $type, ' ' ) === false ) {
			$svgfolder = $svgfolder . $type . 's/';
		} else {
			$svgfolder = $svgfolder . 'icons/';
		}
		$svg_filepath = get_stylesheet_directory() . $svgfolder . $name . $ext;
		if ( file_exists( $svg_filepath ) ) {
			$svg = file_get_contents( $svg_filepath );
			if ( $echo ) {
				echo $svg;
			} else {
				return $svg;
			}
		}
	}
}