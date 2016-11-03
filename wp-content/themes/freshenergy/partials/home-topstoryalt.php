<?php

$thumbnail = get_the_post_thumbnail( $post->ID, 'medium_large' );
?>

<div class="row-fluid fe-card">
	<div <?php post_class( $recent->ID ); ?> >
		<a href="<?php echo get_permalink(); ?>" class="blocklink"></a>
		<a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail( 'large' ); ?></a>
		<div class="text-wrapper">
			<h5 class="top-tag"><?php largo_top_term( array( 'post' => $recent->ID ) ); ?></h5>
			<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
			<span class="byline"><?php echo largo_byline(false); ?></span>
			<?php largo_excerpt( null, 1 ); ?>
		</div>
	</div>
</div>
