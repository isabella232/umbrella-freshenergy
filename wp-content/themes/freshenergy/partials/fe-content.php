<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
	<?php do_action('largo_before_page_header'); ?>
	
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php edit_post_link(__('Edit This Page', 'largo'), '<h5 class="byline"><span class="edit-link">', '</span></h5>'); ?>
	</header><!-- .entry-header -->

	<!-- <header class="archive-background clearfix">
		<div class="hero-title">
			<?php
				$post_id = largo_get_term_meta_post( $queried_object->taxonomy, $queried_object->term_id );
				largo_hero( $post_id );
			?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</header> -->
	
	<?php 
		do_action('largo_after_page_header'); 

		largo_hero( null,'' );

		do_action( 'largo_after_hero' );
	?>
	
	<section class="entry-content">
		
		<?php do_action('largo_before_page_content'); ?>
		
		<?php the_content(); ?>
		
		<?php do_action('largo_after_page_content'); ?>
		
	</section><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
