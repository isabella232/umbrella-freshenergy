<?php

// the thumbnail image (if we're using one)
if ( has_post_thumbnail() ) { ?>
	<div class="row-fluid fe-home-big">
		<div class="span6">
			<a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail( 'mediaum' ); ?></a>
		</div>
		<div class="span6">
			<h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
			<span class="byline"><?php echo largo_byline(false); ?></span>
			<?php largo_excerpt( null, 1 ); ?>
		</div>
	</div>
<?php } else { ?>
	<div class="row-fluid fe-home-big">
		<div class="span12">
			<h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
			<span class="byline"><?php echo largo_byline(false); ?></span>
			<?php largo_excerpt( null, 3 ); ?>
		</div>
	</div>
<?php }
