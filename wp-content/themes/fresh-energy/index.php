<?php get_header() ?>


				<section id="sub" class="archive">

					<?php
					if(is_category()) {
						$cat_ID = get_query_var('cat');
						if(cat_is_ancestor_of(get_category_by_slug('publications'), $cat_ID )) {
							if (function_exists('get_terms_meta')) {

							    $cat_img = get_terms_meta($cat_ID, 'category-image');
								if(!empty($cat_img)) {
									?>
									<figure id="category-img">
										<img src="<?php echo $cat_img[0] ?>" width="602" height="282" alt="Current Topic">
									</figure>
									<?php
								}
							}
						}
					}
					?>


					<?php if (have_posts()): ?>

						<?php while (have_posts()) : the_post(); ?>

							<article class="<?php echo (is_single())?'single':'article' ?>">
								<header class="header">
									<div class="entry-meta">
										<?php if(is_single()) { ?>
										<section class="sharing">
											<!-- AddThis Button BEGIN -->
											<div class="addthis_toolbox addthis_default_style ">
											<a class="addthis_button_facebook_like" fb:like:layout="button_count" style="opacity: 1; -moz-opacity: 1; filter:alpha(opacity=100);"></a>
											<a class="addthis_button_tweet"></a>
											<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
											<a class="addthis_counter addthis_pill_style"></a>
											</div>
											<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ed7910d6d8db3e3"></script>
											<!-- AddThis Button END -->
										</section>
										<?php } ?>
									</div>
									<h2><?php
										if(in_category('clean-energy')) {
											echo 'Clean Energy';
										} elseif(in_category('energy-efficiency')) {
											echo 'Energy Efficiency';
										} elseif(in_category('global-warming')) {
											echo 'Global Warming';
										} elseif(in_category('transportation-land-use')) {
											echo 'Transportation &amp; Land Use';
										} else {
											single_cat_title();
										}
									?></h2>
									<h3 itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php if(is_single()) { ?><div class="entry-meta"><p class="author">POSTED <?php the_time('m.d.Y') ?> by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a></p></div><?php } ?>
								</header>

								<?php
								if(is_single()) {
									?>
									<div class="the-content">
										<?php the_content(); ?>
										<p itemprop="description" style="display:none"><?php echo get_the_excerpt(); ?></p>
									</div>
									<?php
								} else {
									the_post_thumbnail();
									the_excerpt();
								}
								?>

								<?php if(is_single() && in_category('publications')) { ?>

									<section id="featured-in">
										<h4>This Article Featured In</h4>
										<?php
										$i=0;
										foreach((get_the_category('', false)) as $k => $childcat) {
											if (cat_is_ancestor_of(get_category_by_slug('powering-progress'), $childcat) || cat_is_ancestor_of(get_category_by_slug('energy-matters'), $childcat)) {
												?>
												<h3 style="<?php echo ($i>0)?'display:none':'' ?>">
													<a href="<?php echo get_category_link($childcat->cat_ID) ?>"><?php echo (cat_is_ancestor_of(get_category_by_slug('powering-progress'), $childcat))?'Powering Progress':'Energy Matters' ?> - <?php echo $childcat->cat_name ?></a> <a href="https://secure.fresh-energy.org/np/clients/freshenergy/account.jsp" class="subscribe">Subscribe</a>
												</h3>
												<?php
												$i++;
											}
										}
										if($i>1) {
											?>
											<a href="#" class="view-all">View All</a>
											<?php
										}
										?>

									</section>

									<section class="entry-meta">
										<p class="tags"><?php the_tags('', ', ', false) ?></p>
									</section>

								<?php } else  { ?>

								<div class="entry-meta">
									<?php if(!is_single()) { ?>
									<p class="author">POSTED <?php the_time('m.d.Y') ?> by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a></p><?php } ?>
									<p class="tags"><?php the_tags('', ', ', false) ?></p>
									<div class="comments">
										<?php comments_popup_link(__('Add a Comment'), __('1 Comment'), __('% Comments')); ?>
									</div>
								</div>

								<?php } ?>
							</article>






						<?php
						comments_template();
						?>

						<?php endwhile; wp_reset_query(); ?>

						<nav class="pagination">
							<div class="prev left"><?php next_posts_link('Previous Entries') ?></div>
							<div class="next right"><?php previous_posts_link('Newer Entries') ?></div>
						</nav>

					<?php else: ?>
						<article class="hentry">
							<header>
								<h1 class="page-title">Content not found.</h1>
							</header>
							<p>Sorry. We can't seem to find what you're looking for.</p>
						</article>
					<?php endif; ?>
			</section>

<?php get_sidebar() ?>

<?php get_footer() ?>