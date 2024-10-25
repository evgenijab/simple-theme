<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package simple-theme
 */
/**
 * BLOCKS
 */
add_action( 'acf/init', 'snk_child_acf_init_block_types' );
/**
 * Function snk_child_acf_init_block_types
 */
function snk_child_acf_init_block_types() {

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
				//'enqueue_style'     => snk_block_file( 'inc/blocks/headlines/headlines.css', true ),
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
				//'enqueue_style'     => snk_block_file( 'inc/blocks/text-media/text-media.css', true ),
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
