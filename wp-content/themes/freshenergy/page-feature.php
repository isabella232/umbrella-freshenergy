<?php
/**
 * Single Page Template: Feature Template
 * Template Name: Feature Template
 * Description: Shows featured image and one-column text layout
 */

global $shown_ids;
$queried_object = get_queried_object();

add_filter( 'body_class', function( $classes ) {
	$classes[] = 'normal';
	return $classes;
} );

get_header();

?>

<div class="clearfix">
<?php while ( have_posts() ) : the_post(); ?>


	<header class="archive-background clearfix">
		<div class="hero-title">
			<div class="hero is-image">
				<div class="background-container" style="background-image:url(<?php echo the_post_thumbnail_url( 'full' ); ?> )"></div>	
			</div>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
</div>
	</header>

	<section class="container">

		<div id="content" role="main">
			<?php 

					$shown_ids[] = get_the_ID();

					$partial = ( is_page() ) ? 'page' : 'single';

					get_template_part( 'partials/fe-content', $partial );

					if ( $partial === 'single' ) {

						do_action( 'largo_before_post_bottom_widget_area' );

						do_action( 'largo_post_bottom_widget_area' );

						do_action( 'largo_after_post_bottom_widget_area' );

						do_action( 'largo_before_comments' );

						comments_template( '', true );

						do_action( 'largo_after_comments' );
					}
			?>
		</div>
	</section>
<?php endwhile; ?>
</div>	

<?php do_action( 'largo_after_content' ); ?>

<?php get_footer();
