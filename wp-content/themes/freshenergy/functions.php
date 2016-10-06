<?php
/**
 * Child theme functions for the freshenergy theme
 */

/**
 * Include theme files
 *
 * Based off of how Largo loads files: https://github.com/INN/Largo/blob/master/functions.php#L358
 *
 * 1. hook function Largo() on after_setup_theme
 * 2. function Largo() runs Largo::get_instance()
 * 3. Largo::get_instance() runs Largo::require_files()
 *
 * This function is intended to be easily copied between child themes, and for that reason is not prefixed with this child theme's normal prefix.
 *
 * @link https://github.com/INN/Largo/blob/master/functions.php#L145
 */
function largo_child_require_files() {
	$includes = array(
		'/homepages/layouts/freshenergy.php',
		'/inc/widgets.php',
	);
	foreach ( $includes as $include ) {
		require_once( get_stylesheet_directory() . $include );
	}
}
add_action( 'after_setup_theme', 'largo_child_require_files' );

/**
 * Include compiled style.css
 */
function fe_styles() {
	wp_dequeue_style( 'largo-child-styles' );
	$suffix = (LARGO_DEBUG)? '' : '.min';
	wp_enqueue_style( 'fe', get_stylesheet_directory_uri() . '/css/child' . $suffix . '.css' );
}
add_action( 'wp_enqueue_scripts', 'fe_styles', 20 );
