<?php
/*
Template Name: Category Publications
*/
?>
<?php get_header() ?>

<section id="sections">

	<?php
	$cat = get_category_by_slug('publications');
	$args = array(
		'parent' => $cat->term_id,
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
				<img src="<?php echo $cat_img[0]; ?>" width="280" height="140" alt="<?php echo $cat->name ?>" />
			</figure>
			<?php
			$parent = get_category($cat->term_id);
			$args = array(
				'parent' => $parent->term_id,
				'orderby' => 'name',
				'order' => 'desc'
			);
			$issues = get_categories($args);
			foreach ($issues as $issue) {
			?>

				<article class="leadin">
					<div class="hentry">
						<header>
							<h3><a href="<?php echo get_category_link($issue->term_id); ?> " rel="permalink"><?php echo $issue->name; ?></a></h3>
						</header>
						<p><?php echo $issue->description ?></p>
					</div>
				</article>
			<?php
			}
			?>
		</section>
		<?php
		$i++;
	}
	?>
</section>

<?php get_sidebar() ?>
<?php get_footer() ?>