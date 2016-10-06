<?php

// the headline and optionally the post-type icon
?>
<div class="clearfix fe-home-small">
	<h5>
		<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
	</h5>

	<span class="byline"><?php largo_time(); ?></span>
</div>
