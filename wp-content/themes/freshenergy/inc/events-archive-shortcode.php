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
		'exclude' => '',
		'include' => '',
		'meta_key' => 'events_date_iso',
		'order' => 'DESC'
		'orderby' => 'meta_value',
		'per_page' => get_option('posts_per_page'),
		'term' => 'Events',
		'thumb' => 'true',
		'thumbsize' => 'thumbnail'
	) );

	global $paged, $post;

	$query_opts = array(
		'posts_per_page'      => $options['per_page'],
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
		'orderby'             => $options['order'],
		'order'               => $options['orderby'],
		'meta_key'            => $options['meta_key'],
		'post__not_in'        => explode(',', $options['exclude'] ),
		'post__in'            => explode(',', $options['include'] ),
	);

	$events = new WP_Query( $query_opts );

	/*
	 * output the terms
	 */
	ob_start();
	
	echo '<div class="events-archive stories">';
	wp_reset_postdata();
	echo '</div>';

	$ret = ob_get_clean();
	return $ret;
}
add_shortcode('events_list', 'events_archive_shortcode');
