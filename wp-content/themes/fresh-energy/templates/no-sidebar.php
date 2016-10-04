<?php
/**
 * Template Name: No Sidebar
 */
get_header(); ?>

<section id="sub" class="no-sidebar">
  <?php while (have_posts()) : the_post(); ?>
    <article class="hentry the-content">
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>
</section><!-- #sub.no-sidebar -->

<?php get_footer() ?>