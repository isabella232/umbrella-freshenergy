<?php

$thumbnail = get_the_post_thumbnail( $post->ID, 'medium_large' );
?>
<div <?php echo post_class( 'span6 clearleft' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php echo $thumbnail; ?>
		<h2><?php the_title(); ?></h2>
	</a>
</div>
