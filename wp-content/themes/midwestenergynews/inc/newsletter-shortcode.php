<?php
/**
 * newsletter signup form
 */
function mwen_newsletter_signup($attrs=null) {
	( !empty($attrs) && array_search( 'reverse', $attrs ) !== false ) ? $reverse = false : $reverse = true ;
	$attrs = shortcode_atts(
		array(
			'title' => '',
			'reverse' => $reverse,
		),
		$attrs
	);
	ob_start();
	the_widget('mwen_mailchimp_signup_widget', $attrs);
	return ob_get_clean();
}
add_shortcode( 'newsletter_signup', 'mwen_newsletter_signup' );

/**
 * Also render the newsletter signup form on pages published before June 30, 2015
 */
function mwen_add_newsletter_signup_to_old_posts() {
	global $post;
	if ( !is_admin() && strtotime( '2015-06-30 00:00:00' ) > strtotime( $post->post_date ) ) {
		print mwen_newsletter_signup( array( 'reverse' => true ) );
	}
}
add_action( 'mwen_pre_largo_entry_content', 'mwen_add_newsletter_signup_to_old_posts' );