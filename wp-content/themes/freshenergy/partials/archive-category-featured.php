<?php if ( has_post_thumbnail($featured_post->ID) ) { ?>
	<div class="row-fluid fe-card">
		<div <?php post_class( $featured_post->ID ); ?> >
			<a href="<?php echo get_permalink($featured_post->ID); ?>" class="blocklink"></a>
			<a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_post_thumbnail( $featured_post->ID, 'large' ); ?></a>
			<div class="text-wrapper">
				<h5 class="top-tag"><?php largo_top_term( ); ?></h5>
				<h4><a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_title($featured_post->ID); ?></a></h4>
				<span class="byline"><?php largo_byline(true, false, $featured_post); ?></span>
				<?php largo_excerpt( $featured_post->ID, 1 ); ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="row-fluid fe-card">
		<div <?php post_class( $featured_post->ID ); ?> >
			<a href="<?php echo get_permalink($featured_post->ID); ?>" class="blocklink"></a>
			<div class="text-wrapper">
				<h5 class="top-tag"><?php largo_top_term(  ); ?></h5>
				<h4><a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_title($featured_post->ID); ?></a></h4>
				<span class="byline"><?php largo_byline(true, false, $featured_post); ?></span>
				<?php largo_excerpt( $featured_post->ID, 1 ); ?>
			</div>
		</div>
	</div>
<?php }