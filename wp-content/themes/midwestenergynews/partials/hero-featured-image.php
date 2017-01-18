<div class="<?php echo $classes; ?>">

<?php 
	echo get_the_post_thumbnail( $post->ID, 'full' );

	if ( !empty( $thumb_meta ) ) {
		if ( !empty( $thumb_meta['credit'] ) ) {
			if ( !empty( $thumb_meta['credit_url'] ) ) {
				echo '<p class="wp-media-credit visible-tablet visible-phone"><a href="' . $thumb_meta['credit_url'] . '">' . $thumb_meta['credit'] . '</a>';
			} else { 
				echo '<p class="wp-media-credit visible-tablet visible-phone">' . $thumb_meta['credit'];
			}
			if ( !empty( $thumb_meta['organization'] ) )
				echo ' / ' . $thumb_meta['organization'];
			echo '</p>';
		}
			
		if ( !empty( $thumb_meta['caption'] ) )
			echo '<p class="wp-caption-text">' . $thumb_meta['caption'] . '</p>';
	} 
?>

</div>
