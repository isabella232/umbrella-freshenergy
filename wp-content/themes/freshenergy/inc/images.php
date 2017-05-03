<?php
/**
 * Modifications of Largo's inc/images.php
 */

/**
 * Remove Largo's action largo_attachment_image_link_remove_filter
 * @since Largo 0.5.5.3
 */
add_action( 'the_content', function( $content ) {
	remove_action( 'the_content', 'largo_attachment_image_link_remove_filter', 10 );
	return $content;
}, 5);

/**
 * Remove links to attachments
 *
 * @param object the post content
 * @return object post content with image links stripped out
 * @since 0.1
 */
function fe_attachment_image_link_remove_filter( $content ) {
	$content = preg_replace(
		// replace nth item in first array with nth item in second array: saves middle
		array(
			'{<a(.*?)(?:wp-att|wp-content\/uploads)[^"\']+(?:png|jpeg|jpg|svg|gif)[^>]*><img}',
			'{ wp-image-[0-9]*" /></a>}'
		),
		array( '<img', '" />' ),
		$content
	);
	return $content;
}
add_filter( 'the_content', 'fe_attachment_image_link_remove_filter' );

