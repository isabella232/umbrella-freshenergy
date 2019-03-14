<?php
/**
 * The homepage layout for the Fresh Energy site
 * This file is based off of https://github.com/INN/theme-rivard-report/blob/master/homepages/layouts/RivardReportHomepage.php
 *
 * @since Largo 0.5.4
 */
include_once get_template_directory() . '/homepages/homepage-class.php';

class FreshEnergyHome extends Homepage {
	function __construct( $options = array() ) {
		$suffix = ( LARGO_DEBUG ) ? '' : '.min';

		$defaults = array(
			'name' => __( 'Fresh Energy Homepage Template', 'fe' ),
			'type' => 'fe',
			'description' => __( 'Four stories in a grid at the top, then plenty of widget areas', 'fe' ),
			'template' => get_stylesheet_directory() . '/homepages/templates/fe-homepage.php',
			'assets' => array(
				array(
					'homepage-single',
					get_stylesheet_directory_uri() . '/homepages/assets/css/homepage'. $suffix . '.css',
					array(),
					filemtime( get_stylesheet_directory() . '/homepages/assets/css/homepage' . $suffix . '.css' )
				),
			),
			'prominenceTerms' => array(
				// Largo creates Homepage Featured by default, it seems.
				// but we need a Homepage Secondary Featured
				array(
					'name' => __( 'Homepage Secondary Featured', 'fe' ),
					'description' => __( 'The second homepage featured post: this displays on the right.', 'fe' ),
					'slug' => 'homepage-secondary-featured'
				)
			)
		);
		$options = array_merge( $defaults, $options );
		parent::__construct( $options );
	}

	/**
	 * Get the homepage top story
	 *
	 * This copies fairly heavily from Largo's largo_home_featured_stories
	 * This is a separate implementation because we're not going to use the Top Story taxonomy term
     *
	 * @link https://github.com/INN/Largo/blob/09367b17e4d49578dbcc22d9c0829d3668a1e3f5/homepages/homepage.php#L152-L171
	 * @see largo_home_featured_stories
	 * @see FreshEnergyHome::topStories
	 */
	function get_topStories( $max = 4 ) {
		$homepage_feature_term = get_term_by( 'name', __('Homepage Featured', 'largo'), 'prominence' );

		// Get the homepage featured posts
		$featured = get_posts(array(
			'tax_query' => array(
				array(
					'taxonomy' => 'prominence',
					'field' => 'term_id',
					'terms' => $homepage_feature_term->term_id
				)
			),
			'posts_per_page' => $max,
		));

		if ( count( $featured ) < $max ) {
			$min = $max - count( $featured );

			$additional = get_posts( array(
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => $min,
				'post__not_in' => array_map( function( $o ) { return $o->ID; }, $featured )
			) );

			$featured = array_merge( $featured, $additional );
		}

		return $featured;
	}

	/**
	 * Get the posts for the homepage secondary featured story
	 *
	 * This copies fairly heavily from Largo's largo_home_featured_stories
	 * This is a separate implementation because we're not going to use the Top Story taxonomy term
     *
	 * @link https://github.com/INN/Largo/blob/09367b17e4d49578dbcc22d9c0829d3668a1e3f5/homepages/homepage.php#L152-L171
	 * @see largo_home_featured_stories
	 * @see FreshEnergyHome::topStoriesAlt
	 */
	function get_topStoriesSecondary( $max = 4 ) {
		$homepage_feature_term = get_term_by( 'name', __('Homepage Secondary Featured', 'largo'), 'prominence' );

		// Get the homepage featured posts
		$featured = get_posts(array(
			'tax_query' => array(
				array(
					'taxonomy' => 'prominence',
					'field' => 'term_id',
					'terms' => $homepage_feature_term->term_id
				)
			),
			'posts_per_page' => $max,
		));

		if ( count( $featured ) < $max ) {
			$min = $max - count( $featured );

			$additional = get_posts( array(
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => $min,
				'post__not_in' => array_map( function( $o ) { return $o->ID; }, $featured )
			) );

			$featured = array_merge( $featured, $additional );
		}

		return $featured;
	}

	/**
	 * Output the markup for the homepage top stories
	 */
	function topStories() {
		$posts = $this->get_topStories();

		global $post;

		ob_start();

		echo '<div id="top-stories-container">';

		foreach ( $posts as $post ) {
			setup_postdata( $post );
			get_template_part( 'partials/home-topstory' );
		}

		echo '</div>';

		wp_reset_postdata();

		return ob_get_clean();
	}

	/**
	 * Output the markup for the homepage top stories
	 */
	function topStoriesAlt() {
		$top = $this->get_topStories(1);

		global $post;

		ob_start();

		echo '<div id="top-stories-container"><div class="inner">';

		foreach ( $top as $post ) {
			setup_postdata( $post );

			echo '<div class="span8">';
			get_template_part( 'partials/home-topstoryalt-main' );
			echo '</div>';
		}

		$secondary = $this->get_topStoriesSecondary(1);

		foreach ( $secondary as $post ) {
			echo '<div class="span4">';
			get_template_part( 'partials/home-topstoryalt' );
			echo '</div>';
		}

		echo '</div></div>';

		wp_reset_postdata();

		return ob_get_clean();
	}

	/**
	 * All other parts of the homepage are widget areas with widgets. The "Homepage Bottom" widget area contains a custom idget built for this theme.
	 */
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
			'before_title' => '<h3 class=""><span>',
			'after_title' => '</span></h3>'
		),
		array(
			'name' => __( 'Homepage Circles Menu', 'fe' ),
			'id' => 'homepage-circles',
			'description' => __( 'Place one Custom Menu widget here', 'fe' ),
			'before_widget' => '<div class="span12">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class=""><span>',
			'after_title' => '</span></h3>'
		),
		array(
			'name' => __( 'Homepage Bottom', 'fe' ),
			'id' => 'homepage-bottom',
			'description' => __( 'Place Fresh Energy Homepage Widgets here for each item in the custom menu in the Homepage Circles Menu', 'fe' ),
			'before_widget' => '<div class="span12">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class=""><span>',
			'after_title' => '</span></h3>'
		),
		array(
			'name' => __( 'Homepage Footer', 'fe' ),
			'id' => 'homepage-footer',
			'description' => __( 'This appears at the bottom of the homepage.', 'fe' ),
			'before_widget' => '<div class="span6">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class=""><span>',
			'after_title' => '</span></h3>'
		)
	);

	foreach ( $sidebars as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
add_action( "widgets_init", 'fe_add_homepage_widget_areas' );
