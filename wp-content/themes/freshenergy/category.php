<?php
/**
 * Template for category archive pages
 *
 * @package Largo
 * @since 0.4
 * @filter largo_partial_by_post_type
 */
get_header();

global $tags, $paged, $post, $shown_ids;

$title = single_cat_title( '', false );
$description = category_description();
$rss_link = get_category_feed_link( get_queried_object_id() );
$posts_term = of_get_option( 'posts_term_plural', 'Stories' );
$queried_object = get_queried_object();
?>

<div class="clearfix">
	<header class="archive-background clearfix">
		<a class="rss-link rss-subscribe-link" href="<?php echo $rss_link; ?>"><?php echo __( 'Subscribe', 'largo' ); ?> <i class="icon-rss"></i></a>
		<div class="hero-title">
			<?php
				$post_id = largo_get_term_meta_post( $queried_object->taxonomy, $queried_object->term_id );
				largo_hero( $post_id );
			?>
			<h1 class="page-title"><?php echo $title; ?></h1>
		</div>
		<div class="archive-description"><?php echo $description; ?></div>
		<?php do_action( 'largo_category_after_description_in_header' ); ?>
		<?php get_template_part( 'partials/archive', 'category-related' ); ?>
	</header>

	<section class="container">

	<?php if ( $paged < 2 && of_get_option( 'hide_category_featured' ) == '0' ) {
		$featured_posts = largo_get_featured_posts_in_category( $wp_query->query_vars['category_name'] );

		if ( count( $featured_posts ) > 0 ) {
			$secondary_featured = $featured_posts;
			if ( count( $secondary_featured ) > 0 ) { ?>
				<div class="secondary-featured-post">
					<div class="row-fluid clearfix"><?php
						foreach ( $secondary_featured as $idx => $featured_post ) {
								$shown_ids[] = $featured_post->ID;
								largo_render_template(
									'partials/archive',
									'category-featured',
									array( 'featured_post' => $featured_post )
								);
						} ?>
					</div>
					<a href=""><button>More News</button></a>
				</div>
		<?php }
	}
} ?>
	</section>
</div>

<div id="fe-staff-circles" class="row-fluid clearfix">
	<div class="widget widget-1 odd default span12">
		<h3 class=""><span>Staff</span></h3>
		<div class="menu-staff-container">
			<ul id="menu-staff" class="menu">
				<li id="menu-item-18442" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18442"><a href="#"><span>Steven Staffer</span></a></li>
				<li id="menu-item-18443" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18443"><a href="#"><span>Steven Staffer</span></a></li>
				<li id="menu-item-18444" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18444"><a href="#"><span>Stephanie Staffer</span></a></li>
				<li id="menu-item-18445" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18445"><a href="#"><span>Steven Staffer</span></a></li>
				<li id="menu-item-18446" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-18446"><a href="#"><span>Stephanie Staffer</span></a></li>
			</ul>
		</div>
	</div>
</div>

<div id="fe-reports">
	<div class="widget widget-1 odd default span12">
		<h3 class=""><span>Reports</span></h3>
		<div class="row-fluid">
			<div class="span4">
				<a><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/report-placeholder.png" /></a>
				<h4><a>Report 1</a></h4>
			</div>
			<div class="span4">
				<a><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/report-placeholder.png" /></a>
				<h4><a>Report 2</a></h4>
			</div>
			<div class="span4">
				<a><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/report-placeholder.png" /></a>
				<h4><a>Report 3</a></h4>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
