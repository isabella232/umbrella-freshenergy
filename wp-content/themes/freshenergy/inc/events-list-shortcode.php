<?php
/**
 * Functions related to the Events List shortcode
 * Note that this was copied from Chicago Reporter's tax term archive shortcode
 * @see inc/events.php
 * @since Largo 0.5.5.3
 */

/**
 * Output a list of event posts sorted by date, using the [events_list] shortcode
 *
 * The output list will be a div.events-list of div.item elements with the addtional class of the term item's id.
 *
 * Setting 'exclude=""' to a list of comma-separated IDs will exclude those term IDs from the listing.
 * Setting 'include=""' to a list of comma-separated IDs will make the shortcode *only* return those term IDs.
 *
 * @link https://developer.wordpress.org/reference/functions/get_terms/
 * @uses cr_get_cftl_landing_page_for_term
 */
function events_archive_shortcode( $atts, $context, $tag ) {
	/*
	 * Gather the terms
	 * For details of how these args work, see get_terms: https://developer.wordpress.org/reference/functions/get_terms/
	 * get_terms is called by get_categories: https://developer.wordpress.org/reference/functions/get_categories/
	 */
	$options = shortcode_atts( array(
		'exclude' => null,
		'include' => null,
		'order' => 'DESC',
		'per_page' => get_option('posts_per_page'),
		'term' => 'Events',
		'thumb' => 'true',
		'thumbsize' => 'thumbnail'
	), $atts );

	global $paged, $post;

	$query_opts = array(
		#'posts_per_page'      => $options['per_page'],
		#'paged'               => $paged,
		'ignore_sticky_posts' => true,
		#'orderby'             => $options['order'],
		'order' => 'DESC',
		'orderby'               => 'meta_value_num',
		'meta_key'            => 'events_date_epoch',
		#'post__not_in'        => explode(',', $options['exclude'] ),
		#'post__in'            => explode(',', $options['include'] ),
	);

	$events = new WP_Query( $query_opts );

	/*
	 * output the terms
	 */
	ob_start();
	
	echo '<div class="events-archive stories">';
	$counter = 1;

	while ( $events->have_posts() ) {
		$events->the_post();
		$partial = largo_get_partial_by_post_type( 'archive', 'post', 'archive' );
		global $post;
		echo get_post_meta( $post->ID, 'events_date_epoch', true );
		get_template_part( 'partials/content', $partial );
		do_action( 'largo_loop_after_post_x', $counter, $context = 'archive' );
		$counter++;
	}
	
	// I don't know why this is true; it should not be
	$events->is_home = false;
	// if it is true, https://github.com/INN/largo/blob/v0.5.5.3/inc/ajax-functions.php#L110-L114 triggers and we repeat a page

	largo_render_template( 'partials/load-more-posts', array(
		'nav_id'=> 'nav-below',
		'the_query' => $events,
		'posts_term' => 'Events'
	) );

	wp_reset_postdata();
	echo '</div>';

	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('events_list', 'events_archive_shortcode');
