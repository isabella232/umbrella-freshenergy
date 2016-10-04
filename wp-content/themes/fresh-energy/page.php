<?php get_header() ?> 

			
<?php get_sidebar() ?> 
			<section id="sub">
					<?php while (have_posts()) : the_post(); ?> 
						<article class="hentry the-content">

							<div class="entry-content">
					
							<?php the_content(); ?> 
							
							</div>
						</article>
					<?php endwhile; ?> 
			</section>
<?php get_footer() ?> 