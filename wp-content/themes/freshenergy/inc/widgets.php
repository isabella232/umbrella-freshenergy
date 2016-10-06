<?php

/**
 * register FE's widgets
 * @see largo_widgets
 * @since Largo 0.5.5
 * @since 0.1
 */
function fe_widgets() {
	$register = array(
		'fe_homepage_posts' => '/inc/widgets/fe-homepage-posts.php',
	);

	foreach ( $register as $key => $val ) {
		require_once( get_stylesheet_directory() . $val );
		register_widget( $key );
	}
}
add_action( 'widgets_init', 'fe_widgets', 1 );
