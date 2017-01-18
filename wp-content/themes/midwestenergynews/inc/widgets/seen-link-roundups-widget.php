<?php
/**
 * SEEN Roundups Widget
 *
 * Replaces the cat2 option used in the MWEN Roundups Widget with the latest roundup from MWEN
 * This is a cross-blog query that assumes that MWEN is blog 64
 *
 * @see ./mwen-roundups-widget.php
 */
class seen_roundups_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'seen-roundups-widget',
			'description' => 'Show one roundup from a chosen category in Southeast Energy News, PLUS the most-recent roundup from MWEN.', 'mwen'
		);
		parent::__construct('seen-roundups-widget','SEEN Roundups Widget', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

			echo "<p class='roundup-date'><datetime>" . date("F j, Y") . "</datetime></p>"; ?>

			<?php
			$query1_args = array (
				'post__not_in' 	=> get_option( 'sticky_posts' ),
				'showposts' 	=> $instance['num_posts'],
				'exceprt'	=> $instance['show_excerpt'],
				'post_type' 	=> 'roundup',
				'post_status'	=> 'publish'
			);

			if ( $instance['cat1'] != '' ) $query1_args['cat'] = $instance['cat1'];

			/*
			 * This section has been changed from the MWEN Link Roundups WIdget to remove references to the cat2 options
			 */
			$output = '';

			$my_query = new WP_Query( $query1_args );
			if ( $my_query->have_posts() ) {
				while ( $my_query->have_posts() ) {
					$my_query->the_post();
					$custom = get_post_custom($post->ID);
?>
					<div class="post-lead clearfix">
						<h5 class="top-tag"><a href="<?php echo get_category_link($query1_args['cat']); ?>"><?php echo get_cat_name($query1_args['cat']); ?></a></h5>
						<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
					</div> <!-- /.post-lead -->
<?php
				}
			} else {
				_e('<p class="error"><strong>You don\'t have any recent links or the argo links plugin is not active.</strong></p>', 'argo-links');
			} // end this category's recent link

			if ( $instance['linkurl'] !='' ) { ?>
				<p class="morelink"><a href="<?php echo $instance['linkurl']; ?>"><?php echo $instance['linktext']; ?></a></p>
			<?php }

			/**
			 * Here begins the cross-blog query to MWEN, for MWEN's most-recent roundup
			 *
			 * This assumes that blog 64 is MWEN
			 */
			$blog = (array) get_blog_details(64);
			if ( isset( $blog['blog_id'] ) ) {
				// Switch to MWEN
				switch_to_blog(64);

				// get the most recent roundup
				$recent = new WP_Query( array(
					'posts_per_page' => 1,
					'post_type' => 'roundup',
				) );

				// link to it
				if ( $recent->have_posts() ) {

					// if you wanted to put a link or other descriptor here, this is where it would go.

					while ( $recent->have_posts() ) {
						$recent->the_post();
						$cats = get_the_category();
						$cat = (array) $cats[0];
						?>

						<!-- mwen roundup -->
						<div class="post-lead clearfix">
							<h5 class="top-tag"><a href="<?php echo get_category_link($cat['term_id']); ?>" target="_blank"><?php echo get_cat_name($cat['term_id']); ?></a></h5>
							<h4><a href="<?php echo get_permalink(); ?>" target="_blank"><?php echo get_the_title(); ?></a></h4>
						</div> <!-- /.post-lead -->

						<?php
					}
				}

				// Switch back to the current blog, to prevent things being messed up.
				restore_current_blog();
				// end the MWEN portino of this widget
			}

		// reset
		wp_reset_postdata();
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = strip_tags( $new_instance['num_posts'] );
		$instance['linktext'] = $new_instance['linktext'];
		$instance['linkurl'] = $new_instance['linkurl'];
		$instance['cat1'] = intval( $new_instance['cat1'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => 'Recent Link Roundups',
			'num_posts' => 1,
			'linktext' => '',
			'linkurl' => '',
			'cat1' => 0,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p> This widget should only be used on Southeast Energy News. </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'argo-links'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>"><?php _e('Number of posts to show:', 'argo-links'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" style="width:90%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('cat1'); ?>"><?php _e('Category 1: ', 'largo'); ?>
			<?php wp_dropdown_categories(array('name' => $this->get_field_name('cat1'), 'show_option_all' => __('None (all categories)', 'largo'), 'hide_empty'=>0, 'hierarchical'=>1, 'selected'=>$instance['cat1'])); ?></label>
		</p>

		<p>This widget will also output the most-recent Roundup from Midwest Energy News.</p>

		<p><strong>More Link</strong><br /><small><?php _e('If you would like to add a more link at the bottom of the widget, add the link text and url here.', 'argo-links'); ?></small></p>
		<p>
			<label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text:', 'argo-links'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $instance['linktext']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linkurl'); ?>"><?php _e('URL:', 'argo-links'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkurl'); ?>" name="<?php echo $this->get_field_name('linkurl'); ?>" type="text" value="<?php echo $instance['linkurl']; ?>" />
		</p>

	<?php
	}
}
