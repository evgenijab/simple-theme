<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package simple-theme
 */

 /*
	THEME OPTIONS
*/
add_action( 'acf/init', 'acf_init_options_page' );
/**
 * Function acf_init_options_page
 */
function acf_init_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page(
			array(
				'page_title'    => 'Theme General Settings',
				'menu_title'    => 'Theme Settings',
				'menu_slug'     => 'theme-general-settings',
				'capability'    => 'edit_posts',
				'icon_url'      => 'dashicons-admin-tools',
				'redirect'      => true,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'    => 'Theme Header Settings',
				'menu_title'    => 'Header',
				'parent_slug'   => 'theme-general-settings',
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'    => 'Theme Footer Settings',
				'menu_title'    => 'Footer',
				'parent_slug'   => 'theme-general-settings',
			)
		);
	}
}

/**
 * Sets up a custom block category.
 *
 * @param array $categories returns block categories.
 */
function block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'simple-blocks',
				'title' => __( 'Simple Blocks', 'simple-blocks' ),
			),
		),
		$categories
	);
}
add_action( 'block_categories_all', 'block_categories' );
/**
 * BLOCKS
 */
add_action( 'acf/init', 'acf_init_block_types' );
/**
 * Function acf_init_block_types
 */
function acf_init_block_types() {

	if ( function_exists( 'acf_register_block_type' ) ) {

		// registers block headlines.
		acf_register_block_type(
			array(
				'name'              => 'headlines',
				'title'             => __( 'Headlines' ),
				'description'       => __( 'A custom headline block.' ),
				'category'          => 'simple-blocks',
				'icon'              => 'align-wide',
				'keywords'          => array( 'headline block', 'headline', 'text', 'block' ),
				'mode'              => 'preview',
				'render_template'   => 'inc/blocks/headlines/headlines.php',
				'supports'          => array( 'anchor' => true ),
			)
		);
		// registers text-media block.
		acf_register_block_type(
			array(
				'name'              => 'text-media',
				'title'             => __( 'Text/Media' ),
				'description'       => __( 'A custom text-media block.' ),
				'category'          => 'simple-blocks',
				'icon'              => 'playlist-video',
				'keywords'          => array( 'text-media', 'text', 'media' ),
				'mode'              => 'preview',
				'render_template'   => 'inc/blocks/text-media/text-media.php',
				'supports'          => array( 'anchor' => true ),
			)
		);
		// registers speakers block.
		acf_register_block_type(
			array(
				'name'              => 'speakers',
				'title'             => __( 'Speakers' ),
				'description'       => __( 'A custom Speakers block.' ),
				'category'          => 'simple-blocks',
				'icon'              => 'playlist-video',
				'keywords'          => array( 'text-media', 'text', 'media', 'card' ),
				'mode'              => 'preview',
				'render_template'   => 'inc/blocks/speakers/speakers.php',
				'supports'          => array( 'anchor' => true ),
			)
		);
	}}
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function simple_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'simple_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function simple_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'simple_theme_pingback_header' );
