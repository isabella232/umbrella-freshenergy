<?php
/**
 * The homepage layout for the Fresh Energy site
 * This file is based off of https://github.com/INN/theme-rivard-report/blob/master/homepages/layouts/RivardReportHomepage.php
 *
 * @since Largo 0.5.4
 */
include_once get_template_directory() . '/homepages/homepage-class.php';

class FreshEnergyHome extends Homepage {
}

/**
 * Unregister some of the default homepage templates
 * Register our custom one
 *
 * @since 0.1
 */
function fe_custom_homepage_layouts() {
	$unregister = array(
		'HomepageBlog',
		'TopStories',
		'LegacyThreeColumn'
	);
	foreach ( $unregister as $layout ) {
		unregister_homepage_layout( $layout );
	}

	register_homepage_layout( 'FreshEnergyHome' );
}
add_action( 'init', 'fe_custom_homepage_layouts' );

/**
 * Add Fresh energy homepage widget areas
 * This isn't handled with the 'sidebars' index of the $defaults in
 * FreshEnergyHome::__construct because that only lets us set names,
 * not set wrapping HTML and other things
 *
 * @todo maybe this should be included in the homepage layout class
 */
function fe_add_homepage_widget_areas() {
	$sidebars = array(
		array(
			'name' => __( 'Homepage Call to Action', 'fe' ),
			'id' => 'homepage-cta',
			'description' => __( 'You should place one text widget here, which contains the primary call to action of the site', 'fe' ),
			'before_widget' => '<div class="span12">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="">',
			'after_title' => '</h3>'
		),
		array(
			'name' => __( 'Homepage Circles Menu', 'fe' ),
			'id' => 'homepage-circles',
			'description' => __( 'Place one Custom Menu widget here', 'fe' ),
			'before_widget' => '<div class="span12">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="">',
			'after_title' => '</h3>'
		),
		array(
			'name' => __( 'Homepage Bottom', 'fe' ),
			'id' => 'homepage-bottom',
			'description' => __( 'Place Fresh Energy Homepage Widgets here for each item in the custom menu in the Homepage Circles Menu', 'fe' ),
			'before_widget' => '<div class="span12">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="">',
			'after_title' => '</h3>'
		),
		array(
			'name' => __( 'Homepage Footer', 'fe' ),
			'id' => 'homepage-footer',
			'description' => __( 'This appears at the bottom of the homepage.', 'fe' ),
			'before_widget' => '<div class="span6">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="">',
			'after_title' => '</h3>'
		)
	);

	foreach ( $sidebars as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
add_action( "widgets_init", 'fe_add_homepage_widget_areas' );
