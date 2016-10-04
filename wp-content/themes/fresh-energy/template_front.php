<?php
/*
Template Name: Front Page
*/
?>
<?php get_header() ?>

<section id="features">

	<?php ep_display_rotator() ?>

	<?php
	$feature = get_page_by_path('campaign-update');
	?>
	<section id="updates">
		<h3><?php echo $feature->post_title; ?></h3>
		<div>
			<?php echo $feature->post_content; ?>
		</div>
	</section>
</section>

<section id="sections">

	<?php
	$cat = get_category_by_slug('issues');
	$args = array(
		'child_of' => $cat->term_id,
		'depth' => 1,
	);
	$issue_cats = get_categories($args);
	$i = 1;
	foreach($issue_cats as $cat) {

		if (function_exists('get_terms_meta')) {
		    $cat_img = get_terms_meta($cat->term_id, 'category-image');
		}

		?>
		<section class="category <?php echo ($i && $i%2==0)?'end':'' ?>">

			<figure class="category-image">
				<h2><?php echo $cat->name ?></h2>
				<a href="<?php echo get_category_link($cat->term_id); ?>"><img src="<?php echo $cat_img[0]; ?>" width="280" height="140" alt="<?php echo $cat->name ?>" /></a>
			</figure>
			<?php
			global $query_string;
			query_posts( $query_string . "&cat=".$cat->term_id."&posts_per_page=3" );
			while (have_posts()) : the_post(); ?>
				<article class="leadin">
					<div class="hentry">
						<header>
							<h3><a href="<?php the_permalink(); ?>" rel="permalink"><?php the_title(); ?></a></h3>
						</header>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
						<footer class="meta"><p class="author">POSTED <?php echo the_time('m.d.Y') ?> by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a></p></footer>
					</div>
				</article>
				<?php endwhile; wp_reset_query(); ?>
		</section>
		<?php
		$i++;
	}
	?>
</section>

<script type="text/javascript">
//<![CDATA[
	$(function() {
		$("#slider").carouFredSel({
			auto:10000,
			pagination: {
				container: '#slider-pagination #links'
			}
		});
	})
//]]>
</script>

<?php get_sidebar() ?>

<?php get_footer() ?>