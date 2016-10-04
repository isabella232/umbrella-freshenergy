<?php
/**
 * Child theme functions for the freshenergy theme
 */

/**
 * Include compiled style.css
 */
function fe_styles() {
	wp_dequeue_style( 'largo-child-styles' );
	$suffix = (LARGO_DEBUG)? '' : '.min';
	wp_enqueue_style( 'fe', get_stylesheet_directory_uri() . '/css/child' . $suffix . '.css' );
}
add_action( 'wp_enqueue_scripts', 'fe_styles', 20 );
