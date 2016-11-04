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
<div id="fe-top-alt" class="row-fluid clearfix">
	<div class="background-container"></div>
	<?php echo $topStoriesAlt; ?>
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
	<div class="inner">
		<div class="widget span6">
			<h3><span>Make a Donation</span></h3>
			<form>
				<button>$25</button>
				<button>$50</button>
				<button>$100</button>
				<button>$500</button>
				<button type="submit">Donate</button>
			</form>
		</div>
		<div class="widget span6">
			<h3><span>Sign Up for News and Updates</span></h3>
			<form>
				<input type="text" placeholder="First Name" />
				<input type="text" placeholder="Last Name" />
				<input type="text" placeholder="Email" />
				<button type="submit">Sign Up</button>
			</form>
		</div>
	</div>
</div>






<script>
jQuery(document).ready(function(){
	var $ = jQuery;

	var main = $('#fe-top-alt .span8')[0];
	var source = $(main).find ('img').attr('src');

	$('#fe-top-alt .background-container').css('background-image', 'url(' + source + ')');
});
</script>