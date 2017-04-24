<?php if ( has_post_thumbnail($featured_post->ID) ) { ?>

	<article <?php post_class( $featured_post->ID ); ?> >

		<div class="entry-content">		
			<h5 class="top-tag"><?php largo_top_term( array( 'post' => $featured_post->ID ) ); ?></h5>
			<div class="has-thumbnail is-image"><a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_post_thumbnail( $featured_post->ID, 'thumbnail' ); ?></a></div>
			<h2 class="entry-title">
				<a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_title($featured_post->ID); ?></a>
			</h2>

			<h5 class="byline"><?php largo_byline(true, false, $featured_post); ?></h5>
				
			<?php largo_excerpt( $featured_post->ID, 1 ); ?>

			</div><!-- .entry-content -->

	</article>
<?php } else { ?>
	<article <?php post_class( $featured_post->ID ); ?> >

		<div class="entry-content">		
			<h5 class="top-tag"><?php largo_top_term( array( 'post' => $featured_post->ID ) ); ?></h5>
			
			<h2 class="entry-title">
				<a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo get_the_title($featured_post->ID); ?></a>
			</h2>

			<h5 class="byline"><?php largo_byline(true, false, $featured_post); ?></h5>
				
			<?php largo_excerpt( $featured_post->ID, 1 ); ?>

			</div><!-- .entry-content -->

	</article>
<?php }