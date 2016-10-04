<?php

// ======================================
// = Twitter OAuth Library =
// ======================================
// require_once 'lib/codebird.php';
// require_once 'lib/helper.php';

add_filter( 'show_admin_bar', '__return_false' );

if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' ); 
  set_post_thumbnail_size(280, 140, true);
}

if ( function_exists( 'register_sidebar' ) ) {
    register_sidebar();
}

// ======================================
// = set the excerpt read more text.... =
// ======================================
function new_excerpt_more($more) {
    global $post;
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function excerpt_read_more_link($output) {
	 global $post;
	 return $output . '<a href="'. get_permalink($post->ID) . '"  class="view-story">View Full Story</a>';
}
add_filter('the_excerpt', 'excerpt_read_more_link');

// ==========================
// = set the excerpt length =
// ==========================
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');



function ep_get_top_posts_today($limit = '3') {
	global $wpdb;
	$result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND DATE(post_date) >= DATE(NOW()) ORDER BY comment_count DESC LIMIT 0 , $limit");
		$i = 1;
		foreach ($result as $post) {
			setup_postdata($post);
			$postid = $post->ID;
			$title = $post->post_title;
			$commentcount = $post->comment_count;
			if ($commentcount != 0) { ?> 
			<li class="pop-<?php echo $i; ?>"><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>">
			<?php echo $title ?></a></li>
<?php
			$i++; 
			} 
		}
} 
function ep_active_discussions($limit = '5') {
	global $wpdb;
	$result = $wpdb->get_results("SELECT comment_count,ID,post_title,post_author FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'  ORDER BY comment_count DESC LIMIT 0 , 4");
		foreach ($result as $post) {
			setup_postdata($post);
			$postid = $post->ID;
			$title = $post->post_title;
			$author = $post->post_author;
			$commentcount = $post->comment_count;
			if ($commentcount != 0) { ?> 
			<li>
				<article class="entry">
						<p class="count"><?php echo $commentcount ?></p>
						<h4><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>">
				<?php echo $title ?></a></h4>
						<p class="author"><?php echo get_the_author($author); ?></p>
				</article>
			</li>
<?php 		} 
		} 
}

function ep_popular_posts($limit = '5') {
	$posts_per_page = get_query_var('posts_per_page');
		$args=array(
		 'posts_per_page' => $limit, 
		 'post_type' => 'post', 
		 'key' => 'views',
		 'orderby' => 'meta_value_num', 
		 'order' => 'ASC',
		 'post_status' => 'publish'
		);
		query_posts($args);
		while (have_posts()) : the_post(); ?> 
			<li>
				<article class="entry">
					<a href="<?php the_permalink(); ?>" rel="permalink"><?php the_post_thumbnail('thumbnail'); ?> 
					<h4><?php the_title(); ?></h4></a>
				</article>
			</li>
<?php 	endwhile; wp_reset_query(); 
}

?>