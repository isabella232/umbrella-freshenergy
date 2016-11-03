<?php

/**
 * FE Homepage Posts widget
 * This is used to create the homepage layout in the Homepage Bottom widget area.
 *
 * Copied in part from largo_recent_posts_widget
 * @since Largo 0.5.5
 * @since 0.1
 */
class fe_homepage_posts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		$widget_ops = array(
			'classname' => 'fe-homepage-posts',
			'description' => __( 'Displays recent posts on the homepage', 'fe' )
		);
		parent::__construct(
			'fe-homepage-posts', // Base ID
			__( 'Fresh Energy Homepage Posts', 'fe' ), // Name
			$widget_ops // Args
		);

	}

	/**
	 * Outputs the content of the recent posts widget.
	 *
	 * @param array $args widget arguments.
	 * @param array $instance saved values from databse.
	 * @global $post
	 * @global $shown_ids An array of post IDs already on the page, to avoid duplicating posts
	 * @global $wp_query Used to get posts on the page not in $shown_ids, to avoid duplicating posts
	 */
	function widget( $args, $instance ) {

		global $post,
			$wp_query, // grab this to copy posts in the main column
			$shown_ids; // an array of post IDs already on a page so we can avoid duplicating posts;
		
		// Preserve global $post
		$preserve = $post;

		extract( $args );

		// Add the link to the title, using largo_add_link_to_widget_title hooked on widget_title
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title;


		$query_args = array (
			'post__not_in' 	 => get_option( 'sticky_posts' ),
			'post_status'	=> 'publish',
			'post_per_page' => 4,
		);

		if ( isset( $instance['avoid_duplicates'] ) && $instance['avoid_duplicates'] === 1 ) {
			$query_args['post__not_in'] = $shown_ids;
		}
		if ( $instance['cat'] != '' ) $query_args['cat'] = $instance['cat'];

		$my_query = new WP_Query( $query_args );

		if ( $my_query->have_posts() ) {

			$output = '';

			ob_start();
				echo '<div class="row-fluid">';

				$i = 0;

				while ( $my_query->have_posts() ) {
					$my_query->the_post();
					$shown_ids[] = get_the_ID();
					$i++;


					$context = array(
						'instance' => $instance,
						'thumb' => $thumb,
					);


					// // the first post gets wrapped in a span8, the second through fourth posts get wrapped in a span4
					// // Hope that there are more than 4 posts in the category
					// switch ( $i ) {
					// 	case 1:
					// 		echo '<div class=" display-block span8">';
					// 		largo_render_template( 'partials/widget', 'fe-home-big', $context );
					// 		echo '</div>';
					// 		break;
					// 	case 2:
					// 		echo '<div class="span4">';
					// 		largo_render_template( 'partials/widget', 'fe-home-small', $context );
					// 		break;
					// 	case 3:
					// 		largo_render_template( 'partials/widget', 'fe-home-small', $context );
					// 		break;
					// 	case 4:
					// 		largo_render_template( 'partials/widget', 'fe-home-small', $context );
					// 		echo '</div>';
					// 		break;
					// }

					if ($i == 4) {
						echo '</div><div class="row-fluid">';
					}

					echo '<div class="span4">';
					largo_render_template( 'partials/widget', 'fe-home-card', $context );
					echo '</div>';

				}

				echo '</div><a href=""><button>More Recent News</button></a>'; // end the widget's primary div

			$output .= ob_get_clean();

			// print all of the items
			echo $output;

		} // end more featured posts

		echo $after_widget;

		// Restore global $post
		wp_reset_postdata();
		$post = $preserve;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['avoid_duplicates'] = ! empty( $new_instance['avoid_duplicates'] ) ? 1 : 0;
		$instance['cat'] = intval( $new_instance['cat'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => __( 'Recent ' . of_get_option( 'posts_term_plural', 'Posts' ), 'largo' ),
			'avoid_duplicates' => '',
			'cat' => 0,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$duplicates = $instance['avoid_duplicates'] ? 'checked="checked"' : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'largo' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $duplicates; ?> id="<?php echo $this->get_field_id( 'avoid_duplicates' ); ?>" name="<?php echo $this->get_field_name( 'avoid_duplicates' ); ?>" /> <label for="<?php echo $this->get_field_id( 'avoid_duplicates' ); ?>"><?php _e( 'Avoid Duplicate Posts?', 'largo' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Limit to category: ', 'largo'); ?>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name( 'cat' ), 'show_option_all' => __( 'None (all categories)', 'largo' ), 'hide_empty'=>0, 'hierarchical'=>1, 'selected'=>$instance['cat'] ) ); ?></label>
		</p>

	<?php
	}
}
