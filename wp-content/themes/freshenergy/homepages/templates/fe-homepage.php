<?php
/**
 * Home Template: Fresh Energy Homepage
 * Description: Four posts arranged in a grid, then the rest of the page is widget areas
 */

global $largo, $shown_ids, $tags;
?>
<div id="fe-top" class="row-fluid clearfix">
	<?php echo $topStories; ?>
</div>
<div id="fe-homepage-cta" class="row-fluid clearfix">
	<?php dynamic_sidebar( 'homepage-cta' ); ?>
</div>
<div id="fe-homepage-circles" class="row-fluid clearfix">
	<?php dynamic_sidebar( 'homepage-circles' ); ?>
</div>
<div id="fe-homepage-bottom">
	<?php dynamic_sidebar( 'homepage-bottom' ); ?>
</div>
<div id="fe-homepage-footer">
	<?php dynamic_sidebar( 'homepage-footer' ); ?>
</div>